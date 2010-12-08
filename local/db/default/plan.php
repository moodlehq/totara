<?php
/**
 * Default database records for local/plan
 *
 * Specifically, create a default priority scale of "High, Medium, Low"
 * and a default objective scale of "Met, not met"
 *
 * @copyright Totara Learning Solutions Limited
 * @author Aaron Wells! <aaronw@catalyst.net.nz>
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage reportbuilder
 */

// Set up a default priority scale
$ps = new stdClass();
$ps->name = 'High-Medium-Low';
$ps->description = 'High priority, medium priority, or low priority.';
$ps->sortorder = 0;
$ps->timemodified = time();
$ps->usermodified = 0;

$psid = insert_record('dp_priority_scale', $ps);

// Add values to that default priority scale
$psv = new stdClass();
$psv->name = 'High';
$psv->priorityscaleid = $psid;
$psv->sortorder = 0;
$psv->timemodified = time();
$psv->usermodified = 0;
insert_record('dp_priority_scale_value', $psv);

$psv = new stdClass();
$psv->name = 'Medium';
$psv->priorityscaleid = $psid;
$psv->sortorder = 1;
$psv->timemodified = time();
$psv->usermodified = 0;
insert_record('dp_priority_scale_value', $psv);

$psv = new stdClass();
$psv->name = 'Low';
$psv->priorityscaleid = $psid;
$psv->sortorder = 2;
$psv->timemodified = time();
$psv->usermodified = 0;
$psvid = insert_record('dp_priority_scale_value', $psv);

// Add the low value as the default to the priority scale
$ps->id = $psid;
$ps->defaultid = $psvid;
update_record('dp_priority_scale', $ps);

// Create a default objective scale
$os = new stdClass();
$os->name = 'Met-NotMet';
$os->timemodified = time();
$os->usermodified = 0;
$os->sortorder = 0;
$osid = insert_record('dp_objective_scale', $os);

// Add scale values
$osv = new stdClass();
$osv->name = 'Met';
$osv->objscaleid = $osid;
$osv->achieved = 1;
$osv->sortorder = 0;
$osv->timemodified = time();
$osv->usermodified = 0;
insert_record('dp_objective_scale_value', $osv);

$osv = new stdCLass();
$osv->name = 'Not met';
$osv->achieved = 0;
$osv->objscaleid = $osid;
$osv->sortorder = 1;
$osv->timemodified = time();
$osv->usermodified = 0;
$osvid = insert_record('dp_objective_scale_value', $osv);

// Add "not met" as the default for the objective scale
$os->id = $osid;
$os->defaultid = $osvid;
update_record('dp_objective_scale', $os);
