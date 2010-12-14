<?php
@raise_memory_limit('496M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'block_totara_stats'<br>";
$items = array(array('id' => '1','userid' => '0','timestamp' => '1292203123','eventtype' => '1','data' => '','data2' => '9240',),
array('id' => '2','userid' => '2','timestamp' => '1292203123','eventtype' => '1','data' => '','data2' => '16210',),
array('id' => '3','userid' => '1292','timestamp' => '1292203123','eventtype' => '1','data' => '','data2' => '15229',),
array('id' => '4','userid' => '1485','timestamp' => '1292203123','eventtype' => '1','data' => '','data2' => '313',),
array('id' => '5','userid' => '1893','timestamp' => '1292203123','eventtype' => '1','data' => '','data2' => '1325',),
array('id' => '6','userid' => '1920','timestamp' => '1292203123','eventtype' => '1','data' => '','data2' => '11129',),
array('id' => '7','userid' => '3916','timestamp' => '1292203123','eventtype' => '1','data' => '','data2' => '0',),
array('id' => '8','userid' => '6881','timestamp' => '1292203123','eventtype' => '1','data' => '','data2' => '44729',),
array('id' => '9','userid' => '6882','timestamp' => '1292203123','eventtype' => '1','data' => '','data2' => '9132',),
array('id' => '10','userid' => '6883','timestamp' => '1292203123','eventtype' => '1','data' => '','data2' => '6996',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('block_totara_stats', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('block_totara_stats',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('block_totara_stats', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'block_totara_stats');
    // make sure sequence is higher than highest ID
    bump_sequence('block_totara_stats', $CFG->prefix, $maxid);
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
        