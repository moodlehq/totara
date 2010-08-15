<?php // $Id$
/**
 * Library for functions related to activity groups
 *
 * @copyright Catalyst IT Limited
 * @author Simon Coggins
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage reportbuilder
 */


/**
 * Given a tag-based group, update the group assignments so it contains the
 * correct activities
 *
 * @param integer $groupid ID of the group to update
 *
 * @return boolean True if update succeeded
 */
function update_tag_grouping($groupid) {
    global $CFG;

    // get this group's tag and make sure it's a valid one
    $tagid = get_field('report_builder_group', 'assignvalue', 'assigntype',
        'tag', 'id', $groupid);
    if(!$tagid) {
        // need a tag
        return false;
    }

    $tag = get_record('tag', 'id', $tagid, 'tagtype', 'official');
    if(!$tag) {
        // no such official tag exists
        return false;
    }

    $sql = "SELECT f.id FROM {$CFG->prefix}feedback f
        INNER JOIN {$CFG->prefix}tag_instance i
        ON i.itemtype = 'feedback' AND i.itemid = f.id AND i.tagid = $tagid";

    $tagged_activities = get_records_sql($sql);
    if(!$tagged_activities) {
        $tagged_activities = array();
    }

    // get list of currently assigned activities
    $assigned_activities = get_records('report_builder_group_assign',
        'groupid', $groupid);
    if(!$assigned_activities) {
        $assigned_activities = array();
    }

    begin_sql();
    $status = true;

    // add items that are tagged that don't appear in assigned list
    foreach($tagged_activities as $tagged) {
        $track = false;
        foreach($assigned_activities as $assigned) {
            if($assigned->itemid == $tagged->id) {
                $track = true;
            }
        }
        if(!$track) {
            $todb = new object();
            $todb->groupid = $groupid;
            $todb->itemid = $tagged->id;
            $status = $status && insert_record('report_builder_group_assign',
                $todb);
        }
    }

    // get rid of any items that are no longer tagged with this tag
    foreach($assigned_activities as $assigned) {
        if(!array_key_exists($assigned->itemid, $tagged_activities)) {
            $badid = $assigned->id;
            $status = $status && delete_records('report_builder_group_assign',
                'id', $badid);
        }
    }

    // commit if it all worked
    if($status) {
        commit_sql();
        return true;
    } else {
        rollback_sql();
        return false;
    }
}

