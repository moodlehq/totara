<?php

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once($CFG->dirroot.'/local/js/lib/setup.php');
require_once($CFG->dirroot.'/local/program/lib.php');
require_login();

$id = required_param('id', PARAM_INT);

?>


/***
 *** Define and create the object which acts as the main program assignment
 ***/
program_assignment = new function() {
    this.categories = new Array();
    this.num_deleted_items = 0;
    this.num_added_items = 0;
    this.total_count = 0;
    this.is_setup = false;
    this.is_modified = false;

    this.add_category = function(category) {
        category.main = this;
    this.categories.push(category);
        category.setup();
    }

    this.all_items_have_completion_times = function() {
        var result = true;
        $.each(this.categories, function(index, category) {
            $.each(category.items, function(index, item) {
                if (item.completiontime.val() == '') {
                    result = false;
                }
            });
        });
        return result;
    }

    this.update_total_user_count = function() {
        var count = 0;
        $.each(this.categories, function(index, category) {
            count += category.user_count;
        });
        this.total_count = count;

        if (this.is_setup) {
            $('.overall_total span.total').html(this.total_count);
        }
    }

    this.setup = function() {
        this.is_setup = true;
        this.update_total_user_count();
    }
}

/***
 *** Define the category object for re-use, but don't actually instantiate any!
 ***/
function category(id, name, find_url, title) {
    this.id = id;
    this.name = name;
    this.items = new Array();
    this.url = '<?php echo $CFG->wwwroot; ?>/local/program/assignment/';
    this.title = title;

    this.ajax_url = this.url + 'get_item.php?cat=' + this.name;

    // Jquery objects for the element and the table inside
    this.element = $('#category-' + this.id);
    this.table = $('table', this.element);

    // Instaniate the dialog used to add new items
    this.dialog_additem = new totaraDialog_program_cat(this, id, name, find_url, title);

    this.num_initial_users = 0;
    this.num_added_users = 0;
    this.num_removed_users = 0;

    // Add a span for printing the total number
    this.user_count = 0
    this.user_count_label = $('.user_count',this.element);

    /**
     ** Adds an item
     **/
    this.add_item = function(element,isexistingitem) {
    var newitem = new item(this, element, isexistingitem);

    this.items.push(newitem);

        if (!isexistingitem) {
            this.main.num_added_items++;
            this.num_added_users += newitem.users;
        }
        else {
            this.initial_user_count += newitem.users;
        }

        this.check_table_hidden_status();
    }

    /**
     ** Creates an element and then adds it
     **/
    this.create_item = function(html) {
    var element = $(html);

    // Add the item element to the table
    this.table.append(element);

    this.add_item(element,false);
    }

    this.remove_item = function(item) {
    // Remove the element from the table
    item.element.remove();

    // Remove the item from the array of items
    this.items = $.grep(this.items, function (element, x) {
        if (element == item) {
        return false;
        }
        return true
    });

        if (item.isexistingitem) {
            this.main.num_deleted_items++;
            this.num_removed_users += item.users;
        }
        else {
            this.main.num_added_items--;
            this.num_added_users -= item.users;
        }

        this.check_table_hidden_status();
    }

    /**
     ** Checks if the item id exists in this category
     **/
    this.item_exists = function(itemid) {
    for (x in this.items) {
        if (this.items[x].itemid == itemid) {
        return true;
        }
    }
    return false;
    }

    /**
     ** Gets a list of item ids in this category
     **/
    this.get_itemids = function() {
    var itemids = new Array();
    for (x in this.items) {
        itemids.push(this.items[x].itemid);
    }
    return itemids;
    }

    this.check_table_hidden_status = function() {
        if (this.items.length == 0) {
            $('th',this.table).hide();
        }
        else {
            $('th',this.table).show();
        }


        this.update_user_count();
    }

    this.update_user_count = function() {
        this.user_count = 0;
        for (x in this.items) {
            this.user_count += this.items[x].users;

        }
        $(this.user_count_label).text(this.user_count);

        this.main.update_total_user_count();
    }

    var self = this;

    /**
     ** Saves the users selected, called when the user tries to save and exit from the add dialog
     **/
    this.save = function() {
    var elements = $('.selected > div > span', this._container);
    var newids = new Array();

    // Loop through the selected elements
    elements.each(function() {

        // Get id
        var itemid = $(this).attr('id').split('_');
        itemid = itemid[itemid.length-1];  // The last item is the actual id
        itemid = parseInt(itemid);

        if (!self.item_exists(itemid)) {
        newids.push(itemid);
        }
    });

    if (newids.length > 0) {
        this.dialog_additem.showLoading();

        $.getJSON(this.ajax_url + '&itemid=' + newids.join(','), function(data) {

                $.each(data['rows'], function(index, html) {
                        self.create_item(html);
                });

        self.dialog_additem.hide();
        })
    }
    else {
        this.dialog_additem.hide();
    }
    }


    this.setup = function() {
        // Go through existing rows and add them
        var c = 0;
        $('tr',this.element).each(function() {
            if (c > 0) {
                self.add_item($(this), true);
            }
            c++;
        });

        // Check if we should hide the table header
        this.check_table_hidden_status();
    }
}

