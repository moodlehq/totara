<?php //$Id$
/**
* script for downloading of user lists
*/

global $SESSION;
require_once('../../../config.php');
require_once($CFG->libdir.'/adminlib.php');

$format = optional_param('format', '', PARAM_ALPHA);

admin_externalpage_setup('reportlearningrecords');

$return = $CFG->wwwroot.'/admin/report/learningrecords/index.php';

if (empty($SESSION->download_data)) {
    redirect($return);
}

if ($format) {
    $fields = $SESSION->download_cols;
    $data = $SESSION->download_data;

    switch ($format) {
        case 'csv' : download_csv($fields, $data);
        case 'ods' : download_ods($fields, $data);
        case 'xls' : download_xls($fields, $data);

    }
    die;
}

admin_externalpage_print_header();
//TODO lang string for heading and links
print_heading('Export');

print_box_start();
echo '<ul>';
echo '<li><a href="download.php?format=csv">Export in text format</a></li>';
echo '<li><a href="download.php?format=ods">Export in ODS format</a></li>';
echo '<li><a href="download.php?format=xls">Export in Excel format</a></li>';
echo '</ul>';
print_box_end();

print_continue($return);

print_footer();

function download_ods($fields, $data) {
    global $CFG;
    require_once("$CFG->libdir/odslib.class.php");

    $filename = clean_filename('learningrecords.ods');

    header("Content-Type: application/download\n");
    header("Content-Disposition: attachment; filename=$filename");
    header("Expires: 0");
    header("Cache-Control: must-revalidate,post-check=0,pre-check=0");
    header("Pragma: public");


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
                $worksheet[0]->write($row+1, $col, htmlspecialchars_decode($data[$row][$col]));
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

    $filename = clean_filename('learningreports.xls');

    header("Content-Type: application/download\n");
    header("Content-Disposition: attachment; filename=$filename");
    header("Expires: 0");
    header("Cache-Control: must-revalidate,post-check=0,pre-check=0");
    header("Pragma: public");


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
                $worksheet[0]->write($row+1, $col, htmlspecialchars_decode($data[$row][$col]));
            }
        }
        $row++;
    }

    $workbook->close();
    die;
}

function download_csv($fields, $data) {
    global $CFG;

    $filename = clean_filename('learningreports.csv');

    header("Content-Type: application/download\n");
    header("Content-Disposition: attachment; filename=$filename");
    header("Expires: 0");
    header("Cache-Control: must-revalidate,post-check=0,pre-check=0");
    header("Pragma: public");

    $delimiter = get_string('listsep');
    $encdelim  = '&#'.ord($delimiter).';';
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
                $row[] = htmlspecialchars_decode(str_replace($delimiter, $encdelim, $data[$i][$j]));
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
