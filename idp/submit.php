<?php
/**
 * This page asks for confirmation before submitting an IDP.
 **/

require_once('../config.php');
require_once('lib.php');

require_login();

$rev = required_param('rev', PARAM_INT); // Revision ID
$submitbutton = optional_param('submitbutton', false, PARAM_BOOL);
$saveandcontinuebutton = optional_param('saveandcontinuebutton',false, PARAM_BOOL);
$confirm = optional_param('confirm', false, PARAM_BOOL);
$print = optional_param('print', 0, PARAM_INT); // Print-friendly view

$plan = get_plan_for_revision($rev);
if (!$plan ) {
    error('Plan ID is incorrect');
}

// If they didn't click the "submit" or "confirm" buttons, then they 
// actually clicked "save and continue"
if ( !$confirm && !$submitbutton ){
    // Check permissions
    // Users can only edit their own IDP
    $sitecontext = get_context_instance(CONTEXT_SYSTEM);
    require_capability('moodle/local:idpeditownplan', $sitecontext);
    if ( $plan->userid != $USER->id ){
        error(get_string('error:revisionnotvisible', 'idp'));
    }
    update_idp_component_duedate('compduedate', 'idp_revision_competency','competency', $rev);
    update_idp_component_duedate('comptempduedate', 'idp_revision_competencytmpl', 'competencytemplate', $rev);
    update_idp_component_duedate('courseduedate', 'idp_revision_course', 'course', $rev);
    //Update priorities
    update_idp_component_priority('comppriority', 'idp_revision_competency','competency', $rev);
    update_idp_component_priority('comptemppriority', 'idp_revision_competencytmpl', 'competencytemplate', $rev);
    update_idp_component_priority('coursepriority', 'idp_revision_course', 'course', $rev);

    add_to_log(SITEID, 'idp', 'save/update plan', "revision.php?id={$plan->id}", $plan->id);

    redirect($CFG->wwwroot.'/idp/index.php');
}

if ($print) {
    $CFG->theme = 'MITMS_print'; // for this page only
}

if (!$revision = get_revision(0, $rev)) {
    error('Revision ID is incorrect');
}

$contextsite = get_context_instance(CONTEXT_SYSTEM);
$contextuser = get_context_instance(CONTEXT_USER, $plan->userid);

add_to_log(SITEID, 'idp', 'submit plan', "revision.php?id=$plan->id", $plan->id);

if ($confirm) {
    if (submit_revision($revision->id)) {
        redirect($CFG->wwwroot.'/idp/index.php');
    }
    else {
        error(get_string('submissionerror', 'idp'));
    }
}

if ($USER->id == $plan->userid) {
    require_capability('moodle/local:idpviewownplan', $contextsite);
    require_capability('moodle/local:idpsubmitownplan', $contextsite);
} else {
    error(get_string('onlycreatorsubmit', 'idp'));
}

$stridps = get_string('idps', 'idp');

$PAGE = page_create_object('MITMS', $USER->id);
$pageblocks = blocks_setup($PAGE,BLOCKS_PINNED_BOTH);
$blocks_preferred_width = bounded_number(180, blocks_preferred_width($pageblocks[BLOCK_POS_LEFT]), 210);

$navlinks = array();
$navlinks[] = array('name' => $stridps, 'link' => $CFG->wwwroot."/idp/index.php", 'type' => 'home');
$navlinks[] = array('name' => format_string($plan->name), 'link' => "revision.php?id={$revision->idp}&amp;rev=$revision->id", 'type' => 'home');
$navlinks[] = array('name' => get_string('submitting', 'idp'), 'link' => '', 'type' => 'home');

$navigation = build_navigation($navlinks);

$PAGE->print_header($stridps, $navlinks);

echo '<table id="layout-table">';
echo '<tr valign="top">';

