<?php
class dp_manager_role extends dp_base_role {
    function user_has_role($userid=null) {
        global $USER;
        // use current user if none given
        if (!isset($userid)) {
            $userid = $USER->id;
        }
        // are they the manager of this plan's owner?
        if(totara_is_manager($this->plan->userid, $userid)) {
            return 'manager';
        } else {
            return false;
        }
    }
}
