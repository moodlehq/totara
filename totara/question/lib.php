<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2013 Totara Learning Solutions LTD
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
 * @author Simon Coggins <simon.coggins@totaralms.com>
 * @author Valerii Kuznetsov <valerii.kuznetsov@totaralms.com>
 * @package totara
 * @subpackage totara_question
 */

require_once($CFG->libdir.'/formslib.php');
require_once($CFG->libdir.'/form/static.php');
require_once(dirname(__FILE__).'/libforms.php');
require_once($CFG->libdir.'/ddllib.php');

/**
 * Custom fileds management class
 */
class question {
    const GROUP_QUESTION = 1;
    const GROUP_REVIEW = 2;
    const GROUP_OTHER = 3;

    /**
     * Tables prefix used by various elements
     *
     * @var string
     */
    protected $prefix = '';

    /**
     * Db field name for store answer id (each question can have many answers)
     * @var string
     */
    protected $answerfield = '';

    /**
     * Answer id (each question can have many answers)
     * @var int
     */
    protected $answerid = 0;

    /**
     * Subject user id (used by elements that input or output some information about certain user
     * By default - user currently logged in
     * @var int
     */
    protected $subjectid = 0;

    /**
     * Create form
     * @param string $prefix tablename prefix used by different elements
     * @param int $subjectid user id that is subject of question
     * @param string $answerfield answer id field name
     * @param int $answerid answer id field value
     */
    public function __construct($prefix, $subjectid = 0, $answerfield = '', $answerid = 0) {
        global $CFG, $USER;
        if (!$subjectid) {
            $subjectid = $USER->id;
        }
        if (!is_ajax_request($_SERVER)) {
            require_once($CFG->dirroot . '/totara/core/js/lib/setup.php');
            local_js();
        }
        $this->prefix = $prefix;
        $this->subjectid = $subjectid;
        $this->answerfield = $answerfield;
        $this->answerid = $answerid;
    }

    /**
     * Allow read access to restricted properties
     * @param string $name
     * @return mixed
     */
    public function __get($name) {
        if (in_array($name, array('answerid'))) {
            return $this->$name;
        }
    }

    /**
     * Get all registered elements
     *
     * @return array
     */
    public function get_registered_elements() {
        $dir = dirname(__FILE__).'/field';
        $elemfiles = glob($dir.'/*.class.php');
        $info = array();
        foreach ($elemfiles as $file) {
            $element = basename($file, '.class.php');
            $classname = 'question_'.$element;
            if (strpos($file, '..' !== false)) {
                throw new exception('Custom field element file cannot have two dots \'..\' sequentially');
            }
            require_once($file);
            if (class_exists($classname)) {
                $eleminst = new $classname(null, $this->prefix, $this->subjectid, $this->answerfield, $this->answerid);
                $info[$element] = $eleminst->get_info();
                $info[$element]['classname'] = $classname;
            }
        }
        uasort($info, function ($a, $b) {
            return $a['group'] - $b['group'];
        });
        return $info;
    }

    /**
     * Fabric method to instantiate element
     *
     * @param mixed $datatype string with datatype or stdClass with record elements
     * @return question_base
     */
    public function get_element($datatype) {
        $elems = $this->get_registered_elements();
        $element = null;
        if (is_object($datatype)) {
            if (isset($datatype->datatype)) {
                $element = $this->get_element($datatype->datatype);
                $element->define_import($datatype);
            }
        } else if (isset($elems[$datatype])) {
            $classname = $elems[$datatype]['classname'];
            $element = new $classname(null, $this->prefix, $this->subjectid, $this->answerfield, $this->answerid);
        }

        if (!($element instanceof question_base)) {
            throw new question_exception('Cannot find element: '.json_encode($datatype));
        }
        return $element;
    }

    /**
     * Helper method to add all xmldb fields of appraisal to a table definition
     *
     * @param array $elements
     * @param array $xmldbfields domain specific fields
     * @return array of xmld_filed
     */
    public function get_xmldb(array $elements, $xmldbfields = array()) {
        foreach ($elements as $elem) {
            if ($elem instanceof question_base) {
                $fields = $elem->get_xmldb();
            } else if (is_object($elem) && isset($elem->datatype) && isset($elem->id)) {
                $fields = $this->get_element($elem)->get_xmldb();
            } else {
                throw new question_exception('Cannot find element: '.json_encode($elements));
            }

            $xmldbfields = array_merge($xmldbfields, (array)$fields);
        }
        return $xmldbfields;
    }

