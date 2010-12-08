<?php

require_once '../../../config.php';
require_once $CFG->libdir.'/adminlib.php';
require_once 'edit_form.php';


///
/// Setup / loading data
///

// Get paramters
$id = optional_param('id', 0, PARAM_INT); // Objective id; 0 if creating a new objective
// Page setup and check permissions
admin_externalpage_setup('objectivescales');
$sitecontext = get_context_instance(CONTEXT_SYSTEM);

require_capability('local/plan:manageobjectivescales', $sitecontext);
if ($id == 0) {
    // creating new idp objective

    $objective = new object();
    $objective->id = 0;
} else {
    // editing existing idp objective

    if (!$objective = get_record('dp_objective_scale', 'id', $id)) {
        error(get_string('error:objectivescaledidincorrect', 'local_plan'));
    }
}


///
/// Handle form data
///

$mform = new edit_objective_form(
        null, // method (default)
        array( // customdata
            'objectiveid'=>$id
        )
);
$mform->set_data($objective);

// If cancelled
if ($mform->is_cancelled()) {

    redirect("$CFG->wwwroot/local/plan/objectivescales/index.php");

// Update data
} else if ($objectivenew = $mform->get_data()) {

    $objectivenew->timemodified = time();
    $objectivenew->usermodified = $USER->id;
    $objectivenew->sortorder = 1 + get_field_sql("select max(sortorder) from {$CFG->prefix}dp_objective_scale");

    // New objective
    if (empty($objectivenew->id)) {
        unset($objectivenew->id);

        begin_sql();

        try {
            if (!$objectivenew->id = insert_record('dp_objective_scale', $objectivenew)) {
                throw new Exception(get_string('error:createnewobjectivescale' ,'local_plan'));
            }

            $objectivevalues = explode("\n", trim($objectivenew->objectivevalues));
            unset($objectivenew->objectivevalues);

            $sortorder = 1;
            $objectiveidlist = array();
            foreach( $objectivevalues as $objectiveval ){
                if ( trim($objectiveval) != '' ){
                    $objectivevalrec = new stdClass();
                    $objectivevalrec->objscaleid = $objectivenew->id;
                    $objectivevalrec->name = trim($objectiveval);
                    $objectivevalrec->sortorder = $sortorder;
                    $objectivevalrec->timemodified = time();
                    $objectivevalrec->usermodified = $USER->id;

                    $result = insert_record('dp_objective_scale_value', $objectivevalrec);
                    if (!$result){
                        throw new Exception(get_string('error:creatingobjectivescalevalues', 'local_plan'));
                    }
                    $objectiveidlist[] = $result;
                    $sortorder++;
                }
            }

            // Set the default objective value to the least competent one, and the
            // "proficient" objective value to the most competent one
            if ( count($objectiveidlist) ){
                $objectivenew->defaultid = $objectiveidlist[count($objectiveidlist)-1];
                update_record('dp_objective_scale', $objectivenew);
            }

            commit_sql();
        } catch ( Exception $e ){
            rollback_sql();
            error( $e->getMessage() );
        }
    // Existing objective
    } else {
        if (!update_record('dp_objective_scale', $objectivenew)) {
            error(get_string('error:updateobjectivescale', 'local_plan'));
        }
    }

    // Reload from db
    $objectivenew = get_record('dp_objective_scale', 'id', $objectivenew->id);

    // Log
    add_to_log(SITEID, 'priorities', 'update', "view.php?id=$objectivenew->id", '');
    redirect("$CFG->wwwroot/local/plan/objectivescales/view.php?id={$objectivenew->id}");
}

/// Print Page
$navlinks = array();    // Breadcrumbs
$navlinks[] = array('name'=>get_string("objectivescales", 'local_plan'),
                    'link'=>"{$CFG->wwwroot}/local/plan/objectivescales/index.php",
                    'type'=>'misc');
if ($id == 0) { // Add
    $navlinks[] = array('name'=>get_string('objectivesscalecreate', 'local_plan'), 'link'=>'', 'type'=>'misc');
    $heading = get_string('objectivesscalecreate', 'local_plan');
} else {    //Edit
    $navlinks[] = array('name'=>get_string('editobjective', 'local_plan', format_string($objective->name)), 'link'=>'', 'type'=>'misc');
    $heading = get_string('editobjective', 'local_plan');
}

admin_externalpage_print_header('', $navlinks);
print_heading($heading);
$mform->display();

admin_externalpage_print_footer();
?>
