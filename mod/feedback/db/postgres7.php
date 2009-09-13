<?php

function feedback_upgrade($oldversion) {
/// This function does anything necessary to upgrade
/// older versions to match current functionality

    global $CFG;

    if ($oldversion < 2006042400) {
        table_column('feedback_value','','course_id','integer', '1','unsigned','0','not null','');
    }

    if ($oldversion < 2006070300) {
    modify_database('', '
         CREATE TABLE prefix_feedback_sitecourse_map (
         id SERIAL PRIMARY KEY,
         feedbackid integer NOT NULL default 0,
         courseid integer NOT NULL default 0
         );');
   
       modify_database('', 'CREATE UNIQUE INDEX prefix_feedback_sitecourse_map_feedbackcourseid_idx ON prefix_feedback_sitecourse_map (feedbackid, courseid);');
    }

    if ($oldversion < 2006091100) {    	    
//         modify_database('', 'ALTER TABLE prefix_feedback ADD page_after_submit TEXT NOT NULL DEFAULT \'\'');
//         modify_database('', 'ALTER TABLE prefix_feedback ADD timeopen INTEGER NOT NULL DEFAULT 0');
//         modify_database('', 'ALTER TABLE prefix_feedback ADD timeclose INTEGER NOT NULL DEFAULT 0');

    	table_column('feedback', null, 'page_after_submit', 'TEXT', null, null, "''", 'NOT NULL' );
    	table_column('feedback', null, 'timeopen', 'INTEGER', 10, 'unsigned', '0', 'NOT NULL' );
    	table_column('feedback', null, 'timeclose', 'INTEGER', 10, 'unsigned', '0', 'NOT NULL' );    	
    }
    return true;
}

?>
