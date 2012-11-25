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
 * @author Ciaran Irvine <ciaran.irvine@totaralms.com>
 * @package totara
 * @subpackage program
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

/**
* Standard HTML output renderer for totara_core module
*/
class totara_program_renderer extends plugin_renderer_base {

    /**
    * Generates HTML for a cancel button which is displayed on program
    * management edit screens
    *
    * @param str $url
    * @return str HTML fragment
    */
    public function get_cancel_button($params=null, $url='') {
        if (empty($url)) {
            $url = "/totara/program/edit.php";
        }
        $link = new moodle_url($url, $params);
        $output = $this->output->action_link($link, get_string('cancelprogrammanagement', 'totara_program'), null, array('id' => 'cancelprogramedits'));
        $output .= html_writer::empty_tag('br');
        return $output;
    }

    /**
    * Returns html for the dropdown of different completion events
    *
    * @global array $COMPLETION_EVENTS_CLASSNAMES
    * @param string $name
    * @return string
    */
    public function completion_events_dropdown($name="eventtype") {
        global $COMPLETION_EVENTS_CLASSNAMES;
        // The javascript part of this element was initially factored out
        // and added using jQuery when the page was loaded but this didn't work
        // in IE8 so it was added in here instead.
        $dropdown_options = array();
        foreach ($COMPLETION_EVENTS_CLASSNAMES as $class) {
            $event = new $class();
            $dropdown_options[$event->get_id()] = $event->get_name();
        }
        $out = html_writer::select($dropdown_options, $name, null, null, array('id' => $name, 'class' => $name, 'onchange' => 'handle_completion_selection(this.options[this.selectedIndex].value)'));
        $out .= html_writer::script(prog_assignments::get_completion_events_script($name));
        return $out;
    }

