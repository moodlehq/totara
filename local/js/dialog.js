// Setup
YAHOO.namespace('dialog');
YAHOO.namespace('dialogSetupFunc');


// Dialog object
function yuiDialog(title, buttonid, config, default_url) {

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
            underlay : 'shadow'
        };

        // Instantiate the Dialog
        this.dialog = new YAHOO.widget.Dialog(
            this.title,
            $.extend(default_config, this.config)
        );

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

        // Run setup function
        YAHOO.dialogSetupFunc[this.title]();
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


    // Setup object
    this.setup();
}
