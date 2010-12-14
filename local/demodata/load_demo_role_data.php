<?php
@raise_memory_limit('496M');
@ini_set('max_execution_time','3000');
print "Emptytable flag set, deleting all data from role.<br>";
delete_records('role');
print "Loading data for table 'role'<br>";
$items = array(array('id' => '1','name' => 'Administrator','shortname' => 'administrator','description' => 'Administrators can do anything on the site','sortorder' => '0',),
array('id' => '3','name' => 'Editing Trainer','shortname' => 'trainer','description' => '<p>Responsible for delivering training of learners, and can alter activities</p>','sortorder' => '3',),
array('id' => '5','name' => 'Learner','shortname' => 'student','description' => '<p>User acquiring knowledge, comprehension, or mastery through learning</p>','sortorder' => '8',),
array('id' => '6','name' => 'Guest','shortname' => 'guest','description' => 'Guests have minimal privileges and usually can not enter text anywhere','sortorder' => '10',),
array('id' => '7','name' => 'Athenticated User','shortname' => 'user','description' => '<p>All logged in users.</p>','sortorder' => '9',),
array('id' => '8','name' => 'Manager','shortname' => 'manager','description' => '<p>User tasked with managing the performance of a learner or team</p>','sortorder' => '7',),
array('id' => '10','name' => 'Assessor','shortname' => 'assessor','description' => 'User who is responsible for assessing staff','sortorder' => '5',),
array('id' => '11','name' => 'Functional Administrator','shortname' => 'functional','description' => 'User who has a greater level of access to staff records, but not to the site administration functions','sortorder' => '2',),
array('id' => '12','name' => 'Regional Manager','shortname' => 'regionalmanager','description' => '<p>User who is responsible for the performance of a region and has access to regional reports</p>','sortorder' => '1',),
array('id' => '15','name' => 'Trainer','shortname' => 'noneditingtrainer','description' => '<p>Responsible for delivering training of learners, but may not alter activities</p>','sortorder' => '4',),
array('id' => '16','name' => 'Auditor ','shortname' => 'auditor','description' => 'User who can view and update training records','sortorder' => '6',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('role', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('role',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('role', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'role');
    // make sure sequence is higher than highest ID
    bump_sequence('role', $CFG->prefix, $maxid);
    // print output
    // 1 dot per 10 inserts
    if($i%10==0) {
        print ".";
        flush();
    }
    // new line every 200 dots
    if($i%2000==0) {
        print $i." <br>";
    }
    $i++;
}
print "<br>";

set_config("guestloginbutton", 0);
set_config("langmenu", 0);
set_config("forcelogin", 1);
        