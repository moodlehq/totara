$(function() {
    // Handle icon change preview
    $('#id_icon').change(function() {
        var selected = $(this);
        var src = $('#icon_preview').attr('src');

        src = src.replace(/icon=[^&]*/, 'icon='+selected.val());

        $('#icon_preview').attr('src', src);
    });
});
