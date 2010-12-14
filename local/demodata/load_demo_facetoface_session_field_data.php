<?php
@raise_memory_limit('496M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'facetoface_session_field'<br>";
$items = array(array('id' => '1','name' => 'Location','shortname' => 'location','type' => '0','possiblevalues' => '','required' => '0','defaultvalue' => '','isfilter' => '1','showinsummary' => '1',),
array('id' => '2','name' => 'Venue','shortname' => 'venue','type' => '0','possiblevalues' => '','required' => '0','defaultvalue' => '','isfilter' => '1','showinsummary' => '1',),
array('id' => '3','name' => 'Room','shortname' => 'room','type' => '0','possiblevalues' => '','required' => '0','defaultvalue' => '','isfilter' => '1','showinsummary' => '1',),
array('id' => '4','name' => 'Pilot','shortname' => 'pilot','type' => '1','possiblevalues' => 'Yes;No','required' => '0','defaultvalue' => 'No','isfilter' => '1','showinsummary' => '0',),
array('id' => '5','name' => 'Audit','shortname' => 'audit','type' => '1','possiblevalues' => 'Yes;No','required' => '0','defaultvalue' => 'No','isfilter' => '1','showinsummary' => '0',),
array('id' => '6','name' => 'Course Delivery','shortname' => 'coursedelivery','type' => '1','possiblevalues' => 'Internal;External','required' => '0','defaultvalue' => 'Internal','isfilter' => '1','showinsummary' => '0',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('facetoface_session_field', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('facetoface_session_field',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('facetoface_session_field', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'facetoface_session_field');
    // make sure sequence is higher than highest ID
    bump_sequence('facetoface_session_field', $CFG->prefix, $maxid);
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
        