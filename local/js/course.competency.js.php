<?php

    require_once '../../config.php';

    $courseid = optional_param('id', 0, PARAM_INT);

?>

// Bind functionality to page on load
$(function() {

    ///
    /// Add course evidence to competency dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/competency/course/';

        var handler = new totaraDialog_handler_assignCourseEvidence();
        handler.baseurl = url;

        totaraDialogs['coursecompetency'] = new totaraDialog(
            'coursecompetency',
            'show-coursecompetency-dialog',
            {
                buttons: {
                    'Cancel': function() { handler._cancel() }
                },
                title: '<?php echo '<h2>' . get_string('addcourseevidencetocompetency', 'competency') . '</h2>' ?>'
            },
            url+'add.php?id=<?php echo $courseid;?>',
            handler
        );
    })();

});

// Create handler for the assign evidence dialog
totaraDialog_handler_assignCourseEvidence = function() {
    // Base url
    var baseurl = '';
}

totaraDialog_handler_assignCourseEvidence.prototype = new totaraDialog_handler_treeview_singleselect(null, null, dualpane=true);

totaraDialog_handler_assignCourseEvidence.prototype.handle_click = function(clicked) {

    // Get id, format item_XX
    var id = clicked.attr('id');
    var url = this.baseurl+'evidence.php?id=<?php echo $courseid;?>&add='+id;

    // Indicate loading...
    this._dialog.showLoading();

    this._dialog._request(url, this, 'display_evidence');
}

totaraDialog_handler_assignCourseEvidence.prototype.display_evidence = function(response) {

    var handler = this;

    // Hide loading animation
    this._dialog.hideLoading();

    $('.selected', this._dialog.dialog).html(response);

    // Bind click event
    $('#available-evidence', this._dialog.dialog).find('.addbutton').click(function(e) {
        e.preventDefault();
        var competency_id=$('#evitem_competency_id').val();
        var type = $(this).parent().attr('type');
        var instance = $(this).parent().attr('id');
        var url = handler.baseurl+'save.php?competency='+competency_id+'&course=<?php echo $courseid;?>&type='+type+'&instance='+instance;
        handler._dialog._request(url, handler, '_update');
    });

    return false;
}
