<?php
/**
 * template/lib.php
 *
 * Library of functions related to competency templates.
 *
 * Note: Functions in this library should have names beginning with "competency_template",
 * in order to avoid name collisions
 *
 * @copyright Catalyst IT Limited
 * @author Eugene Venter
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package MITMS
 */

/**
 * A function to display a table list of competency templates
 *
 * @param array $templates
 * @param int $frameworkid
 * @return html
 */
function competency_template_display_table($templates, $frameworkid) {
    global $CFG;

    $sitecontext = get_context_instance(CONTEXT_SYSTEM);
    $editing     = optional_param('edit', -1, PARAM_BOOL);

    // Cache user capabilities
    $can_add = has_capability('moodle/local:createcompetencytemplate', $sitecontext);
    $can_edit = has_capability('moodle/local:updatecompetencytemplate', $sitecontext);
    $can_delete = has_capability('moodle/local:deletecompetencytemplate', $sitecontext);

    if (($can_add || $can_edit || $can_delete) && $editing) {
        $editingon = $USER->templateediting = 1;
    } else {
        $editingon = $USER->templateediting = 0;
    }

    ///
    /// Generate / display page
    ///
    $str_edit     = get_string('edit');
    $str_delete   = get_string('delete');
    $str_hide     = get_string('hide');
    $str_show     = get_string('show');

    if ($templates) {

        // Create display table
        $table = new stdclass();
        $table->class = 'generaltable editcompetency';
        $table->width = '95%';

        // Setup column headers
        $table->head = array();
        $table->align = array();
        $table->head[] = get_string('template', 'competency');
        $table->align[] = 'left';
        $table->head[] = get_string('competencies', 'competency');
        $table->align[] = 'center';
        $table->head[] = get_string('createdon', 'competency');
        $table->align[] = 'left';

        // Add edit column
        if ($editingon && $can_edit) {
            $table->head[] = get_string('edit');
            $table->align[] = 'center';
        }

        // Add rows to table
        foreach ($templates as $template) {
            $row = array();

            $cssclass = !$template->visible ? 'class="dimmed"' : '';

            $row[] = "<a $cssclass href=\"{$CFG->wwwroot}/hierarchy/type/competency/template/view.php?id={$template->id}\">{$template->fullname}</a>";
            $row[] = "<a $cssclass href=\"{$CFG->wwwroot}/hierarchy/type/competency/template/view.php?id={$template->id}\">{$template->competencycount}</a>";
            $row[] = userdate($template->timecreated, '%A, %e %B %Y');

            // Add edit link
            $buttons = array();
            if ($editingon && $can_edit) {
                $buttons[] = "<a href=\"{$CFG->wwwroot}/hierarchy/type/competency/template/edit.php?id={$template->id}\" title=\"$str_edit\">".
                    "<img src=\"{$CFG->pixpath}/t/edit.gif\" class=\"iconsmall\" alt=\"$str_edit\" /></a>";
            }
            if ($editingon && $can_delete) {
                $buttons[] = "<a href=\"{$CFG->wwwroot}/hierarchy/type/competency/template/delete.php?id={$template->id}\" title=\"$str_delete\">".
                    "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_delete\" /></a>";
            }

            if ($buttons) {
                $row[] = implode($buttons, ' ');
            }

            $table->data[] = $row;
        }
    }


    // Display page
    //$hierarchy->display_framework_selector('type/competency/template/index.php');

    print_heading(get_string('competencytemplates', 'competency'));

    if ($templates) {
        print_table($table);
    } else {
        echo '<p>'.get_string('notemplateinframework', 'competency').'</p>';
    }


    // Editing buttons
    if ($can_add) {
        echo '<div class="buttons">';

        // Print button for creating new template
        $data = array('frameworkid' => $frameworkid);
        print_single_button($CFG->wwwroot.'/hierarchy/type/competency/template/edit.php', $data, get_string('addnewtemplate', 'competency'), 'get');

        echo '</div>';
    }


}

?>
