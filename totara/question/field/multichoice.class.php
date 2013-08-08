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

abstract class multichoice extends question_base{
    /**
     * One table used for all choices questions. To distinguish between them each question element should provide own unique type id.
     * If two different elements can use same scales they both should have same type id.
     */
    const SCALE_TYPE_MULTICHOICE = 1;
    const SCALE_TYPE_RATING = 2;

    /**
     * Maximum number of choices to admin
     * Should be  as JS-disabled forms will always show all of them
     * It is prohibited to lower this number, as clients might use all of them and lower number of available options could make
     * some choices inaccessible to admin.
     */
    const MAX_CHOICES = 10;

    /**
     * Save choices as
     * @var string
     */
    protected $savechoice = '';

    /**
     * Type of scale
     * @var int
     */
    protected $scaletype = 0;

    /**
     * Constructor
     */
    public function __construct($definition, $prefix, $userid = 0, $answerfield = '', $answerid = 0) {
        $this->param3 = array();
        parent::__construct($definition, $prefix, $userid, $answerfield, $answerid);
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
        return $fields;
    }

    public function define_get(stdClass $toform) {
        global $DB;

        if (isset($this->param2)) {
            $toform->list = $this->param2;
        }
        $scaleid = $this->param1;
        if ($scaleid > 0) {
            $choices = array();
            $values = $DB->get_records($this->prefix.'_scale_value', array($this->prefix.'scaleid' => $scaleid), 'id');
            foreach ($values as $value) {
                $choice = array();
                $choice['option'] = $value->name;
                if (!is_null($value->score)) {
                    $choice['score'] = $value->score;
                }
                $choices[] = $choice;
            }
            if (!empty($this->param3) && is_array($this->param3)) {
                foreach ($this->param3 as $key) {
                    $choices[$key]['default'] = 1;
                }
            }
            $toform->choice = $choices;
        }

        // Get scale.
        $scale = $DB->get_record($this->prefix.'_scale', array('id' => $scaleid));
        if (isset($scale->name) && $scale->name != '') {
            $toform->selectchoices = $scaleid;
        }
        return $toform;
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
        if ($data->saveoptions && trim($data->saveoptionsname) == '') {
            $err['savegroup'] = get_string('choicesmustnamed', 'totara_question');

        }
        return $err;
    }

    /**
     * Set values from configuration form
     *
     * @param stdClass $fromform
     * @return stdClass $fromform
     */
    public function define_set(stdClass $fromform) {
        global $USER, $DB;

        $this->param2 = $fromform->list;

        // User picked saved choices.
        if (isset($fromform->selectchoices) && $fromform->selectchoices > 0) {
            $this->param1 = $fromform->selectchoices;

            $this->param3 = array();
            foreach ($fromform->choice as $key => $choice) {
                if ($choice['default']) {
                    $this->param3[] = $key;
                }
            }

            return $this;
        }

        $options = array();
        foreach ($fromform->choice as $choice) {
            if (trim($choice['option']) != '') {
                $options[] = $choice;
            }
        }
        // Deafults on perf-field basis.
        $this->param3 = array();
        foreach ($options as $key => $option) {
            if ($option['default']) {
                $this->param3[] = $key;
            }
        }

        if ($fromform->saveoptions) {
            $this->savechoice = $fromform->saveoptionsname;
        }
        $scaleid = null;
        if ($this->id > 0) {
            $scaleid = (int)$this->param1;
        }
        $scale = new stdClass();
        $scale->id = $scaleid;
        $scale->name = $this->savechoice;
        $scale->userid = $USER->id;
        $scale->scaletype = $this->scaletype;
        if ($scaleid > 0) {
            $DB->update_record($this->prefix.'_scale', $scale);
        } else {
            $scaleid = $DB->insert_record($this->prefix.'_scale', $scale);
        }
        // Now save options.
        $DB->delete_records($this->prefix.'_scale_value', array($this->prefix.'scaleid' => $scaleid));
        foreach ($options as $option) {
            $value = new stdClass();
            $value->{$this->prefix.'scaleid'} = $scaleid;
            $value->name = trim($option['option']);
            if (isset($option['score'])) {
                $value->score = $option['score'];
            }
            $DB->insert_record($this->prefix.'_scale_value', $value);
        }
        $this->param1 = $scaleid;

        return $fromform;
    }

