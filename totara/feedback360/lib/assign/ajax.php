<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2013 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
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
 * @author Ciaran Irvine <ciaran.irvine@totaralms.com>
 * @author David Curry <david.curry@totaralms.com>
 * @package totara
 * @subpackage totara_feedback360
 */

/**
 * User Paginator server-side processing
 */

require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/totara/feedback360/lib.php');
require_once($CFG->dirroot.'/totara/feedback360/lib/assign/lib.php');
$module = required_param('module', PARAM_ALPHANUMEXT);
$itemid = required_param('itemid', PARAM_INT);

// Pagination variables.
$secho = required_param('sEcho', PARAM_INT);
$idisplaystart = optional_param('iDisplayStart', 0, PARAM_INT);
$idisplaylength = optional_param('iDisplayLength', 10, PARAM_INT);
$idisplaylength = ($idisplaylength == -1) ? null : $idisplaylength;
$ssearch = optional_param('sSearch', null, PARAM_TEXT);
$feedback360 = new $module($itemid);
$assignclassname = "totara_assign_{$module}";
$assignclass = new $assignclassname($module, $feedback360);
$users = $assignclass->get_current_users($idisplaystart, $idisplaylength, $ssearch);
$igrandtotal = $assignclass->get_current_users(null, null, null, true);
$idisplaytotal = $assignclass->get_current_users(null, null, $ssearch, true);
$output = array(
        "sEcho" => $secho,
        "iTotalRecords" => $igrandtotal,
        "iTotalDisplayRecords" => $idisplaytotal,
        "aaData" => array()
);
foreach ($users as $user) {
    $url = new moodle_url('/user/view.php', array('id' => $user->id));
    $link = html_writer::link($url, fullname($user));
    $output['aaData'][] = array($link, $user->assignedvia);
}

echo json_encode($output);
