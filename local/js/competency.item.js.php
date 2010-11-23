<?php

    require_once '../../config.php';


    $id = optional_param('id', 0, PARAM_INT);

?>

// Bind functionality to page on load
$(function() {

    ///
    /// Add related competency dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/competency/related/';

        totaraMultiSelectDialog(
            'related',
            '<?php echo get_string('assignrelatedcompetencies', 'competency'); ?>',
            url+'find.php?id=<?php echo $id;?>',
            url+'save.php?id=<?php echo $id;?>&deleteexisting=1&add='
        );
    })();

    /// Assign evidence item dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/competency/evidenceitem/';

        var handler = new totaraDialog_handler_assignEvidence();
        handler.baseurl = url;

        totaraDialogs['evidence'] = new totaraDialog(
            'evidence',
            'show-evidence-dialog',
            {
                buttons: {
                    'Cancel': function() { handler._cancel() }
                },
                title: '<?php echo '<h2>'.get_string('assignnewevidenceitem', 'competency').'</h2>'; ?>'
            },
            url+'edit.php?id=<?php echo $id;?>',
            handler
        );
    })();

});

// Create handler for the assign evidence dialog
totaraDialog_handler_assignEvidence = function() {
    // Base url
    var baseurl = '';
}

totaraDialog_handler_assignEvidence.prototype = new totaraDialog_handler_treeview();


totaraDialog_handler_assignEvidence.prototype._handle_update_hierarchy = function(list) {
    var handler = this;
    $('span', list).click(function() {
        var par = $(this).parent();

        // Get the id in format item_list_XX
        var id = par.attr('id').substr(10);

        // Check it's not a category
        if (id.substr(0, 3) == 'cat') {
            return;
        }

        handler._handle_course_click(id);
    });
}

totaraDialog_handler_assignEvidence.prototype._handle_course_click = function(id) {
    // Load course details
    var url = this.baseurl+'course.php?id='+id+'&competency=<?php echo $id;?>';

    // Indicate loading...
    this._dialog.showLoading();

    this._dialog._request(url, this, '_display_evidence');
}

/**
 * Display course evidence items
 *
 * @param string    HTML response
 */
totaraDialog_handler_assignEvidence.prototype._display_evidence = function(response) {
    this._dialog.hideLoading();

    $('.selected', this._dialog.dialog).html(response);

    var handler = this;

    // Bind click event
    $('#available-evidence', this._dialog.dialog).find('.addbutton').click(function(e) {
        e.preventDefault();
        var type = $(this).parent().attr('type');
        var instance = $(this).parent().attr('id');
        var url = handler.baseurl+'add.php?competency=<?php echo $id;?>&type='+type+'&instance='+instance;
        handler._dialog._request(url, handler, '_update');
    });

}
