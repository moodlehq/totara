<?php

    require_once('../../config.php');
?>

$(function() {
    if ($('.notifysuccess, .notifyproblem').length) {

	// Get the html
	var html = '';


	$('.notifysuccess, .notifyproblem').each(function() {
	    var state = 'problem';
	    if ($(this).hasClass('notifysuccess'))
		state = 'success';

	    html += '<div class="dialog_notification_'+state+'">';
	    html += '<span class="dialog_notification_icon">';
	    html += $(this).text();
	    html += '</span>';
	    html += '</div>';

	    if (state == 'success')
		html += '<div class="dialog_notification_information"><?php echo get_string('changessaved','dialog'); ?></div>';
	    else
		html += '<div class="dialog_notification_information"><?php echo get_string('changesnotsaved','dialog'); ?></div>';

	}).remove();


	// Create a basic handler
	var handler = new totaraDialog_handler();
	handler._continue = function() {
	    this._dialog.hide();
	}

	// Create the dialog..
	var dialog = new totaraDialog(
	    'assigncourses',
	    'unused',
	    {
		buttons: {
		    'Continue': function() {
			handler._continue()
		    }
		},
		title: '<?php echo get_string('actionnotification','dialog'); ?>',
		width:500,
		height:200
	    },
	    'none',
	    handler
	    );
	dialog.load = function() {
	    html = '<div id="totara-header-notifications">' + html + '</div>';
	    dialog.dialog.html(html);
	}

	// ..And show it immedatly!
	dialog.open();
    }
});