// Bind functionality to page on load
YAHOO.util.Event.onDOMReady(function () {
    YAHOO.dialog.competency = new yuiDialog(
        'assigncompetency',
        'show-assignment-dialog',
        {
            buttons : [
                { text: 'Save changes', handler: assigncompetency_save }
            ],
        }
    );
});


// Setup function
// Run on dialog load
YAHOO.dialogSetupFunc.assigncompetency = function() {

    // Setup treeview
    $('#assigncompetency #competencies').treeview();

    // Setup droppable
    $('#assigncompetency #selectedcompetencies').droppable({
        drop: assigncompetency_drop,
    });

    assigncompetency_bind($('#assigncompetency #competencies'));
}


// Handle dropping
function assigncompetency_drop(event, ui) {
    // Get drop box
    var dropbox = $('#assigncompetency #selectedcompetencies');

    // Append clone
    dropbox.append(ui.draggable.clone());
}


// Bind click handler
function assigncompetency_bind(parent_element) {

    var select = 'span.folder, div.hitarea';

    // Load courses on category click
    $(select, parent_element).click(function() {

        // Get parent for id
        var par = $(this).parent();

        // Id in format competency_list_XX
        var id = par.attr('id').substr(16);
        assigncompetency_load_competencies(id);
    });

    // Make draggable
    $('span:not(.empty)', parent_element).draggable({
        containment: 'body',
        helper: 'clone',
    });
}


// Load child competencies
function assigncompetency_load_competencies(parentid) {

    var callback =
    {
        success:    assigncompetency_add_competencies,
        failure:    function(o) {},
        argument:   parentid,
    }

    // Load courses
    YAHOO.util.Connect.asyncRequest(
        'GET',
        'assign_competency.php?templateid='+competency_template_id+'&parentid='+parentid,
        callback
    );
}


// Add competencies to parent
function assigncompetency_add_competencies(response) {

    var parent_id = response.argument;
    var competencies = response.responseText;
    var list = $('#assigncompetency #competencies li#competency_list_'+parent_id+' ul:first');

    // Remove all existing children
    $('li', list).remove();

    // Add competencies
    $('#assigncompetency #competencies').treeview({add: list.append($(competencies))});

    // Add click handlers for course names
    assigncompetency_bind(list);
}

// Save new assignments
function assigncompetency_save() {

    // Serialize data
    var assignments = '';
    $('#assigncompetency #selectedcompetencies span').each(
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
        success:    assigncompetency_update,
        failure:    function(o) {},
    }

    YAHOO.util.Connect.asyncRequest(
        'GET',
        'update_assignments.php?templateid='+competency_template_id+'&assign='+assignments,
        callback
    );
}

function assigncompetency_update(response) {

    // Hide dialog
    YAHOO.dialog.competency.dialog.hide();

    // Update list
    // Delete no evidence items warning, if exists
    $('table.editcompetency tr.noitems').remove();

    $('table.editcompetency tbody').append(response.responseText);
}

