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

class question_ratingcustom extends multichoice{
    /**
     * Display types
     */
    const DISPLAY_RADIO = 1;
    const DISPLAY_MENU = 2;

    public function __construct($definition, $prefix, $subjectid = 0, $answerfield = '', $answerid = 0) {
        parent::__construct($definition, $prefix, $subjectid, $answerfield, $answerid);
        $this->scaletype = self::SCALE_TYPE_RATING;
    }

    public function get_info() {
        return array('group' => question::GROUP_QUESTION, 'title' => get_string('questiontyperatingcustom', 'totara_question'));
    }

    /**
     * Add database fields definition that represent current customfield
     *
     * @see question_base::get_xmldb()
     * @return array()
     */
    public function get_xmldb() {
        $fields = array();
        $fields[$this->get_prefix_form()] = new xmldb_field($this->get_prefix_db(), XMLDB_TYPE_CHAR, '255');
        return $fields;
    }

    /**
     * Validate custom element configuration
     * @param stdClass $data
     * @param array $files
     */
    public function define_validate($data, $files) {
        $err = array();
        if (!$data->list) {
            $err['listtype'] = get_string('required');
        }
        return $err;
    }

    /**
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

        $form->setDefault('list', self::DISPLAY_RADIO);

        return $this;
    }
    /**
     * Return minimum value for range
     *
     * @return int
     */
    public function get_min() {
        $options = $this->get_choice_list();
        return min(array_keys($options));
    }

    /**
     * Return maximum value for range
     *
     * @return int
     */
    public function get_max() {
        $options = $this->get_choice_list();
        return max(array_keys($options));
    }

    /**
     * Add form elements that represent current field
     *
     * @see question_base::edit_form()
     * @param MoodleQuickForm $form Form to alter
     */
    public function edit_form(MoodleQuickForm $form) {
        $options = $this->get_choice_list();
        $name = $this->get_prefix_form();
        switch ($this->param2) {
            case self::DISPLAY_RADIO:
                $elements = array();
                foreach ($options as $score => $option) {
                    $elements[] = $form->createElement('radio', $name, '', $option, $score);
                }
                $form->addGroup($elements, $name, $this->label, array('<br/>'), false);
                break;
            case self::DISPLAY_MENU:
                $elements = array();
                foreach ($options as $score => $option) {
                    $elements[$score] = $option;
                }
                $select = $form->addElement('select', $name, $this->label, $elements);
                $select->setMultiple(false);
                break;
        }
        if (!$form->exportValue($name)) {
            $default = current($this->param3);
            $keys = array_slice($options, $default, 1, true);
            $form->setDefault($this->get_prefix_form(), key($keys));
        }
        if ($this->required) {
            $form->addRule($name, get_string('required'), 'required');
        }
    }

    /**
     * Override take answer from object
     *
     * @see question_base::get_data()
     * @param string $dest
     * @return stdClass
     */
    public function edit_get($dest) {
        global $TEXTAREA_OPTIONS;
        $data = new stdClass();

        if (empty($this->value)) {
            return $data;
        }

        if ($dest == 'form') {
            switch ($this->param2) {
                case self::DISPLAY_RADIO:
                    $name = $this->get_prefix_form();
                    break;
                case self::DISPLAY_MENU:
                    $name = $this->get_prefix_form();
                    break;
            }
        } else {
            $name = $this->get_prefix_db();
        }

        $data->{$name} = $this->value;
        return $data;
    }


    public function to_html($value) {
        global $DB;

        $scale = $this->param1;

        $answer = '';
        if ($scalevalue = $DB->get_record($this->prefix . '_scale_value', array('score' => $value,
            $this->prefix.'scaleid' => $scale))) {
            $answer = $scalevalue->name;
        }

        return $answer;
    }
}
