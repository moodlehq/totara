<?php
function load_steps(&$steps, $stepnames) {
    global $CFG;
    $stepnumber=0;
    foreach ($stepnames as $stepname) {
        $stepnumber++;
        if (!isset($steps[$stepnumber])) {
            $stepfile = $CFG->dirroot . '/guides/steps/' . $stepname . '/step.php';
            if (file_exists($stepfile)) {
                require_once($stepfile);
                $newstepname = 'guide_' . $stepname . '_step';
            } else {
                require_once($CFG->dirroot . '/guides/steps/missingstep.php');
                $newstepname = 'guide_missing_step';
            }
            $steps[$stepnumber] = new $newstepname();
        }
    }
    return true;
}

function identify_visible_steps($stepnames, $targetstep, &$showfrom, &$showto) {
    $stepcount = count($stepnames);
    if ($stepcount < 4) {
        #There aren't enough steps to worry - show them all.
        $showfrom = 1;
        $showto = $stepcount;
    } elseif (($targetstep + 3) > $stepcount) {
        # Not enough steps after target for normal balance - show last 4 steps
        $showto = $stepcount;
        $showfrom = $stepcount - 3;
    } elseif (($targetstep - 1) < 1) {
        # Not enough steps before target for normal balance - show first 4 steps
        $showfrom = 1;
        $showto = 4;
    } else {
        # Normal balance ie show 1 before target step, and 2 after
        $showfrom = $targetstep - 1;
        $showto = $targetstep + 2;
    }
    return range($showfrom,$showto);
}

function increment_currentstep(&$gi, $steps) {
    $updategi->id = addslashes($gi->id);
    $gi->currentstep++;
    if (isset($steps[$gi->currentstep])) {
        $steps[$gi->currentstep]->start_step();
    }
    $updategi->currentstep = addslashes($gi->currentstep);
    return update_record('block_guides_guide_instance', $updategi);
}

function delete_gi($gi) {
    $updategi->id = addslashes($gi->id);
    $updategi->deleted = 1;
    return update_record('block_guides_guide_instance', $updategi);
}

function measure_gi_progress ($gi, $steps, &$efforttotal, &$effortdone){
    if(empty($steps)) {
        $stepnames = explode(',', $gi->steps);
        load_steps($steps,$stepnames);
    }
    $efforttotal = 0;
    $effortdone = 0;
    foreach ($steps as $stepnumber => $step) {
        $stepeffort = $steps[$stepnumber]->effort();
        $efforttotal += $stepeffort;
        if ($gi->currentstep > $stepnumber) {
            $effortdone += $stepeffort;
        } elseif ($gi->currentstep == $stepnumber) {
            $effortdone += ($stepeffort * $steps[$stepnumber]->percent_complete()/100);
        }
    }
    return true;
}

?>
