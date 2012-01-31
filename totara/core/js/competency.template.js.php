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
 * @author Eugene Venter <eugene@catalyst.net.nz>
 * @author Aaron Barnes <aaronb@catalyst.net.nz>
 * @package totara
 * @subpackage plan
 */

    require_once('../../config.php');

    $templateid = optional_param('id', 0, PARAM_INT);

?>

// Bind functionality to page on load
$(function() {

    ///
    /// Add related competency dialog
    ///
    (function() {
        var url = '<?php echo $CFG->wwwroot ?>/hierarchy/prefix/competency/template/';

        totaraMultiSelectDialog(
            'assignment',
            '<?php echo '<h2>' . get_string('assignnewcompetency', 'competency') . '</h2>'; ?>',
            url+'find_competency.php?templateid=<?php echo $templateid; ?>',
            url+'save_competency.php?templateid=<?php echo $templateid; ?>&deleteexisting=1&add='
        );
    })();

});
