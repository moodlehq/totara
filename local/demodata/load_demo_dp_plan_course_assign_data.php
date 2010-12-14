<?php
@raise_memory_limit('496M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'dp_plan_course_assign'<br>";
$items = array(array('id' => '4','planid' => '2','courseid' => '121','priority' => '1','duedate' => '1289433600','approved' => '50',),
array('id' => '5','planid' => '2','courseid' => '22','priority' => '2','duedate' => '1291680000','approved' => '50',),
array('id' => '6','planid' => '2','courseid' => '45','priority' => '3','duedate' => '1292716800','approved' => '50',),
array('id' => '7','planid' => '3','courseid' => '121','priority' => '1','duedate' => '1355270400','approved' => '50',),
array('id' => '8','planid' => '3','courseid' => '61','priority' => '2','duedate' => '1355270400','approved' => '50',),
array('id' => '9','planid' => '3','courseid' => '217','priority' => '3','duedate' => '1355270400','approved' => '50',),
array('id' => '10','planid' => '3','courseid' => '45','priority' => '0','approved' => '50',),
array('id' => '11','planid' => '4','courseid' => '217','approved' => '20',),
array('id' => '12','planid' => '4','courseid' => '7','approved' => '20',),
array('id' => '13','planid' => '5','courseid' => '82','approved' => '20',),
array('id' => '14','planid' => '5','courseid' => '63','approved' => '20',),
array('id' => '15','planid' => '6','courseid' => '61','priority' => '1','approved' => '50',),
array('id' => '16','planid' => '6','courseid' => '22','priority' => '1','approved' => '50',),
array('id' => '17','planid' => '6','courseid' => '217','priority' => '2','approved' => '50',),
array('id' => '18','planid' => '6','courseid' => '45','priority' => '3','approved' => '50',),
array('id' => '19','planid' => '8','courseid' => '121','approved' => '20',),
array('id' => '20','planid' => '7','courseid' => '218','priority' => '0','approved' => '20',),
array('id' => '21','planid' => '7','courseid' => '219','priority' => '0','approved' => '20',),
array('id' => '22','planid' => '2','courseid' => '218','priority' => '2','duedate' => '1292803200','approved' => '50',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('dp_plan_course_assign', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('dp_plan_course_assign',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('dp_plan_course_assign', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'dp_plan_course_assign');
    // make sure sequence is higher than highest ID
    bump_sequence('dp_plan_course_assign', $CFG->prefix, $maxid);
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
        