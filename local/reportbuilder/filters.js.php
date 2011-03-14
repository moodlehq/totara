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
 * @author Eugene Venter <eugene@catalyst.net.nz>
 * @package totara
 * @subpackage reportbuilder
 */

    require_once('../../config.php');
?>

$(document).ready(function() {
    rb_init_filter_rows();
});

var rb_init_filter_rows = function() {

    // handle changes to the 'Add another filter...' selector
    $('select.new_filter_selector').change(function() {
        var addbutton = rb_init_addbutton($(this));
        var selectedval = $(this).val();

        if(selectedval == 0) {
            // clean out the selections
            addbutton.remove();
        }
    });

    // Set up delete button events
    rb_init_deletebuttons();

    // Set up 'move' button events
    rb_init_movedown_btns();
    rb_init_moveup_btns();
};

var rb_init_addbutton = function(filterselector) {
    var advancedCheck = filterselector.closest('td').next('td').find('input[type=checkbox]');
    var optionsbox = advancedCheck.closest('td').next('td');
    var newfilterinput = filterselector.closest('tr').clone();  // clone of current 'Add new filter...' tr
    var addbutton = optionsbox.find('.addfilterbtn');
    if (addbutton.length == 0) {
        addbutton = rb_get_btn_add(rb_reportid);
    } else {
        // Button already initialised
        return addbutton;
    }

    // Add save button to options
    optionsbox.prepend(addbutton);
    addbutton.click(function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?php echo $CFG->wwwroot.'/local/reportbuilder/ajax/filter.php'; ?>",
            type: "POST",
            data: ({action: 'add', sesskey: '<?php echo $USER->sesskey; ?>', id: rb_reportid, filter: filterselector.val(), advanced: advancedCheck.is(':checked')}),
            beforeSend: function() {
                addbutton.html('<img src="<?php echo "{$CFG->pixpath}/i/ajaxloader.gif"; ?>" alt="Saving..." class="iconsmall" />');
            },
            success: function(o) {
                if (o.length > 0) {
                    // Add action buttons to row
                    var fid = parseInt(o);
                    var deletebutton = rb_get_btn_delete(rb_reportid, fid);

                    var upbutton = '';
                    var uppersibling = filterselector.closest('tr').prev('tr');
                    if (uppersibling.find('select.filter_selector').length > 0) {
                        // Create an up button for the newly added filter, to be added below
                        var upbutton = rb_get_btn_up(rb_reportid, fid);
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

                    rb_reload_option_btns(uppersibling);

                    // Remove added filter from the new filter selector
                    var filtertype = filterselector.val().split('-')[0];
                    var filterval = filterselector.val().split('-')[1];
                    $('.new_filter_selector optgroup option[value='+filtertype+'-'+filterval+']').remove();

                    rb_init_filter_rows();

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
};


var rb_init_deletebuttons = function() {
    $('.reportbuilderform table .deletefilterbtn').click(function(e) {
        e.preventDefault();
        var clickedbtn = $(this);

        confirmed = confirm('<?php echo addslashes_js(get_string('confirmfilterdelete', 'local_reportbuilder')); ?>');

        if (!confirmed) {
            return;
        }

        var filterrow = $(this).closest('tr');
        $.ajax({
            url: "<?php echo $CFG->wwwroot.'/local/reportbuilder/ajax/filter.php'; ?>",
            type: "POST",
            data: ({action: 'delete', sesskey: '<?php echo $USER->sesskey; ?>', id: rb_reportid, fid: filterrow.attr('fid')}),
            beforeSend: function() {
                clickedbtn.replaceWith('<img src="<?php echo "{$CFG->pixpath}/i/ajaxloader.gif"; ?>" alt="Deleting..." class="iconsmall" />');
            },
            success: function(o) {
                if (o.length > 0) {
                    //o = eval('('+o+')');  // this may become necessary for older browsers :(
                    o = JSON.parse(o);

                    var uppersibling = filterrow.prev('tr');
                    var lowersibling = filterrow.next('tr');

                    // Remove filter row
                    filterrow.remove();

                    // Fix sibling buttons
                    if (uppersibling.find('select.filter_selector').length > 0) {
                        rb_reload_option_btns(uppersibling);
                    }
                    if (lowersibling.find('select.filter_selector:not(.new_filter_selector)').length > 0) {
                        rb_reload_option_btns(lowersibling);
                    }

                    // Add deleted filter to new filter selector
                    var nlabel = o.type.replace(/[-_]/g, ' ');  // Determine the optgroup label
                    nlabel = rb_ucwords(nlabel);
                    var optgroup = $('.new_filter_selector optgroup[label='+nlabel+']')
                    if (optgroup.length == 0) {
                        // Create optgroup and append to select
                        optgroup = $('<optgroup label="'+nlabel+'"></optgroup>');
                        $('.new_filter_selector').append(optgroup);
                    }
                    if (optgroup.find('option[value='+o.type+'-'+o.value+']').length == 0) {
                        optgroup.append('<option value="'+o.type+'-'+o.value+'">'+rb_filter_headings[o.type+'-'+o.value]+'</option>');
                    }

                    rb_init_filter_rows();

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
        return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
            return $1.toUpperCase();
        });
    }
}

var rb_init_movedown_btns = function() {
    $('.reportbuilderform table .movefilterdownbtn').click(function(e) {
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

        var loadingimg = '<img src="<?php echo "{$CFG->pixpath}/i/ajaxloader.gif"; ?>" alt="Moving..." class="iconsmall" />';

        $.ajax({
            url: "<?php echo $CFG->wwwroot.'/local/reportbuilder/ajax/filter.php'; ?>",
            type: "POST",
            data: ({action: 'movedown', sesskey: '<?php echo $USER->sesskey; ?>', id: rb_reportid, fid: filterrow.attr('fid')}),
            beforeSend: function() {
                lowersibling.html(loadingimg);
                filterrow.html(loadingimg);
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
                    rb_reload_option_btns(filterrowclone);
                    rb_reload_option_btns(lowersiblingclone);

                    rb_init_filter_rows();

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
}


var rb_init_moveup_btns = function() {
    $('.reportbuilderform table .movefilterupbtn').click(function(e) {
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

        var loadingimg = '<img src="<?php echo "{$CFG->pixpath}/i/ajaxloader.gif"; ?>" alt="Moving..." class="iconsmall" />';

        $.ajax({
            url: "<?php echo $CFG->wwwroot.'/local/reportbuilder/ajax/filter.php'; ?>",
            type: "POST",
            data: ({action: 'moveup', sesskey: '<?php echo $USER->sesskey; ?>', id: rb_reportid, fid: filterrow.attr('fid')}),
            beforeSend: function() {
                uppersibling.html(loadingimg);
                filterrow.html(loadingimg);

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
                    rb_reload_option_btns(filterrowclone);
                    rb_reload_option_btns(uppersiblingclone);

                    rb_init_filter_rows();

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
}

var rb_reload_option_btns = function(filterrow) {
    var optionbox = filterrow.children('td').filter(':last');

    // Remove all option buttons
    optionbox.find('a').remove();
    optionbox.find('img').remove();

    // Replace btns with updated ones
    var fid = filterrow.attr('fid');
    var deletebtn = rb_get_btn_delete(rb_reportid, fid);
    var upbtn = '<img src="<?php echo $CFG->wwwroot.'/pix/spacer.gif'; ?>" class="iconsmall" alt="" />';
    if (filterrow.prev('tr').find('select.filter_selector').length > 0) {
        upbtn = rb_get_btn_up(rb_reportid, fid);
    }
    var downbtn = '<img src="<?php echo $CFG->wwwroot.'/pix/spacer.gif'; ?>" class="iconsmall" alt="" />';
    if (filterrow.next('tr').next('tr').find('select.filter_selector').length > 0) {
        downbtn = rb_get_btn_down(rb_reportid, fid);
    }

    optionbox.append(deletebtn, upbtn, downbtn);
}


var rb_get_btn_delete = function(reportid, fid) {
    return $('<a href="<?php echo $CFG->wwwroot.'/local/reportbuilder/filters.php?id='; ?>' + reportid + '&fid='+fid+'&d=1" class="deletefilterbtn"><img src="<?php echo "{$CFG->pixpath}/t/delete.gif"; ?>" alt="Delete" class="iconsmall" /></a>');
}

var rb_get_btn_up = function (reportid, fid) {
    return $('<a href="<?php echo $CFG->wwwroot.'/local/reportbuilder/filters.php?id='; ?>' + reportid + '&fid='+fid+'&m=up" class="movefilterupbtn"><img src="<?php echo "{$CFG->pixpath}/t/up.gif"; ?>" alt="Move up" class="iconsmall" /></a>');
}

var rb_get_btn_down = function (reportid, fid) {
    return $('<a href="<?php echo $CFG->wwwroot.'/local/reportbuilder/filters.php?id='; ?>' + reportid + '&fid='+fid+'&m=down" class="movefilterdownbtn"><img src="<?php echo "{$CFG->pixpath}/t/down.gif"; ?>" alt="Move down" class="iconsmall" /></a>');
}

var rb_get_btn_add = function (reportid) {
    return $('<a href="<?php echo $CFG->wwwroot.'/local/reportbuilder/filters.php?id='; ?>' + reportid + '" class="addfilterbtn"><input type="button" value="<?php echo addslashes_js(get_string('add')); ?>" /></a>');
}


/**
 * Select/deselect any matching checkboxes, radio buttons or option elements.
 */
$.fn.selected = function(select) {
    if (select == undefined) select = true;
    return this.each(function() {
        var t = this.type;
        if (t == 'checkbox' || t == 'radio')
            this.checked = select;
        else if (this.tagName.toLowerCase() == 'option') {
            var $sel = $(this).parent('select');
            if (select && $sel[0] && $sel[0].type == 'select-one') {
                // deselect all other options
                $sel.find('option').selected(false);
            }
            this.selected = select;
        }
    });
};
