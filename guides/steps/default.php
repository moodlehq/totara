<?php

class guide_default_step {
    # Content - return the step's content section
    # The actual content returned depends on the two parameters;
    # The step may want to produce different output depending on whether the step is active,
    # whether it has already been completed, or is still pending.
    # In a guide, steps before the current step are inactive, and complete,
    # The current step is active, and incomplete
    # Steps after the current step are inactive, and incomplete.
    function content($isactivestep, $iscompletestep) {
        global $CFG;
        $contentstr = '';
        if ($isactivestep) {
            $contentstr .= $this->content_step_active();
        } elseif ($iscompletestep) {
            $contentstr .= $this->content_step_complete();
        } else {
            $contentstr .= $this->content_step_pending();
        }
        return $contentstr;
    }

    # Return the content the step should display when it is the active step in a guide:
    function content_step_active () {
        return '';
    }

    # Return content the step should display when it is not active, and is not complete:
    function content_step_pending () {
        # By default, return exactly the same as when the step is active
        return $this->content_step_active();
    }

    # Return content the step should display when it is not active, and is complete:
    function content_step_complete () {
        # By default, return exactly the same as when the step is active
        return $this->content_step_active();
    }

    # An indication of how involved this step is - default to 100 points
    # May want to be overridden with a lower number to indicate step is trivial,
    # or a higher number to indicate that the step is involved.
    function effort() {
        return 100;
    }

    # Request that the step be marked as complete
    # This shouldn't need to be overridden
    function set_complete() {
        # Check any step completion criteria are met:
        if (!$this->is_completeable()) {
            # Step is not eligible to be marked as finished.
            return false;
        }
        # If tidy-up tasks run ok, mark the step as done.
        if ($this->finish_step()) {
            return true;
        }
        return false;
    }

    # An indication of how complete this step is default to 0 progress
    # may want to over-ride if we can examine the system/db to assess how complete the step is
    function percent_complete() {
        return 0;
    }

    #Step initialization routine
    # By default don't do anything, but return true to indicate successful completion
    function start_step() {
        return true;
    }

    # Step tidy-up routine
    # By default don't do anything, but return true to indicate successful completion
    function finish_step() {
        return true;
    }

    # Is this step ready to be finished?
    # By default, we don't deny any request,
    # But may want to overrided to check the database to see if required actions have been taken.
    function is_completeable() {
        return true;
    }

    # Should this step be automatically completed as soon as it's ready?
    # By default, no - we require the user to click to confirm that they're really done.
    # This can be overridden so that the user flows thru the guide as actions are completed
    function autocomplete() {
        return false;
    }

}
?>
