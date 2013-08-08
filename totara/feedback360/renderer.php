<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2013 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author David Curry <david.curry@totaralms.com>
 * @package totara
 * @subpackage totara_feedback360
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');
}

require_once('lib.php');

/**
 * Output renderer for totara_feedback360s module
 */
class totara_feedback360_renderer extends plugin_renderer_base {

    /**
     * Return a button that when clicked, takes the user to feedback360 creation form
     *
     * @return string HTML to display the button
     */
    public function create_feedback360_button() {
        return $this->output->single_button(new moodle_url('/totara/feedback360/general.php'),
            get_string('createfeedback360', 'totara_feedback360'), 'get');
    }

    public function preview_feedback360_button($feedback360id) {
        $preview_params = array('feedback360id' => $feedback360id, 'preview' => 1);
        $preview_url = new moodle_url('/totara/feedback360/feedback.php', $preview_params);
        $preview_str = get_string('preview', 'totara_feedback360');
        $preview_options = array('class' => 'previewbutton');
        $preview_button = new single_button($preview_url, $preview_str, 'get');
        $preview_button->class = 'previewbutton';
        $preview_button->add_action(new popup_action('click', new moodle_url($preview_url, $preview_params), 'previewpopup', array('height' => 800, 'width' => 1000)));
        return $this->render($preview_button);
    }

    public function request_feedback360_button($userid) {
        $request_params = array('action' => 'form', 'userid' => $userid);
        $request_url = new moodle_url('/totara/feedback360/request.php', $request_params);
        $request_str = get_string('requestfeedback360', 'totara_feedback360');
        $request_options = array('class' => 'requestbutton');
        return $this->output->single_button($request_url, $request_str, 'get', $request_options);
    }

    /**
     * Renders a table containing feedback360s list for manager
     *
     * @param array $feedback360s array of feedback360 object
     * @param int $userid User id to show actions according their rights
     * @return string HTML table
     */
    public function feedback360_manage_table($feedback360s = array(), $userid = null) {
        global $USER, $DB;

        if (!$userid) {
            $userid = $USER->id;
        }

        if (empty($feedback360s)) {
            return get_string('nofeedback360s', 'totara_feedback360');
        }

        $tableheader = array(get_string('name', 'totara_feedback360'),
                             get_string('assignments', 'totara_feedback360'),
                             get_string('status', 'totara_feedback360'),
                             get_string('options', 'totara_feedback360'));

        $feedback360stable = new html_table();
        $feedback360stable->summary = '';
        $feedback360stable->head = $tableheader;
        $feedback360stable->data = array();
        $feedback360stable->attributes = array('class' => 'generaltable fullwidth');

        $stractivate = get_string('activate', 'totara_feedback360');
        $strclose = get_string('close', 'totara_feedback360');
        $strsettings = get_string('settings', 'totara_feedback360');
        $strdelete = get_string('delete', 'totara_feedback360');
        $strclone = get_string('copy', 'moodle');

        $systemcontext = context_system::instance();

        $data = array();
        foreach ($feedback360s as $feedback360) {
            $name = format_string($feedback360->name);
            $activateurl = new moodle_url('/totara/feedback360/activation.php',
                    array('id' => $feedback360->id, 'action' => 'activate'));
            $closeurl = new moodle_url('/totara/feedback360/activation.php',
                    array('id' => $feedback360->id, 'action' => 'close'));
            $editurl = new moodle_url('/totara/feedback360/general.php',
                    array('id' => $feedback360->id));
            $deleteurl = new moodle_url('/totara/feedback360/manage.php',
                    array('id' => $feedback360->id, 'action' => 'delete'));
            $cloneurl = new moodle_url('/totara/feedback360/manage.php',
                    array('id' => $feedback360->id, 'action' => 'copy'));

            $row = array();
            if (has_capability('totara/feedback360:managefeedback360', $systemcontext, $userid)) {
                $row[] = html_writer::link($editurl, $name);
            } else {
                $row[] = $name;
            }

            $assign = new totara_assign_feedback360('feedback360', new feedback360($feedback360->id));
            $countassignments = $assign->get_current_users(null, null, null, true);
            if ($feedback360->status == feedback360::STATUS_DRAFT) {
                $row[] = get_string('assignedtoxdraftusers', 'totara_feedback360', $countassignments);
            } else {
                $row[] = get_string('assignedtoxusers', 'totara_feedback360', $countassignments);
            }
            $row[] = feedback360::display_status($feedback360->status);
            $options = '';
            if (has_capability('totara/feedback360:managefeedback360', $systemcontext, $userid)) {
                $clone = $this->output->action_icon($cloneurl, new pix_icon('/t/copy', $strclone, 'moodle'));
                if ($feedback360->status == feedback360::STATUS_ACTIVE) {
                    $edit_error = get_string('error:feedback360noteditable', 'totara_feedback360');
                    $edit = ' ' . $this->output->pix_icon('/t/edit_gray', $edit_error) . ' ';

                    $delete_error = get_string('error:feedback360isactive', 'totara_feedback360');
                    $delete = ' ' . $this->output->pix_icon('/t/delete_gray', $delete_error) . ' ';
                } else {
                    $edit = $this->output->action_icon($editurl, new pix_icon('/t/edit', $strsettings, 'moodle'));
                    $delete = $this->output->action_icon($deleteurl, new pix_icon('/t/delete', $strdelete, 'moodle'));
                }

                $options .= $edit;
                $options .= $clone;
                $options .= $delete;
            }

            $activate = '';
            if (has_capability('totara/feedback360:manageactivation', $systemcontext, $userid)) {
                if ($feedback360->status == feedback360::STATUS_ACTIVE) {
                    $activate = $this->output->action_link($closeurl, $strclose);
                } else if ($feedback360->status == feedback360::STATUS_DRAFT) {
                    $activate = $this->output->action_link($activateurl, $stractivate);
                }
            }
            $row[] = $options . ' ' . $activate;

            $data[] = $row;
        }
        $feedback360stable->data = $data;

        return html_writer::table($feedback360stable);

    }

