<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2012 Totara Learning Solutions LTD
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
 * @author Piers Harding <piers@catalyst.net.nz>
 * @package totara
 * @subpackage message
 */

defined('MOODLE_INTERNAL') || die();

class block_totara_alerts extends block_base {
    function init() {
        $this->title = get_string('pluginname', 'block_totara_alerts');
    }

    // only one instance of this block is required
    function instance_allow_multiple() {
      return false;
    } //instance_allow_multiple

    // label and button values can be set in admin
    function has_config() {
      return false;
    } //has_config

    function preferred_width() {
        return 210;
    }

    function get_content() {
        global $CFG, $PAGE, $DB, $OUTPUT;

        //cache block contents
        if ($this->content !== NULL) {
        return $this->content;
        }

        $this->content = new stdClass;

        // initialise jquery requirements
        require_once($CFG->dirroot.'/totara/message/messagelib.php');
        require_once($CFG->dirroot.'/totara/reportbuilder/lib.php');
        require_once($CFG->dirroot.'/totara/core/js/lib/setup.php');

        $code = array();
        $code[] = TOTARA_JS_DIALOG;
        local_js($code);
        $PAGE->requires->js_init_call('M.totara_message.init');

      // just get the alerts for this user
        $total = tm_messages_count('totara_alert', false);
        $this->msgs = tm_messages_get('totara_alert', 'timecreated DESC ', false, true);
        $this->title = get_string('alerts', 'block_totara_alerts');

        if (empty($this->instance)) {
            return $this->content;
        }

        // now build the table of results
        $table = new html_table();
        $table->attributes['class'] = 'fullwidth invisiblepadded';
        if (!empty($this->msgs)) {
            $cnt = 0;
            foreach ($this->msgs as $msg) {
                // status Icon
                $cnt++;

                // user name + link
                $userfrom_link = $CFG->wwwroot.'/user/view.php?id='.$msg->useridfrom;
                $from = $DB->get_record('user', array('id' => $msg->useridfrom));
                $fromname = fullname($from);

                // message creation time
                $when = userdate($msg->timecreated, get_string('strftimedate', 'langconfig'));
                $cssclass = totara_message_cssclass($msg->msgtype);
                $rowbkgd = ($cnt % 2) ? 'shade' : 'noshade';
                $msglink = !empty($msg->contexturl) ? $msg->contexturl : '';
                //build the array of 3 table cell objects
                $cells = array();

                $icon = $OUTPUT->pix_icon('msgicons/' . $msg->icon, format_string($msg->subject), 'totara_core', array('class' => "msgicon {$cssclass}",  'alt'=>format_string($msg->subject)));
                if (!empty($msglink)) {
                    $url = new moodle_url($msglink);
                    $attributes = array('href' => $url);
                    $cellcontent = html_writer::tag('a', $icon, $attributes);
                } else {
                    $cellcontent = $icon;
                }
                $cell = new html_table_cell($cellcontent);
                $cell->attributes['class'] = 'status';
                $cells[] = $cell;

                $text = format_string($msg->subject ? $msg->subject : $msg->fullmessage);
                if (!empty($msglink)) {
                    $url = new moodle_url($msglink);
                    $attributes = array('href' => $url);
                    $cellcontent = html_writer::tag('a', $text, $attributes);
                } else {
                    $cellcontent = $text;
                }
                $cell = new html_table_cell($cellcontent);
                $cell->attributes['class'] = 'statement';
                $cells[] = $cell;

                $moreinfotext = get_string('clickformoreinfo', 'block_totara_alerts');
                $icon = $OUTPUT->pix_icon('i/info', $moreinfotext, 'moodle', array('class'=>'msgicon', 'title' => $moreinfotext, 'alt' => $moreinfotext));
                $detailjs = totara_message_alert_popup($msg->id, null, 'detailalert');
                $url = new moodle_url($msglink);
                $attributes = array('href' => $url, 'id' => "detailalert{$msg->id}-dialog");
                $cellcontent = html_writer::tag('a', $icon, $attributes) . $detailjs;
                $cell = new html_table_cell($cellcontent);
                $cell->attributes['class'] = 'action';
                $cells[] = $cell;
                $row = new html_table_row($cells);
                $row->attributes['class'] = $rowbkgd;
                $table->data[] = $row;
            }
        }

        $count = count($this->msgs);
        if ($count) {
            $this->content->text .= html_writer::tag('p', get_string('showingxofx', 'block_totara_alerts', array('count' => $count, 'total' => $total)));
        }
        else {
            $this->content->text .= html_writer::tag('p', get_string('noalerts', 'block_totara_alerts'));
        }

        $this->content->text .= html_writer::table($table);
        if (!empty($this->msgs)) {
            $url = new moodle_url('/totara/message/alerts.php', array('sesskey' => sesskey()));
            $link = html_writer::link($url, get_string('viewallnot', 'block_totara_alerts'));
            $this->content->footer = html_writer::tag('div', $link, array('class' => 'viewall'));
        }
        return $this->content;
    }
}

?>
