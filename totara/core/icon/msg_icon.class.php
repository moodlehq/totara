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

require_once($CFG->dirroot . '/local/icon/totara_icon.class.php');

class msg_icon extends totara_icon {

    function __construct() {
        global $CFG;

        parent::__construct();

        $this->icontype = 'totaramsg';
        $this->icondir = 'pix/msgicons';
        $this->extension = '.gif';
    }


    /**
     * Return the path to the course icon directory
     * without size for totara_msg icons
     *
     * @global $CFG
     * @return string The folder to get the icon stock
     */
    function get_stock_icon_dir($size='') {
        global $CFG;

        if (is_dir($CFG->themedir.'/'.$CFG->theme.'/'.$this->icondir)) {
            return($CFG->themedir.'/'.$CFG->theme.'/'.$this->icondir);
        } else if (is_dir($CFG->themedir.'/standard/'.$this->icondir)) {
            return($CFG->themedir.'/standard/'.$this->icondir);
        }
        else {
            return(false);
        }
    }

    function get_icon_path($icon, $size='large'){
        $icondir = $this->get_stock_icon_dir();

        if(is_file($icondir.'/'.$icon.$this->extension)) {
            return array('icon' => $icon.$this->extension, 'path' => $icondir.'/'.$icon.$this->extension);
        } else {
            return array('icon' => 'default'.$this->extension, 'path' => $icondir.'/default'.$this->extension);
        }
    }

}