    /**
     * Returns a table showing the currently assigned groups of users
     *
     * @param array $assignments group assignment info
     * @param int $itemid the id of the feedback360 object users are assigned to
     * @return string HTML
     */
    public function display_assigned_groups($assignments, $itemid) {
        $tableheader = array(get_string('assigngrouptype', 'totara_feedback360'),
                             get_string('assignsourcename', 'totara_feedback360'),
                             get_string('assignincludechildren', 'totara_feedback360'),
                             get_string('assignnumusers', 'totara_feedback360'),
                             get_string('actions'));

        $feedback360 = new feedback360($itemid);

        $table = new html_table();
        $table->attributes['class'] = 'fullwidth generaltable';
        $table->summary = '';
        $table->head = $tableheader;
        $table->data = array();
        if (empty($assignments)) {
            $table->data[] = array(get_string('nogroupassignments', 'totara_feedback360'));
        } else {
            foreach ($assignments as $assign) {
                $includechildren = ($assign->includechildren == 1) ? get_string('yes') : get_string('no');
                $row = array();
                $row[] = new html_table_cell($assign->grouptypename);
                $row[] = new html_table_cell($assign->sourcefullname);
                $row[] = new html_table_cell($includechildren);
                $row[] = new html_table_cell($assign->groupusers);
                // Only show delete if feedback360 is draft status.
                if ($feedback360->status == feedback360::STATUS_DRAFT) {
                    $delete = $this->output->action_icon(
                            new moodle_url('/totara/feedback360/assignments.php',
                                array('id' => $itemid, 'deleteid' => $assign->id)),
                            new pix_icon('t/delete', get_string('delete')));
                    $row[] = new html_table_cell($delete);
                } else {
                    $row[] = '';
                }
                $table->data[] = $row;
            }
        }
        $out = $this->output->container(html_writer::table($table), 'clearfix', 'assignedgroups');
        return $out;
    }