/***
 *** Defines an item in a category
 ***/
function item(category, element, isexistingitem) {
    var self = this;

    // Create jQuery element
    this.element = element;
    this.category = category;

    this.isexistingitem = isexistingitem;

    // Retreive and store item id
    this.itemid = this.element.find('input[name^="item"]').attr('name');
    this.itemid = this.itemid.replace('item['+ this.category.id +'][','');
    this.itemid = parseInt(this.itemid.replace(']',''));

    if (this.category.name == "individuals") {
        // Hard code individuals to have 1 user
        this.users = 1;
    }
    else {
        // Retreive and store the number of affected users
        this.usersElement = this.element.find('td:last');
        this.users = parseInt(this.usersElement.html());
    }
    this.initial_users = this.users;

    this.removeurl = this.category.url + 'remove_item.php?cat=' + this.category.name + '&itemid=' + this.itemid;

    // Hidden values
    this.completiontime = this.element.find('input[name^="completiontime"]');
    this.completionevent = this.element.find('input[name^="completionevent"]');
    this.completioninstance = this.element.find('input[name^="completioninstance"]');
    this.includechildren = this.element.find('[name^="includechildren"]');

    // Label
    this.completionlink = this.element.find('.completionlink');

    this.update_completiontime = function(completiontime, completionevent, completioninstance) {
    // Update the hidden inputs

        var url = this.category.url + 'completion/get_completion_string.php' +
                  '?completiontime=' + completiontime +
                  '&completionevent=' + completionevent +
                  '&completioninstance=' + completioninstance;

        var original = this.completionlink.html();
        this.completionlink.html('Loading..');

        $.get(url, function(data) {
            if (data == 'error') {
                // Put back to the original
                self.completionlink.html(original);
            }
            else {
                self.completionlink.html(data);
                self.completiontime.val(completiontime);
                self.completionevent.val(completionevent);
                self.completioninstance.val(completioninstance);

                // set a flag to indicate that the program assignments has been modified but not saved
                self.category.main.is_modified = true;
            }
        });
    }

    this.get_completion_time = function() { return this.completiontime.val(); }
    this.get_completion_event = function() { return this.completionevent.val(); }
    this.get_completion_instance = function() { return this.completioninstance.val(); }
    this.get_completion_link = function() { return this.completionlink.html(); }

    // Update the user count, and notifies the parent category
    this.update_user_count = function(count) {

        // Determine if we were at base number
        if (this.users == this.initial_users) {
            if (count > this.users) { // See if we have increased our user count
                // If so, increase the parent count
                this.category.num_added_users += (count - this.users);
            }
            else if (count < this.users) { // See if we have decreased our user count
                this.category.num_removed_users += (this.users - count);
            }
        } else {
            // We are not at our initial count, so its likely we need to decrease the added/removed count
            if (count > this.users) { // See if we have increased our user count
                // If so, increase the parent count
                this.category.num_removed_users -= (count - this.users);
            }
            else if (count < this.users) { // See if we have decreased our user count
                this.category.num_added_users -= (this.users - count);
            }
        }

        this.users = count;
        this.usersElement.html(this.users);
        this.category.update_user_count();

    }

    // Do an ajax request to get an updated count
    // includechildren is true or false
    this.get_user_count = function(includechildren) {

        var url = this.category.url + 'get_item_count.php?cat=' + this.category.name + '&itemid=' + this.itemid + '&include=' + includechildren;

        this.set_loading();

        $.getJSON(url, function(data) {
            var count = parseInt(data['count']);
            self.update_user_count(count);
        });
    }

    this.set_loading = function() {
        var loadingImg = '<img src="<?php echo $CFG->wwwroot; ?>/theme/totara/loading_small.gif"/>';
        this.usersElement.html(loadingImg);
    }

    // Add handler to remove this element
    $('.deletelink', this.element).click(function(event) {
    event.preventDefault();
        self.category.remove_item(self);
    });

    // Add handler to select completion dates etc
    $('.completionlink', this.element).click(function(event) {
    event.preventDefault();

    totaraDialogs['completion'].item = self;
    totaraDialogs['completion'].default_url = self.category.url + 'set_completion.php';
    totaraDialogs['completion'].open();

    });

    // Add handler for the include children being toggled
    $(this.includechildren).change(function(event) {
        if (this.tagName.toLowerCase() == 'input') {
            var value = $(this).attr('checked') ? 1 : 0;
            self.get_user_count(value);
        }
        else if (this.tagName.toLowerCase() == 'select') {
            self.get_user_count($(this).val());
        }
    });

}

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
    $('form[name="form_prog_assignments"]').submit(function(){
        window.onbeforeunload = null;
    });

    // Remove the 'unsaved changes' confirmation when clicking the 'Cancel program management' link
    $('#cancelprogramedits').click(function(){
        window.onbeforeunload = null;
        return true;
    });

    $('#category_select button').click(function() {
    var url = '<?php echo "$CFG->wwwroot/local/program/assignment/get_items.php?progid=$id"; ?>';

    var select = $("#category_select select");
    var option = $("option:selected", select);

    // Ajax call to get the html for the new category box
    $.getJSON(url + '&catid=' + option.val(), function(data) {

        // Need to check that it doesn't already exist before we add it
        if ($("#category-" + option.val()).length > 0) {
        return;
        }

        // Add the category to the bottom of the list of categories
        $("#assignment_categories").append(data['html']);

        // Remove the option from the drop down
        option.remove();

        // Remove the dropdown box if no options are left
        if ($("option",select).length == 0) {
        // Remove the category select if there's no options left
        $('#category_select').remove();
        }
    });

        return false;
    });

    // Add a function to launch the save changes dialog
    $('input[name="savechanges"]').click(function(event) {
    return handleSaveChanges(event);
    });

    totaraDialogs['completion'] = new totaraDialog_completion();
    totaraDialogs['savechanges'] = new totaraDialog_savechanges();
    totaraDialogs['completionevent'] = new totaraDialog_completion_event();

    program_assignment.setup();

    storeInitialFormValues();

});

