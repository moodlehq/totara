<?php

require_once '../../../../config.php';
require_login();

?>

// Bind functionality to page on load
$(function() {

    // Setup vars
    if (window.plan_id === undefined) {
        plan_id = '';
        comp_update_allowed = false;
    }

    (function() {

        var url = '<?php echo $CFG->wwwroot ?>/local/plan/components/competency/';
        var continueurl = url + 'confirm.php?id='+plan_id+'&update=';
        var saveurl = url + 'update.php?id='+plan_id+'&update=';
        var continueskipurl = saveurl + 'id='+plan_id+'&update=';
        var continuesaveurl = url + 'update.php?';

        var handler = new totaraDialog_handler_lpCompetency();
        handler.baseurl = url;
        handler.continueskipurl = continueskipurl;

        handler.standard_buttons = {
            'Cancel': function() { handler._cancel() },
            'Ok': function() { handler._save(saveurl) }
        };

        handler.continue_buttons = {
            'Cancel': function() { handler._cancel() },
            'Continue': function() { handler._continue(continueurl) }
        };

        handler.continuesave_buttons = {
            'Cancel': function() { handler._cancel() },
            'Ok': function() { handler._continueSave(continuesaveurl) }
        };

        totaraDialogs['evidence'] = new totaraDialog(
            'assigncompetencies',
            'show-competency-dialog',
            {
                buttons: {},
                title: '<?php
                    echo '<h2>';
                    echo get_string('addremovecompetency', 'local_plan');
                    echo '</h2>';
                ?>'
            },
            url+'find.php?id='+plan_id,
            handler
        );
    })();

});


// Create handler for the dialog
totaraDialog_handler_lpCompetency = function() {
    // Base url
    var baseurl = '';
}

totaraDialog_handler_lpCompetency.prototype = new totaraDialog_handler_treeview_multiselect();


/**
 * Reset buttons on dialog open
 *
 * @return  void
 */
totaraDialog_handler_lpCompetency.prototype._open = function() {

    // Check if user has allow permissions for updating compentencies
    if (comp_update_allowed) {
        var buttons = this.continue_buttons;
    } else {
        var buttons = this.standard_buttons;
    }

    // Reset buttons
    this._dialog.dialog.dialog('option', 'buttons', buttons);
}


/**
 * Load intermediate page for selecting courses
 *
 * @param   string  url
 * @return  void
 */
totaraDialog_handler_lpCompetency.prototype._continue = function(url) {

    // Serialize data
    var elements = $('.selected > div > span', this._container);
    var selected_str = this._get_ids(elements).join(',');

    // Add to url
    url = url + selected_str;

    // Load url in dialog
    this._dialog._request(url, this, '_continueRender');
}


/**
 * Check result, if special string, redirect. Else, render;
 *
 * If rendering, update dialog buttons to be ok/cancel
 *
 * @param   object  asyncRequest response
 * @return  void
 */
totaraDialog_handler_lpCompetency.prototype._continueRender = function(response) {

    // Check result
    if (response.substr(0, 9) == 'NOCOURSES') {

        // Generate url
        var url = this.continueskipurl + response.substr(10);

        // Send to server
        this._dialog._request(url, this, '_update');

        // Do not render
        return false;
    }

    // Update buttons
    this._dialog.dialog.dialog('option', 'buttons', this.continuesave_buttons);

    // Render result
    return true;
}


/**
 * Serialize linked courses and send to url,
 * update table with result
 *
 * @param string URL to send dropped items to
 * @return void
 */
totaraDialog_handler.prototype._continueSave = function(url) {

    // Serialize form data
    var data_str = $('form', this._container).serialize();

    // Add to url
    url = url + data_str;

    // Send to server
    this._dialog._request(url, this, '_update');
}


/**
 * Add a row to a table on the calling page
 * Also hides the dialog and any no item notice
 *
 * @param string    HTML response
 * @return void
 */
totaraDialog_handler_lpCompetency.prototype._update = function(response) {

    // Hide dialog
    this._dialog.hide();

    // Remove no item warning (if exists)
    $('.noitems-'+this._title).remove();

    //Split response into table and div
    var new_table = $(response).filter('table');
    var new_planbox = $(response).filter('.plan_box');

    // Grab table
    var table = $('div#content form#dp-component-update table.dp-plan-component-items');

    // Check for no items msg
    var noitems = $(response).filter('span.noitems-assigncompetencies');

    if (noitems.size()) {
        // If no items, just display message
        $('div#content form#dp-component-update div#dp-component-update-table').append(noitems);
        // Replace table with nothing
        table.empty();
    } else if (table.size()) {
        // If table found
        table.replaceWith(new_table);
    } else {
        // Add new table
        $('div#content form#dp-component-update div#dp-component-update-table').append(new_table);
    }

    //Replace plan message box
    $('div.plan_box').replaceWith(new_planbox);

    <?php
        require_once($CFG->dirroot.'/local/plan/development_plan.class.php');
        $plan = new development_plan(required_param('planid', PARAM_INT), optional_param('viewas', null, PARAM_INT));

        if ($plan->get_component('competency')->can_update_settings(LP_CHECK_ITEMS_EXIST)) {
    ?>
    // show the update settings button
    var updatesettings = $('div#content div#dp-component-update-submit');
    if (noitems.size()) {
        updatesettings.hide();
    }
    else {
        updatesettings.show();
    }

    <?php if ($plan->get_component('competency')->get_setting('duedatemode') && $plan->get_component('competency')->get_setting('setduedate') >= DP_PERMISSION_ALLOW) { ?>
        // Add duedate datepicker
        $(function() {
            $('[id^=duedate_competency]').datepicker(
                {
                    dateFormat: 'dd/mm/y',
                    showOn: 'both',
                    buttonImage: '<?php echo $CFG->wwwroot; ?>/local/js/images/calendar.gif',
                    buttonImageOnly: true,
                    constrainInput: true
                }
            );
        });
    <?php }
    } ?>
}
