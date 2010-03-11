<?php

    require_once '../../config.php';

?>
// Bind functionality to page on load
YAHOO.util.Event.onDOMReady(function () {

    ///
    /// Position dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/position/assign/';

        yuiLocateDialog(
            'position',
            url+'find.php?user='+user_id,
            function(selected) {
                $('input[name=positionid]').val(selected.attr('id'));
                $('span#positiontitle').text(selected.text());
            }
        );
    })();


    ///
    /// Organisation dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/organisation/assign/';

        yuiLocateDialog(
            'organisation',
            url+'find.php?user='+user_id,
            function(selected) {
                $('input[name=organisationid]').val(selected.attr('id'));
                $('span#organisationtitle').text(selected.text());
            }
        );
    })();


    ///
    /// Manager dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/position/assign/';

        yuiLocateDialog(
            'manager',
            url+'manager.php?user='+user_id,
            function(selected) {
                $('input[name=managerid]').val(selected.attr('id'));
                $('span#managertitle').text(selected.text());
            }
        );
    })();
});
