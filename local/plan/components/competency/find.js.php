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
 * @author Aaron Barnes <aaronb@catalyst.net.nz>
 * @author Alastair Munro <alastair@catalyst.net.nz>
 * @package totara
 * @subpackage plan
 */

require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/config.php');
require_login();
$save_string = get_string('save');
$cancel_string = get_string('cancel');
$cont_string = get_string('continue');
?>

// Bind functionality to page on load
$(function() {

    // Setup vars
    if (window.plan_id === undefined) {
        plan_id = '';
        comp_update_allowed = false;
    }

    (function() {

        var url = '<?php echo $CFG->wwwroot ?>/local/plan/components/competency/';
        var continueurl = url + 'confirm.php?id='+plan_id+'&update=';
        var saveurl = url + 'update.php?id='+plan_id+'&update=';
        var continueskipurl = saveurl + 'id='+plan_id+'&update=';
        var continuesaveurl = url + 'update.php?';

        var handler = new totaraDialog_handler_lpCompetency();
        handler.baseurl = url;
        handler.continueskipurl = continueskipurl;

        handler.standard_buttons = {
            '<?php echo $cancel_string ?>': function() { handler._cancel() },
            '<?php echo $save_string ?>': function() { handler._save(saveurl) }
        };

        handler.continue_buttons = {
            '<?php echo $cancel_string ?>': function() { handler._cancel() },
            '<?php echo $cont_string ?>': function() { handler._continue(continueurl) }
        };

        handler.continuesave_buttons = {
            '<?php echo $cancel_string ?>': function() { handler._cancel() },
            '<?php echo $save_string ?>': function() { handler._continueSave(continuesaveurl) }
        };

        totaraDialogs['evidence'] = new totaraDialog(
            'assigncompetencies',
            'show-competency-dialog',
            {
                buttons: {},
                title: '<?php
                    echo '<h2>';
                    echo get_string('addcompetencys', 'local_plan');
                    echo '</h2>';
                ?>'
            },
            url+'find.php?id='+plan_id,
            handler
        );
    })();

});


// Create handler for the dialog
totaraDialog_handler_lpCompetency = function() {
    // Base url
    var baseurl = '';
}

totaraDialog_handler_lpCompetency.prototype = new totaraDialog_handler_preRequisite();


/**
 * Reset buttons on dialog open
 *
 * @return  void
 */
totaraDialog_handler_lpCompetency.prototype._open = function() {

    // Check if user has allow permissions for updating compentencies
    if (comp_update_allowed) {
        var buttons = this.continue_buttons;
    } else {
        var buttons = this.standard_buttons;
    }

    // Reset buttons
    this._dialog.dialog.dialog('option', 'buttons', buttons);
}


/**
 * Load intermediate page for selecting courses
 *
 * @param   string  url
 * @return  void
 */
totaraDialog_handler_lpCompetency.prototype._continue = function(url) {

    // Serialize data
    var elements = $('.selected > div > span', this._container);
    var selected_str = this._get_ids(elements).join(',');

    // Add to url
    url = url + selected_str;

    // Load url in dialog
    this._dialog._request(url, this, '_continueRender');
}


/**
 * Check result, if special string, redirect. Else, render;
 *
 * If rendering, update dialog buttons to be ok/cancel
 *
 * @param   object  asyncRequest response
 * @return  void
 */
totaraDialog_handler_lpCompetency.prototype._continueRender = function(response) {

    // Check result
    if (response.substr(0, 9) == 'NOCOURSES') {

        // Generate url
        var url = this.continueskipurl + response.substr(10);

        // Send to server
        this._dialog._request(url, this, '_update');

        // Do not render
        return false;
    }

    // Update buttons
    this._dialog.dialog.dialog('option', 'buttons', this.continuesave_buttons);

    // Render result
    return true;
}


/**
 * Serialize linked courses and send to url,
 * update table with result
 *
 * @param string URL to send dropped items to
 * @return void
 */
totaraDialog_handler.prototype._continueSave = function(url) {

    // Serialize form data
    var data_str = $('form', this._container).serialize();

    // Add to url
    url = url + data_str;

    // Send to server
    this._dialog._request(url, this, '_update');
}
