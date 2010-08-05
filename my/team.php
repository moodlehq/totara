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
 * @subpackage Totara
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

require_login();

define('DEFAULT_PAGE_SIZE', 20);
define('SHOW_ALL_PAGE_SIZE', 5000);

global $SESSION,$USER;
$strheading = get_string('myteam', 'local');

$PAGE = page_create_object('Totara', $USER->id);
$pageblocks = blocks_setup($PAGE,BLOCKS_PINNED_BOTH);
$blocks_preferred_width = bounded_number(180, blocks_preferred_width($pageblocks[BLOCK_POS_LEFT]), 210);


// see which reports exist in db and add columns for them to table
// these reports should have the "userid" url parameter enabled to allow
// viewing of individual reports
$staff_records = get_field('report_builder','id','shortname','staff_learning_records');
$staff_f2f = get_field('report_builder','id','shortname','staff_facetoface_sessions');

$PAGE->print_header($strheading, $strheading);

echo '<table id="layout-table">';
echo '<tr valign="top">';

$lt = (empty($THEME->layouttable)) ? array('left', 'middle', 'right') : $THEME->layouttable;
foreach ($lt as $column) {
    switch ($column) {
    case 'left':

        if(blocks_have_content($pageblocks, BLOCK_POS_LEFT) || $PAGE->user_is_editing()) {
            echo '<td style="vertical-align: top; width: '.$blocks_preferred_width.'px;" id="left-column">';
            print_container_start();
            blocks_print_group($PAGE, $pageblocks, BLOCK_POS_LEFT);
            print_container_end();
            echo '</td>';
        } else {
            echo '<td id="left-column"></td>';
        }

    break;
    case 'middle':

        echo '<td valign="top" id="middle-column">';
        echo '<h1>'.$strheading.'</h1>';

        // return users with this user as manager
        $staff_ids = totara_get_staff();

        if ($staff_ids) {
            // now get their details
            $sql = "SELECT u.id, u.firstname, u.lastname, u.imagealt, u.picture, pa.shortname AS position, o.shortname AS organisation
                    FROM {$CFG->prefix}user u
                    LEFT JOIN {$CFG->prefix}pos_assignment pa
                      ON pa.userid=u.id
                    LEFT JOIN {$CFG->prefix}org o
                      ON o.id=pa.organisationid
                    WHERE u.id IN (".implode(',',$staff_ids).")
                    ORDER BY firstname";

            $teammembers = get_records_sql($sql);
            $count = count($staff_ids);
        } else {
            $teammembers = false;
        }

        if ($teammembers) {

            echo '<table class="allmyteam"><tr>';

                if($staff_records) {
                    echo '<tr><td class="c0"><img src="'.$CFG->wwwroot.'/pix/i/teammembers.png" width="32" height="32" alt="'.get_string('allteammembers','local').'"></td>';
                    echo '<td class="c1"><strong><a href="'.$CFG->wwwroot.'/local/reportbuilder/report.php?id='.$staff_records.'">'.get_string('alllearningrecords','local').'</a></strong></td>';
                }
                if($staff_f2f) {
                    echo '<td class="c2"><img src="'.$CFG->wwwroot.'/pix/i/teammembers.png" width="32" height="32" alt="'.get_string('allteammembers','local').'"></td>';
                    echo '<td class="c3"><strong><a href="'.$CFG->wwwroot.'/local/reportbuilder/report.php?id='.$staff_f2f.'">'.get_string('allf2fbookings','local').'</a></strong></td></tr>';
                }
            echo '</tr></table>';

            $tableheaders = array('',get_string('name'));
            $tableheaders[] = get_string('position','position');
            $tableheaders[] = get_string('organisation','organisation');
            $tableheaders[] = '&nbsp;';

            $table = new flexible_table('-team-members');
            $table->define_headers($tableheaders);
            $table->define_columns($tableheaders);
            $table->set_attribute('cellspacing', '0');
            $table->column_style_all('vertical-align','middle');
            $table->set_attribute('class', 'generalbox');
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

            foreach($teammembers as $teammember) {
                $tabledata = array();
                $tabledata[] = print_user_picture($teammember, 1, null, null, true);
                $tabledata[] = '<a href="'.$CFG->wwwroot.'/user/view.php?id='.$teammember->id.'">'.$teammember->firstname.' '.$teammember->lastname.'</a>';
                $tabledata[] = $teammember->position;
                $tabledata[] = $teammember->organisation;
                $cellcontent = '<a href="'.$CFG->wwwroot.'/my/records.php?id='.$teammember->id.'"><img src="'.$CFG->wwwroot.'/pix/i/rol.png" title="'.get_string('learningrecords','local').'"></a>';
                if($staff_f2f) {
                    $cellcontent .= '<a href="'.$CFG->wwwroot.'/my/bookings.php?id='.$teammember->id.'"><img src="'.$CFG->wwwroot.'/pix/i/bookings.png" title="'.get_string('f2fbookings','local').'"></a>';
                }

                $usercontext = get_context_instance(CONTEXT_USER, $teammember->id);
                if(has_capability('moodle/local:idpviewlist', $usercontext)) {
                    $cellcontent .= '<a href="'.$CFG->wwwroot.'/idp/index.php?userid='.$teammember->id.'"><img src="'.$CFG->wwwroot.'/pix/i/idp.png" title="'.get_string('idp','idp').'"></a>';
                }
                $tabledata[] = $cellcontent;
                $table->add_data($tabledata);
            }
            $table->print_html();

        } else {
            print get_string('noteammembers','local');
        }
        echo '</td>';

    break;
    case 'right':
        echo '<td style="vertical-align: top; width: '.$blocks_preferred_width.'px;" id="right-column">';
        print_container_start();
        blocks_print_group($PAGE, $pageblocks, BLOCK_POS_RIGHT);
        print_container_end();
        echo '</td>';
    break;
    }
}

/// Finish the page
echo '</tr></table>';

print_footer();

?>
