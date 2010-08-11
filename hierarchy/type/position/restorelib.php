<?php

function position_restore($posinfo, $fwtobackup, $options, $backup_unique_code) {
    $frameworks = $posinfo['#']['FRAMEWORKS']['0']['#']['FRAMEWORK'];

    // restore requested frameworks
    foreach($frameworks AS $frameworkinfo) {
        $fwid = $frameworkinfo['#']['ID']['0']['#'];
        if(isset($fwtobackup[$fwid]) && $fwtobackup[$fwid] == 1) {
            position_restore_framework($frameworkinfo, $options, $backup_unique_code);
        }
    }
}

function position_restore_framework($fwinfo, $options, $backup_unique_code) {
     global $CFG;
    $status = true;
    $oldid = backup_todb($fwinfo['#']['ID']['0']['#']);
    $framework = new object();
    $framework->fullname = backup_todb($fwinfo['#']['FULLNAME']['0']['#']);
    $framework->shortname = backup_todb($fwinfo['#']['SHORTNAME']['0']['#']);
    $framework->idnumber = backup_todb($fwinfo['#']['IDNUMBER']['0']['#']);
    $framework->description = backup_todb($fwinfo['#']['DESCRIPTION']['0']['#']);
    $framework->sortorder = backup_todb($fwinfo['#']['SORTORDER']['0']['#']);
    $framework->timecreated = backup_todb($fwinfo['#']['TIMECREATED']['0']['#']);
    $framework->timemodified = backup_todb($fwinfo['#']['TIMEMODIFIED']['0']['#']);
    $framework->usermodified = backup_todb($fwinfo['#']['USERMODIFIED']['0']['#']);
    $framework->visible = backup_todb($fwinfo['#']['VISIBLE']['0']['#']);
    $framework->hidecustomfields = backup_todb($fwinfo['#']['HIDECUSTOMFIELDS']['0']['#']);
    $framework->showitemfullname = backup_todb($fwinfo['#']['SHOWITEMFULLNAME']['0']['#']);
    $framework->showdepthfullname = backup_todb($fwinfo['#']['SHOWDEPTHFULLNAME']['0']['#']);

    // rewrite the framework sort order
    $framework->sortorder = get_sortorder('pos_framework',$framework->sortorder);

    // TODO may want to:
    // - append number to shortname
    // - append number to fullname

    $newid = insert_record('pos_framework',$framework);
    print "Restored framework $oldid to $newid<br />";

    if($newid) {
        backup_putid($backup_unique_code, 'pos_framework', $oldid, $newid);

        // now restore depth levels within this framework
        position_restore_depth($oldid, $newid, $fwinfo, $options, $backup_unique_code);

        // now restore positions within this framework
        position_restore_positions($oldid, $newid, $fwinfo, $options, $backup_unique_code);
    } else {
        $status = false;
    }

    return $status;

}

function position_restore_depth($oldfwid, $newfwid, $fwinfo, $options, $backup_unique_code) {
    if(isset($fwinfo['#']['DEPTHS']['0']['#']['DEPTH'])) {
        $depths = $fwinfo['#']['DEPTHS']['0']['#']['DEPTH'];
    } else {
        $depths = array();
    }

    print "Restoring ".count($depths)." depths<br>";
    for($i=0;$i < sizeof($depths); $i++) {
        $depth_info = $depths[$i];
        $oldid = backup_todb($depth_info['#']['ID']['0']['#']);

        $depth = new object();
        $depth->fullname = backup_todb($depth_info['#']['FULLNAME']['0']['#']);
        $depth->shortname = backup_todb($depth_info['#']['SHORTNAME']['0']['#']);
        $depth->description = backup_todb($depth_info['#']['DESCRIPTION']['0']['#']);
        $depth->depthlevel = backup_todb($depth_info['#']['DEPTHLEVEL']['0']['#']);
        $depth->frameworkid = $newfwid;
        $depth->timecreated = backup_todb($depth_info['#']['TIMECREATED']['0']['#']);
        $depth->timemodified = backup_todb($depth_info['#']['TIMEMODIFIED']['0']['#']);
        $depth->usermodified = backup_todb($depth_info['#']['USERMODIFIED']['0']['#']);

        // rewrite usermodified field
        $userid = backup_getid($backup_unique_code, 'user', $depth->usermodified);
        if($userid) {
            $depth->usermodified = $userid->new_id;
        }

        // TODO need to rewrite:
        // - depthlevel ? depends on if we allow partial restores. not at moment
        $newid = insert_record('pos_depth',$depth);

        if($newid) {
            backup_putid($backup_unique_code, 'pos_depth', $oldid, $newid);

            // restore custom fields if specified by options
            if(isset($options['inc_custom']) && $options['inc_custom']) {
                // restore custom fields
                position_restore_custom_category($oldid, $newid, $depth_info, $options, $backup_unique_code);
            }

        } else {
            $status = false;
        }
    }
}

