<?php

class dp_managerdriven_workflow extends dp_base_workflow {

    function __construct() {
        $this->classname = 'managerdriven';

        // workflow settings

        // course specific settings
        $this->cfg_course_duedatemode = DP_DUEDATES_NONE;
        $this->cfg_course_prioritymode = DP_PRIORITY_NONE;

        // competency specific settings
        $this->cfg_competency_autoassignpos = 0;
        $this->cfg_competency_autoassignorg = 0;
        $this->cfg_competency_duedatemode = DP_DUEDATES_NONE;
        $this->cfg_competency_prioritymode = DP_DUEDATES_NONE;


        // TODO add all workflow settings here
        // including component-specific settings

        // plan permission settings
        $this->perm_plan_view_learner = DP_PERMISSION_ALLOW;
        $this->perm_plan_view_manager = DP_PERMISSION_ALLOW;
        $this->perm_plan_create_learner = DP_PERMISSION_DENY;
        $this->perm_plan_create_manager = DP_PERMISSION_ALLOW;
        $this->perm_plan_update_learner = DP_PERMISSION_DENY;
        $this->perm_plan_update_manager = DP_PERMISSION_ALLOW;
        $this->perm_plan_delete_learner = DP_PERMISSION_DENY;
        $this->perm_plan_delete_manager = DP_PERMISSION_ALLOW;
        $this->perm_plan_confirm_learner = DP_PERMISSION_REQUEST;
        $this->perm_plan_confirm_manager = DP_PERMISSION_DENY;
        $this->perm_plan_signoff_learner = DP_PERMISSION_REQUEST;
        $this->perm_plan_signoff_manager = DP_PERMISSION_ALLOW;

        // course permission settings
        $this->perm_course_addcourse_learner = DP_PERMISSION_DENY;
        $this->perm_course_addcourse_manager = DP_PERMISSION_ALLOW;
        $this->perm_course_removecourse_learner = DP_PERMISSION_ALLOW;
        $this->perm_course_removecourse_manager = DP_PERMISSION_ALLOW;
        $this->perm_course_commenton_learner = DP_PERMISSION_ALLOW;
        $this->perm_course_commenton_manager = DP_PERMISSION_ALLOW;
        $this->perm_course_setpriority_learner = DP_PERMISSION_ALLOW;
        $this->perm_course_setpriority_manager = DP_PERMISSION_ALLOW;
        $this->perm_course_setduedate_learner = DP_PERMISSION_ALLOW;
        $this->perm_course_setduedate_manager = DP_PERMISSION_ALLOW;
        $this->perm_course_setcompletionstatus_learner = DP_PERMISSION_REQUEST;
        $this->perm_course_setcompletionstatus_manager = DP_PERMISSION_REQUEST;

        //competency permission settings
        $this->perm_competency_addcompetency_learner = DP_PERMISSION_ALLOW;
        $this->perm_competency_addcompetency_manager = DP_PERMISSION_ALLOW;
        $this->perm_competency_removecompetency_learner = DP_PERMISSION_ALLOW;;
        $this->perm_competency_removecompetency_manager = DP_PERMISSION_ALLOW;;
        $this->perm_competency_commenton_learner = DP_PERMISSION_ALLOW;
        $this->perm_competency_commenton_manager = DP_PERMISSION_ALLOW;
        $this->perm_competency_setpriority_learner = DP_PERMISSION_ALLOW;
        $this->perm_competency_setpriority_manager = DP_PERMISSION_ALLOW;
        $this->perm_competency_setduedate_learner = DP_PERMISSION_ALLOW;
        $this->perm_competency_setduedate_manager = DP_PERMISSION_ALLOW;
        $this->perm_competency_setproficiency_learner = DP_PERMISSION_REQUEST;
        $this->perm_competency_setproficiency_manager = DP_PERMISSION_REQUEST;

        parent::__construct();
    }
}
