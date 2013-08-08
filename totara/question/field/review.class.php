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
 * @subpackage totara_question
 */

abstract class review extends question_base {

    protected $value = array();

    protected $reviewtitle = '';

    protected $buttonlabel = '';

    /**
     * Add database fields definition that represent current customfield
     *
     * @see question_base::get_xmldb()
     * @return array()
     */
    public function get_xmldb() {
        $fields = array();
        return $fields;
    }


    /**
     * Question specific settings elements
     *
     * @param MoodleQuickForm $form
     */
    protected function define_form(MoodleQuickForm $form) {
    }


    /**
     * Get data from element instance to save in db or put into form.
     *
     */
    public function edit_get($dest) {
        global $DB;
        $data = new stdClass();
        // Edit get used in two cases: when form is going to be populated and when data is going to be saved.
        if ($dest == 'form') {
            $name = $this->get_prefix_form();
            $data->$name = array();
            foreach ($this->value as $questreviewid => $content) {
                // Review form doesn't use moodle_form elements to populate.
                // Do this for read only purpose:
                $data->{$name}[$questreviewid] = $content;
            }
        } else {
            // Destination db -> we don't need to return any fields as data saved outside. We just save data.
            foreach ($this->value as $questreviewid => $content) {
                $todb = new stdClass();
                $todb->id = $questreviewid;
                $todb->content = $content;

                $DB->update_record($this->prefix.'_review_data', $todb);
            }
        }
        return $data;
    }


    /**
     * Custom set value for question instance
     *
     * @param stdClass $data
     * @param $source
     */
    public function edit_set(stdClass $data, $source) {
        global $DB;
        // edit_set is not saving. It is value setter into object instance.
        if ($source == 'form') {
            $form_field = $this->get_prefix_form() . 'reviewitems';
            $reviewitems = $data->$form_field;
            if (is_array($reviewitems)) {
                foreach ($reviewitems as $questreviewid) {
                    // We have to get data directly from post because
                    // the form is added to the page via JS so $data does
                    // not contain the form elements
                    $this->value[$questreviewid] = $_POST[$this->get_prefix_form() . '_reviewitem_' . $questreviewid];
                }
            }
        } else {
            // Source is db
            // One quest field can be used in several assignments. We need to use assignment.
            $records = $DB->get_records($this->prefix.'_review_data',
                    array($this->prefix.'questfieldid' => $this->id, $this->answerfield => $this->answerid));
            foreach ($records as $record) {
                $this->value[$record->id] = $record->content;
            }
        }
    }


    /**
     * Get a query to retieve answer data to display
     */
    public abstract function get_display_query($itemid);


    /**
     *
     */
    public abstract function get_items_query();


    /**
     * Render current element's answer as HTML
     * @param string $value value to render
     */
    public function to_html($value) {
        global $DB;
        $nl   = array("\r\n", "\n", "\r");
        $result = array();
        foreach ($value as $reviewid => $review) {
            list($sql, $params) = $this->get_display_query($reviewid);
            $item = $DB->get_record_sql($sql, $params);

            $br = html_writer::empty_tag('br');
            $review = format_string($review);
            $review = str_replace($nl, $br, $review);
            $result[] = html_writer::tag('div', html_writer::tag('strong', $item->fullname).': '.$br. $review);
        }
        return implode(html_writer::empty_tag('br'), $result);
    }


    /**
     * Is this element has any editable form fields, or it's view only (informational or static) element
     *
     * @see question_base::has_editable()
     * @return bool
     */
    public function has_editable() {
        return true;
    }


    /**
     * Override the form rendering for review questions
     */
    public function form(MoodleQuickForm $form) {
        global $DB;

        $form_prefix = $this->get_prefix_form();

        $form->addElement('header', '', $this->reviewtitle);

        $form->addElement('static', $this->get_prefix_form().'question', '', $this->name);
        $this->render_without_label($form, $this->get_prefix_form().'question');
        $form->addElement('button', $form_prefix . '_choosereviewitem', $this->buttonlabel);

        // Get form prefix for all items
        foreach ($this->roleinfo as $role => $info) {
            $element = $info->get_element($this->get_type());
            $element->id = $this->id;
            $element->formprefix = $element->get_prefix_form();

            $this->roleinfo[$role]->formprefix = $element->get_prefix_form();
        }

        $form->addElement('hidden', $this->get_prefix_form() . 'reviewitems')->setValue('');

        $this->edit_form($form);
    }
}
