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
        array('id', 'fullname', 'shortname', 'source','filters','columns','hidden','accessmode', 'contentmode', 'contentsettings', 'accesssettings'),
        array(1, 'Test Report', 'test_report', 'competency_evidence','a:8:{i:0;a:3:{s:4:"type";s:4:"user";s:5:"value";s:8:"fullname";s:8:"advanced";i:0;}i:1;a:3:{s:4:"type";s:4:"user";s:5:"value";s:14:"organisationid";s:8:"advanced";i:0;}i:2;a:3:{s:4:"type";s:19:"competency_evidence";s:5:"value";s:14:"organisationid";s:8:"advanced";i:0;}i:3;a:3:{s:4:"type";s:4:"user";s:5:"value";s:10:"positionid";s:8:"advanced";i:0;}i:4;a:3:{s:4:"type";s:19:"competency_evidence";s:5:"value";s:10:"positionid";s:8:"advanced";i:0;}i:5;a:3:{s:4:"type";s:10:"competency";s:5:"value";s:8:"fullname";s:8:"advanced";i:0;}i:6;a:3:{s:4:"type";s:19:"competency_evidence";s:5:"value";s:13:"completeddate";s:8:"advanced";i:0;}i:7;a:3:{s:4:"type";s:19:"competency_evidence";s:5:"value";s:13:"proficiencyid";s:8:"advanced";i:0;}}', 'a:8:{i:0;a:3:{s:4:"type";s:4:"user";s:5:"value";s:8:"namelink";s:7:"heading";s:11:"Participant";}i:1;a:3:{s:4:"type";s:10:"competency";s:5:"value";s:14:"competencylink";s:7:"heading";s:10:"Competency";}i:2;a:3:{s:4:"type";s:4:"user";s:5:"value";s:12:"organisation";s:7:"heading";s:6:"Office";}i:3;a:3:{s:4:"type";s:19:"competency_evidence";s:5:"value";s:12:"organisation";s:7:"heading";s:17:"Completion Office";}i:4;a:3:{s:4:"type";s:4:"user";s:5:"value";s:8:"position";s:7:"heading";s:8:"Position";}i:5;a:3:{s:4:"type";s:19:"competency_evidence";s:5:"value";s:8:"position";s:7:"heading";s:19:"Completion Position";}i:6;a:3:{s:4:"type";s:19:"competency_evidence";s:5:"value";s:11:"proficiency";s:7:"heading";s:11:"Proficiency";}i:7;a:3:{s:4:"type";s:19:"competency_evidence";s:5:"value";s:13:"completeddate";s:7:"heading";s:15:"Completion Date";}}', 0, 0, 0, '', ''),
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

    function setUp() {
        global $db,$CFG;
        parent::setup();
        load_test_table($CFG->prefix . 'report_builder', $this->reportbuilder_data, $db, 2000);
        load_test_table($CFG->prefix . 'role', $this->role_data, $db);
        load_test_table($CFG->prefix . 'user_info_field', $this->user_info_field_data, $db);
        load_test_table($CFG->prefix . 'org', $this->org_data, $db);
        load_test_table($CFG->prefix . 'pos', $this->pos_data, $db);
        load_test_table($CFG->prefix . 'comp_scale_values', $this->comp_scale_values_data, $db);

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

    }

    function tearDown() {
        global $db,$CFG;
        remove_test_table('mdl_unittest_comp_scale_values', $db);
        remove_test_table('mdl_unittest_org', $db);
        remove_test_table('mdl_unittest_pos', $db);
        remove_test_table('mdl_unittest_user_info_field', $db);
        remove_test_table('mdl_unittest_role', $db);
        remove_test_table('mdl_unittest_report_builder', $db);
        parent::tearDown();
    }

    function test_reportbuilder_initialize_db_instance() {

        $rb = new reportbuilder('test_report');
        // should create report builder object with the correct properties
        $this->assertEqual($rb->fullname,'Test Report');
        $this->assertEqual($rb->shortname,'test_report');
        $this->assertEqual($rb->source, 'competency_evidence');
        $this->assertEqual($rb->hidden, 0);
    }

    function test_reportbuilder_initialize_embedded_instance() {
        $rb = new reportbuilder($this->shortname, $this->embed);
        // should create embedded report builder object with the correct properties
        $this->assertEqual($rb->fullname,'My Record of Learning');
        $this->assertEqual($rb->shortname,'record_of_learning');
        $this->assertEqual($rb->source, 'competency_evidence');
        $this->assertEqual($rb->hidden, null);
    }

    function test_reportbuilder_check_columns() {
        $rb = new reportbuilder('test_report');
        // add an invalid column to object
        $rb->columns[] = array('type'=>'invalid','value'=>'position','heading'=>'Position');
        // run check_columns, storing number of columns before and after call
        $before = count($rb->columns);
        $rb->check_columns(true);
        $after = count($rb->columns);
        // should have removed one invalid column
        $this->assertEqual($before - $after, 1);
    }

    // get_current_url() not tested
    // leaving get_current_admin_options() until after changes to capabilities

    function test_reportbuilder_get_current_params() {
        $rb = new reportbuilder($this->shortname, $this->embed);
        $param = array(array('field' => 'base.userid','joins'=>array(),'value'=>2));
        // should return the expected embedded param
        $this->assertEqual($rb->get_current_params(), $param);
    }

    function test_reportbuilder_get_source_data() {
        $rb = new reportbuilder('test_report');
        // should return the base table string from the source file
        $this->assertEqual($rb->get_source_data('base', $rb->source),'mdl_unittest_comp_evidence base');
    }

    // display_search() and get_sql_filter() not tested as they print output directly to screen

    function test_reportbuilder_get_param_restrictions() {
        $rb = new reportbuilder($this->shortname, $this->embed);
        // should return the correct SQL fragment if a parameter restriction is set
        $this->assertEqual($rb->get_param_restrictions(),'(base.userid = 2)');
    }

    function test_reportbuilder_get_column_fields() {
        $rb = new reportbuilder('test_report');
        $columns = $rb->get_column_fields();
        // should return an array
        $this->assertTrue(is_array($columns));
        // the array should contain the correct number of columns
        $this->assertEqual(count($columns), 8);
        // the strings should have the correct format
        $this->assertEqual(current($columns), "u.id AS user_id, ''||u.firstname||' '||u.lastname AS user_namelink");
    }

    function test_reportbuilder_get_admin_fields() {
        $rb = new reportbuilder('test_report');
        $columns = $rb->get_admin_fields();
        // should return an array
        $this->assertTrue(is_array($columns));
        // the array should contain the correct number of columns
        $this->assertEqual(count($columns), 2);
        // the strings should have the correct format
        $this->assertEqual(current($columns), 'base.userid AS settings_user');
    }

    function test_reportbuilder_get_joins() {
        $rb = new reportbuilder('test_report');
        $inputs = array(
            array(
                'joins' => array('user','competency'),
            ),
            array(
                'joins' => array('position'),
            ),
        );
        $columns = $rb->get_joins($inputs, 'test');
        // should return an array
        $this->assertTrue(is_array($columns));
        // the array should contain the correct number of columns
        $this->assertEqual(count($columns), 3);
        // the strings should have the correct format
        $this->assertEqual($columns['user'], 'LEFT JOIN mdl_unittest_user u ON base.userid = u.id');
    }

    function test_reportbuilder_get_column_joins() {
        $rb = new reportbuilder('test_report');
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
        $rb = new reportbuilder('test_report');
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
        $rb = new reportbuilder('test_report');
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
        $rb = new reportbuilder('test_report');

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
        $this->assertPattern('/where \( true \) *$/i', $sql_count_unfiltered);
        $this->assertPattern('/where \( true \) *$/i', $sql_query_unfiltered);
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
        $rb = new reportbuilder('test_report');
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
        $rb = new reportbuilder('test_report');
        // should return the array with tags stripped at all depth levels
        $this->assertEqual(current(end($rb->strip_tags_r($nested))),'should strip tags');
        $this->assertEqual(next(end($rb->strip_tags_r($nested))), 'even here');
    }

    // skipping tests for the following as they just print HTML
    // export_select()
    // export_buttons()

    // skipping tests for the following as they output files
    // download_ods()
    // download_csv()
    // download_xls()

    function test_reportbuilder_get_filters_select() {
        $rb = new reportbuilder('test_report');
        $options = $rb->get_filters_select();
        // should return an array
        $this->assertTrue(is_array($options));
        // the strings should have the correct format
        $this->assertEqual($options['user-fullname'], 'Participant Name');
    }

    function test_reportbuilder_get_columns_select() {
        $rb = new reportbuilder('test_report');
        $options = $rb->get_columns_select();
        // should return an array
        $this->assertTrue(is_array($options));
        // the strings should have the correct format
        $this->assertEqual($options['user-fullname'], 'User Fullname');
    }

    function test_reportbuilder_delete_column() {
        $rb = new reportbuilder('test_report');
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
        $rb = new reportbuilder('test_report');
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
        $rb = new reportbuilder('test_report');
        $before = $rb->columns;
        $rb->move_column(0, 'up');
        $after = $rb->columns;
        // columns should not change if trying to do a bad column move
        $this->assertEqual($before, $after);
        $rb->move_column(0, 'down');
        $after = $rb->columns;
        // columns should change if move is valid
        $this->assertNotEqual($before, $after);
        // moved columns should have swapped
        $this->assertEqual($before[0], $after[1]);
        $this->assertEqual($before[1], $after[0]);
        // unmoved columns should stay the same
        $this->assertEqual($before[2], $after[2]);
    }

    function test_reportbuilder_move_filter() {
        $rb = new reportbuilder('test_report');
        $before = $rb->filters;
        $rb->move_filter(0, 'up');
        $after = $rb->filters;
        // filters should not change if trying to do a bad filter move
        $this->assertEqual($before, $after);
        $rb->move_filter(0, 'down');
        $after = $rb->filters;
        // filters should change if move is valid
        $this->assertNotEqual($before, $after);
        // moved filters should have swapped
        $this->assertEqual($before[0], $after[1]);
        $this->assertEqual($before[1], $after[0]);
        // unmoved filters should stay the same
        $this->assertEqual($before[2], $after[2]);
    }

}

