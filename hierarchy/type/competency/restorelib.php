<?php

function competency_restore($compinfo, $fwtobackup, $options, $backup_unique_code) {
    $frameworks = $compinfo['#']['FRAMEWORKS']['0']['#']['FRAMEWORK'];

    // restore requested frameworks
    foreach($frameworks AS $frameworkinfo) {
        $fwid = $frameworkinfo['#']['ID']['0']['#'];
        if(isset($fwtobackup[$fwid]) && $fwtobackup[$fwid] == 1) {
            competency_restore_framework($frameworkinfo, $options, $backup_unique_code);
        }

    }
/*
    // function to return matches to existing values
    $res = get_matches($comp, array('idnumber','shortname','fullname'), 'comp');

     */
}

function competency_restore_framework($fwinfo, $options, $backup_unique_code) {
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
    $framework->sortorder = get_sortorder('comp_framework',$framework->sortorder);

    // TODO may want to:
    // - append number to shortname
    // - append number to fullname

    $newid = insert_record('comp_framework',$framework);
    print "Restored framework $oldid to $newid<br />";

    if($newid) {
        backup_putid($backup_unique_code, 'comp_framework', $oldid, $newid);

        // now restore depth levels within this framework
        competency_restore_depth($oldid, $newid, $fwinfo, $options, $backup_unique_code);

        // now restore competencies within this framework
        competency_restore_competencies($oldid, $newid, $fwinfo, $options, $backup_unique_code);
    } else {
        $status = false;
    }


    return $status;
}


function competency_restore_depth($oldfwid, $newfwid, $fwinfo, $options, $backup_unique_code) {
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
        $newid = insert_record('comp_depth',$depth);

        if($newid) {
            backup_putid($backup_unique_code, 'comp_depth', $oldid, $newid);

            // restore custom fields if specified by options
            if(isset($options['inc_custom']) && $options['inc_custom']) {
                // restore custom fields
                competency_restore_custom_category($oldid, $newid, $depth_info, $options, $backup_unique_code);
            }

        } else {
            $status = false;
        }
    }
}

function competency_restore_custom_category($olddepthid, $newdepthid, $depthinfo, $options, $backup_unique_code) {
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
        $category->sortorder = get_sortorder('comp_depth_info_category',$category->sortorder);

        $newid = insert_record('comp_depth_info_category', $category);
        if($newid) {
            backup_putid($backup_unique_code, 'comp_depth_info_category', $oldid, $newid);

            competency_restore_custom_field($oldid, $newid, $cat_info, $options, $backup_unique_code);
        }
        else {
            $status = false;
        }

    }
}

function competency_restore_custom_field($oldcatid, $newcatid, $catinfo, $options, $backup_unique_code) {
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
        $field->sortorder = get_sortorder('comp_depth_info_field',$field->sortorder);

        // rewrite depthid
        $depthid = backup_getid($backup_unique_code, 'comp_depth', $field->depthid);
        if($depthid) {
            $field->depthid = $depthid->new_id;
        }
        $newid = insert_record('comp_depth_info_field', $field);
        if($newid) {
            backup_putid($backup_unique_code, 'comp_depth_info_field', $oldid, $newid);
        }
        else {
            $status = false;
        }
    }
}

