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
 * @author Simon Coggins <simonc@catalyst.net.nz>
 * @author Eugene Venter <eugene@catalyst.net.nz>
 * @author Aaron Barnes <aaronb@catalyst.net.nz>
 * @package totara
 * @subpackage plan
 */

require_once '../../config.php';
require_once($CFG->dirroot.'/local/js/lib/setup.php');

$userid = required_param('userid', PARAM_INT);

?>
// Bind functionality to page on load
$(function() {

    ///
    /// Position dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/position/assign/';

        totaraSingleSelectDialog(
            'position',
            '<?php
                echo get_string('chooseposition', 'position');
                echo dialog_display_currently_selected(get_string('selected', 'hierarchy'), 'position');
            ?>',
            url+'position.php?',
            'positionid',
            'positiontitle'
        );
    })();


    ///
    /// Organisation dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/organisation/assign/';

        totaraSingleSelectDialog(
            'organisation',
            '<?php
                echo get_string('chooseorganisation', 'organisation');
                echo dialog_display_currently_selected(get_string('currentlyselected', 'organisation'), 'organisation');
            ?>',
            url+'find.php?',
            'organisationid',
            'organisationtitle'
        );
    })();


    ///
    /// Manager dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/position/assign/';

        totaraSingleSelectDialog(
            'manager',
            '<?php
                echo get_string('choosemanager', 'position');
                echo dialog_display_currently_selected(get_string('selected', 'hierarchy'), 'manager');
            ?>',
                url+'manager.php?userid=<?php echo $userid ?>',
            'managerid',
            'managertitle'
        );
    })();



});
