<?php
@raise_memory_limit('392M');
@ini_set('max_execution_time','3000');
print "Emptytable flag set, deleting all data from role.<br>";
delete_records('role');
print "Loading data for table 'role'<br>";
$items = array(array('id' => '1','name' => 'Administrator','shortname' => 'admin','description' => 'Administrators can usually do anything on the site, in all courses.','sortorder' => '0',),
array('id' => '2','name' => 'Course creator','shortname' => 'coursecreator','description' => 'Course creators can create new courses.','sortorder' => '1',),
array('id' => '3','name' => 'Editing Trainer','shortname' => 'editingteacher','description' => 'Responsible for delivering training of learners, and can alter activities','sortorder' => '3',),
array('id' => '4','name' => 'Trainer','shortname' => 'teacher','description' => 'Responsible for delivering training of learners, but may not alter activities.','sortorder' => '4',),
array('id' => '5','name' => 'Learner','shortname' => 'student','description' => 'User acquiring knowledge, comprehension, or mastery through learning','sortorder' => '7',),
array('id' => '6','name' => 'Guest','shortname' => 'guest','description' => 'Guests have minimal privileges and usually can not enter text anywhere.','sortorder' => '9',),
array('id' => '7','name' => 'Authenticated User','shortname' => 'user','description' => 'All logged in users.','sortorder' => '8',),
array('id' => '8','name' => 'Manager','shortname' => 'manager','description' => 'User tasked with managing the performance of a learner or team','sortorder' => '6',),
array('id' => '9','name' => 'Regional Manager','shortname' => 'regionalmananger','description' => 'User who is responsible for the performance of a region and has access to regional reports','sortorder' => '5',),
array('id' => '10','name' => 'Regional Trainer','shortname' => 'regionaltrainer','description' => 'User who oversees the delivery of training within a region','sortorder' => '2',),
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
        