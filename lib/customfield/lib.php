<?php //$Id$

/**
 * Base class for the custom fields.
 */
class customfield_base {

    /// These 2 variables are really what we're interested in.
    /// Everything else can be extracted from them
    var $fieldid;
    var $featureid;
    var $tableprefix;
    var $depthid;
    
    var $field;
    var $inputname;
    var $data;

    /**
     * Constructor method.
     * @param   integer   field id from the _info_field table
     * @param   integer   id using the data
     */
    function customfield_base($fieldid=0, $featureid=0, $feature, $tableprefix) {
        $this->set_fieldid($fieldid);
        $this->set_featureid($featureid);
        $this->load_data($featureid, $feature, $tableprefix);
    }


/***** The following methods must be overwritten by child classes *****/

    /**
     * Abstract method: Adds the custom field to the moodle form class
     * @param  form  instance of the moodleform class
     */
    function edit_field_add(&$mform) {
        error('This abstract method must be overriden');
    }

    
/***** The following methods may be overwritten by child classes *****/

    /**
     * Display the data for this field
     */
    function display_data() {
        $options->para = false;
        return format_text($this->data, FORMAT_MOODLE, $options);
    }
    
    /**
     * Print out the form field in the edit page
     * @param   object   instance of the moodleform class
     * $return  boolean
     */
    function edit_field(&$mform) {

        if ($this->field->hidden == false) {
            $this->edit_field_add($mform);
            $this->edit_field_set_default($mform);
            $this->edit_field_set_required($mform);
            return true;
        }
        return false;
    }

    /**
     * Tweaks the edit form
     * @param   object   instance of the moodleform class
     * $return  boolean
     */
    function edit_after_data(&$mform) {

        if ($this->field->hidden == false) {
            $this->edit_field_set_locked($mform);
            return true;
        }
        return false;
    }

    /**
     * Saves the data coming from form
     * @param   mixed   data coming from the form
     * @param   string  name of the feature (ie, competency)
     * @return  mixed   returns data id if success of db insert/update, false on fail, 0 if not permitted
     */
    function edit_save_data($featurenew, $tableprefix, $feature) {

        if (!isset($featurenew->{$this->inputname})) {
            // field not present in form, probably locked and invisible - skip it
            return;
        }
        
        $featurenew->{$this->inputname} = $this->edit_save_data_preprocess($featurenew->{$this->inputname});

        $data = new object();
        $data->{$feature.'id'}  = $featurenew->id;
        $data->fieldid          = $this->field->id;
        $data->data             = $featurenew->{$this->inputname};

        if ($dataid = get_field($tableprefix.'_info_data', 'id', $feature.'id', $data->{$feature.'id'}, 'fieldid', $data->fieldid)) {
            $data->id = $dataid;
            if (!update_record($tableprefix.'_info_data', $data)) {
                error('Error updating custom field!');
            }
        } else {
            insert_record($tableprefix.'_info_data', $data);
        }
    }

    /**
     * Validate the form field from edit page
     * @return  string  contains error message otherwise NULL
     **/
    function edit_validate_field($featurenew) {
        $errors = array();
        /// Check for uniqueness of data if required
        if ($this->is_unique()) {
            if ($featureid = get_field($tableprefix.'_info_data', 'featureid', 'fieldid', $this->field->id, 'data', $featurenew->{$this->inputname})) {
                if ($featureid != $featurenew->id) {
                    $errors["{$this->inputname}"] = get_string('valuealreadyused');
                }
            }
        }
        return $errors;
    }

    /**
     * Sets the default data for the field in the form object
     * @param   object   instance of the moodleform class
     */
    function edit_field_set_default(&$mform) {
        if (!empty($default)) {
            $mform->setDefault($this->inputname, $this->field->defaultdata);
        }
    }

    /**
     * Sets the required flag for the field in the form object
     * @param   object   instance of the moodleform class
     */
    function edit_field_set_required(&$mform) {
        if ($this->is_required()) {
            $mform->addRule($this->inputname, get_string('required'), 'required', null, 'client');
        }
    }

