// Bind functionality to page on load
YAHOO.util.Event.onDOMReady(function () {
    YAHOO.dialog.idpcompetencies = new yuiDialog(
        'idpcompetencies',
        'show-idpcompetency-dialog',
        {
            buttons : [
                { text: 'Save changes', handler: idpcompetencies_save }
            ]
        }
    );
});


// Setup function
// Run on dialog load
YAHOO.dialogSetupFunc.idpcompetencies = function() {

    // Setup treeview
    $('#idpcompetencies #competencies').treeview();

    // Setup droppable
    $('#idpcompetencies #selectedcompetencies').droppable({
        drop: idpcompetencies_drop
    });

    idpcompetencies_bind($('#idpcompetencies #competencies'));
}


// Handle dropping
function idpcompetencies_drop(event, ui) {
    // Get drop box
    var dropbox = $('#idpcompetencies #selectedcompetencies');

    // Append clone
    dropbox.append(ui.draggable.clone());
}


// Bind click handler
function idpcompetencies_bind(parent_element) {

    var select = 'span.folder, div.hitarea';

    // Load courses on category click
    $(select, parent_element).click(function() {

        // Get parent for id
        var par = $(this).parent();

        // Id in format competency_list_XX
        var id = par.attr('id').substr(16);
        idpcompetencies_load_competencies(id);
    });

    // Make draggable
    $('span:not(.empty)', parent_element).draggable({
        containment: 'body',
        helper: 'clone'
    });
}


// Load child competencies
function idpcompetencies_load_competencies(parentid) {
    var callback =
    {
        success:    idpcompetencies_add_competencies,
        failure:    function(o) {},
        argument:   parentid
    }

    // Load courses
    YAHOO.util.Connect.asyncRequest(
        'GET',
        '../hierarchy/type/competency/idp/add.php?id='+idp_revision_id+'&parentid='+parentid,
        callback
    );
}


// Add competencies to parent
function idpcompetencies_add_competencies(response) {

    var parent_id = response.argument;
    var competencies = response.responseText;
    var list = $('#idpcompetencies #competencies li#competency_list_'+parent_id+' ul:first');

    // Remove all existing children
    $('li', list).remove();

    // Add competencies
    $('#idpcompetencies #competencies').treeview({add: list.append($(competencies))});

    // Add click handlers for course names
    idpcompetencies_bind(list);
}

// Save new competencies
function idpcompetencies_save() {

    // Serialize data
    var assignments = '';
    $('#idpcompetencies #selectedcompetencies span').each(
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
        success:    idpcompetencies_update,
        failure:    function(o) {}
    }

    YAHOO.util.Connect.asyncRequest(
        'GET',
        '../hierarchy/type/competency/idp/save.php?id='+idp_revision_id+'&rowcount='+idp_competency_row_count+'&add='+assignments,
        callback
    );
}

function idpcompetencies_update(response) {

    // Hide dialog
    YAHOO.dialog.idpcompetencies.dialog.hide();

    // Update list
    // Delete no evidence items warning, if exists
    $('table#list-idp-competencies tr.noitems').remove();

    $('table#list-idp-competencies tbody').append(response.responseText);
}
