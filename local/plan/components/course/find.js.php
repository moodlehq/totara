<?php

    require_once '../../../../config.php';

?>

// Bind functionality to page on load
$(function() {

    // Setup vars
    if (window.plan_id === undefined) {
        plan_id = '';
    }

    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/local/plan/components/course/';
        var saveurl = url + 'update.php?id='+plan_id+'&update=';

        var handler = new totaraDialog_handler_preRequisite();
        handler.baseurl = url;

        totaraDialogs['evidence'] = new totaraDialog(
            'assigncourses',
            'show-course-dialog',
            {
                 buttons: {
                    'Cancel': function() { handler._cancel() },
                    'Ok': function() { handler._save(saveurl) }
                 },
                title: '<?php
                    echo '<h2>';
                    echo get_string('updatecourses', 'local_plan');
                    echo '</h2>';
                ?>'
            },
            url+'find.php?id='+plan_id,
            handler
        );
    })();

});

// Create handler for the dialog
totaraDialog_handler_preRequisite = function() {
    // Base url
    var baseurl = '';
}

totaraDialog_handler_preRequisite.prototype = new totaraDialog_handler_treeview_multiselect();

/**
 * Add a row to a table on the calling page
 * Also hides the dialog and any no item notice
 *
 * @param string    HTML response
 * @return void
 */
totaraDialog_handler_preRequisite.prototype._update = function(response) {

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
    var noitems = $(response).filter('span.noitems-assigncourses');

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

    // show the update settings button
    var table = $('div#content form#dp-component-update table.dp-plan-component-items');
    var updatesettings = $('div#content div#dp-component-update-submit');
    if (noitems.size()) {
        updatesettings.hide();
    }
    else {
        updatesettings.show();
    }

    // Add duedate datepicker
    $(function() {
        $('[id^=duedate_course]').datepicker(
            {
                dateFormat: 'dd/mm/y',
                showOn: 'button',
                buttonImage: '<?php echo $CFG->wwwroot; ?>/local/js/images/calendar.gif',
                buttonImageOnly: true
            }
        );
    });
}
