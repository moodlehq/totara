<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/type/competency/lib.php');
require_once($CFG->dirroot.'/idp/lib.php');


///
/// Setup / loading data
///

// Revision id
$revisionid = required_param('id', PARAM_INT);

// Courses to add
$rowcount = required_param('rowcount', PARAM_SEQUENCE);

// Competency templates to add
$add = required_param('add', PARAM_SEQUENCE);

// Indicates whether current related items, should be deleted
$deleteexisting = optional_param('deleteexisting', 0, PARAM_BOOL);

// No javascript parameters
$nojs = optional_param('nojs', false, PARAM_BOOL);
$returnurl = optional_param('returnurl', '', PARAM_TEXT);
$s = optional_param('s', '', PARAM_TEXT);

// Check permissions
$sitecontext = get_context_instance(CONTEXT_SYSTEM);
$plan = get_plan_for_revision($revisionid);
if ( !$plan ){
    error('Plan ID is incorrect');
}

// Users can only edit their own IDP
require_capability('moodle/local:idpeditownplan', $sitecontext);
if ( $plan->userid != $USER->id ){
    error(get_string('error:revisionnotvisible', 'idp'));
}

// Setup hierarchy object
$hierarchy = new competency();
$str_remove = get_string('remove');

// Parse input
$add = $add ? explode(',', $add) : array();
$time = time();

///
/// Delete removed assignments (if specified)
///
if ($deleteexisting) {
    // Currently assigned templates
    if (!$currentlyassigned = idp_get_user_competencytemplates($plan->userid, $revisionid)) {
        $currentlyassigned = array();
    }

    $removeditems = array_diff(array_keys($currentlyassigned), $add);
    
    foreach ($removeditems as $rid) {
        begin_sql();
        $dbresult = (boolean) delete_records('idp_revision_competencytmpl', 'revision', $revisionid, 'competencytemplate', $rid);
        $dbresult = $dbresult && update_modification_time($revisionid);
        if ($dbresult ){
            commit_sql();
        } else {
            rollback_sql();
            print_error('error:removalfailed','idp');
        }
        add_to_log(SITEID, 'idp', 'delete IDP competency template', "revision.php?id={$plan->id}", $rid);

        echo " ~~~RELOAD PAGE~~~ ";  // Indicate that a page reload is required
    }
}


///
/// Add competencies
///
foreach ($add as $addition) {
    // Check id
    if (!is_numeric($addition)) {
        error('Supplied bad data - non numeric id');
    }

    // If the template is already present in this plan, don't add it a second
    // time
    if ( count_records('idp_revision_competencytmpl', 'revision', $revisionid, 'competencytemplate', $addition) ){
        continue;
    }

    // Load competency
    $template = $hierarchy->get_template($addition);

    // Load framework
    $framework = $hierarchy->get_framework($template->frameworkid);

    // Load depths
    $depths = $hierarchy->get_depths();

    // Add idp competency
    $idpcompetency = new Object();
    $idpcompetency->revision = $revisionid;
    $idpcompetency->competencytemplate = $template->id;
    $idpcompetency->ctime = time();

    // Insert the competency template and update the modification time for the parent revision
    begin_sql();
    $dbresult = insert_record('idp_revision_competencytmpl', $idpcompetency, false);
    $dbresult = $dbresult && update_modification_time($revisionid);
    add_to_log(SITEID, 'idp', 'add IDP competency tempates', "revision.php?id={$plan->id}", "plan: {$plan->id}, template: {$template->id}");
    if (!$dbresult ){
        rollback_sql();
    } else {
        commit_sql();

        if($nojs) {
            // if javascript disabled redirect back to original page (if sesskey matches)
            $url = ($s == sesskey()) ? $returnurl : $CFG->wwwroot;
            redirect($url);

        } else {

            // Return html
            echo '<tr class=r'.$rowcount.'>';
            echo "<td><a href=\"{$CFG->wwwroot}/hierarchy/framework/index.php?type={$hierarchy->prefix}&id={$framework->id}\">{$framework->fullname}</a></td>";
            echo "<td><a href=\"{$CFG->wwwroot}/hierarchy/type/competency/template/view.php?id={$template->id}\">{$template->fullname}</a></td>";
            echo '<td></td>';
            echo '<td width="25%"><input size="10" maxlength="10" type="text" name="comptempduedate['.$template->id.']" id="comptempduedate'.$template->id.'"/></td>';

        //    if ($editingon) {

                echo "<td style=\"text-align: center;\">";

                echo "<a href=\"{$CFG->wwwroot}/hierarchy/type/competency/template/idp/remove.php?id={$template->id}&revision={$revisionid}\" title=\"$str_remove\">".
                     "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_remove\" /></a>";

                echo "</td>";

        //    }

            echo '</tr>';
            echo '<script type="text/javascript"> $(function() { $(\'[id^=comptempduedate]\').datepicker( ';
            echo '{ dateFormat: \'dd/mm/yy\', showOn: \'button\', buttonImage: \'../local/js/images/calendar.gif\',';
            echo 'buttonImageOnly: true } ); }); </script>'.PHP_EOL;
            $rowcount = ($rowcount + 1) % 2;
        }
    }
}
