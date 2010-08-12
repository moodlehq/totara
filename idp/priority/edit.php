<?php

require_once '../../config.php';
require_once $CFG->libdir.'/adminlib.php';
require_once 'edit_form.php';


///
/// Setup / loading data
///

// Get paramters
// Priority id; 0 if creating a new priority
$id = optional_param('id', 0, PARAM_INT);
// Page setup and check permissions
admin_externalpage_setup('idppriorities');
$sitecontext = get_context_instance(CONTEXT_SYSTEM);

if ($id == 0) {
    // creating new competency priority
    require_capability('moodle/local:manageidppriorities', $sitecontext);

    $priority = new object();
    $priority->id = 0;
} else {
    // editing existing competency priority
    require_capability('moodle/local:updatecompetency', $sitecontext);

    if (!$priority = get_record('comp_priority', 'id', $id)) {
        error('Competency priority ID was incorrect');
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

    redirect("$CFG->wwwroot/idp/priority/index.php");

// Update data
} else if ($prioritynew = $mform->get_data()) {

    $prioritynew->timemodified = time();
    $prioritynew->usermodified = $USER->id;

    // New priority
    if (empty($prioritynew->id)) {
        unset($prioritynew->id);

        begin_sql();

        try {
            if (!$prioritynew->id = insert_record('idp_tmpl_priority_scale', $prioritynew)) {
                throw new Exception('Error creating new priority');
            }

            $priorityvalues = array_reverse( explode(',',trim($prioritynew->priorityvalues)) );
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

                    $result = insert_record('idp_tmpl_priority_scal_val', $priorityvalrec);
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
                update_record('idp_tmpl_priority_scale', $prioritynew);
            }

            commit_sql();
        } catch ( Exception $e ){
            rollback_sql();
            error( $e->getMessage() );
        }
    // Existing priority
    } else {
        if (!update_record('idp_tmpl_priority_scale', $prioritynew)) {
            error('Error updating priority');
        }
    }

    // Reload from db
    $prioritynew = get_record('idp_tmpl_priority_scale', 'id', $prioritynew->id);

    // Log
    add_to_log(SITEID, 'priorities', 'update', "view.php?id=$prioritynew->id", '');
    redirect("$CFG->wwwroot/idp/priority/view.php?id={$prioritynew->id}");
}

/// Print Page
$navlinks = array();    // Breadcrumbs
$navlinks[] = array('name'=>get_string("priorityscales", 'idp'),
                    'link'=>"{$CFG->wwwroot}/idp/priority/index.php",
                    'type'=>'misc');
if ($id == 0) { // Add
    $navlinks[] = array('name'=>get_string('prioritiescustomcreate', 'idp'), 'link'=>'', 'type'=>'misc');
    $heading = get_string('prioritiescustomcreate', 'idp');
} else {    //Edit
    $navlinks[] = array('name'=>get_string('editpriority', 'grades', format_string($priority->name)), 'link'=>'', 'type'=>'misc');
    $heading = get_string('editpriority', 'idp');
}

admin_externalpage_print_header('', $navlinks);
print_heading($heading);
$mform->display();

admin_externalpage_print_footer();
?>
