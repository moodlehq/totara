<?php
@raise_memory_limit('392M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'idp_revision_competency'<br>";
$items = array(array('id' => '1','ctime' => '1263514973','revision' => '2','competency' => '3499',),
array('id' => '2','ctime' => '1263516038','revision' => '2','competency' => '3496',),
array('id' => '3','ctime' => '1263525523','revision' => '3','competency' => '7',),
array('id' => '4','ctime' => '1263525523','revision' => '3','competency' => '3',),
array('id' => '5','ctime' => '1263767446','revision' => '4','competency' => '3503',),
array('id' => '6','ctime' => '1263767446','revision' => '4','competency' => '3507',),
array('id' => '7','ctime' => '1263767446','revision' => '4','competency' => '3508',),
array('id' => '8','ctime' => '1263773869','revision' => '6','competency' => '3501',),
array('id' => '9','ctime' => '1263773869','revision' => '6','competency' => '3486',),
array('id' => '10','ctime' => '1263773869','revision' => '6','competency' => '3480',),
array('id' => '11','ctime' => '1263860096','revision' => '7','competency' => '1',),
array('id' => '12','ctime' => '1263860096','revision' => '7','competency' => '3501',),
array('id' => '13','ctime' => '1263860096','revision' => '7','competency' => '2632',),
array('id' => '19','ctime' => '1267951872','revision' => '10','competency' => '2163','duedate' => '1290078000',),
array('id' => '20','ctime' => '1267953333','revision' => '10','competency' => '299','duedate' => '1290078000',),
array('id' => '21','ctime' => '1267953349','revision' => '10','competency' => '1973','duedate' => '1290078000',),
array('id' => '22','ctime' => '1267955225','revision' => '10','competency' => '2807','duedate' => '1290078000',),
array('id' => '23','ctime' => '1267955281','revision' => '10','competency' => '2970','duedate' => '1290078000',),
array('id' => '24','ctime' => '1267991561','revision' => '10','competency' => '2765','duedate' => '1290078000',),
array('id' => '25','ctime' => '1267991561','revision' => '10','competency' => '3701','duedate' => '1290078000',),
array('id' => '26','ctime' => '1267993369','revision' => '10','competency' => '3499','duedate' => '1290078000',),
array('id' => '27','ctime' => '1268011571','revision' => '11','competency' => '2765','duedate' => '1281528000',),
array('id' => '28','ctime' => '1268011571','revision' => '11','competency' => '3701','duedate' => '1281528000',),
array('id' => '29','ctime' => '1268011571','revision' => '11','competency' => '2163','duedate' => '1281528000',),
array('id' => '30','ctime' => '1268011571','revision' => '11','competency' => '2898','duedate' => '1281528000',),
array('id' => '31','ctime' => '1268011571','revision' => '11','competency' => '785','duedate' => '1281528000',),
array('id' => '32','ctime' => '1268012120','revision' => '11','competency' => '3313','duedate' => '1281528000',),
array('id' => '33','ctime' => '1268012120','revision' => '11','competency' => '1223','duedate' => '1281528000',),
array('id' => '34','ctime' => '1268012120','revision' => '11','competency' => '2765','duedate' => '1281528000',),
array('id' => '38','ctime' => '1280462018','revision' => '13','competency' => '4194','duedate' => '1279195200',),
array('id' => '41','ctime' => '1280462063','revision' => '13','competency' => '4199','duedate' => '1279195200',),
array('id' => '43','ctime' => '1280462109','revision' => '13','competency' => '4293','duedate' => '1279195200',),
array('id' => '44','ctime' => '1280462694','revision' => '13','competency' => '4220',),
array('id' => '45','ctime' => '1280462694','revision' => '13','competency' => '4222',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('idp_revision_competency', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('idp_revision_competency',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('idp_revision_competency', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'idp_revision_competency');
    // make sure sequence is higher than highest ID
    bump_sequence('idp_revision_competency', $CFG->prefix, $maxid);
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
        