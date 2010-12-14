<?php
@raise_memory_limit('496M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'dp_permissions'<br>";
$items = array(array('id' => '1','templateid' => '1','role' => 'learner','component' => 'plan','action' => 'view','value' => '50',),
array('id' => '2','templateid' => '1','role' => 'manager','component' => 'plan','action' => 'view','value' => '50',),
array('id' => '3','templateid' => '1','role' => 'learner','component' => 'plan','action' => 'create','value' => '50',),
array('id' => '4','templateid' => '1','role' => 'manager','component' => 'plan','action' => 'create','value' => '50',),
array('id' => '5','templateid' => '1','role' => 'learner','component' => 'plan','action' => 'update','value' => '50',),
array('id' => '6','templateid' => '1','role' => 'manager','component' => 'plan','action' => 'update','value' => '50',),
array('id' => '7','templateid' => '1','role' => 'learner','component' => 'plan','action' => 'delete','value' => '50',),
array('id' => '8','templateid' => '1','role' => 'manager','component' => 'plan','action' => 'delete','value' => '50',),
array('id' => '9','templateid' => '1','role' => 'learner','component' => 'plan','action' => 'confirm','value' => '30',),
array('id' => '10','templateid' => '1','role' => 'manager','component' => 'plan','action' => 'confirm','value' => '50',),
array('id' => '11','templateid' => '1','role' => 'learner','component' => 'plan','action' => 'signoff','value' => '30',),
array('id' => '12','templateid' => '1','role' => 'manager','component' => 'plan','action' => 'signoff','value' => '50',),
array('id' => '13','templateid' => '1','role' => 'learner','component' => 'course','action' => 'updatecourse','value' => '30',),
array('id' => '14','templateid' => '1','role' => 'manager','component' => 'course','action' => 'updatecourse','value' => '70',),
array('id' => '15','templateid' => '1','role' => 'learner','component' => 'course','action' => 'commenton','value' => '50',),
array('id' => '16','templateid' => '1','role' => 'manager','component' => 'course','action' => 'commenton','value' => '50',),
array('id' => '17','templateid' => '1','role' => 'learner','component' => 'course','action' => 'setpriority','value' => '50',),
array('id' => '18','templateid' => '1','role' => 'manager','component' => 'course','action' => 'setpriority','value' => '50',),
array('id' => '19','templateid' => '1','role' => 'learner','component' => 'course','action' => 'setduedate','value' => '50',),
array('id' => '20','templateid' => '1','role' => 'manager','component' => 'course','action' => 'setduedate','value' => '50',),
array('id' => '21','templateid' => '1','role' => 'learner','component' => 'course','action' => 'setcompletionstatus','value' => '30',),
array('id' => '22','templateid' => '1','role' => 'manager','component' => 'course','action' => 'setcompletionstatus','value' => '70',),
array('id' => '23','templateid' => '1','role' => 'learner','component' => 'competency','action' => 'updatecompetency','value' => '30',),
array('id' => '24','templateid' => '1','role' => 'manager','component' => 'competency','action' => 'updatecompetency','value' => '70',),
array('id' => '25','templateid' => '1','role' => 'learner','component' => 'competency','action' => 'commenton','value' => '50',),
array('id' => '26','templateid' => '1','role' => 'manager','component' => 'competency','action' => 'commenton','value' => '50',),
array('id' => '27','templateid' => '1','role' => 'learner','component' => 'competency','action' => 'setpriority','value' => '50',),
array('id' => '28','templateid' => '1','role' => 'manager','component' => 'competency','action' => 'setpriority','value' => '50',),
array('id' => '29','templateid' => '1','role' => 'learner','component' => 'competency','action' => 'setduedate','value' => '50',),
array('id' => '30','templateid' => '1','role' => 'manager','component' => 'competency','action' => 'setduedate','value' => '50',),
array('id' => '31','templateid' => '1','role' => 'learner','component' => 'competency','action' => 'setproficiency','value' => '30',),
array('id' => '32','templateid' => '1','role' => 'manager','component' => 'competency','action' => 'setproficiency','value' => '70',),
array('id' => '33','templateid' => '1','role' => 'learner','component' => 'objective','action' => 'updateobjective','value' => '50',),
array('id' => '34','templateid' => '1','role' => 'manager','component' => 'objective','action' => 'updateobjective','value' => '50',),
array('id' => '35','templateid' => '1','role' => 'learner','component' => 'objective','action' => 'commenton','value' => '50',),
array('id' => '36','templateid' => '1','role' => 'manager','component' => 'objective','action' => 'commenton','value' => '50',),
array('id' => '37','templateid' => '1','role' => 'learner','component' => 'objective','action' => 'setpriority','value' => '50',),
array('id' => '38','templateid' => '1','role' => 'manager','component' => 'objective','action' => 'setpriority','value' => '50',),
array('id' => '39','templateid' => '1','role' => 'learner','component' => 'objective','action' => 'setduedate','value' => '50',),
array('id' => '40','templateid' => '1','role' => 'manager','component' => 'objective','action' => 'setduedate','value' => '50',),
array('id' => '41','templateid' => '1','role' => 'learner','component' => 'objective','action' => 'setproficiency','value' => '50',),
array('id' => '42','templateid' => '1','role' => 'manager','component' => 'objective','action' => 'setproficiency','value' => '50',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('dp_permissions', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('dp_permissions',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('dp_permissions', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'dp_permissions');
    // make sure sequence is higher than highest ID
    bump_sequence('dp_permissions', $CFG->prefix, $maxid);
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
        