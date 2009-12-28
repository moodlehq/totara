<?php

// Import custom fields for DOC

$customfields = array(
    array('shortname'=>'title','name'=>'Title','datatype'=>'text','description'=>'','categoryid'=>1,'sortorder'=>1,'required'=>0,'locked'=>0,'visible'=>2,'forceunique'=>0,'signup'=>0,'defaultdata'=>'','param1'=>30,'param2'=>2048,'param3'=>0,'param4'=>'','param5'=>''),
    array('shortname'=>'positionid','name'=>'Position ID','datatype'=>'text','description'=>'','categoryid'=>1,'sortorder'=>1,'required'=>0,'locked'=>0,'visible'=>2,'forceunique'=>0,'signup'=>0,'defaultdata'=>'','param1'=>30,'param2'=>2048,'param3'=>0,'param4'=>'','param5'=>''),
    array('shortname'=>'organisationid','name'=>'Organisation ID','datatype'=>'text','description'=>'','categoryid'=>1,'sortorder'=>1,'required'=>0,'locked'=>0,'visible'=>2,'forceunique'=>0,'signup'=>0,'defaultdata'=>'','param1'=>30,'param2'=>2048,'param3'=>0,'param4'=>'','param5'=>''),
    array('shortname'=>'officeid','name'=>'Office ID','datatype'=>'text','description'=>'','categoryid'=>1,'sortorder'=>1,'required'=>0,'locked'=>0,'visible'=>2,'forceunique'=>0,'signup'=>0,'defaultdata'=>'','param1'=>30,'param2'=>2048,'param3'=>0,'param4'=>'','param5'=>''),
    array('shortname'=>'datejoined','name'=>'Date Joined','datatype'=>'text','description'=>'','categoryid'=>1,'sortorder'=>1,'required'=>0,'locked'=>0,'visible'=>2,'forceunique'=>0,'signup'=>0,'defaultdata'=>'','param1'=>30,'param2'=>2048,'param3'=>0,'param4'=>'','param5'=>''),
    array('shortname'=>'managerid','name'=>'Manager ID','datatype'=>'text','description'=>'','categoryid'=>1,'sortorder'=>1,'required'=>0,'locked'=>0,'visible'=>2,'forceunique'=>0,'signup'=>0,'defaultdata'=>'','param1'=>30,'param2'=>2048,'param3'=>0,'param4'=>'','param5'=>''),
    array('shortname'=>'costcentercode','name'=>'Cost Centre Code','datatype'=>'text','description'=>'','categoryid'=>1,'sortorder'=>1,'required'=>0,'locked'=>0,'visible'=>2,'forceunique'=>0,'signup'=>0,'defaultdata'=>'','param1'=>30,'param2'=>2048,'param3'=>0,'param4'=>'','param5'=>''),
    );

$cat = new object();
$cat->name = 'Other fields';
$cat->sortorder = 1;
insert_record('user_info_category',$cat);

foreach($customfields as $customfield) {
    insert_record('user_info_field',(object)$customfield);
}

// free memory
$customfields = array();

// also add some roles
$roles = array(
    array('name'=>'Trainer','shortname'=>'trainer','description'=>'Trainer','sortorder'=>10),
    array('name'=>'Assistant Trainer','shortname'=>'assistanttrainer','description'=>'Assistant Trainer','sortorder'=>11),
    array('name'=>'Auditor','shortname'=>'auditor','description'=>'Auditor','sortorder'=>12),
    array('name'=>'Assessor','shortname'=>'assessor','description'=>'Assessor','sortorder'=>13),
);

foreach($roles as $role) {
    insert_record('role',(object)$role);
}

