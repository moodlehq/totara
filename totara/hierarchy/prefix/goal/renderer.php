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
 * @author Nathan Lewis <nathan.lewis@totaralms.com>
 * @package totara
 * @subpackage totara_hierarchy
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');
}

require_once('lib.php');

/**
 * Output renderer for totara_appraisals module
 */
class totara_goal_renderer extends plugin_renderer_base {

    /**
     * Renders a table that allow selection of a frameworks and link to the goals summary report.
     *
     * @param array $goalframeworks array of goal framework objects
     * @return string HTML table
     */
    public function report_frameworks($goalframeworks = array()) {
        if (empty($goalframeworks)) {
            return get_string('goalnoframeworks', 'totara_hierarchy');
        }

        $tableheader = array(get_string('goalframework', 'totara_hierarchy'),
                             get_string('goalcount', 'totara_hierarchy'));

        $goalframeworkstable = new html_table();
        $goalframeworkstable->summary = '';
        $goalframeworkstable->head = $tableheader;
        $goalframeworkstable->data = array();
        $goalframeworkstable->attributes = array('class' => 'generaltable');

        foreach ($goalframeworks as $goalframework) {
            $row = array();

            $summaryurl = new moodle_url('/totara/hierarchy/prefix/goal/summaryreport.php',
                    array('goalframeworkid' => $goalframework->id, 'clearfilters' => 1));
            $row[] = html_writer::link($summaryurl, format_string($goalframework->fullname));

            $goals = goal::get_framework_items($goalframework->id);
            $row[] = html_writer::link($summaryurl, count($goals));

            $goalframeworkstable->data[] = $row;
        }

        // Totals row.
        $row = array();

        $summaryurl = new moodle_url('/totara/hierarchy/prefix/goal/detailsreport.php', array('clearfilters' => 1));
        $row[] = html_writer::link($summaryurl, get_string('goalallframeworks', 'totara_hierarchy'));

        $goals = goal::get_framework_items();
        $row[] = html_writer::link($summaryurl, count($goals));

        $goalframeworkstable->data[] = $row;

        return html_writer::table($goalframeworkstable);
    }


}
