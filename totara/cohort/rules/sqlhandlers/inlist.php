<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
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
 * @author Aaron Wells <aaronw@catalyst.net.nz>
 * @package totara
 * @subpackage cohort/rules/sqlhandlers
 */
/**
 * This file contains sqlhandlers for rules expressed in SQL as "somecolumn IN (value1, value2, value3...)"
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

/**
 * This SQL handler handles rules that can be expressed as checking whether
 * a given database column's value matches any values in a supplied
 * list of values. In SQL terms, "column IN (1,2,3...)" or "column NOT IN (1,2,3...)"
 */
abstract class cohort_rule_sqlhandler_in extends cohort_rule_sqlhandler {

    public $params = array(
        'equal'=>0,
        'listofvalues'=>1
    );


    /**
     * The field we're comparing against. May be a column name or a custom field id
     * @var mixed
     */
    public $field;

    /**
     * Whether the field we're doing "IN" on holds a char datatype or not
     * @var bool
     */
    public $ischarfield = true;

    public function __construct($fieldnameorid, $ischarfield) {
        $this->field = $fieldnameorid;
        $this->ischarfield = $ischarfield;
    }

    /**
     * Returns the SQL snippet for this
     * @return str
     */
    public function get_sql_snippet(){

        // If the list of values is empty, then this rule can't match, no matter what.
        if (count($this->listofvalues) == 0) {
            // todo: error message?
            return '1=0';
        }

        return $this->construct_sql_snippet($this->field, ($this->equal ? '' : 'not'), $this->listofvalues);
    }

    /**
     * Concatenates together some constants and the cleaned-up variables to return the SQL snippet
     * @param $fieldname str
     * @param $not str
     * @param $lov str
     */
    protected abstract function construct_sql_snippet($field, $not, $lov);
}

/**
 * SQL snippet for a field of the mdl_user table.
 * @author aaronw
 */
class cohort_rule_sqlhandler_in_userfield extends cohort_rule_sqlhandler_in {
    protected function construct_sql_snippet($field, $not, $lov) {
        global $DB;
        $sqlhandler = new stdClass();
        list($sqlin, $params) = $DB->get_in_or_equal($lov, SQL_PARAMS_NAMED, 'iu'.$this->ruleid, ($not != 'not'));
        $sqlhandler->sql = "u.{$field} {$sqlin}";
        $sqlhandler->params = $params;
        return $sqlhandler;
    }
}

class cohort_rule_sqlhandler_in_userfield_char extends cohort_rule_sqlhandler_in_userfield {
    public function __construct($field) {
        parent::__construct($field, true);
    }
}

class cohort_rule_sqlhandler_in_userfield_int extends cohort_rule_sqlhandler_in_userfield {
    public function __construct($field) {
        parent::__construct($field, false);
    }
}

/**
 * SQL snippet for a user custom field
 * @author aaronw
 */
class cohort_rule_sqlhandler_in_usercustomfield extends cohort_rule_sqlhandler_in {

    public function __construct($field){
        // Always a char field
        parent::__construct($field, true);
    }

    protected function construct_sql_snippet($field, $not, $lov) {
        global $DB;
        $sqlhandler = new stdClass();
        list($sqlin, $params) = $DB->get_in_or_equal($lov, SQL_PARAMS_NAMED, 'icu' . $this->ruleid, ($not != 'not'));
        $sqlhandler->sql = "EXISTS (
                                   SELECT 1
                                     FROM {user_info_data} usinda
                                    WHERE usinda.userid = u.id
                                      AND usinda.fieldid = {$field}
                                      AND usinda.data {$sqlin}
                                   )";
        $sqlhandler->params = $params;
        return $sqlhandler;
    }
}

/**
 * SQL snippet for a field of mdl_pos, representing the user's primary position
 * @author aaronw
 */
class cohort_rule_sqlhandler_in_posfield extends cohort_rule_sqlhandler_in {
    protected function construct_sql_snippet($field, $not, $lov) {
        global $DB;
        $sqlhandler = new stdClass();
        list($sqlin, $params) = $DB->get_in_or_equal($lov, SQL_PARAMS_NAMED, 'ipf'.$this->ruleid, ($not != 'not'));
        $sqlhandler->sql = "EXISTS (
                                   SELECT 1
                                     FROM {pos_assignment} pa
                               INNER JOIN {pos} p
                                       ON pa.positionid = p.id
                                    WHERE pa.userid = u.id
                                      AND pa.type = ".POSITION_TYPE_PRIMARY . "
                                      AND p.{$field} {$sqlin}
                                   )";
        $sqlhandler->params = $params;
        return $sqlhandler;
    }
}

/**
 * SQL snippet for a pos custom field, for the user's primary position
 */
class cohort_rule_sqlhandler_in_poscustomfield extends cohort_rule_sqlhandler_in {
    /**
     * These fields are always char
     */
    public function __construct($field){
        parent::__construct($field, true);
    }

    protected function construct_sql_snippet($field, $not, $lov) {
        global $DB;
        $sqlhandler = new stdClass();
        list($sqlin, $params) = $DB->get_in_or_equal($lov, SQL_PARAMS_NAMED, 'ipc'.$this->ruleid, ($not != 'not'));
        $sqlhandler->sql = "exists("
                ."select 1 "
                ."from {pos_assignment} pa "
                ."inner join {pos_type_info_data} ptid "
                ."on pa.positionid=ptid.positionid "
                ."where pa.userid=u.id "
                ."and pa.type=".POSITION_TYPE_PRIMARY." "
                ."and ptid.fieldid={$field} "
                ."and ptid.data {$sqlin}"
            .")";
        $sqlhandler->params = $params;
        return $sqlhandler;
    }
}

