<?php

require_once('../../../../config.php');
//require_once($CFG->dirroot.'/hierarchy/prefix/position/lib.php');

///
/// Setup / loading data
///

// competency id
$id = required_param('id', PARAM_INT);
$returnurl = optional_param('returnurl', $CFG->wwwroot, PARAM_TEXT);
$confirm = optional_param('confirm', 0, PARAM_INT);
$s = optional_param('s', null, PARAM_TEXT);

// only redirect back if we are sure that's where they came from
if($s != sesskey()) {
    $returnurl = $CFG->wwwroot;
}

// Check perms
$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:updatecompetency', $sitecontext);

if($confirm) { // confirmation made
    if(confirm_sesskey()) {
        if(delete_records('comp_evidence','id',$id)) {
            redirect($returnurl);
        } else {
            redirect($returnurl,get_string('couldnotdeletece','local'));
        }
    }
}

$pagetitle = format_string(get_string('deletecompetencyevidence','local'));
$navlinks[] = array('name' => get_string('deletecompetencyevidence','local'), 'link'=> '', 'type'=>'title');
$navigation = build_navigation($navlinks);

print_header_simple($pagetitle, '', $navigation, '', null, true, null);

print '<h2>'.get_string('deletecompetencyevidence', 'local').'</h2>';

// prompt to delete
notice_yesno(get_string('confirmdeletece','local'), qualified_me(), $returnurl, array('confirm'=>1,'sesskey'=>sesskey()));


print_footer();

