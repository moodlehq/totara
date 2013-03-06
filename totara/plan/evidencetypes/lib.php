<?php
/**
 * Determine whether a evidence type is in use or not.
 *
 * "in use" means that items are assigned any of the evidence type's values.
 *
 * @param int $evidencetypeid The evidence type to check
 * @return boolean
 */
function dp_evidence_type_is_used($evidencetypeid) {
    global $DB;

    return $DB->record_exists('dp_plan_evidence', array('evidencetypeid' => $evidencetypeid));
}
