// Temp fix to sniff browser
$(function() {
    if ($.browser.mozilla) {
        $('body').addClass('mozilla');
    }
});


// Setup
var totaraDialogs = {};

// Dialog object
function totaraDialog(title, buttonid, config, default_url, handler) {

    /**
     * ID of dialog
     */
    this.title = title;

    /**
     * ID of open button
     */
    this.buttonid = buttonid;

    /**
     * Dialog widget instance
     */
    this.dialog;

    /**
     * Default URL
     */
    this.default_url = default_url;

    /**
     * Currently loaded URL
     */
    this.url = '';

    /**
     * Custom configuration
     */
    this.config = config;

    /**
     * Handler class
     */
    this.handler = handler;

    /**
     * Setup this dialog
     * @return  void
     */
    this.setup = function() {

        var default_config = {
            autoOpen: false,
            closeOnEscape: true,
            draggable: false,
            height: 350,
            width: 705,
            modal: true,
            resizable: false,
            zIndex: 1500,
            dialogClass: 'totara-dialog'
        };

        // Instantiate the Dialog
        $('<div class="totara-dialog" style="display: none;"><div id="'+this.title+'"></div></div>').appendTo($('body'));

        this.dialog = $('#'+this.title).dialog(
            $.extend(default_config, this.config)
        );

        // Setup handler
        if (this.handler != undefined) {
            this.handler._setup(this);
        }

        // Set up obj for closure
        var obj = this;

        // Bind open event to button
        $('#'+this.buttonid).click(function(event) {

            // Stop any default event occuring
            event.preventDefault();

            // Open default url
            obj.open();
        });
    }


    /**
     * Open dialog and load external page
     * @return  void
     */
    this.open = function() {
        // Open default url in dialog
        var url = this.default_url;
        var method = 'GET';

        this.dialog.html('');
        this.dialog.dialog('open');

        // Override some auto defined styling
        this.dialog.parent().css({ height: '400px' });
        this.dialog.css({ height: '360px', width: '705px' });

        this.load(url, method);
    }


    /**
     * Load an external page in the dialog
     * @param   string      Url of page
     * @param   string      Page fetch method, POST or GET
     * @param   function    Optional function to run on success
     * @return  void
     */
    this.load = function(url, method, onsuccess) {
        // Add loading animation
        this.dialog.html('');
        this.showLoading();

        // Save url
        this.url = url;

        // Load page
        this._request(this.url);
    }


    /**
     * Display error information
     * @param   object  dialog object
     * @param   string  ajax response
     * @param   string  url
     * @return  void
     */
    this.error = function(dialog, response, url) {
        // Hide loading animation
        dialog.hideLoading();

        var message = 'An error has occured';
        dialog.dialog.html('<div class="box errorbox errorboxcontent">'+message+'</div>');
    }


    /**
     * Render dialog and contents
     * @param string o             asyncRequest response
     * @param object outputelement (optional) element in which output should be generated
     * @return void
     */
    this.render = function(o, outputelement) {
        // Hide loading animation
        this.hideLoading();

        if (outputelement) {
            // Render the output in the specified element
            outputelement.html(o);
        } else {
            // Just reload the whole dialog
            this.dialog.html(o);
        }

        this.bindLinks();

        // Run new style setup function
        if (this.handler != undefined) {
            this.handler._load();
        }
    }


    /**
     * Bind this.navigate to any links in the dialog
     * @return void
     */
    this.bindLinks = function() {

        var dialog = this;

        // Bind dialog.load to any links in the dialog
        $('a', this.dialog).each(function() {

            // Check this is not a help popup link
            if ($(this).parent().is('span.helplink')) {
                return;
            }

            $(this).one('click', function(e) {
                dialog.load($(this).attr('href'), 'GET');

                // Stop any default event occuring
                e.preventDefault();

                return false;
            });
        });
    }


    /**
     * Show loading animation
     * @return void
     */
    this.showLoading = function() {
        $('div#'+this.title).addClass('yui-isloading');
    }


    /**
     * Hide loading animation
     * @return void
     */
    this.hideLoading = function() {
        $('div#'+this.title).removeClass('yui-isloading');
    }


    /**
     * Hide dialog
     * @return void
     */
    this.hide = function() {
        this.handler._loaded = false;
        this.dialog.html('');
        this.dialog.dialog('close');
    }


    /**
     * Make an HTTP request
     *
     * Optionally pass an object and method name to be called on success.
     * This method is passed the HTML response, and optionally the data variable.
     *
     * If no object/method name are passed, or they return 'true' - the dialog.render
     * method is called on success also.
     *
     * @param string    request url
     * @param object    Object to call on success (optional)
     * @param string    Object's method name to call on success (optional)
     * @param mixed     extra data to send to success method (optional)
     * @param object outputelement (optional) element in which request output should be generated
     */
    this._request = function(url, s_object, s_method, data, outputelement) {

        var dialog = this;

        $.ajax({
            url: url,
            type: 'GET',
            success: function(o) {

                var result = true;

                // Check the result of onsuccess
                // If false, do not run the render method
                if (s_object != undefined) {
                    result = s_object[s_method](o, data);
                }

                if (result) {
                    dialog.render(o, outputelement);
                }
            },
            error: function(o) {
                dialog.error(dialog, o, url);
            }
        });
    }


    // Setup object
    this.setup();
}


