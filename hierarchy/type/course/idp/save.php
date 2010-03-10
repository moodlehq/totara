<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');


///
/// Setup / loading data
///

// Plan id
$revisionid = required_param('id', PARAM_INT);

// Courses to add
$rowcount = required_param('rowcount', PARAM_SEQUENCE);

// Courses to add
$add = required_param('add', PARAM_SEQUENCE);

// Setup page
admin_externalpage_setup('competencymanage', '', array(), '', $CFG->wwwroot.'/hierarchy/course/idp/save.php');

$str_remove = get_string('remove');

///
/// Add competencies
///

// Parse input
$add = explode(',', $add);
$time = time();

foreach ($add as $addition) {
    // Check id
    if (!is_numeric($addition)) {
        error('Supplied bad data - non numeric id');
    }

    // Load course
    if (!$course = get_record('course', 'id', (int)$addition)) {
        error('Could not load course');
    }

    // Load category
    if (!$category = get_record('course_categories', 'id', $course->category)) {
        error('Could not load category');
    }

    // Add idp course
    $idpcourse = new Object();
    $idpcourse->revision = $revisionid;
    $idpcourse->course = $course->id;
    $idpcourse->ctime = time();

    insert_record('idp_revision_course', $idpcourse);


    // Return html
    echo '<tr class=r'.$rowcount.'>';
    echo "<td><a href=\"{$CFG->wwwroot}/course/category.php?id={$course->category}\">".format_string($category->name)."</a></td>";
    echo "<td><a href=\"{$CFG->wwwroot}/course/view.php?id={$course->id}\">".format_string($course->fullname)."</a></td>";
    echo '<td></td>';
    echo '<td width="25%"><input size="10" maxlength="10" type="text" name="courseduedate['.$course->id.']" id="courseduedate'.$course->id.'"/></td>';

    echo "<td class=\"options\">";

    echo "<a href=\"{$CFG->wwwroot}/hierarchy/type/course/idp/remove.php?id={$course->id}&revision={$revisionid}\" title=\"$str_remove\">".
         "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_remove\" /></a>";

    echo "</td>";

    echo '</tr>';
    echo '<script type="text/javascript"> $(function() { $(\'[id^=courseduedate]\').datepicker( ';
    echo '{ dateFormat: \'dd/mm/yy\', showOn: \'button\', buttonImage: \'../local/js/images/calendar.gif\',';
    echo 'buttonImageOnly: true } ); }); </script>'.PHP_EOL;
    $rowcount = ($rowcount + 1) % 2;
}
