<?php

/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Jake Salmon <jake.salmon@kineo.com>
 * @package totara
 * @subpackage cohort
 */

require_once('../config.php');
require_once('lib.php');

// Get the passed in parameters..
$cohortname = required_param('cohortname',PARAM_TEXT);

$profilefield = optional_param('profilefield','',PARAM_ALPHANUM);
$profilefieldvalues = optional_param('profilefieldvalues','',PARAM_CLEAN);
if (empty($profilefieldvalues))
    $profilefield = '';

$positionid = optional_param('positionid',0,PARAM_INT);
$positionincludechildren = optional_param('positionincludechildren',false,PARAM_BOOL);

$organisationid = optional_param('organisationid',0,PARAM_INT);
$orgincludechildren = optional_param('orgincludechildren',false,PARAM_BOOL);

if (empty($profilefield) && empty($positionid) && empty($organisationid)) {
    echo '<div style="text-align:center;"><p>'. get_string('mustselectonecriteria','local_cohort') .'</p></div>';
    die();
}

$dynamic_cohort_users = new dynamic_cohort_users(
    $profilefield,
    $profilefieldvalues,
    $positionid,
    $positionincludechildren,
    $organisationid,
    $orgincludechildren
);
$num_users = $dynamic_cohort_users->get_count();
?>

<div style="text-align:center;">
    <p>
    <?php echo get_string('abouttocreate','local_cohort', $cohortname); ?>
    </p>
    <p>
    <?php echo get_string('thiscohortwillhave','local_cohort', $num_users); ?>
    </p>
    <p>
    <?php echo get_string('cannoteditcohort','local_cohort'); ?>
    </p>
</div>