/*****************************************************************************/
/** totaraDialog_handler **/

function totaraDialog_handler() {

    // Reference to the yuiDialog object
    var _dialog;

    // Dialog title/name
    var _title;

    // Dialog container
    var _container;

    // Has the dialog loaded its first page?
    var _loaded = false;
}

/**
 * Setup the dialog handler
 * Run when the dialog is constructed
 *
 * @param yuiDialog dialog object
 * @return void
 */
totaraDialog_handler.prototype._setup = function(dialog) {
    this._dialog = dialog;
    this._title = dialog.title;
}

/**
 * Run on page load
 * Calls this.first_load() on first page load
 *
 * @param yuiDialog dialog object
 * @return void
 */
totaraDialog_handler.prototype._load = function(dialog) {

    // First page load
    if (!this._loaded) {

        // Setup container
        this._container = $('#'+this._title);

        // Run decendant method
        if (this.first_load != undefined) {
            this.first_load();
        }

        this._loaded = true;
    }

    // Run decendant method
    if (this.every_load != undefined) {
        this.every_load();
    }

    return true;
}

/**
 * Add a row to a table on the calling page
 * Also hides the dialog and any no item notice
 *
 * @param string    HTML response
 * @return void
 */
totaraDialog_handler.prototype._update = function(response) {

    // Hide dialog
    this._dialog.hide();

    // Remove no item warning (if exists)
    $('.noitems-'+this._title).remove();

    // Sometimes we want to have two dialogs changing the same table,
    // so here we support tagging tables by id, or class
    var table = $('table#list-'+this._title);

    // If no table found by ID
    if (table.size() < 1) {
        table = $('table.list-'+this._title);
    }

    if (response.search(/~~~RELOAD PAGE~~~/) > 0 || table.size() < 1) {
        // Reload the page
        if ($('#middle-column').size()) {
            $('#middle-column').html('<p><strong>Loading...</strong></p>');
        } else {
            $('#content').html('<p><strong>Loading...</strong></p>');
        }

        location.reload();
        return;
    }

    // Add row(s) to table
    $('tbody', table).append(response);
}


/**
 * Utility function for getting ids from
 * a list of elements
 *
 * @param jQuery jquery element list
 * @param string ID prefix string
 * @return array
 */
totaraDialog_handler.prototype._get_ids = function(elements, prefix) {

    var ids = [];

    // Loop through elements
    elements.each(
        function (intIndex) {

            // Get id attr
            var id = $(this).attr('id').split('_');
            id = id[id.length-1];  // The last item is the actual id

            // Append to list
            ids.push(id);
        }
    );

    return ids;
}

/**
 * Serialize dropped items and send to url,
 * update table with result
 *
 * @param string URL to send dropped items to
 * @return void
 */