    /**
     * Add question fields to db table definition
     * @param array $allfields of xmldb_*
     * @param xmldb_table $table
     */
    public function add_db_table(array $allfields, xmldb_table $table) {

        foreach ($allfields as $field) {
            if ($field instanceof xmldb_field) {
                $table->addField($field);
            } else if ($field instanceof xmldb_key) {
                $table->addKey($field);
            } else if ($field instanceof xmldb_index) {
                $table->addIndex($field);
            }
        }
    }

    /**
     * Helper function that creates all elements from array (typically taken from DB) and add them to form
     *
     * @param array $elements of stdClass elements definition
     * @param MoodleQuickForm
     */
    public function add_elements_form(array $elements, MoodleQuickForm $mform) {
        foreach ($elements as $elem) {
            $element = $this->get_element($elem);
            $element->form($mform);
        }
    }
}

/**
 * Custom fields element base class
 *
 * All methods started with define_* used for admin-end (configuration)
 * All methods started with edit_* used for user-end (answers)
 * All methods started with get_* used for getting element meta information
 */
abstract class question_base {
    /**
     * Unique identifier of element
     * Usualy it's database element row id
     *
     * @param int
     */
    public $id;

    /**
     * Optional definition parameters for elements that will be saved to db
     *
     * @var mixed
     */
    public $param1 = null;
    public $param2 = null;
    public $param3 = null;
    public $param4 = null;
    public $param5 = null;

    /**
     * Label of field
     *
     * @var string
     */
    public $name = '';

    /**
     * Label of field
     *
     * @var string
     */
    public $label = '';

    /**
     * String with listing users that can
     * view current user's answer to this question
     */
    public $viewersstring = '';

    /**
     * Information about other roles that can answer
     * this question and current user has permissions to view
     */
    public $roleinfo = array();

    /**
     * Whether or not this user can answer this question
     */
    public $cananswer = true;

    /**
     * User must answer on questions
     * @var bool
     */
    public $required = false;

    /**
     * User can only see answer
     * @var bool
     */
    public $viewonly = false;

    /**
     * Default answer for question
     * @var string
     */
    public $defaultdata = '';

    /**
     * Tablename prefix used by some elements
     *
     * @var string
     */
    protected $prefix = '';

    /**
     * Db field name for store answer id (each question can have many answers)
     * @var string
     */
    protected $answerfield = '';

    /**
     * Answer id (each question can have many answers)
     * @var int
     */
    protected $answerid = 0;

    /**
     * Subject user id (used by elements that input or output some information about certain user
     * By default - user currently logged in
     * @var int
     */
    protected $subjectid = 0;

    /**
     * Indicates that edit form was populated by elements and further changes not possible
     */
    protected $formsent = false;

    /**
     * Form values
     * @var array
     */
    protected $values = array();

    /**
     * Instantiate new field
     *
     * @param stdClass $definiton properties of form element
     * @param string $prefix tables prefix used by some elements
     * @param string $userid subject user id (user that is this element is about). Default: currently loggedin user
     */
    public function __construct($definition, $prefix, $subjectid = 0, $answerfield = '', $answerid = 0) {
        global $USER;
        if (is_object($definition)) {
            $this->set($definition);
        }
        $this->prefix = $prefix;
        $this->subjectid = ($subjectid > 0) ? $subjectid : $USER->id;
        $this->answerfield = $answerfield;
        $this->answerid = $answerid;
    }

    /**
     * Allow read access to restricted properties
     * @param string $name
     * @return mixed
     */
    public function __get($name) {
        if (in_array($name, array('answerid'))) {
            return $this->$name;
        }
    }

