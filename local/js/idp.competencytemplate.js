// Bind functionality to page on load
YAHOO.util.Event.onDOMReady(function () {
    YAHOO.dialog.idpcompetencytemplates = new yuiDialog(
        'idpcompetencytemplates',
        'show-idpcompetencytemplate-dialog',
        {
            buttons : [
                { text: 'Save changes', handler: idpcompetencytemplates_save }
            ]
        }
    );
});


// Setup function
// Run on dialog load
YAHOO.dialogSetupFunc.idpcompetencytemplates = function() {

    // Setup treeview
    $('#idpcompetencytemplates #competencies').treeview();

    // Setup droppable
    $('#idpcompetencytemplates #selectedcompetencies').droppable({
        drop: idpcompetencytemplates_drop
    });

    idpcompetencytemplates_bind($('#idpcompetencytemplates #competencies'));

    // Bind function to framework picker
    $('#idpcompetencytemplates #framework-picker').change(idpcompetencytemplates_set_framework);
}


// Handle dropping
function idpcompetencytemplates_drop(event, ui) {
    // Get drop box
    var dropbox = $('#idpcompetencytemplates #selectedcompetencies');

    // Append clone
    dropbox.append(ui.draggable.clone());
}


// Bind click handler
function idpcompetencytemplates_bind(parent_element) {

    // Make draggable
    $('span:not(.empty)', parent_element).draggable({
        containment: 'body',
        helper: 'clone'
    });
}


// Save new competencies
function idpcompetencytemplates_save() {

    // Serialize data
    var assignments = '';
    $('#idpcompetencytemplates #selectedcompetencies span').each(
        function (intIndex) {
            var id = $(this).attr('id').substr(4);

            if (assignments.length) {
                id = ','+id;
            }

            assignments = assignments + id;
        }
    );

    // Send to server
    var callback =
    {
        success:    idpcompetencytemplates_update,
        failure:    function(o) {}
    }

    YAHOO.util.Connect.asyncRequest(
        'GET',
        '../hierarchy/type/competency/idp/save-template.php?id='+idp_revision_id+'&rowcount='+idp_competencytemplate_row_count+'&add='+assignments,
        callback
    );
}

function idpcompetencytemplates_update(response) {

    // Hide dialog
    YAHOO.dialog.idpcompetencytemplates.dialog.hide();

    // Update list
    // Delete no evidence items warning, if exists
    $('table#list-idp-competencytemplates tr.noitems').remove();

    $('table#list-idp-competencytemplates tbody').append(response.responseText);
}

// Change framework
function idpcompetencytemplates_set_framework() {

    // Get currently selected option
    var selected = $('#framework-picker option:selected').val();

    var dialog = YAHOO.dialog.idpcompetencytemplates;

    // Update URL
    var url = dialog.url;

    // See if framework specific
    if (url.indexOf('frameworkid=') == -1) {
        url = url + '&frameworkid=' + selected;
    } else {
        // Get start of frameworkid
        var start = url.indexOf('frameworkid=') + 12;

        // Find how many characters long the value is
        var end = url.indexOf('&', start);

        // If no following &, it is the end of the url
        if (end == -1) {
            url = url.substring(0, start) + selected;
        // Just replace the value
        } else {
            url = url.substring(0, start) + selected + url.substring(end);
        }
    }

    dialog.load(url, 'GET');

    return false;
}