totaraDialog_handler.prototype._save = function(url) {

    // Serialize data
    var elements = $('.selected span', this._container);
    var selected_str = this._get_ids(elements).join(',');

    // Add to url
    url = url + selected_str;

    // Send to server
    this._dialog._request(url, this, '_update');
}

/**
 * Handle a 'cancel' request, by just closing the dialog
 *
 * @return void
 */
totaraDialog_handler.prototype._cancel = function() {
    this._dialog.hide();
    return;
}


/**
 * Change framework
 *
 * @return void
 */
totaraDialog_handler.prototype._set_framework = function() {

    // Get currently selected option
    var selected = $('.simpleframeworkpicker option:selected', this._container).val();

    // Update URL
    var url = this._dialog.url;

    // See if framework specific
    if (url.indexOf('frameworkid=') == -1) {
        // Only return tree html
        url = url + '&frameworkid=' + selected + '&treeonly=1';
    } else {
        // Get start of frameworkid
        var start = url.indexOf('frameworkid=') + 12;

        // Find how many characters long the value is
        var end = url.indexOf('&', start);

        // If no following &, it is the end of the url
        if (end == -1) {
            url = url.substring(0, start) + selected;
        // Just replace the value
        } else {
            url = url.substring(0, start) + selected + url.substring(end);
        }
    }

    this._dialog.showLoading();  // Show loading icon and then perform request

    this._dialog._request(url, this, '_load', undefined, $('.treeview', this._container));
}


/*****************************************************************************/
/** totaraDialog_handler_treeview **/

totaraDialog_handler_treeview = function() {};
totaraDialog_handler_treeview.prototype = new totaraDialog_handler();

/**
 * Setup a treeview infrastructure
 *
 * @return void
 */
totaraDialog_handler_treeview.prototype.every_load = function() {

    // Setup treeview
    $('.treeview', this._container).treeview({
        prerendered: true
    });

    var handler = this;
    // Setup framework picker
    $('.simpleframeworkpicker', this._container).unbind('change');  // Unbind any previous events
    $('.simpleframeworkpicker', this._container).change(function() {
        handler._set_framework();
    });

    // Setup hierarchy
    this._make_hierarchy($('.treeview', this._container));
}

/**
 * Setup hierarchy click handlers
 *
 * @return void
 */
totaraDialog_handler_treeview.prototype._make_hierarchy = function(parent_element) {
    var handler = this;

    // Load children on parent click
    $('span.folder, div.hitarea', parent_element).click(function() {

        // Get parent
        var par = $(this).parent();

        // Check this category doesn't have any children already
        if ($('> ul > li', par).size()) {
            return false;
        }

        // Id in format item_list_XX
        var id = par.attr('id').substr(10);

        var url = handler._dialog.url+'&parentid='+id;
        handler._dialog._request(url, handler, '_update_hierarchy', id);

        return false;
    });
}

/**
 * @param string    HTML response
 * @param int       Parent id
 * @return void
 */
totaraDialog_handler_treeview.prototype._update_hierarchy = function(response, parent_id) {

    var items = response;
    var list = $('.treeview li#item_list_'+parent_id+' ul:first', this._container);

    // Remove all existing children
    $('li', list).remove();

    // Add items
    $('.treeview', this._container).treeview({add: list.append($(items))});

    // Setup new items
    this._make_hierarchy(list);

    if (this._handle_update_hierarchy != undefined) {
        this._handle_update_hierarchy(list);
    }
}

/**
 * Bind click event to elements, i.o to make them deletable
 *
 * @parent element
 * @return void
 */
