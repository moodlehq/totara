<?php // $Id$
require_once($CFG->libdir.'/formslib.php');

/**
 * Extend the base assignment class for mahara portfolio assignments
 *
 */
class assignment_mahara extends assignment_base {

    private $remotehost;

    function assignment_mahara($cmid='staticonly', $assignment=NULL, $cm=NULL, $course=NULL) {
        parent::assignment_base($cmid, $assignment, $cm, $course);
        $this->type = 'mahara';
    }

    function view() {

        global $CFG, $USER;

        $saved = optional_param('saved', 0, PARAM_BOOL);

        $context = get_context_instance(CONTEXT_MODULE, $this->cm->id);
        require_capability('mod/assignment:view', $context);

        $submission = $this->get_submission();

        $editable = has_capability('mod/assignment:submit', $context) && $this->isopen()
            && (!$submission || $this->assignment->resubmit || !$submission->timemarked);

        if ($editable) {
            $viewid = optional_param('view', null, PARAM_INTEGER);
            if ($viewid && $this->submit_view($viewid)) {
                //TODO fix log actions - needs db upgrade
                $submission = $this->get_submission();
                add_to_log($this->course->id, 'assignment', 'upload',
                           'view.php?a='.$this->assignment->id, $this->assignment->id, $this->cm->id);
                $this->email_teachers($submission);
                //redirect to get updated submission date and word count
                redirect('view.php?id='.$this->cm->id.'&saved=1');
            }
        }

        add_to_log($this->course->id, "assignment", "view", "view.php?id={$this->cm->id}", $this->assignment->id, $this->cm->id);

        $this->view_header();

        $this->view_intro();


        print_box_start('generalbox boxwidthnormal boxaligncenter', 'dates');
        $this->view_dates();
        print_box_end();


        print_box_start('generalbox boxwidthnormal boxaligncenter centerpara');

        if ($submission) {
            if ($saved) {
                notify(get_string('submissionsaved', 'assignment'), 'notifysuccess');
            }
            $data = unserialize($submission->data2);
            echo '<div><strong>' . get_string('selectedview', 'assignment_mahara') . ': </strong>'
              . '<a href="' . $CFG->wwwroot . '/auth/mnet/jump.php?hostid=' . $this->remote_mnet_host_id()
              . '&amp;wantsurl=' . urlencode($data['url']) . '">' 
              . $data['title'] . '</a></div>';
        }

        if ($submission && $editable) {
            echo '<hr>';
        }

        if ($editable) {

            $query = optional_param('q', null, PARAM_TEXT);
            list($error, $views) = $this->get_views($query);

            if ($error) {
                echo $error;
            } else {
                $this->remotehost = get_record('mnet_host', 'id', $this->remote_mnet_host_id());
                $this->remotehost->jumpurl = $CFG->wwwroot . '/auth/mnet/jump.php?hostid=' . $this->remotehost->id;
                echo '<form><div>' . get_string('selectmaharaview', 'assignment_mahara', $this->remotehost) . '</div><br/>'
                  . '<input type="hidden" name="id" value="' . $this->cm->id . '">'
                  . '<label for="q">' . get_string('search') . ':</label> <input type="text" name="q" value="' . $query . '">'
                  . '</form>';
                if ($views['count'] < 1) {
                    echo get_string('noviewsfound', 'assignment_mahara', $this->remotehost->name);
                } else {
                    echo '<h4>' . $this->remotehost->name . ': ' . get_string('viewsby', 'assignment_mahara', $views['displayname']) . '</h4>';
                    echo '<table class="formtable"><thead>'
                      . '<tr><th>' . get_string('preview', 'assignment_mahara') . '</th>'
                      . '<th>' . get_string('submit') . '</th></tr>'
                      . '<tr><td style="padding:0 5px 0 5px;">(' . get_string('clicktopreview', 'assignment_mahara') . ')</td>'
                      . '<td style="padding:0 5px 0 5px;">(' . get_string('clicktoselect', 'assignment_mahara') . ')</td></tr>'
                      . '</thead><tbody>';
                    foreach ($views['data'] as &$v) {
                        $windowname = 'view' . $v['id'];
                        $viewurl = $this->remotehost->jumpurl . '&wantsurl=' . urlencode($v['url']);
                        $js = "this.target='$windowname';window.open('" . $viewurl . "', '$windowname', 'resizable,scrollbars,width=920,height=600');return false;";
                        echo '<tr><td><a href="' . $viewurl . '" target="_blank" onclick="' . $js . '">'
                          . '<img align="top" src="'.$CFG->pixpath.'/f/html.gif" height="16" width="16" alt="html" /> ' . $v['title'] . '</a></td>'
                          . '<td><a href="?id=' . $this->cm->id. '&view=' . $v['id'] . '">' . get_string('submit') . '</a></td></tr>';
                    }
                    echo '</tbody></table>';
                }
            }

        }
        print_box_end();

        $this->view_feedback();

        $this->view_footer();
    }

