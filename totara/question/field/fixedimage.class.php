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

class question_fixedimage extends question_base{
    public function get_info() {
        return array('group' => question::GROUP_OTHER, 'title' => get_string('questiontypefixedimage', 'totara_question'));
    }


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
     * Add database fields definition that represent current question
     *
     * @see question_base::get_xmldb()
     * @return array()
     */
    public function define_get(stdClass $toform) {
        if (!isset($toform)) {
            $toform = new stdClass();
        }

        if (isset($this->param1)) {
            $toform->image_filemanager = $this->param1['image'];
            $toform->description = $this->param1['description'];
        }

        return $toform;
    }


    /**
     * Set values from configuration form
     *
     * @param stdClass $fromform
     * @return stdClass $fromform
     */
    public function define_set(stdClass $fromform) {
        global $FILEPICKER_OPTIONS;
        $options = array();

        $name = 'image';
        $options = $FILEPICKER_OPTIONS;

        $itemid = rand();
        $component = 'totara_'.$this->prefix;

        $fromform = file_postupdate_standard_filemanager($fromform, $name, $options, $options['context'],
            $component, 'quest_fixedimage', $itemid);

        $options['image'] = $itemid;
        $options['description'] = isset($fromform->description) ? $fromform->description : '';

        $this->param1 = $options;
        return $this;
    }


    /**
     * Customfield specific settings elements
     *
     * @param MoodleQuickForm $form
     */
    protected function define_form(MoodleQuickForm $form) {
        global $FILEPICKER_OPTIONS;

        $options = $FILEPICKER_OPTIONS;
        $options['accepted_types'] = 'web_image';

        $form->addElement('filemanager', 'image_filemanager', get_string('image', 'totara_question'), null, $options);

        $form->addElement('textarea', 'description', get_string('description'), array('cols' => 60, 'rows' => 5));
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
        global $CFG, $FILEPICKER_OPTIONS;

        require_once($CFG->libdir . '/resourcelib.php');

        $fileid = $this->param1['image'];

        $contextid = $FILEPICKER_OPTIONS['context']->id;
        $content = '';

        // TODO: Using this prefix contruction means we can only use questions
        // in totara modules is this acceptable?
        $component = 'totara_' . $this->prefix;

        $fs = get_file_storage();
        $files = $fs->get_area_files($contextid, $component, 'quest_fixedimage', $fileid);
        foreach ($files as $draftfile) {
            $file_record = array('contextid'=>$contextid, 'component'=>$component, 'filearea'=>'quest_fixedimage_'.$fileid, 'itemid'=>$fileid, 'filepath'=>'/');
            if (!$draftfile->is_directory()) {
                $path = '/'.$contextid.'/'.$component.'/'.'quest_fixedimage_'.$this->id.$draftfile->get_filepath().$draftfile->get_itemid().'/'.$draftfile->get_filename();
                $fullurl = file_encode_url($CFG->wwwroot.'/pluginfile.php', $path, false);

                $title = '';
                $content .= resourcelib_embed_image($fullurl, $title);
            }
        }

        $form->addElement('static', $this->get_prefix_form(), $this->name, $content);
        $form->addElement('static', $this->get_prefix_form().'description', '', $this->param1['description']);

        // Remove label from form elements to get rid of empty space.
        $this->render_without_label($form, $this->get_prefix_form());
        $this->render_without_label($form, $this->get_prefix_form().'description');
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


    /**
     * Clone question properties (if they are stored in third party tables)
     * @param question_base $old old question instance
     */
    public function duplicate(question_base $old) {
        global $CFG;
        require_once($CFG->libdir . '/resourcelib.php');

        $olddescription = $old->param1['description'];
        $oldimageid = $old->param1['image'];

        // TODO: Dupilicate file area
    }
}
