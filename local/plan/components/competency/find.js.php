<?php

    require_once '../../../../config.php';

?>

// Bind functionality to page on load
$(function() {

    /// Find course prerequisites
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/local/plan/components/competency/';
        var continueurl = url + 'confirm.php?id='+plan_id+'&update=';
        var saveurl = url + 'update.php?';

        var handler = new totaraDialog_handler_lpCompetency();
        handler.baseurl = url;

        handler.standard_buttons = {
                'Cancel': function() { handler._cancel() },
                'Ok': function() { handler._save(saveurl) }
        };

        // Check if user has allow permissions for updating compentencies
        if (comp_update_allowed) {
            var buttons = {
                'Cancel': function() { handler._cancel() },
                'Continue': function() { handler._continue(continueurl) }
            };
        } else {
            var buttons = handler.standard_buttons;
        }


        totaraDialogs['evidence'] = new totaraDialog(
            'assigncompetencies',
            'show-competency-dialog',
            {
                buttons: buttons,
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
 * Render and update dialog buttons to be ok/cancel
 *
 * @return  void
 */
totaraDialog_handler_lpCompetency.prototype._continueRender = function() {

    // Update buttons
    this._dialog.dialog.dialog('option', 'buttons', this.standard_buttons);

    // Render
    return true;
}


/**
 * Serialize linked courses and send to url,
 * update table with result
 *
 * @param string URL to send dropped items to
 * @return void
 */
totaraDialog_handler.prototype._save = function(url) {

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

    // Grab table
    var table = $('div#content form#dp-component-update table.dp-plan-component-items');

    // If table found
    if (table.size()) {
        table.replaceWith(response);
    }
    else {
        // Add new table
        $('div#content form#dp-component-update div#dp-component-update-table').append(response);
    }
    // show the update settings button
    var table = $('div#content form#dp-component-update table.dp-plan-component-items');
    var updatesettings = $('div#content div#dp-component-update-submit');
    if (table.size()) {
        updatesettings.show();
    }
    else {
        updatesettings.hide();
    }

}
