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
    $res = get_matches($comp, array('idnumber','shortname','fullname'), 'competency');

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
    $framework->isdefault = backup_todb($fwinfo['#']['ISDEFAULT']['0']['#']);
    $framework->sortorder = backup_todb($fwinfo['#']['SORTORDER']['0']['#']);
    $framework->timecreated = backup_todb($fwinfo['#']['TIMECREATED']['0']['#']);
    $framework->timemodified = backup_todb($fwinfo['#']['TIMEMODIFIED']['0']['#']);
    $framework->usermodified = backup_todb($fwinfo['#']['USERMODIFIED']['0']['#']);
    $framework->visible = backup_todb($fwinfo['#']['VISIBLE']['0']['#']);
    $framework->hidecustomfields = backup_todb($fwinfo['#']['HIDECUSTOMFIELDS']['0']['#']);
    $framework->showitemfullname = backup_todb($fwinfo['#']['SHOWITEMFULLNAME']['0']['#']);
    $framework->showdepthfullname = backup_todb($fwinfo['#']['SHOWDEPTHFULLNAME']['0']['#']);

    // rewrite the framework sort order
    $framework->sortorder = get_sortorder('competency_framework',$framework->sortorder);

    // prevent multiple default frameworks
    $framework->isdefault = getdefault('competency_framework', $framework->isdefault);

    // TODO may want to:
    // - append number to shortname
    // - append number to fullname

    $newid = insert_record('competency_framework',$framework);
    print "Restored framework $oldid to $newid<br />";

    //TODO fix output dots
    //Do some output
    $i =0;
    if (($i+1) % 50 == 0) {
        echo ".";
        if (($i+1) % 1000 == 0) {
            echo "<br />";
        }
        backup_flush(300);
    }
    if($newid) {
        backup_putid($backup_unique_code, 'competency_framework', $oldid, $newid);

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
        // TODO need to rewrite:
        // - usermodified
        // - depthlevel ? depends on if we allow partial restores. not at moment
        $newid = insert_record('competency_depth',$depth);

        if($newid) {
            backup_putid($backup_unique_code, 'competency_depth', $oldid, $newid);

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
        $category->sortorder = get_sortorder('competency_depth_info_category',$category->sortorder);

        $newid = insert_record('competency_depth_info_category', $category);
        if($newid) {
            backup_putid($backup_unique_code, 'competency_depth_info_category', $oldid, $newid);

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
        $field->sortorder = get_sortorder('competency_depth_info_field',$field->sortorder);

        // rewrite depthid
        $depthid = backup_getid($backup_unique_code, 'competency_depth', $field->depthid);
        if($depthid) {
            $field->depthid = $depthid->new_id;
        }
        $newid = insert_record('competency_depth_info_field', $field);
        if($newid) {
            backup_putid($backup_unique_code, 'competency_depth_info_field', $oldid, $newid);
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
        $competency->fullname = $competency_info['#']['FULLNAME']['0']['#'];
        $competency->shortname = $competency_info['#']['SHORTNAME']['0']['#'];
        $competency->idnumber = $competency_info['#']['IDNUMBER']['0']['#'];
        $competency->frameworkid = $newfwid;
        $competency->parentid = $competency_info['#']['PARENTID']['0']['#'];
        $competency->sortorder = $competency_info['#']['SORTORDER']['0']['#'];
        $competency->depthid = $competency_info['#']['DEPTHID']['0']['#'];
        $competency->path = $competency_info['#']['PATH']['0']['#'];
        $competency->description = $competency_info['#']['DESCRIPTION']['0']['#'];
        $competency->aggregationmethod = $competency_info['#']['AGGREGATIONMETHOD']['0']['#'];
        $competency->scaleid = $competency_info['#']['SCALEID']['0']['#'];
        $competency->proficiencyexpected = $competency_info['#']['PROFICIENCYEXPECTED']['0']['#'];
        $competency->evidencecount = $competency_info['#']['EVIDENCECOUNT']['0']['#'];
        $competency->timecreated = $competency_info['#']['TIMECREATED']['0']['#'];
        $competency->timemodified = $competency_info['#']['TIMEMODIFIED']['0']['#'];
        $competency->usermodified = $competency_info['#']['USERMODIFIED']['0']['#'];
        $competency->visible = $competency_info['#']['VISIBLE']['0']['#'];

        // rewrite parentid
        $parentid = backup_getid($backup_unique_code, 'competency', $competency->parentid);
        if($parentid) {
            $competency->parentid = $parentid->new_id;
        }

        // rewrite the depthid
        $depthid = backup_getid($backup_unique_code, 'competency_depth', $competency->depthid);
        if($depthid) {
            $competency->depthid = $depthid->new_id;
        }

        // make sure sortorder is unique
        $competency->sortorder = get_sortorder('competency',$competency->sortorder);
        // TODO
        // rewrite scaleid
        // rewrite proficiencyexpected
        // usermodified
        // evidencecount to 0 if no evidence included

        $newid = insert_record('competency',$competency);

        if($newid) {
            backup_putid($backup_unique_code, 'competency', $oldid, $newid);

            // last element in path is current ID, but we don't know the new
            // ID for that yet. So we need to do this *after* record insert
            // then run an update to correct path
            $competency->path = update_path($competency->path, $newid, 'competency', 'competency', $backup_unique_code);

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
        $fieldid = backup_getid($backup_unique_code, 'competency_depth_info_field', $value->fieldid);
        if($fieldid) {
            $value->fieldid = $fieldid->new_id;
        }
        $newid = insert_record('competency_depth_info_data',$value);
        if($newid) {
            backup_putid($backup_unique_code, 'competency_depth_info_data', $oldid, $newid);
        } else {
            $status = false;
        }
    }

}
/**
 *
 * HELPER FUNCTIONS
 *
 * Extra functions for helping with restore process
 *
**/



/**
 * Updates the path of a row in the specified table
 * Must be called after the new row is inserted as row ID is required
 *
 * @param string $path Path string to be updated
 * @param int $id ID of the table row to update with the new path
 * @param string $pathtable Table to use to get new ids for the path elements from
 * @param string $desttable Table to update the path in
 * @param int $backup_unique_code Backup code, used to find new path element ids
 * @return mixed The new path (with updated IDs) or false if update failed
**/
function update_path($path, $id, $pathtable, $desttable, $backup_unique_code) {
    $pathelements = explode('/', $path);
    $out = array();
    foreach($pathelements AS $element) {
        if(trim($element) == '') {
            $out[]='';
            continue;
        }
        $comp = backup_getid($backup_unique_code, $pathtable, $element);
        if($comp) {
            $out[] = $comp->new_id;
        } else {
            $out[] = $element;
        }
    }
    $newpath = implode('/', $out);
    $pathupdate = new object();
    $pathupdate->id = $id;
    $pathupdate->path = $newpath;
    if(update_record($desttable, $pathupdate)) {
        return $newpath;
    } else {
        return false;
    }
}

/*
 * Given an array of XMLized data representing a particular branch of the backup
 * file, and a list of fields to match, and a db table to match to, this function
 * returns an array detailing if branch members matched existing db entries
 * and which fields they matched on. The match can be further restricted with an
 * optional SQL WHERE fragment.
*/
function get_matches($xmlinfo, $matchfields, $tablename, $where=null) {
    global $CFG;
    $queries = array();
    if(!empty($where)) {
        $where = " WHERE $where ";
    } else {
        $where = '';
    }
    // first build a result table for each matchfield
    // do this way to avoid running one query per item
    foreach ($matchfields AS $matchfield) {
        $data = array();
        foreach ($xmlinfo AS $row) {
            $data[] =  '\''.$row['#'][strtoupper($matchfield)]['0']['#'].'\'';
        }
        // build the in statement
        $instr = implode(', ',$data);
        // run the query
        $sql  = "SELECT $matchfield,count(id) FROM {$CFG->prefix}$tablename
            $where
            GROUP BY $matchfield
            HAVING $matchfield IN ($instr)";
        $queries[$matchfield] = get_records_sql($sql);
    }

    // now rerun through each line of input data, and create output array
    // of IDs and fields that matched (false for no match)
    // TODO what if matchfields have quotes or other special chars that
    // can't be used as array keys?
    $out = array();
    foreach($xmlinfo AS $row) {
        $match = false;
        $id = $row['#']['ID']['0']['#'];
        foreach ($matchfields AS $matchfield) {
            $data = $row['#'][strtoupper($matchfield)]['0']['#'];
            if(isset($queries[$matchfield][$data]->count) && $queries[$matchfield][$data]->count == 1) {
                $match = $matchfield;
                break;
            }
        }
        $out[$id] = $match;

    }
    // returns an array, where keys are the ID from the backup file
    // and value is either:
    // - the name of the field that matched exactly once
    // - false if no fields matched
    return $out;

}

/**
 * Given an isdefault setting (1 or 0), checks to see if any other rows are
 * already set as the default. If so, this new row is not allowed to be default
 * too.
 *
**/
function getdefault($table, $isdefault) {
    if($isdefault) {
        if(count_records($table,'isdefault',1)) {
            return 0;
        } else {
            return 1;
        }
    }
    else {
        return 0;
    }
}

/**
 * Given a table and a sortorder ID, returns the sortorder to use for a new
 * record. This is either the next available ID or the current one if unused
**/
function get_sortorder($table, $sortorder) {
    global $CFG;
    $matches = count_records($table, 'sortorder', $sortorder);
    if($matches) {
        $sql = "SELECT max(sortorder)+1 AS sortorder from {$CFG->prefix}$table";
        $res = get_record_sql($sql);
        return $res->sortorder;
    } else {
        return $sortorder;
    }
}


