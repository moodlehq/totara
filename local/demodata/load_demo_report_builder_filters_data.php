<?php
@raise_memory_limit('392M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'report_builder_filters'<br>";
$items = array(array('id' => '1','reportid' => '7','type' => 'user','value' => 'fullname','sortorder' => '1','advanced' => '0',),
array('id' => '2','reportid' => '7','type' => 'course','value' => 'fullname','sortorder' => '2','advanced' => '1',),
array('id' => '3','reportid' => '7','type' => 'status','value' => 'statuscode','sortorder' => '3','advanced' => '1',),
array('id' => '4','reportid' => '7','type' => 'date','value' => 'sessiondate','sortorder' => '4','advanced' => '1',),
array('id' => '5','reportid' => '7','type' => 'session','value' => 'location','sortorder' => '5','advanced' => '1',),
array('id' => '6','reportid' => '10','type' => 'user','value' => 'fullname','sortorder' => '1','advanced' => '0',),
array('id' => '7','reportid' => '10','type' => 'course','value' => 'fullname','sortorder' => '2','advanced' => '1',),
array('id' => '8','reportid' => '10','type' => 'status','value' => 'statuscode','sortorder' => '3','advanced' => '1',),
array('id' => '9','reportid' => '10','type' => 'date','value' => 'sessiondate','sortorder' => '4','advanced' => '1',),
array('id' => '10','reportid' => '10','type' => 'session','value' => 'location','sortorder' => '5','advanced' => '1',),
array('id' => '11','reportid' => '9','type' => 'user','value' => 'fullname','sortorder' => '1','advanced' => '0',),
array('id' => '12','reportid' => '9','type' => 'course','value' => 'fullname','sortorder' => '2','advanced' => '1',),
array('id' => '13','reportid' => '9','type' => 'status','value' => 'statuscode','sortorder' => '3','advanced' => '1',),
array('id' => '14','reportid' => '9','type' => 'date','value' => 'sessiondate','sortorder' => '4','advanced' => '1',),
array('id' => '15','reportid' => '9','type' => 'session','value' => 'location','sortorder' => '5','advanced' => '1',),
array('id' => '16','reportid' => '6','type' => 'user','value' => 'fullname','sortorder' => '1','advanced' => '0',),
array('id' => '17','reportid' => '6','type' => 'user','value' => 'organisationpath','sortorder' => '2','advanced' => '1',),
array('id' => '18','reportid' => '6','type' => 'competency_evidence','value' => 'organisationpath','sortorder' => '3','advanced' => '1',),
array('id' => '19','reportid' => '6','type' => 'user','value' => 'positionpath','sortorder' => '4','advanced' => '1',),
array('id' => '20','reportid' => '6','type' => 'competency_evidence','value' => 'positionpath','sortorder' => '5','advanced' => '1',),
array('id' => '21','reportid' => '6','type' => 'competency','value' => 'fullname','sortorder' => '6','advanced' => '1',),
array('id' => '22','reportid' => '6','type' => 'competency_evidence','value' => 'completeddate','sortorder' => '7','advanced' => '1',),
array('id' => '23','reportid' => '6','type' => 'competency_evidence','value' => 'proficiencyid','sortorder' => '8','advanced' => '1',),
array('id' => '24','reportid' => '2','type' => 'user','value' => 'fullname','sortorder' => '1','advanced' => '0',),
array('id' => '25','reportid' => '2','type' => 'user','value' => 'organisationpath','sortorder' => '2','advanced' => '1',),
array('id' => '26','reportid' => '2','type' => 'competency_evidence','value' => 'organisationpath','sortorder' => '3','advanced' => '1',),
array('id' => '27','reportid' => '2','type' => 'user','value' => 'positionpath','sortorder' => '4','advanced' => '1',),
array('id' => '28','reportid' => '2','type' => 'competency_evidence','value' => 'positionpath','sortorder' => '5','advanced' => '1',),
array('id' => '29','reportid' => '2','type' => 'competency','value' => 'fullname','sortorder' => '6','advanced' => '1',),
array('id' => '30','reportid' => '2','type' => 'competency_evidence','value' => 'completeddate','sortorder' => '7','advanced' => '1',),
array('id' => '31','reportid' => '2','type' => 'competency','value' => 'idnumber','sortorder' => '8','advanced' => '1',),
array('id' => '32','reportid' => '2','type' => 'competency_evidence','value' => 'proficiencyid','sortorder' => '9','advanced' => '1',),
array('id' => '33','reportid' => '4','type' => 'user','value' => 'fullname','sortorder' => '1','advanced' => '0',),
array('id' => '34','reportid' => '4','type' => 'user','value' => 'organisationpath','sortorder' => '2','advanced' => '1',),
array('id' => '35','reportid' => '4','type' => 'competency_evidence','value' => 'organisationpath','sortorder' => '3','advanced' => '1',),
array('id' => '36','reportid' => '4','type' => 'user','value' => 'positionpath','sortorder' => '4','advanced' => '1',),
array('id' => '37','reportid' => '4','type' => 'competency_evidence','value' => 'positionpath','sortorder' => '5','advanced' => '1',),
array('id' => '38','reportid' => '4','type' => 'competency','value' => 'fullname','sortorder' => '6','advanced' => '1',),
array('id' => '39','reportid' => '4','type' => 'competency_evidence','value' => 'completeddate','sortorder' => '7','advanced' => '1',),
array('id' => '40','reportid' => '4','type' => 'competency_evidence','value' => 'proficiencyid','sortorder' => '8','advanced' => '1',),
array('id' => '41','reportid' => '16','type' => 'user','value' => 'fullname','sortorder' => '1','advanced' => '0',),
array('id' => '42','reportid' => '16','type' => 'log','value' => 'action','sortorder' => '2','advanced' => '0',),
array('id' => '43','reportid' => '16','type' => 'course','value' => 'fullname','sortorder' => '3','advanced' => '1',),
array('id' => '44','reportid' => '16','type' => 'course_category','value' => 'id','sortorder' => '4','advanced' => '1',),
array('id' => '45','reportid' => '16','type' => 'user','value' => 'positionpath','sortorder' => '5','advanced' => '1',),
array('id' => '46','reportid' => '16','type' => 'user','value' => 'organisationpath','sortorder' => '6','advanced' => '1',),
array('id' => '47','reportid' => '11','type' => 'user','value' => 'fullname','sortorder' => '1','advanced' => '0',),
array('id' => '48','reportid' => '11','type' => 'user','value' => 'organisationpath','sortorder' => '2','advanced' => '0',),
array('id' => '49','reportid' => '11','type' => 'course_completion','value' => 'organisationpath','sortorder' => '3','advanced' => '0',),
array('id' => '50','reportid' => '11','type' => 'user','value' => 'positionpath','sortorder' => '4','advanced' => '0',),
array('id' => '51','reportid' => '11','type' => 'course_completion','value' => 'positionpath','sortorder' => '5','advanced' => '0',),
array('id' => '52','reportid' => '11','type' => 'course','value' => 'fullname','sortorder' => '6','advanced' => '0',),
array('id' => '53','reportid' => '11','type' => 'course_category','value' => 'id','sortorder' => '7','advanced' => '0',),
array('id' => '54','reportid' => '11','type' => 'course_completion','value' => 'completeddate','sortorder' => '8','advanced' => '0',),
array('id' => '55','reportid' => '11','type' => 'course_completion','value' => 'status','sortorder' => '9','advanced' => '0',),
array('id' => '56','reportid' => '12','type' => 'user','value' => 'fullname','sortorder' => '1','advanced' => '0',),
array('id' => '57','reportid' => '12','type' => 'user','value' => 'organisationpath','sortorder' => '2','advanced' => '0',),
array('id' => '58','reportid' => '12','type' => 'course_completion','value' => 'organisationpath','sortorder' => '3','advanced' => '0',),
array('id' => '59','reportid' => '12','type' => 'user','value' => 'positionpath','sortorder' => '4','advanced' => '0',),
array('id' => '60','reportid' => '12','type' => 'course_completion','value' => 'positionpath','sortorder' => '5','advanced' => '0',),
array('id' => '61','reportid' => '12','type' => 'course','value' => 'fullname','sortorder' => '6','advanced' => '0',),
array('id' => '62','reportid' => '12','type' => 'course_category','value' => 'id','sortorder' => '7','advanced' => '0',),
array('id' => '63','reportid' => '12','type' => 'course_completion','value' => 'completeddate','sortorder' => '8','advanced' => '0',),
array('id' => '64','reportid' => '12','type' => 'course_completion','value' => 'status','sortorder' => '9','advanced' => '0',),
array('id' => '65','reportid' => '14','type' => 'user','value' => 'fullname','sortorder' => '1','advanced' => '0',),
array('id' => '66','reportid' => '14','type' => 'log','value' => 'action','sortorder' => '2','advanced' => '0',),
array('id' => '67','reportid' => '14','type' => 'course','value' => 'fullname','sortorder' => '3','advanced' => '1',),
array('id' => '68','reportid' => '14','type' => 'course_category','value' => 'id','sortorder' => '4','advanced' => '1',),
array('id' => '69','reportid' => '14','type' => 'user','value' => 'positionpath','sortorder' => '5','advanced' => '1',),
array('id' => '70','reportid' => '14','type' => 'user','value' => 'organisationpath','sortorder' => '6','advanced' => '1',),
array('id' => '77','reportid' => '13','type' => 'user','value' => 'fullname','sortorder' => '1','advanced' => '0',),
array('id' => '78','reportid' => '13','type' => 'user','value' => 'organisationpath','sortorder' => '2','advanced' => '0',),
array('id' => '79','reportid' => '13','type' => 'course_completion','value' => 'organisationpath','sortorder' => '3','advanced' => '0',),
array('id' => '80','reportid' => '13','type' => 'user','value' => 'positionpath','sortorder' => '4','advanced' => '0',),
array('id' => '81','reportid' => '13','type' => 'course_completion','value' => 'positionpath','sortorder' => '5','advanced' => '0',),
array('id' => '82','reportid' => '13','type' => 'course','value' => 'fullname','sortorder' => '6','advanced' => '0',),
array('id' => '83','reportid' => '13','type' => 'course_category','value' => 'id','sortorder' => '7','advanced' => '0',),
array('id' => '84','reportid' => '13','type' => 'course_completion','value' => 'completeddate','sortorder' => '8','advanced' => '0',),
array('id' => '85','reportid' => '13','type' => 'course_completion','value' => 'status','sortorder' => '9','advanced' => '0',),
array('id' => '86','reportid' => '21','type' => 'feedback','value' => 'name','sortorder' => '1','advanced' => '0',),
array('id' => '89','reportid' => '22','type' => 'course_completion','value' => 'organisationpath','sortorder' => '1','advanced' => '0',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('report_builder_filters', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('report_builder_filters',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('report_builder_filters', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'report_builder_filters');
    // make sure sequence is higher than highest ID
    bump_sequence('report_builder_filters', $CFG->prefix, $maxid);
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
        