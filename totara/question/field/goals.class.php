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

class question_goals extends review {
    public function get_info() {
        return array('group' => question::GROUP_REVIEW, 'title' => get_string('questiontypegoals', 'totara_question'));
    }

    public function __construct($definition, $prefix, $subjectid = 0, $answerfield = '', $answerid = 0) {
        $this->reviewtitle = get_string('reviewyourgoals', 'totara_question');
        $this->buttonlabel = get_string('choosegoalreview', 'totara_question');

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
        $PAGE->requires->string_for_js('choosegoalreview', 'totara_question');

        $form_prefix = $this->get_prefix_form();

        // Check to see if there are any goals we can review
        $personalgoals = $DB->get_record('goal_personal', array('userid' => $this->subjectid), '*', IGNORE_MULTIPLE);
        $companygoals = $DB->get_record('goal_user_assignment', array('userid' => $this->subjectid), '*', IGNORE_MULTIPLE);

        if (!$personalgoals && !$companygoals) {
            $form->addElement('static', 'nogoals', '', get_string('nogoals', 'totara_question'));
            return;
        }

        $args = array('args' => '{"question_id":'.$this->id.', "answerid":'.$this->answerid.', "formprefix": "'.$form_prefix.'", "prefix": "'.$this->prefix.'", "subjectid": '.$this->subjectid.'}');
        $jsmodule = array(
            'name' => 'totara_user_goals',
            'fullpath' => '/totara/question/field/goals.js',
            'requires' => array('json'));
        $PAGE->requires->js_init_call('M.totara_user_goals.init', $args, false, $jsmodule);

        // TODO: Required to answer.
        if ($this->required) {
            // Mark fields as required.
            // Or just override edit_validate($fromform) function if it's impossible on this stage.
        }

        $sql = 'SELECT questdata.*, g.fullname FROM {'.$this->prefix.'_review_data} questdata
                JOIN {goal} g ON
                    questdata.itemid = g.id
                WHERE
                    questdata.'.$this->prefix.'questfieldid = ?
                AND questdata.scope = ?';

        $company_goal_items = $DB->get_records_sql($sql, array($this->id, 2));

        $sql = 'SELECT questdata.*, pg.name as fullname FROM {'.$this->prefix.'_review_data} questdata
                JOIN {goal_personal} pg ON
                    questdata.itemid = pg.id
                WHERE
                    questdata.'.$this->prefix.'questfieldid = ?
                AND questdata.scope = ?';

        $personal_goal_items = $DB->get_records_sql($sql, array($this->id, 1));

        $items = array_merge($company_goal_items, $personal_goal_items);

        $questions = array();

        // Add an answer flag for items that current user can answer
        foreach ($items as $itemid => $item) {
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
        $form->addElement('static', $form_prefix . '_review_goals', $this->name, $html);
        $this->render_without_label($form, $form_prefix.'_review_goals');
    }


    public function get_display_query($itemid) {
        $sql = '';
        $params = array();

        return array($sql, $params);
    }


    public function get_items_query() {
        return '';
    }
}