    /**
     * Display feedback header.
     *
     * @param feedback360_responder $resp
     * @return string HTML
     */
    public function display_feedback_header(feedback360_responder $resp) {
        global $DB, $CFG, $USER;
        $subjectuser = $DB->get_record('user', array('id' => $resp->subjectid));

        // The heading.
        $a = new stdClass();
        $a->username = fullname($subjectuser);
        $a->userid = $subjectuser->id;
        $a->site = $CFG->wwwroot;

        if (isguestuser()) {
            $titlestr = 'userheaderfeedbackwolinks';
        } else if ($resp->is_fake() || $subjectuser->id != $USER->id) {
            $titlestr =  'userheaderfeedback';
        } else {
            $titlestr =  'userownheaderfeedback';
        }


        $r = new html_table_row(array($this->output->user_picture($subjectuser, array('link' => false)),
            get_string($titlestr, 'totara_feedback360', $a)));

        $t = new html_table();
        $t->attributes['class'] = 'invisiblepadded viewing-xs-feedback360';
        $t->data[] = $r;
        $save = '';

        if (!$resp->is_completed() && !$resp->is_fake()) {
            $savebutton = new single_button(new moodle_url('#'), get_string('saveprogress', 'totara_feedback360'));
            $savebutton->formid = 'saveprogress';
            $save = html_writer::tag('div', $this->output->render($savebutton), array('class' => 'feedback360-save'));
        }

        $out = html_writer::tag('div', '', array('class' => "empty", 'id' => 'feedbackhead-anchor'));
        $out .= html_writer::tag('div', $save.html_writer::table($t), array('class' => "plan_box notifymessage",
            'id' => 'feedbackhead'));

        return $out;
    }

    public function display_preview_feedback_header(feedback360_responder $resp) {
        global $DB, $CFG, $USER;

        /*
        $sql = "SELECT fb.name
                FROM {feedback360_user_assignment} ua
                JOIN {feedback360} fb
                ON ua.feedback360id = fb.id
                WHERE ua.id = :uaid";
        $feedbackname = $DB->get_field_sql($sql, array('uaid' => $resp->feedback360userassignmentid));
         */
        $feedbackname = $DB->get_field_select('feedback360', 'name', 'id = :fbid', array('fbid' => $resp->feedback360id));

        $headerstr = get_string('previewheader', 'totara_feedback360', $feedbackname);
        $subheader = get_string('previewsubheader', 'totara_feedback360');

        $rows = array();
        $rows[] = new html_table_row(array($this->output->heading($headerstr)));
        $rows[] = new html_table_row(array($subheader));

        $table = new html_table();
        $table->attributes['class'] = 'invisiblepadded viewing-xs-feedback360';
        $table->data = $rows;

        $out = html_writer::tag('div', '', array('class' => "empty", 'id' => 'feedbackhead-anchor'));
        $out .= html_writer::tag('div', html_writer::table($table), array('class' => "plan_box notifymessage",
            'id' => 'feedbackhead'));

        return $out;
    }

    /**
     * Returns the base markup for a paginated user table widget
     *
     * @return string HTML
     */
    public function display_user_datatable() {
        $table = new html_table();
        $table->id = 'datatable';
        $table->attributes['class'] = 'clearfix';
        $table->head = array(get_string('learner'),
                             get_string('assignedvia', 'totara_core'),
                             );
        $out = $this->output->container(html_writer::table($table), 'clearfix', 'assignedusers');
        return $out;
    }


    /**
     * Get status name and call to action
     *
     * @param int $status
     * @param int $id
     * @return string
     */
    public function feedback360_additional_actions($status, $id) {
        $activateurl = new moodle_url('/totara/feedback360/activation.php', array('id' => $id, 'action' => 'activate'));
        $closeurl = new moodle_url('/totara/feedback360/activation.php', array('id' => $id, 'action' => 'close'));

        $strstatusnow = feedback360::display_status($status);
        $strstatusat = get_string('statusat', 'totara_feedback360');
        $feedback360 = new feedback360($id);

        $preview = $this->preview_feedback360_button($id);

        if ($feedback360->status == feedback360::STATUS_ACTIVE) {
            $activate = $this->output->action_link($closeurl, get_string('closenow', 'totara_feedback360'));
        } else if ($feedback360->status == feedback360::STATUS_DRAFT || $feedback360->status == feedback360::STATUS_CLOSED) {
            $activate = $this->output->action_link($activateurl,  get_string('activatenow', 'totara_feedback360'));
        } else {
            $activate = '';
        }

        $out = '';
        $out .= html_writer::start_tag('div', array('class' => 'additional_actions'));
        $out .= $strstatusat;
        $out .= $strstatusnow . ' ';
        $out .= $activate;
        $out .= $preview;
        $out .= html_writer::end_tag('div');

        return $out;
    }

