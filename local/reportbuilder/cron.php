<?php

require_once($CFG->dirroot . '/local/reportbuilder/lib.php');
require_once($CFG->dirroot . '/local/reportbuilder/groupslib.php');

// how many locked crons to ignore before starting to print errors
define('REPORT_BUILDER_CRON_WAIT_NUM', 10);
// how often to print errors (1 for every time, 2 every other time, etc)
define('REPORT_BUILDER_CRON_ERROR_FREQ', 10);

/**
 * Run the cron functions required by report builder
 *
 * @param integer $grp ID of a group to run on. Runs on all groups if not set
 *
 * @return boolean True if completes successfully, false otherwise
 */
function reportbuilder_cron($grp=null) {
    if(!rb_lock_cron()) {
        // don't run if already in progress
        mtrace('Report Builder cron locked. Skipping this time.');
        return false;
    }

    // if no ID provided, run on all groups
    if(!$grp) {
        $groups = get_records('report_builder_group', '', '' ,'id');
        if(!$groups) {
            $groups = array();
        }
    } else {
        // otherwise run on the group provided
        $data = get_record('report_builder_group', 'id', $grp);
        if($data) {
            $groups = array($data);
        } else {
            $groups = array();
        }
    }

    foreach($groups as $group) {

        $preproc = $group->preproc;
        $groupid = $group->id;

        // create instance of preprocessor
        if(!$pp = reportbuilder::get_preproc_object($preproc, $groupid)) {
            mtrace('Warning: preprocessor "'.$preproc.'" not found.');
            continue;
        }

        // check for items where tags have been added or removed
        update_tag_grouping($groupid);

        // get list of items and when they were last processed
        $trackinfo = $pp->get_track_info();

        // get a list of items that need processing
        $items = $pp->get_group_items();

        mtrace("Running '$preproc' pre-processor on group '{$group->name}' (" .
              count($items) . ' items).');

        foreach($items as $item) {

            // get track info about this item if it exists
            if(array_key_exists($item, $trackinfo)) {
                $lastchecked = $trackinfo[$item]->lastchecked;
                $disabled = $trackinfo[$item]->disabled;
            } else {
                $lastchecked = null;
                $disabled = 0;
            }

            // skip processing if item is disabled
            if($disabled) {
                mtrace('Skipping disabled item '.$item);
                continue;
            }

            $message = '';
            // try processing the item, if it goes wrong disable
            // it to prevent future attempts to process it
            if(!$pp->run($item, $lastchecked, $message)) {
                $pp->disable_item($item);
                mtrace($message);
            }
        }

    }

    process_scheduled_reports();

    rb_unlock_cron();
    return true;
}


/**
 * Get an array of all the sources used by reports on this site
 *
 * @return Array Array of sources that have active reports
 */
function rb_get_active_sources() {
    global $CFG;
    $out = array();
    if($sources = get_records_sql('SELECT DISTINCT source FROM '.
        $CFG->prefix . 'report_builder')) {
        foreach($sources as $source) {
            $out[] = $source->source;
        }
    }
    return $out;
}

/**
 * Attempt to lock the report builder cron.
 *
 * If it is already locked, track how long for and start printing
 * warnings to the error log if it remains locked for too long.
 *
 * @return boolean True if cron successfully locked
 */
function rb_lock_cron() {

    $cronlock = get_config('reportbuilder', 'cron_lock');
    // cron is not locked, lock and return true
    if($cronlock === false || $cronlock == 0) {
        set_config('cron_lock', 1, 'reportbuilder');
        return true;
    }

    // increment cron lock count
    $cronlock++;
    set_config('cron_lock', $cronlock, 'reportbuilder');

    // report errors every so often after a set delay
    // this is to give time to let a long cron complete
    // and to avoid filling up the error log with too many
    // messages
    if($cronlock >= REPORT_BUILDER_CRON_WAIT_NUM) {
        if($cronlock % REPORT_BUILDER_CRON_ERROR_FREQ == 0) {
            error_log('Report Builder cron still locked on attempt '.$cronlock);
        }
    }

    return false;
}

