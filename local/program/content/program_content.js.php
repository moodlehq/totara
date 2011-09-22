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
 * @author Ben Lobo <ben.lobo@kineo.com>
 * @package totara
 * @subpackage program
 */

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once($CFG->dirroot.'/local/program/lib.php');
require_once $CFG->dirroot.'/local/js/lib/setup.php';

require_login();

$id = required_param('id', PARAM_INT);

?>


// Bind functionality to page on load
$(function() {

    // Attach a function to the page to prevent unsaved changes from being lost
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

    // Remove the 'unsaved changes' confirmation when submitting the form
    $('form[name="form_prog_content"]').submit(function(){
        window.onbeforeunload = null;
    });

    // Remove the 'unsaved changes' confirmation when clicking the 'Cancel program management' link
    $('#cancelprogramedits').click(function(){
        window.onbeforeunload = null;
        return true;
    });

    // Add a function to launch the approriate add content dialog
    $('#addcontent').click(function() {
        return addContent();
    });

    // Add a function to launch the save changes dialog
    $('input[name="savechanges"]').click(function() {
    return handleSaveChanges();
    });

    initCoursesets();

    // create instances of each dialog for the page
    totaraDialogs['addmulticourse'] = new totaraDialog_addmulticourse();
    totaraDialogs['addcompetency'] = new totaraDialog_addcompetency();
    totaraDialogs['addrecurringcourse'] = new totaraDialog_addrecurringcourse();
    totaraDialogs['amendcourses'] = new totaraDialog_amendmulticourse();
    totaraDialogs['savechanges'] = new totaraDialog_savechanges();

    storeInitialFormValues();

});

// Hide any elements of all course sets that should not be displayed
// and generally set up the display of course sets
function initCoursesets() {

    $('input[name=cancel]').css('display', 'none');
    $('input[name=update]').css('display', 'none');
    $('input.deletebutton').css('display', 'none');
    $('div.courseadder select').css('display', 'none');
    $('div.courseadder input:submit').val('<?php echo get_string('addcourses', 'local_program'); ?>');
    $('div.setbuttons .updatebutton').css('display', 'none');

}

// Function called when a completion type drop down in a course set is changed to
// determine whether all courses or only one course in the set has to be completed.
// This function changes the completion type string next to the course ('and' or 'or')
// to match the selection
function changeCompletionTypeString(el, prefix) {

    if (el.value == <?php echo COMPLETIONTYPE_ANY; ?>) {
        var completiontypestr = '<?php echo get_string('or', 'local_program'); ?>';
    } else {
        var completiontypestr = '<?php echo get_string('and', 'local_program'); ?>';
    }

    $('.operator'+prefix).html(completiontypestr);

    return true;
}

// open the appropriate dialog to add a content type
function addContent() {

    // get the type of content to be added
    var contenttype = $('#contenttype').val();

    if(contenttype == <?php echo CONTENTTYPE_MULTICOURSE ?>) {
        totaraDialogs['addmulticourse'].open();
    } else if(contenttype == <?php echo CONTENTTYPE_COMPETENCY ?>) {
        totaraDialogs['addcompetency'].open();
    } else if(contenttype == <?php echo CONTENTTYPE_RECURRING ?>) {
        totaraDialogs['addrecurringcourse'].open();
    }

    return false;

}

// Function attached to each 'Amend courses' button.
// This retrieves all the currently selected courses in a course set
// and passes the course ids to the dialog
function amendCourses(coursesetprefix) {

    var selectedcourses = $('input:hidden[name='+coursesetprefix+'courses]').val();
    var coursesetid = $('input:hidden[name='+coursesetprefix+'id]').val();
    var sortorder = $('input:hidden[name='+coursesetprefix+'sortorder]').val();
    var completiontype = $('select[name='+coursesetprefix+'completiontype]').val();

    var selectedcourses_encoded = encodeURI(selectedcourses);

    var dialog_url = '<?php echo $CFG->wwwroot; ?>/local/program/content/find_courses.php?id=<?php echo $id ?>&selectedcourseids=' + selectedcourses_encoded;

    var mydialog = totaraDialogs['amendcourses'];
    mydialog.default_url = dialog_url;
    mydialog.handler.coursesetprefix = coursesetprefix;
    mydialog.handler.coursesetid = coursesetid;
    mydialog.handler.sortorder = sortorder;
    mydialog.handler.completiontype = completiontype;
    mydialog.open();

    return false;
}

