<?php
@raise_memory_limit('392M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'comp_scale_assignments'<br>";
$items = array(array('id' => '1','scaleid' => '1','frameworkid' => '1','timemodified' => '0','usermodified' => '2',),
array('id' => '2','scaleid' => '1','frameworkid' => '2','timemodified' => '0','usermodified' => '2',),
array('id' => '3','scaleid' => '1','frameworkid' => '3','timemodified' => '0','usermodified' => '2',),
array('id' => '4','scaleid' => '1','frameworkid' => '4','timemodified' => '0','usermodified' => '2',),
array('id' => '5','scaleid' => '1','frameworkid' => '5','timemodified' => '1282795685','usermodified' => '2',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('comp_scale_assignments', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('comp_scale_assignments',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('comp_scale_assignments', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'comp_scale_assignments');
    // make sure sequence is higher than highest ID
    bump_sequence('comp_scale_assignments', $CFG->prefix, $maxid);
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
        