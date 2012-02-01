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
 * @package totara
 */

/**
 * Retrieve an array of all the competencies related to the present one
 *
 * @global object $CFG
 * @param int $compid
 * @return array
 */
function comp_relation_get_relations( $compid ){
    global $CFG;

    $returnrecs = array();
    $reclist = get_records_sql("select id, id1, id2 from {$CFG->prefix}comp_relations where id1=$compid or id2=$compid");
    if ( is_array($reclist) ){

        foreach( $reclist as $rec ){
            if ($rec->id1 != $compid){
                $returnrecs[$rec->id1] = $rec->id1;
            } else if ( $rec->id2 != $compid){
                $returnrecs[$rec->id2] = $rec->id2;
            }
        }
    }
    return $returnrecs;
}

?>
