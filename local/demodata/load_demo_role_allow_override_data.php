<?php
@raise_memory_limit('496M');
@ini_set('max_execution_time','3000');
print "Emptytable flag set, deleting all data from role_allow_override.<br>";
delete_records('role_allow_override');
print "Loading data for table 'role_allow_override'<br>";
$items = array(array('id' => '1','roleid' => '1','allowoverride' => '1',),
array('id' => '2','roleid' => '1','allowoverride' => '2',),
array('id' => '4','roleid' => '1','allowoverride' => '3',),
array('id' => '5','roleid' => '1','allowoverride' => '5',),
array('id' => '6','roleid' => '1','allowoverride' => '6',),
array('id' => '7','roleid' => '1','allowoverride' => '7',),
array('id' => '10','roleid' => '1','allowoverride' => '15',),
array('id' => '11','roleid' => '1','allowoverride' => '16',),
array('id' => '12','roleid' => '1','allowoverride' => '12',),
array('id' => '13','roleid' => '1','allowoverride' => '11',),
array('id' => '14','roleid' => '1','allowoverride' => '10',),
array('id' => '15','roleid' => '1','allowoverride' => '8',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('role_allow_override', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('role_allow_override',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('role_allow_override', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'role_allow_override');
    // make sure sequence is higher than highest ID
    bump_sequence('role_allow_override', $CFG->prefix, $maxid);
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
        