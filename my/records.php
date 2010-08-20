<?php

/**
 * Moodle - Modular Object-Oriented Dynamic Learning Environment
 *          http://moodle.org
 * Copyright (C) 1999 onwards Martin Dougiamas  http://dougiamas.com
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
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
 * @package    moodle
 * @subpackage totara
 * @author     Jonathan Newman <jonathan.newman@catalyst.net.nz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @copyright  (C) 1999 onwards Martin Dougiamas  http://dougiamas.com
 *
 * Displays collaborative features for the current user
 *
 */

    require_once('../config.php');
    require_once($CFG->dirroot.'/local/reportbuilder/lib.php');
    require_once($CFG->dirroot.'/local/reportheading/lib.php');

    require_login();

    global $SESSION,$USER;

    $id             = optional_param('id', null, PARAM_INT);                       // which user to show
    $format         = optional_param('format','',PARAM_TEXT); //export format

    // default to current user
    if(empty($id)) {
        $id = $USER->id;
    }

    if (! $user = get_record('user', 'id', $id)) {
        error('User not found');
    }

    $context = get_context_instance(CONTEXT_SYSTEM);
    // users can only view their own and their staff's pages
    // or if they are an admin
    if ($USER->id != $id && !totara_is_manager($id) && !has_capability('moodle/site:doanything',$context)) {
        error('You cannot view this page');
    }
    if ($USER->id != $id) {
        $strheading = get_string('recordoflearningfor','local').fullname($user, true);
    } else {
        $strheading = get_string('myrecordoflearning', 'local');
    }

    $embed = new object();
    $embed->source = 'competency_evidence';
    $embed->fullname = $strheading;
    $embed->filters = array(); //hide filter block
    $embed->columns = array(
        array(
            'type' => 'competency',
            'value' => 'competencylink',
            'heading' => 'Competency',
        ),
        array(
            'type' => 'competency',
            'value' => 'idnumber',
            'heading' => 'Competency ID',
        ),
        array(
            'type' => 'competency_evidence',
            'value' => 'proficiency',
            'heading' => 'Proficiency',
        ),
        array(
            'type' => 'competency_evidence',
            'value' => 'position',
            'heading' => 'Completed As',
        ),
        array(
            'type' => 'competency_evidence',
            'value' => 'organisation',
            'heading' => 'Completed At',
        ),
        array(
            'type' => 'competency_evidence',
            'value' => 'completeddate',
            'heading' => 'Date',
        ),
        array(
            'type' => 'competency_evidence',
            'value' => 'assessor',
            'heading' => 'Assessor',
        ),
        array(
            'type' => 'competency_evidence',
            'value' => 'assessorname',
            'heading' => 'Assessor Organisation',
        ),
    );
    $embed->contentmode = 0;
    $embed->embeddedparams = array(
        // show report for a specific user
        'userid' => $id,
    );
    $shortname = 'record_of_learning';
    $report = new reportbuilder(null, $shortname, $embed);

    if($format!='') {
        $report->export_data($format);
        die;
    }

    $report->include_js();

    ///
    /// Display the page
    ///

    print_header($strheading, $strheading, build_navigation($strheading));

    echo '<h1>'.$strheading.'</h1>';

    // add heading block
    $heading = new reportheading($id);
    print $heading->display();

    // tab bar
    $currenttab = "competency_evidence";
    include('learning_tabs.php');

    // add competency evidence button
    if(has_capability('moodle/local:updatecompetency',$context)) {
        print '<p>';
        print_single_button($CFG->wwwroot.'/hierarchy/type/competency/evidence/add.php', array('userid' => $user->id, 's' => sesskey(), 'returnurl' => qualified_me()),get_string('addforthisuser','local'));
        print '</p>';
    }

    // display table here
    $fullname = $report->fullname;
    $countfiltered = $report->get_filtered_count();
    $countall = $report->get_full_count();

    // display heading including filtering stats
    if($countfiltered == $countall) {
        print_heading("$countall records.");
    } else {
        print_heading("$countfiltered/$countall records shown.");
    }

    print $report->print_description();

    $report->display_search();

    if($countfiltered>0) {
        print $report->showhide_button();
        $report->display_table();
        print $report->edit_button();
        // export button
        $report->export_select();
    }
   print_footer();

?>
