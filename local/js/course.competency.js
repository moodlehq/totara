// Bind functionality to page on load
YAHOO.util.Event.onDOMReady(function () {
    YAHOO.dialog.coursecompetency = new yuiDialog(
        'coursecompetency',
        'show-coursecompetency-dialog',
        {}
    );
});


// Setup function
// Run on dialog load
YAHOO.dialogSetupFunc.coursecompetency = function() {

    // Setup treeview
    $('#coursecompetency #competencies').treeview();

    coursecompetency_bind($('#coursecompetency #competencies'));

    // Bind function to framework picker
    $('#coursecompetency #framework-picker').change(coursecompetency_set_framework);
}


// Bind click handler
function coursecompetency_bind(parent_element) {

    var select = 'div.hitarea';

    // Load competency on category click
    $(select, parent_element).click(function() {

        // Get parent for id
        var par = $(this).parent();

        // Id in format competency_list_XX
        var id = par.attr('id').substr(16);
        coursecompetency_load_competency(id);
    });

    // Use competency on click
    $('span.clickable, span.folder', parent_element).click(function() {

        // Get id, format cmp_XX
        var id = $(this).attr('id').substr(4);

        var callback =
        {
            success:    coursecompetency_evidence,
            failure:    function(o) {}
        }

        // Load data
        YAHOO.util.Connect.asyncRequest(
            'GET',
            '../hierarchy/type/competency/course/evidence.php?id='+course_id+'&add='+id,
            callback
        );
    });
}


// Load child competency
function coursecompetency_load_competency(parentid) {

    var callback =
    {
        success:    coursecompetency_add_competency,
        failure:    function(o) {},
        argument:   parentid
    }

    // Load courses
    YAHOO.util.Connect.asyncRequest(
        'GET',
        '../hierarchy/type/competency/course/add.php?parentid='+parentid,
        callback
    );
}


// Add competency to parent
function coursecompetency_add_competency(response) {

    var parent_id = response.argument;
    var competency = response.responseText;
    var list = $('#coursecompetency #competencies li#competency_list_'+parent_id+' ul:first');

    // Remove all existing children
    $('li', list).remove();

    // Add competency
    $('#coursecompetency #competencies').treeview({add: list.append($(competency))});

    // Add click handlers for course names
    coursecompetency_bind(list);
}

function coursecompetency_evidence(response) {

    var html = response.responseText;
    var display = $('#coursecompetency .bd').html(html);

    // Handle add evidence links
    $('#coursecompetency .selectcompetencies a').click( function(event) {
        event.preventDefault();
        $.get($(this).attr('href'), '', coursecompetency_show);
    });
}

function coursecompetency_show(response) {

    YAHOO.dialog.coursecompetency.dialog.hide();

    // Delete no evidence items warning, if exists
    $('#list-course-competencies tr.noitems').remove();

    $('#list-course-competencies tbody').append(response);
}

// Change framework
function coursecompetency_set_framework() {

    // Get currently selected option
    var selected = $('#framework-picker option:selected').val();

    var dialog = YAHOO.dialog.coursecompetency;

    // Update URL
    var url = dialog.url;

    // See if framework specific
    if (url.indexOf('frameworkid=') == -1) {
        url = url + '&frameworkid=' + selected;
    } else {
        // Get start of frameworkid
        var start = url.indexOf('frameworkid=') + 12;

        // Find how many characters long the value is
        var end = url.indexOf('&', start);

        // If no following &, it is the end of the url
        if (end == -1) {
            url = url.substring(0, start) + selected;
        // Just replace the value
        } else {
            url = url.substring(0, start) + selected + url.substring(end);
        }
    }

    dialog.load(url, 'GET');

    return false;
}