totaraDialog_handler_treeview.prototype._make_deletable = function(parent_element) {
    var deletables = $('.deletebutton', parent_element).closest('td');
    var del_span_elements = deletables.closest('span');
    var handler = this;

    // Bind hover handlers to button parent
    del_span_elements.mouseenter(function() {
        $(".deletebutton", this._container).css("display", "none");
        $(this).find(".deletebutton").css('display', 'inline');

        return false;

    });
    del_span_elements.mouseleave(function() {
        $(this).find(".deletebutton").css('display', 'none');

        return false;
    });

    // Bind event to delete button
    deletables.unbind('click');
    deletables.click(function() {
        // Get the span element, containing the clicked button
        var span_element = $(this).closest('span');

        // Make sure removed element is now selectable in treeview
        var selectable_span = $('.treeview').find('span#'+span_element.attr('id'));
        var addbutton = $('#addbutton_ex:first', '.treeview').clone();
        addbutton.removeAttr('id');
        selectable_span.removeClass('unclickable');
        selectable_span.find('.list-item-action').html(addbutton);
        if (handler._make_selectable != undefined) {
            handler._make_selectable($('.treeview', this._dialog), selectable_span);
        }

        // Finally, remove the span element from the selected pane
        span_element.remove();

        return false;
    });
}

/**
 * @param object element the element to append
 * @return void
 */
totaraDialog_handler_treeview.prototype._append_to_selected = function(element) {
    var clone = element.closest('span').clone();  // Make a clone of the list item
    var selected_area = $('.selected', this._container)

    // Check if an element with the same ID already exists
    if ($('#'+clone.attr('id'), selected_area).size() < 1) {
        // First, remove addbutton from clone and add delete button
        clone.find('.addbutton').remove();
        deletebutton = $('#deletebutton_ex:first').clone();
        clone.find('.list-item-action').append(deletebutton);

        deletebutton.unbind('click');

        // Bind hover handlers to clone
        clone.mouseenter(function() {
            $(".deletebutton", this._container).css("display", "none");
            $(this).find(".deletebutton").css('display', 'inline');

        });
        clone.mouseleave(function() {
            $(this).find(".deletebutton").css('display', 'none');
        });

        // Append item clone to selected items
        selected_area.append(clone);

        // Make all selected items deletable
        this._make_deletable(selected_area);
    }
}



/*****************************************************************************/
/** totaraDialog_handler_treeview_multiselect **/

totaraDialog_handler_treeview_multiselect = function() {};
totaraDialog_handler_treeview_multiselect.prototype = new totaraDialog_handler_treeview();

/**
 * Setup treeview and drag/drop infrastructure
 *
 * @return void
 */
totaraDialog_handler_treeview_multiselect.prototype.every_load = function() {

    // Setup treeview
    totaraDialog_handler_treeview.prototype.every_load.call(this);

    // Make decending spans assignable
    this._make_selectable($('.treeview', this._container));

    // Make spans in selected pane deletable
    this._make_deletable($('.selected', this._container));
}

/**
 * Bind hover/click event to elements, i.o to make them selectable
 *
 * @parent element
 * @return void
 */
totaraDialog_handler_treeview_multiselect.prototype._make_selectable = function(parent_element) {
    // Get assignable/clickable elements
    var selectable_items = $('span:not(.unclickable)', parent_element);
    var handler = this;

    // Bind hover handlers
    selectable_items.mouseenter(function() {
        $(".addbutton", this._container).css("display", "none");
        $(this).find(".addbutton").css('display', 'inline');

        return false;
    });
    selectable_items.mouseleave(function() {
        $(this).find(".addbutton").css('display', 'none');

        return false;
    });

    var assignable_buttons = $('.list-item-action', parent_element);

    assignable_buttons.unbind('click');

    // Bind click handler to add icons
    assignable_buttons.click(function() {

        var clicked = $(this);
        handler._append_to_selected(clicked);

        return false;
    });

}

/**
 * Hierarchy update handler
 *
 * @param element
 * @return void
 */
totaraDialog_handler_treeview_multiselect.prototype._handle_update_hierarchy = function(parent_element) {
    this._make_selectable(parent_element);
}


/*****************************************************************************/
/** totaraDialog_handler_treeview_singleselect **/

totaraDialog_handler_treeview_singleselect = function(value_element_name, text_element_id, dualpane) {

    // Can hold an externally assigned function
    var external_function;

    this.value_element_name = value_element_name;
    this.text_element_id = text_element_id;

    // Use 2 panes in the dialog for getting to the selection items
    if (dualpane != 'undefined') {
        this.dualpane = dualpane
    } else {
        this.dualpane=false;
    }
};

