<?php // $Id: action.php,v 1.3.4.2 2008/01/15 23:53:28 agrabs Exp $ 
require_once('../../../../config.php');
require_once($CFG->dirroot.'/mod/feedback/lib.php');
require_once($CFG->dirroot.'/mod/feedback/item/picture/lib.php');

//move the picture up or down
$id = required_param('id', PARAM_INT);
$itemid = required_param('itemid', PARAM_INT);
$index = required_param('index', PARAM_INT);
$action = required_param('action', PARAM_ALPHA);

$pictureobj = new feedback_item_picture();

if(!$item = get_record('feedback_item', 'id', $itemid)) {
    $SESSION->feedback->errors[] = get_string('item_update_failed', 'feedback');
    redirect($CFG->wwwroot.htmlspecialchars('/mod/feedback/edit_item.php?id='.$id));
}

$picture_action_error = false;
switch($action) {
    case 'moveup':
        if(!$pictureobj->handler_moveup($item, $index)) {
            $picture_action_error = true;
        }
        break;
    case 'movedown':
        if(!$pictureobj->handler_movedown($item, $index)) {
            $picture_action_error = true;
        }
        break;
    default:
        $picture_action_error = true;
}

if($picture_action_error) {
    $SESSION->feedback->errors[] = get_string('item_update_failed', 'feedback');
}
redirect($CFG->wwwroot.htmlspecialchars('/mod/feedback/edit_item.php?id='.$id));
?>
