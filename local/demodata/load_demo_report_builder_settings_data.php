<?php
@raise_memory_limit('392M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'report_builder_settings'<br>";
$items = array(array('id' => '1','reportid' => '10','type' => 'current_org_content','name' => 'enable','value' => '1',),
array('id' => '2','reportid' => '10','type' => 'current_org_content','name' => 'recursive','value' => '1',),
array('id' => '3','reportid' => '10','type' => 'completed_org_content','name' => 'enable','value' => '1',),
array('id' => '4','reportid' => '10','type' => 'completed_org_content','name' => 'recursive','value' => '1',),
array('id' => '5','reportid' => '16','type' => 'user_content','name' => 'enable','value' => '1',),
array('id' => '6','reportid' => '16','type' => 'user_content','name' => 'who','value' => 'reports',),
array('id' => '7','reportid' => '12','type' => 'current_org_content','name' => 'enable','value' => '1',),
array('id' => '8','reportid' => '12','type' => 'current_org_content','name' => 'recursive','value' => '1',),
array('id' => '9','reportid' => '12','type' => 'completed_org_content','name' => 'enable','value' => '1',),
array('id' => '10','reportid' => '12','type' => 'completed_org_content','name' => 'recursive','value' => '1',),
array('id' => '11','reportid' => '6','type' => 'current_org_content','name' => 'enable','value' => '1',),
array('id' => '12','reportid' => '6','type' => 'current_org_content','name' => 'recursive','value' => '1',),
array('id' => '13','reportid' => '6','type' => 'completed_org_content','name' => 'enable','value' => '1',),
array('id' => '14','reportid' => '6','type' => 'completed_org_content','name' => 'recursive','value' => '1',),
array('id' => '15','reportid' => '4','type' => 'user_content','name' => 'enable','value' => '1',),
array('id' => '16','reportid' => '4','type' => 'user_content','name' => 'who','value' => 'reports',),
array('id' => '17','reportid' => '9','type' => 'user_content','name' => 'enable','value' => '1',),
array('id' => '18','reportid' => '9','type' => 'user_content','name' => 'who','value' => 'reports',),
array('id' => '19','reportid' => '17','type' => 'date_content','name' => 'enable','value' => '1',),
array('id' => '20','reportid' => '17','type' => 'date_content','name' => 'when','value' => 'future',),
array('id' => '21','reportid' => '18','type' => 'date_content','name' => 'enable','value' => '1',),
array('id' => '22','reportid' => '18','type' => 'date_content','name' => 'when','value' => 'past',),
array('id' => '23','reportid' => '13','type' => 'user_content','name' => 'enable','value' => '1',),
array('id' => '24','reportid' => '13','type' => 'user_content','name' => 'who','value' => 'reports',),
array('id' => '25','reportid' => '7','type' => 'role_access','name' => 'activeroles','value' => '1',),
array('id' => '26','reportid' => '7','type' => 'role_access','name' => 'enable','value' => '1',),
array('id' => '27','reportid' => '10','type' => 'role_access','name' => 'activeroles','value' => '12|1',),
array('id' => '28','reportid' => '10','type' => 'role_access','name' => 'enable','value' => '1',),
array('id' => '29','reportid' => '9','type' => 'role_access','name' => 'activeroles','value' => '3|15|5|16|10|8',),
array('id' => '30','reportid' => '9','type' => 'role_access','name' => 'enable','value' => '1',),
array('id' => '31','reportid' => '6','type' => 'role_access','name' => 'activeroles','value' => '12|1',),
array('id' => '32','reportid' => '6','type' => 'role_access','name' => 'enable','value' => '1',),
array('id' => '33','reportid' => '2','type' => 'role_access','name' => 'activeroles','value' => '1',),
array('id' => '34','reportid' => '2','type' => 'role_access','name' => 'enable','value' => '1',),
array('id' => '35','reportid' => '4','type' => 'role_access','name' => 'activeroles','value' => '3|15|5|16|10|8',),
array('id' => '36','reportid' => '4','type' => 'role_access','name' => 'enable','value' => '1',),
array('id' => '37','reportid' => '16','type' => 'role_access','name' => 'activeroles','value' => '3|15|5|16|10|1',),
array('id' => '38','reportid' => '16','type' => 'role_access','name' => 'enable','value' => '1',),
array('id' => '39','reportid' => '11','type' => 'role_access','name' => 'activeroles','value' => '1',),
array('id' => '40','reportid' => '11','type' => 'role_access','name' => 'enable','value' => '1',),
array('id' => '41','reportid' => '12','type' => 'role_access','name' => 'activeroles','value' => '12|1',),
array('id' => '42','reportid' => '12','type' => 'role_access','name' => 'enable','value' => '1',),
array('id' => '43','reportid' => '14','type' => 'role_access','name' => 'activeroles','value' => '1',),
array('id' => '44','reportid' => '14','type' => 'role_access','name' => 'enable','value' => '1',),
array('id' => '45','reportid' => '13','type' => 'role_access','name' => 'activeroles','value' => '3|15|5|16|10|8',),
array('id' => '46','reportid' => '13','type' => 'role_access','name' => 'enable','value' => '1',),
array('id' => '47','reportid' => '21','type' => 'role_access','name' => 'enable','value' => '1',),
array('id' => '48','reportid' => '21','type' => 'role_access','name' => 'activeroles','value' => '1',),
array('id' => '49','reportid' => '21','type' => 'user_content','name' => 'enable','value' => '0',),
array('id' => '50','reportid' => '21','type' => 'user_content','name' => 'who','value' => '0',),
array('id' => '51','reportid' => '21','type' => 'current_pos_content','name' => 'enable','value' => '0',),
array('id' => '52','reportid' => '21','type' => 'current_pos_content','name' => 'recursive','value' => '0',),
array('id' => '53','reportid' => '21','type' => 'current_org_content','name' => 'enable','value' => '0',),
array('id' => '54','reportid' => '21','type' => 'current_org_content','name' => 'recursive','value' => '0',),
array('id' => '55','reportid' => '21','type' => 'course_tag_content','name' => 'enable','value' => '1',),
array('id' => '56','reportid' => '21','type' => 'course_tag_content','name' => 'include_logic','value' => '0',),
array('id' => '57','reportid' => '21','type' => 'course_tag_content','name' => 'exclude_logic','value' => '0',),
array('id' => '58','reportid' => '21','type' => 'course_tag_content','name' => 'included','value' => '9',),
array('id' => '59','reportid' => '21','type' => 'course_tag_content','name' => 'excluded','value' => '',),
array('id' => '60','reportid' => '21','type' => 'trainer_content','name' => 'enable','value' => '0',),
array('id' => '61','reportid' => '21','type' => 'trainer_content','name' => 'who','value' => '0',),
array('id' => '62','reportid' => '21','type' => 'date_content','name' => 'enable','value' => '0',),
array('id' => '63','reportid' => '21','type' => 'date_content','name' => 'when','value' => '0',),
array('id' => '64','reportid' => '21','type' => 'date_content','name' => 'incnulls','value' => '0',),
array('id' => '65','reportid' => '22','type' => 'role_access','name' => 'enable','value' => '1',),
array('id' => '66','reportid' => '22','type' => 'role_access','name' => 'activeroles','value' => '1',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('report_builder_settings', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('report_builder_settings',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('report_builder_settings', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'report_builder_settings');
    // make sure sequence is higher than highest ID
    bump_sequence('report_builder_settings', $CFG->prefix, $maxid);
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
        