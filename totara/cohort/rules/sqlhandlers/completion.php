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
 * This file contains sqlhandlers for rules based on course completion and program completion
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

define('COHORT_RULE_COMPLETION_OP_NONE', 0);
define('COHORT_RULE_COMPLETION_OP_ANY', 10);
define('COHORT_RULE_COMPLETION_OP_NOTALL', 30);
define('COHORT_RULE_COMPLETION_OP_ALL', 40);

define('COHORT_RULE_COMPLETION_OP_DATE_LESSTHAN', 50);
define('COHORT_RULE_COMPLETION_OP_DATE_GREATERTHAN', 60);
global $COHORT_RULE_COMPLETION_OP;
$COHORT_RULE_COMPLETION_OP = array(
    COHORT_RULE_COMPLETION_OP_DATE_LESSTHAN => '<=',
    COHORT_RULE_COMPLETION_OP_DATE_GREATERTHAN => '>=',
);

/**
 * A rule for checking whether a user's completed any/all/some/none of the courses/progs
 * in a list
 */
abstract class cohort_rule_sqlhandler_completion_list extends cohort_rule_sqlhandler {
    public $params = array(
        'operator' => 0,
        'listofids' => 1
    );

    public function get_sql_snippet() {

        if (count($this->listofids) == 0){
            // todo: error message?
            return '1=0';
        }

        switch ($this->operator) {
            case COHORT_RULE_COMPLETION_OP_NONE:
                $goalnum = 0;
                $operator = '=';
                break;
            case COHORT_RULE_COMPLETION_OP_ANY:
                $goalnum = 0;
                $operator = '<';
                break;
            case COHORT_RULE_COMPLETION_OP_NOTALL:
                $goalnum = count($this->listofids);
                $operator = '>';
                break;
            case COHORT_RULE_COMPLETION_OP_ALL:
                $goalnum = count($this->listofids);
                $operator = '=';
                break;
            default:
                //todo: error message here?
                return false;
        }

        return $this->construct_sql_snippet($goalnum, $operator, $this->listofids);
    }

    protected abstract function construct_sql_snippet($goalnum, $operator, $lov);
}

/**
 * Rule for completing all/any/some/none of the courses in a list
 */
class cohort_rule_sqlhandler_completion_list_course extends cohort_rule_sqlhandler_completion_list {
    protected function construct_sql_snippet($goalnum, $operator, $lov) {
        global $DB;
        $sqlhandler = new stdClass();
        list($sqlin, $params) = $DB->get_in_or_equal($lov, SQL_PARAMS_NAMED, 'clc'.$this->ruleid);
        $sqlhandler->sql = "{$goalnum} {$operator} ("
                ."select count(*) from {course_completions} cc "
                ."where cc.userid=u.id "
                ."and cc.course {$sqlin} "
                ."and cc.timecompleted > 0"
            .")";
        $sqlhandler->params = $params;
        return $sqlhandler;
    }
}

/**
 * Rule for completing all/any/some/none of the programs in a list
 */
class cohort_rule_sqlhandler_completion_list_program extends cohort_rule_sqlhandler_completion_list {
    protected function construct_sql_snippet($goalnum, $operator, $lov) {
        global $DB;
        $sqlhandler = new stdClass();
        list($sqlin, $params) = $DB->get_in_or_equal($lov, SQL_PARAMS_NAMED, 'clp'.$this->ruleid);
        $sqlhandler->sql = "{$goalnum} {$operator} ("
                ."select count(*) from {prog_completion} pc "
                ."where pc.userid=u.id "
                ."and pc.programid {$sqlin} "
                ."and pc.timecompleted > 0"
            .")";
        $sqlhandler->params = $params;
        return $sqlhandler;
    }
}


/**
 * Abstract rule for handling date-based completion
 */
abstract class cohort_rule_sqlhandler_completion_date extends cohort_rule_sqlhandler {
    public $params = array(
        'operator' => 0,
        'date' => 0,
        'listofids' => 1
    );

    public function get_sql_snippet() {
        global $COHORT_RULE_COMPLETION_OP;

        if (count($this->listofids) == 0){
            // todo: error message?
            return '1=0';
        }

        $date = (int) $this->date;
        $goalnum = count($this->listofids);
        $operator = $COHORT_RULE_COMPLETION_OP[$this->operator];

        return $this->construct_sql_snippet($goalnum, $operator, $date, $this->listofids);
    }

    protected abstract function construct_sql_snippet($goalnum, $operator, $date, $lov);
}

