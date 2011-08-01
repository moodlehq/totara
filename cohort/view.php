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
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/cohort/lib.php');

$id        = required_param('id', PARAM_INT);
$delete    = optional_param('delete', 0, PARAM_BOOL);
$confirm   = optional_param('confirm', 0, PARAM_BOOL);

admin_externalpage_setup('cohorts');


$context = get_context_instance(CONTEXT_SYSTEM);
require_capability('local/cohort:manage', $context);

$cohort = get_record('cohort','id',$id);
if (!$cohort) {
    error('Cohort with this id does not exist');
}

$membercount = count_records('cohort_members', 'cohortid', $cohort->id);

$returnurl = new moodle_url($CFG->wwwroot .'/cohort/index.php');

if ($delete && $cohort->id) {
    if ($confirm and confirm_sesskey()) {
        $result = cohort_delete_cohort($cohort);
        if ($result) {
            totara_set_notification(get_string('successfullydeleted','local_cohort'), $returnurl->out(), array('style'=>'notifysuccess'));
        }
        else {
            totara_set_notification(get_string('failedtodeleted','local_cohort'), $returnurl->out());
        }
    }

    $yesurl = new moodle_url($CFG->wwwroot .'/cohort/view.php', array('id'=>$cohort->id, 'delete'=>1, 'confirm'=>1,'sesskey'=>sesskey()));
    $nourl = new moodle_url($CFG->wwwroot .'/cohort/view.php', array('id'=>$cohort->id));

    $strheading = get_string('delcohort', 'local_cohort');

    admin_externalpage_print_header();

    notice_yesno(get_string('delconfirm', 'local_cohort', format_string($cohort->name)),
                         $yesurl->out(),
                         $nourl->out());
    admin_externalpage_print_footer();
    die();
}



$strheading = get_string('editcohort', 'local_cohort');


admin_externalpage_print_header();

print_heading(format_string($cohort->name));

$currenttab = 'view';
require_once('tabs.php');
?>

<div class="mform">
    <fieldset>
    <div class="fitem required alternate">
        <div class="fitemtitle">
            <?php echo get_string('type','local_cohort'); ?>
        </div>
        <div class="felement ftext">
            <?php echo $cohort->cohorttype == cohort::TYPE_DYNAMIC ? get_string('dynamic','local_cohort') : get_string('set','local_cohort'); ?>
        </div>
    </div>

    <div class="fitem required">
        <div class="fitemtitle">
            <?php echo get_string('idnumber','local_cohort'); ?>
        </div>
        <div class="felement ftext">
            <?php echo $cohort->idnumber; ?>
        </div>
    </div>

    <div class="fitem required alternate">
        <div class="fitemtitle">
            <?php echo get_string('description','local_cohort'); ?>
        </div>
        <div class="felement ftext">
            <?php echo $cohort->description; ?>
        </div>
    </div>

    <div class="fitem required">
        <div class="fitemtitle">
            <?php echo get_string('members','local_cohort'); ?>
        </div>
        <div class="felement ftext">
            <?php echo $membercount; ?>
        </div>
    </div>
    </fieldset>
</div>

<?php
if ($cohort->cohorttype == cohort::TYPE_DYNAMIC):
    // Get the criteria
    $criteria = get_record('cohort_criteria','cohortid',$cohort->id);
?>

<?php print_heading(get_string('dynamiccohortcriterialower','local_cohort')); ?>

<div class="mform">
    <fieldset>
    <div class="fitem required alternate">
        <div class="fitemtitle">
            <?php echo get_string('userprofilefield','local_cohort'); ?>
        </div>
        <div class="felement ftext">
            <?php
            if (!empty($criteria)):
                if (substr($criteria->profilefield, 0, 11) == 'customfield') {
                    $fieldname = get_field('user_info_field', 'name', 'id', substr($criteria->profilefield, 11));
                    if ($fieldname != false) {
                        echo $fieldname;
                    }
                }
                else {
                    echo $criteria->profilefield;
                }
            echo '<br />';
            echo get_string('values','local_cohort') . ': ' . $criteria->profilefieldvalues;
            endif;
            ?>
        </div>
    </div>
    <div class="fitem required">
        <div class="fitemtitle">
            <?php echo get_string('position','local_cohort'); ?>
        </div>
        <div class="felement ftext">
            <?php
            if (!empty($criteria)):
                $positionname =  get_field('pos', 'fullname', 'id', $criteria->positionid);
            if ($positionname != false) {
                echo $positionname;
                if ($criteria->positionincludechildren) {
                    echo ' - ' . get_string('childrenincluded','local_cohort');
                }
            }
            endif;
            ?>
        </div>
    </div>
    <div class="fitem required alternate">
        <div class="fitemtitle">
            <?php echo get_string('organisation','local_cohort'); ?>
        </div>
        <div class="felement ftext">
            <?php
            if (!empty($criteria)):
                $organisationname =  get_field('org', 'fullname', 'id', $criteria->organisationid);
            if ($organisationname != false) {
                echo $organisationname;
                if ($criteria->orgincludechildren) {
                    echo ' - ' . get_string('childrenincluded','local_cohort');
                }
            }
            endif;
            ?>
        </div>
    </div>
    </fieldset>
</div>

<?php endif; ?>

<div class="mform">
    <fieldset>
    <div class="fitem required">
        <div class="fitemtitle">
            &nbsp;
        </div>
        <div class="felement ftext">
        <form>
            <input type="hidden" name="delete" value="1" />
            <input type="hidden" name="id" value="<?php echo $cohort->id; ?>" />
            <input type="submit" value="<?php echo get_string('deletethiscohort','local_cohort'); ?>" />
        </form>
        </div>
    </div>
    </fieldset>
</div>


<?php


admin_externalpage_print_footer();
