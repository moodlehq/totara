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
 * Popup message processor - stores the message to be shown using the message popup
 */

require_once(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))) . '/config.php'); //included from messagelib (how to fix?)
require_once($CFG->dirroot.'/local/totara_msg/message20/output/lib.php');

class message_output_totara_alert extends message_output20{

    /**
     * Process the popup message.
     * The popup doesn't send data only saves in the database for later use,
     * the popup_interface.php takes the message from the message table into
     * the message_read.
     * @param object $eventdata the event data submitted by the message sender plus $eventdata->savedmessageid
     * @return true if ok, false if error
     */
    public function send_message($eventdata) {
        //global $DB;

        //hold onto the popup processor id because /admin/cron.php sends a lot of messages at once
        static $processorid = null;

        //prevent users from getting popup alerts of messages to themselves (happens with forum alerts)
        //if ($eventdata->userfrom->id!=$eventdata->userto->id) {
            if (empty($processorid)) {
                //$processor = $DB->get_record('message_processors20', array('name'=>'popup'));
                $processor = get_record('message_processors20', 'name', 'totara_alert');
                $processorid = $processor->id;
            }
            $procmessage = new stdClass();
            $procmessage->unreadmessageid = $eventdata->savedmessageid;
            $procmessage->processorid     = $processorid;

            //save this message for later delivery
            //$DB->insert_record('message_working20', $procmessage);
            insert_record('message_working20', $procmessage);
        //}

        return true;
    }

    function config_form($preferences) {
        return null;
    }

    public function process_form($form, &$preferences) {
        return true;
    }
    public function load_data(&$preferences, $userid) {
        global $USER;
        return true;
    }
}
