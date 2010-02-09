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
    require_once($CFG->libdir.'/blocklib.php');
    require_once($CFG->libdir.'/tablelib.php');
    require_once($CFG->dirroot.'/tag/lib.php');
    require_once($CFG->dirroot.'/local/reportlib.php');

    require_login();

    define('DEFAULT_PAGE_SIZE', 20);
    define('SHOW_ALL_PAGE_SIZE', 5000);

    global $SESSION,$USER;

    $id             = required_param('id', PARAM_INT);                       // which user to show
    $spage          = optional_param('spage', 0, PARAM_INT);                    // which page to show
    $perpage        = optional_param('perpage', DEFAULT_PAGE_SIZE, PARAM_INT);  // how many per page
    $export         = optional_param('export', 0, PARAM_INT); // export or not?
    $strheading = get_string('myrecordoflearning', 'local');

    if (! $user = get_record('user', 'id', $id)) {
        error('User not found');
    }

    if ($USER->id != $id) {
        error('You can only view your own records');
    }

    ///
    /// Get database info
    ///

    $table = new flexible_table('-recordoflearning-index-'.$user->id);

    $columns = array(
        array(
            'type'    => 'course',
            'value'   => 'fullname',
            'level'   => '',
            'heading' => 'Course title',
        ),
        array(
            'type'    => 'competency',
            'value'   => 'idnumber',
            'level'   => '2',
            'heading' => 'Unit #',
        ),
        array(
            'type'    => 'proficiency',
            'value'   => 'proficiency',
            'level'   => '2',
            'heading' => 'Proficiency',
        ),
        array(
            'type'    => 'position',
            'value'   => 'fullname',
            'level'   => '1',
            'heading' => 'Role',
        ),
        array(
            'type'    => 'organisation',
            'value'   => 'fullname',
            'level'   => '2',
            'heading' => 'CO',
        ),
        array(
            'type'    => 'organisation',
            'value'   => 'fullname',
            'level'   => '3',
            'heading' => 'AO',
        ),
        array(
            'type'    => 'date',
            'value'   => 'timecreated',
            'level'   => '2',
            'heading' => 'Date',
        ),
        array(
            'type'    => 'competency_evidence',
            'value'   => 'assessorid',
            'level'   => '2',
            'heading' => 'Assessor',
        ),
        array(
            'type'    => 'competency_evidence',
            'value'   => 'assessororg',
            'level'   => '2',
            'heading' => 'Assessor Org',
        ),
    );

    foreach ($columns as $column) {
        $tablecolumns[] = $column['heading'];
        $tableheaders[] = $column['heading'];
    }

    $table->define_columns($tablecolumns);
    $table->define_headers($tableheaders);
