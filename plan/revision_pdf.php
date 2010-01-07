<?php
/**
 * This page prints out a given plan revision
 **/

require_once('../../config.php');
require_once('lib.php');

require_login();

$id = required_param('id', PARAM_INT); // Plan ID
$rev = optional_param('rev', 0, PARAM_INT); // Revision ID


// Check parameters 

if (0 == $id) {
    error(get_string('error:idcannotbezero', 'local'));
}

if (!$plan = get_record('idp', 'id', $id)) {
    error('Plan ID is incorrect');
}

require_login();

$contextsite = get_context_instance(CONTEXT_SYSTEM);
$contextuser = get_context_instance(CONTEXT_USER, $plan->userid);

if ($USER->id == $plan->userid) {
    require_capability('moodle/local:viewownplan', $contextsite);
} else {
    require_capability('moodle/local:viewplan', $contextuser);
}



//
// set up all the pdf stuff
require_once($CFG->dirroot . '/local/lib/html2fpdf.php');
$pdf = new HTML2FPDF('P');
$pdf->AliasNbPages();
$pdf->AddPage();



// Get the requested revision (default: the last one)
$currevision = get_revision($plan->id, $rev, $pdf);

$currevision->owner = get_record('user', 'id', $plan->userid, '', '', '', '', 'id,firstname,lastname,idnumber');
add_to_log(SITEID, 'idp', 'view plan', "revision_pdf.php?id=$plan->id", $plan->id);

$stridps = get_string('idps', 'idp');

if ($currevision) {
    // Whether or not to see the editable view
    $editable = false;
    $isauthor = false;

    // Whether or not the current user can approve this plan
    $canapprove = false;
    if (!$isauthor && has_capability('moodle/local:approveplan', $contextuser)) {
        $canapprove = true;
    }

    // Information at the top
    lpheading( get_string('personaldetailsheading', 'idp') );

    ob_start();
    print_revision_details($currevision, $isauthor, $canapprove, true);
    $details = ob_get_contents();
    ob_end_clean();
    $pdf->WriteHTML($details);

    // Objectives
    lpheading(get_string('objectiveheading', 'idp').'&nbsp;');
    $usercurriculum = get_field('user', 'curriculum', 'id', $plan->userid);

    print_curriculum_pdf($usercurriculum, $currevision, $editable);
    print_curriculum_pdf('Q', $currevision, $editable);

    // Free-form lists
    print_freeform_list_pdf($currevision->id, 0, $editable);
    print_freeform_list_pdf($currevision->id, 1, $editable);

} else {
    $pdf->WriteHTML('<p><i>'.get_string('norevisions', 'idp')."</i></p>\n");
}


// Send the PDF data
$pdf->Output(''. 'learningplan.pdf', 'I');
$pdf->Output('', 'S');// send




//
// End of page logic, function defs follow.
//

function lpheading($text, $level=1) {
    global $pdf;
    $fontsizes = array(
            1   =>  15,
            2   =>  14,
            3   =>  13,
            4   =>  12,
            5   =>  11,
            6   =>  11,
        );
    if (strlen($text) > 30) { $level += 1; }    // try to reduce header size for long texts
    $pdf->SetFontSize($fontsizes[$level]);
    $pdf->WriteHTML("<h$level>$text</h$level>");
    $pdf->SetFontSize(12);
}

function print_curriculum_pdf($curriculumcode, $revision, $editable) {
    global $pdf;
    $table = curriculum_objectives($curriculumcode, $revision, $editable);
    $table = preg_replace('/<table /','<table border="1" ', $table);

    if ($table) {
        lpheading(format_string(get_field('racp_curriculum', 'name', 'code', $curriculumcode)), 2);

        $pdf->WriteHTML('<blockquote>');
        $pdf->WriteHTML($table);

        $pdf->WriteHTML('</blockquote>');
    }

}

function print_freeform_list_pdf($revisionid, $listtype, $editable) {
    global $pdf;

    lpheading(get_string("list{$listtype}heading", 'idp').'&nbsp;');

    $pdf->WriteHTML('<blockquote>');

    $table = get_list_items($revisionid, $listtype, $editable);
    $table = preg_replace('/<table /','<table border="1" ', $table);
    $pdf->WriteHTML($table);
    $pdf->WriteHTML('</blockquote>');
}
?>
