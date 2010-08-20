<?php

/**
 * Javascript file containing JQuery bindings for show/hide popup dialog box
 *
 * @copyright Catalyst IT Limited
 * @author Simon Coggins
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage reportbuilder
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');

?>
// bind functionality to page on load
$(function() {

    ///
    /// show/hide column dialog
    ///
    (function() {

        // id not set when zero results
        // http://verens.com/2005/07/25/isset-for-javascript/#comment-332
        if(window.id===undefined) {return;}

        $('#show-showhide-dialog').css('display','block');
        var url = '<?php echo $CFG->wwwroot ?>/local/reportbuilder/';

        var handler = new totaraDialog_handler();
        var name = 'showhide';

        totaraDialogs[name] = new totaraDialog(
            name,
            'show-'+name+'-dialog',
            {
                buttons: {
                    'Ok': function() { handler._cancel() }
                }
            },
            url+'showhide.php?id='+id.toString(),
            handler
        );

    })();

});
