<?php

    require_once('../../config.php');

    $templateid = optional_param('id', 0, PARAM_INT);

?>

// Bind functionality to page on load
$(function() {

    ///
    /// Add related competency dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/competency/template/';

        totaraMultiSelectDialog(
            'assignment',
            '<?php echo '<h2>' . get_string('assignnewcompetency', 'competency') . '</h2>'; ?>',
            url+'find_competency.php?templateid=<?php echo $templateid; ?>',
            url+'save_competency.php?templateid=<?php echo $templateid; ?>&deleteexisting=1&add='
        );
    })();

});