    /**
    * Generates HTML for displaying program status
    *
    * @param object $data - obj used in get_string call
    * @return str HTML fragment
    */
    public function render_current_status($data) {

        $programstatusclass = 'notifymessage';
        if (!empty($data->statusstr)) {
            $programstatusstring = get_string($data->statusstr, 'totara_program');
        } else if ($data->visible) {
            $programstatusstring = get_string('programlive', 'totara_program');
            $programstatusclass = 'notifynotice';
        } else {
            $programstatusstring = get_string('programnotlive', 'totara_program');
        }
        $learnerinfo = html_writer::empty_tag('br') . html_writer::start_tag('span', array('class' => 'assignmentcount'));
        if ($data->exceptions > 0) {
            $learnerinfo .= get_string('learnersassignedexceptions', 'totara_program', $data);
        } else {
            $learnerinfo .= get_string('learnersassigned', 'totara_program', $data);
        }
        $learnerinfo .= html_writer::end_tag('span');
        $out = $this->output->notification($programstatusstring . $learnerinfo, $programstatusclass);

        // This js variable is added so that is available to javascript and can
        // be retrieved and displayed in the dialog when saving the content
        // (see program/program_content.js)
        $out .= html_writer::script('currentassignmentcount = '.$data->assignments.';');
        return $out;
    }
    /**
    * Prints out the html for each assignment category class
    *
    * @param reference object $assignment_class the category class object which called this function
    * @return string html fragment
    */
    public function assignment_category_display($assignment_class, $headers, $buttonname, $data) {
        $categoryclassstr = strtolower(str_replace(' ', '', $assignment_class->name));
        $html = html_writer::start_tag('fieldset', array('class' => 'assignment_category '.$categoryclassstr, 'id' => 'category-'. $assignment_class->id));
        $html .= html_writer::start_tag('legend') . $assignment_class->name .  html_writer::end_tag('legend');
        $table = new html_table();
        $table->attributes['class'] = 'fullwidth';
        $colcount = 0;
        // Add the headers
        foreach ($headers as $header) {
            $headerclassstr = strtolower(str_replace(' ', '', $header));
            $headerclassstr = strtolower(str_replace('#', '', $headerclassstr));
            $cell = new html_table_cell($header);
            $cell->attributes['class'] = $headerclassstr.' col'.$colcount;
            $table->head[] = $cell;
            $colcount++;
        }

        // And the main data
        if (!empty($data)) {
            foreach ($data as $row) {
                $colcount = 0;
                $cells = array();
                foreach ($row as $cell) {
                    $cell = new html_table_cell($cell);
                    $cell->attributes['class'] = 'col'.$colcount;
                    $cells[] = $cell;
                    $colcount++;
                }
                $row = new html_table_row($cells);
                $table->data[] = $row;
            }
        }
        $html .= html_writer::table($table);
        // Add a button for adding new items to the category
        $html .= html_writer::start_tag('button', array('id' => 'add-assignment-' . $assignment_class->id));
        $html .= $buttonname . html_writer::end_tag('button');
        $html .= html_writer::start_tag('div', array('class' => 'total_user_count')) . get_string('total', 'totara_program') . ': ';
        $html .= html_writer::tag('span', '0', array('class' => 'user_count')) . html_writer::end_tag('div');
        $html .= html_writer::end_tag('fieldset');

        return $html;
    }
    /**
    * Generates HTML for edit assignments form
    *
    * @param str $url
    * @return str HTML fragment
    */
    public function display_edit_assignment_form($id, $categories) {
        global $PAGE;
        $dropdown_options = array();
        $out = '';
        $out .= html_writer::start_tag('form', array('name' => 'form_prog_assignments', 'method' => 'post'));
        $out .= html_writer::start_tag('fieldset', array('id' => 'programassignments'));
        $out .= html_writer::tag('legend', get_string('programassignments', 'totara_program'), array('class' => 'ftoggler'));
        $out .= html_writer::tag('p', get_string('instructions:programassignments', 'totara_program'));
        $out .= html_writer::start_tag('div', array('id' => 'assignment_categories'));

        // Display the categories!
        $js = '';
        foreach ($categories as $category) {
            $category->build_table($id);
            if (!$category->has_items()) {
                $dropdown_options[$category->id] = $category->name;
            } else {
                $out .= $category->display();
                $js .= $category->get_js($id);
            }
        }
        if ($js != '') {
            $jsmodule = array(
                'name' => 'totara_programassignment',
                'fullpath' => '/totara/program/assignment/program_assignment.js',
                'requires' => array('json', 'totara_core'));

            $PAGE->requires->js_init_code($js, true, $jsmodule);
        }
        $out .= html_writer::end_tag('div');
        $out .= html_writer::end_tag('fieldset');

        // Display the drop-down if there's any categories that aren't yet being used
        if (!empty($dropdown_options)) {
            $out .= html_writer::start_tag('div', array('id' => 'category_select'));
            $out .= get_string('addnew', 'totara_program');
            $out .= html_writer::select($dropdown_options, 'category_select_dropdown', array('initialvalue' => 1));
            $out .= get_string('toprogram', 'totara_program');
            $out .= html_writer::tag('button', get_string('add'));
            $out .= html_writer::end_tag('div');
        }
        $out .= html_writer::start_tag('div', array('class' => 'overall_total'));
        $out .= $this->output->help_icon('totalassignments', 'totara_program');
        $out .= ' ' . get_string('totalassignments', 'totara_program') . ': ';
        $out .= html_writer::start_tag('span', array('class' => 'total')) . '0' . html_writer::end_tag('span');
        $out .= html_writer::end_tag('div');
        $out .= html_writer::empty_tag('input', array('type' => 'hidden', 'name' => "id", 'value' => $id));
        $out .= html_writer::empty_tag('input', array('type' => 'hidden', 'name' => "sesskey", 'value' => sesskey()));
        $out .= html_writer::empty_tag('input', array('type' => 'submit', 'name' => "savechanges", 'value' => get_string('savechanges'), 'class' => 'savechanges-overview program-savechanges'));
        $out .= html_writer::end_tag('form');
        return $out;
    }

