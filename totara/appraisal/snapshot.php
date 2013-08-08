<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010 - 2013 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Valerii Kuznetsov <valerii.kuznetsov@totaralms.com>
 * @package totara
 * @subpackage totara_appraisal
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->dirroot . '/totara/appraisal/lib.php');
require_once($CFG->dirroot . '/totara/appraisal/appraisal_forms.php');
require_once($CFG->dirroot . '/totara/core/js/lib/setup.php');

require_login();

// Set system context.
$systemcontext = context_system::instance();
$PAGE->set_context($systemcontext);

// Load parameters and objects required for checking permissions.
$subjectid = optional_param('subjectid', $USER->id, PARAM_INT);
$role = optional_param('role', appraisal::ROLE_LEARNER, PARAM_INT);
if ($role == 0) {
    $role = appraisal::ROLE_LEARNER;
}
$roles = appraisal::get_roles();

$appraisalid = required_param('appraisalid', PARAM_INT);
$spaces = optional_param('spaces', 0, PARAM_INT);

// We expect array of stages
$stageschecked = (isset($_REQUEST['stages']) && is_array($_REQUEST['stages'])) ? $_REQUEST['stages'] : array();
$printstages = array_keys(array_filter($stageschecked));
$action = optional_param('action', '', PARAM_ACTION);
if (!is_array($printstages)) {
    throw new appraisal_exception('error:stagesmustbearray');
}

$appraisal = new appraisal($appraisalid);

if ($action == 'stages') {
    // Show dialog box with stages select
    $stageslist = appraisal_stage::get_stages($appraisal->id, array($role));
    $stagesform = new appraisal_print_stages_form(null, array('appraisalid' => $appraisalid, 'stages' => $stageslist,
        'subjectid' => $subjectid, 'role' => $role), 'post', '', array('id' => 'printform', 'class' => 'print-stages-form'));
    $stagesform->display();
    exit();
}

// Check that the subject/role are valid in the given appraisal.
$roleassignment = $appraisal->get_role_assignment($subjectid, $USER->id, $role);
$userassignment = $appraisal->get_user_assignment($subjectid);
if (!$appraisal->can_access($roleassignment)) {
    throw new appraisal_exception('error:cannotaccessappraisal');
}
$assignments = $appraisal->get_all_assignments($subjectid);
$otherassignments = $assignments;
unset($otherassignments[$roleassignment->appraisalrole]);

$PAGE->set_pagelayout('popup');
$renderer = $PAGE->get_renderer('totara_appraisal');
$PAGE->requires->js_init_code('window.print()', true);

$heading = get_string('myappraisals', 'totara_appraisal');
$PAGE->set_title($heading);
$PAGE->set_heading($heading);

if ($action == 'snapshot') {
    ob_flush();
    require_once($CFG->libdir . '/pdflib.php');
    set_time_limit('300');
    ob_start();
} else {
    echo $OUTPUT->header();
}

// Print appraisal header.
echo $renderer->heading($appraisal->name, 1);
$appdesc = new stdClass();
$appdesc->description = $appraisal->description;
$appdesc->descriptionformat = FORMAT_HTML;
$appdesc = file_prepare_standard_editor($appdesc, 'description', $TEXTAREA_OPTIONS, $TEXTAREA_OPTIONS['context'],
        'totara_appraisal', 'appraisal', $appraisal->id);
echo $appdesc->description_editor['text'];
echo $renderer->display_viewing_appraisal_header($subjectid, 'youareprintingxsappraisal', $role);
$stageslist = appraisal_stage::get_stages($appraisal->id, array($role));

foreach ($stageslist as $stageid => $stagedata) {
    if (empty($printstages) || in_array($stageid, $printstages)) {
        // Print stage.
        $stage = new appraisal_stage($stageid);
        echo $renderer->display_stage($appraisal, $stage, $userassignment, $roleassignment, '', false);

        $pages = appraisal_page::get_applicable_pages($stageid, $role, 0, false);
        foreach ($pages as $page) {
            // Print page.
            echo $renderer->heading($page->name);

            // Print form.
            $form = new appraisal_answer_form(null, array('appraisal' => $appraisal, 'page' => $page,
            'userassignment' => $userassignment, 'roleassignment' => $roleassignment,
            'otherassignments' => $otherassignments, 'spaces' => $spaces,
            'action' => 'print', 'preview' => false, 'islastpage' => false, 'readonly' => true));

            foreach ($assignments as $assignment) {
                $form->set_data($appraisal->get_answers($assignment));
            }
            if ($action == 'snapshot') {
                $defaultformrenderer = $GLOBALS['_HTML_QuickForm_default_renderer'];
                $GLOBALS['_HTML_QuickForm_default_renderer'] = new PdfForm_Renderer();
                $form->display();
                $GLOBALS['_HTML_QuickForm_default_renderer'] = $defaultformrenderer;
            } else {
                $form->display();
            }
        }
    }
}

if ($action == 'snapshot') {
    $html = ob_get_contents();
    ob_end_clean();
    $filename = 'appraisal_'.$appraisal->id.'_'.date("Y-m-d_Hi").'_'.$roles[$role].'.pdf';
    // Dirty hack to make html compatible with tcpf
    $html = str_replace('<legend', '<div', str_replace('</legend>', '</div>', $html));
    $cssstr = file_get_contents(__DIR__.'/pdf.css');
    $html = '<style>'.$cssstr.'</style>'.$html;
    $pdf = new pdf();
    $pdf->SetAutoPageBreak(true);
    $pdf->AddPage();
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->lastPage();
    $pdf->Output($CFG->tempdir.'/'.$filename, 'F');
    // Save into db.
    $downloadurl = $appraisal->save_snapshot($CFG->tempdir.'/'.$filename, $roleassignment->id);

    // Message for dialog.
    // Todo: If not saved display error.
    $strsource = new stdClass();
    $strsource->link = $OUTPUT->action_link(new moodle_url('/totara/appraisal/index.php'),
            get_string('allappraisals', 'totara_appraisal'));
    echo html_writer::empty_tag('input', array('type' => 'hidden', 'name' => 'downloadurl', 'id' => 'downloadurl',
        'value' => $downloadurl));
    echo html_writer::tag('div', get_string('snapshotdone', 'totara_appraisal', $strsource), array('class'=>'notifysuccess'));
} else {
    echo $OUTPUT->footer();
}