<?php

require('../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/customfield/indexlib.php');
require_once($CFG->dirroot.'/customfield/fieldlib.php');
require_once($CFG->dirroot.'/customfield/definelib.php');
require_once($CFG->dirroot.'/hierarchy/lib.php');

$type           = required_param('type', PARAM_SAFEDIR);        // hierarchy name or mod name
$subtype        = optional_param('subtype', null, PARAM_ALPHA); // e.g., 'depth' or f2f 'session'
$depthid        = optional_param('depthid', '0', PARAM_INT);    // depthid if hierarchy
$frameworkid    = optional_param('frameworkid', '0', PARAM_INT);
$categoryid     = optional_param('categoryid', '0', PARAM_INT);
$action         = optional_param('action', '', PARAM_ALPHA);    // param for some action
$id             = optional_param('id', 0, PARAM_INT); // id of a custom field

// use $type and $subtype to determine where to get custom field data from
if($type == 'course') {
    $shortprefix = 'course';
    $adminpagename = 'coursecustomfields';
} else {
    // Confirm the hierarchy type exists
    if (file_exists($CFG->dirroot.'/hierarchy/type/'.$type.'/lib.php')) {
        require_once($CFG->dirroot.'/hierarchy/type/'.$type.'/lib.php');
        $hierarchy = new $type();
    } else {
        error('error:hierarchytypenotfound', 'hierarchy', $type);
    }
    $shortprefix = hierarchy::get_short_prefix($type);
    $adminpagename = $type . 'frameworkmanage';
}
if ($subtype !== null && $subtype != '') {
    $tableprefix = $shortprefix.'_'.$subtype;
} else {
    $tableprefix = $shortprefix;
}


// work out where to redirect to after this page
if($id || $action == 'editfield') {
    $baseredirect = $CFG->wwwroot . '/customfield/index.php';
} else {
    $baseredirect = $CFG->wwwroot . '/customfield/custom_field_categories.php';
}
$redirect = $baseredirect.'?type='.$type;
$redirectoptions = array('type'=>$type);
if ($subtype !== null) {
    $redirect .= '&amp;subtype='.$subtype;
    $redirectoptions['subtype'] = $subtype;
}
if ($depthid) {
    $redirect .= '&amp;depthid='.$depthid.'&amp;frameworkid='.$frameworkid;
    $redirectoptions['depthid'] = $depthid;
    $redirectoptions['frameworkid'] = $frameworkid;
}
if ($categoryid) {
    $redirect .= "&amp;categoryid=$categoryid";
    $redirectoptions['categoryid'] = $categoryid;
}
if ($id) {
    $redirect .= "&amp;id=$id";
    $redirectoptions['id'] = $id;
}

// get some relevant data
if($depthid) {
    $depth = $hierarchy->get_depth_by_id($depthid);
    $framework  = $hierarchy->get_framework($depth->frameworkid);
}
if($categoryid) {
    if($depthid) {
        $category = $hierarchy->get_custom_field_category_by_id($categoryid);
    }
    if ($type == 'course') {
        $category = get_course_custom_field_category_by_id($categoryid);
    }
}


// set up breadcrumbs trail
if ($depthid) {
    $pagetitle = format_string(get_string($type.'depthcustomfields',$type));
    $navlinks = array();
    $navlinks[] = array('name'=>get_string("{$type}frameworks", $type),
                        'link'=>"{$CFG->wwwroot}/hierarchy/framework/index.php?type={$type}",
                        'type'=>'misc');    // Framework List
    $navlinks[] = array('name'=>format_string($framework->fullname),
                        'link'=>"{$CFG->wwwroot}/hierarchy/framework/view.php?type={$type}&frameworkid={$framework->id}",
                        'type'=>'misc');    // Framework View
    $navlinks[] = array('name'=>format_string($depth->fullname),
                        'link'=>"{$CFG->wwwroot}/customfield/custom_field_categories.php?type={$type}&frameworkid={$framework->id}&depthid={$depth->id}",
                        'type'=>'misc');    // Current page
    if (isset($category)) {
        $navlinks[] = array('name'=>format_string($category->name),
                            'link'=>"{$CFG->wwwroot}/customfield/index.php?type={$type}&frameworkid={$framework->id}",
                            'type'=>'misc');    // Category View
    }
} else if ($type == 'course') {
    $pagetitle = format_string(get_string('coursecustomfields','customfields'));
    $navlinks[] = array('name' => get_string('administration'), 'link'=> '', 'type'=>'title');
    $navlinks[] = array('name' => get_string('courses'), 'link'=> '', 'type'=>'title');
    $navlinks[] = array('name' => get_string('coursecustomfields','customfields'), 'link'=> '', 'type'=>'title');
    if (isset($category)) {
        $navlinks[] = array('name'=>format_string($category->name),
                            'link'=>"{$CFG->wwwroot}/customfield/index.php?type={$type}",
                            'type'=>'misc');    // Category View
    }
} else {
    $pagetitle = format_string(get_string($type.'depthcustomfields',$type));
    $navlinks[] = array('name' => get_string('administration'), 'link'=> '', 'type'=>'title');
    $navlinks[] = array('name' => get_string($type.'plural',$type), 'link'=> '', 'type'=>'title');
    $navlinks[] = array('name' => get_string($type.'depthcustomfields',$type), 'link'=> '', 'type'=>'title');
}


$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:update'.$type.'customfield', $sitecontext);
admin_externalpage_setup($adminpagename, '', array('type' => $type));

