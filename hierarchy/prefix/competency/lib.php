<?php // $Id$

///////////////////////////////////////////////////////////////////////////
//                                                                       //
// NOTICE OF COPYRIGHT                                                   //
//                                                                       //
// Moodle - Modular Object-Oriented Dynamic Learning Environment         //
//          http://moodle.com                                            //
//                                                                       //
// Copyright (C) 1999 onwards Martin Dougiamas  http://dougiamas.com     //
//                                                                       //
// This program is free software; you can redistribute it and/or modify  //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation; either version 2 of the License, or     //
// (at your option) any later version.                                   //
//                                                                       //
// This program is distributed in the hope that it will be useful,       //
// but WITHOUT ANY WARRANTY; without even the implied warranty of        //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         //
// GNU General Public License for more details:                          //
//                                                                       //
//          http://www.gnu.org/copyleft/gpl.html                         //
//                                                                       //
///////////////////////////////////////////////////////////////////////////

/**
 * competency/lib.php
 *
 * Library to construct competency hierarchies
 * @copyright Catalyst IT Limited
 * @author Jonathan Newman
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 */
require_once($CFG->dirroot.'/hierarchy/lib.php');
require_once($CFG->dirroot.'/hierarchy/prefix/competency/evidenceitem/type/abstract.php');
require_once($CFG->dirroot.'/local/utils.php');

/**
 * Competency aggregation methods
 *
 * These are mapped to lang strings in the competency lang file
 * with the key as a suffix e.g. for ALL, 'aggregationmethod1'
 */
global $COMP_AGGREGATION;
$COMP_AGGREGATION = array(
    'ALL'       => 1,
    'ANY'       => 2,
    'OFF'       => 3,
/*
    'UNIT'      => 4,
    'FRACTION'  => 5,
    'SUM'       => 6,
    'AVERAGE'   => 7,
*/
);

/**
 * Oject that holds methods and attributes for competency operations.
 * @abstract
 */
class competency extends hierarchy {

    /**
     * The base table prefix for the class
     */
    const PREFIX = 'competency';
    const SHORT_PREFIX = 'comp';
    var $prefix = self::PREFIX;
    var $shortprefix = self::SHORT_PREFIX;
    protected $extrafields = array('evidencecount');

    /**
     * Get template
     * @param int Template id
     * @return object|false
     */
    function get_template($id) {
        return get_record($this->shortprefix.'_template', 'id', $id);
    }

    /**
     * Gets templates.
     *
     * @global object $CFG
     * @return array
     */
    function get_templates() {
        global $CFG;
        return get_records($this->shortprefix.'_template', 'frameworkid', $this->frameworkid, 'fullname');
    }

    /**
     * Hide the competency template
     * @var int - the template id to hide
     * @return void
     */
    function hide_template($id) {
        $template = $this->get_template($id);
        if ($template) {
            $visible = 0;
            if (!set_field($this->shortprefix.'_template', 'visible', $visible, 'id', $template->id)) {
                notify('Could not update that '.$this->prefix.' template!');
            }
        }
    }

    /**
     * Show the competency template
     * @var int - the template id to show
     * @return void
     */
    function show_template($id) {
        $template = $this->get_template($id);
        if ($template) {
            $visible = 1;
            if (!set_field($this->shortprefix.'_template', 'visible', $visible, 'id', $template->id)) {
                notify('Could not update that '.$this->prefix.' template!');
            }
        }
    }

    /**
     * Delete competency framework and updated associated scales
     * @access  public
     * @return  void
     */
    function delete_framework() {

        // Start transaction
        begin_sql();

        // Run parent method
        parent::delete_framework();

        // Delete references to scales
        if (count_records($this->shortprefix.'_scale_assignments', 'frameworkid', $this->frameworkid)) {
            if (!delete_records($this->shortprefix.'_scale_assignments', 'frameworkid', $this->frameworkid)) {
                rollback_sql();
                return false;
            }
        }

        // End transaction
        commit_sql();
        return true;
    }


