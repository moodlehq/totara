<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
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
 * @author Eugene Venter <eugene@catalyst.net.nz>
 * @package totara
 * @subpackage totara_sync
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

require_once($CFG->libdir.'/formslib.php');

/**
 * Formslib template for the element settings form
 */
class totara_sync_element_settings_form extends moodleform {
    function definition() {
        global $CFG;
        $mform =& $this->_form;
        $element = $this->_customdata['element'];
        $elementname = $element->get_name();

        // Source selection
        if ($sources = $element->get_sources()) {
            $sourceoptions = array('' => get_string('select'));
            foreach ($sources as $s) {
                $sourceoptions[$s->get_name()] = get_string('displayname:'.$s->get_name(), 'tool_totara_sync');
            }
            $mform->addElement('select', 'source_'.$elementname,
                get_string('source', 'tool_totara_sync'), $sourceoptions);
            $mform->setDefault('source_'.$elementname, get_config('totara_sync', 'source_'.$elementname));
        } else {
            $mform->addElement('static', 'nosources', '('.get_string('nosources', 'tool_totara_sync').')');
            if (!$element->has_config()) {
                return;
            }
        }
        if ($source = $element->get_source()) {
            if ($source->has_config()) {
                $mform->addElement('static', 'configuresource', '', html_writer::link(new moodle_url('/admin/tool/totara_sync/admin/sourcesettings.php', array('element' => $element->get_name(), 'source' => $source->get_name())), get_string('configuresource', 'tool_totara_sync')));
            }
        }

        // Element configuration
        if ($element->has_config()) {
            $element->config_form($mform);
        }

        $this->add_action_buttons(false);
    }
}


/**
 * Formslib template for the source settings form
 */
class totara_sync_source_settings_form extends moodleform {
    function definition() {
        $mform =& $this->_form;
        $source = $this->_customdata['source'];
        $sourcename = $source->get_name();

        // Source configuration
        if ($source->config_form($mform) !== false) {
            $this->add_action_buttons(false);
        }
    }
}


/**
 * Form for general sync settings
 */
class totara_sync_config_form extends moodleform {
    function definition() {
        $mform =& $this->_form;

        $mform->addElement('text', 'filesdir', get_string('filesdir', 'tool_totara_sync'));
        $mform->setType('filesdir', PARAM_TEXT);
        $mform->addRule('filesdir', null, 'required', null, 'client');

        $this->add_action_buttons(false);
    }
}


/**
 * Form for uploading of source sync files
 */
class totara_sync_source_files_form extends moodleform {
    function definition() {
        global $CFG;
        $mform =& $this->_form;
        require_once($CFG->dirroot.'/admin/tool/totara_sync/lib.php');

        $elements = totara_sync_get_elements($onlyenabled=true);
        if (!count($elements)) {
            $mform->addElement('html', html_writer::tag('p', get_string('noenabledelements', 'tool_totara_sync')));
            return;
        }

        foreach ($elements as $e) {
            $mform->addElement('header', 'header_'.$e->get_name(),
                get_string('displayname:'.$e->get_name(), 'tool_totara_sync'));

            if (!$source = $e->get_source()) {
                $mform->addElement('html', html_writer::tag('p', get_string('nosourceconfigured', 'tool_totara_sync')));
                continue;
            }
            if (!$source->uses_files()) {
                $mform->addElement('html', html_writer::tag('p', get_string('sourcedoesnotusefiles', 'tool_totara_sync')));
                continue;
            }
            $mform->addElement('filepicker', $e->get_name(),
                get_string('displayname:'.$source->get_name(), 'tool_totara_sync'), 'size="40"');
            if (file_exists($source->get_filepath())) {
                $mform->addElement('static', '', '', get_string('note:syncfilepending', 'tool_totara_sync'));
            }
        }

        $this->add_action_buttons(false, get_string('upload'));
    }

    /**
     * Does this form element have a file?
     *
     * @param string $elname
     * @return boolean
     */
    function hasFile($elname) {
        global $USER;

        $elements = totara_sync_get_elements($onlyenabled=true);
        // must exist
        if (!in_array($elname, array_keys($elements))) {
            return false;
        }
        // must be configured
        if (!$source = $elements[$elname]->get_source()) {
            return false;
        }
        $values = $this->_form->exportValues($elname);
        if (empty($values[$elname])) {
            return false;
        }
        $draftid = $values[$elname];
        $fs = get_file_storage();
        $context = get_context_instance(CONTEXT_USER, $USER->id);
        if (!$files = $fs->get_area_files($context->id, 'user', 'draft', $draftid, 'id DESC', false)) {
            return false;
        }
        return true;
    }
}
