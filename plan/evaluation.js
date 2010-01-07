// This function is called when users click on an objective's add/delete button
function toggle_objective(revid, objectiveid, curriculum, editable, action, element) {

    var urlparams = 'revisionid=' + revid + '&objectiveid=' + objectiveid
        + '&curriculum=' + curriculum + '&action=' + action;

    sendjsonrequest('evaluation.json.php', urlparams,
                    function (data) {
                        var addbutton = getobject('addobjective' + objectiveid);

                        // Fix focus
                        if (element) {
                            element.focus();
                            element.blur();
                        }

                        // Show/hide add button
                        if (addbutton) {
                            if (data['action'] == 'addobj') {
                                addbutton.style.display = 'none';
                            } else {
                                addbutton.style.display = '';
                            }
                        }

                        var objective_table = getobject('objectivelist' + curriculum);
                        objective_table.innerHTML = data['data'];
                    },
                    function(errormsg) {
                        alert(errormsg);
                    });
}

// Set the grade on a revision objective when users click a radio button
function grade_objective(roid, grade) {

    var urlparams = 'roid=' + roid + '&grade=' + grade + '&action=gradeobj';

    sendjsonrequest('evaluation.json.php', urlparams,
                    function() {},
                    function(errormsg) {
                        alert(errormsg);
                    });
}