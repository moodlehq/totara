/**
 * Loaded every page
 */
$(document).ready(function() {
    // If rounded borders are supported..
    if (roundedBordersSupported()) {
	var buttons = $('input[type="submit"], input[type="button"], button, .ui-state-default, .ui-widget-content button.ui-state-default');
	$(buttons).addClass('totarabutton');

	// Handle the hover effect
	$(buttons).hover(
	    function () {
		$(this).addClass('hover');
	    },
	    function () {
		$(this).removeClass('hover');
	    }
	);

	// Handle any disabled buttons
	$(buttons).each(function() {
	    if ($(this).is(':disabled')) {
		$(this).addClass('disabled');
	    }
	});
    }
});

/**
 * Checks whether the users browser supports rounded corners
 */
function roundedBordersSupported() {
    if ( /Gecko\/\d*/.test(navigator.userAgent) && parseInt(navigator.userAgent.match(/Gecko\/\d*/)[0].split('/')[1]) > 20070501 ) {
	return true;
    }
    else {
	var div = document.createElement('div');
	div.setAttribute('style', '-moz-border-radius: 8px; -webkit-border-radius: 8px; border-radius: 8px;');
	for ( stylenr=0; stylenr<div.style.length; stylenr++ ) {
	    if ( /border.*?-radius/i.test(div.style[stylenr]) ) {
		return true;
	    }
	    return false;
	}
    }
}