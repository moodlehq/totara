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
        $this->version = 2010112500;
        $this->cron = 20; //TODO: should schedule cron rather than using this var.
        //set defaults - setting here to make it easy.
        $this->config->statlearnerhours = 1;
        $this->config->statlearnerhours_hours = 12;
        $this->config->statcoursesstarted = 1;
        $this->config->statcoursescompleted = 1;
        $this->config->statcompachieved = 1;
        $this->config->statobjachieved = 1;
    }

    function instance_allow_config() {
        return true;
    }

    function preferred_width() {
        return 210;
    }

    function specialization() {

    }

    function has_config() {
        return true;
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
            $role = totara_stats_get_dashrole($this->instance->pageid);
            //now get sql required to return stats
            $stats = totara_stats_build_sql($role, $USER, $this->config);
            if (!empty($stats)) {
                $this->content->text   .= get_string('statdesc', 'block_totara_stats')."<br/>".totara_stats_output(totara_stats_sql_helper($stats));
            }
        }

        //TODO: get stuff from reminders/notifications.

        return $this->content;
    }

    function instance_allow_multiple() {
        return false;
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
        //first check if cron is within 2 hours of the scheduled time
                //Calculate distance
        $midnight = usergetmidnight(time());
        $dist = ($CFG->block_totara_stats_sche_hour*3600) +      //Hours distance
                ($CFG->block_totara_stats_sche_minute*60);       //Minutes distance
        $result = $midnight + $dist;
        //if between 2 hours of $result.
        if ($result > 0 && $result < time() && $result+(60*120) > time()) {
            //check last time this cron was run
            $lastrun = (int)get_config('block_totara_stats', 'cronlastrun');
            if (empty($lastrun)) {
                //set $lastrun to one month ago: (only process one month of historical stats)
                $lastrun = time() -(60*60*24*30);
            }
            if (time() > ($lastrun + (24*60*60))) { //if at least 24 hours since last run
                require_once($CFG->dirroot.'/blocks/totara_stats/locallib.php');
                $nextrun = time();
                $stats = totara_stats_timespent($lastrun, $nextrun);
                foreach ($stats as $userid => $timespent) {
                    //insert daily stat for each user returned above into new stats table for reading.
                    totara_stats_add_event($nextrun, $userid, STATS_EVENT_TIME_SPENT, '', $timespent);
                }
                set_config('cronlastrun', $nextrun, 'block_totara_stats');
            }
        }
    }
}
