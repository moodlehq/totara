<?php

/**
 * Automated site link checker
 *
 * Spiders the internal links on a Totara site and checks for database, PHP or page
 * errors (like 404s)
 *
 * To add more checks, add code to the $link_checker->look_for_errors() method.
 *
 * @author Simon Coggins <simon.coggins@totaralms.com>
 *
 * @todo:
 * - allow whitelisting on per-error basis
 * - allow generalise to visit each type of link N times
 *
 */

if (count($_SERVER['argv']) > 5 || count($_SERVER['argv']) < 2) {
    echo "Syntax:\n";
    echo 'php ' . basename($_SERVER['argv'][0]) . " siteurl [moodle_username] [moodle_password] [startpage]\n\n";
    echo "where:\n";
    echo "siteurl is the full URL with trailing slash  (http://www.my-site.com/)\n";
    echo "moodle_username is the moodle username to login with\n";
    echo "moodle_password is the password for that user (wrap in single quotes if it includes shell characters like '!')\n";
    echo "startpage is the page for the checking to start on\n";
    exit;
}

// URL of site (including trailing slash)
$site_url = $_SERVER['argv'][1];

// moodle login credentials - login as learner by default
$MOODLE_USERNAME = isset($_SERVER['argv'][2]) ? $_SERVER['argv'][2] : 'learner';
$MOODLE_PASSWORD = isset($_SERVER['argv'][3]) ? $_SERVER['argv'][3] : 'passworD1!';

// page to start from (default index.php)
$start_page = isset($_SERVER['argv'][4]) ? $_SERVER['argv'][4] : 'index.php';

// list of URLs not to scan
// everything after the site URL, e.g: 'login/logout.php'
$ignore_list = array(
    'login/logout.php', // avoid logging out
    'help.php?module=wiki&file=howtowiki.html', // contains an example URL fragment: 'http://'
    'help.php?module=data&file=tags.html', // contains a string that looks like a bad lang string [[fieldname]]
    'calendar/export_execute.php', // exports in ical format, which breaks urls in the middle
    'iplookup/index.php?ip=192.168.', // fails on local IP lookup,
    'admin/xmldb/', // not useful to test
);

// debugging level:
// 0 = no output at all
// 1 = errors only
// 2 = as above, plus some general stats
// 3 = as above, plus basic progress information
// 4 = as above, plus additional progress information
// 5 = full debug messages
$DEBUG_LEVEL = 2;

// create a new link checker
$lc = new link_checker($site_url, $start_page, $ignore_list);

// start spidering site
$lc->go();


////////////////////////////////////////////////////////////////
// class definitions
////////////////////////////////////////////////////////////////


/**
 * Class defining a link checker
 */
class link_checker {
    private $site_url, $start_page, $ignore_list, $cookie_file;
    private $visited_urls, $urls_to_visit, $errors;

    /**
     * Initialise a new link checker object
     */
    function __construct($site_url, $start_page, $ignore_list = array()) {
        $this->site_url = $site_url;
        $this->start_page = $start_page;
        $this->ignore_list = $ignore_list;
        $this->visited_urls = array();
        $this->urls_to_visit = array();
        $this->errors = array();

        // login to site to set session cookies
        // initialization should fail if this doesn't work
        if (!$this->moodle_login($site_url)) {
            throw new Exception('Could not login to moodle - aborting');
        }
        $this->debug('Logged in.', 4);
    }

    /**
     * Print a debug message
     */
    public function debug($message, $level = 1) {
        global $DEBUG_LEVEL;
        if ($DEBUG_LEVEL >= $level) {
            print $message . "\n";
        }
    }

