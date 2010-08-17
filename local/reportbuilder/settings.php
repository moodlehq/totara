<?php // $Id$

/**
 * Add reportbuilder administration menu settings
 *
 * @author     Simon Coggins
 * @copyright  Totara Learning Solutions Limited
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @package    totara
 * @subpackage reportbuilder
 */

$ADMIN->add('reports',
    new admin_category('local_reportbuilder',
    get_string('reportbuilder','local_reportbuilder'))
);
// add links to report builder reports
$ADMIN->add('local_reportbuilder',
    new admin_externalpage('managereports',
        get_string('managereports','local_reportbuilder'),
        "$CFG->wwwroot/local/reportbuilder/index.php",
        array('local/reportbuilder:managereports')
    )
);
$ADMIN->add('local_reportbuilder',
    new admin_externalpage('globalreportsettings',
        get_string('globalsettings','local_reportbuilder'),
        "$CFG->wwwroot/local/reportbuilder/globalsettings.php",
        array('local/reportbuilder:managereports')
    )
);
$ADMIN->add('local_reportbuilder',
    new admin_externalpage('activitygroups',
        get_string('activitygroups','local_reportbuilder'),
        "$CFG->wwwroot/local/reportbuilder/groups.php",
        array('local/reportbuilder:managereports')
    )
);


?>
