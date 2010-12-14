<?php
@raise_memory_limit('496M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'pos'<br>";
$items = array(array('id' => '1','fullname' => 'Data Analyst','shortname' => 'Data Analyst','idnumber' => 'DATA1','description' => '','frameworkid' => '1','path' => '/1','depthid' => '1','parentid' => '0','sortorder' => '1','visible' => '1','timevalidfrom' => '0','timevalidto' => '0','timecreated' => '0','timemodified' => '1267682496','usermodified' => '2',),
array('id' => '2','fullname' => 'Programme Manager','shortname' => 'ProgrammeManager','idnumber' => 'PROG2','description' => '','frameworkid' => '1','path' => '/2','depthid' => '1','parentid' => '0','sortorder' => '2','visible' => '1','timevalidfrom' => '0','timevalidto' => '0','timecreated' => '0','timemodified' => '0','usermodified' => '2',),
array('id' => '3','fullname' => 'Area Manager','shortname' => 'AreaManager','idnumber' => 'AREA3','description' => '','frameworkid' => '1','path' => '/3','depthid' => '1','parentid' => '0','sortorder' => '3','visible' => '1','timevalidfrom' => '0','timevalidto' => '0','timecreated' => '0','timemodified' => '0','usermodified' => '2',),
array('id' => '4','fullname' => 'Administrator','shortname' => 'Administrator','idnumber' => 'ADMI4','description' => '','frameworkid' => '1','path' => '/4','depthid' => '1','parentid' => '0','sortorder' => '4','visible' => '1','timevalidfrom' => '0','timevalidto' => '0','timecreated' => '0','timemodified' => '0','usermodified' => '2',),
array('id' => '5','fullname' => 'Supervisor','shortname' => 'Supervisor','idnumber' => 'SUPE5','description' => '','frameworkid' => '1','path' => '/5','depthid' => '1','parentid' => '0','sortorder' => '5','visible' => '1','timevalidfrom' => '0','timevalidto' => '0','timecreated' => '0','timemodified' => '0','usermodified' => '2',),
array('id' => '6','fullname' => 'Regional Manager','shortname' => 'Regional Manager','idnumber' => 'REGI6','description' => '','frameworkid' => '1','path' => '/6','depthid' => '1','parentid' => '0','sortorder' => '6','visible' => '1','timevalidfrom' => '0','timevalidto' => '0','timecreated' => '0','timemodified' => '1267682534','usermodified' => '2',),
array('id' => '7','fullname' => 'General Manager','shortname' => 'GeneralManager','idnumber' => 'GENE7','description' => '','frameworkid' => '1','path' => '/7','depthid' => '1','parentid' => '0','sortorder' => '7','visible' => '1','timevalidfrom' => '0','timevalidto' => '0','timecreated' => '0','timemodified' => '0','usermodified' => '2',),
array('id' => '8','fullname' => 'Personal Assistant','shortname' => 'PersonalAssistant','idnumber' => 'PERS8','description' => '','frameworkid' => '1','path' => '/8','depthid' => '1','parentid' => '0','sortorder' => '8','visible' => '1','timevalidfrom' => '0','timevalidto' => '0','timecreated' => '0','timemodified' => '0','usermodified' => '2',),
array('id' => '9','fullname' => 'Manager (L2-L3)','shortname' => 'ManagerL2-L3','idnumber' => 'MANA9','description' => '','frameworkid' => '1','path' => '/9','depthid' => '1','parentid' => '0','sortorder' => '9','visible' => '1','timevalidfrom' => '0','timevalidto' => '0','timecreated' => '0','timemodified' => '0','usermodified' => '2',),
array('id' => '10','fullname' => 'Officer','shortname' => 'Officer','idnumber' => 'OFFI10','description' => '','frameworkid' => '1','path' => '/10','depthid' => '1','parentid' => '0','sortorder' => '10','visible' => '1','timevalidfrom' => '0','timevalidto' => '0','timecreated' => '0','timemodified' => '0','usermodified' => '2',),
array('id' => '11','fullname' => 'Advisor','shortname' => 'Advisor','idnumber' => 'ADVI11','description' => '','frameworkid' => '1','path' => '/11','depthid' => '1','parentid' => '0','sortorder' => '11','visible' => '1','timevalidfrom' => '0','timevalidto' => '0','timecreated' => '0','timemodified' => '0','usermodified' => '2',),
array('id' => '12','fullname' => 'Solicitor','shortname' => 'Solicitor','idnumber' => 'SOLI12','description' => '','frameworkid' => '1','path' => '/12','depthid' => '1','parentid' => '0','sortorder' => '12','visible' => '1','timevalidfrom' => '0','timevalidto' => '0','timecreated' => '0','timemodified' => '0','usermodified' => '2',),
array('id' => '13','fullname' => 'Analyst','shortname' => 'Analyst','idnumber' => 'ANAL13','description' => '','frameworkid' => '1','path' => '/13','depthid' => '1','parentid' => '0','sortorder' => '13','visible' => '1','timevalidfrom' => '0','timevalidto' => '0','timecreated' => '0','timemodified' => '0','usermodified' => '2',),
array('id' => '14','fullname' => 'Other','shortname' => 'Other','idnumber' => 'OTHE14','description' => '','frameworkid' => '1','path' => '/14','depthid' => '1','parentid' => '0','sortorder' => '14','visible' => '1','timevalidfrom' => '0','timevalidto' => '0','timecreated' => '0','timemodified' => '0','usermodified' => '2',),
array('id' => '15','fullname' => 'External','shortname' => 'External','idnumber' => 'EXTE15','description' => '','frameworkid' => '1','path' => '/15','depthid' => '1','parentid' => '0','sortorder' => '15','visible' => '1','timevalidfrom' => '0','timevalidto' => '0','timecreated' => '0','timemodified' => '0','usermodified' => '2',),
array('id' => '18','fullname' => 'Regional Manager','shortname' => 'RM','idnumber' => '','description' => '','frameworkid' => '2','path' => '/18','depthid' => '3','parentid' => '0','sortorder' => '1','visible' => '1','timecreated' => '1291930894','timemodified' => '1291930894','usermodified' => '6881',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('pos', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('pos',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('pos', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'pos');
    // make sure sequence is higher than highest ID
    bump_sequence('pos', $CFG->prefix, $maxid);
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
        