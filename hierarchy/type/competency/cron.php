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
 * @package   totara
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
 *  2) aggregate competency hierarchy depth levels
 *
 * @return  void
 */
function competency_cron() {
    global $CFG;

    competency_cron_evidence_items();

    // Save time started
    $timestarted = time();

    // Loop through each depth level, lowest levels first, processing individually
    $sql = "
        SELECT
            *
        FROM
            {$CFG->prefix}comp_depth
        ORDER BY
            frameworkid,
            depthlevel DESC
    ";

    if ($rs = get_recordset_sql($sql)) {

        while ($record = rs_fetch_next_record($rs)) {
            // Aggregate this depth level
            competency_cron_aggregate_evidence($timestarted, $record);
        }

        $rs->close();
    }

    // Mark only aggregated evidence as aggregated
    if (debugging()) {
        mtrace('Mark all aggregated evidence as aggregated');
    }

    $sql = "
        UPDATE
            {$CFG->prefix}comp_evidence
        SET
            reaggregate = 0
        WHERE
            reaggregate <= {$timestarted}
        AND reaggregate > 0
    ";

    execute_sql($sql, false);

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
 * @param   $imtestarted    int         Time we started aggregating
 * @param   $depth          object      Depth level record
 * @return  void
 */
function competency_cron_aggregate_evidence($timestarted, $depth) {
    global $CFG, $COMP_AGGREGATION;

    if (debugging()) {
        mtrace('Aggregating competency evidence for depthid '.$depth->id);
    }

    // Grab all competency scale values
    $scale_values = get_records('comp_scale_values');

    // Grab all competency evidence items for a depth level
    //
    // A little discussion on what is happening in this horrendous query:
    // In order to keep the number of queries run down, we try grab everything
    // we need in one query, and in an intelligent order.
    //
    // By running a query for each depth level, starting at the "lowest" depth
    // we are using up-to-date data when aggregating any competencies with children.
    //
    // This query will return a group of rows for every competency a user needs
    // reaggregating in. The SQL knows the user needs reaggregating by looking
    // for a competency_evidence field with the reaggregate field set.
    //
    // The group of rows for each competency/user includes one for each of the
    // evidence items, or child competencies for this competency. If either the
    // evidence item or the child competency has data relating to this particular
    // user's competency state in it, we try grab that data too and add it to the
    // related row.
    //
    // Cols returned:
    // evidenceid = the user's competency evidence record id
    // userid = the userid this all relates to
    // competencyid = the competency id
    // path = the competency's path, shows competency and parents, / delimited
    // aggregationmethod = the competency's aggregation method
    // proficienyexpected = the proficiency scale value for this competencies scale
    // itemid = the competencies evidence item id (if we are selecting an evidence item)
    // itemstatus = the competency evidence item status for this user
    // itemproficiency = the competency evidence item proficiency for this user
    // itemmodified = the competency evidence item's last modified time
    // childid = the competencies child id (this is either a child comp or an evidence item)
    // childmodified = the child competency evidence last modified time
    // childproficieny = the child competency evidence proficieny for this user
    //
    $sql = "
        SELECT DISTINCT
            ce.id AS evidenceid,
            ce.userid,
            c.id AS competencyid,
            c.path,
            c.aggregationmethod,
            cs.proficient AS proficiencyexpected,
            cei.evidenceid AS itemid,
            ceie.status AS itemstatus,
            ceie.proficiencymeasured AS itemproficiency,
            ceie.timemodified AS itemmodified,
            cei.childid AS childid,
            cce.timemodified AS childmodified,
            cce.proficiency AS childproficiency
        FROM
            (
                SELECT
                    id AS evidenceid,
                    competencyid,
                    NULL AS childid
                FROM
                    {$CFG->prefix}comp_evidence_items
                UNION
                SELECT
                    NULL AS evidenceid,
                    parentid AS competencyid,
                    id AS childid
                FROM
                    {$CFG->prefix}comp
                WHERE
                    parentid <> 0
                AND frameworkid = {$depth->frameworkid}
                AND depthid <> {$depth->id}
            ) cei
        INNER JOIN
            {$CFG->prefix}comp c
         ON cei.competencyid = c.id
        INNER JOIN
            {$CFG->prefix}comp_evidence ce
         ON ce.competencyid = c.id
        INNER JOIN
            {$CFG->prefix}comp_scale cs
         ON c.scaleid = cs.id
        LEFT JOIN
            {$CFG->prefix}comp_evidence_items_evidence ceie
         ON cei.evidenceid = ceie.itemid
        AND ce.userid = ceie.userid
        LEFT JOIN
            {$CFG->prefix}comp_evidence cce
         ON cce.competencyid = cei.childid
        AND ce.userid = cce.userid
        WHERE
            ce.reaggregate > 0
        AND ce.reaggregate <= {$timestarted}
        AND ce.manual = 0
        AND c.depthid = {$depth->id}
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
                $item_evidence[] = $record;
            } else {
                // If this record is not for the current user/competency, break out of this loop
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

                // Get proficiency
                $proficiency = max($params->itemproficiency, $params->childproficiency);

                if (!isset($scale_values[$params->proficiencyexpected])) {
                    if (debugging()) {
                        mtrace('Could not find proficiency expected scale value');
                    }

                    $aggregated_status = null;
                    break;
                }

                // Get item's scale value
                if (isset($scale_values[$proficiency])) {
                    $item_value = $scale_values[$proficiency];
                }
                else {
                    $item_value = null;
                }

                // Get the competencies minimum proficiency
                $min_value = $scale_values[$params->proficiencyexpected];

                // Flag to break out of aggregation loop (if we already have enough info)
                $stop_agg = false;

                // Handle different aggregation types
                switch ($params->aggregationmethod) {
                    case $COMP_AGGREGATION['ALL']:
                        // Check for no proficiency, or a higher sortorder (which equals lower item)
                        if (!$item_value || $item_value->sortorder > $min_value->sortorder) {
                            $aggregated_status = null;
                            $stop_agg = true;
                        }
                        else {
                            $aggregated_status = $min_value->id;
                        }

                        break;

                    case $COMP_AGGREGATION['ANY']:
                        // Check for a lower sortorder (which equals higher item)
                        if ($item_value && $item_value->sortorder <= $min_value->sortorder) {
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
        $item_evidence[] = $record;
    }

    // Get total records returned
    if (debugging()) {
        mtrace($rs->RecordCount().' records returned');
    }
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
