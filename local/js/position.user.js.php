<?php

    require_once '../../config.php';

?>
// Bind functionality to page on load
YAHOO.util.Event.onDOMReady(function () {

    ///
    /// Position dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/position/assign/';

        yuiLocateDialog(
            'position',
            url+'find.php?user='+user_id,
            function(selected) {
                $('input[name=positionid]').val(selected.attr('id'));
                $('span#positiontitle').text(selected.text());
            }
        );
    })();


    ///
    /// Organisation dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/organisation/assign/';

        yuiLocateDialog(
            'organisation',
            url+'find.php?user='+user_id,
            function(selected) {
                $('input[name=organisationid]').val(selected.attr('id'));
                $('span#organisationtitle').text(selected.text());
            }
        );
    })();


    ///
    /// Manager dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/position/assign/';

        yuiLocateDialog(
            'manager',
            url+'manager.php?user='+user_id,
            function(selected) {
                $('input[name=managerid]').val(selected.attr('id'));
                $('span#managertitle').text(selected.text());
            }
        );
    })();


    ///
    /// Competency dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/competency/assign/';

        yuiLocateDialog(
            'competency',
            url+'find.php?user='+user_id,
            function(selected) {
                var jsonurl = '<?php echo $CFG->wwwroot ?>/hierarchy/type/competency/evidence/competency_scale.json.php';
                var compid = selected.attr('id');
                $('input[name=competencyid]').val(compid);
                $('span#competencytitle').text(selected.text());

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
