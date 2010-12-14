<?php
@raise_memory_limit('496M');
@ini_set('max_execution_time','3000');
print "Emptytable flag set, deleting all data from role_allow_assign.<br>";
delete_records('role_allow_assign');
print "Loading data for table 'role_allow_assign'<br>";
$items = array(array('id' => '1','roleid' => '1','allowassign' => '1',),
array('id' => '2','roleid' => '1','allowassign' => '2',),
array('id' => '4','roleid' => '1','allowassign' => '3',),
array('id' => '5','roleid' => '1','allowassign' => '5',),
array('id' => '8','roleid' => '2','allowassign' => '3',),
array('id' => '9','roleid' => '2','allowassign' => '5',),
array('id' => '10','roleid' => '2','allowassign' => '6',),
array('id' => '12','roleid' => '3','allowassign' => '5',),
array('id' => '13','roleid' => '3','allowassign' => '6',),
array('id' => '15','roleid' => '1','allowassign' => '12',),
array('id' => '16','roleid' => '1','allowassign' => '11',),
array('id' => '17','roleid' => '1','allowassign' => '10',),
array('id' => '19','roleid' => '1','allowassign' => '8',),
array('id' => '20','roleid' => '1','allowassign' => '7',),
array('id' => '22','roleid' => '1','allowassign' => '15',),
array('id' => '23','roleid' => '1','allowassign' => '16',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('role_allow_assign', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('role_allow_assign',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('role_allow_assign', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'role_allow_assign');
    // make sure sequence is higher than highest ID
    bump_sequence('role_allow_assign', $CFG->prefix, $maxid);
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
        