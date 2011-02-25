<?php // $Id$
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
 * @package totara
 * @subpackage dashboard 
 */

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/dashboard/lib.php');
require_once($CFG->libdir.'/tablelib.php');

require_login();

require_capability('local/dashboard:admin', get_context_instance(CONTEXT_SYSTEM));

$shortname = optional_param('item', 0, PARAM_ALPHANUM);   // dashboard id
$dashaction = optional_param('dashaction', 0, PARAM_ALPHANUM);   // action to perform
$blockaction = optional_param('blockaction', 0, PARAM_ALPHANUM);   // action to perform
$blockinstanceid = optional_param('instanceid', 0, PARAM_INT);   // a block instance id
$dletid = optional_param('dlet', 0, PARAM_INT);   // action to perform
$col = optional_param('col', 1, PARAM_INT);


$returnurl = $CFG->wwwroot."/local/dasboard/admin/index.php";

if (empty($shortname) && !empty($blockinstanceid)) {
    // Get dashboard details from block instance
    if ($blockinstance = get_record('block_instance', 'id', $blockinstanceid, 'pagetype', 'totara-dashboard')) {
        if ($dashb = get_record('dashb', 'id', $blockinstance->pageid)) {
            $shortname = $dashb->shortname;
            unset($dashb);
        }
        unset($blockinstance);
    }
}

$dashb = new Dashboard($shortname, 0, 'useredit');

$PAGE=page_create_object('totara-dashboard', $dashb->instance->id);
$pageblocks = blocks_setup($PAGE,BLOCKS_PINNED_FALSE);

// First, handle any actions
if (!empty($dashaction) && !empty($dletid) && confirm_sesskey() && $dashb->is_using_default_instance()) {
    $redirect = "{$CFG->wwwroot}/local/dashboard/admin/edit.php?item={$shortname}";

    switch ($dashaction) {
        case 'toggle' :
            $dashb->dashlet_toggle_visibility($dletid);
            break;
        case 'delete' :
            //TODO: delete block_instance
            $dashb->dashlet_delete($dletid);
            break;
        case 'moveup' :
            $dashb->dashlet_move_vertical($dletid, 'up');
            break;
        case 'movedown' :
            $dashb->dashlet_move_vertical($dletid, 'down');
            break;
        case 'moveleft' :
            $dashb->dashlet_move_horizontal($dletid, 'left');
            break;
        case 'moveright' :
            $dashb->dashlet_move_horizontal($dletid, 'right');
            break;
        case 'config' :
            //TODO: redirect to dashlet config page
            break;
        case 'add' :
            if ($block_instance_id = $dashb->add_block_instance($dletid)) {
                $dashb->dashlet_add($block_instance_id, $col);
            }
            break;
        default:
            break;
    }

    redirect($redirect);
}

$strheading = get_string('editdashboard', 'local_dashboard');
if (!empty($dashb->data->title)) {
    $strheading .= ' - '.$dashb->data->title;
}

$navlinks[] = array('name' => get_string('dashboards', 'local_dashboard'), 'link' => "{$CFG->wwwroot}/local/dashboard/admin/index.php", 'type' => 'misc');
$navlinks[] = array('name' => get_string('editdashboard', 'local_dashboard'), 'link' => '', 'type' => 'misc');
$navigation = build_navigation($navlinks);

print_header_simple($strheading, '', $navigation, '', null, true);

print_heading($strheading);

print_container_start(false, 'mdl-right');
echo "<a href=\"{$CFG->wwwroot}/local/dashboard/admin/index.php\">".get_string('back')."</a>";
print_container_end();

$dashb->output();

print_footer();

?>
