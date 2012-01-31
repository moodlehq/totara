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
 * @author [author name] <[email address]>
 * @package totara
 * @subpackage local 
 */

/**

This function returns the custom sticky blocks definition

todo: this could be written more elegantly, but no hurry...

**/


function get_custom_stickyblocks() {

    $blocks = array();

    $pinnedblock = new_stickyblock_def();
    $id = get_field('block', 'id', 'name', 'admin');
    $pinnedblock->pagetype ='Totara';
    $pinnedblock->position = 'l';
    $pinnedblock->weight = '0';
    $pinnedblock->blockid = $id;
    $blocks[] = $pinnedblock;

    $pinnedblock = new_stickyblock_def();
    $id = get_field('block', 'id', 'name', 'calendar_month');
    $pinnedblock->pagetype ='Totara';
    $pinnedblock->position = 'r';
    $pinnedblock->weight = '0';
    $pinnedblock->blockid = $id;
    $blocks[] = $pinnedblock;

    return $blocks;

}

/*
returns basic $pinnedblock object with parameters that don't change
*/

function new_stickyblock_def() {

    $obj = new stdclass();
    $obj->position='r';
    $obj->visible = '1';
    $obj->configdata = '';

    return $obj;

}

?>

