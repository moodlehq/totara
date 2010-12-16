<?php // $Id$

/**
 * General settings page for development plan templates
 *
 * @copyright Catalyst IT Limited
 * @author Alastair Munro
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage plan
 */

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot . '/local/js/lib/setup.php');
require_once('template_forms.php');
require_once($CFG->dirroot . '/local/plan/lib.php');

$id = required_param('id', PARAM_INT);
$notice = optional_param('notice', 0, PARAM_INT); // notice flag

admin_externalpage_setup('managetemplates');

//Javascript include
local_js(array(
    TOTARA_JS_DIALOG,
    TOTARA_JS_DATEPICKER
));

$returnurl = $CFG->wwwroot."/local/plan/template/general.php?id=$id";

if($id) {
    if(!$template = get_record('dp_template', 'id', $id)) {
        error(get_string('error:invalidtemplateid', 'local_plan'));
    }
}

$mform = new dp_template_general_settings_form(null, compact('id'));

// form results check
if ($mform->is_cancelled()) {
    redirect($returnurl);
}
if ($fromform = $mform->get_data()) {

    if(empty($fromform->submitbutton)) {
        totara_set_notification(get_string('error:unknownbuttonclicked', 'local_plan'), $returnurl);
    }
    if(update_general_settings($id, $fromform)) {
        totara_set_notification(get_string('update_general_settings', 'local_plan'), $returnurl, array('style' => 'notifysuccess'));
    } else {
        totara_set_notification(get_string('error:update_general_settings', 'local_plan'), $returnurl);
    }
}

$navlinks = array();    // Breadcrumbs
$navlinks[] = array('name'=>get_string("managetemplates", "local_plan"),
                    'link'=>"{$CFG->wwwroot}/local/plan/template/index.php",
                    'type'=>'misc');
$navlinks[] = array('name'=>format_string($template->fullname), 'link'=>'', 'type'=>'misc');

admin_externalpage_print_header('', $navlinks);

if($template){
    print_heading($template->fullname);
} else {
    print_heading(get_string('newtemplate', 'local_plan'));
}

$currenttab = 'general';
require('tabs.php');

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

admin_externalpage_print_footer();


function update_general_settings($id, $fromform){
    $todb = new object();
    $todb->id = $id;
    $todb->fullname = $fromform->templatename;
    $todb->startdate = dp_convert_userdate($fromform->startdate);
    $todb->enddate = dp_convert_userdate($fromform->enddate);

    begin_sql();
    if(!update_record('dp_template', $todb)){
        echo 'Epic fail';
        rollback_sql();
        return false;
    }

    commit_sql();
    return true;
}

?>
