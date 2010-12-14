<?php
@raise_memory_limit('496M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'user_info_field'<br>";
$items = array(array('id' => '5','shortname' => 'datejoined','name' => 'Date Joined','datatype' => 'text','description' => '','categoryid' => '1','sortorder' => '1','required' => '0','locked' => '0','visible' => '1','forceunique' => '0','signup' => '0','defaultdata' => '','param1' => '30','param2' => '2048','param3' => '0','param4' => '','param5' => '',),
array('id' => '7','shortname' => 'ccentcode','name' => 'Cost Centre Code','datatype' => 'text','description' => '','categoryid' => '1','sortorder' => '2','required' => '0','locked' => '0','visible' => '0','forceunique' => '0','signup' => '0','defaultdata' => '','param1' => '30','param2' => '2048','param3' => '0','param4' => '','param5' => '',),
array('id' => '8','shortname' => 'IDNumber','name' => 'ID Number','datatype' => 'text','description' => '','categoryid' => '1','sortorder' => '3','required' => '0','locked' => '0','visible' => '1','forceunique' => '0','signup' => '0','defaultdata' => '','param1' => '30','param2' => '2048','param3' => '0','param4' => '','param5' => '',),
array('id' => '12','shortname' => 'nzqaid','name' => 'NZQA ID','datatype' => 'text','description' => '','categoryid' => '1','sortorder' => '4','required' => '0','locked' => '0','visible' => '1','forceunique' => '0','signup' => '0','defaultdata' => '','param1' => '30','param2' => '2048','param3' => '0','param4' => '','param5' => '',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('user_info_field', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('user_info_field',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('user_info_field', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'user_info_field');
    // make sure sequence is higher than highest ID
    bump_sequence('user_info_field', $CFG->prefix, $maxid);
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
        