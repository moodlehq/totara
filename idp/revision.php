<?php
/**
 * This page prints out a given plan revision
 **/

require_once('../config.php');
require_once('lib.php');

$js_enabled = optional_param('js', true, PARAM_BOOL);    // js enabled

require_login();

$planid = required_param('id', PARAM_INT); // Plan ID
$rev = optional_param('rev', 0, PARAM_INT); // Revision ID
$print = optional_param('print', 0, PARAM_INT); // Print-friendly view

if ($print){
    $CFG->theme = 'MITMS_print'; // for this page only
}

if (0 == $planid) {
    error(get_string('error:idcannotbezero', 'local'));
}

if (!$plan = get_record('idp', 'id', $planid)) {
    error('Plan ID is incorrect');
}

$contextsite = get_context_instance(CONTEXT_SYSTEM);
$contextuser = get_context_instance(CONTEXT_USER, $plan->userid);

if ($USER->id == $plan->userid) {
    require_capability('moodle/local:idpviewownplan', $contextsite);
} else {
    require_capability('moodle/local:idpviewplan', $contextuser);
}

// Get the requested revision (default: the last one)
$currevision = get_revision($plan->id, $rev);

if ($USER->id != $plan->userid and 'notsubmitted' == $currevision->status) {
    // Plans which are not yet submitted, are only visible to the plan's author
    error(get_string('error:revisionnotvisible', 'idp'));
}

$currevision->owner = get_record('user', 'id', $plan->userid, '', '', '', '', 'id,firstname,lastname,idnumber');
add_to_log(SITEID, 'idp', 'view plan', "revision.php?id=$plan->id", $plan->id);

// If js enabled, setup custom javascript
if ($js_enabled) {

    require_once($CFG->dirroot.'/local/js/lib/setup.php');

    local_js(array(
        MBE_JS_DIALOG,
        MBE_JS_TREEVIEW,
        MBE_JS_DATEPICKER
    ));

    require_js(array(
        $CFG->wwwroot.'/local/js/idp.assignments.js.php',
#        $CFG->wwwroot.'/local/js/idp.course.js',
    ));
}

$stridps = get_string('idps', 'idp');

$PAGE = page_create_object('MITMS', $USER->id);
$pageblocks = blocks_setup($PAGE,BLOCKS_PINNED_BOTH);
$blocks_preferred_width = bounded_number(180, blocks_preferred_width($pageblocks[BLOCK_POS_LEFT]), 210);

$pagetitle = format_string($plan->name);

$navlinks = array();
$navlinks[] = array('name' => $stridps, 'link' => "index.php", 'type' => 'home');
$navlinks[] = array('name' => $pagetitle, 'link' => '', 'type' => 'home');

