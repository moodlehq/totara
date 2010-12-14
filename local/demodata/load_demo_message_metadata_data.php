<?php
@raise_memory_limit('496M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'message_metadata'<br>";
$items = array(array('id' => '4','messageid' => '4','msgtype' => '0','msgstatus' => '0','processorid' => '1','urgency' => '0','roleid' => '5',),
array('id' => '6','messageid' => '6','msgtype' => '0','msgstatus' => '0','processorid' => '1','urgency' => '0','roleid' => '5',),
array('id' => '7','messageid' => '7','msgtype' => '0','msgstatus' => '0','processorid' => '2','urgency' => '4','roleid' => '8',),
array('id' => '8','messageid' => '8','msgtype' => '0','msgstatus' => '0','processorid' => '1','urgency' => '0','roleid' => '5',),
array('id' => '9','messageid' => '9','msgtype' => '0','msgstatus' => '0','processorid' => '1','urgency' => '0','roleid' => '5',),
array('id' => '10','messageid' => '11','msgtype' => '0','msgstatus' => '0','processorid' => '1','urgency' => '0','roleid' => '5',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('message_metadata', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('message_metadata',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('message_metadata', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'message_metadata');
    // make sure sequence is higher than highest ID
    bump_sequence('message_metadata', $CFG->prefix, $maxid);
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
        