
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
 * @author Simon Coggins <simonc@catalyst.net.nz>
 * @author Eugene Venter <eugene@catalyst.net.nz>
 * @author Aaron Barnes <aaronb@catalyst.net.nz>
 * @package totara
 * @subpackage plan
 */

/* 
 * jQuery for adding a date picker to date inputs in the Plan component
 */
$(document).ready(function() {
    var dateHook = $('select[name*=date[day]]');
    $(dateHook).each(function(){
	var parent = $(this).parent();
	// Hide all normal inputs
	$(parent).children('select').hide();

	// Insert a new field
	$(this).before('<input class="jqdatepicker" type="text" />');

	// Set the value of the input to be the current date if appropriate
	var day = $(parent).children('select[name*=date[day]]').val();
	var month = $(parent).children('select[name*=date[month]]').val();
	var year = $(parent).children('select[name*=date[year]]').val();
	if (day < 10) {
	    day = "0" + day;
	}
	if (month < 10) {
	    month = "0" + month;
	}
	var date = day + "/" + month + "/" + year;
	$(parent).children('.jqdatepicker').val(date);
    });

    // Add a date picker to this new element
    $('.jqdatepicker').datepicker(
	{
	    onSelect: function(date) {
		date = date.split("/");
		$(this).siblings('select[name*=date[day]]').val(parseInt(date[0]));
		$(this).siblings('select[name*=date[month]]').val(parseInt(date[1]));
		$(this).siblings('select[name*=date[year]]').val(date[2]);
	    },
	    dateFormat: 'dd/mm/yy',
	    showOn: 'both',
	    buttonImage: '../../local/js/images/calendar.gif',
	    buttonImageOnly: true,
        constrainInput: true
	}
    );
});

