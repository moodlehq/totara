<?php
/**
 * This page asks for a name before creating a new Learning Plan.
 **/

require_once('../config.php');
require_once('lib.php');

require_login();

$action = required_param('action', PARAM_ACTION); // One of: create, delete, rename
$name = optional_param('name', '', PARAM_NOTAGS); // Plan name
$startdate = optional_param('startdate', '', PARAM_NOTAGS); // Start of the training period
$enddate = optional_param('enddate', '', PARAM_NOTAGS); // End of the training period
$planid = optional_param('planid', 0, PARAM_INT); // IDP ID (idp.id)

$sitecontext = get_context_instance(CONTEXT_SYSTEM);
$contextuser = get_context_instance(CONTEXT_USER, $USER->id);

add_to_log(SITEID, 'idp', 'create plan', "plan.php", '');

require_capability('moodle/local:editownplan', $sitecontext);

if (('create' == $action or 'rename' == $action) && !empty($name) && !empty($startdate) && !empty($enddate)) {

    // Parse dates from the user
    if (!$starttime = convert_userdate($startdate)) {
        error(get_string('error:badstartdate', 'idp'), "index.php");
    }
    if (!$endtime = convert_userdate($enddate)) {
        error(get_string('error:badenddate', 'idp'), "index.php");
    }

    // Simple validation check
    if ($endtime < $starttime) {
        error(get_string('error:endbeforestart', 'idp'), "index.php");
    }

    // Perform the action
    if ('create' == $action) {
        if (!$id = create_new_plan($name, $starttime, $endtime)) {
            error(get_string('error:cannotcreateplan', 'idp'), "index.php");
        }
        redirect($CFG->wwwroot.'/plan/revision.php?id='.$id);
    }
    else {
        if (!rename_plan($planid, $name, $starttime, $endtime)) {
            error(get_string('error:cannotrenameplan', 'idp'), "index.php");
        }
        redirect($CFG->wwwroot.'/plan/index.php');
    }
}
elseif ('create' == $action or 'rename' == $action) {
    $stridps = get_string('idps', 'idp');
    $pagetitle = get_string("{$action}planbreadcrumb", 'idp');

    $navlinks = array();
    $navlinks[] = array('name' => $stridps, 'link' => $CFG->wwwroot."/plan/index.php", 'type' => 'home');
    $navlinks[] = array('name' => $pagetitle, 'link' => '', 'type' => 'home');

    $navigation = build_navigation($navlinks);

    // Add YUI javascript and CSS.
    $CFG->stylesheets[] = $CFG->wwwroot . '/lib/yui/calendar/assets/skins/sam/calendar.css';
    require_js(array('yui_yahoo', 'yui_event', 'yui_connection', 'yui_json', 'yui_dom', 'yui_dom-event', 'yui_calendar'));
    require_js($CFG->wwwroot . '/local/js/PopupCalendar.js');

    print_header_simple($pagetitle, '', $navigation, '', '', true);

    print '<h1>'.get_string("{$action}plantitle", 'idp').'</h1>';

    $defaultname = get_string('defaultplanname', 'idp');
    $defaultstartdate = strtotime('now');
    $defaultenddate = strtotime('now + 3 months');
    if ('create' == $action) {
        // Show the disclaimer
        print '<blockquote><p>'.format_text($CFG->idpdisclaimer, FORMAT_HTML).'</p></blockquote>';
    }
    else {
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
    print '<input type="text" id="startdate" name="startdate" value="'.strftime('%d-%m-%Y', $defaultstartdate).'" size="15" maxlength="30" />';
    print ' '.get_string('to', 'idp').' ';
    print '<input type="text" name="enddate" id="enddate" value="'.strftime('%d-%m-%Y', $defaultenddate).'" size="15" maxlength="30" />';
    print '</p></blockquote>';

    // Submit button
    print '<p><input type="submit" value="'.get_string("{$action}plan", 'idp').'" /></p>';
    print '</form>';

    // Put the focus on the name editbox
    print '<script type="text/javascript">';
    print 'var editbox = getobject(\'planname\');';
    print 'editbox.focus();';
    print '</script>'."\n";

    // Add .js for popup-calendars
    print '
        <script type="text/javascript">

            // this is needed for the YUI calendar skinning, for some reason.
            document.body.className = document.body.className + " yui-skin-sam";

            YAHOO.util.Event.onDOMReady( function(e) {
                    try {
                        var cal1 = new PopupCalendar("startdate");
                        var cal2 = new PopupCalendar("enddate");
                    } catch(e) {
                        // Something broke, so we\'ll leave it to the server end.
                    }
                });
        </script>
    ';

    print_footer();
}
elseif ('delete' == $action) {
    if (0 == $planid) {
        error(get_string('error:invalidplanid', 'idp'));
    }
    else {
        if (delete_plan($planid)) {
            redirect($CFG->wwwroot.'/plan/index.php');
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
