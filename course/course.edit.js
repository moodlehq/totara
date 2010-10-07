$(function() {
    // Handle course icon change preview
    $('#id_icon').change(function() {
        var selected = $(this);
        var src = $('#course_icon_preview').attr('src');

        src = src.replace(/icon=[^&]*/, 'icon='+selected.val());

        $('#course_icon_preview').attr('src', src);
    });
});
