<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Simon Coggins <simon.coggins@totaralms.com>
 * @author Eugene Venter <eugene@catalyst.net.nz>
 * @author Aaron Barnes <aaron.barnes@totaralms.com>
 * @package totara
 * @subpackage plan
 */

require_once '../../config.php';

$courseid = optional_param('id', 0, PARAM_INT);
$save_string = get_string('save');
$cancel_string = get_string('cancel');

?>

<?php if (!empty($CFG->competencyuseresourcelevelevidence)) { ?>
// Bind functionality to page on load
$(function() {

    ///
    /// Add course evidence to competency dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/prefix/competency/course/';

        var handler = new totaraDialog_handler_assignCourseEvidence();
        handler.baseurl = url;

        totaraDialogs['coursecompetency'] = new totaraDialog(
            'coursecompetency',
            'show-coursecompetency-dialog',
            {
                buttons: {
                     '<?php echo $cancel_string ?>': function() { handler._cancel() }
                },
                title: '<?php echo '<h2>' . get_string('addcourseevidencetocompetencies', 'competency') . '</h2>' ?>'
            },
            url+'add.php?id=<?php echo $courseid;?>',
            handler
        );
    })();

});

// Create handler for the assign evidence dialog
totaraDialog_handler_assignCourseEvidence = function() {
    // Base url
    var baseurl = '';
}

totaraDialog_handler_assignCourseEvidence.prototype = new totaraDialog_handler_treeview_singleselect(null, null, dualpane=true);

totaraDialog_handler_assignCourseEvidence.prototype.handle_click = function(clicked) {

    // Get id, format item_XX
    var id = clicked.attr('id');
    var url = this.baseurl+'evidence.php?id=<?php echo $courseid;?>&add='+id;

    // Indicate loading...
    this._dialog.showLoading();

    this._dialog._request(url, this, 'display_evidence');
}

totaraDialog_handler_assignCourseEvidence.prototype.display_evidence = function(response) {

    var handler = this;

    // Hide loading animation
    this._dialog.hideLoading();

    $('.selected', this._dialog.dialog).html(response);

    // Bind click event
    $('#available-evidence', this._dialog.dialog).find('.addbutton').click(function(e) {
        e.preventDefault();
        var competency_id=$('#evitem_competency_id').val();
        var type = $(this).parent().attr('type');
        var instance = $(this).parent().attr('id');
        var url = handler.baseurl+'save.php?competency='+competency_id+'&course=<?php echo $courseid;?>&type='+type+'&instance='+instance;
        handler._dialog._request(url, handler, '_update');
    });

    return false;
}
<?php } else {  // non resource-level dialog ?>
    // Bind functionality to page on load
    $(function() {

        (function() {
            var url = '<?php echo $CFG->wwwroot ?>/hierarchy/prefix/competency/course/';
            var saveurl = url + 'save.php?course=<?php echo $courseid; ?>&type=coursecompletion&instance=<?php echo $courseid?>&deleteexisting=1&update=';

            var handler = new totaraDialog_handler_courseEvidence();
            handler.baseurl = url;

            totaraDialogs['evidence'] = new totaraDialog(
                'coursecompetency',
                'show-coursecompetency-dialog',
                {
                     buttons: {
                        '<?php echo $cancel_string ?>': function() { handler._cancel() },
                        '<?php echo $save_string ?>': function() { handler._save(saveurl) }
                     },
                    title: '<?php echo '<h2>' .
                        get_string('assigncoursecompletiontocompetencies', 'competency') . '</h2>' ?>'
                },
                url+'add.php?id='+<?php echo $courseid; ?>,
                handler
            );
        })();

    });

    // Create handler for the dialog
    totaraDialog_handler_courseEvidence = function() {
        // Base url
        var baseurl = '';
    }

    totaraDialog_handler_courseEvidence.prototype = new totaraDialog_handler_treeview_multiselect();

    /**
     * Add a row to a table on the calling page
     * Also hides the dialog and any no item notice
     *
     * @param string    HTML response
     * @return void
     */
    totaraDialog_handler_courseEvidence.prototype._update = function(response) {

        // Hide dialog
        this._dialog.hide();

        // Remove no item warning (if exists)
        $('.noitems-'+this._title).remove();

        //Split response into table and div
        var new_table = $(response).filter('table');

        // Grab table
        var table = $('div#content table#list-coursecompetency');

        // If table found
        if (table.size()) {
            table.replaceWith(new_table);
        }
        else {
            // Add new table
            $('div#content div#coursecompetency-table-container').append(new_table);
        }
    }

<?php } ?>