    /**
     * Delete all data associated with the competencies
     *
     * This method is protected because it deletes the competencies, but doesn't update the
     * sortorder of the other framework items (or use transactions).
     * Use {@link hierarchy::delete_framework_item()} to recursively delete an item and
     * all its children
     *
     * @param array $items Array of IDs to be deleted
     *
     * @return boolean True if items and associated data were successfully deleted
     */
    protected function _delete_framework_items($items) {
        global $CFG;

        // First call the deleter for the parent class
        if (!parent::_delete_framework_items($items)){
            return false;
        }

        // delete rows from all these other tables:
        $db_data = array(
            $this->shortprefix.'_evidence' => 'competencyid',
            $this->shortprefix.'_evidence_items' => 'competencyid',
            $this->shortprefix.'_evidence_items_evidence' => 'competencyid',
            $this->shortprefix.'_relations' => 'id1',
            $this->shortprefix.'_relations' => 'id2',
            hierarchy::get_short_prefix('position').'_competencies' => 'competencyid',
            hierarchy::get_short_prefix('organisation').'_competencies' => 'competencyid',
            'dp_plan_competency_assign' => 'competencyid',
        );
        foreach ($db_data as $table => $field) {
            $select = "$field IN (" . implode(',', $items) . ')';
            if (!delete_records_select($table, $select)) {
                return false;
            }
        }


        // update the template count

        // start by getting a list of templates affected by the deletions
        $modified_templates = array();
        $sql = "
            SELECT DISTINCT templateid
            FROM {$CFG->prefix}{$this->shortprefix}_template_assignment
            WHERE type=1 AND instanceid IN (" . implode(',', $items) . ")";
        $records = get_records_sql($sql);
        if ($records) {
            foreach ($records as $template) {
                $modified_templates[] = $template->templateid;
            }
        }

        // now delete the template assignments
        if(!delete_records_select($this->shortprefix.'_template_assignment',
            'type = 1 AND instanceid IN (' . implode(',', $items). ')')) {

            return false;
        }

        // only continue if at least one template has changed
        if (count($modified_templates) > 0) {
            // now update count for templates that still have at least one assignment
            // this won't catch templates that now have zero competencies as there
            // won't be any entries in comp_template_assignment
            $sql = "UPDATE {$CFG->prefix}{$this->shortprefix}_template t
                SET competencycount = q.count
                FROM
                    (SELECT templateid, COUNT(instanceid) AS count
                    FROM {$CFG->prefix}{$this->shortprefix}_template_assignment
                    WHERE type = 1
                    GROUP BY templateid
                    HAVING templateid IN (" . implode(',', $modified_templates) . ")
                ) q
                WHERE t.id = q.templateid";
            if (!execute_sql($sql, false)) {
                return false;
            }

            // figure out if any of the modified templates are now empty
            $empty_templates = $modified_templates;
            $sql = "SELECT DISTINCT templateid
                FROM {$CFG->prefix}{$this->shortprefix}_template_assignment";
            $records = get_recordset_sql($sql);
            while ($record = rs_fetch_next_record($records)) {
                $key = array_search($record->templateid, $empty_templates);
                if ($key !== false) {
                    // it's not empty if there's an assignment
                    unset($empty_templates[$key]);
                }
            }

            // finally, set the count to zero for any of the templates that no longer
            // have any assignments
            if (count($empty_templates) > 0) {
                $sql = "UPDATE {$CFG->prefix}{$this->shortprefix}_template
                    SET competencycount = 0
                    WHERE id IN (" . implode(',', $empty_templates). ")";
                if (!execute_sql($sql, false)) {
                    return false;
                }
            }
        }

        return true;

    }


    /**
     * Delete template and associated data
     * @var int - the template id to delete
     * @return  void
     */
    function delete_template($id) {
        delete_records($this->shortprefix.'_template_assignment','templateid',$id);
        delete_records(hierarchy::get_short_prefix('position').'_competencies','templateid',$id);

        // Delete this item
        delete_records($this->shortprefix.'_template', 'id', $id);
    }