    /**
     * Login to moodle site in order to set required cookies
     */
    private function moodle_login() {
        global $MOODLE_USERNAME, $MOODLE_PASSWORD;

        $this->debug('Logging in to moodle...', 4);

        // create a temp file for storing login cookie
        $this->cookie_file = tempnam(sys_get_temp_dir(), 'cookie');

        // visit login page to get session cookies
        $ch = curl_init();
        $options = array(
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; `rv:1.9.2) Gecko/20100115 Firefox/3.6',
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_COOKIEJAR => $this->cookie_file,
            CURLOPT_FOLLOWLOCATION => 1
        );
        $options[CURLOPT_URL] = $this->site_url . 'login/index.php';
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        if ($result === false) {
            $this->debug(curl_error($ch));
            return false;
        }

        // now POST the login form to set login cookies
        $options[CURLOPT_POST] = TRUE;
        $options[CURLOPT_POSTFIELDS] = array('username' => $MOODLE_USERNAME, 'password' => $MOODLE_PASSWORD, 'testcookies' => 1);
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        if ($result === false) {
            $this->debug(curl_error($ch));
            return false;
        }

        // make sure login was successful
        if (preg_match('/Invalid login, please try again/', $result)) {
            $this->debug('Login failed - bad username or password?', 1);
            return false;
        }

        // closing curl session will write cookie info to temp file
        curl_close($ch);
        unset($ch);

        return true;
    }

    /**
     * Download and parse a specified URL
     *
     * @param   object A 'lc_page' object containing details of a page to be analysed
     * @return  array   HTML data
     */
    private function parse_page(&$page_to_check) {
        if (empty($this->cookie_file)) {
            $this->debug('Could not find cookie, run moodle_login() first!');
            return false;
        }

        // use curl to get the page contents
        $ch = curl_init();
        $options = array(
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; `rv:1.9.2) Gecko/20100115 Firefox/3.6',
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_COOKIEJAR => $this->cookie_file,
            CURLOPT_FOLLOWLOCATION => 1
        );
        $options[CURLOPT_COOKIEFILE] = $this->cookie_file;
        $options[CURLOPT_URL] = $page_to_check->actual_url;
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        if ($result === false) {
            $this->debug(curl_error($ch));
            return false;
        }
        $statuscode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // add the status code to the page object
        $page_to_check->statuscode = $statuscode;

        curl_close($ch);

