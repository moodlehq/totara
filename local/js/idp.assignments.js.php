<?php

    require_once '../../config.php';

    $id = optional_param('id', 0, PARAM_INT);
    $frameworkid = optional_param('frameworkid', 0, PARAM_INT);

?>
// Bind functionality to page on load
$(function() {

    ///
    /// Assign competency dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/competency/idp/';

        totaraMultiSelectDialog(
            'idpcompetency',
            '<?php echo get_string('addcompetenciestoplan', 'idp') ?> ',
            url+'find.php?id=<?php echo $id;?>&frameworkid=<?php echo $frameworkid;?>',
            url+'save.php?id=<?php echo $id;?>&frameworkid=<?php echo $frameworkid;?>&deleteexisting=1&add='
        );
        // display the button on page load
        $('#show-idpcompetency-dialog').css('display','inline');
    })();

    ///
    /// Assign competency template dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/competency/idp/';

        totaraMultiSelectDialog(
            'idpcompetencytemplate',
            '<?php echo get_string('addcompetencytemplatestoplan', 'idp') ?>',
            url+'find-template.php?id=<?php echo $id;?>&frameworkid=<?php echo $frameworkid;?>',
            url+'save-template.php?id=<?php echo $id;?>&frameworkid=<?php echo $frameworkid;?>&deleteexisting=1&add='
        );
        // display the button on page load
        $('#show-idpcompetencytemplate-dialog').css('display','inline');
    })();

    ///
    /// Assign competency from position dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/competency/idp/';

        totaraMultiSelectDialog(
            'idppositioncompetency',
            '<?php echo get_string('assigncompetencies', 'competency') ?>',
            url+'find-position.php?id=<?php echo $id;?>&realframeworkid=<?php echo $frameworkid;?>',
            url+'save.php?id=<?php echo $id;?>&frameworkid=<?php echo $frameworkid;?>&deleteexisting=1&add='
        );
        // display the button on page load
        $('#show-idppositioncompetency-dialog').css('display','inline');
    })();

    ///
    /// Assign competency template from position dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/competency/idp/';

        totaraMultiSelectDialog(
            'idppositioncompetencytemplate',
            '<?php echo get_string('addcompetencytemplatestoplan', 'idp') ?>',
            url+'find-position-template.php?id=<?php echo $id;?>&realframeworkid=<?php echo $frameworkid;?>',
            url+'save-template.php?id=<?php echo $id;?>&frameworkid=<?php echo $frameworkid;?>&deleteexisting=1&add='
        );
        // display the button on page load
        $('#show-idppositioncompetencytemplate-dialog').css('display','inline');
    })();

    ///
    /// Assign course dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/course/idp/';

        var handler = new totaraDialog_handler_idpCourse();
        handler.baseurl = url;

        save_url = url+'save.php?id=<?php echo $id;?>&deleteexisting=1&add=',
    
        totaraDialogs['idpcourse'] = new totaraDialog(
            'idpcourse',
            'show-idpcourse-dialog',
            {
                 buttons: {
                    'Cancel': function() { handler._cancel() },
                    'Ok': function() { handler._save(save_url) }
                },
                title: '<?php echo '<h2>' . get_string('addcoursestoplan', 'idp') . '</h2>' ?>'
    
            },
            url+'add.php?id=<?php echo $id;?>',
            handler
        );
        // display the button on page load
        $('#show-idpcourse-dialog').css('display','inline');
    })();

});

// Create handler for the course dialog
totaraDialog_handler_idpCourse = function() {
    // Base url
    var baseurl = '';
};
totaraDialog_handler_idpCourse.prototype = new totaraDialog_handler_skeletalTreeview();

totaraDialog_handler_idpCourse.prototype._handle_hierarchy_expand = function(id) {

    var url = this.baseurl+'category.php?id='+id+'&rev=<?php echo $id;?>';
    this._dialog._request(url, this, '_update_hierarchy', id);
}