    /**
     * Get competencies assigned to a template
     * @param int $id Template id
     * @return array|false
     */
    function get_assigned_to_template($id) {
        global $CFG;

        return get_records_sql(
            "
            SELECT
                c.id AS id,
                c.fullname AS competency,
                c.fullname AS fullname    /* used in some places (for genericness) */
            FROM
                {$CFG->prefix}{$this->shortprefix}_template_assignment a
            LEFT JOIN
                {$CFG->prefix}{$this->shortprefix}_template t
             ON t.id = a.templateid
            LEFT JOIN
                {$CFG->prefix}{$this->shortprefix} c
             ON a.instanceid = c.id
            WHERE
                t.id = {$id}
            "
        );
    }

    /**
     * Get evidence items for a competency
     * @param $item object Competency
     * @return array|false
     */
    function get_evidence($item) {
        return get_records($this->shortprefix.'_evidence_items', 'competencyid', $item->id);
    }

    /**
     * Get related competencies
     * @param $item object Competency
     * @return array|false
     */
    function get_related($item) {
        global $CFG;

        return get_records_sql(
            "
            SELECT DISTINCT
                c.id AS id,
                c.fullname,
                f.id AS fid,
                f.fullname AS framework,
                it.fullname AS itemtype
            FROM
                {$CFG->prefix}{$this->shortprefix}_relations r
            INNER JOIN
                {$CFG->prefix}{$this->shortprefix} c
             ON r.id1 = c.id
             OR r.id2 = c.id
            INNER JOIN
                {$CFG->prefix}{$this->shortprefix}_framework f
             ON f.id = c.frameworkid
            INNER JOIN
                {$CFG->prefix}{$this->shortprefix}_type it
             ON it.id = c.typeid
            WHERE
                (r.id1 = {$item->id} OR r.id2 = {$item->id})
            AND c.id != {$item->id}
            "
        );
    }

    /**
     * Get competency evidence using in a course
     *
     * @param   $courseid   int
     * @return  array|false
     */
    function get_course_evidence($courseid) {
        global $CFG;

        return get_records_sql(
                "
                SELECT DISTINCT
                    cei.id AS evidenceid,
                    c.id AS id,
                    c.fullname,
                    f.id AS fid,
                    f.fullname AS framework,
                    cei.itemtype AS evidencetype,
                    cei.iteminstance AS evidenceinstance,
                    cei.itemmodule AS evidencemodule
                FROM
                    {$CFG->prefix}{$this->shortprefix}_evidence_items cei
                INNER JOIN
                    {$CFG->prefix}{$this->shortprefix} c
                 ON cei.competencyid = c.id
                INNER JOIN
                    {$CFG->prefix}{$this->shortprefix}_framework f
                 ON f.id = c.frameworkid
                LEFT JOIN
                    {$CFG->prefix}modules m
                 ON cei.itemtype = 'activitycompletion'
                AND m.name = cei.itemmodule
                LEFT JOIN
                    {$CFG->prefix}course_modules cm
                 ON cei.itemtype = 'activitycompletion'
                AND cm.instance = cei.iteminstance
                AND cm.module = m.id
                WHERE
                (
                        cei.itemtype <> 'activitycompletion'
                    AND cei.iteminstance = {$courseid}
                )
                OR
                (
                        cei.itemtype = 'activitycompletion'
                    AND cm.course = {$courseid}
                )
                ORDER BY
                    c.fullname
                "
        );
    }

