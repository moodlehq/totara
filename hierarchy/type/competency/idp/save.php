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

// Competencies to add
$add = required_param('add', PARAM_SEQUENCE);

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

///
/// Add competencies
///

// Parse input
$add = explode(',', $add);
$time = time();

foreach ($add as $addition) {
    // Check id
    if (!is_numeric($addition)) {
        error('Supplied bad data - non numeric id');
    }

    // If the competency is already present in this plan, don't add it a second
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
            echo '<tr class=r'.$rowcount.'>';
            echo "<td><a href=\"{$CFG->wwwroot}/hierarchy/framework/index.php?type={$hierarchy->prefix}&id={$framework->id}\">{$framework->fullname}</a></td>";
            echo "<td><a href=\"{$CFG->wwwroot}/hierarchy/item/view.php?type={$hierarchy->prefix}&id={$competency->id}\">{$competency->fullname}</a></td>";
            echo "<td></td>";
            echo '<td width="25%"><input size="10" maxlength="10" type="text" class="idpdate" name="compduedate['.$competency->id.']" id="compduedate'.$competency->id.'"/></td>';

        //    if ($editingon) {
                echo "<td style=\"text-align: center;\">";

                echo "<a href=\"{$CFG->wwwroot}/hierarchy/type/competency/idp/remove.php?id={$competency->id}&revision={$revisionid}\" title=\"$str_remove\">".
                     "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_remove\" /></a>";

                echo "</td>";
        //    }

            echo '</tr>';
            echo '<script type="text/javascript"> $(function() { $(\'[id^=compduedate]\').datepicker( ';
            echo '{ dateFormat: \'dd/mm/yy\', showOn: \'button\', buttonImage: \'../local/js/images/calendar.gif\',';
            echo 'buttonImageOnly: true } ); }); </script>'.PHP_EOL;
            $rowcount = ($rowcount + 1) % 2;
        }
        add_to_log(SITEID, 'idp', 'add IDP competencies', "revision.php?id={$plan->id}", $plan->id);
    }

}
