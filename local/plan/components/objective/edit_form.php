<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
 * Copyright (C) 1999 onwards Martin Dougiamas 
 * 
 * This program is free software; you can redistribute it and/or modify  
 * it under the terms of the GNU General Public License as published by  
 * the Free Software Foundation; either version 2 of the License, or     
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
 * @subpackage plan 
 */

/**
 * The form for editing a plan's objective
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

require_once("{$CFG->libdir}/formslib.php");

class plan_objective_edit_form extends moodleform {

    /**
     * Requires the following $_customdata to be passed in to the constructor:
     * plan, objective, objectiveid (optional)
     *
     * @global object $CFG
     * @global object $USER
     */
    function definition() {
        global $CFG, $USER;

        $mform =& $this->_form;

        // Determine permissions from objective
        $plan = $this->_customdata['plan'];
        $objective = $this->_customdata['objective'];

        // Figure out permissions & settings
        $duedatemode = $objective->get_setting('duedatemode');
        $duedateallow = in_array( $objective->get_setting('setduedate'), array(DP_PERMISSION_ALLOW, DP_PERMISSION_APPROVE));
        $prioritymode = $objective->get_setting('prioritymode');
        $priorityallow = in_array( $objective->get_setting('setpriority'), array(DP_PERMISSION_ALLOW, DP_PERMISSION_APPROVE));
        $profallow = in_array( $objective->get_setting('setproficiency'), array(DP_PERMISSION_ALLOW, DP_PERMISSION_APPROVE));

        // Generate list of priorities
        if ($prioritymode > DP_PRIORITY_NONE) {

            $scaleid = $objective->get_setting('priorityscale');
            if ( $scaleid ){
                $priorityvalues = get_records('dp_priority_scale_value','priorityscaleid', $scaleid, 'sortorder', 'id,name,sortorder');
                $select = array();
                if ( $prioritymode == DP_PRIORITY_OPTIONAL ){
                    $select[] = get_string('none','local_plan');
                }
                foreach( $priorityvalues as $pv ){
                    $select[$pv->id] = $pv->name;
                }
                $prioritylist = $select;
                $prioritydefaultid = get_field('dp_priority_scale', 'defaultid', 'id', $scaleid);
            } else {
                $prioritylist = array( get_string('none', 'local_plan') );
            }
        }

        // Generate list of proficiencies
        $proflist = array();
        $objscaleid = $objective->get_setting('objectivescale');
        $defaultobjscalevalueid = get_field('dp_objective_scale', 'defaultid', 'id', $objscaleid);

        if ( $objscaleid ){
            $vals = get_records('dp_objective_scale_value', 'objscaleid', $objscaleid, 'sortorder', 'id, name, sortorder');
            foreach ( $vals as $v ){
                $proflist[$v->id] = $v->name;
            }
        }

        // Add some hidden fields
        if (isset($this->_customdata['objectiveid'])) {
            $mform->addElement('hidden', 'itemid', $this->_customdata['objectiveid']);
            $mform->setType('itemid', PARAM_INT);
        }
        $mform->addElement('hidden', 'userid', $USER->id);
        $mform->setType('userid', PARAM_INT);
        $mform->addElement('hidden', 'id', $plan->id);
        $mform->setType('id', PARAM_INT);

        $mform->addElement('text', 'fullname', get_string('objectivetitle', 'local_plan'));
        $mform->setType('fullname', PARAM_TEXT);
        $mform->addRule('fullname', get_string('err_required', 'form'), 'required', '', 'client', false, false);
        $mform->addElement('htmleditor', 'description', get_string('objectivedescription', 'local_plan'));
        $mform->setType('description', PARAM_CLEAN);

        // Due dates
        if ( $duedatemode == DP_DUEDATES_OPTIONAL || $duedatemode == DP_DUEDATES_REQUIRED ){

            // Whether to make the field optional
            if ( $duedatemode == DP_DUEDATES_REQUIRED){
                $datemenu = $mform->addElement('date_selector', 'duedate', get_string('duedate', 'local_plan'));
                $mform->addRule('duedate', get_string('err_required', 'form'), 'required', '', 'client', false, false);
            } else {
                $datemenu = $mform->addElement('date_selector', 'duedate', get_string('duedate', 'local_plan'), array('optional'=>true));
            }
            if ( !$duedateallow ){
                $mform->freeze(array('duedate'));
            }
        }

        // Priorities
        if ( $prioritymode == DP_PRIORITY_OPTIONAL || $prioritymode == DP_PRIORITY_REQUIRED ){
            $mform->addElement('select', 'priority', get_string('priority', 'local_plan'), $prioritylist);
            $mform->setDefault('priority', $prioritydefaultid);
            if ( $prioritymode == DP_PRIORITY_REQUIRED ){
                $mform->addRule('priority', get_string('err_required', 'form'), 'required', '', 'client', false, false);
            }
            if ( !$priorityallow ){
                $mform->freeze(array('priority'));
            }
        }

        // Proficiency
        $mform->addElement('select', 'scalevalueid', get_string('status', 'local_plan'), $proflist);
        $mform->addRule('scalevalueid', get_string('err_required', 'form'), 'required', '', 'client', false, false);
        $mform->setDefault('scalevalueid', $defaultobjscalevalueid);

        if ( !$profallow ){
            $mform->freeze(array('scalevalueid'));
        }

        $this->add_action_buttons(true, empty($this->_customdata['objectiveid']) ?
            get_string('addobjective', 'local_plan') : get_string('updateobjective', 'local_plan'));
    }

    function validation($data) {
        $errors = array();

        return $errors;
    }
}
