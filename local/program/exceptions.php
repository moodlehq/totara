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
 * @author Ben Lobo <ben.lobo@kineo.com>
 * @package totara
 * @subpackage program
 */

/**
 * Program exceptions page
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once('lib.php');
require_once($CFG->dirroot . '/local/js/lib/setup.php');

$id = required_param('id', PARAM_INT); // program id
$page = optional_param('page', 0, PARAM_INT);
$searchterm = optional_param('search', '', PARAM_TEXT);

admin_externalpage_setup('manageprograms', '', array('id' => $id), $CFG->wwwroot.'/local/program/exceptions.php');

// Permissions check
$systemcontext = get_system_context();

if( ! has_capability('local/program:handleexceptions', $systemcontext)) {
    print_error('error:nopermissions', 'local_program');
}

// This session variable will be set to true following resolution of issues.
// This allows the page number to be reset (otherwise there is a chance that the
// page index will be wrong (as there are now less exceptions than before)
if (isset($_SESSION['exceptions_resolved']) && $_SESSION['exceptions_resolved']===true) {
    unset($_SESSION['exceptions_resolved']);
    $page = 0;
}

$program = new program($id);

$currenturl = qualified_me();
$currenturl_noquerystring = strip_querystring($currenturl);
$viewurl = $currenturl_noquerystring."?id={$id}&action=view";

$selectiontype = isset($_SESSION['exceptions_selectiontype']) ? $_SESSION['exceptions_selectiontype'] : SELECTIONTYPE_NONE;
$manually_added_exceptions = isset($_SESSION['exceptions_added']) ? $_SESSION['exceptions_added'] : array();
$manually_removed_exceptions = isset($_SESSION['exceptions_removed']) ? $_SESSION['exceptions_removed'] : array();

$exceptions = $program->get_exception_count();
$programexceptionsmanager = $program->get_exceptionsmanager();
$programexceptions = $programexceptionsmanager->search_exceptions($page, $searchterm);
//if ((count($programexceptions) == 0) && ($exceptions > 0) && empty($searchterm)) {
//    $newpage = floor($exceptions / RESULTS_PER_PAGE);
//    redirect("{$CFG->wwwroot}/local/program/exceptions.php?id={$program->id}&amp;page={$newpage}");
//}
$foundexceptionscount = $programexceptionsmanager->search_exceptions($page, $searchterm, '', true);
$programexceptionsmanager->set_selections($selectiontype, $searchterm);
$selected_exceptions = $programexceptionsmanager->get_selected_exceptions();

// Add the manually added selections to the global selection
$selected_exceptions = $selected_exceptions + $manually_added_exceptions;

// Remove the manually removed exceptions from the global selection
foreach ($manually_removed_exceptions as $id => $ex) {
    unset($selected_exceptions[$id]);
}

// Load jQuery and the dialogs
local_js(array(
    TOTARA_JS_DIALOG
));

// log this request
add_to_log(SITEID, 'program', 'view exceptions', "exceptions.php?id={$program->id}", $program->fullname);

///
/// Display
///
$category_breadcrumbs = get_category_breadcrumbs($program->category);

$heading = $program->fullname;
$pagetitle = format_string(get_string('program', 'local_program').': '.$heading);
$navlinks = array();
$navlinks[] = array('name' => get_string('manageprograms', 'admin'), 'link'=> $CFG->wwwroot . '/course/categorylist.php?viewtype=program', 'type'=>'title');
$navlinks = array_merge($navlinks, $category_breadcrumbs);
$navlinks[] = array('name' => $program->shortname, 'link'=> $viewurl, 'type'=>'title');
$navlinks[] = array('name' => get_string('exceptionsreport', 'local_program'), 'link'=> '', 'type'=>'title');

admin_externalpage_print_header('', $navlinks);

print_container_start(false, 'program exceptions', 'program-exceptions');

print_heading($heading.' - '.get_string('exceptionsreport', 'local_program'));

$currenttab = 'exceptions';
require('tabs.php');

echo '<fieldset id="programexceptions">';
echo '<legend class="ftoggler">'.get_string('programexceptions', 'local_program').'</legend>';
echo '<p>'.get_string('instructions:programexceptions', 'local_program').'</p>';

$programexceptionsmanager->print_search($searchterm);

$programexceptionsmanager->print_exceptions_form($programexceptions, $selected_exceptions, $selectiontype);

$params = array('id' => $program->id);
if (!empty($searchterm)) {
    $params['search'] = $searchterm;
}
$base_url = new moodle_url($CFG->wwwroot . '/local/program/exceptions.php', $params);
print_paging_bar($foundexceptionscount, $page, RESULTS_PER_PAGE, $base_url);

echo '</fieldset>';

print_container_end();

$handledActions = $programexceptionsmanager->get_handled_actions_for_selection('json', $selected_exceptions);

?>

<script type="text/javascript">

    function Items() {
    this.list = new Array();

    this.number = <?php echo count($selected_exceptions); ?>;
    this.numberLabel = $('#numselectedexceptions');

    this.actions = $('#selectionaction');

    this.handledActions = <?php echo $handledActions; ?>

    this.addItem = function(item) {
        this.list.push(item);
        item.parent = this;
    }
    this.selectAll = function(totalselected) {
        $.each(this.list, function(index, item) {
        item.select();
        });
        this.updateNumber(totalselected);
    }
    this.unselectAll = function() {
        $.each(this.list, function(index, item) {
        item.unselect();
        });
        this.updateNumber(0);
    }
    this.selectOnly = function(selectionId, totalselected) {
        var i = 0;
        $.each(this.list, function(index, item) {
        if (item.selectionId == selectionId) {
            i++;
            item.select();
        }
        else {
            item.unselect();
        }
        });
        this.updateNumber(totalselected);
    }
    this.increaseCount = function() {
        this.updateNumber(this.number + 1);
    }
    this.decreaseCount = function() {
        this.updateNumber(this.number - 1);
    }
    this.updateNumber = function(number) {
        this.number = number;
        this.numberLabel.html(this.number);
    }
    this.getCount = function() {
        return this.number;
    }
    this.limitActions = function(handledActions) {

            var selectionactions = this.actions;

            // Enable all actions  by default
            $('option', selectionactions).show();

            // Loop through the actions
            $.each(handledActions, function(action, isAllowed) {

                // If this action is not allowed for this type, then hide the option for the entire selection
                if ( ! isAllowed) {
                    $('option[value="'+action+'"]', selectionactions).hide();
                }
            });

            // Make sure the 'Action' option is always visible'
            $('option[value="0"]', selectionactions).show();
    }
    }

    function Item(selectionId, typeId, object) {
    this.selectionId = selectionId;
    this.typeId = typeId;
    this.object = object;

    this.parent = null; // Reference to Items

    this.checkbox = $(this.object).find('input[type="checkbox"]');

    this.exceptionId = $(this.checkbox).val();

    this.select = function() {
        this.checkbox.attr('checked','checked');
    }
    this.unselect = function() {
        this.checkbox.removeAttr('checked');
    }

    this.isSelected = function() {
        return this.checkbox.attr('checked');
    }

    // Add a hook for when the checkboxs are updated manually by the user
    var self = this;
    $(this.checkbox).change(function() {

            var url = '<?php echo $CFG->wwwroot.'/local/program/exception/updateselections.php?id='.$id ?>';
            var searchterm = '<?php echo $searchterm ?>';
            var checked = $(this).attr('checked');

            $.getJSON(url + '&action=selectsingle' + '&checked=' + checked + '&exceptionid=' + self.exceptionId + '&search=' + searchterm, function(data) {
                if(data['error']==true) {
                    alert('An error occurred');
                } else {
                    var totalselected = data['selectedcount'];
                    var handledactions = data['handledactions'];

                    items.limitActions(handledactions)
                    items.updateNumber(totalselected)
                }
            });

    });
    }

    // Bind functionality to the page
    $(function() {

    // Create our Items object
    items = new Items();

    // Loop through the exceptions and create item objects
    $('#exceptions tr').each(function(i,val) {
        if (i == 0) { return; }

        var typeId = $(this).find('span.type').html();

        var selectionId = 0;
        if (typeId == '<?php echo EXCEPTIONTYPE_TIME_ALLOWANCE; ?>') {
        selectionId = <?php echo SELECTIONTYPE_TIME_ALLOWANCE; ?>;
        }
        else if (typeId == '<?php echo EXCEPTIONTYPE_ALREADY_ASSIGNED; ?>') {
        selectionId = <?php echo SELECTIONTYPE_ALREADY_ASSIGNED; ?>;
        }
        else if (typeId == '<?php echo EXCEPTIONTYPE_EXTENSION_REQUEST; ?>') {
        selectionId = <?php echo SELECTIONTYPE_EXTENSION_REQUEST; ?>;
        }
            else if (typeId == '<?php echo EXCEPTIONTYPE_COMPLETION_TIME_UNKNOWN; ?>') {
        selectionId = <?php echo SELECTIONTYPE_COMPLETION_TIME_UNKNOWN; ?>;
        }
        items.addItem(new Item(selectionId,typeId,this));
    });

    // Initially select only the actions that are available to the current selection
        items.limitActions(items.handledActions);

    // Hook onto the type selection dropdown
    $('#selectiontype').change(function() {

        var url = '<?php echo $CFG->wwwroot.'/local/program/exception/updateselections.php?id='.$id ?>';
            var searchterm = '<?php echo $searchterm ?>';
            var selectedId = $(this).find('option:selected').val();

            $.getJSON(url + '&action=selectmultiple&selectiontype=' + selectedId + '&search=' + searchterm, function(data) {

                var totalselected = data['selectedcount'];
                var selectiontype = data['selectiontype'];
                var handledactions = data['handledactions'];

                if (selectiontype == <?php echo SELECTIONTYPE_NONE; ?>) {
                    items.unselectAll();
                } else if (selectiontype == <?php echo SELECTIONTYPE_ALL; ?>) {
                    items.selectAll(totalselected);
                } else {
                    items.selectOnly(selectedId, totalselected);
                }

                items.limitActions(handledactions);
            });
    });

    // Create a dialog to handle stuff
    var handler = new totaraDialog_handler();
    var dialog = new totaraDialog(
            'applyaction',
            'applyactionbutton',
            {
        buttons: {
            'Cancel': function() { handler._cancel() },
            'Ok': function() { dialog.save('<?php echo $CFG->wwwroot; ?>/local/program/exception/resolve.php?id=<?php echo $id ?>'); }
        },
        title: '<?php echo '<h2>'.get_string('confirmresolution', 'local_program').'</h2>'; ?>',
                height: '250'
        },
            '<?php echo $CFG->wwwroot ?>/local/program/exception/confirm_resolution.php',
            handler
        );

    // Modify it a little bit to check
    dialog.base_url = dialog.default_url;
    dialog.old_open = dialog.open;
    dialog.open = function() {

        var action = $('#selectionaction option:selected').val();
            var selectedexceptionscount = items.number;

        if (action == 0 || selectedexceptionscount == 0) {
                return;
        }

        this.default_url = this.base_url;
        this.default_url += '?action=' + action;
        this.default_url += '&selectedexceptioncount=' + selectedexceptionscount;

        this.old_open();
    }
    dialog.save = function(url) {
            var searchterm = '<?php echo $searchterm ?>';
        url += '&action=' + $('#selectionaction option:selected').val();
        url += '&search=' + searchterm;
        this._request(url, dialog, '_update', searchterm);
    }

    dialog._update = function(response, searchterm) {
        this.hide();
        window.location.href = '<?php echo $CFG->wwwroot . '/local/program/exceptions.php?id=' . $id . '&search='; ?>'+searchterm;
    }

    totaraDialogs['applyaction'] = dialog;

    });

</script>

<?php

admin_externalpage_print_footer();

?>
