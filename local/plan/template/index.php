<?php // $Id$

/**
 * Page containing list of plan templates
 *
 * @copyright Catalyst IT Limited
 * @autho Alastair Munro
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage plan
 */

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/plan/lib.php');
require_once($CFG->dirroot.'/local/js/lib/setup.php');
require_once('template_forms.php');

$notice = optional_param('notice', 0, PARAM_INT); // notice flag
$hide = optional_param('hide', 0, PARAM_INT);
$show = optional_param('show', 0, PARAM_INT);
$moveup = optional_param('moveup', 0, PARAM_INT);
$movedown = optional_param('movedown', 0, PARAM_INT);
$delete = optional_param('delete', 0, PARAM_INT);
$confirm = optional_param('confirm', false, PARAM_BOOL);

admin_externalpage_setup('managetemplates');

//Javascript include
local_js(array(
    TOTARA_JS_DIALOG,
    TOTARA_JS_DATEPICKER
));

if($show) {
    if(!$template = get_record('dp_template', 'id', $show)){
        totara_set_notification(get_string('error:templateid', 'local_plan'), $CFG->wwwroot.'/local/plan/template/index.php');
    } else {
        $visible = 1;
        if (!set_field('dp_template', 'visible', $visible, 'id', $template->id)) {
            notify('Could not update that '.$template->fullname.' framework!');
        }
    }
}

if($hide) {
    if(!$template = get_record('dp_template', 'id', $hide)){
        totara_set_notification(get_string('error:templateid', 'local_plan'), $CFG->wwwroot.'/local/plan/template/index.php');
    } else {
        $visible = 0;
        if (!set_field('dp_template', 'visible', $visible, 'id', $template->id)) {
            rollback_sql();
            notify('Could not update visibility of '.$template->fullname.' template!');
        } else {
            commit_sql();
        }
    }
}

