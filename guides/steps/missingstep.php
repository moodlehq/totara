<?php
global $CFG;
require_once($CFG->dirroot . "/guides/steps/default.php");
class guide_missing_step extends guide_default_step {
    # This step is used where a guide has been defined, which uses steps that don't exist
    # It's basically the same as the default step, but is set to autocomplete, to minimise
    # any effect on the user.
    function autocomplete () {
        return true;
    }

}
?>
