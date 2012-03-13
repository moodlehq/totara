<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2012 Totara Learning Solutions LTD
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
 * @author Ciaran Irvine <ciaran.irvine@totaralms.com>
 * @package totara
 * @subpackage totara_core
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

/**
* Standard HTML output renderer for totara_core module
*/
class totara_core_renderer extends plugin_renderer_base {

    /**
    * Displays a count of the number of active users in the last year
    *
    * @param integer $activeusers Number of active users in the last year
    * @return string HTML to output.
    */
    public function totara_print_active_users($activeusers) {
        $output = '';
        $output .= $this->output->box_start('generalbox adminwarning');
        $output .= get_string('numberofactiveusers', 'totara_core', $activeusers);
        $output .= $this->output->box_end();
        return $output;
    }

    /**
     * Displays a link to download error log
     *
     * @param object $latesterror Object containing information about the last site error
     *
     * @return string HTML to output.
     */
    public function totara_print_errorlog_link($latesterror) {
        $output = '';
        $output .= $this->output->box_start('generalbox adminwarning');
        $output .= get_string('lasterroroccuredat', 'totara_core', userdate($latesterror->timeoccured));
        $output .= $this->output->single_button(new moodle_url('/admin/index.php', array('geterrors' => 1)), get_string('downloaderrorlog', 'totara_core'), 'post');
        $output .= $this->output->box_end();
        return $output;
    }

    /**
     * Outputs a block containing totara copyright information
     *
     * @param string $totara_release A totara release version, for inclusion in the block
     *
     * @return string HTML to output.
     */
    public function totara_print_copyright($totara_release) {
        $output = '';
        $output .= $this->output->box_start('generalbox adminwarning totara-copyright');
        $text = get_string('totaralogo', 'totara_core');
        $icon = new pix_icon('logo', $text, 'totara_core',
            array('width' => 253, 'height' => 177, 'class' => 'totaralogo'));
        $url = new moodle_url('http://www.totaralms.com');
        $output .= $this->output->action_icon($url, $icon, null, array('target' => '_blank'));
        $output .= html_writer::empty_tag('br');
        $output .= html_writer::empty_tag('br');
        $text = get_string('version') . ' ' . $totara_release;
        $url = new moodle_url('http://www.totaralms.com');
        $attributes = array('href' => $url, 'target' => '_blank');
        $output .= html_writer::tag('a', $text, $attributes);
        $output .= html_writer::empty_tag('br');
        $output .= html_writer::empty_tag('br');
        $output .= get_string('totaracopyright', 'totara_core');
        $output .= $this->output->box_end();
        return $output;
    }

    /**
    * Returns markup for displaying a progress bar for a user's course progress
    *
    * Optionally with a link to the user's profile if they have the correct permissions
    *
    * @access  public
    * @param   $userid     int
    * @param   $courseid   int
    * @param   $status     int     COMPLETION_STATUS_ constant
    * @return  string html to display
    */
    public function display_course_progress_icon($userid, $courseid, $status) {
        global $COMPLETION_STATUS;

        if (!isset($status) || !array_key_exists($status, $COMPLETION_STATUS)) {
            return '';
        }
        $statusstring = $COMPLETION_STATUS[$status];
        $status = get_string($statusstring, 'completion');
        // Display progress bar
        $content = html_writer::start_tag('span', array('class'=>'coursecompletionstatus'));
        $content .= html_writer::start_tag('span', array('class'=>'completion-' . $statusstring, 'title' => $status));
        $content .= $status;
        $content .= html_writer::end_tag('span');
        $content .= html_writer::end_tag('span');
        // Check if user has permissions to see details
        if (completion_can_view_data($userid, $courseid)) {
            $url = new moodle_url("/blocks/completionstatus/details.php?course={$courseid}&user={$userid}");
            $attributes = array('href' => $url);
            $content = html_writer::tag('a', $content, $attributes);
        }

        return $content;
    }

