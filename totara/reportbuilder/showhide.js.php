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
 * @package totara
 * @subpackage reportbuilder 
 */

/**
 * Javascript file containing JQuery bindings for show/hide popup dialog box
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
                },
                title: '<h2><?php echo get_string('showhidecolumns', 'local_reportbuilder') ?></h2>'
            },
            url+'showhide.php?id='+id.toString(),
            handler
        );

    })();

});
