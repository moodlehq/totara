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
 * @author Eugene Venter <eugene@catalyst.net.nz>
 * @author Simon Coggins <simon.coggins@totaralms.com>
 * @package totara
 * @subpackage totara_reportbuilder
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

/**
* Output renderer for totara_reportbuilder module
*/
class totara_reportbuilder_renderer extends plugin_renderer_base {

    /**
     * Renders a table containing user-generated reports and options
     *
     * @param array $reports array of report objects
     * @return string HTML table
     */
    public function user_generated_reports_table($reports=array()) {
        global $CFG;

        if (empty($reports)) {
            return get_string('noreports', 'totara_reportbuilder');
        }

        $tableheader = array(get_string('name', 'totara_reportbuilder'),
                             get_string('source', 'totara_reportbuilder'),
                             get_string('options', 'totara_reportbuilder'));
        $data = array();
        foreach ($reports as $report) {
            $row = array();
            $strsettings = get_string('settings', 'totara_reportbuilder');
            $strdelete = get_string('delete', 'totara_reportbuilder');
            $viewurl = new moodle_url(reportbuilder_get_report_url($report));
            $editurl = new moodle_url('/totara/reportbuilder/general.php', array('id' => $report->id));
            $deleteurl = new moodle_url('/totara/reportbuilder/index.php', array('id' => $report->id, 'd' => 1));

            $row[] = html_writer::link($editurl, format_string($report->fullname)) . ' (' .
                html_writer::link($viewurl, get_string('view')) . ')';

            $src = reportbuilder::get_source_object($report->source);
            $srcname = $src->sourcetitle;
            $row[] = $srcname;

            $settings = $this->output->action_icon($editurl, new pix_icon('/t/edit', $strsettings, 'moodle'));
            $delete = $this->output->action_icon($deleteurl, new pix_icon('/t/delete', $strdelete, 'moodle'));
            $row[] = "{$settings}{$delete}";

            $data[] = $row;
        }

        $reportstable = new html_table();
        $reportstable->summary = '';
        $reportstable->head = $tableheader;
        $reportstable->data = $data;

        return html_writer::table($reportstable);
    }


    /**
     * Renders a table containing embedded reports and options
     *
     * @param array $reports array of report objects
     * @return string HTML table
     */
    public function embedded_reports_table($reports=array()) {
        global $CFG;

        if (empty($reports)) {
            return get_string('noembeddedreports', 'totara_reportbuilder');
        }

        $tableheader = array(get_string('name', 'totara_reportbuilder'),
                             get_string('source', 'totara_reportbuilder'),
                             get_string('options', 'totara_reportbuilder'));
        $strsettings = get_string('settings', 'totara_reportbuilder');
        $strreload = get_string('restoredefaults', 'totara_reportbuilder');
        $embeddedreportstable = new html_table();
        $embeddedreportstable->summary = '';
        $embeddedreportstable->head = $tableheader;
        $embeddedreportstable->data = array();

        $data = array();
        foreach ($reports as $report) {
            $fullname = format_string($report->fullname);
            $viewurl = new moodle_url($report->url);
            $editurl = new moodle_url('/totara/reportbuilder/general.php', array('id' => $report->id));
            $reloadurl = new moodle_url('/totara/reportbuilder/index.php', array('id' => $report->id, 'em' => 1, 'd' => 1));

            $row = array();
            $row[] = html_writer::link($editurl, $fullname) . ' (' .
                html_writer::link($viewurl, get_string('view')) . ')';

            $src = reportbuilder::get_source_object($report->source);
            $srcname = $src->sourcetitle;
            $row[] = $srcname;

            $settings = $this->output->action_icon($editurl, new pix_icon('/t/edit', $strsettings, 'moodle'));
            $reload = $this->output->action_icon($reloadurl, new pix_icon('/t/reload', $strreload, 'moodle'));
            $row[] = "{$settings}{$reload}";

            $data[] = $row;
        }
        $embeddedreportstable->data = $data;

        return html_writer::table($embeddedreportstable);
    }


