<?php

function organisation_restore($orginfo, $fwtobackup, $options, $backup_unique_code) {
    $frameworks = $orginfo['#']['FRAMEWORKS']['0']['#']['FRAMEWORK'];
    // restore requested frameworks
    foreach($frameworks AS $frameworkinfo) {
        $fwid = $frameworkinfo['#']['ID']['0']['#'];
        if(isset($fwtobackup[$fwid]) && $fwtobackup[$fwid] == 1) {
            organisation_restore_framework($frameworkinfo, $options, $backup_unique_code);
        }
    }
}

function organisation_restore_framework($fwinfo, $options, $backup_unique_code) {
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

    // rewrite the framework sort order
    $framework->sortorder = get_sortorder('org_framework',$framework->sortorder);

    // TODO may want to:
    // - append number to shortname
    // - append number to fullname

    $newid = insert_record('org_framework',$framework);
    print "Restored framework $oldid to $newid<br />";

    if($newid) {
        backup_putid($backup_unique_code, 'org_framework', $oldid, $newid);

        // now restore depth levels within this framework
        organisation_restore_depth($oldid, $newid, $fwinfo, $options, $backup_unique_code);

        // now restore organisations within this framework
        organisation_restore_organisations($oldid, $newid, $fwinfo, $options, $backup_unique_code);
    } else {
        $status = false;
    }

    return $status;

}

function organisation_restore_depth($oldfwid, $newfwid, $fwinfo, $options, $backup_unique_code) {
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
        $newid = insert_record('org_depth',$depth);

        if($newid) {
            backup_putid($backup_unique_code, 'org_depth', $oldid, $newid);

            // restore custom fields if specified by options
            if(isset($options['inc_custom']) && $options['inc_custom']) {
                // restore custom fields
                organisation_restore_custom_category($oldid, $newid, $depth_info, $options, $backup_unique_code);
            }

        } else {
            $status = false;
        }
    }
}

function organisation_restore_custom_category($olddepthid, $newdepthid, $depthinfo, $options, $backup_unique_code) {
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
        $category->sortorder = get_sortorder('org_depth_info_category',$category->sortorder);

        $newid = insert_record('org_depth_info_category', $category);
        if($newid) {
            backup_putid($backup_unique_code, 'org_depth_info_category', $oldid, $newid);

            organisation_restore_custom_field($oldid, $newid, $cat_info, $options, $backup_unique_code);
        }
        else {
            $status = false;
        }

    }
}

function organisation_restore_custom_field($oldcatid, $newcatid, $catinfo, $options, $backup_unique_code) {
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
        $field->sortorder = get_sortorder('org_depth_info_field',$field->sortorder);

        // rewrite depthid
        $depthid = backup_getid($backup_unique_code, 'org_depth', $field->depthid);
        if($depthid) {
            $field->depthid = $depthid->new_id;
        }
        $newid = insert_record('org_depth_info_field', $field);
        if($newid) {
            backup_putid($backup_unique_code, 'org_depth_info_field', $oldid, $newid);
        }
        else {
            $status = false;
        }
    }
}


function organisation_restore_organisations($oldfwid, $newfwid, $fwinfo, $options, $backup_unique_code) {
    if(isset($fwinfo['#']['ORGANISATIONS']['0']['#']['ORGANISATION'])) {
        $organisations = $fwinfo['#']['ORGANISATIONS']['0']['#']['ORGANISATION'];
    } else {
        $organisations = array();
    }

    print "Restoring ".count($organisations)." organisations<br>";

    for($i=0; $i <sizeof($organisations); $i++) {
        $organisation_info = $organisations[$i];

        $oldid = backup_todb($organisation_info['#']['ID']['0']['#']);
        $organisation = new object();
        $organisation->fullname = backup_todb($organisation_info['#']['FULLNAME']['0']['#']);
        $organisation->shortname = backup_todb($organisation_info['#']['SHORTNAME']['0']['#']);
        $organisation->idnumber = backup_todb($organisation_info['#']['IDNUMBER']['0']['#']);
        $organisation->description = backup_todb($organisation_info['#']['DESCRIPTION']['0']['#']);
        $organisation->frameworkid = $newfwid;
        $organisation->path = backup_todb($organisation_info['#']['PATH']['0']['#']);
        $organisation->depthid = backup_todb($organisation_info['#']['DEPTHID']['0']['#']);
        $organisation->parentid = backup_todb($organisation_info['#']['PARENTID']['0']['#']);
        $organisation->sortorder = backup_todb($organisation_info['#']['SORTORDER']['0']['#']);
        $organisation->visible = backup_todb($organisation_info['#']['VISIBLE']['0']['#']);
        $organisation->timecreated = backup_todb($organisation_info['#']['TIMECREATED']['0']['#']);
        $organisation->timemodified = backup_todb($organisation_info['#']['TIMEMODIFIED']['0']['#']);
        $organisation->usermodified = backup_todb($organisation_info['#']['USERMODIFIED']['0']['#']);

        // rewrite parentid
        $parentid = backup_getid($backup_unique_code, 'org', $organisation->parentid);
        if($parentid) {
            $organisation->parentid = $parentid->new_id;
        }

        // rewrite the depthid
        $depthid = backup_getid($backup_unique_code, 'org_depth', $organisation->depthid);
        if($depthid) {
            $organisation->depthid = $depthid->new_id;
        }

        // rewrite the usermodified field
        $userid = backup_getid($backup_unique_code, 'user', $organisation->usermodified);
        if($userid) {
            $organisation->usermodified = $userid->new_id;
        }

        // make sure sortorder is unique
        $organisation->sortorder = get_sortorder('org',$organisation->sortorder);

        $newid = insert_record('org',$organisation);

        if($newid) {
            backup_putid($backup_unique_code, 'org', $oldid, $newid);

            // last element in path is current ID, but we don't know the new
            // ID for that yet. So we need to do this *after* record insert
            // then run an update to correct path
            $organisation->path = update_path($organisation->path, $newid, 'org', 'org', $backup_unique_code);

            // restore custom field data if specified by options
            if(isset($options['inc_custom']) && $options['inc_custom']) {
                // restore custom field data
                organisation_restore_custom_data($oldid, $newid, $organisation_info, $options, $backup_unique_code);
            }

        } else {
            $status = false;
        }
    }
}

function organisation_restore_custom_data($oldorgid, $neworgid, $orginfo, $options, $backup_unique_code) {
    if(isset($orginfo['#']['CUSTOM_VALUES']['0']['#']['CUSTOM_VALUE'])) {
        $values = $orginfo['#']['CUSTOM_VALUES']['0']['#']['CUSTOM_VALUE'];
    } else {
        $values = array();
    }

    print "Restoring ".count($values)." custom values<br>";

    for($i=0; $i <sizeof($values); $i++) {
        $value_info = $values[$i];

        $oldid = backup_todb($value_info['#']['ID']['0']['#']);
        $value = new object();
        $value->fieldid = $value_info['#']['FIELDID']['0']['#'];
        $value->organisationid = $neworgid;
        $value->data = $value_info['#']['DATA']['0']['#'];

        // rewrite fieldid
        $fieldid = backup_getid($backup_unique_code, 'org_depth_info_field', $value->fieldid);
        if($fieldid) {
            $value->fieldid = $fieldid->new_id;
        }
        $newid = insert_record('org_depth_info_data',$value);
        if($newid) {
            backup_putid($backup_unique_code, 'org_depth_info_data', $oldid, $newid);
        } else {
            $status = false;
        }
    }

}
