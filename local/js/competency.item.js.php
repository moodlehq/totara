<?php

    require_once '../../config.php';

?>

// Bind functionality to page on load
$(function() {

    ///
    /// Add related competency dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/competency/related/';

        mitmsAssignDialog(
            'related',
            url+'find.php?id='+competency_id,
            url+'save.php?id='+competency_id+'&add='
        );
    })();

    /// Add new evidence item dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/competency/evidence/';

        mitmsAssignDialog(
            'evidence',
            url+'find.php?id='+competency_id,
            url+'save.php?id='+competency_id+'&add='
        );
    })();

});
