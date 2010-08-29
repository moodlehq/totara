<?php
@raise_memory_limit('392M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'report_builder_preproc_track'<br>";
$items = array(array('id' => '1','groupid' => '1','itemid' => '10','lastchecked' => '1282790649','disabled' => '0',),
array('id' => '2','groupid' => '1','itemid' => '11','lastchecked' => '1282790649','disabled' => '0',),
array('id' => '3','groupid' => '1','itemid' => '12','lastchecked' => '1282790649','disabled' => '0',),
array('id' => '4','groupid' => '1','itemid' => '13','lastchecked' => '1282790651','disabled' => '0',),
array('id' => '5','groupid' => '1','itemid' => '14','lastchecked' => '1282790659','disabled' => '0',),
array('id' => '6','groupid' => '1','itemid' => '15','lastchecked' => '1282790660','disabled' => '0',),
array('id' => '7','groupid' => '1','itemid' => '16','lastchecked' => '1282790669','disabled' => '0',),
array('id' => '8','groupid' => '1','itemid' => '17','lastchecked' => '1282790670','disabled' => '0',),
array('id' => '9','groupid' => '1','itemid' => '18','lastchecked' => '1282790672','disabled' => '0',),
array('id' => '10','groupid' => '1','itemid' => '19','lastchecked' => '1282790674','disabled' => '0',),
array('id' => '11','groupid' => '1','itemid' => '2','lastchecked' => '1282790680','disabled' => '0',),
array('id' => '12','groupid' => '1','itemid' => '20','lastchecked' => '1282790681','disabled' => '0',),
array('id' => '13','groupid' => '1','itemid' => '21','lastchecked' => '1282790682','disabled' => '0',),
array('id' => '14','groupid' => '1','itemid' => '22','lastchecked' => '1282790685','disabled' => '0',),
array('id' => '15','groupid' => '1','itemid' => '23','lastchecked' => '1282790685','disabled' => '0',),
array('id' => '16','groupid' => '1','itemid' => '24','lastchecked' => '1282790686','disabled' => '0',),
array('id' => '17','groupid' => '1','itemid' => '25','lastchecked' => '1282790686','disabled' => '0',),
array('id' => '18','groupid' => '1','itemid' => '26','lastchecked' => '1282790692','disabled' => '0',),
array('id' => '19','groupid' => '1','itemid' => '27','lastchecked' => '1282790693','disabled' => '0',),
array('id' => '20','groupid' => '1','itemid' => '3','lastchecked' => '1282790694','disabled' => '0',),
array('id' => '21','groupid' => '1','itemid' => '30','lastchecked' => '1282790694','disabled' => '0',),
array('id' => '22','groupid' => '1','itemid' => '32','lastchecked' => '1282790695','disabled' => '0',),
array('id' => '23','groupid' => '1','itemid' => '33','lastchecked' => '1282790695','disabled' => '0',),
array('id' => '24','groupid' => '1','itemid' => '34','lastchecked' => '1282790695','disabled' => '0',),
array('id' => '25','groupid' => '1','itemid' => '35','lastchecked' => '1282790696','disabled' => '0',),
array('id' => '26','groupid' => '1','itemid' => '36','lastchecked' => '1282790698','disabled' => '0',),
array('id' => '27','groupid' => '1','itemid' => '37','lastchecked' => '1282790700','disabled' => '0',),
array('id' => '28','groupid' => '1','itemid' => '38','lastchecked' => '1282790704','disabled' => '0',),
array('id' => '29','groupid' => '1','itemid' => '4','lastchecked' => '1282790705','disabled' => '0',),
array('id' => '30','groupid' => '1','itemid' => '40','lastchecked' => '1282790706','disabled' => '0',),
array('id' => '31','groupid' => '1','itemid' => '41','lastchecked' => '1282790711','disabled' => '0',),
array('id' => '32','groupid' => '1','itemid' => '42','lastchecked' => '1282790712','disabled' => '0',),
array('id' => '33','groupid' => '1','itemid' => '43','lastchecked' => '1282790712','disabled' => '0',),
array('id' => '34','groupid' => '1','itemid' => '44','lastchecked' => '1282790712','disabled' => '0',),
array('id' => '35','groupid' => '1','itemid' => '45','lastchecked' => '1282790714','disabled' => '0',),
array('id' => '36','groupid' => '1','itemid' => '46','lastchecked' => '1282790715','disabled' => '0',),
array('id' => '37','groupid' => '1','itemid' => '47','lastchecked' => '1282790715','disabled' => '0',),
array('id' => '38','groupid' => '1','itemid' => '48','lastchecked' => '1282790719','disabled' => '0',),
array('id' => '39','groupid' => '1','itemid' => '49','lastchecked' => '1282790722','disabled' => '0',),
array('id' => '40','groupid' => '1','itemid' => '50','lastchecked' => '1282790723','disabled' => '0',),
array('id' => '41','groupid' => '1','itemid' => '51','lastchecked' => '1282790723','disabled' => '0',),
array('id' => '42','groupid' => '1','itemid' => '52','lastchecked' => '1282790724','disabled' => '0',),
array('id' => '43','groupid' => '1','itemid' => '53','lastchecked' => '1282790728','disabled' => '0',),
array('id' => '44','groupid' => '1','itemid' => '54','lastchecked' => '1282790728','disabled' => '0',),
array('id' => '45','groupid' => '1','itemid' => '55','lastchecked' => '1282790731','disabled' => '0',),
array('id' => '46','groupid' => '1','itemid' => '57','lastchecked' => '1282790732','disabled' => '0',),
array('id' => '47','groupid' => '1','itemid' => '58','lastchecked' => '1282790733','disabled' => '0',),
array('id' => '48','groupid' => '1','itemid' => '59','lastchecked' => '1282790733','disabled' => '0',),
array('id' => '49','groupid' => '1','itemid' => '60','lastchecked' => '1282790734','disabled' => '0',),
array('id' => '50','groupid' => '1','itemid' => '64','lastchecked' => '1282790735','disabled' => '0',),
array('id' => '51','groupid' => '1','itemid' => '65','lastchecked' => '1282790739','disabled' => '0',),
array('id' => '52','groupid' => '1','itemid' => '66','lastchecked' => '1282790743','disabled' => '0',),
array('id' => '53','groupid' => '1','itemid' => '67','lastchecked' => '1282790744','disabled' => '0',),
array('id' => '54','groupid' => '1','itemid' => '68','lastchecked' => '1282790744','disabled' => '0',),
array('id' => '55','groupid' => '1','itemid' => '69','lastchecked' => '1282790745','disabled' => '0',),
array('id' => '56','groupid' => '1','itemid' => '7','lastchecked' => '1282790748','disabled' => '0',),
array('id' => '57','groupid' => '1','itemid' => '70','lastchecked' => '1282790748','disabled' => '0',),
array('id' => '58','groupid' => '1','itemid' => '71','lastchecked' => '1282790750','disabled' => '0',),
array('id' => '59','groupid' => '1','itemid' => '72','lastchecked' => '1282790753','disabled' => '0',),
array('id' => '60','groupid' => '1','itemid' => '73','lastchecked' => '1282790754','disabled' => '0',),
array('id' => '61','groupid' => '1','itemid' => '74','lastchecked' => '1282790756','disabled' => '0',),
array('id' => '62','groupid' => '1','itemid' => '75','lastchecked' => '1282790756','disabled' => '0',),
array('id' => '63','groupid' => '1','itemid' => '76','lastchecked' => '1282790757','disabled' => '0',),
array('id' => '64','groupid' => '1','itemid' => '77','lastchecked' => '1282790760','disabled' => '0',),
array('id' => '65','groupid' => '1','itemid' => '78','lastchecked' => '1282790761','disabled' => '0',),
array('id' => '66','groupid' => '1','itemid' => '79','lastchecked' => '1282790762','disabled' => '0',),
array('id' => '67','groupid' => '1','itemid' => '8','lastchecked' => '1282790766','disabled' => '0',),
array('id' => '68','groupid' => '1','itemid' => '80','lastchecked' => '1282790768','disabled' => '0',),
array('id' => '69','groupid' => '1','itemid' => '81','lastchecked' => '1282790768','disabled' => '0',),
array('id' => '70','groupid' => '1','itemid' => '82','lastchecked' => '1282790769','disabled' => '0',),
array('id' => '71','groupid' => '1','itemid' => '83','lastchecked' => '1282790774','disabled' => '0',),
array('id' => '72','groupid' => '1','itemid' => '84','lastchecked' => '1282790774','disabled' => '0',),
array('id' => '73','groupid' => '1','itemid' => '86','lastchecked' => '1282790774','disabled' => '0',),
array('id' => '74','groupid' => '1','itemid' => '87','lastchecked' => '1282790780','disabled' => '0',),
array('id' => '75','groupid' => '1','itemid' => '88','lastchecked' => '1282790782','disabled' => '0',),
array('id' => '76','groupid' => '1','itemid' => '89','lastchecked' => '1282790782','disabled' => '0',),
array('id' => '77','groupid' => '1','itemid' => '9','lastchecked' => '1282790783','disabled' => '0',),
array('id' => '78','groupid' => '1','itemid' => '90','lastchecked' => '1282790785','disabled' => '0',),
array('id' => '79','groupid' => '1','itemid' => '91','lastchecked' => '1282790786','disabled' => '0',),
array('id' => '80','groupid' => '1','itemid' => '92','lastchecked' => '1282790787','disabled' => '0',),
array('id' => '81','groupid' => '1','itemid' => '93','lastchecked' => '1282790787','disabled' => '0',),
array('id' => '82','groupid' => '1','itemid' => '94','lastchecked' => '1282790787','disabled' => '0',),
array('id' => '83','groupid' => '1','itemid' => '95','lastchecked' => '1282790792','disabled' => '0',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('report_builder_preproc_track', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('report_builder_preproc_track',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('report_builder_preproc_track', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'report_builder_preproc_track');
    // make sure sequence is higher than highest ID
    bump_sequence('report_builder_preproc_track', $CFG->prefix, $maxid);
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
        