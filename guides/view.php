<?php
require_once("../config.php");
$giid = optional_param('gi', 0, PARAM_INT);
$reqstepnumber = optional_param('step', 0, PARAM_INT); //The number of the step we have been asked to display
$finishstep = optional_param('finish', 0, PARAM_INT); //Request to mark this step as finished
$startguide = optional_param('startguide', 0, PARAM_INT); //Request to mark this step as finished
require_login();
require_once($CFG->dirroot . "/guides/lib.php");

# Check that the user trying to load this page is allowed to:
$context = get_context_instance(CONTEXT_SYSTEM);
require_capability('block/guides:viewownguide', $context);

$navlinks = array();
$strguides = get_string('guides','block/guides');
$navlinks[] = array('name' => $strguides, 'link' => "index.php", 'type' => 'misc');

if(!empty($startguide)) {
    # User has requested that a new guide instance is created
    # Check that they don't have an existing, live GI, and that the guide requested is valid
    $existinggi = get_record('block_guides_guide_instance',
                            'deleted', 0,
                            'guide', $startguide,
                            'userid', $USER->id);
    if ($existinggi) {
        if (empty($giid)) {
            // The user asked to start a guide they're already in the middle of
            // Show them the existing guide instance;
            $giid = addslashes($existinggi->id);
        }
    } else {
        $validguide = get_record('block_guides_guide','deleted', 0, 'id', $startguide);
        if ($validguide) {
            #The asked-for guide exists, Create a new guide instance as requested
            $gi->currentstep = 0;
            $gi->guide = $startguide;
            $gi->userid = $USER->id;
            $giid = insert_record('block_guides_guide_instance', $gi, true);
        } else {
            # The guide they have requested to start is not available to them - error-out.
            $navigation = build_navigation($navlinks);
            print_header(" ", " ", $navigation, "", "", true);
            error("There is no guide you can start with that id");
            print_footer();
            exit();
        }
    }
}

$guidesql = 'SELECT gi.*, g.steps, g.name, gi.userid, g.description ' .
            'FROM ' . $CFG->prefix . 'block_guides_guide_instance gi ' .
            ' INNER JOIN ' . $CFG->prefix . 'block_guides_guide g on gi.guide=g.id ' .
            'WHERE gi.id = ' . $giid . ' AND gi.deleted = 0';
$gi = get_record_sql($guidesql);
if (!empty($gi)) {
    $ownguide = ($gi->userid == $USER->id);
} else {
    $ownguide = false;
}

if (!$gi || (!$ownguide && !has_capability('block/guides:viewothersguide',$context))) {
    $navigation = build_navigation($navlinks);
    print_header(" ", " ", $navigation, "", "", true);
    error("There is no guide instance for you to see matching that id");
    print_footer();
}
$navlinks[] = array('name' => $gi->name, 'link' => null, 'type' => 'misc');
$navigation = build_navigation($navlinks);

$stepnames = explode(',', $gi->steps);
$stepnames = array_map('trim', $stepnames);

# If a step has been specified, we should 'focus' on that step
# otherwise we should focus on the guide's current step
if ($reqstepnumber) {
    $targetstep = $reqstepnumber;
} else {
    $targetstep = $gi->currentstep;
}


$steps = array();
# Work out which steps will be visible, and load objects representing those steps
if(!load_steps($steps, $stepnames)) {
    error("Unable to load steps identified by this guide");
}
$visiblesteps = identify_visible_steps($steps, $targetstep, $showfrom, $showto);

#Iterate over steps, marking steps as finished if appropriate, and working out how far through the
# guide the user is in terms of effort-points.
$efforttotal = 0;
$effortdone = 0;
$stepnumber = 0;

if ($gi->currentstep == 0) {
    # Guide has just started - start the 1st step
    increment_currentstep($gi, $steps);
}

