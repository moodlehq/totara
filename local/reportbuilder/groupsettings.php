<?php // $Id$
/*
 * local/reportbuilder/groupsettings.php
 *
 * Page for viewing and editing details about a particular activity groups
 * @copyright Catalyst IT Limited
 * @author Simon Coggins
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package Totara
 */

    require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
    require_once($CFG->libdir.'/adminlib.php');
    require_once($CFG->dirroot.'/local/reportbuilder/lib.php');
    require_once($CFG->dirroot.'/local/reportbuilder/groups_forms.php');
    require_once($CFG->dirroot.'/local/reportbuilder/groupslib.php');

    $id = required_param('id', PARAM_INT); // id of current group

    $returnurl = $CFG->wwwroot.'/local/reportbuilder/groupsettings.php';

    admin_externalpage_setup('activitygroups');

    // ensure tag based grouping is up to date before displaying page
    update_tag_grouping($id);

    $group = get_record('report_builder_group', 'id', $id);
    $tag = get_record('tag', 'id', $group->assignvalue);

    $feedbackmoduleid = get_field('modules', 'id', 'name', 'feedback');
    $sql = "SELECT f.id as feedbackid, f.name as feedback, c.id as courseid,
                c.fullname as course, cm.id as cmid, ppt.disabled, ppt.lastchecked
            FROM {$CFG->prefix}report_builder_group_assign ga
            LEFT JOIN {$CFG->prefix}feedback f ON f.id = CAST(ga.itemid AS INTEGER)
            LEFT JOIN {$CFG->prefix}course c ON f.course = c.id
            LEFT JOIN {$CFG->prefix}course_modules cm
                ON c.id = cm.course
                AND f.id = cm.instance
                AND cm.module = $feedbackmoduleid
            LEFT JOIN {$CFG->prefix}report_builder_preproc_track ppt
                ON ga.itemid = ppt.itemid AND ga.groupid = ppt.groupid
            WHERE ga.groupid = $id
            ORDER BY course, feedback";
    $activities = get_records_sql($sql);
    if(!$activities) {
        $activities = array();
    }

    // get info about current base item
    $sql = "SELECT f.id as feedbackid, f.name as feedback, c.id as courseid,
                c.fullname as course, cm.id as cmid
            FROM {$CFG->prefix}feedback f
            LEFT JOIN {$CFG->prefix}course c ON f.course = c.id
            LEFT JOIN {$CFG->prefix}course_modules cm
                ON c.id = cm.course
                AND f.id = cm.instance
                AND cm.module = $feedbackmoduleid
            WHERE f.id = {$group->baseitem}";
    $baseitem = get_record_sql($sql);

    // find out which reports use this group
    $reports = get_records_select('report_builder', 'source ' . sql_ilike() .
        "'%_grp_" . $id . "'");


    admin_externalpage_print_header();

    print_single_button($CFG->wwwroot . '/local/reportbuilder/groups.php', null,
        get_string('backtoallgroups','local'));

    print_heading(get_string('activitygroupingx','local',$group->name));

    print '<h3>' . get_string('assignedactivities','local') . '</h3>';

    $info = new object();
    $info->count = count($activities);
    $info->tag = $tag->name;
    print '<p>' . get_string('groupcontents', 'local', $info) . '</p>';

    if(count($activities)) {
        $tableheader = array(get_string('course'),
                         get_string('feedback'),
                         get_string('lastchecked','local'),
                         get_string('disabled','local'));

        $data = array();
        foreach($activities as $activity) {
            $row = array();
            // print course
            if($activity->course !== null) {
                $row[] = '<a href="' . $CFG->wwwroot . '/course/view.php?id=' .
                   $activity->courseid . '">' . $activity->course . '</a>';
            } else {
                $row[] = get_string('notset','local');
            }

            // print feedback name
            $row[] = '<a href="' . $CFG->wwwroot . '/mod/feedback/view.php?id=' .
                $activity->cmid . '">' . $activity->feedback . '</a>';

            // print when last checked
            if($activity->lastchecked !== null) {
                $row[] = userdate($activity->lastchecked);
            } else {
                $row[] = get_string('notyetchecked','local');
            }

            // print if disabled or not
            if($activity->disabled !== null && $activity->disabled) {
                $row[] = get_string('yes');
            } else {
                $row[] = get_string('no');
            }
            $data[] = $row;
        }
        $table = new object();
        $table->summary = '';
        $table->head = $tableheader;
        $table->data = $data;
        print_table($table);
    }

    print '<h3>' . get_string('baseactivity','local') . '</h3>';

    $info = new object();
    $info->url = $CFG->wwwroot . '/mod/feedback/view.php?id=' . $baseitem->cmid;
    $info->activity = $baseitem->feedback;
    print '<p>' . get_string('baseitemdesc', 'local', $info) . '</p>';

    print '<h3>' . get_string('reports', 'local') . '</h3>';

    if($reports) {
        print '<p>' . get_string('reportcount', 'local', count($reports)) . '</p>';

        $tableheader = array(get_string('name'),
                         get_string('options','local'));
        $data = array();
        foreach($reports as $report) {
            $row = array();
            if($report->embeddedurl === null) {
                $reporturl = $CFG->wwwroot .
                    '/local/reportbuilder/report.php?id=' . $report->id;
            } else {
                $reporturl = $report->embeddedurl;
            }
            $row[] = '<a href="' . $reporturl . '">' . $report->fullname . '</a>';

            $strsettings = get_string('settings','local');
            $strdelete = get_string('delete','local');

            $settings = '<a href="'.$CFG->wwwroot .
                '/local/reportbuilder/settings.php?id=' . $report->id .
                '" title="' . $strsettings . '">' .
                '<img src="' . $CFG->pixpath . '/t/edit.gif" alt="' .
                $strsettings . '"></a>';
            $delete = '<a href="' . $CFG->wwwroot .
                '/local/reportbuilder/index.php?d=1&amp;id=' . $report->id .
                '" title="' . $strdelete . '">' .
                '<img src="'.$CFG->pixpath . '/t/delete.gif" alt="' .
                $strdelete . '"></a>';
            $row[] = "$settings &nbsp; $delete";
            $data[] = $row;
        }
        $table = new object();
        $table->summary = '';
        $table->head = $tableheader;
        $table->data = $data;
        print_table($table);
    } else {
        print '<p>' . get_string('noreportscount', 'local') . '</p>';
    }

    admin_externalpage_print_footer();

