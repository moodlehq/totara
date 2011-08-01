$(function() {
    // Handle program icon change preview
    $('#id_icon').change(function() {
        var selected = $(this);
        var src = $('#program_icon_preview').attr('src');

        src = src.replace(/icon=[^&]*/, 'icon='+selected.val());

        $('#program_icon_preview').attr('src', src);
    });
});
