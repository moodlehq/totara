<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.


require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once('lib.php');
require_once "$CFG->dirroot/lib/formslib.php";

class dp_global_settings_form extends moodleform {
    function definition(){
        global $CFG;
        $mform =& $this->_form;

        $id = $this->_customdata['id'];
        $template = get_record('dp_template', 'id', $id);


        $mform->addElement('header', 'componentrenaming', get_string('componentrenaming', 'local_plan'));

        $components = array('course' ,'competency', 'objective');

        if($components) {
            $columns[] = 'component';
            $headers[] = get_string('component', 'local_plan');
            $columns[] = 'name';
            $headers[] = get_string('name', 'local_plan');

            $table = new flexible_table('components');
            $table->define_columns($columns);
            $table->define_headers($headers);

            $table->setup();

            foreach($components as $component) {
                $componentname = get_config(null, 'dp_'.$component);
                $tablerow = array();
                $tablerow[] = get_string($component.'_defaultname', 'local_plan');
                $tablerow[] = '<input id="comonentname['.$component.']" type="text" name="componentname['.$component.']" value="'.$componentname.'" />';

                $table->add_data($tablerow);
            }

            ob_start();

            print '<form method="post" action="global.php" class="plancomponents">';

            $table->print_html();

            print '<input type="submit" id="savechanges" name="save" value="'.get_string('savechanges').'" />';
            print '<input type="submit" id="cancel" name="cancel" value="'.get_string('cancel').'" />';

            print '</form>';

            $html = ob_get_contents();
            ob_end_clean();

        }
        $mform->addElement('html', '<center>'.$html.'</center>');

    }
}

$save = optional_param('save', false, PARAM_BOOL);

admin_externalpage_setup('manageglobal');

$returnurl = qualified_me();

if($save){
    if(update_plan_component_name('componentname')){
        totara_set_notification(get_string('update_components_settings', 'local_plan'), $returnurl, array('style' => 'notifysuccess'));
    } else {
        totara_set_notification(get_string('error:update_components_settings', 'local_plan'), $returnurl);
    }
}

admin_externalpage_print_header();

print_heading(get_string('globaldevelopmentplansettings', 'local_plan'));

$form = new dp_global_settings_form();
$form->display();



admin_externalpage_print_footer();


function update_plan_component_name($componentnameformelement){
    $formelementlist = optional_param($componentnameformelement, array(), PARAM_RAW);
    foreach( $formelementlist as $rawid=>$rawcomponentname ){
        $componenttype = clean_param($rawid, PARAM_ALPHA);
        $componentname = clean_param($rawcomponentname, PARAM_TEXT);

        if(!set_config('dp_'.$componenttype, $componentname))
            return false;
    }
    return true;
}



?>
