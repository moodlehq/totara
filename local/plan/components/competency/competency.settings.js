$(document).ready(function() {
    // disable checkboxes on page load
    dp_competency_disable_dependencies();
    // check each time the checkboxes are changed
    $('#mform1 input[name=autoassignpos], #mform1 input[name=autoassignorg]').change(function() {
        dp_competency_disable_dependencies();

    });
});

/**
 * Disable 'include completed competencies' and 'include linked courses',
 * unless either 'auto assign by positions' or 'auto assign by organisations' are enabled
 */
function dp_competency_disable_dependencies() {
    if ($('#mform1 input[name=autoassignpos]').is(':checked') ||
       $('#mform1 input[name=autoassignorg]').is(':checked')) {
        $('#mform1 input[name=includecompleted]').attr('disabled', '');
        $('#mform1 input[name=autoassigncourses]').attr('disabled', '');
    } else {
        $('#mform1 input[name=includecompleted]').attr('disabled', 'disabled');
        $('#mform1 input[name=autoassigncourses]').attr('disabled', 'disabled');
    }
}

