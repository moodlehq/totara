<?php

    require_once '../../config.php';

?>
// Bind functionality to page on load
$(function() {

    ///
    /// Competency dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/organisation/assigncompetency/';

        totaraMultiSelectDialog(
            'assignedcompetencies',
            url+'find.php?assignto='+organisation_id+'&add=',
            url+'assign.php?assignto='+organisation_id+'&deleteexisting=1&add='
        );
    })();

    ///
    /// Template dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/organisation/assigncompetencytemplate/';

        totaraMultiSelectDialog(
            'assignedcompetencytemplates',
            url+'find.php?assignto='+organisation_id+'&add=',
            url+'assign.php?assignto='+organisation_id+'&deleteexisting=1&add='
        );
    })();

});