// Each course name in a multi-course set has a link with an onclick event
// which calls this function to display a confirmation dialog and then
// delete the course from the set (if confirmed)
function deleteCourse(coursesetid, coursesetprefix, coursetodelete_id) {

    var contenturl = '<?php echo $CFG->wwwroot; ?>/local/program/content/get_html.php?id=<?php echo $id ?>';

    var courseids_str = $('input[name='+coursesetprefix+'courses]').val();
    var sortorder = $('input[name='+coursesetprefix+'sortorder]').val();
    var completiontype = $('select[name='+coursesetprefix+'completiontype] option:selected').val();

    var courseids = courseids_str.split(',');
    var new_courseids = new Array();

    for (var i=0; i<courseids.length; i++) {
        if (courseids[i] != coursetodelete_id) {
            new_courseids.push(courseids[i]);
        }
    }

    var new_courseids_str = new_courseids.join(',');

    $.getJSON(contenturl +
            '&htmltype=amendcourses' +
            '&courseids=' + new_courseids_str +
            '&coursesetid=' + coursesetid +
            '&coursesetprefix=' + coursesetprefix +
            '&sortorder=' + sortorder +
            '&completiontype=' + completiontype, function(data) {

        $('#'+coursesetprefix+'courselist').html(data['courselisthtml']);
        $('#'+coursesetprefix+'deletedcourseslist').html(data['deletedcourseshtml']);
        $('input[name="contentchanged"]').val(1);
        initCoursesets();
        //$('form[name="form_prog_content"]').submit();

    });

    return false;
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

    var html = '';
    // Display the number of affected learners (this variable should have been
    // defined in the page (see display_current_status() method in program.class.php)
    if (window.currentassignmentcount !== undefined) {
        html = '<?php echo addslashes(get_string('affectedusercount','local_program')); ?>'+ window.currentassignmentcount;
    }
    html = html + '<'+'p><?php echo addslashes(get_string('tosavecontent','local_program')); ?><'+'/p>';
    dialog.open(html);
    dialog.save = function() {
        dialog.savechanges = true;
        this.hide();
        $('input[name="savechanges"]').trigger('click');
    }

    return false;
}

// Define the dialog and handler for adding a multi course set
totaraDialog_addmulticourse = function() {

    this.url = '<?php echo $CFG->wwwroot; ?>/local/program/content/';
    this.find_url = 'find_courses.php?id=<?php echo $id ?>';
    this.ajax_url = 'get_html.php?id=<?php echo $id ?>';

    // Setup the handler
    var handler = new totaraDialog_handler_addmulticourse(this.url + this.ajax_url);

    var default_url = this.url + this.find_url;

    // Call the parent dialog object and link us
    totaraDialog.call(
        this,
        'addmulticourse',
        'unused', // buttonid unused
        {
            buttons: {
                '<?php echo get_string('cancel','local_program'); ?>': function() { handler._cancel(); },
                '<?php echo get_string('ok','local_program'); ?>': function() { handler._save(); }
            },
            title: '<?php
                echo '<h2>';
                echo get_string('addcourses', 'local_program');
                echo '</h2>';
            ?>'
        },
        default_url,
        handler
    );

}

// Create handler for the dialog
totaraDialog_handler_addmulticourse = function(contenturl) {
    this.contenturl = contenturl;
}

// Set the dialog handler as a multi select
totaraDialog_handler_addmulticourse.prototype = new totaraDialog_handler_treeview_multiselect();

// Adapt the handler's save function
totaraDialog_handler_addmulticourse.prototype._save = function() {

    // Serialize data
    var elements = $('.selected > div > span', this._container);
    var courseids = this._get_ids(elements);
    var courseids_str = this._get_ids(elements).join(':');

    // retrieve the number of set prefixes so that we can determine the sort order for the new set
    var setprefixes = $('input:hidden[name=setprefixes]').val();
    if(setprefixes == '') {
        var sortorder = 1;
    } else {
        var setprefixesarray = setprefixes.split(',');
        var sortorder = setprefixesarray.length + 1;
    }

    $.getJSON(this.contenturl + '&htmltype=multicourseset' + '&courseids=' + courseids_str + '&sortorder=' + sortorder + '&setprefixes=' + setprefixes, function(data) {
        $('#course_sets').append(data['html']);
        $('input[name="setprefixes"]').val(data['setprefixes']);
        initCoursesets();
        $('form[name="form_prog_content"]').submit();
    })

    this._dialog.hide();

}

