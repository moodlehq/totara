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

        var height = $(window).height() * 0.8;

        var default_config = {
            autoOpen: false,
            closeOnEscape: true,
            draggable: false,
            height: height,
            width: '700px',
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

        // fix for IE6 select z-index bug
        if($.browser.msie && parseInt($.browser.version) == 6) {
            $('.ui-dialog').bgiframe();
        }
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

        // Get dialog parent
        var par = this.dialog.parent();

        // Set dialog body height (the 20px is the margins above and below the content)
        var height = par.height() - $('div.ui-dialog-titlebar', par).height() - $('div.ui-dialog-buttonpane', par).height() - 36;
        this.dialog.height(height);

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

        var html_message = '';
        if (response) {
            html_message = response;
        } else {
            // Print a generic error message
            html_message = '<div class="box errorbox errorboxcontent">An error has occured</div>';
        }
        dialog.dialog.html(html_message);
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
        this.bindForms();

        // Run setup function
        this.handler._load();

        // Run partial update function
        if (outputelement && this.handler._partial_load != undefined) {
            this.handler._partial_load(outputelement);
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

            // don't bind links if any parent has dialog-nobind class
            if ($(this).parents('.dialog-nobind').length != 0) {
                return;
            }
            // Check this is not a help popup link
            if ($(this).parent().is('span.helplink')) {
                return;
            }

            $(this).bind('click', function(e) {
                var url = $(this).attr('href');
                // if the link is inside an element with the
                // dialog-load-within class set, load the results in
                // that element instead of reloading the whole dialog
                //
                // if there is more than one parent with the class set,
                // loads in the most specific one
                var target = $(this).parents('.dialog-load-within').slice(0,1);
                if(target.length != 0) {
                    dialog.showLoading();
                    dialog._request(url, null, null, null, target);
                } else {
                    // otherwise, load in the whole dialog
                    dialog.load(url, 'GET');
                }

                // Stop any default event occuring
                e.preventDefault();

                return false;
            });
        });
    }


    /**
     * Bind this.navigate to any form submissions in the dialog
     * @return void
     */
    this.bindForms = function() {

        var dialog = this;

        // Bind dialog.load to any links in the dialog
        $('form', this.dialog).each(function() {

            $(this).bind('submit', function(e) {
                var action = $(this).attr('action');
                var sep = (action.indexOf('?') == -1 ) ? '?' : '&';
                var url = action + sep + $(this).serialize();

                // if the form is inside an element with the
                // 'dialog-load-within' class set, load the results in
                // that element instead of reloading the whole dialog
                //
                // if there is more than one parent with the class set,
                // loads in the most specific one
                var target = $(this).parents('.dialog-load-within').slice(0,1);
                if(target.length != 0) {
                    dialog.showLoading();
                    dialog._request(url, null, null, null, target);
                } else {
                    // if no target set, reload whole dialog
                    dialog.load(url, $(this).attr('method'));
                }

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
                dialog.error(dialog, o.responseText, url);
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
    var elements = $('.selected > div > span', this._container);
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
    if (url.indexOf('&frameworkid=') == -1 || url.indexOf('?frameworkid=') == -1) {
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

    this._dialog._request(url, this, '_load', undefined, $('#browse-tab .treeview', this._container));
}


/*****************************************************************************/
/** totaraDialog_handler_treeview **/

totaraDialog_handler_treeview = function() {};

totaraDialog_handler_treeview.prototype = new totaraDialog_handler();


/**
 * Setup tabs
 *
 * Sets heights of treeviews, sets focus
 *
 * @return void
 */
totaraDialog_handler_treeview.prototype.setup_tabs = function(e, ui) {

    // Resize treeview containers if we haven't already
    // Get container
    var selcontainer = $('td.select', this._container);

    // Get container height minus height of header, height of tab bar
    var containerheight = selcontainer.outerHeight() - $('div.header', selcontainer).outerHeight() - $('div#dialog-tabs', selcontainer).outerHeight();

    // Resize browse treeview, minus padding
    $('div#browse-tab ul.treeview', this._container).height(containerheight - $('select.simpleframeworkpicker', this._container).outerHeight() - 10);

    // Resize search container
    $('div#search-tab ul.treeview', this._container).height(containerheight - $('#search-tab #mform1', selcontainer).outerHeight() - $('div.search-paging', this._container).outerHeight() - 18);

    // If showing search tab, focus search box
    if (ui && ui.index == 1) {
        $('div#search-tab #dialog-search-table #id_query', this._container).focus();
    }
}


/**
 * Setup tab, treeview infrastructure on first load
 *
 * @return void
 */
totaraDialog_handler_treeview.prototype.first_load = function() {

    var handler = this;

    // Setup treeview
    $('.treeview', this._container).treeview({
        prerendered: true
    });

    // Setup tabs
    $('#dialog-tabs').tabs(
        {
            selected: 0,
            show: handler.setup_tabs
        }
    );

    // Set heights of treeviews
    this.setup_tabs();

    // Setup framework picker
    $('.simpleframeworkpicker', this._container).unbind('change');  // Unbind any previous events
    $('.simpleframeworkpicker', this._container).change(function() {
        handler._set_framework();
    });

    // Setup hierarchy
    this._make_hierarchy($('.treeview', this._container));

    // Disable selected item's anchors
    $('.selected > div > span a', this._container).unbind('click')
    .click(function(e) {
        e.preventDefault();
    });
}


/**
 * Setup treeview infrastructure on partial page loads
 *
 * @return void
 */
totaraDialog_handler_treeview.prototype._partial_load = function(parent_element) {

    // Set heights of treeviews
    this.setup_tabs();

    // Render treeview
    $('.treeview', parent_element).treeview({
        prerendered: true
    });

    // Setup hierarchy
    this._make_hierarchy($('.treeview', parent_element));

    // Disable selected item's anchors
    $('.selected > div > span a', parent_element).unbind('click')
    .click(function(e) {
        e.preventDefault();
    });
}

/**
 * Setup hierarchy click handlers
 *
 * @return void
 */
totaraDialog_handler_treeview.prototype._make_hierarchy = function(parent_element) {
    var handler = this;

    // Load children on parent click
    $('span.folder, div.hitarea', parent_element).one('click', function() {

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

    // Make any unclickable items truely unclickable
    $('span.unclickable', parent_element).each (function() {
        handler._toggle_items($(this).attr('id'), false);
    });

    // Make currently selected items unclickable
    $('.selected > div > span', this._container).each(function() {
        // If item in hierarchy, make unclickable
        var id = $(this).attr('id');
        handler._toggle_items(id, false);
    });
}

/**
 * @param string    HTML response
 * @param int       Parent id
 * @return void
 */
totaraDialog_handler_treeview.prototype._update_hierarchy = function(response, parent_id) {

    var items = response;
    var list = $('#browse-tab .treeview li#item_list_'+parent_id+' ul:first', this._container);

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
 * Toggle selectability of treeview items
 *
 * @param id
 * @param bool  True for clickable, false for unclickable
 * @return void
 */
totaraDialog_handler_treeview.prototype._toggle_items = function(elid, type) {

    var handler = this;

    // Get elements from treeviews
    var selectable_spans = $('.treeview', this._container).find('span#'+elid);

    if (type) {
        selectable_spans.removeClass('unclickable');
        selectable_spans.addClass('clickable');
        if (handler._make_selectable != undefined) {
            selectable_spans.each(function(i, element) {
                handler._make_selectable($('.treeview', handler._container));
            });
        }
    }
    else {
        selectable_spans.removeClass('clickable');
        selectable_spans.addClass('unclickable');

        // Disable the anchor
        $('a', selectable_spans).unbind('click');
        $('a', selectable_spans).click(function(e) {
            e.preventDefault();
        });
    }
}

/**
 * Bind click event to elements, i.e to make them deletable
 *
 * @parent element
 * @return void
 */
totaraDialog_handler_treeview.prototype._make_deletable = function(parent_element) {
    var deletables = $('.deletebutton', parent_element);
    var handler = this;

    // Bind event to delete button
    deletables.unbind('click');
    deletables.click(function() {
        // Get the span element, containing the clicked button
        var span_element = $(this).parent();

        // Make sure removed element is now selectable in treeview
        handler._toggle_items(span_element.attr('id'), true);

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

        // Wrap item in a div
        var wrapped = $('<div></div>').append(clone);

        // Append item clone to selected items
        selected_area.append(wrapped);

        // Disable anchor
        $('a', wrapped).click(function(e) {
            e.preventDefault();
        });

        // Scroll to show newly added item
        selected_area.scrollTop(selected_area.children().slice(-1).position().top);

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

    // Make decending spans assignable
    this._make_selectable($('.treeview', this._container));

    // Make spans in selected pane deletable
    this._make_deletable($('.selected', this._container));
}


/**
 * Setup treeview infrastructure on partial page loads
 *
 * @return void
 */
totaraDialog_handler_treeview_multiselect.prototype._partial_load = function(parent_element) {

    // Call parent method
    totaraDialog_handler_treeview.prototype._partial_load.call(this);

    // Setup selectables and deletables
    this.every_load();
}


/**
 * Bind hover/click event to elements, to make them selectable
 *
 * @parent element
 * @return void
 */
totaraDialog_handler_treeview_multiselect.prototype._make_selectable = function(parent_element) {

    // Get assignable/clickable elements
    var selectable_items = $('span.clickable', parent_element);
    var handler = this;

    // Unbind anchors
    var anchors = $('span.clickable a', parent_element).unbind();

    // Bind click handler to selectable items
    selectable_items.unbind('click');
    selectable_items.one('click', function() {

        var clicked = $(this);
        handler._append_to_selected(clicked);

        // Make selected element unselectable
        handler._toggle_items(clicked.attr('id'), false);

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

    // Setup dialog
    totaraDialog_handler_treeview.prototype.first_load.call(this);

    this._set_current_selected();
}

/**
 * Setup treeview and click infrastructure
 *
 * @return void
 */
totaraDialog_handler_treeview_singleselect.prototype.every_load = function() {

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

    $('#treeview_selected_text_'+this._title).text(current_text);
    $('#treeview_selected_val_'+this._title).val(current_val);

    if (current_val != 0) {
        $('#treeview_currently_selected_span_'+this._title).css('display', 'inline');
        this._toggle_items('item_'+current_val, false);
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
    var selected_val = $('#treeview_selected_val_'+this._title).val();
    // Get selected text
    var selected_text = $('#treeview_selected_text_'+this._title).text();

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
    var selectables = $('span.clickable', parent_element);
    var dialog = this;

    // Unbind anchors
    var anchors = $('span.clickable a', parent_element).unbind();

    // Stop parents expanding when clicking the title
    selectables.unbind('click');

    if (this.dualpane) {
        selectables.click(function() {

            var clicked = $(this);

            $('.treeview span.unclickable', dialog._container).addClass('clickable');
            $('.treeview span.unclickable', dialog._container).removeClass('unclickable');
            dialog._toggle_items($(this).attr('id'), false);

            var clicked_id = clicked.attr('id').split('_');
            clicked_id = clicked_id[clicked_id.length-1];  // The last item is the actual id
            clicked.attr('id', clicked_id);

            // Check for new-style clickhandlers
            if (dialog.handle_click != undefined) {
                dialog.handle_click($(this));
            }

            return false;
        });

        return;
    }

    // Bind click handler to selectables
    selectables.click(function() {

        var item = $(this);
        var clone = item.clone();

        $('.treeview span.unclickable', dialog._container).addClass('clickable');
        $('.treeview span.unclickable', dialog._container).removeClass('unclickable');
        dialog._toggle_items($(this).attr('id'), false);

        $('#treeview_selected_text_'+dialog._title).html($('a', clone).html());
        var selected_id = clone.attr('id').split('_')[1];
        $('#treeview_selected_val_'+dialog._title).val(selected_id);

        // Make sure the info is displayed
        $('#treeview_currently_selected_span_'+dialog._title).css('display', 'inline');

        return false;
    });

    // Make currently selected item unclickable
    dialog._toggle_items('item_' + $('#treeview_selected_val_'+dialog._title).val(), false);
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
 * Update the hierarchy
 *
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

            // Make selected element unselectable; remove addbutton
            $(this).parents('span:first').attr('class', 'unclickable');
            $(this).html('');
        });
    }

}

/*****************************************************************************/
/** Factory methods **/

/**
 * Setup single-select treeview dialog that calls a handler on click
 *
 * @param string dialog name
 * @param string dialog title
 * @param string find page url
 * @param string value_element bound to this dialog (value will be updated after dialog selection)
 * @param string text_element bound to this dialog (text will be updated after dialog selection)
 * @param function handler_extra extra code to be executed with handler
 * @return void
 */
totaraSingleSelectDialog = function(name, title, find_url, value_element, text_element, handler_extra) {

    var handler = new totaraDialog_handler_treeview_singleselect(value_element, text_element);
    handler.external_function = handler_extra;

    totaraDialogs[name] = new totaraDialog(
        name,
        'show-'+name+'-dialog',
        {
            buttons: {
                'Cancel': function() { handler._cancel() },
                'Ok': function() { handler._save(); }
            },
            title: '<h2>'+title+'</h2>'
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
 * @param string dialog title
 * @param string find page url
 * @param string save page url
 * @return void
 */
totaraMultiSelectDialog = function(name, title, find_url, save_url) {

    var handler = new totaraDialog_handler_treeview_multiselect();

    totaraDialogs[name] = new totaraDialog(
        name,
        'show-'+name+'-dialog',
        {
            buttons: {
                'Cancel': function() { handler._cancel() },
                'Ok': function() { handler._save(save_url) }
            },
            title: '<h2>'+title+'</h2>'
        },
        find_url,
        handler
    );
}
