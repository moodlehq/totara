<?php

require_once '../../../../config.php';
require_once $CFG->libdir.'/adminlib.php';
require_once 'edit_form.php';


///
/// Setup / loading data
///

// Get paramters
// Scale id; 0 if creating a new scale
$id = optional_param('id', 0, PARAM_INT);
$type = required_param('type', PARAM_TEXT);
// Page setup and check permissions
admin_externalpage_setup($type.'frameworkmanage');
$sitecontext = get_context_instance(CONTEXT_SYSTEM);

if ($id == 0) {
    // creating new competency scale
    require_capability('moodle/local:createcompetency', $sitecontext);

    $scale = new object();
    $scale->id = 0;
    $scale->sortorder = get_field('comp_framework', 'MAX(sortorder) + 1', '', '');
    if (!$scale->sortorder) {
        $scale->sortorder = 1;
    }

} else {
    // editing existing competency scale
    require_capability('moodle/local:updatecompetency', $sitecontext);

    if (!$scale = get_record('comp_scale', 'id', $id)) {
        error('Competency scale ID was incorrect');
    }
}


///
/// Handle form data
///

$mform = new edit_scale_form(
        null, // method (default)
        array( // customdata
            'scaleid'=>$id
        )
);
$mform->set_data($scale);

// If cancelled
if ($mform->is_cancelled()) {

    redirect("$CFG->wwwroot/hierarchy/framework/index.php?type=competency");

// Update data
} else if ($scalenew = $mform->get_data()) {

    $scalenew->timemodified = time();
    $scalenew->usermodified = $USER->id;

    // New scale
    if (empty($scalenew->id)) {
        unset($scalenew->id);

        begin_sql();

        try {

            if (!$scalenew->id = insert_record('comp_scale', $scalenew)) {
                throw new Exception('Error creating new competency scale');
            }

            $scalevalues = array_reverse( explode(',',trim($scalenew->scalevalues)) );
            unset($scalenew->scalevalues);

            $sortorder = 1;
            $scaleidlist = array();
            foreach( $scalevalues as $scaleval ){
                if ( trim($scaleval) != '' ){
                    $scalevalrec = new stdClass();
                    $scalevalrec->scaleid = $scalenew->id;
                    $scalevalrec->name = trim($scaleval);
                    $scalevalrec->sortorder = $sortorder;
                    $scalevalrec->timemodified = time();
                    $scalevalrec->usermodified = $USER->id;

                    $result = insert_record('comp_scale_values', $scalevalrec);
                    if (!$result){
                        throw new Exception('Error creating new competency scale values');
                    }
                    $scaleidlist[] = $result;
                    $sortorder++;
                }
            }

            // Set the default scale value to the least competent one, and the
            // "proficient" scale value to the most competent one
            if ( count($scaleidlist) ){
                $scalenew->defaultid = $scaleidlist[count($scaleidlist)-1];
                $scalenew->proficient = $scaleidlist[0];
                update_record('comp_scale', $scalenew);
            }

            commit_sql();
        } catch ( Exception $e ){
            rollback_sql();
            error( $e->getMessage() );
        }
    // Existing scale
    } else {
        if (!update_record('comp_scale', $scalenew)) {
            error('Error updating competency scale');
        }
    }

    // Reload from db
    $scalenew = get_record('comp_scale', 'id', $scalenew->id);

    // Log
    add_to_log(SITEID, 'competencyscales', 'update', "view.php?id=$scalenew->id&amp;typ=competency", '');

    redirect("$CFG->wwwroot/hierarchy/type/competency/scale/view.php?id={$scalenew->id}&amp;type=competency");
}

/// Print Page
$navlinks = array();    // Breadcrumbs
$navlinks[] = array('name'=>get_string("competencyframeworks", 'competency'), 
                    'link'=>"{$CFG->wwwroot}/hierarchy/framework/index.php?type=competency", 
                    'type'=>'misc');
if ($id == 0) { // Add
    $navlinks[] = array('name'=>get_string('scalescustomcreate'), 'link'=>'', 'type'=>'misc');
    $heading = get_string('scalescustomcreate');
} else {    //Edit
    $navlinks[] = array('name'=>get_string('editscale', 'grades', format_string($scale->name)), 'link'=>'', 'type'=>'misc');
    $heading = get_string('editscale', 'grades');
}

admin_externalpage_print_header('', $navlinks);
print_heading($heading);
$mform->display();

admin_externalpage_print_footer();
