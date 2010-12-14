<?php
@raise_memory_limit('496M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'org_framework'<br>";
$items = array(array('id' => '1','fullname' => 'Regional Offices','shortname' => 'Regions','idnumber' => '','description' => '','sortorder' => '1','visible' => '1','hidecustomfields' => '0','showitemfullname' => '1','showdepthfullname' => '1','timecreated' => '1263434099','timemodified' => '1263434099','usermodified' => '2',),
array('id' => '2','fullname' => 'National Office','shortname' => 'National','idnumber' => '','description' => '','sortorder' => '2','visible' => '1','hidecustomfields' => '0','showitemfullname' => '1','showdepthfullname' => '1','timecreated' => '1263434099','timemodified' => '1263846072','usermodified' => '72',),
array('id' => '3','fullname' => 'External Organisations','shortname' => 'External','idnumber' => '','description' => '','sortorder' => '3','visible' => '1','hidecustomfields' => '0','showitemfullname' => '1','showdepthfullname' => '1','timecreated' => '1263434099','timemodified' => '1267685020','usermodified' => '2',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('org_framework', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('org_framework',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('org_framework', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'org_framework');
    // make sure sequence is higher than highest ID
    bump_sequence('org_framework', $CFG->prefix, $maxid);
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
        