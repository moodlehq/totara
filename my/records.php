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
    $usercustomfields = (array)profile_user_record($user->id);
    foreach ($usercustomfields as $cname=>$cvalue) {
        if (!isset($user->$cname)) { // Don't overwrite any standard fields
            $user->$cname = $cvalue;
        }
    }

    $organisations = mitms_get_user_hierarchy_lineage($user->organisationid, 'organisation');
    $positions     = mitms_get_user_hierarchy_lineage($user->positionid, 'position');

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

    echo mitms_print_report_heading($columns, $user, $usercustomfields);

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