    /**
    * Display the user message box
    *
    * @access public
    * @param  userpic object   userpic class containing user data
    * @param  a object   data for get_string
    * @return string $out    HTML fragment
    */
    public function display_user_message_box($userpic, $a) {
        $table = new html_table();
        $table->attributes = array('border' => '0', 'width' => '100%');
        $cells = array();
        $cell = new html_table_cell($this->output->user_picture($userpic));
        $cell->attributes['width'] = '50';
        $cells[] = $cell;
        $cell = new html_table_cell(html_writer::start_tag('strong') . get_string('youareviewingxsrequiredlearning', 'totara_program', $a) . html_writer::end_tag('strong'));
        $cells[] = $cell;
        $table->data[] = new html_table_row($cells);

        $out = html_writer::start_tag('div', array('class' => 'plan_box plan_box_plain'));
        $out .= html_writer::table($table);
        $out .= html_writer::end_tag('div');
        return $out;
    }
    /**
    * Print a description of a program, suitable for browsing in a list.
    * (This is the counterpart to print_course in /course/lib.php)
    *
    * @param object $data all info required by renderer
    * @return HTML fragment
    */
    public function print_program($data) {
        if ($data->accessible) {
            if ($data->visible) {
                $linkcss = '';
            } else {
                $linkcss = 'dimmed';
            }
        } else {
            if ($data->visible) {
                $linkcss = 'inaccessible';
            } else {
                $linkcss = 'dimmed inaccessible';
            }
        }

        $out = '';
        $out .= html_writer::start_tag('div', array('class' => 'coursebox programbox clearfix'));
        $out .= html_writer::start_tag('div', array('class' => 'info'));
        $out .= html_writer::start_tag('div', array('class' => 'name'));
        $out .= $this->output->pix_icon('/programicons/' . $data->icon, '', 'totara_core');
        $url = new moodle_url('/totara/program/view.php', array('id' => $data->progid));
        $attributes = array('title' => get_string('viewprogram', 'totara_program'), 'class' => $linkcss);
        $linktext = highlight($data->highlightterms, format_string($data->fullname));
        $out .= html_writer::link($url, $linktext, $attributes);
        $out .= html_writer::end_tag('div');
        $out .= html_writer::end_tag('div');
        $out .= html_writer::start_tag('div', array('class' => 'summary'));
        $options = new stdClass();
        $options->noclean = true;
        $options->para = false;
        $out .= highlight($data->highlightterms, format_text($data->summary, FORMAT_MOODLE, $options,  $data->progid));
        $out .= html_writer::end_tag('div');
        $out .= html_writer::end_tag('div');
        return $out;
    }
    /**
    * Generates the HTML to display the current number of exceptions and a link
    * to the exceptions report for the program
    *
    * @param string $url link to exceptions report
    * @param int $excount number of exceptions
    * @return string HTML Fragment
    */
    public function print_exceptions_link($url, $excount) {
        $out = '';
        $out .= html_writer::start_tag('div', array('id' => 'exceptionsreport'));
        $out .= html_writer::start_tag('p');
        $out .= html_writer::start_tag('span', array('class' => 'exceptionscount'));
        $out .= get_string('unresolvedexceptions', 'totara_program', $excount);
        $out .= html_writer::end_tag('span');
        $out .= html_writer::start_tag('span', array('class' => 'exceptionslink'));
        $out .= html_writer::link($url, get_string('viewexceptions', 'totara_program'));
        $out .= html_writer::end_tag('span');
        $out .= html_writer::end_tag('p');
        $out .= html_writer::end_tag('div');
    }
    /**
    * Generates the HTML to display the program search form
    *
    * @param int $programid the program being searched
    * @param string $previoussearch
    * @return string HTML Fragment
    */
    public function print_search($programid, $previoussearch='', $resultcount = 0) {
        $url = new moodle_url('/totara/program/exceptions.php', array('id' => $programid));
        $out = html_writer::start_tag('form', array('action' => $url->out(), 'method' => 'get'));
        $out .= html_writer::tag('label', get_string('searchforindividual', 'totara_program'), array('for' => 'exception_search'));
        $out .= html_writer::empty_tag('input', array('type' => 'text', 'id' => "exception_search", 'name' => 'search', 'value' => $previoussearch));
        $out .= html_writer::empty_tag('input', array('type' => 'hidden', 'name' => "id", 'value' => $programid));
        $out .= html_writer::empty_tag('input', array('type' => 'submit', 'value' => get_string('search')));
        $out .= html_writer::end_tag('form');
        if ($previoussearch != '' && $resultcount > 0) {
            $a = new stdClass();
            $a->count = $resultcount;
            $a->query = $previoussearch;
            $out .= html_writer::tag('p', get_string('xresultsfory', 'totara_core', $a));
        }
        return $out;
    }

