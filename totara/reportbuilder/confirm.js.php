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
 * @author Piers Harding <piers@catalyst.net.nz>
 * @package totara
 * @subpackage reportbuilder 
 */

/**
 * Javascript file containing JQuery bindings for show/hide popup dialog box
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
totaraDialog_handler_confirm.prototype._confirm = function(url, returnto) {

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
totaraDialog_handler_confirm.prototype.setReturnTo = function(url) {
    this._returnTo = url;
    return;
}


/**
 * Handle a 'redirect' request, by just closing the dialog
 * and then jumping to the returnTo
 *
 * @return void
 */
totaraDialog_handler_confirm.prototype._redirect = function() {
    this._dialog.hide();
    if (this._returnTo == null) {
        this._returnTo = '<?php echo $CFG->wwwroot; ?>';
    }
    window.location = this._returnTo;
    return;
}