foreach ($stepnames as $stepname) {
    $stepnumber++;
    # If this is the active step, and the step is either configured for autocomplete,
    # or the user has explicity specifed to mark the step as finished, try to finish
    if ($gi->currentstep == $stepnumber) {
        if ($steps[$stepnumber]->autocomplete() || ($finishstep == $stepnumber)) {
            # If the set_complete function is called, and succeeds, adjust the visible steps,
            # If any new steps are visible, load them
            if($steps[$stepnumber]->set_complete()) {
                increment_currentstep($gi, $steps);
                if (!$reqstepnumber) {
                    // No step has been explicity requested - we're just tracking the active step
                    // update the target step, and load a new step (if necessary)
                    $targetstep = $gi->currentstep;
                    $visiblesteps = identify_visible_steps($steps, $targetstep, $showfrom, $showto);
                }
            } elseif ($finishstep == $stepnumber) {
                # User has explicity requested that a step be marked as finished, but
                # set_complete failed - step not finished.
                $finishfailed = $finishstep;
            }
        }
    }
}

measure_gi_progress($gi, $steps, $efforttotal, $effortdone);

print_header($gi->name. ": ", $gi->name . ": ", $navigation, "", "", true);
print "<div class=guideheadings>";
print_heading($gi->name);
if(isset($gi->description)) {
    print_heading($gi->description,'left',3);
}
print "Showing steps $showfrom to $showto of " . count($stepnames) . "<br />\n";
if (!empty($finishfailed)) {
    print '<span class="error">Step ' . $finishfailed . ' can not yet be marked as completed.  Ensure that you have met the steps requirements, then try again.</span>';
}
$percentvalue = $effortdone / $efforttotal * 100;
$pixelvalue = $effortdone / $efforttotal * 121;
$pixeloffset = round($pixelvalue - 120);
$percent = round($percentvalue);

print "</div>";
print "<div class=guidenavigation>";
print '<img src="' . $CFG->wwwroot . '/guides/percentImage.png" alt="' . $percent . '%" style="background: white url(/guides/percentImage_back.png) top left no-repeat;padding: 0;margin: 5px 0 0 0;background-position: ' . $pixeloffset . 'px 0pt;" />';
print " $percent % complete<br />\n";
print '<form action="' . $CFG->wwwroot . '/guides/delete.php?gi=' . $gi->id . '" method="post">';
print '<input type="hidden" name="gi" value="' . $gi->id . '" />';
print '<input type="image" src="' . $CFG->wwwroot . '/theme/' . $CFG->theme . '/pix/t/delete.gif" alt="delete guide" /> Delete Guide';
print '</form>';
print "</div>";
print "<div class=guidesteps>";
# Iterate over visible steps to output their content
foreach ($visiblesteps as $stepnumber) {
    $activestep = ($stepnumber == $gi->currentstep);
    $completedstep = ($stepnumber < $gi->currentstep);
    if ($activestep) {
        print '<div class="guidestepcontainer"><div class="guidestep active incomplete">';
        print_heading('Step ' . $stepnumber,'center',2,'guidesteptitle active');
    } elseif ($completedstep) {
        print '<div class="guidestepcontainer"><div class="guidestep inactive complete">';
        print_heading('Step ' . $stepnumber,'center',2,'guidesteptitle complete');
    } else {
        print '<div class="guidestepcontainer"><div class="guidestep inactive incomplete">';
        print_heading('Step ' . $stepnumber,'center',2,'guidesteptitle pending');
    }
    print '<div class="guidesteptext">' . $steps[$stepnumber]->content($activestep, $completedstep) . '</div>';
    print '<div class="stepstatus">';
    if ($activestep) {
        print '<form action="' . $CFG->wwwroot . '/guides/view.php?gi=' . $gi->id . '" method="post">';
        print '<input type="hidden" name="gi" value="' . $gi->id . '"/>';
        print '<input type="hidden" name="finish" value="' . $stepnumber . '"/>';
        print '<input type="submit" value="'.get_string('finishstep', 'blocks/guides').'"/>';
        print '</form></div>';
    } elseif ($completedstep) {
        print get_string('completed', 'block/guides');
        print '</div>';
    } else {
        print get_string('unavailable', 'block/guides');
        print '</div>';
    }
    print '</div></div>';
}
print '<div class="clearer"></div>';
print "</div>";
print_footer();

?>

