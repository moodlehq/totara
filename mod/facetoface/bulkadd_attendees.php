<?php
/**
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010 - 2013 Totara Learning Solutions LTD
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
 * @author Aaron Barnes <aaron.barnes@totaralms.com>
 * @author Alastair Munro <alastair.munro@totaralms.com>
 * @package totara
 * @subpackage facetoface
 */

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once($CFG->libdir . '/formslib.php');
require_once($CFG->dirroot . '/mod/facetoface/lib.php');

// Face-to-face session ID
$s = required_param('s', PARAM_INT);

// Upload type
$type = required_param('type', PARAM_ALPHA);

// Show dialog
$dialog = optional_param('dialog', false, PARAM_BOOL);

// Load data
if (!$session = facetoface_get_session($s)) {
    print_error('error:incorrectcoursemodulesession', 'facetoface');
}

if (!$facetoface = $DB->get_record('facetoface', array('id' => $session->facetoface))) {
    print_error('error:incorrectfacetofaceid', 'facetoface');
}

// Check capability
require_login($facetoface->course);

// Generate url
$url = new moodle_url('/mod/facetoface/bulkadd_attendees.php', array('s' => $s, 'type' => $type, 'action' => 'attendees'));

// Generate form

if ($type === 'file') {

    class facetoface_bulkadd_file_form extends moodleform {
        function definition() {
            $mform =& $this->_form;
            $mform->addElement('file', 'userfile', get_string('csvtextfile', 'facetoface'));
            $mform->setType('userfile', PARAM_FILE);
            $mform->addRule('userfile', null, 'required');
            $encodings = textlib::get_encodings();
            $mform->addElement('select', 'encoding', get_string('encoding', 'grades'), $encodings);
        }
    }

    $form = new facetoface_bulkadd_file_form($url, null, 'post', '', null, true, 'bulkaddfile');

} else if ($type === 'input') {

    class facetoface_bulkadd_input_form extends moodleform {
        function definition() {
            $this->_form->addElement('textarea', 'csvinput', get_string('csvtextinput', 'facetoface'));
        }
    }

    $formurl = clone($url);
    $formurl->param('onlycontent', 1);
    $form = new facetoface_bulkadd_input_form($formurl, null, 'post', '', null, true, 'bulkaddinput');
    unset($formurl);
} else {
    error('Invalid parameters supplied');
    die();
}


// Check if data submitted
if ($data = $form->get_data()) {

    // Handle data
    // If input type, explode of commas
    if ($type === 'input') {
        $rawinput = str_replace(array("\r\n", "\n", "\r"), ',', $data->csvinput);
        $addusers = clean_param($rawinput, PARAM_NOTAGS);
        // Turn into array, then filter out empty strings/false/null using array_filter
        $addusers = array_filter(explode(',', $addusers));
        // Remove any leading or trailing spaces
        $addusers = array_map('trim', $addusers);
    }

    if ($type === 'file') {
        // Large files are likely to take their time and memory. Let PHP know
        // that we'll take longer, and that the process should be recycled soon
        // to free up memory.
        @set_time_limit(0);
        @raise_memory_limit("192M");
        if (function_exists('apache_child_terminate')) {
            @apache_child_terminate();
        }

        $csv_delimiter = ',';
        $text = $form->get_file_content('userfile');

        // Trim utf-8 bom
        $text = textlib::trim_utf8_bom($text);
        // Normalize line endings and do the encoding conversion
        $text = textlib::convert($text, $data->encoding);

        $addusers = array();
        foreach (explode("\n", $text) as $line) {
            $line = explode($csv_delimiter, clean_param($line, PARAM_RAW));
            if ($line) {
                $cell = clean_param($line[0], PARAM_NOTAGS);
                if ($cell) {
                    $addusers[] = $cell;
                }
            }
        }
    }

    // Bulk add results
    $errors = array();
    $added = array();

    // Check for data
    if (!$addusers) {
        $errors[] = get_string('error:nodatasupplied', 'facetoface');
    } else {
        // Load users
        foreach ($addusers as $adduser) {
            $result = facetoface_user_import($session, $adduser, true, false, true);
            if ($result['result'] !== true) {
                $errors[] = $result;
            } else {
                $result['result'] = get_string('addedsuccessfully', 'facetoface');
                $added[] = $result;
            }
        }
    }

    // Record results in session for results dialog to access
    if (empty($_SESSION['f2f-bulk-results'])) {
        $_SESSION['f2f-bulk-results'] = array();
    }
    $_SESSION['f2f-bulk-results'][$session->id] = array($added, $errors);

    $result_message = facetoface_generate_bulk_result_notice($_SESSION['f2f-bulk-results'][$session->id]);

    require($CFG->dirroot.'/mod/facetoface/attendees.php');
    die();
}

if (!$dialog) {
    require($CFG->dirroot.'/mod/facetoface/attendees.php');
    die();
}

// Display form
$form->display();

// Help text
if ($type === 'file') {
    $notestring = get_string('bulkaddfilehelptext', 'facetoface');
} else {
    $notestring = get_string('bulkaddtexthelptext', 'facetoface');
}
notify($notestring, 'notifyinfo', 'left');
