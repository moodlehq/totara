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
        this.dialog.parent().css({ height: '350px' });
        this.dialog.css({ height: '310px', width: '705px' });

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

        // Bind this.navigate to any links in the dialog
        $('a:not(.helplink)', this.dialog).one('click', function(e) {

            dialog.load($(this).attr('href'), 'GET');

            // Stop any default event occuring
            e.preventDefault();

            return false;
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
/** mitmsDialog_handler_treeview_draggable **/

mitmsDialog_handler_treeview_draggable = function() {};
mitmsDialog_handler_treeview_draggable.prototype = new mitmsDialog_handler_treeview();

/**
 * Setup treeview and drag/drop infrastructure
 *
 * @return void
 */
mitmsDialog_handler_treeview_draggable.prototype.every_load = function() {

    // Setup treeview
    mitmsDialog_handler_treeview.prototype.every_load.call(this);

    // Setup droppable region
    $('.selected', this._container).droppable({
        drop: this._event_drop,
        scope: this._title
    });

    // Make decending spans draggable
    this._make_draggable($('.treeview', this._container));
}

/**
 * Make decending spans draggable
 *
 * @param jQuery element list
 * @return void
 */
mitmsDialog_handler_treeview_draggable.prototype._make_draggable = function(parent_element) {

    $('span:not(.empty, .ui-undraggable)', parent_element).draggable({
        containment: 'body',
        helper: 'clone',
        scope: this._title
    });
}

/**
 * Hierarchy update handler
 *
 * @param element
 * @return void
 */
mitmsDialog_handler_treeview_draggable.prototype._handle_update_hierarchy = function(parent_element) {
    this._make_draggable(parent_element);
}

/**
 * Add element to drop box when dropped
 *
 * @param event
 * @param ui
 * @return void
 */
mitmsDialog_handler_treeview_draggable.prototype._event_drop = function(event, ui) {

    // Get clone
    var clone = ui.draggable.clone();

    // Get droppage region
    var droppable = $(this);

    // Check if an element with the same ID already exists
    if ($('#'+clone.attr('id'), droppable).size() < 1) {
        // Append clone to drop box
        droppable.append(clone);
    }
}


/*****************************************************************************/
/** mitmsDialog_handler_treeview_clickable **/

mitmsDialog_handler_treeview_clickable = function() {
    /**
     * Function for handling clicks
     */
    var clickhandler;
};

mitmsDialog_handler_treeview_clickable.prototype = new mitmsDialog_handler_treeview();

/**
 * Hierarchy update handler
 *
 * @param element
 * @return void
 */
mitmsDialog_handler_treeview_clickable.prototype._handle_update_hierarchy = function(parent_element) {
    this._make_clickable(parent_element);
}

/**
 * Setup treeview and click infrastructure
 *
 * @return void
 */
mitmsDialog_handler_treeview_clickable.prototype.every_load = function() {

    // Setup treeview
    mitmsDialog_handler_treeview.prototype.every_load.call(this);

    this._make_clickable($('.treeview', this._container));
}

/**
 * Make elements run the clickhandler when clicked
 *
 * @parent element
 * @return void
 */
mitmsDialog_handler_treeview_clickable.prototype._make_clickable = function(parent_element) {

    // Get selectable/clickable elements
    var selectables = $('span:not(.empty)', parent_element);

    // Remove old handlers
    selectables.unbind('click');

    // Add clickable class
    selectables.addClass('clickable');

    // Setup closure
    var dialog = this;

    // Bind click handler
    selectables.click(function() {

        var clicked = $(this);

        // Fix the element id
        clicked.attr('id', clicked.attr('id').substr(5));

        // Check for new style click handler
        if (dialog.handle_click != undefined) {
            dialog.handle_click(clicked);
        }
        else {
            // Run handler and close
            dialog.clickhandler(clicked);
            dialog._dialog.hide();
        }

        return false;
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
 * Setup clickable treeview dialog that calls a handler on click
 *
 * @param string dialog name
 * @param string find page url
 * @param function handler
 * @return void
 */
mitmsLocateDialog = function(name, find_url, clickhandler) {

    var handler = new mitmsDialog_handler_treeview_clickable();
    handler.clickhandler = clickhandler;

    mitmsDialogs[name] = new mitmsDialog(
        name,
        'show-'+name+'-dialog',
        {},
        find_url,
        handler
    );
}

/**
 * Setup draggable treeview dialog that calls a save page, and
 * prints the html response to an underlying table
 *
 * @param string dialog name
 * @param string find page url
 * @param string save page url
 * @return void
 */
mitmsAssignDialog = function(name, find_url, save_url) {

    var handler = new mitmsDialog_handler_treeview_draggable();

    mitmsDialogs[name] = new mitmsDialog(
        name,
        'show-'+name+'-dialog',
        {
            buttons: {
                'Save changes': function() { handler._save(save_url) }
            }
        },
        find_url,
        handler
    );
}
