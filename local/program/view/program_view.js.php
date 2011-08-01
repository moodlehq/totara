<?php

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once($CFG->dirroot.'/local/js/lib/setup.php');
require_once($CFG->dirroot.'/local/program/lib.php');

require_login();

$id = required_param('id', PARAM_INT);
$userid = optional_param('userid', $USER->id, PARAM_INT);

?>

// Bind functionality to page on load
$(function() {

    totaraDialogs['extension'] = new totaraDialog_extension();

    // Bind the extension request dialog to the 'Request an extension' link
    $('.timeallowed a').click(function() {
        totaraDialogs['extension'].open();
        return false;
    });

});

// Define the extension request dialog
totaraDialog_extension = function() {

    this.url = '<?php echo $CFG->wwwroot; ?>/local/program/view/set_extension.php?id=<?php echo $id ?>&amp;userid=<?php echo $userid ?>';

    // Setup the handler
    var handler = new totaraDialog_extension_handler();

    // Store reference to this
    var self = this;

    // Call the parent dialog object and link us
    totaraDialog.call(
    this,
    'extension-dialog',
    'unused', // buttonid unused
    {
        buttons: {
        '<?php echo get_string('cancel','local_program'); ?>': function() { handler._cancel(); },
        '<?php echo get_string('ok','local_program'); ?>': function() { handler._save(); }
        },
        title: '<h2><?php echo get_string('extensionrequest', 'local_program'); ?></h2>'
    },
    this.url,
    handler
    );

    this.old_open = this.open;
    this.open = function() {
    this.old_open();
    this.dialog.height(150);
    }

}

totaraDialog_extension_handler = function() {};

totaraDialog_extension_handler.prototype = new totaraDialog_handler();

totaraDialog_extension_handler.prototype.first_load = function() {
    var handler = this;

    $('.extensiontime', this._container).datepicker({
    dateFormat: 'dd/mm/yy',
    showOn: 'both',
    buttonImage: '<?php echo $CFG->wwwroot; ?>/local/js/images/calendar.gif',
    buttonImageOnly: true,
    beforeShow: function() { $('#ui-datepicker-div').css('z-index',1600); },
    constrainInput: true
    });
}

// Adapt the handler's save function
totaraDialog_extension_handler.prototype._save = function() {

    var success = false;

    var extensiontime = $('.extensiontime', this._container).val();
    var extensionreason = $('.extensionreason', this._container).val();

    var dateformat = new RegExp("[0-3][0-9]/(0|1)[0-9]/(19|20)[0-9]{2}");

    if (dateformat.test(extensiontime) == false) {
        alert("<?php echo get_string('pleaseentervaliddate', 'local_program'); ?>");
    } else if (extensionreason=='') {
        alert("<?php echo get_string('pleaseentervalidreason', 'local_program'); ?>");
    } else {
        success = true;
    }

    if (success) {
        window.location.href='<?php echo $CFG->wwwroot; ?>/local/program/required.php?id=<?php echo $id ?>'+
            '&userid=<?php echo $userid ?>'+
            '&extrequest=1'+
            '&extdate='+encodeURIComponent(extensiontime)+
            '&extreason='+encodeURIComponent(extensionreason);
        this._dialog.hide();
    }

}
