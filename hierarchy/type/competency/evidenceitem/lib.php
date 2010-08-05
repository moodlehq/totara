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
 * @package Totara
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
    $addbutton = '<img src="'.$CFG->pixpath.'/t/add.gif" class="addbutton" width="15px" height="15px" />';

    // Evidence type available
    $available = false;

    // Activity completion
    $completion_info = new completion_info($course);
    if ($completion_info->is_enabled()) {
        $evidence = $completion_info->get_activities();

        if ($evidence) {
            $available = true;
            foreach ($evidence as $activity) {
                if ( array_key_exists("activitycompletion-{$activity->id}", $existingevidencelookup) ){
                    echo "<span class=\"unclickable\">Activity completion - {$activity-> name} {$alreadystr} </span>";
                } else {
                    echo '<span type="activitycompletion" id="'.$activity->id.'">';

                    echo '<table><tr>';
                    echo '<td class="list-item-name">Activity completion - '.format_string($activity->name).'</td>';
                    echo '<td class="list-item-action">'.$addbutton.'</td>';
                    echo '</tr></table>';

                    echo '</span>';

                }
            }
        }
    }

    // Course completion
    if ($completion_info->is_enabled() &&
        $completion_info->has_criteria()) {

        $available = true;
        if ( array_key_exists("coursecompletion-{$course->id}", $existingevidencelookup ) ){
            echo "<span class=\"unclickable\">Course completion {$alreadystr}</span>";
        } else {
            echo '<span type="coursecompletion" id="'.$course->id.'">';

            echo '<table><tr>';
            echo '<td class="list-item-name">Course completion</td>';
            echo '<td class="list-item-action">'.$addbutton.'</td>';
            echo '</tr></table>';

            echo '</span>';
        }
    }

    // Course grade
    $course_grade = get_record_select('grade_items', 'itemtype = \'course\' AND courseid = '.$course->id);

    if ($course_grade) {
        $available = true;
        if ( array_key_exists("coursegrade-{$course->id}", $existingevidencelookup ) ){
            echo "<span class=\"unclickable\">Course grade {$alreadystr}</span>";
        } else {
            echo '<span type="coursegrade" id="'.$course->id.'">';

            echo '<table><tr>';
            echo '<td class="list-item-name">Course grade</td>';
            echo '<td class="list-item-action">'.$addbutton.'</td>';
            echo '</tr></table>';

            echo '</span>';
        }
    }

    // Keep a hidden competency id val for use by javascripts
    echo '<input type="hidden" id="evitem_competency_id" value="'.$competency_id.'" />';

    if (!$available) {
        echo '<em>'.get_string('noevidencetypesavailable', 'competency').'</em>';
    }
}
?>
