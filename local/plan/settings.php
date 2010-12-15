<?php // $Id$

/**
 * Add learning plans administration menu settings
 *
 * @author     Simon Coggins
 * @copyright  Totara Learning Solutions Limited
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @package    totara
 * @subpackage plan
 */

$ADMIN->add('root',
    new admin_category('local_plan',
    get_string('learningplans','local_plan'))
);
// add links to report builder reports
$ADMIN->add('local_plan',
    new admin_externalpage('manageglobal',
        get_string('globalsettings','local_plan'),
        "$CFG->wwwroot/local/plan/global.php",
        array('local/plan:configureplans')
    )
);

$ADMIN->add('local_plan',
    new admin_externalpage('managetemplates',
        get_string('managetemplates', 'local_plan'),
        "$CFG->wwwroot/local/plan/template/index.php",
        array('local/plan:configureplans')
    )
);

$ADMIN->add('local_plan',
    new admin_externalpage('priorityscales',
        get_string('priorityscales', 'local_plan'),
        "$CFG->wwwroot/local/plan/priorityscales/index.php",
        array('local/plan:configureplans')
    )
);

$ADMIN->add('local_plan',
    new admin_externalpage('objectivescales',
        get_string('objectivescales', 'local_plan'),
        "$CFG->wwwroot/local/plan/objectivescales/index.php",
        array('local/plan:configureplans')
    )
);
?>
