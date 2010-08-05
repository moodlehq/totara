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
 * @package Totara
 */
require_once($CFG->libdir.'/completionlib.php');

/**
 * Activity completion competency evidence type
 */
class competency_evidence_type_activitycompletion extends competency_evidence_type {

    /**
     * Evidence item type
     * @var string
     */
    public $itemtype = COMPETENCY_EVIDENCE_TYPE_ACTIVITY_COMPLETION;

    /**
     * Module instance
     * @var object
     */
    private $_module;

    /**
     * Add this evidence to a competency
     *
     * @param   $competency Competency object
     * @return  void
     */
    public function add($competency) {
        global $CFG;

        // Set item details
        $cmrec = get_record_sql("
            SELECT
                cm.*,
                md.name as modname
            FROM
                {$CFG->prefix}course_modules cm,
                {$CFG->prefix}modules md
            WHERE
                cm.id = '{$this->iteminstance}'
            AND md.id = cm.module
        ");

        if (!$cmrec) {
            error('Could not load module from course_modules');
        }

        $this->iteminstance = $cmrec->instance;
        $this->itemmodule = $cmrec->modname;

        return parent::add($competency);
    }

    /**
     * Return module instance
     *
     * @return object
     */
    private function _get_module() {

        // If already loaded
        if ($this->_module) {
            return $this->_module;
        }

        global $CFG;

        // Get module
        $module = get_record($this->itemmodule, 'id', $this->iteminstance);

        if (!$module) {
            error('Could not load '.$this->itemmodule.' module with id of '.$this->iteminstance);
        }

        // Save module instanace
        $this->_module = $module;
        return $this->_module;
    }

    /**
     * Return evidence name and link
     *
     * @return  string
     */
    public function get_name() {
        global $CFG;

        $module = $this->_get_module();

        return '<a href="'.$CFG->wwwroot.'/mod/'.$this->itemmodule.'/view.php?id='.$this->iteminstance.'">'.$module->name.'</a>';
    }

    /**
     * Return evidence item type and link
     *
     * @return  string
     */
    public function get_type() {
        global $CFG;

        $name = $this->get_type_name();

        $module = $this->_get_module();

        return '<a href="'.$CFG->wwwroot.'/course/report/progress/index.php?course='.$module->course.'">'.$name.'</a>';
    }

    /**
     * Find user's who have completed this evidence type
     * @access  public
     * @return  void
     */
    public function cron() {

        global $CFG;

        // Only select activity completions that have changed
        // since an evidence item evidence was last changed
        $sql = "
            SELECT DISTINCT
                ceie.id AS id,
                cei.id AS itemid,
                cei.competencyid,
                cmc.userid,
                ceie.timecreated,
                cmc.completionstate,
                cs.proficient,
                cs.defaultid
            FROM
                {$CFG->prefix}comp_evidence_items cei
            INNER JOIN
                {$CFG->prefix}comp co
             ON cei.competencyid = co.id
            INNER JOIN
                {$CFG->prefix}course_modules_completion cmc
             ON cei.iteminstance = cmc.coursemoduleid
            INNER JOIN
                {$CFG->prefix}comp_scale cs
             ON co.scaleid = cs.id
            LEFT JOIN
                {$CFG->prefix}comp_evidence_items_evidence ceie
             ON ceie.itemid = cei.id
            AND ceie.userid = cmc.userid
            WHERE
                cei.itemtype = 'activitycompletion'
            AND cmc.id IS NOT NULL
            AND cs.proficient IS NOT NULL
            AND
            (
                (
                    ceie.proficiencymeasured <> cs.proficient
                AND ceie.timemodified < cmc.timemodified
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

                require_once($CFG->dirroot . '/hierarchy/type/competency/evidenceitem/type/evidence.php');
                $evidence = new competency_evidence_item_evidence((array)$record, false);

                if (in_array($record['completionstate'], array(COMPLETION_COMPLETE, COMPLETION_COMPLETE_PASS))) {
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
