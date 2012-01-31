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
 * @author Matthew Clarkson <mattc@catalyst.net.nz>
 * @author Alastair Munro <alastair.munro@totaralms.com>
 * @package totara
 * @subpackage local
 */

require('../../config.php');
require_once($CFG->libdir.'/filelib.php');

$type   = required_param('type', PARAM_TEXT);
$icon   = required_param('icon', PARAM_FILE);
$size   = optional_param('size', 'large', PARAM_SAFEDIR);

$sizes = array('large', 'small');

if (!in_array($size, $sizes)) {
    $size = 'small';
}

require_once($CFG->dirroot.'/local/icon/'.$type.'_icon.class.php');

$classname = $type . '_icon';
$class_inst = new $classname();

$icondetails = $class_inst->get_icon_path($icon, $size);
$iconname = $icondetails['icon'];
$iconpath = $icondetails['path'];

send_file($iconpath, $iconname);
