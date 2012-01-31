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
 * @author Ben Lobo <ben.lobo@kineo.com>
 * @package totara
 * @subpackage plan
 */

require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/config.php');
require_login();
$save_string = get_string('save');
$cancel_string = get_string('cancel');

?>

// Bind functionality to page on load
$(function() {

    // Setup vars
    if (window.plan_id === undefined) {
        plan_id = '';
    }

    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/local/plan/components/program/';
        var saveurl = url + 'update.php?id='+plan_id+'&update=';

        var handler = new totaraDialog_handler_preRequisite();
        handler.baseurl = url;

        totaraDialogs['evidence'] = new totaraDialog(
            'assignprograms',
            'show-program-dialog',
            {
                 buttons: {
                    '<?php echo $cancel_string ?>': function() { handler._cancel() },
                    '<?php echo $save_string ?>': function() { handler._save(saveurl) }
                 },
                title: '<?php
                    echo '<h2>';
                    echo get_string('addprograms', 'local_plan');
                    echo '</h2>';
                ?>'
            },
            url+'find.php?id='+plan_id,
            handler
        );
    })();

});
