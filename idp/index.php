<?php
/**
 * This page prints the list of Learning Plans
 **/

require_once('../config.php');
require_once('lib.php');

$userid = optional_param('userid', $USER->id, PARAM_INT); // listing this user's IDP
$summary = optional_param('summary', false, PARAM_BOOL); // show the evaluation summary page
$recordoflearning = optional_param('recordoflearning', false, PARAM_BOOL); // show the record of learning page
$page = optional_param('page', 0, PARAM_INT);  // current page number
$orderby = optional_param('orderby', 'approvaltime', PARAM_ALPHA); // Column to sort by in the manager overview page
$ovorderby = optional_param('ovorderby', 'name', PARAM_ALPHA); // Column to sort by in the manager overview page
$showapproved = optional_param('showapproved', 0, PARAM_INT); // Set to 1 to show only pending plans
$print = optional_param('print', 0, PARAM_INT); // Print-friendly view
$planid = optional_param('planid', PARAM_INT);
$current = optional_param('current', PARAM_INT);

// If they requested to view the user's record of learning, then send them there
if ( $recordoflearning ){
    redirect($CFG->wwwroot . '/my/records.php?id=' . $userid);
}

require_login();

$contextsite = get_context_instance(CONTEXT_SYSTEM);
$contextuser = get_context_instance(CONTEXT_USER, $userid);

$manageroverview = false;
$ownpage = ($USER->id == $userid);

if ($ownpage) {
    // Looking at your own page
    require_capability('moodle/local:idpviewownlist', $contextsite);
}
else {
    $user = get_record('user', 'id', $userid);
    // Looking at another user's page
    if (has_capability('moodle/local:idpmanageroverview', $contextuser) &&
        has_capability('moodle/local:idpmanagerownoverview', $contextsite, $userid)) {

        $manageroverview = true;
    }
    else {
        require_capability('moodle/local:idpviewlist', $contextuser);
    }
}

//Sets current an IDP to current and unsets all others
if ($planid && $userid && ($current==1)){
    require_capability('moodle/local:idpsetcurrent', $contextuser);

    $sql = "UPDATE {$CFG->prefix}idp "
        . "SET current=0 "
        . "WHERE userid={$userid};";
    execute_sql($sql, false);

    $sql2 = "UPDATE {$CFG->prefix}idp "
        . "SET current=1 "
        . "WHERE id={$planid};";
    execute_sql($sql2, false);
}

add_to_log(SITEID, 'idp', 'view', "idp/index.php");

$stridps = get_string('idps', 'idp');

$PAGE = page_create_object('MITMS', $USER->id);
$pageblocks = blocks_setup($PAGE,BLOCKS_PINNED_BOTH);
$blocks_preferred_width = bounded_number(180, blocks_preferred_width($pageblocks[BLOCK_POS_LEFT]), 210);

$navlinks = array();

if ($summary) {
    $navlinks[] = array('name' => $stridps, 'link' => $CFG->wwwroot."/idp/index.php", 'type' => 'home');
    $navlinks[] = array('name' => get_string('evaluationsummary', 'idp'), 'link' => '', 'type' => 'home');
}
else {
    if ($ownpage) {
        $navlinks[] = array('name' => $stridps, 'link' => $CFG->wwwroot."/idp/index.php", 'type' => 'home');
    }
    else {
        $navlinks[] = array('name' => $stridps, 'link' => $CFG->wwwroot."/idp/index.php", 'type' => 'home');
        $navlinks[] = array('name' => fullname($user), 'link' => '', 'type' => 'home');
    }
}

$PAGE->print_header($stridps, $navlinks);

echo '<table id="layout-table">';
echo '<tr valign="top">';

