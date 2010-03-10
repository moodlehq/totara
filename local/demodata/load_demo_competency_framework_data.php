<?php
@raise_memory_limit('392M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'competency_framework'<br>";
$items = array(array('id' => '1','fullname' => 'Unit Standards','shortname' => 'Units','idnumber' => '','description' => '','isdefault' => '1','sortorder' => '2','visible' => '1','hidecustomfields' => '0','showitemfullname' => '1','showdepthfullname' => '1','timecreated' => '1263433929','timemodified' => '1263433929','usermodified' => '2',),
array('id' => '2','fullname' => 'Qualifications','shortname' => 'Quals','idnumber' => '','description' => '','isdefault' => '0','sortorder' => '1','visible' => '1','hidecustomfields' => '0','showitemfullname' => '1','showdepthfullname' => '1','timecreated' => '1263433929','timemodified' => '1263433929','usermodified' => '2',),
array('id' => '3','fullname' => 'Course based competencies','shortname' => 'Course based','idnumber' => '','description' => '','isdefault' => '0','sortorder' => '3','visible' => '1','hidecustomfields' => '0','showitemfullname' => '1','showdepthfullname' => '1','timecreated' => '1265963591','timemodified' => '1265963591','usermodified' => '0',),
array('id' => '4','fullname' => 'Sample framework','shortname' => 'Sample framework','idnumber' => '','description' => '','isdefault' => '0','sortorder' => '4','visible' => '1','hidecustomfields' => '0','showitemfullname' => '1','showdepthfullname' => '1','timecreated' => '1267736603','timemodified' => '1267736603','usermodified' => '2',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('competency_framework', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('competency_framework',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('competency_framework', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'competency_framework');
    // make sure sequence is higher than highest ID
    bump_sequence('competency_framework', $CFG->prefix, $maxid);
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
