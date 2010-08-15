<?php

require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once('../idp_forms.php');
require_once('../lib.php');

require_login();

$id = optional_param('id', 0, PARAM_INT);
$templateid = optional_param('templateid', 0, PARAM_INT);

admin_externalpage_setup('idptemplate');

$stridps = get_string('idps', 'idp');
$idptemplates = get_string('managetemplates', 'idp');

if($id == 0){
    $competencyarea = new object();
    $competencyarea->id = 0;
    $competencyarea->sortorder = get_field('idp_comp_area', 'MAX(sortorder) + 1', 'templateid', $templateid);
    if (!$competencyarea->sortorder) {
        $competencyarea->sortorder = 1;
    }
}
else {
    if (!$competencyarea = get_record('idp_comp_area', 'id', $id)) {
        error('Competency area ID was incorrect');
    }
    else{
        if($frameworks = get_records('idp_comp_area_fw', 'areaid', $competencyarea->id)){
            $list = array();
            foreach($frameworks as $fw){
                $list[$fw->frameworkid] = '1';
            }
            $competencyarea->framework = $list;
        }
    }
}

$pagetitle = 'Create competency area';
$returnurl = $CFG->wwwroot . '/idp/comparea/edit.php';
$cancelurl = $CFG->wwwroot . '/idp/settings/index.php';

$navlinks = array();
$navlinks[] = array('name' => $idptemplates, 'link' => "index.php", 'type' => 'home');
$navlinks[] = array('name' => $pagetitle, 'link' => '', 'type' => 'home');

admin_externalpage_print_header($stridps, $navlinks);

$frameworkcount = 1;
$frameworklist = get_records_sql("SELECT id, shortname, fullname FROM {$CFG->prefix}comp_framework");

// form definition
$mform =& new idp_new_competency_area_form(null, compact('templateid','frameworklist'));

$mform->set_data($competencyarea);

if ($mform->is_cancelled()) {
    redirect($cancelurl);
}
if ($fromform = $mform->get_data()) {

    if(empty($fromform->submitbutton)) {
        print_error('error:unknownbuttonclicked', 'local', $returnurl);
    }

    $frameworks = $fromform->framework;

    $todb = new object();
    $todb->id = $competencyarea->id;
    $todb->templateid = $fromform->templateid;
    $todb->fullname = $fromform->fullname;
    $todb->shortname = $fromform->shortname;
    $todb->sortorder = $competencyarea->sortorder;
    $todb->visible = '1';
    $todb->prioritiesenabled = '0';
    if($id!=0){
        if(update_record('idp_comp_area',$todb)) {
            foreach($frameworks as $key => $val){
                if($val == 1 && (!$record = get_record('idp_comp_area_fw', 'areaid', $competencyarea->id, 'frameworkid', $key))){
                    $fw = new object();
                    $fw->frameworkid = $key;
                    $fw->areaid = $competencyarea->id;
                    $framework = insert_record('idp_comp_area_fw', $fw);
                }
                else if($val == 0 && ($record = get_record('idp_comp_area_fw', 'areaid', $competencyarea->id, 'frameworkid', $key))){
                    delete_records('idp_comp_area_fw', 'id', $record->id);
                }
            }
        } else {
            redirect($returnurl.'?id='.$id, get_string('error:couldnotupdatecompetencyarea','idp'));
        }
    }
    else{
        if($newcompareaid = insert_record('idp_comp_area', $todb)){
            foreach($frameworks as $key => $val){
                if($val == 1){
                    $fw = new object();
                    $fw->frameworkid = $key;
                    $fw->areaid = $newcompareaid;
                    $framework = insert_record('idp_comp_area_fw', $fw);
                }
            }
            redirect($returnurl.'?id='.$newcompareaid);
        } else{
            redirect($returnurl, get_string('error:couldnotcreatecompetencyarea','idp'));
        }
    }
}

$currenttab = 'general';
require('tabs.php');

$mform->display();

print_footer();
?>