/**
 * Unlock the report builder cron.
 *
 * @return True
 */
function rb_unlock_cron() {
    set_config('cron_lock', 0, 'reportbuilder');
    return true;
}


/**
 * Process Scheduled reports
 *
 */
function process_scheduled_reports(){
    global $CFG, $CALENDARDAYS;

    require_once($CFG->dirroot . '/calendar/lib.php');

    $sql = 'SELECT rbs.*, rb.fullname
        FROM mdl_report_builder_schedule rbs
        JOIN mdl_report_builder rb
        ON rbs.reportid=rb.id';

    if(!$scheduledreports = get_records_sql($sql)) {
        $scheduledreports = array();
    }

    mtrace('Processing ' . count($scheduledreports) . ' scheduled reports');

    foreach($scheduledreports as $report) {
        $reportname = $report->fullname;
        $currenthour = date('G');
        $currentminute = date('i');

        // set the next report time if its not yet set
        if(!isset($report->nextreport)){
            $todb = new object();
            $todb->id = $report->id;

            switch($report->frequency){
                case REPORT_BUILDER_SCHEDULE_DAILY:
                    $offset = ($currenthour <= $report->schedule) ? 0 : 86400; // If the scheduled hour has passed then set the offset to 86400 (1 day)
                    $nextreport = mktime(0, 0, 0) + $offset + ($report->schedule*60*60); //calculate next report time (startofcurrentday + offset + hourofschedule)
                    break;

                case REPORT_BUILDER_SCHEDULE_WEEKLY:
                    if(strftime('%A', $report->nextreport) == $CALENDARDAYS[$report->schedule]){
                        $nextreport = mktime(0,0,0); //If the today is the day then set the next reportdate to today
                    }
                    else {
                        $nextreport = strtotime('next '. $CALENDARDAYS[$report->schedule] ,time());
                    }
                    break;

                case REPORT_BUILDER_SCHEDULE_MONTHLY:
                    if(date('j', time()) == $report->schedule) {
                        $nextreport = mktime(0,0,0); // If the schedule is due to run today then nextreport is the start of today
                    } else {
                        $nextreport = get_next_monthly(time(), $report->schedule);
                    }

                    break;
            }

            $todb->nextreport = $nextreport;

            if(!update_record('report_builder_schedule', $todb)){
                mtrace('Failed to update next report field for scheduled report id:' . $report->id);
            }
        } else {
            $nextreport = $report->nextreport;
        }

        // run the report if nextreport time is in the past
        if($nextreport <= time()) {
            // calculate the new nextreport time
            switch($report->frequency){
                case REPORT_BUILDER_SCHEDULE_DAILY:
                    $nexttime = mktime(0, 0, 0) + 86400 + ($report->schedule*60*60); // calcuate the next report time if the report is to be sent
                    break;

                case REPORT_BUILDER_SCHEDULE_WEEKLY:
                    $nexttime = strtotime('next '. $CALENDARDAYS[$report->schedule] ,time());
                    break;

                case REPORT_BUILDER_SCHEDULE_MONTHLY:
                    $nexttime = get_next_monthly(time(), $report->schedule);
                    break;

                default:
                    add_to_log(SITEID, 'scheduledreport', 'failedcron', null, "Invalid frequency in Cron - $reportname (ID $report->id)");
                    break;
            }

            //Send email
            if(send_scheduled_report($report)) {
                mtrace('Sent email for report ' . $report->id);
            } else {
                mtrace('Failed to send email for report ' . $report->id);
            }

            add_to_log(SITEID, 'scheduledreport', 'dailyreport', null, "$reportname (ID $report->id)");

            $todb = new object();
            $todb->id = $report->id;
            $todb->nextreport = $nexttime;

            if(!update_record('report_builder_schedule', $todb)){
                mtrace('Failed to update next report field for scheduled report id:' . $report->id);
            }
        }
    }
}

