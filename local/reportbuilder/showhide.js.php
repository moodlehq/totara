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

        var handler = new totaraDialog_handler_treeview();
        var name = 'showhide';

        totaraDialogs[name] = new totaraDialog(
            name,
            'show-'+name+'-dialog',
            {},
            url+'showhide.php?id='+id
        );
    })();

});
