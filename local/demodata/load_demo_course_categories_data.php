<?php
@raise_memory_limit('392M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'course_categories'<br>";
$items = array(array('id' => '2','name' => 'Technical','description' => '','parent' => '4','sortorder' => '2','coursecount' => '105','visible' => '1','timemodified' => '0','depth' => '2','path' => '/4/2','theme' => '',),
array('id' => '3','name' => 'Induction','description' => '<p><span style=\\\"font-size: medium;\\\"><span style=\\\"font-family: arial,helvetica,sans-serif;\\\"><span style=\\\"color: #008000;\\\"><span style=\\\"font-size: large;\\\"><span style=\\\"color: #000000;\\\"> </span></span></span></span></span></p>','parent' => '4','sortorder' => '1','coursecount' => '1','visible' => '1','timemodified' => '0','depth' => '2','path' => '/4/3','theme' => '',),
array('id' => '4','name' => 'Learning Programmes','description' => '<p><span style=\\\"font-family: arial,helvetica,sans-serif;\\\"><span style=\\\"font-size: small;\\\"><span style=\\\"font-family: arial,helvetica,sans-serif;\\\"><span style=\\\"font-size: small;\\\"><span style=\\\"font-size: medium;\\\"><img height=\\\"93\\\" src=\\\"http://ilearn.doc.govt.nz/file.php/1/People_at_Tararua_Forest_Park1.jpg\\\" width=\\\"232\\\" />     </span></span></span></span></span> <span style=\\\"color: #008000;\\\"><span style=\\\"font-size: medium;\\\"><span style=\\\"color: #003300;\\\"><span style=\\\"font-family: arial,helvetica,sans-serif;\\\"><span style=\\\"font-family: arial,helvetica,sans-serif;\\\">Welcome to Learning Programmes. Please make your selection from the list below:    </span></span> </span></span></span>
<hr />
</p>','parent' => '0','sortorder' => '1','coursecount' => '0','visible' => '1','timemodified' => '0','depth' => '1','path' => '/4','theme' => '',),
array('id' => '5','name' => 'Leadership','description' => '<p><span style=\\\"font-family: arial,helvetica,sans-serif;\\\"><span style=\\\"font-size: medium;\\\"><img height=\\\"96\\\" src=\\\"http://ilearn.doc.govt.nz/file.php/1/People_Walking1.jpg\\\" width=\\\"273\\\" /></span></span>        <span style=\\\"color: #008000;\\\">    <span style=\\\"color: #003300;\\\"><span style=\\\"font-family: arial,helvetica,sans-serif;\\\"><span style=\\\"font-size: medium;\\\">Welcome to Leadership. Please make your selection from below:                 </span></span> </span></span>
<hr />
</p>','parent' => '0','sortorder' => '2','coursecount' => '0','visible' => '1','timemodified' => '0','depth' => '1','path' => '/5','theme' => '',),
array('id' => '19','name' => 'People and Communities','description' => '','parent' => '4','sortorder' => '9','coursecount' => '0','visible' => '1','timemodified' => '0','depth' => '2','path' => '/4/19','theme' => '',),
array('id' => '97','name' => 'Computer Skills','description' => '','parent' => '4','sortorder' => '3','coursecount' => '4','visible' => '1','timemodified' => '0','depth' => '2','path' => '/4/97','theme' => '',),
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
