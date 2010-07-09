<?php
global $CFG;
require_once($CFG->dirroot . "/guides/steps/default.php");
class guide_sample4_step extends guide_default_step {
    function name() {
        return "Sample4";
    }

    function content_step_pending () {
        return "Sample4 - Step not yet ready to proceed<br/>";
    }
    function content_step_active () {
        return "Sample4 - Currently Active Step<br/>";
    }
    function content_step_complete () {
        return "Sample4 Step complete<br/>";
    }
    function is_completeable() {
        return false;
    }

}
?>
