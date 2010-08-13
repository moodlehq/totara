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

// Framework id
$frameworkid = optional_param('frameworkid', 0, PARAM_INT);

// Competencies to add
$add = required_param('add', PARAM_SEQUENCE);

// Indicates whether current related items, not in $add list, should be deleted
$deleteexisting = optional_param('deleteexisting', 0, PARAM_BOOL);

// No javascript parameters
$nojs = optional_param('nojs', false, PARAM_BOOL);
$returnurl = optional_param('returnurl', '', PARAM_TEXT);
$s = optional_param('s', '', PARAM_TEXT);

// Setup page
admin_externalpage_setup('competencymanage', '', array(), '', $CFG->wwwroot.'/competency/idp/save.php');

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


// Currently assigned competencies
if (!$currentlyassigned = idp_get_user_competencies($USER->id, $revisionid, $frameworkid)) {
    $currentlyassigned = array();
}

// Parse input
$add = $add ? explode(',', $add) : array();
$time = time();

///
/// Delete removed assignments (if specified)
///

if ($deleteexisting) {
    $removeditems = array_diff(array_keys($currentlyassigned), $add);

    foreach ($removeditems as $rid) {
        delete_records('idp_revision_competency', 'revision', $revisionid, 'competency', $rid);
        add_to_log(SITEID, 'idp', 'deleteassignment', "revision.php?id={$plan->id}", "IDP (ID {$plan->id})");

        echo " ~~~RELOAD PAGE~~~ ";  // Indicate (to js) that a page reload is required
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

    // If the competency is already present in this plan, don't add a second
    // time
    if ( count_records('idp_revision_competency', 'revision', $revisionid, 'competency', $addition) ){
        continue;
    }

    // Load competency
    $competency = $hierarchy->get_item($addition);

    // Load framework
    $framework = $hierarchy->get_framework($competency->frameworkid);

    // Add idp competency
    $idpcompetency = new Object();
    $idpcompetency->revision = $revisionid;
    $idpcompetency->competency = $competency->id;
    $idpcompetency->ctime = time();

    $default_priority = idp_get_default_scale_value($plan->id);
    $default_priority = isset($default_priority->id) ? $default_priority->id : 0;
    $idpcompetency->priority = $default_priority;

    // Insert the competency and update the modification time for the parent revision
    begin_sql();
    $dbresult = insert_record('idp_revision_competency', $idpcompetency, false);
    $dbresult = $dbresult && update_modification_time($revisionid);
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
            echo '<tr>';
            echo "<td><a href=\"{$CFG->wwwroot}/hierarchy/item/view.php?type={$hierarchy->prefix}&id={$competency->id}\">{$competency->fullname}</a></td>";
            $statuscell = '<font color="grey">
                            Not assessed
                            <a href="'.$CFG->wwwroot.'/hierarchy/type/competency/evidence/add.php?userid='.$USER->id.
                            '&competencyid='.$competency->id.'&s='.$USER->sesskey.'&returnurl='.$CFG->wwwroot.'%2Fidp%2Frevision.php%3Fid%3D'.$revisionid.'">
                                <img alt="Add" class="iconsmall" src="'.$CFG->pixpath.'/t/add.gif">
                            </a>
                           </font>';
            echo "<td>{$statuscell}</td>";

           if(get_config(NULL, 'idp_priorities')==2) {
                $priorities = idp_get_priority_scale_values_menu($plan->id);
                $prioritycell = '<select class="idppriority" name="comppriority['.$competency->id.']" id="comppriority'.$competency->id.'">';
                $prioritycell .= '<option value="0">'.get_string('notspecifiedpriority', 'idp').'</option>';
                foreach($priorities as $priority){
                    $selected = $priority->id == $default_priority ? 'selected="selected"' : '';
                    $prioritycell .= '<option value="'.$priority->id.'" '.$selected.'>'.$priority->name.'</option>';
                }
                $prioritycell .= '</select>';
                echo "<td>{$prioritycell}</td>";
            }

            if(get_config(NULL, 'idp_duedates')) {
                echo '<td width="25%"><input size="10" maxlength="10" type="text" class="idpdate" name="compduedate['.$competency->id.']" id="compduedate'.$competency->id.'"/></td>';
            }

            echo "<td style=\"text-align: center;\">";

            echo "<a href=\"{$CFG->wwwroot}/hierarchy/type/competency/idp/remove.php?id={$competency->id}&revision={$revisionid}\" title=\"$str_remove\">".
                "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_remove\" /></a>";

            echo "</td>";

            echo '</tr>';
            echo '<script type="text/javascript"> $(function() { $(\'[id^=compduedate]\').datepicker( ';
            echo '{ dateFormat: \'dd/mm/yy\', showOn: \'button\', buttonImage: \'../local/js/images/calendar.gif\',';
            echo 'buttonImageOnly: true } ); }); </script>'.PHP_EOL;
        }
        add_to_log(SITEID, 'idp', 'add IDP competencies', "revision.php?id={$plan->id}", $plan->id);
    }

}