    /**
     * HardFreeze the field if locked.
     * @param   object   instance of the moodleform class
     */
    function edit_field_set_locked(&$mform) {
        if (!$mform->elementExists($this->inputname)) {
            return;
        }
        if ($this->is_locked()) {
            $mform->hardFreeze($this->inputname);
            $mform->setConstant($this->inputname, $this->data);
        }
    }

    /**
     * Hook for child classess to process the data before it gets saved in database
     * @param   mixed
     * @return  mixed
     */
    function edit_save_data_preprocess($data) {
        return $data;
    }

    /**
     * Loads an object with data for this field ready for the edit form
     * form
     * @param   object a object
     */
    function edit_load_feature_data(&$feature) {
        if ($this->data !== NULL) {
            $feature->{$this->inputname} = $this->data;
        }
    }

    /**
     * Check if the field data should be loaded into the object
     * By default it is, but for field types where the data may be potentially
     * large, the child class should override this and return false
     * @return boolean
     */
    function is_object_data() {
        return true;
    }


/***** The following methods generally should not be overwritten by child classes *****/
   
    /**
     * Accessor method: set the featureid for this instance
     * @param   integer   id from the feature table
     */
    function set_featureid($featureid) {
        $this->featureid = $featureid;
    }

    /**
     * Accessor method: set the fieldid for this instance
     * @param   integer   id from the _info_field table
     */
    function set_fieldid($fieldid) {
        $this->fieldid = $fieldid;
    }

    /**
     * Accessor method: Load the field record and feature data and tableprefix associated with the feature
     * object's fieldid and featureid
     */
    function load_data($featureid, $feature, $tableprefix) {
        /// Load the field object
        if (($this->fieldid == 0) or (!($field = get_record($tableprefix.'_info_field', 'id', $this->fieldid)))) {
            $this->field = NULL;
            $this->inputname = '';
        } else {
            $this->field = $field;
            $this->inputname = 'customfield_'.$field->shortname;
        }

        if (!empty($this->field)) {
            if ($datafield = get_field($tableprefix.'_info_data', 'data', $feature.'id', $this->featureid, 'fieldid', $this->fieldid)) {
                $this->data = $datafield;
            } else {
                $this->data = $this->field->defaultdata;
            }
        } else {
            $this->data = NULL;
        }
    }

