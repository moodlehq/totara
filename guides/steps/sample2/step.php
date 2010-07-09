<?php
global $CFG;
require_once($CFG->dirroot . "/guides/steps/default.php");
class guide_sample2_step extends guide_default_step {
    function name() {
        return "Sample2";
    }

    function content_step_pending () {
        return "Sample2 - Step not yet ready to proceed<br/>";
    }
    function content_step_active () {
        return "Sample2 - Currently Active Step<br/>";
    }
    function content_step_complete () {
        return "Sample2 Step complete<br/>";
    }

}
?>