    /**
     * Run any code before printing header
     * @param $page string Unique identifier for page
     * @return void
     */
    function hierarchy_page_setup($page = '', $item=null) {
        global $CFG, $USER;

        if (!in_array($page, array('template/view', 'item/view', 'item/add'))) {
            return;
        }

        // Setup custom javascript
        require_once($CFG->dirroot.'/local/js/lib/setup.php');

        // Setup lightbox
        local_js(array(
            TOTARA_JS_DIALOG,
            TOTARA_JS_TREEVIEW,
            TOTARA_JS_DATEPICKER
        ));

        switch ($page) {
            case 'item/view':
                $itemid = !(empty($item->id)) ? "?id={$item->id}" : '';
                require_js(array(
                    $CFG->wwwroot.'/local/js/competency.item.js.php'.$itemid,
                ));
                break;
            case 'template/view':
                $itemid = !(empty($item->id)) ? "?id={$item->id}" : '';
                require_js(array(
                    $CFG->wwwroot.'/local/js/competency.template.js.php'.$itemid,
                ));
                break;
            case 'item/add':
                require_js(array(
                    $CFG->wwwroot.'/local/js/competency.add.js.php',
                    $CFG->wwwroot.'/local/js/position.user.js.php?userid='.$USER->id,
                ));
                break;
        }
    }

    /**
     * Print any extra markup to display on the hierarchy view item page
     * @param $item object Competency being viewed
     * @return void
     */
    function display_extra_view_info($item, $section='') {
        global $CFG;

        $sitecontext = get_context_instance(CONTEXT_SYSTEM);
        $can_edit = has_capability('moodle/local:updatecompetency', $sitecontext);
        if ($can_edit) {
            $str_edit = get_string('edit');
            $str_remove = get_string('remove');
        }

        if (!$section || $section=='related') {
            // Display related competencies
            echo '<div class="list-related">';
            $related = $this->get_related($item);
            require $CFG->dirroot.'/hierarchy/prefix/competency/view-related.html';
            echo '</div>';
        }

        if (!$section || $section=='evidence') {
            // Display evidence
            $evidence = $this->get_evidence($item);
            require $CFG->dirroot.'/hierarchy/prefix/competency/view-evidence.html';
        }
    }

    /**
     * Return hierarchy prefix specific data about an item
     *
     * The returned array should have the structure:
     * array(
     *  0 => array('title' => $title, 'value' => $value),
     *  1 => ...
     * )
     *
     * @param $item object Item being viewed
     * @param $cols array optional Array of columns and their raw data to be returned
     * @return array
     */
    function get_item_data($item, $cols = NULL) {

        $data = parent::get_item_data($item, $cols);

        // Add aggregation method
        $data[] = array(
            'title' => get_string('aggregationmethodview', $this->prefix),
            'value' => get_string('aggregationmethod'.$item->aggregationmethod, $this->prefix)
        );

        return $data;
    }

    /**
     * Get the competency scale for this competency (including all the scale's
     * values in an attribute called valuelist)
     *
     * @global object $CFG
     * @return object
     */
    function get_competency_scale(){
        global $CFG;
        $sql = <<<SQL
            select scale.*
            from
                {$CFG->prefix}{$this->shortprefix}_scale_assignments sa,
                {$CFG->prefix}{$this->shortprefix}_scale scale
            where
                sa.scaleid = scale.id
                and sa.frameworkid = {$this->frameworkid}
SQL;
        $scale = get_record_sql($sql);
        if ( !$scale ){
            return false;
        }

        $valuelist = get_records($this->shortprefix.'_scale_values', 'scaleid', $scale->id, 'sortorder');
        if ( $valuelist ){
            $scale->valuelist = $valuelist;
        } else {
            $scale->valuelist = array();
        }
        return $scale;
    }

