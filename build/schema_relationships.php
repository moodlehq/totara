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

$relations = array(
    // key => table#column, value => table#foreignkey
    // face to face module
    'facetoface#course' => 'course#id',
    'facetoface_sessions#facetoface' => 'facetoface#id',
    'facetoface_sessions_dates#sessionid' => 'facetoface_sessions#id',
    'facetoface_signups#sessionid' => 'facetoface_sessions#id',
    'facetoface_signups#userid' => 'user#id',
    'facetoface_signups_status#signupid' => 'facetoface_signups#id',
    'facetoface_session_data#sessionid' => 'facetoface_sessions#id',
    'facetoface_session_data#fieldid' => 'facetoface_session_field#id',
    // report builder
    'report_builder_columns#reportid' => 'report_builder#id',
    'report_builder_filters#reportid' => 'report_builder#id',
    'report_builder_saved#reportid' => 'report_builder#id',
    'report_builder_saved#userid' => 'user#id',
    'report_builder_settings#reportid' => 'report_builder#id',
    // competencies
    'comp#parentid' => 'comp#id',
    'comp#depthid' => 'comp_depth#id',
    'comp#frameworkid' => 'comp_framework#id',
    'comp#scaleid' => 'comp_scale#id',
    'comp_depth#frameworkid' => 'comp_framework#id',
    'comp_depth_info_category#depthid' => 'comp_depth#id',
    'comp_depth_info_field#depthid' => 'comp_depth#id',
    'comp_depth_info_field#categoryid' => 'comp_depth_info_category#id',
    'comp_depth_info_data#fieldid' => 'comp_depth_info_field#id',
    'comp_depth_info_data#competencyid' => 'comp#id',
    'comp_relations#id1' => 'comp#id',
    'comp_relations#id2' => 'comp#id',
    'comp_scale#proficient' => 'comp_scale_values#id',
    'comp_scale#defaultid' => 'comp_scale_values#id',
    'comp_scale_values#scaleid' => 'comp_scale#id',
    'comp_scale_assignments#frameworkid' => 'comp_framework#id',
    'comp_scale_assignments#scaleid' => 'comp_scale#id',
    'comp_template#frameworkid' => 'comp_framework#id',
    'comp_template_assignment#templateid' => 'comp_template#id',
    'comp_template_assignment#instanceid' => 'comp#id',
    'comp_evidence#userid' => 'user#id',
    'comp_evidence#competencyid' => 'comp#id',
    'comp_evidence#positionid' => 'pos#id',
    'comp_evidence#organisationid' => 'org#id',
    'comp_evidence#assessorid' => 'user#id',
    'comp_evidence#proficiency' => 'comp_scale_values#id',
    'comp_evidence_items#competencyid' => 'comp#id',
    'comp_evidence_items_evidence#userid' => 'user#id',
    'comp_evidence_items_evidence#competencyid' => 'comp#id',
    'comp_evidence_items_evidence#itemid' => 'comp_evidence_items#id',
    // positions
    'pos#parentid' => 'pos#id',
    'pos#depthid' => 'pos_depth#id',
    'pos#frameworkid' => 'pos_framework#id',
    'pos_depth#frameworkid' => 'pos_framework#id',
    'pos_depth_info_category#depthid' => 'pos_depth#id',
    'pos_depth_info_field#depthid' => 'pos_depth#id',
    'pos_depth_info_field#categoryid' => 'pos_depth_info_category#id',
    'pos_depth_info_data#fieldid' => 'pos_depth_info_field#id',
    'pos_depth_info_data#positionid' => 'pos#id',
    'pos_relations#id1' => 'pos#id',
    'pos_relations#id2' => 'pos#id',
    // organisations
    'org#parentid' => 'org#id',
    'org#depthid' => 'org_depth#id',
    'org#frameworkid' => 'org_framework#id',
    'org_depth#frameworkid' => 'org_framework#id',
    'org_depth_info_category#depthid' => 'org_depth#id',
    'org_depth_info_field#depthid' => 'org_depth#id',
    'org_depth_info_field#categoryid' => 'org_depth_info_category#id',
    'org_depth_info_data#fieldid' => 'org_depth_info_field#id',
    'org_depth_info_data#organisationid' => 'org#id',
    'org_relations#id1' => 'org#id',
    'org_relations#id2' => 'org#id',
    'pos_assignment#organisationid' => 'org#id',
    'pos_assignment#userid' => 'user#id',
    'pos_assignment#positionid' => 'pos#id',
    'pos_assignment#reportstoid' => 'role_assignments#id',
    // course completion
    'course_completions#userid' => 'user#id',
    'course_completions#course' => 'course#id',
    'course_completions#organisationid' => 'org#id',
    'course_completions#positionid' => 'pos#id',
    'course_completion_criteria#course' => 'course#id',
    'course_completion_crit_compl#course' => 'course#id',
    'course_completion_crit_compl#userid' => 'user#id',
    'course_completion_crit_compl#criteriaid' => 'course_completion_criteria#id',
    'course_completion_notify#course' => 'course#id',
    'course_completion_aggr_methd#course' => 'course#id',
    // idp
    'idp#userid' => 'user#id',
    'idp_revision#idp' => 'idp#id',
    'idp_revision_course#course' => 'course#id',
    'idp_revision_course#revision' => 'idp_revision#id',
    'idp_revision_competency#competency' => 'comp#id',
    'idp_revision_competency#revision' => 'idp_revision#id',
    'idp_revision_competencytmpl#competencytemplate' => 'comp_template#id',
    'idp_revision_competencytmpl#revision' => 'idp_revision#id',
    'idp_revision_comment#revision' => 'idp_revision#id',
    'idp_list_item#revision' => 'idp_revision#id',
    'idp_competency_eval#revisionid' => 'idp_revision#id',
    'idp_competency_eval#competencyid' => 'comp#id',
    'idp_competency_eval#scalevalueid' => 'comp_scale_values#id',
    'idp_approval#revision' => 'idp_revision#id',
    'idp_approval#approvedby' => 'user#id',
    'idp_approval#onbehalfof' => 'user#id',
);

$prefix = 'mdl_';

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


