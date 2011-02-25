<?php // $Id$
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
 * @author  Simon Coggins <simonc@catalyst.net.nz>
 * @package totara
 * @subpackage plan
 */

/**
 * Add learning plans administration menu settings
 */

$ADMIN->add('root',
    new admin_category('local_plan',
    get_string('learningplans','local_plan'))
);

$ADMIN->add('local_plan',
    new admin_externalpage('managetemplates',
        get_string('managetemplates', 'local_plan'),
        "$CFG->wwwroot/local/plan/template/index.php",
        array('local/plan:configureplans')
    )
);

$ADMIN->add('local_plan',
    new admin_externalpage('priorityscales',
        get_string('priorityscales', 'local_plan'),
        "$CFG->wwwroot/local/plan/priorityscales/index.php",
        array('local/plan:configureplans')
    )
);

$ADMIN->add('local_plan',
    new admin_externalpage('objectivescales',
        get_string('objectivescales', 'local_plan'),
        "$CFG->wwwroot/local/plan/objectivescales/index.php",
        array('local/plan:configureplans')
    )
);
?>