    /**
     * Set element configuration data from it's properties stored in db
     *
     * Elements are not supposed to store or save their setting. They only provide export and import configuration methods
     * for further use.
     * For this purpose cusotmfield elements reserve six fields in storage object (datatype, param1-param5)
     * Also it requires "id" field which used for element unique identification.
     *
     * @param stdClass $fromdb
     * @return stdClass $fromdb
     */
    public function define_import(stdClass $fromdb) {
        // Take all public properties and pick relevant to element.
        foreach ($fromdb as $name => $prop) {
            if (in_array($name, array('param1', 'param2', 'param3', 'param4', 'param5'))) {
                $this->$name = json_decode($prop, true);
            }
            if (in_array($name, array('defaultdata', 'name', 'id'))) {
                $this->$name = $prop;
            }
        }
        return $fromdb;
    }

    /**
     * Prepare element for further saving
     *
     * Elements are not supposed to store or save their setting. They only provide export and import configuration methods
     * for further storing.
     *
     * @param stdClass $todb
     * @return stdClass $todb
     */
    public function define_export(stdClass $todb) {
        foreach (array('param1', 'param2', 'param3', 'param4', 'param5') as $prop) {
            $todb->$prop = json_encode($this->$prop, true);
        }
        $todb->defaultdata = $this->defaultdata;
        $todb->datatype = $this->get_type();
        return $todb;
    }

    /**
     * Encode values from form to paramX for saving configuration
     *
     * @param stdClass $fromform
     * @return stdClass $fromform
     * @todo Refactor to use define_get_elements()  which will be abstract and return fields to transitionaly save/load
     *        This will reduce complexity of getting rig overriding define_set and define_get in most cases
     */
    public function define_set(stdClass $fromform) {
        $this->param1 = $fromform;
        return $fromform;
    }

    /**
     * Set saved configuration to form object
     *
     * @param stdClass $toform
     * @return stdClass $toform
     * @todo Refactor to use define_get_elements()  which will be abstract and return fields to transitionaly save/load
     *        This will reduce complexity of getting rig overriding define_set and define_get in most cases
     */
    public function define_get(stdClass $toform) {
        $toform = (object)$this->param1;
        return $toform;
    }

    /**
     * Prints out the form snippet for creating or editing a question
     *
     * @param MoodleQuickForm $form instance of the moodleform class
     */
    public function define_form_all(MoodleQuickForm $form) {
        $strrequired = get_string('customfieldrequired', 'totara_customfield');
        if ($this->has_editable()) {
            $form->addElement('text', 'name', get_string('question'), 'size="50"');
            $form->addRule('name', $strrequired, 'required');
            $form->setType('name', PARAM_MULTILANG);
            $form->addHelpButton('name', 'customfieldfullname', 'totara_customfield');
        }
        $this->define_form($form);
    }

    /**
     * Prints out the form snippet for the part of creating or
     * editing a custom field common to all data types
     *
     * @param MoodleQuickForm $mform instance of the moodleform class
     */
    protected function define_form_common(MoodleQuickForm $mform) {

    }

    /**
     * Validate the data from the add/edit custom field form.
     * Generally this method should not be overwritten by child
     * classes.
     *
     * @param stdClass data from the add/edit custom field form
     * @param array $files
     * @return  array    associative array of error messages
     */
    public function define_validate_all($data, $files) {
        $data = (object)$data;
        $err = array();
        if ($this->has_editable()) {
            if (empty($data->name)) {
                $err['name'] = get_string('customfieldrequired', 'totara_customfield');
            }
        }
        $err += $this->define_validate($data, $files);
        return $err;
    }

    /**
     * Validate the data from the add/edit custom field form
     * that is specific to the current data type
     *
     * @param stdClass $data from the add/edit custom field form
     * @param array $files
     * @return array associative array of error messages
     */
    protected function define_validate($data, $files) {
        // Do nothing - override if necessary.
        return array();
    }

    /**
     * Populate edit form with question elements
     * @param MoodleQuickForm $form
     */
    public function form(MoodleQuickForm $form) {
        $this->formsent = true;

        // Adding the header causes a new div to start in the output, containing all following elements until the next header.
        $form->addElement('header', '', $this->name);

        if ($this->cananswer) {
            if ($this->viewonly) {
                $this->edit_display($form);
            } else {
                $this->edit_form($form);
            }
            if (!empty($this->viewersstring)) {
                $form->addElement('html', $this->viewersstring);
            }
        }

        foreach ($this->roleinfo as $role => $info) {
            $question = $info->get_element($this->get_type());
            $question->label = $info->label;
            $question->id = $this->id;
            $form->addElement('html', $info->userimage);
            if ($question->cananswer) {
                $question->edit_display($form);
            }
        }
    }

