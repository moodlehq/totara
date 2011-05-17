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

class rb_bookings_embedded extends rb_base_embedded {

    public $url, $source, $fullname, $filters, $columns;
    public $contentmode, $contentsettings, $embeddedparams;
    public $hidden, $accessmode, $accesssettings, $shortname;

    public function __construct($data) {
        $userid = array_key_exists('userid', $data) ? $data['userid'] : null;

        $this->url = '/my/bookings.php';
        $this->source = 'facetoface_sessions';
        $this->shortname = 'bookings';
        $this->fullname = get_string('mybookings', 'local');
        $this->columns = array(
            array(
                'type' => 'course',
                'value' => 'courselink',
                'heading' => get_string('coursename', 'local_reportbuilder'),
            ),
            array(
                'type' => 'facetoface',
                'value' => 'name',
                'heading' => get_string('ftfname', 'rb_source_facetoface_sessions'),
            ),
            array(
                'type' => 'date',
                'value' => 'sessiondate',
                'heading' => get_string('sessdate', 'rb_source_facetoface_sessions'),
            ),
            array(
                'type' => 'date',
                'value' => 'timestart',
                'heading' => get_string('starttime', 'rb_source_facetoface_sessions'),
            ),
            array(
                'type' => 'date',
                'value' => 'timefinish',
                'heading' => get_string('endtime', 'rb_source_facetoface_sessions'),
            ),
        );

        // only add facilitator column if role exists
        if(get_field('role','id','shortname','facilitator')) {
            $this->columns[] = array(
                'type' => 'role',
                'value' => 'facilitator',
                'heading' => get_string('facilitator', 'rb_source_facetoface_sessions'),
            );
        }

        // no filters
        $this->filters = array();

        // only show future bookings
        $this->contentmode = REPORT_BUILDER_CONTENT_MODE_ALL;
        $this->contentsettings = array(
            'date' => array(
                'enable' => 1,
                'when' => 'future',
            ),
        );

        // also limited to single user by embedded params
        $this->embeddedparams = array();
        if(isset($userid)) {
            $this->embeddedparams['userid'] = $userid;
        }

        parent::__construct();
    }
}
