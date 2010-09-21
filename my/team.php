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
 * @subpackage totara
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
require_once($CFG->dirroot.'/local/reportbuilder/lib.php');

require_login();

global $SESSION,$USER;


/**
 * Define the "My Team" embedded report
 */
$strheading = get_string('myteam', 'local');

$embed = new object();
$embed->source = 'user';
$embed->fullname = $strheading;
$embed->filters = array(); //hide filter block
$embed->columns = array(
    array(
        'type' => 'user',
        'value' => 'userpicture',
        'heading' => 'Pic'
    ),
    array(
        'type' => 'user',
        'value' => 'namelink',
        'heading' => 'Name'
    ),
    array(
        'type' => 'user',
        'value' => 'position',
        'heading' => 'Position'
    ),
    array(
        'type' => 'user',
        'value' => 'organisation',
        'heading' => 'Organisation'
    ),
    array(
        'type' => 'user',
        'value' => 'userlearningicons',
        'heading' => 'Links',
    )
);
$embed->contentmode = 2;
$embed->contentsettings = array(
    'user' => array(
        'enable' => 1,
        'who' => 'reports'
    )
);
$embed->embeddedparams = array();
$shortname = 'my_team';
$report = new reportbuilder(null, $shortname, $embed);
/**
 * End of defining the report
 */


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

        $report->include_js();
//        print $report->showhide_button();

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

        $report->display_table();

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