function position_restore_custom_category($olddepthid, $newdepthid, $depthinfo, $options, $backup_unique_code) {
    if(isset($depthinfo['#']['DEPTH_CATEGORIES']['0']['#']['DEPTH_CATEGORY'])) {
        $categories = $depthinfo['#']['DEPTH_CATEGORIES']['0']['#']['DEPTH_CATEGORY'];
    } else {
        $categories = array();
    }
    print "Restoring ".count($categories)." categories<br>";

    for($i=0;$i < sizeof($categories); $i++) {
        $cat_info = $categories[$i];
        $oldid = backup_todb($cat_info['#']['ID']['0']['#']);

        $category->name = backup_todb($cat_info['#']['NAME']['0']['#']);
        $category->sortorder = backup_todb($cat_info['#']['SORTORDER']['0']['#']);
        $category->depthid = $newdepthid;

        // rewrite the sort order
        $category->sortorder = get_sortorder('pos_depth_info_category',$category->sortorder);

        $newid = insert_record('pos_depth_info_category', $category);
        if($newid) {
            backup_putid($backup_unique_code, 'pos_depth_info_category', $oldid, $newid);

            position_restore_custom_field($oldid, $newid, $cat_info, $options, $backup_unique_code);
        }
        else {
            $status = false;
        }

    }
}

function position_restore_custom_field($oldcatid, $newcatid, $catinfo, $options, $backup_unique_code) {
    if(isset($catinfo['#']['CUSTOM_FIELDS']['0']['#']['CUSTOM_FIELD'])) {
        $fields = $catinfo['#']['CUSTOM_FIELDS']['0']['#']['CUSTOM_FIELD'];
    } else {
        $fields = array();
    }
    print "Restoring ".count($fields)." fields<br />";

    for($i=0;$i < sizeof($fields); $i++) {
        $field_info = $fields[$i];
        $oldid = backup_todb($field_info['#']['ID']['0']['#']);

        $field = new object();
        $field->fullname = backup_todb($field_info['#']['FULLNAME']['0']['#']);
        $field->shortname = backup_todb($field_info['#']['SHORTNAME']['0']['#']);
        $field->depthid = backup_todb($field_info['#']['DEPTHID']['0']['#']);
        $field->datatype = backup_todb($field_info['#']['DATATYPE']['0']['#']);
        $field->description = backup_todb($field_info['#']['DESCRIPTION']['0']['#']);
        $field->sortorder = backup_todb($field_info['#']['SORTORDER']['0']['#']);
        $field->categoryid = $newcatid;
        $field->hidden = backup_todb($field_info['#']['HIDDEN']['0']['#']);
        $field->locked = backup_todb($field_info['#']['LOCKED']['0']['#']);
        $field->required = backup_todb($field_info['#']['REQUIRED']['0']['#']);
        $field->forceunique = backup_todb($field_info['#']['FORCEUNIQUE']['0']['#']);
        $field->defaultdata = backup_todb($field_info['#']['DEFAULTDATA']['0']['#']);
        $field->param1 = backup_todb($field_info['#']['PARAM1']['0']['#']);
        $field->param2 = backup_todb($field_info['#']['PARAM2']['0']['#']);
        $field->param3 = backup_todb($field_info['#']['PARAM3']['0']['#']);
        $field->param4 = backup_todb($field_info['#']['PARAM4']['0']['#']);
        $field->param5 = backup_todb($field_info['#']['PARAM5']['0']['#']);

        // rewrite the sort order
        $field->sortorder = get_sortorder('pos_depth_info_field',$field->sortorder);

        // rewrite depthid
        $depthid = backup_getid($backup_unique_code, 'pos_depth', $field->depthid);
        if($depthid) {
            $field->depthid = $depthid->new_id;
        }
        $newid = insert_record('pos_depth_info_field', $field);
        if($newid) {
            backup_putid($backup_unique_code, 'pos_depth_info_field', $oldid, $newid);
        }
        else {
            $status = false;
        }
    }
}