function competency_restore_competencies($oldfwid, $newfwid, $fwinfo, $options, $backup_unique_code) {
    if(isset($fwinfo['#']['COMPETENCIES']['0']['#']['COMPETENCY'])) {
        $competencies = $fwinfo['#']['COMPETENCIES']['0']['#']['COMPETENCY'];
    } else {
        $competencies = array();
    }

    print "Restoring ".count($competencies)." competencies<br>";

    for($i=0; $i <sizeof($competencies); $i++) {
        $competency_info = $competencies[$i];

        $oldid = backup_todb($competency_info['#']['ID']['0']['#']);
        $competency = new object();
        $competency->fullname = backup_todb($competency_info['#']['FULLNAME']['0']['#']);
        $competency->shortname = backup_todb($competency_info['#']['SHORTNAME']['0']['#']);
        $competency->idnumber = backup_todb($competency_info['#']['IDNUMBER']['0']['#']);
        $competency->frameworkid = $newfwid;
        $competency->parentid = backup_todb($competency_info['#']['PARENTID']['0']['#']);
        $competency->sortorder = backup_todb($competency_info['#']['SORTORDER']['0']['#']);
        $competency->depthid = backup_todb($competency_info['#']['DEPTHID']['0']['#']);
        $competency->path = backup_todb($competency_info['#']['PATH']['0']['#']);
        $competency->description = backup_todb($competency_info['#']['DESCRIPTION']['0']['#']);
        $competency->aggregationmethod = backup_todb($competency_info['#']['AGGREGATIONMETHOD']['0']['#']);
        $competency->scaleid = backup_todb($competency_info['#']['SCALEID']['0']['#']);
        $competency->proficiencyexpected = backup_todb($competency_info['#']['PROFICIENCYEXPECTED']['0']['#']);
        $competency->evidencecount = backup_todb($competency_info['#']['EVIDENCECOUNT']['0']['#']);
        $competency->timecreated = backup_todb($competency_info['#']['TIMECREATED']['0']['#']);
        $competency->timemodified = backup_todb($competency_info['#']['TIMEMODIFIED']['0']['#']);
        $competency->usermodified = backup_todb($competency_info['#']['USERMODIFIED']['0']['#']);
        $competency->visible = backup_todb($competency_info['#']['VISIBLE']['0']['#']);

        // rewrite parentid
        $parentid = backup_getid($backup_unique_code, 'comp', $competency->parentid);
        if($parentid) {
            $competency->parentid = $parentid->new_id;
        }

        // rewrite the depthid
        $depthid = backup_getid($backup_unique_code, 'comp_depth', $competency->depthid);
        if($depthid) {
            $competency->depthid = $depthid->new_id;
        }

        // rewrite the usermodified field
        $userid = backup_getid($backup_unique_code, 'user', $competency->usermodified);
        if($userid) {
            $competency->usermodified = $userid->new_id;
        }
        // make sure sortorder is unique, doesnt need to be unique
        //$competency->sortorder = get_sortorder('comp',$competency->sortorder);
        // TODO
        // rewrite scaleid
        // rewrite proficiencyexpected
        // evidencecount to 0 if no evidence included

        $newid = insert_record('comp',$competency);

        if($newid) {
            backup_putid($backup_unique_code, 'comp', $oldid, $newid);

            // last element in path is current ID, but we don't know the new
            // ID for that yet. So we need to do this *after* record insert
            // then run an update to correct path
            $competency->path = update_path($competency->path, $newid, 'comp', 'comp', $backup_unique_code);

            // restore custom field data if specified by options
            if(isset($options['inc_custom']) && $options['inc_custom']) {
                // restore custom field data
                competency_restore_custom_data($oldid, $newid, $competency_info, $options, $backup_unique_code);
            }

        } else {
            $status = false;
        }
    }
}

function competency_restore_custom_data($oldcompid, $newcompid, $compinfo, $options, $backup_unique_code) {
    if(isset($compinfo['#']['CUSTOM_VALUES']['0']['#']['CUSTOM_VALUE'])) {
        $values = $compinfo['#']['CUSTOM_VALUES']['0']['#']['CUSTOM_VALUE'];
    } else {
        $values = array();
    }

    print "Restoring ".count($values)." custom values<br>";

    for($i=0; $i <sizeof($values); $i++) {
        $value_info = $values[$i];

        $oldid = backup_todb($value_info['#']['ID']['0']['#']);
        $value = new object();
        $value->fieldid = $value_info['#']['FIELDID']['0']['#'];
        $value->competencyid = $newcompid;
        $value->data = $value_info['#']['DATA']['0']['#'];

        // rewrite fieldid
        $fieldid = backup_getid($backup_unique_code, 'comp_depth_info_field', $value->fieldid);
        if($fieldid) {
            $value->fieldid = $fieldid->new_id;
        }
        $newid = insert_record('comp_depth_info_data',$value);
        if($newid) {
            backup_putid($backup_unique_code, 'comp_depth_info_data', $oldid, $newid);
        } else {
            $status = false;
        }
    }

}