// Hack to add print stylesheet
$meta = '<link rel="stylesheet" type="text/css" media="print" href="'.$CFG->themewww.'/'. $CFG->theme .'_print/user_styles.css" />'."\n";

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

        echo '<td valign="top" id="middle-column">';
        if ($currevision) {
            if ( $currevision->status == 'completed' ){
                print_revision_completed($currevision, $plan);
            } else {
                // Whether or not to see the can_edit view
                $can_edit = false;
                $can_submit = false;
                $can_evaluate = false;
                if (is_my_plan($currevision->id) and has_capability('moodle/local:idpeditownplan', $contextsite)) {
                    $can_submit = true;
                    if ('notsubmitted' == $currevision->status or 'inrevision' == $currevision->status) {
                        $can_edit = true;
                    }
                }
                $can_edit = $can_edit && !$print;

                // Whether or not the current user can approve this plan
                $can_approve = false;
                if (!$can_submit && has_capability('moodle/local:idpapproveplan', $contextuser)) {
                    $can_approve = true;
                }

                if(has_capability('moodle/local:idpuserevaluate', $contextuser)){
                    $can_evaluate = true;
                }

                if ($can_edit) {
                    print '<h1>'.get_string('revisionedittitle', 'idp', $plan->name).'</h1>';
                } else {
                    print '<h1>'.get_string('revisionviewtitle', 'idp', $plan->name).'</h1>';
                }

                $formstartstr = '';
                if ( $can_submit && $can_edit ){
                    $formstartstr = '<form method="get" action="submit.php" class="plansubmission">';
                }
                if ($can_approve) {
                    print_revision_manager($currevision, $plan, $formstartstr, array(
                        'can_submit' => $can_submit,
                        'can_edit'   => $can_edit,
                        'can_approve' => $can_approve,
                    ));
                } else {
                    print_revision_trainee($currevision, $plan, $formstartstr, array(
                        'can_edit'  => $can_edit,
                        'can_submit' => $can_submit,
                    ));
                }

                if ($can_submit) {

                    if ($can_edit) {
                        print '<br /><center><table><tr><td>';

                        // Save and continue later
                        print '</td><td>';
                        print '<div>';

                        if(get_config(NULL, 'idp_duedates')==2){
                            print '<input type="submit" id="saveandcontinuebutton" name="saveandcontinuebutton" value="'.get_string('savecontinuelaterbutton', 'idp').'" onClick="return checkDateSet()" />';
                        }
                        else{
                            print '<input type="submit" name="saveandcontinuebutton" value="'.get_string('savecontinuelaterbutton', 'idp').'" />';
                        }
                        print '</div>';

                        // Submit button
                        print '</td><td>';
                        print '<div style="text-align: center">';
                        print '<input type="hidden" name="rev" value="'.$currevision->id.'" />';
                        if(get_config(NULL, 'idp_duedates')==2){
                            print '<input type="submit" name="submitbutton" value="'.get_string('submitplan', 'idp'). '" onClick="return checkDateSet()" />';
                        }
                        else{
                            print '<input type="submit" name="submitbutton" value="'.get_string('submitplan', 'idp').'" />';
                        }
                        print '</div>';
                        print "</td></tr></table></center>\n";
                    }
                } 
                if(('approved' == $currevision->status or 'overdue' == $currevision->status) && ($can_evaluate || ((get_config(NULL, 'idp_enableeval')==2) && $can_submit))){
                        // Evaluate button
                        print '<div style="width:722px"><form method="get" action="evaluation.php"><p style="text-align: center">';
                        print '<input type="hidden" name="id" value="'.$plan->id.'" />';
                        print '<input type="hidden" name="rev" value="'.$currevision->id.'" />';
                        print '<input type="submit" value="'.get_string('evaluateplan', 'idp').'" />';
                        print "</p></form></div>\n";
                }

                if ( $can_submit && $can_edit ){
                    echo '</form>';
                }

                print '<div style="width:722px"><p id="backtotop" style="text-align: center"><a href="#top">'.get_string('backtotoplink', 'idp').'</a></p></div>';
            }
        } else {
            print '<p><i>'.get_string('norevisions', 'idp')."</i></p>\n";
        }
        echo '</td>';

    break;
    }
}
/// Finish the page
echo '</tr></table>';
?>

<script type="text/javascript">
<!-- //
    var idp_revision_id = <?php echo $currevision->id ?>;
    var idp_revision_frameworkid = <?php echo optional_param('framework', 1, PARAM_INT); ?>;

    function checkDateSet(){
        console.log($('input[@type=text].idpdate'));
        valid=true;
        $('input[@type=text].idpdate').each(
            function(){
                if(this.value==''){
                    console.log('Missing Date!!');
                    valid=false;
                }
            }
        );

        if(valid==false){
            alert('Error, please fill in all dates'); return false;
        }
        else{
            return true;
        }
    }

// -->
</script>
<?php
print collapse_groups_script();
print '<script type="text/javascript" src="revision.js"></script>'."\n";
print '<script type="text/javascript" src="search.js"></script>'."\n";
print_footer();

?>
