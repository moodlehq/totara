<?php

require_once '../../config.php';
require_once 'customfield_form.php';

$id      = required_param('id', PARAM_INT); // ID in facetoface_session_field
$d       = optional_param('d', false, PARAM_BOOL); // set to true to delete the given field
$confirm = optional_param('confirm', false, PARAM_BOOL); // delete confirmationx

$field = null;
if ($id > 0) {
    if (!$field = get_record('facetoface_session_field', 'id', $id)) {
        error('Field ID is incorrect: '. $id);
    }
}

$contextsystem = get_context_instance(CONTEXT_SYSTEM);

require_login(0, false);
require_capability('moodle/site:config', $contextsystem);

$returnurl = "$CFG->wwwroot/admin/settings.php?section=modsettingfacetoface";

// Header
$navlinks = array();
$navlinks[] = array('name' => get_string('administration'));
$navlinks[] = array('name' => get_string('managemodules'));
$navlinks[] = array('name' => get_string('activities'));
$navlinks[] = array('name' => get_string('modulename', 'facetoface'));

$title = get_string('addnewfield', 'facetoface');
if ($field != null) {
    $title = $field->name;
}
$navlinks[] = array('name' => format_string($title));
$navigation = build_navigation($navlinks);

// Handle deletions
if (!empty($d)) {
    if (!confirm_sesskey()) {
        print_error('confirmsesskeybad', 'error');
    }

    if (!$confirm) {
        print_header_simple(format_string($title), '', $navigation, '', '', true);
        notice_yesno(get_string('fielddeleteconfirm', 'facetoface', format_string($field->name)),
                     "customfield.php?id=$id&amp;d=1&amp;confirm=1&amp;sesskey=$USER->sesskey", $returnurl);
        print_footer();
        exit;
    }
    else {
        begin_sql();
        if (!delete_records('facetoface_session_field', 'id', $id)) {
            rollback_sql();
            print_error('error:couldnotdeletefield', 'facetoface', $returnurl);
        }
        if (!delete_records('facetoface_session_data', 'fieldid', $id)) {
            rollback_sql();
            print_error('error:couldnotdeletefield', 'facetoface', $returnurl);
        }
        commit_sql();
        redirect($returnurl);
    }
}

$mform = new mod_facetoface_customfield_form(null, compact('id'));
if ($mform->is_cancelled()){
    redirect($returnurl);
}

if ($fromform = $mform->get_data()) { // Form submitted

    if (empty($fromform->submitbutton)) {
        print_error('error:unknownbuttonclicked', 'facetoface', $returnurl);
    }

    // Post-process the input
    if (empty($fromform->required)) {
        $fromform->required = 0;
    }
    if (empty($fromform->isfilter)) {
        $fromform->isfilter = 0;
    }
    if (empty($fromform->showinsummary)) {
        $fromform->showinsummary = 0;
    }
    if (empty($fromform->type)) {
        $fromform->possiblevalues = '';
    }

    $todb = new object();
    $todb->name = trim($fromform->name);
    $todb->shortname = trim($fromform->shortname);
    $todb->type = $fromform->type;
    $todb->defaultvalue = trim($fromform->defaultvalue);
    $todb->possiblevalues = trim($fromform->possiblevalues);
    $todb->required = $fromform->required;
    $todb->isfilter = $fromform->isfilter;
    $todb->showinsummary = $fromform->showinsummary;

    if ($field != null) {
        $todb->id = $field->id;
        if (!update_record('facetoface_session_field', $todb)) {
            print_error('error:couldnotupdatefield', 'facetoface', $returnurl);
        }
    }
    else {
        if (!insert_record('facetoface_session_field', $todb)) {
            print_error('error:couldnotaddfield', 'facetoface', $returnurl);
        }
    }

    redirect($returnurl);
}
elseif ($field != null) { // Edit mode
    // Set values for the form
    $toform = new object();
    $toform->name = $field->name;
    $toform->shortname = $field->shortname;
    $toform->type = $field->type;
    $toform->defaultvalue = $field->defaultvalue;
    $toform->possiblevalues = $field->possiblevalues;
    $toform->required = ($field->required == 1);
    $toform->isfilter = ($field->isfilter == 1);
    $toform->showinsummary = ($field->showinsummary == 1);

    $mform->set_data($toform);
}

print_header_simple(format_string($title), '', $navigation, '', '', true);

print_box_start();
print_heading($title);

$mform->display();

print_box_end();
print_footer();
