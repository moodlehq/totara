<?php

    require_once '../../config.php';

?>

// Bind functionality to page on load
$(function() {

    ///
    /// Add related competency dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/competency/related/';

        mitmsAssignDialog(
            'related',
            url+'find.php?id='+competency_id,
            url+'save.php?id='+competency_id+'&add='
        );
    })();

    /// Assign evidence item dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/type/competency/evidenceitem/';

        var handler = new mitmsDialog_handler_assignEvidence();
        handler.baseurl = url;

        mitmsDialogs['evidence'] = new mitmsDialog(
            'evidence',
            'show-evidence-dialog',
            {},
            url+'edit.php?id='+competency_id,
            handler
        );
    })();

});

// Create handler for the assign evidence dialog
mitmsDialog_handler_assignEvidence = function() {
    var baseurl = '';
};

mitmsDialog_handler_assignEvidence.prototype = new mitmsDialog_handler();

/**
 * Setup a treeview infrastructure
 *
 * @return void
 */
mitmsDialog_handler_assignEvidence.prototype.every_load = function() {

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
mitmsDialog_handler_assignEvidence.prototype._make_hierarchy = function(parent_element) {
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

        var url = handler.baseurl+'category.php?id='+id;
        handler._dialog._request(url, handler, '_update_hierarchy', id);

        return false;
    });
}

/**
 * @param string    HTML response
 * @param int       Parent id
 * @return void
 */
mitmsDialog_handler_assignEvidence.prototype._update_hierarchy = function(response, parent_id) {

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

        // Load course details
        var url = handler.baseurl+'course.php?id='+id+'&competency='+competency_id;
        handler._dialog._request(url, handler, '_display_evidence');
    });
}

/**
 * Display course evidence items
 *
 * @param string    HTML response
 */
mitmsDialog_handler_assignEvidence.prototype._display_evidence = function(response) {

    $('.selected', this._dialog.dialog).html(response);

    var handler = this;

    // Handle add evidence links
    $('.selected a', this._dialog.dialog).click(function(e) {
        e.preventDefault();
        handler._dialog._request($(this).attr('href'), handler, '_update');
    });
}
