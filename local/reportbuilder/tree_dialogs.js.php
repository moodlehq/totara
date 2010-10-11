<?php

/**
 * Javascript file containing JQuery bindings for hierarchy dialog filters
 *
 * @copyright Catalyst IT Limited
 * @author Simon Coggins
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage reportbuilder
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
            var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/position/assign/';

            totaraSingleSelectDialog(
                postree[i],
                '<?php
                    echo get_string('chooseposition', 'position');
                    echo dialog_display_currently_selected(get_string('selected', 'hierarchy'), '\'+postree[i]+\'');
                ?>',
                url+'find.php?',
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
            var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/organisation/assign/';

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
            var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/competency/assign/';

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
