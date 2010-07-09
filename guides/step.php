<?php
require_once("../config.php");
$gi = required_param('gi', PARAM_INT);
$step = required_param('step', PARAM_INT);
# TODO: Load the GI from the DB.
require_login();

# Check that the user trying to load this page is allowed to:
$context = get_context_instance(CONTEXT_USER, $guideinstance->userid);
require_capability('block/guide:viewguide', $context);

# TODO: load the class of the requested step, and instansiate it as $step

# If the user has requested that this step be marked as complete, or the step is set to 
# autocomplete, try to mark the step as completed. If this is successful, add some js to force the
# next step to reload - it has now become active, and may also need to autocomplete.
# TODO:

# Output the step's content
# TODO:


?>
