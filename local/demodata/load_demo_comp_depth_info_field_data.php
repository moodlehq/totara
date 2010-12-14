<?php
@raise_memory_limit('496M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'comp_depth_info_field'<br>";
$items = array(array('id' => '1','fullname' => 'example checkbox','shortname' => 'examplecheckbox','depthid' => '1','datatype' => 'checkbox','description' => '<p>test</p>','sortorder' => '1','categoryid' => '4','hidden' => '0','locked' => '0','required' => '0','forceunique' => '0','defaultdata' => '1',),
array('id' => '2','fullname' => 'example menu','shortname' => 'examplemenu','depthid' => '1','datatype' => 'menu','description' => '<p>example menu</p>','sortorder' => '2','categoryid' => '4','hidden' => '0','locked' => '0','required' => '0','forceunique' => '0','defaultdata' => '1','param1' => '1
2
3',),
array('id' => '3','fullname' => 'example text area','shortname' => 'exampletextarea','depthid' => '1','datatype' => 'textarea','description' => '','sortorder' => '1','categoryid' => '5','hidden' => '0','locked' => '0','required' => '0','forceunique' => '0','defaultdata' => '','param1' => '30','param2' => '10',),
array('id' => '4','fullname' => 'text input','shortname' => 'textinput','depthid' => '1','datatype' => 'text','description' => '','sortorder' => '2','categoryid' => '5','hidden' => '0','locked' => '0','required' => '0','forceunique' => '0','defaultdata' => '','param1' => '30','param2' => '2048','param3' => '0',),
array('id' => '5','fullname' => 'test','shortname' => 'test','depthid' => '4','datatype' => 'textarea','description' => '','sortorder' => '1','categoryid' => '1','hidden' => '1','locked' => '0','required' => '0','forceunique' => '0','defaultdata' => '','param1' => '30','param2' => '10',),
array('id' => '6','fullname' => 'test','shortname' => 'test','depthid' => '6','datatype' => 'checkbox','description' => '','sortorder' => '1','categoryid' => '3','hidden' => '0','locked' => '0','required' => '0','forceunique' => '0','defaultdata' => '0',),
array('id' => '7','fullname' => 'NZQA Number','shortname' => 'NZQA','depthid' => '9','datatype' => 'text','description' => '','sortorder' => '1','categoryid' => '8','hidden' => '0','locked' => '0','required' => '1','forceunique' => '0','defaultdata' => '','param1' => '30','param2' => '2048',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('comp_depth_info_field', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('comp_depth_info_field',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('comp_depth_info_field', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'comp_depth_info_field');
    // make sure sequence is higher than highest ID
    bump_sequence('comp_depth_info_field', $CFG->prefix, $maxid);
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
        