$lt = (empty($THEME->layouttable)) ? array('left', 'middle', 'right') : $THEME->layouttable;
foreach ($lt as $column) {
    switch ($column) {
    case 'left':

        if(blocks_have_content($pageblocks, BLOCK_POS_LEFT) || $PAGE->user_is_editing()) {
            echo '<td style="vertical-align: top; width: '.$blocks_preferred_width.'px;" id="left-column">';
            print_container_start();
            blocks_print_group($PAGE, $pageblocks, BLOCK_POS_LEFT);
            print_container_end();
            echo '</td>';
        } else {
            echo '<td id="left-column"></td>';
        }

    break;
    case 'middle':

        print '<td valign="top" id="middle-column">';
        // Hack to add print stylesheet

        // Preview page
        print '<h1>'.get_string('previewtitle', 'idp', $plan->name)."</h1>\n";

        print '<p class="explanation">'.get_string('submitexplanation1', 'idp').'</p>';

        // Border around the preview area
        print '<div id="previewcontainer">';

        print_revision_preview($revision, $plan, false);

        print '</div>';

        print '<p class="explanation">'.get_string('submitexplanation2', 'idp').'</p>';

        // Cancel button
        print '<table cellpadding="5" summary="Two buttons side by side"><tr><td>';
        print '<form method="get" action="revision.php"><div>';
        print '<input type="hidden" name="rev" value="'.$rev.'" />';
        print '<input type="hidden" name="id" value="'.$plan->id.'" />';
        print '<input type="submit" value="'.get_string('backtoeditbutton', 'idp').'" />';
        print '</div></form>';

        // Submit button
        print '</td><td>';
        print '<form method="get" action="submit.php"><div>';
        print '<input type="hidden" name="rev" value="'.$rev.'" />';
        print '<input type="hidden" name="confirm" value="1" />';
        print '<input type="submit" value="'.get_string('confirmsubmitbutton', 'idp').'" />';
        print '</div></form>';
        print "</td></tr></table>\n";
        print '</td>';

    break;
    case 'right':
        echo '<td style="vertical-align: top; width: '.$blocks_preferred_width.'px;" id="right-column">';
        print_container_start();
        blocks_print_group($PAGE, $pageblocks, BLOCK_POS_RIGHT);
        print_container_end();
        echo '</td>';
    break;
    }
}

/// Finish the page
echo '</tr></table>';

print_footer();

/**
 * Updates the due dates for a particular IDP component (abstracting this to a
 * function since it's the exact same behavior for competencies, competency
 * templates, and courses)
 * 
 * @param string $duedateformelement
 * @param string $tablename
 * @param string $componentcolumn
 * @param string $rev
 */
function update_idp_component_duedate($duedateformelement, $tablename, $componentcolumn,$rev){
    // fetching as PARAM_RAW because calendar dates are in DD/MM/YYYY format,
    // and there's no other PARAM setting that'll do numbers and slashes
    $formelementlist = optional_param($duedateformelement,array(),PARAM_RAW);
    foreach( $formelementlist as $rawid=>$rawduedate ){
        $componentid = clean_param($rawid, PARAM_INT);
        $duedate = convert_userdate($rawduedate);

        $component = get_record($tablename, 'revision', $rev, $componentcolumn, $componentid);
        if ( $duedate && ( !isset($component->duedate) || $duedate <> $component->duedate) ){

            begin_sql();
            $result = set_field($tablename,'duedate',$duedate,'revision',$rev,$componentcolumn,$componentid);
            $result = $result && update_modification_time($rev);
            if ( $result ) {
                commit_sql();
            } else {
                rollback_sql();
            }
        }
    }
}


/**
 * Updates the priorities for a particular IDP component (abstracting this to a
 * function since it's the exact same behavior for competencies, competency
 * templates, and courses)
 *
 * @param string $priorityformelement
 * @param string $tablename
 * @param string $componentcolumn
 * @param string $rev
 */
function update_idp_component_priority($priorityformelement, $tablename, $componentcolumn,$rev){
    $formelementlist = optional_param($priorityformelement,array(),PARAM_INT);
    foreach( $formelementlist as $rawid=>$rawpriority ){
        $componentid = clean_param($rawid, PARAM_INT);
        $priority = $rawpriority;

        $component = get_record($tablename, 'revision', $rev, $componentcolumn, $componentid);
        if ( $priority && ( !isset($component->priority) || $priority <> $component->priority) ){

            begin_sql();
            $result = set_field($tablename,'priority',$priority,'revision',$rev,$componentcolumn,$componentid);
            $result = $result && update_modification_time($rev);
            if ( $result ) {
                commit_sql();
            } else {
                rollback_sql();
            }
        }
    }
}


?>
