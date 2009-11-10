<?php

// if this function exists hierarchybackup.php will try to backup competencies
function competency_backup($bf, $frameworks, $options) {
    fwrite($bf,start_tag('HIERARCHY',2,true));
    fwrite($bf,full_tag('NAME', 3, false, 'competency'));
    if(is_array($frameworks)) {
        if(!defined('BACKUP_SILENTLY')) {
            print '<li>Backing up frameworks</li>';
        }
        fwrite($bf,start_tag('FRAMEWORKS',3, true));
        foreach($frameworks AS $fwid => $unused) {
            competency_backup_framework($bf, $fwid, $options);
        }
        fwrite($bf,end_tag('FRAMEWORKS', 3, true));
    }
    if(isset($options->inc_scales) && $options->inc_scales) {
        if(!defined('BACKUP_SILENTLY')) {
            print '<li>Backing up scales</li>';
        }
        competency_backup_scales($bf, $options);
    }
    fwrite($bf,end_tag('HIERARCHY',2, true));
    return true;
}

function competency_backup_framework($bf, $fwid, $options) {
    if(is_numeric($fwid)) {
        $framework = get_record('competency_framework','id',$fwid);
    }

    $status = true;

    fwrite($bf, start_tag('FRAMEWORK', 4, true));
    fwrite($bf, full_tag('ID', 5, false, $framework->id));
    fwrite($bf, full_tag('FULLNAME', 5, false, $framework->fullname));
    fwrite($bf, full_tag('SHORTNAME', 5, false, $framework->shortname));
    fwrite($bf, full_tag('IDNUMBER', 5, false, $framework->idnumber));
    fwrite($bf, full_tag('DESCRIPTION', 5, false, $framework->description));
    fwrite($bf, full_tag('ISDEFAULT', 5, false, $framework->isdefault));
    fwrite($bf, full_tag('SORTORDER', 5, false, $framework->sortorder));
    fwrite($bf, full_tag('TIMECREATED', 5, false, $framework->timecreated));
    fwrite($bf, full_tag('TIMEMODIFIED', 5, false, $framework->timemodified));
    fwrite($bf, full_tag('USERMODIFIED', 5, false, $framework->usermodified));
    fwrite($bf, full_tag('VISIBLE', 5, false, $framework->visible));
    fwrite($bf, full_tag('HIDECUSTOMFIELDS', 5, false, $framework->hidecustomfields));
    fwrite($bf, full_tag('SHOWITEMFULLNAME', 5, false, $framework->showitemfullname));
    fwrite($bf, full_tag('SHOWDEPTHFULLNAME', 5, false, $framework->showdepthfullname));

    if(isset($options->inc_scales) && $options->inc_scales) {
        //competency_backup_scale_assignments($bf, $framework->id, $options);
    }

    competency_backup_competency($bf, $framework->id, $options);
    if(isset($options->inc_custom) && $options->inc_custom) {
        competency_backup_depth($bf, $framework->id, $options);
    }

    fwrite($bf, end_tag('FRAMEWORK', 4, true));
}

function competency_backup_depth($bf, $fwid, $options) {
    if(is_numeric($fwid)) {
        $depths = get_records('competency_depth', 'frameworkid', $fwid);
    }
    if($depths) {
        fwrite($bf, start_tag('DEPTHS', 5, true));
        foreach($depths AS $depth) {
            fwrite($bf, start_tag('DEPTH', 6, true));
            fwrite($bf, full_tag('ID', 7, false, $depth->id));
            fwrite($bf, full_tag('FULLNAME', 7, false, $depth->fullname));
            fwrite($bf, full_tag('SHORTNAME', 7, false, $depth->shortname));
            fwrite($bf, full_tag('DESCRIPTION', 7, false, $depth->description));
            fwrite($bf, full_tag('DEPTHLEVEL', 7, false, $depth->depthlevel));
            fwrite($bf, full_tag('FRAMEWORKID', 7, false, $depth->frameworkid));
            fwrite($bf, full_tag('TIMECREATED', 7, false, $depth->timecreated));
            fwrite($bf, full_tag('TIMEMODIFIED', 7, false, $depth->timemodified));
            fwrite($bf, full_tag('USERMODIFIED', 7, false, $depth->usermodified));
            competency_backup_custom_category($bf, $depth->id, $options);
            fwrite($bf, end_tag('DEPTH', 6, true));
        }
        fwrite($bf, end_tag('DEPTHS', 5, true));
    }
}

