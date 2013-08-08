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

class question_multichoicesingle extends multichoice{
    const DISPLAY_RADIO = 1;
    const DISPLAY_MENU = 2;

    public function __construct($definition, $prefix, $userid = 0, $answerfield = '', $answerid = 0) {
        parent::__construct($definition, $prefix, $userid, $answerfield, $answerid);
        $this->scaletype = self::SCALE_TYPE_MULTICHOICE;
    }

    public function get_info() {
        return array('group' => question::GROUP_QUESTION, 'title' => get_string('questiontypemultichoice', 'totara_question'));
    }

    /**
     * Add database fields definition that represent current customfield
     *
     * @see question_base::get_xmldb()
     * @return array()
     */
    public function get_xmldb() {
        // Multiple answers store data in third party table.
        $fields = array();
        $fields[$this->get_prefix_form()] = new xmldb_field($this->get_prefix_db(), XMLDB_TYPE_INTEGER, 10);
        return $fields;
    }

    /*
     * Customfield specific settings elements
     *
     * @param MoodleQuickForm $form
     * @return question_multichoice2 $this
     */
    protected function define_form(MoodleQuickForm $form) {
        $this->add_choices_menu($form);

        // Add select type.
        $list = array();
        $list[] = $form->createElement('radio', 'list', '', get_string('multichoiceradio', 'totara_question'), 1);
        $list[] = $form->createElement('radio', 'list', '', get_string('multichoicemenu', 'totara_question'), 2);
        $form->addGroup($list, 'listtype', get_string('displaysettings', 'totara_question'), array('<br/>'), false);

        // Set a default
        $form->setDefault('list', self::DISPLAY_RADIO);

        return $this;
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
            $this->param2 = self::DISPLAY_RADIO;
        }
        switch ($this->param2) {
            case self::DISPLAY_RADIO:
                $elements = array();
                $offset = 0;
                foreach ($options as $key => $option) {
                    $elements[] = $form->createElement('radio', $this->get_prefix_form(), '', $option, $key);
                }
                $form->addGroup($elements, $this->get_prefix_form(), $this->label, array('<br/>'), false);
                break;
            case self::DISPLAY_MENU:
                $select = $form->addElement('select', $this->get_prefix_form(), $this->label, $options);
                $select->setMultiple(false);
                break;
        }
        if (!$form->exportValue($this->get_prefix_form())) {
            $default = current($this->param3);
            $keys = array_slice($options, $default, 1, true);
            $form->setDefault($this->get_prefix_form(), key($keys));
        }
        if ($this->required) {
            $form->addRule($this->get_prefix_form(), get_string('required'), 'required');
        }
    }

    public function to_html($value) {
        global $DB;

        if ($scalevalue = $DB->get_record($this->prefix.'_scale_value', array('id' => $value))) {
            return $scalevalue->name;
        }
    }
}
