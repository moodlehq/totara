<?php

require('../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->libdir.'/customfieldlib.php');
require_once($CFG->libdir.'/customfield/definelib.php');

$depthid    = optional_param('depthid', '0', PARAM_INT);
$action   = optional_param('action', '', PARAM_ALPHA);

$redirect    = $CFG->wwwroot.'/competencies/depth/customfields/index.php';
$tableprefix = 'competency_depth';

if ($depthid) {
    $redirect .= '?depthid='.$depthid;
}

admin_externalpage_setup('competencydepthcustomfields');

// check if any actions need to be performed
switch ($action) {
    case 'movecategory':
        $id  = required_param('id', PARAM_INT);
        $dir = required_param('dir', PARAM_ALPHA);

        if (confirm_sesskey()) {
            customfield_move_category($id, $dir, $depthid, $tableprefix);
        }   
        redirect($redirect);
        break;
   case 'movefield':
        $id  = required_param('id', PARAM_INT);
        $dir = required_param('dir', PARAM_ALPHA);

        if (confirm_sesskey()) {
            customfield_move_field($id, $dir, $tableprefix);
        }   
        redirect($redirect);
        break;
    case 'deletecategory':
        $id      = required_param('id', PARAM_INT);
        $confirm = optional_param('confirm', 0, PARAM_BOOL);

        if (data_submitted() and $confirm and confirm_sesskey()) {
            customfield_delete_category($id, $depthid, $tableprefix);
            redirect($redirect);
        }   

        //ask for confirmation
        $fieldcount = count_records('competency_depth_info_field', 'categoryid', $id);
        $optionsyes = array ('id'=>$id, 'confirm'=>1, 'action'=>'deletecategory', 'sesskey'=>sesskey());
        admin_externalpage_print_header();
        print_heading('deletecategory', 'customfields');
        notice_yesno(get_string('confirmcategorydeletion', 'customfields', $fieldcount), $redirect, $redirect, $optionsyes, null, 'post', 'get');
        admin_externalpage_print_footer();
        die;
        break;
    case 'deletefield':
        $id      = required_param('id', PARAM_INT);
        $confirm = optional_param('confirm', 0, PARAM_BOOL);

        if (data_submitted() and $confirm and confirm_sesskey()) {
            customfield_delete_field($id, $tableprefix);
            redirect($redirect);
        }   

        //ask for confirmation
        $datacount = count_records('user_info_data', 'fieldid', $id);
        $optionsyes = array ('id'=>$id, 'confirm'=>1, 'action'=>'deletefield', 'sesskey'=>sesskey());
        admin_externalpage_print_header();
        print_heading('deletefield', 'customfields');
        notice_yesno(get_string('confirmfielddeletion', 'customfields', $datacount), $redirect, $redirect, $optionsyes, null, 'post', 'get');
        admin_externalpage_print_footer();
        die;
        break;
    case 'editfield':
        $id       = optional_param('id', 0, PARAM_INT);
        $datatype = optional_param('datatype', '', PARAM_ALPHA);

        customfield_edit_field($id, $datatype, $depthid, $redirect, $tableprefix);
        die;
        break;
    case 'editcategory':
        $id = optional_param('id', 0, PARAM_INT);

        customfield_edit_category($id, $depthid, $redirect, $tableprefix);
        die;
        break;
    default:
}

admin_externalpage_print_header();
print_heading(get_string('competencydepthcustomfields', 'competencies'));

// show custom fields for the given depth
if ($depthid) {

    $competencydepth = get_record_select('competency_depth', "id='$depthid'");
    $sql = "SELECT cf.fullname FROM {$CFG->prefix}competency_depth cd, {$CFG->prefix}competency_framework cf WHERE cf.id = cd.frameworkid and cd.id='$depthid'";
    $competencyframeworkfullname = get_field_sql($sql);
    $competency = get_record_select('competency', "id='$depthid'");
    $categories = get_records_select('competency_depth_info_category', "depthid='$depthid'", 'sortorder ASC');
    $categorycount = count($categories);

    echo "<b>".get_string('framework', 'competencies').":</b> $competencyframeworkfullname<br>";
    echo "<b>".get_string('depthlevel', 'competencies').":</b> $competencydepth->fullname<br>";

    foreach($categories as $category) {

        $table = new object();
        $table->head  = array(get_string('customfield', 'customfields'), get_string('edit'));
        $table->align = array('left', 'right');
        $table->width = '95%';
        $table->class = 'generaltable customfields';
        $table->data = array();

        if ($fields = get_records_select('competency_depth_info_field', "categoryid=$category->id", 'sortorder ASC')) {

            $fieldcount = count($fields);
            print_heading(format_string($category->name).' '.customfield_category_icons($category, $categorycount, $fieldcount, $depthid));

            foreach ($fields as $field) {
                $table->data[] = array($field->fullname, customfield_edit_icons($field, $fieldcount, $depthid));
            }   
        } else {
            print_heading(format_string($category->name).' '.customfield_category_icons($category, $categorycount, 0, $depthid));
        }

        if (count($table->data)) {
            print_table($table);
        } else {
            notify(get_string('nocustomfieldsdefined', 'customfields'));
        }
    }

    // Create a new custom field dropdown menu
    $options = customfield_list_datatypes();
    popup_form('index.php?id=0&amp;action=editfield&amp;depthid='.$depthid.'&amp;datatype=', $options, 'newfieldform','','choose','','',false,'self',get_string('createnewcustomfield', 'customfields'));

    // Create a new category link
    $options = array('action'=>'editcategory', 'depthid'=>$depthid);
    print_single_button('index.php', $options, get_string('createcustomfieldcategory', 'customfields'));

} else {
// show custom fields for all frameworks

    $sql = "SELECT cf.shortname as frameworkshortname, cd.fullname as depthfullname, cdc.name as categoryname, cdf.fullname as depthfieldfullname
            FROM {$CFG->prefix}competency_framework cf
            JOIN {$CFG->prefix}competency_depth cd on cd.frameworkid=cf.id
            LEFT OUTER JOIN {$CFG->prefix}competency_depth_info_category cdc on cdc.depthid=cd.id
            LEFT OUTER JOIN {$CFG->prefix}competency_depth_info_field cdf on cdf.depthid=cd.id AND cdf.categoryid=cdc.id
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
            }
        }

        $table .= "</table>";
        echo $table;

        $groupcontent = '<tr><td>'.$u->frameworkfullname.'</td>';
                
    }
}

admin_externalpage_print_footer();
die;
