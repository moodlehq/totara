<?php
@raise_memory_limit('496M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'report_builder_columns'<br>";
$items = array(array('id' => '1','reportid' => '7','type' => 'user','value' => 'namelink','heading' => 'Participant','sortorder' => '1','hidden' => '0',),
array('id' => '2','reportid' => '7','type' => 'course','value' => 'courselink','heading' => 'Course Name','sortorder' => '2','hidden' => '0',),
array('id' => '3','reportid' => '7','type' => 'session','value' => 'location','heading' => 'Location','sortorder' => '3','hidden' => '0',),
array('id' => '4','reportid' => '7','type' => 'session','value' => 'venue','heading' => 'Venue','sortorder' => '4','hidden' => '0',),
array('id' => '5','reportid' => '7','type' => 'session','value' => 'room','heading' => 'Room','sortorder' => '5','hidden' => '0',),
array('id' => '6','reportid' => '7','type' => 'session','value' => 'coursedelivery','heading' => 'Course Delivery','sortorder' => '6','hidden' => '0',),
array('id' => '7','reportid' => '7','type' => 'date','value' => 'sessiondate','heading' => 'Session Date','sortorder' => '7','hidden' => '0',),
array('id' => '8','reportid' => '7','type' => 'user','value' => 'organisation','heading' => 'Office','sortorder' => '8','hidden' => '0',),
array('id' => '9','reportid' => '7','type' => 'status','value' => 'statuscode','heading' => 'Status','sortorder' => '9','hidden' => '0',),
array('id' => '10','reportid' => '10','type' => 'user','value' => 'namelink','heading' => 'Participant','sortorder' => '1','hidden' => '0',),
array('id' => '11','reportid' => '10','type' => 'course','value' => 'courselink','heading' => 'Course Name','sortorder' => '2','hidden' => '0',),
array('id' => '12','reportid' => '10','type' => 'user','value' => 'organisation','heading' => 'Office','sortorder' => '3','hidden' => '0',),
array('id' => '13','reportid' => '10','type' => 'session','value' => 'location','heading' => 'Location','sortorder' => '4','hidden' => '0',),
array('id' => '14','reportid' => '10','type' => 'session','value' => 'venue','heading' => 'Venue','sortorder' => '5','hidden' => '0',),
array('id' => '15','reportid' => '10','type' => 'session','value' => 'room','heading' => 'Room','sortorder' => '6','hidden' => '0',),
array('id' => '16','reportid' => '10','type' => 'session','value' => 'coursedelivery','heading' => 'Course Delivery','sortorder' => '7','hidden' => '0',),
array('id' => '17','reportid' => '10','type' => 'date','value' => 'sessiondate','heading' => 'Session Date','sortorder' => '8','hidden' => '0',),
array('id' => '18','reportid' => '10','type' => 'status','value' => 'statuscode','heading' => 'Status','sortorder' => '9','hidden' => '0',),
array('id' => '19','reportid' => '9','type' => 'user','value' => 'namelink','heading' => 'Participant','sortorder' => '1','hidden' => '0',),
array('id' => '20','reportid' => '9','type' => 'course','value' => 'courselink','heading' => 'Course Name','sortorder' => '2','hidden' => '0',),
array('id' => '21','reportid' => '9','type' => 'session','value' => 'location','heading' => 'Location','sortorder' => '3','hidden' => '0',),
array('id' => '22','reportid' => '9','type' => 'session','value' => 'venue','heading' => 'Venue','sortorder' => '4','hidden' => '0',),
array('id' => '23','reportid' => '9','type' => 'session','value' => 'room','heading' => 'Room','sortorder' => '5','hidden' => '0',),
array('id' => '24','reportid' => '9','type' => 'session','value' => 'coursedelivery','heading' => 'Course Delivery','sortorder' => '6','hidden' => '0',),
array('id' => '25','reportid' => '9','type' => 'date','value' => 'sessiondate','heading' => 'Session Date','sortorder' => '7','hidden' => '0',),
array('id' => '26','reportid' => '9','type' => 'status','value' => 'statuscode','heading' => 'Status','sortorder' => '8','hidden' => '0',),
array('id' => '27','reportid' => '6','type' => 'user','value' => 'namelink','heading' => 'Participant','sortorder' => '1','hidden' => '0',),
array('id' => '28','reportid' => '6','type' => 'competency','value' => 'competencylink','heading' => 'Competency','sortorder' => '2','hidden' => '0',),
array('id' => '29','reportid' => '6','type' => 'user','value' => 'organisation','heading' => 'Office','sortorder' => '3','hidden' => '0',),
array('id' => '30','reportid' => '6','type' => 'competency_evidence','value' => 'organisation','heading' => 'Completion Office','sortorder' => '4','hidden' => '0',),
array('id' => '31','reportid' => '6','type' => 'user','value' => 'position','heading' => 'Position','sortorder' => '5','hidden' => '0',),
array('id' => '32','reportid' => '6','type' => 'competency_evidence','value' => 'position','heading' => 'Completion Position','sortorder' => '6','hidden' => '0',),
array('id' => '33','reportid' => '6','type' => 'competency_evidence','value' => 'proficiency','heading' => 'Proficiency','sortorder' => '7','hidden' => '0',),
array('id' => '34','reportid' => '6','type' => 'competency_evidence','value' => 'completeddate','heading' => 'Completion Date','sortorder' => '8','hidden' => '0',),
array('id' => '35','reportid' => '2','type' => 'user','value' => 'namelink','heading' => 'Participant','sortorder' => '1','hidden' => '0',),
array('id' => '36','reportid' => '2','type' => 'competency','value' => 'competencylink','heading' => 'Competency','sortorder' => '2','hidden' => '0',),
array('id' => '37','reportid' => '2','type' => 'competency','value' => 'idnumber','heading' => 'NZQA','sortorder' => '3','hidden' => '0',),
array('id' => '38','reportid' => '2','type' => 'user','value' => 'organisation','heading' => 'Office','sortorder' => '4','hidden' => '0',),
array('id' => '39','reportid' => '2','type' => 'competency_evidence','value' => 'organisation','heading' => 'Completion Office','sortorder' => '5','hidden' => '0',),
array('id' => '40','reportid' => '2','type' => 'user','value' => 'position','heading' => 'Position','sortorder' => '6','hidden' => '0',),
array('id' => '41','reportid' => '2','type' => 'competency_evidence','value' => 'position','heading' => 'Completion Position','sortorder' => '7','hidden' => '0',),
array('id' => '42','reportid' => '2','type' => 'competency_evidence','value' => 'proficiency','heading' => 'Proficiency','sortorder' => '8','hidden' => '0',),
array('id' => '43','reportid' => '2','type' => 'competency_evidence','value' => 'completeddate','heading' => 'Completion Date','sortorder' => '9','hidden' => '0',),
array('id' => '44','reportid' => '4','type' => 'user','value' => 'namelink','heading' => 'Participant','sortorder' => '1','hidden' => '0',),
array('id' => '45','reportid' => '4','type' => 'competency','value' => 'competencylink','heading' => 'Competency','sortorder' => '2','hidden' => '0',),
array('id' => '46','reportid' => '4','type' => 'user','value' => 'organisation','heading' => 'Office','sortorder' => '3','hidden' => '0',),
array('id' => '47','reportid' => '4','type' => 'competency_evidence','value' => 'organisation','heading' => 'Completion Office','sortorder' => '4','hidden' => '0',),
array('id' => '48','reportid' => '4','type' => 'user','value' => 'position','heading' => 'Position','sortorder' => '5','hidden' => '0',),
array('id' => '49','reportid' => '4','type' => 'competency_evidence','value' => 'position','heading' => 'Completion Position','sortorder' => '6','hidden' => '0',),
array('id' => '50','reportid' => '4','type' => 'competency_evidence','value' => 'proficiency','heading' => 'Proficiency','sortorder' => '7','hidden' => '0',),
array('id' => '51','reportid' => '4','type' => 'competency_evidence','value' => 'completeddate','heading' => 'Completion Date','sortorder' => '8','hidden' => '0',),
array('id' => '52','reportid' => '16','type' => 'log','value' => 'time','heading' => 'Time','sortorder' => '1','hidden' => '0',),
array('id' => '53','reportid' => '16','type' => 'user','value' => 'namelink','heading' => 'User','sortorder' => '2','hidden' => '0',),
array('id' => '54','reportid' => '16','type' => 'user','value' => 'position','heading' => 'Position','sortorder' => '3','hidden' => '0',),
array('id' => '55','reportid' => '16','type' => 'user','value' => 'organisation','heading' => 'Organisation','sortorder' => '4','hidden' => '0',),
array('id' => '56','reportid' => '16','type' => 'course','value' => 'courselink','heading' => 'Course','sortorder' => '5','hidden' => '0',),
array('id' => '57','reportid' => '16','type' => 'log','value' => 'ip','heading' => 'IP Address','sortorder' => '6','hidden' => '0',),
array('id' => '58','reportid' => '16','type' => 'log','value' => 'actionlink','heading' => 'Action','sortorder' => '7','hidden' => '0',),
array('id' => '59','reportid' => '16','type' => 'log','value' => 'info','heading' => 'Info','sortorder' => '8','hidden' => '0',),
array('id' => '60','reportid' => '11','type' => 'user','value' => 'namelink','heading' => 'Participant','sortorder' => '1','hidden' => '0',),
array('id' => '61','reportid' => '11','type' => 'course','value' => 'courselink','heading' => 'Course','sortorder' => '2','hidden' => '0',),
array('id' => '62','reportid' => '11','type' => 'user','value' => 'organisation','heading' => 'Office','sortorder' => '3','hidden' => '0',),
array('id' => '63','reportid' => '11','type' => 'course_completion','value' => 'organisation','heading' => 'Completion Office','sortorder' => '4','hidden' => '0',),
array('id' => '64','reportid' => '11','type' => 'user','value' => 'position','heading' => 'Position','sortorder' => '5','hidden' => '0',),
array('id' => '65','reportid' => '11','type' => 'course_completion','value' => 'position','heading' => 'Completion Position','sortorder' => '6','hidden' => '0',),
array('id' => '66','reportid' => '11','type' => 'course_completion','value' => 'status','heading' => 'Completion Status','sortorder' => '7','hidden' => '0',),
array('id' => '67','reportid' => '11','type' => 'course_completion','value' => 'completeddate','heading' => 'Completion Date','sortorder' => '8','hidden' => '0',),
array('id' => '68','reportid' => '12','type' => 'user','value' => 'namelink','heading' => 'Participant','sortorder' => '1','hidden' => '0',),
array('id' => '69','reportid' => '12','type' => 'course','value' => 'courselink','heading' => 'Course','sortorder' => '2','hidden' => '0',),
array('id' => '70','reportid' => '12','type' => 'user','value' => 'organisation','heading' => 'Office','sortorder' => '3','hidden' => '0',),
array('id' => '71','reportid' => '12','type' => 'course_completion','value' => 'organisation','heading' => 'Completion Office','sortorder' => '4','hidden' => '0',),
array('id' => '72','reportid' => '12','type' => 'user','value' => 'position','heading' => 'Position','sortorder' => '5','hidden' => '0',),
array('id' => '73','reportid' => '12','type' => 'course_completion','value' => 'position','heading' => 'Completion Position','sortorder' => '6','hidden' => '0',),
array('id' => '74','reportid' => '12','type' => 'course_completion','value' => 'status','heading' => 'Completion Status','sortorder' => '7','hidden' => '0',),
array('id' => '75','reportid' => '12','type' => 'course_completion','value' => 'completeddate','heading' => 'Completion Date','sortorder' => '8','hidden' => '0',),
array('id' => '76','reportid' => '14','type' => 'log','value' => 'time','heading' => 'Time','sortorder' => '1','hidden' => '0',),
array('id' => '77','reportid' => '14','type' => 'user','value' => 'namelink','heading' => 'User','sortorder' => '2','hidden' => '0',),
array('id' => '78','reportid' => '14','type' => 'user','value' => 'position','heading' => 'Position','sortorder' => '3','hidden' => '0',),
array('id' => '79','reportid' => '14','type' => 'user','value' => 'organisation','heading' => 'Organisation','sortorder' => '4','hidden' => '0',),
array('id' => '80','reportid' => '14','type' => 'course','value' => 'courselink','heading' => 'Course','sortorder' => '5','hidden' => '0',),
array('id' => '81','reportid' => '14','type' => 'log','value' => 'ip','heading' => 'IP Address','sortorder' => '6','hidden' => '0',),
array('id' => '82','reportid' => '14','type' => 'log','value' => 'actionlink','heading' => 'Action','sortorder' => '7','hidden' => '0',),
array('id' => '83','reportid' => '14','type' => 'log','value' => 'info','heading' => 'Info','sortorder' => '8','hidden' => '0',),
array('id' => '92','reportid' => '13','type' => 'user','value' => 'namelink','heading' => 'Participant','sortorder' => '1','hidden' => '0',),
array('id' => '93','reportid' => '13','type' => 'course','value' => 'courselink','heading' => 'Course','sortorder' => '2','hidden' => '0',),
array('id' => '94','reportid' => '13','type' => 'user','value' => 'organisation','heading' => 'Office','sortorder' => '3','hidden' => '0',),
array('id' => '95','reportid' => '13','type' => 'course_completion','value' => 'organisation','heading' => 'Completion Office','sortorder' => '4','hidden' => '0',),
array('id' => '96','reportid' => '13','type' => 'user','value' => 'position','heading' => 'Position','sortorder' => '5','hidden' => '0',),
array('id' => '97','reportid' => '13','type' => 'course_completion','value' => 'position','heading' => 'Completion Position','sortorder' => '6','hidden' => '0',),
array('id' => '98','reportid' => '13','type' => 'course_completion','value' => 'status','heading' => 'Completion Status','sortorder' => '7','hidden' => '0',),
array('id' => '99','reportid' => '13','type' => 'course_completion','value' => 'completeddate','heading' => 'Completion Date','sortorder' => '8','hidden' => '0',),
array('id' => '100','reportid' => '17','type' => 'course','value' => 'courselink','heading' => 'Course Name','sortorder' => '1','hidden' => '0',),
array('id' => '101','reportid' => '17','type' => 'facetoface','value' => 'name','heading' => 'Session Name','sortorder' => '2','hidden' => '0',),
array('id' => '102','reportid' => '17','type' => 'session','value' => 'location','heading' => 'Location','sortorder' => '3','hidden' => '0',),
array('id' => '103','reportid' => '17','type' => 'session','value' => 'audit','heading' => 'Audit','sortorder' => '4','hidden' => '0',),
array('id' => '104','reportid' => '17','type' => 'session','value' => 'pilot','heading' => 'Pilot','sortorder' => '5','hidden' => '0',),
array('id' => '105','reportid' => '17','type' => 'session','value' => 'coursedelivery','heading' => 'Course Delivery','sortorder' => '6','hidden' => '0',),
array('id' => '106','reportid' => '17','type' => 'date','value' => 'sessiondate','heading' => 'Session Date','sortorder' => '7','hidden' => '0',),
array('id' => '107','reportid' => '17','type' => 'date','value' => 'timestart','heading' => 'Start Time','sortorder' => '8','hidden' => '0',),
array('id' => '108','reportid' => '17','type' => 'date','value' => 'timefinish','heading' => 'End Time','sortorder' => '9','hidden' => '0',),
array('id' => '109','reportid' => '18','type' => 'course','value' => 'courselink','heading' => 'Course Name','sortorder' => '1','hidden' => '0',),
array('id' => '110','reportid' => '18','type' => 'facetoface','value' => 'name','heading' => 'Session Name','sortorder' => '2','hidden' => '0',),
array('id' => '111','reportid' => '18','type' => 'session','value' => 'location','heading' => 'Location','sortorder' => '3','hidden' => '0',),
array('id' => '112','reportid' => '18','type' => 'session','value' => 'audit','heading' => 'Audit','sortorder' => '4','hidden' => '0',),
array('id' => '113','reportid' => '18','type' => 'session','value' => 'pilot','heading' => 'Pilot','sortorder' => '5','hidden' => '0',),
array('id' => '114','reportid' => '18','type' => 'session','value' => 'coursedelivery','heading' => 'Course Delivery','sortorder' => '6','hidden' => '0',),
array('id' => '115','reportid' => '18','type' => 'date','value' => 'timestart','heading' => 'Session Start','sortorder' => '7','hidden' => '0',),
array('id' => '116','reportid' => '18','type' => 'date','value' => 'timefinish','heading' => 'Session Finish','sortorder' => '8','hidden' => '0',),
array('id' => '117','reportid' => '19','type' => 'competency','value' => 'competencylink','heading' => 'Course/Competency','sortorder' => '1','hidden' => '0',),
array('id' => '118','reportid' => '19','type' => 'competency','value' => 'idnumber','heading' => 'Competency ID','sortorder' => '2','hidden' => '0',),
array('id' => '119','reportid' => '19','type' => 'competency_evidence','value' => 'proficiency','heading' => 'Proficiency','sortorder' => '3','hidden' => '0',),
array('id' => '120','reportid' => '19','type' => 'competency_evidence','value' => 'position','heading' => 'Completed As','sortorder' => '4','hidden' => '0',),
array('id' => '121','reportid' => '19','type' => 'competency_evidence','value' => 'organisation','heading' => 'Completed At','sortorder' => '5','hidden' => '0',),
array('id' => '122','reportid' => '19','type' => 'competency_evidence','value' => 'completeddate','heading' => 'Date','sortorder' => '6','hidden' => '0',),
array('id' => '123','reportid' => '19','type' => 'competency_evidence','value' => 'assessor','heading' => 'Assessor','sortorder' => '7','hidden' => '0',),
array('id' => '124','reportid' => '19','type' => 'competency_evidence','value' => 'assessorname','heading' => 'Assessor Organisation','sortorder' => '8','hidden' => '0',),
array('id' => '125','reportid' => '20','type' => 'course','value' => 'courselink','heading' => 'Course','sortorder' => '1','hidden' => '0',),
array('id' => '126','reportid' => '20','type' => 'course_completion','value' => 'status','heading' => 'Status','sortorder' => '2','hidden' => '0',),
array('id' => '127','reportid' => '20','type' => 'course_completion','value' => 'completeddate','heading' => 'Date Completed','sortorder' => '3','hidden' => '0',),
array('id' => '128','reportid' => '20','type' => 'course_completion','value' => 'organisation','heading' => 'Completed At','sortorder' => '4','hidden' => '0',),
array('id' => '129','reportid' => '20','type' => 'course_completion','value' => 'position','heading' => 'Completed As','sortorder' => '5','hidden' => '0',),
array('id' => '131','reportid' => '21','type' => 'course','value' => 'fullname','heading' => 'Course Name','sortorder' => '1','hidden' => '0',),
array('id' => '132','reportid' => '22','type' => 'course_completion','value' => 'organisation','heading' => 'Completion Organisation Name','sortorder' => '1','hidden' => '0',),
array('id' => '133','reportid' => '22','type' => 'course_completion','value' => 'completed','heading' => 'Number Completed','sortorder' => '2','hidden' => '0',),
array('id' => '135','reportid' => '22','type' => 'course_completion','value' => 'earliest_completeddate','heading' => 'Earliest Completion Date','sortorder' => '3','hidden' => '0',),
array('id' => '136','reportid' => '22','type' => 'course_completion','value' => 'latest_completeddate','heading' => 'Latest Completion Date','sortorder' => '4','hidden' => '0',),
array('id' => '137','reportid' => '23','type' => 'course','value' => 'courselink','heading' => 'Course Title','sortorder' => '1','hidden' => '0',),
array('id' => '138','reportid' => '23','type' => 'plan','value' => 'planlink','heading' => 'Plan','sortorder' => '2','hidden' => '0',),
array('id' => '139','reportid' => '23','type' => 'plan','value' => 'status','heading' => 'Plan status','sortorder' => '3','hidden' => '0',),
array('id' => '140','reportid' => '23','type' => 'plan','value' => 'courseduedate','heading' => 'Course due date','sortorder' => '4','hidden' => '0',),
array('id' => '141','reportid' => '23','type' => 'plan','value' => 'coursepriority','heading' => 'Course priority','sortorder' => '5','hidden' => '0',),
array('id' => '142','reportid' => '24','type' => 'user','value' => 'userpicture','heading' => 'Pic','sortorder' => '1','hidden' => '0',),
array('id' => '143','reportid' => '24','type' => 'user','value' => 'namelink','heading' => 'Name','sortorder' => '2','hidden' => '0',),
array('id' => '144','reportid' => '24','type' => 'user','value' => 'lastlogin','heading' => 'Last Login','sortorder' => '3','hidden' => '0',),
array('id' => '145','reportid' => '24','type' => 'statistics','value' => 'coursesstarted','heading' => 'Courses Started','sortorder' => '4','hidden' => '0',),
array('id' => '146','reportid' => '24','type' => 'statistics','value' => 'coursescompleted','heading' => 'Courses Completed','sortorder' => '5','hidden' => '0',),
array('id' => '147','reportid' => '24','type' => 'statistics','value' => 'competenciesachieved','heading' => 'Competencies Achieved','sortorder' => '6','hidden' => '0',),
array('id' => '148','reportid' => '24','type' => 'user','value' => 'userlearningicons','heading' => 'Links','sortorder' => '7','hidden' => '0',),
array('id' => '149','reportid' => '25','type' => 'plan','value' => 'planlink','heading' => 'Plan','sortorder' => '1','hidden' => '0',),
array('id' => '150','reportid' => '25','type' => 'plan','value' => 'status','heading' => 'Plan status','sortorder' => '2','hidden' => '0',),
array('id' => '151','reportid' => '25','type' => 'competency','value' => 'fullname','heading' => 'Competency','sortorder' => '3','hidden' => '0',),
array('id' => '152','reportid' => '25','type' => 'competency','value' => 'priority','heading' => 'Priority','sortorder' => '4','hidden' => '0',),
array('id' => '153','reportid' => '25','type' => 'competency','value' => 'duedate','heading' => 'Due date','sortorder' => '5','hidden' => '0',),
array('id' => '154','reportid' => '25','type' => 'competency','value' => 'proficiency','heading' => 'Proficiency','sortorder' => '6','hidden' => '0',),
array('id' => '155','reportid' => '26','type' => 'course','value' => 'courselinkicon','heading' => 'Course Name','sortorder' => '1','hidden' => '0',),
array('id' => '156','reportid' => '26','type' => 'course_category','value' => 'namelinkicon','heading' => 'Category','sortorder' => '2','hidden' => '0',),
array('id' => '157','reportid' => '26','type' => 'course','value' => 'startdate','heading' => 'Start date','sortorder' => '3','hidden' => '0',),
array('id' => '158','reportid' => '26','type' => 'course','value' => 'mods','heading' => 'Content','sortorder' => '4','hidden' => '0',),
array('id' => '159','reportid' => '27','type' => 'message_values','value' => 'urgency','heading' => 'Urgency','sortorder' => '1','hidden' => '0',),
array('id' => '160','reportid' => '27','type' => 'message_values','value' => 'msgtype','heading' => 'Type','sortorder' => '2','hidden' => '0',),
array('id' => '161','reportid' => '27','type' => 'user','value' => 'namelink','heading' => 'Name','sortorder' => '3','hidden' => '0',),
array('id' => '162','reportid' => '27','type' => 'message_values','value' => 'statement','heading' => 'Details','sortorder' => '4','hidden' => '0',),
array('id' => '163','reportid' => '27','type' => 'message_values','value' => 'sent','heading' => 'Sent','sortorder' => '5','hidden' => '0',),
array('id' => '164','reportid' => '27','type' => 'message_values','value' => 'dismiss_link','heading' => '<div id=\\\"totara_msg_selects\\\" style=\\\"display: none;\\\"><a href=\\\"\\\" onclick=\\\"jqCheckAll(\\\'totara_messages\\\', \\\'totara_message\\\', 1); return false;\\\">all</a>/<a href=\\\"\\\" onclick=\\\"jqCheckAll(\\\'totara_messages\\\', \\\'totara_message\\\', 0); return false;\\\">none</a>','sortorder' => '6','hidden' => '0',),
array('id' => '165','reportid' => '28','type' => 'message_values','value' => 'urgency','heading' => 'Urgency','sortorder' => '1','hidden' => '0',),
array('id' => '166','reportid' => '28','type' => 'message_values','value' => 'msgtype','heading' => 'Type','sortorder' => '2','hidden' => '0',),
array('id' => '167','reportid' => '28','type' => 'user','value' => 'namelink','heading' => 'Name','sortorder' => '3','hidden' => '0',),
array('id' => '168','reportid' => '28','type' => 'message_values','value' => 'statement','heading' => 'Details','sortorder' => '4','hidden' => '0',),
array('id' => '169','reportid' => '28','type' => 'message_values','value' => 'sent','heading' => 'Sent','sortorder' => '5','hidden' => '0',),
array('id' => '170','reportid' => '28','type' => 'message_values','value' => 'reminder_links','heading' => '<div id=\\\"totara_msg_selects\\\" style=\\\"display: none;\\\"><a href=\\\"\\\" onclick=\\\"jqCheckAll(\\\'totara_messages\\\', \\\'totara_message\\\', 1); return false;\\\">all</a>/<a href=\\\"\\\" onclick=\\\"jqCheckAll(\\\'totara_messages\\\', \\\'totara_message\\\', 0); return false;\\\">none</a>','sortorder' => '6','hidden' => '0',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('report_builder_columns', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('report_builder_columns',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('report_builder_columns', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'report_builder_columns');
    // make sure sequence is higher than highest ID
    bump_sequence('report_builder_columns', $CFG->prefix, $maxid);
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
        