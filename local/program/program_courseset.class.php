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

define('COMPLETIONTYPE_ALL', 1);
define('COMPLETIONTYPE_ANY', 2);

define('NEXTSETOPERATOR_THEN', 1);
define('NEXTSETOPERATOR_OR', 2);

abstract class course_set {
    public $id, $programid, $contenttype, $sortorder, $label;
    public $competencyid, $nextsetoperator, $completiontype;
    public $timeallowed, $timeallowednum, $timeallowedperiod;
    public $recurrencetime, $recurcreatetime;
    public $isfirstset, $islastset;
    public $uniqueid;

    public function __construct($programid, $setob=null, $uniqueid=null) {

        if(is_object($setob)) {
            $this->id = $setob->id;
            $this->programid = $setob->programid;
            $this->sortorder = $setob->sortorder;
            $this->contenttype = $setob->contenttype;
            $this->label = $setob->label;
            $this->competencyid = $setob->competencyid;
            $this->nextsetoperator = $setob->nextsetoperator;
            $this->completiontype = $setob->completiontype;
            $this->timeallowed = $setob->timeallowed;
            $this->recurrencetime = $setob->recurrencetime;
            $this->recurcreatetime = $setob->recurcreatetime;
        } else {
            $this->id = 0;
            $this->programid = $programid;
            $this->sortorder = 0;
            $this->contenttype = 0;
            $this->label = '';
            $this->competencyid = 0;
            $this->nextsetoperator = 0;
            $this->completiontype = 0;
            $this->timeallowed = 0;
            $this->recurrencetime = 0;
            $this->recurcreatetime = 0;
        }

        $timeallowed = program_utilities::duration_explode($this->timeallowed);
        $this->timeallowednum = $timeallowed->num;
        $this->timeallowedperiod = $timeallowed->period;

        if($uniqueid) {
            $this->uniqueid = $uniqueid;
        } else {
            $this->uniqueid = rand();
        }

    }

    public function init_form_data($formnameprefix, $formdata) {

        $defaultlabel = $this->get_default_label();

        $this->id = $formdata->{$formnameprefix.'id'};
        $this->programid = $formdata->id;
        $this->contenttype = $formdata->{$formnameprefix.'contenttype'};
        $this->sortorder = $formdata->{$formnameprefix.'sortorder'};
        $this->label = isset($formdata->{$formnameprefix.'label'}) && ! empty($formdata->{$formnameprefix.'label'}) ? $formdata->{$formnameprefix.'label'} : $defaultlabel;
        $this->nextsetoperator = isset($formdata->{$formnameprefix.'nextsetoperator'}) ? $formdata->{$formnameprefix.'nextsetoperator'} : 0;
        $this->timeallowednum = $formdata->{$formnameprefix.'timeallowednum'};
        $this->timeallowedperiod = $formdata->{$formnameprefix.'timeallowedperiod'};
        $this->timeallowed = program_utilities::duration_implode($this->timeallowednum, $this->timeallowedperiod);
    }

    protected function get_completion_type_string() {

        switch($this->completiontype) {
        case COMPLETIONTYPE_ANY:
            $completiontypestr = get_string('or', 'local_program');
            break;
        case COMPLETIONTYPE_ALL:
            $completiontypestr = get_string('and', 'local_program');
            break;
        default:
            return false;
            break;
        }
        return $completiontypestr;
    }

    public function get_set_prefix() {
        return $this->uniqueid;
    }

    public function get_default_label() {
        return get_string('untitledset', 'local_program');
    }

    public function is_recurring() {
        return false;
    }

    public function check_course_action($action, $formdata) {
        return false;
    }

    public function save_set() {

        // Make sure the course set is saved with a sensible label instead of the default
        if ($this->label == $this->get_default_label()) {
            $this->label = get_string('legend:courseset', 'local_program', $this->sortorder);
        }

        if($this->id > 0) { // if this set already exists in the database
            return update_record('prog_courseset', $this);
        } else {
            if($id = insert_record('prog_courseset', $this)) {
                $this->id = $id;
                return true;
            }
            return false;
        }
    }

    /**
     * Returns true or false depending on whether or not this course set
     * contains the specified course
     *
     * @param int $courseid
     * @return bool
     */
    abstract public function contains_course($courseid);

    /**
     * Checks whether or not the specified user has completed all the criteria
     * necessary to complete this course set and adds a record to the database
     * if so or returns false if not
     *
     * @param int $userid
     * @return int|bool
     */
    abstract public function check_courseset_complete($userid);

    /**
     * Updates the completion record in the database for the specified user
     *
     * @param int $userid
     * @param array $completionsettings Contains the field values for the record
     * @return bool|int
     */
    public function update_courseset_complete($userid, $completionsettings) {

        $eventtrigger = false;

        // if the course set is being marked as complete we need to trigger an
        // event to any listening modules
        if(array_key_exists('status', $completionsettings)) {
            if($completionsettings['status'] == STATUS_COURSESET_COMPLETE) {

                // flag that we need to trigger the courseset_completed event
                $eventtrigger = true;

                // set up the event data
                $eventdata = new stdClass();
                $eventdata->courseset = $this;
                $eventdata->userid = $userid;
            }
        }

        if($completion = get_record('prog_completion', 'coursesetid', $this->id, 'programid', $this->programid, 'userid', $userid)) {

            foreach($completionsettings as $key => $val) {
                $completion->$key = $val;
            }

            if($update_success = update_record('prog_completion', $completion)) {
                if($eventtrigger) {
                    // trigger an event to notify any listeners that this course
                    // set has been completed
                    events_trigger('program_courseset_completed', $eventdata);
                }
            }

            return $update_success;

        } else {

            $now = time();

            $completion = new stdClass();
            $completion->programid = $this->programid;
            $completion->userid = $userid;
            $completion->coursesetid = $this->id;
            $completion->status = STATUS_COURSESET_INCOMPLETE;
            $completion->timestarted = $now;
            $completion->timedue = 0;

            foreach($completionsettings as $key => $val) {
                $completion->$key = $val;
            }

            if($insert_success = insert_record('prog_completion', $completion)) {
                if($eventtrigger) {
                    // trigger an event to notify any listeners that this course
                    // set has been completed
                    events_trigger('program_courseset_completed', $eventdata);
                }
            }

            return $insert_success;
        }

    }

