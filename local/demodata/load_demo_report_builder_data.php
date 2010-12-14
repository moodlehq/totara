<?php
@raise_memory_limit('496M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'report_builder'<br>";
$items = array(array('id' => '2','fullname' => 'All Competency Evidence','shortname' => 'all_competency_evidence','source' => 'competency_evidence','hidden' => '0','accessmode' => '1','contentmode' => '0','recordsperpage' => '40','defaultsortorder' => '4',),
array('id' => '4','fullname' => 'My Staff Competency Evidence','shortname' => 'staff_competency_evidence','source' => 'competency_evidence','hidden' => '0','accessmode' => '1','contentmode' => '1','recordsperpage' => '40','defaultsortorder' => '4',),
array('id' => '6','fullname' => 'My Local Competency Evidence','shortname' => 'local_competency_evidence','source' => 'competency_evidence','hidden' => '0','accessmode' => '1','contentmode' => '1','recordsperpage' => '40','defaultsortorder' => '4',),
array('id' => '7','fullname' => 'All Face to Face Sessions','shortname' => 'all_facetoface_sessions','source' => 'facetoface_sessions','hidden' => '0','accessmode' => '1','contentmode' => '0','recordsperpage' => '40','defaultsortorder' => '4',),
array('id' => '9','fullname' => 'My Staff Face to Face Sessions','shortname' => 'staff_facetoface_sessions','source' => 'facetoface_sessions','hidden' => '0','accessmode' => '1','contentmode' => '1','recordsperpage' => '40','defaultsortorder' => '4',),
array('id' => '10','fullname' => 'My Local Face to Face Sessions','shortname' => 'local_facetoface_sessions','source' => 'facetoface_sessions','hidden' => '0','accessmode' => '1','contentmode' => '1','recordsperpage' => '40','defaultsortorder' => '4',),
array('id' => '11','fullname' => 'All Course Completions','shortname' => 'all_course_completions','source' => 'course_completion','hidden' => '0','accessmode' => '1','contentmode' => '0','recordsperpage' => '40','defaultsortorder' => '4',),
array('id' => '12','fullname' => 'My Local Course Completions','shortname' => 'local_course_completions','source' => 'course_completion','hidden' => '0','accessmode' => '1','contentmode' => '1','recordsperpage' => '40','defaultsortorder' => '4',),
array('id' => '13','fullname' => 'My Staff Course Completions','shortname' => 'staff_course_completions','source' => 'course_completion','hidden' => '0','accessmode' => '1','contentmode' => '1','recordsperpage' => '40','defaultsortorder' => '4',),
array('id' => '14','fullname' => 'All Site Logs','shortname' => 'all_site_logs','source' => 'site_logs','hidden' => '0','accessmode' => '1','contentmode' => '0','recordsperpage' => '40','defaultsortorder' => '4',),
array('id' => '16','fullname' => 'My Staff Site Logs','shortname' => 'staff_site_logs','source' => 'site_logs','hidden' => '1','accessmode' => '1','contentmode' => '1','recordsperpage' => '40','defaultsortorder' => '4',),
array('id' => '17','fullname' => 'My Bookings','shortname' => 'bookings','source' => 'facetoface_sessions','hidden' => '1','accessmode' => '0','contentmode' => '2','embeddedurl' => '/my/bookings.php?id=2','recordsperpage' => '40','defaultsortorder' => '4',),
array('id' => '18','fullname' => 'My Past Bookings','shortname' => 'pastbookings','source' => 'facetoface_sessions','hidden' => '1','accessmode' => '0','contentmode' => '2','embeddedurl' => '/my/pastbookings.php?id=2','recordsperpage' => '40','defaultsortorder' => '4',),
array('id' => '19','fullname' => 'My Record of Learning','shortname' => 'record_of_learning','source' => 'competency_evidence','hidden' => '1','accessmode' => '0','contentmode' => '0','embeddedurl' => '/my/records.php?id=2','recordsperpage' => '40','defaultsortorder' => '4',),
array('id' => '20','fullname' => 'My Course Completions','shortname' => 'course_completions','source' => 'course_completion','hidden' => '1','accessmode' => '0','contentmode' => '0','embeddedurl' => '/my/coursecompletions.php?id=1292','recordsperpage' => '40','defaultsortorder' => '4',),
array('id' => '21','fullname' => 'Course Feedback','shortname' => 'report_course_feedback','source' => 'graphical_feedback_questions_grp_1','hidden' => '0','accessmode' => '1','contentmode' => '1','recordsperpage' => '40','defaultsortorder' => '4',),
array('id' => '22','fullname' => 'Fusion Tables Example','shortname' => 'report_fusion_tables_example','source' => 'course_completion_by_org','hidden' => '0','accessmode' => '1','contentmode' => '0','description' => '<p>This report provides a good example of exporting to Google Fusion Tables.</p>','recordsperpage' => '40','defaultsortorder' => '4',),
array('id' => '23','fullname' => 'Record of Learning: Courses','shortname' => 'plan_courses','source' => 'dp_course','hidden' => '1','accessmode' => '0','contentmode' => '0','embeddedurl' => '/local/plan/record/courses.php','recordsperpage' => '40','defaultsortorder' => '4',),
array('id' => '24','fullname' => 'Team Members','shortname' => 'team_members','source' => 'user','hidden' => '1','accessmode' => '0','contentmode' => '2','embeddedurl' => '/my/teammembers.php','recordsperpage' => '40','defaultsortorder' => '4',),
array('id' => '25','fullname' => 'Record of Learning: Competencies','shortname' => 'plan_competencies','source' => 'dp_competency','hidden' => '1','accessmode' => '0','contentmode' => '0','embeddedurl' => '/local/plan/record/competencies.php?status=all','recordsperpage' => '40','defaultsortorder' => '4',),
array('id' => '26','fullname' => 'Find Courses','shortname' => 'findcourses','source' => 'courses','hidden' => '1','accessmode' => '0','contentmode' => '0','embeddedurl' => '/course/find.php','recordsperpage' => '40','defaultsortorder' => '4',),
array('id' => '27','fullname' => 'Notifications','shortname' => 'notifications','source' => 'totaramessages','hidden' => '1','accessmode' => '0','contentmode' => '0','embeddedurl' => '/local/totara_msg/notifications.php?roleid=5','recordsperpage' => '40','defaultsortorder' => '4',),
array('id' => '28','fullname' => 'Reminders','shortname' => 'reminders','source' => 'totaramessages','hidden' => '1','accessmode' => '0','contentmode' => '0','embeddedurl' => '/local/totara_msg/reminders.php?roleid=8','recordsperpage' => '40','defaultsortorder' => '4',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('report_builder', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('report_builder',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('report_builder', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'report_builder');
    // make sure sequence is higher than highest ID
    bump_sequence('report_builder', $CFG->prefix, $maxid);
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
        