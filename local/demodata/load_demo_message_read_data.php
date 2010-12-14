<?php
@raise_memory_limit('496M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'message_read'<br>";
$items = array(array('id' => '1','useridfrom' => '2596','useridto' => '2413','message' => '<p>Hi there,</p>
<p>come and enrol on my awesome course!</p>
<p>suzy</p>','format' => '1','timecreated' => '1266527243','timeread' => '1266528898','messagetype' => 'direct','mailed' => '0',),
array('id' => '2','useridfrom' => '1103','useridto' => '1059','message' => 'does your computer go \\\'PING!\\\' when you receive this??','format' => '0','timecreated' => '1266523626','timeread' => '1266549076','messagetype' => 'direct','mailed' => '0',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('message_read', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('message_read',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('message_read', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'message_read');
    // make sure sequence is higher than highest ID
    bump_sequence('message_read', $CFG->prefix, $maxid);
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
        