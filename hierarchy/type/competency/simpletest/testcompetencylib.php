<?php // $Id$
/*
**
 * Unit tests for hierarchy/type/competency/lib.php
 *
 * @author Simon Coggins <simonc@catalyst.net.nz>
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

require_once($CFG->dirroot . '/hierarchy/lib.php');
require_once($CFG->dirroot . '/hierarchy/type/competency/lib.php');

require_once($CFG->libdir . '/simpletestlib.php');

class competencylib_test extends prefix_changing_test_case {
    // test data for database
    var $framework_data = array(
        array('id', 'fullname', 'shortname', 'idnumber','description','sortorder','visible',
            'hidecustomfields','showitemfullname','showdepthfullname','timecreated','timemodified','usermodified'),
        array(1, 'Framework 1', 'FW1', 'ID1','Description 1', 1, 1, 0, 1, 1, 1265963591, 1265963591, 2),
        array(2, 'Framework 2', 'FW2', 'ID2','Description 2', 2, 1, 0, 1, 1, 1265963591, 1265963591, 2),
    );

    var $depth_data = array(
        array('id', 'fullname', 'shortname', 'description', 'depthlevel', 'frameworkid', 'timecreated', 'timemodified',
            'usermodified'),
        array(1, 'Depth Level 1', 'Depth 1', 'Description 1', 1, 1, 1265963591, 1265963591, 2),
        array(2, 'Depth Level 2', 'Depth 2', 'Description 2', 2, 1, 1265963591, 1265963591, 2),
        array(3, 'F2 Depth Level 1', 'F2 Depth 1', 'F2 Description 1', 1, 2, 1265963591, 1265963591, 2),
    );

    var $competency_data = array(
        array('id', 'fullname', 'shortname', 'description', 'idnumber', 'frameworkid', 'path', 'depthid', 'parentid',
            'sortorder', 'visible', 'aggregationmethod', 'scaleid', 'proficencyexpected', 'evidencecount', 'timecreated',
            'timemodified', 'usermodified'),
        array(1, 'Competency 1', 'Comp 1', 'Competency Description 1', 'C1', 1, '/1', 1, 0, 1, 1, 1, -1, 1, 0,
            1265963591, 1265963591, 2),
        array(2, 'Competency 2', 'Comp 2', 'Competency Description 2', 'C2', 1, '/1/2', 2, 1, 2, 1, 1, -1, 1, 0,
            1265963591, 1265963591, 2),
        array(3, 'F2 Competency 1', 'F2 Comp 1', 'F2 Competency Description 1', 'F2 C1', 2, '/3', 3, 0, 1, 1, 1, -1, 1, 0,
            1265963591, 1265963591, 2),
        array(4, 'Competency 3', 'Comp 3', 'Competency Description 3', 'C3', 1, '/1/4', 2, 1, 3, 1, 1, -1, 1, 0,
            1265963591, 1265963591, 2),
        array(5, 'Competency 4', 'Comp 4', 'Competency Description 4', 'C4', 1, '/5', 1, 0, 4, 1, 1, -1, 1, 0,
            1265963591, 1265963591, 2),
    );

    var $depth_category_data = array(
        array('id', 'name', 'sortorder', 'depthid'),
        array(1, 'Custom Field Category 1', 1, 2),
    );

    var $depth_field_data = array(
        array('id', 'fullname', 'shortname', 'depthid', 'datatype', 'description', 'sortorder', 'categoryid', 'hidden',
            'locked', 'required', 'forceunique', 'defaultdata', 'param1', 'param2', 'param3', 'param4', 'param5'),
        array(1, 'Custom Field 1', 'CF1', 2, 'checkbox', 'Custom Field Description 1', 1, 1, 0, 0, 0, 0, 0, null, null,
            null, null, null),
    );

    var $depth_data_data = array(
        array('id', 'data', 'fieldid', 'competencyid'),
        array(1, 1, 1, 2),
    );

    var $template_data = array(
        array('id', 'frameworkid', 'fullname', 'shortname', 'description', 'visible', 'competencycount',
            'timecreated', 'timemodified', 'usermodified'),
        array(1, 1, 'Competency Template', 'CompTemp', 'Competency Template Description', 1, 0,
            1265963591, 1265963591, 2),
    );

    var $template_assignment_data = array(
        array('id', 'templateid', 'type', 'instanceid', 'timecreated', 'usermodified'),
        array(1, 1, 1, 1, 126596391, 2),
    );

    var $template_revision_data = array(
        array('id', 'revision', 'competencytemplate', 'ctime', 'postapproval', 'duedate'),
        array(1, 1, 1, 0, 0, 0),
    );

    var $pos_competencies_data = array(
        array('id', 'positionid', 'competencyid', 'templateid', 'timecreated', 'usermodified'),
        array(1, 1, 1, 1, 1265963591, 1265963591),
    );

    function setUp() {
        global $db,$CFG;
        parent::setup();
        load_test_table($CFG->prefix . 'comp_framework', $this->framework_data, $db);
        load_test_table($CFG->prefix . 'comp_depth', $this->depth_data, $db);
        load_test_table($CFG->prefix . 'comp', $this->competency_data, $db);
        load_test_table($CFG->prefix . 'comp_depth_info_category', $this->depth_category_data, $db);
        load_test_table($CFG->prefix . 'comp_depth_info_field', $this->depth_field_data, $db);
        load_test_table($CFG->prefix . 'comp_depth_info_data', $this->depth_data_data, $db);
        load_test_table($CFG->prefix . 'comp_template', $this->template_data, $db);
        load_test_table($CFG->prefix . 'idp_revision_competencytmpl', $this->template_revision_data, $db);
        load_test_table($CFG->prefix . 'comp_template_assignment', $this->template_assignment_data, $db);
        load_test_table($CFG->prefix . 'pos_competencies', $this->pos_competencies_data, $db);

        // create the competency object
        $this->competency = new competency();
        $this->competency->frameworkid = 1;
        // create 2nd competency object with no frameworkid specified
        $this->nofwid = new competency();

        // create some sample objects
        // framework
        $this->fw1 = new stdClass();
        $this->fw1->fullname = 'Framework 1';
        $this->fw1->shortname = 'FW1';
        $this->fw1->idnumber = 'ID1';
        $this->fw1->description = 'Description 1';
        $this->fw1->sortorder = '1';
        $this->fw1->visible = '1';
        $this->fw1->hidecustomfields = '0';
        $this->fw1->showitemfullname = '1';
        $this->fw1->showdepthfullname = '1';
        $this->fw1->timecreated = '1265963591';
        $this->fw1->timemodified = '1265963591';
        $this->fw1->usermodified = '2';
        $this->fw1->id = 1;
        // depth level
        $this->d1 = new stdClass();
        $this->d1->id = 1;
        $this->d1->fullname = 'Depth Level 1';
        $this->d1->shortname = 'Depth 1';
        $this->d1->description = 'Description 1';
        $this->d1->depthlevel = '1';
        $this->d1->frameworkid = '1';
        $this->d1->timecreated = '1265963591';
        $this->d1->timemodified = '1265963591';
        $this->d1->usermodified = '2';
        // competency
        $this->c1 = new stdClass();
        $this->c1->id = '1';
        $this->c1->fullname = 'Competency 1';
        $this->c1->shortname = 'Comp 1';
        $this->c1->description = 'Competency Description 1';
        $this->c1->idnumber = 'C1';
        $this->c1->frameworkid = '1';
        $this->c1->path = '/1';
        $this->c1->depthid = '1';
        $this->c1->parentid = '0';
        $this->c1->sortorder = '1';
        $this->c1->visible = '1';
        $this->c1->aggregationmethod = '1';
        $this->c1->scaleid = '-1';
        $this->c1->evidencecount = '0';
        $this->c1->proficencyexpected = '1';
        $this->c1->timecreated = '1265963591';
        $this->c1->timemodified = '1265963591';
        $this->c1->usermodified = '2';
        // another competency
        $this->c2 = new stdClass();
        $this->c2->id = '1';
        $this->c2->fullname = 'Competency 2';
        $this->c2->shortname = 'Comp 2';
        $this->c2->description = 'Competency Description 2';
        $this->c2->idnumber = 'C2';
        $this->c2->frameworkid = '1';
        $this->c2->path = '/1/2';
        $this->c2->depthid = '2';
        $this->c2->parentid = '1';
        $this->c2->sortorder = '2';
        $this->c2->visible = '1';
        $this->c2->aggregationmethod = '1';
        $this->c2->scaleid = '-1';
        $this->c2->evidencecount = '0';
        $this->c2->proficencyexpected = '1';
        $this->c2->timecreated = '1265963591';
        $this->c2->timemodified = '1265963591';
        $this->c2->usermodified = '2';
        // competency template
        $this->comptemp = new stdClass();
        $this->comptemp->id = '1';
        $this->comptemp->frameworkid = '1';
        $this->comptemp->fullname = 'Competency Template';
        $this->comptemp->shortname = 'CompTemp';
        $this->comptemp->description = 'Competency Template Description';
        $this->comptemp->visible = '1';
        $this->comptemp->competencycount = '0';
        $this->comptemp->timecreated = '1265963591';
        $this->comptemp->timemodified = '1265963591';
        $this->comptemp->usermodified = '2';

    }

    function tearDown() {
        global $db,$CFG;
        remove_test_table($CFG->prefix . 'pos_competencies', $db);
        remove_test_table($CFG->prefix . 'comp_template_assignment', $db);
        remove_test_table($CFG->prefix . 'idp_revision_competencytmpl', $db);
        remove_test_table($CFG->prefix . 'comp_template', $db);
        remove_test_table($CFG->prefix . 'comp_depth_info_data', $db);
        remove_test_table($CFG->prefix . 'comp_depth_info_field', $db);
        remove_test_table($CFG->prefix . 'comp_depth_info_category', $db);
        remove_test_table($CFG->prefix . 'comp', $db);
        remove_test_table($CFG->prefix . 'comp_depth', $db);
        remove_test_table($CFG->prefix . 'comp_framework', $db);
        parent::tearDown();
    }

    function test_competency_get_template() {
        $competency = $this->competency;
        $comptemp = $this->comptemp;
        // should return the correct template if template found
        $this->assertEqual($competency->get_template(1),$comptemp);
        // should return false if no templates found
        $this->assertFalse($competency->get_template(999));
    }

    function test_competency_get_templates() {
        $competency = $this->competency;
        $comptemp = $this->comptemp;
        // should return an array
        $this->assertTrue(is_array($competency->get_templates()));
        // should return the correct number of elements (1 per template)
        $this->assertEqual(count($competency->get_templates()), 1);
        // elements should have the correct form
        $this->assertEqual(current($competency->get_templates()), $comptemp);
        // if given a valid revision id, should correctly set the disabled flag
        $this->assertEqual(current($competency->get_templates(1))->disabled, 1);
        // if given an invalid revision id, should correctly set the disabled flag
        $this->assertEqual(current($competency->get_templates(999))->disabled, 0);
    }

    function test_competency_show_and_hide_template() {
        $competency = $this->competency;
        // should return null
        $this->assertNull($competency->hide_template(1));
        // should now have visible set to zero
        $this->assertEqual(get_field($competency->shortprefix.'_template', 'visible', 'id', 1), 0);
        // should return null
        $this->assertNull($competency->show_template(1));
        // should now have visible set back to one
        $this->assertEqual(get_field($competency->shortprefix.'_template', 'visible', 'id', 1), 1);
    }

    function test_competency_delete_template() {
        $competency = $this->competency;
        $this->assertNull($competency->delete_template(1));
        $this->assertFalse($competency->get_templates());
    }

    function test_competency_get_assigned_to_template() {
        $competency = $this->competency;
        // TODO finish this test
        //var_dump($competency->get_assigned_to_template(1));
    }
}
