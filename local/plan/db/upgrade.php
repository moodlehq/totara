<?php

// This file keeps track of upgrades to
// the plan module
//
// Sometimes, changes between versions involve
// alterations to database structures and other
// major things that may break installations.
//
// The upgrade function in this file will attempt
// to perform all the necessary actions to upgrade
// your older installtion to the current version.
//
// If there's something it cannot do itself, it
// will tell you what you need to do.
//
// The commands in here will all be database-neutral,
// using the functions defined in lib/ddllib.php

function xmldb_local_plan_upgrade($oldversion=0) {

    global $CFG, $db;

    require_once($CFG->dirroot . '/local/plan/lib.php');

    $result = true;

    if ($result && $oldversion < 2010102700) {
        // hack to get cron working via admin/cron.php
        // at some point we should create a local_modules table
        // based on data in version.php
        set_config('local_plan_cron', 60);
    }

    if ($result && $oldversion < 2010113000) {

    /// Define table dp_objective_settings to be created
        $table = new XMLDBTable('dp_objective_settings');

    /// Adding fields to table dp_objective_settings
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null, null);
        $table->addFieldInfo('templateid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);
        $table->addFieldInfo('duedatemode', XMLDB_TYPE_INTEGER, '4', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0');
        $table->addFieldInfo('prioritymode', XMLDB_TYPE_INTEGER, '4', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0');
        $table->addFieldInfo('priorityscale', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null, null, null);

    /// Adding keys to table dp_objective_settings
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));

    /// Launch create table for dp_objective_settings
        $result = $result && create_table($table);
    }

    if ($result && $oldversion < 2010113001) {

    /// Define table dp_plan_objective to be created
        $table = new XMLDBTable('dp_plan_objective');

    /// Adding fields to table dp_plan_objective
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null, null);
        $table->addFieldInfo('planid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);
        $table->addFieldInfo('fullname', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null, null, null);
        $table->addFieldInfo('shortname', XMLDB_TYPE_CHAR, '100', null, null, null, null, null, null);
        $table->addFieldInfo('description', XMLDB_TYPE_TEXT, 'medium', null, null, null, null, null, null);
        $table->addFieldInfo('priority', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null, null, null);
        $table->addFieldInfo('duedate', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null, null, null);
        $table->addFieldInfo('status', XMLDB_TYPE_INTEGER, '4', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);

    /// Adding keys to table dp_plan_objective
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));

    /// Launch create table for dp_plan_objective
        $result = $result && create_table($table);
    }

    if ($result && $oldversion < 2010113002) {

    /// Define table dp_plan_objective_assign to be created
        $table = new XMLDBTable('dp_plan_objective_assign');

    /// Adding fields to table dp_plan_objective_assign
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null, null);
        $table->addFieldInfo('objectiveid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);
        $table->addFieldInfo('itemtype', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null, null, null);
        $table->addFieldInfo('itemid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);
        $table->addFieldInfo('approved', XMLDB_TYPE_INTEGER, '4', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0');
        $table->addFieldInfo('timecreated', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);
        $table->addFieldInfo('timemodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);
        $table->addFieldInfo('usermodified', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);

    /// Adding keys to table dp_plan_objective_assign
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));

    /// Launch create table for dp_plan_objective_assign
        $result = $result && create_table($table);
    }

    if ($result && $oldversion < 2010113003){
        // Create objective settings for existing templates so they don't break
        $templates = get_records('dp_template', '', '', 'id', 'id');
        if ( is_array($templates) ){
            foreach( $templates as $t ){
                begin_sql();
                $settings = new stdClass();
                $settings->templateid=$t->id;
                $settings->component='objective';
                // Hide objectives in existing templates
                $settings->enabled=0;
                $settings->sortorder= 1 + count_records('dp_component_settings');
                insert_record('dp_component_settings', $settings);
                commit_sql();
            }
        }
    }

    // Fill in permissions and settings for objectives in existing templates
    if ($result && $oldversion < 2010120301){
        $templates = get_records_sql(
                "select p.templateid from {$CFG->prefix}dp_permissions p group by p.templateid having sum(case when p.component='objective' then 1 else 0 end)=0"
        );
        if ( is_array($templates) ){
            $roles = array('learner','manager');
            $actions=array('updateobjective','commenton','setpriority','setduedate');

            foreach( $templates as $t ){
                begin_sql();
                $perm = new stdClass();
                $perm->templateid = $t->templateid;
                foreach( $roles as $r ){
                    foreach( $actions as $a ){
                        $perm->role = $r;
                        $perm->action = $a;
                        $perm->value=50;
                        $perm->component = 'objective';
                        insert_record('dp_permissions', $perm);
                    }
                }

                $progset = new stdClass();
                $progset->templateid = $t->templateid;
                $progset->duedatemode=0;
                $progset->prioritymode=0;
                insert_record('dp_objective_settings', $progset);
                commit_sql();
            }
        }
    }

    if ($result && $oldversion < 2010120800) {

    /// Define table dp_plan_objective_assign to be dropped
        $table = new XMLDBTable('dp_plan_objective_assign');

    /// Launch drop table for dp_plan_objective_assign
        $result = $result && drop_table($table);
    }

    if ($result && $oldversion < 2010120801) {

    /// Rename field status on table dp_plan_objective to scalevalueid
        $table = new XMLDBTable('dp_plan_objective');
        $field = new XMLDBField('status');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '4', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null, 'duedate');

    /// Launch rename field status
        $result = $result && rename_field($table, $field, 'scalevalueid');
    }

    if ($result && $oldversion < 2010120802) {

        // If there are no objective scales, we'll need to create one so that this not-null column can be added.
        $scaleid = get_field_select('dp_objective_scale', 'min(id)', '1=1');
        if ( !$scaleid ){
            global $USER;

            $scale = new stdClass();
            $scale->name='Default objective scale';
            $scale->description='Default scale of for ranking objective completion.';
            $scale->timemodified=time();
            $scale->usermodified=$USER->id;
            $scaleid = insert_record('dp_objective_scale', $scale);
            $result = $result && $scaleid;

            $scalevalue = new stdClass();
            $scalevalue->objscaleid = $scaleid;
            $scalevalue->name = 'Incomplete';
            $scalevalue->sortorder = 0;
            $scalevalue->timemodified = time();
            $scalevalue->usermodified = $USER->id;
            $scalevalue->achieved = 0;
            $defaultid = insert_record('dp_objective_scale_value', $scalevalue);
            $result = $result && $defaultid;

            $scalevalue->name='Complete';
            $scalevalue->achieved = 1;
            $scalevalue->sortorder = 1;
            $result = $result && insert_record('dp_objective_scale_value', $scalevalue);

            $scale->id = $scaleid;
            $scale->defaultid = $defaultid;
            $result = $result && update_record('dp_objective_scale', $scale);
        }

    /// Define field objectivescale to be added to dp_objective_settings
        $table = new XMLDBTable('dp_objective_settings');
        $field = new XMLDBField('objectivescale');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, $scaleid, 'priorityscale');

    /// Launch add field objectivescale
        $result = $result && add_field($table, $field);

    /// Changing the default of field objectivescale on table dp_objective_settings to drop it
        $table = new XMLDBTable('dp_objective_settings');
        $field = new XMLDBField('objectivescale');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null, 'priorityscale');

    /// Launch change of default for field objectivescale
        $result = $result && change_field_default($table, $field);
    }

    if ($result && $oldversion < 2010120803) {

    /// Define field approved to be added to dp_plan_objective
        $table = new XMLDBTable('dp_plan_objective');
        $field = new XMLDBField('approved');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '4', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0', 'scalevalueid');

    /// Launch add field approved
        $result = $result && add_field($table, $field);
    }

    if ($result && $oldversion < 2010120804) {

    /// Changing nullability of field objectivescale on table dp_objective_settings to null
        $table = new XMLDBTable('dp_objective_settings');
        $field = new XMLDBField('objectivescale');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null, null, null, 'priorityscale');

    /// Launch change of nullability for field objectivescale
        $result = $result && change_field_notnull($table, $field);
    }

    if ($result && $oldversion < 2010120805) {

    /// Define field sortorder to be added to dp_objective_scale
        $table = new XMLDBTable('dp_objective_scale');
        $field = new XMLDBField('sortorder');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0', 'defaultid');

    /// Launch add field sortorder
        $result = $result && add_field($table, $field);

        $priorityscalelist = get_records_select('dp_objective_scale', '1=1', 'id desc', 'id');
        if ( $priorityscalelist ){
            $sortorder = 0;
            foreach ($priorityscalelist as $ps ){
                $rec = new stdClass();
                $rec->id = $ps->id;
                $rec->sortorder = $sortorder;
                $sortorder++;
                $result = $result && update_record('dp_objective_scale', $rec);
            }
        }

    /// Changing the default of field sortorder on table dp_objective_scale to drop it
        $table = new XMLDBTable('dp_objective_scale');
        $field = new XMLDBField('sortorder');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null, 'defaultid');

    /// Launch change of default for field sortorder
        $result = $result && change_field_default($table, $field);
    }

    if ($result && $oldversion < 2010120806) {

    /// Define field sortorder to be added to dp_priority_scale
        $table = new XMLDBTable('dp_priority_scale');
        $field = new XMLDBField('sortorder');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0', 'defaultid');

    /// Launch add field sortorder
        $result = $result && add_field($table, $field);

        $priorityscalelist = get_records_select('dp_priority_scale', '1=1', 'id desc', 'id');
        if ( $priorityscalelist ){
            $sortorder = 0;
            foreach ($priorityscalelist as $ps ){
                $rec = new stdClass();
                $rec->id = $ps->id;
                $rec->sortorder = $sortorder;
                $sortorder++;
                $result = $result && update_record('dp_priority_scale', $rec);
            }
        }

    /// Changing the default of field sortorder on table dp_priority_scale to drop it
        $table = new XMLDBTable('dp_priority_scale');
        $field = new XMLDBField('sortorder');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null, 'defaultid');

    /// Launch change of default for field sortorder
        $result = $result && change_field_default($table, $field);
    }

    if ($result && $oldversion < 2010121300) {
        // We were using mdl_course.id as the course id in mdl_dp_plan_component_relation
        // when linking a course to an objective. We are switching to using
        // dp_plan_course_assign.id
        $reclist = get_records_select('dp_plan_component_relation', "component1='course' and component2='objective'");
        if($reclist) {
            foreach( $reclist as $rel ){
                $objective = get_record('dp_plan_objective', 'id', $rel->itemid2);
                $courseassign = get_record('dp_plan_course_assign', 'id', $rel->itemid1, 'planid', $objective->planid);

                // If we couldn't find a mapping for this course in the same plan as the objective, then delete
                // the link, because you should only be able to link courses that are in that plan
                if ( !$courseassign ){
                    $result = $result && delete_records('dp_plan_component_relation', 'id', $rel->id);
                } else {
                    $newrel = new stdClass();
                    $newrel->id = $rel->id;
                    $newrel->itemid1 = $courseassign->id;
                    $result = $result && update_record('dp_plan_component_relation', $newrel);
                }
            }
        }
    }

    if ($result && $oldversion < 2011011300) {
        // drop objective shortname col
        $table = new XMLDBTable('dp_plan_objective');
        $field = new XMLDBField('shortname');
        $result = $result && drop_field($table, $field);
    }

    if ($result && $oldversion < 2011012500) {

        // Define field autoassigncourses to be added to dp_competency_settings
        $table = new XMLDBTable('dp_competency_settings');
        $field = new XMLDBField('autoassigncourses');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '4', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0', 'autoassignpos');

        // Launch add field autoassigncourses
        $result = $result && add_field($table, $field);
    }

    if ($result && $oldversion < 2011012501) {
        // Update dp_permissions table to use new setting names
        $result = $result && execute_sql("UPDATE {$CFG->prefix}dp_permissions SET action='approve' WHERE action='confirm'",false);
        $result = $result && execute_sql("UPDATE {$CFG->prefix}dp_permissions SET action='complete' WHERE action='signoff'",false);
    }

    if($result && $oldversion < 2011033101) {
        $table = new XMLDBTable('dp_competency_settings');
        $field = new XMLDBField('includecompleted');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '4', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '1', 'autoassignpos');

        $result = $result && add_field($table, $field);
    }

    if ($result && $oldversion < 2011072800) {
        $table = new XMLDBTable('dp_plan_settings');

        /// Adding fields to table dp_objective_settings
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null, null);
        $table->addFieldInfo('templateid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);
        $table->addFieldInfo('manualcomplete', XMLDB_TYPE_INTEGER, '4', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '1');
        $table->addFieldInfo('autobyitems', XMLDB_TYPE_INTEGER, '4', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0');
        $table->addFieldInfo('autobyplandate', XMLDB_TYPE_INTEGER, '4', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0');

        /// Adding keys to table dp_objective_settings
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));

        /// Launch create table for dp_plan_objective_assign
        $result = $result && create_table($table);

        // Add Column reason to dp_plan_history
        $table = new XMLDBTable('dp_plan_history');
        $field = new XMLDBField('reason');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '4', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, 10, 'status');

        if (!field_exists($table, $field)) {
            $result = $result && add_field($table, $field);
        }

        // Add reason for existing records in dp_plan_history table
        begin_sql();
        if (!$result = $result && execute_sql("UPDATE {$CFG->prefix}dp_plan_history SET reason=".DP_PLAN_REASON_CREATE . " WHERE status=" . DP_PLAN_STATUS_UNAPPROVED)) {
            rollback_sql();
        }
        if (!$result = $result && execute_sql("UPDATE {$CFG->prefix}dp_plan_history SET reason=" . DP_PLAN_REASON_MANUAL_APPROVE . " WHERE status=".DP_PLAN_STATUS_APPROVED)) {
            rollback_sql();
        }
        if (!$result = $result && execute_sql("UPDATE {$CFG->prefix}dp_plan_history SET reason=" . DP_PLAN_REASON_MANUAL_COMPLETE . " WHERE status=".DP_PLAN_STATUS_COMPLETE)) {
            rollback_sql();
        }
        commit_sql();

        // Add entries in the plan settings table for each template
        if ($templates = get_records('dp_template')) {
            foreach ($templates as $template) {
                $todb->templateid = $template->id;
                $todb->manualcomplete = 1;
                $todb->autobyitems = 0;
                $auto->autobyplandate = 0;

                $result = $result && insert_record('dp_plan_settings', $todb);
            }
        }

        // hack to get cron working via admin/cron.php
        set_config('local_plan_cron', 60);

        // update plan->complete settings to plan->completereactivate
        $result = $result && execute_sql("UPDATE {$CFG->prefix}dp_permissions SET action='completereactivate' WHERE component='plan' AND action='complete'");

        // add completed column to plans
        $table = new XMLDBTable('dp_plan');
        $field = new XMLDBField('timecompleted');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null, null, null);

        $result = $result && add_field($table, $field);

        if ($plans = get_records('dp_plan', 'status', 100)) {
            foreach ($plans as $plan) {
                $updateplansql = "UPDATE {$CFG->prefix}dp_plan set timecompleted=(SELECT timemodified FROM {$CFG->prefix}dp_plan_history WHERE planid={$plan->id} AND status=100) WHERE id={$plan->id}";
                $result = $result && execute_sql($updateplansql);
            }
        }
    }

    if ($result && $oldversion < 2011072900) {
        // Add autoassigned field to competency_assign table
        $table = new XMLDBTable('dp_plan_competency_assign');
        $field = new XMLDBField('mandatory');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, 0);
        if (!field_exists($table, $field)) {
            $result = $result && add_field($table, $field);
        }
    }

    if ($result && $oldversion < 2011080100) {
        // Add column to auto add default competency evidence
        $table = new XMLDBTable('dp_competency_settings');
        $field = new XMLDBField('autoadddefaultevidence');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '4', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, 0);
        if (!field_exists($table, $field)) {
            $result = $result && add_field($table, $field);
        }
    }

    if ($result && $oldversion < 2011080200) {

    /// Define table dp_plan_program_assign to be created
        $table = new XMLDBTable('dp_plan_program_assign');

    /// Adding fields to table dp_plan_program_assign
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null, null);
        $table->addFieldInfo('planid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);
        $table->addFieldInfo('programid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);
        $table->addFieldInfo('priority', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null, null, null);
        $table->addFieldInfo('duedate', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null, null, null);
        $table->addFieldInfo('approved', XMLDB_TYPE_INTEGER, '4', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0');
        $table->addFieldInfo('completionstatus', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null, null, null);

    /// Adding keys to table dp_plan_program_assign
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));

    /// Adding indexes to table dp_plan_program_assign
        $table->addIndexInfo('planidprogramid', XMLDB_INDEX_UNIQUE, array('planid', 'programid'));
        $table->addIndexInfo('planid', XMLDB_INDEX_NOTUNIQUE, array('planid'));

    /// Launch create table for dp_plan_program_assign
        $result = $result && create_table($table);
    }

    if ($result && $oldversion < 2011051002) {

    /// Define table dp_program_settings to be created
        $table = new XMLDBTable('dp_program_settings');

    /// Adding fields to table dp_program_settings
        $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null, null);
        $table->addFieldInfo('templateid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);
        $table->addFieldInfo('duedatemode', XMLDB_TYPE_INTEGER, '4', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0');
        $table->addFieldInfo('prioritymode', XMLDB_TYPE_INTEGER, '4', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0');
        $table->addFieldInfo('priorityscale', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null, null, null);

    /// Adding keys to table dp_program_settings
        $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));

    /// Adding indexes to table dp_program_settings
        $table->addIndexInfo('templateid', XMLDB_INDEX_UNIQUE, array('templateid'));

    /// Launch create table for dp_program_settings
        $result = $result && create_table($table);

    // Create program settings for existing templates so they don't break
    // but disable programs by default in existing templates
        $templates = get_records('dp_template', '', '', 'id', 'id');
        if ( is_array($templates) ){
            foreach( $templates as $t ){
                begin_sql();
                if($settings = get_record('dp_component_settings', 'templateid', $t->id, 'component', 'program')) {
                    $settings->enabled=0;
                    $settings->sortorder = 1 + count_records('dp_component_settings', 'templateid', $t->id);
                    update_record('dp_component_settings', $settings);
                } else {
                    $settings = new stdClass();
                    $settings->templateid=$t->id;
                    $settings->component='program';
                    $settings->enabled=0;
                    $settings->sortorder = 1 + count_records('dp_component_settings', 'templateid', $t->id);
                    insert_record('dp_component_settings', $settings);
                }
                commit_sql();
            }

            $roles = array('learner','manager');
            $actions=array('updateprogram','commenton','setpriority','setduedate','setcompletionstatus');

            require_once($CFG->dirroot . '/local/plan/priorityscales/lib.php');
            if (!$defaultpriorityscale = dp_priority_default_scale_id()) {
                $defaultpriorityscale = 0;
            }


            foreach( $templates as $t ){
                begin_sql();
                $perm = new stdClass();
                $perm->templateid = $t->id;
                foreach( $roles as $r ){
                    foreach( $actions as $a ){
                        if ($rec = get_record_select('dp_permissions', "templateid={$perm->templateid} AND role='$r' AND component='program' AND action='$a'")) {
                            $rec->value=50;
                            update_record('dp_permissions', $rec);
                        } else {
                            $perm->role = $r;
                            $perm->action = $a;
                            $perm->value=50;
                            $perm->component = 'program';
                            insert_record('dp_permissions', $perm);
                        }
                    }
                }

                if($progset = get_record_select('dp_program_settings', "templateid={$t->id}")) {
                    $progset->duedatemode=0;
                    $progset->prioritymode=0;
                    $progset->priorityscale=$defaultpriorityscale;
                    update_record('dp_program_settings', $progset);
                } else {
                    $progset = new stdClass();
                    $progset->templateid = $t->id;
                    $progset->duedatemode=0;
                    $progset->prioritymode=0;
                    $progset->priorityscale=$defaultpriorityscale;
                    insert_record('dp_program_settings', $progset);
                }

                commit_sql();
            }
        }
    }

    return $result;
}
