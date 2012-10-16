<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2012 Totara Learning Solutions LTD
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
 * @author Ciaran Irvine <ciaran.irvine@totaralms.com>
 * @package totara
 * @subpackage totara_core
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

/**
* Standard HTML output renderer for totara_hierarchy module
*/
class totara_hierarchy_renderer extends plugin_renderer_base {

    /**
     * Outputs a table containing evidence for a this item
    *
    * @param object $item competency item
    * @param boolean $can_edit If the user has edit permissions
    * @param array $evidence array of evidence ids
    * @return string HTML to output.
    */
    public function print_competency_view_evidence($item, $evidence=null, $can_edit=false) {
        global $CFG;
        require_once($CFG->dirroot . '/totara/plan/lib.php');
        $out = $this->output->heading(get_string('evidenceitems', 'totara_hierarchy'));
        $out .= html_writer::start_tag('div', array('id' => 'evidence-list-container'));

        $table = new html_table();
        $table->attributes = array('class' => 'generalbox boxaligncenter list-evidence');
        $table->attributes['width'] = '95%';
        $table->attributes['cellpadding'] = '5';
        $table->attributes['cellspacing'] = '1';
        //set up table header
        $cells = array();
        $cell = new html_table_cell(get_string('name'));
        $cell->header = true;
        $cell->attributes['class'] = 'header c0';
        $cell->attributes['style'] = 'vertical-align:top; white-space:nowrap;';
        $cell->attributes['scope'] = 'col';
        $cells[] = $cell;
        if (!empty($CFG->competencyuseresourcelevelevidence)) {
            $cell = new html_table_cell(get_string('type', 'totara_hierarchy'));
            $cell->header = true;
            $cell->attributes['class'] = 'header c1';
            $cell->attributes['style'] = 'vertical-align:top; white-space:nowrap;';
            $cell->attributes['scope'] = 'col';
            $cells[] = $cell;
            $cell = new html_table_cell(get_string('activity'));
            $cell->header = true;
            $cell->attributes['class'] = 'header c2';
            $cell->attributes['style'] = 'vertical-align:top; white-space:nowrap;';
            $cell->attributes['scope'] = 'col';
            $cells[] = $cell;
        }
        if ($can_edit) {
            $cell = new html_table_cell(get_string('linktype', 'totara_plan'));
            $cell->header = true;
            $cell->attributes['class'] = 'header c4';
            $cell->attributes['style'] = 'vertical-align:top; text-align:center; white-space:nowrap;';
            $cell->attributes['scope'] = 'col';
            $cells[] = $cell;
            $cell = new html_table_cell(get_string('options', 'totara_hierarchy'));
            $cell->header = true;
            $cell->attributes['class'] = 'header c4';
            $cell->attributes['style'] = 'vertical-align:top; text-align:center; white-space:nowrap;';
            $cell->attributes['scope'] = 'col';
            $cells[] = $cell;
        }
        $table->data[] = new html_table_row($cells);
        //now the rows if any
        if ($evidence) {
            $oddeven = 1;
            foreach ($evidence as $eitem) {
                $cells = array();
                $oddeven = ++$oddeven % 2;
                $eitem = competency_evidence_type::factory((array)$eitem);
                $cells[] = new html_table_cell($eitem->get_name());
                if (!empty($CFG->competencyuseresourcelevelevidence)) {
                    $cells[] = new html_table_cell($eitem->get_type());
                    $cells[] = new html_table_cell($eitem->get_activity_type());
                }
                if ($can_edit) {

                    $content = html_writer::select(
                    array( //$options
                    PLAN_LINKTYPE_MANDATORY => get_string('mandatory','totara_hierarchy'),
                    PLAN_LINKTYPE_OPTIONAL => get_string('optional','totara_hierarchy'),
                    ),
                    'linktype', //$name,
                    (isset($eitem->linktype) ? $eitem->linktype : PLAN_LINKTYPE_OPTIONAL), //$selected,
                    false, //$nothing,
                    array('onchange' => "\$.get(".
                                "'{$CFG->wwwroot}/totara/plan/update-linktype.php".
                                "?type=course&c={$eitem->id}".
                                "&sesskey=".sesskey().
                                "&t=' + $(this).val()".
                            ");")
                    );

                    $cell = new html_table_cell($content);
                    $cell->attributes['style'] = 'text-align: center;';
                    $cells[] = $cell;
                    $str_remove = get_string('remove');
                    $link = $this->output->action_link(new moodle_url('/totara/hierarchy/prefix/competency/evidenceitem/remove.php', array('id' => $eitem->id)),
                    $this->output->pix_icon('t/delete', $str_remove), null, array('class' => 'iconsmall', 'title' => $str_remove));
                    $cell = new html_table_cell($link);
                    $cell->attributes['style'] = 'text-align: center;';
                    $cells[] = $cell;
                }

                $row = new html_table_row($cells);
                $row->attributes['class'] = 'r'.$oddeven;
                $table->data[] = $row;
            }

        } else {
            // # cols varies
            $cols = $can_edit ? 4 : 3;
            $cell = new html_table_cell(html_writer::start_tag('i') . get_string('noevidenceitems', 'totara_hierarchy') . html_writer::end_tag('i'));
            $cell->colspan = $cols;
            $row = new html_table_row(array($cell));
            $row->attributes['class'] = 'noitems-evidence';
            $table->data[] = $row;
        }
        $out .= html_writer::table($table);

        $out .= html_writer::end_tag('div');
        // Navigation / editing buttons
        $out .= html_writer::start_tag('div', array('class' => 'buttons'));

        $context = context_system::instance();
        $can_edit = has_capability('totara/hierarchy:updatecompetency', $context);
        // Display add evidence item button
        if ($can_edit) {
            $out .= html_writer::start_tag('div', array('class' => 'singlebutton'));

            $action = new moodle_url('/totara/hierarchy/prefix/competency/evidenceitem/edit.php', array('id' => $item->id));
            $out .= html_writer::start_tag('form', array('action' => $action->out(), 'method' => 'get'));
            $out .= html_writer::start_tag('div');
            if (!empty($CFG->competencyuseresourcelevelevidence)) {
                $btnstr = get_string('assignnewevidenceitem', 'totara_hierarchy');
            } else {
                $btnstr = get_string('assigncoursecompletions', 'totara_hierarchy');
            }
            $out .= html_writer::empty_tag('input', array('type' => 'submit', 'id' => "show-evidence-dialog", 'value' => $btnstr));
            $out .= html_writer::empty_tag('input', array('type' => 'hidden', 'name' => "id", 'value' => $item->id));
            $out .= html_writer::empty_tag('input', array('type' => 'hidden', 'name' => "nojs", 'value' => '1'));
            $out .= html_writer::empty_tag('input', array('type' => 'hidden', 'name' => "returnurl", 'value' => qualified_me()));
            $out .= html_writer::empty_tag('input', array('type' => 'hidden', 'name' => "s", 'value' => sesskey()));
            $out .= html_writer::end_tag('div');
            $out .= html_writer::end_tag('form');
            $out .= html_writer::end_tag('div');
        }
        $out .= html_writer::end_tag('div');
        return $out;
    }

