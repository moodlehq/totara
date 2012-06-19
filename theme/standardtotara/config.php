<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Configuration for Moodle's standard theme.
 *
 * This theme is the default theme within Moodle 2.0, it builds upon the base theme
 * adding only CSS to create the simple look and feel Moodlers have come to recognise.
 *
 * For full information about creating Moodle themes, see:
 *  http://docs.moodle.org/dev/Themes_2.0
 *
 * @package   moodlecore
 * @copyright 2010 Sam Hemelryk
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$THEME->name = 'standardtotara';
$THEME->parents = array('standard', 'base');
$THEME->sheets = array(
    'core',     /** Must come first**/
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
    'question',
    'pagelayout',
    'css3'      /** Sets up CSS 3 + browser specific styles **/
);

$THEME->layouts = array(
    // we want to show blocks on the default layout
    'base' => array(
        'file' => 'general.php',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-post',
        'options' => array('langmenu' => true),
    ),
    // pages that need the full width of the page - no blocks shown at all
    // this is only used by totara pages
    'noblocks' => array(
        'file' => 'general.php',
        'regions' => array(),
        'options' => array('noblocks'=>true, 'langmenu'=>true),
    ),
    // rather than having a separate layout file for the single sidebar report
    // layout, we re-use general.php and just exclude side-post from the regions list
    'report' => array(
        'file' => 'general.php',
        'regions' => array('side-pre'),
        'defaultregion' => 'side-pre',
    ),
    // hide the totara nav and login info on the login page as you need to login first
    'login' => array(
        'file' => 'general.php',
        'regions' => array(),
        'options' => array('langmenu'=>true, 'nologininfo' => true, 'nocustommenu' => true),
    ),
    // hide the login info section during maintenance as well
    'maintenance' => array(
        'file' => 'general.php',
        'regions' => array(),
        'options' => array('noblocks' => true, 'nofooter' => true, 'nonavbar' => true, 'nocustommenu' => true, 'nologininfo' => true),
    ),
    // also exclude login info on print view
    'print' => array(
        'file' => 'general.php',
        'regions' => array(),
        'options' => array('noblocks'=>true, 'nofooter'=>true, 'nonavbar'=>false, 'nocustommenu'=>true, 'nologininfo' => true),
    ),
);

$THEME->enable_dock = true;
$THEME->rendererfactory = 'theme_overridden_renderer_factory';