    /**
    * print out the Totara My Learning nav section
    * @return html_writer::table
    */
    public function print_my_learning_nav() {
        global $USER;

        $usercontext = context_user::instance($USER->id);
        $table = new html_table();
        if (has_capability('totara/plan:accessplan', $usercontext)) {
            $cells = array();
            $text = get_string('developmentplan', 'totara_core');
            $icon = html_writer::empty_tag('img', array('src' => $this->output->pix_url('/i/idp'),
            'alt'=> $text));
            $url = new moodle_url('/totara/plan/index.php');
            $attributes = array('href' => $url);
            $cellcontent = html_writer::tag('a', $icon, $attributes);
            $cell = new html_table_cell($cellcontent);
            $cells[] = $cell;
            //second cell is another link to same location so we can reuse $text and $attributes
            $cellcontent = html_writer::tag('a', $text, $attributes);
            $cell = new html_table_cell($cellcontent);
            $cells[] = $cell;
            $row = new html_table_row($cells);
            $table->data[] = $row;
        }

        $cells = array();
        $text = get_string('bookings', 'totara_core');
        $icon = html_writer::empty_tag('img', array('src' => $this->output->pix_url('/i/bookings'),
                'alt'=> $text));
        $url = new moodle_url('/blocks/facetoface/mysignups.php');
        $attributes = array('href' => $url);
        $cellcontent = html_writer::tag('a', $icon, $attributes);
        $cell = new html_table_cell($cellcontent);
        $cells[] = $cell;
        //second cell is another link to different location
        $url = new moodle_url('/my/bookings.php?userid=' . $USER->id);
        $attributes = array('href' => $url);
        $cellcontent = html_writer::tag('a', $text, $attributes);
        $cell = new html_table_cell($cellcontent);
        $cells[] = $cell;
        $row = new html_table_row($cells);
        $table->data[] = $row;

        if (get_config(NULL, 'idp_showlearnrec') == 2) {
            $cells = array();
            $text = get_string('recordoflearning', 'totara_core');
            $icon = html_writer::empty_tag('img', array('src' => $this->output->pix_url('/i/rol'),
                    'alt'=> $text));
            $url = new moodle_url('/totara/plan/record/courses.php?userid='.$USER->id);
            $attributes = array('href' => $url);
            $cellcontent = html_writer::tag('a', $icon, $attributes);
            $cell = new html_table_cell($cellcontent);
            $cells[] = $cell;
            //second cell is another link to same location so we can reuse $text and $attributes
            $cellcontent = html_writer::tag('a', $text, $attributes);
            $cell = new html_table_cell($cellcontent);
            $cells[] = $cell;
            $row = new html_table_row($cells);
            $table->data[] = $row;
        }
        return html_writer::table($table);
    }

    /**
    * print out the Totara My Team nav section
    * @return html_writer::table
    */
    public function print_my_team_nav($numteammembers) {
        $table = new html_table();
        if (!empty($numteammembers) && $numteammembers > 0) {
            $table = new html_table();
            $cells = array();
            $text = get_string('viewmyteam','totara_core');
            $icon = html_writer::empty_tag('img', array('src' => $this->output->pix_url('/i/teammembers'),
                        'alt'=> $text));
            $url = new moodle_url('/my/teammembers.php');
            $attributes = array('href' => $url);
            $cellcontent = html_writer::tag('a', $icon, $attributes);
            $cell = new html_table_cell($cellcontent);
            $cells[] = $cell;
            $cellcontent = html_writer::tag('a', $text, $attributes);
            $cellcontent .= html_writer::empty_tag('br');
            $cellcontent .= get_string('numberofstaff', 'totara_core', $numteammembers);
            $cell = new html_table_cell($cellcontent);
            $cells[] = $cell;
            $row = new html_table_row($cells);
            $table->data[] = $row;
        }
        return html_writer::table($table);
    }

