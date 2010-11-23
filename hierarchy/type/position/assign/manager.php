<?php

require_once('../../../../config.php');
require_once($CFG->dirroot.'/local/dialogs/dialog_content_hierarchy.class.php');


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
            ".sql_fullname('u.firstname', 'u.lastname')." AS fullname,
            ra.id AS ra
        FROM
            {$CFG->prefix}user u
        INNER JOIN
            {$CFG->prefix}role_assignments ra
         ON u.id = ra.userid
        INNER JOIN
            {$CFG->prefix}role r
         ON ra.roleid = r.id
        WHERE
            r.shortname = 'manager'
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

echo $dialog->generate_markup();
