<?php
/**
 * competency/evidenceitem/lib.php
 *
 * Library of functions related to competency evidence items
 *
 * Note: Functions in this library should have names beginning with "comp_evitem_",
 * in order to avoid name collisions
 *
 * @copyright Catalyst IT Limited
 * @author Aaron Wells
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package MITMS
 */

/**
 * Return a lookup array of the existing evidence items for a competency, for
 * determining whether the competency already has this evidence item assigned
 * to it.
 *
 * The unique combination key for evidence items is (competencyid, itemtype, iteminstance).
 * The format of the returned array is that for each evidence item assigned to
 * the competency, there's one entry in the array, with its key and its value
 * equal to the evidence item's itemtype, a hyphen, and its iteminstance.
 *
 * @param int $competency_id
 * @return array
 */
function comp_evitem_get_lookup($competency_id){
    // Get a list of all the existing evidence items, to grey out the duplicates
    // below. For ease of checking, we'll just pull the itemtype and iteminstance
    // concatenated together with hyphens.
    $existingevidencerecs = get_records('comp_evidence_items', 'competencyid', $competency_id);
    if ( !$existingevidencerecs ){
        return array();
    }
    
    $existingevidencelookup = array();
    foreach( $existingevidencerecs as $rec ){
        // itemtype-iteminstance => itemtype-iteminstance
        $existingevidencelookup["{$rec->itemtype}-{$rec->iteminstance}"] = "{$rec->itemtype}-{$rec->iteminstance}";
    }
    return $existingevidencelookup;
}

/**
 * Print the list of evidence items for a given course, with links to assign them to
 * a specific competency via hierarchy/type/competency/evidenceitem/add.php
 *
 * @global object $CFG
 * @param object $course A record from the 'course' table
 * @param int $competency_id
 * @param string $addurl The URL to make the links go to (should be okay to append additional URL parameters with an ampersand on the end)
 */
function comp_evitem_print_course_evitems($course, $competency_id, $addurl ){
    global $CFG;

    $alreadystr = get_string('alreadyselected','local');
    $existingevidencelookup = comp_evitem_get_lookup($competency_id);

    // Evidence type available
    $available = false;

    echo '<ul>';

    // Activity completion
    $completion_info = new completion_info($course);
    if ($completion_info->is_enabled()) {
        $evidence = $completion_info->get_activities();

        if ($evidence) {
            $available = true;
            foreach ($evidence as $activity) {
                if ( array_key_exists("activitycompletion-{$activity->id}", $existingevidencelookup) ){
                    echo "<li><span class=\"unclickable\">Activity completion - {$activity-> name} {$alreadystr} </span></li>";
                } else {
                    echo '<li><a href="'.$addurl.'&type=activitycompletion&instance='.$activity->id.'">';
                    echo 'Activity completion - '.$activity->name;
                    echo '</a></li>';
                }
            }
        }
    }

    // Course completion
    if ($completion_info->is_enabled() &&
        $completion_info->has_criteria()) {

        $available = true;
        if ( array_key_exists("coursecompletion-{$course->id}", $existingevidencelookup ) ){
            echo "<li><span class=\"unclickable\">Course completion {$alreadystr}</span></li>";
        } else {
            echo '<li><a href="'.$addurl.'&type=coursecompletion&instance='.$course->id.'">Course completion</a></li>';
        }
    }

    // Course grade
    $course_grade = get_record_select('grade_items', 'itemtype = \'course\' AND courseid = '.$course->id);

    if ($course_grade) {
        $available = true;
        if ( array_key_exists("coursegrade-{$course->id}", $existingevidencelookup ) ){
            echo "<li><span class=\"unclickable\">Course grade {$alreadystr}</span></li>";
        } else {
            echo '<li><a href="'.$addurl.'&type=coursegrade&instance='.$course->id.'">Course grade</a></li>';
        }
    }

    if (!$available) {
        echo '<li><em>'.get_string('noevidencetypesavailable', 'competency').'</em></li>';
    }

    echo '</ul>';
}
?>
