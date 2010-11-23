<?php

    require_once '../../config.php';
    require_once $CFG->dirroot.'/local/js/lib/setup.php';

    $courseid = optional_param('id', 0, PARAM_INT);

?>

// Bind functionality to page on load
$(function() {

    /// Find course prerequisites
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/course/';

        var handler = new totaraDialog_handler_preRequisite();
        handler.baseurl = url;

        totaraDialogs['evidence'] = new totaraDialog(
            'courseprerequisite',
            'id_add_criteria_course',
            {
                 buttons: {
                    'Cancel': function() { handler._cancel() },
                    'Ok': function() { handler._save() }
                 },
                title: '<?php
                    echo '<h2>';
                    echo get_string('addcourseprerequisite', 'completion');
                    echo dialog_display_currently_selected(get_string('selected', 'hierarchy'), 'courseprerequisite');
                    echo '</h2>';
                ?>'
            },
            url+'completion_prerequisite.php?id=<?php echo $courseid;?>',
            handler
        );
    })();

});

// Create handler for the dialog
totaraDialog_handler_preRequisite = function() {
    // Base url
    var baseurl = '';
}

totaraDialog_handler_preRequisite.prototype = new totaraDialog_handler_treeview_singleselect();

totaraDialog_handler_preRequisite.prototype._save = function() {

    var id = $('#treeview_selected_val_courseprerequisite').val();
    var course = $('#treeview_selected_text_courseprerequisite').text();

    // Get button fitem
    var button_fitem = $('#id_add_criteria_course').parent().parent();

    // Delete no prerequisites warning, if exists
    var statics = $('#courseprerequisites span.nocoursesselected');
    if (statics) {
        $(statics).parent().parent().remove();
    }

    var html = '<div class="fitem"><div class="fitemtitle"><label for="id_dynprereq_'+id+'">'+course+'</label></div>';
    var html = html + '<div class="felement fcheckbox"><span>';
    var html = html + '<input id="id_dyncprereq_'+id+'" type="checkbox" name="criteria_course['+id+']" checked="checked" value="1" />';
    var html = html + '</span></div></div>';

    $(button_fitem).before(html);

    this._dialog.hide();
}
