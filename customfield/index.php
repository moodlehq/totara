<?php

require('../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/customfield/indexlib.php');
require_once($CFG->dirroot.'/customfield/fieldlib.php');
require_once($CFG->dirroot.'/customfield/definelib.php');
require_once($CFG->dirroot.'/hierarchy/lib.php');

hierarchy::support_old_url_syntax();

$prefix         = required_param('prefix', PARAM_ALPHA);        // hierarchy name or mod name
$typeid         = optional_param('typeid', '0', PARAM_INT);    // typeid if hierarchy
$action         = optional_param('action', '', PARAM_ALPHA);    // param for some action
$id             = optional_param('id', 0, PARAM_INT); // id of a custom field

// use $prefix to determine where to get custom field data from
if ($prefix == 'course') {
    $shortprefix = 'course';
    $adminpagename = 'coursecustomfields';
    $tableprefix = $shortprefix;
} else {
    // Confirm the hierarchy prefix exists
    $hierarchy = hierarchy::load_hierarchy($prefix);
    $shortprefix = hierarchy::get_short_prefix($prefix);
    $adminpagename = $prefix . 'typemanage';
    $tableprefix = $shortprefix.'_type';
}

$redirect = $CFG->wwwroot . '/customfield/index.php?prefix='.$prefix;
$redirectoptions = array('prefix'=>$prefix);
if ($typeid) {
    $redirect .= '&amp;typeid='.$typeid;
    $redirectoptions['typeid'] = $typeid;
}
if ($id) {
    $redirect .= "&amp;id=$id";
    $redirectoptions['id'] = $id;
}

// get some relevant data
if ($typeid) {
    $type = $hierarchy->get_type_by_id($typeid);
}

// set up breadcrumbs trail
if ($typeid) {
    $pagetitle = format_string(get_string($prefix.'depthcustomfields',$prefix));

    $navlinks = array();
    $navlinks[] = array('name'=>get_string("{$prefix}types", $prefix),
                        'link'=>"{$CFG->wwwroot}/hierarchy/type/index.php?prefix={$prefix}",
                        'class'=>'misc');    // types List

    $navlinks[] = array('name'=>format_string($type->fullname),
                        'link'=>'',
                        'class'=>'title');

} else if ($prefix == 'course') {
    $pagetitle = format_string(get_string('coursecustomfields','customfields'));
    $navlinks[] = array('name' => get_string('administration'), 'link'=> '', 'class'=>'title');
    $navlinks[] = array('name' => get_string('courses'), 'link'=> '', 'class'=>'title');
    $navlinks[] = array('name' => get_string('coursecustomfields','customfields'), 'link'=> '', 'class'=>'title');
} else {
    $navlinks = array();
}

$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:update'.$prefix.'customfield', $sitecontext);
admin_externalpage_setup($adminpagename, '', array('prefix' => $prefix));

// check if any actions need to be performed
switch ($action) {
   case 'movefield':
        require_capability('moodle/local:update'.$prefix.'customfield', $sitecontext);
        $id  = required_param('id', PARAM_INT);
        $dir = required_param('dir', PARAM_ALPHA);

        if (confirm_sesskey()) {
            customfield_move_field($id, $dir, $tableprefix);
        }
        redirect($redirect);
        break;
    case 'deletefield':
        require_capability('moodle/local:delete'.$prefix.'customfield', $sitecontext);
        $id      = required_param('id', PARAM_INT);
        $confirm = optional_param('confirm', 0, PARAM_BOOL);

        if (data_submitted() and $confirm and confirm_sesskey()) {
            customfield_delete_field($id, $tableprefix);
            redirect($redirect);
        }

        //ask for confirmation
        $optionsyes = array ('id'=>$id, 'confirm'=>1, 'action'=>'deletefield', 'sesskey'=>sesskey());
        admin_externalpage_print_header('', $navlinks);
        print_heading(get_string('deletefield', 'customfields'), '', '1');
        notice_yesno(get_string('confirmfielddeletion', 'customfields', $datacount), $redirect, $redirect, $optionsyes, $redirectoptions, 'post', 'get');
        print_footer();
        die;
        break;
    case 'editfield':
        require_capability('moodle/local:update'.$prefix.'customfield', $sitecontext);
        $id       = optional_param('id', 0, PARAM_INT);
        $datatype = optional_param('datatype', '', PARAM_ALPHA);

        customfield_edit_field($id, $datatype, $typeid, $redirect, $tableprefix, $prefix, $navlinks);
        die;
        break;
    default:
}
// Display page header

admin_externalpage_print_header('', $navlinks);

// Print return to type link
if($prefix != 'course') {
    echo '<p><a href="'.$CFG->wwwroot . '/hierarchy/type/index.php?prefix='.$prefix.'&amp;typeid='.$typeid.'">&laquo; '.get_string('alltypes', 'hierarchy').'</a></p>';
}

if($prefix == 'course') {
    $heading = get_string('coursecustomfields', 'customfields');
    if($categoryid) {
        $heading .= ' : ' . format_string($category->name);
    }
    print_heading($heading, 'left', 1);
} else {
    print_heading(format_string($type->fullname), 'left', 1);
}

// show custom fields for the given type
$table = new object();
$table->head  = array(get_string('customfield', 'customfields'), get_string('edit'));
$table->align = array('left', 'right');
$table->width = '95%';
$table->class = 'generaltable customfields';
if($prefix == 'course') {
    $table->id = 'customfields_course';
} else {
    $table->id = 'customfields_'.$hierarchy->prefix;
}
$table->data = array();

if ($typeid) {
    $field = 'typeid';
    $value = $typeid;
} else {
    $field = '';
    $value = '';
}

if ($fields = get_records($tableprefix.'_info_field', $field , $value , 'sortorder ASC')) {

    $fieldcount = count($fields);

    foreach ($fields as $field) {
        $table->data[] = array($field->fullname, customfield_edit_icons($field, $fieldcount, $typeid, $prefix));
    }
}
if (count($table->data)) {
    print_table($table);
} else {
    notify(get_string('nocustomfieldsdefined', 'customfields'));
}
echo "<br />";
// Create a new custom field dropdown menu
$options = customfield_list_datatypes();

if($prefix == 'course') {
    popup_form('index.php?prefix='.$prefix.'&amp;id=0&amp;action=editfield&amp;datatype=', $options, 'newfieldform','','choose','','',false,'self',get_string('createnewcustomfield', 'customfields'));
} else {
    popup_form('index.php?prefix='.$prefix.'&amp;id=0&amp;action=editfield&amp;typeid='.$typeid.'&amp;datatype=', $options, 'newfieldform','','choose','','',false,'self',get_string('createnewcustomfield', 'customfields'));
}

print_footer();
