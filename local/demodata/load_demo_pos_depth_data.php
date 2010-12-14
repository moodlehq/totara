<?php
@raise_memory_limit('496M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'pos_depth'<br>";
$items = array(array('id' => '1','fullname' => 'General Positions','shortname' => 'General','description' => '','depthlevel' => '1','frameworkid' => '1','timecreated' => '1263434099','timemodified' => '1267682907','usermodified' => '2',),
array('id' => '3','fullname' => 'Management Level One','shortname' => 'Mang L1','description' => '','depthlevel' => '1','frameworkid' => '2','timecreated' => '1291930785','timemodified' => '1291930785','usermodified' => '6881',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('pos_depth', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('pos_depth',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('pos_depth', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'pos_depth');
    // make sure sequence is higher than highest ID
    bump_sequence('pos_depth', $CFG->prefix, $maxid);
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
        