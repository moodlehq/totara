<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2012 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
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
 * @author Simon Coggins <simon.coggins@totaralms.com>
 * @package totara
 * @subpackage totara_core
 */
require_once('tablelib.php');

/**
 * This class extends the flexible_table class and adds toolbar functionality
 */
class totara_table extends flexible_table {

    protected $toolbar;

    function __construct($uniqueid) {
        parent::__construct($uniqueid);
        $this->toolbar = array(
            'top' => array(),
            'bottom' => array()
        );
    }

    /**
     * Add some content to one of the table's toolbars
     *
     * @param string $content HTML to add
     * @param string $side Which side content should be added. Either 'left' or 'right'
     * @param string $position Which toolbar to add content to. Either 'top' or 'bottom'
     * @param integer $index Which toolbar to add content to
     * @return boolean If the content could be added or not
     */
    function add_toolbar_content($content, $side = 'left', $position = 'top', $index = 0) {
        if (!in_array($position, array('top', 'bottom'))) {
            debugging("print_toolbars: Unknown position '{$position}', should be 'top' or 'bottom'");
            return false;
        }
        if (!in_array($side, array('right', 'left'))) {
            debugging("print_toolbars: Unknown side '{$side}', should be 'right' or 'left'");
            return false;
        }

        if (!array_key_exists($index, $this->toolbar[$position])) {
            $this->toolbar[$position][$index] = array();
        }

        if (!array_key_exists($side, $this->toolbar[$position][$index])) {
            $this->toolbar[$position][$index][$side] = array();
        }

        $this->toolbar[$position][$index][$side][] = $content;

        return true;
    }


    /**
     * Render a set of toolbars (either top or bottom)
     *
     * @param string $position Which toolbar to render (top or bottom)
     * @return boolean True if the toolbar was successfully rendered
     */
    function print_toolbars($position = 'top') {
        if (!in_array($position, array('top', 'bottom'))) {
            debugging("print_toolbars: Unknown position '{$position}', should be 'top' or 'bottom'");
            return false;
        }
        $numcols = count($this->columns);
        ksort($this->toolbar[$position]);

        $count = 1;
        $totalcount = count($this->toolbar[$position]);
        foreach ($this->toolbar[$position] as $index => $row) {
            // don't render empty toolbars
            // if you want to render one, add an empty content string to the toolbar
            if (empty($row['left']) && empty($row['right'])) {
                continue;
            }

            $trclass = "toolbar-{$position}";
            if ($count == 1) {
                $trclass .= ' first';
            }
            if ($count == $totalcount) {
                $trclass .= ' last';
            }

            echo html_writer::start_tag('tr', array('class' => $trclass));
            echo html_writer::start_tag('td', array('class' => 'toolbar', 'colspan' => $numcols));

            // nested tables are unfortunately necessary to get IE support without nasty CSS hacks

            // put right side first so it floats on top of left side when insufficent horizontal space
            if (!empty($row['right'])) {
                echo html_writer::start_tag('table', array('class' => 'toolbar-right-table'));
                echo html_writer::start_tag('tr', array('class' => 'toolbar-row'));
                foreach ($row['right'] as $item) {
                    echo html_writer::tag('td', $item, array('class' => 'toolbar-cell'));
                }
                echo html_writer::end_tag('tr');
                echo html_writer::end_tag('table');
            }

            if (!empty($row['left'])) {
                echo html_writer::start_tag('table', array('class' => 'toolbar-left-table'));
                echo html_writer::start_tag('tr', array('class' => 'toolbar-row'));
                foreach ($row['left'] as $item) {
                    echo html_writer::tag('td', $item, array('class' => 'toolbar-cell'));
                }
                echo html_writer::end_tag('tr');
                echo html_writer::end_tag('table');
            }

            echo html_writer::end_tag('td');
            echo html_writer::end_tag('tr');
            $count++;
        }

        return true;
    }


    /**
     * Start outputing content
     *
     * The only change made to parent function is to insert the call to print_toolbars()
     *
     * @return null
     */
    function start_output() {
        $this->started_output = true;
        if ($this->exportclass!==null) {
            $this->exportclass->start_table($this->sheettitle);
            $this->exportclass->output_headers($this->headers);
        } else {
            $this->start_html();
            $this->print_toolbars('top');
            $this->print_headers();
        }
    }

    /**
     * Output the end of the table
     *
     * The only change made to parent function is to insert the call to print_toolbars()
     *
     * @return null|false
     */
    function print_html() {
        if (!$this->setup) {
            return false;
        }
        $this->print_toolbars('bottom');
        $this->finish_html();
    }

    /**
     * Setup the table
     *
     * Re-use parent class, but also add 'totaratable' class
     */
    function setup() {
        parent::setup();
        // Always introduce the "totaratable" class for the table if not specified
        if (empty($this->attributes)) {
            $this->attributes['class'] = 'totaratable';
        } else if (!isset($this->attributes['class'])) {
            $this->attributes['class'] = 'totaratable';
        } else if (!in_array('totaratable', explode(' ', $this->attributes['class']))) {
            $this->attributes['class'] = trim('totaratable ' . $this->attributes['class']);
        }
    }
}
