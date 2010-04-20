<?php

    require_once '../../config.php';

?>
// Bind functionality to page on load
$(function() {

    ///
    /// Assign competency dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/competency/idp/';

        mitmsAssignDialog(
            'idpcompetency',
            url+'find.php?id='+idp_revision_id,
            url+'save.php?id='+idp_revision_id+'&rowcount='+idp_competency_row_count+'&add='
        );
        // display the button on page load
        $('#show-idpcompetency-dialog').css('display','inline');
    })();

    ///
    /// Assign competency template dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/competency/idp/';

        mitmsAssignDialog(
            'idpcompetencytemplate',
            url+'find-template.php?id='+idp_revision_id,
            url+'save-template.php?id='+idp_revision_id+'&rowcount='+idp_competencytemplate_row_count+'&add='
        );
        // display the button on page load
        $('#show-idpcompetencytemplate-dialog').css('display','inline');
    })();

    ///
    /// Assign competency from position dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/competency/idp/';

        mitmsAssignDialog(
            'idppositioncompetency',
            url+'find-position.php?id='+idp_revision_id,
            url+'save.php?id='+idp_revision_id+'&rowcount='+idp_competency_row_count+'&add='
        );
        // display the button on page load
        $('#show-idppositioncompetency-dialog').css('display','inline');
    })();

    ///
    /// Assign competency template from position dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/competency/idp/';

        mitmsAssignDialog(
            'idppositioncompetencytemplate',
            url+'find-position-template.php?id='+idp_revision_id,
            url+'save-template.php?id='+idp_revision_id+'&rowcount='+idp_competencytemplate_row_count+'&add='
        );
        // display the button on page load
        $('#show-idppositioncompetencytemplate-dialog').css('display','inline');
    })();

    ///
    /// Assign course dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/course/idp/';

        var handler = new mitmsDialog_handler_idpCourse();
        handler.baseurl = url;

        //url+'save.php?id='+idp_revision_id+'&rowcount='+idp_competencytemplate_row_count+'&add=',
        mitmsDialogs['idpcourse'] = new mitmsDialog(
            'idpcourse',
            'show-idpcourse-dialog',
            {},
            url+'add.php?id='+idp_revision_id,
            handler
        );
        // display the button on page load
        $('#show-idpcourse-dialog').css('display','inline');
    })();

});

// Create handler for the course dialog
mitmsDialog_handler_idpCourse = function() {
    // Base url
    var baseurl = '';
};
mitmsDialog_handler_idpCourse.prototype = new mitmsDialog_handler_skeletalTreeview();

mitmsDialog_handler_idpCourse.prototype._handle_hierarchy_expand = function(id) {

    var url = this.baseurl+'category.php?id='+id+'&rev='+idp_revision_id;
    this._dialog._request(url, this, '_update_hierarchy', id);
}


mitmsDialog_handler_idpCourse.prototype._handle_course_click = function(id) {

    var url = this.baseurl+'save.php?id='+idp_revision_id+'&rowcount='+idp_competencytemplate_row_count+'&add='+id;

    // Update db
    this._dialog._request(url, this, '_update');
}
