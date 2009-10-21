YAHOO.competencies.setupFuncs.addevidence = function() {

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

// Courses loaded flags
// Indexed by category id
evidence_courses_loaded = [];

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
    var count = 0;
    for (var course in courses) {
        count++;

        var html = '';
        if (count == length) {
            html = html + '<li class="last">';
        } else {
            html = html + '<li>';
        }

        html = html + '<span class="clickable" id="course_list_'+courses[course]['id']+'">'+courses[course]['fullname']+'</span></li>';

        list.append($(html));
    }

    // If no courses added
    if (count == 0) {
        list.append($('<li class="last"><span>No courses</span></li>'));
    }

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
}
