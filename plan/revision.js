// This function updates the revision 'last modified' time at the top
// of the page
function update_mtime(revid, time) {

    // Estimate the modification time using the time of the JSON response
    if (time) {
        var mtime = getobject('mtime');
        mtime.innerHTML = time;
        return true;
    }

    var urlparams = 'revisionid=' + revid + '&action=updatemtime';

    sendjsonrequest('revision.json.php', urlparams,
                    function (data) {
                        var mtime = getobject('mtime');
                        if (data['data'] != false) {
                            mtime.innerHTML = data['data'];
                        }
                    },
                    function (errormsg) {
                        alert(errormsg);
                    });

}

// This function is called when users click on an objective's add/delete button
function toggle_objective(revid, objectiveid, curriculum, editable, action, element) {

    var urlparams = 'revisionid=' + revid + '&objectiveid=' + objectiveid
        + '&curriculum=' + curriculum + '&editable=' + editable
        + '&action=' + action;

    sendjsonrequest('revision.json.php', urlparams,
                    function (data) {
                        var addbutton = getobject('addobjective' + objectiveid);
                        var addfavbutton = getobject('addfavobjective' + objectiveid);
                        var searchaddbutton = getobject('searchaddobjective' + objectiveid);

                        // Fix focus
                        if (element) {
                            element.focus();
                            element.blur();
                        }

                        // Show/hide add button
                        if (addbutton) {
                            if (data['action'] == 'addobj') {
                                if (addfavbutton) {
                                    addfavbutton.style.display = 'none';
                                }
                                if (searchaddbutton) {
                                    searchaddbutton.style.display = 'none';
                                }
                                addbutton.style.display = 'none';
                            } else {
                                if (addfavbutton) {
                                    addfavbutton.style.display = '';
                                }
                                if (searchaddbutton) {
                                    searchaddbutton.style.display = '';
                                }
                                addbutton.style.display = '';
                            }
                        }

                        var objective_table = getobject('objectivelist' + curriculum);
                        objective_table.innerHTML = data['data'];

                        update_mtime(revid, data['time']);
                    },
                    function (errormsg) {
                        alert(errormsg);
                    });
}

// This function is called when users click the add button next to the text fields
function add_list_item(revid, listtype, editable) {

    var textfield = getobject('listitem' + listtype);
    var itemtext = textfield.value;
    textfield.value = '';

    // Don't add items which consist entirely of newlines or spaces
    itemtext = itemtext.replace(/[\r\n]+/g, '');
    tmpval = itemtext.replace(/\s+/g, '');
    if (tmpval == '') {
        return;
    }

    var urlparams = 'revisionid=' + revid + '&listtype=' + listtype
        + '&editable=' + editable + '&action=additem'
        + '&itemtext=' + encodeURIComponent(itemtext);

    sendjsonrequest('revision.json.php', urlparams,
                    function (data) {
                        var list_table = getobject('itemlist' + listtype);
                        list_table.innerHTML = data['data'];

                        // Fix focus
                        textfield.focus();

                        update_mtime(revid, data['time']);
                    },
                    function (errormsg) {
                        alert(errormsg);
                    });
}

var listitem_editing = null;


/** Utility function for showing/hiding listitem editing controls by name */
function listitem_display(show, name, type, itemid) {
    var ob = getobject(name+type+itemid);
    if (ob) {
        if (!show) {
            ob.blur();
        }
        ob.style.display = (show) ? '' : 'none';
    }
}

function listitem_getobject(name, listtype, itemid) {
    return getobject(name+listtype+itemid);
}

function listitem_edit(revid, listtype, itemid) {
    var urlparams = 'revisionid=' + revid + '&listtype=' + listtype
        + '&editable=1' + '&action=edititem'
        + '&itemid=' + itemid;

    listitem_display(true, 'editor', listtype, itemid);
    listitem_display(true, 'save', listtype, itemid);
    listitem_display(true, 'cancel', listtype, itemid);
    listitem_display(false, 'item', listtype, itemid);
    listitem_display(false, 'del', listtype, itemid);
    listitem_display(false, 'edit', listtype, itemid);

    var editor = listitem_getobject('editor', listtype, itemid);
    editor.focus();
    listitem_editing = editor.value; // keep original field value
}