function competency_backup_custom_category($bf, $depthid, $options) {
    if(is_numeric($depthid)) {
        $categories = get_records('competency_depth_info_category','depthid', $depthid);
    }
    if($categories) {
        fwrite($bf, start_tag('DEPTH_CATEGORIES', 7, true));
        foreach($categories AS $category) {
            fwrite($bf, start_tag('DEPTH_CATEGORY', 8, true));
            fwrite($bf, full_tag('ID', 9, false, $category->id));
            fwrite($bf, full_tag('NAME', 9, false, $category->name));
            fwrite($bf, full_tag('SORTORDER', 9, false, $category->sortorder));
            fwrite($bf, full_tag('DEPTHID', 9, false, $category->depthid));

            competency_backup_custom_field($bf, $category->id, $options);

            fwrite($bf, end_tag('DEPTH_CATEGORY', 8, true));
        }
        fwrite($bf, end_tag('DEPTH_CATEGORIES', 7, true));
    }
}

function competency_backup_custom_field($bf, $categoryid, $options) {
    if(is_numeric($categoryid)) {
        $fields = get_records('competency_depth_info_field','categoryid', $categoryid);
    }
    if($fields) {
        fwrite($bf, start_tag('CUSTOM_FIELDS', 9, true));
        foreach($fields AS $field) {
            fwrite($bf, start_tag('CUSTOM_FIELD', 10, true));
            fwrite($bf, full_tag('ID', 11, false, $field->id));
            fwrite($bf, full_tag('FULLNAME', 11, false, $field->fullname));
            fwrite($bf, full_tag('SHORTNAME', 11, false, $field->shortname));
            fwrite($bf, full_tag('DEPTHID', 11, false, $field->depthid));
            fwrite($bf, full_tag('DATATYPE', 11, false, $field->datatype));
            fwrite($bf, full_tag('DESCRIPTION', 11, false, $field->description));
            fwrite($bf, full_tag('SORTORDER', 11, false, $field->sortorder));
            fwrite($bf, full_tag('CATEGORYID', 11, false, $field->categoryid));
            fwrite($bf, full_tag('HIDDEN', 11, false, $field->hidden));
            fwrite($bf, full_tag('LOCKED', 11, false, $field->locked));
            fwrite($bf, full_tag('REQUIRED', 11, false, $field->required));
            fwrite($bf, full_tag('DEFAULTDATA', 11, false, $field->defaultdata));
            fwrite($bf, full_tag('PARAM1', 11, false, $field->param1));
            fwrite($bf, full_tag('PARAM2', 11, false, $field->param2));
            fwrite($bf, full_tag('PARAM3', 11, false, $field->param3));
            fwrite($bf, full_tag('PARAM4', 11, false, $field->param4));
            fwrite($bf, full_tag('PARAM5', 11, false, $field->param5));
            fwrite($bf, end_tag('CUSTOM_FIELD', 10, true));
        }
        fwrite($bf, end_tag('CUSTOM_FIELDS', 9, true));
    }
}

