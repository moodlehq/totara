<?php // $Id$
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