    /**
     * Confirm feedback360 delete
     *
     * @param feedback360 $feedback360
     * @return string
     */
    public function confirm_delete_feedback360 (feedback360 $feedback360) {
        $out = '';

        $msg = get_string('deletefeedback360s', 'totara_feedback360', $feedback360->name);

        // TODO - make this check assignments and question lists.
        if ($feedback360->status != feedback360::STATUS_DRAFT) {
            $msg .= html_writer::empty_tag('br');
            $msg .= get_string('deletefeedback360questions', 'totara_feedback360');
            $msg .= html_writer::empty_tag('br');
            $msg .= get_string('deletefeedback360assignments', 'totara_feedback360');
        }

        $params = array('action' => 'delete',
                        'confirm' => 1,
                        'id' => $feedback360->id,
                        'sesskey' => sesskey(),
                  );

        $continue = new moodle_url('/totara/feedback360/manage.php', $params);
        $cancel = new moodle_url('/totara/feedback360/manage.php');

        return $this->output->confirm($msg, $continue, $cancel);
    }

    /**
     * Confirm feedback360 quesiton delete
     *
     * @param feedback360_question $question
     * @return string
     */
    public function confirm_question_delete(feedback360_question $question) {
        $out = '';

        $msg = get_string('confirmdeletequestion', 'totara_feedback360', $question->name);

        $params = array('action' => 'delete',
                        'confirm' => 1,
                        'id' => $question->id,
                        'feedback360id' => $question->feedback360id,
                        'sesskey' => sesskey(),
                  );

        $continue = new moodle_url('/totara/feedback360/content.php', $params);
        $cancel = new moodle_url('/totara/feedback360/content.php', array('feedback360id' => $question->feedback360id));

        return $this->output->confirm($msg, $continue, $cancel);
    }

    public function confirm_activation_feedback360 ($feedback360, $errors) {

        if (!empty($errors)) {
            $out = $this->heading(get_string('error:activationconfirmation', 'totara_feedback360'));
            $out .= html_writer::tag('p', get_string('feedback360fixerrors', 'totara_feedback360'));
            $errordesc = array();
            foreach ($errors as $error) {
                $errordesc[] = html_writer::tag('li', $error);
            }
            $out .= html_writer::tag('ul', implode('', $errordesc), array('class' => 'feedback360errorlist'));
            $buttons = array();
            $buttons[] = $this->output->single_button(new moodle_url('/totara/feedback360/content.php',
                    array('feedback360id' => $feedback360->id)), get_string('backtofeedback360', 'totara_feedback360',
                            $feedback360->name), 'get');
            $out .= html_writer::tag('div', implode(' ', $buttons), array('class' => 'buttons'));
            return $out;
        } else {
            $msg = get_string('confirmactivatefeedback360', 'totara_feedback360', $feedback360->name);
            $params = array('id' => $feedback360->id,
                                'action' => 'activate',
                                'confirm' => 1,
                                'sesskey' => sesskey()
                          );

            $continueurl = new moodle_url('/totara/feedback360/activation.php', $params);
            $cancelurl = new moodle_url('/totara/feedback360/manage.php');

            return $this->output->confirm($msg, $continueurl, $cancelurl);
        }
    }

    public function confirm_close_feedback360 ($feedback360) {
        $msg = get_string('confirmclosefeedback360', 'totara_feedback360', $feedback360->name);
        $params = array('id' => $feedback360->id,
                            'action' => 'close',
                            'confirm' => 1,
                            'sesskey' => sesskey()
                      );
        $continueurl = new moodle_url('/totara/feedback360/activation.php', $params);
        $cancelurl = new moodle_url('/totara/feedback360/manage.php');

        return $this->output->confirm($msg, $continueurl, $cancelurl);

    }

