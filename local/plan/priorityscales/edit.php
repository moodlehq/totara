<?php

require_once '../../../config.php';
require_once $CFG->libdir.'/adminlib.php';
require_once 'edit_form.php';


///
/// Setup / loading data
///

// Get paramters
$id = optional_param('id', 0, PARAM_INT); // Priority id; 0 if creating a new priority
// Page setup and check permissions
admin_externalpage_setup('priorityscales');
$sitecontext = get_context_instance(CONTEXT_SYSTEM);

require_capability('local/plan:managepriorityscales', $sitecontext);
if ($id == 0) {
    // creating new idp priority
    $priority = new object();
    $priority->id = 0;
} else {
    // editing existing idp priority
    if (!$priority = get_record('dp_priority_scale', 'id', $id)) {
        error(get_string('error:priorityscaleidincorrect', 'local_plan'));
    }
}

///
/// Handle form data
///

$mform = new edit_priority_form(
        null, // method (default)
        array( // customdata
            'priorityid'=>$id
        )
);
$mform->set_data($priority);

// If cancelled
if ($mform->is_cancelled()) {

    redirect("$CFG->wwwroot/local/plan/priorityscales/index.php");

// Update data
} else if ($prioritynew = $mform->get_data()) {

    $prioritynew->timemodified = time();
    $prioritynew->usermodified = $USER->id;
    $prioritynew->sortorder = 1 + get_field_sql("select max(sortorder) from {$CFG->prefix}dp_priority_scale");

    // New priority
    if (empty($prioritynew->id)) {
        unset($prioritynew->id);

        begin_sql();

        try {
            if (!$prioritynew->id = insert_record('dp_priority_scale', $prioritynew)) {
                throw new Exception('error:createnewpriorityscale' ,'local_plan');
            }

            $priorityvalues = explode("\n", trim($prioritynew->priorityvalues));
            unset($prioritynew->priorityvalues);

            $sortorder = 1;
            $priorityidlist = array();
            foreach( $priorityvalues as $priorityval ){
                if ( trim($priorityval) != '' ){
                    $priorityvalrec = new stdClass();
                    $priorityvalrec->priorityscaleid = $prioritynew->id;
                    $priorityvalrec->name = trim($priorityval);
                    $priorityvalrec->sortorder = $sortorder;
                    $priorityvalrec->timemodified = time();
                    $priorityvalrec->usermodified = $USER->id;

                    $result = insert_record('dp_priority_scale_value', $priorityvalrec);
                    if (!$result){
                        throw new Exception('Error creating new IDP priority values');
                    }
                    $priorityidlist[] = $result;
                    $sortorder++;
                }
            }

            // Set the default priority value to the least competent one, and the
            // "proficient" priority value to the most competent one
            if ( count($priorityidlist) ){
                $prioritynew->defaultid = $priorityidlist[count($priorityidlist)-1];
                $prioritynew->proficient = $priorityidlist[0];
                update_record('dp_priority_scale', $prioritynew);
            }

            commit_sql();
        } catch ( Exception $e ){
            rollback_sql();
            error( $e->getMessage() );
        }
    // Existing priority
    } else {
        if (!update_record('dp_priority_scale', $prioritynew)) {
            error(get_string('error:updatingpriorityscale', 'local_plan'));
        }
    }

    // Reload from db
    $prioritynew = get_record('dp_priority_scale', 'id', $prioritynew->id);

    // Log
    add_to_log(SITEID, 'priorities', 'update', "view.php?id=$prioritynew->id", '');
    redirect("$CFG->wwwroot/local/plan/priorityscales/view.php?id={$prioritynew->id}");
}

/// Print Page
$navlinks = array();    // Breadcrumbs
$navlinks[] = array('name'=>get_string("priorityscales", 'local_plan'),
                    'link'=>"{$CFG->wwwroot}/local/plan/priorityscales/index.php",
                    'type'=>'misc');
if ($id == 0) { // Add
    $navlinks[] = array('name'=>get_string('priorityscalecreate', 'local_plan'), 'link'=>'', 'type'=>'misc');
    $heading = get_string('priorityscalecreate', 'local_plan');
} else {    //Edit
    $navlinks[] = array('name'=>get_string('editpriority', 'local_plan', format_string($priority->name)), 'link'=>'', 'type'=>'misc');
    $heading = get_string('editpriority', 'local_plan');
}

admin_externalpage_print_header('', $navlinks);
print_heading($heading);
$mform->display();

admin_externalpage_print_footer();
?>