    /**
    * print out the table of visible reports
    * @param array $reports array of report objects visible to this user
    * @param bool $showsettings if this user is an admin with editing turned on
    * @return html_writer::table
    */
    public function print_report_manager($reports, $showsettings) {

        $counter = 0;
        $table = new html_table();
        $table->attributes['class'] = 'reportmanager';
        foreach ($reports as $report) {
            // show reports user has permission to view, that are not hidden
            $class = ($counter % 2) ? 'noshade' : 'shade';
            $counter++;
            $cells = array();
            $text = format_string($report->fullname);
            $icon = html_writer::empty_tag('img', array('src' => $this->output->pix_url('/i/reports'),
                                'alt'=> $text));
            $url = new moodle_url('/totara/reportbuilder/report.php?id='.$report->id);
            $attributes = array('href' => $url);
            $cellcontent = html_writer::tag('a', $icon, $attributes);
            $cell = new html_table_cell($cellcontent);
            $cell->attributes['class'] = 'icon';
            $cells[] = $cell;
            $url = new moodle_url($report->viewurl);
            $attributes = array('href' => $url);
            $cellcontent = html_writer::tag('a', $text, $attributes);
            // if admin with edit mode on show settings button too
            if ($showsettings) {
                $text = get_string('settings','totara_core');
                $icon = html_writer::empty_tag('img', array('src' => $this->output->pix_url('/t/edit'),
                                                'alt'=> $text));
                $url = new moodle_url('/totara/reportbuilder/general.php?id='.$report->id);
                $attributes = array('href' => $url);
                $cellcontent .= html_writer::tag('a', $icon, $attributes);
            }
            $cell = new html_table_cell($cellcontent);
            $cell->attributes['class'] = 'text';
            $cells[] = $cell;
            $row = new html_table_row($cells);
            $row->attributes['class'] = $class;
            $table->data[] = $row;
        }

        return html_writer::table($table);
    }
    /**
    * Returns markup for displaying saved scheduled reports
    *
    * Optionally without the options column and add/delete form
    * Optionally with an additional sql WHERE clause
    */
    public function print_scheduled_reports($scheduledreports, $showoptions=true) {

        $table = new html_table();
        $table->id = 'scheduled_reports';
        $table->attributes['class'] = 'scheduled-reports generalbox';
        $headers = array();
        $headers[] = get_string('reportname', 'totara_reportbuilder');
        $headers[] = get_string('savedsearch', 'totara_reportbuilder');
        $headers[] = get_string('format', 'totara_reportbuilder');
        $headers[] = get_string('schedule', 'totara_reportbuilder');
        if ($showoptions) {
            $headers[] = get_string('options', 'totara_core');
        }
        $table->head = $headers;

        foreach($scheduledreports as $sched) {
            $cells = array();
            $cells[] = new html_table_cell($sched->fullname);
            $cells[] = new html_table_cell($sched->data);
            $cells[] = new html_table_cell($sched->format);
            $cells[] = new html_table_cell($sched->schedule);
            if ($showoptions) {
                $text = get_string('edit');
                $icon = html_writer::empty_tag('img', array('src' => $this->output->pix_url('/t/edit'),
                                                        'alt' => $text, 'class' =>'iconsmall'));
                $url = new moodle_url('/totara/reportbuilder/scheduled.php?id='.$sched->id);
                $attributes = array('href' => $url);
                $cellcontent = html_writer::tag('a', $icon, $attributes);
                $cellcontent .= ' ';
                $text = get_string('delete');
                $icon = html_writer::empty_tag('img', array('src' => $this->output->pix_url('/t/edit'),
                                                        'alt' => $text, 'class' =>'iconsmall'));
                $url = new moodle_url('/totara/reportbuilder/deletescheduled.php?id='.$sched->id);
                $attributes = array('href' => $url);
                $cellcontent .= html_writer::tag('a', $icon, $attributes);
                $cell = new html_table_cell($cellcontent);
                $cell->attributes['class'] = 'options';
                $cells[] = $cell;
            }
            $row = new html_table_row($cells);
            $table->data[] = $row;
        }

        return html_writer::table($table);
    }

