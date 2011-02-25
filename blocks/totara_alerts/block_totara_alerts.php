<?PHP //$Id$
  /*
  * Totara Alerts
  *
  * @package blocks
  * @subpackage totara_alerts
  * @author: Piers Harding
  * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
  * @copyright  (C) 1999 onwards Martin Dougiamas  http://dougiamas.com
  */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/local/totara_msg/lib.php');

class block_totara_alerts extends block_base {
    function init() {
        $this->title = get_string('blockname', 'block_totara_alerts');
        $this->version = 2010110101;
    }

    // only one instance of this block is required
    function instance_allow_multiple() {
      return false;
    } //instance_allow_multiple

    // label and button values can be set in admin
    function has_config() {
      return false;
    } //has_config

    function preferred_width() {
        return 210;
    }

    function get_content() {
        global $CFG, $USER, $COURSE, $FULLME;

        //cache block contents
        if ($this->content !== NULL) {
        return $this->content;
        }

        $this->content = new stdClass;

        // initialise jquery requirements
        require_once($CFG->dirroot.'/local/reportbuilder/lib.php');
        require_once($CFG->dirroot.'/local/js/lib/setup.php');
        $code = array();
        $code[] = TOTARA_JS_DIALOG;
        $js = array();
        local_js($code);
        $js['dismissmsg'] = $CFG->wwwroot.'/local/reportbuilder/confirm.js.php';
        require_js(array_values($js));

      // just get the alerts for this user
        $roleid = $this->current_roleid();
        $role_assertion = '';
         if ($roleid) {
             $role_assertion = '?roleid='.$roleid;
         }
        $total = tm_messages_count('totara_alert', false, $roleid);
        $this->msgs = tm_messages_get('totara_alert', 'timecreated DESC ', false, true, $roleid);
        $count = is_array($this->msgs) ? count($this->msgs) : 0;
        $this->title = get_string('alerts', 'block_totara_alerts');
        if($count) {
            $this->title .= ' <span>' .
                get_string('showingxofx', 'block_totara_alerts', array($count, $total)).'</span>';
        } else {
            $this->title .= ' <span>' . get_string('noalerts', 'block_totara_alerts') . '</span>';
        }

        if (empty($this->instance)) {
            return $this->content;
        }

        // now build the table of results
        $this->content->text  .= '<table>';
        if (!empty($this->msgs)) {
            $cnt = 0;
            foreach ($this->msgs as $msg) {
                // status Icon
                $cnt++;

                // user name + link
                $userfrom_link = $CFG->wwwroot.'/user/view.php?id='.$msg->useridfrom;
                $from = get_record('user', 'id', $msg->useridfrom);
                $fromname = fullname($from);

                // message creation time
                $when = userdate($msg->timecreated, '%e %b %y');
                $cssclass = totara_msg_cssclass($msg->msgtype);
                // statement - multipart: user + statment + object
                $bkgd = ($cnt % 2) ? 'shade' : 'noshade';
                $msglink = !empty($msg->contexturl) ? $msg->contexturl : '';
                $content  = "<tr class=\"".$bkgd."\">";
                // Icon
                $content .= '<td class="status">';
                $content .= !empty($msglink) ? '<a href="' . $msglink .'">' : '';
                $content .= '<img class="msgicon" src="' . totara_msg_icon_url($msg->icon) . '" title="' . format_string($msg->subject) . '" alt="' . format_string($msg->subject) .'" />';
                $content .= !empty($msglink) ? '</a>' : '';
                $content .= '</td>';
                // Details
                $content .= '<td class="statement">';
                $content .= !empty($msglink) ? '<a href="' . $msglink . '">' : '';
                $content .= format_string($msg->subject ? $msg->subject : $msg->fullmessage);
                $content .= !empty($msglink) ? '</a>' : '';
                $content .= '</td>';
                // Info icon/dialog
                $content .= '<td class="action">';
                $detailjs = totara_msg_alert_popup($msg->id);
                $content .= '<a id="detailtask'.$msg->id.'-dialog" href="' . $msglink . '"
                title="' . get_string('clickformoreinfo', 'block_totara_tasks') .'">';
                $content .= '<img src="' . $CFG->themewww . '/' . $CFG->theme . '/pix/i/info.gif" />' . $detailjs . '</a>';
                $content .= "</td></tr>";
                $this->content->text .= $content;
            }
        }
        $this->content->text .= '</table>';
        if (!empty($this->msgs)) {
            $this->content->footer = '<div class="viewall"><a href="'.$CFG->wwwroot.'/local/totara_msg/alerts.php'.$role_assertion.'">'.
                                     get_string('viewallnot', 'block_totara_alerts').'</a></div>';
        }
        return $this->content;
    }

    /**
    * Get the roleid for this dashlet context
    * @return int roleid
    **/
    function current_roleid() {
        global $CFG;
        if (instance_is_dashlet($this)) {
            // what dashlet role is this

            $role = get_dashlet_role($this->instance->pageid);
            $roleid = get_field('role', 'id', 'shortname', $role);
            return $roleid;
        }
        else {
            return false;
        }
    }
}

?>
