<?php

/**
 * URL used as reference for form creation below:
 * http://docs.moodle.org/dev/lib/formslib.php_Form_Definition#definition.28.29
 *
 * Todo:
 *  - it would be useful to apply an incremental className to form groups, to ctrl
 *    spacing between stacked groups, eg; 'class="felement fgroup fgroup1"'
 **/

require_once(dirname(__FILE__) . '/../../config.php');

require_once($CFG->dirroot.'/lib/formslib.php');


$strheading = 'Element Library: Moodle Forms';
$url = new moodle_url('/theme/elements/moodleforms.php');

// Start setting up the page
$params = array();
$PAGE->set_context(get_system_context());
$PAGE->set_url($url);
$PAGE->set_title($strheading);
$PAGE->set_heading($strheading);

require_login();
echo $OUTPUT->header();

echo $OUTPUT->heading($strheading);

echo $OUTPUT->box_start();
echo $OUTPUT->container('Examples of different types of form.');
echo $OUTPUT->container_start();


// combo form - grouped controls
echo html_writer::empty_tag('hr');
echo $OUTPUT->heading('Grouped Combo form with mixed controls (class "comboform")', 3);

class combo_form_grouped extends moodleform {

    // Define the form
    function definition() {

        $mform =& $this->_form;

        /// Add some extra hidden fields
        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);

        /// Print the required moodle fields first
        $mform->addElement('header', null, 'form_legend');

        // no 'size' attribute, use CSS definitions
        $mform->addElement('text', 'username', 'text_field_name');
        $mform->addRule('username', 'Custom validation feedback here.', 'required', null, 'client');
        $mform->setType('username', PARAM_RAW);

        $mform->addElement('passwordunmask', 'newpassword','password_field_name');
        $mform->addHelpButton('newpassword', 'newpassword');
        $mform->setType('newpassword', PARAM_RAW);

        $mform->addElement('text', 'email', 'email_field_name');
        $mform->addRule('email', 'Custom validation feedback here.', 'required', null, 'client');
        $mform->addRule('email', 'Invalid email address', 'email', null, 'client');
        $mform->setType('email', PARAM_RAW);
        $mform->addHelpButton('email', 'chooseauthmethod', 'auth');

        $mform->addElement('date_selector', 'timedurationuntil_3', 'date_selector');

        $mform->addElement('radio', 'state_toggler', 'ungrouped_radio', 'options_disabled', 0);
        $mform->addElement('radio', 'state_toggler', 'ungrouped_radio', 'options_enabled', 1);

        // create some advanced elements
        $mform->addElement('editor', 'description', 'text_editor');
        $mform->setType('description', PARAM_RAW);
        $mform->setAdvanced('description');

        $mform->addElement('date_time_selector', 'timedurationuntil', 'select_a_date');
        $mform->setAdvanced('timedurationuntil');

        $mform->addElement('text', 'timedurationminutes', 'a_text_field');
        $mform->setType('timedurationminutes', PARAM_INT);
        $mform->setAdvanced('timedurationminutes');

        // create some grouped controls, and use setAdvanced
        $radioGroup=array();
        $radioGroup[] =& $mform->createElement('radio', 'more_radio', 'radio_group_name', 'radio_a', 0);
        $radioGroup[] =& $mform->createElement('radio', 'more_radio', null, 'radio_b', 1);
        $mform->addGroup($radioGroup, 'controls', 'a_group_of_radios', array('<br />'), false);
        $mform->setAdvanced('controls');

        $mform->addElement('textarea', 'desc', 'textarea', array('cols'=>'25', 'rows'=>'5'));
        $mform->setType('desc', PARAM_TEXT);
        $mform->setAdvanced('desc');

