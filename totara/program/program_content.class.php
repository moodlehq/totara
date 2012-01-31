<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
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
 * @author Ben Lobo <ben.lobo@kineo.com>
 * @package totara
 * @subpackage program
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

define('CONTENTTYPE_MULTICOURSE', 1);
define('CONTENTTYPE_COMPETENCY', 2);
define('CONTENTTYPE_RECURRING', 3);

class prog_content {

    // The $formdataobject is an object that will contains the values of any
    // submitted data so that the content edit form can be populated when it
    // is first displayed
    public $formdataobject;

    protected $programid;
    protected $coursesets;
    protected $coursesets_deleted_ids;

    // Used to determine if the content has changed since it was last saved
    protected $contentchanged = false;

    private $courseset_classnames = array(
        CONTENTTYPE_MULTICOURSE => 'multi_course_set',
        CONTENTTYPE_COMPETENCY  => 'competency_course_set',
        CONTENTTYPE_RECURRING   => 'recurring_course_set',
    );

    function __construct($programid) {

        $this->programid = $programid;
        $this->coursesets = array();
        $this->coursesets_deleted_ids = array();
        $this->formdataobject = new stdClass();

        if($sets = get_records('prog_courseset', 'programid', $programid, 'sortorder ASC')) {
            foreach($sets as $set) {

                if( ! array_key_exists($set->contenttype, $this->courseset_classnames)) {
                    throw new ProgramContentException(get_string('contenttypenotfound','local_program'));
                }

                $courseset_classname = $this->courseset_classnames[$set->contenttype];
                $coursesetob = new $courseset_classname($programid, $set);

                $this->coursesets[] = $coursesetob;
            }
        }

        $this->fix_set_sortorder($this->coursesets);
    }

    /**
     * Used by usort to sort the sets in the $coursesets array
     * by their sortorder properties
     *
     * @param <type> $a
     * @param <type> $b
     * @return <type>
     */
    static function cmp_set_sortorder( $a, $b ) {
        if(  $a->sortorder ==  $b->sortorder ){ return 0 ; }
            return ($a->sortorder < $b->sortorder) ? -1 : 1;
    }

    /**
     * Get the course sets
     *
     * @return <type>
     */
    public function get_course_sets() {
        return $this->coursesets;
    }

    /**
     * Deletes all the content for this program
     */
    function delete() {
        $result = true;
        begin_sql();

        foreach($this->coursesets as $courseset) {
            if($result) {
                $result = $result && delete_records('prog_courseset_course', 'coursesetid', $courseset->id);
            } else {
                break;
            }
        }

        if($result) {
            $result = $result && delete_records('prog_courseset', 'programid', $this->programid);
        }

        if ($result) {
            commit_sql();
        }
        else {
            rollback_sql();
        }
        return $result;
    }

    /**
     * Makes sure that an array of course sets is in order in terms of each
     * set's sortorder property and resets the sortorder properties to ensure
     * that it begins from 1 and there are no gaps in the order.
     *
     * Also adds properties to enable the first and last set in the array to be
     * easily detected.
     *
     * @param <type> $coursesets
     */
    public function fix_set_sortorder(&$coursesets=null) {

        if($coursesets==null) {
            $coursesets = $this->coursesets;
        }

        usort($coursesets, array('prog_content', 'cmp_set_sortorder'));

        $pos = 1;
        foreach($coursesets as $courseset) {

            $courseset->sortorder = $pos;

            unset($courseset->isfirstset);
            if($pos == 1) {
                $courseset->isfirstset = true;
            }

            unset($courseset->islastset);
            if($pos == count($coursesets)) {
                $courseset->islastset = true;
            }

            $pos++;
        }
    }

