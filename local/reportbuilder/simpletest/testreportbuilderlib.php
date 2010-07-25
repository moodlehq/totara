<?php // $Id$
/*
**
 * Unit tests for local/reportbuilder/lib.php
 *
 * @author Simon Coggins <simonc@catalyst.net.nz>
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

require_once($CFG->dirroot . '/local/reportbuilder/lib.php');
require_once($CFG->libdir . '/simpletestlib.php');

class reportbuilderlib_test extends prefix_changing_test_case {
    // test data for database
    var $reportbuilder_data = array(
        array('id', 'fullname', 'shortname', 'source', 'hidden', 'accessmode', 'contentmode','embeddedurl'),
        array(1, 'Test Report', 'test_report', 'competency_evidence', 0, 0, 0, null),
    );

    var $reportbuilder_columns_data = array(
        array('id', 'reportid', 'type', 'value', 'heading', 'sortorder'),
        array(1, 1, 'user', 'namelink', 'Participant', 1),
        array(2, 1, 'competency', 'competencylink', 'Competency', 2),
        array(3, 1, 'user', 'organisation', 'Office', 3),
        array(4, 1, 'competency_evidence', 'organisation', 'Completion Office', 4),
        array(5, 1, 'user', 'position', 'Position', 5),
        array(6, 1, 'competency_evidence', 'position', 'Completion Position', 6),
        array(7, 1, 'competency_evidence', 'proficiency', 'Proficiency', 7),
        array(8, 1, 'competency_evidence', 'completeddate', 'Completion Date', 8),
    );

    var $reportbuilder_filters_data = array(
        array('id', 'reportid', 'type', 'value', 'advanced', 'sortorder'),
        array(1, 1, 'user', 'fullname', 0, 1),
        array(2, 1, 'user', 'organisationid', 0, 2),
        array(3, 1, 'competency_evidence', 'organisationid', 0, 3),
        array(4, 1, 'user', 'positionid', 0, 4),
        array(5, 1, 'competency_evidence', 'positionid', 0, 5),
        array(6, 1, 'competency', 'fullname', 0, 6),
        array(7, 1, 'competency_evidence', 'completeddate', 0, 7),
        array(8, 1, 'competency_evidence', 'proficiencyid', 0, 8),
    );

    var $reportbuilder_settings_data = array(
        array('id', 'reportid', 'type', 'name', 'value'),
        array(1, 1, 'role_access', 'activeroles', '1|2'),
        array(2, 1, 'role_access', 'enable', '1'),
    );

    var $reportbuilder_saved_data = array(
        array('id', 'reportid', 'userid', 'name', 'search', 'public'),
        array(1, 1, 2, 'Saved Search', 'a:1:{s:13:"user-fullname";a:1:{i:0;a:2:{s:8:"operator";i:0;s:5:"value";s:1:"a";}}}', 0),
    );

    var $role_assignments_data = array(
        array('id', 'roleid', 'contextid', 'userid', 'hidden', 'timestart', 'timeend', 'timemodified', 'modifierid', 'enrol', 'sortorder'),
        array(1, 1, 1, 2, 0, 0, 0, 0, 2, 'manual', 0),
    );

    var $context_data = array(
        array('id','contextlevel','instanceid','path','depth'),
        array(1, 10, 0, '/1', 1),
        array(2, 30, 2, '/1/2', 2),
    );

    var $role_data = array(
        array('id', 'name', 'shortname', 'description', 'sortorder'),
        array(1, 'manager', 'manager', '', 1),
    );

    var $user_info_field_data = array(
        array('id', 'shortname', 'name', 'datatype', 'description', 'categoryid', 'sortorder', 'required', 'locked', 'visible', 'forceunique', 'signup', 'defaultdata', 'param1', 'param2', 'param3', 'param4', 'param5'),
        array(1, 'datejoined', 'Date Joined', 'text', '', 1, 1, 0, 0, 1, 0, 0, '', 30, 2048, 0, '', ''),
    );

    var $org_data = array(
        array('id', 'fullname', 'shortname', 'description', 'idnumber', 'frameworkid', 'path', 'depthid', 'parentid', 'sortorder', 'visible', 'timecreated', 'timemodified', 'usermodified'),
        array(1, 'District Office', 'DO', '', '', 1, '/1', 1, 0, 1, 1, 0, 0, 2),
    );

    var $pos_data = array(
        array('id', 'fullname', 'shortname', 'idnumber', 'description', 'frameworkid', 'path', 'depthid', 'parentid', 'sortorder', 'visible', 'timevalidfrom', 'timevalidto', 'timecreated', 'timemodified', 'usermodified'),
        array(1, 'Data Analyst', 'Data Analyst', '', '', 1, '/1', 1, 0, 1, 1, 0, 0, 0, 0, 2),
    );

    var $comp_scale_values_data = array(
        array('id', 'name', 'idnumber', 'description', 'scaleid', 'numeric', 'sortorder', 'timemodified', 'usermodified'),
        array(1, 'Competent', '', '', 1, '', 1, 0, 2),
    );

    // reduced version of user table
    var $user_data = array(
        array('id', 'username', 'firstname', 'lastname'),
        array(1, 'guest', 'Guest', 'User'),
        array(2, 'admin', 'Admin', 'User'),
    );

    // reduced version of pos_assignment table
    var $pos_assignment_data = array(
        array('id', 'fullname','shortname','organisationid','positionid','userid','type'),
        array(1, 'Title', 'Title', null, null, 2, 1),
    );

    function setUp() {
        global $db,$CFG;
        parent::setup();
        load_test_table($CFG->prefix . 'report_builder', $this->reportbuilder_data, $db, 2000);
        load_test_table($CFG->prefix . 'report_builder_columns', $this->reportbuilder_columns_data, $db);
        load_test_table($CFG->prefix . 'report_builder_filters', $this->reportbuilder_filters_data, $db);
        load_test_table($CFG->prefix . 'report_builder_settings', $this->reportbuilder_settings_data, $db);
        load_test_table($CFG->prefix . 'report_builder_saved', $this->reportbuilder_saved_data, $db);
        load_test_table($CFG->prefix . 'role', $this->role_data, $db);
        load_test_table($CFG->prefix . 'user_info_field', $this->user_info_field_data, $db);
        load_test_table($CFG->prefix . 'org', $this->org_data, $db);
        load_test_table($CFG->prefix . 'pos', $this->pos_data, $db);
        load_test_table($CFG->prefix . 'comp_scale_values', $this->comp_scale_values_data, $db);
        load_test_table($CFG->prefix . 'role_assignments', $this->role_assignments_data, $db);
        load_test_table($CFG->prefix . 'context', $this->context_data, $db);
        load_test_table($CFG->prefix . 'user', $this->user_data, $db);
        load_test_table($CFG->prefix . 'pos_assignment', $this->pos_assignment_data, $db);

        $this->embed = new object();
        $this->embed->source = 'competency_evidence';
        $this->embed->fullname = 'My Record of Learning';
        $this->embed->filters = array(); //hide filter block
        $this->embed->columns = array(
            array(
                'type' => 'competency',
                'value' => 'competencylink',
                'heading' => 'Course/Competency',
            ),
            array(
                'type' => 'competency',
                'value' => 'idnumber',
                'heading' => 'Competency ID',
            ),
            array(
                'type' => 'competency_evidence',
                'value' => 'proficiency',
                'heading' => 'Proficiency',
            ),
            array(
                'type' => 'competency_evidence',
                'value' => 'position',
                'heading' => 'Completed As',
            ),
            array(
                'type' => 'competency_evidence',
                'value' => 'organisation',
                'heading' => 'Completed At',
            ),
            array(
                'type' => 'competency_evidence',
                'value' => 'completeddate',
                'heading' => 'Date',
            ),
            array(
                'type' => 'competency_evidence',
                'value' => 'assessor',
                'heading' => 'Assessor',
            ),
            array(
                'type' => 'competency_evidence',
                'value' => 'assessorname',
                'heading' => 'Assessor Organisation',
            ),
        );
        $this->embed->contentmode = 0;
        $this->embed->accessmode = 0;
        $this->embed->embeddedparams = array(
            // show report for a specific user
            'userid' => 2,
        );
        $this->shortname = 'record_of_learning';
        $this->embeddedurl = 'test';

        // db version of report
        $this->rb = new reportbuilder(1);
    }

    function tearDown() {
        global $db,$CFG;
        remove_test_table('mdl_unittest_pos_assignment', $db);
        remove_test_table('mdl_unittest_user', $db);
        remove_test_table('mdl_unittest_context', $db);
        remove_test_table('mdl_unittest_role_assignments', $db);
        remove_test_table('mdl_unittest_comp_scale_values', $db);
        remove_test_table('mdl_unittest_org', $db);
        remove_test_table('mdl_unittest_pos', $db);
        remove_test_table('mdl_unittest_user_info_field', $db);
        remove_test_table('mdl_unittest_role', $db);
        remove_test_table('mdl_unittest_report_builder_saved', $db);
        remove_test_table('mdl_unittest_report_builder_settings', $db);
        remove_test_table('mdl_unittest_report_builder_filters', $db);
        remove_test_table('mdl_unittest_report_builder_columns', $db);
        remove_test_table('mdl_unittest_report_builder', $db);
        parent::tearDown();
    }

    function test_reportbuilder_initialize_db_instance() {

        $rb = $this->rb;
        // should create report builder object with the correct properties
        $this->assertEqual($rb->fullname,'Test Report');
        $this->assertEqual($rb->shortname,'test_report');
        $this->assertEqual($rb->source, 'competency_evidence');
        $this->assertEqual($rb->hidden, 0);
    }

    function test_reportbuilder_initialize_embedded_instance() {
        $rb = new reportbuilder(null, $this->shortname, $this->embed);
        // should create embedded report builder object with the correct properties
        $this->assertEqual($rb->fullname,'My Record of Learning');
        $this->assertEqual($rb->shortname,'record_of_learning');
        $this->assertEqual($rb->source, 'competency_evidence');
        $this->assertEqual($rb->hidden, 1);
    }

    function test_reportbuilder_restore_saved_search() {
        global $SESSION;
        $rb = new reportbuilder(1, null, null, 1);
        // should be able to restore a saved search
        $this->assertTrue($rb->restore_saved_search());
        // the correct SESSION var should now be set
        $filtername = 'filtering_'.$rb->shortname;
        // the SESSION var should be set to the value specified by the saved search
        $this->assertEqual($SESSION->$filtername,
            array('user-fullname' => array(0 => array('operator' => 0, 'value' => 'a'))));
    }

    function test_reportbuilder_get_filters() {
        $rb = $this->rb;
        $filters = $rb->get_filters();
        // should return the current filters for this report
        $this->assertTrue(is_array($filters));
        $this->assertEqual(count($filters), 8);
        $this->assertEqual(current($filters)->type, 'user');
        $this->assertEqual(current($filters)->value, 'fullname');
        $this->assertEqual(current($filters)->advanced, '0');
        $this->assertEqual(current($filters)->label, 'User\'s Full name');
        $this->assertEqual(current($filters)->joins, array('user'));
        $this->assertEqual(current($filters)->selectfunc, null);
    }

    function test_reportbuilder_get_columns() {
        $rb = $this->rb;
        $columns = $rb->get_columns();
        // should return the current columns for this report
        $this->assertTrue(is_array($columns));
        $this->assertEqual(count($columns), 9);
        $this->assertEqual(current($columns)->type, 'user');
        $this->assertEqual(current($columns)->value, 'namelink');
        $this->assertEqual(current($columns)->heading, 'Participant');
    }

    function test_reportbuilder_create_embedded_record() {
        $rb = new reportbuilder(null, $this->shortname, $this->embed);
        // should create a db record for the embedded report
        $this->assertTrue($record = get_record('report_builder', 'shortname', $this->shortname));
        // there should be db records in the columns table
        $this->assertTrue(get_records('report_builder_columns', 'reportid', $record->id));
    }

    function test_reportbuilder_create_shortname() {
        $shortname1 = reportbuilder::create_shortname('name');
        $shortname2 = reportbuilder::create_shortname('My Report with special chars\'"%$*[]}~');
        $shortname3 = reportbuilder::create_shortname('Space here');
        // should prepend 'report_' to name
        $this->assertEqual($shortname1, 'report_name');
        // special chars should be stripped
        $this->assertEqual($shortname2, 'report_my_report_with_special_chars');
        // spaces should be replaced with underscores and upper case moved to lower case
        $this->assertEqual($shortname3, 'report_space_here');
        // create a db entry
        $rb = new reportbuilder(null, $shortname3, $this->embed);
        $existingname = reportbuilder::create_shortname('space_here');
        // should append numbers to suggestion if shortname already exists
        $this->assertEqual($existingname, 'report_space_here1');
    }

    function test_reportbuilder_report_url() {
        global $CFG;
        $rb = $this->rb;
        // a normal report should return the report.php url
        $this->assertEqual(substr($rb->report_url(),strlen($CFG->wwwroot)),'/local/reportbuilder/report.php?id=1');
        $rb2 = new reportbuilder(null, $this->shortname, $this->embed);
        // an embedded report should return the embedded url (this page)
        $this->assertEqual($rb2->report_url(),qualified_me());
    }


    // not tested as difficult to do in a useful way
    // get_current_url() not tested
    // leaving get_current_admin_options() until after changes to capabilities

    function test_reportbuilder_get_current_params() {
        $rb = new reportbuilder(null, $this->shortname, $this->embed);
        $paramoption = new object();
        $paramoption->name = 'userid';
        $paramoption->field = 'base.userid';
        $paramoption->joins = null;
        $param = new rb_param('userid',array($paramoption));
        $param->value = 2;
        // should return the expected embedded param
        $this->assertEqual($rb->get_current_params(), array($param));
    }


    // display_search() and get_sql_filter() not tested as they print output directly to screen

    function test_reportbuilder_is_capable() {
        $rb = $this->rb;
        // should return true if accessmode is zero
        $this->assertTrue($rb->is_capable(1));
        $todb = new object();
        $todb->id = 1;
        $todb->accessmode = 1;
        update_record('report_builder',$todb);
        // should return true if accessmode is 1 and admin an allowed role
        $this->assertTrue($rb->is_capable(1));
        // should return false if access mode is 1 and admin not an allowed role
        delete_records('report_builder_settings','reportid',1);
        $this->assertFalse($rb->is_capable(1));
        $todb = new object();
        $todb->reportid = 1;
        $todb->type = 'role_access';
        $todb->name = 'activeroles';
        $todb->value = 1;
        insert_record('report_builder_settings',$todb);
        $todb = new object();
        $todb->reportid = 1;
        $todb->type = 'role_access';
        $todb->name = 'enable';
        $todb->value = '1';
        insert_record('report_builder_settings', $todb);
        // should return true if accessmode is 1 and admin is only allowed role
        $this->assertTrue($rb->is_capable(1));
    }

    function test_reportbuilder_get_param_restrictions() {
        $rb = new reportbuilder(null, $this->shortname, $this->embed);
        // should return the correct SQL fragment if a parameter restriction is set
        $this->assertEqual($rb->get_param_restrictions(),'(base.userid = 2)');
    }

    function test_reportbuilder_get_content_restrictions() {
        $rb = $this->rb;
        // should return ( TRUE ) if content mode = 0
        $this->assertEqual($rb->get_content_restrictions(),'( TRUE )');
        $todb = new object();
        $todb->id = 1;
        $todb->contentmode = 1;
        update_record('report_builder', $todb);
        $rb = new reportbuilder(1);
        // should return (FALSE) if content mode = 1 but no restrictions set
        $this->assertEqual($rb->get_content_restrictions(),'(FALSE)');
        $todb = new object();
        $todb->reportid = 1;
        $todb->type = 'date_content';
        $todb->name = 'enable';
        $todb->value = 1;
        insert_record('report_builder_settings', $todb);
        $todb->name = 'when';
        $todb->value = 'future';
        insert_record('report_builder_settings', $todb);
        $todb->type = 'user_content';
        $todb->name = 'enable';
        $todb->value = 1;
        insert_record('report_builder_settings', $todb);
        $todb->name = 'who';
        $todb->value = 'own';
        insert_record('report_builder_settings', $todb);
        $rb = new reportbuilder(1);
        // should return the appropriate SQL snippet to OR the restrictions if content mode = 1
        $this->assertPattern('/(base\.userid = 2 OR base\.timemodified > \d+)/',$rb->get_content_restrictions());
        $todb = new object();
        $todb->id = 1;
        $todb->contentmode = 2;
        update_record('report_builder', $todb);
        $rb = new reportbuilder(1);
        // should return the appropriate SQL snippet to AND the restrictions if content mode = 2
        $this->assertPattern('/(base\.userid = 2 AND base\.timemodified > \d+)/',$rb->get_content_restrictions());

    }

    function test_reportbuilder_get_restriction_descriptions() {
        global $USER;
        $rb = $this->rb;
        // should return empty array if content mode = 0
        $this->assertEqual($rb->get_restriction_descriptions('content'), array());
        $todb = new object();
        $todb->id = 1;
        $todb->contentmode = 1;
        update_record('report_builder', $todb);
        $rb = new reportbuilder(1);
        // should return an array with empty string if content mode = 1 but no restrictions set
        $this->assertEqual($rb->get_restriction_descriptions('content'), array(''));
        $todb = new object();
        $todb->reportid = 1;
        $todb->type = 'date_content';
        $todb->name = 'enable';
        $todb->value = 1;
        insert_record('report_builder_settings', $todb);
        $todb->name = 'when';
        $todb->value = 'future';
        insert_record('report_builder_settings', $todb);
        $todb->type = 'user_content';
        $todb->name = 'enable';
        $todb->value = 1;
        insert_record('report_builder_settings', $todb);
        $todb->name = 'who';
        $todb->value = 'own';
        insert_record('report_builder_settings', $todb);
        $rb = new reportbuilder(1);
        // should return the appropriate text description if content mode = 1
        $this->assertPattern('/The user is "Admin User" or The completion date occurred after .*/', current($rb->get_restriction_descriptions('content')));
        $todb = new object();
        $todb->id = 1;
        $todb->contentmode = 2;
        update_record('report_builder', $todb);
        $rb = new reportbuilder(1);
        // should return the appropriate array of text descriptions if content mode = 2
        $restrictions = $rb->get_restriction_descriptions('content');
        $firstrestriction = current($restrictions);
        $secondrestriction = next($restrictions);
        $this->assertPattern('/^The user is "Admin User"$/', $firstrestriction);
        $this->assertPattern('/^The completion date occurred after/', $secondrestriction);
    }

    function test_reportbuilder_get_column_fields() {
        $rb = $this->rb;
        $columns = $rb->get_column_fields();
        // should return an array
        $this->assertTrue(is_array($columns));
        // the array should contain the correct number of columns
        $this->assertEqual(count($columns), 11);
        // the strings should have the correct format
        $this->assertEqual(current($columns), "''||u.firstname||' '||u.lastname AS user_namelink");
    }

    function test_reportbuilder_get_joins() {
        $rb = $this->rb;
        $obj1 = new stdClass();
        $obj1->joins = array('user','competency');
        $obj2 = new stdClass();
        $obj2->joins = 'position';
        $columns = $rb->get_joins($obj1, 'test');
        // should return an array
        $this->assertTrue(is_array($columns));
        // the array should contain the correct number of columns
        $this->assertEqual(count($columns), 2);
        // the strings should have the correct format
        $this->assertEqual($columns['user'], 'LEFT JOIN mdl_unittest_user u ON base.userid = u.id');
        // should also work with string instead of array
        $columns2 = $rb->get_joins($obj2, 'test');
        $this->assertTrue(is_array($columns2));
        // the array should contain the correct number of columns
        $this->assertEqual(count($columns2), 1);
        // the strings should have the correct format
        $this->assertEqual($columns2['position'], 'LEFT JOIN mdl_unittest_pos position
                ON position.id = pa.positionid');

    }

    function test_reportbuilder_get_content_joins() {
        $rb = $this->rb;
        // should return an empty array if content mode = 0
        $this->assertEqual($rb->get_content_joins(),array());
        // TODO test other options
        // can't do with competency evidence as no joins required
    }

    function test_reportbuilder_get_column_joins() {
        $rb = $this->rb;
        $columns = $rb->get_column_joins();
        // should return an array
        $this->assertTrue(is_array($columns));
        // the array should contain the correct number of columns
        $this->assertEqual(count($columns), 8);
        // the strings should have the correct format
        $this->assertEqual(current($columns), 'LEFT JOIN mdl_unittest_user u ON base.userid = u.id');
    }

    function test_reportbuilder_get_filter_joins() {
        global $SESSION;
        $rb = $this->rb;
        // set a filter session var
        $filtername = 'filtering_'.$rb->shortname;
        $SESSION->$filtername = array('user-fullname' => 'unused', 'user-positionid' => 'unused');
        $columns = $rb->get_filter_joins();
        // should return an array
        $this->assertTrue(is_array($columns));
        // the array should contain the correct number of columns
        $this->assertEqual(count($columns), 2);
        // the strings should have the correct format
        $this->assertEqual($columns['user'], 'LEFT JOIN mdl_unittest_user u ON base.userid = u.id');
        unset($SESSION->$filtername);
    }

    function test_reportbuilder_sort_join() {
        $rb = $this->rb;
        // should return the correct values for valid joins
        $this->assertEqual($rb->sort_join('user','position_assignment'),-1);
        $this->assertEqual($rb->sort_join('position_assignment','user'), 1);
        $this->assertEqual($rb->sort_join('user','user'), 0);
        // should throw errors if invalid keys provided
        $this->expectError('Missing array key in sort_join(). Add \'junk\' to order array.');
        $this->assertEqual($rb->sort_join('user', 'junk'), -1);
        $this->expectError('Missing array key in sort_join(). Add \'junk\' to order array.');
        $this->assertEqual($rb->sort_join('junk', 'user'), 1);
        $this->expectError('Missing array keys in sort_join(). Add \'junk\' and \'junk2\' to order array.');
        $this->assertEqual($rb->sort_join('junk', 'junk2'), 0);
    }

    function test_reportbuilder_build_query() {
        global $SESSION;
        $filtername = 'filtering_test_report';
        // create a complex set of filtering criteria
        $SESSION->$filtername = array(
            'user-fullname' => array(
                'operator' => 0,
                'value' => 'John',
            ),
            'user-organisationid' => array(
                'operator' => 1,
                'value' => '21,1,106,111,112,113,2,211,212,213,3,311,312,313,4,411,412,413,812,6,611,612,613,7,711,712,713,714,9,813,911,912,913,914',
            ),
            'competency-fullname' => array(
                'operator' => 0,
                'value' => 'fire',
            ),
            'competency_evidence-completeddate' => array(
                'after' => 0,
                'before' => 1271764800,
            ),
            'competency_evidence-proficiencyid' => array(
                'operator' => 1,
                'value' => '3',
            ),
        );
        $rb = $this->rb;

        $sql_count_filtered = $rb->build_query(true, true);
        $sql_count_unfiltered = $rb->build_query(true, false);
        $sql_query_filtered = $rb->build_query(false, true);
        $sql_query_unfiltered = $rb->build_query(false, false);
        // if counting records, the SQL should include the string "count(*)"
        $this->assertPattern('/count\(\*\)/i', $sql_count_filtered);
        $this->assertPattern('/count\(\*\)/i', $sql_count_unfiltered);
        // if not counting records, the SQL should not include the string "count(*)"
        $this->assertNoPattern('/count\(\*\)/i', $sql_query_filtered);
        $this->assertNoPattern('/count\(\*\)/i', $sql_query_unfiltered);
        // if not filtered, the SQL should include the string "where (true) " with no other clauses
        $this->assertPattern('/where \(\s+true\s+\)\s*/i', $sql_count_unfiltered);
        $this->assertPattern('/where \(\s+true\s+\)\s*/i', $sql_query_unfiltered);
        // hard to do further testing as no actual data or tables exist
    }

    // can't test the following functions as data and tables don't exist
    // get_full_count()
    // get_filtered_count()
    // export_data()
    // display_table()
    // fetch_data()
    // add_admin_columns()


    function test_reportbuilder_check_sort_keys() {
        global $SESSION;
        // set a bad sortorder key
        $SESSION->flextable['test_report']->sortby['bad_key'] = 4;
        $before = count($SESSION->flextable['test_report']->sortby);
        $rb = $this->rb;
        // run the function
        $rb->check_sort_keys();
        $after = count($SESSION->flextable['test_report']->sortby);
        // the bad sort key should have been deleted
        $this->assertEqual($before - $after, 1);
    }

    function test_reportbuilder_strip_tags_r() {
        $nested = array(
            array(
                'test' => array('contents','at','many','depths'),
                'another' => array('some associative', 'some not'),
            ),
            array(
                '<b>should strip tags</b>',
                '<a href="#">even here</a>',
                '<br />',
            ),
        );
        $rb = $this->rb;
        // should return the array with tags stripped at all depth levels
        $this->assertEqual(current(end($rb->strip_tags_r($nested))),'should strip tags');
        $this->assertEqual(next(end($rb->strip_tags_r($nested))), 'even here');
    }

    // skipping tests for the following as they just print HTML
    // export_select()
    // export_buttons()
    // view_button()
    // save_button()
    // saved_menu()
    // edit_button()

    // skipping tests for the following as they output files
    // download_ods()
    // download_csv()
    // download_xls()


    function test_reportbuilder_get_content_options() {
        $rb = $this->rb;
        $contentoptions = $rb->get_content_options();
        // should return an array of content options
        $this->assertTrue(is_array($contentoptions));
        // should have the appropriate format
        $this->assertEqual(current($contentoptions), 'current_org');
    }

    function test_reportbuilder_get_filters_select() {
        $rb = $this->rb;
        $options = $rb->get_filters_select();
        // should return an array
        $this->assertTrue(is_array($options));
        // the strings should have the correct format
        $this->assertEqual($options['user-fullname'], "User's Full name");
    }

    function test_reportbuilder_get_columns_select() {
        $rb = $this->rb;
        $options = $rb->get_columns_select();
        // should return an array
        $this->assertTrue(is_array($options));
        // the strings should have the correct format
        $this->assertEqual($options['user-fullname'], 'User Fullname');
    }

    function test_reportbuilder_delete_column() {
        $rb = $this->rb;
        $before = count($rb->columns);
        $rb->delete_column(999);
        $afterfail = count($rb->columns);
        // should not delete column if cid doesn't match
        $this->assertEqual($before - $afterfail, 0);
        // should return true if successful
        $this->assertTrue($rb->delete_column(4));
        $after = count($rb->columns);
        // should be one less column after successful delete operation
        $this->assertEqual($before - $after, 1);
    }

    function test_reportbuilder_delete_filter() {
        $rb = $this->rb;
        $before = count($rb->filters);
        $rb->delete_filter(999);
        $afterfail = count($rb->filters);
        // should not delete filter if fid doesn't match
        $this->assertEqual($before - $afterfail, 0);
        // should return true if successful
        $this->assertTrue($rb->delete_filter(4));
        $after = count($rb->filters);
        // should be one less filter after successful delete operation
        $this->assertEqual($before - $after, 1);
    }

    function test_reportbuilder_move_column() {
        $rb = $this->rb;
        reset($rb->columns);
        $firstbefore = current($rb->columns);
        $secondbefore = next($rb->columns);
        $thirdbefore = next($rb->columns);
        // should not be able to move first column up
        $this->assertFalse($rb->move_column(1, 'up'));
        reset($rb->columns);
        $firstafter = current($rb->columns);
        $secondafter = next($rb->columns);
        $thirdafter = next($rb->columns);
        // columns should not change if trying to do a bad column move
        $this->assertEqual($firstbefore, $firstafter);
        $this->assertEqual($secondbefore, $secondafter);
        // should be able to move first column down
        $this->assertTrue($rb->move_column(1, 'down'));
        reset($rb->columns);
        $firstafter = current($rb->columns);
        $secondafter = next($rb->columns);
        $thirdafter = next($rb->columns);
        // columns should change if move is valid
        $this->assertNotEqual($firstbefore, $firstafter);
        // moved columns should have swapped
        $this->assertEqual($firstbefore, $secondafter);
        $this->assertEqual($secondbefore, $firstafter);
        // unmoved columns should stay the same
        $this->assertEqual($thirdbefore, $thirdafter);
    }

    function test_reportbuilder_move_filter() {
        $rb = $this->rb;
        reset($rb->filters);
        $firstbefore = current($rb->filters);
        $secondbefore = next($rb->filters);
        $thirdbefore = next($rb->filters);
        // should not be able to move first filter up
        $this->assertFalse($rb->move_filter(1, 'up'));
        reset($rb->filters);
        $firstafter = current($rb->filters);
        $secondafter = next($rb->filters);
        $thirdafter = next($rb->filters);
        // filters should not change if trying to do a bad filter move
        $this->assertEqual($firstbefore, $firstafter);
        $this->assertEqual($secondbefore, $secondafter);
        // should be able to move first filter down
        $this->assertTrue($rb->move_filter(1, 'down'));
        reset($rb->filters);
        $firstafter = current($rb->filters);
        $secondafter = next($rb->filters);
        $thirdafter = next($rb->filters);
        // filters should change if move is valid
        $this->assertNotEqual($firstbefore, $firstafter);
        // moved filters should have swapped
        $this->assertEqual($firstbefore, $secondafter);
        $this->assertEqual($secondbefore, $firstafter);
        // unmoved filters should stay the same
        $this->assertEqual($thirdbefore, $thirdafter);
    }

}

