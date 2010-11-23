<?php
/**
 * locallib.php for totara stats block
 *
 * @package   totara
 * @copyright 2010 Totara Learning Solutions Ltd
 * @author    Dan Marsden <dan@catalyst.net.nz>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('STATS_EVENT_TIME_SPENT', 1);

define('STATS_EVENT_COURSE_STARTED', 2);

define('STATS_EVENT_COURSE_COMPLETE', 3);

define('STATS_EVENT_COMP_ACHIEVED', 4);

define('STATS_EVENT_OBJ_ACHIEVED', 5);


/**
 * adds an event to the totara stats table.
 *
 * @param int $time - standard timestamp
 * @param int $userid - userid this is related to
 * @param int $eventtype - see defines above for posssible values
 * @param string $data - stores string related data for this event
 * @param int $data2 - stores int related data for this event - eg time, id of record.
 * @return boolean (result of insert_record)
 */
function totara_stats_add_event($time, $userid, $eventtype, $data=null, $data2=null) {
    global $DB;
    $newevent = new stdClass();
    $newevent->timestamp = $time;
    $newevent->userid = $userid;
    $newevent->eventtype = $eventtype;
    $newevent->data = $data; //string for events with more info.
    $newevent->data2 = $data2; //integer for timebased events to allow easy sql usage.

    return insert_record('block_totara_stats', $newevent);
}

/**
 * used by block cron to obtain daily usage stats.
 *
 * @param int $from - timestamp for start of stats generation
 * @param int $to - timestamp for end of stats generation
 * @return array
 */
function totara_stats_timespent($from, $to) {
    $minutesbetweensession = 30; //used to define new session
    //calculate timespent by each user
    $logs = totara_stats_get_logs($from, $to);
    $totalTime = array();
        if (!empty($logs)){
            foreach($logs as $aLog){
                if (empty($lasttime[$aLog->userid])) {
                    $lasttime[$aLog->userid] = $from;
                }
                if (!isset($totalTime[$aLog->userid])) {
                    $totalTime[$aLog->userid] = 0;
                }

                $delta = $aLog->time - $lasttime[$aLog->userid];
                if ($delta < $minutesbetweensession * MINSECS){
                    $totalTime[$aLog->userid] =$totalTime[$aLog->userid] + $delta;
                }
                $lasttime[$aLog->userid] = $aLog->time;
            }
        }
    return $totalTime;
}

/**
 * used to return stats for admin stats view
 *
 * @param object $user - Full $USER record (usually from $USER)
 * @return array
 */
function totara_stats_admin_stats($user, $structureonly=false) {
    global $CFG;
    //TODO - create a way of setting timeframes
    $to = time();
    $from = $to - (60*60*24*30); //30 days in the past.
    $numhours = 12;

    $statssql = array();
    $statssql[1]->sql = "SELECT count(DISTINCT userid) FROM {$CFG->prefix}mdl_block_totara_stats ".
                        "WHERE eventtype = ". STATS_EVENT_TIME_SPENT. " AND timestamp > ".$from. " AND timestamp < ".$to.
                        " GROUP BY userid HAVING sum(data2) > ".$numhours*60*60;
    $statssql[1]->string = 'statlearnerhours';
    $statssql[1]->stringparam->hours = $numhours; //extra params used by this particular query - could be configurable in future?

    $statssql[2]->sql = "SELECT count(*) FROM {$CFG->prefix}mdl_block_totara_stats ".
                        "WHERE eventtype = ". STATS_EVENT_COURSE_STARTED. " AND timestamp > ".$from. " AND timestamp < ".$to;
    $statssql[2]->string = 'statcoursesstarted';

    $statssql[3]->sql = "SELECT count(*) FROM {$CFG->prefix}mdl_block_totara_stats ".
                        "WHERE eventtype = ". STATS_EVENT_COURSE_COMPLETE. " AND timestamp > ".$from. " AND timestamp < ".$to;
    $statssql[3]->string = 'statcoursescompleted';

    $statssql[4]->sql = "SELECT count(*) FROM {$CFG->prefix}mdl_block_totara_stats ".
                        "WHERE eventtype = ". STATS_EVENT_COMP_ACHIEVED. " AND timestamp > ".$from. " AND timestamp < ".$to;
    $statssql[4]->string = 'statcompachieved';

    $statssql[5]->sql = "SELECT count(*) FROM {$CFG->prefix}mdl_block_totara_stats ".
                        "WHERE eventtype = ". STATS_EVENT_OBJ_ACHIEVED. " AND timestamp > ".$from. " AND timestamp < ".$to;
    $statssql[5]->string = 'statobjachieved';

    if ($structureonly) {
        return $statssql;
    }

    $results = totara_stats_sql_helper($statssql);

    return $results;
}

/**
 * used to return stats for manager stats view
 *
 * @param object $user - Full $USER record (usually from $USER)
 * @return array
 */
