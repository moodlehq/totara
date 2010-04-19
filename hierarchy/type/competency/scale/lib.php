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
 * A function to determine whether a scale is in use or not
 *
 * @param <type> $scaleid
 * @return boolean
 */
function competency_scale_is_used( $scaleid ){
    global $CFG;

    return (boolean) count_records_sql("
        select count(*) 
        from 
            {$CFG->prefix}comp_scale_assignments sa, 
            {$CFG->prefix}comp c 
        where 
            sa.scaleid={$scaleid}
            and sa.frameworkid=c.id"
    );
}

?>
