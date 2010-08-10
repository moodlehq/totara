<?php
require_once('../../config.php');
require_once($CFG->dirroot.'/local/reportbuilder/lib.php');

$id = required_param('id', PARAM_INT);

$report = new reportbuilder($id);
print '<h2>' . get_string('showhidecolumns', 'local') . '</h2>';
print '<div id="column-checkboxes">';
$count = 0;
foreach($report->columns as $column) {
    // skip empty headings
    if($column->heading == '') {
        continue;
    }
    $ident = "{$column->type}_{$column->value}";
    print '<input type="checkbox" id="'. $ident .'" name="' . $ident . '">';
    print '<label for="' . $ident . '">' . $column->heading.'</label><br />';
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
    var sel = '#' + shortname + ' .' + $(this).attr('name');
    var value = $(this).attr('checked') ? 1 : 0;
    $(sel).toggle();

    $.ajax({
        url: '<?php print $CFG->wwwroot; ?>showhide_save.php',
        data: {'shortname' : shortname,
               'column' : $(this).attr('name'),
               'value' : value
        },
    });

});
</script>
