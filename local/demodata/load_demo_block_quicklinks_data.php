<?php
@raise_memory_limit('496M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'block_quicklinks'<br>";
$items = array(array('id' => '1','userid' => '2','block_instance_id' => '2452','title' => 'Home','url' => 'http://totara.moodle.scoggins.wgtn.cat-it.co.nz/index.php','displaypos' => '0',),
array('id' => '2','userid' => '2','block_instance_id' => '2452','title' => 'Reports','url' => 'http://totara.moodle.scoggins.wgtn.cat-it.co.nz/my/reports.php','displaypos' => '1',),
array('id' => '3','userid' => '2','block_instance_id' => '2452','title' => 'Courses','url' => 'http://totara.moodle.scoggins.wgtn.cat-it.co.nz/course/find.php','displaypos' => '2',),
array('id' => '4','userid' => '2','block_instance_id' => '2456','title' => 'Home','url' => 'http://totara.moodle.scoggins.wgtn.cat-it.co.nz/index.php','displaypos' => '0',),
array('id' => '5','userid' => '2','block_instance_id' => '2456','title' => 'Reports','url' => 'http://totara.moodle.scoggins.wgtn.cat-it.co.nz/my/reports.php','displaypos' => '1',),
array('id' => '6','userid' => '2','block_instance_id' => '2456','title' => 'Courses','url' => 'http://totara.moodle.scoggins.wgtn.cat-it.co.nz/course/find.php','displaypos' => '2',),
array('id' => '7','userid' => '1920','block_instance_id' => '2482','title' => 'Home','url' => 'http://demoprep.totaralms.com/index.php','displaypos' => '0',),
array('id' => '8','userid' => '1920','block_instance_id' => '2482','title' => 'Reports','url' => 'http://demoprep.totaralms.com/my/reports.php','displaypos' => '1',),
array('id' => '9','userid' => '1920','block_instance_id' => '2482','title' => 'Courses','url' => 'http://demoprep.totaralms.com/course/find.php','displaypos' => '2',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('block_quicklinks', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('block_quicklinks',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('block_quicklinks', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'block_quicklinks');
    // make sure sequence is higher than highest ID
    bump_sequence('block_quicklinks', $CFG->prefix, $maxid);
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
        