// Define the dialog and handler for adding a competency course set
totaraDialog_addcompetency = function() {

    this.url = '<?php echo $CFG->wwwroot; ?>/local/program/content/';
    this.find_url = 'find_competency.php?id=<?php echo $id ?>';
    this.ajax_url = 'get_html.php?id=<?php echo $id ?>';

    // Setup the handler
    var handler = new totaraDialog_handler_addcompetency(this.url + this.ajax_url);

    var default_url = this.url + this.find_url;

    // Call the parent dialog object and link us
    totaraDialog.call(
        this,
        'addcompetency',
        'unused', // buttonid unused
        {
            buttons: {
                '<?php echo get_string('cancel','local_program'); ?>': function() { handler._cancel(); },
                '<?php echo get_string('ok','local_program'); ?>': function() { handler._save(); }
            },
            title: '<?php
                echo '<h2>';
                echo get_string('addcompetency', 'local_program');
                echo dialog_display_currently_selected(get_string('selected', 'hierarchy'), 'addcompetency');
                echo '</h2>';
            ?>'
        },
        default_url,
        handler
    );

}

// Create handler for the dialog
totaraDialog_handler_addcompetency = function(contenturl) {
    this.contenturl = contenturl;
}

// Set the dialog handler as a single select
totaraDialog_handler_addcompetency.prototype = new totaraDialog_handler_treeview_singleselect();

// Adapt the handler's save function
totaraDialog_handler_addcompetency.prototype._save = function() {

    // retrieve the competency id and name
    var id = $('#treeview_selected_val_addcompetency').val();
    var competency = $('#treeview_selected_text_addcompetency').text();

    // retrieve the number of set prefixes so that we can determine the sort order for the new set
    var setprefixes = $('input:hidden[name=setprefixes]').val();
    if(setprefixes == '') {
        var sortorder = 1;
    } else {
        var setprefixesarray = setprefixes.split(',');
        var sortorder = setprefixesarray.length + 1;
    }

    // retrieve the html for the new set
    $.getJSON(this.contenturl + '&htmltype=competencyset' + '&competencyid=' + id + '&sortorder=' + sortorder + '&setprefixes=' + setprefixes, function(data) {
        $('#course_sets').append(data['html']);
        $('input[name="setprefixes"]').val(data['setprefixes']);
        initCoursesets();
        $('form[name="form_prog_content"]').submit();
    })

    this._dialog.hide();

}

// Define the dialog and handler for adding a recurring course set
totaraDialog_addrecurringcourse = function() {

    this.url = '<?php echo $CFG->wwwroot; ?>/local/program/content/';
    this.find_url = 'find_course.php?id=<?php echo $id ?>';
    this.ajax_url = 'get_html.php?id=<?php echo $id ?>';

    // Setup the handler
    var handler = new totaraDialog_handler_addrecurringcourse(this.url + this.ajax_url);

    var default_url = this.url + this.find_url;

    // Call the parent dialog object and link us
    totaraDialog.call(
        this,
        'addrecurringcourse',
        'unused', // buttonid unused
        {
            buttons: {
                '<?php echo get_string('cancel','local_program'); ?>': function() { handler._cancel(); },
                '<?php echo get_string('ok','local_program'); ?>': function() { handler._save(); }
            },
            title: '<?php
                echo '<h2>';
                echo get_string('addcourse', 'local_program');
                echo dialog_display_currently_selected(get_string('selected', 'hierarchy'), 'addrecurringcourse');
                echo '</h2>';
            ?>'
        },
        default_url,
        handler
    );

}

// Create handler for the dialog
totaraDialog_handler_addrecurringcourse = function(contenturl) {
    this.contenturl = contenturl;
}

