
// highlight a specific category by flashing the background yellow,
// then fades out over 5 seconds
$(document).ready(function(){
    // remember the old background (zebra stripes)
    var oldColor =  $('div.itemhighlight').closest('tr').children('td').css('backgroundColor');
    // set background to yellow
    $('div.itemhighlight').closest('tr').children('td').css({backgroundColor: '#ff0'});
    // then fade back slowly
    $('div.itemhighlight').closest('tr').children('td').animate({backgroundColor: oldColor}, 5000);
});
