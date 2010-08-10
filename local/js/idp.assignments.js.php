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

        mitmsMultiSelectDialog(
            'idpcompetency',
            url+'find.php?id='+idp_revision_id+'&frameworkid='+idp_revision_frameworkid,
            url+'save.php?id='+idp_revision_id+'&frameworkid='+idp_revision_frameworkid+'&deleteexisting=1&add='
        );
        // display the button on page load
        $('#show-idpcompetency-dialog').css('display','inline');
    })();

    ///
    /// Assign competency template dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/competency/idp/';

        mitmsMultiSelectDialog(
            'idpcompetencytemplate',
            url+'find-template.php?id='+idp_revision_id+'&frameworkid='+idp_revision_frameworkid,
            url+'save-template.php?id='+idp_revision_id+'&frameworkid='+idp_revision_frameworkid+'&deleteexisting=1&add='
        );
        // display the button on page load
        $('#show-idpcompetencytemplate-dialog').css('display','inline');
    })();

    ///
    /// Assign competency from position dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/competency/idp/';

        mitmsMultiSelectDialog(
            'idppositioncompetency',
            url+'find-position.php?id='+idp_revision_id+'&frameworkid='+idp_revision_frameworkid,
            url+'save.php?id='+idp_revision_id+'&frameworkid='+idp_revision_frameworkid+'&deleteexisting=1&add='
        );
        // display the button on page load
        $('#show-idppositioncompetency-dialog').css('display','inline');
    })();

    ///
    /// Assign competency template from position dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/competency/idp/';

        mitmsMultiSelectDialog(
            'idppositioncompetencytemplate',
            url+'find-position-template.php?id='+idp_revision_id+'&frameworkid='+idp_revision_frameworkid,
            url+'save-template.php?id='+idp_revision_id+'&frameworkid='+idp_revision_frameworkid+'&deleteexisting=1&add='
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

        save_url = url+'save.php?id='+idp_revision_id+'&deleteexisting=1&add=',
    
        mitmsDialogs['idpcourse'] = new mitmsDialog(
            'idpcourse',
            'show-idpcourse-dialog',
            {
                 buttons: {
                'Ok': function() { handler._save(save_url) },
                'Cancel': function() { handler._cancel() }
            }
    
            },
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
