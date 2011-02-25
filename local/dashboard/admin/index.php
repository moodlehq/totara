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

global $USER;

require_capability('local/dashboard:admin', get_context_instance(CONTEXT_SYSTEM));

admin_externalpage_setup('managedashboards');
admin_externalpage_print_header();

print_heading(get_string('dashboards','local_dashboard'));

$columns = array('shortname', 'title', 'role', 'active_dashlets');
$headings = array(get_string('shortname', 'local_dashboard'),
    get_string('title', 'local_dashboard'),
    get_string('role'),
    get_string('activedashlets', 'local_dashboard')
    );

$table = new flexible_table(get_string('dashboards', 'local_dashboard'));
$table->define_columns($columns);
$table->define_headers($headings);
$table->set_attribute('id', 'list-managedashboards');
$table->set_attribute('width', '95%');
$table->set_attribute('class', 'generalbox edit boxaligncenter');
$table->setup();

if ($dashboards = local_dashboard_get_dashboards()) {
    foreach ($dashboards as $d) {
        $content = array();

        $content[] = $d->shortname;
        $content[] = "<a href=\" {$CFG->wwwroot}/local/dashboard/admin/edit.php?item={$d->shortname}\">{$d->title}</a>";
        $content[] = $d->rolename;
        $content[] = $d->active_dashlets;
        $table->add_data($content);
    }

    $table->print_html();
} else {
    print_simple_box(get_string('nodashboardsfound', 'local_dashboard'));
}

admin_externalpage_print_footer();

?>