    /**
     * Retruns list of questions of particular page
     *
     * @param array $quests of stdClass
     * @return string
     */
    public function list_questions($quests) {
        $list = array();
        if ($quests) {
            $feedback360 = new feedback360(current($quests)->feedback360id);

            $strposition = get_string('reorder', 'totara_question');
            $stredit = get_string('settings', 'totara_question');
            $strdelete = get_string('delete', 'totara_question');
            $strup =  get_string('moveup', 'totara_question');
            $strdown =  get_string('movedown', 'totara_question');
            $last = end($quests);
            $first = reset($quests);

            $questionman = feedback360_question::get_manager();
            $questtypes = $questionman->get_registered_elements();
            foreach ($quests as $quest) {
                $posuplink = $posdownlink = '';
                $attrs['data-questid'] = $quest->id;
                if ($quest->id != $first->id) {
                    $posupurl = new moodle_url('/totara/feedback360/content.php', array('action' => 'posup',
                        'id' => $quest->id, 'feedback360id' => $feedback360->id));
                    $posuplink = $this->output->action_icon($posupurl, new pix_icon('/t/up', $strup, 'moodle'), null,
                            array('class' => 'action-icon js-hide'));
                } else {
                    $attrs['class'] = ' first';
                }
                if ($quest->id != $last->id) {
                    $posdownurl = new moodle_url('/totara/feedback360/content.php', array('action' => 'posdown',
                            'id' => $quest->id, 'feedback360id' => $feedback360->id));
                    $posdownlink = $this->output->action_icon($posdownurl, new pix_icon('/t/down', $strdown, 'moodle'), null,
                            array('class' => 'action-icon js-hide'));
                } else {
                    $attrs['class'] .= ' last';
                }
                $questurl = new moodle_url('/totara/feedback360/content.php', array('feedback360stagepageid' => $quest->id,
                        'feedback360id' => $feedback360->id));
                $editurl = new moodle_url('/totara/feedback360/content.php', array('action' => 'edit',
                    'id' => $quest->id, 'feedback360id' => $feedback360->id));
                $deleteurl = new moodle_url('/totara/feedback360/content.php', array('action' => 'delete',
                    'id' => $quest->id, 'feedback360id' => $feedback360->id));;

                $dragdrop = $this->pix_icon('/i/dragdrop', '', 'moodle', array('class' => 'smallicon js-show-inline move'));
                $editlink = $this->output->action_icon($editurl, new pix_icon('/t/edit', $stredit, 'moodle'), null,
                        array('class' => 'action-icon edit'));
                $deletelink = $this->output->action_icon($deleteurl, new pix_icon('/t/delete', $strdelete, 'moodle'), null,
                        array('class' => 'action-icon delete'));

                $titlename = ($quest->name != '') ? format_string($quest->name) : $questtypes[$quest->datatype]['title'];
                $questname = html_writer::tag('strong', $titlename).'<br/>'.$questtypes[$quest->datatype]['title'];
                $strquest = html_writer::tag('span', $questname, array('class' => 'feedback360-quest-list-name'));

                $actions = '';
                if (feedback360::is_draft($feedback360)) {
                    $actions = html_writer::tag('span', $posuplink.$posdownlink.$dragdrop.$editlink.$deletelink,
                            array('class'=>'feedback360-quest-actions'));
                } else {
                    $actions = html_writer::tag('span', $editlink, array('class'=>'feedback360-quest-actions'));
                }
                $list[] = html_writer::tag('li', $actions.$strquest, $attrs);
            }
            $nav = html_writer::tag('ul', implode($list), array('id'=>'feedback360-quest-list',
                'class' => 'feedback360-quest-list yui-nav'));
            return html_writer::tag('div', $nav, array('class' => 'yui-u first'));
        }
        return '';
    }