function competency_backup_competency($bf, $fwid, $options) {
    if(is_numeric($fwid)) {
        $competencies = get_records('competency', 'frameworkid', $fwid);
    }
    if($competencies) {
        fwrite($bf, start_tag('COMPETENCIES', 5, true));
        foreach($competencies AS $competency) {
            fwrite($bf, start_tag('COMPETENCY', 6, true));
            fwrite($bf, full_tag('ID', 7, false, $competency->id));
            fwrite($bf, full_tag('FULLNAME', 7, false, $competency->fullname));
            fwrite($bf, full_tag('SHORTNAME', 7, false, $competency->shortname));
            fwrite($bf, full_tag('IDNUMBER', 7, false, $competency->idnumber));
            fwrite($bf, full_tag('FRAMEWORKID', 7, false, $competency->frameworkid));
            fwrite($bf, full_tag('PARENTID', 7, false, $competency->parentid));
            fwrite($bf, full_tag('SORTORDER', 7, false, $competency->sortorder));
            fwrite($bf, full_tag('DEPTHID', 7, false, $competency->depthid));
            fwrite($bf, full_tag('PATH', 7, false, $competency->path));
            fwrite($bf, full_tag('DESCRIPTION', 7, false, $competency->description));
            fwrite($bf, full_tag('AGGREGATIONMETHOD', 7, false, $competency->aggregationmethod));
            fwrite($bf, full_tag('SCALEID', 7, false, $competency->scaleid));
            fwrite($bf, full_tag('PROFICIENCYEXPECTED', 7, false, $competency->proficiencyexpected));
            fwrite($bf, full_tag('EVIDENCECOUNT', 7, false, $competency->evidencecount));
            fwrite($bf, full_tag('TIMECREATED', 7, false, $competency->timecreated));
            fwrite($bf, full_tag('TIMEMODIFIED', 7, false, $competency->timemodified));
            fwrite($bf, full_tag('USERMODIFIED', 7, false, $competency->usermodified));
            fwrite($bf, full_tag('VISIBLE', 7, false, $competency->visible));

            if(isset($options->inc_custom) && $options->inc_custom) {
                competency_backup_custom_data($bf, $competency->id, $options);
            }
            //TODO backup relations and evidence items
            if(isset($options->inc_relations) && $options->inc_relations) {
                // TODO check that relations refer to competencies in the current backup.
                //      if not, exclude from backup and print warning to user
                //competency_backup_relations($bf, $competency->id, $options);
            }
            if(isset($options->inc_evidence) && $options->inc_evidence) {
                //competency_backup_evidence_items($bf, $competency->id, $options);
                if(isset($options->inc_users) && $options->inc_users) {
                    //competency_backup_evidence($bf, $competency->id, $options);
                    //competency_backup_evidence_history($bf, $competency->id, $options);
                }
            }

            fwrite($bf, end_tag('COMPETENCY', 6, true));
        }
        fwrite($bf, end_tag('COMPETENCIES', 5, true));
    }
}

function competency_backup_custom_data($bf, $compid, $options) {
    if(is_numeric($compid)) {
        $values = get_records('competency_depth_info_data','competencyid',$compid);
    }
    if($values) {
        fwrite($bf, start_tag('CUSTOM_VALUES', 7, true));
        foreach($values AS $value) {
            fwrite($bf, start_tag('CUSTOM_VALUE', 8, true));
            fwrite($bf, full_tag('ID', 9, false, $value->id));
            fwrite($bf, full_tag('COMPETENCYID', 9, false, $value->competencyid));
            fwrite($bf, full_tag('FIELDID', 9, false, $value->fieldid));
            fwrite($bf, full_tag('DATA', 9, false, $value->data));
            fwrite($bf, end_tag('CUSTOM_VALUE', 8, true));
        }
        fwrite($bf, end_tag('CUSTOM_VALUES', 7, true));

    }
}

function competency_backup_scales($bf, $options) {
    fwrite($bf, start_tag('SCALES',3,true));
    //TODO scales info here
    //TODO decide which scales to include - only include scales which are 
    //     referred to by selected frameworks
    // competency_backup_scale_values($bf, $scale->id, $options);
    fwrite($bf, end_tag('SCALES', 3, true));
}


// if this function exists, it will be called to provide additional competency 
// specific options for the hierarchybackup form
function competency_set_extra_options($mform) {

    $mform->addElement('selectyesno','competency_inc_relations','Include competency relations');
    $mform->setDefault('competency_inc_relations',1);

    $mform->addElement('selectyesno','competency_inc_scales','Include competency scales');
    $mform->setDefault('competency_inc_scales',1);

    $mform->addElement('selectyesno','competency_inc_custom','Include custom fields');
    $mform->setDefault('competency_inc_custom',1);

    $mform->addElement('selectyesno','competency_inc_evidence','Include competency evidence');
    $mform->setDefault('competency_inc_evidence',1);

}


// if this function exists, it will be called to retrieve additional competency 
// specific options for the hierarchybackup form
// these options can then be used within the backup functions but do check if 
// they are set first 
function competency_get_extra_options() {
    $options = new object();
    $options->inc_relations = optional_param('competency_inc_relations', null, PARAM_BOOL);
    $options->inc_scales = optional_param('competency_inc_scales',null, PARAM_BOOL);
    $options->inc_custom = optional_param('competency_inc_custom',null, PARAM_BOOL);
    $options->inc_evidence = optional_param('competency_inc_evidence',null, PARAM_BOOL);
    return $options;
}


