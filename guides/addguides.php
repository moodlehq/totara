<?php

    require_once("../config.php");
    require_login();
    $context = get_context_instance(CONTEXT_SYSTEM);
    require_capability('block/guides:addguides', $context);

    $guides = get_records('block_guides_guide');
    if (!$guides) {
        $guides = array();
    }

    $navlinks = array();
    $strguides = get_string('guides','block/guides');
    $navlinks[] = array('name' => $strguides, 'link' => "index.php", 'type' => 'misc');
    $navlinks[] = array('name' => 'addguides', 'link' => null, 'type' => 'misc');
    $navigation = build_navigation($navlinks);
    print_header('Add Guides: ', 'Add Guides: ', $navigation, "", "", true);

    # TODO: opendir, readdir, if !exists, require
    $dir = $CFG->dirroot . '/guides/guidedata/';
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            if (strpos($file, '.') === 0) {
                continue;
            }
            if (!is_file($dir . $file)) {
                // Not interested in directories etc
                continue;
            }
            $matches = array();
            if (!preg_match('/[0-9]*_([A-Za-z0-9_\ -]*)\.php/', $file, $matches)) {
                continue;
            }
            $basename = $matches[1];
            $found = false;
            foreach ($guides as $guide) {
                if ($guide->identifier == $basename) {
                    # We already know about that guide
                    $found = true;
                    break;
                }
            }
            if ($found) {
                continue;
            }
            unset($guide);
            require_once($dir . $file);
            $guide->identifier = $basename;
            print "New guide found - adding $basename <br />\n";
            insert_record("block_guides_guide",addslashes_object($guide));
        }
        closedir($dh);
    }

    print_continue($CFG->wwwroot);

    print_footer();

?>
