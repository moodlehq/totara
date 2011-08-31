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
 * @author Eugene Venter <eugene@catalyst.net.nz>
 * @package totara
 * @subpackage reportbuilder
 */

require_once('../../../config.php');

/// Check access
require_sesskey();
require_login();
require_capability('local/reportbuilder:managereports', get_context_instance(CONTEXT_SYSTEM));

/// Get params
$action = required_param('action', PARAM_TEXT);
$reportid = required_param('id', PARAM_INT);

switch ($action) {
    case 'add' :
        $filter = required_param('filter', PARAM_TEXT);
        $filter = explode('-', $filter);
        $ftype = $filter[0];
        $fvalue = $filter[1];
        $advanced = optional_param('advanced', 0, PARAM_BOOL);

        /// Prevent duplicates
        $sql = "SELECT id FROM {$CFG->prefix}report_builder_filters f
            WHERE reportid = {$reportid}
            AND type = '{$ftype}'
            AND value = '{$fvalue}'";

        if (get_record_sql($sql)) {
            echo false;
            exit;
        }

        /// Save filter
        $todb = new object();
        $todb->reportid = $reportid;
        $todb->type = $ftype;
        $todb->value = $fvalue;
        $todb->advanced = $advanced;
        $sortorder = get_field('report_builder_filters', 'MAX(sortorder) + 1', 'reportid', $reportid);
        if(!$sortorder) {
            $sortorder = 1;
        }
        $todb->sortorder = $sortorder;

        $id = insert_record('report_builder_filters', $todb);

        echo $id;
        break;
    case 'delete':
        $fid = required_param('fid', PARAM_INT);
        if ($filter = get_record('report_builder_filters', 'id', $fid)) {
            if (delete_records('report_builder_filters', 'id', $fid)) {
                require_once($CFG->dirroot . '/lib/pear/HTML/AJAX/JSON.php'); // required for PHP5.2 JSON support
                echo json_encode((array)$filter);
            } else {
                echo false;
                exit;
            }
        } else {
            echo false;
            exit;
        }
        break;
    case 'movedown':
        $fid = required_param('fid', PARAM_INT);

        $filter = get_record('report_builder_filters', 'id', $fid);
        $sql = "SELECT * FROM {$CFG->prefix}report_builder_filters
            WHERE reportid = {$reportid} AND sortorder > {$filter->sortorder}
            ORDER BY sortorder";
        if (!$lowersibling = get_record_sql($sql, true)) {
            echo false;
            exit;
        }

        $todb = new stdClass;
        $todb->id = $filter->id;
        $todb->sortorder = $lowersibling->sortorder;

        if (!update_record('report_builder_filters', $todb)) {
            echo false;
            exit;
        }

        $todb = new stdClass;
        $todb->id = $lowersibling->id;
        $todb->sortorder = $filter->sortorder;

        if (!update_record('report_builder_filters', $todb)) {
            echo false;
            exit;
        }

        echo "1";
        break;
    case 'moveup':
        $fid = required_param('fid', PARAM_INT);

        $filter = get_record('report_builder_filters', 'id', $fid);
        $sql = "SELECT * FROM {$CFG->prefix}report_builder_filters
            WHERE reportid = {$reportid} AND sortorder < {$filter->sortorder}
            ORDER BY sortorder DESC";
        if (!$uppersibling = get_record_sql($sql, true)) {
            echo false;
            exit;
        }

        $todb = new stdClass;
        $todb->id = $filter->id;
        $todb->sortorder = $uppersibling->sortorder;

        if (!update_record('report_builder_filters', $todb)) {
            echo false;
            exit;
        }

        $todb = new stdClass;
        $todb->id = $uppersibling->id;
        $todb->sortorder = $filter->sortorder;

        if (!update_record('report_builder_filters', $todb)) {
            echo false;
            exit;
        }

        echo "1";
        break;

    default:
        echo '';
        break;
}

exit;

?>
