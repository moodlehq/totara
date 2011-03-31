<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
 * Copyright (C) 1999 onwards Martin Dougiamas 
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

require_once '../../../../config.php';
require_login();

?>

// Bind functionality to page on load
$(function() {

    // Setup vars
    if (window.plan_id === undefined) {
        plan_id = '';
    }

    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/local/plan/components/course/';
        var saveurl = url + 'update.php?id='+plan_id+'&update=';

        var handler = new totaraDialog_handler_preRequisite();
        handler.baseurl = url;

        totaraDialogs['evidence'] = new totaraDialog(
            'assigncourses',
            'show-course-dialog',
            {
                 buttons: {
                    'Cancel': function() { handler._cancel() },
                    'Ok': function() { handler._save(saveurl) }
                 },
                title: '<?php
                    echo '<h2>';
                    echo get_string('updatecourses', 'local_plan');
                    echo '</h2>';
                ?>'
            },
            url+'find.php?id='+plan_id,
            handler
        );
    })();

});

// Create handler for the dialog
totaraDialog_handler_preRequisite = function() {
    // Base url
    var baseurl = '';
}

totaraDialog_handler_preRequisite.prototype = new totaraDialog_handler_treeview_multiselect();

/**
 * Add a row to a table on the calling page
 * Also hides the dialog and any no item notice
 *
 * @param string    HTML response
 * @return void
 */
totaraDialog_handler_preRequisite.prototype._update = function(response) {

    // Hide dialog
    this._dialog.hide();

    // Remove no item warning (if exists)
    $('.noitems-'+this._title).remove();

    //Split response into table and div
    var new_table = $(response).filter('table');
    var new_planbox = $(response).filter('.plan_box');

    // Grab table
    var table = $('div#content form#dp-component-update table.dp-plan-component-items');

    // Check for no items msg
    var noitems = $(response).filter('span.noitems-assigncourses');

    // Define update setting button div
    var updatesettings = $('div#content div#dp-component-update-submit');

    if (noitems.size()) {
        // If no items, just display message
        $('div#content form#dp-component-update div#dp-component-update-table').append(noitems);
        // Replace table with nothing
        table.empty();
        // Hide update setting button when there are no items
        updatesettings.hide();
    } else if (table.size()) {
        // If table found
        table.replaceWith(new_table);
        updatesettings.show();
    } else {
        // Add new table
        $('div#content form#dp-component-update div#dp-component-update-table').append(new_table);
        // Show update setting button there are now rows
        updatesettings.show();
    }

    //Replace plan message box
    $('div.plan_box').replaceWith(new_planbox);

    <?php
        require_once($CFG->dirroot.'/local/plan/development_plan.class.php');
        $plan = new development_plan(required_param('planid', PARAM_INT), optional_param('viewas', null, PARAM_INT));

        if ($plan->get_component('course')->can_update_settings(false)) {
    ?>

    <?php if ($plan->get_component('course')->get_setting('duedatemode') && $plan->get_component('course')->get_setting('setduedate') >= DP_PERMISSION_ALLOW) { ?>
        // Add duedate datepicker
        $(function() {
            $('[id^=duedate_course]').datepicker(
                {
                    dateFormat: 'dd/mm/y',
                    showOn: 'both',
                    buttonImage: '<?php echo $CFG->wwwroot; ?>/local/js/images/calendar.gif',
                    buttonImageOnly: true,
                    constrainInput: true
                }
            );
        });
    <?php }
    } ?>
}
