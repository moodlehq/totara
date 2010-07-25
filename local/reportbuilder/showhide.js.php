<?php

    require_once '../../config.php';

?>
// bind functionality to page on load
$(function() {

    ///
    /// show/hide column dialog
    ///
    (function() {
        $('#show-showhide-dialog').css('display','block');
        var url = '<?php echo $CFG->wwwroot ?>/local/reportbuilder/';
        mitmsDialog(
            'showhide',
            'show-showhide-dialog',
            {},
            url+'showhide.php?id='+id,
            null
        );
    })();

});
