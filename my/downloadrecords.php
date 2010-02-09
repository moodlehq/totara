<?php
require_once('../config.php');
global $SESSION;

$format = optional_param('format', '', PARAM_ALPHA);

$strheading = get_string('myrecordoflearning', 'local');

require_login();

if(empty($SESSION->download_data)) {
    error('No data found');
}

if($format) {
    $fields = strip_tags_r($SESSION->download_cols);
    $data = strip_tags_r($SESSION->download_data);

    switch($format) {
        case 'csv' : download_csv($fields,$data);
        case 'ods' : download_ods($fields,$data);
        case 'xls' : download_xls($fields,$data);
    }
    die;
}

print_header($strheading, $strheading, build_navigation($strheading));

print_box_start();
echo '<ul>';
echo '<li><a href="downloadrecords.php?format=csv">'.get_string('exporttext','hierarchy').'</a></li>';
echo '<li><a href="downloadrecords.php?format=ods">'.get_string('exportods','hierarchy').'</a></li>';
echo '<li><a href="downloadrecords.php?format=xls">'.get_string('exportexcel','hierarchy').'</a></li>';
echo '</ul>';
print_box_end();

print_footer();


function download_ods($fields, $data) {
    global $CFG;

    require_once("$CFG->libdir/odslib.class.php");

    $filename = clean_filename('myrecords.ods');

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

function download_xls($fields, $data) {
    global $CFG;

    require_once("$CFG->libdir/excellib.class.php");

    $filename = clean_filename('myrecords.xls');

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

function download_csv($fields, $data) {
    global $CFG;

    $filename = clean_filename('myrecords.csv');

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

// recursive version of strip_tags
function strip_tags_r($value) {
    return is_array($value) ? array_map('strip_tags_r', $value) :
        strip_tags($value);
}

