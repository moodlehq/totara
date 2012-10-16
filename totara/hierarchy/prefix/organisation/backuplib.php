<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010 - 2012 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Simon Coggins <simon.coggins@totaralms.com>
 * @package totara
 * @subpackage totara_hierarchy
 */

function organisation_backup($bf, $frameworks, $options) {
    // only create hierarchy tag if there are frameworks
    if (is_array($frameworks) && array_keys($frameworks, '1')) {
        fwrite($bf,start_tag('HIERARCHY',2,true));
        fwrite($bf,full_tag('NAME', 3, false, 'organisation'));
        // only backup frameworks if at least one is selected
        if (is_array($frameworks) && array_keys($frameworks, '1')) {
            print '<li>Backing up frameworks</li>';
            fwrite($bf,start_tag('FRAMEWORKS',3, true));
            foreach ($frameworks as $fwid => $include) {
                if ($include) {
                    organisation_backup_framework($bf, $fwid, $options);
                }
            }
            fwrite($bf,end_tag('FRAMEWORKS', 3, true));
        }
        fwrite($bf,end_tag('HIERARCHY',2, true));
    }
    return true;
}

function organisation_backup_framework($bf, $fwid, $options) {
     if (is_numeric($fwid)) {
        $framework = $DB->get_record('org_framework', array('id' => $fwid));
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

    organisation_backup_depth($bf, $framework->id, $options);
    organisation_backup_organisation($bf, $framework->id, $options);

    fwrite($bf, end_tag('FRAMEWORK', 4, true));
}

function organisation_backup_depth($bf, $fwid, $options) {
    if (is_numeric($fwid)) {
        $depths = $DB->get_records('org_depth', array('frameworkid' => $fwid));
    }
    if ($depths) {
        fwrite($bf, start_tag('DEPTHS', 5, true));
        foreach ($depths as $depth) {
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
            if (isset($options->inc_custom) && $options->inc_custom) {
                organisation_backup_custom_category($bf, $depth->id, $options);
            }
            fwrite($bf, end_tag('DEPTH', 6, true));
        }
        fwrite($bf, end_tag('DEPTHS', 5, true));
    }
}

function organisation_backup_custom_category($bf, $depthid, $options) {
    if (is_numeric($depthid)) {
        $categories = $DB->get_records('org_depth_info_category', array('depthid' => $depthid));
    }
    if ($categories) {
        fwrite($bf, start_tag('DEPTH_CATEGORIES', 7, true));
        foreach ($categories as $category) {
            fwrite($bf, start_tag('DEPTH_CATEGORY', 8, true));
            fwrite($bf, full_tag('ID', 9, false, $category->id));
            fwrite($bf, full_tag('NAME', 9, false, $category->name));
            fwrite($bf, full_tag('SORTORDER', 9, false, $category->sortorder));
            fwrite($bf, full_tag('DEPTHID', 9, false, $category->depthid));

            organisation_backup_custom_field($bf, $category->id, $options);

            fwrite($bf, end_tag('DEPTH_CATEGORY', 8, true));
        }
        fwrite($bf, end_tag('DEPTH_CATEGORIES', 7, true));
    }
}

function organisation_backup_custom_field($bf, $categoryid, $options) {
    if (is_numeric($categoryid)) {
        $fields = $DB->get_records('org_depth_info_field', array('categoryid' => $categoryid));
    }
    if ($fields) {
        fwrite($bf, start_tag('CUSTOM_FIELDS', 9, true));
        foreach ($fields as $field) {
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

function organisation_backup_organisation($bf, $fwid, $options) {
    if (is_numeric($fwid)) {
        $organisations = $DB->get_records('org', array('frameworkid' => $fwid));
    }
    if ($organisations) {
        fwrite($bf, start_tag('ORGANISATIONS', 5, true));
        foreach ($organisations as $organisation) {
            fwrite($bf, start_tag('ORGANISATION', 6, true));
            fwrite($bf, full_tag('ID', 7, false, $organisation->id));
            fwrite($bf, full_tag('FULLNAME', 7, false, $organisation->fullname));
            fwrite($bf, full_tag('SHORTNAME', 7, false, $organisation->shortname));
            fwrite($bf, full_tag('IDNUMBER', 7, false, $organisation->idnumber));
            fwrite($bf, full_tag('DESCRIPTION', 7, false, $organisation->description));
            fwrite($bf, full_tag('FRAMEWORKID', 7, false, $organisation->frameworkid));
            fwrite($bf, full_tag('PATH', 7, false, $organisation->path));
            fwrite($bf, full_tag('DEPTHID', 7, false, $organisation->depthid));
            fwrite($bf, full_tag('PARENTID', 7, false, $organisation->parentid));
            fwrite($bf, full_tag('SORTORDER', 7, false, $organisation->sortorder));
            fwrite($bf, full_tag('VISIBLE', 7, false, $organisation->visible));
            fwrite($bf, full_tag('TIMECREATED', 7, false, $organisation->timecreated));
            fwrite($bf, full_tag('TIMEMODIFIED', 7, false, $organisation->timemodified));
            fwrite($bf, full_tag('USERMODIFIED', 7, false, $organisation->usermodified));

            if (isset($options->inc_custom) && $options->inc_custom) {
                organisation_backup_custom_data($bf, $organisation->id, $options);
            }

            fwrite($bf, end_tag('ORGANISATION', 6, true));
        }
        fwrite($bf, end_tag('ORGANISATIONS', 5, true));
    }
}

function organisation_backup_custom_data($bf, $posid, $options) {
    if (is_numeric($posid)) {
        $values = $DB->get_records('org_depth_info_data', array('organisationid' => $posid));
    }
    if ($values) {
        fwrite($bf, start_tag('CUSTOM_VALUES', 7, true));
        foreach ($values as $value) {
            fwrite($bf, start_tag('CUSTOM_VALUE', 8, true));
            fwrite($bf, full_tag('ID', 9, false, $value->id));
            fwrite($bf, full_tag('FIELDID', 9, false, $value->fieldid));
            fwrite($bf, full_tag('ORGANISATIONID', 9, false, $value->organisationid));
            fwrite($bf, full_tag('DATA', 9, false, $value->data));
            fwrite($bf, end_tag('CUSTOM_VALUE', 8, true));
        }
        fwrite($bf, end_tag('CUSTOM_VALUES', 7, true));

    }
}

function organisation_options() {
    $options = array();

    $options['custom'] = array('name' => 'inc_custom',
                                  'type' => 'selectyesno',
                                  'label' => 'Include custom fields',
                                  'default' => 1,
                                  'format' => PARAM_BOOL,
                                  'tag' => 'DEPTH_CATEGORIES'
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
function organisation_get_item_tag($plural=false) {
    if ($plural) {
        return "ORGANISATIONS";
    } else {
        return "ORGANISATION";
    }
}
