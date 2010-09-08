<?php // $Id$
      // Admin-only code to delete a course utterly

    require_once("../config.php");
    require_once($CFG->dirroot . "/guides/lib.php");
    $giid = required_param('gi', PARAM_INT);              // course id
    $delete = optional_param('delete', '', PARAM_ALPHANUM); // delete confirmation hash

    require_login();
    $context = get_context_instance(CONTEXT_SYSTEM);
    require_capability('block/guides:deleteownguide', $context);

    $strdeleteguide = get_string("deleteguide",'block/guides');
    $strdelete = get_string('delete');
    $guidesql = 'SELECT gi.*, g.steps, g.name, g.description ' .
                'FROM ' . $CFG->prefix . 'block_guides_guide_instance gi ' .
                ' INNER JOIN ' . $CFG->prefix . 'block_guides_guide g on gi.guide=g.id ' .
                'WHERE gi.id = ' . $giid . ' AND gi.deleted = 0';
    $gi = get_record_sql($guidesql);
    if (! $gi || ($USER->id != $gi->userid)) {
        error("No such guide matching those detail able to be deleted");
    }

    $navlinks = array();
    $strguides = get_string('guides','block/guides');
    $navlinks[] = array('name' => $strguides, 'link' => "index.php", 'type' => 'misc');

    if (! $delete) {
        $strdeleteguidecheck = get_string("deleteguidecheck", 'block/guides');
        $navlinks[] = array('name' => $gi->name, 'link' => "view.php?gi=$giid", 'type' => 'misc');
        $navlinks[] = array('name' => $strdelete, 'link' => null, 'type' => 'misc');
        $navigation = build_navigation($navlinks);

        print_header($gi->name. ": ", $gi->name . ": ", $navigation, "", "", true);

        notice_yesno("$strdeleteguidecheck<br /><br />",
                     "delete.php?gi=$gi->id&amp;delete=".md5($gi->name . $gi->currentstep)."&amp;sesskey=$USER->sesskey",
                     "view.php?gi=$gi->id");

        print_footer();
        exit;
    }

    if ($delete != md5($gi->name . $gi->currentstep)) {
        error("The check variable was wrong - try again");
    }

    if (!confirm_sesskey()) {
        print_error('confirmsesskeybad', 'error');
    }

    $navlinks[] = array('name' => $gi->name, 'link' => null, 'type' => 'misc');
    $navlinks[] = array('name' => $strdelete, 'link' => null, 'type' => 'misc');
    $navigation = build_navigation($navlinks);
    print_header($gi->name. ": ", $gi->name . ": ", $navigation, "", "", true);
    delete_gi($gi);
    print_heading( get_string("deletedguide", "block/guides", $gi->name));
    print_continue($CFG->wwwroot.'/guides/');

    print_footer();

?>