        $checkboxGroup=array();
        $checkboxGroup[] =& $mform->createElement('advcheckbox', 'test1', 'more_checkbox', 'checkbox_desc', array('group' => 1));
        $checkboxGroup[] =& $mform->createElement('advcheckbox', 'test2', 'more_checkbox', 'checkbox_desc', array('group' => 1));
        $checkboxGroup[] =& $mform->createElement('advcheckbox', 'test3', 'more_checkbox', 'checkbox_desc', array('group' => 1));
        $checkboxGroup[] =& $mform->createElement('advcheckbox', 'test4', 'more_checkbox', 'checkbox_desc', array('group' => 1));
        $mform->setDefault('test1', 1);
        $mform->addGroup($checkboxGroup, 'more_checkbox', 'a_group_of_checkboxes', array('<br />'), false);
        $mform->setAdvanced('more_checkbox');

        $checkboxGroup2=array();
        $checkboxGroup2[] =& $mform->createElement('advcheckbox', 'test5', 'more_checkbox_2', 'checkbox_desc', array('group' => 2));
        $checkboxGroup2[] =& $mform->createElement('advcheckbox', 'test6', 'more_checkbox_2', 'checkbox_desc', array('group' => 2));
        $checkboxGroup2[] =& $mform->createElement('advcheckbox', 'test7', 'more_checkbox_2', 'checkbox_desc', array('group' => 2));
        $checkboxGroup2[] =& $mform->createElement('advcheckbox', 'test8', 'more_checkbox_2', 'checkbox_desc', array('group' => 2));
        $mform->addGroup($checkboxGroup2, 'more_checkbox_2', 'another_group_of_checkboxes', array(''), false);
        $mform->setAdvanced('more_checkbox_2');

        $mform->addElement('select', 'auth', 'select_menu_name', array('Option 1','Option 2','Option 3'));
        $mform->setAdvanced('auth');

        $sel = $mform->addElement('select', 'colors', 'selector_name', array('sunset red', 'azure blue', 'cyanic green'));
        $sel->setMultiple(true);
        $mform->setAdvanced('colors');

        $this->add_action_buttons(true, get_string('savechanges'));

