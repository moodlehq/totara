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
 * @author     Simon Coggins <simonc@catalyst.net.nz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @copyright  (C) 1999 onwards Martin Dougiamas  http://dougiamas.com
 *
 * Displays information for the current user's team
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

    $strheading = get_string('myteam', 'local');

    // see which reports exist in db and add columns for them to table
    // these reports should have the "userid" url parameter enabled to allow
    // viewing of individual reports
    $staff_records = get_field('report_builder','id','shortname','staff_learning_records');
    $staff_f2f = get_field('report_builder','id','shortname','staff_facetoface_sessions');

    $tableheaders = array('',get_string('name'));
    $tableheaders[] = get_string('learningrecords','local');
    if($staff_f2f) {
        $tableheaders[] = get_string('f2fbookings','local');
    }
    //TODO add link to user's IDPs
    //$tableheaders[] = get_string('idps','local');

    print_header($strheading, $strheading, build_navigation($strheading));

    echo '<br /><center><h1>'.$strheading.'</h1></center><br />';

    // return users with this user as manager
    $staff_ids = mitms_get_staff();

    if($staff_ids) {
        // now get their details
        $sql = "SELECT id, firstname, lastname, imagealt, picture FROM {$CFG->prefix}user
            WHERE id IN (".implode(',',$staff_ids).") ORDER BY firstname";

        $teammembers = get_records_sql($sql);
        $count = count($staff_ids);
    } else {
        $teammembers = false;
    }

    if($teammembers) {
        $table = new flexible_table('-team-members-for-'.$USER->id);
        $table->define_headers($tableheaders);
        $table->define_columns($tableheaders);
        $table->set_attribute('cellspacing', '0');
        $table->column_style_all('vertical-align','middle');
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
        //$table->pagesize($perpage, $count);

        // show row for all staff first
        $tabledata = array('<img src="'.$CFG->wwwroot.'/pix/i/teammembers.png" width="32" height="32" alt="'.get_string('allteammembers','local').'">', '<strong>'.get_string('allteammembers','local').'</strong>');
        if($staff_records) {
            $tabledata[] = '<strong><a href="'.$CFG->wwwroot.'/local/reportbuilder/report.php?id='.$staff_records.'">'.get_string('learningrecords','local').'</a></strong>';
        } else {
            $tabledata[] = '';
        }
        if($staff_f2f) {
            $tabledata[] = '<strong><a href="'.$CFG->wwwroot.'/local/reportbuilder/report.php?id='.$staff_f2f.'">'.get_string('f2fbookings','local').'</a></strong>';
        }
        $table->add_data($tabledata);
        //TODO add blank field here when IDP column added
        //            $tabledata[] = '';

        foreach($teammembers as $teammember) {
            $tabledata = array();
            $tabledata[] = print_user_picture($teammember, 1, null, null, true);
            $tabledata[] = $teammember->firstname.' '.$teammember->lastname;
            /* use this when converting my/records link to a report
            if($staff_records) {
                $tabledata[] = '<a href="'.$CFG->wwwroot.'/local/reportbuilder/report.php?id='.$staff_records.'&amp;userid='.$teammember->id.'">'.get_string('learningrecords','local').'</a>';
            }*/
            $tabledata[] = '<a href="'.$CFG->wwwroot.'/my/records.php?id='.$teammember->id.'">'.get_string('learningrecords','local').'</a>';
            if($staff_f2f) {
                $tabledata[] = '<a href="'.$CFG->wwwroot.'/local/reportbuilder/report.php?id='.$staff_f2f.'&amp;userid='.$teammember->id.'">'.get_string('f2fbookings','local').'</a>';
            }
            //TODO add link to user's IDPs
            //            $tabledata[] = '<a href="'.$CFG->wwwroot.'/plan/index.php?userid='.$teammember->id.'">'.get_string('viewidps','local').'</a>';
            $table->add_data($tabledata);
        }
        $table->print_html();

    } else {
        print get_string('noteammembers','local');
    }


    print_footer();

?>