    /**
     * Add scale/choices options
     *
     * @param MoodleQuickForm $form
     * @param string $jsid Javascript container id (make sense only when more than one choices menu on a page).
     *                      Two choices menus in one form not supported
     * @param bool $limitone Only one choice can be selected
     * @return multichoice $this
     */
    protected function add_choices_menu(MoodleQuickForm $form, $jsid='availablechoices', $limitone=true) {
        $type = $this->scaletype;
        $form->addElement('header', $jsid, get_string('availablechoices', 'totara_question'));
        $saved = $this->get_saved_choices($type);
        $opsets = array();
        foreach ($saved as $opsetid => $opsetdata) {
            $opsets[$opsetid] = $opsetdata['name'];
        }

        if (!empty($saved) && $this->id < 1) {
            // Todo @todo If one of saved choices was used -> display dropdown.
            $savedchoices = array('0' => get_string('createnewchoices', 'totara_question')) + $opsets;
            $form->addElement('select', 'selectchoices', '', $savedchoices);
        }

        for ($i = 0; $i < self::MAX_CHOICES; $i++) {
            // @todo Refactor to call method ->_addchoice(). And implement this method in exact elements.
            switch ($type) {
                case self::SCALE_TYPE_MULTICHOICE:
                    $choice = array();
                    $choice[] = $elem = $form->createElement('text', 'option');
                    $choice[] = $form->createElement('advcheckbox', 'default', '',
                            get_string('defaultmake', 'totara_question'), array('class' => 'makedefault'));
                    $form->addGroup($choice, "choice[$i]");
                    break;

                case self::SCALE_TYPE_RATING:
                    // Add Header row if its the first item.
                    if ($i == 0) {
                        $header = array();
                        $header[] = $form->createElement('static', 'choice', '', html_writer::tag('span', html_writer::tag('b', get_string('choice', 'totara_question'))));
                        $header[] = $form->createElement('static', 'rating', '', html_writer::tag('span', html_writer::tag('b', get_string('score', 'totara_question'))));
                        $form->addGroup($header, 'header');
                    }

                    $choice = array();
                    $choice[0] = $form->createElement('text', 'option');
                    $choice[1] = $form->createElement('text', 'score');
                    $choice[2] = $form->createElement('advcheckbox', 'default', '',
                            get_string('defaultmake', 'totara_question'), array('class' => 'makedefault'));

                    $form->addGroup($choice, "choice[$i]");
                    $form->addGroupRule("choice[$i]", array("score" => array(array(get_string('error:scorenumeric', 'totara_question'), 'numeric', '', 'client'))));

                    break;
            }
        }

        $form->addElement('static', 'addoptionelem', '',
            html_writer::link('#', get_string('addanotheroption', 'totara_question'),
                    array('id' => "addoptionlink_$jsid", 'class'=>'addoptionlink')));

        $save = array();
        $save[] = $form->createElement('advcheckbox', 'saveoptions', 0, get_string('savechoicesas', 'totara_question'));
        $save[] = $form->createElement('text', 'saveoptionsname');
        $form->addGroup($save, 'savegroup', '', null, false);
        $form->disabledIf('saveoptionsname', 'saveoptions');
        $this->add_choices_js($form, $jsid, $saved, $limitone);
        return $this;
    }

