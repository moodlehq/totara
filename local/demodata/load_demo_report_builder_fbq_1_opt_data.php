<?php
@raise_memory_limit('392M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'report_builder_fbq_1_opt'<br>";
$items = array(array('id' => '1','qid' => '1','name' => 'Strongly no','sortorder' => '1',),
array('id' => '2','qid' => '1','name' => 'No','sortorder' => '2',),
array('id' => '3','qid' => '1','name' => 'Neutral','sortorder' => '3',),
array('id' => '4','qid' => '1','name' => 'Yes','sortorder' => '4',),
array('id' => '5','qid' => '1','name' => 'Strongly yes','sortorder' => '5',),
array('id' => '6','qid' => '2','name' => 'Strongly no','sortorder' => '1',),
array('id' => '7','qid' => '2','name' => 'No','sortorder' => '2',),
array('id' => '8','qid' => '2','name' => 'Neutral','sortorder' => '3',),
array('id' => '9','qid' => '2','name' => 'Yes','sortorder' => '4',),
array('id' => '10','qid' => '2','name' => 'Strongly yes','sortorder' => '5',),
array('id' => '11','qid' => '3','name' => 'Strongly no','sortorder' => '1',),
array('id' => '12','qid' => '3','name' => 'No','sortorder' => '2',),
array('id' => '13','qid' => '3','name' => 'Neutral','sortorder' => '3',),
array('id' => '14','qid' => '3','name' => 'Yes','sortorder' => '4',),
array('id' => '15','qid' => '3','name' => 'Strongly yes','sortorder' => '5',),
array('id' => '16','qid' => '4','name' => 'Theory Section','sortorder' => '1',),
array('id' => '17','qid' => '4','name' => 'Examples Section','sortorder' => '2',),
array('id' => '18','qid' => '4','name' => 'Practical workshop','sortorder' => '3',),
array('id' => '19','qid' => '5','name' => 'Theory Section','sortorder' => '1',),
array('id' => '20','qid' => '5','name' => 'Examples Section','sortorder' => '2',),
array('id' => '21','qid' => '5','name' => 'Practical workshop','sortorder' => '3',),
array('id' => '22','qid' => '6','name' => 'Strongly no','sortorder' => '1',),
array('id' => '23','qid' => '6','name' => 'No','sortorder' => '2',),
array('id' => '24','qid' => '6','name' => 'Neutral','sortorder' => '3',),
array('id' => '25','qid' => '6','name' => 'Yes','sortorder' => '4',),
array('id' => '26','qid' => '6','name' => 'Strongly yes','sortorder' => '5',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('report_builder_fbq_1_opt', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('report_builder_fbq_1_opt',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('report_builder_fbq_1_opt', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'report_builder_fbq_1_opt');
    // make sure sequence is higher than highest ID
    bump_sequence('report_builder_fbq_1_opt', $CFG->prefix, $maxid);
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
        