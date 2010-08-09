<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/type/position/lib.php');
require_once($CFG->dirroot.'/local/js/lib/setup.php');


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

?>

<div class="selectmanager">

<h2>
<?php
    echo get_string('choosemanager', 'position');
    echo dialog_display_currently_selected(get_string('selected', 'hierarchy'));
?>
</h2>

<ul class="treeview filetree picker">
<?php

echo build_treeview(
    $managers,
    get_string('nomanagersavailable', 'position')
);

echo '</ul></div>';