    /**
     * Get competencies in a framework by parent. If a revision id is supplied,
     * add a 'disabled' flag that will be TRUE for the competencies present in
     * that IDP revision, and FALSE otherwise
     *
     * @global object $CFG
     * @param int $parentid
     * @param int $revisionid
     * @return array
     */
    function get_items_by_parent($parentid=false, $revisionid=0) {
        global $CFG;

        // If there's no revisionid, we can use the parent class's implementation
        if ( !$revisionid ){
            return parent::get_items_by_parent($parentid);
        }

        if ($parentid) {
            // Parentid supplied, do not specify frameworkid as
            // sometimes it is not set correctly. And a parentid
            // is enough to get the right results
            $sql = <<<SQL
                select
                    c.*,
                    (
                        select count(*)
                        from {$CFG->prefix}idp_revision_competency rc
                        where
                            rc.revision = {$revisionid}
                            and rc.competency = c.id
                    ) as disabled
                from {$CFG->prefix}{$this->shortprefix} c
                where c.parentid = {$parentid}
                    and c.visible=1
                order by frameworkid, sortorder, fullname
SQL;
            return get_records_sql($sql);
        } else {
            // If no parentid, grab the root node of this framework
            return $this->get_all_root_items(false, $revisionid);
        }
    }

    
    /*
     * Returns all items at the root level (parentid=0) for the current framework (obtained
     * from $this->frameworkid)
     * If no framework is specified, returns root items across all frameworks
     * This behaviour can also be forced by setting $all = true
     *
     * @global object $CFG
     * @param int $fwid Framework ID or null for all frameworks
     * @param boolean $all If true return root items for all frameworks even if $this->frameworkid is set
     * @return array|false
     */
    function get_all_root_items($all=false, $revisionid=0) {
        global $CFG;

        // If there's no revisionid, we can use the parent class's implementation
        if ( !$revisionid ){
            return parent::get_all_root_items($all);
        }

        if(empty($this->frameworkid) || $all) {
            // all root level items across frameworks
            return $this->get_items_by_parent(0, $revisionid);
        } else {
            // root level items for current framework only
            $sql = <<<SQL
                select
                    c.*,
                    (
                        select count(*)
                        from {$CFG->prefix}idp_revision_competency rc
                        where
                            rc.revision = {$revisionid}
                            and rc.competency = c.id
                    ) as disabled
                from {$CFG->prefix}{$this->shortprefix} c
                where 
                    c.parentid = 0
                    and c.frameworkid = {$this->frameworkid}
                    and c.visible = 1
                order by sortorder, fullname
SQL;
            return get_records_sql($sql);
        }
    }

    /**
     * Get scales for a competency
     * @return array|false
     */
    function get_scales() {
        return get_records($this->shortprefix.'_scale', '', '', 'name');
    }

    /**
     * Delete  a competency assigned to a template
     * @param $templateid
     * @param $competencyid
     * @return void;
     */
    function delete_assigned_template_competency($templateid, $competencyid) {
        if (!$template = $this->get_template($templateid)) {
            return;
        }

        // Delete assignment
        delete_records('comp_template_assignment', 'templateid', $template->id, 'instanceid', $competencyid);

        // Reduce competency count for template
        $template->competencycount--;

        if ($template->competencycount < 0) {
            $template->competencycount = 0;
        }

        update_record('comp_template', $template);

        add_to_log(SITEID, 'competency', 'template remove competency assignment',
                    "prefix/competency/template/view.php?id={$template->id}", "Competency ID $competencyid");

    }


    /**
     * Returns an array of all competencies that a user has a comp_evidence
     * record for, keyed on the competencyid. Also returns the required
     * proficiency value and isproficient, which is 1 if the user meets the
     * proficiency and 0 otherwise
     */
    static function get_proficiencies($userid) {
        global $CFG;
        $sql = "SELECT ce.competencyid, prof.proficiency, csv.proficient AS isproficient
            FROM {$CFG->prefix}comp_evidence ce
            LEFT JOIN {$CFG->prefix}comp c ON c.id=ce.competencyid
            LEFT JOIN {$CFG->prefix}comp_scale_assignments csa
                ON c.frameworkid = csa.frameworkid
            LEFT JOIN {$CFG->prefix}comp_scale_values csv
                ON csv.scaleid=csa.scaleid
                AND csv.id=ce.proficiency
            LEFT JOIN (
                SELECT scaleid, MAX(id) AS proficiency
                FROM {$CFG->prefix}comp_scale_values
                WHERE proficient=1
                GROUP BY scaleid
            ) prof on prof.scaleid=csa.scaleid
            WHERE ce.userid=$userid";
        return get_records_sql($sql);
    }


