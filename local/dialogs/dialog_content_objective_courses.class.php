<?php

/**
 * Devplan objective specific course dialog generator
 *
 * @copyright Totara Learning Solutions Limited
 * @author Aaron Barnes <aaronb@catalyst.net.nz>
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage dialogs
 */
require_once($CFG->dirroot.'/local/dialogs/dialog_content_courses.class.php');
require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->libdir.'/datalib.php');


class totara_dialog_objective_content_courses extends totara_dialog_content_courses {
    /**
     *
     * @access  public
     */
    public function __construct() {

    }
    /**
     * Load courses to display
     *
     * @access  public
     * planid integer - id of development plan for which linked courses should be loaded
     */
    public function load_courses($planid) {
        global $CFG;
        $sql = 'SELECT dppca.id as id, c.fullname as fullname, c.sortorder as sortorder ' .
                'FROM '. $CFG->prefix . 'dp_plan_course_assign dppca' .
                ' INNER JOIN ' . $CFG->prefix . 'course c ON c.id = dppca.courseid ' .
                'WHERE dppca.planid = ' . $planid;
        $courses = get_records_sql($sql);
        if (empty($courses)) {
            $this->courses = array();
        } else {
            $this->courses = $courses;
        }
    }
}
