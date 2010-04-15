<?php
/**
 * Moodle - Modular Object-Oriented Dynamic Learning Environment
 *          http://moodle.org
 * Copyright (C) 1999 onwards Martin Dougiamas  http://dougiamas.com
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
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
 * @package    moodle
 * @subpackage local
 * @author     Jonathan Newman <jonathan.newman@catalyst.net.nz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @copyright  Catalyst IT Limited
 *
 * this file should be used for all tao-specific methods
 * and will be included automatically in setup.php along
 * with other core libraries.
 *
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

require_once($CFG->dirroot.'/local/mitms.php');
require_once($CFG->dirroot.'/hierarchy/lib.php');

function mitms_get_user_hierarchy_lineage($id=null, $type=null) {
    global $CFG;
    $lineage = array();

    if ((!empty($id) and !empty($type))) {
        require_once($CFG->dirroot.'/hierarchy/type/'.$type.'/lib.php');
        $hierarchy = new $type();
        $lineage = $hierarchy->get_item_lineage($id);
    }

    return $lineage;
}

function mitms_print_report_heading($columns, $user, $usercustomfields) {

    global $CFG;

    $positions = array();
    $organisations = array();

    if ( $positionassignmentlist = get_records('position_assignment', 'userid', $user->id ) ){
        foreach( $positionassignmentlist as $positionassignment ){
            $positions += mitms_get_user_hierarchy_lineage($positionassignment->positionid, 'position');
            $organisations += mitms_get_user_hierarchy_lineage($positionassignment->organisationid, 'organisation');
        }
    }

//    $organisations = new object();
//    if ($user->organisationid) {
//        $organisations = mitms_get_user_hierarchy_lineage($user->organisationid, 'organisation');
//    }
//    $positionrecs = new object();
//    if ($user->positionid) {
//        $positionrecs = mitms_get_user_hierarchy_lineage($user->positionid, 'position');
//    }

    $table = '<table cellpadding="4">';
    foreach ($columns as $column) {
        if ($column['column'] == 1) {
            echo "<tr>";
        }   
        $cell1str = "<td><strong>";
        $cell2str = "<td>";
        switch($column['type']) {
            case 'user':
                $cell1str .= get_string($column['value']);
                if ($column['value'] == 'fullname') {
                    $cell2str .= '<a href="'.$CFG->wwwroot.'/user/view.php?id='.$user->id.'">'.fullname($user, true).'</a>';
                } elseif ($column['value'] == 'email') {
                    $cell2str .= obfuscate_mailto($user->email);
                } else {
                    $cell2str .= $user->{$column['value']};
                }   
                break;
            case 'usercustom':
                $cell1str .= get_field('user_info_field', 'name', 'shortname', $column['value']);
                if ($usercustomfields) {
                    foreach($usercustomfields as $usercustomfield) {
                        $cell2str .= mitms_print_user_profile_field($user->id, $column['value']);
                    }
                }
                //                $cell2str .= mitms_print_user_profile_field($user->id, $column['value']);
                break;
            case 'position':
                if ($column['headingtype'] == 'defined') {
                    $cell1str .= $column['heading'];
                } else {
                    $cell1str .= get_string('position', 'position');
                }   
                if ($positions) {
                    foreach ($positions as $position) {
                        if ($column['level'] == $position->depthlevel) {
                            $cell2str .= $position->{$column['value']};
                            break;
                        }   
                    }   
                }   
                break;
            case 'organisation':
                if ($column['headingtype'] == 'defined') {
                    $cell1str .= $column['heading'];
                } else {
                    $cell1str .= get_string('organisation', 'organisation');
                }   
                if ($organisations) {
                    foreach ($organisations as $organisation) {
                        if ($column['level'] == $organisation->depthlevel) {
                            $cell2str .= $organisation->{$column['value']};
                            break;
                        }   
                    }   
                }   
                break;
            default:
                $cell1str = "<td></td>";
                $cell2str = "<td></td>";
                break;
        }
        $table .= $cell1str.$cell2str;
        if ($column['column'] == 2) {
            $table .= "</tr>";
        }
    }
    $table .= "</table>";

    return $table;

}
