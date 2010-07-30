<?php
@raise_memory_limit('392M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'report_builder_access'<br>";
$items = array(array('id' => '1','reportid' => '7','accesstype' => 'role','typeid' => '1',),
array('id' => '2','reportid' => '10','accesstype' => 'role','typeid' => '12',),
array('id' => '3','reportid' => '10','accesstype' => 'role','typeid' => '1',),
array('id' => '4','reportid' => '9','accesstype' => 'role','typeid' => '3',),
array('id' => '5','reportid' => '9','accesstype' => 'role','typeid' => '15',),
array('id' => '6','reportid' => '9','accesstype' => 'role','typeid' => '5',),
array('id' => '7','reportid' => '9','accesstype' => 'role','typeid' => '16',),
array('id' => '8','reportid' => '9','accesstype' => 'role','typeid' => '10',),
array('id' => '10','reportid' => '6','accesstype' => 'role','typeid' => '12',),
array('id' => '11','reportid' => '6','accesstype' => 'role','typeid' => '1',),
array('id' => '12','reportid' => '2','accesstype' => 'role','typeid' => '1',),
array('id' => '13','reportid' => '4','accesstype' => 'role','typeid' => '3',),
array('id' => '14','reportid' => '4','accesstype' => 'role','typeid' => '15',),
array('id' => '15','reportid' => '4','accesstype' => 'role','typeid' => '5',),
array('id' => '16','reportid' => '4','accesstype' => 'role','typeid' => '16',),
array('id' => '17','reportid' => '4','accesstype' => 'role','typeid' => '10',),
array('id' => '19','reportid' => '16','accesstype' => 'role','typeid' => '3',),
array('id' => '20','reportid' => '16','accesstype' => 'role','typeid' => '15',),
array('id' => '21','reportid' => '16','accesstype' => 'role','typeid' => '5',),
array('id' => '22','reportid' => '16','accesstype' => 'role','typeid' => '16',),
array('id' => '23','reportid' => '16','accesstype' => 'role','typeid' => '10',),
array('id' => '24','reportid' => '16','accesstype' => 'role','typeid' => '1',),
array('id' => '25','reportid' => '11','accesstype' => 'role','typeid' => '1',),
array('id' => '26','reportid' => '12','accesstype' => 'role','typeid' => '12',),
array('id' => '27','reportid' => '12','accesstype' => 'role','typeid' => '1',),
array('id' => '28','reportid' => '14','accesstype' => 'role','typeid' => '1',),
array('id' => '31','reportid' => '13','accesstype' => 'role','typeid' => '3',),
array('id' => '32','reportid' => '13','accesstype' => 'role','typeid' => '15',),
array('id' => '33','reportid' => '13','accesstype' => 'role','typeid' => '5',),
array('id' => '34','reportid' => '13','accesstype' => 'role','typeid' => '16',),
array('id' => '35','reportid' => '13','accesstype' => 'role','typeid' => '10',),
array('id' => '37','reportid' => '4','accesstype' => 'role','typeid' => '8',),
array('id' => '38','reportid' => '13','accesstype' => 'role','typeid' => '8',),
array('id' => '39','reportid' => '9','accesstype' => 'role','typeid' => '8',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('report_builder_access', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('report_builder_access',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('report_builder_access', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'report_builder_access');
    // make sure sequence is higher than highest ID
    bump_sequence('report_builder_access', $CFG->prefix, $maxid);
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
        