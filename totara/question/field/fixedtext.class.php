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
 * @author Valerii Kuznetsov <valerii.kuznetsov@totaralms.com>
 * @author Alastair Munro <alastair.munro@totaralms.com>
 * @package totara
 * @subpackage totara_question
 */

class question_fixedtext extends question_base{
    public function get_info() {
        return array('group' => question::GROUP_OTHER, 'title' => get_string('questiontypefixedtext', 'totara_question'));
    }

    /**
     * Add database fields definition that represent current question
     *
     * @see question_base::get_xmldb()
     * @return array()
     */
    public function get_xmldb() {
        $fields = array();
        return $fields;
    }


    /**
     * Add database fields definition that represent current question
     *
     * @see question_base::get_xmldb()
     * @return array()
     */
    public function define_get(stdClass $toform) {
        global $TEXTAREA_OPTIONS, $PAGE;

        if (!isset($toform)) {
            $toform = new stdClass();
        }

        $PAGE->requires->js('/lib/editor/tinymce/tiny_mce/3.5.7b/tiny_mce_src.js');
        $toform->fixedtextformat = FORMAT_HTML;
        $toform->fixedtext = isset($this->param1) ? $this->param1 : '';
        $toform = file_prepare_standard_editor($toform, 'fixedtext', $TEXTAREA_OPTIONS, $TEXTAREA_OPTIONS['context'],
            'totara_question', $this->prefix . '_question', $this->id);

        return $toform;
    }


    /**
     * Set values from configuration form
     *
     * @param stdClass $fromform
     * @return stdClass $fromform
     */
    public function define_set(stdClass $fromform) {
        global $TEXTAREA_OPTIONS;

        $fromform = file_postupdate_standard_editor($fromform, 'fixedtext', $TEXTAREA_OPTIONS, $TEXTAREA_OPTIONS['context'],
            'totara_question', $this->prefix . '_question', $this->id);
        $this->param1 = $fromform->fixedtext;

        return $this;
    }


    /**
     * Question specific settings elements
     *
     * @param MoodleQuickForm $form
     */
    protected function define_form(MoodleQuickForm $form) {
        global $TEXTAREA_OPTIONS;
        $form->addElement('editor', 'fixedtext_editor', get_string('questiontypefixedtext', 'totara_question'), null, $TEXTAREA_OPTIONS);
    }


    /**
     * Add form elements that represent current field
     *
     * @see question_base::edit_form()
     * @param MoodleQuickForm $form Form to alter
     */
    public function edit_form(MoodleQuickForm $form) {
    }


    /**
     * Add form elements related to questions to form for user answers
     * Default implementation for first mapped field.
     * Override for all other cases.
     *
     * @param MoodleQuickForm $form
     */
    public function edit_display(MoodleQuickForm $form) {
        global $TEXTAREA_OPTIONS;

        $obj = new stdClass();
        $obj->fixedtextformat = FORMAT_HTML;
        $obj->fixedtext = isset($this->param1) ? $this->param1 : '';
        $preparedobj = file_prepare_standard_editor($obj, 'fixedtext', $TEXTAREA_OPTIONS, $TEXTAREA_OPTIONS['context'],
            'totara_question', $this->prefix . '_question', $this->id);

        $form->addElement('static', $this->get_prefix_form(), $this->name, $preparedobj->fixedtext_editor['text']);

        // Remove label from form element to get rid of empty space.
        $this->render_without_label($form, $this->get_prefix_form());
    }


    /**
     * Is this element has any editable form fields, or it's view only (informational or static) element
     *
     * @see question_base::has_editable()
     * @return bool
     */
    public function has_editable() {
        return false;
    }
}
