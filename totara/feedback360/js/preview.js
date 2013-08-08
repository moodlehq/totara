$(document).on('click', '.previewlink', function (event) {
    event.preventDefault();
    var formid = this.id;
    var url = $('input[name="popupurl"]').val() + formid;

    console.log(url);

    var popup = window.open(url, 'name', 'height=800,width=1000');
    if (window.focus) {
        popup.focus();
    }
});
