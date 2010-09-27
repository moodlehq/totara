<?php

    require_once '../../config.php';

    $id = optional_param('id', 0, PARAM_INT);
    $frameworkid = optional_param('frameworkid', 0, PARAM_INT);

?>

// Bind functionality to page on load
$(function() {

    ///
    /// Competency dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/position/assigncompetency/';

        totaraMultiSelectDialog(
            'assignedcompetencies',
            '<?php echo get_string('assigncompetency', 'competency') ?>',
            url+'find.php?assignto=<?php echo $id;?>&frameworkid=<?php echo $frameworkid;?>&add=',
            url+'assign.php?assignto=<?php echo $id;?>&frameworkid=<?php echo $frameworkid;?>&deleteexisting=1&add='
        );
    })();

    ///
    /// Template dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/position/assigncompetencytemplate/';

        totaraMultiSelectDialog(
            'assignedcompetencytemplates',
            '<?php echo get_string('assigncompetencytemplate', 'competency') ?>',
            url+'find.php?assignto=<?php echo $id;?>&frameworkid=<?php echo $frameworkid;?>&add=',
            url+'assign.php?assignto=<?php echo $id;?>&frameworkid=<?php echo $frameworkid;?>&deleteexisting=1&add='
        );
    })();

});
