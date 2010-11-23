<?php // $Id$

/**
 * Add dashboard administration menu settings
 *
 * @author     Eugene Venter
 * @copyright  Totara Learning Solutions Limited
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @package    totara
 * @subpackage dashboard
 */

$ADMIN->add('modules', new admin_category('local_dashboard', get_string('dashboards','local_dashboard')));

// add link to dashboard management
$ADMIN->add('local_dashboard',
    new admin_externalpage('managedashboards',
        get_string('managedashboards','local_dashboard'),
        "$CFG->wwwroot/local/dashboard/admin/index.php",
        array('local/dashboard:admin')
    )
);

?>
