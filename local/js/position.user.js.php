<?php

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
