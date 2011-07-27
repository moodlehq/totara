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
 * @author Alastair Munro <alastair.munro@totaralms.com>
 * @author Aaron Barnes <aaron.barnes@totaralms.com>
 * @author Aaron Wells <aaronw@catalyst.net.nz>
 *
 * @package totara
 * @subpackage plan
 */

class block_addtoplan extends block_base {

    function init() {
        $this->title = get_string('blockname', 'block_addtoplan');
        $this->version = 2011052700;
    }

    function get_content() {
        global $CFG, $USER, $COURSE;

        require_once($CFG->dirroot .'/blocks/addtoplan/lib.php');

        if ($this->content !== NULL) {
            return $this->content;
        }

        $this->content = new stdClass;
        $this->content->footer = '';

        // If they're already completed in this course, then we don't need
        // to show this block.
        require_once($CFG->dirroot.'/lib/completion/completion_completion.php');
        $params = array('userid'=>$USER->id, 'course'=>$COURSE->id);
        $completion = new completion_completion($params);
        if($completion->is_complete()){
            $this->content->text = '';
            return $this->content;
        }

        require_once($CFG->dirroot.'/local/plan/lib.php');
        $plans = dp_get_plans($USER->id, array(DP_PLAN_STATUS_UNAPPROVED, DP_PLAN_STATUS_APPROVED));
        if (!is_array($plans)) {
            $plans = array();
        } else {
            $plans = array_keys($plans);
        }

        // If they have no active plan, then we don't need to display this block to them.
        if (!count($plans)){
            $this->content->text = '';
            return $this->content;
        }

        $course_include = $CFG->dirroot . '/local/plan/components/course/course.class.php';
        if (file_exists($course_include)) {
            require_once($course_include);
        } else {
            $this->content->text = '';
            return $this->content;
        }

        require_js(array(
            "{$CFG->wwwroot}/local/js/lib/jquery-1.3.2.min.js",
        ));

        $html  = '<script type="text/javascript">'."\n";
        $html .= '  $(function() {'."\n";
        $html .= '      $(\'#block_addtoplan_text form\').live(\'submit\', function() {'."\n";
        $html .= '          var addurl = \''.$CFG->wwwroot.'/local/plan/components/course/add.php?add='.$COURSE->id.'&fromblock=1&id=\';'."\n\n";
        $html .= '          // Get plan ID'."\n";
        $html .= '          addurl += $(\'#block_addtoplan_text form select\').val();'."\n\n";
        $html .= '          // Add'."\n";
        $html .= '          $(\'#block_addtoplan_text\').load(addurl);'."\n\n";
        $html .= '          return false;'."\n";
        $html .= '      });'."\n";
        $html .= '  });'."\n";
        $html .= '</script>'."\n";
        $html .= get_addtoplan_block_content($COURSE->id, $USER->id);
        $this->content->text = $html;

        return $this->content;
    }

}
?>
