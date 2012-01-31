<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Alastair Munro <alastair.munro@totaralms.com>
 * @package totara
 * @subpackage program
 */

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
     <?php echo build_datepicker_js('input[name="extensiontime"]',false); ?>
    $('#ui-datepicker-div').css('z-index',1600);
}

totaraDialog_extension_handler.prototype.every_load = function() {
    // rebind placeholder for date picker
    $('input[placeholder], textarea[placeholder]').placeholder();
}

// Adapt the handler's save function
totaraDialog_extension_handler.prototype._save = function() {

    var success = false;

    var extensiontime = $('.extensiontime', this._container).val();
    var extensionreason = $('.extensionreason', this._container).val();

    var dateformat = new RegExp("<?php echo get_string('datepickerregexjs'); ?>");

    if (dateformat.test(extensiontime) == false) {
        alert("<?php echo get_string('pleaseentervaliddate', 'local_program', get_string('datepickerplaceholder')); ?>");
    } else if (extensionreason=='') {
        alert("<?php echo get_string('pleaseentervalidreason', 'local_program'); ?>");
    } else {
        success = true;
    }

    if (success) {
        var data = {
            id: <?php echo $id ?>,
            userid: <?php echo $userid ?>,
            extrequest: "1",
            extdate: extensiontime,
            extreason: extensionreason
        };

        $.ajax({
            type: 'POST',
            url: '<?php echo "{$CFG->wwwroot}/local/program/extension.php"; ?>',
            data: data,
            success: totara_program_extension_update,
            error: totara_program_extension_error
        });
        this._dialog.hide();
    }
}

/*
 * Update extension text and notify user of
 * success
 */
var totara_program_extension_update = function(response) {
    // Get existing text
    var extensiontext = $('p.timeallowed');

    if (response) {
        var new_text = response;

        if (extensiontext.size()) {
            //If text found replace
            extensiontext.replaceWith(new_text);
        }

        var notify_html = '<?php echo trim(notify(get_string("extensionrequestsent", "local_program"), "notifysuccess", "center", true)); ?>';

        $('div#totara-header-notifications').html(notify_html);
    } else {
        var notify_html_fail = '<?php echo trim(notify(get_string("extensionrequestnotsent", "local_program"), null, "center", true)); ?>';

        $('div#totara-header-notifications').html(notify_html_fail);
    }
}

/**
 * If validation error has occured then an error is returned
 * print a notification with the error message
 */
var totara_program_extension_error = function(response) {
    if (response) {
        var notify_text = response.responseText;

        var notify_html = '<div class="notifyproblem" style="text-align:center">' + notify_text + '</div>';

        $('div#totara-header-notifications').html(notify_html);
    }
}