    /**
    * Outputs a table containing competencies that are related to this item
    *
    * @param object $item competency item
    * @param boolean $can_edit If the user has edit permissions
    * @param array $related array of related items
    * @return string HTML to output.
    */
    public function print_competency_view_related($item, $can_edit=false, $related=null) {

        $out = $this->output->heading(get_string('relatedcompetencies', 'totara_hierarchy'));

        $table = new html_table();
        $table->attributes = array('id' => 'list-related', 'class' => 'generalbox boxaligncenter');
        $table->attributes['width'] = '95%';
        $table->attributes['cellpadding'] = '5';
        $table->attributes['cellspacing'] = '1';
        //set up table header
        $cells = array();
        $cell = new html_table_cell(get_string('competencyframework', 'totara_hierarchy'));
        $cell->header = true;
        $cell->attributes['class'] = 'header c0';
        $cell->attributes['style'] = 'vertical-align:top; white-space:nowrap;';
        $cell->attributes['scope'] = 'col';
        $cells[] = $cell;
        $cell = new html_table_cell(get_string('name'));
        $cell->header = true;
        $cell->attributes['class'] = 'header c1';
        $cell->attributes['style'] = 'vertical-align:top; white-space:nowrap;';
        $cell->attributes['scope'] = 'col';
        $cells[] = $cell;
        if ($can_edit) {
            $cell = new html_table_cell(get_string('options', 'totara_plan'));
            $cell->header = true;
            $cell->attributes['class'] = 'header c4';
            $cell->attributes['style'] = 'vertical-align:top; text-align:center; white-space:nowrap;';
            $cell->attributes['scope'] = 'col';
            $cells[] = $cell;
        }
        $table->data[] = new html_table_row($cells);
        //now the rows if any

        if ($related) {
            $sitecontext = context_system::instance();
            $can_manage_fw = has_capability('totara/hierarchy:updatecompetencyframeworks', $sitecontext);

            $oddeven = 1;
            foreach ($related as $ritem) {
                $cells = array();
                $framework_text = ($can_manage_fw) ?
                    $this->output->action_link(new moodle_url('/totara/hierarchy/index.php', array('prefix' => 'competency', 'frameworkid' => $ritem->fid)),
                    format_string($ritem->framework)) : format_string($ritem->framework);
                $oddeven = ++$oddeven % 2;

                $cells[] = new html_table_cell($framework_text);
                $link = html_writer::link(new moodle_url('/totara/hierarchy/item/view.php', array('prefix' => 'competency', 'id' => $ritem->id)), $ritem->fullname);
                $cells[] = new html_table_cell($link);

                if ($can_edit) {
                    $str_remove = get_string('remove');
                    $content = $this->output->action_link(new moodle_url("/totara/hierarchy/prefix/competency/related/remove.php", array('id' => $item->id, 'related' => $ritem->id)),
                         new pix_icon('t/delete', $str_remove), null, array('class' => 'iconsmall', 'title' => $str_remove));
                    $cell = new html_table_cell($content);
                    $cell->attributes['style'] = 'text-align: center;';
                    $cells[] = $cell;
                }
                $row = new html_table_row($cells);
                $row->attributes['class'] = 'r'.$oddeven;
                $table->data[] = $row;
            }

        } else {
            // # cols varies
            $cols = $can_edit ? 4 : 3;
            $cell = new html_table_cell(html_writer::start_tag('i') . get_string('norelatedcompetencies', 'totara_hierarchy') . html_writer::end_tag('i'));
            $cell->colspan = $cols;
            $row = new html_table_row(array($cell));
            $row->attributes['class'] = 'noitems-related';
            $table->data[] = $row;
        }
        $out .= html_writer::table($table);

        // Add related competencies button
        if ($can_edit) {
            $out .= html_writer::start_tag('div', array('class' => 'buttons'));
            $out .= html_writer::start_tag('div', array('class' => 'singlebutton'));

            $action = new moodle_url('/totara/hierarchy/prefix/competency/related/find.php', array('id' => $item->id, 'frameworkid' => $item->frameworkid));
            $out .= html_writer::start_tag('form', array('action' => $action->out(), 'method' => 'get'));
            $out .= html_writer::start_tag('div');
            $out .= html_writer::empty_tag('input', array('type' => 'submit', 'id' => "show-related-dialog", 'value' => get_string('assignrelatedcompetencies', 'totara_hierarchy')));
            $out .= html_writer::empty_tag('input', array('type' => 'hidden', 'name' => "id", 'value' => $item->id));
            $out .= html_writer::empty_tag('input', array('type' => 'hidden', 'name' => "nojs", 'value' => '1'));
            $out .= html_writer::empty_tag('input', array('type' => 'hidden', 'name' => "returnurl", 'value' => qualified_me()));
            $out .= html_writer::empty_tag('input', array('type' => 'hidden', 'name' => "s", 'value' => sesskey()));
            $out .= html_writer::empty_tag('input', array('type' => 'hidden', 'name' => "frameworkid", 'value' => $item->frameworkid));
            $out .= html_writer::end_tag('div');
            $out .= html_writer::end_tag('form');
            $out .= html_writer::end_tag('div');
            $out .= html_writer::end_tag('div');
        }

        return $out;
    }
    /**
    * Outputs a table containing items in this organisation
    *
    * @param int $framework current framework id
    * @param string $type shortprefix e.g. 'pos' or 'org'
    * @param string $displaytitle
    * @param moodle_url $addurl
    * @param int $itemid id of current item being viewed
    * @param array $items array of assigned competencies
    * @param boolean $can_edit if the user has edit permissions
    * @return string HTML to output.
    */
    function print_hierarchy_items($framework, $prefix, $shortprefix, $displaytitle, $addurl, $itemid, $items, $can_edit=false){
        global $CFG;

        require_once($CFG->libdir . '/tablelib.php');
        require_once($CFG->dirroot . '/totara/plan/lib.php');

        if ($displaytitle == 'assignedcompetencies') {
            $columns = array('type', 'name');
            $headers = array(
            get_string('type', 'totara_hierarchy'),
            get_string('name', 'totara_hierarchy')
            );
        } else if ($displaytitle == 'assignedcompetencytemplates') {
            $columns = array('name');
            $headers = array(
            get_string('name', 'totara_hierarchy'),
            );
        }
        $displayprefix = 'competency';

        if ($can_edit) {
            $str_edit = get_string('edit');
            $str_remove = get_string('remove');
            $columns[] = 'linktype';
            $headers[] = get_string('linktype', 'totara_plan');
            $columns[] = 'options';
            $headers[] = get_string('options', 'totara_hierarchy');
        }
        $out = '';
        if (is_array($items) && count($items)) {
            //output buffering because flexible_table uses echo() internally
            ob_start();
            $table = new flexible_table($displaytitle);
            $table->define_baseurl("{$CFG->wwwroot}/totara/hierarchy/item/view.php?prefix={$displayprefix}&id={$itemid}");
            $table->define_columns($columns);
            $table->define_headers($headers);
            $table->set_attribute('id', 'list-'.$displaytitle);
            $table->set_attribute('cellspacing', '0');
            $table->set_attribute('class', 'generalbox boxaligncenter edit'.$displayprefix);
            $table->setup();
            // Add one blank line
            $table->add_data(NULL);
            foreach ($items as $ritem) {
                $content = array();
                $content[] = empty($ritem->type) ? get_string('unclassified', 'totara_hierarchy') : $ritem->type;

                if ($displaytitle == 'assignedcompetencies') {
                    $content[] = $this->output->action_link(new moodle_url('/totara/hierarchy/item/view.php', array('prefix' => $displayprefix, 'id' => $ritem->id)), $ritem->fullname);
                } elseif ($displaytitle == 'assignedcompetencytemplates') {
                    $content[] = $this->output->action_link(new moodle_url('/totara/hierarchy/prefix/competency/template/view.php', array('id' => $ritem->id)), $ritem->fullname);
                }

                if ($can_edit) {
                    // TODO: Rewrite to use a component_action object
                    $content[] = html_writer::select(
                    array( //$options
                    PLAN_LINKTYPE_OPTIONAL => get_string('optional', 'totara_hierarchy'),
                    PLAN_LINKTYPE_MANDATORY => get_string('mandatory', 'totara_hierarchy'),
                    ),
                    'linktype', //$name,
                    ($ritem->linktype ? $ritem->linktype : PLAN_LINKTYPE_OPTIONAL), //$selected,
                    false, //$nothing,
                    array('onChange' => "\$.get(".
                                "'{$CFG->wwwroot}/totara/plan/update-linktype.php".
                                "?type={$shortprefix}&c={$ritem->aid}".
                                "&sesskey=".sesskey().
                                "&t=' + $(this).val()".
                            ");")
                    );
                    $content[] = $this->output->action_icon(new moodle_url('/totara/hierarchy/prefix/' . $prefix . '/assigncompetency/remove.php', array('id' => $ritem->aid, $prefix => $itemid, 'framework' => $framework)),
                    new pix_icon('t/delete', $str_remove), null, array('class' => 'iconsmall', 'title' => $str_remove));
                }
                $table->add_data($content);
            }
            $table->finish_html();
            $out .= ob_get_clean();
        } else {
            $out .= $this->output->box_start('boxaligncenter boxwidthnormal centerpara nohierarchyitems noitems-'.$displaytitle);
            $out .= get_string('no'.$displaytitle, 'totara_hierarchy');
            $out .= $this->output->box_end();
        }

        // Add button
        if ($can_edit) {
            // need to be done manually (not with single_button) to get correct ID on input button element
            $add_button_text = get_string('add'.$displayprefix, 'totara_hierarchy');
            $out .= html_writer::start_tag('div', array('class' => 'buttons'));
            $out .= html_writer::start_tag('div', array('class' => 'singlebutton'));
            $out .= html_writer::start_tag('form', array('action' => $addurl, 'method' => 'get'));
            $out .= html_writer::start_tag('div');
            $out .= html_writer::empty_tag('input', array('type' => 'submit', 'id' => "show-".$displaytitle."-dialog", 'value' => $add_button_text));
            $out .= html_writer::empty_tag('input', array('type' => 'hidden', 'name' => "assignto", 'value' => $itemid));
            $out .= html_writer::empty_tag('input', array('type' => 'hidden', 'name' => "nojs", 'value' => '1'));
            $out .= html_writer::empty_tag('input', array('type' => 'hidden', 'name' => "returnurl", 'value' => qualified_me()));
            $out .= html_writer::empty_tag('input', array('type' => 'hidden', 'name' => "s", 'value' => sesskey()));
            $out .= html_writer::end_tag('div');
            $out .= html_writer::end_tag('form');
            $out .= html_writer::end_tag('div');
            $out .= html_writer::end_tag('div');
        }
        return $out;
    }

}
