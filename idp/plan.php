<?php
/**
 * This page asks for a name before creating a new Learning Plan.
 **/

require_once('../config.php');
require_once('lib.php');
require_once($CFG->dirroot.'/local/js/lib/setup.php');

require_login();

$action = required_param('action', PARAM_ACTION); // One of: clone, create, delete, rename
$name = optional_param('name', '', PARAM_NOTAGS); // Plan name
$startdate = optional_param('startdate', '', PARAM_NOTAGS); // Start of the training period
$enddate = optional_param('enddate', '', PARAM_NOTAGS); // End of the training period
$planid = optional_param('planid', 0, PARAM_INT); // IDP ID (idp.id)

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

if (('create' == $action or 'rename' == $action or 'clone' == $action) && !empty($name) && !empty($startdate) && !empty($enddate)) {

    $errorurl = "plan.php?action={$action}" . (($action=='create')?'':"&planid={$planid}");

    // Parse dates from the user
    if (!$starttime = convert_userdate($startdate)) {
        error(get_string('error:badstartdate', 'idp'), $errorurl);
    }
    if (!$endtime = convert_userdate($enddate)) {
        error(get_string('error:badenddate', 'idp'), $errorurl);
    }

    // Simple validation check
    if ($endtime < $starttime) {
        error(get_string('error:endbeforestart', 'idp'), $errorurl);
    }

    // Perform the action
    if ('create' == $action) {
        if (!$id = create_new_plan($name, $starttime, $endtime)) {
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
elseif ('create' == $action or 'rename' == $action or 'clone' == $action) {
    $stridps = get_string('idps', 'idp');
    $pagetitle = get_string("{$action}planbreadcrumb", 'idp');

    // Stylesheet and javascript
    local_js(array(
        MBE_JS_DIALOG,
        MBE_JS_TREEVIEW,
        MBE_JS_DATEPICKER
    ));

    $PAGE = page_create_object('MITMS', $USER->id);
    $pageblocks = blocks_setup($PAGE,BLOCKS_PINNED_BOTH);
    $blocks_preferred_width = bounded_number(180, blocks_preferred_width($pageblocks[BLOCK_POS_LEFT]), 210);

    $navlinks = array();
    $navlinks[] = array('name' => $stridps, 'link' => $CFG->wwwroot."/idp/index.php", 'type' => 'home');
    $navlinks[] = array('name' => $pagetitle, 'link' => '', 'type' => 'home');

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
            if(!$defaultstartdate = convert_userdate(get_config(NULL, idp_start_date))){
                $defaultstartdate = '';
            }
            if(!$defaultenddate = convert_userdate(get_config(NULL, idp_end_date))){
                $defaultenddate = '';
            }

            if ('create' != $action) {
                // Get the current values from the DB
                $plan = get_record('idp', 'id', $planid);
                $defaultname = $plan->name;
                $defaultstartdate = $plan->startdate;
                $defaultenddate = $plan->enddate;
            }

            print '<form method="get" action="plan.php">';

            // Ask for a name
            print '<p>'.get_string('plannameexplanation1', 'idp')."</p>\n";
            print '<blockquote><p>';
            print '<input type="hidden" name="planid" value="'.$planid.'" />';
            print '<input type="hidden" name="action" value="'.$action.'" />';
            print '<input id="planname" type="text" name="name" value="'.$defaultname.'" size="30" maxlength="255" />';
            //print '<br />'.get_string('plannameexplanation2', 'idp');
            print '</p></blockquote>';

            // Start/end dates
            print '<p>'.get_string('trainingperiodexplanation', 'idp').'</p>';
            print '<blockquote><p>';
            print helpbutton('idpstartdate', get_string('startdate', 'idp'));
            print '<input type="text" id="startdate" name="startdate" value="'.strftime('%d/%m/%Y', $defaultstartdate).'" size="15" maxlength="30" />';
            print ' '.get_string('to', 'idp').' ';
            print helpbutton('idpenddate', get_string('enddate', 'idp'));
            print '<input type="text" name="enddate" id="enddate" value="'.strftime('%d/%m/%Y', $defaultenddate).'" size="15" maxlength="30" />';
            print '</p></blockquote>';

            // Submit button
            print '<p><input type="submit" value="'.get_string("{$action}plan", 'idp').'" /></p>';
            print '</form>';

            print <<<HEREDOC
<script type="text/javascript">

    $(function() {
        $('#startdate, #enddate').datepicker(
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
    if (0 == $planid) {
        error(get_string('error:invalidplanid', 'idp'));
    }
    else {
        if (delete_plan($planid)) {
            redirect($CFG->wwwroot.'/idp/index.php');
        }
        else {
            error(get_string('error:plannotempty', 'idp'), "index.php");
        }
    }
}
else {
    error(get_string('error:invalidaction', 'idp', $action));
}

?>
