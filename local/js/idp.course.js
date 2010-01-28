// Bind functionality to page on load
YAHOO.util.Event.onDOMReady(function () {
    YAHOO.dialog.courses = new yuiDialog(
        'idpcourses',
        'show-idpcourse-dialog',
        {   
            buttons : [ 
                { text: 'Save changes', handler: idpcourses_save }
            ]   
        }   
    );
});


// Setup function
// Run on dialog load
YAHOO.dialogSetupFunc.idpcourses = function() {

    $('#idpcourses #categories').treeview();

    // Setup droppable
    $('#idpcourses #selectedcourses').droppable({
        drop: idpcourses_drop
    });

    idpcourses_bind($('#idpcourses #categories'));
}

// Handle dropping
function idpcourses_drop(event, ui) {
    // Get drop box
    var dropbox = $('#idpcourses #selectedcourses');

    // Append clone
    dropbox.append(ui.draggable.clone());
}

// Bind click handler
function idpcourses_bind(parent_element) {

    var select = 'span.folder, div.hitarea';

    // Load courses on category click
    $(select, parent_element).one('click', idpcourses_load_courses);

    // Make draggable
    $('span:not(.empty)', parent_element).draggable({
        containment: 'body',
        helper: 'clone'
    }); 
}

// Load child courses
function idpcourses_load_courses() {

    // Get parent for id
    var par = $(this).parent();

    // Id in format course_list_XX
    var parentid = par.attr('id').substr(9);

    // Check for loading list item
    var loading = $('#idpcourses #categories li#cat_list_'+parentid+' ul:first > li.loading');

    if (loading.length == 0) {
        // Already loaded, so ignore
        return;
    }

    var callback =
    {
        success:    idpcourses_add_courses,
        failure:    function(o) {},
        argument:   parentid
    }

    // Load courses
    YAHOO.util.Connect.asyncRequest(
        'GET',
        '../hierarchy/type/course/idp/category.php?id='+parentid,
        callback
    );
}

// Add courses to parent
function idpcourses_add_courses(response) {

    var cat_id = response.argument;
    var courses = YAHOO.lang.JSON.parse(response.responseText);
    var list = $('#idpcourses #categories li#cat_list_'+cat_id+' ul:first');

    // Remove "Loading courses..." list item
    $('> li.loading', list).remove();

    // Add courses
    var length = courses.length;
    var html = '';
    for (var course in courses) {

        html = html + '<li>';
        html = html + '<span class="clickable" id="course_list_'+courses[course]['id']+'">'+courses[course]['fullname']+'</span></li>';
    }

    // If no courses added
    if (length == 0) {
        html = '<li><span>No courses</span></li>';
    }

    $('#idpcourses #categories').treeview({add: list.append($(html))});

    idpcourses_bind(list);
}

// Save new courses
function idpcourses_save() {

    // Serialize data
    var assignments = '';
    $('#idpcourses #selectedcourses span').each(
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
        success:    idpcourses_update,
        failure:    function(o) {}
    }

    YAHOO.util.Connect.asyncRequest(
        'GET',
        '../hierarchy/type/course/idp/save.php?id='+idp_revision_id+'&add='+assignments,
        callback
    );
}

function idpcourses_update(response) {

    // Hide dialog
    YAHOO.dialog.courses.dialog.hide();

    // Update list
    // Delete no evidence items warning, if exists
    $('table#list-idp-courses tr.noitems').remove();

    $('table#list-idp-courses tbody').append(response.responseText);
}
