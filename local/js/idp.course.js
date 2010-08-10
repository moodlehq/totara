// Bind functionality to page on load
//YAHOO.util.Event.onDOMReady(function () {
//    YAHOO.dialog.courses = new yuiDialog(
//        'idpcourses',
//        'show-idpcourse-dialog',
//        {
//            buttons : [
//                { text: 'Save changes', handler: idpcourse_save }
//            ]
//        }
//    );
//});


// Setup function
// Run on dialog load
YAHOO.dialogSetupFunc.idpcourse = function() {

    $('#idpcourse #categories').treeview();

    // Setup droppable
    $('#idpcourse #selectedcourses').droppable({
        drop: idpcourse_drop
    });

    idpcourse_bind($('#idpcourse #categories'));
}

// Handle dropping
function idpcourse_drop(event, ui) {
    // Get drop box
    var dropbox = $('#idpcourse #selectedcourses');

    // Append clone
    dropbox.append(ui.draggable.clone());
}

// Bind click handler
function idpcourse_bind(parent_element) {

    var select = 'span.folder, div.hitarea';

    // Load courses on category click
    $(select, parent_element).one('click', idpcourse_load_courses);

    // Make draggable
    $('span:not(.empty)', parent_element).draggable({
        containment: 'body',
        helper: 'clone'
    });
}

// Load child courses
function idpcourse_load_courses() {

    // Get parent for id
    var par = $(this).parent();

    // Id in format course_list_XX
    var parentid = par.attr('id').substr(9);

    // Check for loading list item
    var loading = $('#idpcourse #categories li#cat_list_'+parentid+' ul:first > li.loading');

    if (loading.length == 0) {
        // Already loaded, so ignore
        return;
    }

    var callback =
    {
        success:    idpcourse_add_courses,
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
function idpcourse_add_courses(response) {

    var cat_id = response.argument;
    var courses = YAHOO.lang.JSON.parse(response.responseText);
    var list = $('#idpcourse #categories li#cat_list_'+cat_id+' ul:first');

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

    $('#idpcourse #categories').treeview({add: list.append($(html))});

    idpcourse_bind(list);
}

// Save new courses
function idpcourse_save() {

    // Serialize data
    var assignments = '';
    $('#idpcourse #selectedcourses span').each(
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
        success:    idpcourse_update,
        failure:    function(o) {}
    }

    YAHOO.util.Connect.asyncRequest(
        'GET',
        '../hierarchy/type/course/idp/save.php?id='+idp_revision_id+'&add='+assignments,
        callback
    );
}

function idpcourse_update(response) {

    // Hide dialog
    YAHOO.dialog.courses.dialog.hide();

    // Update list
    // Delete no evidence items warning, if exists
    $('table#list-idp-courses tr.noitems').remove();

    $('table#list-idp-courses tbody').append(response.responseText);
}
