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

/**
 * Multiple answers question stores data not in generated db table fields but in separate table.
 * This is because number of chosen options is unknown,
 * To store this data (answers), element uses *_scale_data table.
 * Sets of elements joned in scales. It's needed for.
 *
 */

require_once('multichoice.class.php');

class question_multichoicemulti extends multichoice{
    /**
     * How to display choice
     */
    const MENU_CHECKBOX = 1;
    const MENU_SELECT = 2;

    public $value = array();

    public function __construct($definition, $prefix, $userid = 0, $answerfield = '', $answerid = 0) {
        parent::__construct($definition, $prefix, $userid, $answerfield, $answerid);
        $this->scaletype = self::SCALE_TYPE_MULTICHOICE;
        if (!$this->param2) {
            $this->param2 = self::MENU_CHECKBOX;
        }
    }

    public function get_info() {
        return array('group' => question::GROUP_QUESTION, 'title' => get_string('questiontypemultichoicemulti', 'totara_question'));
    }

    /**
     * Customfield specific settings elements
     *
     * @param MoodleQuickForm $form
     * @return question_multichoice2 $this
     */
    protected function define_form(MoodleQuickForm $form) {
        $this->add_choices_menu($form, 'availablechoices', false);

        // Add select type.
        $list = array();
        $list[] = $form->createElement('radio', 'list', '', get_string('multichoicecheck', 'totara_question'), self::MENU_CHECKBOX);
        $list[] = $form->createElement('radio', 'list', '', get_string('multichoicemultimenu', 'totara_question'),
                self::MENU_SELECT);
        $form->addGroup($list, 'listtype', get_string('displaysettings', 'totara_question'), array('<br/>'), false);

        // Set a default
        $form->setDefault('list', self::MENU_CHECKBOX);

        return $this;
    }

    public function edit_get($dest) {
        global $DB;
        $data = new stdClass();
        if ($dest == 'form') {
            $name = $this->get_prefix_form();
            $data->$name = array();
            switch ($this->param2) {
                case self::MENU_CHECKBOX:
                    foreach ($this->value as $id) {
                            $data->{$name}[$id] = 1;
                    }
                    break;
                case self::MENU_SELECT:
                    $data->$name = $this->value;
                    break;
            }
        } else {
            $DB->delete_records($this->prefix.'_scale_data', array($this->answerfield => $this->answerid,
                    $this->prefix.'questfieldid' => $this->id));

            foreach ($this->value as $id) {
                $answer = new stdClass();
                $answer->{$this->answerfield} = $this->answerid;
                $answer->{$this->prefix.'scalevalueid'} = $id;
                $answer->{$this->prefix.'questfieldid'} = $this->id;
                $DB->insert_record($this->prefix.'_scale_data', $answer);
            }
        }
        return $data;
    }

    public function edit_set(stdClass $data, $source) {
        global $DB;
        if ($source == 'form') {
            $name = $this->get_prefix_form();
            if (isset($data->$name)) {
                switch ($this->param2) {
                case self::MENU_CHECKBOX:
                    foreach ($data->$name as $id => $value) {
                        if ($value) {
                            $this->value[] = $id;
                        }
                    }
                    break;
                case self::MENU_SELECT:
                    $this->value = $data->$name;
                    break;
                }
            }
        } else {
            $values = $DB->get_records($this->prefix.'_scale_data', array($this->answerfield => $this->answerid,
                    $this->prefix.'questfieldid' => $this->id));
            foreach ($values as $field) {
                $this->value[] = $field->{$this->prefix.'scalevalueid'};
            }
        }
        return $data;
    }

    /**
     * Add form elements that represent current field
     *
     * @see question_base::edit_form()
     * @param MoodleQuickForm $form Form to alter
     */
    public function edit_form(MoodleQuickForm $form) {
        $options = $this->get_choice_list();
        if ($this->param2 < 1) {
            $this->param2 = self::MENU_CHECKBOX;
        }
        $defaultvalues = $this->param3;

        switch ($this->param2) {
            case self::MENU_CHECKBOX:
                $elements = array();
                $offset = 0;
                $default = array();
                foreach ($options as $key => $option) {
                    $elements[] = $form->createElement('advcheckbox', $this->get_prefix_form().'['.$key.']', '', $option);
                    if (in_array($offset, $this->param3)) {
                        $default[] = array('key' => $this->get_prefix_form().'['.$key.']', 'values' => 1);
                    }
                    $offset++;
                }
                $form->addGroup($elements, $this->get_prefix_form(), $this->label, array('<br/>'), false);
                break;
            case self::MENU_SELECT:
                $select = $form->addElement('select', $this->get_prefix_form(), $this->label, $options);
                $select->setMultiple(true);

                $default = array(array('key' => $this->get_prefix_form(), 'values' => array()));
                foreach ($defaultvalues as $offset) {
                    $keys = array_slice($options, $offset, 1, true);
                    $default[0]['values'][] = key($keys);

                }
                break;
        }
        $value = $form->exportValue($this->get_prefix_form());
        if (is_array($value)) {
            $value = array_filter($value);
        }
        if (!$value) {
            foreach ($default as $data) {
                $form->setDefault($data['key'], $data['values']);
            }
        }

        if ($this->required) {
            $form->addRule($this->get_prefix_form(), get_string('required'), 'required');
        }
    }

    public function to_html($values) {
        global $DB;

        switch ($this->param2) {
            case self::MENU_CHECKBOX:
                $ids = array_keys($values);
                break;
            case self::MENU_SELECT:
                $ids = array_values($values);
                break;
        }

        list($sql, $params) = $DB->get_in_or_equal($ids);

        $scalevalues = $DB->get_records_select($this->prefix.'_scale_value', 'id ' . $sql, $params);

        $choices = array();
        foreach ($scalevalues as $value) {
            $choices[] = $value->name;
        }

        $answers = implode(html_writer::empty_tag('br'), $choices);

        return $answers ;
    }

    public function delete() {
        global $DB;
        $DB->delete_records($this->prefix.'_scale_data', array($this->prefix.'questfieldid' => $this->id));
        parent::delete();
    }
}
