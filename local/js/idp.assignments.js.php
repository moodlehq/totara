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
    /// Assign course template dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/course/idp/';

        mitmsAssignDialog(
            'idpcourse',
            url+'add.php?id='+idp_revision_id,
            url+'save.php?id='+idp_revision_id+'&rowcount='+idp_competencytemplate_row_count+'&add='
        );
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

});
