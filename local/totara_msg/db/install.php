<?php

// This file replaces:
//   * STATEMENTS section in db/install.xml
//   * lib.php/modulename_install() post installation hook
//   * partially defaults.php

function xmldb_local_totara_msg_install() {
    global $CFG;

/// Install logging support
//    update_log_display_entry('local_totara_msg', 'add', 'local_totara_msg', 'name');

/// Check all message20 output plugins and upgrade if necessary
/// This is temporary until Totara goes to 2.x - then migrate local/totara_msg/message20 to message
    upgrade_plugins('local','local/totara_msg/message20/output',"$CFG->wwwroot/$CFG->admin/index.php");

    // hack to get cron working via admin/cron.php
    // at some point we should create a local_modules table
    // based on data in version.php
    set_config('local_totara_msg_cron', 60);

    return true;
}
