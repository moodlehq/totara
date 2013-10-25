<?php
/*
 * Script to generate table relationship information
 * For use by Schema Spy
 *
 * Necessary because Moodle doesn't record foreign key in schema
 *
 * $relations array contains key value pairs, where the key
 * represents a column, and the value represents the foreign
 * key of that column.
 *
 * Columns are represented in the form [tablename]#[columnname]
 * where [tablename] is the moodle table (without the prefix) and
 * [columnname] is the name of the column.
 *
 * Output is XML file suitable for use by the -meta flag in
 * Schema Spy
 *
 */

// Set default prefix.
// Some scripts may include this one and preset the prefix so
// only change if it isn't yet set.
if (!isset($prefix)) {
   $prefix = 'mdl_';
}

$relations = array(
    // Key => table#column, value => table#foreignkey.
    // Face to face module.
    'facetoface#course' => 'course#id',
    'facetoface_sessions#facetoface' => 'facetoface#id',
    'facetoface_sessions#roomid' => 'facetoface_room#id',
    'facetoface_sessions#usermodified' => 'user#id',
    'facetoface_sessions_dates#sessionid' => 'facetoface_sessions#id',
    'facetoface_signups#sessionid' => 'facetoface_sessions#id',
    'facetoface_signups#userid' => 'user#id',
    'facetoface_signups_status#signupid' => 'facetoface_signups#id',
    'facetoface_signups_status#createdby' => 'user#id',
    'facetoface_session_data#sessionid' => 'facetoface_sessions#id',
    'facetoface_session_data#fieldid' => 'facetoface_session_field#id',
    'facetoface_session_roles#sessionid' => 'facetoface_sessions#id',
    'facetoface_session_roles#userid' => 'user#id',
    'facetoface_session_roles#roleid' => 'role#id',
    'facetoface_notice_data#fieldid' => 'facetoface_session_field#id',
    'facetoface_notice_data#noticeid' => 'facetoface_notice#id',
    'facetoface_notification#usermodified' => 'user#id',
    'facetoface_notification#courseid' => 'course#id',
    'facetoface_notification#facetofaceid' => 'facetoface#id',
    'facetoface_notification_sent#notificationid' => 'facetoface_notification#id',
    'facetoface_notification_sent#sessionid' => 'facetoface_sessions#id',
    'facetoface_notification_hist#notificationid' => 'facetoface_notification#id',
    'facetoface_notification_hist#sessionid' => 'facetoface_sessions#id',
    'facetoface_notification_hist#sessiondateid' => 'facetoface_sessions_dates#id',
    'facetoface_notification_hist#userid' => 'user#id',
    // Report builder.
    'report_builder_columns#reportid' => 'report_builder#id',
    'report_builder_filters#reportid' => 'report_builder#id',
    'report_builder_saved#reportid' => 'report_builder#id',
    'report_builder_saved#userid' => 'user#id',
    'report_builder_settings#reportid' => 'report_builder#id',
    'report_builder_group_assign#groupid' => 'report_builder_group#id',
    'report_builder_preproc_track#groupid' => 'report_builder_group#id',
    'report_builder_schedule#reportid' => 'report_builder#id',
    'report_builder_schedule#userid' => 'user#id',
    'report_builder_schedule#savedsearchid' => 'report_builder_saved#id',
    'report_builder_cache#reportid' => 'report_builder#id',
    // Competencies.
    'comp#parentid' => 'comp#id',
    'comp#typeid' => 'comp_type#id',
    'comp#frameworkid' => 'comp_framework#id',
    'comp_type_info_field#typeid' => 'comp_type#id',
    'comp_type_info_data#fieldid' => 'comp_type_info_field#id',
    'comp_type_info_data#competencyid' => 'comp#id',
    'comp_relations#id1' => 'comp#id',
    'comp_relations#id2' => 'comp#id',
    'comp_scale#defaultid' => 'comp_scale_values#id',
    'comp_scale_values#scaleid' => 'comp_scale#id',
    'comp_scale_assignments#frameworkid' => 'comp_framework#id',
    'comp_scale_assignments#scaleid' => 'comp_scale#id',
    'comp_template#frameworkid' => 'comp_framework#id',
    'comp_template_assignment#templateid' => 'comp_template#id',
    'comp_template_assignment#instanceid' => 'comp#id',
    'comp_template_assignment#usermodified' => 'user#id',
    'comp_record#userid' => 'user#id',
    'comp_record#competencyid' => 'comp#id',
    'comp_record#positionid' => 'pos#id',
    'comp_record#organisationid' => 'org#id',
    'comp_record#assessorid' => 'user#id',
    'comp_record#proficiency' => 'comp_scale_values#id',
    'comp_record_history#userid' => 'user#id',
    'comp_record_history#competencyid' => 'comp#id',
    'comp_record_history#proficiency' => 'comp_scale_values#id',
    'comp_criteria#competencyid' => 'comp#id',
    'comp_criteria_record#userid' => 'user#id',
    'comp_criteria_record#competencyid' => 'comp#id',
    'comp_criteria_record#itemid' => 'comp_criteria#id',
    // Positions.
    'pos#parentid' => 'pos#id',
    'pos#typeid' => 'pos_type#id',
    'pos#frameworkid' => 'pos_framework#id',
    'pos_type_info_field#typeid' => 'pos_type#id',
    'pos_type_info_data#fieldid' => 'pos_type_info_field#id',
    'pos_type_info_data#positionid' => 'pos#id',
    'pos_relations#id1' => 'pos#id',
    'pos_relations#id2' => 'pos#id',
    // Organisations.
    'org#parentid' => 'org#id',
    'org#typeid' => 'org_type#id',
    'org#frameworkid' => 'org_framework#id',
    'org_competencies#organisationid' => 'org#id',
    'org_competencies#competencyid' => 'comp#id',
    'org_type_info_field#typeid' => 'org_type#id',
    'org_type_info_data#fieldid' => 'org_type_info_field#id',
    'org_type_info_data#organisationid' => 'org#id',
    'org_relations#id1' => 'org#id',
    'org_relations#id2' => 'org#id',
    'pos_assignment#organisationid' => 'org#id',
    'pos_assignment#userid' => 'user#id',
    'pos_assignment#appraiserid' => 'user#id',
    'pos_assignment#positionid' => 'pos#id',
    'pos_assignment#reportstoid' => 'role_assignments#id',
    'pos_assignment#managerid' => 'user#id',
    'pos_assignment_history#organisationid' => 'org#id',
    'pos_assignment_history#userid' => 'user#id',
    'pos_assignment_history#positionid' => 'pos#id',
    'pos_assignment_history#reportstoid' => 'role_assignments#id',
    'pos_competencies#positionid' => 'pos#id',
    'pos_competencies#competencyid' => 'comp#id',
    // Course completion.
    'course_completions#userid' => 'user#id',
    'course_completions#course' => 'course#id',
    'course_completions#organisationid' => 'org#id',
    'course_completions#positionid' => 'pos#id',
    'course_completion_criteria#course' => 'course#id',
    'course_completion_crit_compl#course' => 'course#id',
    'course_completion_crit_compl#userid' => 'user#id',
    'course_completion_crit_compl#criteriaid' => 'course_completion_criteria#id',
    'course_completion_aggr_methd#course' => 'course#id',
    // Idp.
    'dp_plan#templateid' => 'dp_template#id',
    'dp_plan#userid' => 'user#id',
    'dp_permissions#templateid' => 'dp_template#id',
    'dp_component_settings#templateid' => 'dp_template#id',
    'dp_course_settings#templateid' => 'dp_template#id',
    'dp_course_settings#priorityscale' => 'dp_priority_scale#id',
    'dp_plan_course_assign#planid' => 'dp_plan#id',
    'dp_plan_course_assign#courseid' => 'course#id',
    'dp_plan_course_assign#priority' => 'dp_priority_scale_value#id',
    'dp_plan_course_assign#completionstatus' => 'course_completions#status',
    'dp_plan_competency_assign#planid' => 'dp_plan#id',
    'dp_plan_competency_assign#competencyid' => 'comp#id',
    'dp_plan_competency_assign#priority' => 'dp_priority_scale_value#id',
    'dp_plan_competency_assign#scalevalueid' => 'comp_scale_values#id',
    'dp_competency_settings#templateid' => 'dp_template#id',
    'dp_competency_settings#priorityscale' => 'dp_priority_scale#id',
    'dp_priority_scale#defaultid' => 'dp_priority_scale_value#id',
    'dp_priority_scale#usermodified' => 'user#id',
    'dp_priority_scale_value#priorityscaleid' => 'dp_priority_scale#id',
    'dp_priority_scale_value#usermodified' => 'user#id',
    'dp_objective_scale#defaultid' => 'dp_objective_scale_value#id',
    'dp_objective_scale#usermodified' => 'user#id',
    'dp_objective_scale_value#objscaleid' => 'dp_objective_scale#id',
    'dp_objective_scale_value#usermodified' => 'user#id',
    'dp_plan_history#planid' => 'dp_plan#id',
    'dp_plan_history#usermodified' => 'user#id',
    'dp_plan_evidence#evidencetypeid' => 'dp_evidence_type#id',
    'dp_plan_evidence#usermodified' => 'user#id',
    'dp_plan_evidence#userid' => 'user#id',
    'dp_objective_settings#templateid' => 'dp_template#id',
    'dp_objective_settings#priorityscale' => 'dp_priority_scale#id',
    'dp_objective_settings#objectivescale' => 'dp_objective_scale#id',
    'dp_plan_objective#planid' => 'dp_plan#id',
    'dp_plan_objective#priority' => 'dp_priority_scale_value#id',
    'dp_plan_objective#scalevalueid' => 'dp_objective_scale_value#id',
    'dp_plan_program_assign#planid' => 'dp_plan#id',
    'dp_plan_program_assign#programid' => 'prog#id',
    'dp_plan_program_assign#priority' => 'dp_priority_scale_value#id',
    'dp_evidence_type#usermodified' => 'user#id',
    'dp_plan_evidence_relation#evidenceid' => 'dp_plan_evidence#id',
    'dp_plan_evidence_relation#planid' => 'dp_plan#id',
    'dp_plan_history#planid' => 'dp_plan#id',
    'dp_plan_history#usermodified' => 'user#id',
    'dp_plan_settings#templateid' => 'dp_template#id',
    'dp_program_settings#templateid' => 'dp_template#id',
    // Appraisals.
    'appraisal_stage#appraisalid' => 'appraisal#id',
    'appraisal_stage_page#appraisalstageid' => 'appraisal_stage#id',
    'appraisal_scale#userid' => 'user#id',
    'appraisal_scale_value#appraisalscaleid' => 'appraisal_scale#id',
    'appraisal_stage_role_setting#appraisalstageid' => 'appraisal_stage#id',
    'appraisal_quest_field#appraisalstagepageid' => 'appraisal_stage_page#id',
    'appraisal_quest_field#appraisalscaleid' => 'appraisal_scale#id',
    'appraisal_quest_field_role#appraisalquestfieldid' => 'appraisal_quest_field#id',
    'appraisal_grp_org#appraisalid' => 'appraisal#id',
    'appraisal_grp_org#orgid' => 'org#id',
    'appraisal_grp_pos#appraisalid' => 'appraisal#id',
    'appraisal_grp_pos#posid' => 'pos#id',
    'appraisal_grp_cohort#appraisalid' => 'appraisal#id',
    'appraisal_grp_cohort#cohortid' => 'cohort#id',
    'appraisal_review_data#appraisalquestfieldid' => 'appraisal_quest_field#id',
    'appraisal_review_data#appraisalroleassignmentid' => 'appraisal_role_assignment#id',
    'appraisal_history#userid' => 'user#id',
    'appraisal_history#appraisalid' => 'appraisal#id',
    'appraisal_user_assignment#userid' => 'user#id',
    'appraisal_user_assignment#appraisalid' => 'appraisal#id',
    'appraisal_user_assignment#activestageid' => 'appraisal_stage#id',
    'appraisal_role_assignment#appraisaluserassignmentid' => 'appraisal_user_assignment#id',
    'appraisal_role_assignment#userid' => 'user#id',
    'appraisal_stage_data#appraisalroleassignmentid' => 'appraisal_role_assignment#id',
    'appraisal_stage_data#appraisalstageid' => 'appraisal_stage#id',
    'appraisal_scale_data#appraisalscalevalueid' => 'appraisal_scale_value#id',
    'appraisal_scale_data#appraisalroleassignmentid' => 'appraisal_role_assignment#id',
    'appraisal_scale_data#appraisalquestfieldid' => 'appraisal_quest_field#id',
    'appraisal_event#appraisalid' => 'appraisal#id',
    'appraisal_event#appraisalstageid' => 'appraisal_stage#id',
    'appraisal_event_message#appraisaleventid' => 'appraisal_event#id',
    'appraisal_event_rcpt#appraisaleventmessageid' => 'appraisal_event_message#id',
    // Feedback360.
    'feedback360_quest_field#feedback360id' => 'feedback360#id',
    'feedback360_grp_org#feedback360id' => 'feedback360#id',
    'feedback360_grp_org#orgid' => 'org#id',
    'feedback360_grp_pos#feedback360id' => 'feedback360#id',
    'feedback360_grp_pos#posid' => 'pos#id',
    'feedback360_grp_cohort#feedback360id' => 'feedback360#id',
    'feedback360_grp_cohort#cohortid' => 'cohort#id',
    'feedback360_user_assignment#userid' => 'user#id',
    'feedback360_user_assignment#feedback360id' => 'feedback360#id',
    'feedback360_resp_assignment#userid' => 'user#id',
    'feedback360_resp_assignment#feedback360userassignmentid' => 'feedback360_user_assignment#id',
    'feedback360_resp_assignment#feedback360emailassignmentid' => 'feedback360_email_assignment#id',
    'feedback360_scale#userid' => 'user#id',
    'feedback360_scale#feedback360questfieldid' => 'feedback360_quest_field#id',
    'feedback360_scale_value#feedback360scaleid' => 'feedback360_scale#id',
    'feedback360_scale_data#feedback360scalevalueid' => 'feedback360_scale_value#id',
    'feedback360_scale_data#feedback360respassignmentid' => 'feedback360_resp_assignment#id',
    'feedback360_scale_data#feedback360questfieldid' => 'feedback360_quest_field#id',
    // Goals.
    'goal#parentid' => 'goal#id',
    'goal#frameworkid' => 'goal_framework#id',
    'goal#typeid' => 'goal_type#id',
    'goal_scale_assignments#scaleid' => 'goal_scale#id',
    'goal_scale_assignments#frameworkid' => 'goal_framework#id',
    'goal_scale_values#scaleid' => 'goal_scale#id',
    'goal_record#userid' => 'user#id',
    'goal_record#goalid' => 'goal#id',
    'goal_record#scalevalueid' => 'goal_scale_values#id',
    'goal_scale#defaultid' => 'goal_scale_values#id',
    'goal_type_info_data#goalid' => 'goal#id',
    'goal_type_info_data#fieldid' => 'goal_type_info_field#id',
    'goal_type_info_field#typeid' => 'goal_type#id',
    'goal_user_assignment#goalid' => 'goal#id',
    'goal_user_assignment#userid' => 'user#id',
    'goal_grp_pos#posid' => 'pos#id',
    'goal_grp_pos#goalid' => 'goal#id',
    'goal_grp_org#orgid' => 'org#id',
    'goal_grp_org#goalid' => 'goal#id',
    'goal_grp_cohort#cohortid' => 'cohort#id',
    'goal_grp_cohort#goalid' => 'goal#id',
    'goal_personal#userid' => 'user#id',
    'goal_personal#scaleid' => 'goal_scale#id',
    'goal_personal#scalevalueid' => 'goal_scale_values#id',
    'goal_item_history#scalevalueid' => 'goal_scale_values#id',
    // Certifications.
    'certif_completion#certifid' => 'certif#id',
    'certif_completion#userid' => 'user#id',
    'certif_completion_history#certifid' => 'certif#id',
    'certif_completion_history#userid' => 'user#id',
    'course_completion_history#courseid' => 'course#id',
    'course_completion_history#userid' => 'user#id',
    // Badges.
    'badge#courseid' => 'course#id',
    'badge#usermodified' => 'user#id',
    'badge#usercreated' => 'user#id',
    'badge_criteria#badgeid' => 'badge#id',
    'badge_criteria_param#critid' => 'badge_criteria#id',
    'badge_issued#badgeid' => 'badge#id',
    'badge_issued#userid' => 'user#id',
    'badge_criteria_met#critid' => 'badge_criteria#id',
    'badge_criteria_met#userid' => 'user#id',
    'badge_criteria_met#issuedid' => 'badge_issued#id',
    'badge_manual_award#badgeid' => 'badge#id',
    'badge_manual_award#recipientid' => 'user#id',
    'badge_manual_award#issuerid' => 'user#id',
    'badge_manual_award#issuerrole' => 'role#id',
    'badge_backpack#userid' => 'user#id',
    'badge_external#backpackid' => 'badge_backpack#id',
    // Temporary managers.
    'temporary_manager#userid' => 'user#id',
    'temporary_manager#tempmanagerid' => 'user#id',
    'temporary_manager#usermodified' => 'user#id',
    // Cohort.
    'cohort_rule_collections#cohortid' => 'cohort#id',
    'cohort_rule_collections#modifierid' => 'user#id',
    'cohort_rulesets#rulecollectionid' => 'cohort_rule_collections#id',
    'cohort_rulesets#modifierid' => 'user#id',
    'cohort_rules#rulesetid' => 'cohort_rulesets#id',
    'cohort_rules#modifierid' => 'user#id',
    'cohort_rule_params#ruleid' => 'cohort_rules#id',
    'cohort_rule_params#modifierid' => 'user#id',
    'cohort_msg_queue#cohortid' => 'cohort#id',
    'cohort_msg_queue#userid' => 'user#id',
    'cohort_msg_queue#modifierid' => 'user#id',
    'cohort_plan_history#cohortid' => 'cohort#id',
    'cohort_plan_history#templateid' => 'dp_template#id',
    'cohort_plan_history#usercreated' =>  'user#id',
    'cohort_visibility#cohortid' => 'cohort#id',
    'cohort_visibility#usermodified' => 'user#id',
);

print <<<EOF
<schemaMeta>
<comments>
    Foreign Key information for moodle tables
</comments>
<tables>

EOF;
foreach($relations as $source => $target) {
    list($sourcetable, $sourcecolumn) = explode('#', $source);
    list($targettable, $targetcolumn) = explode('#', $target);
    print <<<EOF
    <table name="$prefix$sourcetable">
        <column name="$sourcecolumn">
            <foreignKey table="$prefix$targettable" column="$targetcolumn"/>
        </column>
    </table>

EOF;
}
print <<<EOF
</tables>
</schemaMeta>
EOF;


