<?php

require_once('../../../../config.php');
require_once($CFG->dirroot.'/local/dialogs/dialog_content_hierarchy.class.php');

$userid = required_param('userid', PARAM_INT);

///
/// Setup / loading data
///

// Setup page
require_login();

// Load potential managers for this user
$managers = get_records_sql(
    "
        SELECT
            u.id,
            ".sql_fullname('u.firstname', 'u.lastname')." AS fullname
        FROM
            {$CFG->prefix}user u
        ORDER BY
            u.firstname,
            u.lastname
    "
);


///
/// Display page
///

$dialog = new totara_dialog_content();
$dialog->search_code = '/hierarchy/type/position/assign/manager_search.php';
$dialog->items = $managers;
$dialog->lang_file = 'manager';
$dialog->disabled_items = array($userid => true);

echo $dialog->generate_markup();
