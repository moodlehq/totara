<?php
@raise_memory_limit('496M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'report_heading_items'<br>";
$items = array(array('id' => '1','type' => 'user-firstname','heading' => 'First Name','defaultvalue' => 'Not Found','sortorder' => '1',),
array('id' => '2','type' => 'user-lastname','heading' => 'Last Name','defaultvalue' => 'Not Found','sortorder' => '2',),
array('id' => '3','type' => 'user-department','heading' => 'Department','defaultvalue' => 'Not found','sortorder' => '3',),
array('id' => '4','type' => 'manager-fullname','heading' => 'Manager\\\'s Fullname','defaultvalue' => 'Not found','sortorder' => '4',),
array('id' => '5','type' => 'pos-General','heading' => 'Position','defaultvalue' => 'Not found','sortorder' => '5',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('report_heading_items', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('report_heading_items',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('report_heading_items', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'report_heading_items');
    // make sure sequence is higher than highest ID
    bump_sequence('report_heading_items', $CFG->prefix, $maxid);
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
        