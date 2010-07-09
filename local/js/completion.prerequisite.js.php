<?php

    require_once '../../config.php';

?>

// Bind functionality to page on load
$(function() {

    /// Find course prerequisites
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/course/';

        var handler = new mitmsDialog_handler_preRequisite();
        handler.baseurl = url;

        mitmsDialogs['evidence'] = new mitmsDialog(
            'courseprerequisite',
            'id_add_criteria_course',
            {
                 buttons: {
                'Ok': function() { handler._save() },
                'Cancel': function() { handler._cancel() }
                 }
            },
            url+'completion_prerequisite.php?id='+course_id,
            handler
        );
    })();

});

// Create handler for the dialog
mitmsDialog_handler_preRequisite = function() {
    // Base url
    var baseurl = '';
}

mitmsDialog_handler_preRequisite.prototype = new mitmsDialog_handler_skeletalTreeview();

mitmsDialog_handler_preRequisite.prototype._handle_hierarchy_expand = function(id) {

    var url = this.baseurl+'completion_prerequisite.php?id='+course_id+'&category='+id;
    this._dialog._request(url, this, '_update_hierarchy', id);
}


mitmsDialog_handler_preRequisite.prototype._handle_course_click = function(id) {

    var course = $('#course_'+id+' > span').text();

    $('#treeview_currently_selected_span').css('display', 'inline');
    $('#treeview_selected_text').text(course);
    $('#treeview_selected_val').val(id);
}


mitmsDialog_handler_preRequisite.prototype._save = function() {
    var id = $('#treeview_selected_val').val();
    var course = $('#treeview_selected_text').text();

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