    /**
     * Add scale/choices options supporting JS
     * We don't use $PAGE->js_init_call() because it calls only functions.
     * However, we can generate JS code here as a function and run it using js_init_call()
     *
     * @param MoodleQuickForm $form
     * @param string $jsid Javascript container id (make sense only when more than one choices menu on a page)
     * @param array $savedchoices array of previously saved chices
     * @return multichoice $this
     */
    protected function add_choices_js($form, $jsid, $savedchoices=array(), $limitone = true) {
        global $PAGE, $CFG;

        $limitone = (int)$limitone;
        $max = self::MAX_CHOICES;
        $jsonsavedchoices = json_encode($savedchoices);

        $PAGE->requires->strings_for_js(array('defaultmake', 'defaultselected', 'defaultunselect'), 'totara_question');
        $args = array('args' => '{"savedchoices": ' . $jsonsavedchoices . ', "oneAnswer": "' . $limitone . '", "jsid": "' .
                        $jsid . '", "max": ' . $max . '}');

        $jsmodule = array(
            'name' => 'totara_question_multichoice',
            'fullpath' => '/totara/question/field/multichoice.js',
            'requires' => array('json')
        );

        $PAGE->requires->js_init_call('M.totara_question_multichoice.init', $args, false, $jsmodule);

        return $this;
    }

    /**
     * Get saved choices
     * @return array
     */
    protected function get_saved_choices() {
        global $DB, $USER;
        $type = $this->scaletype;
        $sql = 'SELECT appsca.id, appsca.name AS scale_name, asv.name, asv.score
                FROM {'.$this->prefix.'_scale} appsca, {'.$this->prefix.'_scale_value} asv
                WHERE appsca.id = asv.'.$this->prefix.'scaleid
                    AND appsca.userid = ?
                    AND appsca.scaletype = ?
                    AND appsca.name <> \'\'
                    ORDER BY appsca.name, asv.id';
        $values = $DB->get_recordset_sql($sql, array($USER->id, $type));
        $scales = array();
        foreach ($values as $scaleid => $value) {
            $scales[$scaleid]['name'] = $value->scale_name;
            if (!isset($scales[$scaleid]['values'])) {
                $scales[$scaleid]['values'] = array();
            }
            $scales[$scaleid]['values'][] = array('name' => $value->name, 'score' => $value->score);
        }
        return $scales;
    }

    /**
     * Get list of choices
     *
     * @param int $scaleid Scale to use. If not set, scale will be taken from $this->param1
     * @return array
     */
    public function get_choice_list($scaleid = null) {
        global $DB;
        if (is_null($scaleid)) {
            if (is_array($this->param1)) {
                $options = array();
                foreach ($this->param1 as $o) {
                    $options[$o['score']] = $o['option'];
                }
                return $options;
            } else {
                $scaleid = $this->param1;
            }
        }
        $choices = $DB->get_records($this->prefix.'_scale_value', array($this->prefix.'scaleid' => $scaleid), 'id');
        $options = array();
        foreach ($choices as $id => $choice) {
            if ($choice->score) {
                $options[$choice->score] = $choice->name;
            } else {
                $options[$id] = $choice->name;
            }
        }

        return $options;
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

    public function delete() {
        global $USER, $DB;
        $scaleid = (int)$this->param1;
        $DB->delete_records($this->prefix.'_scale', array('id' => $scaleid, 'userid' => $USER->id, 'name' => ''));
        parent::delete();
    }

    public function duplicate(question_base $old) {
        global $DB;
        // Duplicate scale if it was not saved.
        $oldscaleid = $old->param1;
        if ($oldscaleid > 0) {
            $scale = $DB->get_record($this->prefix.'_scale', array('id' => $oldscaleid));
            if ($scale->name != '') {
                // It is not saved choices -> duplicate.
                $scale->id = 0;
                $newscaleid = $DB->insert_record($this->prefix.'_scale', $scale);
                $values = $DB->get_records($this->prefix.'_scale_value', array('id' => $oldscaleid));
                foreach ($values as $value) {
                    $value->id = 0;
                    $value->{$this->prefix.'scaleid'} = $newscaleid;
                    $DB->insert_record($this->prefix.'_scale_value', $value);
                }
            }
        }
    }
}
