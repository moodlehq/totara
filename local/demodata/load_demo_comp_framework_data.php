<?php
@raise_memory_limit('496M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'comp_framework'<br>";
$items = array(array('id' => '1','fullname' => 'Unit Standards','shortname' => 'Units','idnumber' => '','description' => '','sortorder' => '2','visible' => '1','hidecustomfields' => '1','showitemfullname' => '1','showdepthfullname' => '1','timecreated' => '1263433929','timemodified' => '1263433929','usermodified' => '2',),
array('id' => '2','fullname' => 'Qualifications','shortname' => 'Quals','idnumber' => '','description' => '','sortorder' => '3','visible' => '1','hidecustomfields' => '0','showitemfullname' => '1','showdepthfullname' => '1','timecreated' => '1263433929','timemodified' => '1263433929','usermodified' => '2',),
array('id' => '3','fullname' => 'Course based competencies','shortname' => 'Course based','sortorder' => '1','visible' => '1','hidecustomfields' => '0','showitemfullname' => '1','showdepthfullname' => '1','timecreated' => '1265963591','timemodified' => '1265963591','usermodified' => '0',),
array('id' => '4','fullname' => 'Sample framework','shortname' => 'Sample framework','idnumber' => '','description' => '','sortorder' => '4','visible' => '1','hidecustomfields' => '0','showitemfullname' => '1','showdepthfullname' => '1','timecreated' => '1267736603','timemodified' => '1267736603','usermodified' => '2',),
array('id' => '5','fullname' => 'European e-Competence Framework','shortname' => 'e-Competence','idnumber' => '','description' => '<p>European e-Competence Framework version 1.0</p>','sortorder' => '5','visible' => '1','hidecustomfields' => '0','showitemfullname' => '1','showdepthfullname' => '1','timecreated' => '1282795685','timemodified' => '1282795685','usermodified' => '2',),
array('id' => '6','fullname' => 'Generic Company Competencies','shortname' => 'Gen Comps','idnumber' => '','description' => '','sortorder' => '6','visible' => '1','hidecustomfields' => '0','showitemfullname' => '0','showdepthfullname' => '0','timecreated' => '1291931221','timemodified' => '1291931221','usermodified' => '6881',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('comp_framework', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('comp_framework',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('comp_framework', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'comp_framework');
    // make sure sequence is higher than highest ID
    bump_sequence('comp_framework', $CFG->prefix, $maxid);
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
        