<?php
@raise_memory_limit('392M');
@ini_set('max_execution_time','3000');
print "Emptytable flag set, deleting all data from block_pinned.<br>";
delete_records('block_pinned');
print "Loading data for table 'block_pinned'<br>";
$items = array(array('id' => '3','blockid' => '21','pagetype' => 'Totara','position' => 'l','weight' => '0','visible' => '1','configdata' => '',),
array('id' => '4','blockid' => '7','pagetype' => 'Totara','position' => 'r','weight' => '0','visible' => '1','configdata' => '',),
array('id' => '5','blockid' => '2','pagetype' => 'Totara','position' => 'l','weight' => '1','visible' => '1','configdata' => '',),
array('id' => '6','blockid' => '23','pagetype' => 'Totara','position' => 'r','weight' => '1','visible' => '1','configdata' => '',),
array('id' => '7','blockid' => '43','pagetype' => 'Totara','position' => 'r','weight' => '2','visible' => '1','configdata' => '',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('block_pinned', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('block_pinned',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('block_pinned', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'block_pinned');
    // make sure sequence is higher than highest ID
    bump_sequence('block_pinned', $CFG->prefix, $maxid);
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
        
