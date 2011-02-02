// Javascript to pre-fill column headings with the appropriate title
// when a column is selected

$(document).ready(function() {
    // disable the new column heading field on page load
    $('#id_newheading').attr('disabled', true);

    // handle changes to the column pulldowns
    $('select.column_selector').change(function() {
        var changedSelector = $(this).val();
        var newContent = rb_column_headings[changedSelector];
        $(this).parents('td')  // find the containing td tag
            .next('td')        // get the next sibling (contains textbox)
            .find('input')     // get the heading input field
            .val(newContent);  // insert new content
    });

    // special case for the 'Add another column...' selector
    $('select.new_column_selector').change(function() {
        var newHeadingBox = $(this).parents('td').next('td').find('input');
        if($(this).val() == 0) {
            // empty and disable the new heading box if no column chosen
            newHeadingBox.val('');
            newHeadingBox.attr('disabled', true);
        } else {
            // reenable it (binding above will fill the value)
            newHeadingBox.attr('disabled', false);
        }
    });
});
