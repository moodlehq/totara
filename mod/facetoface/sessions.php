<?php

    require_once('../../config.php');
    require_once('lib.php');

    $id = optional_param('id', 0, PARAM_INT); // Course Module ID
    $f = optional_param('f', 0, PARAM_INT); // facetoface Module ID
    $s = optional_param('s', 0, PARAM_INT); // facetoface session ID
    $c = optional_param('c', 0, PARAM_INT); // copy session
    $d = optional_param('d', 0, PARAM_INT); // copy session
    $cancelform = optional_param( 'cancel' );

    $maxnbdays = 30; // number of session date/time blocks in the form
    $nbdays = 1; // default number to show

    $session = null;
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
            error(get_string('error:incorrectcoursemoduleid', 'facetoface'));
        }

        $nbdays = count($session->sessiondates);

    } else {

        if (! $facetoface = get_record('facetoface', 'id', $f)) {
            error(get_string('error:incorrectfacetofaceid', 'facetoface'));
        }
        if (! $course = get_record('course', 'id', $facetoface->course)) {
            error(get_string('error:coursemisconfigured', 'facetoface'));
        }
        if (! $cm = get_coursemodule_from_instance('facetoface', $facetoface->id, $course->id)) {
            error(get_string('error:incorrectcoursemoduleid', 'facetoface'));
        }
    }

    $sessiondate = array();
    $datetimestart = array();
    $datetimefinish = array();
    for ($i = 0; $i < $maxnbdays; $i++) {
        $sessiondate[$i] = NULL;
        $datetimestart[$i] = make_timestamp(2000, 1, 1, 9, 0, 0);
        $datetimefinish[$i] = make_timestamp(2000, 1, 1, 12, 0, 0);
    }

    if ($s) {
        $form = $session;
        if($d) {
            for ($i=0; $i < count($session->sessiondates); $i++) {
                $sessiondate[$i] = userdate($session->sessiondates[$i]->timestart, get_string('strftimedate'));
                $datetimestart[$i] = userdate($session->sessiondates[$i]->timestart, get_string('strftimetime'));
                $datetimefinish[$i] = userdate($session->sessiondates[$i]->timefinish, get_string('strftimetime'));
            }
        } else {
            for ($i=0; $i < count($session->sessiondates); $i++) {
                $sessiondate[$i] = $session->sessiondates[$i]->timestart;
                $datetimestart[$i] = $session->sessiondates[$i]->timestart;
                $datetimefinish[$i] = $session->sessiondates[$i]->timefinish;
            }
        }
    }

    if (empty($form->facetoface)) {
        $form->facetoface = $facetoface->id;
    }

    if (empty($form->location)) {
        $form->location = '';
    }

    if (empty($form->venue)) {
        $form->venue = '';
    }

    if (empty($form->room)) {
        $form->room = '';
    }

    if (empty($form->datetimeknown)) {
        if ($session && $session->datetimeknown) {
            $form->datetimeknown = 1;
        } else {
            $form->datetimeknown = 0;
        }
    }

    if (empty($form->capacity)) {
        $form->capacity = "10";
    }

    if (!empty($form->sessyr)) {
        for ($i = 0; $i < count($form->sessyr); $i++) {
            if (!empty($form->sessday[$i]) && !empty($form->sessmon[$i]) && !empty($form->sessyr[$i])) {
                $sessiondate[$i] = make_timestamp($form->sessyr[$i], $form->sessmon[$i], $form->sessday[$i], 0, 0, 0);
            }

            if (!empty($form->starthr[$i]) && !empty($form->startmin[$i])) {
                $datetimestart[$i] = make_timestamp(2000, 1, 1, $form->starthr[$i], $form->startmin[$i], 0);
            }

            if (!empty($form->endhr[$i]) && !empty($form->endmin[$i])) {
                $datetimefinish[$i] = make_timestamp(2000, 1, 1, $form->endhr[$i], $form->endmin[$i], 0);
            }
        }
    }

    if (empty($form->duration)) {
        $form->duration = '';
    }

    if (empty($form->normalcost)) {
        $form->normalcost = '';
    }

    if (empty($form->discountcost)) {
        $form->discountcost = '';
    }

    if (empty($form->details)) {
        $form->details = '';
    }

    if (empty($form->closed)) {
        $form->closed = "0";
    }

    require_course_login($course);
    $errorstr = '';
    $context = get_context_instance(CONTEXT_COURSE, $course->id);
    require_capability('mod/facetoface:editsessions', $context);

    if ($session = data_submitted()) {
        if (!confirm_sesskey()) {
            print_error('confirmsesskeybad', 'error');
        }

        if ($cancelform) {
            redirect($CFG->wwwroot.'/mod/facetoface/view.php?f='.$facetoface->id);
        }

        if ($session->d) {
            if (facetoface_delete_session($session)) {
                add_to_log($course->id, 'facetoface', 'delete session', 'sessions.php?s='.$session->id, $facetoface->id, $cm->id);
                $url = "view.php?f=$facetoface->id";
                redirect($url);
            } else {
                add_to_log($course->id, 'facetoface', 'delete session (FAILED)', 'sessions.php?s='.$session->id, $facetoface->id, $cm->id);
                error(get_string('error:couldnotdeletesession', 'facetoface'), $CFG->wwwroot.'/course/view.php?id='.$course->id);
            }
        }

        if (empty($session->facetoface)) {
            // Only the "Copy" form allows users to specify a different facetoface ID
            $session->facetoface = $facetoface->id;
        }

        if ($session->location == '') $errorstr .= get_string('error:emptylocation', 'facetoface');
        if ($session->venue == '') $errorstr .= get_string('error:emptyvenue', 'facetoface');

        if (empty($errorstr)) {

            $sessiondates = array();
            $j = 0;
            $nbdays = count($session->sessyr) - 1; // skip the last one (template)
            for ($i = 0; $i < $nbdays; $i++) {
                $sessiondates[$j]->timestart = make_timestamp($session->sessyr[$i], $session->sessmon[$i],
                                                              $session->sessday[$i], $session->starthr[$i],
                                                              $session->startmin[$i]);
                $sessiondates[$j]->timefinish = make_timestamp($session->sessyr[$i], $session->sessmon[$i],
                                                               $session->sessday[$i], $session->endhr[$i],
                                                               $session->endmin[$i]);
                $j++;
            }

            if ($s && !($session->c) && !($session->d)) {
                $session->id = $s;
                if (empty($session->duration)) $session->duration = '0';
                if (empty($session->normalcost)) $session->normalcost = '0';
                if (empty($session->discountcost)) $session->discountcost = '0';
                if ($edit = facetoface_update_session($session, $sessiondates)) {
                    add_to_log($course->id, 'facetoface', 'update session', "sessions.php?s=$session->id", $facetoface->id, $cm->id);
                    redirect("view.php?f=$session->facetoface", '', '5');
                } else {
                    add_to_log($course->id, 'facetoface', 'update session (FAILED)', "sessions.php?s=$session->id", $facetoface->id, $cm->id);
                    $errordestination = $CFG->wwwroot . "/mod/facetoface/view.php?f=$session->facetoface";
                    error(get_string('error:couldnotupdatesession', 'facetoface'), $errordestination);
                }

            } elseif ($session->c) { // Adding a new copied session

                if ($session->id = facetoface_add_session($session, $sessiondates)) {
                    add_to_log($course->id, 'facetoface', 'copy session', 'sessions.php?s='.$session->id, $facetoface->id, $cm->id);
                    $url = "view.php?f=$session->facetoface";
                    redirect($url);
                } else {
                    add_to_log($course->id, 'facetoface', 'copy session (FAILED)', 'sessions.php?s='.$session->id, $facetoface->id, $cm->id);
                    $errordestination = $CFG->wwwroot . "/mod/facetoface/view.php?f=$session->facetoface";
                    error(get_string('error:couldnotcopysession', 'facetoface'), $errordestination);
                }

            } else { // Adding a new session

                if ($session->id = facetoface_add_session($session, $sessiondates)) {
                    add_to_log($course->id, 'facetoface', 'add session', 'facetoface', 'sessions.php?s='.$session->id, $facetoface->id, $cm->id);
                    $url = "view.php?f=$session->facetoface";
                    redirect($url);
                } else {
                    add_to_log($course->id, 'facetoface', 'add session (FAILED)', 'sessions.php?s='.$session->id, $facetoface->id, $cm->id);
                    error(get_string('error:couldnotaddsession', 'facetoface'), $CFG->wwwroot.'/course/view.php?id='.$course->id);
                }
            }
        } 
    }

    $strfacetofaces = get_string('modulenameplural', 'facetoface');
    $strfacetoface = get_string('modulename', 'facetoface');

    if ($c) {
        $heading = get_string('copyingsession', 'facetoface', $facetoface->name);
    } else if ($d) {
        $heading = get_string('deletingsession', 'facetoface', $facetoface->name);
    } else if ($id) {
        $heading = get_string('addingsession', 'facetoface', $facetoface->name);
    } else {
        $heading = get_string('editingsession', 'facetoface', $facetoface->name);
    }

    $pagetitle = format_string($facetoface->name);
    $navlinks[] = array('name' => $strfacetofaces, 'link' => "index.php?id=$course->id", 'type' => 'title');
    $navlinks[] = array('name' => $pagetitle, 'link' => "view.php?f=$facetoface->id", 'type' => 'activityinstance');
    $navlinks[] = array('name' => $heading, 'link' => '', 'type' => 'title');
    $navigation = build_navigation($navlinks);
    print_header_simple($pagetitle, '', $navigation, '', '', true,
                        update_module_button($cm->id, $course->id, $strfacetoface), navmenu($course, $cm));

    echo '<table align="center" border="0" cellpadding="5" cellspacing="0"><tr><td class="generalboxcontent">';

    print_heading($heading, 'center');

    if (!empty($errorstr)) {
        echo '<div class="notifyproblem" align="center"><span style="font-size: 12px; line-height: 18px;">'.$errorstr.'</span></div>';
    }

    if ($d) {
        echo '<span style="font-size: 12px; line-height: 18px;">'.get_string('deletesessionconfirm', 'facetoface').'<BR /><BR /></span>';
        require('sessions_delete.html');
    } else {
        require('sessions.html');
    }
    echo '</td></tr></table>';
    print_footer($course);

?>
