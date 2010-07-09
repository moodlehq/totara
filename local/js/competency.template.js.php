<?php

    require_once '../../config.php';

?>

// Bind functionality to page on load
$(function() {

    ///
    /// Add related competency dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/competency/template/';

        mitmsMultiSelectDialog(
            'assignment',
            url+'find_competency.php?templateid='+competency_template_id,
            url+'save_competency.php?templateid='+competency_template_id+'&deleteexisting=1&add='
        );
    })();

});
