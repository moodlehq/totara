<?php
@raise_memory_limit('496M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'comp_depth'<br>";
$items = array(array('id' => '1','fullname' => 'Unit Standard','shortname' => 'Unit','description' => '','depthlevel' => '1','frameworkid' => '1','timecreated' => '1263433929','timemodified' => '1263433929','usermodified' => '2',),
array('id' => '2','fullname' => 'Qualification','shortname' => 'Qual','description' => '','depthlevel' => '1','frameworkid' => '2','timecreated' => '1263433929','timemodified' => '1263433929','usermodified' => '2',),
array('id' => '3','fullname' => 'Course based competencies','shortname' => 'Course based','depthlevel' => '1','frameworkid' => '3','timecreated' => '1265963591','timemodified' => '1265963591','usermodified' => '0',),
array('id' => '4','fullname' => 'Competency Area','shortname' => 'CA','description' => '','depthlevel' => '1','frameworkid' => '4','timecreated' => '1267736622','timemodified' => '1267736622','usermodified' => '2',),
array('id' => '5','fullname' => 'Competency Heading','shortname' => 'CH','description' => '','depthlevel' => '2','frameworkid' => '4','timecreated' => '1267736644','timemodified' => '1267736644','usermodified' => '2',),
array('id' => '6','fullname' => 'Competencies','shortname' => 'Competencies','description' => '','depthlevel' => '3','frameworkid' => '4','timecreated' => '1267736677','timemodified' => '1267736677','usermodified' => '2',),
array('id' => '7','fullname' => 'Dimension 1','shortname' => 'd1','description' => '','depthlevel' => '1','frameworkid' => '5','timecreated' => '1282795712','timemodified' => '1282795712','usermodified' => '2',),
array('id' => '8','fullname' => 'Dimension 2','shortname' => 'd2','description' => '','depthlevel' => '2','frameworkid' => '5','timecreated' => '1282795759','timemodified' => '1282795759','usermodified' => '2',),
array('id' => '9','fullname' => 'Induction Competencies','shortname' => 'Induction','description' => '','depthlevel' => '1','frameworkid' => '6','timecreated' => '1291931296','timemodified' => '1291931805','usermodified' => '6881',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('comp_depth', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('comp_depth',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('comp_depth', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'comp_depth');
    // make sure sequence is higher than highest ID
    bump_sequence('comp_depth', $CFG->prefix, $maxid);
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
        