//    $table->column_style($tablecolumncf,'text-align','center');
    $table->column_style('edit','width','80px');

    $table->set_attribute('cellspacing', '0');
    $table->set_attribute('id', 'recordoflearning');
    $table->set_attribute('class', 'logtable generalbox');

    $table->set_control_variables(array(
                TABLE_VAR_SORT    => 'ssort',
                TABLE_VAR_HIDE    => 'shide',
                TABLE_VAR_SHOW    => 'sshow',
                TABLE_VAR_IFIRST  => 'sifirst',
                TABLE_VAR_ILAST   => 'silast',
                TABLE_VAR_PAGE    => 'spage'
                )); 
    $table->setup();

    $table->initialbars(true);

    $select1 = "SELECT c.fullname AS cfullname, cc.course AS cid, cc.timecompleted";
    $from1   = " FROM mdl_course_completions cc
                 JOIN mdl_course c
                   ON c.id=cc.course";
    $where1  = " WHERE cc.userid={$user->id}";
    $sort1   = " ORDER BY cc.timecompleted";

    $select2 = "SELECT c.fullname AS cfullname, ce.competencyid AS cid, ce.proficiency, ce.positionid, ce.organisationid, ce.timemodified";
    $from2   = " FROM mdl_competency_evidence ce
                 JOIN mdl_competency c
                 ON c.id=ce.competencyid";
    $where2  = " WHERE ce.userid={$user->id}";
    $sort2   = " ORDER by ce.timemodified DESC";

    $select3 = "SELECT c.fullname as cfullname, ce.competencyid AS cid,
        ce.proficiency, 
        ce.positionid, ce.organisationid, ce.timemodified, ce.assessorid, 
        ce.assessorname, 'competency' AS type, c.idnumber as idnumber
        FROM mdl_competency_evidence ce JOIN mdl_competency c ON c.id=ce.competencyid WHERE ce.userid={$user->id}
        UNION ALL
        SELECT c.fullname AS cfullname, cc.course AS cid, 
        CASE WHEN cc.timecompleted IS NOT NULL THEN 3 ELSE 1 END AS proficiency,
        positionid, organisationid, cc.timecompleted, null::integer as assessorid, 
        null::varchar as assessorname, 'course' AS type, c.idnumber as idnumber
        FROM mdl_course_completions cc JOIN mdl_course c ON c.id=cc.course
        WHERE cc.userid={$user->id} ORDER BY timemodified DESC";

    $matchcount1 = count_records_sql('SELECT COUNT (*) '.$from1.$where1);
    $matchcount2 = count_records_sql('SELECT COUNT (*) '.$from2.$where2);

    $table->pagesize($perpage, $matchcount1+$matchcount2);
    $extrasql = '';
    if($export!='1') {
        $records3 = get_recordset_sql($select3,
            $table->get_page_start(),  $table->get_page_size());
    } else {
        // don't paginate for export
        $records3 = get_recordset_sql($select3);
    }
    $scalevalues = array(
        array(
            'id' => 1,
            'name' => 'Not competent',
        ),
        array(
            'id' => 2,
            'name' => 'Competent with supervision',
        ),
        array(
            'id' => 3,
            'name' => 'Competent',
        )
    );

    $exportdata = array();
    if ($records3) {
        while ($record = rs_fetch_next_record($records3)) {
            $tabledata = array();
            foreach ($columns as $column) {
                switch($column['type']) {
                case 'course':
                        if($record->type=='course') {
                            $tabledata[] = '<a href="'.$CFG->wwwroot.'/course/view.php?id='.$record->cid.'">'.$record->cfullname.'</a>';
                        } else {
                            $tabledata[] = '<a href="'.$CFG->wwwroot.'/hierarchy/item/view.php?type=competency&id='.$record->cid.'">'.$record->cfullname.'</a>';
                        }
                        break;
                    case 'competency':
                        $tabledata[] = $record->idnumber;
                        break;
                    case 'proficiency':
                        if($record->type=='course') {
                            if(!empty($record->timemodified)) {
                                $tabledata[] = get_string('completed', 'completion');
                            } else {
                                $tabledata[] = get_string('notcompleted', 'completion');
                            }
                        } else {
                            if(!empty($record->proficiency)) {
                                foreach ($scalevalues as $scalevalue) {
                                    if ($record->proficiency == $scalevalue['id']) {
                                        $tabledata[] = $scalevalue['name'];
                                    }
                                }
                            } else {
                                $tabledata[] = "-";
                            }
                        }
                        break;
                    case 'position':
                        if(!empty($record->positionid) && isset($positionids[$record->positionid])) {
                            $tabledata[] = $positionids[$record->positionid]->fullname;
                        } else {
                            $tabledata[] = '';
                        }
                        break;
                    case 'organisation':
                        if(!empty($record->organisationid)) {
                            $testfound = false;
                            // not very efficient doing this for every loop but don't know
                            // in advance what possible values will be because we are using recordset
                            $orgs = mitms_get_user_hierarchy_lineage($record->organisationid, 'organisation');
                            foreach ($orgs as $org) {
                                if ($column['level'] == $org->depthlevel) {
                                    $tabledata[] = $org->{$column['value']};
                                    $testfound = true;
                                }
                            }
                            if (!$testfound) {
                                $tabledata[] = get_string('notapplicable', 'local');
                            }
                        } else {
                            $tabledata[] = '';
                        }
                        break;
                    case 'date':
                        if($record->type=='course') {
                            if(!empty($record->timemodified)) {
                                $tabledata[] = userdate($record->timemodified, '%d %b %Y');
                            } else {
                                $tabledata[] = '-';
                            }
                        } else {
                            if(!empty($record->timemodified)) {
                                $tabledata[] = userdate($record->timemodified, '%d %b %Y');
                            } else {
                                $tabledata[] = '-';
                            }
                        }
                        break;
                    case 'competency_evidence':
                        
                        if($column['value']=='assessorid') {
                            if(!empty($record->assessorid) && $record->assessorid != 0) {
                                $auser = get_record('user','id',$record->assessorid);
                                if($auser) {
                                    $tabledata[] = $auser->firstname.' '.$auser->lastname;
                                } else {
                                    $tabledata[] = '';
                                }
                            } else {
                                $tabledata[] = '';
                            }
                        } else if ($column['value']=='assessororg'){
                            if (!empty($record->assessorname)) {
                                $tabledata[] = $record->assessorname;
                            } else {
                                $tabledata[] = '';
                            }
                        } else {
                            $tabledata[] = '';
                        }


                        break;
                    default:
                        $tabledata[] = '';
                        break;
                }

            }

            $table->add_data($tabledata);
            $exportdata[] = $tabledata;

        }
        rs_close($records3);
    }

    if($export=='1') {
        // save exportdata to session
        $SESSION->download_data = $exportdata;
        $SESSION->download_cols = $tablecolumns;
        redirect($CFG->wwwroot.'/my/downloadrecords.php');
    }

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

    $organisations = mitms_get_user_hierarchy_lineage($user->organisationid, 'organisation');
    $positions     = mitms_get_user_hierarchy_lineage($user->positionid, 'position');
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
            'type'        => 'organisation',
            'value'       => 'fullname',
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
            'type'        => 'organisation',
            'value'       => 'fullname',
            'level'       => '3',
            'headingtype' => 'defined',
            'heading'     => 'Area Office',
        ),
        array(
            'column'      => '1',
            'sortorder'   => '3',
            'type'        => 'usercustom',
            'value'       => 'title',
            'level'       => '',
            'headingtype' => 'defined',
            'heading'     => '',
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
            'type'        => 'position',
            'value'       => 'fullname',
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
            'type'        => 'usercustom',
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
                $cell1str .= 'Manager name';
                $managerid = mitms_print_user_profile_field($user->id, 'managerid');
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
            } else {
                $cell2str .= get_string('notavailable','local');
            }
            break;
        case 'organisation':
            $testfound = false;
            if ($column['headingtype'] == 'defined') {
                $cell1str .= $column['heading'];
            } else {
                $cell1str .= get_string('organisation', 'organisation');
            }
            if ($organisations) {
                foreach ($organisations as $organisation) {
                    if ($column['level'] == $organisation->depthlevel) {
                        $cell2str .= $organisation->{$column['value']};
                        $testfound = true;
                        break;
                    }
                }
            }
            if (!$testfound) {
                $cell2str .= get_string('notapplicable', 'local');
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
<br>
<?php
    if($export!='1') {
        // Display table
        $table->print_html();
        $url = new moodle_url(qualified_me());
        $current_params = $url->params;
        $current_params = array_merge($current_params, array('export'=>'1'));
        echo '<div align=\"center\">'.print_single_button(null,$current_params,'Export').'</div>';
    } else {
        // export
    }

    print_footer();

?>
