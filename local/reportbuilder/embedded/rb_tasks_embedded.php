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
 * @author Simon Coggins <simonc@catalyst.net.nz>
 * @package totara
 * @subpackage reportbuilder 
 */

class rb_tasks_embedded extends rb_base_embedded {

    public $url, $source, $fullname, $filters, $columns;
    public $contentmode, $contentsettings, $embeddedparams;
    public $hidden, $accessmode, $accesssettings, $shortname;

    public function __construct($data) {
        $userid = array_key_exists('userid', $data) ? $data['userid'] : null;
        $roleid = array_key_exists('roleid', $data) ? $data['roleid'] : null;

        $this->url = '/local/totara_msg/tasks.php';
        $this->source = 'totaramessages';
        $this->shortname = 'tasks';
        $this->fullname = get_string('tasks', 'local_totara_msg');
        $this->columns = array(
            array(
                'type' => 'message_values',
                'value' => 'msgtype',
                'heading' => 'Type',
            ),
            array(
                'type' => 'user',
                'value' => 'namelink',
                'heading' => 'Name',
            ),
            array(
                'type' => 'message_values',
                'value' => 'statementurl',
                'heading' => 'Details',
            ),
                array(
                'type' => 'message_values',
                'value' => 'sent',
                'heading' => 'Sent',
            ),
        );

        $this->filters = array(
            array(
                    'type' => 'user',
                    'value' => 'fullname',
                    'advanced' => 1,
                ),
            array(
                    'type' => 'message_values',
                    'value' => 'category',
                    'advanced' => 0,
                ),
            array(
                    'type' => 'message_values',
                    'value' => 'statement',
                    'advanced' => 1,
                ),
            array(
                    'type' => 'message_values',
                    'value' => 'sent',
                    'advanced' => 1,
                ),
        );

        // no restrictions
        $this->contentmode = REPORT_BUILDER_CONTENT_MODE_NONE;

        // only show tasks, not notifications
        $this->embeddedparams = array(
            'name' => '\'totara_task\''
        );
        // also limited to single user
        if(isset($userid)) {
            $this->embeddedparams['userid'] = $userid;
        }
        // also limited by role
        if(isset($roleid)) {
            $this->embeddedparams['roleid'] = $roleid;
        }

        parent::__construct();
    }
}
