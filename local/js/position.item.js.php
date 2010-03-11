<?php

    require_once '../../config.php';

?>
// Bind functionality to page on load
YAHOO.util.Event.onDOMReady(function () {

    ///
    /// Competency dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/position/assigncompetency/';

        yuiAssignDialog(
            'assignedcompetencies',
            url+'find.php?assignto='+position_id+'&add=',
            url+'assign.php?assignto='+position_id+'&add='
        );
    })();

    ///
    /// Template dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/position/assigncompetencytemplate/';

        yuiAssignDialog(
            'assignedcompetencytemplates',
            url+'find.php?assignto='+position_id+'&add=',
            url+'assign.php?assignto='+position_id+'&add='
        );
    })();

});
