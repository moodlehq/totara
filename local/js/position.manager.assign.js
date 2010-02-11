// Bind functionality to page on load
YAHOO.util.Event.onDOMReady(function () {
    YAHOO.dialog.manager = new yuiDialog(
        'managerassignment',
        'show-manager-dialog',
        {},
        '/hierarchy/type/position/assign/manager.php?user='+user_id
    );
});


// Setup function
// Run on dialog load
YAHOO.dialogSetupFunc.managerassignment = function() {

    // Setup treeview
    $('#managerassignment #managers').treeview();

    managerassignment_bind($('#managerassignment #managers'));

    // Bind function to framework picker
    $('#managerassignment #framework-picker').change(managerassignment_set_framework);
}


// Bind click handler
function managerassignment_bind(parent_element) {

    var select = 'span.folder, div.hitarea';

    // Load child managers on category click
    $(select, parent_element).click(function() {

        // Get parent for id
        var par = $(this).parent();

        // Id in format manager_list_XX
        var id = par.attr('id').substr(18);
        managerassignment_load(id);
    });

    // Load manager on click
    $('span.clickable', parent_element).click(function() {

        // Get id, format org_XX
        var id = $(this).attr('id').substr(4);

        // Get title
        var title = $(this).text();

        managerassignment_save(id, title);
    });
}


// Load child managers
function managerassignment_load(parentid) {

    var callback =
    {
        success:    managerassignment_add,
        failure:    function(o) {},
        argument:   parentid
    }

    // Load managers
    YAHOO.util.Connect.asyncRequest(
        'GET',
        '/hierarchy/type/manager/assign/find.php?user='+user_id+'&parentid='+parentid,
        callback
    );
}


// Add managers to parent
function managerassignment_add(response) {

    var parent_id = response.argument;
    var managers = response.responseText;
    var list = $('#managerassignment #managers li#manager_list_'+parent_id+' ul:first');

    // Remove all existing children
    $('li', list).remove();

    // Add managers
    $('#managerassignment #managers').treeview({add: list.append($(managers))});

    // Add click handlers for managers
    managerassignment_bind(list);
}

// Save new manager
function managerassignment_save(id, title) {

    // Hide dialog
    YAHOO.dialog.manager.dialog.hide();

    // Update form
    $('input[name=managerid]').val(id);
    $('span#managertitle').text(title);
}

// Change framework
function managerassignment_set_framework() {

    // Get currently selected option
    var selected = $('#framework-picker option:selected').val();

    var dialog = YAHOO.dialog.manager;

    // Update URL
    var url = '/hierarchy/type/manager/assign/find.php'+
              '?user='+user_id+
              '&frameworkid='+selected;

    dialog.load(url, 'GET');

    return false;
}
