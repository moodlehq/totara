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

require_once(dirname(dirname(__FILE__)) . '/config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/cohort/lib.php');

$id        = required_param('id', PARAM_INT);
$delete    = optional_param('delete', 0, PARAM_BOOL);
$confirm   = optional_param('confirm', 0, PARAM_BOOL);

admin_externalpage_setup('cohorts');


$context = context_system::instance();
require_capability('moodle/cohort:manage', $context);

$cohort = $DB->get_record('cohort',array('id' => $id));
if (!$cohort) {
    print_error('error:doesnotexist', 'cohort');
}

$membercount = $DB->count_records('cohort_members', array('cohortid' => $cohort->id));

$returnurl = new moodle_url('/cohort/index.php');

if ($delete && $cohort->id) {
    if ($confirm and confirm_sesskey()) {
        $result = cohort_delete_cohort($cohort);
        totara_set_notification(get_string('successfullydeleted', 'totara_cohort'), $returnurl->out(), array('class' => 'notifysuccess'));
    }

    $yesurl = new moodle_url('/cohort/view.php', array('id'=>$cohort->id, 'delete'=>1, 'confirm'=>1,'sesskey'=>sesskey()));
    $nourl = new moodle_url('/cohort/view.php', array('id'=>$cohort->id));

    $strheading = get_string('delcohort', 'totara_cohort');

    echo $OUTPUT->header();

    $buttoncontinue = new single_button($yesurl->out(), get_string('yes'), 'post');
    $buttoncancel   = new single_button($nourl->out(), get_string('no'), 'post');
    echo $OUTPUT->confirm(get_string('delconfirm', 'totara_cohort', format_string($cohort->name)), $buttoncontinue, $buttoncancel);

    echo $OUTPUT->footer();
    die();
}



$strheading = get_string('editcohort', 'totara_cohort');


echo $OUTPUT->header();


echo $OUTPUT->heading(format_string($cohort->name));

$currenttab = 'view';
require_once('tabs.php');


$out = '';
$out .= html_writer::start_tag('div', array('class' => 'mform'));
$out .= html_writer::start_tag('fieldset');

$item = html_writer::tag('div', get_string('type', 'totara_cohort'), array('class' => 'fitemtitle'));
$item .= html_writer::tag('div', ($cohort->cohorttype == cohort::TYPE_DYNAMIC) ? get_string('dynamic', 'totara_cohort') : get_string('set', 'totara_cohort'), array('class' => 'felement ftext'));
$out .= $OUTPUT->container($item, 'fitem required alternate');

$item = html_writer::tag('div', get_string('idnumber', 'totara_cohort'), array('class' => 'fitemtitle'));
$item .= html_writer::tag('div', $cohort->idnumber, array('class' => 'felement ftext'));
$out .= $OUTPUT->container($item, 'fitem required ');

$item = html_writer::tag('div', get_string('description', 'totara_cohort'), array('class' => 'fitemtitle'));
$item .= html_writer::tag('div', $cohort->description, array('class' => 'felement ftext'));
$out .= $OUTPUT->container($item, 'fitem required alternate');

$item = html_writer::tag('div', get_string('members', 'totara_cohort'), array('class' => 'fitemtitle'));
$item .= html_writer::tag('div', $membercount, array('class' => 'felement ftext'));
$out .= $OUTPUT->container($item, 'fitem required');

$out .= html_writer::end_tag('fieldset') . html_writer::end_tag('div');

if ($cohort->cohorttype == cohort::TYPE_DYNAMIC) {
    // Get the criteria
    $criteria =$DB->get_record('cohort_criteria',array('cohortid' => $cohort->id));
    $out .= $OUTPUT->heading(get_string('dynamiccohortcriterialower', 'totara_cohort'));

    $out .= html_writer::start_tag('div', array('class' => 'mform'));
    $out .= html_writer::start_tag('fieldset');

    $item = html_writer::tag('div', get_string('userprofilefield', 'totara_cohort'), array('class' => 'fitemtitle'));
    $element = '';
    if (!empty($criteria)) {
        if (substr($criteria->profilefield, 0, 11) == 'customfield') {
            $fieldname = $DB->get_field('user_info_field', 'name', array('id' => substr($criteria->profilefield, 11)));
            if ($fieldname != false) {
                $element .= $fieldname;
            }
        } else {
            $element .= $criteria->profilefield;
        }
        $element .= html_writer::empty_tag('br');
        $element .= get_string('profilefieldvalues', 'totara_cohort') . ': ' . $criteria->profilefieldvalues;
    }
    $item .= html_writer::tag('div', $element, array('class' => 'felement ftext'));
    $out .= $OUTPUT->container($item, 'fitem required alternate');

    $item = html_writer::tag('div', get_string('position', 'totara_cohort'), array('class' => 'fitemtitle'));
    $element = '';
    if (!empty($criteria)) {
        $positionname =  $DB->get_field('pos', 'fullname', array('id' => $criteria->positionid));
        if ($positionname != false) {
            $element .= $positionname;
            if ($criteria->positionincludechildren) {
                $element .= ' - ' . get_string('childrenincluded', 'totara_cohort');
            }
        }
    }
    $item .= html_writer::tag('div', $element, array('class' => 'felement ftext'));
    $out .= $OUTPUT->container($item, 'fitem required');

    $item = html_writer::tag('div', get_string('organisation', 'totara_cohort'), array('class' => 'fitemtitle'));
    $element = '';
    if (!empty($criteria)) {
        $organisationname =  $DB->get_field('org', 'fullname', array('id' => $criteria->organisationid));
        if ($organisationname != false) {
            $element .= $organisationname;
            if ($criteria->orgincludechildren) {
                $element .= ' - ' . get_string('childrenincluded', 'totara_cohort');
            }
        }
    }
    $item .= html_writer::tag('div', $element, array('class' => 'felement ftext'));
    $out .= $OUTPUT->container($item, 'fitem required alternate');

    $out .= html_writer::end_tag('fieldset') . html_writer::end_tag('div');

} //end if cohort type is dynamic

$out .= html_writer::start_tag('div', array('class' => 'mform'));
$out .= html_writer::start_tag('fieldset');
$item = html_writer::tag('div', '&nbsp;', array('class' => 'fitemtitle'));
$form = html_writer::start_tag('form');
$form .= html_writer::empty_tag('input', array('type' => 'hidden', 'name' => 'delete', 'value' => '1'));
$form .= html_writer::empty_tag('input', array('type' => 'hidden', 'name' => 'id', 'value' => $cohort->id));
$form .= html_writer::empty_tag('input', array('type' => 'submit', 'value' => get_string('deletethiscohort', 'totara_cohort')));
$form .= html_writer::end_tag('form');
$item .= html_writer::tag('div', $membercount, array('class' => 'felement ftext'));
$out .= $OUTPUT->container($item, 'fitem required');
$out .= html_writer::end_tag('fieldset') . html_writer::end_tag('div');

echo $out;

echo $OUTPUT->footer();
