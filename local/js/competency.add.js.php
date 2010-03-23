<?php

    require_once '../../config.php';

?>

// Bind functionality to page on load
YAHOO.util.Event.onDOMReady(function () {
    YAHOO.dialog.add = new yuiDialog(
        'addcompetency',
        'show-add-dialog',
        {},
        '<?php echo $CFG->wwwroot ?>/hierarchy/item/add.php?type=competency'

    );
});


// Setup function
// Run on dialog load
YAHOO.dialogSetupFunc.addcompetency = function() {
    addcompetency_bind();
}

function addcompetency_bind() {

    $('#addcompetency #id_submitbutton').click(function() {
        var formdata = $('#addcompetency #mform1');

        var callback =
        {
            success:    addcompetency_submit_form,
            failure:    function(o) {}
        }

        // submit form
        YAHOO.util.Connect.asyncRequest(
            'GET',
            '<?php echo $CFG->wwwroot ?>/hierarchy/item/add.php?'+formdata.serialize(),
            callback
        );

        return false;
    });
    $('#addcompetency #id_cancel').click(function() {
        YAHOO.dialog.add.dialog.hide();
        return false;
    });
}

function addcompetency_submit_form(response) {
    if (response.responseText.substr(0,8) == 'newcomp:') {
        // competency created, grab info and close popup
        if(match = response.responseText.match(/^newcomp:([0-9]*):(.*)$/)) {
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


            YAHOO.dialog.add.dialog.hide();
        } else {
            // new competency creation failed, show error
            YAHOO.dialog.add.render(response);
            //YAHOO.dialog.add.dialog.hide();
        }
    } else {
        // validation failed, rerender form
    YAHOO.dialog.add.render(response);
    }
}


