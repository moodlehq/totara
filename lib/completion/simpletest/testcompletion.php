<?php
/**
 * Unit tests for course completion
 *
 * lib/completionlib.php and lib/completion/*
 *
 * @author Aaron Barnes <aaronb@catalyst.net.nz>
 */
if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');
}


/**
 * Required includes
 */
require_once("{$CFG->libdir}/simpletestlib.php");
require_once("{$CFG->libdir}/completionlib.php");
require_once("{$CFG->libdir}/completion/cron.php");


class coursecompletion_test extends prefix_changing_test_case {


    /**
     * Sets up unit test wide variables at the start
     * of each test method.
     *
     * @access  public
     */
    public function setUp() {

        // Setup enabled course
        $this->course = new object();
        $this->course->id = 3;
        $this->course->enablecompletion = COMPLETION_ENABLED;


        // Setup disabled course
        $this->course_disabled = new object();
        $this->course_disabled->id = 2;
        $this->course_disabled->enablecompletion = COMPLETION_DISABLED;
    }


    /**
     * Test get_aggregation_methods() is up-to-date with all
     * the COMPLETION_AGGREGATION definitions
     *
     * @access  public
     */
    public function test_get_aggregation_methods() {
        // Get all completion aggregation definitions
        $allconstants = get_defined_constants(true);
        $agg_constants = array();
        foreach ($allconstants['user'] as $constant => $value) {
            if (preg_match('/^COMPLETION_AGGREGATION_/', $constant)) {
                $agg_constants[] = $value;
            }
        }

        // Check get_aggregation_methods() returns all of them
        $result = completion_info::get_aggregation_methods();
        $this->assertIdentical($agg_constants, array_keys($result));

        // Check for missing lang strings
        $missing = false;
        foreach ($result as $string) {
            if (strpos($string, '[') !== false) {
                $missing = true;
            }
        }

        $this->assertFalse($missing);
    }


    /**
     * Test is_enabled_for_site checks the correct data
     *
     * @access  public
     */
    public function test_is_enabled_for_site() {
        global $CFG;
        $oldvalue = $CFG->enablecompletion;

        // Check no value = completion disabled
        unset($CFG->enablecompletion);
        $this->assertFalse(completion_info::is_enabled_for_site());

        // Check COMPLETION_ENABLED = completion enabled
        $CFG->enablecompletion = COMPLETION_ENABLED;
        $this->assertTrue(completion_info::is_enabled_for_site());

        // Check a positive value = completion enabled
        $CFG->enablecompletion = true;
        $this->assertTrue(completion_info::is_enabled_for_site());

        // Check COMPLETION_DISABLED = completion disabled
        $CFG->enablecompletion = COMPLETION_DISABLED;
        $this->assertFalse(completion_info::is_enabled_for_site());

        $CFG->enablecompletion = $oldvalue;
    }


    /**
     * Test is_enabled checks the correct data
     *
     * @access  public
     */
    public function test_is_enabled() {
        global $CFG;
        $oldvalue = $CFG->enablecompletion;

        // Enabled course, enabled sitewide
        $CFG->enablecompletion = COMPLETION_ENABLED;
        $cinfo = new completion_info($this->course);
        $this->assertIdentical($cinfo->is_enabled(), COMPLETION_ENABLED);

        // Enabled course, disabled sitewide
        unset($CFG->enablecompletion);
        $this->assertIdentical($cinfo->is_enabled(), COMPLETION_DISABLED);

        // Disabled course, enabled sitewide
        $CFG->enablecompletion = COMPLETION_ENABLED;
        $cinfo = new completion_info($this->course_disabled);
        $this->assertIdentical($cinfo->is_enabled(), COMPLETION_DISABLED);

        // Disabled course, enabled sitewide, enabled cm
        $cm = new object();
        $cm->completion = 'testvalue';
        $this->assertIdentical($cinfo->is_enabled($cm), COMPLETION_DISABLED);

        // Enabled course, enabled sitewide, disabled cm
        $cinfo = new completion_info($this->course);
        $this->assertIdentical($cinfo->is_enabled($cm), 'testvalue');
    }
}


class coursecompletioncompletion_test extends prefix_changing_test_case {

