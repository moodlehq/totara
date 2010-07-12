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

// Confirm the hierarchy type exists
if (file_exists($CFG->dirroot.'/hierarchy/type/'.$type.'/lib.php')) {
    require_once($CFG->dirroot.'/hierarchy/type/'.$type.'/lib.php');
    $hierarchy = new $type();
} else {
    error('error:hierarchytypenotfound', 'hierarchy', $type);
}
$shortprefix = hierarchy::get_short_prefix($type);

$breadcrumbnavigation = $depthid && $frameworkid ? 1 : 0;

$baseredirect = $CFG->wwwroot . '/customfield/index.php';
$redirect = $baseredirect.'?type='.$type;
$redirectoptions = array('type'=>$type);
if ($subtype !== null) {
    $redirect .= '&subtype='.$subtype;
    $redirectoptions['subtype'] = $subtype;
}
if ($depthid) {
    $redirect .= '&depthid='.$depthid;
    $redirectoptions['depthid'] = $depthid;
    $depth      = $hierarchy->get_depth_by_id($depthid);
    if ($frameworkid) {     // If this is set, it means we navigated here via the framework, etc. Display admin menu and header
        $redirect = "{$CFG->wwwroot}/customfield/custom_field_categories.php?type={$type}&frameworkid={$frameworkid}&depthid={$depthid}&action={$action}";
        $redirectoptions['frameworkid'] = $frameworkid;
        $redirectoptions['categoryid'] = $categoryid;
    }
    
    if (!empty($categoryid)) {
        $category = $hierarchy->get_custom_field_category_by_id($categoryid);
    }

    $pagetitle = format_string($depth->fullname);
    $navlinks[] = array('name' => get_string('administration'), 'link'=> '', 'type'=>'title');
    $navlinks[] = array('name' => get_string($type.'plural',$type), 'link'=> '', 'type'=>'title');
    $navlinks[] = array('name' => get_string($type.'depthcustomfields',$type), 'link'=> '', 'type'=>'title');
    if ($breadcrumbnavigation) {
        $framework  = $hierarchy->get_framework($depth->frameworkid);
        // Override navlinks with detailed breadcrumbs
        $navlinks = array();
        $navlinks[] = array('name'=>get_string("{$type}frameworks", $type), 
                            'link'=>"{$CFG->wwwroot}/hierarchy/framework/index.php?type={$type}", 
                            'type'=>'misc');    // Framework List
        $navlinks[] = array('name'=>format_string($framework->fullname), 
                            'link'=>"{$CFG->wwwroot}/hierarchy/framework/view.php?type={$type}&frameworkid={$framework->id}", 
                            'type'=>'misc');    // Framework View    

/*        $navlinks[] = array('name'=>get_string('customfieldcategories', 'customfields'), 
                            'link'=>"{$CFG->wwwroot}/customfield/index.php?type={$type}&frameworkid={$framework->id}&depthid={$depth->id}", 
                            'type'=>'misc');    // Custom field categories    */
        $navlinks[] = array('name'=>format_string($depth->fullname), 
                            'link'=>"{$CFG->wwwroot}/customfield/custom_field_categories.php?type={$type}&frameworkid={$framework->id}&depthid={$depth->id}", 
                            'type'=>'misc');    // Current page
        if (isset($category)) {
            $navlinks[] = array('name'=>format_string($category->name), 
                                'link'=>"{$CFG->wwwroot}/customfield/index.php?type={$type}&frameworkid={$framework->id}", 
                                'type'=>'misc');    // Category View    
        }
               
    }
} else {
    $pagetitle = format_string(get_string($type.'depthcustomfields',$type));
    $navlinks[] = array('name' => get_string('administration'), 'link'=> '', 'type'=>'title');
    $navlinks[] = array('name' => get_string($type.'plural',$type), 'link'=> '', 'type'=>'title');
    $navlinks[] = array('name' => get_string($type.'depthcustomfields',$type), 'link'=> '', 'type'=>'title');
}

if ($subtype !== null) {
    $tableprefix = $shortprefix.'_'.$subtype;
} else {
    $tableprefix = $shortprefix;
}

$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:update'.$type.'customfield', $sitecontext);

