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

        assignDialog(
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

        assignDialog(
            'assignedcompetencytemplates',
            url+'find.php?assignto='+position_id+'&add=',
            url+'assign.php?assignto='+position_id+'&add='
        );
    })();

});


var assignDialog = function(name, find_url, save_url) {

    var handler = new yuiDialog_handler_treeview_draggable();

    YAHOO.dialog[name] = new yuiDialog(
        name,
        'show-'+name+'-dialog',
        {
            buttons : [
                { text: 'Save changes', handler: function() { handler._save(save_url) } }
            ]
        },
        find_url,
        handler
    );

}