    /**
    * Generates the HTML to display the exceptions form
    *
    * @param array $exceptions all exceptions
    * @param array $selectedexceptions currently selected exceptions
    * @param int $selectiontype currently selected value in dropdown
    * @return string HTML Fragment
    */
    public function print_exceptions_form($numexceptions, $numselectedexceptions, $programid, $selectiontype, $tabledata) {
        $out = '';

        if ($numexceptions == 0) {
            $out .= html_writer::start_tag('p') . get_string('noprogramexceptions', 'totara_program') . html_writer::end_tag('p');
        } else {
            $out .= html_writer::start_tag('form', array('name' => 'exceptionsform', 'method' => 'post'));
            $out .= html_writer::empty_tag('input', array('type' => 'hidden', 'name' => "id", 'value' => $programid));
            $out .= html_writer::start_tag('div', array('class' => 'exceptionactions'));

            $out .= $this->get_exceptiontype_selector($selectiontype);

            $out .= $this->get_exceptionaction_selector();

            $out .= html_writer::start_tag('div');
            $out .= html_writer::empty_tag('input', array('type' => 'submit', 'id' => 'applyactionbutton', 'name' => "submit", 'value' => get_string('proceed', 'totara_program')));
            $out .= html_writer::end_tag('div');

            $out .= html_writer::start_tag('div') . html_writer::start_tag('p');
            $out .= html_writer::start_tag('span', array('id' => 'numselectedexceptions')) . $numselectedexceptions . html_writer::end_tag('span') . ' ' .get_string('learnersselected', 'totara_program');
            $out .= html_writer::end_tag('p') . html_writer::end_tag('div');
            $out .= html_writer::end_tag('div');

            $table = new html_table();
            $table->attributes['class'] = 'fullwidth';
            $table->id = 'exceptions';
            $table->head = array(
                get_string('header:hash', 'totara_program'),
                get_string('header:learners', 'totara_program'),
                get_string('header:id','totara_program'),
                get_string('header:issue','totara_program'),
            );

            foreach ($tabledata as $rowdata) {
                $row = array();

                $row[] = html_writer::checkbox("exceptionid", $rowdata->exceptionid, $rowdata->selected);
                $url = new moodle_url('/user/view.php', array('id' => $rowdata->user->id));
                $row[] = html_writer::link($url, fullname($rowdata->user));
                $row[] = '#'.$rowdata->exceptionid;

                html_writer::tag('span', $rowdata->exceptiontype, array('class' => 'type', 'style' => 'display:none;'));
                $row[] = $rowdata->descriptor . html_writer::tag('span', $rowdata->exceptiontype, array('class' => 'type', 'style' => 'display:none;'));
                $table->data[] = $row;
                $table->rowclass[] = 'exceptionrow';
            }

            $out .= html_writer::table($table, true);
            $out .= html_writer::end_tag('form');
        }
        return $out;
    }

    public function get_exceptiontype_selector($selectiontype) {
        global $CFG;

        require_once($CFG->dirroot . '/totara/program/program_exceptions.class.php');

        $out = '';
        $options = array();
        $options[SELECTIONTYPE_NONE] = get_string('select', 'totara_program');
        $options[SELECTIONTYPE_ALL] = get_string('alllearners', 'totara_program');
        $options[SELECTIONTYPE_TIME_ALLOWANCE] = get_string('alltimeallowanceissues', 'totara_program');
        $options[SELECTIONTYPE_ALREADY_ASSIGNED] = get_string('allcurrentlyassignedissues', 'totara_program');
        $options[SELECTIONTYPE_COMPLETION_TIME_UNKNOWN] = get_string('allcompletiontimeunknownissues', 'totara_program');
        $out .= html_writer::start_tag('div');
        $out .= html_writer::select($options, 'selectiontype', $selectiontype, null, array('id' => 'selectiontype'));
        $out .= html_writer::end_tag('div');

        return $out;
    }

