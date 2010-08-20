<?php

    require_once '../../config.php';

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
            url+'find.php?id='+competency_id,
            url+'save.php?id='+competency_id+'&deleteexisting=1&add='
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
                }
            },
            url+'edit.php?id='+competency_id,
            handler
        );
    })();

});

// Create handler for the assign evidence dialog
totaraDialog_handler_assignEvidence = function() {
    // Base url
    var baseurl = '';
}

totaraDialog_handler_assignEvidence.prototype = new totaraDialog_handler_skeletalTreeview();

totaraDialog_handler_assignEvidence.prototype._handle_hierarchy_expand = function(id) {
    var url = this.baseurl+'category.php?id='+id;
    this._dialog._request(url, this, '_update_hierarchy', id);
}


totaraDialog_handler_assignEvidence.prototype._handle_course_click = function(id) {
    // Load course details
    var url = this.baseurl+'course.php?id='+id+'&competency='+competency_id;
    this._dialog._request(url, this, '_display_evidence');
}

/**
 * Display course evidence items
 *
 * @param string    HTML response
 */
totaraDialog_handler_assignEvidence.prototype._display_evidence = function(response) {

    $('.selected', this._dialog.dialog).html(response);

    var handler = this;

    // Bind hover event
    $('#available-evidence span', this._dialog.dialog).mouseenter(function() {
        $('.addbutton').css('display', 'none');
        $('.addbutton', $(this)).css('display', 'inline');
    });

    // Bind click event
    $('#available-evidence', this._dialog.dialog).find('.addbutton').click(function(e) {
        e.preventDefault();
        var type = $(this).closest('span').attr('type');
        var instance = $(this).closest('span').attr('id');
        var url = handler.baseurl+'add.php?competency='+competency_id+'&type='+type+'&instance='+instance;
        handler._dialog._request(url, handler, '_update');
    });

}
