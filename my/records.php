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
 * @subpackage mitms
 * @author     Jonathan Newman <jonathan.newman@catalyst.net.nz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @copyright  (C) 1999 onwards Martin Dougiamas  http://dougiamas.com
 *
 * Displays collaborative features for the current user
 *
 */

    require_once('../config.php');
    require_once($CFG->dirroot.'/local/reportbuilder/lib.php');
    require_once($CFG->dirroot.'/local/reportlib.php');

    require_login();

    global $SESSION,$USER;

    $id             = required_param('id', PARAM_INT);                       // which user to show
    $format         = optional_param('format','',PARAM_TEXT); //export format


    if (! $user = get_record('user', 'id', $id)) {
        error('User not found');
    }

    // users can only view their own and their staff's pages
    if ($USER->id != $id && !mitms_is_manager($id)) {
        error('You cannot view this page');
    }
    if ($USER->id != $id) {
        $strheading = get_string('recordoflearningfor','local').fullname($user, true);
    } else {
        $strheading = get_string('myrecordoflearning', 'local');
    }

    $shortname = 'record_of_learning';
    $source = 'competency_evidence';
    $fullname = $strheading;
    $filters = array(); // hide filter block
    $columns = array(
        array(
            'type' => 'competency',
            'value' => 'competencylink',
            'heading' => 'Course/Competency',
        ),
        array(
            'type' => 'competency',
            'value' => 'idnumber',
            'heading' => 'Competency ID',
        ),
        array(
            'type' => 'competency_evidence',
            'value' => 'proficiency',
            'heading' => 'Proficiency',
        ),
        array(
            'type' => 'competency_evidence',
            'value' => 'position',
            'heading' => 'Completed As',
        ),
        array(
            'type' => 'competency_evidence',
            'value' => 'organisation',
            'heading' => 'Completed At',
        ),
        array(
            'type' => 'competency_evidence',
            'value' => 'completeddate',
            'heading' => 'Date',
        ),
        array(
            'type' => 'competency_evidence',
            'value' => 'assessor',
            'heading' => 'Assessor',
        ),
        array(
            'type' => 'competency_evidence',
            'value' => 'assessorname',
            'heading' => 'Assessor Organisation',
        ),
    );
    // no restrictions set, but embedded params
    // and in page check ensure only valid users
    // can see reports
    $restriction = array(
        array(
            'field' => 'all',
            'funcname' => 'dummy',
        ),
    );

    $embeddedparams = array(
        // show report for a specific user
        'userid' => $id,
    );

    $report = new reportbuilder($shortname, true, $source, $fullname,
        $filters, $columns, $restriction, $embeddedparams);

    if($format!='') {
        $report->export_data($format);
        die;
    }

    ///
    /// Get database info
    ///

    /// Get the primary position and related meta dat
    $sql = "SELECT pa.fullname,
                pa.shortname,
                pa.idnumber,
                pa.organisationid,
                pa.positionid,
                u.id as managerid,
                u.email as manageremail,
                u.firstname as managerfirstname,
                u.lastname as managerlastname
            FROM {$CFG->prefix}position_assignment pa
            JOIN {$CFG->prefix}role_assignments ra
              ON ra.id=pa.reportstoid
            JOIN {$CFG->prefix}user u
               ON u.id=ra.userid
            WHERE pa.type=1 AND pa.userid={$id}";
    $positionassignment = get_record_sql($sql);

    print_header($strheading, $strheading, build_navigation($strheading));

    echo '<h1>'.$strheading.'</h1>';

    /// Add the custom profile fields to the user record
    include_once($CFG->dirroot.'/user/profile/lib.php');
    $usercustomfields = (array)profile_user_record($user->id);
    foreach ($usercustomfields as $cname=>$cvalue) {
        if (!isset($user->$cname)) { // Don't overwrite any standard fields
            $user->$cname = $cvalue;
        }
    }

    $organistions = new object();
    $positions = new object();
    if (!empty($positionassignment->organisationid)) {
        $organisations = mitms_get_user_hierarchy_lineage($positionassignment->organisationid, 'organisation');
    }
    if (!empty($positionassignment->positionid)) {
        $positions = mitms_get_user_hierarchy_lineage($positionassignment->positionid, 'position');
    }
    $positionids = get_records('position', '', '', '', 'id,fullname');

    $columns = array(
        array(
            'column'      => '1',
            'sortorder'   => '1',
            'type'        => 'user',
            'value'       => 'fullname',
            'level'       => '',
            'headingtype' => 'lang',
            'heading'     => 'fullname',
        ),
        array(
            'column'      => '2',
            'sortorder'   => '1',
            'type'        => 'positionassignment',
            'value'       => 'organisationfullname',
            'level'       => '2',
            'headingtype' => 'defined',
            'heading'     => 'Conservancy',
        ),
        array(
            'column'      => '1',
            'sortorder'   => '2',
            'type'        => 'user',
            'value'       => 'email',
            'level'       => '',
            'headingtype' => 'lang',
            'heading'     => 'email',
        ),
        array(
            'column'      => '2',
            'sortorder'   => '2',
            'type'        => 'positionassignment',
            'value'       => 'organisationfullname',
            'level'       => '3',
            'headingtype' => 'defined',
            'heading'     => 'Area Office',
        ),
        array(
            'column'      => '1',
            'sortorder'   => '3',
            'type'        => 'positionassignment',
            'value'       => 'fullname',
            'level'       => '',
            'headingtype' => 'defined',
            'heading'     => 'Title',
        ),
        array(
            'column'      => '2',
            'sortorder'   => '3',
            'type'        => 'user',
            'value'       => 'idnumber',
            'level'       => '',
            'headingtype' => 'defined',
            'heading'     => 'Jade id',
        ),
        array(
            'column'      => '1',
            'sortorder'   => '4',
            'type'        => 'positionassignment',
            'value'       => 'positionfullname',
            'level'       => '1',
            'headingtype' => 'defined',
            'heading'     => 'Role',
        ),
        array(
            'column'      => '2',
            'sortorder'   => '4',
            'type'        => 'usercustom',
            'value'       => 'nzqaid',
            'level'       => '',
            'headingtype' => 'defined',
            'heading'     => '',
        ),
        array(
            'column'      => '1',
            'sortorder'   => '5',
            'type'        => 'positionassignment',
            'value'       => 'managername',
            'level'       => '',
            'headingtype' => 'defined',
            'heading'     => 'Manager name',
        ),
        array(
            'column'      => '2',
            'sortorder'   => '5',
            'type'        => 'usercustom',
            'value'       => 'datejoined',
            'level'       => '',
            'headingtype' => 'defined',
            'heading'     => '',
        ),
    );