    public function get_exceptionaction_selector() {
        global $CFG;

        require_once($CFG->dirroot . '/totara/program/program_exceptions.class.php');

        $out = '';
        $options = array();
        $options[SELECTIONACTION_NONE] = get_string('action', 'totara_program');
        $options[SELECTIONACTION_AUTO_TIME_ALLOWANCE] = get_string('setrealistictimeallowance', 'totara_program');
        $options[SELECTIONACTION_OVERRIDE_EXCEPTION] = get_string('overrideandaddprogram', 'totara_program');
        $options[SELECTIONACTION_DISMISS_EXCEPTION] = get_string('dismissandtakenoaction', 'totara_program');
        $out .= html_writer::start_tag('div');
        $out .= html_writer::select($options, 'selectionaction', null, null, array('id' => 'selectionaction'));
        $out .= html_writer::end_tag('div');

        return $out;
    }

    /**
    * Generates the HTML to display the set_completion page
    *
    * @return string HTML Fragment
    */
    public function display_set_completion() {
        $out = '';
        $out .= html_writer::start_tag('div', array('id' => 'prog-completion-fixed-date'));
        $out .= html_writer::start_tag('label', array('for' => 'completiontime')) . get_string('completeby', 'totara_program') . html_writer::end_tag('label');
        $out .= html_writer::empty_tag('input', array('class' => 'completiontime', 'type' => 'text', 'name' => "completiontime", 'placeholder' => get_string('datepickerplaceholder', 'totara_core')));
        $out .= html_writer::start_tag('button', array('class' => 'fixeddate')) . get_string('setfixedcompletiondate', 'totara_program') . html_writer::end_tag('button');
        $out .= html_writer::end_tag('div');

        $out .= html_writer::start_tag('div', array('id' => 'prog-completion-or-string'));
        $out .= get_string('or', 'totara_program');
        $out .= html_writer::end_tag('div');

        $out .= html_writer::start_tag('div', array('id' => 'prog-completion-relative-date'));
        $out .= get_string('completewithin', 'totara_program');
        $out .= program_utilities::print_duration_selector($prefix = '', $periodelementname = 'timeperiod', $periodvalue = '', $numberelementname = 'timeamount', $numbervalue = '1', $includehours = false);
        $out .= html_writer::empty_tag('br');
        $out .= get_string('of', 'totara_program');
        $out .= $this->completion_events_dropdown();
        $out .= html_writer::empty_tag('input', array('id' => 'instance', 'type' => 'hidden', 'name' => "instance", 'value' => ''));
        $out .= html_writer::link('#', '', array('id' => 'instancetitle'));
        $out .= html_writer::empty_tag('br');
        $out .= html_writer::start_tag('button', array('class' => 'relativeeventtime')) . get_string('settimerelativetoevent', 'totara_program') . html_writer::end_tag('button');
        $out .= html_writer::end_tag('div');

        return $out;
    }

    /**
    * Generates the HTML to display the set__extension page
    *
    * @return string HTML Fragment
    */
    public function display_set_extension() {
        $out = '';
        $out .= html_writer::start_tag('div');
        $out .= html_writer::start_tag('label', array('for' => 'extensiontime')) . get_string('extenduntil', 'totara_program') . html_writer::end_tag('label');
        $out .= html_writer::empty_tag('input', array('class' => 'extensiontime', 'type' => 'text', 'name' => 'extensiontime', 'id' => 'extensiontime', 'size' => '20', 'maxlength' => '10', 'placeholder' => get_string('datepickerplaceholder', 'totara_core')));
        $out .= html_writer::end_tag('div');
        $out .= html_writer::empty_tag('br');

        $out .= html_writer::start_tag('div');
        $out .= html_writer::start_tag('label', array('for' => 'extensionreason')) . get_string('reasonforextension', 'totara_program') . html_writer::end_tag('label');
        $out .= html_writer::empty_tag('input', array('class' => 'extensionreason', 'type' => 'text', 'name' => 'extensionreason', 'id' => 'extensionreason', 'size' => '80', 'maxlength' => '255'));
        $out .= html_writer::end_tag('div');
        return $out;
    }