/**
 * SQL snippet for a field of mdl_org, representing the organisation of the user's primary position
 * @author aaronw
 */
class cohort_rule_sqlhandler_in_posorgfield extends cohort_rule_sqlhandler_in {
    protected function construct_sql_snippet($field, $not, $lov){
        global $DB;
        $sqlhandler = new stdClass();
        list($sqlin, $params) = $DB->get_in_or_equal($lov, SQL_PARAMS_NAMED, 'ipo'.$this->ruleid, ($not != 'not'));
        $sqlhandler->sql = "exists("
                ."select 1 "
                ."from {pos_assignment} pa "
                ."inner join {org} o "
                ."on pa.organisationid=o.id "
                ."where pa.userid=u.id "
                ."and pa.type=".POSITION_TYPE_PRIMARY." "
                ."and o.{$field} {$sqlin}"
            .")";
        $sqlhandler->params = $params;
        return $sqlhandler;
    }
}

/**
 * SQL snippet for an org custom field, for the organisation of the user's primary position
 * @author aaronw
 */
class cohort_rule_sqlhandler_in_posorgcustomfield extends cohort_rule_sqlhandler_in {
    /**
     * These fields are always char
     */
    public function __construct($field){
        parent::__construct($field, true);
    }

    protected function construct_sql_snippet($field, $not, $lov){
        global $DB;
        $sqlhandler = new stdClass();
        list($sqlin, $params) = $DB->get_in_or_equal($lov, SQL_PARAMS_NAMED, 'ipoc'.$this->ruleid, ($not != 'not'));
        $sqlhandler->sql = "exists ("
                ."select 1 "
                ."from {pos_assignment} pa "
                ."inner join {org_type_info_data} otid "
                ."on pa.organisationid=otid.organisationid "
                ."where pa.userid=u.id "
                ."and pa.type=".POSITION_TYPE_PRIMARY." "
                ."and otid.fieldid={$field} "
                ."and otid.data {$sqlin}"
            .")";
        $sqlhandler->params = $params;
        return $sqlhandler;
    }
}

/**
 * SQL snippet for a list of values that matches the "id" field of a table
 */
abstract class cohort_rule_sqlhandler_in_hierarchyid extends cohort_rule_sqlhandler_in {
    public $params = array(
        'equal'=>0,
        'includechildren'=>0,
        'listofvalues'=>1
    );

    /**
     * No constructor variables necessary. It's always on one particular column,
     * and the field is always an int
     */
    public function __construct(){
        parent::__construct(false, false);
    }

    /**
     * This one's a little strange... if they didn't tick the "include children" checkbox, then it
     * will produce an "in..." SQL snippet. If they do tick the "include children" checkbox, then it
     * acts significantly differently, needing to "like % or like % or like %"...
     * @return str
     */
    // let it use the parent get_sql_snippet in order to parse the $listofvalues into the necessary $lov

    protected function construct_sql_snippet($field, $not, $lov) {
        $sqlhandler = $this->construct_sql_snippet_firsthalf($not, $lov);
        if ($this->includechildren) {
            $sqlhandler->sql .= $this->construct_sql_snippet_pathclause();
        }
        $sqlhandler->sql .= $this->construct_sql_snippet_ending();
        return $sqlhandler;
    }

    protected abstract function construct_sql_snippet_firsthalf($not, $lov);
    protected function construct_sql_snippet_pathclause() {
        $likestart = "OR " . $this->likefield() . " LIKE '%/";
        $likeend = "/%'";
        $likeglue = "{$likeend} {$likestart}";
        return $likestart . implode($likeglue, $this->listofvalues) . $likeend . " ";
    }
    protected function construct_sql_snippet_ending() {
        return "))";
    }
    protected abstract function likefield();
}

/**
 * SQL Snippet for a list of positions by ID (matching the user's current primary position)
 */
class cohort_rule_sqlhandler_in_listofids_pos extends cohort_rule_sqlhandler_in_hierarchyid {

    protected function likefield() {
        return 'pos.path';
    }

    protected function construct_sql_snippet_firsthalf($not, $lov) {
        global $DB;
        $sqlhandler = new stdClass();
        list($sqlin, $params) = $DB->get_in_or_equal($lov, SQL_PARAMS_NAMED, 'ilp'.$this->ruleid);
        $sqlhandler->sql = "{$not} exists ("
                ."select 1 from {pos_assignment} pa "
                ."inner join {pos} pos "
                ."on pa.positionid=pos.id "
                ."where pa.userid=u.id "
                ."and pa.type=".POSITION_TYPE_PRIMARY." "
                ."and (pa.positionid {$sqlin} ";
        $sqlhandler->params = $params;
        return $sqlhandler;
    }
}

/**
 * SQL Snippet for a list of organisations by ID (matching the user's current primary position's org)
 */
class cohort_rule_sqlhandler_in_listofids_org extends cohort_rule_sqlhandler_in_hierarchyid {

    protected function likefield() {
        return 'org.path';
    }

    protected function construct_sql_snippet_firsthalf($not, $lov) {
        global $DB;
        $sqlhandler = new stdClass();
        list($sqlin, $params) = $DB->get_in_or_equal($lov, SQL_PARAMS_NAMED, 'ilo'.$this->ruleid);
        $sqlhandler->sql = "{$not} exists ("
                ."select 1 from {pos_assignment} pa "
                ."inner join {org} org "
                ."on pa.organisationid=org.id "
                ."where pa.userid=u.id "
                ."and pa.type=".POSITION_TYPE_PRIMARY." "
                ."and (pa.organisationid {$sqlin} ";
        $sqlhandler->params = $params;
        return $sqlhandler;
    }
}
