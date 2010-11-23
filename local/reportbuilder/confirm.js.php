<?php

/**
 * Javascript file containing JQuery bindings for show/hide popup dialog box
 *
 * @copyright Catalyst IT Limited
 * @author Piers Harding
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage reportbuilder
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');

?>

/*****************************************************************************/
/** totaraDialog_handler_confirm **/

/**
 * define the handler for a basic continue/cancel type dialog box
 * with a jumpto URL on continue leg
 *
 */

totaraDialog_handler_confirm = function() {};
totaraDialog_handler_confirm.prototype = new totaraDialog_handler();

/**
 * Serialize confirmed messages and send to url,
 * update table with result
 *
 * @param string URL to send confirmed messages to
 * @param string returnTo to send user back to after confirm complete
 * @return void
 */
totaraDialog_handler.prototype._confirm = function(url, returnto) {

    // set the returnto
    this.setReturnTo(returnto);

    // grab message ids if available
    msgids = [];
    $("form#totara_messages INPUT[@name=totara_message][type='checkbox'][checked=true]").each(
                function () {
                    msgids.push($(this).attr('value'));
                });
    url = url+'&msgids='+msgids.join(',');

    // Send to server
    this._dialog._request(url, this, '_redirect');
}

/**
 * set the returnTo location
 *
 * @return void
 */
totaraDialog_handler.prototype.setReturnTo = function(url) {
    this._returnTo = url;
    return;
}


/**
 * Handle a 'redirect' request, by just closing the dialog
 * and then jumping to the returnTo
 *
 * @return void
 */
totaraDialog_handler.prototype._redirect = function() {
    this._dialog.hide();
    if (this._returnTo == null) {
        this._returnTo = '<?php echo $CFG->wwwroot; ?>';
    }
    window.location = this._returnTo;
    return;
}
