<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
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
 * @author Eugene Venter <eugene@catalyst.net.nz>
 * @author Dongsheng Cai <dongsheng@moodle.com>
 * @package totara
 * @subpackage comment
 */

/**
 * comment_manager is helper class to manage moodle comments in admin page (Reports->Comments)
 */
class comment_manager {
    private $perpage;
    function __construct() {
        global $CFG;
        $this->perpage = empty($CFG->commentsperpage) ? 50 : $CFG->commentsperpage;
    }

    /**
     * Return comments by pages
     * @param int $page
     * @return mixed
     */
    function get_comments($page) {
        global $CFG, $USER;
        $params = array();
        if ($page == 0) {
            $start = 0;
        } else {
            $start = $page*$this->perpage;
        }
        $sql = "SELECT c.id, c.contextid, c.itemid, c.commentarea, c.userid, c.content, u.firstname, u.lastname, c.timecreated
            FROM {$CFG->prefix}comments c, {$CFG->prefix}user u
            WHERE u.id=c.userid ORDER BY c.timecreated ASC";

        $comments = array();
        $formatoptions = array('overflowdiv' => true);
        if ($records = get_records_sql($sql, $start, $this->perpage)) {
            foreach ($records as $item) {
                $item->fullname = fullname($item);
                $item->time = userdate($item->timecreated);
                $item->content = format_text($item->content, FORMAT_MOODLE, (object)$formatoptions);
                $comments[] = $item;
                unset($item->firstname);
                unset($item->lastname);
                unset($item->timecreated);
            }
        }

        return $comments;
    }

    private function setup_course($courseid) {
        global $PAGE;
        if (!empty($this->course)) {
            // already set, stop
            return;
        }
        if ($courseid == $COURSE->id) {
            $this->course = $COURSE;
        } else if (!$this->course = get_record('course', 'id', $courseid)) {
            $this->course = null;
        }
    }

    private function setup_plugin($comment) {
        global $DB;
        $this->context = get_context_instance_by_id($comment->contextid);
        if (!is_object($this->context)) {
            return;
        }
        if ($this->context->contextlevel == CONTEXT_BLOCK) {
            if ($block = $DB->get_record('block_instances', array('id'=>$this->context->instanceid))) {
                $this->plugintype = 'block';
                $this->pluginname = $block->blockname;
            }
        }
        if ($this->context->contextlevel == CONTEXT_MODULE) {
            $this->plugintype = 'mod';
            $this->cm = get_coursemodule_from_id('', $this->context->instanceid);
            $this->setup_course($this->cm->course);
            $this->modinfo = get_fast_modinfo($this->course);
            $this->pluginname = $this->modinfo->cms[$this->cm->id]->modname;
        }
    }

    /**
     * Print comments
     * @param int $page
     */
    function print_comments($page=0) {
        global $CFG;
        require_once($CFG->dirroot.'/lib/tablelib.php');

        $count = count_records_sql("SELECT COUNT(*) FROM {$CFG->prefix}comments c");
        $comments = $this->get_comments($page);
        $table = new flexible_table('totara-comments');
        $table->define_headers(array('<label for="selectall">'.get_string('selectall').'</label><input type="checkbox" name="selectall" id="comment_select_all" class="comment-report-selectall" />', get_string('author', 'search'), get_string('content', 'notes'), get_string('action')));
        $table->define_columns(array('selectall', 'author', 'content', 'action'));
        $table->set_attribute('class', 'generaltable commentstable');
        $table->setup();
        $table->data = array();
        $linkbase = $CFG->wwwroot.'/local/comment/index.php?action=delete&sesskey='.sesskey();
        foreach ($comments as $c) {
            $link = $linkbase . '&commentid='. $c->id;
            $this->setup_plugin($c);
            if (!empty($this->plugintype)) {
                $context_url = plugin_callback($this->plugintype, $this->pluginname, FEATURE_COMMENT, 'url', array($c));
            }
            $checkbox = '<input type="checkbox" name="commentids[]" value="'.$c->id.'" />';
            $action = '<a href="'.$link.'">'.get_string('delete').'</a>';
            if (!empty($context_url)) {
                $action .= '<br>';
                $action .= '<a href="'.$context_url.'" target="_blank">'.get_string('commentincontext').'</a>';
            }
            $table->add_data(array($checkbox, $c->fullname, $c->content, $action));
        }
        $table->print_html();
        print_paging_bar($count, $page, $this->perpage, $CFG->wwwroot.'/local/comment/index.php&amp;');
    }

    /**
     * delete a comment
     * @param int $commentid
     */
    public function delete_comment($commentid) {
        global $DB;
        if ($comment = get_record('comments', 'id', $commentid)) {
            delete_records('comments', 'id', $commentid);
            return true;
        }
        return false;
    }
    /**
     * delete comments
     * @param int $commentid
     */
    public function delete_comments($ids) {
        global $DB;
        foreach ($ids as $id) {
            if (is_int((int)$id)) {
                if ($comment = get_record('comments', 'id', $id)) {
                    delete_records('comments', 'id', $comment->id);
                }
            }
        }
        return true;
    }
}
