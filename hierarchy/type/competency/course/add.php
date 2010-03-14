<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/type/competency/lib.php');


///
/// Setup / loading data
///

// Parent id
$parentid = optional_param('parentid', 0, PARAM_INT);

// Framework id
$frameworkid = optional_param('frameworkid', 0, PARAM_INT);

// Setup page
admin_externalpage_setup('competencymanage', '', array(), '', $CFG->wwwroot.'/competency/course/add.php');

// Check permissions
$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:updatecompetency', $sitecontext);

// Setup hierarchy object
$hierarchy = new competency();

// Load framework
if (!$framework = $hierarchy->get_framework($frameworkid)) {
    error('Competency framework could not be found');
}

// Load competency depths
$depths = $hierarchy->get_depths();

// Get max depth level
end($depths);
$max_depth = current($depths)->id;

// Load competencies to display
$competencies = $hierarchy->get_items_by_parent($parentid);

///
/// Display page
///

// If parent id is not supplied, we must be displaying the main page
if (!$parentid) {

?>

<div class="selectcompetencies">

<h2>
<?php

    echo get_string('addcourseevidencetocompetency', $hierarchy->prefix);

    // Display framework picker
    $frameworks = $hierarchy->get_frameworks();

    if (count($frameworks) > 1) {

        echo '<select id="framework-picker">';

        foreach ($frameworks as $fw) {
            echo '<option value="'.$fw->id.'"';

            // Is current?
            if ($fw->id == $framework->id) {
                echo ' selected="selected"';
            }

            echo '>'.$fw->fullname.'</option>';
        }

        echo '</select>';
    }

?></h2>

<p>
    <?php echo get_string('locatecompetency', $hierarchy->prefix) ?>:
</p>

<ul id="competencies" class="filetree">
<?php
}


// Foreach competency
if ($competencies) {
    foreach ($competencies as $competency) {
        if ($competency->depthid == $max_depth) {
            $li_class = '';
            $span_class = 'clickable';
        } else {
            $li_class = 'closed';
            $span_class = 'folder';
        }

        echo '<li class="'.$li_class.'" id="competency_list_'.$competency->id.'">';
        echo '<span id="cmp_'.$competency->id.'" class="'.$span_class.'">'.$competency->fullname.'</span>';

        if ($span_class == 'folder') {
            echo '<ul></ul>';
        }
        echo '</li>'.PHP_EOL;
    }
} else {
    echo '<li><span class="empty">No child competencies found</span></li>'.PHP_EOL;
}

// If no parent id, close list
if (!$parentid) {
    echo '</ul></div>';
}
