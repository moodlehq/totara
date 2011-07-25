<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * The comments block
 *
 * @package   block
 * @subpackage comments
 * @copyright 2009 Dongsheng Cai <dongsheng@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// Obviously required
require_once($CFG->dirroot . '/local/comment/lib.php');

class block_comments extends block_base {

    function init() {
        $this->version = 2009072000;
        $this->title = get_string('pluginname', 'block_comments');
    }

    function specialization() {
        // require js for commenting
        comment::init();
    }

    function applicable_formats() {
        return array('all' => true);
    }

    function instance_allow_multiple() {
        return false;
    }

    function instance_allow_config() {
        return true;
    }

    function get_content() {
        global $CFG, $PAGE;
        /*if (!$CFG->usecomments) {
            $this->content->text = '';
            if ($PAGE->user_is_editing()) {
                $this->content->text = get_string('disabledcomments', 'block_comments');
            }
            return $this->content;
        }*/
        if ($this->content !== NULL) {
            return $this->content;
        }
        if (empty($this->instance)) {
            return null;
        }
        $this->content->footer = '';
        $this->content->text = '';
        list($context, $course, $cm) = get_context_info_array($PAGE->context->id);

        $args = new stdClass;
        $args->context   = $PAGE->context;
        $args->course    = $course;
        $args->area      = 'page_comments_block';
        $args->itemid    = 0;
        $args->component = 'block_comments';
        $args->commentsperpage  = !empty($this->config->commentsperpage) ? $this->config->commentsperpage : 15;
        $args->autostart = isset($this->config->autostart) ? $this->config->autostart : 1;
        $args->notoggle  = isset($this->config->autostart) ? $this->config->autostart : 1;
        $args->showcount = isset($this->config->autostart) ? !$this->config->autostart : 0;
        $args->displaycancel = true;
        $comment = new comment($args);
        //$comment->linktext  = get_string('showcomments', 'block_comments').' ('.$comment->count().')';
        $comment->set_view_permission(true);

        $this->content = new stdClass();
        $this->content->text = $comment->output(true);
        $this->content->footer = '';
        return $this->content;
    }
}
