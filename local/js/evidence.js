YAHOO.competencies.setupFuncs.addevidence = function() {

    $('#addevidence #categories').treeview();

    // Load courses on category click
    $('#addevidence #categories span.folder').click(function() {
            // Id in format cat_XX
            var id = this.id.substr(4);
            evidence_load_courses(id);
    });
}

// Courses loaded flags
// Indexed by category id
evidence_courses_loaded = [];

// Load courses for this category
function evidence_load_courses(cat) {

    if (evidence_courses_loaded[cat]) {
        return;
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

        html = html + '<span class="clickable">'+courses[course]['fullname']+'</span></li>';

        list.append($(html));
    }

    // If no courses added
    if (count == 0) {
        list.append($('<li class="last"><span>No courses</span></li>'));
    }

    // Add click handlers for course names
    $('span.clickable', list).click(function() {
        alert('load course info');
    });
}
