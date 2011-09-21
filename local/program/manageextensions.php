<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
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
 * @author Alastair Munro <alastair.munro@totaralms.com>
 * @package totara
 * @subpackage program
 */


require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');

require_login();

$submitted = optional_param('submitbutton', null, PARAM_TEXT); //form submitted
$userid = optional_param('userid', 0, PARAM_INT);

if ((!empty($userid) && !totara_is_manager($userid, $USER->id)) && !has_capability('moodle/site:doanything', get_context_instance(CONTEXT_SYSTEM))) {
    error(get_string('nopermissions', 'error', get_string('manageextensions', 'local_program')));
}

define('PROG_EXTENSION_GRANT', 1);
define('PROG_EXTENSION_DENY', 2);

if ($submitted && confirm_sesskey()) {
    $extensions = optional_param('extension', array(), PARAM_INT);

    if (!empty($extensions)) {
        $update_fail_count = 0;
        $update_extension_count = 0;

        foreach ($extensions as $id => $action) {
            if ($action == 0) {
                continue;
            }

            $update_extension_count++;

            if (!$extension = get_record('prog_extension', 'id', $id)) {
                error(get_string('error:couldnotloadextension', 'local_program'));
            }

            if (!totara_is_manager($extension->userid)) {
                error(get_string('error:notusersmanager', 'local_program'));
            }

            if (!$roleid = get_field('role', 'id', 'shortname', 'student')) {
                print_error('error:failedtofindstudentrole', 'local_program');
            }

            if ($action == PROG_EXTENSION_DENY) {

                $userto = get_record('user', 'id', $extension->userid);
                $userfrom = totara_get_manager($extension->userid);

                $messagedata = new stdClass();
                $messagedata->userto           = $userto;
                $messagedata->userfrom         = $userfrom;
                $messagedata->roleid           = $roleid;
                $messagedata->subject          = get_string('extensiondenied', 'local_program');;
                $messagedata->contexturl       = $CFG->wwwroot.'/local/program/required.php?id='.$extension->programid;
                $messagedata->contexturlname   = get_string('launchprogram', 'local_program');
                $messagedata->fullmessage      = get_string('extensiondeniedmessage', 'local_program');

                $eventdata = new stdClass();
                $eventdata->message = $messagedata;

                if ($result = tm_alert_send($messagedata)) {

                    $extension_todb = new stdClass();
                    $extension_todb->id = $extension->id;
                    $extension_todb->status = PROG_EXTENSION_DENY;

                    if (!update_record('prog_extension', $extension_todb)) {
                        $update_fail_count++;
                    }
                } else {
                    error(get_string('error:failedsendextensiondenyalert' ,'local_program'));
                }
            } elseif ($action == PROG_EXTENSION_GRANT) {
                // Load the program for this extension
                $extension_program = new program($extension->programid);

                if ($prog_completion = get_record('prog_completion', 'programid', $extension_program->id, 'userid', $extension->userid, 'coursesetid', 0)) {
                    $duedate = empty($prog_completion->timedue) ? 0 : $prog_completion->timedue;

                    if ($extension->extensiondate < $duedate) {
                        $update_fail_count++;
                        continue;
                    }
                }

                $now = time();
                if ($extension->extensiondate < $now) {
                    $update_fail_count++;
                    continue;
                }

                // Try to update due date for program using extension date
                if (!$extension_program->set_timedue($extension->userid, $extension->extensiondate)) {
                    $update_fail_count++;
                    continue;
                } else {
                    $userto = get_record('user', 'id', $extension->userid);
                    if (!$userto) {
                        print_error('error:failedtofinduser', 'local_program', $extension->userid);
                    }

                    $userfrom = totara_get_manager($extension->userid);

                    $messagedata = new stdClass();
                    $messagedata->userto           = $userto;
                    $messagedata->userfrom         = $userfrom;
                    $messagedata->roleid           = $roleid;
                    $messagedata->subject          = get_string('extensiongranted', 'local_program');
                    $messagedata->contexturl       = $CFG->wwwroot.'/local/program/required.php?id='.$extension->programid;
                    $messagedata->contexturlname   = get_string('launchprogram', 'local_program');
                    $messagedata->fullmessage      = get_string('extensiongrantedmessage', 'local_program', userdate($extension->extensiondate, '%d/%m/%Y', $CFG->timezone));

                    if ($result = tm_alert_send($messagedata)) {

                        $extension_todb = new stdClass();
                        $extension_todb->id = $extension->id;
                        $extension_todb->status = PROG_EXTENSION_GRANT;

                        if (!update_record('prog_extension', $extension_todb)) {
                            $update_fail_count++;
                        }
                    } else {
                        error(get_string('error:failedsendextensiongrantalert','local_program'));
                    }
                }
            }
        }

        if ($update_extension_count == 0) {
            redirect('manageextensions.php');
        } elseif($update_fail_count == $update_extension_count && $update_fail_count > 0) {
            totara_set_notification(get_string('updateextensionfailall', 'local_program'), 'manageextensions.php?userid='.$userid);
        } elseif ($update_fail_count > 0) {
            totara_set_notification(get_string('updateextensionfailcount', 'local_program', $update_fail_count), 'manageextensions.php?userid='.$userid);
        } else {
            totara_set_notification(get_string('updateextensionsuccess', 'local_program'), 'manageextensions.php?userid='.$userid, array('style' => 'notifysuccess'));
        }
    }
}


