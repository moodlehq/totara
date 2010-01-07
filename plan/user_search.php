<?php
    require_once ('../config.php');
    require_once($CFG->dirroot.'/plan/lib.php');
    require_once($CFG->dirroot.'/user/filters/lib.php');

    $search       = optional_param('search', '', PARAM_TEXT);
    $sort         = optional_param('sort', 'name', PARAM_ALPHA);
    $dir          = optional_param('dir', 'ASC', PARAM_ALPHA);
    $page         = optional_param('page', 0, PARAM_INT);
    $perpage      = optional_param('perpage', 30, PARAM_INT);        // how many per page

    $site = get_site();
    require_login($site->id);

    //
    // Set up page variables
    //
    $sitecontext = get_context_instance(CONTEXT_SYSTEM);

    if ($sort == 'name') {
        $sort = 'firstname';
    }

    $stridps  = get_string('idps', 'idp');
    $strprofile = get_string('profile');

    //
    // Output header and navigation links
    //

    $navlinks   = array();
    $navlinks[] = array('name' => $stridps, 'link' => $CFG->wwwroot."/plan/index.php", 'type' => 'home');
    $navlinks[] = array('name' => $stridps, 'link' => "index.php", 'type' => 'home');
    $navlinks[] = array('name' => get_string('search'), 'link' => '', 'type' => 'home');
    $navigation = build_navigation($navlinks);

    print_header_simple('Learning plan search', '', $navigation, '', '', true); 

    //
    // Initialise results table columns
    //
    idp_usearch_init_columns();

    //
    // Run the search against the database
    //

    $users = '';
    $usercount = 0;
    if (!empty($search)) {
        $allusers = get_users_listing($sort, $dir, 0, 0, $search, '', '');
        $usercount = count($allusers);
        $users = get_users_listing($sort, $dir, $page*$perpage, $perpage, $search, '', '');

        print_paging_bar($usercount, $page, $perpage,
                         idp_usearch_geturl(array('sort' => $sort, 'dir' => $dir,
                                                    'search' => $search, 'perpage' => $perpage)));

    }
    // Output the page so far, so that users see some feedback quickly, even if 
    // results list takes some time.
    flush();

    if (!$users) {
        print_heading(get_string('nousersfound'));

        $table = NULL;
    } else {
        //
        // Construct and output results table
        //
        $mainadmin = get_admin();

        $table->head = array ("$firstname / $lastname", $city, $country, $lastaccess, "", "");
        $table->align = array ("left", "left", "left", "left", "center", "center");
        $table->width = "95%";
        foreach ($users as $user) {
            if ($user->username == 'guest') {
                continue; // do not display dummy new user and guest here
            }

            idp_usearch_handlemnetuser($user);

            if ($user->lastaccess) {
                $strlastaccess = format_time(time() - $user->lastaccess);
            } else {
                $strlastaccess = get_string('never');
            }

            $fullname = fullname($user, true);

            $row = array ();
            $row[] = $fullname;
            $row[] = $user->city;
            $row[] = $user->country;
            $row[] = $strlastaccess;
            $row[] = " <a href=\"{$CFG->wwwroot}/plan/index.php?userid={$user->id}\">$stridps</a>";
            $row[] = " <a href=\"{$CFG->wwwroot}/user/view.php?id={$user->id}\">$strprofile</a>";
            $table->data[] = $row;
        }
    }

    if (!empty($table)) {
        print_table($table);
        print_paging_bar($usercount, $page, $perpage,
                         idp_usearch_geturl(array('sort' => $sort, 'dir' => $dir,
                                                    'search' => $search, 'perpage' => $perpage)));
    }

    print_box_start();
    echo usersearch_form($search);
    print_box_end();

    print_footer();



/* -- Functions follow -------------------------------------------------------------------------------- */
 

    // Set up the column links and sort directions for each column of the results table.
    function idp_usearch_init_columns() {
        global $CFG, $columns, $dir, $sort, $search;

        $columns = array("firstname", "lastname", "city", "country", "lastaccess");

        foreach ($columns as $column) {
            $string[$column] = get_string("$column");
            if ($sort != $column) {
                $columnicon = "";
                if ($column == "lastaccess") {
                    $columndir = "DESC";
                } else {
                    $columndir = "ASC";
                }
            } else {
                $columndir = $dir == "ASC" ? "DESC":"ASC";
                if ($column == "lastaccess") {
                    $columnicon = $dir == "ASC" ? "up":"down";
                } else {
                    $columnicon = $dir == "ASC" ? "down":"up";
                }
                $columnicon = " <img src=\"$CFG->pixpath/t/$columnicon.gif\" alt=\"\" />";

            }
            $url = idp_usearch_geturl(array('sort' => $column, 'dir' => $columndir, 'search' => $search));
            $GLOBALS[$column] = "<a href=\"$url\">".$string[$column]."</a>$columnicon";
        }
    }

    // Return a URL for this script, preserving required GET params, such as search ..
    //  $extraparams can be an array of ( paramname => paramvalue, ... ), to be added to the URL
    function idp_usearch_geturl($extraparams) {

        $url = "user_search.php?";
        $param = array();
        foreach($extraparams as $name => $value) {
            $param[] = urlencode($name) . '=' . urlencode($value);
        }
        $url .= implode('&amp;', $param) . '&amp;';
        return $url;
    }

    // NB: Is this required??
    function idp_usearch_handlemnetuser($user) {
        global $confirmbutton, $editbutton;

        // for remote users, shuffle columns around and display MNET stuff
        if (is_mnet_remote_user($user)) {
            $accessctrl = 'allow';
            if ($acl = get_record('mnet_sso_access_control', 'username', $user->username, 'mnet_host_id', $user->mnethostid)) {
                $accessctrl = $acl->accessctrl;
            }
            $changeaccessto = ($accessctrl == 'deny' ? 'allow' : 'deny');
            // delete button in confirm column - remote users should already be confirmed
            // TODO: no delete for remote users, for now. new userid, delete flag, unique on username/host...
            $confirmbutton = "";
            // mnet info in edit column
            if (isset($mnethosts[$user->mnethostid])) {
                $editbutton = $mnethosts[$user->mnethostid]->name;
            }
        }
    }
?>
