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
                        insert_record('dp_permissions', $perm);
                    }
                }

                $objset = new stdClass();
                $objset->templateid = $t->templateid;
                $objset->duedatemode=0;
                $objset->prioritymode=0;
                insert_record('dp_objective_settings', $objset);
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

    return $result;
}
