// Courses loaded flags
// Indexed by category id
evidence_courses_loaded = [];


// Bind functionality to page on load
YAHOO.util.Event.onDOMReady(function () {
    YAHOO.dialog.evidence = new yuiDialog(
        'addevidence',
        'show-evidence-dialog',
        'evidence/edit.php?id=' + competency_id
    );
});


// Setup function
// Run on dialog load
YAHOO.dialogSetupFunc.addevidence = function() {

    $('#addevidence #categories').treeview();

    // Load courses on category click
    $('#addevidence #categories span.folder, '+
      '#addevidence #categories div.hitarea').click(function() {
            // Get parent for id
            var par = $(this).parent();

            // Id in format cat_list_XX
            var id = par.attr('id').substr(9);
            evidence_load_courses(id);
    });
}


// Load courses for this category
function evidence_load_courses(cat) {

    if (evidence_courses_loaded[cat]) {
        // TODO: Fix caching
        //return;
        // Continue for the meantime
    }

    var callback =
    {
        success:    evidence_add_courses,
        failure:    function(o) {},
        argument:   cat,
    }

    // Load courses
    YAHOO.util.Connect.asyncRequest(
        'GET',
        'evidence/category.php?id='+cat,
        callback
    );
}


// Add courses to category
function evidence_add_courses(response) {

    var cat_id = response.argument;
    var courses = YAHOO.lang.JSON.parse(response.responseText);
    var list = $('#addevidence #categories li#cat_list_'+cat_id+' ul:first');

    // Prevent courses from being reloaded later
    evidence_courses_loaded[cat_id] = true;

    // Remove "Loading courses..." list item
    $('li:last', list).remove();

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

        evidence_load_coursedata(id);
    });
}


// Load course data
function evidence_load_coursedata(course) {

    var callback =
    {
        success:    evidence_display_coursedata,
        failure:    function(o) {},
        argument:   course,
    }

    // Load data
    YAHOO.util.Connect.asyncRequest(
        'GET',
        'evidence/course.php?id='+course+'&competency='+competency_id,
        callback
    );
}

// Display course data
function evidence_display_coursedata(response) {

    var course_id = response.argument;
    var html = response.responseText;

    var display = $('#addevidence #available-evidence').html(html);

    // Handle add evidence links
    $('#addevidence #available-evidence a').click( function(event) {
        event.preventDefault();
        $.get($(this).attr('href'), '', evidence_new_evidence);
    });
}

// Add new evidence to competency view
function evidence_new_evidence(response) {
    YAHOO.dialog.evidence.dialog.hide();

    // Delete no evidence items warning, if exists
    $('table.editcompetency tr.noevidenceitems').remove();

    $('table.editcompetency tbody').append(response);
}