    /*
     * Display the assignment dates
     */
    function view_dates() {
        global $USER, $CFG;

        if (!$this->assignment->timeavailable && !$this->assignment->timedue) {
            return;
        }

        echo '<table>';
        if ($this->assignment->timeavailable) {
            echo '<tr><td class="c0">'.get_string('availabledate','assignment').':</td>';
            echo '    <td class="c1">'.userdate($this->assignment->timeavailable).'</td></tr>';
        }
        if ($this->assignment->timedue) {
            echo '<tr><td class="c0">'.get_string('duedate','assignment').':</td>';
            echo '    <td class="c1">'.userdate($this->assignment->timedue).'</td></tr>';
        }
        $submission = $this->get_submission($USER->id);
        if ($submission) {
            echo '<tr><td class="c0">'.get_string('lastedited').':</td>';
            echo '    <td class="c1">'.userdate($submission->timemodified).'</td></tr>';
        }
        echo '</table>';
    }

    function print_student_answer($userid, $return=false){
        global $CFG;
        if (!$submission = $this->get_submission($userid)) {
            return '';
        }
        $data = unserialize($submission->data2);
        return '<div><a href="' . $CFG->wwwroot . '/auth/mnet/jump.php?hostid=' . $this->remote_mnet_host_id()
          . '&amp;wantsurl=' . urlencode($data['url']) . '">' 
          . $data['title'] . '</a></div>';
    }

    function print_user_files($userid, $return=false) {
        echo $this->print_student_answer($userid, $return);
    }

    function setup_elements(&$mform) {
        global $CFG, $COURSE;

        // Get Mahara hosts we are doing SSO with
        $sql = "
             SELECT DISTINCT 
                 h.id, 
                 h.name
             FROM 
                 {$CFG->prefix}mnet_host h,
                 {$CFG->prefix}mnet_application a,
                 {$CFG->prefix}mnet_host2service h2s_IDP,
                 {$CFG->prefix}mnet_service s_IDP,
                 {$CFG->prefix}mnet_host2service h2s_SP,
                 {$CFG->prefix}mnet_service s_SP
             WHERE
                 h.id != '{$CFG->mnet_localhost_id}' AND
                 h.id = h2s_IDP.hostid AND
                 h.deleted = 0 AND
                 h.applicationid = a.id AND
                 h2s_IDP.serviceid = s_IDP.id AND
                 s_IDP.name = 'sso_idp' AND
                 h2s_IDP.publish = '1' AND
                 h.id = h2s_SP.hostid AND
                 h2s_SP.serviceid = s_SP.id AND
                 s_SP.name = 'sso_idp' AND
                 h2s_SP.publish = '1' AND
                 a.name = 'mahara'
             ORDER BY
                 h.name";

        if ($hosts = get_records_sql($sql)) {
            foreach ($hosts as &$h) {
                $h = $h->name;
            }
            $mform->addElement('select', 'var2', get_string("site"), $hosts);
            $mform->setHelpButton('var2', array('var2', get_string('site', 'assignment'), 'assignment'));
            $mform->setDefault('var2', key($hosts));
        }
        else {
            $mform->addElement('static', '', '', get_string('nomaharahostsfound', 'assignment'));
        }

        $ynoptions = array( 0 => get_string('no'), 1 => get_string('yes'));

        $mform->addElement('select', 'resubmit', get_string("allowresubmit", "assignment"), $ynoptions);
        $mform->setHelpButton('resubmit', array('resubmit', get_string('allowresubmit', 'assignment'), 'assignment'));
        $mform->setDefault('resubmit', 0);

        $mform->addElement('select', 'emailteachers', get_string("emailteachers", "assignment"), $ynoptions);
        $mform->setHelpButton('emailteachers', array('emailteachers', get_string('emailteachers', 'assignment'), 'assignment'));
        $mform->setDefault('emailteachers', 0);

        $mform->addElement('select', 'var1', get_string("commentinline", "assignment"), $ynoptions);
        $mform->setHelpButton('var1', array('commentinline', get_string('commentinline', 'assignment'), 'assignment'));
        $mform->setDefault('var1', 0);

    }

    function remote_mnet_host_id() {
        return $this->assignment->var2;
    }

    function get_mnet_sp() {
        global $CFG, $MNET;
        require_once $CFG->dirroot . '/mnet/peer.php';
        $mnet_sp = new mnet_peer();
        $mnet_sp->set_id($this->remote_mnet_host_id());
        return $mnet_sp;
    }

