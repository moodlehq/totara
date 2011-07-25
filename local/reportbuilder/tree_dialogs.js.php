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
 * Javascript file containing JQuery bindings for hierarchy dialog filters
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->dirroot . '/local/js/lib/setup.php');

?>
// See local/reportbuilder/lib.php method include_js()
// for postree/orgtree/comptree variable definitions


// Bind functionality to page on load
$(function() {

    for(i in postree) {

        ///
        /// Position dialog
        ///
        (function() {
            var url = '<?php echo $CFG->wwwroot ?>/hierarchy/prefix/position/assign/';

            totaraSingleSelectDialog(
                postree[i],
                '<?php
                    echo get_string('chooseposition', 'position');
                    echo dialog_display_currently_selected(get_string('selected', 'hierarchy'), '\'+postree[i]+\'');
                ?>',
                url+'position.php?',
                postree[i],
                postree[i]+'title'
            );

            // disable popup buttons if first pulldown is set to
            // 'any value'
            if($('select[name='+postree[i]+'_op]').val() == 0) {
                $('input[name='+postree[i]+'_rec]').attr('disabled',true);
                $('#show-'+postree[i]+'-dialog').attr('disabled',true);
            }
        })();

    }

    for(i in orgtree) {

        ///
        /// Organisation dialog
        ///
        (function() {
            var url = '<?php echo $CFG->wwwroot ?>/hierarchy/prefix/organisation/assign/';

            totaraSingleSelectDialog(
                orgtree[i],
                '<?php
                    echo get_string('chooseorganisation', 'organisation');
                    echo dialog_display_currently_selected(get_string('currentlyselected', 'organisation'), '\'+orgtree[i]+\'');
                ?>',
                url+'find.php?',
                orgtree[i],
                orgtree[i] + 'title'
            );

            // disable popup buttons if first pulldown is set to
            // 'any value'
            if($('select[name='+orgtree[i]+'_op]').val() == 0) {
                $('input[name='+orgtree[i]+'_rec]').attr('disabled',true);
                $('#show-'+orgtree[i]+'-dialog').attr('disabled',true);
            }
        })();

    }

    for(i in comptree) {

        ///
        /// Competency dialog
        ///
        (function() {
            var url = '<?php echo $CFG->wwwroot ?>/hierarchy/prefix/competency/assign/';

            totaraSingleSelectDialog(
                comptree[i],
                '<?php
                    echo get_string('selectcompetency', 'local');
                    echo dialog_display_currently_selected(get_string('currentlyselected', 'competency'), '\'+comptree[i]+\'');
                ?>',
                url+'find.php?',
                comptree[i],
                comptree[i]+'title'
            );

            // disable popup buttons if first pulldown is set to
            // 'any value'
            if($('select[name='+comptree[i]+'_op]').val() == 0) {
                $('input[name='+comptree[i]+'_rec]').attr('disabled',true);
                $('#show-'+comptree[i]+'-dialog').attr('disabled',true);
            }
        })();

    }

});