function position_restore_positions($oldfwid, $newfwid, $fwinfo, $options, $backup_unique_code) {
    if(isset($fwinfo['#']['POSITIONS']['0']['#']['POSITION'])) {
        $positions = $fwinfo['#']['POSITIONS']['0']['#']['POSITION'];
    } else {
        $positions = array();
    }

    print "Restoring ".count($positions)." positions<br>";

    for($i=0; $i <sizeof($positions); $i++) {
        $position_info = $positions[$i];

        $oldid = backup_todb($position_info['#']['ID']['0']['#']);
        $position = new object();
        $position->fullname = backup_todb($position_info['#']['FULLNAME']['0']['#']);
        $position->shortname = backup_todb($position_info['#']['SHORTNAME']['0']['#']);
        $position->idnumber = backup_todb($position_info['#']['IDNUMBER']['0']['#']);
        $position->description = backup_todb($position_info['#']['DESCRIPTION']['0']['#']);
        $position->frameworkid = $newfwid;
        $position->path = backup_todb($position_info['#']['PATH']['0']['#']);
        $position->depthid = backup_todb($position_info['#']['DEPTHID']['0']['#']);
        $position->parentid = backup_todb($position_info['#']['PARENTID']['0']['#']);
        $position->sortorder = backup_todb($position_info['#']['SORTORDER']['0']['#']);
        $position->visible = backup_todb($position_info['#']['VISIBLE']['0']['#']);
        $position->timecreated = backup_todb($position_info['#']['TIMECREATED']['0']['#']);
        $position->timemodified = backup_todb($position_info['#']['TIMEMODIFIED']['0']['#']);
        $position->usermodified = backup_todb($position_info['#']['USERMODIFIED']['0']['#']);

        // rewrite parentid
        $parentid = backup_getid($backup_unique_code, 'pos', $position->parentid);
        if($parentid) {
            $position->parentid = $parentid->new_id;
        }

        // rewrite the depthid
        $depthid = backup_getid($backup_unique_code, 'pos_depth', $position->depthid);
        if($depthid) {
            $position->depthid = $depthid->new_id;
        }

        // rewrite the usermodified field
        $userid = backup_getid($backup_unique_code, 'user', $position->usermodified);
        if($userid) {
            $position->usermodified = $userid->new_id;
        }

        // make sure sortorder is unique
        $position->sortorder = get_sortorder('pos',$position->sortorder);

        $newid = insert_record('pos',$position);

        if($newid) {
            backup_putid($backup_unique_code, 'pos', $oldid, $newid);

            // last element in path is current ID, but we don't know the new
            // ID for that yet. So we need to do this *after* record insert
            // then run an update to correct path
            $position->path = update_path($position->path, $newid, 'pos', 'pos', $backup_unique_code);

            // restore custom field data if specified by options
            if(isset($options['inc_custom']) && $options['inc_custom']) {
                // restore custom field data
                position_restore_custom_data($oldid, $newid, $position_info, $options, $backup_unique_code);
            }

            // restore assigned competencies if specified by options
            if(isset($options['inc_comp']) && $options['inc_comp']) {
                //restore assigned competencies
                position_restore_assigned_competencies($oldid, $newid, $position_info, $options, $backup_unique_code);
            }

        } else {
            $status = false;
        }
    }
}

function position_restore_custom_data($oldposid, $newposid, $posinfo, $options, $backup_unique_code) {
    if(isset($posinfo['#']['CUSTOM_VALUES']['0']['#']['CUSTOM_VALUE'])) {
        $values = $posinfo['#']['CUSTOM_VALUES']['0']['#']['CUSTOM_VALUE'];
    } else {
        $values = array();
    }

    print "Restoring ".count($values)." custom values<br>";

    for($i=0; $i <sizeof($values); $i++) {
        $value_info = $values[$i];

        $oldid = backup_todb($value_info['#']['ID']['0']['#']);
        $value = new object();
        $value->fieldid = $value_info['#']['FIELDID']['0']['#'];
        $value->positionid = $newposid;
        $value->data = $value_info['#']['DATA']['0']['#'];

        // rewrite fieldid
        $fieldid = backup_getid($backup_unique_code, 'pos_depth_info_field', $value->fieldid);
        if($fieldid) {
            $value->fieldid = $fieldid->new_id;
        }
        $newid = insert_record('pos_depth_info_data',$value);
        if($newid) {
            backup_putid($backup_unique_code, 'pos_depth_info_data', $oldid, $newid);
        } else {
            $status = false;
        }
    }

}

function position_restore_assigned_competencies($oldposid, $newposid, $posinfo, $options, $backup_unique_code) {
    if(isset($posinfo['#']['ASSIGNED_COMPETENCIES']['0']['#']['COMPETENCY'])) {
        $values = $posinfo['#']['ASSIGNED_COMPETENCIES']['0']['#']['COMPETENCY'];
    } else {
        $values = array();
    }

    print "Restoring ".count($values)." assigned competencies<br>";

    for($i=0; $i < sizeof($values); $i++) {
        $value_info = $values[$i];

        $oldid = backup_todb($value_info['#']['ID']['0']['#']);
        $value = new object();
        $value->positionid = $value_info['#']['POSITIONID']['0']['#'];
        $value->competencyid = backup_todb($value_info['#']['COMPETENCYID']['0']['#']);
        $value->templateid = backup_todb($value_info['#']['TEMPLATEID']['0']['#']);
        $value->timecreated = $value_info['#']['TIMECREATED']['0']['#'];
        $value->usermodified = $value_info['#']['USERMODIFIED']['0']['#'];

        // rewrite positionid
        $positionid = backup_getid($backup_unique_code, 'pos', $value->positionid);
        if($positionid) {
            $value->positionid = $positionid->new_id;
        }

        // rewrite competencyid
        $competencyid = backup_getid($backup_unique_code, 'comp', $value->competencyid);
        if($competencyid) {
            $value->competencyid = $competencyid->new_id;
        }

        //rewrite templateid
        $templateid = backup_getid($backup_unique_code, 'comp_template', $value->templateid);
        if($templateid) {
            $value->templateid = $templateid->new_id;
        }
        $newid = insert_record('pos_competencies', $value);
        if($newid) {
            backup_putid($backup_unique_code, 'pos_competencies', $oldid, $newid);
        } else {
            $status = false;
        }
    }

}
