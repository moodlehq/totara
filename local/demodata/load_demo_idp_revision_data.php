<?php
@raise_memory_limit('392M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'idp_revision'<br>";
$items = array(array('id' => '2','ctime' => '1263514731','mtime' => '1263516061','submittedtime' => '1263516061','visible' => '1','idp' => '2',),
array('id' => '3','ctime' => '1263525474','mtime' => '1263525626','submittedtime' => '1263525626','visible' => '1','idp' => '3',),
array('id' => '4','ctime' => '1263767357','mtime' => '1263767492','submittedtime' => '1263767492','visible' => '1','idp' => '4',),
array('id' => '6','ctime' => '1263773710','mtime' => '1263773710','visible' => '0','idp' => '6',),
array('id' => '7','ctime' => '1263773975','mtime' => '1263773975','visible' => '0','idp' => '7',),
array('id' => '10','ctime' => '1267854410','mtime' => '1280459256','visible' => '0','idp' => '10',),
array('id' => '11','ctime' => '1268002425','mtime' => '1280459152','visible' => '0','idp' => '11',),
array('id' => '13','ctime' => '1280460950','mtime' => '1280462694','visible' => '0','idp' => '13',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('idp_revision', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('idp_revision',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('idp_revision', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'idp_revision');
    // make sure sequence is higher than highest ID
    bump_sequence('idp_revision', $CFG->prefix, $maxid);
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
        