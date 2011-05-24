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
 * @author Simon Coggins <simonc@catalyst.net.nz>
 * @author Alastair Munro <alastair.munro@totaralms.com>
 * @package totara
 * @subpackage dashboard
 */

// This file keeps track of upgrades to
// the dashboard module
//
// Sometimes, changes between versions involve
// alterations to database structures and other
// major things that may break installations.
//
// The upgrade function in this file will attempt
// to perform all the necessary actions to upgrade
// your older installtion to the current version.
//
// If there's something it cannot do itself, it
// will tell you what you need to do.
//
// The commands in here will all be database-neutral,
// using the functions defined in lib/ddllib.php

function xmldb_local_dashboard_upgrade($oldversion=0) {

    global $CFG, $db;

    $result = true;

    if($oldversion < 2011052300) {
        // Remove statistics blocks from learner dashboards
        $sql = "SELECT bi.id FROM
                    {$CFG->prefix}dashb_instance_dashlet dbid
                  JOIN
                    {$CFG->prefix}dashb_instance dbi
                   ON dbid.dashb_instance_id = dbi.id
                  JOIN
                    {$CFG->prefix}dashb db
                   ON dbi.dashb_id = db.id
                  JOIN
                    {$CFG->prefix}block_instance bi
                   ON bi.id = dbid.block_instance_id
                  JOIN
                    {$CFG->prefix}block b
                   ON bi.blockid = b.id
                 WHERE
                    db.shortname = 'mylearning'
                  AND
                    b.name = 'totara_stats'";

        if ($block_instances = get_records_sql($sql)) {
            $instance_ids = implode(',', array_keys($block_instances));

            begin_sql();
            $result = $result && delete_records_select('dashb_instance_dashlet', "block_instance_id IN ({$instance_ids})");
            $result = $result && delete_records_select('block_instance', "id IN ({$instance_ids})");

            if (!$result) {
                rollback_sql();
                return $result;
            }

            commit_sql();
        }
    }

    return $result;
}
