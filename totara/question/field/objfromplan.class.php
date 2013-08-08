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

class question_objfromplan extends review{
    public function get_info() {
        return array('group' => question::GROUP_REVIEW, 'title' => get_string('questiontypeobjfromplan', 'totara_question'));
    }

    public function __construct($definition, $prefix, $subjectid = 0, $answerfield = '', $answerid = 0) {
        $this->reviewtitle = get_string('reviewyourlpobjectives', 'totara_question');
        $this->buttonlabel = get_string('chooseobjectivereview', 'totara_question');

        parent::__construct($definition, $prefix, $subjectid, $answerfield, $answerid);
    }

    /**
     * Add form elements that represent current field
     *
     * @see question_base::edit_form()
     * @param MoodleQuickForm $form Form to alter
     */
    public function edit_form(MoodleQuickForm $form) {
        global $PAGE, $DB;
        local_js(array(
            TOTARA_JS_DIALOG,
            TOTARA_JS_TREEVIEW
        ));

        $PAGE->requires->string_for_js('add', 'moodle');
        $PAGE->requires->strings_for_js(array('chooseobjectivereview', 'removeconfirm'), 'totara_question');

        $form_prefix = $this->get_prefix_form();

        $plan = $DB->get_record('dp_plan', array('userid' => $this->subjectid), '*', IGNORE_MULTIPLE);

        if (!$plan) {
            $form->addElement('static', 'noplans', '', get_string('noobjectiveplans', 'totara_question'));
            return;
        }

        $args = array('args' => '{"plan_id":'.$plan->id.',"question_id":'.$this->id.', "answerid":'.$this->answerid.', "formprefix": "'.$form_prefix.'", "prefix": "'.$this->prefix.'", "subjectid": '.$this->subjectid.'}');
        $jsmodule = array(
            'name' => 'totara_plan_objective',
            'fullpath' => '/totara/question/field/objfromplan.js',
            'requires' => array('json'));
        $PAGE->requires->js_init_call('M.totara_plan_objective.init', $args, false, $jsmodule);

        // TODO: Required to answer.
        if ($this->required) {
            // Mark fields as required.
            // Or just override edit_validate($fromform) function if it's impossible on this stage.
        }

        // Get item data for question
        $sql = $this->get_items_query();
        $items = $DB->get_records_sql($sql, array($this->id));

        $questions = array();

        // Add an answer flag for items that current user can answer
        foreach ($items as $itemid => $item) {
            $answerfield = $this->answerfield;
            if ($this->cananswer) {
                $item->cananswer = true;
                $questions[$item->itemid] = $item;
            } else if (!isset($questions[$item->itemid])) {
                $questions[$item->itemid] = $item;
            }
        }

        $this->edit_set(new stdClass(), 'db');
        $renderer = $PAGE->get_renderer('totara_appraisal');
        $html = $renderer->display_review_items($questions, $form_prefix, $this->roleinfo);
        $form->addElement('static', $form_prefix . '_review_objectives', $this->name, $html);
        $this->render_without_label($form, $form_prefix.'_review_objectives');
    }


    public function get_display_query($itemid) {
        $sql = 'SELECT po.fullname FROM {'.$this->prefix.'_review_data} questdata
            JOIN {dp_plan_objective} po ON questdata.itemid = po.id
            WHERE questdata.id = ?';
        $params = array($itemid);

        return array($sql, $params);
    }


    public function get_items_query() {
        $sql = 'SELECT questdata.*, po.fullname FROM {'.$this->prefix.'_review_data} questdata
                JOIN {dp_plan_objective} po ON
                    questdata.itemid = po.id
                WHERE
                    questdata.'.$this->prefix.'questfieldid = ?';

        return $sql;
    }
}
