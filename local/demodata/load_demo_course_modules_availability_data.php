<?php
@raise_memory_limit('496M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'course_modules_availability'<br>";
$items = array(array('id' => '35','coursemoduleid' => '667','gradeitemid' => '388',),
array('id' => '36','coursemoduleid' => '667','sourcecmid' => '667','requiredcompletion' => '1',),
array('id' => '39','coursemoduleid' => '832','sourcecmid' => '831','requiredcompletion' => '1',),
array('id' => '40','coursemoduleid' => '974','sourcecmid' => '963','requiredcompletion' => '1',),
array('id' => '41','coursemoduleid' => '921','gradeitemid' => '442','grademin' => '80.00000',),
array('id' => '42','coursemoduleid' => '968','sourcecmid' => '988','requiredcompletion' => '1',),
array('id' => '43','coursemoduleid' => '978','sourcecmid' => '982','requiredcompletion' => '1',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('course_modules_availability', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('course_modules_availability',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('course_modules_availability', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'course_modules_availability');
    // make sure sequence is higher than highest ID
    bump_sequence('course_modules_availability', $CFG->prefix, $maxid);
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
        