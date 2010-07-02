<?php
global $CFG;
require_once($CFG->dirroot . "/guides/steps/default.php");
class guide_sample6_step extends guide_default_step {
    function name() {
        return "Sample6";
    }

    function content_step_pending () {
        return "Sample6 - Step not yet ready to proceed<br/>";
    }
    function content_step_active () {
        return "Sample6 - Currently Active Step<br/>";
    }
    function content_step_complete () {
        return "Sample6 Step complete<br/>";
    }

}
?>
