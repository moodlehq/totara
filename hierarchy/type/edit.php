<?php

require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/lib.php');
require_once($CFG->dirroot.'/local/js/lib/setup.php');

hierarchy::support_old_url_syntax();

// type id; 0 if creating a new type
$prefix    = required_param('prefix', PARAM_ALPHA); // hierarchy prefix
$shortprefix = hierarchy::get_short_prefix($prefix);
$id      = optional_param('id', 0, PARAM_INT);    // type id; 0 if creating a new type

$page       = optional_param('page', 0, PARAM_INT);
$returnurl = $CFG->wwwroot . '/hierarchy/type/index.php?prefix='. $prefix;

$hierarchy = hierarchy::load_hierarchy($prefix);

require_once($CFG->dirroot.'/local/icon/'.$prefix.'_type_icon.class.php');
$typename = $prefix.'_type_icon';
$type_icon = new $typename();

// If the hierarchy prefix has type editing files use them else use the generic files
if (file_exists($CFG->dirroot.'/hierarchy/prefix/'.$prefix.'/type/edit.php')) {
    require_once($CFG->dirroot.'/hierarchy/prefix/'.$prefix.'/type/edit_form.php');
    require_once($CFG->dirroot.'/hierarchy/prefix/'.$prefix.'/type/edit.php');
    die;
} else {
    require_once($CFG->dirroot.'/hierarchy/type/edit_form.php');
}

// Manage frameworks
admin_externalpage_setup($prefix.'typemanage');

$context = get_context_instance(CONTEXT_SYSTEM);

if ($id == 0) {
    // creating new type
    require_capability('moodle/local:create'.$prefix.'type', $context);

    $type = new object();
    $type->id = 0;

} else {
    // editing existing type
    require_capability('moodle/local:update'.$prefix.'type', $context);
    if (!$type = $hierarchy->get_type_by_id($id)) {
        error('Type ID was incorrect');
    }
}

// Include JS for icon preview
local_js(array(TOTARA_JS_ICON_PREVIEW));

// create form
$datatosend = array('prefix'=>$prefix, 'page' => $page, 'type' => $type);
$typeform  = new type_edit_form(null, $datatosend);
$typeform->set_data($type);

// cancelled
if ($typeform->is_cancelled()) {

    redirect($returnurl);

// update data
} else if ($typenew = $typeform->get_data()) {

    $typenew->timemodified = time();
    $typenew->usermodified = $USER->id;

    // new type
    if ($typenew->id == 0) {
        unset($typenew->id);

        $typenew->timecreated = time();

        if (!$typenew->id = insert_record($shortprefix.'_type', $typenew)) {
            totara_set_notification(get_string('error:createtype', $prefix, $typenew->fullname), $returnurl);
        } else {
            // Reload from db
            $typenew = get_record($shortprefix.'_type', 'id', $typenew->id);
            $type_icon->process_form($typenew);

            add_to_log(SITEID, $prefix, 'create type', "type/index.php?prefix={$prefix}", "{$typenew->fullname} (ID {$typenew->id})");
            totara_set_notification(get_string('createtype', $prefix, $typenew->fullname), $returnurl, array('style'=>'notifysuccess'));
        }

    // Existing type
    } else {
        if (!update_record($shortprefix.'_type', $typenew)) {
            totara_set_notification(get_string('error:updatetype', $prefix, $typenew->fullname), $returnurl);
        } else {
            // Reload from db
            $typenew = get_record($shortprefix.'_type', 'id', $typenew->id);
            $type_icon->process_form($typenew);

            add_to_log(SITEID, $prefix, 'update type', "type/edit.php?id={$typenew->id}", "{$typenew->fullname}(ID {$typenew->id})");
            totara_set_notification(get_string('updatetype', $prefix, $typenew->fullname), $returnurl, array('style'=>'notifysuccess'));
        }
    }
}


/// Display page header
$navlinks = array();    // Breadcrumbs
$navlinks[] = array('name'=>get_string("{$prefix}types", $prefix),
                    'link'=>$returnurl,
                    'type'=>'misc');

if ($id == 0) {
    $navlinks[] = array('name'=>get_string('addtype', $prefix), 'link'=>'', 'type'=>'misc');
} else {
    $navlinks[] = array('name'=>get_string('editgeneric', $prefix, format_string($type->fullname)), 'link'=>'', 'type'=>'misc');
}

admin_externalpage_print_header('', $navlinks);

if ($type->id == 0) {
    print_heading(get_string('addtype', $prefix));
} else {
    print_heading(get_string('editgeneric', $prefix, format_string($type->fullname)));
}

/// Finally display the form
$typeform->display();

print_footer();
