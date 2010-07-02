<?php

    require_once '../../config.php';

?>

// Bind functionality to page on load
$(function() {

    ///
    /// Add course evidence to competency dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/competency/course/';

        var handler = new mitmsDialog_handler_assignCourseEvidence();
        handler.baseurl = url;

        mitmsDialogs['coursecompetency'] = new mitmsDialog(
            'coursecompetency',
            'show-coursecompetency-dialog',
            {
                buttons: {
                    'Cancel': function() { handler._cancel() }
                }
            },
            url+'add.php?id='+course_id,
            handler
        );
    })();

});

// Create handler for the assign evidence dialog
mitmsDialog_handler_assignCourseEvidence = function() {
    // Base url
    var baseurl = '';
}

mitmsDialog_handler_assignCourseEvidence.prototype = new mitmsDialog_handler_treeview_singleselect(null, null, dualpane=true);

mitmsDialog_handler_assignCourseEvidence.prototype.handle_click = function(clicked) {

    // Get id, format item_XX
    var id = clicked.attr('id');
    var url = this.baseurl+'evidence.php?id='+course_id+'&add='+id;

    this._dialog._request(url, this, 'display_evidence');
}

mitmsDialog_handler_assignCourseEvidence.prototype.display_evidence = function(response) {

    var handler = this;

    // Hide loading animation
    this._dialog.hideLoading();

    $('.selected', this._dialog.dialog).html(response);

    // Bind hover event
    $('#available-evidence span', this._dialog.dialog).mouseenter(function() {
        $('.addbutton').css('display', 'none');
        $('.addbutton', $(this)).css('display', 'inline');
    });

    // Bind click event
    $('#available-evidence', this._dialog.dialog).find('.addbutton').click(function(e) {
        e.preventDefault();
        var competency_id=$('#evitem_competency_id').val();
        var type = $(this).closest('span').attr('type');
        var instance = $(this).closest('span').attr('id');
        var url = handler.baseurl+'save.php?competency='+competency_id+'&course='+course_id+'&type='+type+'&instance='+instance;
        handler._dialog._request(url, handler, '_update');
    });

    return false;
}
