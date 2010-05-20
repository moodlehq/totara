<?php
/**
 * competency/lib.php
 *
 * Library of functions related to competency scales.
 *
 * Note: Functions in this library should have names beginning with "competency_scale",
 * in order to avoid name collisions
 *
 * @copyright Catalyst IT Limited
 * @author Aaron Wells
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package MITMS
 */

/**
 * A function to determine whether a scale is in use or not. (In this context,
 * "in use" means that if we change this scale or its values, it'll cause
 * the data in the database to become corrupt)
 *
 * @param <type> $scaleid
 * @return boolean
 */
function competency_scale_is_used( $scaleid ){
    global $CFG;

    return (boolean) count_records('comp_scale_assignments','scaleid',$scaleid);
}

?>
