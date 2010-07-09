<?php
global $CFG;
require_once($CFG->dirroot . "/guides/steps/default.php");
class guide_sample1_step extends guide_default_step {
    function name() {
        return "Sample1";
    }

    function content_step_pending () {
        return "Sample1 - Step not yet ready to proceed<br/>";
    }
    function content_step_active () {
        return "Sample1 - Currently Active Step<br/>";
    }
    function content_step_complete () {
        return "Sample1 Step complete<br/>";
    }

}
?>
