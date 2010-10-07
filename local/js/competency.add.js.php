<?php

    require_once('../../config.php');
    require_once('lib/setup.php');

?>

// Bind functionality to page on load
$(function() {

    (function() {
        var handler = new totaraDialog_handler_addcompetency();

        totaraDialogs['addcompetency'] = new totaraDialog(
            'addcompetency',
            'show-add-dialog',
            {title: '<?php echo '<h2>'.get_string('selectacompetencyframework', 'competency').'</h2>'; ?>'},
            '<?php echo $CFG->wwwroot ?>/hierarchy/item/add.php?type=competency',
            handler
        );
    })();

    ///
    /// Competency dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/competency/assign/';

        totaraSingleSelectDialog(
            'competency',
            '<?php echo get_string('selectcompetency', 'local').dialog_display_currently_selected(get_string('currentlyselected', 'competency'), 'competency'); ?>',
            url+'find.php?',
            'competencyid',
            'competencytitle',
            function() {
                var jsonurl = '<?php echo $CFG->wwwroot ?>/hierarchy/type/competency/evidence/competency_scale.json.php';
                compid = $('input[name=competencyid]').val();

                var profinput = $('body.hierarchy-type-competency-evidence select#id_proficiency');
                // only do JSON request if a proficiency select found to fill
                if(profinput) {
                    // used by add competency evidence page to populate proficiency pulldown based on competency chosen
                    $.getJSON(jsonurl, {competencyid:compid}, function(scales) {
                        var i, htmlstr = '';
                        for (i in scales) {
                            htmlstr += '<option value="'+scales[i].name+'">'+scales[i].value+'</option>';
                        }
                        profinput.removeAttr('disabled').html(htmlstr);
                    });
                }
            }
        );
    })();
});


// Create handler for the addcompetency dialog
totaraDialog_handler_addcompetency = function() {};
totaraDialog_handler_addcompetency.prototype = new totaraDialog_handler();

/**
 * Do handler specific binding
 *
 * @return void
 */
totaraDialog_handler_addcompetency.prototype.every_load = function() {

    var handler = this;

    $('#addcompetency #id_submitbutton').click(function() {
        var formdata = $('#addcompetency #mform1');

        // submit form
        handler._dialog._request(
            '<?php echo $CFG->wwwroot ?>/hierarchy/item/add.php?'+formdata.serialize(),
            handler,
            'submission'
        );

        return false;
    });

    $('#addcompetency #id_cancel').click(function() {
        handler._dialog.hide();
        return false;
    });
}

/**
 * Handle form submission
 *
 * @param   post request response
 * @return  boolean
 */
totaraDialog_handler_addcompetency.prototype.submission = function(response) {

    if (response.substr(0,8) == 'newcomp:') {
        // competency created, grab info and close popup
        if(match = response.match(/^newcomp:([0-9]*):(.*)$/)) {
            var compid = match[1];
            var compname = match[2];
            $('input[name=competencyid]').val(compid);
            $('span#competencytitle').text(compname);

            var profinput = $('body.hierarchy-type-competency-evidence select#id_proficiency');
            var jsonurl = '<?php echo $CFG->wwwroot ?>/hierarchy/type/competency/evidence/competency_scale.json.php';
            // only do JSON request if a proficiency select found to fill
            if(profinput) {
                // used by add competency evidence page to populate proficiency pulldown based on competency chosen
                $.getJSON(jsonurl, {competencyid:compid}, function(scales) {
                    var i, htmlstr = '';
                    for (i in scales) {
                        htmlstr += '<option value="'+scales[i].name+'">'+scales[i].value+'</option>';
                    }
                    profinput.removeAttr('disabled').html(htmlstr);
                });
            }

            this._dialog.hide();
            return false;
        }
    }

    // Failed, rerender form
    return true;
}
