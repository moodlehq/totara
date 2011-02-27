ol_delay = 350;
ol_fgclass = 'cal_popup_fg';
ol_bgclass = 'cal_popup_bg';
ol_cgclass = 'cal_popup_cg';
ol_captionfontclass = 'cal_popup_caption';
ol_noclose = true;
ol_sticky = true;
ol_close = 'X';
ol_offsety = -1;
ol_mouseoff = 1;

// We had an issue whereby the absolutely positioned calendar pop-ups were being
// placed in the wrong position. This is due to a parent div in the page having
// relative positioning. We cannot remove the relative positioning as it's
// needed for other things.
//
// The solution I've gone for is to modify the offset of the pop-up so that
// it is correctly positioned. What we do is get the left position of the
// relative parent if it exists, and set the offset to be the negative of this
//
// This wrapper element only exists in some of the Totara themes. Therefore we
// Make sure it exists and check it has the relative position style.

var wrapper = document.getElementById('wrapper');
if (wrapper != null && getStyle(wrapper,'position') == 'relative') {
    ol_offsetx = -wrapper.offsetLeft;
}

// Generic function for getting a style property from an element element
function getStyle(element,styleProp) {
    if (element.currentStyle)
	var y = element.currentStyle[styleProp];
    else if (window.getComputedStyle)
	var y = document.defaultView.getComputedStyle(element,null).getPropertyValue(styleProp);
    return y;
}
