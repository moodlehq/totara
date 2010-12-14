<?php
@raise_memory_limit('496M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'dp_plan_objective'<br>";
$items = array(array('id' => '1','planid' => '7','fullname' => 'Apply health & safety principles to working practices','shortname' => 'Demonstrate how health & safety practices should be applied to everyday working practices.','description' => 'Demonstrate how health & safety practices should be applied to everyday working practices.','priority' => '1','scalevalueid' => '0','approved' => '50',),
array('id' => '2','planid' => '2','fullname' => 'Improve time management','shortname' => 'I need to get better at time management.','description' => 'I need to get better at time management.','priority' => '0','duedate' => '0','scalevalueid' => '0','approved' => '50',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('dp_plan_objective', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('dp_plan_objective',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('dp_plan_objective', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'dp_plan_objective');
    // make sure sequence is higher than highest ID
    bump_sequence('dp_plan_objective', $CFG->prefix, $maxid);
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
        