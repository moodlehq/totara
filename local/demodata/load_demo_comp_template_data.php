<?php
@raise_memory_limit('496M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'comp_template'<br>";
$items = array(array('id' => '1','frameworkid' => '1','fullname' => 'Fire','shortname' => 'Fire','description' => '','visible' => '1','competencycount' => '0','timecreated' => '1263951477','timemodified' => '1263951477','usermodified' => '72',),
array('id' => '2','frameworkid' => '1','fullname' => 'Management Skills','shortname' => 'Management Skills','description' => '','visible' => '1','competencycount' => '3','timecreated' => '1267736879','timemodified' => '1267736879','usermodified' => '2',),
array('id' => '3','frameworkid' => '1','fullname' => 'test4','shortname' => 'test4','description' => '','visible' => '1','competencycount' => '0','timecreated' => '1268001692','timemodified' => '1268001692','usermodified' => '2',),
array('id' => '4','frameworkid' => '1','fullname' => 'test3','shortname' => 'test3','description' => '','visible' => '1','competencycount' => '0','timecreated' => '1268001720','timemodified' => '1268001720','usermodified' => '2',),
array('id' => '5','frameworkid' => '6','fullname' => 'Health and Safety','shortname' => 'H&S','description' => '','visible' => '1','competencycount' => '4','timecreated' => '1291932870','timemodified' => '1291932870','usermodified' => '6881',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('comp_template', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('comp_template',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('comp_template', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'comp_template');
    // make sure sequence is higher than highest ID
    bump_sequence('comp_template', $CFG->prefix, $maxid);
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
        