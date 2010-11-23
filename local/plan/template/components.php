<?php // $Id$

/**
 * Workflow settings page for development plan templates
 *
 * @copyright Catalyst IT Limited
 * @author Alastair Munro
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage plan
 */

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once('template_forms.php');

$id = optional_param('id', null, PARAM_INT);
$save = optional_param('save', false, PARAM_BOOL);
$moveup = optional_param('moveup', 0, PARAM_INT);
$movedown = optional_param('movedown', 0, PARAM_INT);
$hide = optional_param('hide', 0, PARAM_INT);
$show = optional_param('show', 0, PARAM_INT);

admin_externalpage_setup('managetemplates');

if(!$template = get_record('dp_template', 'id', $id)){
    error(get_string('error:invalidtemplateid', 'local_plan'));
}

$returnurl = $CFG->wwwroot . '/local/plan/template/components.php?id=' . $id;

if($save){
    if(update_plan_component_name('componentname', $id)){
        totara_set_notification(get_string('update_components_settings', 'local_plan'), $returnurl, array('style' => 'notifysuccess'));
    } else {
        totara_set_notification(get_string('error:update_components_settings', 'local_plan'), $returnurl);
    }
}

if ((!empty($moveup) or !empty($movedown))) {

    $move = NULL;
    $swap = NULL;

    // Get value to move, and value to replace
    if (!empty($moveup)) {
        $move = get_record('dp_component_settings', 'id', $moveup);
        $resultset = get_records_sql("
            SELECT *
            FROM {$CFG->prefix}dp_component_settings
            WHERE
            templateid = {$template->id}
            AND sortorder < {$move->sortorder}
            ORDER BY sortorder DESC", 0, 1
        );
        if ( $resultset && count($resultset) ){
            $swap = reset($resultset);
            unset($resultset);
        }
    } else {
        $move = get_record('dp_component_settings', 'id', $movedown);
        $resultset = get_records_sql("
            SELECT *
            FROM {$CFG->prefix}dp_component_settings
            WHERE
            templateid = {$template->id}
            AND sortorder > {$move->sortorder}
            ORDER BY sortorder ASC", 0, 1
        );
        if ( $resultset && count($resultset) ){
            $swap = reset($resultset);
            unset($resultset);
        }
    }

    if ($swap && $move) {
        // Swap sortorders
        begin_sql();
        if (!(set_field('dp_component_settings', 'sortorder', $move->sortorder, 'id', $swap->id)
            && set_field('dp_component_settings', 'sortorder', $swap->sortorder, 'id', $move->id)
        )) {
            rollback_sql();
            totara_set_notification(get_string('error:update_components_sortorder', 'local_plan'), $returnurl);
        }
        commit_sql();
    }
}

if($show) {
    if(!$component = get_record('dp_component_settings', 'id', $show)){
            totara_set_notification(get_string('error:invalid_component_id', 'local_plan'), $returnurl);
    } else {
        $enabled = 1;
        if (!set_field('dp_component_settings', 'enabled', $enabled, 'id', $component->id)) {
            rollback_sql();
            totara_set_notification(get_string('error:update_components_enabled', 'local_plan'), $returnurl);
        } else {
            commit_sql();
        }
    }
}

if($hide) {
    if(!$component = get_record('dp_component_settings', 'id', $hide)){
            totara_set_notification(get_string('error:invalid_component_id', 'local_plan'), $returnurl);
    } else {
        $enabled = 0;
        if (!set_field('dp_component_settings', 'enabled', $enabled, 'id', $component->id)) {
            rollback_sql();
            totara_set_notification(get_string('error:update_components_enabled', 'local_plan'), $returnurl);
        } else {
            commit_sql();
        }
    }
}


admin_externalpage_print_header();

if($template){
    print_heading($template->fullname);
} else {
    print_heading(get_string('newtemplate', 'local_plan'));
}

$currenttab = 'components';
require('tabs.php');

$mform = new dp_components_form(null, compact('id'));
$mform->display();

admin_externalpage_print_footer();

?>