        // now parse the page contents
        $html = new DOMDocument();
        $html->strictErrorChecking = false;
        $html->substituteEntities = false;
        @$html->loadHTML($result);
        return array('dom' => $html, 'raw' => $result);
    }

    /**
     * Look for errors in a page's parsed DOM tree
     *
     * Add to this method to include additional checks
     *
     * When an error is found, a new lc_page_error object is created and pushed onto the errors array
     *
     * @param object A parsed version of the page, as generated by parse_page()
     * @param object A 'lc_page' object containing details of a page to be analysed
     */
    private function look_for_errors($parsed_page, $page_to_check) {

        $xpath = new DomXPath($parsed_page['dom']);

        // check for the CSS for 'moodle' error boxes and save a message
        // containing the contents
        $errorbox = false;
        foreach ($xpath->query('//*[contains(@class, \'errorbox\')]') as $message) {
            $errorbox = true;
            $error = new lc_page_error('Error message "' . $message->nodeValue . '"',
                $page_to_check);
            array_push($this->errors, $error);
        }

        // only include bad status code if it's not on a page generated by error() or print_error()
        // as they will also return a 404 status
        $statuscode = $page_to_check->statuscode;
        if (!$errorbox && $statuscode >= 400) {
            $error = new lc_page_error('Bad status code reported', $page_to_check);
            array_push($this->errors, $error);
        }

        /*
        // look for SQL errors printed to the page
        // this only works if debugging is set high and errors output to page
        // alternatively, just save errors directly to the server logs
        foreach ($parsed_page->find('div.notifytiny') as $el) {
            if (preg_match('/call to debugging\(\)/', $el->plaintext)) {
                $error = new lc_page_error('SQL Error: "' . $el->plaintext . '"',
                    $page_to_check);
                array_push($this->errors, $error);
            }

        }
         */

        /*
        // look for PHP errors
        // this only works if you have debugging set high, errors output to page
        // and Xdebug with pretty error messages installed
        // alternatively, just save errors directly to the server logs
        foreach ($parsed_page->find('table.xdebug-error') as $err) {
            // find first <th> tag
            $el = $err->find('th', 0);

            $error = new lc_page_error('PHP Error: "' . $el->plaintext . '"',
                $page_to_check);
            array_push($this->errors, $error);
        }
         */

        // get the whole page (unparsed)
        $rawhtml = $parsed_page['raw'];

        // @todo only list each lang string once
        if (preg_match_all('/\[\[([^\]]+)\]\]/i', $rawhtml , $matches, PREG_PATTERN_ORDER)) {
            $badstrings = $matches[1];
            foreach ($badstrings as $badstring) {
                $error = new lc_page_error('Bad language string "' . $badstring . '"',
                    $page_to_check);
                array_push($this->errors, $error);
            }
        }
    }


    /**
     * Process a parsed HTML page, saving any links to visit
     */
    private function process_links($parsed_page, $page_to_check) {
        $url_to_process = $page_to_check->actual_url;

        // loop through every link in the page
        $xpath = new DomXPath($parsed_page);
        foreach ($xpath->query('//a[@href]') as $link) {
            $url = html_entity_decode(trim($link->getAttribute('href')));

            // log empty urls
            if (strlen($url) == 0) {
                $error = new lc_page_error('Empty URL found in link named "'. $link->nodeValue . '"', $page_to_check);
                array_push($this->errors, $error);
                continue;
            }

            // log local IP addresses
            if (preg_match('/[^=]192\.168\.[0-9]+\.[0-9]+/', $url)) {
                $error = new lc_page_error('Local IP address found in URL "' . $url . '"', $page_to_check);
                array_push($this->errors, $error);
                continue;
            }

            if (preg_match('/^#/', $url)) {
                $this->debug('Skipping anchor link: ' . $url, 5);
                continue;
            }

            // add root to relative paths
            $url = rel2abs($url, $url_to_process);

            if (substr($url, 0, strlen($this->site_url)) != $this->site_url) {
                $this->debug('Skipping external link: ' . $url, 5);
                continue;
            }

            // skip urls that match the start of the ignore list (will work for directories)
            foreach ($this->ignore_list as $ignore_item) {
                $badlink = $this->site_url . $ignore_item;
                if (substr($url, 0, strlen($badlink)) == $badlink) {
                    $this->debug('Skipping link from ignore list: ' . $url, 5);
                    continue 2;
                }
            }

            // this link has already been visited
            foreach ($this->visited_urls as $visited_url) {
                if (generalise($url) == $visited_url) {
                    $this->debug('Skipping link from visited list: ' . $url . ' as it generalises to match ' . $visited_url, 5);
                    continue 2;
                }
            }

            // already in the list to visit
            foreach ($this->urls_to_visit as $url_to_visit) {
                if ($url_to_visit->generalised_url == generalise($url)) {
                    $this->debug('Skipping link already marked for visiting: '. $url . ' as it generalises to match ' . $url_to_visit->generalised_url, 5);
                    continue 2;
                }

            }

            // nothing wrong with this link
            // add it to the list of links to visit
            $this->debug('Saving link to visit later: ' . $url, 4);
            $item = new lc_page($url, $url_to_process);

            array_push($this->urls_to_visit, $item);

        }

    }

    /**
     * Check links in a specific page and record the results
     *
     * @param object A 'page' object containing details of a page to be analysed
     */
    private function check_page($page_to_check) {

        // add this url to the list of visited pages
        // do it before the check in case it links to itself
        array_push($this->visited_urls, $page_to_check->generalised_url);

        // download the page
        if ($html = $this->parse_page($page_to_check)) {
            // scan the page for any errors
            $this->look_for_errors($html, $page_to_check);
            // parse the links on the page for more pages
            $this->process_links($html['dom'], $page_to_check);
        }
    }


    /**
     * Execute the link checker
     */
    public function go($url = null) {

        $this->debug('Starting link check...', 2);

        // default to start page
        if (empty($url)) {
            $url = $this->site_url . $this->start_page;
        }

        // make an object containing the URL info
        $item = new lc_page($url);

        // check the initial page
        $this->check_page($item);

        // now work through urls_to_visit until empty
        while (count($this->urls_to_visit) > 0) {
            $page_to_check = array_shift($this->urls_to_visit);
            $actual_url = $page_to_check->actual_url;

            $this->debug(count($this->visited_urls) . ' URLs visited, ' . count($this->urls_to_visit) . ' URLs left to go.' . "\n", 3);
            $this->debug('Visiting URL: '. $actual_url . "\n", 4);
            $this->check_page($page_to_check);

        }

        // print results
        $this->debug("\n" . 'Visited ' . count($this->visited_urls) . ' URLs.' . "\n", 2);

        // report on completion
        if (count($this->errors) == 0) {
            $this->debug('Scan complete. No issues found.', 1);
        } else {
            // print errors
            $err_message = count($this->errors) . " errors found:\n\n";
            foreach ($this->errors as $error) {
                $err_message .= $error->format_error();
            }
            $this->debug($err_message, 1);
        }
    }

} // end of link_checker class


