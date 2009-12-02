var courseprerequisites_used = new Array();


// Bind functionality to page on load
YAHOO.util.Event.onDOMReady(function () {
    YAHOO.dialog.prerequisite = new yuiDialog(
        'addcourseprerequisite',
        'id_add_criteria_course',
        {},
        'completion_prerequisite.php?id='+course_id
    );
});


// Setup function
// Run on dialog load
YAHOO.dialogSetupFunc.addcourseprerequisite = function() {

    // Setup treeview
    $('#addcourseprerequisite #categories').treeview();

    // Load courses on category click
    $('#addcourseprerequisite #categories span.folder, '+
      '#addcourseprerequisite #categories div.hitarea').click(function() {

        // Get parent for id
        var par = $(this).parent();

        // Id in format cat_list_XX
        var id = par.attr('id').substr(9);

        courseprerequisites_load_courses(id);
    });
}

// Load courses for this category
function courseprerequisites_load_courses(cat) {

    var callback =
    {
        success:    courseprerequisites_add_courses,
        failure:    function(o) {},
        argument:   cat
    }

    // Load courses
    YAHOO.util.Connect.asyncRequest(
        'GET',
        'completion_prerequisite.php?id='+course_id+'&category='+cat,
        callback
    );
}


// Add courses to category
function courseprerequisites_add_courses(response) {

    var cat_id = response.argument;
    var courses = YAHOO.lang.JSON.parse(response.responseText);
    var list = $('#addcourseprerequisite #categories li#cat_list_'+cat_id+' ul:first');

    // Remove "Loading courses..." list item
    $('li.loading', list).remove();

    // Add courses
    var length = courses.length;
    var html = '';
    for (var course in courses) {

        // Check this isn't a course we have used (added to settings form)
        if (courseprerequisites_used.indexOf(parseInt(courses[course]['id'])) != -1) {
            continue;
        }

        html = html + '<li>';
        html = html + '<span class="clickable" id="course_list_'+courses[course]['id']+'">'+courses[course]['fullname']+'</span></li>';
    }

    // If no courses added
    if (html == '') {
        html = '<li><span>No courses</span></li>';
    }

    $('#addcourseprerequisite #categories').treeview({add: list.append($(html))});

    // Add click handlers for course names
    $('span.clickable', list).click(function() {
        // Get course title and id
        var id = $(this).attr('id').substr(12);
        var text = $(this).text();

        // Add to used array
        courseprerequisites_used.push(parseInt(id));

        // Add to settings form
        courseprerequisites_save_course(text, id);
    });
}


// Add new prerequisite to completion settings form
function courseprerequisites_save_course(cname, cid) {

    YAHOO.dialog.prerequisite.dialog.hide();

    // Get button fitem
    var button_fitem = $('#id_add_criteria_course').parent().parent();

    // Delete no prerequisites warning, if exists
    var statics = $('#courseprerequisites span.nocoursesselected');
    if (statics) {
        $(statics).parent().parent().remove();
    }

    var html = '<div class="fitem"><div class="fitemtitle"><label for="id_dynprereq_'+cid+'">'+cname+'</label></div>';
    var html = html + '<div class="felement fcheckbox"><span>';
    var html = html + '<input id="id_dyncprereq_'+cid+'" type="checkbox" name="criteria_course['+cid+']" checked="checked" value="1" />';
    var html = html + '</span></div></div>';

    $(button_fitem).before(html);
}
