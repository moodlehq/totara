/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010 - 2012 Totara Learning Solutions LTD
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
 * @author Eugene Venter <eugene@catalyst.net.nz>
 * @package totara
 * @subpackage reportbuilder
 */
M.totara_reportbuilderfilters = M.totara_reportbuilderfilters || {

    Y: null,
    // optional php params and defaults defined here, args passed to init method
    // below will override these values
    config: {},
    loadingimg: '<img src="'+M.util.image_url('i/ajaxloader', 'moodle')+'" alt="' + M.util.get_string('saving', 'totara_reportbuilder') + '" class="iconsmall" />',

    /**
     * module initialisation method called by php js_init_call()
     *
     * @param object    YUI instance
     * @param string    args supplied in JSON format
     */
    init: function(Y, args){
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

        // check jQuery dependency is available
        if (typeof $ === 'undefined') {
            throw new Error('M.totara_reportbuildercolumns.init()-> jQuery dependency required for this module to function.');
        }

        // do setup
        this.rb_init_filter_rows();
    },

    rb_init_filter_rows: function() {
        var module = this;

        // handle changes to the 'Add another filter...' selector
        $('select.new_filter_selector').bind('change', function() {
            var addbutton = module.rb_init_addbutton($(this));
            var selectedval = $(this).val();

            if (selectedval == 0) {
                // clean out the selections
                addbutton.remove();
            }
        });

        // Set up delete button events
        module.rb_init_deletebuttons();

        // Set up 'move' button events
        module.rb_init_movedown_btns();
        module.rb_init_moveup_btns();
    },

    rb_init_addbutton: function(filterselector) {
        var module = this;
        var advancedCheck = filterselector.closest('td').next('td').find('input[type=checkbox]');
        var optionsbox = advancedCheck.closest('td').next('td');
        var newfilterinput = filterselector.closest('tr').clone();  // clone of current 'Add new filter...' tr
        var addbutton = optionsbox.find('.addfilterbtn');
        if (addbutton.length == 0) {
            addbutton = module.rb_get_btn_add(module.config.rb_reportid);
        } else {
            // Button already initialised
            return addbutton;
        }

        // Add save button to options
        optionsbox.prepend(addbutton);
        addbutton.unbind('click');
        addbutton.bind('click', function(e) {
            e.preventDefault();
            $.ajax({
                url: M.cfg.wwwroot + '/totara/reportbuilder/ajax/filter.php',
                type: "POST",
                data: ({action: 'add', sesskey: module.config.user_sesskey, id: module.config.rb_reportid, filter: filterselector.val(), advanced: Number(advancedCheck.is(':checked'))}),
                beforeSend: function() {
                    addbutton.html(module.loadingimg);
                },
                success: function(o) {
                    if (o.length > 0) {
                        // Add action buttons to row
                        var fid = parseInt(o);
                        var deletebutton = module.rb_get_btn_delete(module.config.rb_reportid, fid);

                        var upbutton = '';
                        var uppersibling = filterselector.closest('tr').prev('tr');
                        if (uppersibling.find('select.filter_selector').length > 0) {
                            // Create an up button for the newly added filter, to be added below
                            var upbutton = module.rb_get_btn_up(module.config.rb_reportid, fid);
                        }

                        addbutton.remove();
                        optionsbox.prepend(deletebutton, upbutton);

                        // Set row atts
                        $('select[').removeClass('new_filter_selector');
                        var filterbox = optionsbox.prev('td').prev('td');
                        filterbox.find('select.filter_selector').attr('name', 'filter'+fid);
                        filterbox.find('select optgroup[label=New]').remove();
                        filterbox.find('select.filter_selector').attr('id', 'id_filter'+fid);
                        advancedCheck.attr('name', 'filter'+fid);
                        advancedCheck.attr('id', 'id_filter'+fid);
                        advancedCheck.closest('tr').attr('fid', fid);

                        // Append a new filter select box
                        filterbox.closest('table').append(newfilterinput);

                        module.rb_reload_option_btns(uppersibling);

                        // Remove added filter from the new filter selector
                        var filtertype = filterselector.val().split('-')[0];
                        var filterval = filterselector.val().split('-')[1];
                        $('.new_filter_selector optgroup option[value='+filtertype+'-'+filterval+']').remove();

                        module.rb_init_filter_rows();

                    } else {
                        alert('Error');
                        // Reload the broken page
                        location.reload();
                    }

                },
                error: function(h, t, e) {
                    alert('Error');
                    // Reload the broken page
                    location.reload();
                }
            }); // ajax
        }); // click event

        return addbutton;
    },


    rb_init_deletebuttons: function() {
        var module = this;
        $('.reportbuilderform table .deletefilterbtn').unbind('click');
        $('.reportbuilderform table .deletefilterbtn').bind('click', function(e) {
            e.preventDefault();
            var clickedbtn = $(this);

            confirmed = confirm(M.util.get_string('confirmfilterdelete', 'totara_reportbuilder'));

            if (!confirmed) {
                return;
            }

            var filterrow = $(this).closest('tr');
            $.ajax({
                url: M.cfg.wwwroot + '/totara/reportbuilder/ajax/filter.php',
                type: "POST",
                data: ({action: 'delete', sesskey: module.config.user_sesskey, id: module.config.rb_reportid, fid: filterrow.attr('fid')}),
                beforeSend: function() {
                    clickedbtn.replaceWith(module.loadingimg);
                },
                success: function(o) {
                    if (o.length > 0) {
                        o = JSON.parse(o);

                        var uppersibling = filterrow.prev('tr');
                        var lowersibling = filterrow.next('tr');

                        // Remove filter row
                        filterrow.remove();

                        // Fix sibling buttons
                        if (uppersibling.find('select.filter_selector').length > 0) {
                            module.rb_reload_option_btns(uppersibling);
                        }
                        if (lowersibling.find('select.filter_selector:not(.new_filter_selector)').length > 0) {
                            module.rb_reload_option_btns(lowersibling);
                        }

                        // Add deleted filter to new filter selector
                        var nlabel = o.type.replace(/[-_]/g, ' ');  // Determine the optgroup label
                        nlabel = rb_ucwords(nlabel);
                        var optgroup = $(".new_filter_selector optgroup[label='"+nlabel+"']");
                        if (optgroup.length == 0) {
                            // Create optgroup and append to select
                            optgroup = $('<optgroup label="'+nlabel+'"></optgroup>');
                            $('.new_filter_selector').append(optgroup);
                        }
                        if (optgroup.find('option[value='+o.type+'-'+o.value+']').length == 0) {
                            optgroup.append('<option value="'+o.type+'-'+o.value+'">'+rb_filter_headings[o.type+'-'+o.value]+'</option>');
                        }

                        module.rb_init_filter_rows();

                    } else {
                        alert('Error');
                        // Reload the broken page
                        location.reload();
                    }

                },
                error: function(h, t, e) {
                    alert('Error');
                    // Reload the broken page
                    location.reload();
                }
            }); // ajax

        });

        function rb_ucwords (str) {
            return (str + '').replace(/^([a-z])|\s+([a-z])/g, function($1) {
                return $1.toUpperCase();
            });
        }
    },

    rb_init_movedown_btns: function() {
        var module = this;
        $('.reportbuilderform table .movefilterdownbtn').unbind('click');
        $('.reportbuilderform table .movefilterdownbtn').bind('click', function(e) {
            e.preventDefault();
            var clickedbtn = $(this);

            var filterrow = $(this).closest('tr');

            var filterrowclone = filterrow.clone();
            // Set the selected option, cause for some reason this don't clone so well...
            filterrowclone.find('select.filter_selector option[value='+filterrow.find('select.filter_selector').val()+']').attr('selected', 'selected');

            var lowersibling = filterrow.next('tr');

            var lowersiblingclone = lowersibling.clone();
            // Set the selected option, cause for some reason this don't clone so well...
            lowersiblingclone.find('select.filter_selector option[value='+lowersibling.find('select.filter_selector').val()+']').attr('selected', 'selected');

            $.ajax({
                url: M.cfg.wwwroot + '/totara/reportbuilder/ajax/filter.php',
                type: "POST",
                data: ({action: 'movedown', sesskey: module.config.user_sesskey, id: module.config.rb_reportid, fid: filterrow.attr('fid')}),
                beforeSend: function() {
                    lowersibling.html(module.loadingimg);
                    filterrow.html(module.loadingimg);
                    filterrowclone.find('td *').hide();
                    lowersiblingclone.find('td *').hide();
                },
                success: function(o) {
                    if (o.length > 0) {
                        // Switch!
                        filterrow.replaceWith(lowersiblingclone);
                        lowersibling.replaceWith(filterrowclone);

                        filterrowclone.find('td *').fadeIn();
                        lowersiblingclone.find('td *').fadeIn();

                        // Fix option buttons
                        module.rb_reload_option_btns(filterrowclone);
                        module.rb_reload_option_btns(lowersiblingclone);

                        module.rb_init_filter_rows();

                    } else {
                        alert('Error');
                        // Reload the broken page
                        location.reload();
                    }

                },
                error: function(h, t, e) {
                    alert('Error');
                    // Reload the broken page
                    location.reload();
                }
            }); // ajax

        });
    },


    rb_init_moveup_btns: function() {
        var module = this;
        $('.reportbuilderform table .movefilterupbtn').unbind('click');
        $('.reportbuilderform table .movefilterupbtn').bind('click', function(e) {
            e.preventDefault();
            var clickedbtn = $(this);

            var filterrow = $(this).closest('tr');
            var filterrowclone = filterrow.clone();
            // Set the selected option, cause for some reason this don't clone so well...
            filterrowclone.find('select.filter_selector option[value='+filterrow.find('select.filter_selector').val()+']').attr('selected', 'selected');

            var uppersibling = filterrow.prev('tr');

            var uppersiblingclone = uppersibling.clone();
            // Set the selected option, cause for some reason this don't clone so well...
            uppersiblingclone.find('select.filter_selector option[value='+uppersibling.find('select.filter_selector').val()+']').attr('selected', 'selected');

            $.ajax({
                url: M.cfg.wwwroot + '/totara/reportbuilder/ajax/filter.php',
                type: "POST",
                data: ({action: 'moveup', sesskey: module.config.user_sesskey, id: module.config.rb_reportid, fid: filterrow.attr('fid')}),
                beforeSend: function() {
                    uppersibling.html(module.loadingimg);
                    filterrow.html(module.loadingimg);

                    filterrowclone.find('td *').hide();
                    uppersiblingclone.find('td *').hide();
                },
                success: function(o) {
                    if (o.length > 0) {
                        // Switch!
                        filterrow.replaceWith(uppersiblingclone);
                        uppersibling.replaceWith(filterrowclone);

                        filterrowclone.find('td *').fadeIn();
                        uppersiblingclone.find('td *').fadeIn();

                        // Fix option buttons
                        module.rb_reload_option_btns(filterrowclone);
                        module.rb_reload_option_btns(uppersiblingclone);

                        module.rb_init_filter_rows();

                    } else {
                        alert('Error');
                        // Reload the broken page
                        location.reload();
                    }

                },
                error: function(h, t, e) {
                    alert('Error');
                    // Reload the broken page
                    location.reload();
                }
            }); // ajax

        });
    },

    rb_reload_option_btns: function(filterrow) {
        var module = this;
        var optionbox = filterrow.children('td').filter(':last');

        // Remove all option buttons
        optionbox.find('a').remove();
        optionbox.find('img').remove();

        // Replace btns with updated ones
        var fid = filterrow.attr('fid');
        var deletebtn = module.rb_get_btn_delete(module.config.rb_reportid, fid);
        var upbtn = '<img src="'+M.util.image_url('spacer')+'" class="iconsmall" alt="" />';
        if (filterrow.prev('tr').find('select.filter_selector').length > 0) {
            upbtn = module.rb_get_btn_up(module.config.rb_reportid, fid);
        }
        var downbtn = '<img src="'+M.util.image_url('spacer')+'" class="iconsmall" alt="" />';
        if (filterrow.next('tr').next('tr').find('select.filter_selector').length > 0) {
            downbtn = module.rb_get_btn_down(module.config.rb_reportid, fid);
        }

        optionbox.append(deletebtn, upbtn, downbtn);
    },


    rb_get_btn_delete: function(reportid, fid) {
        return $('<a href=' + M.cfg.wwwroot + '/totara/reportbuilder/filters.php?id=' + reportid + '&fid=' + fid + '&d=1" class="deletefilterbtn"><img src="' + M.util.image_url('t/delete') + '" alt="' + M.util.get_string('delete', 'totara_reportbuilder') + '" class="iconsmall" /></a>');
    },

    rb_get_btn_up: function(reportid, fid) {
        return $('<a href=' + M.cfg.wwwroot + '/totara/reportbuilder/filters.php?id=' + reportid + '&fid=' + fid + '&m=up" class="movefilterupbtn"><img src="' + M.util.image_url('t/up') + '" alt="' + M.util.get_string('moveup', 'totara_reportbuilder') + '" class="iconsmall" /></a>');
    },

    rb_get_btn_down: function(reportid, fid) {
        return $('<a href=' + M.cfg.wwwroot + '/totara/reportbuilder/filters.php?id=' + reportid + '&fid=' + fid + '&m=down" class="movefilterdownbtn"><img src="' + M.util.image_url('t/down') + '" alt="' + M.util.get_string('movedown', 'totara_reportbuilder') + '" class="iconsmall" /></a>');
    },

    rb_get_btn_add: function(reportid) {
        return $('<a href=' + M.cfg.wwwroot + '/totara/reportbuilder/filters.php?id=' + reportid + '" class="addfilterbtn"><input type="button" value="' + M.util.get_string('add', 'totara_reportbuilder') + '" /></a>');
    }
}
