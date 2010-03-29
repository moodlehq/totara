<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/type/competency/lib.php');


///
/// Setup / loading data
///

// Competency id
$id = required_param('id', PARAM_INT);

// Parent id
$parentid = optional_param('parentid', 0, PARAM_INT);

// Framework id
$frameworkid = optional_param('frameworkid', 0, PARAM_INT);

// No javascript parameters
$nojs = optional_param('nojs', false, PARAM_BOOL);
$returnurl = optional_param('returnurl', '', PARAM_TEXT);
$s = optional_param('s', '', PARAM_TEXT);

// string of params needed in non-js url strings
$urlparams = 'id='.$id.'&amp;frameworkid='.$frameworkid.'&amp;nojs='.$nojs.'&amp;returnurl='.urlencode($returnurl).'&amp;s='.$s;

// Setup page
admin_externalpage_setup('competencymanage', '', array(), '', $CFG->wwwroot.'/competency/related/add.php');

// Check permissions
$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:updatecompetency', $sitecontext);

// Setup hierarchy object
$hierarchy = new competency();

// Load framework
if (!$framework = $hierarchy->get_framework($frameworkid)) {
    error('Competency framework could not be found');
}

// Load competencies to display
$competencies = $hierarchy->get_items_by_parent($parentid);

// Get IDs of all competencies that are parents
// (to see if we should link to sub-competencies)
if(!$parentcomps = get_records_sql("
    SELECT DISTINCT parentid AS id
    FROM {$CFG->prefix}{$hierarchy->prefix}
    WHERE parentid != 0")) {
    // default to empty array if none found
    $parentcomps = array();
}


///
/// Display page
///

if($nojs) {
    admin_externalpage_print_header();
    ?>
<h2><?php echo get_string('addrelatedcompetencies', $hierarchy->prefix); ?></h2>
<div id="nojsinstructions">
    <p>
        <?php echo get_string('clicktoassign', $hierarchy->prefix); ?>
    </p>
</div>
<?php
    if($parentid) {
        echo '<div class="breadcrumb"><h2 class="accesshide " >You are here</h2> <ul>';
        echo '<li class="first"><a href="'.$CFG->wwwroot.'/hierarchy/type/'.$hierarchy->prefix.'/related/add.php?'.$urlparams.'">'.$framework->fullname.'</a></li>';
        if($lineage = $hierarchy->get_item_lineage($parentid)) {
            // correct order for breadcrumbs
            $items = array_reverse($lineage);
            $first = true;
            foreach($items as $item) {
                // the first item is the same as the link to the framework, so don't display
                if($first) {
                    $first = false;
                    continue;
                }
                echo '<li> <span class="accesshide " >/&nbsp;</span><span class="arrow sep">&#x25BA;</span>'.
                '<a href="'.$CFG->wwwroot.'/hierarchy/type/'.$hierarchy->prefix.'/related/add.php?'.$urlparams.'&amp;parentid='.$item->parentid.'">'.$item->fullname.'</a></li>';
            }
        }
        echo '</ul></div>';
    }
    echo '<div class="nojsselectcompetencies"><ul>'; // start list of competencies
}

// If parent id is not supplied, we must be displaying the main page
if (!$parentid && !$nojs) {

?>

<div class="selectcompetencies">

<h2><?php echo get_string('addrelatedcompetencies', $hierarchy->prefix); ?></h2>


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
}

$added = false;

// Loop through competencies
if ($competencies) {
    foreach ($competencies as $competency) {
        // make competencies links if JS disabled
        $compname = $nojs ? '<a href="'.$CFG->wwwroot.'/hierarchy/type/competency/related/save.php?'.$urlparams.'&amp;add='.$competency->id.'">'.$competency->fullname.'</a>' : $competency->fullname;

        // If there are no children don't make it expandable
        if (!array_key_exists($competency->id, $parentcomps)) {
            $li_class = '';
            $span_class = '';
        } else {
            $li_class = 'closed';
            $span_class = 'folder';
        }

        echo '<li class="'.$li_class.'" id="competency_list_'.$competency->id.'">';
        if($nojs && $span_class == 'folder') {
            echo '[<a href="'.$CFG->wwwroot.'/hierarchy/type/competency/related/add.php?'.$urlparams.'&amp;parentid='.$competency->id.'" title="'.get_string('viewchildren','local').'">+</a>] ';
        }
        echo '<span id="cmp_'.$competency->id.'" class="'.$span_class.'">'.$compname.'</span>';

        if ($span_class == 'folder') {
            echo '<ul></ul>';
        }
        echo '</li>'.PHP_EOL;

        $added = true;
    }
}

if (!$added) {
    echo '<li><span class="empty">No child competencies found</span></li>'.PHP_EOL;
}

// If no parent id, close list
if (!$parentid) {
    echo '</ul></div>';
}


if($nojs) {
    print_footer();
}
