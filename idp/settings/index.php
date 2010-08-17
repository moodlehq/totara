<?php
require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once('../idp_forms.php');
require_once('../comparea/lib.php');

define('UPDATE_TEMPLATE_SUCCESS', 1);
define('UPDATE_TEMPLATE_FAIL', 2);
define('UPDATE_TEMPLATE_UNKNOWN_BUTTON', 3);

$id = optional_param('id', 1, PARAM_INT); // Temp while there is only 1 template allowed
$action = optional_param('action', false, PARAM_BOOL); // action
$moveup = optional_param('moveup', 0, PARAM_INT);
$movedown = optional_param('movedown', 0, PARAM_INT);
$notice = optional_param('notice', 0, PARAM_INT);

admin_externalpage_setup('idptemplate');

if(!$plantemplate = get_record('idp_template', 'id', $id)){
    echo 'DEAD';
}

if ((!empty($moveup) or !empty($movedown))) {

    $move = NULL;
    $swap = NULL;

    // Get value to move, and value to replace
    if (!empty($moveup)) {
        $move = get_record('idp_comp_area', 'id', $moveup);
        $resultset = get_records_sql("
            SELECT *
            FROM {$CFG->prefix}idp_comp_area
            WHERE
            templateid = {$plantemplate->id}
            AND sortorder < {$move->sortorder}
            ORDER BY sortorder DESC", 0, 1
        );
        if ( $resultset && count($resultset) ){
            $swap = reset($resultset);
            unset($resultset);
        }
    } else {
        $move = get_record('idp_comp_area', 'id', $movedown);
        $resultset = get_records_sql("
            SELECT *
            FROM {$CFG->prefix}idp_comp_area
            WHERE
            templateid = {$plantemplate->id}
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
        if (!(    set_field('idp_comp_area', 'sortorder', $move->sortorder, 'id', $swap->id)
            && set_field('idp_comp_area', 'sortorder', $swap->sortorder, 'id', $move->id)
        )) {
            error('Could not update comp area ordering!');
        }
        commit_sql();
    }
}

$templateid = $plantemplate->id;
$returnurl = "{$CFG->wwwroot}/idp/settings/index.php?id={$templateid}";

$prioritytype = new object();
$prioritytype->prioritytype = get_field('idp_tmpl_priority_assign', 'priorityscaleid', 'templateid', $templateid);
if(!$prioritytype->prioritytype)
    $prioritytype->prioritytype = '0';

$planname = $plantemplate->fullname;
$templateid = $plantemplate->id;

$mform =& new idp_edit_priority_form(null, compact('id','prioritytype', 'templateid'));
$mform->set_data($prioritytype);

if ($mform->is_cancelled()) {
    redirect($CFG->wwwroot.'/idp/settings/index.php');
}
if ($fromform = $mform->get_data()) {
    if(empty($fromform->submitbutton)) {
        redirect($returnurl.'&amp;notice='.UPDATE_TEMPLATE_UNKNOWN_BUTTON);
    }
    $now = time();
    $todb = new object();
    $todb->id = $fromform->id;
    $todb->templateid = $fromform->templateid;
    $todb->priorityscaleid = $fromform->prioritytype;
    $todb->timemodified = $now;
    $todb->usermodified = '1';
    if($assign = get_record('idp_tmpl_priority_assign', 'templateid', $fromform->templateid)){
        $todb->id = $assign->id;
        if(!update_record('idp_tmpl_priority_assign', $todb))
            redirect($returnurl.'&amp;notice='.UPDATE_TEMPLATE_FAIL);
        else
            redirect($returnurl.'&amp;notice='.UPDATE_TEMPLATE_SUCCESS);
    }
    else{
        if(!insert_record('idp_tmpl_priority_assign', $todb))
            redirect($returnurl.'&amp;notice='.UPDATE_TEMPLATE_FAIL);
        else
            redirect($returnurl.'&amp;notice='.UPDATE_TEMPLATE_SUCCESS);
    }
}

admin_externalpage_print_header();

if($notice){
    switch($notice){
    case UPDATE_TEMPLATE_SUCCESS:
        notify(get_string('updatetemplatesuccess', 'idp'), 'notifysuccess');
        break;
    case UPDATE_TEMPLATE_FAIL:
        notify(get_string('error:updatetemplatefail', 'idp'));
        break;
    case UPDATE_TEMPLATE_UNKNOWN_BUTTON:
        notify(get_string('error:unknownbuttonclicked', 'local'));
        break;
    }
}

print '<h1>'.get_string('developmentplan', 'idp', $planname).'</h1>';
echo '<div align:left>';
$mform->display();
echo '</div>';

$lt = (empty($THEME->layouttable)) ? array('left', 'middle', 'right') : $THEME->layouttable;

$areas = get_competency_areas();
if(count($areas)>0){
    comp_area_display_table($areas, $editingon=1, $id);
}
else {
    print '<p><i>'.get_string('emptyplancompetencyareas', 'idp')."</i></p>\n";
}

print_footer();

?>
