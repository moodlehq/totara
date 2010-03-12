<?php
//
// this file contains an array of addtional columns to display on the page to the
// right of the standard columns. It is designed for adding administration options
// to each row but could be adapted for other purposes.
//
// They differ from the other columns in that:
// - Each column is only displayed if the required capability is met by the user
// - They cannot be filtered by this column
// - They only appear on the page (not in the export)
//
// The array elements are as follows:
//
// 'name' key => A name to identify the column. Used in the SQL so stick to standard characters
// 'heading' key => The text that will appear on the page in the column heading
// 'fields' key => An array of SQL fragments used to match against, same as in columnoptions.
//                 The keys of this field are used in the SQL as part of the column alias
// 'joins' key => An array of join names which are required to allow all the fields defined
//                above to be obtained, same as in columnoptions.
// 'capability' key => A moodle capability string. This column will only appear for users
//                     who have this capability
// 'displayfunc' key => Name of a display function, found in reportbuilder/displayfuncs.php
//                      which will be called to display the column. The function will be
//                      passed a db record which will make available any fields specified
//                      in the format $arg->[name]_[field-key]
//                      Its return value will be the contents of each column
//
// params for this source
$adminoptions = array(
    array(
        'name' => 'settings',
        'heading' => 'Settings',
        'fields' => array(
            'user' => 'base.userid',
            'id'   =>'base.id',
        ),
        'joins' => array('user'),
        'capability' => 'moodle/local:updatecompetency',
        'displayfunc' => 'reportbuilder_ce_admin_options',
    ),
);

