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

