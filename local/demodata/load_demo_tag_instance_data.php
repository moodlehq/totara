<?php
@raise_memory_limit('392M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'tag_instance'<br>";
$items = array(array('id' => '1','tagid' => '1','itemtype' => 'user','itemid' => '6868','ordering' => '0','timemodified' => '1266372797',),
array('id' => '2','tagid' => '2','itemtype' => 'user','itemid' => '6868','ordering' => '1','timemodified' => '1266372797',),
array('id' => '3','tagid' => '3','itemtype' => 'user','itemid' => '6868','ordering' => '2','timemodified' => '1266372797',),
array('id' => '4','tagid' => '4','itemtype' => 'user','itemid' => '6868','ordering' => '3','timemodified' => '1266372797',),
array('id' => '5','tagid' => '5','itemtype' => 'user','itemid' => '6868','ordering' => '4','timemodified' => '1266372797',),
array('id' => '6','tagid' => '6','itemtype' => 'user','itemid' => '6868','ordering' => '5','timemodified' => '1266372797',),
array('id' => '7','tagid' => '7','itemtype' => 'user','itemid' => '6868','ordering' => '6','timemodified' => '1266372797',),
array('id' => '8','tagid' => '8','itemtype' => 'feedback','itemid' => '2','timemodified' => '1282789612',),
array('id' => '9','tagid' => '8','itemtype' => 'feedback','itemid' => '3','timemodified' => '1282789612',),
array('id' => '10','tagid' => '8','itemtype' => 'feedback','itemid' => '4','timemodified' => '1282789612',),
array('id' => '11','tagid' => '8','itemtype' => 'feedback','itemid' => '5','timemodified' => '1282789612',),
array('id' => '12','tagid' => '8','itemtype' => 'feedback','itemid' => '6','timemodified' => '1282789612',),
array('id' => '13','tagid' => '8','itemtype' => 'feedback','itemid' => '7','timemodified' => '1282789612',),
array('id' => '14','tagid' => '8','itemtype' => 'feedback','itemid' => '8','timemodified' => '1282789612',),
array('id' => '15','tagid' => '8','itemtype' => 'feedback','itemid' => '9','timemodified' => '1282789612',),
array('id' => '16','tagid' => '8','itemtype' => 'feedback','itemid' => '10','timemodified' => '1282789612',),
array('id' => '17','tagid' => '8','itemtype' => 'feedback','itemid' => '11','timemodified' => '1282789612',),
array('id' => '18','tagid' => '8','itemtype' => 'feedback','itemid' => '12','timemodified' => '1282789612',),
array('id' => '19','tagid' => '8','itemtype' => 'feedback','itemid' => '13','timemodified' => '1282789612',),
array('id' => '20','tagid' => '8','itemtype' => 'feedback','itemid' => '14','timemodified' => '1282789612',),
array('id' => '21','tagid' => '8','itemtype' => 'feedback','itemid' => '15','timemodified' => '1282789612',),
array('id' => '22','tagid' => '8','itemtype' => 'feedback','itemid' => '16','timemodified' => '1282789612',),
array('id' => '23','tagid' => '8','itemtype' => 'feedback','itemid' => '17','timemodified' => '1282789612',),
array('id' => '24','tagid' => '8','itemtype' => 'feedback','itemid' => '18','timemodified' => '1282789612',),
array('id' => '25','tagid' => '8','itemtype' => 'feedback','itemid' => '19','timemodified' => '1282789612',),
array('id' => '26','tagid' => '8','itemtype' => 'feedback','itemid' => '20','timemodified' => '1282789612',),
array('id' => '27','tagid' => '8','itemtype' => 'feedback','itemid' => '21','timemodified' => '1282789612',),
array('id' => '28','tagid' => '8','itemtype' => 'feedback','itemid' => '22','timemodified' => '1282789612',),
array('id' => '29','tagid' => '8','itemtype' => 'feedback','itemid' => '23','timemodified' => '1282789612',),
array('id' => '30','tagid' => '8','itemtype' => 'feedback','itemid' => '24','timemodified' => '1282789612',),
array('id' => '31','tagid' => '8','itemtype' => 'feedback','itemid' => '25','timemodified' => '1282789612',),
array('id' => '32','tagid' => '8','itemtype' => 'feedback','itemid' => '26','timemodified' => '1282789612',),
array('id' => '33','tagid' => '8','itemtype' => 'feedback','itemid' => '27','timemodified' => '1282789612',),
array('id' => '34','tagid' => '8','itemtype' => 'feedback','itemid' => '28','timemodified' => '1282789612',),
array('id' => '35','tagid' => '8','itemtype' => 'feedback','itemid' => '29','timemodified' => '1282789612',),
array('id' => '36','tagid' => '8','itemtype' => 'feedback','itemid' => '30','timemodified' => '1282789612',),
array('id' => '37','tagid' => '8','itemtype' => 'feedback','itemid' => '31','timemodified' => '1282789612',),
array('id' => '38','tagid' => '8','itemtype' => 'feedback','itemid' => '32','timemodified' => '1282789612',),
array('id' => '39','tagid' => '8','itemtype' => 'feedback','itemid' => '33','timemodified' => '1282789612',),
array('id' => '40','tagid' => '8','itemtype' => 'feedback','itemid' => '34','timemodified' => '1282789612',),
array('id' => '41','tagid' => '8','itemtype' => 'feedback','itemid' => '35','timemodified' => '1282789612',),
array('id' => '42','tagid' => '8','itemtype' => 'feedback','itemid' => '36','timemodified' => '1282789612',),
array('id' => '43','tagid' => '8','itemtype' => 'feedback','itemid' => '37','timemodified' => '1282789612',),
array('id' => '44','tagid' => '8','itemtype' => 'feedback','itemid' => '38','timemodified' => '1282789612',),
array('id' => '45','tagid' => '8','itemtype' => 'feedback','itemid' => '39','timemodified' => '1282789612',),
array('id' => '46','tagid' => '8','itemtype' => 'feedback','itemid' => '40','timemodified' => '1282789612',),
array('id' => '47','tagid' => '8','itemtype' => 'feedback','itemid' => '41','timemodified' => '1282789612',),
array('id' => '48','tagid' => '8','itemtype' => 'feedback','itemid' => '42','timemodified' => '1282789612',),
array('id' => '49','tagid' => '8','itemtype' => 'feedback','itemid' => '43','timemodified' => '1282789612',),
array('id' => '50','tagid' => '8','itemtype' => 'feedback','itemid' => '44','timemodified' => '1282789612',),
array('id' => '51','tagid' => '8','itemtype' => 'feedback','itemid' => '45','timemodified' => '1282789612',),
array('id' => '52','tagid' => '8','itemtype' => 'feedback','itemid' => '46','timemodified' => '1282789612',),
array('id' => '53','tagid' => '8','itemtype' => 'feedback','itemid' => '47','timemodified' => '1282789612',),
array('id' => '54','tagid' => '8','itemtype' => 'feedback','itemid' => '48','timemodified' => '1282789612',),
array('id' => '55','tagid' => '8','itemtype' => 'feedback','itemid' => '49','timemodified' => '1282789612',),
array('id' => '56','tagid' => '8','itemtype' => 'feedback','itemid' => '50','timemodified' => '1282789612',),
array('id' => '57','tagid' => '8','itemtype' => 'feedback','itemid' => '51','timemodified' => '1282789612',),
array('id' => '58','tagid' => '8','itemtype' => 'feedback','itemid' => '52','timemodified' => '1282789612',),
array('id' => '59','tagid' => '8','itemtype' => 'feedback','itemid' => '53','timemodified' => '1282789612',),
array('id' => '60','tagid' => '8','itemtype' => 'feedback','itemid' => '54','timemodified' => '1282789612',),
array('id' => '61','tagid' => '8','itemtype' => 'feedback','itemid' => '55','timemodified' => '1282789612',),
array('id' => '62','tagid' => '8','itemtype' => 'feedback','itemid' => '56','timemodified' => '1282789612',),
array('id' => '63','tagid' => '8','itemtype' => 'feedback','itemid' => '57','timemodified' => '1282789612',),
array('id' => '64','tagid' => '8','itemtype' => 'feedback','itemid' => '58','timemodified' => '1282789612',),
array('id' => '65','tagid' => '8','itemtype' => 'feedback','itemid' => '59','timemodified' => '1282789612',),
array('id' => '66','tagid' => '8','itemtype' => 'feedback','itemid' => '60','timemodified' => '1282789612',),
array('id' => '67','tagid' => '8','itemtype' => 'feedback','itemid' => '61','timemodified' => '1282789612',),
array('id' => '68','tagid' => '8','itemtype' => 'feedback','itemid' => '62','timemodified' => '1282789612',),
array('id' => '69','tagid' => '8','itemtype' => 'feedback','itemid' => '63','timemodified' => '1282789612',),
array('id' => '70','tagid' => '8','itemtype' => 'feedback','itemid' => '64','timemodified' => '1282789612',),
array('id' => '71','tagid' => '8','itemtype' => 'feedback','itemid' => '65','timemodified' => '1282789612',),
array('id' => '72','tagid' => '8','itemtype' => 'feedback','itemid' => '66','timemodified' => '1282789612',),
array('id' => '73','tagid' => '8','itemtype' => 'feedback','itemid' => '67','timemodified' => '1282789612',),
array('id' => '74','tagid' => '8','itemtype' => 'feedback','itemid' => '68','timemodified' => '1282789612',),
array('id' => '75','tagid' => '8','itemtype' => 'feedback','itemid' => '69','timemodified' => '1282789612',),
array('id' => '76','tagid' => '8','itemtype' => 'feedback','itemid' => '70','timemodified' => '1282789612',),
array('id' => '77','tagid' => '8','itemtype' => 'feedback','itemid' => '71','timemodified' => '1282789612',),
array('id' => '78','tagid' => '8','itemtype' => 'feedback','itemid' => '72','timemodified' => '1282789612',),
array('id' => '79','tagid' => '8','itemtype' => 'feedback','itemid' => '73','timemodified' => '1282789612',),
array('id' => '80','tagid' => '8','itemtype' => 'feedback','itemid' => '74','timemodified' => '1282789612',),
array('id' => '81','tagid' => '8','itemtype' => 'feedback','itemid' => '75','timemodified' => '1282789612',),
array('id' => '82','tagid' => '8','itemtype' => 'feedback','itemid' => '76','timemodified' => '1282789612',),
array('id' => '83','tagid' => '8','itemtype' => 'feedback','itemid' => '77','timemodified' => '1282789612',),
array('id' => '84','tagid' => '8','itemtype' => 'feedback','itemid' => '78','timemodified' => '1282789612',),
array('id' => '85','tagid' => '8','itemtype' => 'feedback','itemid' => '79','timemodified' => '1282789612',),
array('id' => '86','tagid' => '8','itemtype' => 'feedback','itemid' => '80','timemodified' => '1282789612',),
array('id' => '87','tagid' => '8','itemtype' => 'feedback','itemid' => '81','timemodified' => '1282789612',),
array('id' => '88','tagid' => '8','itemtype' => 'feedback','itemid' => '82','timemodified' => '1282789612',),
array('id' => '89','tagid' => '8','itemtype' => 'feedback','itemid' => '83','timemodified' => '1282789612',),
array('id' => '90','tagid' => '8','itemtype' => 'feedback','itemid' => '84','timemodified' => '1282789612',),
array('id' => '91','tagid' => '8','itemtype' => 'feedback','itemid' => '85','timemodified' => '1282789612',),
array('id' => '92','tagid' => '8','itemtype' => 'feedback','itemid' => '86','timemodified' => '1282789612',),
array('id' => '93','tagid' => '8','itemtype' => 'feedback','itemid' => '87','timemodified' => '1282789612',),
array('id' => '94','tagid' => '8','itemtype' => 'feedback','itemid' => '88','timemodified' => '1282789612',),
array('id' => '95','tagid' => '8','itemtype' => 'feedback','itemid' => '89','timemodified' => '1282789612',),
array('id' => '96','tagid' => '8','itemtype' => 'feedback','itemid' => '90','timemodified' => '1282789612',),
array('id' => '97','tagid' => '8','itemtype' => 'feedback','itemid' => '91','timemodified' => '1282789612',),
array('id' => '98','tagid' => '8','itemtype' => 'feedback','itemid' => '92','timemodified' => '1282789612',),
array('id' => '99','tagid' => '8','itemtype' => 'feedback','itemid' => '93','timemodified' => '1282789612',),
array('id' => '100','tagid' => '8','itemtype' => 'feedback','itemid' => '94','timemodified' => '1282789612',),
array('id' => '101','tagid' => '8','itemtype' => 'feedback','itemid' => '95','timemodified' => '1282789612',),
array('id' => '102','tagid' => '9','itemtype' => 'course','itemid' => '3','ordering' => '0','timemodified' => '1283124397',),
array('id' => '103','tagid' => '9','itemtype' => 'course','itemid' => '75','ordering' => '0','timemodified' => '1283124435',),
array('id' => '104','tagid' => '9','itemtype' => 'course','itemid' => '28','ordering' => '0','timemodified' => '1283124440',),
array('id' => '105','tagid' => '9','itemtype' => 'course','itemid' => '44','ordering' => '0','timemodified' => '1283124444',),
array('id' => '106','tagid' => '9','itemtype' => 'course','itemid' => '52','ordering' => '0','timemodified' => '1283124448',),
array('id' => '107','tagid' => '9','itemtype' => 'course','itemid' => '100','ordering' => '0','timemodified' => '1283124470',),
array('id' => '108','tagid' => '9','itemtype' => 'course','itemid' => '41','ordering' => '0','timemodified' => '1283124475',),
array('id' => '109','tagid' => '9','itemtype' => 'course','itemid' => '5','ordering' => '0','timemodified' => '1283124479',),
array('id' => '110','tagid' => '9','itemtype' => 'course','itemid' => '85','ordering' => '0','timemodified' => '1283124483',),
array('id' => '111','tagid' => '9','itemtype' => 'course','itemid' => '99','ordering' => '0','timemodified' => '1283124487',),
array('id' => '112','tagid' => '10','itemtype' => 'course','itemid' => '84','ordering' => '0','timemodified' => '1283124509',),
array('id' => '113','tagid' => '10','itemtype' => 'course','itemid' => '79','ordering' => '0','timemodified' => '1283124514',),
array('id' => '114','tagid' => '10','itemtype' => 'course','itemid' => '39','ordering' => '0','timemodified' => '1283124517',),
array('id' => '115','tagid' => '10','itemtype' => 'course','itemid' => '7','ordering' => '0','timemodified' => '1283124521',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('tag_instance', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('tag_instance',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('tag_instance', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'tag_instance');
    // make sure sequence is higher than highest ID
    bump_sequence('tag_instance', $CFG->prefix, $maxid);
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
        