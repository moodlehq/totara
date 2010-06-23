// Temp fix to sniff browser
$(function() {
    if ($.browser.mozilla) {
        $('body').addClass('mozilla');
    }
});


// Setup
var mitmsDialogs = {};

// Dialog object
function mitmsDialog(title, buttonid, config, default_url, handler) {

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
            position: [205, 'center'],
            resizable: false,
            zIndex: 1500,
            dialogClass: 'mitms-dialog'
        };

        // Instantiate the Dialog
        $('<div class="mitms-dialog" style="display: none;"><div id="'+this.title+'"></div></div>').appendTo($('body'));

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
        this.dialog.css({ height: '330px', width: '705px' });

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
     * @param   o   asyncRequest response
     * @return  void
     */
    this.render = function(o) {
        // Hide loading animation
        this.hideLoading();

        this.dialog.html(o);

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
     */
    this._request = function(url, s_object, s_method, data) {

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
                    dialog.render(o);
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
/** mitmsDialog_handler **/

function mitmsDialog_handler() {

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
mitmsDialog_handler.prototype._setup = function(dialog) {
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
mitmsDialog_handler.prototype._load = function(dialog) {

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
}

/**
 * Add a row to a table on the calling page
 * Also hides the dialog and any no item notice
 *
 * @param string    HTML response
 * @return void
 */
mitmsDialog_handler.prototype._update = function(response) {

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

    // Add row to table
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
mitmsDialog_handler.prototype._get_ids = function(elements, prefix) {

    // Set default prefix
    if (prefix == undefined) {
        var prefix = 'item_';
    }

    var ids = [];
    var prefix_length = prefix.length;

    // Loop through elements
    elements.each(
        function (intIndex) {

            // Get id attr
            var id = $(this).attr('id');

            // Check the prefix matches
            if (id.substr(0, prefix_length) != prefix) {
                return;
            }

            // Remove the prefix
            id = id.substr(prefix_length);

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
mitmsDialog_handler.prototype._save = function(url) {

    // Serialize data
    var elements = $('.selected span', this._container);
    var dropped = this._get_ids(elements).join(',');

    // Nothing dropped
    if (!dropped.length) {
        this._dialog.hide();
        return;
    }

    // Add to url
    url = url + dropped;

    // Send to server
    this._dialog._request(url, this, '_update');
}

/**
 * Handle a 'cancel' request, by just closing the dialog
 *
 * @return void
 */
mitmsDialog_handler.prototype._cancel = function() {
    this._dialog.hide();
    return;
}


/**
 * Change framework
 *
 * @return void
 */
mitmsDialog_handler.prototype._set_framework = function() {

    // Get currently selected option
    var selected = $('.simpleframeworkpicker option:selected', this._container).val();

    // Update URL
    var url = this._dialog.url;

    // See if framework specific
    if (url.indexOf('frameworkid=') == -1) {
        url = url + '&frameworkid=' + selected;
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

    this._dialog.load(url, 'GET');
}


/*****************************************************************************/
/** mitmsDialog_handler_treeview **/

mitmsDialog_handler_treeview = function() {};
mitmsDialog_handler_treeview.prototype = new mitmsDialog_handler();

/**
 * Setup a treeview infrastructure
 *
 * @return void
 */
mitmsDialog_handler_treeview.prototype.every_load = function() {

    // Setup treeview
    $('.treeview', this._container).treeview({
        prerendered: true
    });

    var handler = this;
    // Setup framework picker
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
mitmsDialog_handler_treeview.prototype._make_hierarchy = function(parent_element) {
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
mitmsDialog_handler_treeview.prototype._update_hierarchy = function(response, parent_id) {

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


/*****************************************************************************/
/** mitmsDialog_handler_treeview_multiselect **/

mitmsDialog_handler_treeview_multiselect = function() {};
mitmsDialog_handler_treeview_multiselect.prototype = new mitmsDialog_handler_treeview();

/**
 * Setup treeview and drag/drop infrastructure
 *
 * @return void
 */
mitmsDialog_handler_treeview_multiselect.prototype.every_load = function() {

    // Setup treeview
    mitmsDialog_handler_treeview.prototype.every_load.call(this);

    // Make decending spans assignable
    this._make_selectable($('.treeview', this._container));
}

/**
 * Make elements run the clickhandler when clicked
 *
 * @parent element
 * @return void
 */
mitmsDialog_handler_treeview_multiselect.prototype._make_selectable = function(parent_element) {

    // Get assignable/clickable elements
    var selectable_items = $('span:not(.unclickable)', parent_element);

    // Bind hover handler
    selectable_items.mouseenter(function() {
        $(".addbutton", this._container).css("display", "none");
        $(this).find(".addbutton").css('display', 'inline')

        return false;
    });
    
    var assignable_buttons = $('span:not(.unclickable)', parent_element).children('.addbutton');

    assignable_buttons.unbind('click');

    // Bind click handler to add icons
    assignable_buttons.click(function() {

        var clicked = $(this);
        var clone = clicked.parent().clone();  // Make a clone of the list item
        var selected_area = $('.selected', this._container)

        // Check if an element with the same ID already exists
        if ($('#'+clone.attr('id'), selected_area).size() < 1) {
            // First, remove addbutton from clone and add delete button
            clone.find('.addbutton').remove();
            deletebutton = $('#deletebutton_ex').clone();
            deletebutton.attr('style', 'display: inline;');
            clone.append(deletebutton);

            deletebutton.unbind('click');

            // Bind event to delete button
            deletebutton.click(function() {
                // Remove the button and its parent
                $(this).parent().remove();

                return false;
            });
            
            // Append item clone to selected items
            selected_area.append(clone);
        }

        return false;
    });
    
}

/**
 * Hierarchy update handler
 *
 * @param element
 * @return void
 */
mitmsDialog_handler_treeview_multiselect.prototype._handle_update_hierarchy = function(parent_element) {
    this._make_selectable(parent_element);
}


/*****************************************************************************/
/** mitmsDialog_handler_treeview_singleselect **/

mitmsDialog_handler_treeview_singleselect = function(value_element_name, text_element_id) {

    // Can hold an externally assigned function
    var external_function;

    this.value_element_name = value_element_name;
    this.text_element_id = text_element_id;
};

mitmsDialog_handler_treeview_singleselect.prototype = new mitmsDialog_handler_treeview();

/**
 * Hierarchy update handler
 *
 * @param element
 * @return void
 */
mitmsDialog_handler_treeview_singleselect.prototype._handle_update_hierarchy = function(parent_element) {
    this._make_selectable(parent_element);
}

/**
 * Setup run this on first load 
 *
 * @return void
 */
mitmsDialog_handler_treeview_singleselect.prototype.first_load = function() {
    this._set_current_selected();
}

/**
 * Setup treeview and click infrastructure
 *
 * @return void
 */
mitmsDialog_handler_treeview_singleselect.prototype.every_load = function() {

    // Setup treeview
    mitmsDialog_handler_treeview.prototype.every_load.call(this);

    this._make_selectable($('.treeview', this._container));
    this._set_current_selected();
}

mitmsDialog_handler_treeview_singleselect.prototype._set_current_selected = function() {
    var current_val = $('input[name='+this.value_element_name+']').val();
    var current_text = $('#'+this.text_element_id).text();
    if (!(current_val && current_text)) {
        current_val = 0;
        current_text = 'None';
    }

    $('#treeview_selected_text').text(current_text);
    $('#treeview_selected_val').text(current_val);
}

/**
 * Take clicked/selected item and 
 * either update specified element(s)
 *
 * @param string element name to update value
 * @param string element id to update text (optional)
 * @return void
 */
mitmsDialog_handler_treeview_singleselect.prototype._save = function() {

    // Get selected id
    var selected_val = $('#treeview_selected_val', this._container).val();
    // Get selected text
    var selected_text = $('#treeview_selected_text').text();

    // Update value element
    $('input[name='+this.value_element_name+']').val(selected_val);
    
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
mitmsDialog_handler_treeview_singleselect.prototype._make_selectable = function(parent_element) {

    // Get selectable/clickable elements
    var selectables = $('span:not(.empty)', parent_element);
    
    // Bind hover handler
    selectables.mouseenter(function() {
        $('.addbutton', this._container).css("display", "none");
        $(this).find('.addbutton').css('display', 'inline')

        return false;
    });
    
    var assignable_buttons = $('span:not(.unclickable)', parent_element).children('.addbutton');

    // Remove old handlers
    assignable_buttons.unbind('click');

    // Bind click handler to add icons
    assignable_buttons.click(function() {
        var item = $(this).parent();
        var clone = item.clone();

        // First, remove addbutton from clone and add delete button
        clone.find('.addbutton').remove();
        deletebutton = $('#deletebutton_ex').clone();
        deletebutton.attr('style', 'display: inline;');
        clone.append(deletebutton);

        deletebutton.unbind('click');

        // Bind event to delete button
        deletebutton.click(function() {
            // Remove the button and its parent
            $(this).parent().remove();
            $('#treeview_selected_val').val(0);

            return false;
        });

        $('#treeview_selected_text').html(clone);
        var selected_id = clone.attr('id').split('_')[1];
        $('#treeview_selected_val').val(selected_id);
    });
}


/*****************************************************************************/
/** mitmsDialog_handler_skeletalTreeview **/

mitmsDialog_handler_skeletalTreeview = function() {};
mitmsDialog_handler_skeletalTreeview.prototype = new mitmsDialog_handler_treeview();

/**
 * Setup a treeview infrastructure
 *
 * @return void
 */
mitmsDialog_handler_skeletalTreeview.prototype.every_load = function() {

    // Setup treeview
    $('.treeview', this._container).treeview({
        prerendered: true
    });

    var handler = this;

    // Setup hierarchy
    this._make_hierarchy($('.treeview', this._container));
}

/**
 * Setup hierarchy click handlers
 *
 * @return void
 */
mitmsDialog_handler_skeletalTreeview.prototype._make_hierarchy = function(parent_element) {
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
mitmsDialog_handler_skeletalTreeview.prototype._update_hierarchy = function(response, parent_id) {

    var items = response;
    var list = $('.treeview li#item_list_'+parent_id+' ul:first', this._container);

    // Remove placeholder child
    $('> li.loading', list).remove();

    // Add items
    $('.treeview', this._container).treeview({add: list.append($(items))});

    var handler = this;

    // Bind course names
    $('span.clickable', list).click(function() {

        // Get parent
        var par = $(this).parent();

        // Get the id in format course_XX
        var id = par.attr('id').substr(7);

        // To be overridden in child classes
        handler._handle_course_click(id);
    });
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
mitmsSingleSelectDialog = function(name, find_url, value_element, text_element, handler_extra) {

    var handler = new mitmsDialog_handler_treeview_singleselect(value_element, text_element);
    handler.external_function = handler_extra;

    mitmsDialogs[name] = new mitmsDialog(
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
mitmsMultiSelectDialog = function(name, find_url, save_url) {

    var handler = new mitmsDialog_handler_treeview_multiselect();

    mitmsDialogs[name] = new mitmsDialog(
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
