<?php //$Id$
/**
* script for downloading of user lists
*/

require_once('../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once('lib.php');
global $SESSION;

$format = optional_param('format', '', PARAM_ALPHA);
$hierarchy         = new competency();

admin_externalpage_setup($hierarchy->prefix.'manage');
//todo decide on competencies
//require_capability('moodle/user:update', get_context_instance(CONTEXT_SYSTEM));

$return = $CFG->wwwroot.'/competency/index.php';

if (empty($SESSION->downloaddata)) {
    redirect($return);
}

if ($format) {
    $fields = array('id'        => 'id',
                    'fullname'  => 'fullname',
                    'shortname' => 'shortname',
                    'idnumber'  => 'idnumber',
                    'frameworkid' => 'frameworkid',
                    'parentid' => 'parentid',
                    'sortorder'    => 'sortorder',
                    'depthid'    => 'depthid',
                    'path'      => 'path',
                    'description'       => 'description',
                    'aggregationmethod'       => 'aggregrationmethod',
                    'scaleid'     => 'scaleid',
                    'proficiencyexpected'       => 'proficiencyexpected',
                    'evidencecount'     => 'evidencecount',
                    'timecreated'       => 'timecreated',
                    'timemodified'      => 'timemodified',
                    'usermodified'      => 'usermodified',
                    'visible'   => 'visible');

    if ($customfields = get_records_select('competency_info_field')) {
        foreach ($customfields as $n=>$v){
            $fields['custom_field_'.$v->shortname] = 'custom_field_'.$v->shortname;
        }
    }

    switch ($format) {
        case 'csv' : competency_download_csv($fields);
        case 'ods' : competency_download_ods($fields);
        case 'xls' : competency_download_xls($fields);
        
    }
    die;
}

admin_externalpage_print_header();
print_heading(get_string('download', 'admin'));

print_box_start();
echo '<ul>';
echo '<li><a href="download_competencies.php?format=csv">'.get_string('downloadtext').'</a></li>';
echo '<li><a href="download_competencies.php?format=ods">'.get_string('downloadods').'</a></li>';
echo '<li><a href="download_competencies.php?format=xls">'.get_string('downloadexcel').'</a></li>';
echo '</ul>';
print_box_end();

print_continue($return);

print_footer();

function competency_download_ods($fields) {
    global $CFG, $SESSION;

    require_once("$CFG->libdir/odslib.class.php");

    $filename = clean_filename(get_string('competencies','competency').'.ods');

    $workbook = new MoodleODSWorkbook('-');
    $workbook->send($filename);

    $worksheet = array();

    $worksheet[0] =& $workbook->add_worksheet('');
    $col = 0;
    foreach ($fields as $fieldname) {
        $worksheet[0]->write(0, $col, $fieldname);
        $col++;
    }

    $row = 1;
    foreach ($SESSION->downloaddata as $competencyid => $unused) {
        if (!$competency = get_record('competency', 'id', $competencyid)) {
            continue;
        }
        $col = 0;
        foreach ($fields as $field=>$unused) {
            $worksheet[0]->write($row, $col, $competency->$field);
            $col++;
        }
        $row++;
    }

    $workbook->close();
    die;
}

function competency_download_xls($fields) {
    global $CFG, $SESSION;

    require_once("$CFG->libdir/excellib.class.php");

    $filename = clean_filename(get_string('competencies','competency').'.xls');

    $workbook = new MoodleExcelWorkbook('-');
    $workbook->send($filename);

    $worksheet = array();

    $worksheet[0] =& $workbook->add_worksheet('');
    $col = 0;
    foreach ($fields as $fieldname) {
        $worksheet[0]->write(0, $col, $fieldname);
        $col++;
    }

    $row = 1;
    foreach ($SESSION->downloaddata as $competencyid=>$unused) {
        if (!$competency = get_record('competency', 'id', $competencyid)) {
            continue;
        }
        $col = 0;
        foreach ($fields as $field=>$unused) {
            $worksheet[0]->write($row, $col, $competency->$field);
            $col++;
        }
        $row++;
    }

    $workbook->close();
    die;
}

function competency_download_csv($fields) {
    global $CFG, $SESSION;
    
    $filename = clean_filename(get_string('competencies','competency').'.csv');

    header("Content-Type: application/download\n");
    header("Content-Disposition: attachment; filename=$filename");
    header("Expires: 0");
    header("Cache-Control: must-revalidate,post-check=0,pre-check=0");
    header("Pragma: public");

    $delimiter = get_string('listsep');
    $encdelim  = '&#'.ord($delimiter);
    $row = array(); 
    foreach ($fields as $fieldname) {
        $row[] = str_replace($delimiter, $encdelim, $fieldname);
    }
    echo implode($delimiter, $row)."\n";
    foreach ($SESSION->downloaddata as $competencyid => $unused) {
        $row = array();
        if (!$competency = get_record('competency', 'id', $competencyid)) {
            continue;
        }
        
        foreach ($fields as $field=>$unused) {
            $row[] = str_replace($delimiter, $encdelim, $competency->$field);
        }
        echo implode($delimiter, $row)."\n";
    }
    die;
}

?>
