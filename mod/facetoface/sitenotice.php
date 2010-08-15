<?php

require_once '../../config.php';
require_once 'sitenotice_form.php';

$id      = required_param('id', PARAM_INT); // ID in facetoface_notice
$d       = optional_param('d', false, PARAM_BOOL); // set to true to delete the given notice
$confirm = optional_param('confirm', false, PARAM_BOOL); // delete confirmation

$notice = null;
if ($id > 0) {
    if (!$notice = get_record('facetoface_notice', 'id', $id)) {
        error('Notice ID is incorrect: '. $id);
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

$title = get_string('addnewnotice', 'facetoface');
if ($notice != null) {
    $title = $notice->name;
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
        $info = new object();
        $info->name = format_string($notice->name);
        $info->text = format_text($notice->text, FORMAT_HTML);
        notice_yesno(get_string('noticedeleteconfirm', 'facetoface', $info),
                     "sitenotice.php?id=$id&amp;d=1&amp;confirm=1&amp;sesskey=$USER->sesskey", $returnurl);
        print_footer();
        exit;
    }
    else {
        begin_sql();
        if (!delete_records('facetoface_notice', 'id', $id)) {
            rollback_sql();
            print_error('error:couldnotdeletenotice', 'facetoface', $returnurl);
        }
        if (!delete_records('facetoface_notice_data', 'noticeid', $id)) {
            rollback_sql();
            print_error('error:couldnotdeletenotice', 'facetoface', $returnurl);
        }
        commit_sql();
        redirect($returnurl);
    }
}

$customfields = facetoface_get_session_customfields();

$mform = new mod_facetoface_sitenotice_form(null, compact('id', 'customfields'));
if ($mform->is_cancelled()){
    redirect($returnurl);
}

if ($fromform = $mform->get_data()) { // Form submitted

    if (empty($fromform->submitbutton)) {
        print_error('error:unknownbuttonclicked', 'facetoface', $returnurl);
    }

    $todb = new object();
    $todb->name = trim($fromform->name);
    $todb->text = trim($fromform->text);

    begin_sql();

    if ($notice != null) {
        $todb->id = $notice->id;
        if (!update_record('facetoface_notice', $todb)) {
            rollback_sql();
            print_error('error:couldnotupdatenotice', 'facetoface', $returnurl);
        }
    }
    else {
        $notice = new object();
        if (!$notice->id = insert_record('facetoface_notice', $todb)) {
            rollback_sql();
            print_error('error:couldnotaddnotice', 'facetoface', $returnurl);
        }
    }

    foreach ($customfields as $field) {
        $fieldname = "custom_$field->shortname";
        if (empty($fromform->$fieldname)) {
            $fromform->$fieldname = ''; // need to be able to clear fields
        }

        if (!facetoface_save_customfield_value($field->id, $fromform->$fieldname, $notice->id, 'notice')) {
            rollback_sql();
            print_error('error:couldnotsavecustomfield', 'facetoface', $returnurl);
        }
    }

    commit_sql();
    redirect($returnurl);
}
elseif ($notice != null) { // Edit mode
    // Set values for the form
    $toform = new object();
    $toform->name = $notice->name;
    $toform->text = $notice->text;

    foreach ($customfields as $field) {
        $fieldname = "custom_$field->shortname";
        $toform->$fieldname = facetoface_get_customfield_value($field, $notice->id, 'notice');
    }

    $mform->set_data($toform);
}

print_header_simple(format_string($title), '', $navigation, '', '', true);

print_box_start();
print_heading($title);

$mform->display();

print_box_end();
print_footer();
