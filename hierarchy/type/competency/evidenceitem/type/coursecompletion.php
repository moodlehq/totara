<?php

///////////////////////////////////////////////////////////////////////////
//                                                                       //
// NOTICE OF COPYRIGHT                                                   //
//                                                                       //
// Moodle - Modular Object-Oriented Dynamic Learning Environment         //
//          http://moodle.com                                            //
//                                                                       //
// Copyright (C) 1999 onwards Martin Dougiamas  http://dougiamas.com     //
//                                                                       //
// This program is free software; you can redistribute it and/or modify  //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation; either version 2 of the License, or     //
// (at your option) any later version.                                   //
//                                                                       //
// This program is distributed in the hope that it will be useful,       //
// but WITHOUT ANY WARRANTY; without even the implied warranty of        //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         //
// GNU General Public License for more details:                          //
//                                                                       //
//          http://www.gnu.org/copyleft/gpl.html                         //
//                                                                       //
///////////////////////////////////////////////////////////////////////////

/**
 * @copyright Catalyst IT Limited
 * @author Aaron Barnes
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 */

require_once $CFG->dirroot.'/hierarchy/type/competency/evidenceitem/type/evidence.php';

/**
 * Course completion competency evidence type
 */
class competency_evidence_type_coursecompletion extends competency_evidence_type {

    /**
     * Evidence item type
     * @var string
     */
    public $itemtype = COMPETENCY_EVIDENCE_TYPE_COURSE_COMPLETION;

    /**
     * Return evidence name and link
     *
     * @return  string
     */
    public function get_name() {
        global $CFG;

        // Get course name
        $course = get_field('course', 'fullname', 'id', $this->iteminstance);

        return '<a href="'.$CFG->wwwroot.'/course/view.php?id='.$this->iteminstance.'">'.$course.'</a>';
    }

    /**
     * Return evidence item type and link
     *
     * @return  string
     */
    public function get_type() {
        global $CFG;

        $name = $this->get_type_name();

        return '<a href="'.$CFG->wwwroot.'/course/report/completion/index.php?course='.$this->iteminstance.'">'.$name.'</a>';
    }

    /**
     * Get human readable type name
     *
     * @return  string
     */
    public function get_activity_type() {
        return '';
    }

    /**
     * Find user's who have completed this evidence type
     * @access  public
     * @return  void
     */
    public function cron() {

        global $CFG;

        // Only select course completions that have changed
        // since an evidence item evidence was last changed
        $sql = "
            SELECT DISTINCT
                ceie.id AS id,
                cei.id AS itemid,
                cei.competencyid,
                cc.userid,
                ceie.timecreated,
                cc.timecompleted,
                cs.proficient,
                cs.defaultid
            FROM
                {$CFG->prefix}comp_evidence_items cei
            INNER JOIN
                {$CFG->prefix}comp co
             ON cei.competencyid = co.id
            INNER JOIN
                {$CFG->prefix}course c
             ON cei.iteminstance = c.id
            INNER JOIN
                {$CFG->prefix}course_completions cc
            ON cc.course = c.id
            INNER JOIN
                {$CFG->prefix}comp_scale_assignments csa
            ON co.frameworkid = csa.frameworkid
            INNER JOIN
                {$CFG->prefix}comp_scale cs
                ON csa.scaleid = cs.id
            LEFT JOIN
                {$CFG->prefix}comp_evidence_items_evidence ceie
             ON ceie.itemid = cei.id
            AND ceie.userid = cc.userid
            WHERE
                cei.itemtype = 'coursecompletion'
            AND cc.id IS NOT NULL
            AND cs.proficient IS NOT NULL
            AND
            (
                (
                ceie.proficiencymeasured <> cs.proficient
                AND
                    (
                        ceie.timemodified < cc.timecompleted
                     OR ceie.timemodified < cc.timeenrolled
                     OR ceie.timemodified < cc.timestarted
                    )
                )
             OR ceie.proficiencymeasured IS NULL
            )
        ";

        // Loop through evidence itmes, and mark as complete
        if ($rs = get_recordset_sql($sql)) {
            foreach ($rs as $record) {

                if (debugging()) {
                    mtrace('.', '');
                }

                $evidence = new competency_evidence_item_evidence((array)$record, false);

                if ($record['timecompleted']) {
                    $evidence->proficiencymeasured = $record['proficient'];
                }
                elseif ($record['defaultid']) {
                    $evidence->proficiencymeasured = $record['defaultid'];
                }
                else {
                    continue;
                }

                $evidence->save();
            }

            if (debugging() && isset($evidence)) {
                mtrace('');
            }
            $rs->close();
        }
    }
}
