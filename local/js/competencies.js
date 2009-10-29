// Setup
YAHOO.namespace('competencies.dialogs');
YAHOO.namespace('competencies.setupFuncs');

// Bind functionality to page on load
YAHOO.util.Event.onDOMReady(function () {
    YAHOO.competencies.dialogs.add = new yuiDialog(
        'addevidence',
        'show-evidence-dialog',
        'evidence/edit.php?id=' + competency_id
    );
});
