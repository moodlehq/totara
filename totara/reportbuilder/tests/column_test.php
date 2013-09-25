<?php // $Id$
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2013 Totara Learning Solutions LTD
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
 * @subpackage reportbuilder
 *
 * Unit tests to check source column definitions
 *
 * vendor/bin/phpunit columns_test totara/reportbuilder/tests/column_test.php
 *
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

global $CFG;
require_once($CFG->dirroot . '/totara/reportbuilder/lib.php');
require_once($CFG->dirroot . '/totara/reportbuilder/tests/reportcache_advanced_testcase.php');

class columns_test extends reportcache_advanced_testcase {

    protected function setUp() {
        global $DB,$CFG;
        parent::setup();

        //Warning: Massive amount oftest data ahead
        $this->rb_data = new stdclass();
        $this->rb_data->id = 1;
        $this->rb_data->fullname = 'Test Report';
        $this->rb_data->shortname = 'test_report';
        $this->rb_data->source = 'competency_evidence';
        $this->rb_data->hidden = 0;
        $this->rb_data->accessmode = 0;
        $this->rb_data->contentmode = 0;
        $this->rb_data->description = '';
        $this->rb_data->recordsperpage = 40;
        $this->rb_data->defaultsortcolumn = 'user_fullname';
        $this->rb_data->defaultsortorder = 4;
        $this->rb_data->embedded = 0;

        $this->rb_col_data = new stdClass();
        $this->rb_col_data->id = 1;
        $this->rb_col_data->reportid = 1;
        $this->rb_col_data->type = 'user';
        $this->rb_col_data->value = 'namelink';
        $this->rb_col_data->heading = 'Participant';
        $this->rb_col_data->sortorder = 1;
        $this->rb_col_data->hidden = 0;
        $this->rb_col_data->customheading = 0;

        $this->rb_filter_data = new stdClass();
        $this->rb_filter_data->id = 1;
        $this->rb_filter_data->reportid = 1;
        $this->rb_filter_data->type = 'user';
        $this->rb_filter_data->value = 'fullname';
        $this->rb_filter_data->advanced = 0;
        $this->rb_filter_data->sortorder = 1;

        $this->rb_settings_data = array();

        $this->rb_settings_data1 = new stdClass();
        $this->rb_settings_data1->id = 1;
        $this->rb_settings_data1->reportid = 1;
        $this->rb_settings_data1->type = 'rb_role_access';
        $this->rb_settings_data1->name = 'activeroles';
        $this->rb_settings_data1->value = '1|2';
        $this->rb_settings_data[] = $this->rb_settings_data1;

        $this->rb_settings_data2 = new stdClass();
        $this->rb_settings_data2->id = 2;
        $this->rb_settings_data2->reportid = 1;
        $this->rb_settings_data2->type = 'rb_role_access';
        $this->rb_settings_data2->name = 'enable';
        $this->rb_settings_data2->value = 1;
        $this->rb_settings_data[] = $this->rb_settings_data2;

        $this->rb_group_data = new stdClass();
        $this->rb_group_data->id = 1;
        $this->rb_group_data->name = 'My Group';
        $this->rb_group_data->preproc = 'test';
        $this->rb_group_data->baseitem = 'something';
        $this->rb_group_data->assigntype = 'else';
        $this->rb_group_data->assignvalue = 1;

        $this->user_info_field_data = new stdClass();
        $this->user_info_field_data->id = 1;
        $this->user_info_field_data->shortname = 'datejoined';
        $this->user_info_field_data->name = 'Date Joined';
        $this->user_info_field_data->datatype = 'text';
        $this->user_info_field_data->description = '';
        $this->user_info_field_data->categoryid = 1;
        $this->user_info_field_data->sortorder = 1;
        $this->user_info_field_data->required = 0;
        $this->user_info_field_data->locked = 0;
        $this->user_info_field_data->visible = 1;
        $this->user_info_field_data->forceunique = 0;
        $this->user_info_field_data->signup = 0;
        $this->user_info_field_data->defaultdata = '';
        $this->user_info_field_data->param1 = 30;
        $this->user_info_field_data->param2 = 2048;
        $this->user_info_field_data->param3 = 0;
        $this->user_info_field_data->param4 = '';
        $this->user_info_field_data->param5 = '';

        $this->user_info_data_data = new stdClass();
        $this->user_info_data_data->id = 1;
        $this->user_info_data_data->userid = 2;
        $this->user_info_data_data->fieldid = 1;
        $this->user_info_data_data->data = 'test';

        $this->org_framework_data = array();
        $this->org_framework_data1 = new stdClass();
        $this->org_framework_data1->id = 1;
        $this->org_framework_data1->fullname = 'Organisation Framework 1';
        $this->org_framework_data1->shortname = 'OFW1';
        $this->org_framework_data1->idnumber = 'ID1';
        $this->org_framework_data1->description = 'Description 1';
        $this->org_framework_data1->sortorder = 1;
        $this->org_framework_data1->visible = 1;
        $this->org_framework_data1->hidecustomfields = 0;
        $this->org_framework_data1->timecreated = 1265963591;
        $this->org_framework_data1->timemodified = 1265963591;
        $this->org_framework_data1->usermodified = 2;
        $this->org_framework_data[] = $this->org_framework_data1;

        $this->org_data = new stdClass();
        $this->org_data->id = 1;
        $this->org_data->fullname = 'Distric Office';
        $this->org_data->shortname = 'DO';
        $this->org_data->description = '';
        $this->org_data->idnumber = '';
        $this->org_data->frameworkid = 1;
        $this->org_data->path = '/1';
        $this->org_data->depthlevel = 1;
        $this->org_data->parentid = 0;
        $this->org_data->sortthread = '01';
        $this->org_data->visible = 1;
        $this->org_data->timecreated = 0;
        $this->org_data->timemodified = 0;
        $this->org_data->usermodified = 2;

        $this->pos_framework_data = array();
        $this->pos_framework_data1 = new stdClass();
        $this->pos_framework_data1->id = 1;
        $this->pos_framework_data1->fullname = 'Postion Framework 1';
        $this->pos_framework_data1->shortname = 'PFW1';
        $this->pos_framework_data1->idnumber = 'ID1';
        $this->pos_framework_data1->description = 'Description 1';
        $this->pos_framework_data1->sortorder = 1;
        $this->pos_framework_data1->visible = 1;
        $this->pos_framework_data1->hidecustomfields = 0;
        $this->pos_framework_data1->timecreated = 1265963591;
        $this->pos_framework_data1->timemodified = 1265963591;
        $this->pos_framework_data1->usermodified = 2;
        $this->pos_framework_data[] = $this->pos_framework_data1;

        $this->pos_data = new stdClass();
        $this->pos_data->id = 1;
        $this->pos_data->fullname = 'Data Analyst';
        $this->pos_data->shortname = 'Data Analyst';
        $this->pos_data->idnumber = '';
        $this->pos_data->description = '';
        $this->pos_data->frameworkid = 1;
        $this->pos_data->path = '/1';
        $this->pos_data->depthlevel = 1;
        $this->pos_data->parentid = 0;
        $this->pos_data->sortthread = '01';
        $this->pos_data->visible = 1;
        $this->pos_data->timevalidfrom = 0;
        $this->pos_data->timevalidto = 0;
        $this->pos_data->timecreated = 0;
        $this->pos_data->timemodified = 0;
        $this->pos_data->usermodified = 2;

        $this->pos_assignment_data = new stdClass();
        $this->pos_assignment_data->id = 1;
        $this->pos_assignment_data->fullname = 'Title';
        $this->pos_assignment_data->shortname = 'Title';
        $this->pos_assignment_data->organisationid = 1;
        $this->pos_assignment_data->positionid = 1;
        $this->pos_assignment_data->userid = 2;
        $this->pos_assignment_data->type = 1;
        $this->pos_assignment_data->timecreated = 1;
        $this->pos_assignment_data->timemodified = 1;
        $this->pos_assignment_data->usermodified = 1;

        $this->f2f_session_data_data = new stdClass();
        $this->f2f_session_data_data->id = 1;
        $this->f2f_session_data_data->fieldid = 1;
        $this->f2f_session_data_data->sessionid = 1;
        $this->f2f_session_data_data->data = 'Training Centre';

        $this->course_completions_data = new stdClass();
        $this->course_completions_data->id = 1;
        $this->course_completions_data->userid = 2;
        $this->course_completions_data->course = 1;
        $this->course_completions_data->organisationid = 1;
        $this->course_completions_data->positionid = 1;
        $this->course_completions_data->deleted = 0;
        $this->course_completions_data->timenotified = 0;
        $this->course_completions_data->timestarted = 1140606000;
        $this->course_completions_data->timeenrolled = 1140606000;
        $this->course_completions_data->timecompleted = 1140606000;
        $this->course_completions_data->reaggregate = 0;
        $this->course_completions_data->rpl = '';
        $this->course_completions_data->rplgrade = 0;
        $this->course_completions_data->status = 0;

        $this->course_completion_criteria_data = new stdClass();
        $this->course_completion_criteria_data->id = 1;
        $this->course_completion_criteria_data->course = 2;
        $this->course_completion_criteria_data->criteriatype = 6;
        $this->course_completion_criteria_data->gradepass = 2;

        $this->course_completion_crit_compl_data = new stdClass();
        $this->course_completion_crit_compl_data->id = 1;
        $this->course_completion_crit_compl_data->userid = 2;
        $this->course_completion_crit_compl_data->course = 2;
        $this->course_completion_crit_compl_data->criteriaid = 1;
        $this->course_completion_crit_compl_data->gradefinal = 2;
        $this->course_completion_crit_compl_data->deleted = 0;

        $this->log_data = new stdClass();
        $this->log_data->id = 1;
        $this->log_data->time = 1140606000;
        $this->log_data->userid = 2;
        $this->log_data->ip = '192.168.2.133';
        $this->log_data->course = 1;
        $this->log_data->module = 'user';
        $this->log_data->cmid = 0;
        $this->log_data->action = 'update';
        $this->log_data->url = 'view.php';
        $this->log_data->info = 1;

        $this->course_data = new stdClass();
        $this->course_data->id = 2;
        $this->course_data->fullname = 'Test Course 1';
        $this->course_data->shortname = 'TC1';
        $this->course_data->category = 1;
        $this->course_data->idnumber = 'ID1';
        $this->course_data->startdate = 1140606000;
        $this->course_data->icon = '';
        $this->course_data->visible = 1;
        $this->course_data->summary = 'Course Summary';
        $this->course_data->coursetype = 0;
        $this->course_data->lang = 'en';
        $this->course_data->audiencevisible = 2;

        $this->feedback_data = new stdClass();
        $this->feedback_data->id = 1;
        $this->feedback_data->course = 1;
        $this->feedback_data->name = 'Feedback';
        $this->feedback_data->intro = 'introduction';
        $this->feedback_data->page_after_submit = 'final_page';

        $this->feedback_item_data = new stdClass();
        $this->feedback_item_data->id = 1;
        $this->feedback_item_data->feedback = 1;
        $this->feedback_item_data->template = 0;
        $this->feedback_item_data->name = 'Question';
        $this->feedback_item_data->presentation = 'A\r|B\r|C\r';
        $this->feedback_item_data->type = 'radio';
        $this->feedback_item_data->hasvalue = 1;
        $this->feedback_item_data->position = 1;
        $this->feedback_item_data->required = 0;

        $this->feedback_completed_data = new stdClass();
        $this->feedback_completed_data->id = 1;
        $this->feedback_completed_data->feedback = 1;
        $this->feedback_completed_data->userid = 2;
        $this->feedback_completed_data->timemodified = 1140606000;

        $this->feedback_value_data = new stdClass();
        $this->feedback_value_data->id = 1;
        $this->feedback_value_data->course_id = 0;
        $this->feedback_value_data->item = 1;
        $this->feedback_value_data->completed = 1;
        $this->feedback_value_data->value = 2;

        $this->tag_instance_data = new stdClass();
        $this->tag_instance_data->id = 1;
        $this->tag_instance_data->tagid = 1;
        $this->tag_instance_data->itemtype = 'feedback';
        $this->tag_instance_data->itemid = 1;

        $this->tag_data = new stdClass();
        $this->tag_data->id = 1;
        $this->tag_data->userid = 2;
        $this->tag_data->name = 'Tag';
        $this->tag_data->tagtype = 'official';

        $this->grade_items_data = new stdClass();
        $this->grade_items_data->id = 1;
        $this->grade_items_data->courseid = 2;
        $this->grade_items_data->itemtype = 'course';
        $this->grade_items_data->gradepass = 2;
        $this->grade_items_data->itemmodule = 'assignment';
        $this->grade_items_data->iteminstance  = 1;
        $this->grade_items_data->scaleid = 1;

        $this->grade_grades_data = new stdClass();
        $this->grade_grades_data->id = 1;
        $this->grade_grades_data->itemid = 1;
        $this->grade_grades_data->userid = 2;
        $this->grade_grades_data->finalgrade = 2;
        $this->grade_grades_data->rawgrademin = 2;
        $this->grade_grades_data->rawgrademax = 2;

        $this->framework_data = array();

        $this->framework_data1 = new stdClass();
        $this->framework_data1->id = 1;
        $this->framework_data1->fullname = 'Framework 1';
        $this->framework_data1->shortname = 'FW1';
        $this->framework_data1->idnumber = 'ID1';
        $this->framework_data1->description = 'Description 1';
        $this->framework_data1->sortorder = 1;
        $this->framework_data1->visible = 1;
        $this->framework_data1->hidecustomfields = 0;
        $this->framework_data1->timecreated = 1265963591;
        $this->framework_data1->timemodified = 1265963591;
        $this->framework_data1->usermodified = 2;
        $this->framework_data[] = $this->framework_data1;

        $this->framework_data2 = new stdClass();
        $this->framework_data2->id = 2;
        $this->framework_data2->fullname = 'Framework 2';
        $this->framework_data2->shortname = 'FW2';
        $this->framework_data2->idnumber = 'ID2';
        $this->framework_data2->description = 'Description 2';
        $this->framework_data2->sortorder = 2;
        $this->framework_data2->visible = 1;
        $this->framework_data2->hidecustomfields = 0;
        $this->framework_data2->timecreated = 1265963591;
        $this->framework_data2->timemodified = 1265963591;
        $this->framework_data2->usermodified = 2;
        $this->framework_data[] = $this->framework_data2;

        $this->type_data = array();

        $this->type_data1 = new stdClass();
        $this->type_data1->id = 1;
        $this->type_data1->fullname = 'Hierarchy Type 1';
        $this->type_data1->shortname = 'Type 1';
        $this->type_data1->description = 'Description 1';
        $this->type_data1->timecreated = 1265963591;
        $this->type_data1->timemodified = 1265963591;
        $this->type_data1->usermodified = 2;
        $this->type_data[] = $this->type_data1;

        $this->type_data2 = new stdClass();
        $this->type_data2->id = 2;
        $this->type_data2->fullname = 'Hierarchy Type 2';
        $this->type_data2->shortname = 'Type 2';
        $this->type_data2->description = 'Description 2';
        $this->type_data2->timecreated = 1265963591;
        $this->type_data2->timemodified = 1265963591;
        $this->type_data2->usermodified = 2;
        $this->type_data[] = $this->type_data2;

        $this->type_data3 = new stdClass();
        $this->type_data3->id = 3;
        $this->type_data3->fullname = 'F2 Hierarchy Type 1';
        $this->type_data3->shortname = 'F2 Type 1';
        $this->type_data3->description = 'F2 Description 1';
        $this->type_data3->timecreated = 1265963591;
        $this->type_data3->timemodified = 1265963591;
        $this->type_data3->usermodified = 2;
        $this->type_data[] = $this->type_data3;

        $this->comp_data = array();

        $this->comp_data1 = new stdClass();
        $this->comp_data1->id = 1;
        $this->comp_data1->fullname = 'Competency 1';
        $this->comp_data1->shortname =  'Comp 1';
        $this->comp_data1->description = 'Competency Description 1';
        $this->comp_data1->idnumber = 'C1';
        $this->comp_data1->frameworkid = 1;
        $this->comp_data1->path = '/1';
        $this->comp_data1->depthlevel = 1;
        $this->comp_data1->parentid = 0;
        $this->comp_data1->sortthread = '01';
        $this->comp_data1->visible = 1;
        $this->comp_data1->aggregationmethod = 1;
        $this->comp_data1->proficiencyexpected = 1;
        $this->comp_data1->evidencecount = 0;
        $this->comp_data1->timecreated = 1265963591;
        $this->comp_data1->timemodified = 1265963591;
        $this->comp_data1->usermodified = 2;
        $this->comp_data[] = $this->comp_data1;

        $this->comp_data2 = new stdClass();
        $this->comp_data2->id = 2;
        $this->comp_data2->fullname = 'Competency 2';
        $this->comp_data2->shortname = 'Comp 2';
        $this->comp_data2->description = 'Competency Description 2';
        $this->comp_data2->idnumber = 'C2';
        $this->comp_data2->frameworkid = 1;
        $this->comp_data2->path = '/1/2';
        $this->comp_data2->depthlevel = 2;
        $this->comp_data2->parentid = 1;
        $this->comp_data2->sortthread = '01.01';
        $this->comp_data2->visible = 1;
        $this->comp_data2->aggregationmethod = 1;
        $this->comp_data2->proficiencyexpected = 1;
        $this->comp_data2->evidencecount = 0;
        $this->comp_data2->timecreated = 1265963591;
        $this->comp_data2->timemodified = 1265963591;
        $this->comp_data2->usermodified = 2;
        $this->comp_data[] = $this->comp_data2;

        $this->comp_data3 = new stdClass();
        $this->comp_data3->id = 3;
        $this->comp_data3->fullname = 'F2 Competency 1';
        $this->comp_data3->shortname = 'F2 Comp 1';
        $this->comp_data3->description = 'F2 Competency Description 1';
        $this->comp_data3->idnumber = 'F2 C1';
        $this->comp_data3->frameworkid = 2;
        $this->comp_data3->path = '/3';
        $this->comp_data3->depthlevel = 1;
        $this->comp_data3->parentid = 0;
        $this->comp_data3->sortthread = '01';
        $this->comp_data3->visible = 1;
        $this->comp_data3->aggregationmethod = 1;
        $this->comp_data3->proficiencyexpected = 1;
        $this->comp_data3->evidencecount = 0;
        $this->comp_data3->timecreated = 1265963591;
        $this->comp_data3->timemodified = 1265963591;
        $this->comp_data3->usermodified = 2;
        $this->comp_data[] = $this->comp_data3;

        $this->comp_data4 = new stdClass();
        $this->comp_data4->id = 4;
        $this->comp_data4->fullname = 'Competency 3';
        $this->comp_data4->shortname = 'Comp 3';
        $this->comp_data4->description = 'Competency Description 3';
        $this->comp_data4->idnumber = 'C3';
        $this->comp_data4->frameworkid = 1;
        $this->comp_data4->path = '/1/4';
        $this->comp_data4->depthlevel = 2;
        $this->comp_data4->parentid = 1;
        $this->comp_data4->sortthread = '01.02';
        $this->comp_data4->visible = 1;
        $this->comp_data4->aggregationmethod = 1;
        $this->comp_data4->proficiencyexpected = 1;
        $this->comp_data4->evidencecount = 0;
        $this->comp_data4->timecreated = 1265963591;
        $this->comp_data4->timemodified = 1265963591;
        $this->comp_data4->usermodified = 2;
        $this->comp_data[] = $this->comp_data4;

        $this->comp_data5 = new stdClass();
        $this->comp_data5->id = 5;
        $this->comp_data5->fullname = 'Competency 4';
        $this->comp_data5->shortname = 'Comp 4';
        $this->comp_data5->description = 'Competency Description 4';
        $this->comp_data5->idnumber = 'C4';
        $this->comp_data5->frameworkid = 1;
        $this->comp_data5->path = '/5';
        $this->comp_data5->depthlevel = 1;
        $this->comp_data5->parentid = 0;
        $this->comp_data5->sortthread = '02';
        $this->comp_data5->visible = 1;
        $this->comp_data5->aggregationmethod = 1;
        $this->comp_data5->proficiencyexpected = 1;
        $this->comp_data5->evidencecount = 0;
        $this->comp_data5->timecreated = 1265963591;
        $this->comp_data5->timemodified = 1265963591;
        $this->comp_data5->usermodified = 2;
        $this->comp_data[] = $this->comp_data5;

        $this->type_field_data = new stdClass();
        $this->type_field_data->id = 1;
        $this->type_field_data->fullname = 'Custom Field';
        $this->type_field_data->shortname = 'CF1';
        $this->type_field_data->classid = 2;
        $this->type_field_data->datatype = 'checkbox';
        $this->type_field_data->description = 'Custom Field Description 1';
        $this->type_field_data->sortorder = 1;
        $this->type_field_data->categoryid = 1;
        $this->type_field_data->hidden = 0;
        $this->type_field_data->locked = 0;
        $this->type_field_data->required = 0;
        $this->type_field_data->forceunique = 0;
        $this->type_field_data->defaultdata = 0;
        $this->type_field_data->param1 = null;
        $this->type_field_data->param2 = null;
        $this->type_field_data->param3 = null;
        $this->type_field_data->param4 = null;
        $this->type_field_data->param5 = null;
        $this->type_field_data->typeid = 1;

        $this->type_data_data = new stdClass();
        $this->type_data_data->id = 1;
        $this->type_data_data->data = 1;
        $this->type_data_data->fieldid = 1;
        $this->type_data_data->competencyid = 2;
        $this->type_data_data->typeid = 1;

        $this->f2f_data = new stdClass();
        $this->f2f_data->id = 1;
        $this->f2f_data->course = 1;
        $this->f2f_data->name = 'F2F name';
        $this->f2f_data->shortname = 'f2f';
        $this->f2f_data->details = 'details';

        $this->f2f_session_data = new stdClass();
        $this->f2f_session_data->id = 1;
        $this->f2f_session_data->facetoface = 1;
        $this->f2f_session_data->capacity = 10;
        $this->f2f_session_data->details = 'details';
        $this->f2f_session_data->duration = 60;
        $this->f2f_session_data->datetimeknown = 1;
        $this->f2f_session_data->normalcost = 100;
        $this->f2f_session_data->discountcost = 90;
        $this->f2f_session_data->usermodified = 2;

        $this->f2f_session_dates_data = new stdClass();
        $this->f2f_session_dates_data->id = 1;
        $this->f2f_session_dates_data->sessionid = 1;
        $this->f2f_session_dates_data->timestart = 1140519599;
        $this->f2f_session_dates_data->timefinish = 114051960;

        $this->f2f_signups_data = new stdClass();
        $this->f2f_signups_data->id = 1;
        $this->f2f_signups_data->sessionid = 1;
        $this->f2f_signups_data->userid = 2;
        $this->f2f_signups_data->discountcode = '';
        $this->f2f_signups_data->mailedreminder = 0;
        $this->f2f_signups_data->notificationtype = 0;
        $this->f2f_signups_data->archived = 0;

        $this->f2f_signup_status_data = new stdClass();
        $this->f2f_signup_status_data->id = 1;
        $this->f2f_signup_status_data->signupid = 1;
        $this->f2f_signup_status_data->statuscode = 2;
        $this->f2f_signup_status_data->superceded = 0;
        $this->f2f_signup_status_data->grade = 2;
        $this->f2f_signup_status_data->note = 'test note';
        $this->f2f_signup_status_data->createdby = 1;
        $this->f2f_signup_status_data->timecreated = 1205445539;

        $this->f2f_session_roles_data = new stdClass();
        $this->f2f_session_roles_data->id = 1;
        $this->f2f_session_roles_data->sessionid = 1;
        $this->f2f_session_roles_data->roleid = 1;
        $this->f2f_session_roles_data->userid = 2;

        $this->scorm_data = new stdClass();
        $this->scorm_data->id = 1;
        $this->scorm_data->course = 1;
        $this->scorm_data->name = 'Scorm';
        $this->scorm_data->intro = 'Hi there, this is a scorm.';

        $this->scorm_scoes_data = new stdClass();
        $this->scorm_scoes_data->id = 1;
        $this->scorm_scoes_data->scorm = 1;
        $this->scorm_scoes_data->title = 'SCO';
        $this->scorm_scoes_data->launch = 'launch';

        $this->scorm_scoes_track_data = array();

        $this->scorm_scoes_track_data1 = new stdClass();
        $this->scorm_scoes_track_data1->id = 1;
        $this->scorm_scoes_track_data1->userid = 2;
        $this->scorm_scoes_track_data1->scormid = 1;
        $this->scorm_scoes_track_data1->scoid = 1;
        $this->scorm_scoes_track_data1->attempt = 1;
        $this->scorm_scoes_track_data1->element = 'cmi.core.lesson_status';
        $this->scorm_scoes_track_data1->value = 'done';
        $this->scorm_scoes_track_data1->timemodified = 1205445539;
        $this->scorm_scoes_track_data[] = $this->scorm_scoes_track_data1;

        $this->scorm_scoes_track_data2 = new stdClass();
        $this->scorm_scoes_track_data2->id = 1;
        $this->scorm_scoes_track_data2->userid = 2;
        $this->scorm_scoes_track_data2->scormid = 1;
        $this->scorm_scoes_track_data2->scoid = 1;
        $this->scorm_scoes_track_data2->attempt = 1;
        $this->scorm_scoes_track_data2->element = 'cmi.core.score.raw';
        $this->scorm_scoes_track_data2->value = '100';
        $this->scorm_scoes_track_data2->timemodified = 1205445539;
        $this->scorm_scoes_track_data[] = $this->scorm_scoes_track_data2;

        $this->scorm_scoes_track_data3 = new stdClass();
        $this->scorm_scoes_track_data3->id = 1;
        $this->scorm_scoes_track_data3->userid = 2;
        $this->scorm_scoes_track_data3->scormid = 1;
        $this->scorm_scoes_track_data3->scoid = 1;
        $this->scorm_scoes_track_data3->attempt = 1;
        $this->scorm_scoes_track_data3->element = 'cmi.core.score.min';
        $this->scorm_scoes_track_data3->value = '10';
        $this->scorm_scoes_track_data3->timemodified = 1205445539;
        $this->scorm_scoes_track_data[] = $this->scorm_scoes_track_data3;

        $this->scorm_scoes_track_data4 = new stdClass();
        $this->scorm_scoes_track_data4->id = 1;
        $this->scorm_scoes_track_data4->userid = 2;
        $this->scorm_scoes_track_data4->scormid = 1;
        $this->scorm_scoes_track_data4->scoid = 1;
        $this->scorm_scoes_track_data4->attempt = 1;
        $this->scorm_scoes_track_data4->element = 'cmi.core.score.max';
        $this->scorm_scoes_track_data4->value = '90';
        $this->scorm_scoes_track_data4->timemodified = 1205445539;
        $this->scorm_scoes_track_data[] = $this->scorm_scoes_track_data4;

        $this->course_info_field_data = new stdClass();
        $this->course_info_field_data->id = 1;
        $this->course_info_field_data->fullname = 'Field Name';
        $this->course_info_field_data->shortname = 'Field';
        $this->course_info_field_data->datatype = 'text';
        $this->course_info_field_data->description = 'Description';
        $this->course_info_field_data->sortorder = 1;
        $this->course_info_field_data->categoryid = 1;
        $this->course_info_field_data->hidden = 0;
        $this->course_info_field_data->locked = 0;
        $this->course_info_field_data->required = 0;
        $this->course_info_field_data->forceunique = 0;
        $this->course_info_field_data->defaultdata = 'default';
        $this->course_info_field_data->param1 = 'text';
        $this->course_info_field_data->param2 = 'text';
        $this->course_info_field_data->param3 = 'text';
        $this->course_info_field_data->param4 = 'text';
        $this->course_info_field_data->param5 = 'text';

        $this->course_info_data_data = new stdClass();
        $this->course_info_data_data->id = 1;
        $this->course_info_data_data->fieldid = 1;
        $this->course_info_data_data->courseid = 1;
        $this->course_info_data_data->data = 'test';

        $this->course_modules_data = new stdClass();
        $this->course_modules_data->id = 1;
        $this->course_modules_data->course = 1;
        $this->course_modules_data->module = 8;
        $this->course_modules_data->instance = 1;

        $this->block_totara_stats_data = new stdClass();
        $this->block_totara_stats_data->id = 1;
        $this->block_totara_stats_data->userid = 2;
        $this->block_totara_stats_data->timestamp = 0;
        $this->block_totara_stats_data->eventtype = 1;
        $this->block_totara_stats_data->data = 1;
        $this->block_totara_stats_data->data2 = 1;

        $this->message_working_data = new stdClass();
        $this->message_working_data->id = 1;
        $this->message_working_data->unreadmessageid = 1;
        $this->message_working_data->processorid = 1;

        $this->message_data = new stdClass();
        $this->message_data->id = 1;
        $this->message_data->useridfrom = 1;
        $this->message_data->useridto = 3;
        $this->message_data->subject = 'subject';
        $this->message_data->fullmessage = 'message';
        $this->message_data->fullmessageformat = 1;
        $this->message_data->fullmessagehtml = 'message';
        $this->message_data->smallmessage = 'msg';
        $this->message_data->notification = 1;
        $this->message_data->contexturl = '';
        $this->message_data->contexturlname = '';
        $this->message_data->timecreated = 0;

        $this->message_metadata_data = new stdClass();
        $this->message_metadata_data->id = 1;
        $this->message_metadata_data->messageid = 1;
        $this->message_metadata_data->msgtype = 1;
        $this->message_metadata_data->msgstatus = 1;
        $this->message_metadata_data->processorid = 1;
        $this->message_metadata_data->urgency = 1;
        $this->message_metadata_data->roleid = 1;
        $this->message_metadata_data->onaccept = '';
        $this->message_metadata_data->onreject = '';
        $this->message_metadata_data->icon = 'competency-regular';

        $this->dp_template_data = new stdClass();
        $this->dp_template_data->id = 1;
        $this->dp_template_data->fullname = 'plan';
        $this->dp_template_data->shortname = 'plan';
        $this->dp_template_data->startdate = 0;
        $this->dp_template_data->enddate = 0;
        $this->dp_template_data->sortorder = 1;
        $this->dp_template_data->visible = 1;
        $this->dp_template_data->workflow = 'user';

        $this->dp_plan_data = new stdClass();
        $this->dp_plan_data->id = 1;
        $this->dp_plan_data->templateid = 1;
        $this->dp_plan_data->userid = 2;
        $this->dp_plan_data->name = 'DP';
        $this->dp_plan_data->description = '';
        $this->dp_plan_data->startdate = 0;
        $this->dp_plan_data->enddate = 0;
        $this->dp_plan_data->status = 1;

        $this->dp_plan_competency_assign_data = new stdClass();
        $this->dp_plan_competency_assign_data->id = 1;
        $this->dp_plan_competency_assign_data->planid = 1;
        $this->dp_plan_competency_assign_data->competencyid = 1;
        $this->dp_plan_competency_assign_data->priority = 1;
        $this->dp_plan_competency_assign_data->duedate = 1;
        $this->dp_plan_competency_assign_data->approved = 1;
        $this->dp_plan_competency_assign_data->scalevalueid = 1;

        $this->dp_plan_course_assign_data = new stdClass();
        $this->dp_plan_course_assign_data->id = 1;
        $this->dp_plan_course_assign_data->planid = 1;
        $this->dp_plan_course_assign_data->courseid = 1;
        $this->dp_plan_course_assign_data->priority = 1;
        $this->dp_plan_course_assign_data->duedate = 1;
        $this->dp_plan_course_assign_data->approved = 1;
        $this->dp_plan_course_assign_data->completionstatus = 1;
        $this->dp_plan_course_assign_data->grade = 2;

        $this->dp_priority_scale_value_data = new stdClass();
        $this->dp_priority_scale_value_data->id = 1;
        $this->dp_priority_scale_value_data->name = 'scale';
        $this->dp_priority_scale_value_data->idnumber = 1;
        $this->dp_priority_scale_value_data->description = '';
        $this->dp_priority_scale_value_data->priorityscaleid = 1;
        $this->dp_priority_scale_value_data->numericscore = 1;
        $this->dp_priority_scale_value_data->sortorder = 1;
        $this->dp_priority_scale_value_data->timemodified = 1;
        $this->dp_priority_scale_value_data->usermodified = 1;

        $this->dp_plan_objective_data = new stdClass();
        $this->dp_plan_objective_data->id = 1;
        $this->dp_plan_objective_data->planid = 1;
        $this->dp_plan_objective_data->fullname = 'Objective';
        $this->dp_plan_objective_data->shortname = 'obj';
        $this->dp_plan_objective_data->description = 'Objective description';
        $this->dp_plan_objective_data->priority = 10;
        $this->dp_plan_objective_data->duedate = 1234567890;
        $this->dp_plan_objective_data->scalevalueid = 1;
        $this->dp_plan_objective_data->approved = 10;

        $this->dp_plan_evidence_type_data = new stdClass();
        $this->dp_plan_evidence_type_data->id = 1;
        $this->dp_plan_evidence_type_data->name = 'plan evidence type';
        $this->dp_plan_evidence_type_data->description = 'plan evidence description';
        $this->dp_plan_evidence_type_data->timemodified = 0;
        $this->dp_plan_evidence_type_data->usermodified = 2;
        $this->dp_plan_evidence_type_data->sortorder = 1;

        $this->dp_plan_evidence_data = new stdClass();
        $this->dp_plan_evidence_data->name = 'plan evidence';
        $this->dp_plan_evidence_data->description = 'plan evidence description';
        $this->dp_plan_evidence_data->timecreated = 0;
        $this->dp_plan_evidence_data->timemodified = 0;
        $this->dp_plan_evidence_data->usermodified = 2;
        $this->dp_plan_evidence_data->evidencetypeid = 1;
        $this->dp_plan_evidence_data->evidencelink = 1;
        $this->dp_plan_evidence_data->institution = 'plan evidence institution';
        $this->dp_plan_evidence_data->datecompleted = 0;
        $this->dp_plan_evidence_data->userid = 2;
        $this->dp_plan_evidence_data->readonly = 0;

        $this->dp_plan_evidence_relation_data = new stdClass();
        $this->dp_plan_evidence_relation_data->id = 1;
        $this->dp_plan_evidence_relation_data->evidenceid = 1;
        $this->dp_plan_evidence_relation_data->planid = 1;
        $this->dp_plan_evidence_relation_data->component = 'competency';
        $this->dp_plan_evidence_relation_data->itemid = 1;

        $this->dp_objective_scale_value_data = new stdClass();
        $this->dp_objective_scale_value_data->id = 1;
        $this->dp_objective_scale_value_data->objscaleid = 1;
        $this->dp_objective_scale_value_data->name = 'Objective Scale Value';
        $this->dp_objective_scale_value_data->idnumber = 'ID1';
        $this->dp_objective_scale_value_data->description = 'Objective scale value description';
        $this->dp_objective_scale_value_data->numericscore = 1;
        $this->dp_objective_scale_value_data->sortorder = 1;
        $this->dp_objective_scale_value_data->timemodified = 1234567890;
        $this->dp_objective_scale_value_data->usermodified = 2;
        $this->dp_objective_scale_value_data->achieved = 1;

        $this->dp_plan_component_relation_data = new stdClass();
        $this->dp_plan_component_relation_data->id = 1;
        $this->dp_plan_component_relation_data->itemid1 = 1;
        $this->dp_plan_component_relation_data->component1 = 'competency';
        $this->dp_plan_component_relation_data->itemid2 = 1;
        $this->dp_plan_component_relation_data->component2 = 'course';

        $this->cohort_data = new stdClass();
        $this->cohort_data->id = 1;
        $this->cohort_data->name = 'cohort';
        $this->cohort_data->contextid = 0;
        $this->cohort_data->descriptionformat = 0;
        $this->cohort_data->timecreated = 0;
        $this->cohort_data->timemodified = 0;
        $this->cohort_data->cohorttype = 0;

        $this->cohort_members_data = new stdClass();
        $this->cohort_members_data->id = 1;
        $this->cohort_members_data->cohortid = 1;
        $this->cohort_members_data->userid = 1;

        $this->prog_data = array();

        $this->prog_data1 = new stdClass();
        $this->prog_data1->id = 1;
        $this->prog_data1->certifid = null;
        $this->prog_data1->category = 1;
        $this->prog_data1->fullname = 'program';
        $this->prog_data1->shortname = 'prog';
        $this->prog_data1->idnumber = '123';
        $this->prog_data1->icon = 'default.png';
        $this->prog_data1->summary = 'summary';
        $this->prog_data1->availablefrom = 123456789;
        $this->prog_data1->availableuntil = 123456789;
        $this->prog_data1->audiencevisible = 2;
        $this->prog_data[] = $this->prog_data1;

        $this->prog_data2 = new stdClass();
        $this->prog_data2->id = 2;
        $this->prog_data2->certifid = 1;
        $this->prog_data2->category = 1;
        $this->prog_data2->fullname = 'Cf program fullname 101';
        $this->prog_data2->shortname = 'CP101';
        $this->prog_data2->idnumber = 'CP101';
        $this->prog_data2->summary = 'CP101';
        $this->prog_data2->availablefrom = 123456789;
        $this->prog_data2->availableuntil = 123456789;
        $this->prog_data2->icon = 'people-and-communities';
        $this->prog_data2->audiencevisible = 2;
        $this->prog_data[] = $this->prog_data2;

        $this->prog_courseset_data = new stdClass();
        $this->prog_courseset_data->id = 1;
        $this->prog_courseset_data->programid = 1;
        $this->prog_courseset_data->sortorder = 1;
        $this->prog_courseset_data->competencyid = 0;
        $this->prog_courseset_data->nextsetoperator = 0;
        $this->prog_courseset_data->completiontype = 1;
        $this->prog_courseset_data->timeallowed = 3024000;
        $this->prog_courseset_data->recurcreatetime = 0;
        $this->prog_courseset_data->recurrencetime = 0;
        $this->prog_courseset_data->contenttype = 1;
        $this->prog_courseset_data->label = 'courseset1';

        $this->prog_courseset_course_data = new stdClass();
        $this->prog_courseset_course_data->id = 1;
        $this->prog_courseset_course_data->coursesetid = 1;
        $this->prog_courseset_course_data->courseid = 1;

        $this->prog_extension_data = new stdClass();
        $this->prog_extension_data->id = 1;
        $this->prog_extension_data->programid = 1;
        $this->prog_extension_data->userid = 2;
        $this->prog_extension_data->status = 0;

        $this->prog_completion_data = array();

        $this->prog_completion_data1 = new stdClass();
        $this->prog_completion_data1->id = 2;
        $this->prog_completion_data1->programid = 1;
        $this->prog_completion_data1->userid = 2;
        $this->prog_completion_data1->coursesetid = 0;
        $this->prog_completion_data1->status = 1;
        $this->prog_completion_data1->timedue = 1205445539;
        $this->prog_completion_data1->timecompleted = 1205445539;
        $this->prog_completion_data1->timestarted = 1205445539;
        $this->prog_completion_data1->positionid = 1;
        $this->prog_completion_data1->organisationid = 1;
        $this->prog_completion_data[] = $this->prog_completion_data1;

        $this->prog_completion_data2 = new stdClass();
        $this->prog_completion_data2->id = 3;
        $this->prog_completion_data2->programid = 2;
        $this->prog_completion_data2->userid = 2;
        $this->prog_completion_data2->coursesetid = 0;
        $this->prog_completion_data2->status = 1;
        $this->prog_completion_data2->timestarted = 1378136334;
        $this->prog_completion_data2->timedue = -1;
        $this->prog_completion_data2->timecompleted = 1378215781;
        $this->prog_completion_data2->positionid = 1;
        $this->prog_completion_data2->organisationid = 1;
        $this->prog_completion_data[] = $this->prog_completion_data2;

        $this->prog_completion_history_data = new stdClass();
        $this->prog_completion_history_data->id = 2;
        $this->prog_completion_history_data->programid = 1;
        $this->prog_completion_history_data->userid = 2;
        $this->prog_completion_history_data->coursesetid = 0;
        $this->prog_completion_history_data->status = 1;
        $this->prog_completion_history_data->timestarted = 1205445539;
        $this->prog_completion_history_data->timedue = 1205445539;
        $this->prog_completion_history_data->timecompleted = 1205445539;
        $this->prog_completion_history_data->recurringcourseid = 1;
        $this->prog_completion_history_data->positionid = 1;
        $this->prog_completion_history_data->organisationid = 1;

        $this->prog_user_assignment_data = new stdClass();
        $this->prog_user_assignment_data->id = 1;
        $this->prog_user_assignment_data->programid = 1;
        $this->prog_user_assignment_data->userid = 2;

        $this->pos_type_info_data_data = new stdClass();
        $this->pos_type_info_data_data->id = 1;
        $this->pos_type_info_data_data->fieldid = 1;
        $this->pos_type_info_data_data->positionid = 1;
        $this->pos_type_info_data_data->data = 'test';

        $this->org_type_info_data_data = new stdClass();
        $this->org_type_info_data_data->id = 1;
        $this->org_type_info_data_data->fieldid = 1;
        $this->org_type_info_data_data->organisationid = 1;
        $this->org_type_info_data_data->data = 'test';

        $this->pos_type_info_field_data = new stdClass();
        $this->pos_type_info_field_data->id = 1;
        $this->pos_type_info_field_data->fullname = 'Field Name';
        $this->pos_type_info_field_data->shortname = 'Field';
        $this->pos_type_info_field_data->datatype = 'text';
        $this->pos_type_info_field_data->description = 'Description';
        $this->pos_type_info_field_data->sortorder = 1;
        $this->pos_type_info_field_data->categoryid = 1;
        $this->pos_type_info_field_data->hidden = 0;
        $this->pos_type_info_field_data->locked = 0;
        $this->pos_type_info_field_data->required = 0;
        $this->pos_type_info_field_data->forceunique = 0;
        $this->pos_type_info_field_data->defaultdata = 'default';
        $this->pos_type_info_field_data->param1 = 'text';
        $this->pos_type_info_field_data->param2 = 'text';
        $this->pos_type_info_field_data->param3 = 'text';
        $this->pos_type_info_field_data->param4 = 'text';
        $this->pos_type_info_field_data->param5 = 'text';

        $this->org_type_info_field_data = new stdClass();
        $this->org_type_info_field_data->id = 1;
        $this->org_type_info_field_data->fullname = 'Field Name';
        $this->org_type_info_field_data->shortname = 'Field';
        $this->org_type_info_field_data->datatype = 'text';
        $this->org_type_info_field_data->description = 'Description';
        $this->org_type_info_field_data->sortorder = 1;
        $this->org_type_info_field_data->typeid = 1;
        $this->org_type_info_field_data->categoryid = 1;
        $this->org_type_info_field_data->hidden = 0;
        $this->org_type_info_field_data->locked = 0;
        $this->org_type_info_field_data->required = 0;
        $this->org_type_info_field_data->forceunique = 0;
        $this->org_type_info_field_data->defaultdata = 'default';
        $this->org_type_info_field_data->param1 = 'text';
        $this->org_type_info_field_data->param2 = 'text';
        $this->org_type_info_field_data->param3 = 'text';
        $this->org_type_info_field_data->param4 = 'text';
        $this->org_type_info_field_data->param5 = 'text';

        $this->assignment_data = new stdClass();
        $this->assignment_data->id = 1;
        $this->assignment_data->course = 2;
        $this->assignment_data->name = 'Assignment 001';
        $this->assignment_data->description = 'Assignment description 001';
        $this->assignment_data->format = 0;
        $this->assignment_data->assignmenttype = 'uploadsingle';
        $this->assignment_data->resubmit = 0;
        $this->assignment_data->preventlate = 0;
        $this->assignment_data->emailteachers = 0;
        $this->assignment_data->var1 = 0;
        $this->assignment_data->var2 = 0;
        $this->assignment_data->var3 = 0;
        $this->assignment_data->var4 = 0;
        $this->assignment_data->var5 = 0;
        $this->assignment_data->maxbytes = 1048576;
        $this->assignment_data->timedue = 1332758400;
        $this->assignment_data->timeavailable = 1332153600;
        $this->assignment_data->grade = 2;
        $this->assignment_data->timemodified = 1332153673;
        $this->assignment_data->intro = 'introduction';

        $this->assignment_submissions_data = new stdClass();
        $this->assignment_submissions_data->id = 1;
        $this->assignment_submissions_data->assignment = 1;
        $this->assignment_submissions_data->userid = 2;
        $this->assignment_submissions_data->timecreated = 0;
        $this->assignment_submissions_data->timemodified = 1332166933;
        $this->assignment_submissions_data->numfiles = 1;
        $this->assignment_submissions_data->data1 = '';
        $this->assignment_submissions_data->data2 = '';
        $this->assignment_submissions_data->grade = 2;
        $this->assignment_submissions_data->submissioncomment = 'well done';
        $this->assignment_submissions_data->format = 0;
        $this->assignment_submissions_data->teacher = 0;
        $this->assignment_submissions_data->timemarked = 0;
        $this->assignment_submissions_data->mailed = 1;

        $this->scale_data = array();

        $this->scale_data1 = new stdClass();
        $this->scale_data1->id = 1;
        $this->scale_data1->courseid = 0;
        $this->scale_data1->userid = 2;
        $this->scale_data1->name = 'Scale 001';
        $this->scale_data1->scale ='Bad,Average,Good';
        $this->scale_data1->description = '';
        $this->scale_data1->timemodified = 1332243112;
        $this->scale_data[] = $this->scale_data1;

        $this->scale_data2 = new stdClass();
        $this->scale_data2->id = 2;
        $this->scale_data2->courseid = 0;
        $this->scale_data2->userid = 2;
        $this->scale_data2->name = 'Scale 002';
        $this->scale_data2->scale ='Awful,Satisfactory,Good,Excellent';
        $this->scale_data2->description = '';
        $this->scale_data2->timemodified = 1332243112;
        $this->scale_data[] = $this->scale_data2;

        $this->filter_config_data = new stdClass();
        $this->filter_config_data->id = 1;
        $this->filter_config_data->filter = 'filter/tidy';
        $this->filter_config_data->contextid = 2;
        $this->filter_config_data->name = 'filter_data_config';

        $this->filter_active_data = new stdClass();
        $this->filter_active_data->id = 1;
        $this->filter_active_data->filter = 'filter/tidy';
        $this->filter_active_data->contextid = 2;
        $this->filter_active_data->active = 1;
        $this->filter_active_data->sortorder = '1';

        $this->files_data = new stdClass();
        $this->files_data->id = 1;
        $this->files_data->contextid = 1;
        $this->files_data->itemid = 1;
        $this->files_data->filepath = '/totara/';
        $this->files_data->filename = 'icon.gif';
        $this->files_data->filesize = 8;
        $this->files_data->filearea = 'course';
        $this->files_data->status = 1;
        $this->files_data->timecreated = 0;
        $this->files_data->timemodified = 0;
        $this->files_data->sortorder = 1;

        $this->sync_log_data = new stdClass();
        $this->sync_log_data->id = 1;
        $this->sync_log_data->runid = 1;
        $this->sync_log_data->time = 1;
        $this->sync_log_data->element = 'user';
        $this->sync_log_data->logtype = 'info';
        $this->sync_log_data->action = 'user sync';
        $this->sync_log_data->info = 'sync started';

        $this->appraisal = new stdClass();
        $this->appraisal->id = 1;
        $this->appraisal->name = 'Appraisal 1';
        $this->appraisal->description = 'Description';
        $this->appraisal->status = 0;
        $this->appraisal->timestarted = 1332243112;
        $this->appraisal->timefinished = 1332643112;

        $this->appraisal_stage = new stdClass();
        $this->appraisal_stage->id = 2;
        $this->appraisal_stage->appraisalid = 1;
        $this->appraisal_stage->name = 'Stage 1';
        $this->appraisal_stage->timedue = 1332443112;

        $this->appraisal_user_assignment = new stdClass();
        $this->appraisal_user_assignment->id = 3;
        $this->appraisal_user_assignment->userid = 2;
        $this->appraisal_user_assignment->appraisalid = 1;
        $this->appraisal_user_assignment->assignedvia = 'Position 1';
        $this->appraisal_user_assignment->activestageid = 2;
        $this->appraisal_user_assignment->timecompleted = null;

        $this->goal = new stdClass();
        $this->goal->id = 1;
        $this->goal->frameworkid = 2;
        $this->goal->fullname = 'Goal 1';
        $this->goal->parentid = 0;
        $this->goal->visible = 1;
        $this->goal->proficiencyexpected = 0;
        $this->goal->timecreated = 0;
        $this->goal->timemodified = 0;
        $this->goal->usermodified = 0;

        $this->goal_framework = new stdClass();
        $this->goal_framework->id = 2;
        $this->goal_framework->fullname = 'Goal Framework 1';
        $this->goal_framework->sortorder = 1;
        $this->goal_framework->visible = 1;
        $this->goal_framework->hidecustomfields = 0;
        $this->goal_framework->timecreated = 0;
        $this->goal_framework->timemodified = 0;
        $this->goal_framework->usermodified = 0;

        $this->goal_record = new stdClass();
        $this->goal_record->id = 3;
        $this->goal_record->userid = 2;
        $this->goal_record->scalevalueid = 4;
        $this->goal_record->goalid = 1;
        $this->goal_record->deleted = 0;

        $this->goal_scale_data = new stdClass();
        $this->goal_scale_data->id = 5;
        $this->goal_scale_data->name = 'Goal Scale';
        $this->goal_scale_data->description = '';
        $this->goal_scale_data->timemodified = 1332153671;
        $this->goal_scale_data->usermodified = 1;
        $this->goal_scale_data->defaultid = 4;

        $this->goal_scale_values = new stdClass();
        $this->goal_scale_values->id = 4;
        $this->goal_scale_values->scaleid = 5;
        $this->goal_scale_values->name = 'Scale value 1';
        $this->goal_scale_values->sortorder = 1;
        $this->goal_scale_values->timemodified = 0;
        $this->goal_scale_values->usermodified = 0;

        $this->goal_item_history_data = new stdClass();
        $this->goal_item_history_data->id = 1;
        $this->goal_item_history_data->scope = 2;
        $this->goal_item_history_data->itemid = 1;
        $this->goal_item_history_data->scalevalueid = 1;
        $this->goal_item_history_data->timemodified = 1332153671;
        $this->goal_item_history_data->usermodified = 1;

        $this->goal_personal_data = new stdClass();
        $this->goal_personal_data->id = 1;
        $this->goal_personal_data->userid = 1;
        $this->goal_personal_data->name = 'My Personal Goal';
        $this->goal_personal_data->description = '';
        $this->goal_personal_data->targetdate = 1332153671;
        $this->goal_personal_data->scaleid = 1;
        $this->goal_personal_data->scalevalueid = 4;
        $this->goal_personal_data->assigntype = 1;
        $this->goal_personal_data->timecreated = 1332153671;
        $this->goal_personal_data->usercreated = 1;
        $this->goal_personal_data->timemodified = 1332153671;
        $this->goal_personal_data->usermodified = 1;
        $this->goal_personal_data->deleted = 0;

        // Note most of this is just random filler, but component MUST be a valid value e.g. course/program/competency.
        $this->filler_data = new stdClass();
        $this->filler_data->id = 1;
        $this->filler_data->courseid = 1;
        $this->filler_data->programid = 1;
        $this->filler_data->competencyid = 1;
        $this->filler_data->templateid = 1;
        $this->filler_data->enabled = 1;
        $this->filler_data->sortorder = 1;
        $this->filler_data->manualcomplete = 1;
        $this->filler_data->component = 'prgram';
        $this->filler_data->enrol = 'cohort';
        $this->filler_data->customint1 = 1;

        $this->dummy_data = new stdClass();
        $this->dummy_data->id = 1;
        $this->dummy_data->userid = 2;
        $this->dummy_data->frameworkid = 1;
        $this->dummy_data->competency = 1;
        $this->dummy_data->competencyid = 1;
        $this->dummy_data->competencycount = 1;
        $this->dummy_data->instanceid = 1;
        $this->dummy_data->iteminstance = 1;
        $this->dummy_data->itemid = 1;
        $this->dummy_data->templateid = 1;
        $this->dummy_data->id1 = 1;
        $this->dummy_data->id2 = 1;
        $this->dummy_data->proficiency = 1;
        $this->dummy_data->timecreated = 1;
        $this->dummy_data->timemodified = 1;
        $this->dummy_data->usermodified = 1;
        $this->dummy_data->organisationid = 1;
        $this->dummy_data->positionid = 1;
        $this->dummy_data->assessorid = 1;
        $this->dummy_data->assessorname = 'Name';
        $this->dummy_data->fullname = 'fullname';
        $this->dummy_data->visible = 1;
        $this->dummy_data->type = 1;

        $this->visible_cohort_data = new stdClass();
        $this->visible_cohort_data->id = 1;
        $this->visible_cohort_data->cohortid = 1;
        $this->visible_cohort_data->instanceid = 1;
        $this->visible_cohort_data->instancetype = 50;
        $this->visible_cohort_data->timemodified = 1;
        $this->visible_cohort_data->timecreated = 1;
        $this->visible_cohort_data->usermodified = 1;

        $this->totara_compl_import_course_data = new stdClass();
        $this->totara_compl_import_course_data->id = 1;
        $this->totara_compl_import_course_data->username = 'username';
        $this->totara_compl_import_course_data->courseshortname = 'shortname';
        $this->totara_compl_import_course_data->courseidnumber = 'idnumber';
        $this->totara_compl_import_course_data->completiondate = '2013-08-27';
        $this->totara_compl_import_course_data->grade = 'grade';
        $this->totara_compl_import_course_data->timecreated = time();
        $this->totara_compl_import_course_data->timeupdated = time();
        $this->totara_compl_import_course_data->importuserid = 1;
        $this->totara_compl_import_course_data->importerror = 1;
        $this->totara_compl_import_course_data->importerrormsg = 'nousername;usernamenotfound;nocourse;nomanualenrol;';
        $this->totara_compl_import_course_data->rownumber = 1;
        $this->totara_compl_import_course_data->importevidence = 0;

        $this->totara_compl_import_cert_data = new stdClass();
        $this->totara_compl_import_cert_data->id = 1;
        $this->totara_compl_import_cert_data->username = 'username';
        $this->totara_compl_import_cert_data->certificationshortname = 'shortname';
        $this->totara_compl_import_cert_data->certificationidnumber = 'idnumber';
        $this->totara_compl_import_cert_data->completiondate = '2013-08-27';
        $this->totara_compl_import_cert_data->timecreated = time();
        $this->totara_compl_import_cert_data->timeupdated = time();
        $this->totara_compl_import_cert_data->importuserid = 1;
        $this->totara_compl_import_cert_data->importerror = 1;
        $this->totara_compl_import_cert_data->importerrormsg = 'nousername;usernamenotfound;nocourse;nomanualenrol;';
        $this->totara_compl_import_cert_data->rownumber = 1;
        $this->totara_compl_import_cert_data->importevidence = 0;

        $this->certif_data = new stdClass();
        $this->certif_data->id = 1;
        $this->certif_data->learningcomptype = 1;
        $this->certif_data->activeperiod = '1 year';
        $this->certif_data->windowperiod = '4 week';
        $this->certif_data->recertifydatetype = 1;
        $this->certif_data->timemodified = 1332153673;

        $this->certif_completion_data = new stdClass();
        $this->certif_completion_data->id = 1;
        $this->certif_completion_data->certifid = 1;
        $this->certif_completion_data->userid = 2;
        $this->certif_completion_data->certifpath = 1;
        $this->certif_completion_data->status = 1;
        $this->certif_completion_data->renewalstatus = 0;
        $this->certif_completion_data->timewindowopens = 0;
        $this->certif_completion_data->timeexpires = 0;
        $this->certif_completion_data->timecompleted = 0;
        $this->certif_completion_data->timemodified = 1332153671;

        $this->certif_completion_history_data = new stdClass();
        $this->certif_completion_history_data->id = 1;
        $this->certif_completion_history_data->certifid = 1;
        $this->certif_completion_history_data->userid = 2;
        $this->certif_completion_history_data->certifpath = 1;
        $this->certif_completion_history_data->status = 1;
        $this->certif_completion_history_data->renewalstatus = 0;
        $this->certif_completion_history_data->timewindowopens = 1332153673;
        $this->certif_completion_history_data->timeexpires = 1332113673;
        $this->certif_completion_history_data->timecompleted = null;
        $this->certif_completion_history_data->timemodified = 1332153671;

        $this->course_completion_history_data = new stdClass();
        $this->course_completion_history_data->id = 1;
        $this->course_completion_history_data->courseid = 1;
        $this->course_completion_history_data->userid = 1;
        $this->course_completion_history_data->timecompleted = 1332153671;
        $this->course_completion_history_data->grade = 1;

        $this->comp_record_history_data = new stdClass();
        $this->comp_record_history_data->id = 1;
        $this->comp_record_history_data->userid = 1;
        $this->comp_record_history_data->competencyid = 1;
        $this->comp_record_history_data->proficiency = 1;
        $this->comp_record_history_data->timemodified = 1332153671;
        $this->comp_record_history_data->usermodified = 1;

        $DB->insert_record('report_builder', $this->rb_data);
        $DB->insert_record('report_builder_columns', $this->rb_col_data);
        $DB->insert_record('report_builder_filters', $this->rb_filter_data);
        $DB->insert_records_via_batch('report_builder_settings', $this->rb_settings_data);
        $DB->insert_record('user_info_field', $this->user_info_field_data);
        $DB->insert_record('user_info_data', $this->user_info_data_data);
        $DB->insert_records_via_batch('org_framework', $this->org_framework_data);
        $DB->insert_records_via_batch('org_type', $this->type_data);
        $DB->insert_record('org', $this->org_data);
        $DB->insert_records_via_batch('pos_framework', $this->pos_framework_data);
        $DB->insert_records_via_batch('pos_type', $this->type_data);
        $DB->insert_record('pos', $this->pos_data);
        $DB->insert_record('pos_assignment', $this->pos_assignment_data);
        $DB->insert_record('facetoface_session_data', $this->f2f_session_data_data);
        $DB->insert_record('course_completion_crit_compl', $this->course_completion_crit_compl_data);
        $DB->insert_record('course_completion_criteria', $this->course_completion_criteria_data);
        $DB->insert_record('course_completions', $this->course_completions_data);
        $DB->insert_record('log', $this->log_data);
        $DB->insert_record('course', $this->course_data);
        $DB->insert_record('grade_items', $this->grade_items_data);
        $DB->insert_record('grade_grades', $this->grade_grades_data);
        $DB->insert_records_via_batch('comp_framework', $this->framework_data);
        $DB->insert_records_via_batch('comp_type', $this->type_data);
        $DB->insert_records_via_batch('comp', $this->comp_data);
        $DB->insert_record('comp_type_info_field', $this->type_field_data);
        $DB->insert_record('comp_type_info_data', $this->type_data_data);
        $DB->insert_record('comp_record', $this->dummy_data);
        $DB->insert_record('comp_record_history', $this->comp_record_history_data);
        $DB->insert_record('comp_criteria', $this->dummy_data);
        $DB->insert_record('comp_criteria_record', $this->dummy_data);
        $DB->insert_record('comp_template', $this->dummy_data);
        $DB->insert_record('comp_template_assignment', $this->dummy_data);
        $DB->insert_record('pos_competencies', $this->dummy_data);
        $DB->insert_record('comp_relations', $this->dummy_data);
        $DB->insert_record('facetoface', $this->f2f_data);
        $DB->insert_record('facetoface_sessions', $this->f2f_session_data);
        $DB->insert_record('facetoface_sessions_dates', $this->f2f_session_dates_data);
        $DB->insert_record('facetoface_signups', $this->f2f_signups_data);
        $DB->insert_record('facetoface_signups_status', $this->f2f_signup_status_data);
        $DB->insert_record('facetoface_session_roles', $this->f2f_session_roles_data);
        $DB->insert_record('scorm_scoes', $this->scorm_scoes_data);
        $DB->insert_records_via_batch('scorm_scoes_track', $this->scorm_scoes_track_data);
        $DB->insert_record('feedback', $this->feedback_data);
        $DB->insert_record('feedback_item', $this->feedback_item_data);
        $DB->insert_record('feedback_completed', $this->feedback_completed_data);
        $DB->insert_record('feedback_value', $this->feedback_value_data);
        $DB->insert_record('tag', $this->tag_data);
        $DB->insert_record('tag_instance', $this->tag_instance_data);
        $DB->insert_record('course_info_field', $this->course_info_field_data);
        $DB->insert_record('course_info_data', $this->course_info_data_data);
        $DB->insert_record('course_modules', $this->course_modules_data);
        $DB->insert_record('block_totara_stats', $this->block_totara_stats_data);
        $DB->insert_record('message', $this->message_data);
        $DB->insert_record('message_working', $this->message_working_data);
        $DB->insert_record('message_metadata', $this->message_metadata_data);
        $DB->insert_record('dp_template', $this->dp_template_data);
        $DB->insert_record('dp_plan', $this->dp_plan_data);
        $DB->insert_record('dp_plan_competency_assign', $this->dp_plan_competency_assign_data);
        $DB->insert_record('dp_plan_course_assign', $this->dp_plan_course_assign_data);
        $DB->insert_record('dp_priority_scale_value', $this->dp_priority_scale_value_data);
        $DB->insert_record('dp_plan_objective', $this->dp_plan_objective_data);
        $DB->insert_record('dp_evidence_type', $this->dp_plan_evidence_type_data);
        $DB->insert_record('dp_plan_evidence', $this->dp_plan_evidence_data);
        $DB->insert_record('dp_plan_evidence_relation', $this->dp_plan_evidence_relation_data);
        $DB->insert_record('dp_objective_scale_value', $this->dp_objective_scale_value_data);
        $DB->insert_record('dp_plan_component_relation', $this->dp_plan_component_relation_data);
        $DB->insert_record('cohort', $this->cohort_data);
        $DB->insert_record('cohort_members', $this->cohort_members_data);
        $DB->insert_records_via_batch('prog', $this->prog_data);
        $DB->insert_record('prog_courseset', $this->prog_courseset_data);
        $DB->insert_record('prog_courseset_course', $this->prog_courseset_course_data);
        $DB->insert_record('prog_extension', $this->prog_extension_data);
        $DB->insert_records_via_batch('prog_completion', $this->prog_completion_data);
        $DB->insert_record('prog_completion_history', $this->prog_completion_history_data);
        $DB->insert_record('prog_user_assignment', $this->prog_user_assignment_data);
        $DB->insert_record('pos_type_info_field', $this->pos_type_info_field_data);
        $DB->insert_record('org_type_info_field', $this->org_type_info_field_data);
        $DB->insert_record('pos_type_info_data', $this->pos_type_info_data_data);
        $DB->insert_record('org_type_info_data', $this->org_type_info_data_data);
        $DB->insert_record('assignment', $this->assignment_data);
        $DB->insert_record('assignment_submissions', $this->assignment_submissions_data);
        $DB->insert_records_via_batch('scale', $this->scale_data);
        $DB->insert_record('filter_config', $this->filter_config_data);
        $DB->insert_record('filter_active', $this->filter_active_data);
        $DB->insert_record('files', $this->files_data);
        $DB->insert_record('enrol', $this->filler_data);
        $DB->insert_record('prog_assignment', $this->filler_data);
        $DB->insert_record('totara_sync_log', $this->sync_log_data);
        $DB->insert_record('cohort_visibility', $this->visible_cohort_data);
        $DB->insert_record('appraisal', $this->appraisal);
        $DB->insert_record('appraisal_stage', $this->appraisal_stage);
        $DB->insert_record('appraisal_user_assignment', $this->appraisal_user_assignment);
        $DB->insert_record('goal', $this->goal);
        $DB->insert_record('goal_framework', $this->goal_framework);
        $DB->insert_record('goal_record', $this->goal_record);
        $DB->insert_record('goal_scale_values', $this->goal_scale_values);
        $DB->insert_record('goal_item_history', $this->goal_item_history_data);
        $DB->insert_record('goal_scale', $this->goal_scale_data);
        $DB->insert_record('goal_personal', $this->goal_personal_data);
        $DB->insert_record('totara_compl_import_course', $this->totara_compl_import_course_data);
        $DB->insert_record('totara_compl_import_cert', $this->totara_compl_import_cert_data);
        $DB->insert_record('certif', $this->certif_data);
        $DB->insert_record('certif_completion', $this->certif_completion_data);
        $DB->insert_record('certif_completion_history', $this->certif_completion_history_data);
        $DB->insert_record('course_completion_history', $this->course_completion_history_data);

        // db version of report
        $this->rb = new reportbuilder(1);
    }

