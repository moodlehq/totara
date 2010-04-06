/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function getobject(elementid) {
    if (document.getElementById) {
        return document.getElementById(elementid);
    } else if (window[elementid]) {
        return window[elementid];
    }
    return null;
}

// Close a group of collapsable divs, using groupid, and _toggle_div_groups;
function close_divgroup(groupid, exceptions) {
    // convert the array of exceptions to a hash for easy lookup
    var ex = exceptions;
    exceptions = {};
    for(var i in ex) {
        exceptions[ex[i]] = 1;
    }
    // close ALL groups if groupid is not defined, calling self repeatedly to do so.
    if (groupid === undefined || groupid === null) {
        for(var i in _toggle_div_groups) {
            close_divgroup(i, exceptions);
        }
        return;
    }

    // close all divs in a group, except those passed in [exceptions]
    var divs = _toggle_div_groups[groupid];
    for (var i in divs) {
        var d = divs[i];
        if (exceptions[d]) {
            continue;
        }
        var divobject = getobject(d);
        var arrowobject = getobject("arrow_" + d);
        try {
            divobject.style.display = 'none';
            arrowobject.src = config['pixpath'] + '/t/switch_minus.gif';
        } catch(e) {
            // do nothing about errors at this point
        }
    }
}

function toggle_div(divid, mutexid) {

    var divobject = getobject(divid);
    var arrowobject = getobject("arrow_" + divid);

    if (divobject.style.display == "none") {
        divobject.style.display = "";
        arrowobject.src = config['pixpath'] + '/t/switch_minus.gif';

    } else {
        divobject.style.display = "none";
        arrowobject.src = config['pixpath'] + '/t/switch_plus.gif';
    }
    if (mutexid != '') {
        close_divgroup(mutexid, [divid]);
    }
}