// Set the dialog handler as a single select
totaraDialog_handler_addrecurringcourse.prototype = new totaraDialog_handler_treeview_singleselect();

// Adapt the handler's save function
totaraDialog_handler_addrecurringcourse.prototype._save = function() {

    // retrieve the course id and name
    var courseid = $('#treeview_selected_val_addrecurringcourse').val();
    var coursename = $('#treeview_selected_text_addrecurringcourse').text();

    // Recurring programs will only ever contain a single course set so we can set these default values
    var setprefixes = '';
    var sortorder = 1;

    // retrieve the html for the new set
    $.getJSON(this.contenturl + '&htmltype=recurringset' + '&courseid=' + courseid + '&sortorder=' + sortorder + '&setprefixes=' + setprefixes, function(data) {
        $('#course_sets').append(data['html']);
        $('input[name="setprefixes"]').val(data['setprefixes']);
        initCoursesets();
        $('form[name="form_prog_content"]').submit();
    })

    this._dialog.hide();

}

// Define the dialog and handler for adding/removing courses from a multi course set
totaraDialog_amendmulticourse = function() {

    var url = '<?php echo $CFG->wwwroot; ?>/local/program/content/';

    this.find_url = 'find_courses.php?id=<?php echo $id ?>';
    this.ajax_url = 'get_html.php?id=<?php echo $id ?>';
    this.default_url = url + this.find_url;

    // Setup the handler
    this.handler = new totaraDialog_handler_amendmulticourse(url + this.ajax_url);

    var self = this;

    // Call the parent dialog object and link us
    totaraDialog.call(
        this,
        'amendmulticourse',
        'unused', // buttonid unused
        {
            buttons: {
                '<?php echo get_string('cancel','local_program'); ?>': function() { self.handler._cancel(); },
                '<?php echo get_string('ok','local_program'); ?>': function() { self.handler._save(); }
            },
            title: '<?php
                echo '<h2>';
                echo get_string('addcourses', 'local_program');
                echo '</h2>';
            ?>'
        },
        this.default_url,
        this.handler
    );

}

// Create handler for the add/remove courses dialog
totaraDialog_handler_amendmulticourse = function(contenturl) {
    this.contenturl = contenturl;
    this.coursesetprefix = '';
    this.coursesetid = 0;
    this.sortorder = 0;
    this.completiontype = 0;
}

// Set the dialog handler as a multiselect
totaraDialog_handler_amendmulticourse.prototype = new totaraDialog_handler_treeview_multiselect();

// Adapt the handler's save function
totaraDialog_handler_amendmulticourse.prototype._save = function() {

    // Serialize data
    var elements = $('.selected > div > span', this._container);
    var courseids = this._get_ids(elements);
    var courseids_str = courseids.join(',');

    // retrieve the set prefix
    var setprefixes = $('input:hidden[name=setprefixes]').val();
    var setprefixesarray = setprefixes.split(',');
    var sortorder = setprefixesarray.length + 1;

    var self = this;

    $.getJSON(this.contenturl + 
            '&htmltype=amendcourses' +
            '&courseids=' + courseids_str +
            '&coursesetid=' + this.coursesetid +
            '&coursesetprefix=' + this.coursesetprefix +
            '&sortorder=' + this.sortorder +
            '&completiontype=' + this.completiontype, function(data) {

        $('#'+self.coursesetprefix+'courselist').html(data['courselisthtml']);
        $('#'+self.coursesetprefix+'deletedcourseslist').html(data['deletedcourseshtml']);
        $('input[name="contentchanged"]').val(1);
        initCoursesets();
        //$('form[name="form_prog_content"]').submit();

    });

    this._dialog.hide();

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
        '<?php echo get_string('editcontent','local_program'); ?>': function() { handler._cancel() },
        '<?php echo get_string('saveallchanges','local_program'); ?>': function() { self.save() }
        },
        title: '<h2><?php echo get_string('confirmcontentchanges','local_program'); ?></h2>'
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
    var form = $('form[name="form_prog_content"]');

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
    var form = $('form[name="form_prog_content"]');
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
    var contentchanged = $('input[name="contentchanged"]').val();
    if (contentchanged == 1) {
        isModified = true;
    }

    return isModified;
}