    /**
     * Renders a table containing reporting activity groups
     *
     * @param array $groups array of group objects
     * @return string HTML table
     */
    public function activity_groups_table($groups) {
        global $USER;

        if (empty($groups)) {
            return html_writer::tag('p', get_string('nogroups', 'totara_reportbuilder'));
        }

        $tableheader = array(get_string('name', 'totara_reportbuilder'),
                             get_string('tag'),
                             get_string('baseitem', 'totara_reportbuilder'),
                             get_string('activities', 'totara_reportbuilder'),
                             get_string('reports', 'totara_reportbuilder'),
                             get_string('options', 'totara_reportbuilder'));

        $data = array();
        foreach ($groups as $group) {
            $row = array();
            $strsettings = get_string('settings', 'totara_reportbuilder');
            $strdelete = get_string('delete', 'totara_reportbuilder');
            $strcron = get_string('refreshdataforthisgroup', 'totara_reportbuilder');

            $settingsurl = new moodle_url('/totara/reportbuilder/groupsettings.php', array('id' => $group->id));
            $settingsattr = array('title' => $strsettings);
            $settings = $this->output->action_icon($settingsurl, new pix_icon('t/edit', $strsettings), null, $settingsattr);

            $deleteurl = new moodle_url('/totara/reportbuilder/groups.php', array('id' => $group->id, 'd' => 1));
            $deleteattr = array('title' => $strdelete);
            $delete = $this->output->action_icon($deleteurl, new pix_icon('t/delete', $strdelete), null, $deleteattr);

            $cronurl = new moodle_url('/totara/reportbuilder/runcron.php', array('group' => $group->id, 'sesskey' => $USER->sesskey));
            $options['height'] = 500;
            $options['width'] = 750;
            $cron = $this->output->action_link($cronurl,
                '<img src="'.$this->output->pix_url('/t/reload').'" alt="'.$strcron.'">',
                new popup_action('click', $cronurl, 'runcron', $options),
                array('title' => $strcron));

            $url = new moodle_url('/totara/reportbuilder/groupsettings.php', array('id' => $group->id));
            $row[] = html_writer::link($url, $group->name);
            //$row[] = $group->preproc;
            $row[] = $group->tagname;

            $url = new moodle_url('/mod/feedback/view.php', array('id' => $group->cmid));
            $row[] = html_writer::link($url, $group->feedbackname);
            $row[] = ($group->numitems === null) ? 0 : $group->numitems;
            $row[] = ($group->numreports === null) ? 0 : $group->numreports;
            $row[] = "$settings &nbsp; $delete &nbsp; $cron";
            $data[] = $row;
        }

        $table = new html_table();
        $table->summary = '';
        $table->head = $tableheader;
        $table->data = $data;

        return html_writer::table($table);
    }


    /**
     * Renders a table containing assigned activities of a reporting activity group
     *
     * @param array $groups array of activity objects
     * @return string HTML table
     */
    public function activity_group_activities_table($activities) {
        if (empty($activities)) {
            return '';
        }

        $tableheader = array(get_string('course'),
                         get_string('feedback'),
                         get_string('lastchecked', 'totara_reportbuilder'),
                         get_string('disabled', 'totara_reportbuilder'));

        $data = array();
        foreach ($activities as $activity) {
            $row = array();
            // print course
            if ($activity->course !== null) {
                $url = new moodle_url('/course/view.php', array('id' => $activity->courseid));
                $row[] = html_writer::link($url, $activity->course);
            } else {
                $row[] = get_string('coursenotset', 'totara_reportbuilder');
            }

            // print feedback name
            $url = new moodle_url('/mod/feedback/view.php', array('id' => $activity->cmid));
            $row[] = html_writer::link($url, $activity->feedback);

            // print when last checked
            if ($activity->lastchecked !== null) {
                $row[] = userdate($activity->lastchecked);
            } else {
                $row[] = get_string('notyetchecked', 'totara_reportbuilder');
            }

            // print if disabled or not
            if ($activity->disabled !== null && $activity->disabled) {
                $row[] = get_string('yes');
            } else {
                $row[] = get_string('no');
            }
            $data[] = $row;
        }
        $table = new html_table();
        $table->summary = '';
        $table->head = $tableheader;
        $table->data = $data;

        return html_writer::table($table);
    }