$navigation = build_navigation($navlinks);

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
        if ($frameworkid) {
            $redirect = "{$CFG->wwwroot}/customfield/index.php?type={$type}&subtype={$subtype}&frameworkid={$frameworkid}&depthid={$depthid}&categoryid={$categoryid}";
        }


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
        if ($breadcrumbnavigation) {
            admin_externalpage_setup($type.'frameworkmanage', '', array('type'=>$type));
            admin_externalpage_print_header('', $navlinks);
        } else {
            print_header_simple($pagetitle, '', $navigation, '', null, true);
        }
        print_heading(get_string('deletecategory', 'customfields'), 'left', '1');
        notice_yesno(get_string('confirmcategorydeletion', 'customfields', $fieldcount), $redirect, $redirect, $optionsyes, $redirectoptions, 'post', 'get');
        print_footer();
        die;
        break;
    case 'deletefield':
        require_capability('moodle/local:delete'.$type.'customfield', $sitecontext);
        $id      = required_param('id', PARAM_INT);
        $confirm = optional_param('confirm', 0, PARAM_BOOL);
        if ($frameworkid) {
            $redirect = "{$CFG->wwwroot}/customfield/index.php?type={$type}&subtype={$subtype}&frameworkid={$frameworkid}&depthid={$depthid}&categoryid={$categoryid}";
        }

        if (data_submitted() and $confirm and confirm_sesskey()) {
            customfield_delete_field($id, $tableprefix);
            redirect($redirect);
        }   

        //ask for confirmation
        $datacount = count_records('user_info_data', 'fieldid', $id);
        $optionsyes = array ('id'=>$id, 'confirm'=>1, 'action'=>'deletefield', 'sesskey'=>sesskey());
        if ($breadcrumbnavigation) {
            admin_externalpage_setup($type.'frameworkmanage', '', array('type'=>$type));
            admin_externalpage_print_header('', $navlinks);
        } else {
            print_header_simple($pagetitle, '', $navigation, '', null, true);
        }
        print_heading(get_string('deletefield', 'customfields'), 'left', '1');
        notice_yesno(get_string('confirmfielddeletion', 'customfields', $datacount), $redirect, $redirect, $optionsyes, $redirectoptions, 'post', 'get');
        print_footer();
        die;
        break;
    case 'editfield':
        require_capability('moodle/local:update'.$type.'customfield', $sitecontext);
        $id       = optional_param('id', 0, PARAM_INT);
        $datatype = optional_param('datatype', '', PARAM_ALPHA);
        if ($frameworkid) {
            $redirect = "{$CFG->wwwroot}/customfield/index.php?type={$type}&subtype={$subtype}&frameworkid={$frameworkid}&depthid={$depthid}&categoryid={$categoryid}";
        }

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
if (!($breadcrumbnavigation)) {
    print_header_simple($pagetitle, '', $navigation, '', null, true);
    print_heading(get_string($type.'depthcustomfields', $type));
} else {
    admin_externalpage_setup($type.'frameworkmanage', '', array('type'=>$type));
    
    $framework  = $hierarchy->get_framework($depth->frameworkid);
    
    $navlinks = array();    // Breadcrumbs
    $navlinks[] = array('name'=>get_string("{$type}frameworks", $type), 
                        'link'=>"{$CFG->wwwroot}/hierarchy/framework/index.php?type={$type}", 
                        'type'=>'misc');    // Framework List
    $navlinks[] = array('name'=>format_string($framework->fullname), 
                        'link'=>"{$CFG->wwwroot}/hierarchy/framework/view.php?type={$type}&frameworkid={$framework->id}", 
                        'type'=>'misc');    // Framework View    
    $navlinks[] = array('name'=>format_string($depth->fullname), 
                        'link'=>"{$CFG->wwwroot}/customfield/custom_field_categories.php?type={$type}&frameworkid={$framework->id}&depthid={$depth->id}", 
                        'type'=>'misc');    // Current page
    $navlinks[] = array('name'=>format_string($category->name), 
                        'link'=>'', 
                        'type'=>'misc');    // Category View    
    admin_externalpage_print_header('', $navlinks);

    print_heading(format_string($depth->fullname)." : ".format_string($category->name), 'left', 1);
    print_heading(get_string('customfields', 'customfields'));
}
// show custom fields for the given depth and category
if ($breadcrumbnavigation) {
    $table = new object();
    $table->head  = array(get_string('customfield', 'customfields'), get_string('edit'));
    $table->align = array('left', 'right');
    $table->width = '95%';
    $table->class = 'generaltable customfields';
    $table->id = 'customfields_'.$hierarchy->prefix;
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
    popup_form('index.php?type='.$type.'&amp;subtype='.$subtype.'&id=0&amp;action=editfield&amp;frameworkid='.$frameworkid.'&amp;categoryid='.$categoryid.'&amp;depthid='.$depthid.'&amp;datatype=', $options, 'newfieldform','','choose','','',false,'self',get_string('createnewcustomfield', 'customfields'));



} else if ($depthid) {
// show custom fields for the given depth

    $framework  = $hierarchy->get_framework($depth->frameworkid);
    $categories = get_records_select($tableprefix.'_info_category', "depthid='$depthid'", 'sortorder ASC');
    $categorycount = count($categories);

    echo "<b>".get_string('framework', $type).":</b> <a href=\"".$CFG->wwwroot."/hierarchy/index.php?type={$type}&frameworkid={$framework->id}\">$framework->fullname</a><br>";
    echo "<b>".get_string('depthlevel', $type).":</b> $depth->fullname<br>";

    if (!empty($categories)) {

        foreach($categories as $category) {

            $table = new object();
            $table->head  = array(get_string('customfield', 'customfields'), get_string('edit'));
            $table->align = array('left', 'right');
            $table->width = '95%';
            $table->class = 'generaltable customfields';
            $table->id = 'customfields_'.$hierarchy->prefix;
            $table->data = array();

            if ($fields = get_records_select($tableprefix.'_info_field', "categoryid=$category->id", 'sortorder ASC')) {

                $fieldcount = count($fields);
                print_heading(format_string($category->name).' '.customfield_category_icons($category, $categorycount, $fieldcount, $depthid, $type, $subtype));

                foreach ($fields as $field) {
                    $table->data[] = array($field->fullname, customfield_edit_icons($field, $fieldcount, $depthid, $type, $subtype));
                }   
            } else {
                print_heading(format_string($category->name).' '.customfield_category_icons($category, $categorycount, 0, $depthid, $type, $subtype));
            }
            if (count($table->data)) {
                print_table($table);
            } else {
                notify(get_string('nocustomfieldsdefined', 'customfields'));
            }
        }


        // Create a new custom field dropdown menu
        $options = customfield_list_datatypes();
        popup_form('index.php?type='.$type.'&amp;subtype='.$subtype.'&categoryid=0&amp;action=editfield&amp;depthid='.$depthid.'&amp;datatype=', $options, 'newfieldform','','choose','','',false,'self',get_string('createnewcustomfield', 'customfields'));

    } else {
        // don't let them create a custom field if there are no categories for them to go in
        print '<p>'.get_string('nocustomfieldcategories','customfields').'</p>';
    }

    print '<div class="buttons">';

    // Create a new category link
    $options = array('action'=>'editcategory', 'type'=>$type, 'subtype' => $subtype, 'depthid'=>$depthid);
    print_single_button('index.php', $options, get_string('createcustomfieldcategory', 'customfields'));

    // Create a return to framework link
    $options = array('frameworkid' => $framework->id, 'type' => $type);
    print_single_button("{$CFG->wwwroot}/hierarchy/index.php", $options, get_string('returntoframework', $type));

    print '</div>';

} else {
// show custom fields for all frameworks

    $sql = "SELECT cf.shortname as frameworkshortname, cf.fullname as frameworkfullname,
              cd.fullname as depthfullname, cdc.name as categoryname, cdf.fullname as depthfieldfullname
            FROM {$CFG->prefix}{$shortprefix}_framework cf
            JOIN {$CFG->prefix}{$shortprefix}_depth cd on cd.frameworkid=cf.id
            LEFT OUTER JOIN {$CFG->prefix}{$shortprefix}_depth_info_category cdc on cdc.depthid=cd.id
            LEFT OUTER JOIN {$CFG->prefix}{$shortprefix}_depth_info_field cdf on cdf.depthid=cd.id AND cdf.categoryid=cdc.id
            ORDER BY cf.sortorder, cd.depthlevel, cdc.sortorder, cdf.sortorder";

    if ($rs = get_recordset_sql($sql)) {

        $frameworkshortname = '';
        $depthfullname      = '';
        $categoryname       = '';
        $framework          = array();

        $table = '<table cellpadding="4"><tr><th align="left"><strong>Framework name</strong></th><th align="left">Depth name</th><th align="left">Category name</th><th align="left">Custom field name</th></tr>';

        if ($rs->RecordCount()) {
            while ($u = rs_fetch_next_record($rs)) {
                if ($frameworkshortname != $u->frameworkshortname) {
                    $frameworkshortname = $u->frameworkshortname;
                    $table .= "<tr><td>$u->frameworkshortname</td>";
                } else {
                    $table .= "<tr><td></td>";
                }
                if ($depthfullname != $u->depthfullname) {
                    $depthfullname = $u->depthfullname;
                    $table .= "<td>$u->depthfullname</td>";
                } else {
                    $table .= "<td></td>";
                }
                if ($categoryname != $u->categoryname) {
                    $categoryname = $u->categoryname;
                    $table .= "<td>$u->categoryname</td>";
                } else {
                    $table .= "<td></td>";
                }
                $table .= "<td>$u->depthfieldfullname</td></tr>";
                $frameworkfullname = $u->frameworkfullname;
            }
        }

        $table .= "</table>";
        echo $table;

        $groupcontent = '<tr><td>'.$frameworkfullname.'</td>';
    }
}

print_footer();
