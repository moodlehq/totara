<?php
require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once('../idp_forms.php');
require_once('../lib.php');

require_login();

admin_externalpage_setup('idptemplate');

$stridps = get_string('idps', 'idp');
$idptemplates = get_string('managetemplates', 'idp');

$pagetitle = 'Create competency area';

$navlinks = array();
$navlinks[] = array('name' => $idptemplates, 'link' => "index.php", 'type' => 'home');
$navlinks[] = array('name' => $pagetitle, 'link' => '', 'type' => 'home');

admin_externalpage_print_header($stridps, $navlinks);

// form definition
$mform =& new idp_edit_population_form(null); //null, compact('id','report'));

if ($mform->is_cancelled()) {
    redirect($CFG->wwwroot.'/idp/index.php');
}
if ($fromform = $mform->get_data()) {
    if(empty($fromform->submitbutton)) {
        print_error('error:unknownbuttonclicked', 'local', $returnurl);
    }
}

$currenttab = 'population';
require('../tabs.php');

$mform->display();

print_footer();
?>
