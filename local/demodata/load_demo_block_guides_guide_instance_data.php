<?php
@raise_memory_limit('392M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'block_guides_guide_instance'<br>";
$items = array(array('id' => '1','guide' => '1','userid' => '2','currentstep' => '2','deleted' => '0',),
array('id' => '2','guide' => '2','userid' => '2','currentstep' => '1','deleted' => '0',),
array('id' => '3','guide' => '1','userid' => '1292','currentstep' => '1','deleted' => '1',),
array('id' => '4','guide' => '8','userid' => '2','currentstep' => '2','deleted' => '0',),
array('id' => '5','guide' => '7','userid' => '2','currentstep' => '2','deleted' => '0',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('block_guides_guide_instance', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('block_guides_guide_instance',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('block_guides_guide_instance', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'block_guides_guide_instance');
    // make sure sequence is higher than highest ID
    bump_sequence('block_guides_guide_instance', $CFG->prefix, $maxid);
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
        