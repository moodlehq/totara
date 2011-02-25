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
 * @author Simon Coggins <simonc@catalyst.net.nz>
 * @package totara
 * @subpackage reportbuilder 
 */

require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/reportheading/lib.php');
require_once($CFG->dirroot.'/local/reportheading/report_forms.php');

global $USER;
$d = optional_param('d', null, PARAM_TEXT); // delete
$m = optional_param('m', null, PARAM_TEXT); // move
$cid = optional_param('cid',null,PARAM_INT); //column id
$confirm = optional_param('confirm', 0, PARAM_INT); // confirm delete

admin_externalpage_setup('reportheading');
$returnurl = $CFG->wwwroot."/local/reportheading/index.php";

$heading = new reportheading();
// delete column
if ($d and $confirm ) {
    if(!confirm_sesskey()) {
        print_error('confirmsesskeybad','error');
    }

    if(isset($cid)) {
        if($heading->delete_column($cid)) {
            redirect($returnurl);
        } else {
            redirect($returnurl, 'Column could not be deleted');
        }
    }
}

// confirm deletion column
if ($d) {

    admin_externalpage_print_header();

    if(isset($cid)) {
        notice_yesno('Are you sure you want to delete this column?',"index.php?d=1&amp;cid=$cid&amp;confirm=1&amp;sesskey=$USER->sesskey", $returnurl);
    }

    admin_externalpage_print_footer();
    die;
}

// move column
if($m && isset($cid)) {
    if($heading->move_column($cid, $m)) {
        redirect($returnurl);
    } else {
        redirect($returnurl, 'Column could not be moved');
    }
}

// form definition
$mform =& new report_heading_columns_form(null, compact('heading'));

// form results check
if ($mform->is_cancelled()) {
    redirect($CFG->wwwroot.'/local/reportheading/index.php');
}
if ($fromform = $mform->get_data()) {

    if(empty($fromform->submitbutton)) {
        print_error('error:unknownbuttonclicked', 'local', $returnurl);
    }

    if(build_columns($fromform)) {
        redirect($returnurl);
    } else {
        redirect($returnurl, get_string('error:couldnotupdatereport','local'));
    }

}

admin_externalpage_print_header();

print_heading(get_string('editheading','local'));

// display the form
$mform->display();

// disable heading and defaultvalue when page loads
print<<<EOF
<script>
document.getElementById('id_newheading').disabled = true;
document.getElementById('id_newdefaultvalue').disabled = true;
</script>
EOF;

admin_externalpage_print_footer();



function build_columns($fromform) {
    begin_sql();

    if ($oldcolumns = get_records('report_heading_items')) {
        // see if existing columns have changed
        foreach($oldcolumns as $cid => $oldcolumn) {
            $columnname = "column{$cid}";
            $headingname = "heading{$cid}";
            $defaultvaluename = "defaultvalue{$cid}";
            // update db only if column has changed
            if(isset($fromform->$columnname) &&
                ($fromform->$columnname != $oldcolumn->type ||
                $fromform->$headingname != $oldcolumn->heading ||
                $fromform->$defaultvaluename != $oldcolumn->defaultvalue)) {
                $todb = new object();
                $todb->id = $cid;
                $todb->type = $fromform->$columnname;
                $todb->heading = $fromform->$headingname;
                $todb->defaultvalue = $fromform->$defaultvaluename;
                if(!update_record('report_heading_items', $todb)) {
                    rollback_sql();
                    return false;
                }
            }
        }
    }

    // add any new columns
    if(isset($fromform->newcolumns) && $fromform->newcolumns != '0') {
        $todb = new object();
        $todb->type = $fromform->newcolumns;
        $todb->heading = $fromform->newheading;
        $todb->defaultvalue = $fromform->newdefaultvalue;
        $sortorder = get_field('report_heading_items', 'MAX(sortorder) + 1','','');
        if(!$sortorder) {
            $sortorder = 1;
        }
        $todb->sortorder = $sortorder;
        if(!insert_record('report_heading_items', $todb)) {
            rollback_sql();
            return false;
        }
    }

    commit_sql();
    return true;
}


?>
