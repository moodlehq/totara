<?php

    require_once '../../config.php';

?>
// Bind functionality to page on load
YAHOO.util.Event.onDOMReady(function () {

    ///
    /// Assign competency dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/competency/idp/';

        yuiAssignDialog(
            'idpcompetency',
            url+'find.php?id='+idp_revision_id,
            url+'save.php?id='+idp_revision_id+'&rowcount='+idp_competency_row_count+'&add='
        );
    })();

    ///
    /// Assign competency template dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/competency/idp/';

        yuiAssignDialog(
            'idpcompetencytemplate',
            url+'find-template.php?id='+idp_revision_id,
            url+'save-template.php?id='+idp_revision_id+'&rowcount='+idp_competencytemplate_row_count+'&add='
        );
    })();

    ///
    /// Assign competency from position dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/competency/idp/';

        yuiAssignDialog(
            'idppositioncompetency',
            url+'find-position.php?id='+idp_revision_id,
            url+'save.php?id='+idp_revision_id+'&rowcount='+idp_competency_row_count+'&add='
        );
    })();
});
