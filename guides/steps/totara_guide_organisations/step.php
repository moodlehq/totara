<?php
require_once ($CFG->dirroot . '/guides/steps/default.php');
class guide_totara_guide_organisations_step extends guide_default_step {
    ## Return the content the step should display when it is the active step in a guide:
    function content_step_active () {
        global $CFG;
        $returnstring = '<p>This step requires you to set up the organisation structure.</p>
                <p>When you are ready to start, open ';
        $guide = get_record('block_guides_guide','name','Configure Organisations');
        if ($guide) {
            $returnstring .= '<a href="' . $CFG->wwwroot . '/guides/view.php?startguide=' . $guide->id . '">Configure Organisations</a>.';
        } else {
            $returnstring .= 'the Configure Organisations guide.';
        }
        $returnstring .= ' This step by step guide will help you with this process.</p>';
        return $returnstring;
    }

    # Return content the step should display when it is not active, and is not complete:
    function content_step_pending () {
        return '<p>Set up your organisation structure allows you to set up an organisational heirarchy in the system.</p>';
    }

    # Return content the step should display when it is not active, and is complete:
    function content_step_complete () {
        return '<p>This step has been completed.</p>
            <p>You can add, modify or delete organisation information from <b>Organisations</b> on the Site Administration menu.</p>';
    }

    function effort() {
        return 500;
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
