<?php //$Id$
/**
* script for downloading of user lists
*/

require_once('../config.php');
require_once($CFG->libdir.'/adminlib.php');
global $SESSION;

$format = optional_param('format', '', PARAM_ALPHA);
$type   = optional_param('type', '-1', PARAM_SAFEDIR);

// Confirm the type exists
if (!file_exists($CFG->dirroot.'/hierarchy/type/'.$type.'/lib.php')) {
    error('Hierarchy type '.$type.' does not exist');
}

admin_externalpage_setup($type.'manage');
require_capability('moodle/local:view'.$type, get_context_instance(CONTEXT_SYSTEM));

$return = $CFG->wwwroot.'/hierarchy/index.php?type='.$type;

if (empty($SESSION->download_data)) {
    redirect($return);
}

if ($format) {
    $fields = $SESSION->download_cols;
    $data = $SESSION->download_data;

    switch ($format) {
        case 'csv' : hierarchy_download_csv($fields, $data, $type);
        case 'ods' : hierarchy_download_ods($fields, $data, $type);
        case 'xls' : hierarchy_download_xls($fields, $data, $type);
        
    }
    die;
}

admin_externalpage_print_header();
print_heading(get_string('export', 'hierarchy'));

print_box_start();
echo '<ul>';
echo '<li><a href="download.php?format=csv&type='.$type.'">'.get_string('exportcsv', 'hierarchy').'</a></li>';
echo '<li><a href="download.php?format=ods&type='.$type.'">'.get_string('exportods', 'hierarchy').'</a></li>';
echo '<li><a href="download.php?format=xls&type='.$type.'">'.get_string('exportexcel','hierarchy').'</a></li>';
echo '</ul>';
print_box_end();

print_continue($return);

print_footer();

function hierarchy_download_ods($fields, $data, $type) {
    global $CFG;

    require_once("$CFG->libdir/odslib.class.php");

    $filename = clean_filename(get_string('featureplural',$type).'.ods');

    $workbook = new MoodleODSWorkbook('-');
    $workbook->send($filename);

    $worksheet = array();

    $worksheet[0] =& $workbook->add_worksheet('');
    $col = 0;
    foreach ($fields as $fieldname) {
        $worksheet[0]->write(0, $col, $fieldname);
        $col++;
    }

    $numfields = count($fields);
    $row = 0;
    foreach ($data as $datarow) {
        for($col=0; $col<$numfields;$col++) {
            if(isset($data[$row][$col])) {
                $worksheet[0]->write($row+1, $col, $data[$row][$col]);
            }
        }
        $row++;
    }

    $workbook->close();
    die;
}

function hierarchy_download_xls($fields, $data, $type) {
    global $CFG;

    require_once("$CFG->libdir/excellib.class.php");

    $filename = clean_filename(get_string('featureplural',$type).'.xls');

    $workbook = new MoodleExcelWorkbook('-');
    $workbook->send($filename);

    $worksheet = array();

    $worksheet[0] =& $workbook->add_worksheet('');
    $col = 0;
    foreach ($fields as $fieldname) {
        $worksheet[0]->write(0, $col, $fieldname);
        $col++;
    }

    $numfields = count($fields);
    $row = 0;
    foreach ($data as $datarow) {
        for($col=0; $col<$numfields; $col++) {
            if(isset($data[$row][$col])) {
                $worksheet[0]->write($row+1, $col, $data[$row][$col]);
            }
        }
        $row++;
    }

    $workbook->close();
    die;
}

function hierarchy_download_csv($fields, $data, $type) {
    global $CFG;
    
    $filename = clean_filename(get_string('featureplural',$type).'.csv');

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

    $numfields = count($fields);
    $i = 0;
    foreach ($data AS $row) {
        $row = array();
        for($j=0; $j<$numfields; $j++) {
            if(isset($data[$i][$j])) {
                $row[] = str_replace($delimiter, $encdelim, $data[$i][$j]);
            } else {
                $row[] = '';
            }
        }
        echo implode($delimiter, $row)."\n";
        $i++;
    }
    die;

}

?>
