<?php

  /*
  * Testing only block for Totara Notifications and Reminders
  *
  * @package blocks
  * @subpackage totara_test_msg
  * @author: Piers Harding
  * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
  * @copyright  (C) 1999 onwards Martin Dougiamas  http://dougiamas.com
  */

defined('MOODLE_INTERNAL') || die();

  class block_totara_test_msg extends block_base {

    function init() {
      $this->title = get_string('blockname', 'block_totara_test_msg');
      $this->version = 2010110101;
    } //init

    // only one instance of this block is required
    function instance_allow_multiple() {
      return false;
    } //instance_allow_multiple

    // label and button values can be set in admin
    function has_config() {
      return false;
    } //has_config

    function get_content() {
      global $CFG;

      //cache block contents
      if ($this->content !== NULL) {
        return $this->content;
      }

      $this->content = new stdClass;

      //fetch values if defined in admin, otherwise use defaults
      $label_type  = get_string('typelabel', 'block_totara_test_msg');
      $label_notification  = get_string('notification', 'block_totara_test_msg');
      $label_reminder  = get_string('reminder', 'block_totara_test_msg');
      $label_role  = get_string('role', 'block_totara_test_msg');
      $button = get_string('msgbutton', 'block_totara_test_msg');

      //basic search form
      $roles = get_records('role');
      $options = '';
      foreach ($roles as $role) {
          $selected = $role->shortname == 'manager' ? 'selected' : '';
          $options .= '<option value="'.$role->id.'" '.$selected.'>'.$role->name.'</option>';
      }
      $this->content->text =
          '<form id="totara_test_msg" method="get" action="'. $CFG->wwwroot .'/blocks/totara_test_msg/send.php"><div>'
        . '<label for="block_test_msg">'. get_string('subjectlabel', 'block_totara_test_msg') .'</label>'
        . '<input id="block_test_msg" type="text" name="subject" /><br/>'
        . '<label for="block_test_msg">'. get_string('msglabel', 'block_totara_test_msg') .'</label>'
        . '<input id="block_test_msg" type="text" name="msg" /><br/>'
        . '<label for="block_test_type">'. $label_type .'</label><br/>'
        . $label_notification . '<input type="radio" name="type" value="notification" /> <br/>'
        . $label_reminder . '<input type="radio" name="type" value="reminder"  checked="checked" /><br/>'
        . $label_role . '<select name="roleid">'
        . $options
        . '</select>'
        . '<input type="submit" value="'.$button.'" />'
        . '</div></form>';

      //no footer, thanks
      $this->content->footer = '';

      return $this->content;
    } //get_content

  }

?>
