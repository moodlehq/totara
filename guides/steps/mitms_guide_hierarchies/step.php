<?php
require_once ($CFG->dirroot . '/guides/steps/default.php');
class guide_mitms_guide_hierarchies_step extends guide_default_step {
    ## Return the content the step should display when it is the active step in a guide:
    function content_step_active () {
        global $CFG;
        $returnstring = '<p>This is the final step to configuring MITMS for your organisation.</p>
           <p>When you are ready to start open the ';
        $guide = get_record('block_guides_guide','name','Configure Hierarchies');
        if ($guide) {
            $returnstring .= 'by clicking <a href="' . $CFG->wwwroot . '/guides/view.php?startguide=' . $guide->id . '">Configure Hierarchies</a>';
        } else {
            $returnstring .= 'Configure Hierarchies guide.';
        }
        $returnstring .= ' this will open a step by step guide that will help you with this process.</p>';
        return $returnstring;
    }

    # Return content the step should display when it is not active, and is not complete:
    function content_step_pending () {
        return '<p>Assigning a user\'s organisational details allows you to assign a manager, organisation and position to each user.</p>';
    }

    # Return content the step should display when it is not active, and is complete:
    function content_step_complete () {
        return '<p>This step has been completed.</p>
            <p>You can modify a user\'s assigned organisational details by editing the user\'s profile.</p>';
    }

    function effort() {
        return 400;
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