    /**
     * Recieves the data submitted from the program content form and sets up
     * the course sets in an array so that they can be manipulated and/or
     * re-displayed in the form
     *
     * @param <type> $formdata
     * @return <type>
     */
    public function setup_content($formdata) {

        $courseset_prefixes = $this->get_courseset_prefixes($formdata);

        // If the form has been submitted then it's likely that some changes are
        // being made to the messages so we mark the messages as changed (this
        // is used by javascript to determine whether or not to warn te user
        // if they try to leave the page without saving first
        $this->contentchanged = true;

        $this->coursesets = array();

        foreach($courseset_prefixes as $prefix) {

            if(isset($formdata->{$prefix.'contenttype'})) {
                $contenttype = $formdata->{$prefix.'contenttype'};
            } else {
                continue;
            }

            if( ! array_key_exists($contenttype, $this->courseset_classnames)) {
                throw new ProgramContentException(get_string('contenttypenotfound','local_program'));
            }

            $courseset_classname = $this->courseset_classnames[$contenttype];
            $courseset = new $courseset_classname($this->programid, null, $prefix);

            $courseset->init_form_data($prefix, $formdata);
            $this->coursesets[] = $courseset;
        }

        $this->coursesets_deleted_ids = $this->get_deleted_coursesets($formdata);

        $this->fix_set_sortorder($this->coursesets);

        return true;

    }

    public function update_content() {
        $this->fix_set_sortorder($this->coursesets);
    }

    /**
     * Returns the sort order of the last course set.
     *
     * @return <type>
     */
    public function get_last_courseset_pos() {
        $sortorder = null;
        foreach($this->coursesets as $set) {
            $sortorder = max($sortorder, $set->sortorder);
        }
        return $sortorder;
    }

    /**
     * Retrieves the form name prefixes of all the existing course sets from
     * the submitted data and returns an array containing all the form name
     * prefixes
     *
     * @param object $formdata The submitted form data
     * @return array
     */
    public function get_courseset_prefixes($formdata) {
        if( ! isset($formdata->setprefixes) || empty($formdata->setprefixes)) {
            return array();
        } else  {
            return explode(',', $formdata->setprefixes);
        }
    }

    /**
     * Retrieves the ids of any deleted course sets from the submitted data and
     * returns an array containing the id numbers or an empty array
     *
     * @param <type> $formdata
     * @return <type>
     */
    public function get_deleted_coursesets($formdata) {
        if( ! isset($formdata->deleted_coursesets) || empty($formdata->deleted_coursesets)) {
            return array();
        }
        return explode(',', $formdata->deleted_coursesets);
    }

    /**
     * Determines whether or not an action button was clicked and, if so,
     * determines which set the action refers to (based on the set sortorder)
     * and returns the set order number.
     *
     * @param string $action The action that this relates to (moveup, movedown, delete, etc)
     * @param object $formdata The submitted form data
     * @return int|obj|false Returns set order number if a matching action was found or false for no action
     */
    public function check_set_action($action, $formdata) {

        $courseset_prefixes = $this->get_courseset_prefixes($formdata);

        // if a submit button was clicked, try to determine if it relates to a
        // course set and, if so, return the course set sort order
        foreach($courseset_prefixes as $prefix) {
            if(isset($formdata->{$prefix.$action})) {
                return $formdata->{$prefix.'sortorder'};
            }
        }

        // if a submit button was clicked, try to determine if it relates to a
        // course within a course set and, if so, return the course set sort
        // order and the course id in an object
        foreach($this->coursesets as $courseset) {
            if($courseid = $courseset->check_course_action($action, $formdata)) {
                $ob = new stdClass();
                $ob->courseid = $courseid;
                $ob->setnumber = $courseset->sortorder;
                return $ob;
            }
        }

        return false;
    }

    public function save_content() {

        $this->fix_set_sortorder($this->coursesets);

        // first delete any course sets from the database that have been marked for deletion
        foreach($this->coursesets_deleted_ids as $coursesetid) {
            if($courseset = get_record('prog_courseset', 'id', $coursesetid)) {

                // delete and courses linked to the course set
                if( ! delete_records('prog_courseset_course', 'coursesetid', $coursesetid)) {
                    return false;
                }

                // delete the course set
                if( ! delete_records('prog_courseset', 'id', $coursesetid)) {
                    return false;
                }
            }
        }

        // then save the new and changed course sets
        foreach($this->coursesets as $courseset) {
            if( ! $courseset->save_set()) {
                return false;
            }
        }

        return true;
    }

