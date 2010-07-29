<?php

require_once($CFG->dirroot . '/local/reportbuilder/lib.php');

// how many locked crons to ignore before starting to print errors
define('REPORT_BUILDER_CRON_WAIT_NUM', 10);
// how often to print errors (1 for every time, 2 every other time, etc)
define('REPORT_BUILDER_CRON_ERROR_FREQ', 10);

function reportbuilder_cron($grp=null) {
    if(!rb_lock_cron()) {
        // don't run if already in progress
        mtrace('Report Builder cron locked. Skipping this time.');
        return false;
    }

    // if no ID provided, run on all groups
    if(!$grp) {
        $groups = get_records('report_builder_group', '', '' ,'id');
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
    rb_unlock_cron();
    return true;
}


/*
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

/*
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

/*
 * Unlock the report builder cron.
 *
 * @return True
 */
function rb_unlock_cron() {
    set_config('cron_lock', 0, 'reportbuilder');
    return true;
}

