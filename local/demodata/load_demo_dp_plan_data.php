<?php
@raise_memory_limit('496M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'dp_plan'<br>";
$items = array(array('id' => '2','templateid' => '1','userid' => '1292','name' => '2010 Development Plan','description' => 'This plan covers the training I intend to achieve during 2010.','startdate' => '1291778856','enddate' => '1323255600','status' => '50',),
array('id' => '3','templateid' => '1','userid' => '6882','name' => 'Induction','description' => 'induction plan','startdate' => '1291890593','enddate' => '1323216000','status' => '50',),
array('id' => '4','templateid' => '1','userid' => '3916','name' => '2011 Plan','description' => 'This covers 2011 Jan to Dec','startdate' => '1291939200','enddate' => '1325289600','status' => '10',),
array('id' => '5','templateid' => '1','userid' => '6882','name' => 'Improving','description' => 'Improving my skills','startdate' => '1291939200','enddate' => '1354838400','status' => '10',),
array('id' => '6','templateid' => '1','userid' => '1292','name' => '2009 Development Plan','description' => 'Learning for 2009','startdate' => '1291949313','enddate' => '1259625600','status' => '100',),
array('id' => '7','templateid' => '1','userid' => '1292','name' => '2011 Development Plan','description' => 'Planning for 2011 appraisal process.','startdate' => '1292198400','enddate' => '1323216000','status' => '10',),
array('id' => '8','templateid' => '1','userid' => '6881','name' => 'new plan','description' => 'New plan','startdate' => '1292198400','enddate' => '1323216000','status' => '10',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('dp_plan', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('dp_plan',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('dp_plan', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'dp_plan');
    // make sure sequence is higher than highest ID
    bump_sequence('dp_plan', $CFG->prefix, $maxid);
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
        