    /**
     * Set current element as required/not required
     * Must be set before added to form
     * Turns off question_base::set_viewonly()
     *
     * @param bool $is_required
     * @return question_base $this
     */
    public function set_required($is_required = true) {
        if ($this->formsent) {
            throw new question_exception('Form already populated');
        }
        $this->required = $is_required;
        if ($is_required) {
            $this->set_viewonly(false);
        }
        return $this;
    }

    /**
     * Set current element as view only
     * Must be set before added to form
     * Turns off question_base::set_required()
     *
     * @param bool $isviewonly
     * @return question_base $this
     */
    public function set_viewonly($isviewonly = true) {
        if ($this->formsent) {
            throw new question_exception('Form already rendered');
        }
        $this->viewonly = $isviewonly;
        if ($isviewonly) {
            $this->set_required(false);
        }
        return $this;
    }

    /**
     * Validate elements input
     *
     * @see question_base::edit_validate
     * @return array
     */
    public function edit_validate($fromform) {
        return array();
    }

    /**
     * Load answer to object
     *
     * @param stdClass $data
     * @param string $source source of data 'form' (otherwise 'db')
     * @return question_base $this
     */
    private function set_data(stdClass $data, $source) {
        $this->edit_set($data, $source);
        $dbfields = $this->get_xmldb();
        foreach ($dbfields as $elem => $field) {
            if (!is_numeric($elem)) {
                if ($source == 'form') {
                    $name = $elem;
                } else {
                    $name = $field->getName();
                }
                $this->values[$elem] = $data->$name;
            }
        }
        return $this;
    }

    /**
     * Take answer from object
     *
     * @param stdClass $data
     * @param string $dest destination of data 'form' (otherwise 'db')
     * @return stdClass $data
     */
    private function get_data(stdClass $data, $dest) {
        $dbfields = $this->get_xmldb();
        foreach ($dbfields as $elem => $field) {
            if (!is_numeric($elem)) {
                if ($dest == 'form') {
                    $name = $elem;
                } else {
                    $name = $field->getName();
                }
                $data->$name = $this->values[$elem];
            }
        }
        $customdata = (array)$this->edit_get($dest);
        foreach ($customdata as $key => $value) {
            $data->$key = $value;
        }
        return $data;
    }

    /**
     * Set answer from Db Row object
     * @param stdClass $data
     * @return stdClass $data
     */
    final public function set_as_db(stdClass $data) {
        return $this->set_data($data, 'db');
    }

    /**
     * Set answer from form object
     * @param stdClass $data
     * @return stdClass $data
     */
    final public function set_as_form(stdClass $data) {
        return $this->set_data($data, 'form');
    }

    /**
     * Get answer as Db Row object
     * @param stdClass $data
     * @return stdClass $data
     */
    final public function get_as_db(stdClass $data) {
        return $this->get_data($data, 'db');
    }

    /**
     * Get answer as form object
     * @param stdClass $data
     * @return stdClass $data
     */
    final public function get_as_form(stdClass $data) {
        return $this->get_data($data, 'form');
    }

    /**
     * Get question shortname to use as datatype
     * @return string
     */
    public function get_type() {
        return str_replace('question_', '', get_class($this));
    }

    /**
     * Return prefix name for db
     *
     * @return string
     */
    public function get_prefix_db() {
        return 'data_'.$this->id;
    }

    /**
     * Return prefix name for form
     *
     * @return string
     */
    public function get_prefix_form() {
        return 'data_'.$this->id.'_'.$this->answerid;
    }

    /**
     * Add form elements related to questions to form for user answers
     * Default implementation for first mapped field.
     * Override for all other cases.
     *
     * @param MoodleQuickForm $form
     */
    public function edit_display(MoodleQuickForm $form) {
        $form->addElement('staticcallback', $this->get_prefix_form(), $this->label, $this);
    }

    /**
     * Add data for view other roles questions
     * This will be used when rendering the question
     */
    public function add_question_role_info($role, question $info) {
        $this->roleinfo[$role] = $info;
    }