function listitem_save(revid, listtype, itemid) {
    var editor = listitem_getobject('editor', listtype, itemid);
    var itemtext = editor.value;

    // Don't add items which consist entirely of newlines or spaces
    itemtext = itemtext.replace(/[\r\n]+/g, '');
    tmpval = itemtext.replace(/\s+/g, '');
    if (tmpval == '') {
        return;
    }

    var urlparams = 'revisionid=' + revid + '&listtype=' + listtype
        + '&editable=1' + '&action=saveitem'
        + '&itemid=' + itemid
        + '&itemtext=' + encodeURIComponent(itemtext);

    sendjsonrequest('revision.json.php', urlparams,
                    function (data) {
                        var list_table = getobject('itemlist' + listtype);
                        list_table.innerHTML = data['data'];

                        // Fix focus
                        var textfield = getobject('listitem' + listtype);
                        textfield.focus();
                        textfield.blur();

                        update_mtime(revid, data['time']);

                        // Hidden text field should always have the right value
                        editor.value = itemtext;
                        listitem_editing = null;

                        listitem_display(false, 'editor', listtype, itemid);
                        listitem_display(false, 'save', listtype, itemid);
                        listitem_display(false, 'cancel', listtype, itemid);
                        listitem_display(true, 'item', listtype, itemid);
                        listitem_display(true, 'del', listtype, itemid);
                        listitem_display(true, 'edit', listtype, itemid);
                    },
                    function (errormsg) {
                        alert(errormsg);
                    });
}

function listitem_cancel(revid, listtype, itemid) {

    // Restore the old value of the field
    var editor = listitem_getobject('editor', listtype, itemid);
    editor.value = listitem_editing;
    listitem_editing = null;

    listitem_display(false, 'editor', listtype, itemid);
    listitem_display(false, 'save', listtype, itemid);
    listitem_display(false, 'cancel', listtype, itemid);
    listitem_display(true, 'item', listtype, itemid);
    listitem_display(true, 'del', listtype, itemid);
    listitem_display(true, 'edit', listtype, itemid);
}

function listitem_action(revid, listtype, itemid, action) {
    var urlparams = 'revisionid=' + revid + '&listtype=' + listtype
        + '&editable=1' + '&action=' + action + "item"
        + '&itemid=' + itemid;

    switch(action) {
        case 'edit':
            listitem_edit(revid, listtype, itemid, action);
            break;
        case 'del':
            listitem_del(revid, listtype, itemid, action);
            break;
        case 'save':
            listitem_save(revid, listtype, itemid, action);
            break;
        case 'cancel':
            listitem_cancel(revid, listtype, itemid, action);
            break;
    }
}

// This function is called when users click the delete button next to a list item
function listitem_del(revid, listtype, itemid) {

    var urlparams = 'revisionid=' + revid + '&listtype=' + listtype
        + '&editable=1' + '&action=deleteitem'
        + '&itemid=' + itemid;

    sendjsonrequest('revision.json.php', urlparams,
                    function (data) {
                        var list_table = getobject('itemlist' + listtype);
                        list_table.innerHTML = data['data'];

                        // Fix focus
                        var textfield = getobject('listitem' + listtype);
                        textfield.focus();
                        textfield.blur();

                        update_mtime(revid, data['time']);
                    },
                    function (errormsg) {
                        alert(errormsg);
                    });
}


// This function when ESC is pressed while in the editbox
function clear_list_item(listtype) {

    var textfield = getobject('listitem' + listtype);
    textfield.value = '';
    textfield.blur();
}

// Used to prevent naive double-submits
var add_comment_last_sent = null;

