<?php require_once('../../config.php') ?>
// Bind functionality to page on load
YAHOO.util.Event.onDOMReady(function () {

    var rplvisible = new Array();

    // Get RPL type of element
    var fnc_rpltype = function(el) {
        var classes = el.attr('class').split(' ');
        var type = '';

        for (var id in classes) {
            if (classes[id].substr(0, 4) == 'rpl-') {
                type = classes[id];
                break;
            }
        }

        return type;
    }

    // Display RPL expand if RPLs present
    var fnc_toggleexpand = function() {

        // Loop through expanders
        var expanders = $('a.rplexpand');

        expanders.each(function() {

            // Get rpl type
            var type = fnc_rpltype($(this));

            // Check for any RPLs
            var rpls = $('td.'+type+' a.rplshow');

            // If RPLs, show expander
            if (rpls.length) {
                $(this).show();
            } else {
                $(this).hide();
            }

            // Hide values, show expanders
            if (rpls.length) {
                $('td.'+type+' span.rplvalue').hide();
                $('td.'+type+' a.rplshow').show();
            }
        });
    }
    fnc_toggleexpand();


    // RPL expand functionality
    var fnc_expand = function(event) {

        event.preventDefault();

        // Trigger the save/hide for any other open input groups
        fnc_savehide();

        // Get rpl type
        var type = fnc_rpltype($(this).parent('a'));

        // Toggle visibility
        rplvisible[type] = rplvisible[type] ? false : true;

        if (rplvisible[type]) {
            $('td.'+type+' a.rplshow').hide();
            $('td.'+type+' span.rplvalue').show();
        } else {
            $('td.'+type+' a.rplshow').show();
            $('td.'+type+' span.rplvalue').hide();
        }
    }
    $('a.rplexpand img').click(fnc_expand);


    // RPL edit textfield functionality
    var fnc_edit = function(event) {

        event.preventDefault();

        // Get table cell
        var cell = $(this).parent('td');

        // Get elements
        var value = $('span.rplvalue', cell);
        var inputgroup = $('span.rplinputgroup', cell);
        var input = $('input.rplinput', inputgroup);
        var dots = $('a.rplshow', cell);

        // Toggle text field
        if (inputgroup.length)
        {
            // If text field exists

            // Old value
            var oldvalue = value.text();

            // If a RPL was entered
            var inputvalue = input.val();
            if (inputvalue) {
                // Change icon
                $('a.rpledit img', cell).attr('src', '<?php echo $CFG->wwwroot ?>/theme/totara/pix/i/completion-rpl-y.gif');

                // Save value
                value.text(inputvalue);

                // Show value
                if (rplvisible) {
                    value.show();
                }

                // Add dots if they don't exist
                if (!dots.length) {
                    var dots = $('<a href="#" class="rplshow" title="Show RPL">...</a>');
                    dots.click(fnc_expand);

                    cell.append(dots);
                }

                if (rplvisible) {
                    dots.hide();
                } else {
                    dots.show();
                }

            // If no RPL was entered
            } else {
                // Reset value and hide
                value.text('').hide();

                // Remove dots
                dots.remove();

                // Change icon
                $('a.rpledit img', cell).attr('src', '<?php echo $CFG->wwwroot ?>/theme/totara/pix/i/completion-rpl-n.gif');
            }

            // Toggle expander
            fnc_toggleexpand();

            // Remove inputgroup
            inputgroup.remove();

            // If value has changed, save
            if (oldvalue != inputvalue) {
                var user = cell.parent('tr').attr('id').substr(5);
                fnc_saverpl(cell, user, inputvalue);
            }

        } else {
            // If no text field

            // Trigger the save/hide for any other open input groups
            fnc_savehide();

            // Create group
            var inputgroup = $('<span class="rplinputgroup"></span>');

            // Create input
            var input = $('<input class="rplinput" type="text" maxlength="255"/>');
            input.val(value.text());

            // Bind enter event to input
            input.keypress(function(event) {
                if (event.which != 13) {
                    return;
                }

                // If enter key pressed, save
                $('a.rpledit', cell).trigger('click');
            });

            // Create delete button
            var cancel = $('<a href="#" class="icon rpldelete" title="Delete this RPL"><img src="<?php echo $CFG->wwwroot ?>/theme/totara/pix/i/cross_red_big.gif" alt="Delete" /></a>');
            cancel.click(function(event) {

                event.preventDefault();

                // Remove RPL
                input.val('');

                // Trigger edit event
                $('a.rpledit', cell).trigger('click');
            });

            // Add stuff to group
            inputgroup.append(input);
            inputgroup.append(cancel);

            // Hide value or dots if shown
            value.hide();
            dots.hide();

            // Insert into cell
            $('a.rpledit', cell).after(inputgroup);

            // Focus input
            input.focus();
        }

    }
    $('a.rpledit, a.rplshow').click(fnc_edit);


    // Trigger the save/hide for any other open input groups
    var fnc_savehide = function() {
        $('span.rplinputgroup').each(function() {

            // Trigger edit event
            $('a.rpledit', $(this).parent('td')).trigger('click');
        });
    }


    // Save RPL data
    var fnc_saverpl = function(cell, user, rpl) {

        // Get rpl type
        var type = fnc_rpltype(cell).substr(4);

        // Show loading icon
        cell.append($('<img class="rplloading" src="<?php echo $CFG->wwwroot ?>/theme/totara/pix/i/loading_small.gif" />'));

        // Save callback
        var fnc_savecallback = function(response) {

            var user = response.argument;

            // Hide save icon
            $('#user-'+user+' .rplloading').remove();
        }

        // Load courses
        YAHOO.util.Connect.asyncRequest(
            'GET',
            'save_rpl.php?type='+type+'&course='+course+'&user='+user+'&rpl='+rpl,
            {
                success:    fnc_savecallback,
                failure:    function(o) {},
                argument:   user
            }
        );
    }
});
