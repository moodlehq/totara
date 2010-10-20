<?php // $Id$
/*
**
 * Unit tests to check source column definitions
 *
 * @author Simon Coggins <simonc@catalyst.net.nz>
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

require_once($CFG->dirroot . '/local/reportbuilder/lib.php');
require_once($CFG->libdir . '/simpletestlib.php');

class columns_test extends prefix_changing_test_case {
    // test data for database
    var $reportbuilder_data = array(
        array('id', 'fullname', 'shortname', 'source', 'hidden', 'accessmode', 'contentmode','embeddedurl','description', 'recordsperpage', 'defaultsortcolumn', 'defaultsortorder'),
        array(1, 'Test Report', 'test_report', 'competency_evidence', 0, 0, 0, null,'', 40, 'user_namelink', 4),
    );

    var $config_data = array(
        array('id','name','value'),
        array(1, 'facetoface_sessionroles', '1'),
    );

    var $reportbuilder_columns_data = array(
        array('id', 'reportid', 'type', 'value', 'heading', 'sortorder', 'hidden'),
        array(1, 1, 'user', 'namelink', 'Participant', 1, 0),
    );

    var $reportbuilder_filters_data = array(
        array('id', 'reportid', 'type', 'value', 'advanced', 'sortorder'),
        array(1, 1, 'user', 'fullname', 0, 1),
    );

    var $reportbuilder_settings_data = array(
        array('id', 'reportid', 'type', 'name', 'value'),
        array(1, 1, 'rb_role_access', 'activeroles', '1|2'),
        array(2, 1, 'rb_role_access', 'enable', '1'),
    );

    var $reportbuilder_group_data = array(
        array('id', 'name', 'preproc', 'baseitem', 'assigntype', 'assignvalue'),
        array(1, 'My Group', 'test', 'something', 'else', 1),
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

    var $user_info_data_data = array(
        array('id', 'userid', 'fieldid', 'data'),
        array(1, 2, 1, 'test'),
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
        array('id', 'username', 'firstname', 'lastname', 'idnumber', 'picture', 'imagealt'),
        array(2, 'admin', 'Admin', 'User', 'ID2', 0, 'alt'),
    );

    var $pos_assignment_data = array(
        array('id', 'fullname','shortname','idnumber', 'description', 'timevalidfrom', 'timevalidto', 'timecreated',
            'timemodified', 'usermodified', 'organisationid','positionid','userid','reportstoid', 'type'),
        array(1, 'Title', 'Title', 'ID1', 'Desc', 0, 0, 1265963637, 1265963736, 2, 1, 2, 1, 1, 1),
    );

    var $f2f_session_field_data = array(
        array('id', 'name', 'shortname', 'type', 'possiblevalues', 'required', 'defaultvalue', 'isfilter', 'showinsummary'),
        array(1, 'Location', 'location', 0, '', 0, '', 1, 1),
    );

    var $f2f_session_data_data = array(
        array('id', 'fieldid', 'sessionid', 'data'),
        array(1, 1, 1, 'Training Centre'),
    );

    var $course_completions_data = array(
        array('id', 'userid', 'course', 'organisationid', 'positionid', 'deleted', 'timenotified', 'timestarted',
            'timeenrolled', 'timecompleted', 'reaggregate', 'rpl'),
        array(1, 1, 1, 1, 1, 0, 0, 1140606000, 1140606000, 1140606000, 0, ''),
    );

    var $course_completion_criteria_data = array(
        array('id', 'course', 'criteriatype', 'gradepass'),
        array(1, 2, 6, 50),
    );

    var $course_completion_crit_compl_data = array(
        array('id', 'userid', 'course', 'criteriaid', 'gradefinal', 'deleted'),
        array(1, 2, 2, 1, 80, 0),
    );

    var $log_data = array(
        array('id','time','userid','ip','course','module','cmid','action','url','info'),
        array(1, 1140606000, 2, '192.168.2.133', 1, 'user', 0, 'update', 'view.php', 1),
    );

    // reduced version of course table
    var $course_data = array(
        array('id','fullname','shortname','category','idnumber','startdate','icon','visible','summary'),
        array(1, 'Test Course 1', 'TC1', 1, 'ID1', 1140606000,'icon.gif',1,'Course summary'),
    );

    // reduced version of feedback table
    var $feedback_data = array(
        array('id', 'course', 'name'),
        array(1, 1, 'Feedback'),
    );

    var $feedback_item_data = array(
        array('id', 'feedback', 'template', 'name', 'presentation', 'typ', 'hasvalue', 'position', 'required'),
        array(1, 1, 0, 'Question', 'A\r|B\r|C\r', 'radio', 1, 1, 0),
    );

    var $feedback_completed_data = array(
        array('id', 'feedback', 'userid', 'timemodified'),
        array(1, 1, 2, 1140606000),
    );

    var $feedback_value_data = array(
        array('id', 'course_id', 'item', 'completed', 'value'),
        array(1, 0, 1, 1, 2),
    );

    var $tag_instance_data = array(
        array('id', 'tagid', 'itemtype', 'itemid'),
        array(1, 1, 'feedback', 1),
    );

    var $tag_data = array(
        array('id', 'userid', 'name', 'tagtype'),
        array(1, 2, 'Tag', 'official'),
    );

    // reduced version of course cats table
    var $course_categories_data = array(
        array('id', 'name', 'parent','sortorder','icon'),
        array(1, 'Misc', 0, 1,'icon.gif'),
    );

    // competency test data

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

    var $dummy_data = array(
        array('id', 'competency', 'competencyid','competencycount','instanceid','templateid','id1','id2','proficiency',
            'timemodified','organisationid', 'positionid','assessorid','assessorname', 'userid'),
        array(1, 1, 1, 1, 1, 1, 1, 2, 1, 0, 1, 1, 1, 'Name', 2),
    );

    // partial f2f table
    var $f2f_data = array(
        array('id', 'course', 'name', 'shortname','details'),
        array(1, 1, 'F2F name', 'f2f','details'),
    );

    // partial f2f table
    var $f2f_session_data = array(
        array('id', 'facetoface', 'capacity', 'details', 'duration'),
        array(1, 1, 10, 'details', 60),
    );

    // partial f2f table
    var $f2f_session_dates_data = array(
        array('id', 'sessionid', 'timestart', 'timefinish'),
        array(1, 1, 1140519599, 1140519600),
    );

    // partial f2f table
    var $f2f_signups_data = array(
        array('id', 'sessionid', 'userid'),
        array(1, 1, 2),
    );

    // partial f2f table
    var $f2f_signup_status_data = array(
        array('id', 'signupid', 'statuscode', 'superceded', 'grade'),
        array(1, 1, 70, 0, 100),
    );

    // partial f2f table
    var $f2f_session_roles_data = array(
        array('id', 'sessionid', 'roleid', 'userid'),
        array(1, 1, 1, 2),
    );

    var $scorm_data = array(
        array('id', 'course', 'name'),
        array(1, 1, 'Scorm'),
    );

    var $scorm_scoes_data = array(
        array('id', 'scorm', 'title'),
        array(1, 1, 'SCO'),
    );

    var $scorm_scoes_track_data = array(
        array('id', 'userid', 'scormid', 'scoid', 'attempt', 'element', 'value', 'timemodified'),
        array(1, 2, 1, 1, 1, 'cmi.core.lesson_status', 'done', 1205445539),
        array(1, 2, 1, 1, 1, 'cmi.core.score.raw', '100', 1205445539),
        array(1, 2, 1, 1, 1, 'cmi.core.score.min', '10', 1205445539),
        array(1, 2, 1, 1, 1, 'cmi.core.score.max', '90', 1205445539),
    );

    var $course_info_category_data = array(
        array('id', 'name', 'sortorder'),
        array(1, 'Miscellaneous', 1),
    );

    var $course_info_field_data = array(
        array('id', 'fullname', 'shortname', 'datatype', 'description',
            'sortorder', 'categoryid', 'hidden', 'locked', 'required',
            'forceunique', 'defaultdata', 'param1', 'param2', 'param3',
            'param4', 'param5'),
        array(1, 'Field Name', 'Field', 'text', 'Description', 1, 1, 0, 0,
            0, 0, 'default', 'text', 'text', 'text', 'text', 'text'),
    );

    var $course_info_data_data = array(
        array('id', 'fieldid', 'courseid', 'data'),
        array(1, 1, 1, 'test'),
    );

    var $course_modules_data = array(
        array('id', 'course', 'module'),
        array(1, 1, 1),
    );

    var $modules_data = array(
        array('id', 'name', 'visible'),
        array(1, 'facetoface', 1),
    );

    function setUp() {
        global $db,$CFG;
        parent::setup();
        load_test_table($CFG->prefix . 'report_builder', $this->reportbuilder_data, $db, 2000);
        load_test_table($CFG->prefix . 'report_builder_columns', $this->reportbuilder_columns_data, $db);
        load_test_table($CFG->prefix . 'report_builder_filters', $this->reportbuilder_filters_data, $db);
        load_test_table($CFG->prefix . 'report_builder_settings', $this->reportbuilder_settings_data, $db);
        load_test_table($CFG->prefix . 'role', $this->role_data, $db);
        load_test_table($CFG->prefix . 'user_info_field', $this->user_info_field_data, $db);
        load_test_table($CFG->prefix . 'user_info_data', $this->user_info_data_data, $db);
        load_test_table($CFG->prefix . 'org', $this->org_data, $db);
        load_test_table($CFG->prefix . 'pos', $this->pos_data, $db);
        load_test_table($CFG->prefix . 'comp_scale_values', $this->comp_scale_values_data, $db);
        load_test_table($CFG->prefix . 'role_assignments', $this->role_assignments_data, $db);
        load_test_table($CFG->prefix . 'context', $this->context_data, $db);
        load_test_table($CFG->prefix . 'user', $this->user_data, $db);
        load_test_table($CFG->prefix . 'pos_assignment', $this->pos_assignment_data, $db);
        load_test_table($CFG->prefix . 'facetoface_session_field', $this->f2f_session_field_data, $db);
        load_test_table($CFG->prefix . 'facetoface_session_data', $this->f2f_session_data_data, $db);
        load_test_table($CFG->prefix . 'course_completion_crit_compl', $this->course_completion_crit_compl_data, $db);
        load_test_table($CFG->prefix . 'course_completion_criteria', $this->course_completion_criteria_data, $db);
        load_test_table($CFG->prefix . 'course_completions', $this->course_completions_data, $db);
        load_test_table($CFG->prefix . 'log', $this->log_data, $db);
        load_test_table($CFG->prefix . 'course', $this->course_data, $db);
        load_test_table($CFG->prefix . 'course_categories', $this->course_categories_data, $db);
        load_test_table($CFG->prefix . 'comp_framework', $this->framework_data, $db);
        load_test_table($CFG->prefix . 'comp_depth', $this->depth_data, $db);
        load_test_table($CFG->prefix . 'comp', $this->competency_data, $db);
        load_test_table($CFG->prefix . 'comp_depth_info_category', $this->depth_category_data, $db);
        load_test_table($CFG->prefix . 'comp_depth_info_field', $this->depth_field_data, $db);
        load_test_table($CFG->prefix . 'comp_depth_info_data', $this->depth_data_data, $db);
        load_test_table($CFG->prefix . 'idp_revision_competency', $this->dummy_data, $db);
        load_test_table($CFG->prefix . 'idp_competency_eval', $this->dummy_data, $db);
        load_test_table($CFG->prefix . 'comp_evidence', $this->dummy_data, $db);
        load_test_table($CFG->prefix . 'comp_evidence_items', $this->dummy_data, $db);
        load_test_table($CFG->prefix . 'comp_evidence_items_evidence', $this->dummy_data, $db);
        load_test_table($CFG->prefix . 'comp_template', $this->dummy_data, $db);
        load_test_table($CFG->prefix . 'comp_template_assignment', $this->dummy_data, $db);
        load_test_table($CFG->prefix . 'pos_competencies', $this->dummy_data, $db);
        load_test_table($CFG->prefix . 'comp_relations', $this->dummy_data, $db);
        load_test_table($CFG->prefix . 'facetoface', $this->f2f_data, $db);
        load_test_table($CFG->prefix . 'facetoface_sessions', $this->f2f_session_data, $db);
        load_test_table($CFG->prefix . 'facetoface_sessions_dates', $this->f2f_session_dates_data, $db);
        load_test_table($CFG->prefix . 'facetoface_signups', $this->f2f_signups_data, $db);
        load_test_table($CFG->prefix . 'facetoface_signups_status', $this->f2f_signup_status_data, $db);
        load_test_table($CFG->prefix . 'facetoface_session_roles', $this->f2f_session_roles_data, $db);
        load_test_table($CFG->prefix . 'scorm', $this->scorm_data, $db);
        load_test_table($CFG->prefix . 'scorm_scoes', $this->scorm_scoes_data, $db);
        load_test_table($CFG->prefix . 'scorm_scoes_track', $this->scorm_scoes_track_data, $db);
        load_test_table($CFG->prefix . 'feedback', $this->feedback_data, $db);
        load_test_table($CFG->prefix . 'feedback_item', $this->feedback_item_data, $db);
        load_test_table($CFG->prefix . 'feedback_completed', $this->feedback_completed_data, $db);
        load_test_table($CFG->prefix . 'feedback_value', $this->feedback_value_data, $db);
        load_test_table($CFG->prefix . 'tag', $this->tag_data, $db);
        load_test_table($CFG->prefix . 'tag_instance', $this->tag_instance_data, $db);
        load_test_table($CFG->prefix . 'report_builder_group', $this->reportbuilder_group_data, $db);
        load_test_table($CFG->prefix . 'config', $this->config_data, $db);
        load_test_table($CFG->prefix . 'course_info_category', $this->course_info_category_data, $db);
        load_test_table($CFG->prefix . 'course_info_field', $this->course_info_field_data, $db);
        load_test_table($CFG->prefix . 'course_info_data', $this->course_info_data_data, $db);
        load_test_table($CFG->prefix . 'course_modules', $this->course_modules_data, $db);
        load_test_table($CFG->prefix . 'modules', $this->modules_data, $db);

        // get rid of dummy records
        delete_records('report_builder_group');

        // db version of report
        $this->rb = new reportbuilder(1);
    }

    function tearDown() {
        global $db,$CFG;
        remove_test_table($CFG->prefix . 'modules', $db);
        remove_test_table($CFG->prefix . 'course_modules', $db);
        remove_test_table($CFG->prefix . 'course_info_data', $db);
        remove_test_table($CFG->prefix . 'course_info_field', $db);
        remove_test_table($CFG->prefix . 'course_info_category', $db);
        remove_test_table($CFG->prefix . 'config', $db);
        remove_test_table($CFG->prefix . 'report_builder_group', $db);
        remove_test_table($CFG->prefix . 'tag_instance', $db);
        remove_test_table($CFG->prefix . 'tag', $db);
        remove_test_table($CFG->prefix . 'feedback_value', $db);
        remove_test_table($CFG->prefix . 'feedback_completed', $db);
        remove_test_table($CFG->prefix . 'feedback_item', $db);
        remove_test_table($CFG->prefix . 'feedback', $db);
        remove_test_table($CFG->prefix . 'scorm_scoes_track', $db);
        remove_test_table($CFG->prefix . 'scorm_scoes', $db);
        remove_test_table($CFG->prefix . 'scorm', $db);
        remove_test_table($CFG->prefix . 'facetoface', $db);
        remove_test_table($CFG->prefix . 'facetoface_sessions', $db);
        remove_test_table($CFG->prefix . 'facetoface_sessions_dates', $db);
        remove_test_table($CFG->prefix . 'facetoface_signups', $db);
        remove_test_table($CFG->prefix . 'facetoface_signups_status', $db);
        remove_test_table($CFG->prefix . 'facetoface_session_roles', $db);
        remove_test_table($CFG->prefix . 'comp_relations', $db);
        remove_test_table($CFG->prefix . 'pos_competencies', $db);
        remove_test_table($CFG->prefix . 'comp_template_assignment', $db);
        remove_test_table($CFG->prefix . 'comp_template', $db);
        remove_test_table($CFG->prefix . 'comp_evidence_items_evidence', $db);
        remove_test_table($CFG->prefix . 'comp_evidence_items', $db);
        remove_test_table($CFG->prefix . 'comp_evidence', $db);
        remove_test_table($CFG->prefix . 'idp_competency_eval', $db);
        remove_test_table($CFG->prefix . 'idp_revision_competency', $db);
        remove_test_table($CFG->prefix . 'comp_depth_info_data', $db);
        remove_test_table($CFG->prefix . 'comp_depth_info_field', $db);
        remove_test_table($CFG->prefix . 'comp_depth_info_category', $db);
        remove_test_table($CFG->prefix . 'comp', $db);
        remove_test_table($CFG->prefix . 'comp_depth', $db);
        remove_test_table($CFG->prefix . 'comp_framework', $db);
        remove_test_table($CFG->prefix . 'course_categories', $db);
        remove_test_table($CFG->prefix . 'course', $db);
        remove_test_table($CFG->prefix . 'log', $db);
        remove_test_table($CFG->prefix . 'course_completion_crit_compl', $db);
        remove_test_table($CFG->prefix . 'course_completion_criteria', $db);
        remove_test_table($CFG->prefix . 'course_completions', $db);
        remove_test_table($CFG->prefix . 'facetoface_session_data', $db);
        remove_test_table($CFG->prefix . 'facetoface_session_field', $db);
        remove_test_table($CFG->prefix . 'pos_assignment', $db);
        remove_test_table($CFG->prefix . 'user', $db);
        remove_test_table($CFG->prefix . 'context', $db);
        remove_test_table($CFG->prefix . 'role_assignments', $db);
        remove_test_table($CFG->prefix . 'comp_scale_values', $db);
        remove_test_table($CFG->prefix . 'org', $db);
        remove_test_table($CFG->prefix . 'pos', $db);
        remove_test_table($CFG->prefix . 'user_info_data', $db);
        remove_test_table($CFG->prefix . 'user_info_field', $db);
        remove_test_table($CFG->prefix . 'role', $db);
        remove_test_table($CFG->prefix . 'report_builder_settings', $db);
        remove_test_table($CFG->prefix . 'report_builder_filters', $db);
        remove_test_table($CFG->prefix . 'report_builder_columns', $db);
        remove_test_table($CFG->prefix . 'report_builder', $db);
        parent::tearDown();
    }

    function test_columns_and_filters() {
        global $SESSION;
        // loop through installed sources
        foreach(reportbuilder::get_source_list() as $sourcename => $title) {
            //print '<h3>Source ' . $title . ':</h3>';
            $src = reportbuilder::get_source_object($sourcename);
            foreach($src->columnoptions as $column) {
                // create a report
                $report = new object();
                $report->fullname = 'Test Report';
                $report->shortname = 'test1';
                $report->source = $sourcename;
                $report->hidden = 0;
                $report->accessmode = 0;
                $report->contentmode = 0;
                $reportid = insert_record('report_builder', $report);
                // add a single column
                $col = new object();
                $col->reportid = $reportid;
                $col->type = $column->type;
                $col->value = $column->value;
                $col->heading = addslashes($column->defaultheading);
                $col->sortorder = 1;
                $colid = insert_record('report_builder_columns', $col);
                // create the reportbuilder object
                //print '<h5>Test ' . $column->type . '-' . $column->value . ' column:</h5>';
                $rb = new reportbuilder($reportid);
                $sql = $rb->build_query();
                $data = $rb->fetch_data($sql, 1, 40);
                $this->assertEqual($rb->get_full_count(),1);
                // remove afterwards
                delete_records('report_builder', 'id', $reportid);
            }

            foreach($src->filteroptions as $filter) {
                // create a report
                $report = new object();
                $report->fullname = 'Test Report';
                $report->shortname = 'test1';
                $report->source = $sourcename;
                $report->hidden = 0;
                $report->accessmode = 0;
                $report->contentmode = 0;
                $reportid = insert_record('report_builder', $report);
                // add a single column
                $col = new object();
                $col->reportid = $reportid;
                $col->type = $filter->type;
                $col->value = $filter->value;
                $col->heading = 'Test';
                $col->sortorder = 1;
                $colid = insert_record('report_builder_columns', $col);
                // add a single filter
                $fil = new object();
                $fil->reportid = $reportid;
                $fil->type = $filter->type;
                $fil->value = $filter->value;
                $fil->advanced = addslashes($filter->defaultadvanced);
                $fil->sortorder = 1;
                $filid = insert_record('report_builder_filters', $fil);
                // create the reportbuilder object
                //print '<h5>Test ' . $filter->type . '-' . $filter->value . ' filter:</h5>';
                $rb = new reportbuilder($reportid);
                // set session to filter by this column
                $filtername = 'filtering_test1';
                $fname = $filter->type . '-' . $filter->value;
                $SESSION->{$filtername} = array();
                $SESSION->{$filtername}[$fname] = array();
                switch($filter->filtertype) {
                    case 'date':
                        $search = array('before' => null, 'after' => 1);
                        break;
                    case 'text':
                    case 'number':
                    case 'select':
                    default:
                        $search = array('operator' => 1, 'value' => 2);
                        break;
                }
                $SESSION->{$filtername}[$fname] = array($search);
                $sql = $rb->build_query(false, true);
                $data = $rb->fetch_data($sql, 1, 40);
                $this->assertPattern('/[01]/', $rb->get_filtered_count());
                // remove afterwards
                delete_records('report_builder', 'id', $reportid);
                unset($SESSION->{$filtername});
            }
        }
    }

}