/**
 * Rule for checking whether users has completed all the courses in a list before a fixed date
 */
class cohort_rule_sqlhandler_completion_date_course extends cohort_rule_sqlhandler_completion_date {
    protected function construct_sql_snippet($goalnum, $operator, $date, $lov) {
        global $DB;
        $sqlhandler = new stdClass();
        list($sqlin, $params) = $DB->get_in_or_equal($lov, SQL_PARAMS_NAMED, 'cdc'.$this->ruleid);
        $sqlhandler->sql = "{$goalnum} = ("
                ."select count(*) from {course_completions} cc "
                ."where cc.userid = u.id "
                ."and cc.course {$sqlin} "
                ."and cc.timecompleted > 0 "
                ."and cc.timecompleted {$operator} {$date}"
            .")";
        $sqlhandler->params = $params;
        return $sqlhandler;
    }
}

/**
 * Rule for checking whether user has completed all the programs in a list before a fixed date
 */
class cohort_rule_sqlhandler_completion_date_program extends cohort_rule_sqlhandler_completion_date {
    protected function construct_sql_snippet($goalnum, $operator, $date, $lov) {
        global $DB;
        $sqlhandler = new stdClass();
        list($sqlin, $params) = $DB->get_in_or_equal($lov, SQL_PARAMS_NAMED, 'cdp'.$this->ruleid);
        $sqlhandler->sql = "{$goalnum} = ("
                ."select count(*) from {prog_completion} pc "
                ."where pc.userid = u.id "
                ."and pc.programid {$sqlin} "
                ."and pc.timecompleted > 0 "
                ."and pc.timecompleted {$operator} {$date}"
            .")";
        $sqlhandler->params = $params;
        return $sqlhandler;
    }
}


/**
 * Rule for checking whether user took longer than a specified duration to complete all
 * the courses in a list
 */
class cohort_rule_sqlhandler_completion_duration_course extends cohort_rule_sqlhandler_completion_date {
    protected function construct_sql_snippet($goalnum, $operator, $duration, $lov){
        global $DB;
        $sqlhandler = new stdClass();
        list($sqlin1, $params) = $DB->get_in_or_equal($lov, SQL_PARAMS_NAMED, 'cdc1'.$this->ruleid);
        list($sqlin2, $params2) = $DB->get_in_or_equal($lov, SQL_PARAMS_NAMED, 'cdc2'.$this->ruleid);
        $params = array_merge($params, $params2);
        $sqlhandler->sql =  "("
                ."{$goalnum} = ("
                    ."select count(*) from {course_completions} cc "
                    ."where cc.userid=u.id "
                    ."and cc.course {$sqlin1} "
                    ."and timecompleted > 0 "
                .") AND {$duration} {$operator} ("
                    ."select max(cc.timecompleted) - min(cc.timestarted) "
                    ."from {course_completions} cc "
                    ."where cc.userid = u.id "
                    ."and cc.course {$sqlin2} "
                    ."and timecompleted > 0 "
               .")"
           .")";
        $sqlhandler->params = $params;
        return $sqlhandler;
    }
}

/**
 * Rule for checking whether user took longer than a specified duration to complete all
 * the programs in a list
 */
class cohort_rule_sqlhandler_completion_duration_program extends cohort_rule_sqlhandler_completion_date {
    protected function construct_sql_snippet($goalnum, $operator, $duration, $lov){
        global $DB;
        $sqlhandler = new stdClass();
        list($sqlin1, $params) = $DB->get_in_or_equal($lov, SQL_PARAMS_NAMED, 'cdp1'.$this->ruleid);
        list($sqlin2, $params2) = $DB->get_in_or_equal($lov, SQL_PARAMS_NAMED, 'cdp2'.$this->ruleid);
        $params = array_merge($params, $params2);
        $sqlhandler->sql = "("
                ."{$goalnum} = ("
                    ."select count(*) from {prog_completion} pc "
                    ."where pc.userid=u.id "
                    ."and pc.programid {$sqlin1} "
                    ."and pc.timecompleted > 0 "
                .") AND {$duration} {$operator} ("
                    ."select max(pc.timecompleted) - min(pc.timestarted) "
                    ."from {prog_completion} pc "
                    ."where pc.userid = u.id "
                    ."and pc.programid {$sqlin2} "
                    ."and pc.timecompleted > 0 "
                .")"
            .")";
        $sqlhandler->params = $params;
        return $sqlhandler;
    }
}
