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
    require_once($CFG->dirroot.'/local/mitms.php');

    require_login();

    define('DEFAULT_PAGE_SIZE', 20);
    define('SHOW_ALL_PAGE_SIZE', 5000);

    $id             = required_param('id', PARAM_INT);                       // which user to show
    $spage          = optional_param('spage', 0, PARAM_INT);                    // which page to show
    $perpage        = optional_param('perpage', DEFAULT_PAGE_SIZE, PARAM_INT);  // how many per page

    $strheading = get_string('myrecordoflearning', 'local');

    print_header($strheading, $strheading, build_navigation($strheading));

    if (! $user = get_record('user', 'id', $id)) {
        error('User not found');
    }

    /// Add the custom profile fields to the user record
    include_once($CFG->dirroot.'/user/profile/lib.php');
    $customfields = (array)profile_user_record($user->id);
    foreach ($customfields as $cname=>$cvalue) {
        if (!isset($user->$cname)) { // Don't overwrite any standard fields
            $user->$cname = $cvalue;
        }
    }

    $useorganisations = true;
    $usepositions     = true;

    if ($useorganisations) {
        require_once($CFG->dirroot.'/hierarchy/lib.php');
        $hierarchy = new hierarchy();
        $hierarchy->prefix = 'organisation';
        $organisations = $hierarchy->get_item_lineage($user->organisationid);
    }
    if ($usepositions) {
        require_once($CFG->dirroot.'/hierarchy/lib.php');
        $hierarchy = new hierarchy();
        $hierarchy->prefix = 'position';
        $positions = $hierarchy->get_item_lineage($user->positionid);
    }


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
            'value'       => 'managerempcode',
            'level'       => '',
            'headingtype' => 'defined',
            'heading'     => '',
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
            $cell1str .= get_field('user_info_field', 'name', 'shortname', $column['value']);
            $cell2str .= mitms_print_user_profile_field($user->id, $column['value']);
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

    $select = "SELECT c.fullname AS cfullname, cc.course AS cid, cc.timecompleted";
    $from   = " FROM mdl_course_completions cc
                JOIN mdl_course c
                ON c.id=cc.course";
    $where  = " WHERE cc.userid={$user->id}";
    $sort   = " ORDER BY cc.timecompleted";

    $matchcount = count_records_sql('SELECT COUNT (*) '.$from.$where);
    $matchcount = 100;

    $table->pagesize($perpage, $matchcount);
    $extrasql = '';

    $records = get_recordset_sql($select.$from.$where.$extrasql.$sort,
            $table->get_page_start(),  $table->get_page_size());
    
    if ($records) {
        while ($record = rs_fetch_next_record($records)) {
            $tabledata = array();
            foreach ($columns as $column) {
                switch($column['type']) {
                    case 'course':
                        $tabledata[] = '<a href="'.$CFG->wwwroot.'/course/view.php?id='.$record->cid.'">'.$record->cfullname.'</a>';
                        break;
                    case 'competency':
                        $tabledata[] = '';
                        break;
                    case 'proficiency':
                        $tabledata[] = get_string('completed', 'completion');
                        break;
                    case 'position':
                        if ($positions) {
                            foreach ($positions as $position) {
                                if ($column['level'] == $position->depthlevel) {
                                    $tabledata[] = $position->{$column['value']};
                                    break;
                                }
                            }
                        } else {
                            $tabledata[] = '';
                        }
                        break;
                    case 'organisation':
                        if ($organisations) {
                            foreach ($organisations as $organisation) {
                                if ($column['level'] == $organisation->depthlevel) {
                                    $tabledata[] = $organisation->{$column['value']};
                                    break;
                                }
                            }
                        } else {
                            $tabledata[] = '';
                        } 
                        break;
                    case 'date':
                        $tabledata[] = userdate($record->timecompleted, '%d %b %Y');
                        break;
                    default:
                        $tabledata[] = '';
                        break;
                }
                
            }

            $table->add_data($tabledata);
        }
    }

    // Display table
    $table->print_html();

    print_footer();

?>
