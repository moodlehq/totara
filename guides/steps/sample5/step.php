<?php
global $CFG;
require_once($CFG->dirroot . "/guides/steps/default.php");
class guide_sample5_step extends guide_default_step {
    function name() {
        return "Sample5";
    }

    function content_step_pending () {
        return "Sample5 - Step not yet ready to proceed<br/>";
    }
    function content_step_active () {
        return "Sample5 - Currently Active Step<br/>";
    }
    function content_step_complete () {
        return "Sample5 Step complete<br/>";
    }

}
?>
