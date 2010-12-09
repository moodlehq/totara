<?php

    require_once '../../../../config.php';

?>

// Bind functionality to page on load
$(function() {

    /// Find course prerequisites
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/local/plan/components/competency/';
        var saveurl = url + 'update.php?id='+plan_id+'&update=';

        var handler = new totaraDialog_handler_preRequisite();
        handler.baseurl = url;

        totaraDialogs['evidence'] = new totaraDialog(
            'assigncompetencies',
            'show-competency-dialog',
            {
                 buttons: {
                    'Cancel': function() { handler._cancel() },
                    'Ok': function() { handler._save(saveurl) }
                 },
                title: '<?php
                    echo '<h2>';
                    echo get_string('updatecompetencies', 'local_plan');
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

    // Grab table
    var table = $('div#content form#dp-component-update table.dp-plan-component-items');

    // If table found
    if (table.size()) {
        table.replaceWith(response);
    }
    else {
        // Add new table
        $('div#content form#dp-component-update').prepend(response);
    }
}