    function submit_view($viewid) {
        global $CFG, $USER, $MNET;

        $submission = $this->get_submission($USER->id, true);

        require_once $CFG->dirroot . '/mnet/xmlrpc/client.php';
        $mnet_sp = $this->get_mnet_sp();
        $mnetrequest = new mnet_xmlrpc_client();
        $mnetrequest->set_method('mod/mahara/rpclib.php/submit_view_for_assessment');
        $mnetrequest->add_param($USER->username);
        $mnetrequest->add_param($viewid);

        if ($mnetrequest->send($mnet_sp) !== true) {
            return false;
        }
        $data = $mnetrequest->response;

        $mahara_outcomes = array();

        foreach ($data['outcome'] as &$o) {
            $scale1 = array();
            foreach ($o['scale'] as &$item) {
                $scale1[$item['value']] = $item['name'];
            }
            $mahara_outcomes[$o['outcome']][] = array('scale' => $scale1, 'grade' => $o['grade']);
        }

        unset($data['outcome']);

        $update = new object();
        $update->id           = $submission->id;
        $update->timemodified = time();

        $update->data1 = addslashes('<a href="' . $data['fullurl'] . '">' . clean_text($data['title']) . '</a>');
        $update->data2 = addslashes(serialize($data));


        // If mahara sent attached outcomes along with the view, and we have outcomes here with
        // matching names and a matching scale, and we don't already have those outcomes, then
        // import them.
        require_once($CFG->libdir.'/gradelib.php');
        $grading_info = grade_get_grades($this->course->id, 'mod', 'assignment', $this->assignment->id, $USER->id);

        if (!empty($grading_info->outcomes)) {
            $scales = array();
            $import = array();
            foreach($grading_info->outcomes as $o) {
                // If we already have a grade for this outcome, the assignment is just a
                // resubmission, not a new import.  Ignore it.
                if ($o->grades[$userid] && $o->grades[$userid]->grade) {
                    continue;
                }
                if (isset($mahara_outcomes[$o->name])) {
                    if (!isset($scales[$o->scaleid])) {
                        $scales[$o->scaleid] = make_grades_menu(-$o->scaleid);
                    }
                    foreach ($mahara_outcomes[$o->name] as $mahara_scale_grade) {
                        if ($scales[$o->scaleid] == $mahara_scale_grade['scale']) {
                            // Found a match; import the grade
                            $import[$o->itemnumber] = $mahara_scale_grade['grade'];
                            break;
                        }
                    }
                }
            }
            if (count($import) > 0) {
                grade_update_outcomes('mod/assignment', $this->course->id, 'mod', 'assignment', $this->assignment->id, $USER->id, $import);
            }
        }

        if (!update_record('assignment_submissions', $update)) {
            return false;
        }

        $submission = $this->get_submission($USER->id);
        $this->update_grade($submission);
        return true;
    }

    function get_views($query) {
        global $CFG, $USER, $MNET;

        $error = false;
        $viewdata = array();
        if (!is_enabled_auth('mnet')) {
            $error = get_string('authmnetdisabled', 'mnet');
        } else if (!has_capability('moodle/site:mnetlogintoremote', get_context_instance(CONTEXT_SYSTEM), NULL, false)) {
            $error = get_string('notpermittedtojump', 'mnet');
        } else {
            // set up the RPC request
            require_once $CFG->dirroot . '/mnet/xmlrpc/client.php';
            $mnet_sp = $this->get_mnet_sp();
            $mnetrequest = new mnet_xmlrpc_client();
            $mnetrequest->set_method('mod/mahara/rpclib.php/get_views_for_user');
            $mnetrequest->add_param($USER->username);
            $mnetrequest->add_param($query);

            if ($mnetrequest->send($mnet_sp) === true) {
                $viewdata = $mnetrequest->response;
            } else {
                $error = "RPC mod/mahara/rpclib.php/get_views_for_user:<br/>";
                foreach ($mnetrequest->error as $errormessage) {
                    list($code, $errormessage) = array_map('trim',explode(':', $errormessage, 2));
                    $error .= "ERROR $code:<br/>$errormessage<br/>";
                }
            }
        }
        return array($error, $viewdata);
    }

    function process_outcomes($userid) {
        global $CFG, $MNET, $USER;
        parent::process_outcomes($userid);

        // Export outcomes to the mahara site
        $grading_info = grade_get_grades($this->course->id, 'mod', 'assignment', $this->assignment->id, $userid);

        if (empty($grading_info->outcomes)) {
            return;
        }

        if (!$submission = $this->get_submission($userid)) {
            return;
        }

        $data = unserialize($submission->data2);

        $viewoutcomes = array();

        foreach($grading_info->outcomes as $o) {
            $scale = make_grades_menu(-$o->scaleid);
            if (!isset($scale[$o->grades[$userid]->grade])) {
                continue;
            }
            // Save array keys; they get lost on the way
            foreach ($scale as $k => $v) {
                $scale[$k] = array('name' => $v, 'value' => $k);
            }
            $viewoutcomes[] = array(
                'name' =>  $o->name,
                'scale' => $scale,
                'grade' => $o->grades[$userid]->grade,
            );
        }

        require_once $CFG->dirroot . '/mnet/xmlrpc/client.php';
        $mnet_sp = $this->get_mnet_sp();
        $mnetrequest = new mnet_xmlrpc_client();
        $mnetrequest->set_method('mod/mahara/rpclib.php/release_submitted_view');
        $mnetrequest->add_param($data['id']);
        $mnetrequest->add_param($viewoutcomes);
        $mnetrequest->add_param($USER->username);
        // Do something if this fails?  Or use cron to export the same data later?
        $mnetrequest->send($mnet_sp);
    }

}
?>
