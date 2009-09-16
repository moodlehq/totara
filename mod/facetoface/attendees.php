<?php

    require_once('../../config.php');
    require_once('lib.php');

    $id = optional_param('id', 0, PARAM_INT); // Course Module ID
    $f = optional_param('f', 0, PARAM_INT); // facetoface Module ID
    $s = optional_param('s', 0, PARAM_INT); // facetoface session ID
    $takeattendance = optional_param('takeattendance', 0, PARAM_INT); // take attendance
    $cancelform = optional_param('cancelform'); // cancel request
    $backtoallsessions = optional_param('backtoallsessions', 0, PARAM_INT); // facetoface activity to go back to

    if ($id) {

        if (! $cm = get_record('course_modules', 'id', $id)) {
            error(get_string('error:incorrectcoursemoduleid', 'facetoface'));
        }
        if (! $course = get_record('course', 'id', $cm->course)) {
            error(get_string('error:coursemisconfigured', 'facetoface'));
        }
        if (! $facetoface = get_record('facetoface', 'id', $cm->instance)) {
            error(get_string('error:incorrectcoursemodule', 'facetoface'));
        }

    } elseif ($s) {

        if (! $session = facetoface_get_session($s)) {
            error(get_string('error:incorrectcoursemodulesession', 'facetoface'));
        }
        if (! $facetoface = get_record('facetoface', 'id', $session->facetoface)) {
            error(get_string('error:incorrectfacetofaceid', 'facetoface'));
        }
        if (! $course = get_record('course', 'id', $facetoface->course)) {
            error(get_string('error:coursemisconfigured', 'facetoface'));
        }
        if (! $cm = get_coursemodule_from_instance('facetoface', $facetoface->id, $course->id)) {
            error(get_string('error:incorrectcoursemodule', 'facetoface'));
        }

    } else {

        if (! $facetoface = get_record('facetoface', 'id', $f)) {
            error(get_string('error:incorrectfacetofaceid', 'facetoface'));
        }
        if (! $course = get_record('course', 'id', $facetoface->course)) {
            error(get_string('error:coursemisconfigured', 'facetoface'));
        }
        if (! $cm = get_coursemodule_from_instance('facetoface', $facetoface->id, $course->id)) {
            error(get_string('error:incorrectcoursemodule', 'facetoface'));
        }
    }

    $sessiondate = NULL;
    $datetimestart = make_timestamp(2000, 1, 1, 9, 0, 0);
    $datetimefinish = make_timestamp(2000, 1, 1, 12, 0, 0);

    require_course_login($course);
    $context = get_context_instance(CONTEXT_COURSE, $course->id);
    require_capability('mod/facetoface:view', $context);

    if ($form = data_submitted()) {
        if (!confirm_sesskey()) {
            print_error('confirmsesskeybad', 'error');
        }

        require_capability('mod/facetoface:takeattendance', $context);

        if ($cancelform) {
            redirect('attendees.php?s='.$s, '', '4');
        } elseif (facetoface_take_attendance($form)) {
            add_to_log($course->id, 'facetoface', 'take attendance', "view.php?id=$cm->id", $facetoface->id, $cm->id);
        } else {
            add_to_log($course->id, 'facetoface', 'take attendance (FAILED)', "view.php?id=$cm->id", $facetoface->id, $cm->id);
        }

    }
    $strfacetofaces = get_string('modulenameplural', 'facetoface');
    $strfacetoface = get_string('modulename', 'facetoface');

    $pagetitle = format_string($facetoface->name);
    $navlinks[] = array('name' => $strfacetofaces, 'link' => "index.php?id=$course->id", 'type' => 'title');
    $navlinks[] = array('name' => $pagetitle, 'link' => "view.php?f=$facetoface->id", 'type' => 'activityinstance');
    $navlinks[] = array('name' => get_string('attendees', 'facetoface'), 'link' => '', 'type' => 'title');
    $navigation = build_navigation($navlinks);
    print_header_simple($pagetitle, '', $navigation, '', '', true,
                        update_module_button($cm->id, $course->id, $strfacetoface), navmenu($course, $cm));

    if ($takeattendance && !has_capability('mod/facetoface:takeattendance', $context)) {
        $takeattendance = 0;
    }

    if ($takeattendance) {
        $heading = get_string('takeattendance', 'facetoface');
    } else {
        add_to_log($course->id, 'facetoface', 'view attendees', "view.php?id=$cm->id", $facetoface->id, $cm->id);
        $heading = get_string('attendees', 'facetoface');
    }
    if ($session->datetimeknown) {
        $allsessiondates = '';
        foreach ($session->sessiondates as $date) {
            $allsessiondates .= '<tr>';
            $allsessiondates .= '<td align="right">'.userdate($date->timestart, get_string('strftimedaydate')).
                ',</td><td align="left">'.userdate($date->timestart, get_string('strftimetime')).
                ' - '.userdate($date->timefinish, get_string('strftimetime')).'</td>';
            $allsessiondates .= '</tr>';
        }

        $subheading = $facetoface->name.' - '.$session->venue.'<br /><table border="0">'.$allsessiondates.'</table>';
    } else {
        $subheading = $facetoface->name.' - '.$session->location.'<br />'.get_string('wait-list', 'facetoface');
    }

    print_heading($heading, 'center');
    echo '<center>';
    echo '<strong>'.$subheading.'</strong>';
    echo '</center>';
    echo '<br />';

    if ($takeattendance) {
        echo '<center><span style="font-size: 12px; line-height: 18px;">';
        echo get_string('attendanceinstructions', 'facetoface');
        echo '</span></center><br />';
    }

    $table = '';

    if ($takeattendance) {
        $table .= '<form action="attendees.php?s='.$s.'" method="post">';
        $table .= '<input type="hidden" name="sesskey" value="'.$USER->sesskey.'" />';
        $table .= '<input type="hidden" name="s" value="'.$s.'" />';
        $table .= '<input type="hidden" name="action" value="1" />';
    }
    $table .= '<table align="center" cellpadding="3" cellspacing="0" width="600" style="border-color:#DDDDDD; border-width:1px 1px 1px 1px; border-style:solid;">';
    $table .= '<tr>';
    $table .= '<th class="header" align="left">&nbsp;'.get_string('name').'</th>';
    if (has_capability('mod/facetoface:viewattendees', $context)) {
        if ($takeattendance) {
            $table .= '<th class="header" align="center" width="40%">'.get_string('attendedsession', 'facetoface').'</th>';
        } else {
            if (!get_config(NULL, 'facetoface_hidecost')) {
                $table .= '<th class="header" align="center">'.get_string('cost', 'facetoface').'</th>';
                if (!get_config(NULL, 'facetoface_hidediscount')) {
                    $table .= '<th class="header" align="center">'.get_string('discountcode', 'facetoface').'</th>';
                }
            }
            $table .= '<th class="header" align="center">'.get_string('attendance', 'facetoface').'</th>';
        }
    }
    $table .= '</tr>';

    if ($attendees = facetoface_get_attendees($session->id)) {

        foreach($attendees as $attendee) {
            $table .= '<tr>';
            $table .= '<td>&nbsp;<a href="'.$CFG->wwwroot.'/user/view.php?id='.$attendee->id.
                '&amp;course='.$course->id.'">'.$attendee->firstname.', '.$attendee->lastname.'</a></td>';
            if (has_capability('mod/facetoface:viewattendees', $context)) {
                if ($takeattendance) {
                    $checkbox_id = 'submissionid_'.$attendee->submissionid;
                    $did_attend = ((int)($attendee->grade)==100)? 1 : 0;
                    $checkbox = print_checkbox($checkbox_id, $did_attend, $did_attend, '', '', '', true);
                    $table .= '<td align="center">'.$checkbox.'</td>';
                } else {
                    if (!get_config(NULL, 'facetoface_hidecost')) {
                        $table .= '<td align="center">'.facetoface_cost($attendee->id, $session->id, $session).'</td>';
                        if (!get_config(NULL, 'facetoface_hidediscount')) {
                            $table .= '<td align="center">'.$attendee->discountcode.'</td>';
                        }
                    }
                    $did_attend = ((int)($attendee->grade)==100)? get_string("yes") : get_string("no");
                    $table .= '<td align="center">'.$did_attend.'</td>';
                }
            }
            $table .= '</tr>';
        }

    } else {
        $table .= '<tr>';
        if (has_capability('mod/facetoface:viewattendees', $context)) {
            $table .= '<td colspan="2">&nbsp;'.get_string('nosignedupusers', 'facetoface').'</td>';
        } else  {
            $table .= '<td>&nbsp;'.get_string('nosignedupusers', 'facetoface').'</td>';
        }
        $table .= '</tr>';
        
    }
    $table .= '</table>';
    if ($takeattendance) {
        $table .= '<br /><center>';
        $table .= '<input type="submit" value="'.get_string('saveattendance', 'facetoface').'" />';
        $table .= '&nbsp;<input type="submit" name="cancelform" value="'.get_string('cancel').'" />';
        $table .= '</center>';

        $table .= '</form>';
    }
    echo $table;

    // Actions
    print '<p style="text-align: center">';
    if (has_capability('mod/facetoface:takeattendance', $context)) {
        if (!$takeattendance and !empty($attendees)) {
            // Take attendance
            echo '<a href="'.$CFG->wwwroot.'/mod/facetoface/attendees.php?s='.$session->id.'&amp;takeattendance=1">'.get_string('takeattendance', 'facetoface').'</a> - ';
        }
    }
    if (has_capability('mod/facetoface:editattendees', $context)) {
        // Add/remove attendees
        echo '<a href="'.$CFG->wwwroot.'/mod/facetoface/editattendees.php?s='.$session->id.'">'.get_string('addremoveattendees', 'facetoface').'</a> - ';
    }

    $url = $CFG->wwwroot.'/course/view.php?id='.$course->id;
    if ($backtoallsessions) {
        $url = $CFG->wwwroot.'/mod/facetoface/view.php?f='.$facetoface->id.'&amp;backtoallsessions='.$backtoallsessions;
    }
    print '<a href="'.$url.'">'.get_string('goback', 'facetoface').'</a></p>';

    if (has_capability('mod/facetoface:viewcancellations', $context) && facetoface_get_num_cancellations($session->id)) {

        // View cancellations
        echo '<br />';
        print_heading(get_string('cancellations', 'facetoface'), 'center');

        $table  = '<table align="center" cellpadding="3" cellspacing="0" width="600" style="border-color:#DDDDDD; border-width:1px 1px 1px 1px; border-style:solid;">';
        $table .= '<tr>';
        $table .= '<th class="header" align="left">&nbsp;'.get_string('name').'</th>';
        $table .= '<th class="header" align="cemter">'.get_string('timesignedup', 'facetoface').'</th>';
        $table .= '<th class="header" align="cemter">'.get_string('timecancelled', 'facetoface').'</th>';
        $table .= '</tr>';

        $attendees = facetoface_get_cancellations($session->id);

        foreach($attendees as $attendee) {
            $table .= '<tr>';
            $table .= '<td>&nbsp;<a href="'.$CFG->wwwroot.'/user/view.php?id='.$attendee->id.
                '&amp;course='.$course->id.'">'.$attendee->lastname.', '.$attendee->firstname.'</a></td>';
            $table .= '<td align="center">'.userdate($attendee->timecreated, get_string('strftimedatetime')).'</td>';
            $table .= '<td align="center">'.userdate($attendee->timecancelled, get_string('strftimedatetime')).'</td>';
            $table .= '</tr>';
        }

        $table .= '</table>';
        echo $table;
    }

    print_footer($course);

?>
