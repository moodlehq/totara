<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Strings for component 'question', language 'en_us', branch 'MOODLE_22_STABLE'
 *
 * @package   question
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['behaviour'] = 'Behavior';
$string['behaviourbeingused'] = 'behavior being used: {$a}';
$string['cannotdeletebehaviourinuse'] = 'You cannot delete the behavior \'{$a}\'. It is used by question attempts.';
$string['cannotdeletemissingbehaviour'] = 'You cannot uninstall the missing behavior. It is required by the system.';
$string['cannotdeleteneededbehaviour'] = 'Cannot delete the question behavior \'{$a}\'. There are other behaviors installed that rely on it.';
$string['cannotenablebehaviour'] = 'Question behavior {$a} cannot be used directly. It is for internal use only.';
$string['deletebehaviourareyousure'] = 'Delete behavior {$a}: are you sure?';
$string['deletebehaviourareyousuremessage'] = 'You are about to completely delete the question behavior {$a}. This will completely delete everything in the database associated with this question behavior. Are you SURE you want to continue?';
$string['deletingbehaviour'] = 'Deleting question behavior \'{$a}\'';
$string['penaltyforeachincorrecttry_help'] = 'When you run your questions using the \'Interactive with multiple tries\' or \'Adaptive mode\' behavior, so that the the student will have several tries to get the question right, then this option controls how much they are penalized for each incorrect try.
The penalty is a proportion of the total question grade, so if the question is worth three marks, and the penalty is 0.3333333, then the student will score 3 if they get the question right first time, 2 if they get it right second try, and 1 of they get it right on the third try.';
$string['qbehaviourdeletefiles'] = 'All data associated with the question behavior \'{$a->behaviour}\' has been deleted from the database. To complete the deletion (and to prevent the behavior from re-installing itself), you should now delete this directory from your server: {$a->directory}';
$string['questionbehaviouradminsetting'] = 'Question behavior settings';
$string['questionbehavioursdisabled'] = 'Question behaviors to disable';
$string['questionbehavioursdisabledexplained'] = 'Enter a comma separated list of behaviors you do not want to appear in drop-down menu';
$string['questionbehavioursorder'] = 'Question behaviors order';
$string['questionbehavioursorderexplained'] = 'Enter a comma separated list of behaviors in the order you want them to appear in drop-down menu';
$string['uninstallbehaviour'] = 'Uninstall this question behavior.';
$string['unknownbehaviour'] = 'Unknown behavior: {$a}.';
