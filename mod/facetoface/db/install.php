<?php
/*
 * Copyright (C) 2012 Totara Learning Solutions LTD
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
 * @package mod
 * @subpackage facetoface
 */

function xmldb_facetoface_install() {
    global $DB;

    /*
     * This creates 3 customfields when facetoface is first installed
     */
    $result = true;
    // Create three new custom fields
    $newfield1 = new stdClass();
    $newfield1->name = get_string('location', 'facetoface');
    $newfield1->shortname = 'location';
    $newfield1->type = 0; // free text
    $newfield1->required = 0;
    $locationfieldid = $DB->insert_record('facetoface_session_field', $newfield1);

    $newfield2 = new stdClass();
    $newfield2->name = get_string('venue', 'facetoface');
    $newfield2->shortname = 'venue';
    $newfield2->type = 0; // free text
    $newfield2->required = 0;
    $venuefieldid = $DB->insert_record('facetoface_session_field', $newfield2);

    $newfield3 = new stdClass();
    $newfield3->name = get_string('room', 'facetoface');
    $newfield3->shortname = 'room';
    $newfield3->type = 0; // free text
    $newfield3->required = 0;
    $newfield3->showinsummary = 0;
    $roomfieldid = $DB->insert_record('facetoface_session_field', $newfield3);
}
?>
