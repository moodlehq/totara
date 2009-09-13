<?php

    require_once('../../config.php');
    require_once('lib.php');
    $id = optional_param('id', 0, PARAM_INT); // Course Module ID
    $f = optional_param('f', 0, PARAM_INT); // facetoface Module ID
    $s = optional_param('s', 0, PARAM_INT); // facetoface session ID
    $confirmcancel = optional_param('confirm',0,PARAM_INT);
    $cancelform = optional_param( 'cancelform' );
    $cancelbooking = optional_param('cancelbooking', 0, PARAM_INT);
    $confirmmanager = optional_param('confirmmanager');
    $confirm = optional_param('confirm');
    $changemanager = optional_param('changemanager');
    $backtoallsessions = optional_param('backtoallsessions', 0, PARAM_INT);
    $addmanager = optional_param('addmanager', 0, PARAM_INT);
    $discountcode = optional_param('discountcode', '', PARAM_SAFEDIR);
    $notificationtype = optional_param('notificationtype', MDL_F2F_INVITE, PARAM_INT);

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
        if (! $cm = get_coursemodule_from_instance("facetoface", $facetoface->id, $course->id)) {
            error(get_string('error:incorrectcoursemoduleid', 'facetoface'));
        }

    } else {

        if (! $facetoface = get_record('facetoface', 'id', $f)) {
            error(get_string('error:incorrectfacetofaceid', 'facetoface'));
        }
        if (! $course = get_record('course', 'id', $facetoface->course)) {
            error(get_string('error:coursemisconfigured', 'facetoface'));
        }
        if (! $cm = get_coursemodule_from_instance("facetoface", $facetoface->id, $course->id)) {
            error(get_string('error:incorrectcoursemoduleid', 'facetoface'));
        }
    }

    require_course_login($course);
    $context = get_context_instance(CONTEXT_COURSE, $course->id);
    require_capability('mod/facetoface:view', $context);

    $confirm = false;
    $errorstr = '';

    if ($form = data_submitted()) {
        if (!confirm_sesskey()) {
            print_error('confirmsesskeybad', 'error');
        }

        require_capability('mod/facetoface:signup', $context);

        if (!empty($form->confirm)) $confirm=true;

        if ($cancelform) {

            if ($backtoallsessions) {
                redirect($CFG->wwwroot.'/mod/facetoface/view.php?f='.$backtoallsessions);
            } else {
                redirect($CFG->wwwroot.'/course/view.php?id='.$course->id);
            }

        } else if ($cancelbooking) {

            if (facetoface_user_cancel($session)) {

                add_to_log($course->id, 'facetoface', 'cancel booking', "signup.php?id=$cm->id", $facetoface->id, $cm->id);

                $url = '';
                if ($backtoallsessions) {
                    $url = $CFG->wwwroot.'/mod/facetoface/view.php?f='.$backtoallsessions;
                } else {
                    $url = $CFG->wwwroot.'/course/view.php?id='.$course->id;
                }

                $message = get_string('bookingcancelled', 'facetoface');
                $timemessage = 4;

                if ($session->datetimeknown) {
                    $error = facetoface_send_cancellation_notice($facetoface, $session, $USER->id, $notificationtype);
                    if (empty($error)) {

                        if ($session->datetimeknown && $facetoface->cancellationinstrmngr) {
                            $message .= '<BR /><BR />'.get_string('cancellationsentmgr', 'facetoface');
                        } else {
                            $message .= '<BR /><BR />'.get_string('cancellationsent', 'facetoface');
                        }
                    }
                    else {
                        error($error);
                    }
                }

                redirect($url, $message, $timemessage);

            } else {
                add_to_log($course->id, 'facetoface', 'cancel booking (FAILED)', "signup.php?id=$cm->id", $facetoface->id, $cm->id);

                $errorstr = get_string('error:cancelbooking', 'facetoface');
            }

        } elseif (!empty($addmanager)) {

            if (!empty($form->manageremail)) {

                if (facetoface_check_manageremail($form->manageremail)) {

                    if (facetoface_set_manageremail($form->manageremail)) {
                        add_to_log($course->id, 'facetoface', 'update manageremail', "signup.php?id=$cm->id", $facetoface->id, $cm->id);
                        $confirm = true;
                    } else {
                        add_to_log($course->id, 'facetoface', 'update manageremail (FAILED)', "signup.php?id=$cm->id", $facetoface->id, $cm->id);
                        $errorstr = get_string('error:couldnotupdatemanageremail', 'facetoface');
                    }

                } else {
                    $errorstr = facetoface_get_manageremailformat();
                }

            } else {
                $errorstr = get_string('error:emptymanageremail', 'facetoface');
            }

        } elseif (!empty($changemanager)) {

            if (!empty($form->manageremail)) {
                if(facetoface_set_manageremail($form->manageremail)) {
                    add_to_log($course->id, 'facetoface', 'update manageremail', "signup.php?id=$cm->id", $facetoface->id, $cm->id);
                    $confirm = true;
                } else {
                    add_to_log($course->id, 'facetoface', 'update manageremail (FAILED)', "signup.php?id=$cm->id", $facetoface->id, $cm->id);
                    $errorstr = get_string('error:couldnotupdatemanageremail', 'facetoface');
                }
            } elseif (!empty($confirmmanager)) {
                $confirmmanager = 0;
            } else {
                $errorstr = get_string('error:emptymanageremail', 'facetoface');
            }

        } elseif (!$session->datetimeknown || !get_config(NULL, 'facetoface_addchangemanageremail')) {
            $confirm=true;
        }

        if ($confirm) {

            if (facetoface_get_user_submissions($facetoface->id, $USER->id)) {
                error(get_string('alreadysignedup', 'facetoface'), $CFG->wwwroot.'/course/view.php?id='.$course->id);
            }
            elseif ($submissionid = facetoface_user_signup($session, $facetoface, $course, $discountcode, $notificationtype)) {

                add_to_log($course->id, 'facetoface','signup',"signup.php?d=$submissionid", "$submissionid", $cm->id);

                $url = $CFG->wwwroot.'/course/view.php?id='.$course->id;
                $message = '';

                if ($addmanager) $message .= get_string('manageradded', 'facetoface').' ';
                if ($changemanager) $message .= get_string('managerchanged', 'facetoface').' ';

                $message .= get_string('bookingcompleted', 'facetoface');

                if ($session->datetimeknown && $facetoface->confirmationinstrmngr) {
                    $message .= '<BR /><BR />'.get_string('confirmationsentmgr', 'facetoface');
                } else {
                    $message .= '<BR /><BR />'.get_string('confirmationsent', 'facetoface');
                }
                $timemessage = 4;

                redirect($url, $message, $timemessage);
            } else {
                add_to_log($course->id, 'facetoface','signup (FAILED)',"signup.php?d=$submissionid", "$submissionid", $cm->id);
                $errorstr = get_string('error:problemsigningup', 'facetoface');
            }

        } else {
            $manageremail = facetoface_get_manageremail($USER->id);

            if (!empty($changemanager)) {
            } elseif ($manageremail) {
                $confirmmanager = 1;
            } else {
                $addmanager = 1;
            }
        }
    }

    $strfacetofaces = get_string('modulenameplural', 'facetoface');
    $strfacetoface = get_string('modulename', 'facetoface');

    $sessiondate = array();
    $datetimestart = array();
    $datetimefinish = array();
    for ($i = 0; $i < count($session->sessiondates); $i++) {
        $sessiondate[$i] = userdate($session->sessiondates[$i]->timestart, get_string('strftimedate'));
        $datetimestart[$i] = userdate($session->sessiondates[$i]->timestart, get_string('strftimetime'));
        $datetimefinish[$i] = userdate($session->sessiondates[$i]->timefinish, get_string('strftimetime'));
    }
    $signedup = false;

    $pagetitle = format_string($facetoface->name);
    $navlinks[] = array('name' => $strfacetofaces, 'link' => "index.php?id=$course->id", 'type' => 'title');
    $navlinks[] = array('name' => $pagetitle, 'link' => '', 'type' => 'activityinstance');
    $navigation = build_navigation($navlinks);
    print_header_simple($pagetitle, '', $navigation, '', '', true,
                        update_module_button($cm->id, $course->id, $strfacetoface));

    echo '<table align="center" border="0" cellpadding="5" cellspacing="0"><tr><td class="generalboxcontent">';

    if ($cancelbooking) {
        $heading = get_string('cancelbookingfor', 'facetoface', $facetoface->name);
    } else {
        $heading = get_string('signupfor', 'facetoface', $facetoface->name);
    }

    print_heading($heading, 'center');

    if (facetoface_check_signup($facetoface->id)) {
    // User is currently signed-up for this session

        echo '<center><span style="font-size: 12px; line-height: 18px;">';
        echo get_string('bookingstatus', 'facetoface');
        $signedup = true;

        if (!empty($cancelbooking)) {
            // User has asked to cancel their booking to this instance
            echo '. ';
            echo get_string('cancellationconfirm', 'facetoface');

        } else {
            echo ': ';
        }
        echo '<br /><br /></span></center>';
 
    }

    if (!empty($errorstr)) {
        echo '<div class="notifyproblem" align="center"><span style="font-size: 12px; line-height: 18px;">'.$errorstr.'</span></div>';
    }

    $querystr = '';

    if ($cancelbooking) $querystr .= '&amp;cancelbooking=1';
    if ($addmanager) $querystr .= '&amp;addmanager=1';
    if ($changemanager) $querystr .= '&amp;changemanager=1';
    if ($confirmmanager) $querystr .= '&amp;confirmmanager=1';
    if ($backtoallsessions) $querystr .= '&amp;backtoallsessions='.$backtoallsessions;

    require('signup.html');
    echo '</td></tr></table>';
    print_footer($course);

?>