    /**
     * Prints the list of linked evidence
     *
     * @param int $courseid
     * @return string
     */
    function print_linked_evidence_list($courseid) {
        global $CFG;

        $can_edit = has_capability('moodle/local:updatecompetency', get_context_instance(CONTEXT_SYSTEM));
        $can_manage_fw = has_capability('moodle/local:updatecompetencyframeworks', get_context_instance(CONTEXT_SYSTEM));

        if (!$course = get_record('course', 'id', $courseid)) {
            print_error('invalidcourseid');
        }

        $out = '<table width="95%" cellpadding="5" cellspacing="1" id="list-coursecompetency"
            class="generalbox editcompetency boxaligncenter">
            <tr>
                <th style="vertical-align:top; white-space:nowrap;" class="header c0" scope="col">'.
                    get_string('framework', 'competency').
                '</th>

                <th style="vertical-align:top; white-space:nowrap;" class="header c2" scope="col">'.
                    get_string('name').
                '</th>';

        if (!empty($CFG->competencyuseresourcelevelevidence)) {
            $out .= '<th style="vertical-align:top; white-space:nowrap;" class="header c3" scope="col">'.
                get_string('evidence', 'competency').
            '</th>';
        }

        if ($can_edit) {
            $out .= '<th style="vertical-align:top; white-space:nowrap;" class="header c4" scope="col">'.
                get_string('options', 'competency').
            '</th>';
        } // if ($can_edit)
        $out .= '</tr>';

        // Get any competencies used in this course
        $competencies = $this->get_course_evidence($course->id);
        $oddeven = 0;
        if ($competencies) {

            $str_remove = get_string('remove');

            $activities = array();

            foreach ($competencies as $competency) {
                $framework_text = ($can_manage_fw) ?
                    "<a href=\"{$CFG->wwwroot}/hierarchy/index.php?prefix=competency&amp;frameworkid={$competency->fid}\">" .
                    format_string($competency->framework) . "</a>" : format_string($competency->framework);

                $out .= '<tr class="r' . $oddeven . '">';
                $out .= "<td>{$framework_text}</td>";
                $out .= "<td><a href=\"{$CFG->wwwroot}/hierarchy/item/view.php?prefix=competency&amp;id={$competency->id}\">{$competency->fullname}</a></td>";

                // Create evidence object
                $evidence = new object();
                $evidence->id = $competency->evidenceid;
                $evidence->itemtype = $competency->evidencetype;
                $evidence->iteminstance = $competency->evidenceinstance;
                $evidence->itemmodule = $competency->evidencemodule;

                if (!empty($CFG->competencyuseresourcelevelevidence)) {
                    $out .= '<td>';

                    $evidence = competency_evidence_type::factory($evidence);

                    $out .= $evidence->get_type();
                    if ($evidence->itemtype == 'activitycompletion') {
                        $out .= ' - '.$evidence->get_name();
                    }

                    $out .= '</td>';
                }

                // Options column
                if ($can_edit) {
                    $out .= '<td align="center">';
                    $out .= "<a href=\"{$CFG->wwwroot}/hierarchy/prefix/competency/evidenceitem/remove.php?id={$evidence->id}&course={$courseid}\" title=\"$str_remove\">".
                         "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_remove\" /></a>";
                    $out .= '</td>';
                }

                $out .= '</tr>';

                // for row striping
                $oddeven = $oddeven ? 0 : 1;
            }

        } else {

            $cols = 5;
            $out .= '<tr class="noitems-coursecompetency"><td colspan="'.$cols.'"><i>'.get_string('nocoursecompetencies', 'competency').'</i></td></tr>';
        }

        $out .= '</table>';

        return $out;
    }

