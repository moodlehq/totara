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
 * @author Piers Harding <piers@catalyst.net.nz>
 * @package totara
 * @subpackage reportbuilder 
 */
// Javascript to pre-fill column headings with the appropriate title
// when a column is selected

$(document).ready(function() {
    // disable the new column heading field on page load
    $('#id_newheading').attr('disabled', true);

    // handle changes to the column pulldowns
    $('select.column_selector').change(function() {
        var changedSelector = $(this).val();
        var newContent = rb_column_headings[changedSelector];
        $(this).parents('td')  // find the containing td tag
            .next('td')        // get the next sibling (contains textbox)
            .find('input')     // get the heading input field
            .val(newContent);  // insert new content
    });

    // special case for the 'Add another column...' selector
    $('select.new_column_selector').change(function() {
        var newHeadingBox = $(this).parents('td').next('td').find('input');
        if($(this).val() == 0) {
            // empty and disable the new heading box if no column chosen
            newHeadingBox.val('');
            newHeadingBox.attr('disabled', true);
        } else {
            // reenable it (binding above will fill the value)
            newHeadingBox.attr('disabled', false);
        }
    });
});
