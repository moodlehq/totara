// Courses loaded flags
// Indexed by category id
courses_loaded = [];


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

    idpcourses_bind($('#idpcourses #courses'));
/*
    // Load courses on category click
    $('#idpcourses #categories span.folder, '+
      '#idpcourses #categories div.hitarea').click(function() {
            // Get parent for id
            var par = $(this).parent();

            // Id in format cat_list_XX
            var id = par.attr('id').substr(9);
            load_courses(id);
    });
*/
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
    $(select, parent_element).click(function() {

        // Get parent for id
        var par = $(this).parent();

        // Id in format course_list_XX
        var id = par.attr('id').substr(9);
        idpcourses_load_courses(id);
    }); 

    // Make draggable
    $('span:not(.empty)', parent_element).draggable({
        containment: 'body',
        helper: 'clone'
    }); 
}

// Load child courses
function idpcourses_load_courses(parentid) {

    if (courses_loaded[parentid]) {
        // TODO: Fix caching
        //return;
        // Continue for the meantime
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
        '../hierarchy/type/courses/idp/category.php?id='+parentid,
        callback
    );
}

// Add courses to parent
function idpcourses_add_courses(response) {

    var parent_id = response.argument;
    var courses = YAHOO.lang.JSON.parse(response.responseText);
    var list = $('#idpcourses #categories li#cat_list_'+cat_id+' ul:first');

    // Prevent courses from being reloaded later
    courses_loaded[parent_id] = true;

    // Remove all existing children
    $('li', list).remove();

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

    $('#addevidence #categories').treeview({add: list.append($(html))});

    // Add click handlers for course names
    $('span.clickable', list).click(function() {
        // Get course id
        var id = $(this).attr('id').substr(12);

        idpcourses_load_coursedata(id);
    });
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
    YAHOO.dialog.related.dialog.hide();

    // Update list
    // Delete no evidence items warning, if exists
    $('table#list-idp-courses tr.noitems').remove();

    $('table#list-idp-courses tbody').append(response.responseText);
}

// Display course data
function display_courses(response) {

    var course_id = response.argument;
    var html = response.responseText;

    var display = $('#idpcourses #available-courses').html(html);

    // Handle add course links
    $('#idpcourses #available-courses a').click( function(event) {
        event.preventDefault();
        $.get($(this).attr('href'), '', new_courses);
    });
}

// Add new courses to idp courses view
function new_courses(response) {
    YAHOO.dialog.courses.dialog.hide();

    // Delete no courses warning, if exists
    $('table.viewcourses tr.noevidenceitems').remove();

    $('table.viewcourses tbody').append(response);
}
