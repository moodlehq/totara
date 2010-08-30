<?php
@raise_memory_limit('392M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'tag'<br>";
$items = array(array('id' => '1','userid' => '6857','name' => 'travel','rawname' => 'Travel','tagtype' => 'default','descriptionformat' => '0','flag' => '0','timemodified' => '1266372797',),
array('id' => '2','userid' => '6857','name' => 'walking','rawname' => 'Walking','tagtype' => 'default','descriptionformat' => '0','flag' => '0','timemodified' => '1266372797',),
array('id' => '3','userid' => '6857','name' => 'golf','rawname' => 'golf','tagtype' => 'default','descriptionformat' => '0','flag' => '0','timemodified' => '1266372797',),
array('id' => '4','userid' => '6857','name' => 'reading','rawname' => 'reading','tagtype' => 'default','descriptionformat' => '0','flag' => '0','timemodified' => '1266372797',),
array('id' => '5','userid' => '6857','name' => 'cinema','rawname' => 'cinema','tagtype' => 'default','descriptionformat' => '0','flag' => '0','timemodified' => '1266372797',),
array('id' => '6','userid' => '6857','name' => 'theatre and galleries','rawname' => 'theatre and galleries','tagtype' => 'default','descriptionformat' => '0','flag' => '0','timemodified' => '1266372797',),
array('id' => '7','userid' => '6857','name' => 'good food and wine.','rawname' => 'good food and wine.','tagtype' => 'default','descriptionformat' => '0','flag' => '0','timemodified' => '1266372797',),
array('id' => '8','userid' => '2','name' => 'evaluation','rawname' => 'evaluation','tagtype' => 'official','descriptionformat' => '0','flag' => '0','timemodified' => '1282789612',),
array('id' => '9','userid' => '2','name' => 'core','rawname' => 'core','tagtype' => 'official','descriptionformat' => '0','flag' => '0','timemodified' => '1283124368',),
array('id' => '10','userid' => '2','name' => 'specialist','rawname' => 'specialist','tagtype' => 'official','descriptionformat' => '0','flag' => '0','timemodified' => '1283124375',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('tag', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('tag',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('tag', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'tag');
    // make sure sequence is higher than highest ID
    bump_sequence('tag', $CFG->prefix, $maxid);
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
        