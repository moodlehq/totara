<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/type/organisation/lib.php');


///
/// Setup / loading data
///

// Competency id
$userid = required_param('user', PARAM_INT);

// Parent id
$parentid = optional_param('parentid', 0, PARAM_INT);

// Framework id
$frameworkid = optional_param('frameworkid', 0, PARAM_INT);

// Setup page
require_login();

// Check permissions
$personalcontext = get_context_instance(CONTEXT_USER, $userid);
$can_edit = false;
if (has_capability('moodle/local:assignuserposition', get_context_instance(CONTEXT_SYSTEM))) {
    $can_edit = true;
}
elseif (has_capability('moodle/local:assignuserposition', $personalcontext)) {
    $can_edit = true;
}
elseif ($USER->id == $user->id &&
    has_capability('moodle/local:assignselfposition', get_context_instance(CONTEXT_SYSTEM))) {
    $can_edit = true;
}

if (!$can_edit) {
    error('You do not have the permissions to assign this user a position');
}

// Setup hierarchy object
$hierarchy = new organisation();

// Load framework
if (!$framework = $hierarchy->get_framework($frameworkid)) {
    error('Hierarchy framework could not be found');
}

// Load depths
$depths = $hierarchy->get_depths();

// Get max depth level
end($depths);
$max_depth = current($depths)->id;

// Load items to display
$positions = $hierarchy->get_items_by_parent($parentid);


///
/// Display page
///

// If parent id is not supplied, we must be displaying the main page
if (!$parentid) {

?>

<div class="selectorganisation">

<h2>
<?php
    echo get_string('chooseorganisation', $hierarchy->prefix);

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

?>
</h2>

<ul id="organisations" class="filetree">
<?php
}


// Foreach competency
if ($positions) {
    foreach ($positions as $position) {
        if ($position->depthid == $max_depth) {
            $li_class = '';
            $span_class = 'clickable';
        } else {
            $li_class = 'closed';
            $span_class = 'folder';
        }

        echo '<li class="'.$li_class.'" id="organisation_list_'.$position->id.'">';
        echo '<span id="org_'.$position->id.'" class="'.$span_class.'">'.$position->fullname.'</span>';

        if ($span_class == 'folder') {
            echo '<ul></ul>';
        }
        echo '</li>'.PHP_EOL;
    }
} else {
    echo '<li><span class="empty">'.get_string('noorganisationsinframework', $hierarchy->prefix).'</span></li>'.PHP_EOL;
}

// If no parent id, close list
if (!$parentid) {
    echo '</ul></div>';
}
