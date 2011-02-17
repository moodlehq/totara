<?php

/**
 * Display tabs on report settings pages
 *
 * Included in each settings page
 *
 * @copyright Catalyst IT Limited
 * @author Simon Coggins
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage reportbuilder
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

// assumes the report id variable has been set in the page
if (!isset($currenttab)) {
    $currenttab = 'general';
}

$tabs = array();
$row = array();
$activated = array();
$inactive = array();

$row[] = new tabobject('general',$CFG->wwwroot.'/local/reportbuilder/general.php?id='.$id, get_string('general'));
$row[] = new tabobject('columns',$CFG->wwwroot.'/local/reportbuilder/columns.php?id='.$id, get_string('columns','local_reportbuilder'));
$row[] = new tabobject('filters',$CFG->wwwroot.'/local/reportbuilder/filters.php?id='.$id, get_string('filters','local_reportbuilder'));
$row[] = new tabobject('content',$CFG->wwwroot.'/local/reportbuilder/content.php?id='.$id, get_string('content','local_reportbuilder'));
// hide access tab for embedded reports
if(!$report->embeddedurl) {
    $row[] = new tabobject('access',$CFG->wwwroot.'/local/reportbuilder/access.php?id='.$id, get_string('access','local_reportbuilder'));
}

$tabs[] = $row;
$activated[] = $currenttab;

// print out tabs
print_tabs($tabs, $currenttab, $inactive, $activated);