    /**
     * Check all reports columns and filters
     *
     * @param bool $usecache
     * @dataProvider provider_use_cache
     * @group slowtest
     */
    function test_columns_and_filters($usecache) {
        global $SESSION, $DB;
        // loop through installed sources
        foreach (reportbuilder::get_source_list(true) as $sourcename => $title) {
            // echo '<h3>Title : [' . $title . '] Sourcename : [' . $sourcename . ']</h3>' . "\n";
            $src = reportbuilder::get_source_object($sourcename);
            foreach ($src->columnoptions as $column) {
                // create a report
                $report = new stdClass();
                $report->fullname = 'Test Report';
                $report->shortname = 'test1';
                $report->source = $sourcename;
                $report->hidden = 0;
                $report->accessmode = 0;
                $report->contentmode = 0;
                $reportid = $DB->insert_record('report_builder', $report);
                $col = new stdClass();
                $col->reportid = $reportid;
                $col->type = $column->type;
                $col->value = $column->value;
                $col->heading = addslashes($column->defaultheading);
                $col->sortorder = 1;
                $colid = $DB->insert_record('report_builder_columns', $col);
                // create the reportbuilder object
                // echo '<h5>column option : Test ' . $column->type . '-' . $column->value . ' column:</h5>' . "\n";

                if ($usecache) {
                    $this->enable_caching($reportid);
                }

                $rb = new reportbuilder($reportid);
                $sql = $rb->build_query();
                // echo '<h5>sql ' . var_export($sql, true) . '</h5>' . "\n";
                $records = $DB->get_recordset_sql($sql[0], $sql[1], 0, 40);
                foreach ($records as $record) {
                    if (array_key_exists('competency_proficiencyandapproval', $record)) {
                        $this->setAdminUser();
                    }
                    $data = $rb->process_data_row($record);
                }
                $records->close();
                $message = "\nReport title : {$title}\n";
                $message .= "Report sourcename : {$sourcename}\n";
                $message .= "Column option : Test {$column->type}_{$column->value} column\n";
                $message .= "SQL : {$sql[0]}\n";
                $message .= "SQL Params : " . var_export($sql[1], true) . "\n";
                if ($title == "User" || $title == "Courses" ||
                        in_array($sourcename, array('dp_certification_history', 'program_completion'))) {
                    $this->assertEquals('2', $rb->get_full_count(), $message);
                }
                else{
                    $this->assertEquals('1', $rb->get_full_count(), $message);
                }
                // remove afterwards
                $DB->delete_records('report_builder', array('id' => $reportid));
            }

            foreach ($src->filteroptions as $filter) {
                // create a report
                $report = new stdClass();
                $report->fullname = 'Test Report';
                $report->shortname = 'test1';
                $report->source = $sourcename;
                $report->hidden = 0;
                $report->accessmode = 0;
                $report->contentmode = 0;
                $reportid = $DB->insert_record('report_builder', $report);
                // If the filter is based on a column, include that column
                if (empty($filter->field)) {
                    // add a single column
                    $col = new stdClass();
                    $col->reportid = $reportid;
                    $col->type = $filter->type;
                    $col->value = $filter->value;
                    $col->heading = 'Test';
                    $col->sortorder = 1;
                    $colid = $DB->insert_record('report_builder_columns', $col);
                }
                // add a single filter
                $fil = new stdClass();
                $fil->reportid = $reportid;
                $fil->type = $filter->type;
                $fil->value = $filter->value;
                //$fil->advanced = addslashes($filter->defaultadvanced);
                $fil->sortorder = 1;
                $filid = $DB->insert_record('report_builder_filters', $fil);
                // create the reportbuilder object
                // echo '<h5>Filter option : Test ' . $filter->type . '-' . $filter->value . ' filter:</h5>'."\n";
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

                $records = $DB->get_recordset_sql($sql[0], $sql[1]);

                foreach ($records as $record) {
                    $data = $rb->process_data_row($record);
                }

                $records->close();
                $message = "\nReport title : {$title}\n";
                $message .= "Report sourcename : {$sourcename}\n";
                $message .= "Filter option : Test {$filter->type}_{$filter->value} filter\n";
                $message .= "SQL : {$sql[0]}\n";
                $message .= "SQL Params : " . var_export($sql[1], true) . "\n";
                $this->assertRegExp('/[012]/', (string)$rb->get_filtered_count(), $message);
                // remove afterwards
                $DB->delete_records('report_builder', array('id' => $reportid));
                unset($SESSION->{$filtername});
            }
        }

        $this->resetAfterTest(true);
    }
}
