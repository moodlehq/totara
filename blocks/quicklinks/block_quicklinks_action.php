<?php

/**
 * This script handles block config actions
 *
 * @package   totara
 * @copyright 2010 Totara Learning Solutions Ltd
 * @author    Eugene Venter <aaronb@catalyst.net.nz>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');

require_login();
global $USER;

if (!$referer = get_referer(false)) {
    $referrer = $CFG->wwwroot.'/';
}

if (!confirm_sesskey() || isguest()) {
    print_error('accessdenied', 'block_quicklinks', $referer);
}

$id = required_param('id', PARAM_ALPHANUM);
$blockinstanceid = required_param('blockinstance', PARAM_INT);
$action = required_param('blockaction', PARAM_ALPHANUM);

$isdashlet = get_record('dashb_instance_dashlet', 'block_instance_id', $blockinstanceid);
$userid = $isdashlet ? $USER->id : 0;
if (!$blockinstance = get_record('block_instance', 'id', $blockinstanceid)) {
    print_error('accessdenied', 'block_quicklinks');
}

$blockcontext = get_context_instance(CONTEXT_BLOCK, $blockinstanceid);
if ($userid == 0) {
    // This is not a dashlet
    require_capability('block/quicklinks:managealllinks', $blockcontext);
} else {
    require_capability('block/quicklinks:manageownlinks', $blockcontext);
}

switch ($action) {
    case 'deletelink' :
        delete_records('block_quicklinks', 'id', $id, 'userid', $userid);
        $links = get_records_select('block_quicklinks', "userid={$userid} AND block_instance_id={$blockinstanceid}", 'displaypos');
        $links = array_keys($links);
        block_quicklinks_reorder_links($links);
        break;
    case 'movelinkup' :
        block_quicklinks_move_vertical($id, 'up', $userid);
        break;
    case 'movelinkdown' :
        block_quicklinks_move_vertical($id, 'down', $userid);
        break;
    default:
        break;
}

redirect($referer);


/** HELPER FUNCTIONS **/
function block_quicklinks_move_vertical($id, $direction, $userid) {
    if (!$link = get_record('block_quicklinks', 'id', $id, 'userid', $userid)) {
        return;
    }

    $links = get_records_select('block_quicklinks', "userid={$userid} AND block_instance_id={$link->block_instance_id}", 'displaypos');
    $links = array_keys($links);
    $itemkey = array_search($link->id, $links);

    switch ($direction) {
        case 'up':
            if (isset($links[$itemkey-1])) {
                $olditem = $links[$itemkey-1];
                $links[$itemkey-1] = $links[$itemkey];
                $links[$itemkey] = $olditem;
            }
            break;
        case 'down':
            if (isset($links[$itemkey+1])) {
                $olditem = $links[$itemkey+1];
                $links[$itemkey+1] = $links[$itemkey];
                $links[$itemkey] = $olditem;
            }
            break;
        default:
            break;
    }

    block_quicklinks_reorder_links($links);
}

function block_quicklinks_reorder_links($links) {
    foreach ($links as $key=>$l) {
        if (!set_field('block_quicklinks', 'displaypos', $key, 'id', $l)) {
            print_error('linkreorderfail');
        }
    }
}

?>
