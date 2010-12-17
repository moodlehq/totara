<?php

// helper functions for totara theme


/**
 * Loops through the navigation options and returns an array of classes
 *
 * The array contains the navigation option name as a key, and a string
 * to be inserted into a class as the value. The string is either
 * ' selected' if the option is currently selected, or an empty string ('')
 *
 * @param array $navstructure A nested array containing the structure of the menu
 * @param string $primary_selected The name of the primary option
 * @param string $secondary_selected The name of the secondary option
 *
 * @return array Array of strings, keyed on option names
 */
function totara_get_nav_select_classes($navstructure, $primary_selected, $secondary_selected) {

    $selectedstr = ' selected';
    $selected = array();
    foreach($navstructure as $primary => $secondaries) {
        if($primary_selected == $primary) {
            $selected[$primary] = $selectedstr;
        } else {
            $selected[$primary] = '';
        }
        foreach($secondaries as $secondary) {
            if($secondary_selected == $secondary) {
                $selected[$secondary] = $selectedstr;
            } else {
                $selected[$secondary] = '';
            }
        }
    }
    return $selected;
}


/**
 * Returns an array of class strings to add to each navigation tab
 *
 * Strings are empty unless the page should be shown as 'selected'. Keys
 * are the tab names from $navstructure array
 *
 * @param array $navstructure Multi-dimensional array of the tab structure
 * @param array $navmatches URL matches for each tab name
 *
 * @return array Array of class strings to add to menu items
 */
function totara_get_selected_navs($navstructure, $navmatches) {

    $selected = null;
    foreach ($navmatches as $pagename => $partialurls) {
        if(is_array($partialurls)) {
            foreach($partialurls as $partialurl) {
                if(strncmp(me(), $partialurl,
                    strlen($partialurl)) == 0) {
                        $selected = $pagename;
                    }
            }
        } else {
            if(strncmp(me(), $partialurls,
                strlen($partialurls)) == 0) {
                    $selected = $pagename;
                }
        }
    }

    // now work out if any primary items should be selected
    $primary_selected = null;
    $secondary_selected = null;
    foreach($navstructure as $primary => $secondaries) {
        // this is a primary item
        if($selected == $primary) {
            $primary_selected = $primary;
            $secondary_selected = null;
        }
        // this is a secondary item, find which primary
        // item it belongs to
        if(in_array($selected, $secondaries)) {
            $primary_selected = $primary;
            $secondary_selected = $selected;
        }
        // otherwise, none set
    }
    return array($primary_selected, $secondary_selected);
}
