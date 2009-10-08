// Setup
YAHOO.namespace('competencies.dialogs');

// Bind functionality to page on load
YAHOO.util.Event.onDOMReady(function () {

/*    if (logging != undefined) {
        show_logger = function() {
            var logreader = new YAHOO.widget.LogReader();
            logreader.newestOnTop = false;
            logreader.setTitle('Moodle Debug: YUI Log Console');
        };
        show_logger();
    }*/

    loader = new YAHOO.util.YUILoader({
        require: ["container"],

        //Set your skins member here:
        skin: {

            // Specifies the location of the skin relative to the build
            // directory for the skinnable component.
            base: 'assets/skins/',

            // The default skin, which is automatically applied if not
            // overriden by a component-specific skin definition.
            // Change this in to apply a different skin globally 
            defaultSkin: 'sam',
        },

        onSuccess: function(o) {
            //callback logic goes here
        }
    });

    loader.insert();


    // Instantiate the Dialog
    YAHOO.competencies.dialogs.add = new YAHOO.widget.Dialog(
        'addevidence', 
        {
            x : 205,
            y : 300,
            width : "705px",
            effect : {effect:YAHOO.widget.ContainerEffect.FADE, duration:0.5},
            visible : false,
            draggable : false,
            constraintoviewport : true,
            modal : true,
            underlay : 'shadow'
        }
    );

    var callback =
    {
        success: function(o) {
            YAHOO.competencies.dialogs.add.setBody(o.responseText);

            // Render
            YAHOO.competencies.dialogs.add.render(document.body);
        },
        failure: function(o) {

            alert('fail');
        }
    }

    YAHOO.util.Connect.asyncRequest('GET', '/competencies/evidence/edit.php?id=2', callback);


    // Hide if we click anywhere in the document other than the dialog
    YAHOO.util.Event.addListener(document, "click", function(e) {
        
        var el = YAHOO.util.Event.getTarget(e);
        var dialogEl = YAHOO.competencies.dialogs.add.element;
        var element = new YAHOO.util.Element(el);

        if (el != dialogEl && !YAHOO.util.Dom.isAncestor(dialogEl, el) && element.get('id') != 'show-evidence-dialog') {
            YAHOO.competencies.dialogs.add.hide();
        }
    });

    // Bind listeners
    YAHOO.util.Event.addListener(
        'show-evidence-dialog',
        'click',
        YAHOO.competencies.dialogs.add.show,
        YAHOO.competencies.dialogs.add,
        true
    );

})
