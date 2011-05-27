<?php

/**
 * This script handles block config actions
 *
 * @package   totara
 * @copyright 2010 Totara Learning Solutions Ltd
 * @author    Eugene Venter <eugene@catalyst.net.nz>
 * @author    Alastair Munro <alastair.munro@totaralms.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');

require_login();
global $USER;

if (!$referer = get_referer(false)) {
    $referer = $CFG->wwwroot.'/';
}

if (!confirm_sesskey() || isguest()) {
    print_error('accessdenied', 'block_quicklinks', $referer);
}

$id = required_param('id', PARAM_ALPHANUM);
$blockinstanceid = required_param('blockinstance', PARAM_INT);
$action = required_param('blockaction', PARAM_ALPHANUM);

// Is this a dashlet or a standard block
$isdashlet = get_record('dashb_instance_dashlet', 'block_instance_id', $blockinstanceid);

if ($isdashlet) {
    $dashletuserid = get_field_sql("SELECT dbi.userid FROM {$CFG->prefix}dashb_instance_dashlet dbid JOIN {$CFG->prefix}dashb_instance dbi ON dbi.id=dbid.dashb_instance_id WHERE dbid.block_instance_id={$blockinstanceid}");
    if ($dashletuserid === false) {
        error('fail');
    }

    if ($dashletuserid != $USER->id) {
        require_capability('local/dashboard:admin', get_context_instance(CONTEXT_SYSTEM));
        $userid = 0;
    } else {
       $userid = $USER->id;
    }
} else {
    // If this is being used as a standard block not on a dashboard
    $userid = $USER->id;
}

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
        if (!delete_records('block_quicklinks', 'id', $id)) {
            print_error('error:deletequicklink', 'block_quicklinks');
        }
        $links = get_records_select('block_quicklinks', "block_instance_id={$blockinstanceid}", 'displaypos');
        $links = array_keys($links);
        block_quicklinks_reorder_links($links);
        break;
    case 'movelinkup' :
        block_quicklinks_move_vertical($id, 'up');
        break;
    case 'movelinkdown' :
        block_quicklinks_move_vertical($id, 'down');
        break;
    default:
        break;
}

redirect($referer);


/** HELPER FUNCTIONS **/
function block_quicklinks_move_vertical($id, $direction) {
    if (!$link = get_record('block_quicklinks', 'id', $id)) {
        return;
    }

    $links = get_records('block_quicklinks', 'block_instance_id', $link->block_instance_id, 'displaypos');
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
