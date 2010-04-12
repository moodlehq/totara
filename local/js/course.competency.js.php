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
            {},
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

mitmsDialog_handler_assignCourseEvidence.prototype = new mitmsDialog_handler_treeview_clickable();

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

    this._dialog.dialog.html(response);

    // Handle add evidence links
    $('#coursecompetency .selectcompetencies a').live('click', function(event) {
        event.preventDefault();
        handler._dialog._request($(this).attr('href'), handler, '_update');
    });

    return false;
}
