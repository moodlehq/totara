<?php
require_once ($CFG->dirroot . '/guides/steps/default.php');
class guide_mitms_guide_competencies_step extends guide_default_step {
    ## Return the content the step should display when it is the active step in a guide:
    function content_step_active () {
        global $CFG;
        $returnstring = 'This step requires you to complete the ';
        $guide = get_record('block_guides_guide', 'name', 'Configure Competencies');
        if ($guide) {
            $returnstring .= '<a href="' . $CFG->wwwroot . '/guides/view.php?startguide=' . $guide->id . '">Configure Competencies</a> guide.';
        } else {
            $returnstring .= 'Configure Competencies guide.';
        }
        return $returnstring;
    }

    # Return content the step should display when it is not active, and is not complete:
    function content_step_pending () {
        return 'This is the mitms_guide_competencies step.<br /> This step is pending.  When you get to this step you will need to complete the Configure Competencies guide.';
    }

    # Return content the step should display when it is not active, and is complete:
    function content_step_complete () {
        return 'The competencies guide has been marked as completed. <br /> If you would like to run through the competencies guide again, you can delete your guide progress, and start again.';
    }

    function effort() {
        return 900;
    }

    #function percent_complete() {
    #    TODO: Could do something nice here to examine how complete the related guide_instance is (if there is one).
    #    return 0;
    #}

    ##Step initialization routine
    ## By default don't do anything, but return true to indicate successful completion
    #function start_step() {
    #    return true;
    #}

    ## Step tidy-up routine
    ## By default don't do anything, but return true to indicate successful completion
    #function finish_step() {
    #    return true;
    #}

    ## Is this step ready to be finished?
    ## By default, we don't deny any request,
    ## But may want to overrided to check the database to see if required actions have been taken.
    #function is_completeable() {
    #    return true;
    #}

    ## Should this step be automatically completed as soon as it's ready?
    ## By default, no - we require the user to click to confirm that they're really done.
    ## This can be overridden so that the user flows thru the guide as actions are completed
    #function autocomplete() {
    #    return false;
    #}

}
?>
