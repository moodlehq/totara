<?php

///////////////////////////////////////////////////////////////////////////
//                                                                       //
// NOTICE OF COPYRIGHT                                                   //
//                                                                       //
// Moodle - Modular Object-Oriented Dynamic Learning Environment         //
//          http://moodle.com                                            //
//                                                                       //
// Copyright (C) 1999 onwards  Martin Dougiamas  http://moodle.com       //
//                                                                       //
// This program is free software; you can redistribute it and/or modify  //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation; either version 2 of the License, or     //
// (at your option) any later version.                                   //
//                                                                       //
// This program is distributed in the hope that it will be useful,       //
// but WITHOUT ANY WARRANTY; without even the implied warranty of        //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         //
// GNU General Public License for more details:                          //
//                                                                       //
//          http://www.gnu.org/copyleft/gpl.html                         //
//                                                                       //
///////////////////////////////////////////////////////////////////////////

/**
 * Popup message processor - lib file
 *
 * @author Luis Rodrigues
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package
 */

/**
 * Register the processor.
 */
function totara_reminder_install(){
    //global $DB;

    $result = true;

    $provider = new stdClass();
    $provider->name  = 'totara_reminder';
    //$DB->insert_record('message_processors20', $provider);
    insert_record('message_processors20', $provider);
    return $result;
}
