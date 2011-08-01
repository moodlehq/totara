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
 * @author Ben Lobo <ben.lobo@kineo.com>
 * @package totara
 * @subpackage program
 */

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once($CFG->dirroot.'/local/program/lib.php');
require_once($CFG->dirroot.'/local/dialogs/dialog_content.class.php');

require_login();

// Put the html here for now
// The Javascript is all in the new handler

?>

<div>
    <label><?php echo get_string('completeby', 'local_program'); ?></label>

    <input type="text" class="completiontime" name="completiontime" />

    <button class="fixeddate" ><?php echo get_string('setfixedcompletiondate', 'local_program'); ?></button>
</div>

<div>
    <?php echo get_string('or', 'local_program'); ?>
</div>

<div>
    <?php echo get_string('completewithin', 'local_program'); ?>

    <?php echo program_utilities::print_duration_selector($prefix='', $periodelementname='timeperiod', $periodvalue='', $numberelementname='timeamount', $numbervalue='1', $return=true, $includehours=false); ?>

    <?php echo get_string('of', 'local_program'); ?>

    <?php echo prog_assignments::get_completion_events_dropdown(); ?>

    <input type="hidden" id="instance" name="instance" value="" />
    <a id="instancetitle" href="#" > </a>

    <button class="relativeeventtime" ><?php echo get_string('settimerelativetoevent', 'local_program'); ?></button>
</div>
