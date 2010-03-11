// Setup
YAHOO.namespace('dialog');
YAHOO.namespace('dialogSetupFunc');


// Dialog object
function yuiDialog(title, buttonid, config, default_url, handler) {

    /**
     * ID of dialog
     */
    this.title = title;

    /**
     * ID of open button
     */
    this.buttonid = buttonid;

    /**
     * YUI Dialog widget instance
     */
    this.dialog;

    /**
     * Default URL
     */
    this.default_url;

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
        // Get form action
        if (default_url) {
            this.default_url = default_url;
        } else {
            this.default_url = $('#'+this.buttonid).closest('form').attr('action');
        }

        // Default config
        var default_config = {
            x : 205,
            y : 300,
            width : "705px",
            effect : {effect: YAHOO.widget.ContainerEffect.FADE, duration: 0.5},
            visible : false,
            draggable : false,
            modal : true,
            underlay : 'shadow',
            zIndex : 1500
        };

        // Instantiate the Dialog
        this.dialog = new YAHOO.widget.Dialog(
            this.title,
            $.extend(default_config, this.config)
        );

        // Setup handler
        if (this.handler != undefined) {
            this.handler._setup(this);
        }

        // Set up obj for closure
        var obj = this;

        // Bind a hide event to the rest of the document
        // Will hide the dialog if we click anywhere in the document other than the dialog
        YAHOO.util.Event.addListener(
            document,
            'click',
            function(e) {
                var el = YAHOO.util.Event.getTarget(e);
                var dialogEl = obj.dialog.element;
                var element = new YAHOO.util.Element(el);

                if (el != dialogEl && !YAHOO.util.Dom.isAncestor(dialogEl, el) && element.get('id') != obj.buttonid) {
                    obj.dialog.hide();
                }
            }
        );

        // Bind open event to button
        YAHOO.util.Event.addListener(
            this.buttonid,
            'click',
            this.open,
            this,
            true
        );
    }


    /**
     * Open dialog and load external page
     * @param   event
     * @return  void
     */
    this.open = function(event) {
        // Stop any default event occuring
        YAHOO.util.Event.stopEvent(event);

        // Open default url in dialog
        var url = this.default_url;
        var method = 'GET';

        // Need to run setBody so the body
        // appears above the close button
        this.dialog.setBody('');
        this.dialog.render(document.body);
        this.dialog.show();
        this.load(url, method);
    }


    /**
     * Load an external page in the dialog
     * @param   url     Url of page
     * @param   method  Page fetch method, POST or GET
     * @return  void
     */
    this.load = function(url, method) {
        // Add loading animation
        this.showLoading();
        this.dialog.setBody('');

        // Save url
        this.url = url;

        // Set up obj for closure
        var obj = this;

        var callback =
        {
            success: function(o) { obj.render(o) },
            failure: function(o) {}
        }

        YAHOO.util.Connect.asyncRequest(method, url, callback);
    }


    /**
     * Navigate to a new page in the dialog
     * @param   event
     * @return  void
     */
    this.navigate = function(event) {
        // Stop any default event occuring
        YAHOO.util.Event.stopEvent(event);

        // Get element that was clicked
        var el = YAHOO.util.Event.getTarget(event);

        // Load the page
        this.load(el.href, 'GET');
    }


    /**
     * Render dialog and contents
     * @param   o   asyncRequest response
     * @return  void
     */
    this.render = function(o) {
        this.dialog.setBody(o.responseText);
        this.dialog.render(document.body);

        this.bindLinks();

        // Hide loading animation
        this.hideLoading();

        // Run old style setup function
        if (YAHOO.dialogSetupFunc[this.title] != undefined) {
            YAHOO.dialogSetupFunc[this.title]();
        }

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
        var anchors = YAHOO.util.Dom.getElementsBy(
            function(el) {
                if (el.className != 'container-close') {
                    return true;
                } else {
                    return false;
                }
            },
            'A',
            this.dialog.element
        );

        // Bind this.navigate to any links in the dialog
        YAHOO.util.Event.addListener(
            anchors,
            'click',
            this.navigate,
            this,
            true
        );
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
        this.dialog.setBody('');
        this.dialog.hide();
    }


    /**
     * Handle HTTP request failures
     * @return void
     */
    this.request_failure = function(url) {
    }

    // Setup object
    this.setup();
}


/*****************************************************************************/
/** yuiDialog_handler **/

