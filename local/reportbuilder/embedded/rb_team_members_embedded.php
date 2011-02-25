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

class rb_team_members_embedded extends rb_base_embedded {

    public $url, $source, $fullname, $filters, $columns;
    public $contentmode, $contentsettings, $embeddedparams;
    public $hidden, $accessmode, $accesssettings, $shortname;

    public function __construct($data) {
        $this->url = '/my/teammembers.php';
        $this->source = 'user';
        $this->shortname = 'team_members';
        $this->fullname = get_string('teammembers', 'local');
        $this->columns = array(
            array(
                'type' => 'user',
                'value' => 'namewithlinks',
                'heading' => 'Name'
            ),
            array(
                'type' => 'user',
                'value' => 'lastlogin',
                'heading' => 'Last Login'
            ),
            array(
                'type' => 'statistics',
                'value' => 'coursesstarted',
                'heading' => 'Courses Started'
            ),
            array(
                'type' => 'statistics',
                'value' => 'coursescompleted',
                'heading' => 'Courses Completed'
            ),
            array(
                'type' => 'statistics',
                'value' => 'competenciesachieved',
                'heading' => 'Competencies Achieved'
            ),
        );

        // no filters
        $this->filters = array();

        // only show future bookings
        $this->contentmode = REPORT_BUILDER_CONTENT_MODE_ALL;
        $this->contentsettings = array(
            'user' => array(
                'enable' => 1,
                'who' => 'reports'
            )
        );

        parent::__construct();
    }
}
