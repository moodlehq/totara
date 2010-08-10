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

        var handler = new mitmsDialog_handler();
        var name = 'showhide';

        mitmsDialogs[name] = new mitmsDialog(
            name,
            'show-'+name+'-dialog',
            {
                buttons: {
                    'Ok': function() { handler._cancel() }
                }
            },
            url+'showhide.php?id='+id.toString(),
            handler
        );
    })();

});
