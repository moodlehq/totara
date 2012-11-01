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
 * @author Simon Coggins <simon.coggins@totaralms.com>
 * @package totara
 * @subpackage reportbuilder
 */

require_once($CFG->dirroot.'/totara/core/db/utils.php');

/**
 * Local database upgrade script
 *
 * @param   integer $oldversion Current (pre-upgrade) local db version timestamp
 * @return  boolean $result
 */
function xmldb_totara_reportbuilder_upgrade($oldversion) {
    global $CFG, $DB;
    $dbman = $DB->get_manager(); // loads ddl manager and xmldb classes

    if ($oldversion < 2012071300) {
        // handle renaming of assignment field: description to intro
        foreach (array('columns', 'filters') as $table) {
            $sql = "SELECT rbt.id FROM {report_builder_{$table}} rbt
                JOIN {report_builder} rb
                ON rbt.reportid = rb.id
                WHERE
                (rbt.type = ? AND rbt.value = ? AND rb.source = ?) OR
                (rbt.type = ? AND rbt.value = ? AND rb.source = ?)";
            $items = $DB->get_fieldset_sql($sql, array(
                'assignment', 'description', 'assignment',
                'base', 'description', 'assignmentsummary'));

            if (!empty($items)) {
                list($insql, $inparams) = $DB->get_in_or_equal($items);
                $sql = "UPDATE {report_builder_{$table}} SET value = ? WHERE id {$insql}";
                $params = array_merge(array('intro'), $inparams);
                $DB->execute($sql, $params);
            }
        }
        totara_upgrade_mod_savepoint(true, 2012071300, 'totara_reportbuilder');
    }

    if ($oldversion < 2012071900) {
        require_once($CFG->dirroot . '/totara/reportbuilder/lib.php');
        // rename the aggregated user columns/filters to avoid clashing with standard user fields
        reportbuilder_rename_data('columns', 'course_completion_by_org', 'user', 'fullname', 'user', 'allparticipants');
        reportbuilder_rename_data('filters', 'course_completion_by_org', 'user', 'fullname', 'user', 'allparticipants');
        totara_upgrade_mod_savepoint(true, 2012071900, 'totara_reportbuilder');
    }

    if ($oldversion < 2012073100) {
        // set global setting for financial year
        // default: July, 1
        set_config('financialyear', '0107', 'reportbuilder');
        totara_upgrade_mod_savepoint(true, 2012073100, 'totara_reportbuilder');
    }

    if ($oldversion < 2012081000) {
        // need to migrate saved search data from the database
        // to remove extraneous array that is no longer used
        $searches = $DB->get_recordset('report_builder_saved', null, '', 'id, search');
        foreach ($searches as $search) {
            $todb = new stdClass();
            $todb->id = $search->id;
            $currentfilters = unserialize($search->search);
            $newfilters = array();
            foreach ($currentfilters as $key => $filter) {
                // if the filter contains an array with only the [0] key set
                // assume it is no longer needed and remove it
                $newfilters[$key] = (isset($filter[0]) && count($filter) == 1) ? $filter[0] : $filter;
            }
            $todb->search = serialize($newfilters);
            $DB->update_record('report_builder_saved', $todb);
        }
        $searches->close();
        totara_upgrade_mod_savepoint(true, 2012081000, 'totara_reportbuilder');
    }

    if ($oldversion < 2012112300) {
        // Convert saved searches with status to the new status field
        $filter = 'course_completion-status';

        $like_sql = $DB->sql_like('rs.search', '?');

        $sql = "SELECT rs.id, rs.search
                FROM {report_builder_saved} AS rs
                JOIN {report_builder} AS rb ON rb.id = rs.reportid
                WHERE rb.source = ?
                AND {$like_sql}";

        $params = array('course_completion', '%' . $DB->sql_like_escape($filter) . '%');

        $searches = $DB->get_records_sql($sql, $params);

        require_once($CFG->libdir.'/completion/completion_completion.php');

        foreach ($searches as $search) {
            $todb = new stdClass();
            $todb->id = $search->id;
            $data = unserialize($search->search);

            if (isset($data[$filter])) {
                $options = $data[$filter];
                if (isset($options['operator']) && isset($options['value']) && is_int($options['operator']) && is_string($options['value'])) {
                    $operator = $options['operator'];
                    $value = $options['value'];
                    if (($operator == 1 && $value == '0') || ($operator == 2 && $value == '1')) {
                        // Completion Status is equal to "Not completed" or
                        // Completion Status isn't equal to "Completed"
                        $options['value'] = array(
                            COMPLETION_STATUS_NOTYETSTARTED => "1",
                            COMPLETION_STATUS_INPROGRESS => "1",
                            COMPLETION_STATUS_COMPLETE => "0",
                            COMPLETION_STATUS_COMPLETEVIARPL => "0" );
                    } else if (($operator == 1 && $value == '1') || ($operator == 2 && $value == '0')) {
                        // Completion Status is equal to "Completed" or
                        // Completion Status isn't equal to "Not completed"
                        $options['value'] = array(
                            COMPLETION_STATUS_NOTYETSTARTED => "0",
                            COMPLETION_STATUS_INPROGRESS => "0",
                            COMPLETION_STATUS_COMPLETE => "1",
                            COMPLETION_STATUS_COMPLETEVIARPL => "1" );
                    } else {
                        // not the expected data so leave the data alone
                        continue;
                    }
                    // Set the operator to any of the following
                    $options['operator'] = 1;
                    $data[$filter] = $options;
                    $todb->search = serialize($data);
                    $DB->update_record('report_builder_saved', $todb);
                }
            }
        }
        totara_upgrade_mod_savepoint(true, 2012112300, 'totara_reportbuilder');
    }

    return true;
}