echo '<table cellpadding="4">';
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
            if ($column['value'] == 'managername') {
                if (!empty($managerid)) {
                    $manager = get_record('user', 'id', $managerid);
                    $cell2str .= '<a href="'.$CFG->wwwroot.'/user/view.php?id='.$managerid.'">'.$manager->firstname.' '.$manager->lastname.'</a>';
                } else {
                    $cell2str .= get_string('notavailable', 'local');
                }
            } else {
                $cell1str .= get_field('user_info_field', 'name', 'shortname', $column['value']);
                $usercustom = mitms_print_user_profile_field($user->id, $column['value']);
                if (!$usercustom == '') {
                    $cell2str .= $usercustom;
                } else {
                    $cell2str .= get_string('notavailable', 'local');
                }
            }
            break;
        case 'positionassignment';
            switch($column['value']) {
                case 'fullname':
                    if ($column['headingtype'] == 'defined') {
                        $cell1str .= $column['heading'];
                    } else {
                        $cell1str .= get_string('title');
                    }
                    if (!empty($positionassignment)) {
                       $cell2str .= $positionassignment->fullname;
                    }
                    break;
                case 'shortname':
                    $cell2str .= $positionassignment->shortname;
                    break;
                case 'managername':
                    if ($column['headingtype'] == 'defined') {
                        $cell1str .= $column['heading'];
                    } else {
                        $cell1str .= "Manager name";
                    }
                    if (!empty($positionassignment)) {
                        $manager = new object();
                        $manager->firstname = $positionassignment->managerfirstname;
                        $manager->lastname  = $positionassignment->managerlastname;
                        $cell2str .= '<a href="'.$CFG->wwwroot.'/user/view.php?id='.$positionassignment->managerid.'">'.fullname($manager, true).'</a>';
                    }
                    break;
                case 'positionfullname':
                    if ($column['headingtype'] == 'defined') {
                        $cell1str .= $column['heading'];
                    } else {
                        $cell1str .= get_string('position', 'position');
                    }
                    if (!empty($positions)) {
                        foreach ($positions as $position) {
                            if ($column['level'] == $position->depthlevel) {
                                $cell2str .= $position->fullname;
                                break;
                            }
                        }
                    } else {
                        $cell2str .= get_string('notavailable','local');
                    }
                    break;
                case 'organisationfullname':
                    if ($column['headingtype'] == 'defined') {
                        $cell1str .= $column['heading'];
                    } else {
                        $cell1str .= get_string('organisation', 'organisation');
                    }
                    $testfound = false;
                    if (!empty($organisations)) {
                        foreach ($organisations as $organisation) {
                            if ($column['level'] == $organisation->depthlevel) {
                                $cell2str .= $organisation->fullname;
                                $testfound = true;
                                break;
                            }
                        }
                    }
                    if (!$testfound) {
                        $cell2str .= get_string('notapplicable', 'local');
                    }
                break;
            }
            break;
        default:
            $cell1str = "<td></td>";
            $cell2str = "<td></td>";
            break;
    }
    echo $cell1str.$cell2str;
    if ($column['column'] == 2) {
        echo "</tr>";
    }
}
echo "</table>";
?>
<table cellpadding="4">
<tr>
    <td><strong>Reported at: </strong></td>
    <td><?php echo userdate(time()) ?></td>
    <td></td>
    <td></td>
</tr>
</table>

<?php

// display table here
$fullname = $report->_fullname;
$countfiltered = $report->get_filtered_count();
$countall = $report->get_full_count();

// display heading including filtering stats
print_heading("$countall results found.");

$report->display_search();

if($countfiltered>0) {
    $report->display_table();
    // export button
    $report->export_select();
}
   print_footer();

?>
