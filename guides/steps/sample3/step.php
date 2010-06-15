<?php
global $CFG;
require_once($CFG->dirroot . "/guides/steps/default.php");
class guide_sample3_step extends guide_default_step {
    function name() {
        return "Sample3";
    }

    function content_step_pending () {
        return "Sample3 - Step not yet ready to proceed<br/>";
    }
    function content_step_active () {
        return "Sample3 - Currently Active Step<br/>";
    }
    function content_step_complete () {
        return "Sample3 Step complete<br/>";
    }

}
?>
