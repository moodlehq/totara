<?php
@raise_memory_limit('392M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'report_builder_fbq_1_q'<br>";
$items = array(array('id' => '1','name' => 'This course did all it said it would do.','presentation' => 'Strongly no|No|Neutral|Yes|Strongly yes','typ' => 'dropdown','sortorder' => '1',),
array('id' => '2','name' => 'Did you find it useful, relevant and worthwhile <b>to you?</b>','presentation' => 'Strongly no|No|Neutral|Yes|Strongly yes','typ' => 'dropdown','sortorder' => '2',),
array('id' => '3','name' => 'Did you find it useful, relevant and worthwhile <b>to your job?</b>','presentation' => 'Strongly no|No|Neutral|Yes|Strongly yes','typ' => 'dropdown','sortorder' => '3',),
array('id' => '4','name' => 'What secton of the course did you find the most useful?','presentation' => 'Theory section\\\\r|Examples section\\\\r|Practical workshop','typ' => 'dropdown','sortorder' => '4',),
array('id' => '5','name' => 'What section of the course did you find the least useful?','presentation' => 'Theory section\\\\r|Examples section\\\\r|Practical workshop','typ' => 'dropdown','sortorder' => '5',),
array('id' => '6','name' => 'It was well presented - interesting, engaging and understandable?','presentation' => 'Strongly no|No|Neutral|Yes|Strongly yes','typ' => 'dropdown','sortorder' => '6',),
array('id' => '7','name' => 'Do you have any comments that you wish to make that will help us improve this course?','presentation' => '50|10','typ' => 'textarea','sortorder' => '7',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('report_builder_fbq_1_q', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('report_builder_fbq_1_q',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('report_builder_fbq_1_q', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'report_builder_fbq_1_q');
    // make sure sequence is higher than highest ID
    bump_sequence('report_builder_fbq_1_q', $CFG->prefix, $maxid);
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
        