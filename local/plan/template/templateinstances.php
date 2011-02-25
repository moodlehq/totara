<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
 * Copyright (C) 1999 onwards Martin Dougiamas 
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
 * @author Alastair Munro <alastair@catalyst.net.nz>
 * @package totara
 * @subpackage plan 
 */

/**
 * Page containing list of plan templates
 */

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/plan/lib.php');

$id = required_param('id', PARAM_INT);

admin_externalpage_setup('managetemplates');

if(!get_record('dp_template', 'id', $id)) {
    error('Invalid template id');
}

$instances = get_records('dp_plan', 'templateid', $id);

$navlinks = array();    // Breadcrumbs
$navlinks[] = array('name'=>get_string("managetemplates", "local_plan"),
                    'link'=>"{$CFG->wwwroot}/local/plan/template/index.php",
                    'type'=>'misc');
$navlinks[] = array('name'=>get_string('templateinstances', 'local_plan'), 'link'=>'', 'type'=>'misc');

admin_externalpage_print_header('', $navlinks);

print_heading(get_string('templateinstances','local_plan'));

if($instances){
    $columns[] = 'name';
    $headers[] = get_string('name', 'local_plan');
    $columns[] = 'user';
    $headers[] = get_string('user');
    $columns[] = 'startdate';
    $headers[] = get_string('startdate', 'local_plan');
    $columns[] = 'enddate';
    $headers[] = get_string('enddate', 'local_plan');
    $columns[] = 'status';
    $headers[] = get_string('status', 'local_plan');

    $table = new flexible_table('Template_instances');
    $table->define_columns($columns);
    $table->define_headers($headers);
    $table->set_attribute('class', 'generalbox dp-template-instances');

    $table->setup();
    foreach($instances as $instance) {
        $tablerow = array();
        $tablerow[] = '<a href=' . $CFG->wwwroot . '/local/plan/view.php?id=' . $instance->id . '>' . $instance->name . '</a>';
        $user = get_record('user', 'id', $instance->userid);
        $tablerow[] = '<a href=' . $CFG->wwwroot . '/user/view.php?id='.$user->id . '>' . $user->firstname .' '. $user->lastname . '</a>';
        $tablerow[] = date('j M Y', $instance->startdate);
        $tablerow[] = date('j M Y', $instance->enddate);

        switch($instance->status){
            case DP_PLAN_STATUS_UNAPPROVED:
                $status = get_string('unapproved', 'local_plan');
                break;
            case DP_PLAN_STATUS_APPROVED:
                $status = get_string('approved', 'local_plan');
                break;

            case DP_PLAN_STATUS_COMPLETE:
                $status = get_string('complete', 'local_plan');
                break;
        }
        $tablerow[] = $status;
        $table->add_data($tablerow);
    }
    $table->print_html();
}
print_footer();
?>
