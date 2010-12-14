<?php
@raise_memory_limit('496M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'dp_component_settings'<br>";
$items = array(array('id' => '1','templateid' => '1','component' => 'course','enabled' => '1','sortorder' => '1',),
array('id' => '2','templateid' => '1','component' => 'competency','enabled' => '1','sortorder' => '2',),
array('id' => '3','templateid' => '1','component' => 'objective','enabled' => '1','sortorder' => '3',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('dp_component_settings', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('dp_component_settings',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('dp_component_settings', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'dp_component_settings');
    // make sure sequence is higher than highest ID
    bump_sequence('dp_component_settings', $CFG->prefix, $maxid);
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
        