    /**
     * Modify a form element's renderer to exclude the 'label' portion.
     * Used for "other" elements that can take up the full form width.
     *
     * @param MoodleQuickForm $form
     * @param string $element Name of the form element to modify (value returned by {@link get_prefix_form()}
     * @return void
     */
    public function render_without_label(MoodleQuickForm $form, $element) {
        global $OUTPUT;
        $renderer = $form->defaultRenderer();
        $elementtemplate = $OUTPUT->container($OUTPUT->container('{element}'), 'fitem');
        $renderer->setElementTemplate($elementtemplate, $element);
    }

    /**
     * Render current element's answer as HTML
     * @param string $value value to render
     */
    public function to_html($value) {
        return $value;
    }

    /**
     * Delete all data created by element
     * Override only if element add definition/data directly using global $DB object/files/etc
     */
    public function delete() {
    }

    /**
     * Clone question properties (if they are stored in third party tables)
     * @param question_base $old old question instance
     */
    public function duplicate(question_base $old) {
    }

    /**
     * Override load answer to object
     *
     * @see question_base::set_data()
     * @param stdClass $data
     * @param string $source
     */
    public function edit_set(stdClass $data, $source) {
    }

    /**
     * Override take answer from object
     *
     * @see question_base::get_data()
     * @param string $dest
     * @return stdClass
     */
    public function edit_get($dest) {
    }

    /**
     * Add configuration settings related to a field
     *
     * @param MoodleQuickForm $form instance of the moodleform class
     */
    abstract protected function define_form(MoodleQuickForm $form);

    /**
     * Add form elements related to questions to form for user answers
     *
     * @param MoodleQuickForm $form
     */
    abstract public function edit_form(MoodleQuickForm $form);

    /**
     * Return array with information about current field
     * Array structure:
     * array('group' => question::GROUP_*, 'title'=>'Localised element name')
     *
     *
     * @return array
     */
    abstract public function get_info();

    /**
     * Return array of field/indexes/keys definitions needed to store question data
     * One question can use several db fields if needed.
     * Question fields can be mapped to form elements by setting returning array keys queals to form element names
     * If data stored in outer tables and no extra field required this array can be empty
     *
     * @return array of xmldb_field
     */
    abstract public function get_xmldb();

    /**
     * Is this element has any editable form fields, or it's view only (informational or static) element
     *
     * @return bool
     */
    abstract public function has_editable();
}

/**
 * Form element that during display his value calls callback of an any element
 */
class MoodleQuickForm_staticcallback extends MoodleQuickForm_static {
    /**
     * Function to call during display
     * @var type
     */
    protected $callback = null;

    /**
     * constructor
     *
     * @param string $elementName (optional) name of the text field
     * @param string $elementLabel (optional) text field label
     * @param string $callback (optional) function that returns value to display
     */
    public function MoodleQuickForm_staticcallback($elementName = null, $elementLabel = null, $callback = null) {
        parent::MoodleQuickForm_static($elementName, $elementLabel, '');
        $this->callback = $callback;
        $this->_text = html_writer::tag('em', get_string('notanswered', 'totara_question'));
    }

    /**
     * Overriden rendering method
     * @param string $text
     * @return string
     */
    public function setText($text) {
        if (empty($text)) {
            return;
        }
        $this->_text = $text;
        if (is_object($this->callback) && $this->callback instanceof question_base) {
            $this->_text = $this->callback->to_html($text);
        } else if (is_callable($this->callback)) {
            $this->_text = $this->callback($text);
        }
    }
}

// Register question specific form element
MoodleQuickForm::registerElementType('staticcallback', "$CFG->dirroot/totara/question/lib.php", 'MoodleQuickForm_staticcallback');

/**
 * Simplifies rendering elements as much as possible
 */
class PdfForm_Renderer extends MoodleQuickForm_Renderer {
    public function __construct() {
        parent::MoodleQuickForm_Renderer();
        //var_dump($this->_elementTemplates);die();
        foreach($this->_elementTemplates as &$template) {
            if ($template != '') {
                $template = "\n\t\t<div>{label}: {element}</div>";
            }
        }
    }
}

class question_exception extends Exception {

}