    /**
     * Returns an array of competency ids that have completed by the specified user
     * @param int $userid user to get competencies for
     * @return array list of ids of completed competencies
     */
    static function get_user_completed_competencies($userid) {
        global $CFG;

        $proficient_sql = "SELECT
            ce.competencyid
            FROM
                {$CFG->prefix}comp_evidence ce
            JOIN
                {$CFG->prefix}comp_scale_values csv ON csv.id = ce.proficiency
            WHERE csv.proficient = 1
              AND ce.userid={$userid}
              ";
        $completed = get_records_sql($proficient_sql);

        return is_array($completed) ? array_keys($completed) : array();
    }


    /**
     * Extra form elements to include in the add/edit form for items of this prefix
     *
     * @param object &$mform Moodle form object (passed by reference)
     */
    function add_additional_item_form_fields(&$mform) {
        global $CFG;

        $frameworkid = $this->frameworkid;

        // Get all aggregation methods
        global $COMP_AGGREGATION;
        $aggregations = array();
        foreach ($COMP_AGGREGATION as $title => $key) {
            $aggregations[$key] = get_string('aggregationmethod'.$key, 'competency');
        }

        // Get the name of the framework's scale. (Note this code expects there
        // to be only one scale per framework, even though the DB structure
        // allows there to be multiple since we're using a go-between table)
        $scaledesc = get_field_sql("
            select s.name
            from
        {$CFG->prefix}{$this->shortprefix}_scale s,
        {$CFG->prefix}{$this->shortprefix}_scale_assignments a
        where
        a.frameworkid = {$frameworkid}
        and a.scaleid = s.id
        ");

        $mform->addElement('select', 'aggregationmethod', get_string('aggregationmethod', 'competency'), $aggregations);
        $mform->setHelpButton('aggregationmethod', array('competencyaggregationmethod', get_string('aggregationmethod', 'competency')), true);
        $mform->addRule('aggregationmethod', get_string('aggregationmethod', 'competency'), 'required', null);

        $mform->addElement('static', 'scalename', get_string('scale'), ($scaledesc)?$scaledesc:get_string('none'));
        $mform->setHelpButton('scalename', array('competencyscale', get_string('scale')), true);

        $mform->addElement('hidden', 'proficiencyexpected', 1);
        $mform->addElement('hidden', 'evidencecount', 0);
    }


    /**
     * Returns various stats about an item, used for listed what will be deleted
     *
     * @param integer $id ID of the item to get stats for
     * @return array Associative array containing stats
     */
    public function get_item_stats($id) {
        if (!$data = parent::get_item_stats($id)){
            return false;
        }

        // should always include at least one item (itself)
        if (!$children = $this->get_item_descendants($id)) {
            return false;
        }

        $ids = array_keys($children);

        // number of comp_evidence records
        $data['user_achievement'] = count_records_select('comp_evidence',
            sql_sequence('competencyid', $ids));

        // number of comp_evidence_item records
        $data['evidence'] = count_records_select('comp_evidence_items',
            sql_sequence('competencyid', $ids));

        // number of comp_relations records
        $data['related'] = count_records_select('comp_relations',
            sql_sequence('id1', $ids) . ' OR ' . sql_sequence('id2', $ids));

        return $data;
    }

    /**
     * Given some stats about an item, return a formatted delete message
     *
     * @param array $stats Associative array of item stats
     * @return string Formatted delete message
     */
    public function output_delete_message($stats) {
        $message = parent::output_delete_message($stats);

        if ($stats['user_achievement'] > 0) {
            $message .= get_string('deleteincludexuserstatusrecords', 'competency', $stats['user_achievement']) . '<br />';
        }

        if ($stats['evidence'] > 0) {
            $message .= get_string('deleteincludexevidence', 'competency', $stats['evidence']) . '<br />';
        }

        if ($stats['related'] > 0) {
            $message .= get_string('deleteincludexrelatedcompetencies', 'competency', $stats['related']). '<br />';
        }

        return $message;
    }

}  // class
