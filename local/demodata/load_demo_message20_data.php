<?php
@raise_memory_limit('496M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'message20'<br>";
$items = array(array('id' => '1','useridfrom' => '1920','useridto' => '1292','subject' => '','fullmessage' => '<a href=\\\"http://totara.moodle.scoggins.wgtn.cat-it.co.nz/user/view.php?id=1920\\\" title=\\\"John Wylie\\\">John Wylie</a> Plan 2010 Development Plan has been approved','fullmessageformat' => '2','fullmessagehtml' => '<a href=\\\"http://totara.moodle.scoggins.wgtn.cat-it.co.nz/user/view.php?id=1920\\\" title=\\\"John Wylie\\\">John Wylie</a> Plan 2010 Development Plan has been approved','notification' => '1','timecreated' => '1291778857',),
array('id' => '2','useridfrom' => '6883','useridto' => '6882','subject' => '','fullmessage' => '<a href=\\\"http://demoprep.totaralms.com/user/view.php?id=6883\\\" title=\\\"Test Manager\\\">Test Manager</a> Plan Induction has been approved','fullmessageformat' => '2','fullmessagehtml' => '<a href=\\\"http://demoprep.totaralms.com/user/view.php?id=6883\\\" title=\\\"Test Manager\\\">Test Manager</a> Plan Induction has been approved','notification' => '1','timecreated' => '1291890593',),
array('id' => '4','useridfrom' => '1292','useridto' => '1292','subject' => '','fullmessage' => '<p>Plan approval requested for <a href=\\\"http://demoprep.totaralms.com/local/plan/view.php?id=6&userid=1292\\\">2009 Development Plan</a></p>','fullmessageformat' => '2','fullmessagehtml' => '<p>Plan approval requested for <a href=\\\"http://demoprep.totaralms.com/local/plan/view.php?id=6&userid=1292\\\">2009 Development Plan</a></p>','notification' => '1','timecreated' => '1291948702',),
array('id' => '6','useridfrom' => '1292','useridto' => '1292','subject' => '','fullmessage' => '<p>Plan approval requested for <a href=\\\"http://demoprep.totaralms.com/local/plan/view.php?id=6&userid=1292\\\">2009 Development Plan</a></p>','fullmessageformat' => '2','fullmessagehtml' => '<p>Plan approval requested for <a href=\\\"http://demoprep.totaralms.com/local/plan/view.php?id=6&userid=1292\\\">2009 Development Plan</a></p>','notification' => '1','timecreated' => '1291948889',),
array('id' => '7','useridfrom' => '1292','useridto' => '1920','subject' => '','fullmessage' => '<a href=\\\"http://demoprep.totaralms.com/user/view.php?id=1292\\\" title=\\\"Abby Miller\\\">Abby Miller</a> Plan approval requested for <a href=\\\"http://demoprep.totaralms.com/local/plan/view.php?id=6&userid=1292\\\">2009 Development Plan</a>','fullmessageformat' => '2','fullmessagehtml' => '<a href=\\\"http://demoprep.totaralms.com/user/view.php?id=1292\\\" title=\\\"Abby Miller\\\">Abby Miller</a> Plan approval requested for <a href=\\\"http://demoprep.totaralms.com/local/plan/view.php?id=6&userid=1292\\\">2009 Development Plan</a>','notification' => '1','contexturl' => 'http://demoprep.totaralms.com','timecreated' => '1291948989',),
array('id' => '8','useridfrom' => '1292','useridto' => '1292','subject' => '','fullmessage' => '<p>Plan approval requested for <a href=\\\"http://demoprep.totaralms.com/local/plan/view.php?id=6&userid=1292\\\">2009 Development Plan</a></p>','fullmessageformat' => '2','fullmessagehtml' => '<p>Plan approval requested for <a href=\\\"http://demoprep.totaralms.com/local/plan/view.php?id=6&userid=1292\\\">2009 Development Plan</a></p>','notification' => '1','timecreated' => '1291948989',),
array('id' => '9','useridfrom' => '1920','useridto' => '1292','subject' => '','fullmessage' => '<a href=\\\"http://demoprep.totaralms.com/user/view.php?id=1920\\\" title=\\\"John Wylie\\\">John Wylie</a> Plan 2009 Development Plan has been approved','fullmessageformat' => '2','fullmessagehtml' => '<a href=\\\"http://demoprep.totaralms.com/user/view.php?id=1920\\\" title=\\\"John Wylie\\\">John Wylie</a> Plan 2009 Development Plan has been approved','notification' => '1','timecreated' => '1291949313',),
array('id' => '10','useridfrom' => '1920','useridto' => '1920','subject' => '','fullmessage' => '<p>Successfully completed plan 2009 Development Plan</p>','fullmessageformat' => '2','fullmessagehtml' => '<p>Successfully completed plan 2009 Development Plan</p>','notification' => '1','timecreated' => '1291949439',),
array('id' => '11','useridfrom' => '1292','useridto' => '1292','subject' => '','fullmessage' => '<p>Successfully completed plan 2009 Development Plan</p>','fullmessageformat' => '2','fullmessagehtml' => '<p>Successfully completed plan 2009 Development Plan</p>','notification' => '1','timecreated' => '1291949440',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('message20', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('message20',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('message20', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'message20');
    // make sure sequence is higher than highest ID
    bump_sequence('message20', $CFG->prefix, $maxid);
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
        