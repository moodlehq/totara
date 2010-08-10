<?php

    require_once '../../config.php';

?>
// Bind functionality to page on load
$(function() {

    ///
    /// Competency dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/position/assigncompetency/';

        mitmsMultiSelectDialog(
            'assignedcompetencies',
            url+'find.php?assignto='+position_id+'&frameworkid='+position_frameworkid+'&add=',
            url+'assign.php?assignto='+position_id+'&frameworkid='+position_frameworkid+'&deleteexisting=1&add='
        );
    })();

    ///
    /// Template dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/position/assigncompetencytemplate/';

        mitmsMultiSelectDialog(
            'assignedcompetencytemplates',
            url+'find.php?assignto='+position_id+'&frameworkid='+position_frameworkid+'&add=',
            url+'assign.php?assignto='+position_id+'&frameworkid='+position_frameworkid+'&deleteexisting=1&add='
        );
    })();

});