$heading = get_string('manageextensions', 'local_program');
$pagetitle = get_string('extensions', 'local_program');
$navlinks = array();
$navlinks[] = array('name' => $heading, 'link'=> '', 'type'=>'title');
$navigation = build_navigation($navlinks);

print_header_simple($pagetitle, '', $navigation, '', null, true, '');

if (!empty($userid)) {
    $backstr = "&laquo" . get_string('backtoallextrequests', 'local_program');
    echo "<p><a href=\"{$CFG->wwwroot}/local/program/manageextensions.php\">{$backstr}</a></p>";
}

print_heading($heading);

if(!empty($userid)) {
    if(!$user = get_record('user', 'id', $userid)) {
        error('Invalid userid');
    }
    $user_fullname = fullname($user);

    $staff_ids = $userid;
} elseif ($staff_members = totara_get_staff()) {
    $staff_ids = implode(',', $staff_members);
}

if (!empty($staff_ids)) {
    $sql = "SELECT * FROM {$CFG->prefix}prog_extension
        WHERE status = 0
        AND userid IN ({$staff_ids})";

    $extensions = get_records_sql($sql);

    if ($extensions) {

        $columns[] = 'user';
        $headers[] = get_string('name');
        $columns[] = 'program';
        $headers[] = get_string('program', 'local_program');
        $columns[] = 'currentdate';
        $headers[] = get_string('currentduedate', 'local_program');
        $columns[] = 'extensiondate';
        $headers[] = get_string('extensiondate', 'local_program');
        $columns[] = 'reason';
        $headers[] = get_string('reason', 'local_program');
        $columns[] = 'grant';
        $headers[] = get_string('grantdeny', 'local_program');

        $table = new flexible_table('Extensions');
        $table->define_columns($columns);
        $table->define_headers($headers);

        $table->setup();

        $options = array(
            PROG_EXTENSION_GRANT => get_string('grant', 'local_program'),
            PROG_EXTENSION_DENY => get_string('deny', 'local_program'),
        );

        foreach ($extensions as $extension) {
            $tablerow = array();

            if ($prog_completion = get_record('prog_completion', 'programid', $extension->programid, 'userid', $extension->userid, 'coursesetid', 0)) {
                $duedatestr = empty($prog_completion->timedue) ? get_string('duedatenotset', 'local_program') : userdate($prog_completion->timedue, '%e %h %Y', $CFG->timezone, false);
            }

            $prog_name = get_field('prog', 'fullname', 'id', $extension->programid);
            $prog_name = empty($prog_name) ? '' : $prog_name;

            $user = get_record('user', 'id', $extension->userid);
            $tablerow[] = fullname($user);
            $tablerow[] = $prog_name;
            $tablerow[] = $duedatestr;
            $tablerow[] = userdate($extension->extensiondate, '%e %h %Y', $CFG->timezone, false);
            $tablerow[] = $extension->extensionreason;

            $pulldown_name = "extension[{$extension->id}]";
            $pulldown_menu = choose_from_menu(
                $options,
                $pulldown_name,
                $extension->status,
                'choose',
                '',
                0,
                true,
                false,
                0,
                '',
                false,
                false,
                'approval'
            );

            $tablerow[] = $pulldown_menu;
            $table->add_data($tablerow);
        }

        $currenturl = qualified_me();

        if (!empty($userid)) {
            echo '<p>' . get_string('viewinguserextrequests', 'local_program', $user_fullname) . '</p>';
        }

        print '<form id="program-extension-update" action="' . $currenturl . '" method="POST">';
        print '<input type="hidden" id="sesskey" name="sesskey" value="'.sesskey().'" />';

        $table->print_html();

        print '<br /><input type="submit" name="submitbutton" value="'.get_string('updateextensions', 'local_program').'" />';
        print '</form>';
    } elseif (!empty($userid)) {
        echo '<p>' . get_string('nouserextensions', 'local_program', $user_fullname) . '</p>';
    } else {
        echo '<p>' . get_string('noextensions', 'local_program') . '</p>';
    }
} else {
    echo '<p>' . get_string('notmanager', 'local_program') . '</p>';
}

print_footer();

?>
