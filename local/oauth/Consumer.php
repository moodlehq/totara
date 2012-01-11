<?php
/**
 * OAuth Consumer - derived from OAuth libraries of simpleSAMLphp
 *
 * @author Andreas Åkre Solberg, <andreas.solberg@uninett.no>, UNINETT AS.
 * @package simpleSAMLphp
 * @version $Id$
 */
// classes that clash with the real ssphp
if (!class_exists('OAuthConsumer')) {
    require_once('OAuth.php');
}

class local_oauth_HTTPResponse {

    public $body;
    private $headers;
    public $status;
    public $message;

    public function __construct($body, $headers, $status, $message) {
        $this->body = $body;
        $this->headers = $headers;
        $this->status = $status;
        $this->message = $message;

        // sort out HTTP errors
        if (empty($this->status)) {
            $this->status = $this->headers['http_code'];
        }
        if ($this->status > 299 && empty($this->message)) {
            $this->message = $this->body;
        }
    }
}

/**
* Misc static functions that is used several places.in example parsing and id generation.
*
* @author Andreas Åkre Solberg, UNINETT AS. <andreas.solberg@uninett.no>
* @author Piers Harding
* @package local/oauth
* @version $Id$
*/
class local_oauth_Utilities {

    /* This function redirects the user to the specified address.
     * An optional set of query parameters can be appended by passing
    * them in an array.
    *
    * This function will use the HTTP 303 See Other redirect if the
    * current request is a POST request and the HTTP version is HTTP/1.1.
    * Otherwise a HTTP 302 Found redirect will be used.
    *
    * The fuction will also generate a simple web page with a clickable
    * link to the target page.
    *
    * Parameters:
    *  $url         URL we should redirect to. This URL may include
    *               query parameters. If this URL is a relative URL
    *               (starting with '/'), then it will be turned into an
    *               absolute URL by prefixing it with the absolute URL
    *               to the root of the website.
    *  $parameters  Array with extra query string parameters which should
    *               be appended to the URL. The name of the parameter is
    *               the array index. The value of the parameter is the
    *               value stored in the index. Both the name and the value
    *               will be urlencoded. If the value is NULL, then the
    *               parameter will be encoded as just the name, without a
    *               value.
    *
    * Returns:
    *  This function never returns.
    */
    public static function redirect($url, $parameters = array()) {
        assert(is_string($url));
        assert(strlen($url) > 0);
        assert(is_array($parameters));

        /* Check for relative URL. */
        if(substr($url, 0, 1) === '/') {
            /* Prefix the URL with the url to the root of the
             * website.
             */
            $url = self::selfURLhost() . $url;
        }

        /* Determine which prefix we should put before the first
         * parameter.
         */
        if(strpos($url, '?') === FALSE) {
            $paramPrefix = '?';
        }
        else {
            $paramPrefix = '&';
        }

        /* Iterate over the parameters and append them to the query
         * string.
         */
        foreach($parameters as $name => $value) {

            /* Encode the parameter. */
            if($value === NULL) {
                $param = urlencode($name);
            } elseif (is_array($value)) {
                $param = "";
                foreach ($value as $val) {
                    $param .= urlencode($name) . "[]=" . urlencode($val) . '&';
                }
            } else {
                $param = urlencode($name) . '=' .
                urlencode($value);
            }

            /* Append the parameter to the query string. */
            $url .= $paramPrefix . $param;

            /* Every following parameter is guaranteed to follow
             * another parameter. Therefore we use the '&' prefix.
             */
            $paramPrefix = '&';
        }

        /* Set the HTTP result code. This is either 303 See Other or
         * 302 Found. HTTP 303 See Other is sent if the HTTP version
         * is HTTP/1.1 and the request type was a POST request.
         */
        if($_SERVER['SERVER_PROTOCOL'] === 'HTTP/1.1' &&
            $_SERVER['REQUEST_METHOD'] === 'POST') {
            $code = 303;
        }
        else {
            $code = 302;
        }

        /* Set the location header. */
        header('Location: ' . $url, TRUE, $code);

        /* Disable caching of this response. */
        header('Pragma: no-cache');
        header('Cache-Control: no-cache, must-revalidate');

        /* Show a minimal web page with a clickable link to the URL. */
        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"' .
                ' "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">' . "\n";
        echo '<html xmlns="http://www.w3.org/1999/xhtml">';
        echo '<head>
                        <meta http-equiv="content-type" content="text/html; charset=utf-8">
                        <title>Redirect</title>
                    </head>';
        echo '<body>';
        echo '<h1>Redirect</h1>';
        echo '<p>';
        echo 'You were redirected to: ';
        echo '<a id="redirlink" href="' . htmlspecialchars($url) . '">' . htmlspecialchars($url) . '</a>';
        echo '<script type="text/javascript">document.getElementById("redirlink").focus();</script>';
        echo '</p>';
        echo '</body>';
        echo '</html>';

        /* End script execution. */
        exit;
    }
}

