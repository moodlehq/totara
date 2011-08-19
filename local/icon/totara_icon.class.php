<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
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
 * @author Alastair Munro <alastair.munro@totaralms.com>
 * @package totara
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

require_once($CFG->libdir.'/filelib.php');

abstract class totara_icon {

    public $icontype;

    public $icondir;

    public $table;

    public $field;

    public $size;

    public $extension;

    public $default;

    function __construct() {
        global $CFG;

        $this->field = 'icon';
        $this->size = 'large';
        $this->extension = '.png';
        $this->default = 'default';
    }


    /**
     *  Add a set of form elements for picking an icon
     *
     *  @param object $data If data contains an icon parameter then it will set that icon as the current icon
     *  @param mform &$mform Form object passed by reference
     */
    function add_to_form($data, &$mform) {
        global $CFG;

        $iconfield = $this->field;
        if (!isset($data->$iconfield)) {
            $data->$iconfield = '';
        }

        $icon_image_tag = '<img src="'.$CFG->wwwroot.'/local/icon/icon.php?icon='.urlencode($data->$iconfield).'&amp;size='.$this->size.'&amp;type='.$this->icontype.'" class="course_icon" id="icon_preview" />';

        $mform->addElement('header', 'iconheader', get_string($this->icontype.'icon', 'local'));
        $mform->addElement('static', 'currenticon', get_string('currenticon', 'local'), $icon_image_tag);
        $mform->addElement('select', 'icon', get_string('icon', 'local'), $this->get_stock_icons($this->icontype));
    }

    /**
     * Process update of icon
     *
     * @param object $data Form data to be processed
     * @return bool True if the update succeeds
     */
    function process_form($data) {
        $todb = new stdClass;
        $todb->id = $data->id;
        $iconfield = $this->field;

        if ($data->icon == 'none') {
            $todb->$iconfield = '';
        } else {
            $todb->$iconfield = $data->icon;
        }

        if (!update_record($this->table, $todb)) {
            return false;
        }

        return true;
    }


    /**
     *  @param string $iconname Name of the icon to display
     *  @param string $size Icon size
     *  @param array $attributes An array of extra attributes for the image tag returned
     *
     *  @return string Image tag for displaying specified image
     */
    function display($data, $size=null, $attributes=null) {
        global $CFG;

        if (isset($data->icon)) {
            $iconname = $data->icon;
        } else {
            if (!$iconname = get_field($this->table, $this->field, 'id', $data->id)) {
                // If we can't find the icon for this item show the default
                $this->icon = 'default'.$this->extension;
            }
        }

        $size = $size ? $size : $this->size;

        $filepath = $CFG->dirroot.'/theme/standard/'.$this->icontype.'icons';
        if (is_file($CFG->themedir.'/'.$CFG->theme.'/'.$this->icondir.'/'.$size.'/'.$iconname)) {
            $iconurl = $CFG->themewww.'/'.$CFG->theme.'/'.$this->icondir.'/'.$size.'/'.$iconname;

        }
        else if (is_file($CFG->dirroot.'/theme/standard/'.$this->icondir.'/'.$size.'/'.$iconname)) {
            $iconurl = $CFG->themewww.'/standard/'.$this->icondir.'/'.$size.'/'.$iconname;
        }
        else {
            $iconurl = $CFG->themewww.'/standard/'.$this->icondir.'/'.$size.'/default.png';
        }

        // Add css class
        if (is_array($attributes)) {
            if (!empty($attributes['class'])) {
                $attributes['class'] .= ' '.get_class($this);
            } else {
                $attributes['class'] = get_class($this);
            }
        } else {
            $attributes = array('class' => get_class($this));
        }

        $extra_attributes = '';
        if (is_array($attributes)) {
            foreach($attributes as $attr_key => $attr_value) {
                $extra_attributes .= " {$attr_key}=\"{$attr_value}\"";
            }
        }

        return '<img src="'.$iconurl.'" '.$extra_attributes.'/>';
    }


    /**
     * Get list of stock course icons
     *
     * @return array An array of icons ([image name] => "Icon name")
     */
    function get_stock_icons() {
        global $CFG;
        $icons = array('none' => get_string('none', 'local'));

        if ($path = $this->get_stock_icon_dir()) {
            $large_path = $path.'/large/';
            foreach (scandir($large_path) as $icon) {
                if (is_file($large_path.$icon) && (clean_param($icon, PARAM_FILE) == $icon)) {

                    $replace = array('_' => ' ', '-' => ' ', '.png' => '');
                    $icons[$icon] = ucwords(strtr($icon, $replace));
                }
            }
        }
        return($icons);
    }


    /**
     * Return the path to the course icon directory
     *
     * @global $CFG
     * @param string $size the size of the image to display
     * @return string The folder to get the icon stock
     */
    function get_stock_icon_dir($size='') {
        global $CFG;

        if (is_dir($CFG->themedir.'/'.$CFG->theme.'/'.$this->icondir.'/'.$size)) {
            return($CFG->themedir.'/'.$CFG->theme.'/'.$this->icondir.'/'.$size);
        } else if (is_dir($CFG->themedir.'/standard/'.$this->icondir.'/'.$size)) {
            return($CFG->themedir.'/standard/'.$this->icondir.'/'.$size);
        }
        else {
            return(false);
        }
    }

    /**
     * Constructs the path for the file and returns it if it exists
     *
     * @param string $icon Name of the icon
     * @param string $size Size of icon to return path for
     * @return array Array with 2 items (item and path) both strings
     */
    function get_icon_path($icon, $size='large'){
        $icondir = $this->get_stock_icon_dir($size);

        if (is_file($icondir.'/'.$icon)) {
            return array('icon' => $icon, 'path' => $icondir.'/'.$icon);
        } else {
            return array('icon' => $this->default.$this->extension, 'path' => $icondir.'/'.$this->default.$this->extension);
        }
    }
}

?>
