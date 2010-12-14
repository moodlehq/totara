<?php
@raise_memory_limit('496M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'message'<br>";
$items = array(array('id' => '1','useridfrom' => '72','useridto' => '2638','message' => 'Wake Up!','format' => '0','timecreated' => '1266462205','messagetype' => 'direct',),
array('id' => '2','useridfrom' => '72','useridto' => '1103','message' => 'Wake Up','format' => '0','timecreated' => '1266462279','messagetype' => 'direct',),
array('id' => '3','useridfrom' => '1103','useridto' => '2413','message' => 'apparently I can send you a message when you\\\'re on this site....','format' => '0','timecreated' => '1266462861','messagetype' => 'direct',),
array('id' => '4','useridfrom' => '1103','useridto' => '6876','message' => 'who are you????','format' => '0','timecreated' => '1266523495','messagetype' => 'direct',),
array('id' => '6','useridfrom' => '2596','useridto' => '2596','message' => '<p>Hi there,</p>
<p>come and enrol on my awesome course!</p>
<p>suzy</p>','format' => '1','timecreated' => '1266527243','messagetype' => 'direct',),
array('id' => '7','useridfrom' => '2596','useridto' => '1103','message' => '<p>Hi there,</p>
<p>come and enrol on my awesome course!</p>
<p>suzy</p>','format' => '1','timecreated' => '1266527243','messagetype' => 'direct',),
array('id' => '8','useridfrom' => '2596','useridto' => '1687','message' => '<p>Hi there,</p>
<p>come and enrol on my awesome course!</p>
<p>suzy</p>','format' => '1','timecreated' => '1266527243','messagetype' => 'direct',),
array('id' => '10','useridfrom' => '2596','useridto' => '2638','message' => '<p>Hi there,</p>
<p>come and enrol on my awesome course!</p>
<p>suzy</p>','format' => '1','timecreated' => '1266527246','messagetype' => 'direct',),
array('id' => '11','useridfrom' => '2596','useridto' => '6860','message' => '<p>Hi there,</p>
<p>come and enrol on my awesome course!</p>
<p>suzy</p>','format' => '1','timecreated' => '1266527246','messagetype' => 'direct',),
array('id' => '12','useridfrom' => '1103','useridto' => '2413','message' => 'You\\\'re not Sharon.....','format' => '0','timecreated' => '1266528950','messagetype' => 'direct',),
array('id' => '13','useridfrom' => '2413','useridto' => '2596','message' => 'I\\\'m getting emails  - should I be? Or should that be switched off?
Below is what I received

Hi there,

come and enrol on my awesome course!

suzy


--------------------------------------------------------------------------------

This email is a copy of a message sent to you at \\\"iLearn\\\"','format' => '0','timecreated' => '1266528950','messagetype' => 'direct',),
array('id' => '14','useridfrom' => '1059','useridto' => '1103','message' => 'No
cute photo!','format' => '0','timecreated' => '1266549090','messagetype' => 'direct',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('message', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('message',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('message', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'message');
    // make sure sequence is higher than highest ID
    bump_sequence('message', $CFG->prefix, $maxid);
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
        