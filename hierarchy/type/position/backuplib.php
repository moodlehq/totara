<?php

function position_backup($bf, $frameworks, $options) {
    // only create hierarchy tag if there are frameworks
    if(is_array($frameworks) && array_keys($frameworks, '1')) {
        fwrite($bf,start_tag('HIERARCHY',2,true));
        fwrite($bf,full_tag('NAME', 3, false, 'position'));
        // only backup frameworks if at least one is selected
        if(is_array($frameworks) && array_keys($frameworks, '1')) {
            print '<li>Backing up frameworks</li>';
            fwrite($bf,start_tag('FRAMEWORKS',3, true));
            foreach($frameworks AS $fwid => $include) {
                if($include) {
                    position_backup_framework($bf, $fwid, $options);
                }
            }
            fwrite($bf,end_tag('FRAMEWORKS', 3, true));
        }
        fwrite($bf,end_tag('HIERARCHY',2, true));
    }
    return true;
}

function position_backup_framework($bf, $fwid, $options) {
     if(is_numeric($fwid)) {
        $framework = get_record('pos_framework','id',$fwid);
    }

    $status = true;

    fwrite($bf, start_tag('FRAMEWORK', 4, true));
    fwrite($bf, full_tag('ID', 5, false, $framework->id));
    fwrite($bf, full_tag('FULLNAME', 5, false, $framework->fullname));
    fwrite($bf, full_tag('SHORTNAME', 5, false, $framework->shortname));
    fwrite($bf, full_tag('IDNUMBER', 5, false, $framework->idnumber));
    fwrite($bf, full_tag('DESCRIPTION', 5, false, $framework->description));
    fwrite($bf, full_tag('SORTORDER', 5, false, $framework->sortorder));
    fwrite($bf, full_tag('TIMECREATED', 5, false, $framework->timecreated));
    fwrite($bf, full_tag('TIMEMODIFIED', 5, false, $framework->timemodified));
    fwrite($bf, full_tag('USERMODIFIED', 5, false, $framework->usermodified));
    fwrite($bf, full_tag('VISIBLE', 5, false, $framework->visible));
    fwrite($bf, full_tag('HIDECUSTOMFIELDS', 5, false, $framework->hidecustomfields));
    fwrite($bf, full_tag('SHOWITEMFULLNAME', 5, false, $framework->showitemfullname));
    fwrite($bf, full_tag('SHOWDEPTHFULLNAME', 5, false, $framework->showdepthfullname));

    position_backup_depth($bf, $framework->id, $options);
    position_backup_position($bf, $framework->id, $options);

    fwrite($bf, end_tag('FRAMEWORK', 4, true));
}

function position_backup_depth($bf, $fwid, $options) {
    if(is_numeric($fwid)) {
        $depths = get_records('pos_depth', 'frameworkid', $fwid);
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
            if(isset($options->inc_custom) && $options->inc_custom) {
                position_backup_custom_category($bf, $depth->id, $options);
            }
            fwrite($bf, end_tag('DEPTH', 6, true));
        }
        fwrite($bf, end_tag('DEPTHS', 5, true));
    }
}

function position_backup_custom_category($bf, $depthid, $options) {
    if(is_numeric($depthid)) {
        $categories = get_records('pos_depth_info_category','depthid', $depthid);
    }
    if($categories) {
        fwrite($bf, start_tag('DEPTH_CATEGORIES', 7, true));
        foreach($categories AS $category) {
            fwrite($bf, start_tag('DEPTH_CATEGORY', 8, true));
            fwrite($bf, full_tag('ID', 9, false, $category->id));
            fwrite($bf, full_tag('NAME', 9, false, $category->name));
            fwrite($bf, full_tag('SORTORDER', 9, false, $category->sortorder));
            fwrite($bf, full_tag('DEPTHID', 9, false, $category->depthid));

            position_backup_custom_field($bf, $category->id, $options);

            fwrite($bf, end_tag('DEPTH_CATEGORY', 8, true));
        }
        fwrite($bf, end_tag('DEPTH_CATEGORIES', 7, true));
    }
}

