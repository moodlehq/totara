<?php
/**
 * Block for displaying stats
 *
 * @package   totara
 * @copyright 2010 Totara Learning Solutions Ltd
 * @author    Dan Marsden <dan@catalyst.net.nz>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_totara_stats extends block_base {

    function init() {
        $this->title = get_string('blockname', 'block_totara_stats');
        $this->version = 2010111701;
        $this->cron = 20; //TODO: should schedule cron rather than using this var.
    }

    function preferred_width() {
        return 210;
    }

    function specialization() {

    }

    function get_content() {
        global $CFG, $USER;

        // Check if content is cached
        if($this->content !== NULL) {
            return $this->content;
        }

        $this->content = new stdClass;
        $this->content->text   = '';
        $this->content->footer = '';

        if ($this->instance_is_dashlet()) {
            require_once($CFG->dirroot.'/blocks/totara_stats/locallib.php');

            // get Role of user in this page.
            $sql = "SELECT r.shortname
                FROM {$CFG->prefix}dashb d
                INNER JOIN {$CFG->prefix}dashb_instance di ON d.id = di.dashb_id
                INNER JOIN {$CFG->prefix}role r on d.roleid = r.id
                WHERE di.id = {$this->instance->pageid}";       // The pageid is the dashb instance id
            $role = get_field_sql($sql);

            switch ($role) {
                case 'admin' :
                case 'administrator' :
                    $this->content->text   .= totara_stats_output(totara_stats_admin_stats($USER));
                    break;
                case 'manager' :
                    $this->content->text   .= totara_stats_output(totara_stats_manager_stats($USER));
                    break;
                case 'teacher' :
                case 'trainer' :
                case 'student' :
                default:
                    $this->content->text   .= totara_stats_output(totara_stats_user_stats($USER));
                    break;
            }
        }

        //TODO: get stuff from reminders/notifications.

        return $this->content;
    }

    function instance_allow_multiple() {
        return false;
    }


    function instance_config_save($data) {

    }


    /**
    * Determines whether the block instance is a dashlet, on a dashboard page
    * @return boolean
    **/
    function instance_is_dashlet() {
        return ($this->instance->pagetype == 'totara-dashboard' && $this->instance->position == 'c');
    }

    function cron() {
        global $CFG;
        //check if time to run cron
        //check last time this cron was run
        $lastrun = (int)get_config('block_totara_stats', 'cronlastrun');
        if (empty($lastrun)) {
            //set $lastrun to one month ago: (only process one month of historical stats)
            $lastrun = time() -(60*60*24*30);
        }
        $nextrun = time() + (24*60*60);
        if (time() < $nextrun or (empty($lastrun))) { //if 24 hours since last run
            require_once($CFG->dirroot.'/blocks/totara_stats/locallib.php');

            $stats = totara_stats_timespent($lastrun, $nextrun);
            foreach ($stats as $userid => $timespent) {
                //insert daily stat for each user returned above into new stats table for reading.
                totara_stats_add_event($nextrun, $userid, STATS_EVENT_TIME_SPENT, '', $timespent);
            }
            set_config('cronlastrun', $nextrun, 'block_totara_stats');
        }
    }
}