function handleSaveChanges(event) {

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

    if ( ! program_assignment.all_items_have_completion_times()) {
        alert("<?php echo htmlspecialchars(get_string('pleasesetcompletiontimes','local_program')); ?>");
        return false;
    }

    // Load a html template in, and switch
    var templateJSON = <?php echo prog_assignments::get_confirmation_template(); ?>;

    var template = $(templateJSON['html']);

    var totalAdded = 0;
    var totalRemoved = 0;
    if (program_assignment.categories.length > 0) {
        for (x in program_assignment.categories) {
            var category = program_assignment.categories[x];

            totalAdded += category.num_added_users;
            totalRemoved += category.num_removed_users;

            $('.added_' + category.id, template).html(category.num_added_users);
            $('.removed_' + category.id, template).html(category.num_removed_users);
        }
    }

    $('.total_added', template).html(totalAdded);
    $('.total_removed', template).html(totalRemoved);

    var html = template.html();

    totaraDialogs['savechanges'].open(html);
    totaraDialogs['savechanges'].save = function() {
        totaraDialogs['savechanges'].savechanges = true;
        this.hide();
        $('input[name="savechanges"]').trigger('click');
    }
    event.preventDefault();
}

totaraDialog_program_cat = function(category, catid, name, find_url, title) {

    // Store some bits
    this.category = category;
    this.catid = catid;
    this.name = name;
    this.url = '<?php echo $CFG->wwwroot; ?>/local/program/assignment/';
    this.ajax_url = this.url + 'get_item.php?cat=' + this.name;

    // Setup the handler
    var handler = new totaraDialog_handler_treeview_multiselect();

    var default_url = this.url + find_url;

    var self = this;

    // Call the parent dialog object and link us
    totaraDialog.call(
    this,
    'add-asignment-dialog-' + catid,
    'add-assignment-' + catid,
    {
        buttons: {
        '<?php print_string('cancel','local_program') ?>': function() { self.hide(); },
        '<?php print_string('ok','local_program') ?>': function() { self.category.save(); }
        },
        title: '<h2>' + title +'</h2>'
    },
    default_url,
    handler);

    // Modify the open function to dynamically get values from the category
    this.old_open = this.open;
    this.open = function() {
    var selected = this.category.get_itemids();
    selected = selected.join(",");
    this.default_url += '&selected=' + selected;
    this.old_open();
    }

    var self = this;

    // Add a handler for any click events for the complete column

}

