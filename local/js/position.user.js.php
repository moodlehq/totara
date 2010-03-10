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

        locateDialog(
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

        locateDialog(
            'organisation',
            url+'find.php?user='+user_id,
            function(selected) {
                $('input[name=templateid]').val(selected.attr('id'));
                $('span#templatetitle').text(selected.text());
            }
        );
    })();


    ///
    /// Manager dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/position/assign/';

        locateDialog(
            'manager',
            url+'manager.php?user='+user_id,
            function(selected) {
                $('input[name=managerid]').val(selected.attr('id'));
                $('span#managertitle').text(selected.text());
            }
        );
    })();
});


var locateDialog = function(name, find_url, clickhandler) {

    var handler = new yuiDialog_handler_treeview_clickable();
    handler.clickhandler = clickhandler;

    YAHOO.dialog[name] = new yuiDialog(
        name,
        'show-'+name+'-dialog',
        {},
        find_url,
        handler
    );

}
