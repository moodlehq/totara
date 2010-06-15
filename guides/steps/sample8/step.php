<?php
global $CFG;
require_once($CFG->dirroot . "/guides/steps/default.php");
class guide_sample8_step extends guide_default_step {
    function name() {
        return "Sample8";
    }

    function content_step_pending () {
        return "Sample8 - Step not yet ready to proceed<br/>";
    }
    function content_step_active () {
        return "Sample8 - Currently Active Step<br/>";
    }
    function content_step_complete () {
        return "Sample8 Step complete<br/>";
    }

}
?>