$lt = (empty($THEME->layouttable)) ? array('left', 'middle', 'right') : $THEME->layouttable;
foreach ($lt as $column) {
    switch ($column) {
    case 'left':

        if(blocks_have_content($pageblocks, BLOCK_POS_LEFT) || $PAGE->user_is_editing()) {
            echo '<td style="vertical-align: top; width: '.$blocks_preferred_width.'px;" id="left-column">';
            print_container_start();
            blocks_print_group($PAGE, $pageblocks, BLOCK_POS_LEFT);
            print_container_end();
            echo '</td>';
        } else {
            echo '<td id="left-column"></td>';
        }

    break;
    case 'middle':

        echo '<td valign="top" id="middle-column">';
        if ($summary) {
            // Evaluation Summary page
            print print_button();
            print '<h1>'.get_string('evaluationsummarytitle', 'idp').'</h1>';

            print_evaluation_summary($userid);

            print '<p id="backtoplanslink"><a href="index.php?userid='.$userid.'">'.
                get_string('backlearningplans', 'idp').'</a></p>';
        }
        elseif ($manageroverview) {
            $perpage = 20;
            $hasplans = false;
            $canviewplans = true;
            print '<h1>';
            if ( $ownpage ) {
                print get_string('myidps', 'idp');
            } else {
                print get_string('idpsfor', 'idp', fullname($user, true));
            }
            print '</h1>';
            $hasplans = print_user_learning_plans($userid, $canviewplans, $page, $perpage, $orderby);
            if ( $hasplans || ($ownpage && has_capability('moodle/local:idpeditownplan',$contextsite)) ){
                print '<table width="80%"><tr>';
            }
            if ($ownpage && has_capability('moodle/local:idpeditownplan', $contextsite)) {
                // Create new plan button
                print '<td><form method="get" action="plan.php"><div>';
                print '<input type="hidden" name="action" value="create" />';
                print '<input type="submit" value="'.get_string('createnewplan', 'idp').'" />';
                print "</div></form></td>\n";
            }

            if ($hasplans) {
                // Evaluation Summary button
                print '<td align="right"><form method="get" action="index.php"><div>';
                print '<input type="hidden" name="userid" value="'.$userid.'" />';
                print '<input type="hidden" name="summary" value="1" />';
                print '<input type="submit" value="'.get_string('viewsummary', 'idp').'" />';
                print '</div></form></td>';
            }
            if ( $hasplans || ($ownpage && has_capability('moodle/local:idpeditownplan',$contextsite)) ){
                print '</tr></table>';
            }

            // manager overview
            print '<h1>'.get_string('manageroverviewtitle', 'idp').'</h1>';

            // Get all of the plans
            $plans = get_plans($userid);
            $nbplans = count($plans);

            $trainees = get_trainees($userid);

            if ($trainees and count($trainees) > 0) {
                // Show submitted/approved plans
                print '<h2>'.get_string('learningplanapproval', 'idp')."</h2>\n";

                // JavaScript selector to filter in/out the approved plans
                print '<p><b>'.get_string('filter', 'idp').'</b>&nbsp;<select name="showapproved"';
                print " onchange=\"window.location='index.php?userid=$userid&amp;orderby=$orderby&amp;showapproved=' + this.value\">";
                print '<option '.($showapproved ? 'selected="selected"' : '').' value="1">';
                print get_string('showapprovedplans', 'idp').'</option>';
                print '<option '.($showapproved ? '' : 'selected="selected"').' value="0">';
                print get_string('hideapprovedplans', 'idp').'</option>';
                print "</select></p>\n";

                print_pending_plans($trainees, $orderby, $showapproved);
            }

        }
        else {
            // Trainee summary
            print '<h1>';
            if ( $ownpage ) {
                print get_string('myidps', 'idp');
            } else {
                print get_string('idpsfor', 'idp', fullname($user, true));
            }
            print '</h1>';

            $hasplans = false;
            {
                $perpage = 20;

                $canviewplans = false;
                if ($ownpage) {
                    if (has_capability('moodle/local:idpviewownplan', $contextsite)) {
                        $canviewplans = true;
                    }
                } else {
                    if (has_capability('moodle/local:idpviewplan', $contextuser)) {
                        $canviewplans = true;
                    }
                }

                if (empty($orderby) || $orderby == 'approvaltime') {
                    $orderby = 'mtime';
                }
                $hasplans = print_user_learning_plans($userid, $canviewplans, $page, $perpage, $orderby);
            }

            if ( $hasplans || ($ownpage && has_capability('moodle/local:idpeditownplan', $contextsite)) ){
                print '<table width="738px"><tr>';
            }
            if ($ownpage && has_capability('moodle/local:idpeditownplan', $contextsite)) {
                // Create new plan button
                print '<td><form method="get" action="plan.php"><div>';
                print '<input type="hidden" name="action" value="create" />';
                print '<input type="submit" value="'.get_string('createnewplan', 'idp').'" />';
                print "</div></form></td>\n";
            }

            if ($hasplans) {
                // Evaluation Summary button
                print '<td align="right"><form method="get" action="index.php"><div>';
                print '<input type="hidden" name="userid" value="'.$userid.'" />';
                print '<input type="hidden" name="recordoflearning" value="1" />';
                print '<input type="submit" value="'.get_string('recordoflearning', 'local').'" />';
                print '</div></form></td>';
            }

            if ( $hasplans || ($ownpage && has_capability('moodle/local:idpeditownplan', $contextsite)) ){
                print "</tr></table>\n";
            }

        }
        echo '</td>';

    break;
    }
}

/// Finish the page
echo '</tr></table>';

print_footer();

?>
