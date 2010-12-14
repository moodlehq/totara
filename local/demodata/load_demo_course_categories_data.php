<?php
@raise_memory_limit('496M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'course_categories'<br>";
$items = array(array('id' => '2','name' => 'Technical','parent' => '4','sortorder' => '2','coursecount' => '105','visible' => '1','timemodified' => '0','depth' => '2','path' => '/4/2','icon' => '',),
array('id' => '3','name' => 'Induction','parent' => '4','sortorder' => '1','coursecount' => '3','visible' => '1','timemodified' => '0','depth' => '2','path' => '/4/3','theme' => '','icon' => '',),
array('id' => '4','name' => 'Learning Programmes','parent' => '0','sortorder' => '1','coursecount' => '0','visible' => '1','timemodified' => '0','depth' => '1','path' => '/4','theme' => '','icon' => '',),
array('id' => '5','name' => 'Leadership','parent' => '0','sortorder' => '2','coursecount' => '0','visible' => '1','timemodified' => '0','depth' => '1','path' => '/5','theme' => '','icon' => '',),
array('id' => '19','name' => 'People and Communities','parent' => '4','sortorder' => '9','coursecount' => '0','visible' => '1','timemodified' => '0','depth' => '2','path' => '/4/19','icon' => '',),
array('id' => '97','name' => 'Computer Skills','parent' => '4','sortorder' => '3','coursecount' => '4','visible' => '1','timemodified' => '0','depth' => '2','path' => '/4/97','theme' => '','icon' => '',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('course_categories', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('course_categories',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('course_categories', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'course_categories');
    // make sure sequence is higher than highest ID
    bump_sequence('course_categories', $CFG->prefix, $maxid);
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
        