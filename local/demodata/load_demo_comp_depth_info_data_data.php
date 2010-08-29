<?php
@raise_memory_limit('392M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'comp_depth_info_data'<br>";
$items = array(array('id' => '1','data' => '1','fieldid' => '1','competencyid' => '1',),
array('id' => '2','data' => '1','fieldid' => '2','competencyid' => '1',),
array('id' => '3','data' => '','fieldid' => '3','competencyid' => '1',),
array('id' => '4','data' => '','fieldid' => '4','competencyid' => '1',),
array('id' => '5','data' => '1','fieldid' => '1','competencyid' => '2',),
array('id' => '6','data' => '1','fieldid' => '2','competencyid' => '2',),
array('id' => '7','data' => '','fieldid' => '3','competencyid' => '2',),
array('id' => '8','data' => '','fieldid' => '4','competencyid' => '2',),
array('id' => '9','data' => '1','fieldid' => '1','competencyid' => '4',),
array('id' => '10','data' => '1','fieldid' => '2','competencyid' => '4',),
array('id' => '11','data' => '','fieldid' => '3','competencyid' => '4',),
array('id' => '12','data' => '','fieldid' => '4','competencyid' => '4',),
array('id' => '13','data' => '1','fieldid' => '1','competencyid' => '5',),
array('id' => '14','data' => '1','fieldid' => '2','competencyid' => '5',),
array('id' => '15','data' => '','fieldid' => '3','competencyid' => '5',),
array('id' => '16','data' => '','fieldid' => '4','competencyid' => '5',),
array('id' => '17','data' => '1','fieldid' => '1','competencyid' => '7',),
array('id' => '18','data' => '1','fieldid' => '2','competencyid' => '7',),
array('id' => '19','data' => '','fieldid' => '3','competencyid' => '7',),
array('id' => '20','data' => '','fieldid' => '4','competencyid' => '7',),
array('id' => '21','data' => '1','fieldid' => '1','competencyid' => '8',),
array('id' => '22','data' => '1','fieldid' => '2','competencyid' => '8',),
array('id' => '23','data' => '','fieldid' => '3','competencyid' => '8',),
array('id' => '24','data' => '','fieldid' => '4','competencyid' => '8',),
array('id' => '25','data' => '1','fieldid' => '1','competencyid' => '10',),
array('id' => '26','data' => '1','fieldid' => '2','competencyid' => '10',),
array('id' => '27','data' => '','fieldid' => '3','competencyid' => '10',),
array('id' => '28','data' => '','fieldid' => '4','competencyid' => '10',),
array('id' => '29','data' => '1','fieldid' => '1','competencyid' => '11',),
array('id' => '30','data' => '1','fieldid' => '2','competencyid' => '11',),
array('id' => '31','data' => '','fieldid' => '3','competencyid' => '11',),
array('id' => '32','data' => '','fieldid' => '4','competencyid' => '11',),
array('id' => '33','data' => '1','fieldid' => '1','competencyid' => '12',),
array('id' => '34','data' => '1','fieldid' => '2','competencyid' => '12',),
array('id' => '35','data' => '','fieldid' => '3','competencyid' => '12',),
array('id' => '36','data' => '','fieldid' => '4','competencyid' => '12',),
array('id' => '37','data' => '1','fieldid' => '1','competencyid' => '14',),
array('id' => '38','data' => '1','fieldid' => '2','competencyid' => '14',),
array('id' => '39','data' => '','fieldid' => '3','competencyid' => '14',),
array('id' => '40','data' => '','fieldid' => '4','competencyid' => '14',),
array('id' => '41','data' => '1','fieldid' => '1','competencyid' => '15',),
array('id' => '42','data' => '1','fieldid' => '2','competencyid' => '15',),
array('id' => '43','data' => '','fieldid' => '3','competencyid' => '15',),
array('id' => '44','data' => '','fieldid' => '4','competencyid' => '15',),
array('id' => '45','data' => '1','fieldid' => '1','competencyid' => '19',),
array('id' => '46','data' => '1','fieldid' => '2','competencyid' => '19',),
array('id' => '47','data' => '','fieldid' => '3','competencyid' => '19',),
array('id' => '48','data' => '','fieldid' => '4','competencyid' => '19',),
array('id' => '49','data' => '1','fieldid' => '1','competencyid' => '20',),
array('id' => '50','data' => '1','fieldid' => '2','competencyid' => '20',),
array('id' => '51','data' => '','fieldid' => '3','competencyid' => '20',),
array('id' => '52','data' => '','fieldid' => '4','competencyid' => '20',),
array('id' => '53','data' => '1','fieldid' => '1','competencyid' => '21',),
array('id' => '54','data' => '1','fieldid' => '2','competencyid' => '21',),
array('id' => '55','data' => '','fieldid' => '3','competencyid' => '21',),
array('id' => '56','data' => '','fieldid' => '4','competencyid' => '21',),
array('id' => '57','data' => '1','fieldid' => '1','competencyid' => '22',),
array('id' => '58','data' => '1','fieldid' => '2','competencyid' => '22',),
array('id' => '59','data' => '','fieldid' => '3','competencyid' => '22',),
array('id' => '60','data' => '','fieldid' => '4','competencyid' => '22',),
array('id' => '61','data' => '1','fieldid' => '1','competencyid' => '23',),
array('id' => '62','data' => '1','fieldid' => '2','competencyid' => '23',),
array('id' => '63','data' => '','fieldid' => '3','competencyid' => '23',),
array('id' => '64','data' => '','fieldid' => '4','competencyid' => '23',),
array('id' => '65','data' => '1','fieldid' => '1','competencyid' => '25',),
array('id' => '66','data' => '1','fieldid' => '2','competencyid' => '25',),
array('id' => '67','data' => '','fieldid' => '3','competencyid' => '25',),
array('id' => '68','data' => '','fieldid' => '4','competencyid' => '25',),
array('id' => '69','data' => '1','fieldid' => '1','competencyid' => '26',),
array('id' => '70','data' => '1','fieldid' => '2','competencyid' => '26',),
array('id' => '71','data' => '','fieldid' => '3','competencyid' => '26',),
array('id' => '72','data' => '','fieldid' => '4','competencyid' => '26',),
array('id' => '73','data' => '1','fieldid' => '1','competencyid' => '27',),
array('id' => '74','data' => '1','fieldid' => '2','competencyid' => '27',),
array('id' => '75','data' => '','fieldid' => '3','competencyid' => '27',),
array('id' => '76','data' => '','fieldid' => '4','competencyid' => '27',),
array('id' => '77','data' => '1','fieldid' => '1','competencyid' => '28',),
array('id' => '78','data' => '1','fieldid' => '2','competencyid' => '28',),
array('id' => '79','data' => '','fieldid' => '3','competencyid' => '28',),
array('id' => '80','data' => '','fieldid' => '4','competencyid' => '28',),
array('id' => '81','data' => '1','fieldid' => '1','competencyid' => '29',),
array('id' => '82','data' => '1','fieldid' => '2','competencyid' => '29',),
array('id' => '83','data' => '','fieldid' => '3','competencyid' => '29',),
array('id' => '84','data' => '','fieldid' => '4','competencyid' => '29',),
array('id' => '85','data' => '1','fieldid' => '1','competencyid' => '31',),
array('id' => '86','data' => '1','fieldid' => '2','competencyid' => '31',),
array('id' => '87','data' => '','fieldid' => '3','competencyid' => '31',),
array('id' => '88','data' => '','fieldid' => '4','competencyid' => '31',),
array('id' => '89','data' => '1','fieldid' => '1','competencyid' => '32',),
array('id' => '90','data' => '1','fieldid' => '2','competencyid' => '32',),
array('id' => '91','data' => '','fieldid' => '3','competencyid' => '32',),
array('id' => '92','data' => '','fieldid' => '4','competencyid' => '32',),
array('id' => '93','data' => '1','fieldid' => '1','competencyid' => '33',),
array('id' => '94','data' => '1','fieldid' => '2','competencyid' => '33',),
array('id' => '95','data' => '','fieldid' => '3','competencyid' => '33',),
array('id' => '96','data' => '','fieldid' => '4','competencyid' => '33',),
array('id' => '97','data' => '1','fieldid' => '1','competencyid' => '34',),
array('id' => '98','data' => '1','fieldid' => '2','competencyid' => '34',),
array('id' => '99','data' => '','fieldid' => '3','competencyid' => '34',),
array('id' => '100','data' => '','fieldid' => '4','competencyid' => '34',),
array('id' => '101','data' => '1','fieldid' => '1','competencyid' => '36',),
array('id' => '102','data' => '1','fieldid' => '2','competencyid' => '36',),
array('id' => '103','data' => '','fieldid' => '3','competencyid' => '36',),
array('id' => '104','data' => '','fieldid' => '4','competencyid' => '36',),
array('id' => '105','data' => '1','fieldid' => '1','competencyid' => '39',),
array('id' => '106','data' => '1','fieldid' => '2','competencyid' => '39',),
array('id' => '107','data' => '','fieldid' => '3','competencyid' => '39',),
array('id' => '108','data' => '','fieldid' => '4','competencyid' => '39',),
array('id' => '109','data' => '1','fieldid' => '1','competencyid' => '40',),
array('id' => '110','data' => '1','fieldid' => '2','competencyid' => '40',),
array('id' => '111','data' => '','fieldid' => '3','competencyid' => '40',),
array('id' => '112','data' => '','fieldid' => '4','competencyid' => '40',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('comp_depth_info_data', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('comp_depth_info_data',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('comp_depth_info_data', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'comp_depth_info_data');
    // make sure sequence is higher than highest ID
    bump_sequence('comp_depth_info_data', $CFG->prefix, $maxid);
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
        