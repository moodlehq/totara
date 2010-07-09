<?php
global $CFG;
require_once($CFG->dirroot . "/guides/steps/default.php");
class guide_sample_step extends guide_default_step {
    function name() {
        return "Sample";
    }

    function content_inactive () {
        return "Step not yet ready to proceed<br/>";
    }
    function content_active () {
        return "Currently Active Step<br/>";
    }
    function content_complete () {
        return "Step complete<br/>";
    }

}
?>