    public function myfeedback_user_table($userid) {
        global $DB;

        $out = '';

        $header_cells = array();
        $header_cells['name'] = new html_table_cell(get_string('name', 'totara_feedback360'));
        $header_cells['name']->header = true;
        $header_cells['responses'] = new html_table_cell(get_string('responses', 'totara_feedback360'));
        $header_cells['responses']->header = true;
        $header_cells['duedate'] = new html_table_cell(get_string('duedate', 'totara_feedback360'));
        $header_cells['duedate']->header = true;
        $header_cells['options'] = new html_table_cell(get_string('options', 'totara_feedback360'));
        $header_cells['options']->header = true;

        $header_row = new html_table_row($header_cells);
        $user_table = new html_table();
        $user_table->data[] = $header_row;

        // Join the user assignment to the feedback360 so we have the name later.
        $sql = "SELECT ua.*, fb.name, fb.status
                FROM {feedback360_user_assignment} ua
                JOIN {feedback360} fb
                ON ua.feedback360id = fb.id
                WHERE ua.userid = :uid";

        $user_assignments = $DB->get_records_sql($sql, array('uid' => $userid));
        $nodata = true;
        foreach ($user_assignments as $user_assignment) {
            // Count how many requests for the feedback you have sent.
            $requests = $DB->count_records('feedback360_resp_assignment', array('feedback360userassignmentid' => $user_assignment->id));

            // Count how many replies to your feedback you have recieved.
            $respondsql = "SELECT count(*)
                    FROM {feedback360_resp_assignment} re
                    WHERE re.feedback360userassignmentid = :uaid
                    AND re.timecompleted > 0";
            $responses = $DB->count_records_sql($respondsql, array('uaid' => $user_assignment->id));

            if (!empty($requests)) {
                $nodata = false;
                // Set up some variables for the cells.
                $res = new stdClass();
                $res->total = $requests;
                $res->responded = $responses;

                // The contents of the options column.
                $editparams = array('action' => 'users', 'userid' => $userid, 'formid' => $user_assignment->id, 'update' => 1);
                $editurl = new moodle_url('/totara/feedback360/request.php', $editparams);
                $editstr = get_string('edit');
                $edit = $this->output->action_icon($editurl, new pix_icon('/t/edit', $editstr, 'moodle'));
                $remindparams = array('userformid' => $user_assignment->id);
                $remindurl = new moodle_url('/totara/feedback360/request/remind.php', $remindparams);
                $remindstr = get_string('remind', 'totara_feedback360');
                $remind = $this->output->action_icon($remindurl, new pix_icon('/t/email', $remindstr, 'moodle'));
                $cancelparams = array('userformid' => $user_assignment->id);
                $cancelurl = new moodle_url('/totara/feedback360/request/stop.php', $cancelparams);
                $cancelstr = get_string('stop', 'totara_feedback360');
                $cancel = $this->output->action_icon($cancelurl, new pix_icon('/t/stop', $cancelstr, 'moodle'));

                $duedate = !empty($user_assignment->timedue) ? userdate($user_assignment->timedue, get_string('strftimedate', 'langconfig')) : '';
                $nameurl = new moodle_url('/totara/feedback360/request/view.php', array('userassignment' => $user_assignment->id));
                $namelink = html_writer::link($nameurl, format_string($user_assignment->name));

                if ($user_assignment->status == feedback360::STATUS_ACTIVE) {
                    if ($res->total == $res->responded) {
                        $options = $edit;
                    } else {
                        $options = $edit . $remind . $cancel;
                    }
                } else {
                    $options = get_string('closed', 'totara_feedback360');
                }

                // Set up the row for the table.
                $cells = array();
                $cells['name'] = new html_table_cell($namelink);
                $cells['responses'] = new html_table_cell(get_string('responsecount', 'totara_feedback360', $res));
                $cells['duedate'] = new html_table_cell($duedate);
                $cells['options'] = new html_table_cell($options);

                $row = new html_table_row($cells);
                $user_table->data[] = $row;
            }
        }

        if ($nodata) {
            $cell = new html_table_cell(get_string('nofeedback360requested', 'totara_feedback360'));
            $cell->colspan = count($header_cells);
            $user_table->data[] = new html_table_row(array($cell));
        }

        $out .= html_writer::table($user_table);
        return $out;
    }