function totara_stats_manager_stats($user, $structureonly=false) {
    global $CFG;
    //TODO - create a way of setting timeframes
    $to = time();
    $from = $to - (60*60*24*30); //30 days in the past.
    $numhours = 12;

    $managerroleid = get_field('role','id','shortname','manager');

    //TODO: look to see if there's a more efficient way to manage this. - eg get list of userids, and pass userids into queries?
    //might need to be careful with length of sql query limit - list of userids could be very large.

    // return users with this user as manager
    $usersql = "AND userid IN (SELECT c.instanceid as userid
        FROM {$CFG->prefix}role_assignments ra
        LEFT JOIN {$CFG->prefix}context c
          ON c.id=ra.contextid
        JOIN {$CFG->prefix}user u
          ON u.id=c.instanceid
        WHERE ra.roleid={$managerroleid}
          AND ra.userid=".$user->id.
        " AND c.contextlevel=30) ";


    $statssql = array();
    $statssql[1]->sql = "SELECT count(DISTINCT userid) FROM {$CFG->prefix}mdl_block_totara_stats ".
                        "WHERE eventtype = ". STATS_EVENT_TIME_SPENT. " AND timestamp > ".$from. " AND timestamp < ".$to.$usersql.
                        " GROUP BY userid HAVING sum(data2) > ".$numhours*60*60;
    $statssql[1]->string = 'statlearnerhours';
    $statssql[1]->stringparam->hours = $numhours; //extra params used by this particular query - could be configurable in future?

    $statssql[2]->sql = "SELECT count(*) FROM {$CFG->prefix}mdl_block_totara_stats ".
                        "WHERE eventtype = ". STATS_EVENT_COURSE_STARTED. " AND timestamp > ".$from. " AND timestamp < ".$to.$usersql.
    $statssql[2]->string = 'statcoursesstarted';

    $statssql[3]->sql = "SELECT count(*) FROM {$CFG->prefix}mdl_block_totara_stats ".
                        "WHERE eventtype = ". STATS_EVENT_COURSE_COMPLETE. " AND timestamp > ".$from. " AND timestamp < ".$to.$usersql.
    $statssql[3]->string = 'statcoursescompleted';

    $statssql[4]->sql = "SELECT count(*) FROM {$CFG->prefix}mdl_block_totara_stats ".
                        "WHERE eventtype = ". STATS_EVENT_COMP_ACHIEVED. " AND timestamp > ".$from. " AND timestamp < ".$to.$usersql.
    $statssql[4]->string = 'statcompachieved';

    $statssql[5]->sql = "SELECT count(*) FROM {$CFG->prefix}mdl_block_totara_stats ".
                        "WHERE eventtype = ". STATS_EVENT_OBJ_ACHIEVED. " AND timestamp > ".$from. " AND timestamp < ".$to.$usersql.
    $statssql[5]->string = 'statobjachieved';

    if ($structureonly) {
        return $statssql;
    }

    $results = totara_stats_sql_helper($statssql);

    return $results;
}

/**
 * used to return stats for user stats view
 *
 * @param object $user - Full $USER record (usually from $USER)
 * @return array
 */
function totara_stats_user_stats($user) {

}

/**
 * takes an array of sql queries/lang strings and returns an object with the counts/strings to display in a block - helper function
 *
 * @param object $statsql - object from totara_stats_***_stats functions.
 * @return array
 */
function totara_stats_sql_helper($statsql) {
    $results = array();
    $i = 0;
    foreach ($statsql as $stat) {
        $stringparam = new stdClass();
        if (!empty($stat->stringparam)) {
            $stringparam = $stat->stringparam;
        }

        $stringparam->count = count_records_sql($stat->sql);
        $results[$i] = get_string($stat->string, 'block_totara_stats', $stringparam);
        $i++;
    }
    return $results;
}

/**
 * used to display stats in a block. - takes input from a call to totara_stats_helper
 *
 * @param array $stats - array from totara_stats_helper
 * @return string
 */
function totara_stats_output($stats) {
    $return = '';
    if (!empty($stats)) {
        $return = "<ul>";
        foreach ($stats as $stat) {
            $return .= "<li>".$stat."</li>";
        }
        $return .= "</ul>";
    }
    return $return;
}

/**
 * obtains log data from logs tables - used by totara_stats_timespent
 *
 * @param int $from - timestamp for start of stats generation
 * @param int $to - timestamp for end of stats generation
 * @param int $courseid (optional) - course id of stats to return
 * @return string
 */
function totara_stats_get_logs($from, $to, $courseid=null) {
    global $CFG;

    $courseclause = (!is_null($courseid)) ? " AND course = $courseid " : '' ;

    $sql = "
       SELECT
         *
       FROM
         {$CFG->prefix}log
       WHERE
         time > $from AND
         time < $to
         $courseclause
       ORDER BY userid, time";

    if($rs = get_recordset_sql($sql)){
        $logs = array();
        while($log = rs_fetch_next_record($rs)){
            $logs[] = $log;
        }
        rs_close($rs);
        return $logs;
    }
    return array();
}