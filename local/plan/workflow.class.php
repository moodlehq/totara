<?php

abstract class dp_base_workflow {

    function __construct() {

        // check that child classes implement required properties
        $properties = array(
            'classname',

            //course config options
            'cfg_course_duedatemode',
            'cfg_course_prioritymode',

            //competency config options
            'cfg_competency_autoassignpos',
            'cfg_competency_autoassignorg',
            'cfg_competency_autoassigncourses',
            'cfg_competency_duedatemode',
            'cfg_competency_prioritymode',

            //objective config options
            'cfg_objective_duedatemode',
            'cfg_objective_prioritymode',

            //plan permission settings
            'perm_plan_view_learner',
            'perm_plan_view_manager',
            'perm_plan_create_learner',
            'perm_plan_create_manager',
            'perm_plan_update_learner',
            'perm_plan_update_manager',
            'perm_plan_delete_learner',
            'perm_plan_delete_manager',
            'perm_plan_approve_learner',
            'perm_plan_approve_manager',
            'perm_plan_complete_learner',
            'perm_plan_complete_manager',

            //course permission settings
            'perm_course_updatecourse_learner',
            'perm_course_updatecourse_manager',
            'perm_course_commenton_learner',
            'perm_course_commenton_manager',
            'perm_course_setpriority_learner',
            'perm_course_setpriority_manager',
            'perm_course_setduedate_learner',
            'perm_course_setduedate_manager',
            'perm_course_setcompletionstatus_learner',
            'perm_course_setcompletionstatus_manager',

            //competency permission settings
            'perm_competency_updatecompetency_learner',
            'perm_competency_updatecompetency_manager',
            'perm_competency_commenton_learner',
            'perm_competency_commenton_manager',
            'perm_competency_setpriority_learner',
            'perm_competency_setpriority_manager',
            'perm_competency_setduedate_learner',
            'perm_competency_setduedate_manager',
            'perm_competency_setproficiency_learner',
            'perm_competency_setproficiency_manager',

            //objective permission settings
            'perm_objective_updateobjective_learner',
            'perm_objective_updateobjective_manager',
            'perm_objective_commenton_learner',
            'perm_objective_commenton_manager',
            'perm_objective_setpriority_learner',
            'perm_objective_setpriority_manager',
            'perm_objective_setduedate_learner',
            'perm_objective_setduedate_manager',
            'perm_objective_setproficiency_learner',
            'perm_objective_setproficiency_manager',
            
        );
        foreach($properties as $property) {
            if(!property_exists($this, $property)) {
                $msg = new object();
                $msg->class = get_class($this);
                $msg->property = $property;
                throw new Exception(get_string('error:propertymustbeset', 'local_plan', $msg));
            }
        }
        // reserve the name 'custom' for use by the system
        if($this->classname == 'custom') {
            throw new Exception(get_string('error:cantcreatecustomworkflow', 'local_plan'));
        }

        // get name and description lang string based on name
        $this->name = get_string($this->classname . 'workflowname', 'local_plan');
        $this->description = get_string($this->classname . 'workflowdesc', 'local_plan');
    }


    /**
     * Returns a list of differences between the workflow's settings
     * and the current database settings used to let the user know
     * what will change if they switch workflows.
     *
     * @param int templateid id of the current template
     * @return array diff an array of changes
     */
    function list_differences($templateid) {
        global $CFG;
        $diff = array();

        if(!$course_settings = get_record('dp_course_settings', 'templateid', $templateid)) {
            error(get_string('error:missingcoursesettings', 'local_plan'));
        }

        if(!$competency_settings = get_record('dp_competency_settings', 'templateid', $templateid)) {
            error(get_string('error:missingcompetencysettings', 'local_plan'));
        }

        if(!$objective_settings = get_record('dp_objective_settings', 'templateid', $templateid)) {
            error(get_string('error:missingobjectivesettings', 'local_plan'));
        }

        foreach(get_object_vars($this) as $property => $value) {
            $parts = explode('_', $property);
            if($parts[0] == 'cfg') {
                switch($parts[1]){
                case 'course':
                    $attribute = $parts[2];
                    if($value != $course_settings->$attribute) {
                        $diff[$property] = array('before' => $course_settings->$attribute, 'after' => $value);
                    }
                    break;
                case 'competency':
                    $attribute = $parts[2];
                    if($value != $competency_settings->$attribute) {
                        $diff[$property] = array('before' => $competency_settings->$attribute, 'after' => $value);
                    }
                    break;
                case 'objective':
                    $attribute = $parts[2];
                    if($value != $objective_settings->$attribute) {
                        $diff[$property] = array('before' => $objective_settings->$attribute, 'after' => $value);
                    }
                    break;
                }

            } elseif ($parts[0] == 'perm') {
                $sql = "SELECT value FROM {$CFG->prefix}dp_permissions WHERE templateid={$templateid} AND role='{$parts[3]}' AND component='{$parts[1]}' AND action='{$parts[2]}'";
                if(!$dbval = get_field_sql($sql)) {
                    echo(get_string('error:missingpermissionsetting', 'local_plan'));
                }

                if($value != $dbval){
                    $diff[$property] = array('before' => $dbval, 'after' => $value);
                }

            }
        }
        return $diff;
    }

