<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2013 Totara Learning Solutions LTD
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
 * @author Paul Walker <paul.walker@catalyst-eu.net>
 * @package totara
 * @subpackage theme
 *
 * @copyright Totara Learning Solutions Ltd
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$THEME->name = 'standardtotararesponsive';
$THEME->parents = array('bootstrapbase');
$THEME->sheets = array(
    'core',     // Must come first.
    'navigation',
    'admin',
    'blocks',
    'calendar',
    'course',
    'user',
    'dock',
    'grade',
    'message',
    'modules',
    'pagelayout',
    'question',
    'plugins',
    'totara_jquery_treeview',
    'totara_jquery_datatables',
    'totara_jquery_ui_dialog',
    'totara',
    'css3'      // Sets up CSS 3 + browser specific styles.
);

$THEME->layouts = array(
    'noblocks' => array(
        'file' => 'columns1.php',
        'regions' => array(),
        'options' => array('noblocks'=>true, 'langmenu'=>true),
    )
);

$THEME->enable_dock = true;
$THEME->rendererfactory = 'theme_overridden_renderer_factory';
