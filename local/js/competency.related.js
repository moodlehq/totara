// Bind functionality to page on load
YAHOO.util.Event.onDOMReady(function () {
    YAHOO.dialog.related = new yuiDialog(
        'relatedcompetencies',
        'show-related-dialog',
        {
            buttons : [
                { text: 'Save changes', handler: relatedcompetencies_save }
            ]
        }
    );
});


// Setup function
// Run on dialog load
YAHOO.dialogSetupFunc.relatedcompetencies = function() {

    // Setup treeview
    $('#relatedcompetencies #competencies').treeview();

    // Setup droppable
    $('#relatedcompetencies #selectedcompetencies').droppable({
        drop: relatedcompetencies_drop
    });

    relatedcompetencies_bind($('#relatedcompetencies #competencies'));
}


// Handle dropping
function relatedcompetencies_drop(event, ui) {
    // Get drop box
    var dropbox = $('#relatedcompetencies #selectedcompetencies');

    // Append clone
    dropbox.append(ui.draggable.clone());
}


// Bind click handler
function relatedcompetencies_bind(parent_element) {

    var select = 'span.folder, div.hitarea';

    // Load courses on category click
    $(select, parent_element).click(function() {

        // Get parent for id
        var par = $(this).parent();

        // Id in format competency_list_XX
        var id = par.attr('id').substr(16);
        relatedcompetencies_load_competencies(id);
    });

    // Make draggable
    $('span:not(.empty)', parent_element).draggable({
        containment: 'body',
        helper: 'clone'
    });
}


// Load child competencies
function relatedcompetencies_load_competencies(parentid) {

    var callback =
    {
        success:    relatedcompetencies_add_competencies,
        failure:    function(o) {},
        argument:   parentid
    }

    // Load courses
    YAHOO.util.Connect.asyncRequest(
        'GET',
        '../type/competency/related/add.php?id='+competency_id+'&parentid='+parentid,
        callback
    );
}


// Add competencies to parent
function relatedcompetencies_add_competencies(response) {

    var parent_id = response.argument;
    var competencies = response.responseText;
    var list = $('#relatedcompetencies #competencies li#competency_list_'+parent_id+' ul:first');

    // Remove all existing children
    $('li', list).remove();

    // Add competencies
    $('#relatedcompetencies #competencies').treeview({add: list.append($(competencies))});

    // Add click handlers for course names
    relatedcompetencies_bind(list);
}

// Save new competencies
function relatedcompetencies_save() {

    // Serialize data
    var assignments = '';
    $('#relatedcompetencies #selectedcompetencies span').each(
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
        success:    relatedcompetencies_update,
        failure:    function(o) {}
    }

    YAHOO.util.Connect.asyncRequest(
        'GET',
        '../type/competency/related/save.php?id='+competency_id+'&add='+assignments,
        callback
    );
}

function relatedcompetencies_update(response) {

    // Hide dialog
    YAHOO.dialog.related.dialog.hide();

    // Update list
    // Delete no evidence items warning, if exists
    $('table#list-related-competencies tr.noitems').remove();

    $('table#list-related-competencies tbody').append(response.responseText);
}
