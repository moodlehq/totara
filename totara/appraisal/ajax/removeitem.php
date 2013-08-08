<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010 - 2013 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
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
 * @author Alastair Munro <alastair.munro@totaralms.com>
 * @package totara
 * @subpackage totara_appraisal
 */

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');

$sytemcontext = context_system::instance();
$PAGE->set_context($sytemcontext);


$id = required_param('id', PARAM_INT); // Question id
$itemid = required_param('itemid', PARAM_INT);
$answerid = required_param('answerid', PARAM_INT);
$review_item_id = required_param('reviewid', PARAM_INT);

// TODO Permissions checks
if (!confirm_sesskey()) {
    print_error('invalidsesskey');
}

$entries = $DB->get_records('appraisal_review_data', array('itemid' => $itemid, 'appraisalquestfieldid' => $id,
    'appraisalroleassignmentid' => $answerid));

if (count($entries) > 1) {
    // If is more than one entry for this combination then they should be for multiple roles
    // Check permissions to delete data from other roles
} else {
    // Delete
    $DB->delete_records('appraisal_review_data', array('id' => $review_item_id));
    if (is_ajax_request($_SERVER)) {
        echo ('success');
    }
}
