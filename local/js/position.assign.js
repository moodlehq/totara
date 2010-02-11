// Bind functionality to page on load
YAHOO.util.Event.onDOMReady(function () {
    YAHOO.dialog.position = new yuiDialog(
        'positionassignment',
        'show-position-dialog',
        {},
        '/hierarchy/type/position/assign/find.php?user='+user_id
    );
});


// Setup function
// Run on dialog load
YAHOO.dialogSetupFunc.positionassignment = function() {

    // Setup treeview
    $('#positionassignment #positions').treeview();

    positionassignment_bind($('#positionassignment #positions'));
}


// Bind click handler
function positionassignment_bind(parent_element) {

    var select = 'span.folder, div.hitarea';

    // Load child positions on category click
    $(select, parent_element).click(function() {

        // Get parent for id
        var par = $(this).parent();

        // Id in format position_list_XX
        var id = par.attr('id').substr(14);
        positionassignment_load(id);
    });

    // Load position on click
    $('span.clickable', parent_element).click(function() {

        // Get id, format pos_XX
        var id = $(this).attr('id').substr(4);

        // Get title
        var title = $(this).text();

        positionassignment_save(id, title);
    });
}


// Load child positions
function positionassignment_load(parentid) {

    var callback =
    {
        success:    positionassignment_add,
        failure:    function(o) {},
        argument:   parentid
    }

    // Load positions
    YAHOO.util.Connect.asyncRequest(
        'GET',
        '../type/competency/related/add.php?id='+competency_id+'&parentid='+parentid,
        callback
    );
}


// Add positions to parent
function positionassignment_add(response) {

    var parent_id = response.argument;
    var positions = response.responseText;
    var list = $('#relatedcompetencies #competencies li#competency_list_'+parent_id+' ul:first');

    // Remove all existing children
    $('li', list).remove();

    // Add competencies
    $('#relatedcompetencies #competencies').treeview({add: list.append($(competencies))});

    // Add click handlers for course names
    relatedcompetencies_bind(list);
}

// Save new position
function positionassignment_save(id, title) {

    // Hide dialog
    YAHOO.dialog.position.dialog.hide();

    // Update form
    $('input[name=positionid]').val(id);
    $('span#positiontitle').text(title);
}