    public function myfeedback_colleagues_table($userid) {
        global $DB;

        $out = '';

        $header_cells = array();
        $header_cells['name'] = new html_table_cell(get_string('name', 'totara_feedback360'));
        $header_cells['name']->header = true;
        $header_cells['duedate'] = new html_table_cell(get_string('duedate', 'totara_feedback360'));
        $header_cells['duedate']->header = true;
        $header_cells['options'] = new html_table_cell(get_string('options', 'totara_feedback360'));
        $header_cells['options']->header = true;

        $header_row = new html_table_row($header_cells);
        $colleague_table = new html_table();
        $colleague_table->data[] = $header_row;

        // Join to quest_data_Y so we can tell if it has been completed.
        $sql = "SELECT re.*, ua.feedback360id, ua.timedue, ua.userid as assignedby, u.firstname, u.lastname
                FROM {feedback360_resp_assignment} re
                JOIN {feedback360_user_assignment} ua
                ON re.feedback360userassignmentid = ua.id
                JOIN {user} u
                ON ua.userid = u.id
                WHERE re.userid = :uid";
        $resp_assignments = $DB->get_records_sql($sql, array('uid' => $userid));
        if (empty($resp_assignments)) {
            $cell = new html_table_cell(get_string('nofeedback360togive', 'totara_feedback360'));
            $cell->colspan = count($header_cells);
            $colleague_table->data[] = new html_table_row(array($cell));
        } else {
            foreach ($resp_assignments as $resp_assignment) {
                // Set up some variables for the cells.
                $completed = $resp_assignment->timecompleted;
                $answerurl = new moodle_url('/totara/feedback360/feedback.php', array('userid' => $resp_assignment->assignedby,
                        'feedback360id' => $resp_assignment->feedback360id));
                if (!empty($completed)) {
                    // Complete.
                    $status = get_string('completed', 'totara_feedback360');
                    $options = $this->output->action_link($answerurl, get_string('reviewnow', 'totara_feedback360'));
                } else {
                    $options = $this->output->single_button($answerurl, get_string('answernow', 'totara_feedback360'), 'get');
                    if (empty($resp_assignment->timedue)) {
                        // Infinite time.
                        $status = '';
                    } else if ($resp_assignment->timedue < time()) {
                        // Overdue.
                        $status = get_string('overdue', 'totara_feedback360');
                    } else {
                        // Pending.
                        $status = get_string('pending', 'totara_feedback360');
                    }
                }

                $duedate = !empty($resp_assignment->timedue) ? userdate($resp_assignment->timedue, get_string('strftimedate', 'langconfig')) : '';
                $profileurl = new moodle_url('/user/profile.php', array('id' => $resp_assignment->assignedby));
                $userlink = html_writer::link($profileurl, fullname($resp_assignment), array('class' => 'userlink'));

                // Set up the row for the table.
                $cells = array();
                $cells['name'] = new html_table_cell($userlink);
                $cells['duedate'] = new html_table_cell($duedate . ' ' . $status);
                $cells['options'] = new html_table_cell($options);

                $row = new html_table_row($cells);
                $colleague_table->data[] = $row;
            }
        }
        $out .= html_writer::table($colleague_table);
        return $out;
    }

    public function view_request_infotable($user_assignment) {
        global $DB;

        $out = '';

        $header_cells = array();
        $header_cells['name'] = new html_table_cell(get_string('nameemail', 'totara_feedback360'));
        $header_cells['name']->header = true;
        $header_cells['completed'] = new html_table_cell(get_string('completed', 'totara_feedback360'));
        $header_cells['completed']->header = true;
        $header_cells['response'] = new html_table_cell(get_string('response', 'totara_feedback360'));
        $header_cells['response']->header = true;

        $header_row = new html_table_row($header_cells);
        $request_infotable = new html_table();
        $request_infotable->data[] = $header_row;

        $resp_sql = "SELECT ra.*, u.firstname, u.lastname
                     FROM {feedback360_resp_assignment} ra
                     JOIN {user} u
                     ON ra.userid = u.id
                     WHERE ra.feedback360userassignmentid = :uaid";
        $resp_params = array('uaid' => $user_assignment->id);
        $resp_assignments = $DB->get_records_sql($resp_sql, $resp_params);
        foreach ($resp_assignments as $resp_assignment) {
            if (!empty($resp_assignment->timecompleted)) {
                $comp_str = userdate($resp_assignment->timecompleted, get_string('strftimedate', 'langconfig'));
                $responseparam = array('myfeedback' => 1, 'responseid' => $resp_assignment->id);
                $responseurl = new moodle_url('/totara/feedback360/feedback.php', $responseparam);
                $responselink = html_writer::link($responseurl, get_string('viewresponse', 'totara_feedback360'));
            } else {
                $comp_str = get_string('notcompleted', 'totara_feedback360');
                $responselink = '';
            }

            if (empty($resp_assignment->feedback360emailassignmentid)) {
                $name_str = fullname($resp_assignment);
            } else {
                $param = array('id' => $resp_assignment->feedback360emailassignmentid);
                $name_str = format_string($DB->get_field('feedback360_email_assignment', 'email', $param));
            }

            $cells = array();
            $cells['name'] = new html_table_cell($name_str);
            $cells['completed'] = new html_table_cell($comp_str);
            $cells['response'] = new html_table_cell($responselink);

            $row = new html_table_row($cells);
            $request_infotable->data[] = $row;
        }
        $out .= html_writer::table($request_infotable);
        return $out;
    }

