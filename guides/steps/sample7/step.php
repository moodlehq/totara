<?php
global $CFG;
require_once($CFG->dirroot . "/guides/steps/default.php");
class guide_sample7_step extends guide_default_step {
    function name() {
        return "Sample7";
    }

    function content_step_pending () {
        return "Sample7 - Step not yet ready to proceed<br/>";
    }
    function content_step_active () {
        return "Sample7 - Currently Active Step<br/>";
    }
    function content_step_complete () {
        return "Sample7 Step complete<br/>";
    }

}
?>
