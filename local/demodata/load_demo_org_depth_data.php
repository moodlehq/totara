<?php
@raise_memory_limit('496M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'org_depth'<br>";
$items = array(array('id' => '1','fullname' => 'Regional Offices','shortname' => 'RO','description' => '','depthlevel' => '1','frameworkid' => '1','timecreated' => '1263434099','timemodified' => '1263434099','usermodified' => '2',),
array('id' => '2','fullname' => 'District Offices','shortname' => 'DO','description' => '','depthlevel' => '2','frameworkid' => '1','timecreated' => '1263434099','timemodified' => '1267683881','usermodified' => '2',),
array('id' => '3','fullname' => 'Area Offices','shortname' => 'AO','description' => '','depthlevel' => '3','frameworkid' => '1','timecreated' => '1263434099','timemodified' => '1263434099','usermodified' => '2',),
array('id' => '4','fullname' => 'National Office','shortname' => 'NO','description' => '','depthlevel' => '1','frameworkid' => '2','timecreated' => '1263434099','timemodified' => '1263434099','usermodified' => '2',),
array('id' => '5','fullname' => 'Business Groups','shortname' => 'BG','description' => '','depthlevel' => '2','frameworkid' => '2','timecreated' => '1263434099','timemodified' => '1263434099','usermodified' => '2',),
array('id' => '6','fullname' => 'Business Units','shortname' => 'BU','description' => '','depthlevel' => '3','frameworkid' => '2','timecreated' => '1263434099','timemodified' => '1263434099','usermodified' => '2',),
array('id' => '7','fullname' => 'External Organisations','shortname' => 'External','description' => '','depthlevel' => '1','frameworkid' => '3','timecreated' => '1263434099','timemodified' => '1267685083','usermodified' => '2',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('org_depth', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('org_depth',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('org_depth', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'org_depth');
    // make sure sequence is higher than highest ID
    bump_sequence('org_depth', $CFG->prefix, $maxid);
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
        