<?php
@raise_memory_limit('496M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'comp_scale_values'<br>";
$items = array(array('id' => '1','name' => 'Not Competent','idnumber' => '','description' => '','scaleid' => '1','sortorder' => '3','timemodified' => '1267736958','usermodified' => '2',),
array('id' => '2','name' => 'Competent With Supervision','idnumber' => '','description' => '','scaleid' => '1','sortorder' => '2','timemodified' => '1267736968','usermodified' => '2',),
array('id' => '3','name' => 'Competent','scaleid' => '1','sortorder' => '1','timemodified' => '1267736958','usermodified' => '2',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('comp_scale_values', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('comp_scale_values',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('comp_scale_values', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'comp_scale_values');
    // make sure sequence is higher than highest ID
    bump_sequence('comp_scale_values', $CFG->prefix, $maxid);
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
        