    public function print_system_assignments($userformid) {
        global $DB;

        $out = html_writer::start_tag('div', array('class' => 'existing-system-assignments'));

        $strdelete = get_string('delete');
        $sysparams = array('feedback360userassignmentid' => $formid);
        // Incase we are editing get all existing user_resp.
        $sysassignmentsql = 'SELECT u.*
                              FROM {feedback360_resp_assignment} fra
                              JOIN {user} u
                                  ON fra.userid = u.id
                              WHERE fra.feedback360userassignmentid = ?';
        $sysassignments = $DB->get_records_sql($sysassignmentsql, $sysparams);

        foreach ($sysassignments as $sysassignment) {
            // Skip email assignments.
            if (!empty($sysassignment->feedback360emailassignmentid)) {
                continue;
            } else {
                $deleteurl = new moodle_url('/totara/feedback360/request/delete.php', array('userid' => $sysassignment->id, 'formid' => $userformid));

                $out .= html_writer::start_tag('div', array('class' => 'userassignment'));
                $out .= html_writer::tag(user_fullname($sysassignment));
                $out .= $this->output->action_icon($deleteurl, new pix_icon('/t/delete', $strdelete, 'moodle'));
                $out .= html_writer::end_tag('div');
            }
        }
        $out .= html_writer::end_tag('div');
        return $out;
    }

    /**
     * returns the html for a system user item with delete button.
     *
     * @param object $userid    A user record
     * @param int $userform     The id of the feedback user assignment
     */
    public function system_user_record($user, $userform) {
        global $DB;

        $out = '';
        $username = fullname($user);
        $removestr = get_string('remove');
        $completestr = get_string('alreadyreplied', 'totara_feedback360');
        $deleteparams = array('userid' => $user->id, 'userform' => $userform);
        $deleteurl = new moodle_url('/totara/feedback360/request/delete.php', $deleteparams);

        $resp_params = array('userid' => $user->id, 'feedback360userassignmentid' => $userform);
        $resp = $DB->get_record('feedback360_resp_assignment', $resp_params);

        $out .= html_writer::start_tag('div', array('id' => "system_user_{$user->id}", 'class' => 'user_record'));
        $out .= $username;
        if (!empty($resp->timecompleted)) {
            $out .= $this->output->pix_icon('/t/delete_gray', $completestr);
        } else {
            $out .= $this->output->action_icon($deleteurl, new pix_icon('/t/delete', $removestr), null, array('class' => 'system_record_del', 'id' => $user->id));
        }
        $out .= html_writer::end_tag('div');

        return $out;
    }

    public function external_user_record($email, $userform) {
        global $DB, $CFG;

        $out = '';
        $removestr = get_string('remove');
        $completestr = get_string('alreadyreplied', 'totara_feedback360');
        $deleteparams = array('userid' => $CFG->siteguest, 'userform' => $userform, 'email' => $email);
        $deleteurl = new moodle_url('/totara/feedback360/request/delete.php', $deleteparams);

        $sql = "SELECT ra.*
                FROM {feedback360_resp_assignment} ra
                JOIN {feedback360_email_assignment} ea
                    ON ra.feedback360emailassignmentid = ea.id
                WHERE ra.feedback360userassignmentid = ?
                AND ea.email = ?";
        $resp = $DB->get_record_sql($sql, array($userform, $email));

        $out .= html_writer::start_tag('div', array('id' => "external_user_{$email}", 'class' => 'external_record'));
        $out .= $email;
        if (!empty($resp->timecompleted)) {
            $out .= $this->output->pix_icon('/t/delete_gray', $completestr);
        } else {
            $out .= $this->output->action_icon($deleteurl, new pix_icon('/t/delete', $removestr), null, array('class' => 'external_record_del', 'id' => $email));
        }
        $out .= html_writer::end_tag('div');

        return $out;
    }
}