    /**
     * Renders a table containing reports of a reporting activity group
     *
     * @param array $groups array of report objects
     * @return string HTML table
     */
    public function activity_group_reports_table($reports) {
        if (empty($reports)) {
            return html_writer::tag('p', get_string('noreportscount', 'totara_reportbuilder'));
        }

        echo html_writer::tag('p', get_string('reportcount', 'totara_reportbuilder', count($reports)));

        $tableheader = array(get_string('name'),
                         get_string('options', 'totara_reportbuilder'));
        $data = array();
        foreach ($reports as $report) {
            $row = array();
            $reporturl = reportbuilder_get_report_url($report);
            $row[] = html_writer::link($reporturl, $report->fullname);

            $strsettings = get_string('settings', 'totara_reportbuilder');
            $strdelete = get_string('delete', 'totara_reportbuilder');

            $editurl = new moodle_url('/totara/reportbuilder/general.php', array('id' => $report->id));
            $editattr = array('title' => $strsettings);
            $settings = $this->output->action_icon($editurl, new pix_icon('/t/edit', $strsettings), null, $editattr);
            $deleteurl = new moodle_url('/totara/reportbuilder/index.php', array('id' => $report->id, 'd' => 1));
            $deleteattr = array('title' => $strdelete);
            $delete = $this->output->action_icon($deleteurl, new pix_icon('/t/delete', $strdelete), null, $deleteattr);
            $row[] = "$settings &nbsp; $delete";
            $data[] = $row;
        }
        $table = new html_table();
        $table->summary = '';
        $table->head = $tableheader;
        $table->data = $data;

        return html_writer::table($table);
    }


    /** Prints select box and Export button to export current report.
     *
     * A select is shown if the global settings allow exporting in
     * multiple formats. If only one format specified, prints a button.
     * If no formats are set in global settings, no export options are shown
     *
     * for this to work page must contain:
     * if ($format != '') { $report->export_data($format);die;}
     * before header is printed
     *
     * @param integer $id ID of the report to exported
     * @param integer $sid Saved search ID if a saved search is active (optional)
     * @return No return value but prints export select form
     */
    public function export_select($id, $sid = 0) {
        global $CFG;

        require_once($CFG->dirroot . '/totara/reportbuilder/export_form.php');
        $export = new report_builder_export_form(qualified_me(), compact('id', 'sid'));
        $export->display();
    }

    /** Prints separate buttons to export current report in the allowed
     * formats
     *
     * for this to work page must contain:
     * if ($format != '') { $report->export_data($format);die;}
     * before header is printed
     *
     * @param integer $id ID of the report to exported
     * @param integer $sid Saved search ID if a saved search is active (optional)
     *
     * @return string Returns the code for the export buttons
     */
    public function export_buttons($id, $sid = 0) {
        global $REPORT_BUILDER_EXPORT_OPTIONS;
        $exportoptions = get_config('reportbuilder', 'exportoptions');

        $out = html_writer::start_tag('table') . html_writer::start_tag('tr');
        $sitecontext = context_system::instance();
        foreach ($REPORT_BUILDER_EXPORT_OPTIONS as $option => $code) {
            // specific checks for fusion tables export
            // disabled for now, awaiting new repository/gdrive integration
            if ($option == 'fusion') {
                continue;
            }
            $exporturl = new moodle_url(qualified_me(),
                array('format' => $option, 'id' => $id, 'sid' => $sid));
            // bitwise operator to see if option bit is set
            if (($exportoptions & $code) == $code) {
                $out .= html_writer::start_tag('td');
                $out .= $this->output->single_button(new moodle_url(qualified_me(), array('format' => $option)), get_string('export'.$option, 'totara_reportbuilder'), 'post');
                $out .= html_writer::end_tag('td');
            }
        }
        $out .= html_writer::end_tag('tr') . html_writer::end_tag('table');

        return $out;
    }

    /**
     * Returns a link that takes the user to a page which displays the report
     *
     * @param string $reporturl the url to redirect to
     * @return string HTML to display the link
     */
    public function view_report_link($reporturl) {

        $url = new moodle_url($reporturl);
        return html_writer::link($url, get_string('viewreport', 'totara_reportbuilder'));
    }

    /**
     * Returns a link back to the manage reports page called 'View all reports'
     *
     * Used when editing a single report
     *
     * @return string The HTML for the link
     */
    public function view_all_reports_link() {
        $url = new moodle_url('/totara/reportbuilder/');
        return '&laquo; ' . html_writer::link($url, get_string('allreports', 'totara_reportbuilder'));
    }

