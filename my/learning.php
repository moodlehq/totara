<?php

require_once('../config.php');
require_once($CFG->dirroot.'/local/dashboard/lib.php');

require_login();

$dashaction = optional_param('dashaction', null, PARAM_ALPHANUM);
$dletid = optional_param('dlet', 0, PARAM_INT);
$col = optional_param('col', 1, PARAM_INT);
$edit=optional_param('edit', -1, PARAM_BOOL);

// Check user capabilities
$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('local/dashboard:view', $sitecontext, $USER->id);
$canedit = (has_capability('local/dashboard:edit', $sitecontext, $USER->id));
//TODO: maybe add some dashboard-specific caps here

$dashb = new Dashboard('mylearning', $USER->id, 'user');
$isdefaultinstance = empty($dashb->instance->userid);

$PAGE = page_create_object('totara-dashboard', $dashb->instance->id);
$pageblocks = blocks_setup($PAGE,BLOCKS_PINNED_FALSE);

$blocks_preferred_width = bounded_number(180, blocks_preferred_width($pageblocks[BLOCK_POS_LEFT]), 210);

if (!empty($dashaction) && !empty($dletid) && confirm_sesskey() && !$dashb->is_using_default_instance() && $canedit) {
    $redirect = strip_querystring(me());

    switch ($dashaction) {
        case 'toggle' :
            $dashb->dashlet_toggle_visibility($dletid);
            break;
        case 'delete' :
            $dashb->dashlet_delete($dletid);
            break;
        case 'moveup' :
            $dashb->dashlet_move_vertical($dletid, 'up');
            break;
        case 'movedown' :
            $dashb->dashlet_move_vertical($dletid, 'down');
            break;
        case 'moveleft' :
            $dashb->dashlet_move_horizontal($dletid, 'left');
            break;
        case 'moveright' :
            $dashb->dashlet_move_horizontal($dletid, 'right');
            break;
        case 'config' :
            //TODO: redirect to dashlet config page
            break;
        case 'add' :
            if ($block_instance_id = $dashb->add_block_instance($dletid)) {
                $dashb->dashlet_add($block_instance_id, $col);
            }
            // TODO: go to dlet config page if necessary??
            break;
        default:
            break;
    }

    redirect($redirect);
}

$strheading = $dashb->data->title;

$pagetitle = format_string($strheading);
$navlinks[] = array('name' => $strheading . ' ' . get_string('dashboard', 'local_dashboard'), 'link' => null, 'type' => 'misc');
$navigation = build_navigation($navlinks);
$navbaritem = !empty($canedit) ? $dashb->get_editing_button($edit) : '';

print_header_simple($pagetitle, '', $navigation, '', null, true, $navbaritem);

echo '<table id="layout-table">';
echo '<tr valign="top">';
echo '<td valign="top" id="middle-column">';
echo '<h1>'.$strheading.'</h1>';

$format = $PAGE->user_is_editing() ? 'useredit' : 'user';
$dashb->set_type($format);
echo $dashb->output();

echo '</td>';
echo '</tr></table>';

print_footer();

?>
