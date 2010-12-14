<?php
@raise_memory_limit('496M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'dp_plan_history'<br>";
$items = array(array('id' => '2','planid' => '2','status' => '10','timemodified' => '1291778424','usermodified' => '1292',),
array('id' => '3','planid' => '2','status' => '50','timemodified' => '1291778856','usermodified' => '1920',),
array('id' => '4','planid' => '3','status' => '10','timemodified' => '1291890482','usermodified' => '6882',),
array('id' => '5','planid' => '3','status' => '50','timemodified' => '1291890593','usermodified' => '6883',),
array('id' => '6','planid' => '4','status' => '10','timemodified' => '1291942809','usermodified' => '3916',),
array('id' => '7','planid' => '5','status' => '10','timemodified' => '1291947660','usermodified' => '6882',),
array('id' => '8','planid' => '6','status' => '10','timemodified' => '1291948493','usermodified' => '1292',),
array('id' => '9','planid' => '6','status' => '50','timemodified' => '1291949313','usermodified' => '1920',),
array('id' => '10','planid' => '6','status' => '100','timemodified' => '1291949439','usermodified' => '1920',),
array('id' => '11','planid' => '7','status' => '10','timemodified' => '1291949504','usermodified' => '1292',),
array('id' => '12','planid' => '8','status' => '10','timemodified' => '1292202093','usermodified' => '6881',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('dp_plan_history', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('dp_plan_history',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('dp_plan_history', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'dp_plan_history');
    // make sure sequence is higher than highest ID
    bump_sequence('dp_plan_history', $CFG->prefix, $maxid);
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
        