    /**
     * Returns a button that when clicked, takes the user to a page where they can
     * save the results of a search for the current report
     *
     * @param int $reportid
     * @return string HTML to display the button
     */
    public function save_button($reportid) {

        $buttonsarray = optional_param_array('submitgroup', null, PARAM_TEXT);
        $search = isset($buttonsarray['addfilter']) ? $buttonsarray['addfilter'] : null;
        if ($search) {
            $params = array('id' => $reportid);
            return $this->output->single_button(new moodle_url('/totara/reportbuilder/save.php', $params), get_string('savesearch', 'totara_reportbuilder'), 'get');
        } else {
            return '';
        }
    }


    /**
     * Returns HTML for a button that lets users show and hide report columns
     * interactively within the report
     *
     * JQuery, dialog code and showhide.js.php should be included in page
     * when this is used (see code in report.php)
     *
     * @param int $reportid
     * @param string $reportshortname the report short name
     * @return string HTML to display the button
     */
    public function showhide_button($reportid, $reportshortname) {
        $js = "var id = {$reportid}; var shortname = '{$reportshortname}';";
        $html = html_writer::script($js);

        // hide if javascript disabled
        $html .= html_writer::start_tag('div', array('class' => 'rb-showhide boxalignright'));
        $html .= html_writer::start_tag('form');
        $html .= html_writer::empty_tag('input', array('type' => 'button',
            'name' => 'rb_showhide_columns',
            'id' => 'show-showhide-dialog',
            'value' => get_string('showhidecolumns', 'totara_reportbuilder'),
            'style' => 'display:none;'));
        $html .= html_writer::end_tag('form');
        $html .= html_writer::end_tag('div');

        return $html;
    }

    /**
     * Print the description of a report
     *
     * @param string $description
     * @param integer $reportid ID of the report the description belongs to
     * @return HTML
     */
    public function print_description($description, $reportid) {

        $sitecontext = context_system::instance();
        $description = file_rewrite_pluginfile_urls($description, 'pluginfile.php', $sitecontext->id, 'totara_reportbuilder', 'report_builder', $reportid);

        $out = '';
        if (isset($description) &&
            trim(strip_tags($description)) != '') {
            $out .= $this->output->box_start('generalbox reportbuilder-description');
            $out .= $description;
            $out .= $this->output->box_end();
        }
        return $out;
    }


    /**
     * Return the appropriate string describing the search matches
     *
     * @param integer $countfiltered Number of records that matched the search query
     * @param integer $countall Number of records in total (with no search)
     *
     * @return string Text describing the number of results
     */
    public function print_result_count_string($countfiltered, $countall) {
        // get pluralisation right
        $resultstr = $countall == 1 ? 'record' : 'records';

        if ($countfiltered == $countall) {
            $heading = get_string('x' . $resultstr, 'totara_reportbuilder', $countall);
        } else {
            $a = new stdClass();
            $a->filtered = $countfiltered;
            $a->unfiltered = $countall;
            $heading = get_string('xofy' . $resultstr, 'totara_reportbuilder', $a);
        }
        return $heading;
    }

    /**
     * Renders a table containing report saved searches
     *
     * @param array $searches array of saved searches
     * @return string HTML table
     */
    public function saved_searches_table($searches) {
        global $CFG;
        $tableheader = array(get_string('name', 'totara_reportbuilder'),
                             get_string('options', 'totara_reportbuilder'));
        $data = array();

        foreach ($searches as $search) {
            $row = array();
            $strdelete = get_string('delete', 'totara_reportbuilder');
            $reporturl = new moodle_url('/totara/reportbuilder/report.php', array('id' => $search->reportid, 'sid' => $search->id));

            $row[] = html_writer::link($reporturl, $search->name );

            $deleteurl = new moodle_url('/totara/reportbuilder/savedsearches.php', array('id' => $search->reportid, 'd' => 1, 'sid' => $search->id));
            $delete = $this->output->action_icon($deleteurl, new pix_icon('/t/delete', $strdelete, 'moodle'));
            $row[] = $delete;
            $data[] = $row;
        }
        $table = new html_table();
        $table->summary = '';
        $table->head = $tableheader;
        $table->data = $data;

        return html_writer::table($table);
    }

}