    /**
     * Returns true or false depending on whether or not the specified user has
     * completed this course set
     *
     * @param int $userid
     * @return bool
     */
    public function is_courseset_complete($userid) {
        if($completion_status = get_record('prog_completion', 'coursesetid', $this->id, 'programid', $this->programid, 'userid', $userid)) {
            if($completion_status->status == STATUS_COURSESET_COMPLETE) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Returns the HTML suitable for displaying a course set to a learner.
     *
     * @param int $userid
     * @param array $previous_sets
     * @param array $next_sets
     * @param bool $accessible Indicates whether or not the courses in the set are accessible to the user
     * @param bool $viewinganothersprogram Indicates if you are viewing another persons program
     *
     * @return string
     */
    abstract public function display($userid=null,$previous_sets=array(),$next_sets=array(),$accessible=true, $viewinganothersprogram=false);

    /**
     * Returns an HTML string suitable for displaying as the label for a course
     * set in the program overview form
     *
     * @return string
     */
    public function display_form_label() {

        $timeallowedob = program_utilities::duration_explode($this->timeallowed);
        $this->timeallowednum = $timeallowedob->num;
        $this->timeallowedperiod = $timeallowedob->period;
        $timeallowedperiodstr = $timeallowedob->periodstr;

        $out = '';
        $out .= $this->label.' ('.$this->timeallowednum.' '.$timeallowedperiodstr.')';

        return $out;
    }

    /**
     * Returns an HTML string suitable for displaying as the element body
     * for a course set in the program overview form
     *
     * @return string
     */
    abstract public function display_form_element();

    /**
     * This method must be overrideen by sub-classes
     *
     * @param bool $return
     * @return string
     */
    abstract public function print_set_minimal($return=false);

    /**
     * Defines the form elements for a course set
     *
     * @param <type> $mform
     * @param <type> $template_values
     * @param <type> $formdataobject
     * @param <type> $updateform
     */
    abstract public function get_courseset_form_template(&$mform, &$template_values, &$formdataobject, $updateform=true);

    public function print_nextsetoperator_select($prefix, $return=false) {
        $out = '';

        if(isset($this->islastset) && $this->islastset) {
            $out .= '<input type="hidden" name="'.$prefix.'nextsetoperator" value="0" />';
        } else {
            $out .= '<div>';
            $out .= '<label for="'.$prefix.'nextsetoperator">'.get_string('label:nextsetoperator', 'local_program').'</label>';
            $out .= '<select name="'.$prefix.'nextsetoperator" id="'.$prefix.'nextsetoperator">';
            $out .= '<option value="'.NEXTSETOPERATOR_THEN.'"'.($this->nextsetoperator==NEXTSETOPERATOR_THEN ? 'selected="selected"' : '').'>'.get_string('then', 'local_program').'</option>';
            $out .= '<option value="'.NEXTSETOPERATOR_OR.'"'.($this->nextsetoperator==NEXTSETOPERATOR_OR ? 'selected="selected"' : '').'>'.get_string('or', 'local_program').'</option>';
            $out .= '</select>';
            $out .= '</div>';
        }

        if($return) {
            return $out;
        } else {
            echo $out;
        }
    }

    public function get_nextsetoperator_select_form_template(&$mform, &$template_values, $formdataobject, $prefix, $updateform=true) {
        $templatehtml = '';
        $hidden = false;

        if($updateform) {
            if(isset($this->islastset) && $this->islastset) {
                $hidden = true;
                $mform->addElement('hidden', $prefix.'nextsetoperator', 0);
            } else {
                $options = array(
                    NEXTSETOPERATOR_THEN => get_string('then', 'local_program'),
                    NEXTSETOPERATOR_OR => get_string('or', 'local_program')
                );
                $mform->addElement('select', $prefix.'nextsetoperator', get_string('label:nextsetoperator', 'local_program'), $options);
            }

            $mform->setType($prefix.'nextsetoperator', PARAM_INT);
            $template_values['%'.$prefix.'nextsetoperator%'] = array('name'=>$prefix.'nextsetoperator', 'value'=>null);
        }

        $operatorclass = $hidden ? '' : ($this->nextsetoperator == NEXTSETOPERATOR_THEN ? 'nextsetoperator-then' : 'nextsetoperator-or');
        $templatehtml .= '<div class="'.$operatorclass.'">%'.$prefix.'nextsetoperator%</div>'."\n";
        $formdataobject->{$prefix.'nextsetoperator'} = $this->nextsetoperator;

        return $templatehtml;

    }

    protected function get_courseset_divider_text($previous_sets=array(), $next_sets=array(), $userid=0, $viewinganothersprogram=false) {
        $out = '';

        // If this divider is inside an OR group
        if ($previous_sets[count($previous_sets)-1]->nextsetoperator == NEXTSETOPERATOR_OR) {
            $sets = array();

            // Get the OR's above..
            for ($i = count($previous_sets)-1; $i > -1; $i--) {
                if ($previous_sets[$i]->nextsetoperator == NEXTSETOPERATOR_THEN) {
                    break;
                }
                $sets[] = $this->get_course_text($previous_sets[$i]);
            }
            $sets = array_reverse($sets);

            // Get the OR's below..
            for ($i = 0; $i < count($next_sets); $i++) {
                $sets[] = $this->get_course_text($next_sets[$i]);
                if ($next_sets[$i]->nextsetoperator != NEXTSETOPERATOR_OR) {
                    break;
                }
            }

            if ($viewinganothersprogram) {
                if (!$user = get_record('user', 'id', $userid)) {
                    print_error('error:invaliduser', 'local_program');
                }
                $out .= fullname($user) . ' ' . get_string('youmustcompleteormanager','local_program',implode(' or ', $sets));
            } else {
                if ($userid) {
                    $out .= get_string('youmustcompleteorlearner','local_program',implode(' or ', $sets));
                } else {
                    $out .= get_string('youmustcompleteorviewing','local_program',implode(' or ', $sets));
                }
            }
        }
        else {
            $a = new stdClass();

            // If there is an OR set above us..
            if (isset($previous_sets[count($previous_sets)-2]) && $previous_sets[count($previous_sets)-2]->nextsetoperator == NEXTSETOPERATOR_OR) { // If set two above is using OR
                $sets = array($this->get_course_text($previous_sets[count($previous_sets)-1]));
                for ($i = count($previous_sets)-2; $i > -1; $i--) {
                    if ($previous_sets[$i]->nextsetoperator == NEXTSETOPERATOR_THEN) {
                        break;
                    }
                    $sets[] = $this->get_course_text($previous_sets[$i]);
                }
                $sets = array_reverse($sets);
                $a->mustcomplete = implode(' or ', $sets);
            }
            else {
                $a->mustcomplete = $this->get_course_text($previous_sets[count($previous_sets)-1]);
            }

            // If there is an OR set below us..
            if (isset($next_sets[0]) && $next_sets[0]->nextsetoperator == NEXTSETOPERATOR_OR) { // If the below set is using OR
                $sets = array();
                for ($i = 0; $i < count($next_sets); $i++) {
                    $sets[] = $this->get_course_text($next_sets[$i]);
                    if ($next_sets[$i]->nextsetoperator != NEXTSETOPERATOR_OR) {
                        break;
                    }
                }
                $a->proceedto = implode(' or ', $sets);
            }
            else if (isset($next_sets[0])) {
                $a->proceedto = $this->get_course_text($next_sets[0]);
            }
            if ($viewinganothersprogram) {
                if (!$user = get_record('user', 'id', $userid)) {
                    print_error('error:invaliduser', 'local_program');
                }
                $out .= fullname($user) . ' ' . get_string('youmustcompletebeforeproceedingtomanager', 'local_program', $a);
            } else {
                if ($userid) {
                    $out .= get_string('youmustcompletebeforeproceedingtolearner', 'local_program', $a);
                } else {
                    $out .= get_string('youmustcompletebeforeproceedingtoviewing', 'local_program', $a);
                }
            }
        }
        return $out;
    }

    /**
     * Returns text such as 'all courses from Course set 1'
     */
    abstract public function get_course_text($courseset);

}

class multi_course_set extends course_set {

    public $courses, $courses_deleted_ids;

    public function __construct($programid, $setob=null, $uniqueid=null) {

        parent::__construct($programid, $setob, $uniqueid);

        $this->contenttype = CONTENTTYPE_MULTICOURSE;
        $this->courses = array();
        $this->courses_deleted_ids = array();

        if(is_object($setob)) {
            if($courseset_courses = get_records('prog_courseset_course', 'coursesetid', $this->id)) {
                foreach($courseset_courses as $courseset_course) {
                    $course = get_record('course', 'id', $courseset_course->courseid);
                    if (!$course) { // if the course has been deleted before being removed from the program we remove it from the course set
                        delete_records('prog_courseset_course', 'id', $courseset_course->id);
                    } else {
                        $this->courses[] = $course;
                    }
                }
            }
        }

    }

    public function init_form_data($formnameprefix, $formdata) {

        parent::init_form_data($formnameprefix, $formdata);

        $this->completiontype = $formdata->{$formnameprefix.'completiontype'};

        if(isset($formdata->{$formnameprefix.'courses'})) {
            $courseids = explode(',', $formdata->{$formnameprefix.'courses'});
            foreach($courseids as $courseid) {
                if($courseid && $course = get_record('course', 'id', $courseid)) {
                    $this->courses[] = $course;
                }
            }
        }

        $this->courses_deleted_ids = $this->get_deleted_courses($formdata);

    }

    /**
     * Retrieves the ids of any deleted courses for this course set from the
     * submitted data and returns an array containing the course id numbers
     * or an empty array
     *
     * @param <type> $formdata
     * @return <type>
     */
    public function get_deleted_courses($formdata) {

        $prefix = $this->get_set_prefix();

        if( ! isset($formdata->{$prefix.'deleted_courses'}) || empty($formdata->{$prefix.'deleted_courses'})) {
            return array();
        }
        return explode(',', $formdata->{$prefix.'deleted_courses'});
    }

    public function check_course_action($action, $formdata) {

        $prefix = $this->get_set_prefix();

        foreach($this->courses as $course) {
            if(isset($formdata->{$prefix.$action.'_'.$course->id})) {
                return $course->id;
            }
        }
        return false;
    }

    public function save_set() {

        // Make sure the course set is saved with a sensible label instead of the default
        if ($this->label == $this->get_default_label()) {
            $this->label = get_string('legend:courseset', 'local_program', $this->sortorder);
        }

        if($this->id == 0) { // if this set doesn't already exist in the database
            if( ! $id = insert_record('prog_courseset', $this)) {
                return false;
            }

            $this->id = $id;
        } else {
            if( ! update_record('prog_courseset', $this)) {
                return false;
            }
        }

        return $this->save_courses();
    }

    public function save_courses() {

        if( ! $this->id) {
            return false;
        }

        // first delete any courses from the database that have been marked for deletion
        foreach($this->courses_deleted_ids as $courseid) {
            if($courseset_course = get_record('prog_courseset_course', 'coursesetid', $this->id, 'courseid', $courseid)) {
                if( ! delete_records('prog_courseset_course', 'coursesetid', $this->id, 'courseid', $courseid)) {
                    return false;
                }
            }
        }

        // then add any new courses
        foreach($this->courses as $course) {
            if( ! $ob = get_record('prog_courseset_course', 'coursesetid', $this->id, 'courseid', $course->id)) {
                $ob = new stdClass();
                $ob->coursesetid = $this->id;
                $ob->courseid = $course->id;
                if( ! insert_record('prog_courseset_course', $ob)) {
                    return false;
                }
            }
        }
        return true;
    }

    public function add_course($formdata) {

        $courseid_elementname = $this->get_set_prefix().'courseid';

        if(isset($formdata->$courseid_elementname)) {
            $courseid = $formdata->$courseid_elementname;
            if($course = get_record('course', 'id', $courseid)) {
                $this->courses[] = $course;
                return true;
            }
        }
        return false;
    }

    public function delete_course($courseid) {

        $new_courses = array();
        $coursefound = false;

        foreach($this->courses as $course) {
            if($course->id != $courseid) {
                $new_courses[] = $course;
            } else {
                if($courseset_course = get_record('prog_courseset_course', 'coursesetid', $this->id, 'courseid', $course->id)) {
                    $this->courses_deleted_ids[] = $course->id;
                }
                $coursefound = true;
            }
        }

        if($coursefound) {
            $this->courses = $new_courses;
            return true;
        } else {
            return false;
        }
    }

    /**
     * Returns true or false depending on whether or not this course set
     * contains the specified course
     *
     * @param int $courseid
     * @return bool
     */
    public function contains_course($courseid) {

        $courses = $this->courses;

        foreach($courses as $course) {
            if($course->id == $courseid) {
                return true;
            }
        }

        return false;
    }

    /**
     * Checks whether or not the specified user has completed all the criteria
     * necessary to complete this course set and adds a record to the database
     * if so or returns false if not
     *
     * @param int $userid
     * @return int|bool
     */
    public function check_courseset_complete($userid) {

        $courses = $this->courses;
        $completiontype = $this->completiontype;

        // check that the course set contains at least one course
        if( ! count($courses)) {
            return false;
        }

        foreach($courses as $course) {

            $set_completed = false;

            // create a new completion object for this course
            $completion_info = new completion_info($course);

            // check if the course is complete
            if($completion_info->is_course_complete($userid)) {
                if($completiontype==COMPLETIONTYPE_ANY) {
                    $completionsettings = array(
                        'status'        => STATUS_COURSESET_COMPLETE,
                        'timecompleted' => time()
                    );
                    return $this->update_courseset_complete($userid, $completionsettings);
                }
            } else {
                // if all courses must be completed for this ourse set to be complete
                if($completiontype==COMPLETIONTYPE_ALL) {
                    return false;
                }
            }
        }

        // if processing reaches here and all courses in this set must be comleted then the course set is complete
        if($completiontype==COMPLETIONTYPE_ALL) {
            $completionsettings = array(
                'status'        => STATUS_COURSESET_COMPLETE,
                'timecompleted' => time()
            );
            return $this->update_courseset_complete($userid, $completionsettings);
        }

        return false;
    }

    public function display($userid=null,$previous_sets=array(),$next_sets=array(),$accessible=true, $viewinganothersprogram=false) {
        global $CFG;

        $out = '';
        $out .= '<fieldset>';
        $out .= '<legend>'.$this->label.'</legend>';

        switch($this->completiontype) {
        case COMPLETIONTYPE_ALL:
            $out .= '<p><strong>'.get_string('completeallcourses', 'local_program').'</strong></p>';
            break;
        case COMPLETIONTYPE_ANY:
            $out .= '<p><strong>'.get_string('completeanycourse', 'local_program').'</strong></p>';
            break;
        }

        $timeallowance = program_utilities::duration_explode($this->timeallowed);

        $out .= '<p>'.get_string('allowtimeforset', 'local_program', $timeallowance).'</p>';

        if(count($this->courses) > 0) {
            $table = new stdClass();
            $table->head = array(get_string('coursename', 'local_program'));
            if($userid) {
                $table->head[] = get_string('status', 'local_program');
            }

            $table->data = array();
            foreach($this->courses as $course) {

                $row = array();

                $coursedetails = '<img src="'.$CFG->wwwroot.'/local/icon/icon.php?icon='.$course->icon.'&amp;id='.$course->id.'&amp;size=small&amp;type=course" class="course_icon" />';
                $coursedetails .= $accessible ? '<a href="'.$CFG->wwwroot.'/course/view.php?id='.$course->id.'">'.$course->fullname.'</a>' : $course->fullname;

                if ($accessible) {
                    $launch = '<div class="prog-course-launch">' . print_single_button($CFG->wwwroot.'/course/view.php', array('id' => $course->id), get_string('launchcourse', 'local_program'), null, null, true) . '</div>';
                } else {
                    $launch = '<div class="prog-course-launch">' . print_single_button(null, null, get_string('notavailable', 'local_program'), null, null, true, null, true) . '</div>';
                }

                $row[] = $coursedetails . $launch;

                if($userid) {
                    if( ! $status = get_field('course_completions', 'status', 'userid', $userid, 'course', $course->id)) {
                        $status = COMPLETION_STATUS_NOTYETSTARTED;
                    }
                    $row[] = totara_display_course_progress_icon($userid, $course->id, $status);
                }

                $table->data[] = $row;
            }
            $out .= print_table($table, true);
        } else {
            $out .= '<p>'.get_string('nocourses', 'local_program').'</p>';
        }

        $out .= '</fieldset>';

        if ( ! isset($this->islastset) || $this->islastset===false) {
            switch($this->nextsetoperator) {
            case NEXTSETOPERATOR_THEN:
                $out .= '<div class="nextsetoperator">';
                $out .= '<p class="operator-then">'.get_string('then', 'local_program').'</p>';
                $out .= '<p class="nextsethelp">'. $this->get_courseset_divider_text($previous_sets, $next_sets, $userid, $viewinganothersprogram) .'</p>';
                $out .= '</div>';
                break;
            case NEXTSETOPERATOR_OR:
                $out .= '<div class="nextsetoperator">';
                $out .= '<p class="operator-or">'.get_string('or', 'local_program').'</p>';
                $out .= '<p class="nextsethelp">'. $this->get_courseset_divider_text($previous_sets, $next_sets, $userid, $viewinganothersprogram) .'</p>';
                $out .= '</div>';
                break;
            }
        }

        return $out;

    }

    /**
     * Returns an HTML string suitable for displaying as the element body
     * for a course set in the program overview form
     *
     * @return string
     */
    public function display_form_element() {

        $completiontypestr = $this->completiontype == COMPLETIONTYPE_ALL ? get_string('and', 'local_program') : get_string('or', 'local_program');
        $courses = $this->courses;

        $out = '';
        $out .= '<div class="courseset">';
        $out .= '<div class="courses">';

        if(count($courses)) {
            $coursestr = '';
            foreach($courses as $course) {
                $coursestr .= $course->fullname.' '.$completiontypestr.' ';
            }
            $coursestr = trim($coursestr);
            $coursestr = rtrim($coursestr, $completiontypestr);
            $out .= $coursestr;
        } else {
            $out .= get_string('nocourses', 'local_program');
        }

        $out .= '</div>';

        if ( ! isset($this->islastset) || $this->islastset===false) {
            if($this->nextsetoperator != 0) {
                $out .= '<div class="nextsetoperator">';
                $operatorstr = $this->nextsetoperator == NEXTSETOPERATOR_THEN ? get_string('then', 'local_program') : get_string('or', 'local_program');
                $out .= $operatorstr;
                $out .= '</div>';
            }
        }

        $out .= '</div>';

        return $out;
    }

    public function print_set_minimal($return=false) {

        $prefix = $this->get_set_prefix();

        $out = '';

        $out .= '<input type="hidden" name="'.$prefix.'id" value="'.$this->id.'" />';
        $out .= '<input type="hidden" name="'.$prefix.'sortorder" value="'.$this->sortorder.'" />';
        $out .= '<input type="hidden" name="'.$prefix.'contenttype" value="'.$this->contenttype.'" />';
        $out .= '<input type="hidden" name="'.$prefix.'completiontype" value="'.COMPLETIONTYPE_ALL.'" />';
        $out .= '<input type="hidden" name="'.$prefix.'label" value="" />';
        $out .= '<input type="hidden" name="'.$prefix.'nextsetoperator" value="" />';
        $out .= '<input type="hidden" name="'.$prefix.'timeallowedperiod" value="'.TIME_SELECTOR_DAYS.'" />';
        $out .= '<input type="hidden" name="'.$prefix.'timeallowednum" value="1" />';

        if(isset($this->courses) && is_array($this->courses) && count($this->courses)>0) {
            $courseidsarray = array();
            foreach($this->courses as $course) {
                $courseidsarray[] = $course->id;
            }
            $out .= '<input type="hidden" name="'.$prefix.'courses" value="'.implode(',', $courseidsarray).'" />';

        } else {
            $out .= '<input type="hidden" name="'.$prefix.'courses" value="" />';
        }

        if($return) {
            return $out;
        } else {
            echo $out;
        }
    }

    public function print_courses($return=false) {
        global $CFG;

        $prefix = $this->get_set_prefix();

        $out = '';
        $out .= get_string('courses', 'local_program').':<br />';
        if(isset($this->courses) && is_array($this->courses) && count($this->courses)>0) {

            if( ! $completiontypestr = $this->get_completion_type_string()) {
                print_error('Unrecognised completion type for course set '.$this->sortorder);
            }

            $out .= '<table id="'.$prefix.'coursetable" class="course_table">';
            $firstcourse = true;
            foreach($this->courses as $course) {
                $out .= '<tr>';
                if($firstcourse) {
                    $out .= '<td class="operator">&nbsp;</td>';
                    $firstcourse = false;
                } else {
                    $out .= '<td class="operator">'.$completiontypestr.'</td>';
                }
                $deleteimg = '<img src="'.$CFG->pixpath.'/t/delete.gif">';
                $out .= '<td class="course"><div class="delete_item">'.$course->fullname.'<a href="#" class="coursedeletelink" onclick="return deleteCourse('.$this->id.', '.$prefix.', '.$course->id.')">'.$deleteimg.'</a></div></td>';
                $out .= '</tr>';
            }
            $out .= '</table>';

            $courseidsarray = array();
            foreach($this->courses as $course) {
                $courseidsarray[] = $course->id;
            }
            $out .= '<input type="hidden" name="'.$prefix.'courses" value="'.implode(',', $courseidsarray).'" />';

        } else {
            $out .= '<p>'.get_string('nocourses', 'local_program').'</p>';
            $out .= '<input type="hidden" name="'.$prefix.'courses" value="" />';
        }

        if($return) {
            return $out;
        } else {
            echo $out;
        }
    }

    public function print_deleted_courses($return=false) {

        $prefix = $this->get_set_prefix();

        $out = '';
        $deletedcourseidsarray = array();

        if($this->courses_deleted_ids) {
            foreach($this->courses_deleted_ids as $deleted_course_id) {
                $deletedcourseidsarray[] = $deleted_course_id;
            }
        }

        $deletedcoursesstr = implode(',', $deletedcourseidsarray);
        $out .= '<input type="hidden" name="'.$prefix.'deleted_courses" value="'.$deletedcoursesstr.'" />';

        if($return) {
            return $out;
        } else {
            echo $out;
        }
    }

    /**
     * Defines the form elements for a course set
     *
     * @param <type> $mform
     * @param <type> $template_values
     * @param <type> $formdataobject
     * @param <type> $updateform
     * @return <type>
     */
    public function get_courseset_form_template(&$mform, &$template_values, &$formdataobject, $updateform=true) {

        $prefix = $this->get_set_prefix();

        $templatehtml = '';
        $templatehtml .= '<fieldset id="'.$prefix.'" class="course_set">';

        $helpbutton = helpbutton('multicourseset', get_string('legend:courseset', 'local_program'), 'local_program', true, false, '', true);
        $templatehtml .= '<legend>'.((isset($this->label) && ! empty($this->label)) ? stripslashes($this->label) : get_string('untitledset', 'local_program', $this->sortorder)).' '.$helpbutton.'</legend>';

        // Add set buttons
        $templatehtml .= '<div class="setbuttons">';

        // Add the move up button for this seit
        if($updateform) {
            $attributes = array();
            $attributes['class'] = isset($this->isfirstset) ? 'fieldsetbutton disabled' : 'fieldsetbutton';
            if(isset($this->isfirstset)) $attributes['disabled'] = 'disabled';
            $mform->addElement('submit', $prefix.'moveup', get_string('moveup', 'local_program'), $attributes);
            $template_values['%'.$prefix.'moveup%'] = array('name'=>$prefix.'moveup', 'value'=>null);
            $templatehtml .= '%'.$prefix.'moveup%'."\n";

            // Add the move down button for this set
            $attributes = array();
            $attributes['class'] = isset($this->islastset) ? 'fieldsetbutton disabled' : 'fieldsetbutton';
            if(isset($this->islastset)) $attributes['disabled'] = 'disabled';
            $mform->addElement('submit', $prefix.'movedown', get_string('movedown', 'local_program'), $attributes);
            $template_values['%'.$prefix.'movedown%'] = array('name'=>$prefix.'movedown', 'value'=>null);
            $templatehtml .= '%'.$prefix.'movedown%'."\n";

            // Add the delete button for this set
            $mform->addElement('submit', $prefix.'delete', get_string('delete', 'local_program'), array('class'=>"fieldsetbutton setdeletebutton"));
            $template_values['%'.$prefix.'delete%'] = array('name'=>$prefix.'delete', 'value'=>null);
            $templatehtml .= '%'.$prefix.'delete%'."\n";
        }

        $templatehtml .= '</div>';


        // Add the course set id
        if($updateform) {
            $mform->addElement('hidden', $prefix.'id', $this->id);
            $mform->setType($prefix.'id', PARAM_INT);
            $mform->setConstant($prefix.'id', $this->id);
            $template_values['%'.$prefix.'id%'] = array('name'=>$prefix.'id', 'value'=>null);
        }
        $templatehtml .= '%'.$prefix.'id%'."\n";
        $formdataobject->{$prefix.'id'} = $this->id;

        // Add the course set sort order
        if($updateform) {
            $mform->addElement('hidden', $prefix.'sortorder', $this->sortorder);
            $mform->setType($prefix.'sortorder', PARAM_INT);
            $mform->setConstant($prefix.'sortorder', $this->sortorder);
            $template_values['%'.$prefix.'sortorder%'] = array('name'=>$prefix.'sortorder', 'value'=>null);
        }
        $templatehtml .= '%'.$prefix.'sortorder%'."\n";
        $formdataobject->{$prefix.'sortorder'} = $this->sortorder;

        // Add the course set content type
        if($updateform) {
            $mform->addElement('hidden', $prefix.'contenttype', $this->contenttype);
            $mform->setType($prefix.'contenttype', PARAM_INT);
            $mform->setConstant($prefix.'contenttype', $this->contenttype);
            $template_values['%'.$prefix.'contenttype%'] = array('name'=>$prefix.'contenttype', 'value'=>null);
        }
        $templatehtml .= '%'.$prefix.'contenttype%'."\n";
        $formdataobject->{$prefix.'contenttype'} = $this->contenttype;

        // Add the list of deleted courses
        $templatehtml .= '<div id="'.$prefix.'deletedcourseslist">';
        $templatehtml .= $this->get_deleted_courses_form_template($mform, $template_values, $formdataobject, $updateform);
        $templatehtml .= '</div>';

        // Add the course set label
        if($updateform) {
            $mform->addElement('text', $prefix.'label', $this->label, array('size'=>'40', 'maxlength'=>'255'));
            $mform->setType($prefix.'label', PARAM_TEXT);
            //$mform->addRule($prefix.'label', get_string('required'), 'required', null, 'client');
            $template_values['%'.$prefix.'label%'] = array('name'=>$prefix.'label', 'value'=>null);
        }
        $helpbutton = helpbutton('setlabel', get_string('label:setname', 'local_program'), 'local_program', true, false, '', true);
        $templatehtml .= '<div>';
        $templatehtml .= '<div class="flabel"><label for="'.$prefix.'label">'.get_string('label:setname', 'local_program').' '.$helpbutton.'</label></div>';
        $templatehtml .= '<div class="fitem">%'.$prefix.'label%</div>';
        $templatehtml .= '</div>';
        $formdataobject->{$prefix.'label'} = $this->label;

        // Add the completion type drop down field
        if($updateform) {
            $completiontypeoptions = array(
                COMPLETIONTYPE_ANY => get_string('onecourse', 'local_program'),
                COMPLETIONTYPE_ALL => get_string('allcourses', 'local_program'),
            );
            $onchange = 'return changeCompletionTypeString(this, '.$prefix.');';
            $mform->addElement('select', $prefix.'completiontype', get_string('label:learnermustcomplete', 'local_program'), $completiontypeoptions, array('onchange'=>$onchange));
            $mform->setType($prefix.'completiontype', PARAM_INT);
            $mform->setDefault($prefix.'completiontype', COMPLETIONTYPE_ALL);
            $template_values['%'.$prefix.'completiontype%'] = array('name'=>$prefix.'completiontype', 'value'=>null);
        }
        $helpbutton = helpbutton('completiontype', get_string('label:learnermustcomplete', 'local_program'), 'local_program', true, false, '', true);
        $templatehtml .= '<div>';
        $templatehtml .= '<div class="flabel"><label for="'.$prefix.'completiontype">'.get_string('label:learnermustcomplete', 'local_program').' '.$helpbutton.'</label></div>';
        $templatehtml .= '<div class="fitem">%'.$prefix.'completiontype%</div>';
        $templatehtml .= '</div>';
        $formdataobject->{$prefix.'completiontype'} = $this->completiontype;

        // Add the time allowance selection group
        if($updateform) {
            $mform->addElement('text', $prefix.'timeallowednum', $this->timeallowednum, array('size'=>4, 'maxlength'=>3));
            $mform->setType($prefix.'timeallowednum', PARAM_INT);
            $mform->addRule($prefix.'timeallowednum', get_string('required'), 'nonzero', null, 'server');

            $timeallowanceoptions = program_utilities::get_standard_time_allowance_options();
            $mform->addElement('select', $prefix.'timeallowedperiod', '', $timeallowanceoptions);
            $mform->setType($prefix.'timeallowedperiod', PARAM_INT);

            $template_values['%'.$prefix.'timeallowednum%'] = array('name'=>$prefix.'timeallowednum', 'value'=>null);
            $template_values['%'.$prefix.'timeallowedperiod%'] = array('name'=>$prefix.'timeallowedperiod', 'value'=>null);
        }
        $helpbutton = helpbutton('timeallowance', get_string('label:timeallowance', 'local_program'), 'local_program', true, false, '', true);
        $templatehtml .= '<div>';
        $templatehtml .= '<div class="flabel"><label for="'.$prefix.'timeallowance">'.get_string('label:timeallowance', 'local_program').' '.$helpbutton.'</label></div>';
        $templatehtml .= '<div class="fitem">%'.$prefix.'timeallowednum% %'.$prefix.'timeallowedperiod%</div>';
        $templatehtml .= '</div>';
        $formdataobject->{$prefix.'timeallowednum'} = $this->timeallowednum;
        $formdataobject->{$prefix.'timeallowedperiod'} = $this->timeallowedperiod;

        // Add the list of courses for this set
        $templatehtml .= '<div id="'.$prefix.'courselist" class="courselist">';
        $templatehtml .= $this->get_courses_form_template($mform, $template_values, $formdataobject, $updateform);
        $templatehtml .= '</div>';

        // Add the 'Add course' drop down list
        $templatehtml .= '<div class="courseadder">';
        if($courseoptions = get_records_menu('course', '', '', 'fullname ASC', 'id,fullname')) {
            if($updateform) {
                $mform->addElement('select',  $prefix.'courseid', '', $courseoptions);
                $mform->addElement('submit', $prefix.'addcourse', get_string('addcourse', 'local_program'), array('onclick'=>"return amendCourses('$prefix')"));
                $template_values['%'.$prefix.'courseid%'] = array('name'=>$prefix.'courseid', 'value'=>null);
                $template_values['%'.$prefix.'addcourse%'] = array('name'=>$prefix.'addcourse', 'value'=>null);
            }
            $templatehtml .= '%'.$prefix.'courseid%'."\n";
            $templatehtml .= '%'.$prefix.'addcourse%'."\n";
        } else {
            $templatehtml .= '<p>'.get_string('nocoursestoadd', 'local_program').'</p>';
        }
        $templatehtml .= '</div>';


        /*$templatehtml .= '<div>';
        // Add the update button for this set
        if($updateform) {
            $mform->addElement('submit', $prefix.'update', get_string('update', 'local_program'), array('class'=>"fieldsetbutton updatebutton"));
            $template_values['%'.$prefix.'update%'] = array('name'=>$prefix.'update', 'value'=>null);
        }
        $templatehtml .= '%'.$prefix.'update%'."\n";



        $templatehtml .= '</div>';*/

        $templatehtml .= '</fieldset>';

        $templatehtml .= $this->get_nextsetoperator_select_form_template($mform, $template_values, $formdataobject, $prefix, $updateform);

        return $templatehtml;

    }

    /**
     * Defines the form elemens for the courses in a course set
     *
     * @param <type> $mform
     * @param <type> $template_values
     * @param <type> $formdataobject
     * @param <type> $updateform
     * @return <type>
     */
    public function get_courses_form_template(&$mform, &$template_values, &$formdataobject, $updateform=true) {
        global $CFG;

        $prefix = $this->get_set_prefix();

        $templatehtml = '';
        $templatehtml .= get_string('courses', 'local_program').':<br />';
        if(isset($this->courses) && is_array($this->courses) && count($this->courses)>0) {

            if( ! $completiontypestr = $this->get_completion_type_string()) {
                print_error('Unrecognised completion type for course set '.$this->sortorder);
            }

            $templatehtml .= '<table id="'.$prefix.'coursetable" class="course_table">';
            $firstcourse = true;
            foreach($this->courses as $course) {
                $templatehtml .= '<tr>';
                if($firstcourse) {
                    $templatehtml .= '<td class="operator">&nbsp;</td>';
                    $firstcourse = false;
                } else {
                    $templatehtml .= '<td class="operator operator'.$prefix.'">'.$completiontypestr.'</td>';
                }
                $deleteimg = '<img src="'.$CFG->pixpath.'/t/delete.gif">';
                $templatehtml .= '<td class="course"><div class="delete_item">'.$course->fullname.'<a href="#" class="coursedeletelink" onclick="return deleteCourse('.$this->id.', '.$prefix.', '.$course->id.')">'.$deleteimg.'</a></div></td>';
                $templatehtml .= '</tr>';
            }
            $templatehtml .= '</table>';

            $courseidsarray = array();
            foreach($this->courses as $course) {
                $courseidsarray[] = $course->id;
            }
            $coursesstr = implode(',', $courseidsarray);
            if($updateform) {
                $mform->addElement('hidden', $prefix.'courses', $coursesstr);
                $mform->setType($prefix.'courses', PARAM_SEQUENCE);
                $mform->setConstant($prefix.'courses', $coursesstr);
                $template_values['%'.$prefix.'courses%'] = array('name'=>$prefix.'courses', 'value'=>null);
            }
            $templatehtml .= '%'.$prefix.'courses%'."\n";
            $formdataobject->{$prefix.'courses'} = $coursesstr;

        } else {
            if($updateform) {
                $mform->addElement('hidden', $prefix.'courses');
                $mform->setType($prefix.'courses', PARAM_SEQUENCE);
                $mform->setConstant($prefix.'courses', '');
                $template_values['%'.$prefix.'courses%'] = array('name'=>$prefix.'courses', 'value'=>null);
            }
            $templatehtml .= '%'.$prefix.'courses%'."\n";
            $formdataobject->{$prefix.'courses'} = '';

            $templatehtml .= '<p>'.get_string('nocourses', 'local_program').'</p>';
        }

        return $templatehtml;

    }

    /**
     * Defines the form elements for the deleted courses
     *
     * @param <type> $mform
     * @param <type> $template_values
     * @param <type> $formdataobject
     * @param <type> $updateform
     * @return <type>
     */
    public function get_deleted_courses_form_template(&$mform, &$template_values, &$formdataobject, $updateform=true) {

        $prefix = $this->get_set_prefix();

        $templatehtml = '';
        $deletedcourseidsarray = array();

        if($this->courses_deleted_ids) {
            foreach($this->courses_deleted_ids as $deleted_course_id) {
                $deletedcourseidsarray[] = $deleted_course_id;
            }
        }

        $deletedcoursesstr = implode(',', $deletedcourseidsarray);
        if($updateform) {
            $mform->addElement('hidden', $prefix.'deleted_courses', $deletedcoursesstr);
            $mform->setType($prefix.'deleted_courses', PARAM_SEQUENCE);
            $mform->setConstant($prefix.'deleted_courses', $deletedcoursesstr);
            $template_values['%'.$prefix.'deleted_courses%'] = array('name'=>$prefix.'deleted_courses', 'value'=>null);
        }
        $templatehtml .= '%'.$prefix.'deleted_courses%'."\n";
        $formdataobject->{$prefix.'deleted_courses'} = $deletedcoursesstr;


        return $templatehtml;
    }

    public function get_course_text($courseset) {
        if ($courseset->completiontype == COMPLETIONTYPE_ALL) {
            return get_string('allcoursesfrom','local_program') . ' "' . format_string($courseset->label) . '"';
        }
        else {
            return get_string('onecoursesfrom','local_program') . ' "' . format_string($courseset->label) . '"';
        }
    }
}


class competency_course_set extends course_set {

    public function __construct($programid, $setob=null, $uniqueid=null) {
        parent::__construct($programid, $setob, $uniqueid);
        $this->contenttype = CONTENTTYPE_COMPETENCY;

        if(is_object($setob)) {
            // completiontype can change if the competency changes so we have to check it every time
            if( ! $this->completiontype = $this->get_completion_type()) {
                $this->completiontype = COMPLETIONTYPE_ALL;
            }
        }

    }

    public function init_form_data($formnameprefix, $formdata) {
        parent::init_form_data($formnameprefix, $formdata);

        $this->competencyid = $formdata->{$formnameprefix.'competencyid'};

        if( ! $this->completiontype = $this->get_completion_type()) {
            $this->completiontype = COMPLETIONTYPE_ALL;
        }
    }

    public function get_completion_type() {
        if( ! $competency = get_record('comp', 'id', $this->competencyid)) {
            return false;
        } else {
            return ($competency->aggregationmethod == COMPLETIONTYPE_ALL ? COMPLETIONTYPE_ALL : COMPLETIONTYPE_ANY);
        }
    }

    public function add_competency($formdata) {

        $competencyid_elementname = $this->get_set_prefix().'competencyid';

        if(isset($formdata->$competencyid_elementname)) {
            $competencyid = $formdata->$competencyid_elementname;
            if($competency = get_record('comp', 'id', $competencyid)) {
                $this->competencyid = $competency->id;
                $this->completiontype = $this->get_completion_type(); // completiontype can change if the competency changes so we have to check it every time
                return true;
            }
        }
        return false;
    }

    private function get_competency_courses() {
        global $CFG;

        $sql = "SELECT c.*
            FROM {$CFG->prefix}course AS c
            JOIN {$CFG->prefix}comp_evidence_items AS cei ON c.id = cei.iteminstance
            WHERE cei.competencyid = {$this->competencyid}
            AND cei.itemtype = 'coursecompletion'";

        return get_records_sql($sql);
    }

    /**
     * Returns true or false depending on whether or not this course set
     * contains the specified course
     *
     * @param int $courseid
     * @return bool
     */
    public function contains_course($courseid) {

        $courses = $this->get_competency_courses();

        if ($courses) {
            foreach ($courses as $course) {
                if($course->id == $courseid) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Checks whether or not the specified user has completed all the criteria
     * necessary to complete this course set and adds a record to the database
     * if so or returns false if not
     *
     * @param int $userid
     * @return int|bool
     */
    public function check_courseset_complete($userid) {

        $courses = $this->get_competency_courses();
        $completiontype = $this->get_completion_type();

        // check that the course set contains at least one course
        if( !$courses || !count($courses)) {
            return false;
        }

        foreach ($courses as $course) {

            $set_completed = false;

            // create a new completion object for this course
            $completion_info = new completion_info($course);

            // check if the course is complete
            if($completion_info->is_course_complete($userid)) {
                if($completiontype==COMPLETIONTYPE_ANY) {
                    $completionsettings = array(
                        'status'        => STATUS_COURSESET_COMPLETE,
                        'timecompleted' => time()
                    );
                    return $this->update_courseset_complete($userid, $completionsettings);
                }
            } else {
                // if all courses must be completed for this ourse set to be complete
                if($completiontype==COMPLETIONTYPE_ALL) {
                    return false;
                }
            }
        }

        // if processing reaches here and all courses in this set must be comleted then the course set is complete
        if($completiontype==COMPLETIONTYPE_ALL) {
            $completionsettings = array(
                'status'        => STATUS_COURSESET_COMPLETE,
                'timecompleted' => time()
            );
            return $this->update_courseset_complete($userid, $completionsettings);
        }

        return false;
    }

    public function display($userid=null,$previous_sets=array(),$next_sets=array(),$accessible=true, $viewinganothersprogram=false) {
        global $CFG;

        $out = '';
        $out .= '<fieldset>';
        $out .= '<legend>'.$this->label.'</legend>';

        switch($this->completiontype) {
        case COMPLETIONTYPE_ALL:
            $out .= '<p><strong>'.get_string('completeallcourses', 'local_program').'</strong></p>';
            break;
        case COMPLETIONTYPE_ANY:
            $out .= '<p><strong>'.get_string('completeanycourse', 'local_program').'</strong></p>';
            break;
        }

        $timeallowance = program_utilities::duration_explode($this->timeallowed);

        $out .= '<p>'.get_string('allowtimeforset', 'local_program', $timeallowance).'</p>';

        $courses = $this->get_competency_courses();

        if ($courses && count($courses) > 0) {
            $table = new stdClass();
            $table->head = array(get_string('coursename', 'local_program'), '');
            if($userid) {
                $table->head[] = get_string('status', 'local_program');
            }

            $table->data = array();;
            foreach($courses as $course) {

                $row = array();

                $coursedetails = '<img src="'.$CFG->wwwroot.'/local/icon/icon.php?icon='.$course->icon.'&amp;id='.$course->id.'&amp;size=small&amp;type=course" class="course_icon" />';
                $coursedetails .= $accessible ? '<a href="'.$CFG->wwwroot.'/course/view.php?id='.$course->id.'">'.$course->fullname.'</a>' : $course->fullname;
                $row[] = $coursedetails;

                if ($accessible) {
                    $launch = '<div class="prog-course-launch">' . print_single_button($CFG->wwwroot.'/course/view.php', array('id' => $course->id), get_string('launchcourse', 'local_program'), null, null, true) . '</div>';
                } else {
                    $launch = '<div class="prog-course-launch">' . print_single_button(null, null, get_string('notavailable', 'local_program'), null, null, true, null, true) . '</div>';
                }

                $row[] = $launch;

                if($userid) {
                    if( ! $status = get_field('course_completions', 'status', 'userid', $userid, 'course', $course->id)) {
                        $status = COMPLETION_STATUS_NOTYETSTARTED;
                    }
                    $row[] = totara_display_course_progress_icon($userid, $course->id, $status);
                }
                $table->data[] = $row;
            }
            $out .= print_table($table, true);
        } else {
            $out .= '<p>'.get_string('nocourses', 'local_program').'</p>';
        }

        $out .= '</fieldset>';

        if ( ! isset($this->islastset) || $this->islastset===false) {
            switch($this->nextsetoperator) {
            case NEXTSETOPERATOR_THEN:
                $out .= '<div class="nextsetoperator">';
                $out .= '<p class="operator-then">'.get_string('then', 'local_program').'</p>';
                $out .= '<p class="nextsethelp">'. $this->get_courseset_divider_text($previous_sets, $next_sets, $userid, $viewinganothersprogram) .'</p>';
                $out .= '</div>';
                break;
            case NEXTSETOPERATOR_OR:
                $out .= '<div class="nextsetoperator">';
                $out .= '<p class="operator-or">'.get_string('or', 'local_program').'</p>';
                $out .= '<p class="nextsethelp">'. $this->get_courseset_divider_text($previous_sets, $next_sets, $userid, $viewinganothersprogram) .'</p>';
                $out .= '</div>';
                break;
            }
        }

        return $out;

    }

    /**
     * Returns an HTML string suitable for displaying as the element body
     * for a course set in the program overview form
     *
     * @return string
     */
    public function display_form_element() {

        $completiontypestr = $this->get_completion_type() == COMPLETIONTYPE_ALL ? get_string('and', 'local_program') : get_string('or', 'local_program');
        $courses = $this->get_competency_courses();

        $out = '';
        $out .= '<div class="courseset">';
        $out .= '<div class="courses">';

        if ($courses && count($courses) > 0) {
            $coursestr = '';
            foreach($courses as $course) {
                $coursestr .= $course->fullname.' '.$completiontypestr.' ';
            }
            $coursestr = trim($coursestr);
            $coursestr = rtrim($coursestr, $completiontypestr);
            $out .= $coursestr;
        } else {
            $out .= get_string('nocourses', 'local_program');
        }

        $out .= '</div>';

        if($this->nextsetoperator != 0) {
            $out .= '<div class="nextsetoperator">';
            $operatorstr = $this->nextsetoperator == NEXTSETOPERATOR_THEN ? get_string('then', 'local_program') : get_string('or', 'local_program');
            $out .= $operatorstr;
            $out .= '</div>';
        }

        $out .= '</div>';

        return $out;
    }

    /**
     * Prints only the inputs required for this course set as hidden inputs.
     * This is used when a new set is created by javascript in the form so that
     * the new set values will be submitted when the form is submitted.
     *
     * @param <type> $return
     * @return <type>
     */
    public function print_set_minimal($return=false) {

        $prefix = $this->get_set_prefix();

        $out = '';
        $out .= '<input type="hidden" name="'.$prefix.'id" value="'.$this->id.'" />';
        $out .= '<input type="hidden" name="'.$prefix.'sortorder" value="'.$this->sortorder.'" />';
        $out .= '<input type="hidden" name="'.$prefix.'contenttype" value="'.$this->contenttype.'" />';
        $out .= '<input type="hidden" name="'.$prefix.'label" value="" />';
        $out .= '<input type="hidden" name="'.$prefix.'nextsetoperator" value="" />';
        $out .= '<input type="hidden" name="'.$prefix.'timeallowedperiod" value="'.TIME_SELECTOR_DAYS.'" />';
        $out .= '<input type="hidden" name="'.$prefix.'timeallowednum" value="1" />';

        if($this->competencyid > 0) {
            $out .= '<input type="hidden" name="'.$prefix.'competencyid" value="'.$this->competencyid.'" />';
        } else {
            $out .= '<input type="hidden" name="'.$prefix.'competencyid" value="0" />';
        }

        if($return) {
            return $out;
        } else {
            echo $out;
        }
    }

    /**
     * Defines the form elements for this course set and builds the template
     * in which the form will be rendered.
     *
     * @param <type> $mform
     * @param <type> $template_values
     * @param <type> $formdataobject
     * @param <type> $updateform
     * @return <type>
     */
    public function get_courseset_form_template(&$mform, &$template_values, &$formdataobject, $updateform=true) {

        $prefix = $this->get_set_prefix();

        $templatehtml = '';
        $templatehtml .= '<fieldset id="'.$prefix.'" class="course_set">';

        $helpbutton = helpbutton('competencycourseset', get_string('competency', 'local_program'), 'local_program', true, false, '', true);
        $templatehtml .= '<legend>'.((isset($this->label) && ! empty($this->label)) ? stripslashes($this->label) : get_string('legend:courseset', 'local_program', $this->sortorder)).' '.$helpbutton.'</legend>';

        $templatehtml .= '<div class="setbuttons">';

        // Add the move up button for this set
        if($updateform) {
            $attributes = array();
            $attributes['class'] = isset($this->isfirstset) ? 'fieldsetbutton disabled' : 'fieldsetbutton';
            if(isset($this->isfirstset)) $attributes['disabled'] = 'disabled';
            $mform->addElement('submit', $prefix.'moveup', get_string('moveup', 'local_program'), $attributes);
            $template_values['%'.$prefix.'moveup%'] = array('name'=>$prefix.'moveup', 'value'=>null);
        }
        $templatehtml .= '%'.$prefix.'moveup%'."\n";

        // Add the move down button for this set
        if($updateform) {
            $attributes = array();
            $attributes['class'] = isset($this->islastset) ? 'fieldsetbutton disabled' : 'fieldsetbutton';
            if(isset($this->islastset)) $attributes['disabled'] = 'disabled';
            $mform->addElement('submit', $prefix.'movedown', get_string('movedown', 'local_program'), $attributes);
            $template_values['%'.$prefix.'movedown%'] = array('name'=>$prefix.'movedown', 'value'=>null);
        }
        $templatehtml .= '%'.$prefix.'movedown%'."\n";

        // Add the delete button for this set
        if($updateform) {
            $mform->addElement('submit', $prefix.'delete', get_string('delete', 'local_program'), array('class'=>"fieldsetbutton setdeletebutton"));
            $template_values['%'.$prefix.'delete%'] = array('name'=>$prefix.'delete', 'value'=>null);
        }
        $templatehtml .= '%'.$prefix.'delete%'."\n";
        $templatehtml .= '</div>';

        // Add the course set id
        if($updateform) {
            $mform->addElement('hidden', $prefix.'id', $this->id);
            $mform->setType($prefix.'id', PARAM_INT);
            $mform->setConstant($prefix.'id', $this->id);
            $template_values['%'.$prefix.'id%'] = array('name'=>$prefix.'id', 'value'=>null);
        }
        $templatehtml .= '%'.$prefix.'id%'."\n";
        $formdataobject->{$prefix.'id'} = $this->id;

        // Add the course set sort order
        if($updateform) {
            $mform->addElement('hidden', $prefix.'sortorder', $this->sortorder);
            $mform->setType($prefix.'sortorder', PARAM_INT);
            $mform->setConstant($prefix.'sortorder', $this->sortorder);
            $template_values['%'.$prefix.'sortorder%'] = array('name'=>$prefix.'sortorder', 'value'=>null);
        }
        $templatehtml .= '%'.$prefix.'sortorder%'."\n";
        $formdataobject->{$prefix.'sortorder'} = $this->sortorder;

        // Add the course set content type
        if($updateform) {
            $mform->addElement('hidden', $prefix.'contenttype', $this->contenttype);
            $mform->setType($prefix.'contenttype', PARAM_INT);
            $mform->setConstant($prefix.'contenttype', $this->contenttype);
            $template_values['%'.$prefix.'contenttype%'] = array('name'=>$prefix.'contenttype', 'value'=>null);
        }
        $templatehtml .= '%'.$prefix.'contenttype%'."\n";
        $formdataobject->{$prefix.'contenttype'} = $this->contenttype;

        // Add the course set label
        if($updateform) {
            $mform->addElement('text', $prefix.'label', $this->label, array('size'=>'40', 'maxlength'=>'255'));
            $mform->setType($prefix.'label', PARAM_TEXT);
            $template_values['%'.$prefix.'label%'] = array('name'=>$prefix.'label', 'value'=>null);
        }
        $helpbutton = helpbutton('setlabel', get_string('label:setname', 'local_program'), 'local_program', true, false, '', true);
        $templatehtml .= '<div>';
        $templatehtml .= '<div class="flabel"><label for="'.$prefix.'label">'.get_string('label:setname', 'local_program').' '.$helpbutton.'</label></div>';
        $templatehtml .= '<div class="fitem">%'.$prefix.'label%</div>';
        $templatehtml .= '</div>';
        $formdataobject->{$prefix.'label'} = $this->label;

        if($this->competencyid > 0) {
            if($competency = get_record('comp', 'id', $this->competencyid)) {
                $templatehtml .= '<div>';
                $templatehtml .= '<div class="flabel"><label>'.get_string('label:competencyname', 'local_program').'</label></div>';
                $templatehtml .= '<div class="fitem"><p>'.$competency->fullname.'</p></div>';
                $templatehtml .= '</div>';
            }
        }

        // Add the time allowance selection group
        if($updateform) {

            $mform->addElement('text', $prefix.'timeallowednum', $this->timeallowednum, array('size'=>4, 'maxlength'=>3));
            $mform->setType($prefix.'timeallowednum', PARAM_INT);
            $mform->addRule($prefix.'timeallowednum', get_string('required'), 'required', null, 'server');

            $timeallowanceoptions = program_utilities::get_standard_time_allowance_options();
            $mform->addElement('select', $prefix.'timeallowedperiod', '', $timeallowanceoptions);
            $mform->setType($prefix.'timeallowedperiod', PARAM_INT);

            $template_values['%'.$prefix.'timeallowednum%'] = array('name'=>$prefix.'timeallowednum', 'value'=>null);
            $template_values['%'.$prefix.'timeallowedperiod%'] = array('name'=>$prefix.'timeallowedperiod', 'value'=>null);
        }
        $helpbutton = helpbutton('timeallowance', get_string('label:timeallowance', 'local_program'), 'local_program', true, false, '', true);
        $templatehtml .= '<div>';
        $templatehtml .= '<div class="flabel"><label for="'.$prefix.'timeallowance">'.get_string('label:timeallowance', 'local_program').' '.$helpbutton.'</label></div>';
        $templatehtml .= '<div class="fitem">%'.$prefix.'timeallowednum% %'.$prefix.'timeallowedperiod%</div>';
        $templatehtml .= '</div>';
        $formdataobject->{$prefix.'timeallowednum'} = $this->timeallowednum;
        $formdataobject->{$prefix.'timeallowedperiod'} = $this->timeallowedperiod;

        $templatehtml .= '<div id="'.$prefix.'courselist" class="courselist">';
        $templatehtml .= get_string('courses', 'local_program').':<br />';

        if($this->competencyid > 0) {

            if( ! $completiontypestr = $this->get_completion_type_string()) {
                print_error('Unrecognised completion type for course set '.$this->sortorder);
            }

            if($courses = $this->get_competency_courses()) {

                $templatehtml .= '<table id="'.$prefix.'coursetable" class="course_table">';
                $firstcourse = true;
                foreach($courses as $course) {
                    $templatehtml .= '<tr>';
                    if($firstcourse) {
                        $templatehtml .= '<td class="operator">&nbsp;</td>';
                        $firstcourse = false;
                    } else {
                        $templatehtml .= '<td class="operator">'.$completiontypestr.'</td>';
                    }
                    $templatehtml .= '<td class="course"><div class="course_item">'.$course->fullname.'</div></td>';
                    $templatehtml .= '</tr>';
                }
                $templatehtml .= '</table>';

            } else {
                $templatehtml .= '<p>'.get_string('nocourses', 'local_program').'</p>';
            }

            // Add the competency id element to the form
            if($updateform) {
                $mform->addElement('hidden', $prefix.'competencyid', $this->competencyid);
                $mform->setType($prefix.'competencyid', PARAM_INT);
                $template_values['%'.$prefix.'competencyid%'] = array('name'=>$prefix.'competencyid', 'value'=>null);
            }
            $templatehtml .= '%'.$prefix.'competencyid%'."\n";
            $formdataobject->{$prefix.'competencyid'} = $this->competencyid;

        } else { // if no competency has been added to this set yet

            if($course_competencies = get_records_menu('comp', '', '', 'fullname ASC', 'id,fullname')) {
                if($updateform) {
                    $mform->addElement('select',  $prefix.'competencyid', '', $course_competencies);
                    $mform->addElement('submit', $prefix.'addcompetency', get_string('addcompetency', 'local_program'));
                    $template_values['%'.$prefix.'competencyid%'] = array('name'=>$prefix.'competencyid', 'value'=>null);
                    $template_values['%'.$prefix.'addcompetency%'] = array('name'=>$prefix.'addcompetency', 'value'=>null);
                }
                $templatehtml .= '%'.$prefix.'competencyid%'."\n";
                $templatehtml .= '%'.$prefix.'addcompetency%'."\n";
            } else {
                // Add the competency id element to the form
                if($updateform) {
                    $mform->addElement('hidden', $prefix.'competencyid', 0);
                    $mform->setType($prefix.'competencyid', PARAM_INT);
                    $template_values['%'.$prefix.'competencyid%'] = array('name'=>$prefix.'competencyid', 'value'=>null);
                }
                $templatehtml .= '%'.$prefix.'competencyid%'."\n";
                $templatehtml .= '<p>'.get_string('nocompetenciestoadd', 'local_program').'</p>';
                $formdataobject->{$prefix.'competencyid'} = 0;
            }
        }

        $templatehtml .= '</div>';

        // Add the update button for this set
/*        if($updateform) {
            $mform->addElement('submit', $prefix.'update', get_string('update', 'local_program'), array('class'=>"fieldsetbutton updatebutton"));
            $template_values['%'.$prefix.'update%'] = array('name'=>$prefix.'update', 'value'=>null);
        }
$templatehtml .= '%'.$prefix.'update%'."\n";*/


        $templatehtml .= '</fieldset>';

        $templatehtml .= $this->get_nextsetoperator_select_form_template($mform, $template_values, $formdataobject, $prefix, $updateform);

        return $templatehtml;

    }


    public function get_course_text($courseset) {
        if ($courseset->completiontype == COMPLETIONTYPE_ALL) {
            return get_string('allcoursesfrom','local_program') . ' "' . format_string($courseset->label) . '"';
        }
        else {
            return get_string('onecoursesfrom','local_program') . ' "' . format_string($courseset->label) . '"';
        }
    }
}

class recurring_course_set extends course_set {

    public $recurrencetime, $recurrencetimenum, $recurrencetimeperiod;
    public $recurcreatetime, $recurcreatetimenum, $recurcreatetimeperiod;
    public $course;

    public function __construct($programid, $setob=null, $uniqueid=null) {

        parent::__construct($programid, $setob, $uniqueid);

        $this->contenttype = CONTENTTYPE_RECURRING;

        if(is_object($setob)) {
            if($courseset_course = get_record('prog_courseset_course', 'coursesetid', $this->id)) {
                $course = get_record('course', 'id', $courseset_course->courseid);
                if (!$course) {
                    delete_records('prog_courseset_course', 'id', $courseset_course->id);
                    $this->course = array();
                } else {
                    $this->course = $course;
                }
            }
            $recurrencetime = program_utilities::duration_explode($this->recurrencetime);
            $this->recurrencetimenum = $recurrencetime->num;
            $this->recurrencetimeperiod = $recurrencetime->period;
            $recurcreatetime = program_utilities::duration_explode($this->recurcreatetime);
            $this->recurcreatetimenum = $recurcreatetime->num;
            $this->recurcreatetimeperiod = $recurcreatetime->period;
        } else {
            $this->recurrencetimenum = 0;
            $this->recurrencetimeperiod = 0;
            $this->recurcreatetimenum = 0;
            $this->recurcreatetimeperiod = 0;
        }

    }

    public function init_form_data($formnameprefix, $data) {
        parent::init_form_data($formnameprefix, $data);

        $this->recurrencetimenum = $data->{$formnameprefix.'recurrencetimenum'};
        $this->recurrencetimeperiod = $data->{$formnameprefix.'recurrencetimeperiod'};
        $this->recurrencetime = program_utilities::duration_implode($this->recurrencetimenum, $this->recurrencetimeperiod);

        $this->recurcreatetimenum = $data->{$formnameprefix.'recurcreatetimenum'};
        $this->recurcreatetimeperiod = $data->{$formnameprefix.'recurcreatetimeperiod'};
        $this->recurcreatetime = program_utilities::duration_implode($this->recurcreatetimenum, $this->recurcreatetimeperiod);

        $courseid = $data->{$formnameprefix.'courseid'};
        if($course = get_record('course', 'id', $courseid)) {
            $this->course = $course;
        }

    }

    public function is_recurring() {
        return true;
    }

    public function save_set() {
        if(parent::save_set()) {
            return $this->save_course();
        } else {
            return false;
        }
    }

    public function save_course() {

        if( ! $this->id) {
            return false;
        }

        if( ! is_object($this->course)) {
            return false;
        }

        if($ob = get_record('prog_courseset_course', 'coursesetid', $this->id)) {
            if($this->course->id != $ob->courseid) {
                $ob->courseid = $this->course->id;
                return update_record('prog_courseset_course', $ob);
            }
        } else {
            $ob = new stdClass();
            $ob->coursesetid = $this->id;
            $ob->courseid = $this->course->id;
            return insert_record('prog_courseset_course', $ob);
        }

        return true;
    }

    /**
     * Returns true or false depending on whether or not this course set
     * contains the specified course
     *
     * @param int $courseid
     * @return bool
     */
    public function contains_course($courseid) {

        if($this->course->id == $courseid) {
            return true;
        }

        return false;
    }

    /**
     * Checks whether or not the specified user has completed all the criteria
     * necessary to complete this course set and adds a record to the database
     * if so or returns false if not
     *
     * @param int $userid
     * @return int|bool
     */
    public function check_courseset_complete($userid) {

        $course = $this->course;

        // create a new completion object for this course
        $completion_info = new completion_info($course);

        // check if the course is complete
        if($completion_info->is_course_complete($userid)) {
            $completionsettings = array(
                'status'        => STATUS_COURSESET_COMPLETE,
                'timecompleted' => time()
            );
            return $this->update_courseset_complete($userid, $completionsettings);
        }

        return false;
    }

    public function display($userid=null,$previous_sets=array(),$next_sets=array(),$accessible=true, $viewinganothersprogram=false) {
        global $CFG;

        $out = '';
        $out .= '<fieldset>';
        $out .= '<legend>'.format_string($this->label).'</legend>';

        $timeallowance = program_utilities::duration_explode($this->timeallowed);

        $out .= '<p>'.get_string('allowtimeforset', 'local_program', $timeallowance).'</p>';

        if(is_object($this->course)) {
            $table = new stdClass();
            $table->head = array(get_string('coursename', 'local_program'), '');
            if($userid) {
                $table->head[] = get_string('status', 'local_program');
            }

            $table->data = array();

            $course = $this->course;

            $row = array();

            $coursedetails = '<img src="'.$CFG->wwwroot.'/local/icon/icon.php?icon='.$course->icon.'&amp;id='.$course->id.'&amp;size=small&amp;type=course" class="course_icon" />';
            $coursedetails .= $accessible ? '<a href="'.$CFG->wwwroot.'/course/view.php?id='.$course->id.'">'.$course->fullname.'</a>' : $course->fullname;
            $row[] = $coursedetails;

            if ($accessible) {
                $launch = '<div class="prog-course-launch">' . print_single_button($CFG->wwwroot.'/course/view.php?id='.$course->id, null, get_string('launchcourse', 'local_program'), null, null, true) . '</div>';
            } else {
                $launch = '<div class="prog-course-launch">' . print_single_button(null, null, get_string('notavailable', 'local_program'), null, null, true, null, true) . '</div>';
            }

            $row[] = $launch;

            if($userid) {
                if( ! $status = get_field('course_completions', 'status', 'userid', $userid, 'course', $course->id)) {
                    $status = COMPLETION_STATUS_NOTYETSTARTED;
                }
                $row[] = totara_display_course_progress_icon($userid, $course->id, $status);
            }
            $table->data[] = $row;

            $out .= print_table($table, true);
        } else {
            $out .= '<p>'.get_string('nocourses', 'local_program').'</p>';
        }

        $out .= '</fieldset>';

        return $out;

    }

    /**
     * Returns an HTML string suitable for displaying as the element body
     * for a course set in the program overview form
     *
     * @return string
     */
    public function display_form_element() {
        return $this->course->fullname;
    }

    public function print_set_minimal($return=false) {

        $prefix = $this->get_set_prefix();

        $out = '';

        $out .= '<input type="hidden" name="'.$prefix.'id" value="'.$this->id.'" />';
        $out .= '<input type="hidden" name="'.$prefix.'label" value="'.$this->label.'" />';
        $out .= '<input type="hidden" name="'.$prefix.'courseid" value="'.(is_object($this->course) ? $this->course->id : 0).'" />';
        $out .= '<input type="hidden" name="'.$prefix.'sortorder" value="'.$this->sortorder.'" />';
        $out .= '<input type="hidden" name="'.$prefix.'contenttype" value="'.$this->contenttype.'" />';
        $out .= '<input type="hidden" name="'.$prefix.'recurrencetime" value="'.$this->recurrencetime.'" />';
        $out .= '<input type="hidden" name="'.$prefix.'nextsetoperator" value="'.$this->nextsetoperator.'" />';

        $out .= '<input type="hidden" name="'.$prefix.'timeallowedperiod" value="'.TIME_SELECTOR_DAYS.'" />';
        $out .= '<input type="hidden" name="'.$prefix.'timeallowednum" value="1" />';
        $out .= '<input type="hidden" name="'.$prefix.'recurrencetimeperiod" value="'.TIME_SELECTOR_DAYS.'" />';
        $out .= '<input type="hidden" name="'.$prefix.'recurrencetimenum" value="1" />';
        $out .= '<input type="hidden" name="'.$prefix.'recurcreatetimeperiod" value="'.TIME_SELECTOR_DAYS.'" />';
        $out .= '<input type="hidden" name="'.$prefix.'recurcreatetimenum" value="1" />';

        if($return) {
            return $out;
        } else {
            echo $out;
        }
    }

    public function get_courseset_form_template(&$mform, &$template_values, &$formdataobject, $updateform=true) {
        $prefix = $this->get_set_prefix();

        $templatehtml = '';
        $templatehtml .= '<fieldset id="'.$prefix.'" class="course_set">';

        $helpbutton = helpbutton('recurringcourseset', get_string('legend:recurringcourseset', 'local_program'), 'local_program', true, false, '', true);
        $templatehtml .= '<legend>'.((isset($this->label) && ! empty($this->label)) ? stripslashes($this->label) : get_string('legend:recurringcourseset', 'local_program', $this->sortorder)).' '.$helpbutton.'</legend>';

        // Recurring programs don't need a nextsetoperator property but we must
        // include it in the form to avoid any problems when the data is submitted
        $templatehtml .= '<input type="hidden" name="'.$prefix.'nextsetoperator" value="0" />';

        // Add the delete button for this set
        $templatehtml .= '<div class="setbuttons">';

        if($updateform) {
            $mform->addElement('submit', $prefix.'delete', get_string('delete', 'local_program'), array('class'=>"fieldsetbutton setdeletebutton"));
            $template_values['%'.$prefix.'delete%'] = array('name'=>$prefix.'delete', 'value'=>null);
        }
        $templatehtml .= '%'.$prefix.'delete%'."\n";
        $templatehtml .= '</div>';

        // Add the course set id
        if($updateform) {
            $mform->addElement('hidden', $prefix.'id', $this->id);
            $mform->setType($prefix.'id', PARAM_INT);
            $mform->setConstant($prefix.'id', $this->id);
            $template_values['%'.$prefix.'id%'] = array('name'=>$prefix.'id', 'value'=>null);
        }
        $templatehtml .= '%'.$prefix.'id%'."\n";
        $formdataobject->{$prefix.'id'} = $this->id;

        // Add the course set sort order
        if($updateform) {
            $mform->addElement('hidden', $prefix.'sortorder', $this->sortorder);
            $mform->setType($prefix.'sortorder', PARAM_INT);
            $mform->setConstant($prefix.'sortorder', $this->sortorder);
            $template_values['%'.$prefix.'sortorder%'] = array('name'=>$prefix.'sortorder', 'value'=>null);
        }
        $templatehtml .= '%'.$prefix.'sortorder%'."\n";
        $formdataobject->{$prefix.'sortorder'} = $this->sortorder;

        // Add the course set content type
        if($updateform) {
            $mform->addElement('hidden', $prefix.'contenttype', $this->contenttype);
            $mform->setType($prefix.'contenttype', PARAM_INT);
            $mform->setConstant($prefix.'contenttype', $this->contenttype);
            $template_values['%'.$prefix.'contenttype%'] = array('name'=>$prefix.'contenttype', 'value'=>null);
        }
        $templatehtml .= '%'.$prefix.'contenttype%'."\n";
        $formdataobject->{$prefix.'contenttype'} = $this->contenttype;

        // Add the course set label
        if($updateform) {
            $mform->addElement('text', $prefix.'label', $this->label, array('size'=>'40', 'maxlength'=>'255'));
            $mform->setType($prefix.'label', PARAM_TEXT);
            $template_values['%'.$prefix.'label%'] = array('name'=>$prefix.'label', 'value'=>null);
        }

        $helpbutton = helpbutton('setlabel', get_string('label:setname', 'local_program'), 'local_program', true, false, '', true);
        $templatehtml .= '<div>';
        $templatehtml .= '<div class="flabel"><label for="'.$prefix.'label">'.get_string('label:setname', 'local_program').' '.$helpbutton.'</label></div>';
        $templatehtml .= '<div class="fitem">%'.$prefix.'label%</div>';
        $templatehtml .= '</div>';
        $formdataobject->{$prefix.'label'} = $this->label;

        // Display the course name
        if(is_object($this->course)) {
            if(isset($this->course->fullname)) {
                $templatehtml .= '<div>';
                $templatehtml .= '<div class="flabel"><label>'.get_string('coursename', 'local_program').'</label></div>';
                $templatehtml .= '<div class="fitem"><input type="text" name="" disabled="disabled" value="'.format_string($this->course->fullname).'" /></div>';
                $templatehtml .= '</div>';
            }
        }

        // Add the time allowance selection group
        if($updateform) {
            $mform->addElement('text', $prefix.'timeallowednum', $this->timeallowednum, array('size'=>4, 'maxlength'=>3));
            $mform->setType($prefix.'timeallowednum', PARAM_INT);
            $mform->addRule($prefix.'timeallowednum', get_string('required'), 'nonzero', null, 'server');

            $timeallowanceoptions = program_utilities::get_standard_time_allowance_options();
            $mform->addElement('select', $prefix.'timeallowedperiod', '', $timeallowanceoptions);
            $mform->setType($prefix.'timeallowedperiod', PARAM_INT);

            $template_values['%'.$prefix.'timeallowednum%'] = array('name'=>$prefix.'timeallowednum', 'value'=>null);
            $template_values['%'.$prefix.'timeallowedperiod%'] = array('name'=>$prefix.'timeallowedperiod', 'value'=>null);
        }
        $helpbutton = helpbutton('timeallowance', get_string('label:timeallowance', 'local_program'), 'local_program', true, false, '', true);
        $templatehtml .= '<div>';
        $templatehtml .= '<div class="flabel"><label for="'.$prefix.'timeallowance">'.get_string('label:timeallowance', 'local_program').' '.$helpbutton.'</label></div>';
        $templatehtml .= '<div class="fitem">%'.$prefix.'timeallowednum% %'.$prefix.'timeallowedperiod%</div>';
        $templatehtml .= '</div>';
        $formdataobject->{$prefix.'timeallowednum'} = $this->timeallowednum;
        $formdataobject->{$prefix.'timeallowedperiod'} = $this->timeallowedperiod;

        // Add the recurrence period selection group
        if($updateform) {
            $mform->addElement('text', $prefix.'recurrencetimenum', $this->recurrencetimenum, array('size'=>4, 'maxlength'=>3));
            $mform->setType($prefix.'recurrencetimenum', PARAM_INT);
            $mform->addRule($prefix.'recurrencetimenum', get_string('required'), 'nonzero', null, 'server');

            $timeallowanceoptions = program_utilities::get_standard_time_allowance_options();
            $mform->addElement('select', $prefix.'recurrencetimeperiod', '', $timeallowanceoptions);
            $mform->setType($prefix.'recurrencetimeperiod', PARAM_INT);

            $template_values['%'.$prefix.'recurrencetimenum%'] = array('name'=>$prefix.'recurrencetimenum', 'value'=>null);
            $template_values['%'.$prefix.'recurrencetimeperiod%'] = array('name'=>$prefix.'recurrencetimeperiod', 'value'=>null);
        }
        $helpbutton = helpbutton('recurrence', get_string('label:recurrence', 'local_program'), 'local_program', true, false, '', true);
        $templatehtml .= '<div>';
        $templatehtml .= '<div class="flabel"><label for="'.$prefix.'recurrencetimenum">'.get_string('label:recurrence', 'local_program').' '.$helpbutton.'</label></div>';
        $templatehtml .= '<div class="fitem">'.get_string('repeatevery', 'local_program').' %'.$prefix.'recurrencetimenum% %'.$prefix.'recurrencetimeperiod%</div>';
        $templatehtml .= '</div>';
        $formdataobject->{$prefix.'recurrencetimenum'} = $this->recurrencetimenum;
        $formdataobject->{$prefix.'recurrencetimeperiod'} = $this->recurrencetimeperiod;

        // Add the recur create period selection group
        if($updateform) {
            $mform->addElement('text', $prefix.'recurcreatetimenum', $this->recurcreatetimenum, array('size'=>4, 'maxlength'=>3));
            $mform->setType($prefix.'recurcreatetimenum', PARAM_INT);
            $mform->addRule($prefix.'recurcreatetimenum', get_string('required'), 'nonzero', null, 'server');

            $timeallowanceoptions = program_utilities::get_standard_time_allowance_options();
            $mform->addElement('select', $prefix.'recurcreatetimeperiod', '', $timeallowanceoptions);
            $mform->setType($prefix.'recurcreatetimeperiod', PARAM_INT);

            $template_values['%'.$prefix.'recurcreatetimenum%'] = array('name'=>$prefix.'recurcreatetimenum', 'value'=>null);
            $template_values['%'.$prefix.'recurcreatetimeperiod%'] = array('name'=>$prefix.'recurcreatetimeperiod', 'value'=>null);
        }
        $helpbutton = helpbutton('coursecreation', get_string('label:recurcreation', 'local_program'), 'local_program', true, false, '', true);
        $templatehtml .= '<div>';
        $templatehtml .= '<div class="flabel"><label for="'.$prefix.'recurcreatetimenum">'.get_string('label:recurcreation', 'local_program').' '.$helpbutton.'</label></div>';
        $templatehtml .= '<div class="fitem">'.get_string('createcourse', 'local_program').' %'.$prefix.'recurcreatetimenum% %'.$prefix.'recurcreatetimeperiod% '.get_string('beforecourseends', 'local_program').'</div>';
        $templatehtml .= '</div>';
        $formdataobject->{$prefix.'recurcreatetimenum'} = $this->recurcreatetimenum;
        $formdataobject->{$prefix.'recurcreatetimeperiod'} = $this->recurcreatetimeperiod;

        // Add the 'Select course' drop down list
        $templatehtml .= '<div class="courseselector">';
        if($courseoptions = get_records_menu('course', '', '', 'fullname ASC', 'id,fullname')) {
            if($updateform) {
                $mform->addElement('select',  $prefix.'courseid', '', $courseoptions);
                $mform->addElement('submit', $prefix.'changecourse', get_string('changecourse', 'local_program'), array('onclick'=>"return selectRecurringCourse('$prefix')"));
                $template_values['%'.$prefix.'courseid%'] = array('name'=>$prefix.'courseid', 'value'=>null);
                $template_values['%'.$prefix.'changecourse%'] = array('name'=>$prefix.'changecourse', 'value'=>null);
            }
            $templatehtml .= '%'.$prefix.'courseid%'."\n";
            $templatehtml .= '%'.$prefix.'changecourse%'."\n";
            $templatehtml .= helpbutton('recurringcourse', get_string('changecourse', 'local_program'), 'local_program', true, false, '', true);
            $formdataobject->{$prefix.'courseid'} = $this->course->id;
        } else {
            $templatehtml .= '<p>'.get_string('nocoursestoselect', 'local_program').'</p>';
        }
        $templatehtml .= '</div>';

        $templatehtml .= '<div class="setbuttons">';

        // Add the update button for this set
        if($updateform) {
            $mform->addElement('submit', $prefix.'update', get_string('update', 'local_program'), array('class'=>"fieldsetbutton updatebutton"));
            $template_values['%'.$prefix.'update%'] = array('name'=>$prefix.'update', 'value'=>null);
        }
        $templatehtml .= '%'.$prefix.'update%'."\n";

        $templatehtml .= '</div>';

        $templatehtml .= '</fieldset>';

        return $templatehtml;
    }

    public function get_course_text($courseset) {
        if ($courseset->completiontype == COMPLETIONTYPE_ALL) {
            return get_string('allcoursesfrom','local_program') . ' "' . format_string($courseset->label) . '"';
        }
        else {
            return get_string('onecoursesfrom','local_program') . ' "' . format_string($courseset->label) . '"';
        }
    }
}
