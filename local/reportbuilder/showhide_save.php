<?php

/**
 * Set a SESSION var to store the visibility of a report builder column
 *
 * Called via AJAX from local/reportbuilder/showhide.php
 *
 * @copyright Catalyst IT Limited
 * @author Simon Coggins
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage reportbuilder
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');

$shortname = required_param('shortname', PARAM_TEXT);
$column = required_param('column', PARAM_TEXT);
$value = required_param('value', PARAM_TEXT);

// get current settings
$cols = isset($SESSION->rb_showhide_columns) ?
    $SESSION->rb_showhide_columns : array();

// update value
if(!isset($cols[$shortname])) {
    $cols[$shortname] = array();
}
$cols[$shortname][$column] = $value;

// store back to session
$SESSION->rb_showhide_columns = $cols;


