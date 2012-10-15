<?php

/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2012 Totara Learning Solutions LTD
 * Copyright (C) 1999 onwards Martin Dougiamas
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * renderer for mymobile totara theme
 *
 * @author Russell England <russell.england@totaralms.com>
 * @package theme
 * @subpackage mymobiletotara
 *
 * @copyright Totara Learning Solutions Ltd
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

include_once ($CFG->dirroot. '/mod/choice/renderer.php');

class theme_mymobile_totara_renderer extends plugin_renderer_base {

    /**
     * Create a mobile menu using jquery mobile classes - overrides print_totara_menu()
     *
     * @global object $PAGE
     * @param array $menudata Array of menu objects
     * @param string|null $parent Short name of parent
     * @param array|null $selected_items - not used by this function
     * @return string Output to display
     */
    public function print_totara_menu($menudata, $parent = null, $selected_items = array()) {
        global $PAGE;

        // Output to be displayed
        $output = '';

        // Collect the children for this parent
        $children = array();
        $collapsed = 'true'; // Note the quotes! Should be a string
        foreach ($menudata as $child) {
            // Default to no children
            $child->hasitems = false;
            if ($child->parent == $parent) {
                // The child menu properties
                $children[$child->name] = $child;
                if ($PAGE->totara_menu_selected && $PAGE->totara_menu_selected == $child->name) {
                    // Set to open if we are in the currently selected menu
                    $collapsed = 'false';
                }
            } elseif ($parent && $child->name == $parent) {
                // The current menu properties
                $thismenu = $child;
                if ($PAGE->totara_menu_selected && $PAGE->totara_menu_selected == $child->name) {
                    // Set to open if we are in the currently selected menu
                    $collapsed = 'false';
                }
            }
        }

        if ($parent == null) {
            // Its the root, so just print the children
            $output .= html_writer::start_tag('div', array('data-role' => 'collapsible-set'));
            foreach ($children as $child) {
                $output .= $this->print_totara_menu($menudata, $child->name);
            }
            $output .= html_writer::end_tag('div');
        } else {
            // Have the children got children?
            foreach ($menudata as $child) {
                if (isset($children[$child->parent])) {
                    $children[$child->parent]->hasitems = true;
                }
            }

            // Insert this menu's link at the top - is there a better way to do this?
            $thismenua[$thismenu->name] = $thismenu;
            $children = array_merge($thismenua, $children);

            // Create a collapsible menu
            $output .= html_writer::start_tag('div', array('data-role' => 'collapsible', 'data-collapsed' => $collapsed));

            // Print menu heading
            $output .= html_writer::start_tag('h1');
            $output .= $thismenu->linktext;
            $output .= html_writer::end_tag('h1');

            // Print the children
            $output .= html_writer::start_tag('ul', array('data-role' => 'listview'));

            foreach ($children as $child) {

                $output .= html_writer::start_tag('li');

                $url = new moodle_url($child->url);

                $output .= $this->output->action_link($url, $child->linktext);

                $output .= html_writer::end_tag('li');

                if ($child->hasitems) {
                    // There are children - so print the sub menu with heading
                    $output .= $this->print_totara_menu($menudata, $child->name);
                }
            }

            $output .= html_writer::end_tag('ul');
            $output .= html_writer::end_tag('div');
        }
        return $output;
    }
}