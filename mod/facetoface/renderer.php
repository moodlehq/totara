<?php


defined('MOODLE_INTERNAL') || die();

class mod_facetoface_renderer extends plugin_renderer_base {
    /**
     * Builds session list table given an array of sessions
     */
    public function print_session_list_table($customfields, $sessions, $viewattendees, $editsessions) {
        $output = '';

        $tableheader = array();
        foreach ($customfields as $field) {
            if (!empty($field->showinsummary)) {
                $tableheader[] = format_string($field->name);
            }
        }
        $tableheader[] = get_string('date', 'facetoface');
        $tableheader[] = get_string('time', 'facetoface');
        if ($viewattendees) {
            $tableheader[] = get_string('capacity', 'facetoface');
        }
        else {
            $tableheader[] = get_string('seatsavailable', 'facetoface');
        }
        $tableheader[] = get_string('status', 'facetoface');
        $tableheader[] = get_string('options', 'facetoface');

        $timenow = time();

        $table = new html_table();
        $table->summary = get_string('previoussessionslist', 'facetoface');
        $table->head = $tableheader;
        $table->data = array();

        foreach ($sessions as $session) {

            $isbookedsession = false;
            $bookedsession = $session->bookedsession;
            $sessionstarted = false;
            $sessionfull = false;

            $sessionrow = array();

            // Custom fields
            $customdata = $session->customfielddata;
            foreach ($customfields as $field) {
                if (empty($field->showinsummary)) {
                    continue;
                }

                if (empty($customdata[$field->id])) {
                    $sessionrow[] = '&nbsp;';
                }
                else {
                    if (CUSTOMFIELD_TYPE_MULTISELECT == $field->type) {
                        $sessionrow[] = str_replace(CUSTOMFIELD_DELIMITER, html_writer::empty_tag('br'), format_string($customdata[$field->id]->data));
                    } else {
                        $sessionrow[] = format_string($customdata[$field->id]->data);
                    }

                }
            }

            // Dates/times
            $allsessiondates = '';
            $allsessiontimes = '';
            if ($session->datetimeknown) {
                foreach ($session->sessiondates as $date) {
                    if (!empty($allsessiondates)) {
                        $allsessiondates .= html_writer::empty_tag('br');
                    }
                    $allsessiondates .= userdate($date->timestart, get_string('strftimedate'));
                    if (!empty($allsessiontimes)) {
                        $allsessiontimes .= html_writer::empty_tag('br');
                    }
                    $allsessiontimes .= userdate($date->timestart, get_string('strftimetime')).
                        ' - '.userdate($date->timefinish, get_string('strftimetime'));
                }
            }
            else {
                $allsessiondates = get_string('wait-listed', 'facetoface');
                $allsessiontimes = get_string('wait-listed', 'facetoface');
                $sessionwaitlisted = true;
            }
            $sessionrow[] = $allsessiondates;
            $sessionrow[] = $allsessiontimes;

            // Capacity
            $signupcount = facetoface_get_num_attendees($session->id, MDL_F2F_STATUS_APPROVED);
            $stats = $session->capacity - $signupcount;
            if ($viewattendees) {
                $stats = $signupcount.' / '.$session->capacity;
            }
            else {
                $stats = max(0, $stats);
            }
            $sessionrow[] = $stats;

            // Status
            $status  = get_string('bookingopen', 'facetoface');
            if ($session->datetimeknown && facetoface_has_session_started($session, $timenow) && facetoface_is_session_in_progress($session, $timenow)) {
                $status = get_string('sessioninprogress', 'facetoface');
                $sessionstarted = true;
            }
            elseif ($session->datetimeknown && facetoface_has_session_started($session, $timenow)) {
                $status = get_string('sessionover', 'facetoface');
                $sessionstarted = true;
            }
            elseif ($bookedsession && $session->id == $bookedsession->sessionid) {
                $signupstatus = facetoface_get_status($bookedsession->statuscode);

                $status = get_string('status_'.$signupstatus, 'facetoface');
                $isbookedsession = true;
            }
            elseif ($signupcount >= $session->capacity) {
                $status = get_string('bookingfull', 'facetoface');
                $sessionfull = true;
            }

            $sessionrow[] = $status;

            // Options
            $options = '';
            if ($editsessions) {
                $options .= $this->output->action_icon(new moodle_url('sessions.php', array('s' => $session->id)), new pix_icon('t/edit', get_string('edit', 'facetoface')), null, array('title' => get_string('editsession', 'facetoface'))) . ' ';
                $options .= $this->output->action_icon(new moodle_url('sessions.php', array('s' => $session->id, 'c' => 1)), new pix_icon('t/copy', get_string('copy', 'facetoface')), null, array('title' => get_string('copysession', 'facetoface'))) . ' ';
                $options .= $this->output->action_icon(new moodle_url('sessions.php', array('s' => $session->id, 'd' => 1)), new pix_icon('t/delete', get_string('delete', 'facetoface')), null, array('title' => get_string('deletesession', 'facetoface'))) . ' ';
                $options .= html_writer::empty_tag('br');
            }
            if ($viewattendees) {
                $options .= html_writer::link('attendees.php?s='.$session->id.'&backtoallsessions='.$session->facetoface, get_string('attendees', 'facetoface'), array('title' => get_string('seeattendees', 'facetoface'))) . html_writer::empty_tag('br');
            }
            if ($isbookedsession) {
                $options .= html_writer::link('signup.php?s='.$session->id.'&backtoallsessions='.$session->facetoface, get_string('moreinfo', 'facetoface'), array('title' => get_string('moreinfo', 'facetoface'))) . html_writer::empty_tag('br');

                $options .= html_writer::link('cancelsignup.php?s='.$session->id.'&backtoallsessions='.$session->facetoface, get_string('cancelbooking', 'facetoface'), array('title' => get_string('cancelbooking', 'facetoface')));
            }
            elseif (!$sessionstarted and !$bookedsession) {
                $options .= html_writer::link('signup.php?s='.$session->id.'&backtoallsessions='.$session->facetoface, get_string('signup', 'facetoface'));
            }
            if (empty($options)) {
                $options = get_string('none', 'facetoface');
            }
            $sessionrow[] = $options;

            $row = new html_table_row($sessionrow);

            // Set the CSS class for the row
            if ($sessionstarted) {
                $row->attributes = array('class' => 'dimmed_text');
            }
            elseif ($isbookedsession) {
                $row->attributes = array('class' => 'highlight');
            }
            elseif ($sessionfull) {
                $row->attributes = array('class' => 'dimmed_text');
            }

            // Add row to table
            $table->data[] = $row;
        }

        $output .= html_writer::table($table);

        return $output;
    }
}
?>
