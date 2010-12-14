<?php
@raise_memory_limit('496M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'dashb_instance_dashlet'<br>";
$items = array(array('id' => '1','dashb_instance_id' => '1','block_instance_id' => '2452','col' => '1','pos' => '0','visible' => '1',),
array('id' => '2','dashb_instance_id' => '1','block_instance_id' => '2453','col' => '2','pos' => '0','visible' => '1',),
array('id' => '3','dashb_instance_id' => '1','block_instance_id' => '2454','col' => '3','pos' => '0','visible' => '1',),
array('id' => '4','dashb_instance_id' => '1','block_instance_id' => '2455','col' => '1','pos' => '1','visible' => '1',),
array('id' => '5','dashb_instance_id' => '2','block_instance_id' => '2456','col' => '1','pos' => '0','visible' => '1',),
array('id' => '6','dashb_instance_id' => '2','block_instance_id' => '2457','col' => '2','pos' => '0','visible' => '1',),
array('id' => '7','dashb_instance_id' => '2','block_instance_id' => '2458','col' => '3','pos' => '0','visible' => '1',),
array('id' => '8','dashb_instance_id' => '2','block_instance_id' => '2459','col' => '1','pos' => '1','visible' => '1',),
array('id' => '9','dashb_instance_id' => '2','block_instance_id' => '2460','col' => '2','pos' => '2','visible' => '1',),
array('id' => '10','dashb_instance_id' => '3','block_instance_id' => '2482','col' => '1','pos' => '0','visible' => '1',),
array('id' => '11','dashb_instance_id' => '3','block_instance_id' => '2483','col' => '2','pos' => '0','visible' => '1',),
array('id' => '12','dashb_instance_id' => '3','block_instance_id' => '2484','col' => '3','pos' => '0','visible' => '1',),
array('id' => '13','dashb_instance_id' => '3','block_instance_id' => '2485','col' => '1','pos' => '1','visible' => '1',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('dashb_instance_dashlet', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('dashb_instance_dashlet',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('dashb_instance_dashlet', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'dashb_instance_dashlet');
    // make sure sequence is higher than highest ID
    bump_sequence('dashb_instance_dashlet', $CFG->prefix, $maxid);
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
        