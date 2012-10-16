/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2012 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
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
 * @author Dave Wallace <dave.wallace@kineo.co.nz>
 * @package totara
 * @subpackage program
 */
M.totara_programcontent = M.totara_programcontent || {

    Y: null,
    // optional php params and defaults defined here, args passed to init method
    // below will override these values
    config: {
        userid:''
    },

    /**
     * module initialisation method called by php js_init_call()
     *
     * @param object    YUI instance
     * @param string    args supplied in JSON format
     */
    init: function(Y, args){

        var module = this;

        // save a reference to the Y instance (all of its dependencies included)
        this.Y = Y;

        // if defined, parse args into this module's config object
        if (args) {
            var jargs = Y.JSON.parse(args);
            for (var a in jargs) {
                if (Y.Object.owns(jargs, a)) {
                    this.config[a] = jargs[a];
                }
            }
        }

        // check if required param id is available
        if (!this.config.id) {
            throw new Error('M.totara_programcontent.init()-> Required config \'id\' not available.');
        }

        // check jQuery dependency and continue with setup
        if (typeof $ === 'undefined') {
            throw new Error('M.totara_programcontent.init()-> jQuery dependency required for this module to function.');
        }

        /**
         * Dialog and dialog handler definitions, totaraDialog_program_cat is
         * saved on the module instance as it is referenced in the code
         * following this module definition
        */
        // Define the dialog and handler for adding a multi course set
        // Create handler
        var totaraDialog_handler_addmulticourse = function(contenturl) {
            this.contenturl = contenturl;
        };

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
            if (setprefixes == '') {
                var sortorder = 1;
            } else {
                var setprefixesarray = setprefixes.split(',');
                var sortorder = setprefixesarray.length + 1;
            }

            $.getJSON(this.contenturl + '&htmltype=multicourseset' + '&courseids=' + courseids_str + '&sortorder=' + sortorder + '&setprefixes=' + setprefixes, function(data) {
                $('#course_sets').append(data['html']);
                $('input[name="setprefixes"]').val(data['setprefixes']);
                module.initCoursesets();
                $('form[name="form_prog_content"]').submit();
            })

            this._dialog.hide();

        };

        // Define the dialog
        var totaraDialog_addmulticourse = function() {

            this.url = M.cfg.wwwroot+'/totara/program/content/';
            this.find_url = 'find_courses.php?id='+module.config.id;
            this.ajax_url = 'get_html.php?id='+module.config.id;

            // Setup the handler
            var handler = new totaraDialog_handler_addmulticourse(this.url + this.ajax_url);

            var default_url = this.url + this.find_url;
            var buttonsObj = {};
            buttonsObj[M.util.get_string('cancel', 'totara_program')] = function() { handler._cancel(); };
            buttonsObj[M.util.get_string('ok','totara_program')] = function() { handler._save(); };

            // Call the parent dialog object and link us
            totaraDialog.call(
                this,
                'addmulticourse',
                'unused', // buttonid unused
                {
                    buttons: buttonsObj,
                    title: '<h2>'+M.util.get_string('addcourses', 'totara_program')+'</h2>'
                },
                default_url,
                handler
            );

        };

        // Define the dialog and handler for adding a competency course set
        // Create handler
        var totaraDialog_handler_addcompetency = function(contenturl) {
            this.contenturl = contenturl;
        };

        // Set the dialog handler as a single select
        totaraDialog_handler_addcompetency.prototype = new totaraDialog_handler_treeview_singleselect();

        // Adapt the handler's save function
        totaraDialog_handler_addcompetency.prototype._save = function() {

            // retrieve the competency id and name
            var id = $('#treeview_selected_val_addcompetency').val();
            var competency = $('#treeview_selected_text_addcompetency').text();

            // retrieve the number of set prefixes so that we can determine the sort order for the new set
            var setprefixes = $('input:hidden[name=setprefixes]').val();
            if (setprefixes == '') {
                var sortorder = 1;
            } else {
                var setprefixesarray = setprefixes.split(',');
                var sortorder = setprefixesarray.length + 1;
            }

            // retrieve the html for the new set
            $.getJSON(this.contenturl + '&htmltype=competencyset' + '&competencyid=' + id + '&sortorder=' + sortorder + '&setprefixes=' + setprefixes, function(data) {
                $('#course_sets').append(data['html']);
                $('input[name="setprefixes"]').val(data['setprefixes']);
                module.initCoursesets();
                $('form[name="form_prog_content"]').submit();
            })

            this._dialog.hide();

        };
        // Define the dialog
        var totaraDialog_addcompetency = function() {

            this.url = M.cfg.wwwroot+'/totara/program/content/';
            this.find_url = 'find_competency.php?id='+module.config.id;
            this.ajax_url = 'get_html.php?id='+module.config.id;

            // Setup the handler
            var handler = new totaraDialog_handler_addcompetency(this.url + this.ajax_url);

            var default_url = this.url + this.find_url;
            var buttonsObj = {};
            buttonsObj[M.util.get_string('cancel', 'totara_program')] = function() { handler._cancel(); };
            buttonsObj[M.util.get_string('ok','totara_program')] = function() { handler._save(); };

            // Call the parent dialog object and link us
            totaraDialog.call(
                this,
                'addcompetency',
                'unused', // buttonid unused
                {
                    buttons: buttonsObj,
                    title: '<h2>'+ M.util.get_string('addcompetency', 'totara_program') + module.config.display_selected_addcompetency +'</h2>'
                },
                default_url,
                handler
            );

        };

        // Define the dialog and handler for adding a recurring course set
        // Create handler
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
                module.initCoursesets();
                $('form[name="form_prog_content"]').submit();
            })

            this._dialog.hide();

        };
        // Define the dialog
        totaraDialog_addrecurringcourse = function() {

            this.url = M.cfg.wwwroot+'/totara/program/content/';
            this.find_url = 'find_course.php?id='+module.config.id;
            this.ajax_url = 'get_html.php?id='+module.config.id;

            // Setup the handler
            var handler = new totaraDialog_handler_addrecurringcourse(this.url + this.ajax_url);

            var default_url = this.url + this.find_url;
            var buttonsObj = {};
            buttonsObj[M.util.get_string('cancel', 'totara_program')] = function() { handler._cancel(); };
            buttonsObj[M.util.get_string('ok','totara_program')] = function() { handler._save(); };

            // Call the parent dialog object and link us
            totaraDialog.call(
                this,
                'addrecurringcourse',
                'unused', // buttonid unused
                {
                    buttons: buttonsObj,
                    title: '<h2>'+ M.util.get_string('addcourse', 'totara_program') + module.config.display_selected_addrecurringcourse +'</h2>'
                },
                default_url,
                handler
            );

        };

        // Define the dialog and handler for adding/removing courses from a multi course set
        // Create handler for the add/remove courses dialog
        totaraDialog_handler_amendmulticourse = function(contenturl) {
            this.contenturl = contenturl;
            this.coursesetprefix = '';
            this.coursesetid = 0;
            this.sortorder = 0;
            this.completiontype = 0;
        };

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
                module.initCoursesets();
                //$('form[name="form_prog_content"]').submit();

            });

            this._dialog.hide();

        };

        // Define the dialog
        totaraDialog_amendmulticourse = function() {

            var url = M.cfg.wwwroot+'/totara/program/content/';

            this.find_url = 'find_courses.php?id='+module.config.id;
            this.ajax_url = 'get_html.php?id='+module.config.id;
            this.default_url = url + this.find_url;

            // Setup the handler
            this.handler = new totaraDialog_handler_amendmulticourse(url + this.ajax_url);

            var self = this;
            var buttonsObj = {};
            buttonsObj[M.util.get_string('cancel', 'totara_program')] = function() { self.handler._cancel(); };
            buttonsObj[M.util.get_string('ok','totara_program')] = function() { self.handler._save(); };

            // Call the parent dialog object and link us
            totaraDialog.call(
                this,
                'amendmulticourse',
                'unused', // buttonid unused
                {
                    buttons: buttonsObj,
                    title: '<h2>'+ M.util.get_string('addcourses', 'totara_program') +'</h2>'
                },
                this.default_url,
                this.handler
            );

        };

        // The save changes confirmation dialog
        totaraDialog_savechanges = function() {

            // Setup the handler
            var handler = new totaraDialog_handler();

            // Store reference to this
            var self = this;
            var buttonsObj = {};
            buttonsObj[M.util.get_string('editcontent', 'totara_program')] = function() { handler._cancel(); };
            buttonsObj[M.util.get_string('saveallchanges','totara_program')] = function() { self.save(); };

            // Call the parent dialog object and link us
            totaraDialog.call(
            this,
            'savechanges-dialog',
            'unused', // buttonid unused
            {
                buttons: buttonsObj,
                title: '<h2>'+ M.util.get_string('confirmcontentchanges', 'totara_program') +'</h2>'
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
        };

        /**
         * Event bindings, Dialog instantiation and setup
         */
        // Attach a function to the page to prevent unsaved changes from being lost
        // when navigating away
        window.onbeforeunload = function(e) {

            var modified = module.isFormModified();
            var e = e || window.event;
            var str = M.util.get_string('youhaveunsavedchanges', 'totara_program');

            if (modified == true) {
                // For IE and Firefox (before version 4)
                if (e) {
                    e.returnValue = str;
                }
                // For Safari
                return str;
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
            return module.addContent();
        });

        // Add a function to launch the save changes dialog
        $('input[name="savechanges"]').click(function() {
            return module.handleSaveChanges();
        });

        // delegate course deletion to delete buttons rendered or created dynamically
        Y.delegate('click', function(e){
            var coursesetid = this.getAttribute('data-coursesetid');
            var coursesetprefix = this.getAttribute('data-coursesetprefix');
            var coursetodelete_id = this.getAttribute('data-coursetodelete_id');
            module.deleteCourse(coursesetid, coursesetprefix, coursetodelete_id);
        }, '#programcontent', '.coursedeletelink');

        this.initCoursesets();

        // create instances of each dialog for the page
        totaraDialogs['addmulticourse'] = new totaraDialog_addmulticourse();
        totaraDialogs['addcompetency'] = new totaraDialog_addcompetency();
        totaraDialogs['addrecurringcourse'] = new totaraDialog_addrecurringcourse();
        totaraDialogs['amendcourses'] = new totaraDialog_amendmulticourse();
        totaraDialogs['savechanges'] = new totaraDialog_savechanges();

        this.storeInitialFormValues();
    },

    /**
     * Hide any elements of all course sets that should not be displayed and
     * generally set up the display of course sets
     */
    initCoursesets: function(){

        $('input[name=cancel]').css('display', 'none');
        $('input[name=update]').css('display', 'none');
        $('input.deletebutton').css('display', 'none');
        $('div.courseadder select').css('display', 'none');
        $('div.courseadder input:submit').val(M.util.get_string('addcourses', 'totara_program'));
        $('div.setbuttons .updatebutton').css('display', 'none');

    },

    /**
     * Function called when a completion type drop down in a course set is changed to
     * determine whether all courses or only one course in the set has to be completed.
     * This function changes the completion type string next to the course ('and' or 'or')
     * to match the selection
     */
    changeCompletionTypeString: function(el, prefix){

        if (el.value == this.config.COMPLETIONTYPE_ANY) {
            var completiontypestr = M.util.get_string('or', 'totara_program');
        } else {
            var completiontypestr = M.util.get_string('and', 'totara_program');
        }

        $('.operator'+prefix).html(completiontypestr);

        return true;

    },

    /**
     * open the appropriate dialog to add a content type
     */
    addContent: function(){

        // get the type of content to be added
        var contenttype = $('#contenttype').val();
        if (contenttype == this.config.CONTENTTYPE_MULTICOURSE) {
            totaraDialogs['addmulticourse'].open();
        } else if (contenttype == this.config.CONTENTTYPE_COMPETENCY) {
            totaraDialogs['addcompetency'].open();
        } else if (contenttype == this.config.CONTENTTYPE_RECURRING) {
            totaraDialogs['addrecurringcourse'].open();
        }

        return false;

    },

    /**
     * Function attached to each 'Amend courses' button.
     * This retrieves all the currently selected courses in a course set
     * and passes the course ids to the dialog
     */
    amendCourses: function(coursesetprefix){

        var selectedcourses = $('input:hidden[name='+coursesetprefix+'courses]').val();
        var coursesetid = $('input:hidden[name='+coursesetprefix+'id]').val();
        var sortorder = $('input:hidden[name='+coursesetprefix+'sortorder]').val();
        var completiontype = $('select[name='+coursesetprefix+'completiontype]').val();

        var selectedcourses_encoded = encodeURI(selectedcourses);

        var dialog_url = M.cfg.wwwroot+'/totara/program/content/find_courses.php?id='+this.config.id+'&selectedcourseids=' + selectedcourses_encoded;

        var mydialog = totaraDialogs['amendcourses'];
        mydialog.default_url = dialog_url;
        mydialog.handler.coursesetprefix = coursesetprefix;
        mydialog.handler.coursesetid = coursesetid;
        mydialog.handler.sortorder = sortorder;
        mydialog.handler.completiontype = completiontype;
        mydialog.open();

        return false;
    },

    /**
     * Each course name in a multi-course set has a link with an onclick event
     * which calls this function to display a confirmation dialog and then
     * delete the course from the set (if confirmed)
     */
    deleteCourse: function(coursesetid, coursesetprefix, coursetodelete_id){

        var contenturl = M.cfg.wwwroot+'/totara/program/content/get_html.php?id='+M.totara_programcontent.config.id;

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
            M.totara_programcontent.initCoursesets();
            //$('form[name="form_prog_content"]').submit();

        });

        return false;
    },


    /**
     * Stores the initial values of the form when the page is loaded
     */
    storeInitialFormValues: function() {
        var form = $('form[name="form_prog_content"]');

        $('input[type="text"], textarea, select', form).each(function() {
            $(this).attr('initialValue', $(this).val());
        });

        $('input[type="checkbox"]', form).each(function() {
            var checked = $(this).is('checked') ? 1 : 0;
            $(this).attr('initialValue', checked);
        });
    },

    /**
     *
     */
    handleSaveChanges: function(){
        // no need to display the confirmation dialog if there are no changes to save
        if (!this.isFormModified()) {
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
            html = M.util.get_string('affectedusercount', 'totara_program') + window.currentassignmentcount;
        }
        html = html + '<'+'p>' + M.util.get_string('tosavecontent', 'totara_program') +'<'+'/p>';
        dialog.open(html);
        dialog.save = function() {
            dialog.savechanges = true;
            this.hide();
            $('input[name="savechanges"]').trigger('click');
        }

        return false;
    },

    /**
     * Checks if the form is modified by comparing the initial and current values
     */
    isFormModified: function(){
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
            var checked = $(this).is('checked') ? 1 : 0;
            if ($(this).attr('initialValue') != checked) {
                isModified = true;
            }
        });

        // Check if textareas have been changed
        $('textarea', form).each(function() {
            // See if there's a tiny MCE instance for this text area
            var instance = tinyMCE.getInstanceById($(this).attr('id'));
            if (instance != undefined && typeof instance.isDirty == 'function') {
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

        // Check if messages have been changed as a result of the form being submitted
        var contentchanged = $('input[name="contentchanged"]').val();
        if (contentchanged == 1) {
            isModified = true;
        }

        return isModified;
    }
};
