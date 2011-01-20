<?php

    require_once '../../config.php';

    $courseid = optional_param('id', 0, PARAM_INT);

?>

<?php if (!empty($CFG->competencyuseresourcelevelevidence)) { ?>
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
<?php } else {  // non resource-level dialog ?>
    // Bind functionality to page on load
    $(function() {

        (function() {
            var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/competency/course/';
            var saveurl = url + 'save.php?course=<?php echo $courseid; ?>&type=coursecompletion&instance=<?php echo $courseid?>&deleteexisting=1&update=';

            var handler = new totaraDialog_handler_courseEvidence();
            handler.baseurl = url;

            totaraDialogs['evidence'] = new totaraDialog(
                'coursecompetency',
                'show-coursecompetency-dialog',
                {
                     buttons: {
                        'Cancel': function() { handler._cancel() },
                        'Ok': function() { handler._save(saveurl) }
                     },
                    title: '<?php echo '<h2>' .
                        get_string('assigncoursecompletiontocompetency', 'competency') . '</h2>' ?>'
                },
                url+'add.php?id='+<?php echo $courseid; ?>,
                handler
            );
        })();

    });

    // Create handler for the dialog
    totaraDialog_handler_courseEvidence = function() {
        // Base url
        var baseurl = '';
    }

    totaraDialog_handler_courseEvidence.prototype = new totaraDialog_handler_treeview_multiselect();

    /**
     * Add a row to a table on the calling page
     * Also hides the dialog and any no item notice
     *
     * @param string    HTML response
     * @return void
     */
    totaraDialog_handler_courseEvidence.prototype._update = function(response) {

        // Hide dialog
        this._dialog.hide();

        // Remove no item warning (if exists)
        $('.noitems-'+this._title).remove();

        //Split response into table and div
        var new_table = $(response).filter('table');

        // Grab table
        var table = $('div#content table#list-coursecompetency');

        // If table found
        if (table.size()) {
            table.replaceWith(new_table);
        }
        else {
            // Add new table
            $('div#content div#coursecompetency-table-container').append(new_table);
        }
    }

<?php } ?>