    /**
     * Copies all the settings and permissions for a workflow to
     * the database, overriding existing values
     *
     * @param int $templateid id of the current template
     * @return bool
     */
    function copy_to_db($templateid) {
        global $CFG;

        $returnurl = $CFG->wwwroot . '/local/plan/template/workflow?id=' . $templateid;

        if(!$templateid) {
            error(get_string('error:templateid', 'local_plan'));
        }

        $course_todb = new object();
        if($course_settings = get_record('dp_course_settings', 'templateid', $templateid)){
            $course_todb->id = $course_settings->id;
        }

        $competency_todb = new object();
        if($competency_settings = get_record('dp_competency_settings', 'templateid', $templateid)){
            $competency_todb->id = $competency_settings->id;
        }

        $objective_todb = new object();
        if($objective_settings = get_record('dp_objective_settings', 'templateid', $templateid)){
            $objective_todb->id = $objective_settings->id;
        }

        foreach(get_object_vars($this) as $property => $value) {
            $parts = explode('_', $property);
            if($parts[0] == 'cfg') {
                switch($parts[1]){
                case 'course':
                    $course_todb->$parts[2] = $value;
                    break;
                case 'competency':
                    $competency_todb->$parts[2] = $value;
                    break;
                case 'objective':
                    $objective_todb->$parts[2] = $value;
                    break;
                }

            } elseif ($parts[0] == 'perm') {
                $perm_todb = new object();
                $perm_todb->templateid = $templateid;
                $perm_todb->role = $parts[3];
                $perm_todb->component = $parts[1];
                $perm_todb->action = $parts[2];
                $perm_todb->value = $value;

                $sql = "SELECT * FROM {$CFG->prefix}dp_permissions WHERE templateid={$templateid} AND role='{$parts[3]}' AND component='{$parts[1]}' AND action='{$parts[2]}'";
                if(!$record = get_record_sql($sql)) {
                    //insert
                    begin_sql();
                    if(!insert_record('dp_permissions', $perm_todb)){
                        rollback_sql();
                        totara_set_notification(get_string('error:todb_updatepermissionserror', $returnurl));
                        return false;
                    }
                } else {
                    //update
                    begin_sql();
                    $perm_todb->id = $record->id;
                    if(!update_record('dp_permissions', $perm_todb)){
                        rollback_sql();
                        totara_set_notification(get_string('error:todb_updatepermissionserror', $returnurl));
                        return false;
                    }
                }
            }
        }

        //Write settings to tables
        if($course_settings) {
            if(!update_record('dp_course_settings', $course_todb)) {
                rollback_sql();
                totara_set_notification(get_string('error:todb_coursesettingerror', $returnurl));
                return false;
            }
        } else {
            $course_todb->templateid = $templateid;
            if(!insert_record('dp_course_settings', $course_todb)){
                rollback_sql();
                totara_set_notification(get_string('error:todb_coursesettingerror', $returnurl));
                return false;
            }
        }

        if($competency_settings) {
            if(!update_record('dp_competency_settings', $competency_todb)) {
                rollback_sql();
                totara_set_notification(get_string('error:todb_competencysettingerror', $returnurl));
                return false;
            }
        } else {
            $competency_todb->templateid = $templateid;
            if(!insert_record('dp_competency_settings', $competency_todb)){
                rollback_sql();
                totara_set_notification(get_string('error:todb_competencysettingerror', $returnurl));
                return false;
            }
        }

        if($objective_settings) {
            if(!update_record('dp_objective_settings', $objective_todb)) {
                rollback_sql();
                totara_set_notification(get_string('error:todb_objectivesettingerror', $returnurl));
                return false;
            }
        } else {
            $objective_todb->templateid = $templateid;
            if(!insert_record('dp_objective_settings', $objective_todb)){
                rollback_sql();
                totara_set_notification(get_string('error:todb_objectivesettingerror', $returnurl));
                return false;
            }
        }

        commit_sql();
        return true;

    }
}
