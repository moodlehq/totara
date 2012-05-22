$(function() {
    // Handle icon change preview
    $('#id_icon').change(function() {
        var selected = $(this);
        var src = $('#icon_preview').attr('src');
        src = src.replace(/image=(.*?)icons%2F(.*?)&/, 'image=$1'+'icons%2F'+selected.val()+'&');
        $('#icon_preview').attr('src', src);
    });
});
