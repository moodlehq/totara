<?php
/**
 * This page prints out a given plan revision
 **/

require_once('../config.php');
require_once('lib.php');

require_login();

$id = required_param('id', PARAM_INT); // Plan ID
$rev = optional_param('rev', 0, PARAM_INT); // Revision ID


// Check parameters 

if (0 == $id) {
    error(get_string('error:idcannotbezero', 'idp'));
}

if (!$plan = get_record('idp', 'id', $id)) {
    error('Plan ID is incorrect');
}

require_login();

$contextsite = get_context_instance(CONTEXT_SYSTEM);
$contextuser = get_context_instance(CONTEXT_USER, $plan->userid);

if ($USER->id == $plan->userid) {
    require_capability('moodle/local:idpviewownplan', $contextsite);
} else {
    require_capability('moodle/local:idpviewplan', $contextuser);
}



//
// set up all the pdf stuff
require_once($CFG->libdir . '/tcpdf/tcpdf.php');
//$pdf = new HTML2FPDF('P');
$pdf = new TCPDF('P');
$pdf->AliasNbPages();
$pdf->AddPage();



// Get the requested revision (default: the last one)
$currevision = get_revision($plan->id, $rev, $pdf);

$currevision->owner = get_record('user', 'id', $plan->userid, '', '', '', '', 'id,firstname,lastname,idnumber');
add_to_log(SITEID, 'idp', 'view plan', "revision_pdf.php?id=$plan->id", $plan->id);

$stridps = get_string('idps', 'idp');

if ($currevision) {
    /*$filename = "{$CFG->wwwroot}/idp/revision_pdf.php?id='{$currevision->idp}'&amp;print=1";
    $html = file_get_contents($filename);
    $pdf->writeHTML($html, true, false, true, false, '');*/

    // Whether or not to see the can_edit view
    $can_edit = false;
    $isauthor = false;

    // Whether or not the current user can approve this plan
    $can_approve = false;
    if (!$isauthor && has_capability('moodle/local:idpapproveplan', $contextuser)) {
        $can_approve = true;
    }

    $pdf->WriteHTML('<h1>'.get_string('revisionviewtitle', 'idp', $plan->name).'</h1>');

    $pdf->WriteHTML('<br/><h3>'.get_string('personaldetailsheading', 'idp').'</h3>');
    // Information at the top
    //idpheading(get_string('personaldetailsheading', 'idp') );

    ob_start();
    print_revision_details($currevision, $isauthor, $can_approve, true);
    $details = ob_get_contents();
    ob_end_clean();
    $pdf->WriteHTML($details);

    //Revision History
    ob_start();
    print_revision_list($plan->id, $currevision->id);
    $details = ob_get_contents();
    ob_end_clean();
    $pdf->WriteHTML($details);

    //Competencies
    ob_start();
    $competencies = idp_get_user_competencies($plan->userid, $currevision->id);
    print_idp_competencies_view($currevision, $competencies);
    $details = ob_get_contents();
    $details = preg_replace('/<table /','<table border="1" ', $details);
    ob_end_clean();
    $pdf->WriteHTML($details);


    //Courses
    ob_start();
    $courses = idp_get_user_courses($plan->userid, $currevision->id);
    print_idp_courses_view($currevision, $courses);
    $details = ob_get_contents();
    $details = preg_replace('/<table /','<table border="1" ', $details);
    ob_end_clean();
    $pdf->WriteHTML($details);

} else {
    $pdf->WriteHTML('<p><i>'.get_string('norevisions', 'idp')."</i></p>\n");
}


ob_end_clean();
// Send the PDF data
$pdf->Output('idp.pdf', 'I');
//$pdf->Output('', 'S');// send

?>
