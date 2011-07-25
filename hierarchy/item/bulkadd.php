<?php

require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/item/bulkadd_form.php');
require_once($CFG->dirroot.'/hierarchy/lib.php');

///
/// Setup / loading data
///

$prefix = required_param('prefix', PARAM_ALPHA);
$shortprefix = hierarchy::get_short_prefix($prefix);

$frameworkid = required_param('frameworkid', PARAM_INT);
$page       = optional_param('page', 0, PARAM_INT);

$hierarchy = hierarchy::load_hierarchy($prefix);

// Make this page appear under the manage competencies admin item
admin_externalpage_setup($prefix.'manage', '', array('prefix'=>$prefix));

$context = get_context_instance(CONTEXT_SYSTEM);

require_capability('moodle/local:create'.$prefix, $context);

// Load framework
if (!$framework = get_record($shortprefix.'_framework', 'id', $frameworkid)) {
    error($prefix.' framework ID was incorrect');
}


///
/// Display page
///

// create form
$mform = new item_bulkadd_form(null, compact('prefix', 'frameworkid', 'page'));

// cancelled
if ($mform->is_cancelled()) {

    redirect("{$CFG->wwwroot}/hierarchy/index.php?prefix={$prefix}&amp;frameworkid={$item->frameworkid}&amp;page={$page}");

// Update data
} else if ($formdata = $mform->get_data()) {

    $items_to_add = hierarchy_construct_items_to_add($formdata);
    if (!$items_to_add) {
        totara_set_notification(get_string('bulkaddfailed', 'hierarchy'), "{$CFG->wwwroot}/hierarchy/index.php?prefix={$prefix}&amp;frameworkid={$frameworkid}&amp;page={$page}");
    }

    if ($new_ids = $hierarchy->add_multiple_items($formdata->parentid, $items_to_add, $frameworkid)) {
        add_to_log(SITEID, $prefix, 'bulk add', "index.php?id={$frameworkid}&amp;prefix={$prefix}", 'New IDs '. implode(',', $new_ids));
        totara_set_notification(get_string('bulkaddsuccess', 'hierarchy', count($new_ids)), "{$CFG->wwwroot}/hierarchy/index.php?prefix={$prefix}&amp;frameworkid={$frameworkid}&amp;page={$page}", array('style' => 'notifysuccess'));
    } else {
        totara_set_notification(get_string('bulkaddfailed', 'hierarchy'), "{$CFG->wwwroot}/hierarchy/index.php?prefix={$prefix}&amp;frameworkid={$frameworkid}&amp;page={$page}");

    }
}

$navlinks = array();    // Breadcrumbs
$navlinks[] = array('name'=>get_string("{$prefix}frameworks", $prefix), 'link'=>$CFG->wwwroot . '/hierarchy/framework/index.php?prefix='.$prefix, 'type'=>'misc');
$navlinks[] = array('name'=>format_string($framework->fullname), 'link'=>$CFG->wwwroot . '/hierarchy/index.php?prefix='.$prefix.'&amp;frameworkid='.$framework->id, 'type'=>'misc');
$navlinks[] = array('name'=>get_string('addmultiplenew'.$prefix, $prefix), 'link'=>'', 'type'=>'title');

/// Display page header
admin_externalpage_print_header('' ,$navlinks);

print_heading(get_string('addmultiplenew'.$prefix, $prefix));

/// Finally display the form
$mform->display();

print_footer();


/**
 * Create an array of hierarchy item objects based on the data from the bulkadd form
 *
 * Given the formdata from the bulkadd form, this function builds a set of skeleton objects that will
 * go into the database. They are still missing all the additional metadata such as hierarchy path,
 * depth, etc and timestamps. That data is added later by {@link hierarchy->add_multiple_items()}.
 *
 * @param object $formdata Form data from bulkadd form
 *
 * @return array Array of objects describing the new items
 */
function hierarchy_construct_items_to_add($formdata) {
    // get list of names then remove from the form object
    $items = explode("\n", trim($formdata->itemnames));
    unset($formdata->itemnames);

    $items_to_add = array();
    foreach ($items as $item) {
        if (strlen(trim($item)) == 0) {
            // don't include empty lines
            continue;
        }

        // copy the form object and set the item name
        $new = clone $formdata;
        $new->fullname = trim($item);
        if (HIERARCHY_DISPLAY_SHORTNAMES) {
            $new->shortname = substr(trim($item), 0, 100);
        }

        $items_to_add[] = $new;

    }

    // $itemnames was empty
    if (count($items_to_add) == 0) {
        return false;
    }

    return $items_to_add;
}
