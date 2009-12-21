<?php

// Import custom fields for DOC

$customfields = array(
    array('shortname'=>'dob','name'=>'Date of Birth','datatype'=>'text','description'=>'','categoryid'=>1,'sortorder'=>1,'required'=>0,'locked'=>0,'visible'=>2,'forceunique'=>0,'signup'=>0,'defaultdata'=>'','param1'=>30,'param2'=>2048,'param3'=>0,'param4'=>'','param5'=>''),
    array('shortname'=>'title','name'=>'Title','datatype'=>'text','description'=>'','categoryid'=>1,'sortorder'=>1,'required'=>0,'locked'=>0,'visible'=>2,'forceunique'=>0,'signup'=>0,'defaultdata'=>'','param1'=>30,'param2'=>2048,'param3'=>0,'param4'=>'','param5'=>''),
    array('shortname'=>'position','name'=>'Position ID','datatype'=>'text','description'=>'','categoryid'=>1,'sortorder'=>1,'required'=>0,'locked'=>0,'visible'=>2,'forceunique'=>0,'signup'=>0,'defaultdata'=>'','param1'=>30,'param2'=>2048,'param3'=>0,'param4'=>'','param5'=>''),
    array('shortname'=>'organisationid','name'=>'Organisation ID','datatype'=>'text','description'=>'','categoryid'=>1,'sortorder'=>1,'required'=>0,'locked'=>0,'visible'=>2,'forceunique'=>0,'signup'=>0,'defaultdata'=>'','param1'=>30,'param2'=>2048,'param3'=>0,'param4'=>'','param5'=>''),
    array('shortname'=>'office','name'=>'Office','datatype'=>'text','description'=>'','categoryid'=>1,'sortorder'=>1,'required'=>0,'locked'=>0,'visible'=>2,'forceunique'=>0,'signup'=>0,'defaultdata'=>'','param1'=>30,'param2'=>2048,'param3'=>0,'param4'=>'','param5'=>''),
    array('shortname'=>'datejoined','name'=>'Date Joined','datatype'=>'text','description'=>'','categoryid'=>1,'sortorder'=>1,'required'=>0,'locked'=>0,'visible'=>2,'forceunique'=>0,'signup'=>0,'defaultdata'=>'','param1'=>30,'param2'=>2048,'param3'=>0,'param4'=>'','param5'=>''),
    array('shortname'=>'managerempcode','name'=>'Manager ID','datatype'=>'text','description'=>'','categoryid'=>1,'sortorder'=>1,'required'=>0,'locked'=>0,'visible'=>2,'forceunique'=>0,'signup'=>0,'defaultdata'=>'','param1'=>30,'param2'=>2048,'param3'=>0,'param4'=>'','param5'=>''),
    array('shortname'=>'ccentcode','name'=>'Cost Centre Code','datatype'=>'text','description'=>'','categoryid'=>1,'sortorder'=>1,'required'=>0,'locked'=>0,'visible'=>2,'forceunique'=>0,'signup'=>0,'defaultdata'=>'','param1'=>30,'param2'=>2048,'param3'=>0,'param4'=>'','param5'=>''),
    array('shortname'=>'jade2','name'=>'Jade Number 2','datatype'=>'text','description'=>'','categoryid'=>1,'sortorder'=>1,'required'=>0,'locked'=>0,'visible'=>2,'forceunique'=>0,'signup'=>0,'defaultdata'=>'','param1'=>30,'param2'=>2048,'param3'=>0,'param4'=>'','param5'=>''),
    array('shortname'=>'jade3','name'=>'Jade Number 3','datatype'=>'text','description'=>'','categoryid'=>1,'sortorder'=>1,'required'=>0,'locked'=>0,'visible'=>2,'forceunique'=>0,'signup'=>0,'defaultdata'=>'','param1'=>30,'param2'=>2048,'param3'=>0,'param4'=>'','param5'=>''),
    array('shortname'=>'jade4','name'=>'Jade Number 4','datatype'=>'text','description'=>'','categoryid'=>1,'sortorder'=>1,'required'=>0,'locked'=>0,'visible'=>2,'forceunique'=>0,'signup'=>0,'defaultdata'=>'','param1'=>30,'param2'=>2048,'param3'=>0,'param4'=>'','param5'=>''),
    array('shortname'=>'nzqano','name'=>'NZQA Number','datatype'=>'text','description'=>'','categoryid'=>1,'sortorder'=>1,'required'=>0,'locked'=>0,'visible'=>2,'forceunique'=>0,'signup'=>0,'defaultdata'=>'','param1'=>30,'param2'=>2048,'param3'=>0,'param4'=>'','param5'=>''),
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

