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
 * @author Simon Coggins <simon.coggins@totaralms.com>
 * @package totara
 * @subpackage reportbuilder
 */

/**
 * Javascript file containing JQuery bindings for hierarchy dialog filters
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->dirroot . '/totara/core/js/lib/setup.php');

?>

// Bind functionality to page on load
$(function() {

    $('input.rb-filter-choose-pos').each(function(i, el) {
        var id = $(this).attr('id');
        // remove 'show-' and '-dialog' from ID
        id = id.substr(5, id.length - 12);

        ///
        /// Position dialog
        ///
        (function() {
            var url = '<?php echo $CFG->wwwroot ?>/hierarchy/prefix/position/assign/';

            totaraSingleSelectDialog(
                id,
                '<?php
                    echo get_string('chooseposition', 'position');
                    echo dialog_display_currently_selected(get_string('selected', 'hierarchy'), '\'+id+\'');
                ?>',
                url+'position.php?',
                id,
                id+'title'
            );

            // disable popup buttons if first pulldown is set to
            // 'any value'
            if ($('select[name='+id+'_op]').val() == 0) {
                $('input[name='+id+'_rec]').attr('disabled',true);
                $('#show-'+id+'-dialog').attr('disabled',true);
            }
        })();

    });

    $('input.rb-filter-choose-org').each(function(i, el) {
        var id = $(this).attr('id');
        // remove 'show-' and '-dialog' from ID
        id = id.substr(5, id.length - 12);

        ///
        /// Organisation dialog
        ///
        (function() {
            var url = '<?php echo $CFG->wwwroot ?>/hierarchy/prefix/organisation/assign/';

            totaraSingleSelectDialog(
                id,
                '<?php
                    echo get_string('chooseorganisation', 'organisation');
                    echo dialog_display_currently_selected(get_string('currentlyselected', 'organisation'), '\'+id+\'');
                ?>',
                url+'find.php?',
                id,
                id + 'title'
            );

            // disable popup buttons if first pulldown is set to
            // 'any value'
            if ($('select[name='+id+'_op]').val() == 0) {
                $('input[name='+id+'_rec]').attr('disabled',true);
                $('#show-'+id+'-dialog').attr('disabled',true);
            }
        })();

    });

    $('input.rb-filter-choose-comp').each(function(i, el) {
        var id = $(this).attr('id');
        // remove 'show-' and '-dialog' from ID
        id = id.substr(5, id.length - 12);

        ///
        /// Competency dialog
        ///
        (function() {
            var url = '<?php echo $CFG->wwwroot ?>/hierarchy/prefix/competency/assign/';

            totaraSingleSelectDialog(
                id,
                '<?php
                    echo get_string('selectcompetency', 'local');
                    echo dialog_display_currently_selected(get_string('currentlyselected', 'competency'), '\'+id+\'');
                ?>',
                url+'find.php?',
                id,
                id+'title'
            );

            // disable popup buttons if first pulldown is set to
            // 'any value'
            if ($('select[name='+id+'_op]').val() == 0) {
                $('input[name='+id+'_rec]').attr('disabled',true);
                $('#show-'+id+'-dialog').attr('disabled',true);
            }
        })();

    });



    // bind multi-organisation report filter
    $('div.rb-org-add-link a').each(function(i, el) {
        var id = $(this).attr('id');
        // remove 'show-' and '-dialog' from ID
        id = id.substr(5, id.length - 12);

        (function() {
            var url = '<?php echo $CFG->wwwroot ?>/hierarchy/prefix/organisation/assignfilter/';

            totaraMultiSelectDialogRbFilter(
                id,
                '<?php
                    echo get_string('chooseorgplural', 'local_reportbuilder');
                ?>',
                url+'find.php?',
                url+'save.php?filtername='+id+'&ids='
            );

        })();

    });


    // bind multi-position report filter
    $('div.rb-pos-add-link a').each(function(i, el) {
        var id = $(this).attr('id');
        // remove 'show-' and '-dialog' from ID
        id = id.substr(5, id.length - 12);

        (function() {
            var url = '<?php echo $CFG->wwwroot ?>/hierarchy/prefix/position/assignfilter/';

            totaraMultiSelectDialogRbFilter(
                id,
                '<?php
                    echo get_string('chooseposplural', 'local_reportbuilder');
                ?>',
                url+'find.php?',
                url+'save.php?filtername='+id+'&ids='
            );

        })();

    });


    // bind multi-competency report filter
    $('div.rb-comp-add-link a').each(function(i, el) {
        var id = $(this).attr('id');
        // remove 'show-' and '-dialog' from ID
        id = id.substr(5, id.length - 12);

        (function() {
            var url = '<?php echo $CFG->wwwroot ?>/hierarchy/prefix/competency/assignfilter/';

            totaraMultiSelectDialogRbFilter(
                id,
                '<?php
                    echo get_string('choosecompplural', 'local_reportbuilder');
                ?>',
                url+'find.php?',
                url+'save.php?filtername='+id+'&ids='
            );

        })();

    });


});