    /**
     * Moves a course set up one place in the array of course sets
     *
     * @param <type> $settomove_sortorder
     * @return <type>
     */
    public function move_set_up($settomove_sortorder) {

        foreach($this->coursesets as $current_set) {

            if($current_set->sortorder == $settomove_sortorder) {
                $settomoveup = $current_set;
            }

            if($current_set->sortorder == $settomove_sortorder-1) {
                $settomovedown = $current_set;
            }
        }

        if($settomoveup && $settomovedown) {
            $moveup_sortorder = $settomoveup->sortorder;
            $movedown_sortorder = $settomovedown->sortorder;
            $settomoveup->sortorder = $movedown_sortorder;
            $settomovedown->sortorder = $moveup_sortorder;
            $this->fix_set_sortorder($this->coursesets);
            return true;
        }

        return false;
    }

    /**
     * Moves a course set down one place in the array of course sets
     *
     * @param <type> $settomove_sortorder
     * @return <type>
     */
    public function move_set_down($settomove_sortorder) {

        foreach($this->coursesets as $current_set) {

            if($current_set->sortorder == $settomove_sortorder) {
                $settomovedown = $current_set;
            }

            if($current_set->sortorder == $settomove_sortorder+1) {
                $settomoveup = $current_set;
            }
        }

        if($settomovedown && $settomoveup) {
            $movedown_sortorder = $settomovedown->sortorder;
            $moveup_sortorder = $settomoveup->sortorder;
            $settomovedown->sortorder = $moveup_sortorder;
            $settomoveup->sortorder = $movedown_sortorder;
            $this->fix_set_sortorder($this->coursesets);
            return true;
        }

        return false;
    }

    /**
     * Adds a new course set to the array of course sets.
     *
     * @param <type> $contenttype
     * @return <type>
     */
    //public function add_set($contenttype, &$mform, &$template_values) {
    public function add_set($contenttype) {

        $lastsetpos = $this->get_last_courseset_pos();

        if( ! array_key_exists($contenttype, $this->courseset_classnames)) {
            throw new ProgramContentException(get_string('contenttypenotfound','local_program'));
        }

        $courseset_classname = $this->courseset_classnames[$contenttype];
        $courseset = new $courseset_classname($this->programid);

        if($lastsetpos !== null) {
            $courseset->sortorder = $lastsetpos + 1;
        } else {
            $courseset->sortorder = 1;
        }

        $courseset->label = get_string('legend:courseset', 'local_program', $courseset->sortorder);

        $this->coursesets[] = $courseset;
        $this->fix_set_sortorder($this->coursesets);

        return true;
    }

    /**
     * Deletes a course set from the array of course sets. If the set
     * has no id number (i.e. it does not yet exist in the database) it is
     * removed from the array but if it has an id number it is marked as
     * deleted but not actually removed from the array until the content is
     * saved
     *
     * @param <type> $set
     */
    public function delete_set($settodelete_sortorder) {

        $new_coursesets = array();
        $setfound = false;
        $previous_set = null;

        foreach($this->coursesets as $courseset) {
            if ($courseset->sortorder == $settodelete_sortorder) {
                $setfound = true;
                if ($courseset->id > 0) { // if this set already exists in the database
                    $this->coursesets_deleted_ids[] = $courseset->id;
                }

                // if the set being deleted was the last set in the program
                // we have to set the previous set's nextsetoperator property
                // to 0
                if (isset($courseset->islastset) && $courseset->islastset) {
                    if (is_object($previous_set)) {
                        $previous_set->nextsetoperator = 0;
                    }
                } else {
                    // if this set's nextsetoperator property is 'then' we have to
                    // transfer this property to the previous set (if there was one)
                    // so that we don't break the flow of the content
                    if ($courseset->nextsetoperator == NEXTSETOPERATOR_THEN) {
                        if (is_object($previous_set)) {
                            $previous_set->nextsetoperator = NEXTSETOPERATOR_THEN;
                        }
                    }
                }

            } else {
                $previous_set = $courseset;
                $new_coursesets[] = $courseset;
            }
        }

        if ($setfound) {
            $this->coursesets = $new_coursesets;
            $this->fix_set_sortorder($this->coursesets);
            return true;
        }

        return false;
    }

