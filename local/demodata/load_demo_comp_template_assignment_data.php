<?php
@raise_memory_limit('496M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'comp_template_assignment'<br>";
$items = array(array('id' => '1','templateid' => '2','type' => '1','instanceid' => '3262','timecreated' => '1267736908','usermodified' => '2',),
array('id' => '2','templateid' => '2','type' => '1','instanceid' => '724','timecreated' => '1267736908','usermodified' => '2',),
array('id' => '3','templateid' => '2','type' => '1','instanceid' => '1264','timecreated' => '1267736908','usermodified' => '2',),
array('id' => '4','templateid' => '5','type' => '1','instanceid' => '4332','timecreated' => '1291932920','usermodified' => '6881',),
array('id' => '5','templateid' => '5','type' => '1','instanceid' => '4333','timecreated' => '1291932920','usermodified' => '6881',),
array('id' => '6','templateid' => '5','type' => '1','instanceid' => '4334','timecreated' => '1291932920','usermodified' => '6881',),
array('id' => '7','templateid' => '5','type' => '1','instanceid' => '4335','timecreated' => '1291932920','usermodified' => '6881',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('comp_template_assignment', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('comp_template_assignment',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('comp_template_assignment', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'comp_template_assignment');
    // make sure sequence is higher than highest ID
    bump_sequence('comp_template_assignment', $CFG->prefix, $maxid);
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
        