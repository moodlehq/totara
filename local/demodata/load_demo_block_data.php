<?php
@raise_memory_limit('392M');
@ini_set('max_execution_time','3000');
print "Emptytable flag set, deleting all data from block.<br>";
delete_records('block');
print "Loading data for table 'block'<br>";
$items = array(array('id' => '1','name' => 'activity_modules','version' => '2007101509','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '0',),
array('id' => '2','name' => 'admin','version' => '2007101509','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '0',),
array('id' => '3','name' => 'admin_bookmarks','version' => '2007101509','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '0',),
array('id' => '4','name' => 'admin_tree','version' => '2007101509','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '0',),
array('id' => '5','name' => 'blog_menu','version' => '2007101509','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '0',),
array('id' => '6','name' => 'blog_tags','version' => '2007101509','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '1',),
array('id' => '7','name' => 'calendar_month','version' => '2007101509','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '0',),
array('id' => '8','name' => 'calendar_upcoming','version' => '2007101509','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '0',),
array('id' => '9','name' => 'completionstatus','version' => '2009072800','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '0',),
array('id' => '10','name' => 'course_list','version' => '2007101509','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '0',),
array('id' => '11','name' => 'course_summary','version' => '2007101509','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '0',),
array('id' => '12','name' => 'extsearch','version' => '2009062000','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '1',),
array('id' => '13','name' => 'facetoface','version' => '2009120400','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '0',),
array('id' => '14','name' => 'feedback','version' => '2007072500','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '0',),
array('id' => '15','name' => 'glossary_random','version' => '2007101509','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '1',),
array('id' => '16','name' => 'html','version' => '2007101509','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '1',),
array('id' => '17','name' => 'loancalc','version' => '2007101509','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '0',),
array('id' => '18','name' => 'login','version' => '2007101509','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '0',),
array('id' => '19','name' => 'mentees','version' => '2007101509','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '1',),
array('id' => '20','name' => 'messages','version' => '2007101509','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '0',),
array('id' => '21','name' => 'totara_my_learning_nav','version' => '2009120100','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '0',),
array('id' => '22','name' => 'totara_my_performance_nav','version' => '2009120100','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '0',),
array('id' => '23','name' => 'totara_my_team_nav','version' => '2009120100','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '0',),
array('id' => '24','name' => 'totara_my_tools_nav','version' => '2009120100','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '0',),
array('id' => '25','name' => 'mnet_hosts','version' => '2007101509','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '0',),
array('id' => '26','name' => 'news_items','version' => '2007101509','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '0',),
array('id' => '27','name' => 'online_users','version' => '2007101510','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '0',),
array('id' => '28','name' => 'participants','version' => '2007101509','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '0',),
array('id' => '29','name' => 'quiz_results','version' => '2007101509','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '1',),
array('id' => '30','name' => 'recent_activity','version' => '2007101509','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '0',),
array('id' => '31','name' => 'rss_client','version' => '2007101511','cron' => '300','lastcron' => '1280467617','visible' => '1','multiple' => '1',),
array('id' => '32','name' => 'search','version' => '2008031500','cron' => '1','lastcron' => '0','visible' => '1','multiple' => '0',),
array('id' => '33','name' => 'search_forums','version' => '2007101509','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '0',),
array('id' => '34','name' => 'section_links','version' => '2007101511','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '0',),
array('id' => '35','name' => 'selfcompletion','version' => '2009072800','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '0',),
array('id' => '36','name' => 'site_main_menu','version' => '2007101509','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '0',),
array('id' => '37','name' => 'social_activities','version' => '2007101509','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '0',),
array('id' => '38','name' => 'student_job_search','version' => '2005022100','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '0',),
array('id' => '39','name' => 'student_loan_calc','version' => '2005022100','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '0',),
array('id' => '40','name' => 'tag_flickr','version' => '2007101509','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '1',),
array('id' => '41','name' => 'tag_youtube','version' => '2007101509','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '1',),
array('id' => '42','name' => 'tags','version' => '2007101509','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '1',),
array('id' => '43','name' => 'totara_report_manager','version' => '2010012800','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '0',),
array('id' => '44','name' => 'totara_my_current_courses','version' => '2010021900','cron' => '0','lastcron' => '0','visible' => '0','multiple' => '0',),
array('id' => '45','name' => 'guides','version' => '2010073000','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '0',),
array('id' => '46','name' => 'totara_my_learning_nav','version' => '2009120100','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '1',),
array('id' => '47','name' => 'totara_my_team_nav','version' => '2009120100','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '1',),
array('id' => '48','name' => 'totara_report_manager','version' => '2010012800','cron' => '0','lastcron' => '0','visible' => '1','multiple' => '0',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('block', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('block',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('block', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'block');
    // make sure sequence is higher than highest ID
    bump_sequence('block', $CFG->prefix, $maxid);
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
        