        $oldclass = $mform->getAttribute('class');
        if (!empty($oldclass)){
            $mform->updateAttributes(array('class'=>$oldclass.' comboform'));
        }else {
            $mform->updateAttributes(array('class'=>'comboform'));
        }
    }

}
$form = new combo_form_grouped();
$data = $form->get_data(); // enables server validation
echo html_writer::start_tag('div', array('class'=>'yui3-g') );
  echo html_writer::start_tag('div', array('class'=>'yui3-u-2-3') );
  $form->display();
  echo html_writer::end_tag('div');
  echo html_writer::tag('div', '
<strong>Notes about this form:</strong>
', array('class'=>'yui3-u-1-3') );
echo html_writer::end_tag('div');// close yui grid

// combo form - ungrouped controls
echo html_writer::empty_tag('hr');
echo $OUTPUT->heading('Ungrouped Combo form with mixed controls (class "comboform")', 3);

class combo_form_ungrouped extends moodleform {

    // Define the form
    function definition() {

        $mform =& $this->_form;

        /// Add some extra hidden fields
        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);

        /// Print the required moodle fields first
        $mform->addElement('header', null, 'form_legend');

        // no 'size' attribute, use CSS definitions
        $mform->addElement('text', 'username_2', 'text_field_name');
        $mform->addRule('username_2', 'Custom validation feedback here.', 'required', null, 'client');
        $mform->setType('username_2', PARAM_RAW);

        $mform->addElement('passwordunmask', 'newpassword_2','password_field_name');
        $mform->addHelpButton('newpassword_2', 'newpassword');
        $mform->setType('newpassword_2', PARAM_RAW);

        $mform->addElement('radio', 'state_toggler_2', 'ungrouped_radio_2', 'options_disabled', 0);
        $mform->addElement('radio', 'state_toggler_2', 'ungrouped_radio_2', 'options_enabled', 1);

        // series of controls whose enabled state depends on the radio control above
        $mform->addElement('date_time_selector', 'timedurationuntil_2', 'date_selector');
        $mform->disabledIf('timedurationuntil_2','state_toggler_2','noteq', 1);

        $mform->addElement('text', 'timedurationminutes_2', 'a_text_field');
        $mform->setType('timedurationminutes_2', PARAM_INT);
        $mform->disabledIf('timedurationminutes_2','state_toggler_2','noteq', 1);

        $radioGroup=array();
        $radioGroup[] =& $mform->createElement('radio', 'more_radio_2', '', 'Foo', 1);
        $radioGroup[] =& $mform->createElement('radio', 'more_radio_2', '', 'Bar', 0);
        $mform->addGroup($radioGroup, 'more_radio_2', 'a_group_of_radios', array('<br />'), false);
        $mform->disabledIf('more_radio_2','state_toggler_2','noteq', 1);

        // no 3rd arg for rows/cols, use CSS definitions
        $mform->addElement('editor', 'description_2', 'text_editor');
        $mform->setType('description_2', PARAM_RAW);
        $mform->addHelpButton('description_2', 'coursesummary');
        $mform->disabledIf('description_2','state_toggler_2','noteq', 1); // TinyMCE can't be disabled currently: http://tracker.moodle.org/browse/MDL-25067

        $mform->addElement('textarea', 'desc_2', 'textarea', array('cols'=>'25', 'rows'=>'5'));
        $mform->setType('desc_2', PARAM_TEXT);
        $mform->disabledIf('desc_2','state_toggler_2','noteq', 1); // TinyMCE can't be disabled currently: http://tracker.moodle.org/browse/MDL-25067

        $mform->addElement('checkbox', 'groupmembersonly_2', 'checkbox_name_2', 'always_has_a_desc');
        $mform->addHelpButton('groupmembersonly_2', 'groupmembersonly', 'group');
        $mform->disabledIf('groupmembersonly_2','state_toggler_2','noteq', 1);

        $mform->addElement('select', 'auth_2', 'select_menu_name_2', array('Option 1','Option 2','Option 3'));
        $mform->addHelpButton('auth_2', 'chooseauthmethod', 'auth');
        $mform->disabledIf('auth_2','state_toggler_2','noteq', 1);

        $select = &$mform->addElement('select', 'colors_2', 'selector_name', array('sunset red', 'azure blue', 'cyanic green'));
        $select->setMultiple(true);
        $mform->disabledIf('colors_2','state_toggler_2','noteq', 1);

        // submit
        $this->add_action_buttons(false, get_string('savechanges'));

        $oldclass = $mform->getAttribute('class');
        if (!empty($oldclass)){
            $mform->updateAttributes(array('class'=>$oldclass.' comboform'));
        }else {
            $mform->updateAttributes(array('class'=>'comboform'));
        }
    }

}
$form = new combo_form_ungrouped();
$data = $form->get_data();
echo html_writer::start_tag('div', array('class'=>'yui3-g') );
  echo html_writer::start_tag('div', array('class'=>'yui3-u-2-3') );
  $form->display();
  echo html_writer::end_tag('div');
  echo html_writer::tag('div', '
<strong>Notes about this form:</strong>
', array('class'=>'yui3-u-1-3') );
echo html_writer::end_tag('div');// close yui grid


//
echo html_writer::empty_tag('hr');
echo $OUTPUT->heading('Tabular form (class "tabularform")', 3);

class tabular_form extends moodleform {

    // Define the form
    function definition() {

        $mform =& $this->_form;
        $renderer =& $mform->defaultRenderer();

        // $renderer->clearAllTemplates()  might be useful here depending on requirements

        // limitation - we can't use the 'html_writer:table()' or 'flexible_table()' methods?
        $thead_row = html_writer::tag('thead', html_writer::tag('tr', html_writer::tag('th','Select', array('class'=>'header c0', 'scope'=>'col')) . html_writer::tag('th','Item', array('class'=>'header c1', 'scope'=>'col')) ) );
        $template_wrap = html_writer::tag('table', $thead_row . '{content}', array('class' => 'generaltable fcontainer') );
        $template_element = html_writer::tag('tr', html_writer::tag('td', '<!-- END error -->{element}', array('class' => 'felement')) . html_writer::tag('td', '<!-- BEGIN required -->' . $mform->getReqHTML() . '<!-- END required -->{label}', array('class' => 'fitemtitle')), array('class' => 'fitem') );

        $renderer->setGroupTemplate($template_wrap, 'tabular_checkboxes');
        $renderer->setGroupElementTemplate($template_element, 'tabular_checkboxes');

        $controlGroup=array();
        $controlGroup[] =& $mform->createElement('checkbox', 'tabular_checkbox1', 'checkbox_name');
        $controlGroup[] =& $mform->createElement('checkbox', 'tabular_checkbox2', 'checkbox_name');
        $controlGroup[] =& $mform->createElement('checkbox', 'tabular_checkbox3', 'checkbox_name');
        $controlGroup[] =& $mform->createElement('checkbox', 'tabular_checkbox4', 'checkbox_name');
        $controlGroup[] =& $mform->createElement('checkbox', 'tabular_checkbox5', 'checkbox_name');

        $mform->addGroup($controlGroup, 'tabular_checkboxes', '', array(' '), false);

        $mform->addElement('submit', 'submit_btn', 'Submit');

        $oldclass = $mform->getAttribute('class');
        if (!empty($oldclass)){
            $mform->updateAttributes(array('class'=>$oldclass.' tabularform'));
        }else {
            $mform->updateAttributes(array('class'=>'tabularform'));
        }
    }

}
$form = new tabular_form();
$data = $form->get_data();
echo html_writer::start_tag('div', array('class'=>'yui3-g') );
  echo html_writer::start_tag('div', array('class'=>'yui3-u-2-3') );
  $form->display();
  echo html_writer::end_tag('div');
  echo html_writer::tag('div', '
<strong>Notes about this form:</strong>
', array('class'=>'yui3-u-1-3') );
echo html_writer::end_tag('div');// close yui grid



//
echo html_writer::empty_tag('hr');
echo $OUTPUT->heading('Form with grouped \'action\' controls above \'data\' controls (class "actionform"), by providing new template markup to the Renderer.', 3);

class action_form extends moodleform {

    // Define the form
    function definition() {

        $mform =& $this->_form;
        $renderer =& $mform->defaultRenderer();

        // 'action' controls grouped together here
        $template_a_wrap = html_writer::tag('div', '{content}', array('class' => 'fcontainer actionform') );
        $template_a_element = html_writer::tag('div', html_writer::tag('div', '<!-- BEGIN required -->' . $mform->getReqHTML() . '<!-- END required -->{label}', array('class' => 'fitemtitle')) . html_writer::tag('div', '<!-- END error -->{element}', array('class' => 'felement')), array('class' => 'fitem') );

        $renderer->setGroupTemplate($template_a_wrap, 'action_group');
        $renderer->setGroupElementTemplate($template_a_element, 'action_group');

        $group=array();
        $group[] =& $mform->createElement('date_time_selector', 'date_select', 'Choose a date:'); // grouped date_time_selector objects don't run the JS enhancement?
        $c1 = $mform->createElement('text', 'text_entry', 'Search term:');
        $mform->setType('text_entry', PARAM_INT);
        $group[] =& $c1;
        $c2 = $mform->createElement('checkbox', 'action_group_checkbox', 'checkbox_name');
        $group[] =& $c2;
        $group[] =& $mform->createElement('select', 'action_group_auth', 'select_menu_name', array('Option 1','Option 2','Option 3'));

        $mform->addGroup($group, 'action_group', '', array(' '), false);
        $mform->addElement('submit', 'submit_btn_2', 'Submit');

        // render the table containing more controls
        $thead_row = html_writer::tag('thead', html_writer::tag('tr', html_writer::tag('th','Select', array('class'=>'header c0', 'scope'=>'col')) . html_writer::tag('th','Item', array('class'=>'header c1', 'scope'=>'col')) ) );
        $template_b_wrap = html_writer::tag('table', $thead_row . '{content}', array('class' => 'generaltable fcontainer') );
        $template_b_element = html_writer::tag('tr', html_writer::tag('td', '<!-- END error -->{element}', array('class' => 'felement')) . html_writer::tag('td', '<!-- BEGIN required -->' . $mform->getReqHTML() . '<!-- END required -->{help}{label}', array('class' => 'fitemtitle')), array('class' => 'fitem') );

        $renderer->setGroupTemplate($template_b_wrap, 'tabular_checkboxes_2');
        $renderer->setGroupElementTemplate($template_b_element, 'tabular_checkboxes_2');

        $group=array();
        $group[] =& $mform->createElement('checkbox', 'tabular_checkbox6', 'checkbox_name');
        $group[] =& $mform->createElement('checkbox', 'tabular_checkbox7', 'checkbox_name');
        $group[] =& $mform->createElement('checkbox', 'tabular_checkbox8', 'checkbox_name');
        $group[] =& $mform->createElement('checkbox', 'tabular_checkbox9', 'checkbox_name');
        $group[] =& $mform->createElement('checkbox', 'tabular_checkbox10', 'checkbox_name');

        $mform->addGroup($group, 'tabular_checkboxes_2', '', array(' '), false);

    }
}
$form = new action_form(); // shouldn't this have an 'id' attribute of 'tabular_form'? ref. /lib/formslib.php:123
$data = $form->get_data();
echo html_writer::start_tag('div', array('class'=>'yui3-g') );
  echo html_writer::start_tag('div', array('class'=>'yui3-u-2-3') );
  $form->display();
  echo html_writer::end_tag('div');
  echo html_writer::tag('div', '
<strong>Notes about this form:</strong>
', array('class'=>'yui3-u-1-3') );
echo html_writer::end_tag('div');// close yui grid


//
echo html_writer::empty_tag('hr');
echo $OUTPUT->heading('Minimal forms', 3);

class minimal_form extends moodleform {

    // Define the form
    function definition() {

        $mform =& $this->_form;

        switch( $this->_customdata['type'] ){
            case 'search' :
                $mform->addElement('text', 'search');
                $mform->setType('search', PARAM_RAW);
                $mform->addElement('submit', 'search_btn', 'Go');
                break;
            case 'single_button' :
                $this->add_action_buttons(false, 'Turn editing on');
                break;
            default:
                break;
        }
    }
}
//
echo html_writer::empty_tag('hr');
$form = new minimal_form( null, array('type'=>'search') );
$data = $form->get_data();
echo html_writer::start_tag('div', array('class'=>'yui3-g') );
  echo html_writer::start_tag('div', array('class'=>'yui3-u-2-3') );
  $form->display();
  echo html_writer::end_tag('div');
  echo html_writer::tag('div','
<strong>Notes about this form:</strong>
', array('class'=>'yui3-u-1-3') );
echo html_writer::end_tag('div');// close yui grid

//
echo html_writer::empty_tag('hr');
$form = new minimal_form( null, array('type'=>'single_button') );
$data = $form->get_data();
echo html_writer::start_tag('div', array('class'=>'yui3-g') );
  echo html_writer::start_tag('div', array('class'=>'yui3-u-2-3') );
  $form->display();
  echo html_writer::end_tag('div');
  echo html_writer::tag('div', '
<strong>Notes about this form:</strong>
', array('class'=>'yui3-u-1-3') );
echo html_writer::end_tag('div');// close yui grid




echo $OUTPUT->container_end();
echo $OUTPUT->box_end();
echo $OUTPUT->footer();
