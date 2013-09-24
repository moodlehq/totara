$(document).ready(function() {
    var elements = document.getElementsByClassName('system_record_del');
    var index;
    for (index = 0; index < elements.length; ++index) {
        elements[index].hidden = false;
    }
});

$(document).on('click', '.system_record_del', function (event) {
    event.preventDefault();
    var userid = this.id;
    var sysnew = $('input[name="systemnew"]');
    var user_record = document.getElementById('system_user_' + userid);

    // Remove the user from displaying on the screen.
    user_record.parentNode.removeChild(user_record);

    // Remove the user from the hidden div used to add them.
    var sysval = sysnew.val().split(',');

    var newval = [];
    for (var i = 0; i < sysval.length; i++) {
        if (sysval[i] != userid) {
            newval.push(sysval[i]);
        }
    }

    sysnew.val(newval.join(','));
});

$(document).on('click', '.external_record_del', function (event) {
    event.preventDefault();

    var email = this.id;

    // Remove the email assignment from the display.
    var external_record = document.getElementById('external_user_' + email);
    external_record.parentNode.removeChild(external_record);

    // Add the email to #cancelledemails (commaseperated);
    var cancelled = $('input[name="emailcancel"]');
    if (cancelled.val()) {
        var newval = cancelled.val().split(',');
    } else {
        var newval = [];
    }
    newval.push(email);
    cancelled.val(newval.join(','));
//    console.log(cancelled.val());
});
