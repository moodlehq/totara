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
 * @author Ben Lobo <ben.lobo@kineo.com>
 * @package totara
 * @subpackage cohort
 */

/**
 * Cron job for updating dynamic cohorts
 */

require_once $CFG->dirroot.'/cohort/lib.php';

/**
 * Update dynamic cohorts
 *
 * @return  void
 */
function cohort_cron() {

    mtrace("Updating dynamic cohorts...");

    // Get all dynamic cohorts
    $cohorts = get_records('cohort', 'cohorttype', cohort::TYPE_DYNAMIC);

    if (!empty($cohorts)) {
        // Update the membership for the cohorts
        foreach ($cohorts as $cohort) {

            try {
                cohort_housekeep_dynamic_cohort($cohort);
            }
            catch (Exception $e) {
                // Log it
                mtrace($e->getMessage());
            }
        }
    }

}
