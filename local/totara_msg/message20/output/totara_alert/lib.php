<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
 * Copyright (C) 1999 onwards Martin Dougiamas 
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
 * @author Piers Harding <piers@catalyst.net.nz>
 * @author Luis Rodrigues
 * @package totara
 * @subpackage totara_msg 
 */

/**
 * Popup message processor - lib file
 */

/**
 * Register the processor.
 */
function local_totara_alert_install(){
    //global $DB;

    $result = true;

    $provider = new stdClass();
    $provider->name  = 'totara_alert';
    //$DB->insert_record('message_processors20', $provider);
    //Avoid duplicate processors
    if (! record_exists('message_processors20', 'name', $provider->name)){
        insert_record('message_processors20', $provider);
    }
    return $result;
}
