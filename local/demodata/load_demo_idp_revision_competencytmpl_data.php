<?php
@raise_memory_limit('392M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'idp_revision_competencytmpl'<br>";
$items = array(array('id' => '2','revision' => '10','competencytemplate' => '2','ctime' => '1267952610','duedate' => '1290078000',),
array('id' => '3','revision' => '10','competencytemplate' => '1','ctime' => '1267953293','duedate' => '1290078000',),
array('id' => '4','revision' => '10','competencytemplate' => '2','ctime' => '1267955290','duedate' => '1290078000',),
array('id' => '5','revision' => '10','competencytemplate' => '2','ctime' => '1267955291','duedate' => '1290078000',),
array('id' => '6','revision' => '10','competencytemplate' => '1','ctime' => '1268001617','duedate' => '1290078000',),
array('id' => '7','revision' => '10','competencytemplate' => '2','ctime' => '1268001617','duedate' => '1290078000',),
array('id' => '8','revision' => '10','competencytemplate' => '2','ctime' => '1268001617','duedate' => '1290078000',),
array('id' => '9','revision' => '10','competencytemplate' => '2','ctime' => '1268001645','duedate' => '1290078000',),
array('id' => '10','revision' => '10','competencytemplate' => '1','ctime' => '1268001645','duedate' => '1290078000',),
array('id' => '11','revision' => '10','competencytemplate' => '4','ctime' => '1268001747','duedate' => '1290078000',),
array('id' => '12','revision' => '10','competencytemplate' => '3','ctime' => '1268001747','duedate' => '1290078000',),
array('id' => '13','revision' => '10','competencytemplate' => '2','ctime' => '1268001858','duedate' => '1290078000',),
array('id' => '14','revision' => '10','competencytemplate' => '4','ctime' => '1268001858','duedate' => '1290078000',),
array('id' => '15','revision' => '10','competencytemplate' => '3','ctime' => '1268001858','duedate' => '1290078000',),
array('id' => '16','revision' => '11','competencytemplate' => '2','ctime' => '1268012138','duedate' => '1281528000',),
array('id' => '17','revision' => '11','competencytemplate' => '1','ctime' => '1268012138','duedate' => '1281528000',),
array('id' => '18','revision' => '11','competencytemplate' => '4','ctime' => '1268012138','duedate' => '1281528000',),
array('id' => '19','revision' => '11','competencytemplate' => '3','ctime' => '1268012138','duedate' => '1281528000',),
array('id' => '20','revision' => '11','competencytemplate' => '1','ctime' => '1268012235','duedate' => '1281528000',),
array('id' => '21','revision' => '11','competencytemplate' => '2','ctime' => '1268012235','duedate' => '1281528000',),
array('id' => '22','revision' => '11','competencytemplate' => '4','ctime' => '1268012235','duedate' => '1281528000',),
array('id' => '23','revision' => '11','competencytemplate' => '3','ctime' => '1268012235','duedate' => '1281528000',),
array('id' => '28','revision' => '13','competencytemplate' => '1','ctime' => '1280462121','duedate' => '1279195200',),
array('id' => '29','revision' => '13','competencytemplate' => '2','ctime' => '1280462684',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('idp_revision_competencytmpl', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('idp_revision_competencytmpl',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('idp_revision_competencytmpl', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'idp_revision_competencytmpl');
    // make sure sequence is higher than highest ID
    bump_sequence('idp_revision_competencytmpl', $CFG->prefix, $maxid);
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
        