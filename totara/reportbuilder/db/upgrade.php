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

    return true;
}
