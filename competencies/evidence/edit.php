<?php

require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');


///
/// Setup / loading data
///

// competency id
$id = required_param('id', PARAM_INT);

// Check perms
admin_externalpage_setup('competencymanage', '', array(), '', $CFG->wwwroot.'/competencies/edit.php');

$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:updatecompetencies', $sitecontext);

if (!$competency = get_record('competency', 'id', $id)) {
    error('Competency ID was incorrect');
}

// Load framework
if (!$framework = get_record('competency_framework', 'id', $competency->frameworkid)) {
    error('Competency framework could not be found');
}

// Load depth
if (!$depth = get_record('competency_depth', 'id', $competency->depthid)) {
    error('Competency depth could not be found');
}

// Cache user capabilities
$can_edit_comp = has_capability('moodle/local:updatecompetencies', $sitecontext);


///
/// Display page
///

print_heading(get_string('addnewevidenceitem', 'competencies'));

?>
<h2 class="main">Select the evidence type:</h2>
<ul>
    <li>
        Activity completion
    </li>
    <li>
        Activity grade
    </li>
    <li>
        Activity outcome
    </li>
    <li>
        Course completion
    </li>
    <li>
        Course grade
    </li>
    <li>
        File
    </li>
</ul>
<?php

