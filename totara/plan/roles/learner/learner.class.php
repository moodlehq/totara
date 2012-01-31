<?php

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

class dp_learner_role extends dp_base_role {

    function user_has_role($userid=null) {
        global $USER;
        // use current user if none given
        if (!isset($userid)) {
            $userid = $USER->id;
        }
        if($userid == $this->plan->userid) {
            return 'learner';
        } else {
            return false;
        }
    }

}