if ((!empty($moveup) or !empty($movedown))) {

    $move = NULL;
    $swap = NULL;

    // Get value to move, and value to replace
    if (!empty($moveup)) {
        $move = get_record('dp_template', 'id', $moveup);
        $resultset = get_records_sql("
            SELECT *
            FROM {$CFG->prefix}dp_template
            WHERE
            sortorder < {$move->sortorder}
            ORDER BY sortorder DESC", 0, 1
        );
        if ( $resultset && count($resultset) ){
            $swap = reset($resultset);
            unset($resultset);
        }
    } else {
        $move = get_record('dp_template', 'id', $movedown);
        $resultset = get_records_sql("
            SELECT *
            FROM {$CFG->prefix}dp_template
            WHERE
            sortorder > {$move->sortorder}
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
        if (!(set_field('dp_template', 'sortorder', $move->sortorder, 'id', $swap->id)
            && set_field('dp_template', 'sortorder', $swap->sortorder, 'id', $move->id)
        )) {
            error(get_string('error:updatetemplateordering', 'local_plan'));
        }
        commit_sql();
    }
}

if($delete && $confirm) {
    if(confirm_sesskey()){
        begin_sql();
        if(!delete_records('dp_template', 'id', $delete) || !delete_records('dp_component_settings', 'templateid', $delete)){
            rollback_sql();
            totara_set_notification(get_string('error:deletedp', 'local_plan'), $CFG->wwwroot.'/local/plan/template/index.php');
        }

        if(!delete_records('dp_competency_settings', 'templateid', $delete)){
            rollback_sql();
            totara_set_notification(get_string('error:deletedp', 'local_plan'), $CFG->wwwroot.'/local/plan/template/index.php');
        }

        if(!delete_records('dp_course_settings', 'templateid', $delete)){
            rollback_sql();
            totara_set_notification(get_string('error:deletedp', 'local_plan'), $CFG->wwwroot.'/local/plan/template/index.php');
        }

        if(!delete_records('dp_objective_settings', 'templateid', $delete)){
            rollback_sql();
            totara_set_notification(get_string('error:deletedp', 'local_plan'), $CFG->wwwroot.'/local/plan/template/index.php');
        }

        if(!delete_records('dp_permissions', 'templateid', $delete)){
            rollback_sql();
            totara_set_notification(get_string('error:deletedp', 'local_plan'), $CFG->wwwroot.'/local/plan/template/index.php');
        }

        commit_sql();
        totara_set_notification(get_string('deletedp', 'local_plan'), $CFG->wwwroot.'/local/plan/template/index.php', array('style' => 'notifysuccess'));
    }
} else if($delete) {
    if(!$template = get_record('dp_template', 'id', $delete)){
        error(get_string('error:templateid', 'local_plan'));
    }

    if(count_records('dp_plan', 'templateid', $template->id) > 0){
        totara_set_notification(get_string('cannotdelete_inuse', 'local_plan'), $CFG->wwwroot.'/local/plan/template/index.php');
    }

    admin_externalpage_print_header();
    $deleteurl = $CFG->wwwroot.'/local/plan/template/index.php?delete='.$delete.'&amp;confirm=true&amp;sesskey='.sesskey();
    $returnurl = $CFG->wwwroot.'/local/plan/template/index.php';
    $strdelete = get_string('deletecheckdptemplate', 'local_plan');
    notice_yesno(
        "{$strdelete}<br /><br />".format_string($template->fullname),
        $deleteurl,
        $returnurl
    );

    print_footer();
    exit;
}

$mform = new dp_template_new_form();

if ($mform->is_cancelled()) {
    redirect($returnurl);
}
if ($fromform = $mform->get_data()) {
    if(empty($fromform->submitbutton)) {
        redirect($returnurl . '&amp;notice=' .
            DEVELOPMENT_PLAN_UNKNOWN_BUTTON_CLICKED);
    }
    else {
        if ( !count_records('dp_priority_scale') ){
            print_error('error:notemplatewithoutpriorityscale', 'local_plan');
        }

        if ( !count_records('dp_objective_scale') ){
            print_error('error:notemplatewithoutobjectivescale', 'local_plan');
        }

        begin_sql();

        $todb = new object();
        $todb->fullname = $fromform->templatename;
        $todb->startdate = dp_convert_userdate($fromform->startdate);
        $todb->enddate = dp_convert_userdate($fromform->enddate);
        $sortorder = count_records('dp_template') + 1;
        $todb->sortorder = $sortorder;
        $todb->visible = 1;
        // by default use first listed workflow
        global $DP_AVAILABLE_WORKFLOWS;
        reset($DP_AVAILABLE_WORKFLOWS);
        $workflow = current($DP_AVAILABLE_WORKFLOWS);
        $todb->workflow = $workflow;

        if(!$newtemplateid = insert_record('dp_template', $todb)) {
            rollback_sql();
            error(get_string('error:newdptemplate', 'local_plan'));
            die();
        }

        global $DP_AVAILABLE_COMPONENTS;
        foreach($DP_AVAILABLE_COMPONENTS as $component){
            $classfile = $CFG->dirroot .
                "/local/plan/components/{$component}/{$component}.class.php";
            if(!is_readable($classfile)) {
                $string_properties = new object();
                $string_properties->classfile = $class;
                $string_properties->component = $component;
                throw new PlanException(get_string('noclassfileforcomponent', 'local_plan', $string_properties));
            }
            include_once($classfile);

            // check class exists
            $class = "dp_{$component}_component";
            if(!class_exists($class)) {
                $string_properties = new object();
                $string_properties->class = $class;
                $string_properties->component = $component;
                throw new PlanException(get_string('noclassforcomponent', 'local_plan', $string_properties));
            }

            $defaultname = get_string($component.'_defaultname', 'local_plan');

            $cn = new object();
            $cn->templateid = $newtemplateid;
            $cn->component = $component;
            $cn->name = $defaultname;
            $cn->enabled = 1;
            $sortorder = get_field_sql("SELECT max(sortorder) FROM {$CFG->prefix}dp_component_settings");
            $cn->sortorder = $sortorder + 1;

            if(!$componentsettingid = insert_record('dp_component_settings', $cn)){
                rollback_sql();
                error(get_string('error:createcomponents', 'local_plan'));
                die();
            }
        }

        $classfile = $CFG->dirroot . "/local/plan/workflows/{$workflow}/{$workflow}.class.php";
        if(!is_readable($classfile)) {
            $string_properties = new object();
            $string_properties->classfile = $classfile;
            $string_properties->workflow = $workflow;
            throw new PlanException(get_string('noclassfileforworkflow', 'local_plan', $string_properties));
        }
        include_once($classfile);

        // check class exists
        $class = "dp_{$workflow}_workflow";
        if(!class_exists($class)) {
            $string_properties = new object();
            $string_properties->class = $classfile;
            $string_properties->workflow = $workflow;
            throw new PlanException(get_string('noclassforworkflow','local_plan', $string_properties));
        }

        // create an instance and save as a property for easy access
        $workflow_class = new $class();
        if(!$workflow_class->copy_to_db($newtemplateid)) {
            error(get_string('error:newdptemplate', 'local_plan'));
            die();
        }


        commit_sql();
        redirect($CFG->wwwroot . '/local/plan/template/general.php?id=' . $newtemplateid);
    }
}

admin_externalpage_print_header();

print_heading(get_string('managetemplates','local_plan'));

$templates = get_records('dp_template', null, null, 'sortorder');

if($templates){

    $str_hide = 'Hide';
    $str_show = 'Show';
    $str_edit = 'Edit';
    $str_remove = 'Delete';
    $str_moveup = get_string('moveup');
    $str_movedown = get_string('movedown');

    $columns[] = 'name';
    $headers[] = get_string('name', 'local_plan');
    $columns[] = 'instances';
    $headers[] = get_string('instances', 'local_plan');
    $columns[] = 'options';
    $headers[] = get_string('options', 'local_plan');

    $table = new flexible_table('Templates');
    $table->define_columns($columns);
    $table->define_headers($headers);
    $table->set_attribute('class', 'generalbox dp-templates');

    $table->setup();
    $spacer = "<img src=\"{$CFG->wwwroot}/pix/spacer.gif\" class=\"iconsmall\" alt=\"\" />";
    $count = 0;
    $numvalues = count($templates);
    foreach($templates as $template){
        $count++;
        $tablerow = array();

        $cssclass = !$template->visible ? 'class="dimmed"' : '';

        $title = "<a $cssclass href=\"$CFG->wwwroot/local/plan/template/general.php?id=$template->id\">$template->fullname</a>";
        if($count==1){
            $title .= ' ('.get_string('default').')';
        }
        $tablerow[] = $title;

        $tablerow[] = count_records('dp_plan', 'templateid', $template->id);

        $buttons = array();

        $buttons[] = "<a href=\"{$CFG->wwwroot}/local/plan/template/general.php?id={$template->id}\" title=\"$str_edit\">".
            "<img src=\"{$CFG->pixpath}/t/edit.gif\" class=\"iconsmall\" alt=\"$str_edit\" /></a>";

        $buttons[] = "<a href=\"{$CFG->wwwroot}/local/plan/template/index.php?delete={$template->id}\" title=\"$str_remove\">".
            "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_remove\" /></a>";


        // Re-add this once multiple templates can be selected
        /*if ($template->visible) {
            $buttons[] = "<a href=\"{$CFG->wwwroot}/local/plan/template/index.php?hide={$template->id}\" title=\"$str_hide\">".
                "<img src=\"{$CFG->pixpath}/t/hide.gif\" class=\"iconsmall\" alt=\"$str_hide\" /></a>";
        } else {
            $buttons[] = "<a href=\"{$CFG->wwwroot}/local/plan/template/index.php?show={$template->id}\" title=\"$str_show\">".
                "<img src=\"{$CFG->pixpath}/t/show.gif\" class=\"iconsmall\" alt=\"$str_show\" /></a>";
        }*/

        if ($count > 1) {
            $buttons[] = "<a href=\"{$CFG->wwwroot}/local/plan/template/index.php?moveup={$template->id}\" title=\"$str_moveup\">".
                "<img src=\"{$CFG->pixpath}/t/up.gif\" class=\"iconsmall\" alt=\"$str_moveup\" /></a>";
        } else {
            $buttons[] = $spacer;
        }

        // If value can be moved down
        if ($count < $numvalues) {
            $buttons[] = "<a href=\"{$CFG->wwwroot}/local/plan/template/index.php?movedown={$template->id}\" title=\"$str_movedown\">".
                "<img src=\"{$CFG->pixpath}/t/down.gif\" class=\"iconsmall\" alt=\"$str_movedown\" /></a>";
        } else {
            $buttons[] = $spacer;
        }

        $tablerow[] = implode($buttons, ' ');

        $table->add_data($tablerow);
    }
    $table->print_html();
}
else {
    echo get_string('notemplates', 'local_plan');
}

$mform->display();

print <<<HEREDOC
<script type="text/javascript">

    $(function() {
        $('#id_startdate, #id_enddate').datepicker(
            {
                dateFormat: 'dd/mm/yy',
                showOn: 'button',
                buttonImage: '../../../local/js/images/calendar.gif',
                buttonImageOnly: true
            }
        );
    });
</script>
HEREDOC;

print_footer();

function get_template_status($startdate, $enddate) {
    $now = time();
    if($startdate){
        if($startdate < $now) {
            if($enddate) {
                if($enddate < $now) {
                    $status = 'complete';
                } else {
                    $status = 'active';
                }
            } else {
                $status = 'active';
            }
        } else {
            $status = 'draft';
        }
    } else {
        if($enddate) {
            if($enddate < $now) {
                $status = 'complete';
            } else {
                $status = 'active';
            }
        } else {
            $status = 'draft';
        }
    }
    return $status;
}

?>