totaraDialog_handler_treeview_singleselect.prototype = new totaraDialog_handler_treeview();

/**
 * Hierarchy update handler
 *
 * @param element
 * @return void
 */
totaraDialog_handler_treeview_singleselect.prototype._handle_update_hierarchy = function(parent_element) {
    this._make_selectable(parent_element);
}

/**
 * Setup run this on first load
 *
 * @return void
 */
totaraDialog_handler_treeview_singleselect.prototype.first_load = function() {
    this._set_current_selected();
}

/**
 * Setup treeview and click infrastructure
 *
 * @return void
 */
totaraDialog_handler_treeview_singleselect.prototype.every_load = function() {

    // Setup treeview
    totaraDialog_handler_treeview.prototype.every_load.call(this);

    this._make_selectable($('.treeview', this._container));
    //this._set_current_selected();
}

totaraDialog_handler_treeview_singleselect.prototype._set_current_selected = function() {
    var current_val = $('input[name='+this.value_element_name+']').val();
    var current_text = $('#'+this.text_element_id).text();
    if (!(current_val && current_text)) {
        current_val = 0;
        current_text = 'None';
    }

    $('#treeview_selected_text').text(current_text);
    $('#treeview_selected_val').val(current_val);

    if (current_val != 0) {
        $('#treeview_currently_selected_span').css('display', 'inline');
    }
}

/**
 * Take clicked/selected item and
 * either update specified element(s)
 *
 * @param string element name to update value
 * @param string element id to update text (optional)
 * @return void
 */
totaraDialog_handler_treeview_singleselect.prototype._save = function() {

    // Get selected id
    var selected_val = $('#treeview_selected_val', this._container).val();
    // Get selected text
    var selected_text = $('#treeview_selected_text').text();

    // Update value element
    if (this.value_element_name) {
        $('input[name='+this.value_element_name+']').val(selected_val);
    }

    // Update text element
    if (this.text_element_id) {
        $('#'+this.text_element_id).text(selected_text);
    }

    if (this.external_function) {
        // Execute the extra function
        this.external_function();
    }

    this._dialog.hide();
}


/**
 * Make elements run the clickhandler when clicked
 *
 * @parent element
 * @return void
 */
totaraDialog_handler_treeview_singleselect.prototype._make_selectable = function(parent_element) {

    // Get selectable/clickable elements
    var selectables = $('span:not(.empty)', parent_element);
    var dialog = this;

    selectables.addClass('clickable');

    if (this.dualpane) {
        selectables.click(function() {

            var clicked = $(this);

            var clicked_id = clicked.attr('id').split('_');
            clicked_id = clicked_id[clicked_id.length-1];  // The last item is the actual id
            clicked.attr('id', clicked_id);

            // Check for new-style clickhandlers
            if (dialog.handle_click != undefined) {
                dialog.handle_click($(this));
            }
        });

        return;
    }

    // Bind click handler to selectables
    selectables.click(function() {

        var item = $(this);
        var clone = item.clone();

        $('#treeview_selected_text').html(clone.find('.list-item-name').html());
        var selected_id = clone.attr('id').split('_')[1];
        $('#treeview_selected_val').val(selected_id);

        // Make sure the info is displayed
        $('#treeview_currently_selected_span').css('display', 'inline');
    });

}

/*****************************************************************************/
/** totaraDialog_handler_skeletalTreeview **/

totaraDialog_handler_skeletalTreeview = function() {};
totaraDialog_handler_skeletalTreeview.prototype = new totaraDialog_handler_treeview();

/**
 * Setup a treeview infrastructure
 *
 * @return void
 */
totaraDialog_handler_skeletalTreeview.prototype.every_load = function() {

    // Setup treeview
    $('.treeview', this._container).treeview({
        prerendered: true
    });

    var handler = this;

    // Setup framework picker if one exists
    $('.simpleframeworkpicker', this._container).unbind('change');  // Unbind any previous events
    $('.simpleframeworkpicker', this._container).change(function() {
        handler._set_framework();
    });

    // Setup hierarchy
    this._make_hierarchy($('.treeview', this._container));

    // Make spans in selected pane deletable
    this._make_deletable($('.selected', this._container));
}

