// Bind functionality to page on load
YAHOO.util.Event.onDOMReady(function () {
    YAHOO.dialog.organisation = new yuiDialog(
        'organisationassignment',
        'show-organisation-dialog',
        {},
        '../hierarchy/type/organisation/assign/find.php?user='+user_id
    );
});


// Setup function
// Run on dialog load
YAHOO.dialogSetupFunc.organisationassignment = function() {

    // Setup treeview
    $('#organisationassignment #organisations').treeview();

    organisationassignment_bind($('#organisationassignment #organisations'));

    // Bind function to framework picker
    $('#organisationassignment #framework-picker').change(organisationassignment_set_framework);
}


// Bind click handler
function organisationassignment_bind(parent_element) {

    var select = 'div.hitarea';

    // Load child organisations on category click
    $(select, parent_element).click(function() {

        // Get parent for id
        var par = $(this).parent();

        // Id in format organisation_list_XX
        var id = par.attr('id').substr(18);
        organisationassignment_load(id);
    });

    // Load organisation on click
    $('span.clickable, span.folder', parent_element).click(function() {

        // Get id, format org_XX
        var id = $(this).attr('id').substr(4);

        // Get title
        var title = $(this).text();

        organisationassignment_save(id, title);
    });
}


// Load child organisations
function organisationassignment_load(parentid) {

    var callback =
    {
        success:    organisationassignment_add,
        failure:    function(o) {},
        argument:   parentid
    }

    // Load organisations
    YAHOO.util.Connect.asyncRequest(
        'GET',
        '../hierarchy/type/organisation/assign/find.php?user='+user_id+'&parentid='+parentid,
        callback
    );
}


// Add organisations to parent
function organisationassignment_add(response) {

    var parent_id = response.argument;
    var organisations = response.responseText;
    var list = $('#organisationassignment #organisations li#organisation_list_'+parent_id+' ul:first');

    // Remove all existing children
    $('li', list).remove();

    // Add organisations
    $('#organisationassignment #organisations').treeview({add: list.append($(organisations))});

    // Add click handlers for organisations
    organisationassignment_bind(list);
}

// Save new organisation
function organisationassignment_save(id, title) {

    // Hide dialog
    YAHOO.dialog.organisation.dialog.hide();

    // Update form
    $('input[name="organisationid"]').val(id);
    $('span#organisationtitle').text(title);
}

// Change framework
function organisationassignment_set_framework() {

    // Get currently selected option
    var selected = $('#framework-picker option:selected').val();

    var dialog = YAHOO.dialog.organisation;

    // Update URL
    var url = '../hierarchy/type/organisation/assign/find.php'+
              '?user='+user_id+
              '&frameworkid='+selected;

    dialog.load(url, 'GET');

    return false;
}