// This function is called when users click the add button next to the comment text fields
function add_comment(revid, editable) {

    var textfield = getobject('commentfield');
    var urlparams = 'revisionid=' + revid + '&listtype=' + 0
        + '&editable=' + editable + '&action=addcomment'
        + '&itemtext=' + encodeURIComponent(textfield.value);

    if (add_comment_last_sent && add_comment_last_sent == urlparams ) {
        return;
    }
    add_comment_last_sent = urlparams;

    sendjsonrequest('revision.json.php', urlparams,
                    function (data) {
                        var comments = getobject('commentscontainer');
                        comments.innerHTML = data['data'];
                        textfield.value = '';

                        // Fix focus
                        textfield.focus();
                        textfield.blur();

                        // Hide the comments box
                        toggle_addcomments();

                        update_mtime(revid, data['time']);
                    },
                    function (errormsg) {
                        alert(errormsg);
                    });
}


// This function when ESC is pressed while in the editbox
function clear_comment() {

    var textfield = getobject('commentfield');
    textfield.value = '';
    textfield.blur();
}


// Add/remove an objective to/from the favourite list
function toggle_favourite(revisionid, objectiveid, curriculum, action, element) {

    var urlparams = 'objectiveid=' + objectiveid
        + '&revisionid=' + revisionid
        + '&curriculum=' + curriculum
        + '&action=' + action;

    sendjsonrequest('revision.json.php', urlparams,
                    function (data) {
                        if ('addtofav' == action) {
                            // Fix focus
                            if (element) {
                                element.focus();
                                element.blur();
                            }

                            var addtofavbutton = getobject('addtofav' + objectiveid);

                            var favouritelist = getobject('favourites' + curriculum);
                            favouritelist.innerHTML = data['data'];

                            // Swap the "star" buttons
                            var delfromfavbutton = getobject('delfromfav' + objectiveid);
                            delfromfavbutton.style.display = '';
                            addtofavbutton.style.display = 'none';

                            var searchaddtofavbutton = getobject('searchaddtofav' + objectiveid);
                            if (searchaddtofavbutton){
                                searchaddtofavbutton.style.display = 'none';
                            }
                            var searchdelfromfavbutton = getobject('searchdelfromfav' + objectiveid);
                            if (searchdelfromfavbutton){
                                searchdelfromfavbutton.style.display = '';
                            }
                        }
                        else if ('delfromfav' == action) {
                            var delfromfavbutton = getobject('delfromfav' + objectiveid);
                            var delfavbutton = getobject('delfromfav' + objectiveid);

                            // Fix focus
                            if (delfromfavbutton) {
                                delfromfavbutton.focus();
                                delfromfavbutton.blur();
                            }
                            else if (delfavbutton) {
                                delfavbutton.focus();
                                delfavbutton.blur();
                            }

                            var favouritelist = getobject('favourites' + curriculum);
                            favouritelist.innerHTML = data['data'];

                            // Swap the "star" buttons
                            var addtofavbutton = getobject('addtofav' + objectiveid);
                            addtofavbutton.style.display = '';
                            delfromfavbutton.style.display = 'none';

                            var searchaddtofavbutton = getobject('searchaddtofav' + objectiveid);
                            if (searchaddtofavbutton){
                                searchaddtofavbutton.style.display = '';
                            }
                            var searchdelfromfavbutton = getobject('searchdelfromfav' + objectiveid);
                            if (searchdelfromfavbutton){
                                searchdelfromfavbutton.style.display = 'none';
                            }
                        }
                    },
                    function (errormsg) {
                        alert(errormsg);
                    });
}

function toggle_addcomments() {
    var divob = getobject('commentsadd');
    if (divob) {
        var invis = (divob.style.display == "none");
        if (invis) {
            divob.style.display = '';
            var field = getobject('commentfield');
            field.focus();
        }
        else {
            divob.style.display = 'none';
        }
    }
}