    public function update_set($set_pos) {
        $this->fix_set_sortorder($this->coursesets);
    }

    /**
     * Locates the course set to which a course is being added and adds the course
     *
     * @param <type> $set_sortorder
     * @param <type> $formdata
     * @return <type>
     */
    public function add_course($set_sortorder, $formdata) {
        foreach($this->coursesets as $courseset) {
            if($courseset->sortorder == $set_sortorder) {
                if( ! $courseset->add_course($formdata)) {
                    return false;
                } else {
                    $this->fix_set_sortorder($this->coursesets);
                    return true;
                }
            }
        }
        return false;
    }

    public function delete_course($set_sortorder, $courseid, $formdata) {
        foreach($this->coursesets as $courseset) {
            if($courseset->sortorder == $set_sortorder) {
                if( ! $courseset->delete_course($courseid)) {
                    return false;
                } else {
                    $this->fix_set_sortorder($this->coursesets);
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Locates the course set to which a competency is being added and adds the competency
     *
     * @param <type> $set_sortorder
     * @param <type> $formdata
     * @return <type>
     */
    public function add_competency($set_sortorder, $formdata) {
        foreach($this->coursesets as $courseset) {
            if($courseset->sortorder == $set_sortorder) {
                if( ! $courseset->add_competency($formdata)) {
                    return false;
                } else {
                    $this->fix_set_sortorder($this->coursesets);
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Returns the total maximum time allowance for the program by looking the
     * different content time allowances
     *
     * @return int total_time_allowance
     */
    public function get_total_time_allowance() {

    // Store the maximum time allowance to be returned
    $total_time_allowance = 0;

        // retrieve the course sets in the way that they are grouped in the program
        $courseset_groups = $this->get_courseset_groups();

    if (empty($courseset_groups)) {
        return 0; // raise an exception? or give infinite time?
    }

    foreach ($courseset_groups as $courseset_group) {

            $max_time_allowance_in_group = 0;

            foreach($courseset_group as $courseset) {
                if ($courseset->timeallowed > $max_time_allowance_in_group) {
                    $max_time_allowance_in_group = $courseset->timeallowed;
                }
            }

            $total_time_allowance += $max_time_allowance_in_group;

    }

    return $total_time_allowance;
    }

    /**
     * Returns an array of arrays containing the course sets in this program
     * grouped by their flow within the program. For example, if the content
     * flow is Set1 or Set2 then Set3 or Set4 then Set5, the returned array
     * will be:
     *
     * array(
     *      array(Set1, Set2),
     *      array(Set3, Set4),
     *      array(Set5),
     * };
     *
     * This can be used to determine whether or not a user has completed a
     * particular set and/or group of sets (which is necessary for working out
     * when to provide 'access tokens' to a user to let them into any of the
     * courses in a subsequent course set or group of course sets.
     */
    public function get_courseset_groups() {

        $courseset_groups = array();

    if (empty($this->coursesets)) {
        return $courseset_groups;
    }

    // Helpers for handling the sets of OR's
    $last_handled_OR_operator = false;
    $courseset_group = array();

    foreach ($this->coursesets as $courseset) {
        if ($courseset->nextsetoperator == NEXTSETOPERATOR_OR) {
        // Add to the outstanding 'or' list
        $last_handled_OR_operator = true;
        $courseset_group[] = $courseset;

                // slight hack to check if this is the last course set (nextsetoperator should not be set in this case but sometimes it is)
                if (isset($courseset->islastset) && $courseset->islastset) {
                    $courseset_groups[] = $courseset_group;
                }
        } else { // If THEN operator or no operator next..
        if ($last_handled_OR_operator) {
            // Add each course set in the group of ORs to an array
            $courseset_group[] = $courseset;

            // Add this group of course sets to the array of groups
            $courseset_groups[] = $courseset_group;

            // Reset the OR bits
            $last_handled_OR_operator = false;
            $courseset_group = array();
        } else {
                    $courseset_group[] = $courseset;
                    $courseset_groups[] = $courseset_group;
                    $courseset_group = array();
                }

        }
    }

    return $courseset_groups;
    }

    /**
     * Receives an array containing the course sets in a course group and determines
     * the time allowance for the group based on the shortest time allowance of
     * all the course sets. A record is then added to the prog_completion table
     * setting the timedue property as the current time + time allowance.
     *
     * This date will be used to determine when to issue course set due reminders.
     *
     * @param array $courseset_group
     * @param int $userid
     * @return void
     */
    public function set_courseset_group_timedue($courseset_group, $userid) {

        if (count($courseset_group)<1) {
            return;
        }

    $now = time();
        $courseset_selected = $courseset_group[0];

        // select the course set with the shortest time allowance
        foreach($courseset_group as $courseset) {
            $courseset_selected = ($courseset->timeallowed < $courseset_selected->timeallowed) ? $courseset : $courseset_selected;
        }

        $timeallowance = $courseset_selected->timeallowed;

        // insert a record to set the time that this course set will be due
        if ($timeallowance>0) {
            if ( ! $cc = get_record('prog_completion', 'programid', $this->programid, 'userid', $userid, 'coursesetid', $courseset_selected->id)) {
                $cc = new stdClass();
                $cc->programid = $this->programid;
                $cc->userid = $userid;
                $cc->coursesetid = $courseset_selected->id;
                $cc->status = STATUS_COURSESET_INCOMPLETE;
                $cc->timestarted = $now;
                $cc->timedue = $now + $timeallowance;
                insert_record('prog_completion', $cc);
            }
        }

        return;

    }

    public function get_content_form_template(&$mform, &$template_values, $coursesets=null, $updateform=true) {

        if($coursesets==null) {
            $coursesets = $this->coursesets;
        }

        $templatehtml = '';
        $numcoursesets = count($coursesets);
        $recurring = false;

        // This update button is at the start of the form so that it catches any
        // 'return' key presses in text fields and acts as the default submit
        // behaviour. This is not official browser behaviour but in most browsers
        // this should result in this button being submitted (where a form has
        // multiple submit buttons like this one)
        if($updateform) {
            $mform->addElement('submit', 'update', get_string('update', 'local_program'));
            $template_values['%update%'] = array('name'=>'update', 'value'=>null);
        }
        $templatehtml .= '%update%'."\n";

        // Add the program id
        if($updateform) {
            $mform->addElement('hidden', 'id');
            $mform->setType('id', PARAM_INT);
            $template_values['%programid%'] = array('name'=>'id', 'value'=>null);
        }
        $templatehtml .= '%programid%'."\n";
        $this->formdataobject->id = $this->programid;

        // Add a hidden field to show if the content has been changed
        // (used by javascript to determine whether or not to display a
        // dialog when the user leaves the page)
        $contentchanged = $this->contentchanged ? '1' : '0';
        if($updateform) {
            $mform->addElement('hidden', 'contentchanged', $contentchanged);
            $mform->setType('contentchanged', PARAM_BOOL);
            $mform->setConstant('contentchanged', $contentchanged);
            $template_values['%contentchanged%'] = array('name'=>'contentchanged', 'value'=>null);
        }
        $templatehtml .= '%contentchanged%'."\n";
        $this->formdataobject->contentchanged = $contentchanged;

        // Add the deleted course set ids
        if($this->coursesets_deleted_ids) {
            $deletedcoursesetidsarray = array();
            foreach($this->coursesets_deleted_ids as $deleted_courseset_id) {
                $deletedcoursesetidsarray[] = $deleted_courseset_id;
            }
            $deletedcourseidsstr = implode(',', $deletedcoursesetidsarray);
            if($updateform) {
                $mform->addElement('hidden', 'deleted_coursesets', $deletedcourseidsstr);
                $mform->setType('deleted_coursesets', PARAM_SEQUENCE);
                $mform->setConstant('deleted_coursesets', $deletedcourseidsstr);
                $template_values['%deleted_coursesets%'] = array('name'=>'deleted_coursesets', 'value'=>null);
            }
            $templatehtml .= '%deleted_coursesets%'."\n";
            $this->formdataobject->deleted_coursesets = $deletedcourseidsstr;
        }

        $templatehtml .= '<fieldset id="programcontent">';
        $templatehtml .= '<legend class="ftoggler">'.get_string('programcontent', 'local_program').'</legend>';
        $templatehtml .= '<p>'.get_string('instructions:programcontent', 'local_program').'</p>';

        $templatehtml .= '<div id="course_sets">';
        $coursesetprefixesarray = array();

        if($numcoursesets==0) { // if there's no content yet
            $templatehtml .= '<p>'.get_string('noprogramcontent', 'local_program').'</p>';
        } else {
            foreach($coursesets as $courseset) {
                $coursesetprefixesarray[] = $courseset->get_set_prefix();

                // Add the course sets
                $templatehtml .= $courseset->get_courseset_form_template($mform, $template_values, $this->formdataobject, $updateform);

                $recurring = $courseset->is_recurring();
            }
        }

        // Add the set prefixes
        $setprefixesstr = implode(',', $coursesetprefixesarray);
        if($updateform) {
            $mform->addElement('hidden', 'setprefixes', $setprefixesstr);
            $mform->setType('setprefixes', PARAM_TEXT);
            $mform->setConstant('setprefixes', $setprefixesstr);
            $template_values['%setprefixes%'] = array('name'=>'setprefixes', 'value'=>null);
        }
        $templatehtml .= '%setprefixes%'."\n";
        $this->formdataobject->setprefixes = $setprefixesstr;

        $templatehtml .= '</div>';
        $templatehtml .= '</fieldset>';
        $templatehtml .= '<br />';

        if( ! $recurring) {
            // Add the add content drop down
            if($updateform) {
                $contentoptions = array(
                    CONTENTTYPE_MULTICOURSE => get_string('setofcourses', 'local_program'),
                    CONTENTTYPE_COMPETENCY => get_string('competency', 'local_program')
                );
                if($numcoursesets==0) { // don't allow recurring course to be added if the program already has other content
                    $contentoptions[CONTENTTYPE_RECURRING] = get_string('recurringcourse', 'local_program');
                }
                $mform->addElement('select', 'contenttype', get_string('addnew', 'local_program'), $contentoptions, array('id'=>'contenttype'));
                $mform->setType('contenttype', PARAM_INT);
                $template_values['%contenttype%'] = array('name'=>'contenttype', 'value'=>null);
            }
            $templatehtml .= '<label for="contenttype">'.get_string('addnew', 'local_program').' </label>';
            $templatehtml .= '%contenttype%';
            $templatehtml .= ' '.get_string('toprogram', 'local_program').' ';

            // Add the add content button
            if($updateform) {
                $mform->addElement('submit', 'addcontent', get_string('add'), array('id'=>'addcontent'));
                $template_values['%addcontent%'] = array('name'=>'addcontent', 'value'=>null);
            }
            $templatehtml .= '%addcontent%'."\n";
            $helpbutton = helpbutton('addprogramcontent', get_string('addnew', 'local_program'), 'local_program', true, false, '', true);
            $templatehtml .= $helpbutton;
        }

        $templatehtml .= '<br />';

        if ($updateform) {
//            $this->add_action_buttons();

        }

        // Add the save and return button
        if($updateform) {
            $mform->addElement('submit', 'savechanges', get_string('savechanges'), array('class'=>"savechanges-content program-savechanges"));
            $template_values['%savechanges%'] = array('name'=>'savechanges', 'value'=>null);
        }
        $templatehtml .= '%savechanges%'."\n";

/*        // Add the save and next button
        if($updateform) {
            $mform->addElement('submit', 'saveandnext', get_string('saveandnext', 'local_program'), array('class'=>'next-assignments'));
            $template_values['%saveandnext%'] = array('name'=>'saveandnext', 'value'=>null);
        }
        $templatehtml .= '%saveandnext%'."\n";*/

        // Add the cancel button
        if($updateform) {
            $mform->addElement('cancel', 'cancel', get_string('cancel', 'local_program'));
            $template_values['%cancel%'] = array('name'=>'cancel', 'value'=>null);
        }
        $templatehtml .= '%cancel%'."\n";

        return $templatehtml;
    }
}

class ProgramContentException extends Exception { }