// check if any actions need to be performed
switch ($action) {
    case 'movecategory':
        require_capability('moodle/local:update'.$type.'customfield', $sitecontext);
        $id  = required_param('categoryid', PARAM_INT);
        $dir = required_param('dir', PARAM_ALPHA);

        if (confirm_sesskey()) {
            customfield_move_category($id, $dir, $depthid, $tableprefix);
        }
        redirect($redirect);
        break;
   case 'movefield':
        require_capability('moodle/local:update'.$type.'customfield', $sitecontext);
        $id  = required_param('id', PARAM_INT);
        $dir = required_param('dir', PARAM_ALPHA);

        if (confirm_sesskey()) {
            customfield_move_field($id, $dir, $tableprefix);
        }
        redirect($redirect);
        break;
    case 'deletecategory':
        require_capability('moodle/local:delete'.$type.'customfield', $sitecontext);
        $id      = required_param('categoryid', PARAM_INT);
        $confirm = optional_param('confirm', 0, PARAM_BOOL);

        if (data_submitted() and $confirm and confirm_sesskey()) {
            customfield_delete_category($id, $depthid, $tableprefix);
            redirect($redirect);
        }

        //ask for confirmation
        $fieldcount = count_records($tableprefix.'_info_field', 'categoryid', $id);
        $optionsyes = array ('categoryid'=>$id, 'confirm'=>1, 'action'=>'deletecategory', 'sesskey'=>sesskey());
        admin_externalpage_print_header('', $navlinks);
        print_heading(get_string('deletecategory', 'customfields'), 'left', '1');
        notice_yesno(get_string('confirmcategorydeletion', 'customfields', $fieldcount), $redirect, $redirect, $optionsyes, $redirectoptions, 'post', 'get');
        print_footer();
        die;
        break;
    case 'deletefield':
        require_capability('moodle/local:delete'.$type.'customfield', $sitecontext);
        $id      = required_param('id', PARAM_INT);
        $confirm = optional_param('confirm', 0, PARAM_BOOL);

        if (data_submitted() and $confirm and confirm_sesskey()) {
            customfield_delete_field($id, $tableprefix);
            redirect($redirect);
        }

        //ask for confirmation
        $datacount = count_records($tableprefix . '_info_data', 'fieldid', $id);
        $optionsyes = array ('id'=>$id, 'confirm'=>1, 'action'=>'deletefield', 'sesskey'=>sesskey());
        admin_externalpage_print_header('', $navlinks);
        print_heading(get_string('deletefield', 'customfields'), 'left', '1');
        notice_yesno(get_string('confirmfielddeletion', 'customfields', $datacount), $redirect, $redirect, $optionsyes, $redirectoptions, 'post', 'get');
        print_footer();
        die;
        break;
    case 'editfield':
        require_capability('moodle/local:update'.$type.'customfield', $sitecontext);
        $id       = optional_param('id', 0, PARAM_INT);
        $datatype = optional_param('datatype', '', PARAM_ALPHA);

        customfield_edit_field($id, $datatype, $depthid, $redirect, $tableprefix, $type, $subtype, $frameworkid, $categoryid, $navlinks);
        die;
        break;
    case 'editcategory':
        require_capability('moodle/local:update'.$type.'customfield', $sitecontext);
        $id = optional_param('categoryid', 0, PARAM_INT);

        customfield_edit_category($id, $depthid, $redirect, $tableprefix, $type, $subtype, $frameworkid, $navlinks);
        die;
        break;
    default:
}
// Display page header




admin_externalpage_print_header('', $navlinks);

if($type == 'course') {
    $heading = get_string('coursecustomfields', 'customfields');
    if($categoryid) {
        $heading .= ' : ' . format_string($category->name);
    }
    print_heading($heading, 'left', 1);
} else {
    print_heading(format_string($depth->fullname)." : ".format_string($category->name), 'left', 1);
}

print_heading(get_string('customfields', 'customfields'));


// show custom fields for the given depth and category
$table = new object();
$table->head  = array(get_string('customfield', 'customfields'), get_string('edit'));
$table->align = array('left', 'right');
$table->width = '95%';
$table->class = 'generaltable customfields';
if($type == 'course') {
    $table->id = 'customfields_course';
} else {
    $table->id = 'customfields_'.$hierarchy->prefix;
}
$table->data = array();


if ($fields = get_records_select($tableprefix.'_info_field', "categoryid=$categoryid", 'sortorder ASC')) {

    $fieldcount = count($fields);

    foreach ($fields as $field) {
        $table->data[] = array($field->fullname, customfield_edit_icons($field, $fieldcount, $depthid, $type, $subtype, $frameworkid, $categoryid));
    }
}
if (count($table->data)) {
    print_table($table);
} else {
    notify(get_string('nocustomfieldsdefined', 'customfields'));
}
echo "<br>";
// Create a new custom field dropdown menu
$options = customfield_list_datatypes();

if($type == 'course') {
    popup_form('index.php?type='.$type.'&amp;id=0&amp;action=editfield&amp;categoryid='.$categoryid.'&amp;datatype=', $options, 'newfieldform','','choose','','',false,'self',get_string('createnewcustomfield', 'customfields'));
} else {
    popup_form('index.php?type='.$type.'&amp;subtype='.$subtype.'&id=0&amp;action=editfield&amp;frameworkid='.$frameworkid.'&amp;categoryid='.$categoryid.'&amp;depthid='.$depthid.'&amp;datatype=', $options, 'newfieldform','','choose','','',false,'self',get_string('createnewcustomfield', 'customfields'));
}

print_footer();
