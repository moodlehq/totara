<?php
/**
 * This page asks for a name before creating a new Learning Plan.
 **/

require_once('../config.php');
require_once('lib.php');
require_once($CFG->dirroot.'/local/js/lib/setup.php');
require_once('idp_forms.php');

require_login();

$action = required_param('action', PARAM_ACTION); // One of: clone, create, delete, rename
$planid = optional_param('planid', 0, PARAM_INT); // IDP ID (idp.id)
$confirm = optional_param('confirm', 0, PARAM_INT);

$sitecontext = get_context_instance(CONTEXT_SYSTEM);
$contextuser = get_context_instance(CONTEXT_USER, $USER->id);

add_to_log(SITEID, 'idp', 'create plan', "plan.php", '');

require_capability('moodle/local:idpeditownplan', $sitecontext);
if ( $action != 'create' ){
    $plan = get_record('idp','id',$planid);
    if ( $USER->id != $plan->userid ){
        print_error('error:plannotyours', 'idp');
    }
    unset($plan);
}

if ($confirm && $action=='delete') {
    if (confirm_sesskey()){
        if(delete_plan($planid)) {
            redirect($CFG->wwwroot.'/idp/index.php');
        }
        else {
            error(get_string('error:cannotdeletesubmit', 'idp'), "index.php");
        }
    }
}

$PAGE = page_create_object('Totara', $USER->id);
$templateid = get_field('idp_template', 'id', 'current', 1);  //Get current template id TODO add checking to this
$form = new create_new_idp_form('plan.php', compact('action', 'planid', 'templateid'));

if ($form->is_cancelled()){
    redirect($CFG->wwwroot. '/idp/index.php'); // redirect to the idp page
}

// Stylesheet and javascript
local_js(array(
    TOTARA_JS_DIALOG,
    TOTARA_JS_TREEVIEW,
    TOTARA_JS_DATEPICKER
));

$stridps = get_string('idps', 'idp');
$pagetitle = get_string("{$action}planbreadcrumb", 'idp');

$navlinks = array();
$navlinks[] = array('name' => $stridps, 'link' => $CFG->wwwroot."/idp/index.php", 'type' => 'home');
$navlinks[] = array('name' => $pagetitle, 'link' => '', 'type' => 'home');


if ('create' == $action or 'rename' == $action or 'clone' == $action) {
    $stridps = get_string('idps', 'idp');
    $pagetitle = get_string("{$action}planbreadcrumb", 'idp');

    $PAGE = page_create_object('Totara', $USER->id);
    $pageblocks = blocks_setup($PAGE,BLOCKS_PINNED_BOTH);
    $blocks_preferred_width = bounded_number(180, blocks_preferred_width($pageblocks[BLOCK_POS_LEFT]), 210);

    if ($fromform = $form->get_data()) {

        if(empty($fromform->submitbutton)) {
        }
        else{
            $name = $fromform->planname;
            $starttime = convert_userdate($fromform->startdate);
            $endtime = convert_userdate($fromform->enddate);
            $templateid = $fromform->templateid;

            // Perform the action
            if ('create' == $action) {
                if (!$id = create_new_plan($name, $starttime, $endtime, $templateid)) {
                    error(get_string('error:cannotcreateplan', 'idp'), $errorurl);
                }
                redirect($CFG->wwwroot.'/idp/revision.php?id='.$id);
            }
            else if ('clone' == $action){
                $currevision = get_revision($planid);
                if (!$newplanid = clone_plan($currevision->id)){
                    error(get_string('error:cannotcloneplan','idp'), $errorurl);
                }
                if(!rename_plan($newplanid, $name, $starttime, $endtime)){
                    error(get_string('error:cannotupdateclonedplan', 'idp'), $errorurl);
                }
                redirect($CFG->wwwroot . '/idp/revision.php?id=' . $newplanid);
            }
            else {
                if (!rename_plan($planid, $name, $starttime, $endtime)) {
                    error(get_string('error:cannotrenameplan', 'idp'), $errorurl);
                }
                redirect($CFG->wwwroot.'/idp/index.php');
            }
        }
    }

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
            // Add YUI javascript and CSS.

            print '<h1>'.get_string("{$action}plantitle", 'idp');
            print helpbutton('idp', get_string('idp', 'idp'));
            print '</h1>';

            $defaultname = get_string('defaultplanname', 'idp');
            if(!$defaultstartdate = convert_userdate(get_config(NULL, 'idp_start_date'))){
                $defaultstartdate = '';
            }
            if(!$defaultenddate = convert_userdate(get_config(NULL, 'idp_end_date'))){
                $defaultenddate = '';
            }

            if ('create' != $action) {
                // Get the current values from the DB
                $plan = get_record('idp', 'id', $planid);
                $idp = new object();
                $idp->planname = $plan->name;
                $idp->startdate = strftime('%d/%m/%Y', $plan->startdate);
                $idp->enddate = strftime('%d/%m/%Y', $plan->enddate);
            }
            else{
                $idp = new object();
            }

            $form->set_data($idp);
            print '<p>'.get_string('trainingperiodexplanation', 'idp').'</p>';
            $form->display();

            print <<<HEREDOC
<script type="text/javascript">

    $(function() {
        $('#id_startdate, #id_enddate').datepicker(
            {
                dateFormat: 'dd/mm/yy',
                showOn: 'button',
                buttonImage: '../local/js/images/calendar.gif',
                buttonImageOnly: true
            }
        );
    });
</script>
HEREDOC;

            echo '</td>';

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
    print '</tr></table>';

    print_footer();
}
elseif ('delete' == $action) {
    $PAGE->print_header($stridps, $navlinks);

    if (0 == $planid) {
        error(get_string('error:invalidplanid', 'idp'));
    }
    else {
        $planname = get_field('idp', 'name', 'id', $planid);
        notice_yesno(
            "Are you sure you want to delete this Plan and all its data?<br /><br />".format_string($planname),
            $CFG->wwwroot.'/idp/plan.php?planid='.$planid.'&action=delete&confirm=1&sesskey='.$USER->sesskey,
            $CFG->wwwroot.'/idp/index.php'
        );
    }
}
else {
    error(get_string('error:invalidaction', 'idp', $action));
}

?>