    public function print_my_courses($displaycourses, $userid) {
        global $COMPLETION_STATUS; //required for $this->display_course_progress_icon

        if (count($displaycourses) > 0) {
            $table = new html_table();
            $table->attributes['class'] = 'centerblock';
            //set up table headers
            $headers = array();
            $cell = new html_table_cell(get_string('course'));
            $cell->attributes['class'] = 'course';
            $headers[] = $cell;
            $cell = new html_table_cell(get_string('status'));
            $cell->attributes['class'] = 'status';
            $headers[] = $cell;
            $cell = new html_table_cell(get_string('enrolled', 'totara_core'));
            $cell->attributes['class'] = 'enroldate';
            $headers[] = $cell;
            $cell = new html_table_cell(get_string('started','totara_core'));
            $cell->attributes['class'] = 'startdate';
            $headers[] = $cell;
            $cell = new html_table_cell(get_string('completed','totara_core'));
            $cell->attributes['class'] = 'completeddate';
            $headers[] = $cell;
            $table->head = $headers;
            foreach ($displaycourses as $course) {
                $cells = array();
                // Display deleted courses as unknown
                if ($name != '') {
                    $url = new moodle_url("/course/view.php?id={$course->id}");
                    $attributes = array('href' => $url, 'title' => $course->name);
                    $cellcontent .= html_writer::tag('a', $course->name, $attributes);
                } else {
                    $cellcontent .= get_string('deletedcourse', 'completion');
                }
                $cell = new html_table_cell($cellcontent);
                $cell->attributes['class'] = 'course';
                $cells[] = $cell;

                $completion = $this->display_course_progress_icon($userid, $course->id, $course->status);
                $cell = new html_table_cell($completion);
                $cell->attributes['class'] = 'status';
                $cells[] = $cell;
                $cell = new html_table_cell($course->enroldate);
                $cell->attributes['class'] = 'enroldate';
                $cells[] = $cell;
                $cell = new html_table_cell($course->starteddate);
                $cell->attributes['class'] = 'startdate';
                $cells[] = $cell;
                $cell = new html_table_cell($course->completeddate);
                $cell->attributes['class'] = 'completeddate';
                $cells[] = $cell;
                $row = new html_table_row($cells);
                $table->data[] = $row;
            }
            $content = html_writer::table($table);
            $content .= html_writer::start_tag('div', array('class' => 'allmycourses'));
            $url = new moodle_url('/totara/plan/record/courses.php?userid='.$userid);
            $attributes = array('href' => $url);
            $content .= html_writer::tag('a', get_string('allmycourses','totara_core'), $attributes);
            $content .= html_writer::end_tag('div');
        } else {
            $content = html_writer::start_tag('span', array('class' => 'noenrollments'));
            $content .= get_string('notenrolled','totara_core');
            $content .= html_writer::end_tag('span');
        }

        $output = html_writer::start_tag('div', array('class' => 'mycourses'));
        $output .= html_writer::start_tag('div', array('class' => 'header'));
        $output .= html_writer::start_tag('div', array('class' => 'title'));
        $output .= html_writer::start_tag('h2');
        $output .= get_string('mycoursecompletions','totara_core');
        $output .= html_writer::end_tag('h2');
        $output .= html_writer::end_tag('div');
        $output .= html_writer::end_tag('div');
        $output .= html_writer::start_tag('div', array('class' => 'content'));
        $output .= $content;
        $output .= html_writer::end_tag('div');
        $output .= html_writer::end_tag('div');
        return $output;
    }

    /**
    * Generate markup for search box
    */
    public function print_totara_search($action, $type, $category, $strsearch, $value) {
        $output = html_writer::start_tag('form', array('id'=>'searchtotara', 'action'=>$action, 'method'=>'get'));
        $output .= html_writer::start_tag('fieldset', array('class' => 'coursesearchbox invisiblefieldset'));
        $output .= html_writer::empty_tag('input', array('type'=>'hidden', 'name'=>'viewtype', 'value'=>$type));
        $output .= html_writer::empty_tag('input', array('type'=>'hidden', 'name'=>'category', 'value'=>$category));
        $output .= html_writer::empty_tag('input', array('type'=>'text', 'id' => 'navsearchbox',
                                                        'class' => 'search-box', 'name'=>'search', 'value'=>s($value, true),
                                                        'size' => '20', 'alt' => s($strsearch), 'placeholder' => s($strsearch)
        ));
        $output .= html_writer::empty_tag('input', array('type'=>'submit', 'value'=>get_string('go')));
        $output .= html_writer::end_tag('fieldset');
        $output .= html_writer::end_tag('form');
        return $output;
    }
}
