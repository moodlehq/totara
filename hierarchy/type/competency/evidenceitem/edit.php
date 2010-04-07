<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/course/lib.php');


///
/// Setup / loading data
///

// competency id
$id = required_param('id', PARAM_INT);
$type = optional_param('type', -1, PARAM_INT);

// Check perms
admin_externalpage_setup('competencymanage', '', array(), '', $CFG->wwwroot.'/competency/edit.php');

$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:updatecompetency', $sitecontext);

if (!$competency = get_record('competency', 'id', $id)) {
    error('Competency ID was incorrect');
}


///
/// Display page
///


// Load categories by parent id
$categories = array();
$parents = array();
make_categories_list($categories, $parents);

?>

<h2><?php echo get_string('assignnewevidenceitem', 'competency') ?></h2>

<div id="available-evidence" class="selected">
</div>

<p>
    Locate course:
</p>

<ul class="filetree treeview">
<?php

    $len = count($categories);
    $i = 0;
    $parent = array();

    // Add empty category to end of array to trigger
    // closing nested lists
    $categories[] = null;

    foreach ($categories as $id => $category) {
        $i++;

        // If an actual category
        if ($category !== null) {
            if (!isset($parents[$i])) {
                $this_parent = array();
            } else {
                $this_parents = array_reverse($parents[$i]);
                $this_parent = $parents[$i];
            }
        // If placeholder category at end
        } else {
            $this_parent = array();
        }

        if ($this_parent == $parent) {
            if ($i > 1) {
                echo '<li class="last loading"><div></div><span>Loading courses...</span></li></ul></li>';
            }
        } else {
            // If there are less parents now
            $diff = count($parent) - count($this_parent);

            if ($diff) {
                echo str_repeat('</li><li class="last loading"><div></div><span>Loading courses...</span></li></ul>', $diff + 1);
            }

            $parent = $this_parent;
        }

        if ($category !== null) {
            // Grab category name
            $rpos = strrpos($category, ' / ');
            if ($rpos) {
                $category = substr($category, $rpos + 3);
            }

            $li_class = 'expandable closed';
            $div_class = 'hitarea closed-hitarea expandable-hitarea';

            if ($i == $len) {
                $li_class .= ' lastExpandable';
                $div_class .= ' lastExpandable-hitarea';
            }

            echo '<li class="'.$li_class.'" id="item_list_'.$id.'"><div class="'.$div_class.'"></div>';
            echo '<span class="folder">'.$category.'</span><ul style="display: none;">'.PHP_EOL;
        }
    }

?>
</ul>
