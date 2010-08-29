<?php
@raise_memory_limit('392M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'idp_revision_course'<br>";
$items = array(array('id' => '1','ctime' => '1267951769','revision' => '10','course' => '217','duedate' => '1290078000','priority' => '0',),
array('id' => '2','ctime' => '1267952655','revision' => '10','course' => '176','priority' => '0',),
array('id' => '3','ctime' => '1267953285','revision' => '10','course' => '119','priority' => '0',),
array('id' => '4','ctime' => '1267955303','revision' => '10','course' => '128','priority' => '0',),
array('id' => '5','ctime' => '1268001157','revision' => '10','course' => '129','priority' => '0',),
array('id' => '6','ctime' => '1268001157','revision' => '10','course' => '116','priority' => '0',),
array('id' => '7','ctime' => '1268001181','revision' => '10','course' => '217','duedate' => '1290078000','priority' => '0',),
array('id' => '8','ctime' => '1268001181','revision' => '10','course' => '112','priority' => '0',),
array('id' => '9','ctime' => '1268001181','revision' => '10','course' => '61','duedate' => '1290078000','priority' => '0',),
array('id' => '10','ctime' => '1268001181','revision' => '10','course' => '22','duedate' => '1290078000','priority' => '0',),
array('id' => '11','ctime' => '1268012158','revision' => '11','course' => '53','duedate' => '1281528000','priority' => '0',),
array('id' => '12','ctime' => '1268012158','revision' => '11','course' => '75','duedate' => '1281528000','priority' => '0',),
array('id' => '13','ctime' => '1268012158','revision' => '11','course' => '44','duedate' => '1281528000','priority' => '0',),
array('id' => '16','ctime' => '1280462134','revision' => '13','course' => '217','duedate' => '1279195200','priority' => '0',),
array('id' => '17','ctime' => '1280462134','revision' => '13','course' => '61','duedate' => '1279195200','priority' => '0',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('idp_revision_course', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('idp_revision_course',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('idp_revision_course', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'idp_revision_course');
    // make sure sequence is higher than highest ID
    bump_sequence('idp_revision_course', $CFG->prefix, $maxid);
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
        