// The completion dialog
totaraDialog_completion = function() {

    //this.item = item;
    //this.url = url + 'choose_completion.php';

    // Setup the handler
    var handler = new totaraDialog_completion_handler();

    // Store reference to this
    var self = this;


    // Call the parent dialog object and link us
    totaraDialog.call(
    this,
    'completion-dialog',
    'unused', // buttonid unused
    {
        buttons: {
        '<?php print_string('cancel','local_program') ?>': function() { handler._cancel() }
        },
        title: '<h2><?php echo get_string('completioncriteria', 'local_program'); ?></h2>'
    },
    this.url,
    handler
    );

    this.old_open = this.open;
    this.open = function() {
    this.old_open();
    this.dialog.height(150);
    }

    $('.fixeddate', this.handler._container).live('click', function() {
        var completiontime = $('.completiontime', self.handler._container).val();
        var completionevent = <?php echo COMPLETION_EVENT_NONE; ?>;
        var completioninstance = 0;

        //var dateformat = /^\d{1,2}(\-|\/|\.)\d{1,2}\1\d{4}$/

        var dateformat = new RegExp("[0-3][0-9]/(0|1)[0-9]/(19|20)[0-9]{2}");

        if (dateformat.test(completiontime) == false) {
            alert("<?php echo get_string('pleaseentervaliddate', 'local_program'); ?>");
        }
        else {
            self.item.update_completiontime(completiontime, completionevent, completioninstance);
            self.hide();
        }
    });

    $('.relativeeventtime').live('click', function() {

        var timeunit = $('#timeamount', self.handler._container).val();
        var timeperiod = $('#timeperiod option:selected', self.handler._container).val();
        var completiontime = timeunit + " " + timeperiod;

        var completionevent = $('#eventtype option:selected', self.handler._container).val();
        var completioninstance = $('#instance', self.handler._container).val();

        var unitformat = /^\d{1,3}$/
        if (unitformat.test(timeunit) == false) {
            alert("<?php echo get_string('pleaseentervalidunit', 'local_program'); ?>");
        }
        else if (completioninstance == 0 && completionevent != <?php echo COMPLETION_EVENT_FIRST_LOGIN; ?>) {
            alert("<?php echo get_string('pleasepickaninstance', 'local_program'); ?>");
        }
        else {
            self.item.update_completiontime(completiontime, completionevent, completioninstance);
            self.hide();
        }
    });
}

