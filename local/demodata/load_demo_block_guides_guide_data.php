<?php
@raise_memory_limit('392M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'block_guides_guide'<br>";
$items = array(array('id' => '1','name' => 'Configure Totara','description' => 'A birds-eye guide to configuring a new Totara system','steps' => 'totara_guide_competencies,totara_guide_organisations,totara_guide_positions,totara_guide_hierarchies','deleted' => '0','identifier' => 'configure_totara',),
array('id' => '2','name' => 'Configure Organisations','description' => 'Organisations allows you to setup your organisational structure','steps' => 'totara_create_organisation_framework,totara_create_organisation_depth_levels,totara_create_organisation_custom_field_categories,totara_create_organisation_custom_fields,totara_add_organisations','deleted' => '0','identifier' => 'configure_organisations',),
array('id' => '3','name' => 'Configure Positions','description' => 'Positions allows you to set up your organisation\\\'s job roles','steps' => 'totara_create_position_framework,totara_create_depth_levels,totara_create_position_custom_field_categories,totara_create_custom_fields,totara_add_positions,totara_assign_competencies,totara_assign_competency_templates','deleted' => '0','identifier' => 'configure_positions',),
array('id' => '4','name' => 'Configure Competencies','description' => 'Competencies allows you to set up your oranisations competencies.','steps' => 'totara_create_proficiency_scale,totara_create_framework,totara_create_depth_levels,totara_create_custom_field_categories,totara_create_custom_fields,totara_add_competencies,totara_add_competency_templates,totara_assign_competency_evidence_items','deleted' => '0','identifier' => 'configure_competencies',),
array('id' => '5','name' => 'Configure Hierarchies','description' => 'Assign a user\\\'s organisational details allows you to assign a position, organisation and manager to each user.','steps' => 'totara_assign_user_manager_role,totara_assign_user_positions','deleted' => '0','identifier' => 'configure_hierarchies',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('block_guides_guide', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('block_guides_guide',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('block_guides_guide', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'block_guides_guide');
    // make sure sequence is higher than highest ID
    bump_sequence('block_guides_guide', $CFG->prefix, $maxid);
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
        
