<?php
@raise_memory_limit('392M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'idp'<br>";
$items = array(array('id' => '2','name' => 'My IDP','startdate' => '1263466800','enddate' => '1271246400','userid' => '2','current' => '0','templateid' => '0',),
array('id' => '3','name' => 'My IDP','startdate' => '1263466800','enddate' => '1271246400','userid' => '2','current' => '0','templateid' => '0',),
array('id' => '4','name' => 'My IDP','startdate' => '1263726000','enddate' => '1271505600','userid' => '2','current' => '0','templateid' => '0',),
array('id' => '6','name' => 'Alex\\\'s Development Plan 2009 - 2010','startdate' => '1246363200','enddate' => '1277812800','userid' => '72','current' => '0','templateid' => '0',),
array('id' => '7','name' => 'Alex\\\'s Development Plan 2010 - 2011','startdate' => '1263726000','enddate' => '1271505600','userid' => '72','current' => '0','templateid' => '0',),
array('id' => '10','name' => 'My IDP','startdate' => '1267786800','enddate' => '1275739200','userid' => '2','current' => '0','templateid' => '0',),
array('id' => '11','name' => 'My IDP','startdate' => '1267959600','enddate' => '1275912000','userid' => '2','current' => '0','templateid' => '0',),
array('id' => '13','name' => 'My IDP','startdate' => '1280404800','enddate' => '1288350000','userid' => '1292','current' => '0','templateid' => '0',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('idp', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('idp',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('idp', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'idp');
    // make sure sequence is higher than highest ID
    bump_sequence('idp', $CFG->prefix, $maxid);
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
        