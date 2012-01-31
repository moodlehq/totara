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
 * @author Simon Coggins <simonc@catalyst.net.nz>
 * @package totara
 * @subpackage reportbuilder 
 */

/**
 * Page containing column display options, displayed inside show/hide popup dialog
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->dirroot.'/local/reportbuilder/lib.php');

require_login();

$id = required_param('id', PARAM_INT);

$report = new reportbuilder($id);
print '<div id="column-checkboxes">';
$count = 0;
foreach($report->columns as $column) {
    // skip empty headings
    if($column->heading == '') {
        continue;
    }
    $ident = "{$column->type}_{$column->value}";
    print '<input type="checkbox" id="'. $ident .'" name="' . $ident . '">';
    print '<label for="' . $ident . '">' . format_string($column->heading) . '</label><br />';
    $count++;
}
print '</div>';

?>
<script type="text/javascript">
// set checkbox state based on current column visibility
$('#column-checkboxes input').each(function() {
    var sel = '#' + shortname + ' .' + $(this).attr('name');
    var state = $(sel).css('display');
    var check = (state == 'none') ? false : true;
    $(this).attr('checked', check);
});
// when clicked, toggle visibility of columns
$('#column-checkboxes input').click(function() {
    var selheader = '#' + shortname + ' th.' + $(this).attr('name');
    var sel = '#' + shortname + ' td.' + $(this).attr('name');
    var value = $(this).attr('checked') ? 1 : 0;

    if ($.browser.msie && parseInt($.browser.version) == '8') {
        $(selheader).each(function(i, elem) {
            $(elem).toggle($(elem).css('display') == 'none');
        });
        $(sel).each(function(i, elem) {
            $(elem).toggle($(elem).css('display') == 'none');
        });
    }
    else {
        $(selheader).toggle();
        $(sel).toggle();
    }

    $.ajax({
        url: '<?php print $CFG->wwwroot; ?>/local/reportbuilder/showhide_save.php',
        data: {'shortname' : shortname,
               'column' : $(this).attr('name'),
               'value' : value
        }
    });

});
</script>
