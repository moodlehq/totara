<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/type/competency/lib.php');


///
/// Setup / loading data
///

// Framework id
$frameworkid = optional_param('frameworkid', 0, PARAM_INT);

admin_externalpage_setup('competencymanage', '', array(), '', $CFG->wwwroot.'/hierarchy/type/competency/idp/add-template.php');

// Check permissions
$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:updatecompetency', $sitecontext);

// Setup hierarchy object
$hierarchy = new competency();

// Load framework
if (!$framework = $hierarchy->get_framework($frameworkid)) {
    error('Competency framework could not be found');
}

// Load competency templates to display
$templates = $hierarchy->get_templates();

///
/// Display page
///

?>

<div class="selectcompetencies">

<h2><?php echo get_string('addcompetencytemplatestoplan', 'idp') ?>

<?php

    // Display framework picker
    $frameworks = $hierarchy->get_frameworks();

    if (count($frameworks) > 1) {

        echo '<select id="framework-picker">';

        foreach ($frameworks as $fw) {
            echo '<option value="'.$fw->id.'"';

            // Is current?
            if ($fw->id == $frameworkid) {
                echo ' selected="selected"';
            }

            echo '>'.$fw->fullname.'</option>';
        }

        echo '</select>';
    }

?></h2>

<div id="selectedcompetencies">
    <p>
        <?php echo get_string('dragheretoassign', $hierarchy->prefix) ?>
    </p>
</div>

<p>
    <?php echo get_string('locatecompetency', $hierarchy->prefix) ?>:
</p>

<ul id="competencies" class="filetree">
<?php

// Foreach competency
if ($templates) {
    foreach ($templates as $template) {

        echo '<li id="competency_list_'.$template->id.'">';
        echo '<span id="cmp_'.$template->id.'">'.$template->fullname.'</span>';
        echo '</li>'.PHP_EOL;
    }
} else {
    echo '<li><span class="empty">No templates found</span></li>'.PHP_EOL;
}

echo '</ul></div>';