function yuiDialog_handler() {

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
yuiDialog_handler.prototype._setup = function(dialog) {
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
yuiDialog_handler.prototype._load = function(dialog) {

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
 * Make an HTTP GET request
 *
 * @param string request url
 * @param function call on success
 * @param function call on failure
 * @param mixed argument
 */
yuiDialog_handler.prototype._request = function(url, success, failure, argument) {

    // Setting up callbacks
    var handler = this;
    var dialog = this._dialog;

    // Send to server
    YAHOO.util.Connect.asyncRequest(
        'GET',
        url,
        {
            success: function(response) { success(handler, response) },
            failure: function() { failure(dialog, url) },
            argument: argument
        }
    );
}

/**
 * Add a row to a table on the calling page
 * Also hides the dialog and any no item notice
 *
 * @param yuiDialog_handler this handler object
 * @param yuiresponse YUI repsonse object
 * @return void
 */
yuiDialog_handler.prototype._update = function(handler, response) {

    // Hide dialog
    handler._dialog.hide();

    // Remove no item warning (if exists)
    $('div.noitems-'+handler._title).remove();

    // Add row to table
    $('table#list-'+handler._title+' tbody').append(response.responseText);
}


/**
 * Utility function for getting ids from
 * a list of elements
 *
 * @param jQuery jquery element list
 * @param string ID prefix string
 * @return array
 */
yuiDialog_handler.prototype._get_ids = function(elements, prefix) {

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
yuiDialog_handler.prototype._save = function(url) {

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
    this._request(url, this._update, this._dialog.request_failure);
}

/**
 * Change framework
 *
 * @return void
 */
yuiDialog_handler.prototype._set_framework = function() {

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
/** yuiDialog_handler_treeview **/

yuiDialog_handler_treeview = function() {};
yuiDialog_handler_treeview.prototype = new yuiDialog_handler();

/**
 * Setup a treeview infrastructure
 *
 * @return void
 */
yuiDialog_handler_treeview.prototype.every_load = function() {

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
yuiDialog_handler_treeview.prototype._make_hierarchy = function(parent_element) {
    var handler = this;

    // Load courses on category click
    $('span.folder, div.hitarea', parent_element).live('click', function() {

        // Get parent
        var par = $(this).parent();

        // Check this category doesn't have any children already
        if ($('> ul > li', par).size()) {
            return false;
        }

        // Id in format item_list_XX
        var id = par.attr('id').substr(10);

        var url = handler._dialog.url+'&parentid='+id;
        handler._request(url, handler._update_hierarchy, handler._dialog.request_failure, id);

        return false;
    });
}

/**
 * @param yuiDialog_handler this handler object
 * @param yuiresponse YUI repsonse object
 * @return void
 */
yuiDialog_handler_treeview.prototype._update_hierarchy = function(handler, response) {

    var parent_id = response.argument;
    var items = response.responseText;
    var list = $('.treeview li#item_list_'+parent_id+' ul:first', handler._container);

    // Remove all existing children
    $('li', list).remove();

    // Add items
    $('.treeview', handler._container).treeview({add: list.append($(items))});

    // Setup new items
    handler._make_hierarchy(list);

    if (handler._handle_update_hierarchy != undefined) {
        handler._handle_update_hierarchy(list);
    }
}


/*****************************************************************************/
/** yuiDialog_handler_treeview_draggable **/

yuiDialog_handler_treeview_draggable = function() {};
yuiDialog_handler_treeview_draggable.prototype = new yuiDialog_handler_treeview();

/**
 * Setup treeview and drag/drop infrastructure
 *
 * @return void
 */
yuiDialog_handler_treeview_draggable.prototype.every_load = function() {

    // Setup treeview
    yuiDialog_handler_treeview.prototype.every_load.call(this);

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
yuiDialog_handler_treeview_draggable.prototype._make_draggable = function(parent_element) {

    $('span:not(.empty)', parent_element).draggable({
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
yuiDialog_handler_treeview_draggable.prototype._handle_update_hierarchy = function(parent_element) {
    this._make_draggable(parent_element);
}

/**
 * Add element to drop box when dropped
 *
 * @param event
 * @param ui
 * @return void
 */
yuiDialog_handler_treeview_draggable.prototype._event_drop = function(event, ui) {

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
/** yuiDialog_handler_treeview_clickable **/

yuiDialog_handler_treeview_clickable = function() {
    /**
     * Function for handling clicks
     */
    var clickhandler;
};

yuiDialog_handler_treeview_clickable.prototype = new yuiDialog_handler_treeview();

/**
 * Hierarchy update handler
 *
 * @param element
 * @return void
 */
yuiDialog_handler_treeview_clickable.prototype._handle_update_hierarchy = function(parent_element) {
    this._make_clickable(parent_element);
}

/**
 * Setup treeview and click infrastructure
 *
 * @return void
 */
yuiDialog_handler_treeview_clickable.prototype.every_load = function() {

    // Setup treeview
    yuiDialog_handler_treeview.prototype.every_load.call(this);

    this._make_clickable($('.treeview', this._container));
}

/**
 * Make elements run the clickhandler when clicked
 *
 * @parent element
 * @return void
 */
yuiDialog_handler_treeview_clickable.prototype._make_clickable = function(parent_element) {

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

        // Run handler and close
        dialog.clickhandler(clicked);
        dialog._dialog.hide();

        return false;
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
yuiLocateDialog = function(name, find_url, clickhandler) {

    var handler = new yuiDialog_handler_treeview_clickable();
    handler.clickhandler = clickhandler;

    YAHOO.dialog[name] = new yuiDialog(
        name,
        'show-'+name+'-dialog',
        {},
        find_url,
        handler
    );
}