totaraDialog_completion_handler = function() {};

totaraDialog_completion_handler.prototype = new totaraDialog_handler();

totaraDialog_completion_handler.prototype.first_load = function() {
    var handler = this;

    $('.completiontime', this._container).datepicker({
    dateFormat: 'dd/mm/yy',
    showOn: 'both',
    buttonImage: '<?php echo $CFG->wwwroot; ?>/local/js/images/calendar.gif',
    buttonImageOnly: true,
    beforeShow: function() { $('#ui-datepicker-div').css('z-index',1600); },
    constrainInput: true
    });
}

totaraDialog_completion_handler.prototype.every_load = function() {
    var completiontime = this._dialog.item.get_completion_time();
    var completionevent = this._dialog.item.get_completion_event();
    var completioninstance = this._dialog.item.get_completion_instance();

    if (completionevent == <?php echo COMPLETION_EVENT_NONE; ?>) {
        $('.completiontime', this._container).val(completiontime);
    }
    else {
        var parts = completiontime.split(" ");
        $('#timeamount', this._container).val(parts[0]);
        $('#timeperiod', this._container).val(parts[1]);
        $('#eventtype', this._container).val(completionevent);
    }
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
        '<?php print_string('editassignments','local_program') ?>': function() { handler._cancel() },
        '<?php print_string('saveallchanges','local_program') ?>': function() { self.save() }
        },
        title: '<h2>Confirm assignment changes</h2>'
    },
    'unused', // default_url unused
    handler
    );

    this.old_open = this.open;
    this.open = function(html, table, rows) {
    // Do the default open first to get everything ready
    this.old_open();

    this.dialog.height(270);

    // Now load the custom html content
    this.dialog.html(html);

    this.table = table;
    this.rows = rows;
    }

    // Don't load anything
    this.load = function(url, method) {
    }

}


// The completion event dialog
totaraDialog_completion_event = function() {

    // Setup the handler
    var handler = new totaraDialog_handler_treeview_singleselect('instance', 'instancetitle');

    // Store reference to this
    var self = this;

    // Call the parent dialog object and link us
    totaraDialog.call(
    this,
    'completion-event-dialog',
    'unused2', // buttonid unused
    {
        buttons: {
        '<?php print_string('cancel','local_program') ?>': function() { handler._cancel() },
        '<?php print_string('ok','local_program') ?>': function() { self.save() }
        },
        title: '<h2><?php
                echo get_string('chooseitem', 'local_program');
                echo dialog_display_currently_selected(get_string('selected', 'hierarchy'), 'completion-event-dialog');
            ?></h2>'
    },
    'unused2', // default_url unused
    handler
    );

    this.save = function() {
        var selected_val = $('#treeview_selected_val_'+this.handler._title).val();
        var selected_text = $('#treeview_selected_text_'+this.handler._title).text();

        $('#instance').val(selected_val);
        $('#instancetitle').text(selected_text);

        this.hide();
    }

    this.clear = function() {
        $('#instance').val(0);
        $('#instancetitle').text('');
    }

    this.set_to_none = function() {
        $('#instance').val(0);
        $('#instancetitle').text('<?php echo get_string('none'); ?>');
    }

}

// Stores the initial values of the form when the page is loaded
function storeInitialFormValues() {
    var form = $('form[name="form_prog_assignments"]');

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
    var form = $('form[name="form_prog_assignments"]');
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

    // Check if assignments have been added or removed
    if (program_assignment.num_added_items > 0 || program_assignment.num_deleted_items > 0) {
        isModified = true;
    }

    // Check if assignments have been added or removed
    if (program_assignment.is_modified == true) {
        isModified = true;
    }

    return isModified;
}