    /**
     * Check if the field data is hidden to the current feature 
     * @return  boolean
     */
    function is_hidden() {

        if($this->field->hidden) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check if the field data is considered empty
     * return boolean
     */
    function is_empty() {
        return ( ($this->data != '0') and empty($this->data));
    }

    /**
     * Check if the field is required on the edit page
     * @return   boolean
     */
    function is_required() {
        return (boolean)$this->field->required;
    }

    /**
     * Check if the field is locked on the edit page
     * @return   boolean
     */
    function is_locked() {
        return (boolean)$this->field->locked;
    }

    /**
     * Check if the field data should be unique
     * @return   boolean
     */
    function is_unique() {
        return (boolean)$this->field->forceunique;
    }

} /// End of class efinition


/***** General purpose functions for custom fields *****/

function customfield_load_data(&$feature, $featurename, $tableprefix) {
    global $CFG;
    $depthstr = '';
    if ($feature->depthid) {
        $depthstr = "depthid='$feature->depthid'";
    }
    if ($fields = get_records_select($tableprefix.'_info_field', $depthstr)) {
        foreach ($fields as $field) {
            require_once($CFG->dirroot.'/lib/customfield/field/'.$field->datatype.'/field.class.php');
            $newfield = 'customfield_'.$field->datatype;
            $formfield = new $newfield($field->id, $feature->id, $featurename, $tableprefix);
            $formfield->edit_load_feature_data($feature);
        }
    }
}

/**
 * Print out the customisable categories and fields
 * @param  object  instance of the moodleform class
 */
function customfield_definition(&$mform, $featureid, $feature, $depthid=0, $tableprefix) {
    global $CFG;

    $depthstr = '';
    if ($depthid) {
        $depthstr = "depthid='$depthid'";
    }
    if ($categories = get_records_select($tableprefix.'_info_category', $depthstr, 'sortorder ASC')) {
        foreach ($categories as $category) {
            if ($fields = get_records_select($tableprefix.'_info_field', "categoryid=$category->id", 'sortorder ASC')) {

                // check first if *any* fields will be displayed
                $display = false;
                foreach ($fields as $field) {
                    if ($field->hidden == false) {
                        $display = true;
                    }   
                }   

                // display the header and the fields
                if ($display) {
                    $mform->addElement('header', 'category_'.$category->id, format_string($category->name));
                    foreach ($fields as $field) {
                        require_once($CFG->dirroot.'/lib/customfield/field/'.$field->datatype.'/field.class.php');
                        $newfield = 'customfield_'.$field->datatype;
                        $formfield = new $newfield($field->id, $featureid, $feature, $tableprefix);
                        $formfield->edit_field($mform);
                    }   
                }   
            }   
        }   
    }   
}

function customfield_definition_after_data(&$mform, $featureid, $feature, $depthid=0, $tableprefix) {
    global $CFG;

    $depthstr = '';
    if ($depthid) {
        $depthstr = 'depthid='.$depthid;
    }

    if ($fields = get_records_select($tableprefix.'_info_field', $depthstr)) {
        foreach ($fields as $field) {
            require_once($CFG->dirroot.'/lib/customfield/field/'.$field->datatype.'/field.class.php');
            $newfield = 'customfield_'.$field->datatype;
            $formfield = new $newfield($field->id, $featureid, $feature, $tableprefix);
            $formfield->edit_after_data($mform);
        }
    }
}

function customfield_validation($featurenew, $featurename, $tableprefix) {
    global $CFG;

    $err = array();

    $depthstr = '';
    if ($featurenew->depthid) {
        $depthstr = 'depthid='.$featurenew->depthid;
    }

    if ($fields = get_records_select($tableprefix.'_info_field', $depthstr)) {
        foreach ($fields as $field) {
            require_once($CFG->dirroot.'/lib/customfield/field/'.$field->datatype.'/field.class.php');
            $newfield = 'customfield_'.$field->datatype;
            $formfield = new $newfield($field->id, $featurenew->id, $featurename, $tableprefix);
            $err += $formfield->edit_validate_field($featurenew);
        }
    }
    return $err;
}

function customfield_save_data($featurenew, $tableprefix, $feature) {
    global $CFG;

    $depthstr = '';
    if ($featurenew->depthid) {
        $depthstr = 'depthid='.$featurenew->depthid;
    }

    if ($fields = get_records_select($tableprefix.'_info_field', $depthstr)) {
        foreach ($fields as $field) {
            require_once($CFG->dirroot.'/lib/customfield/field/'.$field->datatype.'/field.class.php');
            $newfield = 'customfield_'.$field->datatype;
            $formfield = new $newfield($field->id, $featurenew->id, $feature, $tableprefix);
            $formfield->edit_save_data($featurenew, $tableprefix, $feature);
        }
    }
}

function customfield_display_fields($featureid, $tableprefix) {
    global $CFG;
    if ($categories = get_records_select($tableprefix.'_info_category', '', 'sortorder ASC')) {
        foreach ($categories as $category) {
            if ($fields = get_records_select($tableprefix.'_info_field', "categoryid=$category->id", 'sortorder ASC')) {
                foreach ($fields as $field) {
                    require_once($CFG->dirroot.'/lib/customfield/field/'.$field->datatype.'/field.class.php');
                    $newfield = 'customfield_'.$field->datatype;
                    $formfield = new $newfield($field->id, $featureid);
                    if (!$formfield->is_hidden() and !$formfield->is_empty()) {
                        print_row(s($formfield->field->name.':'), $formfield->display_data());
                    }
                }
            }
        }
    }
}

/**
 * Returns an object with the custom fields set for the given id
 * @param  integer  id
 * @return  object
 */
function customfield_record($id, $tableprefix) {
    global $CFG;
    $feature = new object();

    if ($fields = get_records_select($tableprefix.'_info_field')) {
        foreach ($fields as $field) {
            require_once($CFG->dirroot.'/lib/customfield/field/'.$field->datatype.'/field.class.php');
            $newfield = 'customfield_'.$field->datatype;
            $formfield = new $newfield($field->id, $id);
            if ($formfield->is_object_data()) $feature->{$field->shortname} = $formfield->data;
        }
    }

    return $feature;
}