function position_backup_custom_field($bf, $categoryid, $options) {
    if(is_numeric($categoryid)) {
        $fields = get_records('pos_depth_info_field','categoryid', $categoryid);
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
            fwrite($bf, full_tag('FORCEUNIQUE', 11, false, $field->forceunique));
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

function position_backup_position($bf, $fwid, $options) {
    if(is_numeric($fwid)) {
        $positions = get_records('pos', 'frameworkid', $fwid);
    }
    if($positions) {
        fwrite($bf, start_tag('POSITIONS', 5, true));
        foreach($positions AS $position) {
            fwrite($bf, start_tag('POSITION', 6, true));
            fwrite($bf, full_tag('ID', 7, false, $position->id));
            fwrite($bf, full_tag('FULLNAME', 7, false, $position->fullname));
            fwrite($bf, full_tag('SHORTNAME', 7, false, $position->shortname));
            fwrite($bf, full_tag('IDNUMBER', 7, false, $position->idnumber));
            fwrite($bf, full_tag('DESCRIPTION', 7, false, $position->description));
            fwrite($bf, full_tag('FRAMEWORKID', 7, false, $position->frameworkid));
            fwrite($bf, full_tag('PATH', 7, false, $position->path));
            fwrite($bf, full_tag('DEPTHID', 7, false, $position->depthid));
            fwrite($bf, full_tag('PARENTID', 7, false, $position->parentid));
            fwrite($bf, full_tag('SORTORDER', 7, false, $position->sortorder));
            fwrite($bf, full_tag('VISIBLE', 7, false, $position->visible));
            fwrite($bf, full_tag('TIMEVALIDFROM', 7, false, $position->timevalidfrom));
            fwrite($bf, full_tag('TIMEVALIDTO', 7, false, $position->timevalidto));
            fwrite($bf, full_tag('TIMECREATED', 7, false, $position->timecreated));
            fwrite($bf, full_tag('TIMEMODIFIED', 7, false, $position->timemodified));
            fwrite($bf, full_tag('USERMODIFIED', 7, false, $position->usermodified));

            if(isset($options->inc_custom) && $options->inc_custom) {
                position_backup_custom_data($bf, $position->id, $options);
            }

            if(isset($options->inc_comp) && $options->inc_comp) {
                position_backup_assigned_competencies($bf, $position->id, $options);
            }

            fwrite($bf, end_tag('POSITION', 6, true));
        }
        fwrite($bf, end_tag('POSITIONS', 5, true));
    }
}

function position_backup_custom_data($bf, $posid, $options) {
    if(is_numeric($posid)) {
        $values = get_records('pos_depth_info_data','positionid',$posid);
    }
    if($values) {
        fwrite($bf, start_tag('CUSTOM_VALUES', 7, true));
        foreach($values AS $value) {
            fwrite($bf, start_tag('CUSTOM_VALUE', 8, true));
            fwrite($bf, full_tag('ID', 9, false, $value->id));
            fwrite($bf, full_tag('FIELDID', 9, false, $value->fieldid));
            fwrite($bf, full_tag('POSITIONID', 9, false, $value->positionid));
            fwrite($bf, full_tag('DATA', 9, false, $value->data));
            fwrite($bf, end_tag('CUSTOM_VALUE', 8, true));
        }
        fwrite($bf, end_tag('CUSTOM_VALUES', 7, true));

    }
}

function position_backup_assigned_competencies($bf, $posid, $options){
    if(is_numeric($posid)){
        $values = get_records('pos_competencies','positionid',$posid);
    }
    if($values){
        fwrite($bf, start_tag('ASSIGNED_COMPETENCIES', 7, true));
        foreach($values as $value){
            fwrite($bf, start_tag('COMPETENCY', 8, true));
            fwrite($bf, full_tag('ID', 9, false, $value->id));
            fwrite($bf, full_tag('POSITIONID', 9, false, $value->positionid));
            fwrite($bf, full_tag('COMPETENCYID', 9, false, $value->competencyid));
            fwrite($bf, full_tag('TEMPLATEID', 9, false, $value->templateid));
            fwrite($bf, full_tag('TIMECREATED', 9, false, $value->timecreated));
            fwrite($bf, full_tag('USERMODIFIED', 9, false, $value->usermodified));
            fwrite($bf, end_tag('COMPETENCY', 8, true));
        }
        fwrite($bf, end_tag('ASSIGNED_COMPETENCIES', 7, true));
    }
}

function position_options() {
    $options = array();

    $options['custom'] = array('name' => 'inc_custom',
                                  'type' => 'selectyesno',
                                  'label' => 'Include custom fields',
                                  'default' => 1,
                                  'format' => PARAM_BOOL,
                                  'tag' => 'DEPTH_CATEGORIES'
                              );

    $options['competencies'] = array('name' => 'inc_comp',
                                        'type' => 'selectyesno',
                                        'label' => 'Include Assigned competencies',
                                        'default' => 1,
                                        'format' => PARAM_BOOL,
                                        'tag' => 'ASSIGNED_COMPETENCIES'
                                    );

    return $options;

}

/**
 * Used by hierarchy/restorelib.php to determine which tags to look inside
 * when restoring items
 *
 * @param boolean $plural True if the plural of the tag is required
 * @return string Returns a string containing the tag name for this hierarchy
 *                The plural version of the tag is returned if $plural is true
 *                otherwise the singlular is returned
**/
function position_get_item_tag($plural=false) {
    if ($plural) {
        return "POSITIONS";
    } else {
        return "POSITION";
    }
}