/**
 * Class defining an object containing page error information
 */
class lc_page_error {
    private $message, $page;

    // save the error message and page context
    function __construct($message, $page) {
        $this->message = $message;
        $this->page = $page;
    }

    /**
     * Display the error stored by this object
     */
    public function format_error() {
        $source = empty($this->page->actual_url) ? 'Unknown' : $this->page->actual_url;
        $referrer = empty($this->page->referrer) ? 'None' : $this->page->referrer;
        $statuscode = $this->page->statuscode;

        $out = 'ERROR:       ' . $this->message . "\n";
        $out .= 'Page:        ' . $source . "\n";
        $out .= 'Referrer:    ' . $referrer . "\n";
        // only include status if an error
        if ($statuscode >= 400) {
            $out .= 'HTTP Status: ' . $statuscode . "\n";
        }
        $out .= "\n";

        return $out;
    }

} // end of lc_page_error class

/**
 * Class defining a page object
 * containing information needed when checking a URL
 */
class lc_page {
    public $actual_url, $referrer, $generalised_url;
    public $statuscode;

    function __construct($url, $referrer = null) {
        $this->actual_url = $url;
        $this->referrer = $referrer;
        $this->generalised_url = generalise($url);
        $this->statuscode = null; // set by curl when page fetched
    }

} // end of lc_page class


////////////////////////////////////////////////////////////////
// utility functions
////////////////////////////////////////////////////////////////


/**
 * Convert a relative link into an absolute one
 *
 * @param string $rel Relative URL
 * @param string $base Base URL to use to convert $rel to absolute path
 *
 * @return string Absolute URL for $rel
 */
function rel2abs($rel, $base) {
    // return if already absolute URL
    if (parse_url($rel, PHP_URL_SCHEME) != '') {
        return $rel;
    }

    // queries and anchors
    if ($rel[0]=='#' || $rel[0]=='?') {
        return $base.$rel;
    }

    // parse base URL and convert to local variables:
    //  $scheme, $host, $path
    extract(parse_url($base));

    // remove non-directory element from path
    $path = preg_replace('#/[^/]*$#', '', $path);

    // destroy path if relative url points to root
    if ($rel[0] == '/') {
        $path = '';
    }

    // dirty absolute URL
    $abs = "$host$path/$rel";

    // replace '//' or '/./' or '/foo/../' with '/'
    $re = array('#(/\.?/)#', '#/(?!\.\.)[^/]+/\.\./#');
    for($n=1; $n>0; $abs=preg_replace($re, '/', $abs, -1, $n)) {}

    // absolute URL is ready
    return $scheme.'://'.$abs;
}

/**
 * Convert a URL into a version without any unique parameters
 *
 * @param string $url URL to be generalised
 *
 * @todo convert to use http_build_url() ?
 */
function generalise($url) {
    $pos = strpos($url, '?');
    if ($pos === false ) {
        // no query string to generalise return everything except # fragment
        if ($hashpos = strpos($url, '#')) {
            return substr($url, 0, $hashpos);
        } else {
            return $url;
        }
    }

    // params to always generalise (even when value is a string)
    $always_generalise = array(
        /**
         * Some reports have a alphabet bar for filtering usernames, can get into massive loops
         */
        'silast',
        'sifirst'
    );

    // split query params into an array
    $query = parse_url($url, PHP_URL_QUERY);
    $query_parts = array();
    parse_str($query, $query_parts);

    $new_query_parts = array();
    foreach ($query_parts as $key => $value) {
        if (strlen($value) == 0) {
            continue;
        }
        if (preg_match('/^-?[0-9]+$/', $value)) {
            // convert integers
            $new_query_parts[] = $key . '=X';
        } else if (in_array($key, $always_generalise)) {
            // convert sort parameters
            $new_query_parts[] = $key . '=X';
        } else {
            $new_query_parts[] = $key . '=' . $value;
        }
    }
    // sort array so id=X&course=Y matches course=Y&id=X
    asort($new_query_parts);

    // re-build the URL with new parameters (excluding any
    // # fragment)
    return substr($url, 0, $pos + 1) . implode('&', $new_query_parts);
}


?>

