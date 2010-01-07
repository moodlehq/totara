<?php

require_once('../../config.php');
require_once('lib.php');
require_once('HTML/AJAX/JSON.php');

json_headers();

$sessionkey = required_param('sessionkey', PARAM_RAW); // Session key
$action = required_param('action', PARAM_ALPHA); // Action code

$revid = optional_param('revisionid', 0, PARAM_INT); // Revision ID
$objectiveid = optional_param('objectiveid', 0, PARAM_INT); // Learning Objective ID
$curriculum = optional_param('curriculum', '', PARAM_ALPHA); // Curriculum code
$editable = optional_param('editable', 0, PARAM_INT); // Show/hide edit components
$listtype = optional_param('listtype', '', PARAM_INT); // Which list the items belong to
$itemtext = optional_param('itemtext', '', PARAM_NOTAGS); // List item contents
$itemid = optional_param('itemid', '', PARAM_INT); // ID of the item to delete

$error = 0;
$errormsg = '';

if (!confirm_sesskey($sessionkey)) {
    $error = 7;
    $errormsg = 'Bad session key';
}
elseif (0 == $revid) {
    $error = 1;
    $errormsg = 'Revisionid cannot be 0.';
}

$data = '';
if (0 == $error) {
    if ('addobj' == $action or 'deleteobj' == $action) {
        if (0 == $objectiveid) {
            $error = 2;
            $errormsg = 'Objectiveid cannot be 0.';
        } else {
            if (objective_ajax_action($objectiveid, $revid, $action)) {
                $revision = get_revision(0, $revid, false);
                $data = curriculum_objectives($curriculum, $revision, $editable);
            }
            else {
                $error = 4;
                $errormsg = "Could not perform $action with objective=$objectiveid and revision=$revid.";
            }
        }
    }
    elseif ('additem' == $action) {
        if (add_list_item($revid, $listtype, $itemtext)) {
            $data = get_list_items($revid, $listtype, 1);
        }
        else {
            $error = 5;
            $errormsg = "Could not add item to list $listtype of revision $revid.";
        }
    }
    elseif ('saveitem' == $action) {
        if (update_list_item($revid, $listtype, $itemid, $itemtext)) {
            $data = get_list_items($revid, $listtype, 1);
        }
        else {
            $error = 12;
            $errormsg = "Could not update item $itemid in list type $listtype of revision $revid.";
        }
    }
    elseif ('deleteitem' == $action) {
        if (delete_list_item($revid, $itemid)) {
            $data = get_list_items($revid, $listtype, 1);
        }
        else {
            $error = 6;
            $errormsg = "Could not add item to list $listtype of revision $revid.";
        }
    }
    elseif ('updatemtime' == $action) {
        $data = get_modification_time($revid);
    }
    elseif ('addtofav' == $action or 'delfromfav' == $action) {
        $userid = get_field_sql("SELECT p.userid
                                   FROM {$CFG->prefix}idp_revision r,
                                        {$CFG->prefix}idp p
                                  WHERE r.idp = p.id AND r.id = $revid");

        if ($userid) {
            if ('addtofav' == $action) {
                if (!add_to_favourites($userid, $objectiveid)) {
                    $error = 9;
                    $errormsg = "Could not add objective $objectiveid as a favourite.";
                }
            }
            elseif ('delfromfav' == $action) {
                if (!delete_from_favourites($userid, $objectiveid)) {
                    $error = 10;
                    $errormsg = "Could not remove objective $objectiveid from the favourites.";
                }
            }

            // Return the new list of favourites
            if (0 == $error) {
                $favourites = get_favourites($userid, $curriculum);
                $data = format_favourites($favourites, $revid, $curriculum);
            }
        }
        else {
            $error = 8;
            $errormsg = "Could not find userid associated with revision $revid";
        }
    }
    elseif('addcomment' == $action) {
        if (add_comment($revid, $itemtext)) {
            $revision = get_revision(0, $revid);
            $data = revision_comments($revision, true);
        }
        else {
            $error = 11;
            $errormsg = 'Could not add comment';
        }
    }
}

$json = new HTML_AJAX_JSON();

$value = array('error' => $error, 'errormsg' => "$errormsg",
               'rev' => $revid, 'objectiveid'=> $objectiveid,
               'data' => $data, 'action' => $action,
               'time' => userdate(time()));

$output = $json->encode($value);
print($output);

?>