    /**
    * Generates the HTML to display the program category info table
    * @param object $category all exceptions
    * @param array $programs all exceptions
    * @param bool $depth indentation
    * @param bool $limit calculated from $CFG->maxcategorydepth
    * @param bool $showprograms
    * @param int $programcount total number of programs
    * @return string HTML Fragment
    */
    function prog_print_category_info($category, $programs, $depth, $limit, $showprograms, $programcount) {

        $strsummary = get_string('summary');
        $catlinkcss = $category->visible ? '' : 'dimmed';

        $table = new html_table();
        $table->attributes = array('class' => 'categorylist');
        $cells = array();
        if ($showprograms && $programcount) {
            if ($depth) {
                $indent = $depth*30;
                $rows = count($programs) + 1;
                $cell = new html_table_cell($this->output->spacer(array('height'=>10, 'width'=>$indent)));
                $cell->attributes['class'] = 'category indentation';
                $cell->attributes['rowspan'] = $rows;
                $cell->attributes['valign'] = 'top';
                $cells[] = $cell;
            }
            $cell = new html_table_cell('&nbsp;');
            $cell->attributes['class'] = 'category image';
            $cell->attributes['valign'] = 'top';
            $cells[] = $cell;
            $url = new moodle_url('/course/category.php', array('id' =>$data->progid));
            $attributes = array('class' => $catlinkcss);
            $linktext = format_string($category->name);
            $link = html_writer::link($url, $linktext, $attributes);
            $cell = new html_table_cell($link);
            $cell->attributes['class'] = 'category name';
            $cell->attributes['valign'] = 'top';
            $cells[] = $cell;
            $cell = new html_table_cell('&nbsp;');
            $cell->attributes['class'] = 'category info';
            $cells[] = $cell;
            $table->data[] = new html_table_row($cells);

            if ($programs && $limit) {
                foreach ($programs as $program) {
                    $prog = new program($program->id);
                    if (!$prog->is_accessible($USER)) {
                        continue;
                    }
                    $cells = array();
                    $linkcss = $program->visible ? '' : 'dimmed';
                    $cell = new html_table_cell('&nbsp;');
                    $cell->attributes['valign'] = 'top';
                    $cells[] = $cell;

                    $icon = $this->output->pix_icon('/programicons/' . $program->icon, '', 'totara_core', array('class' => 'iconsmall'));
                    $url = new moodle_url('/totara/program/view.php', array('id' => $program->id));
                    $attributes = array('class' => $linkcss);
                    $linktext = format_string($program->fullname);
                    $link = html_writer::link($url, $linktext, $attributes);
                    $cell = new html_table_cell($icon . $link);
                    $cell->attributes['valign'] = 'top';
                    $cell->attributes['class'] = 'course name';
                    $cells[] = $cell;

                    if ($program->summary) {
                        $url = new moodle_url('/totara/program/info.php', array('id' => $program->id));
                        $image = $this->output->pix_icon('/i/info', $strsummary);
                        $action = new popup_action('click', $url, $strsummary);
                        $icon = $this->output->action_link($url, $image, $action, array('height' => 400, 'width' => 500, 'title' => $strsummary));
                    } else {
                        $icon = $this->output->spacer(array('width' => '18px', 'height' => '16px'));
                    }
                    $cell = new html_table_cell($icon);
                    $cell->attributes['valign'] = 'top';
                    $cell->attributes['align'] = 'right';
                    $cell->attributes['class'] = 'course info';
                    $cells[] = $cell;
                    $table->data[] = new html_table_row($cells);
                }
            }
        } else {
            $cells = array();
            if ($depth) {
                $indent = $depth*20;
                $cell = new html_table_cell($this->output->spacer(array('height'=>10, 'width'=>$indent)));
                $cell->attributes['valign'] = 'top';
                $cell->attributes['class'] = 'category indentation';
                $cells[] = $cell;
            }
            $url = new moodle_url('/course/category.php', array('id' => $category->id));
            $attributes = array('class' => $catlinkcss);
            $linktext = format_string($category->name);
            $link = html_writer::link($url, $linktext, $attributes);
            $cell = new html_table_cell($link);
            $cell->attributes['valign'] = 'top';
            $cell->attributes['class'] = 'category name';
            $cells[] = $cell;

            $content = (count($programs)) ? count($programs) : '';
            $cell = new html_table_cell($content);
            $cell->attributes['valign'] = 'top';
            $cell->attributes['class'] = 'category number';
            $cells[] = $cell;
            $table->data[] = new html_table_row($cells);
        }
        return html_writer::table($table);
    }
}
