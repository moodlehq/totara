<?php

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once($CFG->dirroot.'/local/program/lib.php');
require_once $CFG->dirroot.'/local/js/lib/setup.php';

require_login();

$id = required_param('id', PARAM_INT);

?>

// Bind functionality to page on load
$(function() {

    // attach a function to the page to prevent unsaved changes from being lost
    // when navigating away
    window.onbeforeunload = function(e) {

        var modified = isFormModified();

        if(modified==true) {

            // For IE and Firefox
            if (e) {
                e.returnValue = "<?php echo get_string('youhaveunsavedchanges','local_program'); ?>";
            }

            // For Safari
            return "<?php echo get_string('youhaveunsavedchanges','local_program'); ?>";

        }
    };

    // remove the 'unsaved changes' confirmation when submitting the form
    $('form[name="form_prog_messages"]').submit(function(){
        window.onbeforeunload = null;
    });

    // Remove the 'unsaved changes' confirmation when clicking th 'Cancel program management' link
    $('#cancelprogramedits').click(function(){
        window.onbeforeunload = null;
        return true;
    });

    // Add a function to launch the save changes dialog
    $('input[name="savechanges"]').click(function() {
    return handleSaveChanges();
    });

    totaraDialogs['savechanges'] = new totaraDialog_savechanges();

    initDisplay();

    storeInitialFormValues();

});

// Set up the display of messages
function initDisplay() {
    $('input[name=cancel]').css('display', 'none');
    $('input[name=update]').css('display', 'none');
}

function handleSaveChanges() {

    // no need to display the confirmation dialog if there are no changes to save
    if ( ! isFormModified()) {
        window.onbeforeunload = null;
        return true;
    }

    var dialog = totaraDialogs['savechanges'];

    if (dialog.savechanges == true) {
    window.onbeforeunload = null;
        return true;
    }

    dialog.open('<?php echo addslashes(get_string('tosavemessages','local_program')); ?>');
    dialog.save = function() {
    dialog.savechanges = true;
    this.hide();
    $('input[name="savechanges"]').trigger('click');
    }

    return false;
}

// The save changes confirmation dialog
totaraDialog_savechanges = function() {

    // Setup the handler
    var handler = new totaraDialog_handler();

    // Store reference to this
    var self = this;

    // Call the parent dialog object and link us
    totaraDialog.call(
    this,
    'savechanges-dialog',
    'unused', // buttonid unused
    {
        buttons: {
        '<?php echo get_string('editmessages','local_program'); ?>': function() { handler._cancel() },
        '<?php echo get_string('saveallchanges','local_program'); ?>': function() { self.save() }
        },
        title: '<h2><?php echo get_string('confirmmessagechanges','local_program'); ?></h2>'
    },
    'unused', // default_url unused
    handler
    );

    this.old_open = this.open;
    this.open = function(html, table, rows) {
    // Do the default open first to get everything ready
    this.old_open();

    this.dialog.height(150);

    // Now load the custom html content
    this.dialog.html(html);

    this.table = table;
    this.rows = rows;
    }

    // Don't load anything
    this.load = function(url, method) {
    }
}

// Stores the initial values of the form when the page is loaded
function storeInitialFormValues() {
    var form = $('form[name="form_prog_messages"]');

    $('input[type="text"], textarea, select', form).each(function() {
        $(this).attr('initialValue', $(this).val());
    });

    $('input[type="checkbox"]', form).each(function() {
        var checked = $(this).attr('checked') ? 1 : 0;
        $(this).attr('initialValue', checked);
    });
}

// Checks if the form is modified by comparing the initial and current values
function isFormModified() {
    var form = $('form[name="form_prog_messages"]');
    var isModified = false;

    // Check if text inputs or selects have been changed
    $('input[type="text"], select', form).each(function() {
        if ($(this).attr('initialValue') != $(this).val()) {
            isModified = true;
        }
    });

    // Check if check boxes have changed
    $('input[type="checkbox"]', form).each(function() {
        var checked = $(this).attr('checked') ? 1 : 0;
        if ($(this).attr('initialValue') != checked) {
            isModified = true;
        }
    });

    // Check if textareas have been changed
    $('textarea', form).each(function() {
        // See if there's a tiny MCE instance for this text area
        var instance = tinyMCE.getInstanceById($(this).attr('id'));
        if (instance != undefined) {
            if (instance.isDirty()) {
                isModified = true;
            }
        } else {
            // normal textarea (not tinyMCE)
            if ($(this).attr('initialValue') != $(this).val()) {
                isModified = true;
            }
        }
    });

    // Check if messages ahve been changed as a result of the form being submitted
    var messageschanged = $('input[name="messageschanged"]').val();
    if (messageschanged == 1) {
        isModified = true;
    }

    return isModified;
}
