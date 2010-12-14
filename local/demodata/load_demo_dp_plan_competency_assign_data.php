<?php
@raise_memory_limit('496M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'dp_plan_competency_assign'<br>";
$items = array(array('id' => '1','planid' => '2','competencyid' => '4198','priority' => '1','duedate' => '1300014000','approved' => '50','scalevalueid' => '0',),
array('id' => '2','planid' => '2','competencyid' => '4307','priority' => '1','duedate' => '1294570800','approved' => '50','scalevalueid' => '0',),
array('id' => '3','planid' => '2','competencyid' => '4295','priority' => '2','duedate' => '1292238000','approved' => '50','scalevalueid' => '0',),
array('id' => '4','planid' => '2','competencyid' => '4238','priority' => '3','duedate' => '1292324400','approved' => '50','scalevalueid' => '0',),
array('id' => '5','planid' => '3','competencyid' => '4194','priority' => '0','approved' => '50','scalevalueid' => '0',),
array('id' => '6','planid' => '3','competencyid' => '4195','priority' => '0','approved' => '50','scalevalueid' => '0',),
array('id' => '7','planid' => '4','competencyid' => '4332','approved' => '20','scalevalueid' => '0',),
array('id' => '8','planid' => '4','competencyid' => '4333','approved' => '20','scalevalueid' => '0',),
array('id' => '13','planid' => '5','competencyid' => '276','priority' => '2','approved' => '20','scalevalueid' => '0',),
array('id' => '14','planid' => '5','competencyid' => '585','priority' => '3','approved' => '20','scalevalueid' => '0',),
array('id' => '15','planid' => '5','competencyid' => '698','priority' => '1','approved' => '50','scalevalueid' => '0',),
array('id' => '16','planid' => '6','competencyid' => '4333','priority' => '1','approved' => '50','scalevalueid' => '0',),
array('id' => '17','planid' => '6','competencyid' => '4334','priority' => '1','approved' => '50','scalevalueid' => '0',),
array('id' => '18','planid' => '8','competencyid' => '4195','approved' => '20','scalevalueid' => '0',),
array('id' => '19','planid' => '7','competencyid' => '4334','priority' => '0','approved' => '20','scalevalueid' => '0',),
array('id' => '20','planid' => '7','competencyid' => '4332','priority' => '0','approved' => '20','scalevalueid' => '0',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('dp_plan_competency_assign', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('dp_plan_competency_assign',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('dp_plan_competency_assign', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'dp_plan_competency_assign');
    // make sure sequence is higher than highest ID
    bump_sequence('dp_plan_competency_assign', $CFG->prefix, $maxid);
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
        