<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.


/**
 * Cron job for reviewing and aggregating competency evidence
 *
 * @package   mitms
 * @copyright 2009 Catalyst IT Ltd
 * @author    Aaron Barnes <aaronb@catalyst.net.nz>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once $CFG->dirroot.'/hierarchy/type/competency/lib.php';
require_once $CFG->dirroot.'/hierarchy/type/competency/evidence/evidence.php';


/**
 * Update competency evidence
 *
 * The order in which we do things is important
 *  1) update all competency items evidence
 *  2) aggregate and update competency items evidence
 *  3) aggregate competency hierarchy
 *
 * @return  void
 */
function competency_cron() {

    competency_cron_evidence_items();

    competency_cron_aggregate_evidence();
}

/**
 * Run installed competency evidence type's aggregation methods
 *
 * Loop through each installed evidence type and run the
 * cron() method if it exists
 *
 * @return  void
 */
function competency_cron_evidence_items() {

    // Process each evidence type
    global $CFG, $COMPETENCY_EVIDENCE_TYPES;

    foreach ($COMPETENCY_EVIDENCE_TYPES as $type) {

        $object = 'competency_evidence_type_'.$type;
        $source = $CFG->dirroot.'/hierarchy/type/competency/evidenceitem/type/'.$type.'.php';

        if (!file_exists($source)) {
            continue;
        }

        require_once $source;
        $class = new $object();

        // Run the evidence type's cron method, if it has one
        if (method_exists($class, 'cron')) {

            if (debugging()) {
                mtrace('Running '.$object.'->cron()');
            }
            $class->cron();
        }
    }
}

/**
 * Aggregate competency's evidence items
 *
 * @return  void
 */
function competency_cron_aggregate_evidence() {
    global $CFG, $COMP_AGGREGATION;

    if (debugging()) {
        mtrace('Aggregating competency evidence');
    }

    // Save time started
    $timestarted = time();

    // Grab all competency scale values
    $scale_values = get_records('competency_scale_values');

    // Grab all competency evidence items
    $sql = "
        SELECT DISTINCT
            ce.id AS evidenceid,
            c.id AS competencyid,
            cei.id AS itemid,
            ceie.status AS itemstatus,
            ceie.proficiencymeasured AS itemproficiency,
            c.aggregationmethod,
            ceie.userid,
            ceie.timemodified,
            cs.proficient AS proficiencyexpected
        FROM
            {$CFG->prefix}competency_evidence_items cei
        INNER JOIN
            {$CFG->prefix}competency c
         ON cei.competencyid = c.id
        INNER JOIN
            {$CFG->prefix}competency_evidence ce
         ON ce.competencyid = c.id
        INNER JOIN
            {$CFG->prefix}competency_scale cs
         ON c.scaleid = cs.id
        LEFT JOIN
            {$CFG->prefix}competency_evidence_items_evidence ceie
         ON cei.id = ceie.itemid
        AND ce.userid = ceie.userid
        WHERE
            ce.reaggregate > 0
        AND ce.reaggregate <= {$timestarted}
        AND ce.manual = 0
        ORDER BY
            competencyid,
            userid
    ";

    // Check if result is empty
    if (!$rs = get_recordset_sql($sql)) {
        return;
    }

    $current_user = null;
    $current_competency = null;
    $item_evidence = array();

    while (1) {

        // Grab records for current user/competency
        while ($record = rs_fetch_next_record($rs)) {

            // If we are still grabbing the same users evidence
            $record = (object)$record;
            if ($record->userid === $current_user && $record->competencyid === $current_competency) {
                $item_evidence[$record->itemid] = $record;
            } else {
                break;
            }
        }

        // Aggregate
        if (!empty($item_evidence)) {

            if (debugging()) {
                mtrace('Aggregating competency items evidence for user '.$current_user.' for competency '.$current_competency);
            }

            $aggregated_status = null;

            // Check each of the items
            foreach ($item_evidence as $params) {

                // Skip incomplete evidence items
                if ($params->itemproficiency == 0) {
                    continue;
                }

                if (!isset($scale_values[$params->itemproficiency]) || 
                    !isset($scale_values[$params->proficiencyexpected])) {

                    if (debugging()) {
                        mtrace('Could not find scale value');
                    }

                    $aggregated_status = null;
                    break;
                }

                // Get item's evidence scale value
                $evidence_value = $scale_values[$params->itemproficiency];

                // Get the competencies minimum proficiency
                $min_value = $scale_values[$params->proficiencyexpected];

                // Flag to break out of aggregation loop (if we already have enough info)
                $stop_agg = false;

                // Handle different aggregation types
                switch ($params->aggregationmethod) {
                    case $COMP_AGGREGATION['ALL']:
                        if ($evidence_value->sortorder > $min_value->sortorder) {
                            $aggregated_status = null;
                            $stop_agg = true;
                        }
                        else {
                            $aggregated_status = $min_value->id;
                        }

                        break;

                    case $COMP_AGGREGATION['ANY']:
                        if ($evidence_value->sortorder <= $min_value->sortorder) {
                            $aggregated_status = $min_value->id;
                            $stop_agg = true;
                        }

                        break;

                    default:
                        if (debugging()) {
                            mtrace('Aggregation method not supported: '.$params->aggregationmethod);
                            mtrace('Skipping user...');
                            $aggregated_status = null;
                            $stop_agg = true;
                        }
                }

                if ($stop_agg) {
                    break;
                }
            }

            // If aggregated status is not null, update competency evidence
            if ($aggregated_status !== null) {
                if (debugging()) {
                    mtrace('Update proficiency to '.$aggregated_status);
                }

                $cevidence = new competency_evidence(
                    array(
                        'competencyid'  => $current_competency,
                        'userid'        => $current_user
                    )
                );
                $cevidence->update_proficiency($aggregated_status);
            }
        }

        // If this is the end of the recordset, break the loop
        if (!$record) {
            $rs->close();
            break;
        }

        // New/next user, update user details, reset evidence
        $current_user = $record->userid;
        $current_competency = $record->competencyid;
        $item_evidence = array();
        $item_evidence[$record->itemid] = $record;
    }

    // Mark all aggregated evidence as aggregated
    $sql = "
        UPDATE
            {$CFG->prefix}competency_evidence
        SET
            reaggregate = 0
        WHERE
            reaggregate <= {$timestarted}
    ";

    execute_sql($sql, false);
}

/**
 * Aggregate criteria status's as per configured aggregation method
 *
 * @param int $method COMPLETION_AGGREGATION_* constant
 * @param bool $data Criteria completion status
 * @param bool|null $state Aggregation state
 * @return void
 */
function competency_cron_aggregate($method, $data, &$state) {
    if ($method == COMPLETION_AGGREGATION_ALL) {
        if ($data && $state !== false) {
            $state = true;
        } else {
            $state = false;
        }
    } elseif ($method == COMPLETION_AGGREGATION_ANY) {
        if ($data) {
            $state = true;
        } else if (!$data && $state === null) {
            $state = false;
        }
    }
}
