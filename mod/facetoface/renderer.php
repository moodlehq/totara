<?php

defined('MOODLE_INTERNAL') || die();

class mod_facetoface_renderer extends plugin_renderer_base {
    protected $context = null;

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
        $tableheader[] = get_string('room', 'facetoface');
        if ($viewattendees) {
            $tableheader[] = get_string('capacity', 'facetoface');
        } else {
            $tableheader[] = get_string('seatsavailable', 'facetoface');
        }
        $tableheader[] = get_string('status', 'facetoface');
        $tableheader[] = get_string('options', 'facetoface');

        $timenow = time();

        $table = new html_table();
        $table->summary = get_string('previoussessionslist', 'facetoface');
        $table->attributes['class'] = 'generaltable fullwidth';
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
                } else {
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
                        $allsessiontimes .= html_writer::empty_tag('br');
                    }
                    $sessionobj = facetoface_format_session_times($date->timestart, $date->timefinish, $date->sessiontimezone);
                    if ($sessionobj->startdate == $sessionobj->enddate) {
                        $allsessiondates .= $sessionobj->startdate;
                    } else {
                        $allsessiondates .= $sessionobj->startdate . ' - ' . $sessionobj->enddate;
                    }
                    $allsessiontimes .= $sessionobj->starttime . ' - ' . $sessionobj->endtime . ' ' . $sessionobj->timezone;
                }
            } else {
                $allsessiondates = get_string('wait-listed', 'facetoface');
                $allsessiontimes = get_string('wait-listed', 'facetoface');
                $sessionwaitlisted = true;
            }
            $sessionrow[] = $allsessiondates;
            $sessionrow[] = $allsessiontimes;

            // Room.
            if (isset($session->room)) {
                $roomhtml = '';
                $roomhtml .= isset($session->room->name) ? format_string($session->room->name) . html_writer::empty_tag('br') : '';
                $roomhtml .= isset($session->room->building) ? format_string($session->room->building) . html_writer::empty_tag('br') : '';
                $roomhtml .= isset($session->room->address) ? format_string($session->room->address) . html_writer::empty_tag('br') : '';
                $sessionrow[] = $roomhtml;
            } else {
                $sessionrow[] = '';
            }

            // Capacity.
            if ($session->datetimeknown) {
                $signupcount = facetoface_get_num_attendees($session->id, MDL_F2F_STATUS_BOOKED);
            } else {
                $signupcount = facetoface_get_num_attendees($session->id, MDL_F2F_STATUS_APPROVED);
            }
            if ($viewattendees) {
                if ($session->datetimeknown) {
                    $a = array('current' => $signupcount, 'maximum' => $session->capacity);
                    $stats = get_string('capacitycurrentofmaximum', 'facetoface', $a);
                    if ($signupcount > $session->capacity) {
                        $stats .= get_string('capacityoverbooked', 'facetoface');
                    }
                    $waitlisted = facetoface_get_num_attendees($session->id, MDL_F2F_STATUS_APPROVED) - $signupcount;
                    if ($waitlisted > 0) {
                        $stats .= " (" . $waitlisted . " " . get_string('status_waitlisted', 'facetoface') . ")";
                    }
                } else {
                    $stats = $session->capacity . " (" . $signupcount . " " . get_string('status_waitlisted', 'facetoface') . ")";
                }
            } else {
                $stats = max(0, $session->capacity - $signupcount);
            }
            $sessionrow[] = $stats;

            // Status.
            $status  = get_string('bookingopen', 'facetoface');
            if ($session->datetimeknown && facetoface_has_session_started($session, $timenow) && facetoface_is_session_in_progress($session, $timenow)) {
                $status = get_string('sessioninprogress', 'facetoface');
                $sessionstarted = true;
            } else if ($session->datetimeknown && facetoface_has_session_started($session, $timenow)) {
                $status = get_string('sessionover', 'facetoface');
                $sessionstarted = true;
            } else if ($bookedsession && $session->id == $bookedsession->sessionid) {
                $signupstatus = facetoface_get_status($bookedsession->statuscode);
                $status = get_string('status_'.$signupstatus, 'facetoface');
                $isbookedsession = true;
            } else if ($signupcount >= $session->capacity) {
                $status = get_string('bookingfull', 'facetoface');
                $sessionfull = true;
            }

            $sessionrow[] = $status;

            // Options.
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
            } else if (!$sessionstarted and !$bookedsession) {
                if (!facetoface_session_has_capacity($session, $this->context, MDL_F2F_STATUS_WAITLISTED) && !$session->allowoverbook) {
                    $options .= get_string('none', 'facetoface');
                } else {
                    $options .= html_writer::link('signup.php?s='.$session->id.'&backtoallsessions='.$session->facetoface, get_string('signup', 'facetoface'));
                }
            }
            if (empty($options)) {
                $options = get_string('none', 'facetoface');
            }
            $sessionrow[] = $options;

            $row = new html_table_row($sessionrow);

            // Set the CSS class for the row.
            if ($sessionstarted) {
                $row->attributes = array('class' => 'dimmed_text');
            } else if ($isbookedsession) {
                $row->attributes = array('class' => 'highlight');
            } else if ($sessionfull) {
                $row->attributes = array('class' => 'dimmed_text');
            }

            // Add row to table.
            $table->data[] = $row;
        }

        $output .= html_writer::table($table);

        return $output;
    }

    /**
     * Main calendar hook function for rendering the f2f filter controls
     *
     * @return string html
     */
    public function calendar_filter_controls() {
        global $DB, $SESSION;

        // Get fields.
        $fields = $DB->get_records('facetoface_session_field', array('isfilter' => 1));

        $output = '';
        foreach ($fields as $f) {
            $currentval = !empty($SESSION->calendarfacetofacefilter[$f->shortname]) ? $SESSION->calendarfacetofacefilter[$f->shortname] : '';
            $output .= $this->custom_field_chooser($f, $currentval);
        }

        return $output;
    }

    /**
     * Generates a custom field select for a f2f custom field
     *
     * @param int $field
     * @param string $currentval
     *
     * @return string html
     */
    public function custom_field_chooser($field, $currentval) {
        global $DB;

        if (empty($field->isfilter)) {
            return false; // not a filter
        }

        $values = array();
        switch ($field->type) {
        case CUSTOMFIELD_TYPE_TEXT:
            $records = $DB->get_records('facetoface_session_data', array('fieldid' => $field->id), 'data', 'id, data');
            foreach ($records as $record) {
                $values[$record->data] = $record->data;
            }
            break;

        case CUSTOMFIELD_TYPE_SELECT:
        case CUSTOMFIELD_TYPE_MULTISELECT:
            $values = explode(CUSTOMFIELD_DELIMITER, $field->possiblevalues);
            break;

        default:
            return false; // invalid type
        }

        // Build up dropdown list of values
        $options = array();
        if (!empty($values)) {
            foreach ($values as $value) {
                $v = clean_param(trim($value), PARAM_TEXT);
                if (!empty($v)) {
                    $options[s($v)] = format_string($v);
                }
            }
        }

        $nothing = get_string('all');
        $nothingvalue = '';

        $fieldname = "field_$field->shortname";
        $currentval = empty($currentval) ? $nothingvalue : $currentval;

        $dropdown = html_writer::select($options, $fieldname, $currentval, array($nothingvalue => $nothing));

        return format_string($field->name) . ': ' . $dropdown;

    }

    public function setcontext($context) {
        $this->context = $context;
    }
}
?>