/**
 * Encapsulate the entire OAuth consumer interaction
 * @author piers
 *
 */
class local_oauth_Consumer {

    private $consumer;
    private $signer;

    public function __construct($key, $secret) {
        $this->consumer = new OAuthConsumer($key, $secret, NULL);
        $this->signer = new OAuthSignatureMethod_HMAC_SHA1();
    }

    // Used only to load the libextinc library early.
    public static function dummy() {
    }

    public function getRequestToken($url, $parameters=NULL) {
        $req_req = OAuthRequest::from_consumer_and_token($this->consumer, NULL, "GET", $url, $parameters);
        $req_req->sign_request($this->signer, $this->consumer, NULL);

        $response_req = $this->send_request('GET', $req_req->to_url(), FALSE, FALSE);
        if ($response_req === FALSE) {
            throw new local_oauth_exception('Error contacting request_token endpoint on the OAuth Provider');
        }

        parse_str($response_req->body, $responseParsed);

        if(array_key_exists('error', $responseParsed)) {
            throw new local_oauth_exception('Error getting request token: ' . $responseParsed['error']);
        }

        $requestToken = $responseParsed['oauth_token'];
        $requestTokenSecret = $responseParsed['oauth_token_secret'];

        return new OAuthToken($requestToken, $requestTokenSecret);
    }

    public function getAuthorizeRequest($url, $requestToken, $redirect = TRUE, $callback = NULL) {
        $authorizeURL = $url . '?oauth_token=' . $requestToken->key;
        if ($callback) {
            $authorizeURL .= '&oauth_callback=' . urlencode($callback);
        }
        if ($redirect) {
            local_oauth_Utilities::redirect($authorizeURL);
            exit;
        }
        return $authorizeURL;
    }

    public function getAccessToken($url, $requestToken) {
        $acc_req = OAuthRequest::from_consumer_and_token($this->consumer, $requestToken, "GET", $url, NULL);
        $acc_req->sign_request($this->signer, $this->consumer, $requestToken);

        $response_acc = $this->send_request('GET', $acc_req->to_url(), FALSE, FALSE);
        if ($response_acc === FALSE) {
            throw new local_oauth_exception('Error contacting request_token endpoint on the OAuth Provider');
        }

        parse_str($response_acc->body, $accessResponseParsed);

        if(array_key_exists('error', $accessResponseParsed)) {
            throw new local_oauth_exception('Error getting request token: ' . $accessResponseParsed['error']);
        }

        $accessToken = $accessResponseParsed['oauth_token'];
        $accessTokenSecret = $accessResponseParsed['oauth_token_secret'];

        return new OAuthToken($accessToken, $accessTokenSecret);
    }


    public function send_request($http_method, $url, $auth_header=null, $postData=null, $timeout=100) {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_USERAGENT, 'MySpifyAgent-1.0');
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);

        switch($http_method) {
          case 'GET':
              if ($auth_header) {
                  curl_setopt($curl, CURLOPT_HTTPHEADER, array($auth_header));
              }
              break;
          case 'POST':
              curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded',
                                                           $auth_header));
              curl_setopt($curl, CURLOPT_POST, 1);
              curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
              break;
          case 'PUT':
              curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded',
                                                           $auth_header));
              curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $http_method);
              curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
              break;
          case 'DELETE':
              curl_setopt($curl, CURLOPT_HTTPHEADER, array($auth_header));
              curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $http_method);
              break;
        }
        // execute
        $body = curl_exec($curl);
        $headers = curl_getinfo($curl);

        // fetch errors
        $errorNumber = curl_errno($curl);
        $errorMessage = curl_error($curl);

        curl_close($curl);

        $response = new local_oauth_HTTPResponse($body, $headers, $errorNumber, $errorMessage);
        return $response;
    }

    public function postRequest($url, $accessToken, $parameters) {
        $data_req = OAuthRequest::from_consumer_and_token($this->consumer, $accessToken, "POST", $url, $parameters);
        $data_req->sign_request($this->signer, $this->consumer, $accessToken);
        $postdata = $data_req->to_postdata();

        $response = $this->send_request('POST', $url, FALSE, $postdata);
        return $response;
    }

    public function getRequest($url, $accessToken, $parameters) {
        $data_req = OAuthRequest::from_consumer_and_token($this->consumer, $accessToken, "GET", $url, $parameters);
        $data_req->sign_request($this->signer, $this->consumer, $accessToken);

        $response = $this->send_request('GET', $data_req->to_url(), FALSE, FALSE);
        return $response;
    }
}