    /**
     * Test all COMPLETION_STATUS constants are set and in the
     * $COMPLETION_STATUS global
     *
     * @access   public
     */
    public function test_completion_status() {
        global $COMPLETION_STATUS;

        // Get all completion status definitions
        $allconstants = get_defined_constants(true);
        $status_constants = array();
        foreach ($allconstants['user'] as $constant => $value) {
            if (preg_match('/^COMPLETION_STATUS_/', $constant)) {
                $status_constants[] = $value;
            }
        }

        // Check all constants exist in $COMPLETION_STATUS
        $this->assertIdentical($status_constants, array_keys($COMPLETION_STATUS));
    }


    /**
     * Test get_status static method
     *
     * @access  public
     */
    public function test_get_status() {
        $c = new object();

        // Test with empty object
        $this->assertIdentical(completion_completion::get_status($c), '');

        // Test with empty values
        $c->timeenrolled = 0;
        $c->timestarted = 0;
        $c->timecompleted = 0;
        $c->rpl = '';
        $this->assertIdentical(completion_completion::get_status($c), '');

        // Test with a timeenrolled only
        $c->timeenrolled = 1;
        $this->assertIdentical(completion_completion::get_status($c), 'notyetstarted');

        // Test with a timenrolled and a timestarted
        $c->timestarted = 1;
        $this->assertIdentical(completion_completion::get_status($c), 'inprogress');

        // Test with all
        $c->timecompleted = 1;
        $this->assertIdentical(completion_completion::get_status($c), 'complete');

        // Test an rpl
        $c->rpl = 'complete';
        $this->assertIdentical(completion_completion::get_status($c), 'completeviarpl');

        // Test with an rpl but no timeenrolled
        $c->timeenrolled = 0;
        $this->assertIdentical(completion_completion::get_status($c), 'completeviarpl');

        // Test with only a timestarted
        $c->timecompleted = 0;
        unset($c->rpl);
        $this->assertIdentical(completion_completion::get_status($c), 'inprogress');
    }
}


class coursecompletioncriteria_test extends prefix_changing_test_case {

    /**
     * Test all COMPLETION_CRITERIA_TYPE constants are set and in the
     * $COMPLETION_CRITERIA_TYPES global
     *
     * @access   public
     */
    public function test_completion_criteria() {
        global $COMPLETION_CRITERIA_TYPES;

        // Get all completion status definitions
        $allconstants = get_defined_constants(true);
        $type_constants = array();
        foreach ($allconstants['user'] as $constant => $value) {
            if (preg_match('/^COMPLETION_CRITERIA_TYPE_/', $constant)) {
                $type_constants[] = $value;
            }
        }

        // Check all constants exist in $COMPLETION_CRITERIA_TYPES
        $this->assertIdentical($type_constants, array_keys($COMPLETION_CRITERIA_TYPES));
    }


    /**
     * Test all criteria type's are defined
     *
     * @access  public
     */
    public function test_completion_criteria_factory() {
        global $COMPLETION_CRITERIA_TYPES;

        foreach ($COMPLETION_CRITERIA_TYPES as $type => $name) {
            $classname = 'completion_criteria_'.$name;
            $params = new object();
            $params->id = 5;
            $params->criteriatype = $type;

            $result = completion_criteria::factory($params);
            $this->assertIsA($result, $classname);
            $this->assertEqual($result->id, $params->id);
        }
    }
}


class coursecompletioncron_test extends prefix_changing_test_case {

    /**
     * Test completion_cron_aggregate works correctly
     *
     * @access  public
     */
    public function test_completion_cron_aggregate() {
        $all = COMPLETION_AGGREGATION_ALL;
        $any = COMPLETION_AGGREGATION_ANY;


        // Test all
        $state = null;
        completion_cron_aggregate($all, true, $state);
        $this->assertIdentical($state, true);

        completion_cron_aggregate($all, true, $state);
        $this->assertIdentical($state, true);

        completion_cron_aggregate($all, false, $state);
        $this->assertIdentical($state, false);

        completion_cron_aggregate($all, true, $state);
        $this->assertIdentical($state, false);

        $state = null;
        completion_cron_aggregate($all, false, $state);
        $this->assertIdentical($state, false);

        completion_cron_aggregate($all, true, $state);
        $this->assertIdentical($state, false);

        completion_cron_aggregate($all, true, $state);
        $this->assertIdentical($state, false);


        // Test any
        $state = null;
        completion_cron_aggregate($any, false, $state);
        $this->assertIdentical($state, false);

        completion_cron_aggregate($any, false, $state);
        $this->assertIdentical($state, false);

        completion_cron_aggregate($any, true, $state);
        $this->assertIdentical($state, true);

        completion_cron_aggregate($any, false, $state);
        $this->assertIdentical($state, true);
    }
}
