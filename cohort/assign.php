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
 * Cohort related management functions, this file needs to be included manually.
 *
 * @package    core
 * @subpackage cohort
 * @copyright  2010 Petr Skoda  {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/cohort/lib.php');

$id = required_param('id', PARAM_INT);

admin_externalpage_setup('cohorts');

$cohort = get_record('cohort', 'id', $id);
$context = get_context_instance(CONTEXT_SYSTEM);

require_capability('local/cohort:assign', $context);

$returnurl = new moodle_url($CFG->wwwroot .'/cohort/index.php');


if (optional_param('cancel', false, PARAM_BOOL)) {
    redirect($returnurl->out());
}

$strheading = get_string('delcohort', 'local_cohort');

admin_externalpage_print_header();

print_heading(format_string($cohort->name));

$currenttab = 'editmembers';
require_once('tabs.php');

// Get the user_selector we will need.
$potentialuserselector = new cohort_candidate_selector('addselect', array('cohortid'=>$cohort->id));
$existinguserselector = new cohort_existing_selector('removeselect', array('cohortid'=>$cohort->id));

// Process incoming user assignments to the cohort

if (optional_param('add', false, PARAM_BOOL) && confirm_sesskey()) {
    $userstoassign = $potentialuserselector->get_selected_users();
    if (!empty($userstoassign)) {

        foreach ($userstoassign as $adduser) {
            // no duplicates please

            if (!record_exists('cohort_members', 'cohortid', $cohort->id, 'userid', $adduser->id)) {
                cohort_add_member($cohort->id, $adduser->id);
            }
        }

        $potentialuserselector->invalidate_selected_users();
        $existinguserselector->invalidate_selected_users();

	// Trigger an event to let anyone know that the membership has changed
	events_trigger('cohort_membership_changed',$cohort);
    }
}

// Process removing user assignments to the cohort
if (optional_param('remove', false, PARAM_BOOL) && confirm_sesskey()) {
    $userstoremove = $existinguserselector->get_selected_users();
    if (!empty($userstoremove)) {
        foreach ($userstoremove as $removeuser) {
            cohort_remove_member($cohort->id, $removeuser->id);
        }
        $potentialuserselector->invalidate_selected_users();
        $existinguserselector->invalidate_selected_users();

	// Trigger an event to let anyone know that the membership has changed
	events_trigger('cohort_membership_changed',$cohort);
    }
}

// Print the form.
?>
<form id="assignform" method="post" action="<?php echo $CFG->wwwroot; ?>/cohort/assign.php?id=<?php echo $id; ?>"><div>
  <input type="hidden" name="sesskey" value="<?php echo sesskey() ?>" />

  <table summary="" class="generaltable generalbox boxaligncenter" cellspacing="0">
    <tr>
      <td id="existingcell">
          <p><label for="removeselect"><?php print_string('currentusers', 'local_cohort'); ?></label></p>
          <?php $existinguserselector->display() ?>
      </td>
      <td id="buttonscell">
          <div id="addcontrols">
              <input name="add" id="add" type="submit" value="<?php echo '&#x25C4;&nbsp;'.s(get_string('add')); ?>" title="<?php p(get_string('add')); ?>" /><br />
          </div>

          <div id="removecontrols">
              <input name="remove" id="remove" type="submit" value="<?php echo s(get_string('remove')).'&nbsp;&#x25BA;'; ?>" title="<?php p(get_string('remove')); ?>" />
          </div>
      </td>
      <td id="potentialcell">
          <p><label for="addselect"><?php print_string('potusers', 'local_cohort'); ?></label></p>
          <?php $potentialuserselector->display() ?>
      </td>
    </tr>
    <tr><td colspan="3" id='backcell'>
      <input type="submit" name="cancel" value="<?php p(get_string('backtocohorts', 'local_cohort')); ?>" />
    </td></tr>
  </table>
</div></form>

<?php

admin_externalpage_print_footer();
