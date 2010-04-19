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

admin_externalpage_setup('competencyscales');
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

    redirect("$CFG->wwwroot/hierarchy/type/competency/scale/index.php");

// Update data
} else if ($scalenew = $mform->get_data()) {

    $scalenew->timemodified = time();
    $scalenew->usermodified = $USER->id;

    // New scale
    if (empty($scalenew->id)) {
        unset($scalenew->id);

        $scalevalues = array_reverse( explode(',',trim($scalenew->scalevalues)) );
        unset($scalenew->scalevalues);

        if (!$scalenew->id = insert_record('comp_scale', $scalenew)) {
            error('Error creating new competency scale');
        }

        $sortorder = 1;
        foreach( $scalevalues as $scaleval ){
            if ( trim($scaleval) != '' ){
                $scalevalrec = new stdClass();
                $scalevalrec->scaleid = $scalenew->id;
                $scalevalrec->name = trim($scaleval);
                $scalevalrec->sortorder = $sortorder;
                $scalevalrec->timemodified = time();
                $scalevalrec->usermodified = $USER->id;

                insert_record('comp_scale_values', $scalevalrec);
                $sortorder++;
            }
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
    add_to_log(SITEID, 'competencyscales', 'update', "view.php?id=$scalenew->id", '');

    redirect("$CFG->wwwroot/hierarchy/type/competency/scale/view.php?id={$scalenew->id}");
}

admin_externalpage_print_header();
print_heading(get_string('scalescustomcreate'));
$mform->display();

admin_externalpage_print_footer();