/**
 * Setup hierarchy click handlers
 *
 * @return void
 */
totaraDialog_handler_skeletalTreeview.prototype._make_hierarchy = function(parent_element) {
    var handler = this;

    // Load courses on parent click
    $('span.folder, div.hitarea', parent_element).click(function() {

        // Get parent
        var par = $(this).parent();

        // If we have just collapsed this branch, don't reload stuff
        if ($('li:visible', $(par)).size() == 0) {
            return false;
        }

        // Check to see if the loading placeholder exists
        if ($('> ul > li.loading', par).size() == 0) {
            return false;
        }

        // Id in format item_list_XX
        var id = par.attr('id').substr(10);

        // To be overridden in child classes
        handler._handle_hierarchy_expand(id);

        return false;
    });
}

/**
 * @param string    HTML response
 * @param int       Parent id
 * @return void
 */
totaraDialog_handler_skeletalTreeview.prototype._update_hierarchy = function(response, parent_id) {

    var items = response;
    var list = $('.treeview li#item_list_'+parent_id+' ul:first', this._container);

    // Remove placeholder child
    $('> li.loading', list).remove();

    // Add items
    $('.treeview', this._container).treeview({add: list.append($(items))});

    var handler = this;

    handler._make_selectable(list, false);
}

/**
* @param object element to make selectable
* @return void
*/
totaraDialog_handler_skeletalTreeview.prototype._make_selectable = function(elements, addclickable) {
    var handler = this;

    if (addclickable) {
        addclickable.addClass('clickable');
    }

    if (handler._handle_course_click != undefined) {
        // Bind clickable function to course
        $('span.clickable', elements).click(function() {
            var par = $(this).parent();

            // Get the id in format course_XX
            var id = par.attr('id').substr(7);

            // To be overridden in child classes
            handler._handle_course_click(id);
        });
    } else {
        // Bind hover handlers to clickable items
        $('span.clickable', elements).parent().mouseenter(function() {
            $('.addbutton', this._container).css("display", "none");
            $(this).find('.addbutton').css('display', 'inline');
        });
        $('span.clickable', elements).parent().mouseleave(function() {
            $(this).find('.addbutton').css('display', 'none');
        });

        // Bind addbutton
        $('span.clickable', elements).find('.list-item-action').click(function() {
            // Assign id attribute to
            handler._append_to_selected($(this));
        });
    }

}

/*****************************************************************************/
/** Factory methods **/

/**
 * Setup single-select treeview dialog that calls a handler on click
 *
 * @param string dialog name
 * @param string find page url
 * @param string value_element bound to this dialog (value will be updated after dialog selection)
 * @param string text_element bound to this dialog (text will be updated after dialog selection)
 * @param function handler_extra extra code to be executed with handler
 * @return void
 */
totaraSingleSelectDialog = function(name, find_url, value_element, text_element, handler_extra) {

    var handler = new totaraDialog_handler_treeview_singleselect(value_element, text_element);
    handler.external_function = handler_extra;

    totaraDialogs[name] = new totaraDialog(
        name,
        'show-'+name+'-dialog',
        {
            buttons: {
                'Ok': function() { handler._save(); },
                'Cancel': function() { handler._cancel() }
            }
        },
        find_url,
        handler
    );
}

/**
 * Setup multi-select treeview dialog that calls a save page, and
 * prints the html response to an underlying table
 *
 * @param string dialog name
 * @param string find page url
 * @param string save page url
 * @return void
 */
totaraMultiSelectDialog = function(name, find_url, save_url) {

    var handler = new totaraDialog_handler_treeview_multiselect();

    totaraDialogs[name] = new totaraDialog(
        name,
        'show-'+name+'-dialog',
        {
            buttons: {
                'Ok': function() { handler._save(save_url) },
                'Cancel': function() { handler._cancel() }
            }
        },
        find_url,
        handler
    );
}
