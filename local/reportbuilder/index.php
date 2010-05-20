<?php // $Id$
    require_once('../../config.php');
    require_once($CFG->libdir.'/adminlib.php');
    require_once($CFG->dirroot.'/local/reportbuilder/lib.php');
    require_once('report_forms.php');

    $id = optional_param('id',null,PARAM_INT); // id for delete report
    $d = optional_param('d',false, PARAM_BOOL); // delete record?
    $em = optional_param('em', false, PARAM_BOOL); // embedded report?
    $confirm = optional_param('confirm', false, PARAM_BOOL); // confirm delete

    admin_externalpage_setup('reportbuilder');

    global $USER;

    $returnurl = $CFG->wwwroot.'/local/reportbuilder/index.php';

    // delete an existing report
    if($d && $confirm) {
        $type = $em ? 'reload' : 'delete';
        if(!confirm_sesskey()) {
            print_error('confirmsesskeybad','error');
        }
        if(delete_report($id)) {
            redirect($returnurl, get_string($type.'report', 'local'));
        } else {
            redirect($returnurl, get_string('no'.$type.'report', 'local'));
        }
    } else if($d) {
        $type = $em ? 'reload' : 'delete';
        admin_externalpage_print_header();
        print_heading(get_string('reportbuilder','local'));
        if($em) {
            notice_yesno(get_string('reportconfirm'.$type,'local'),"index.php?id={$id}&amp;d=1&amp;em={$em}&amp;confirm=1&amp;sesskey={$USER->sesskey}", $returnurl);
        } else {
            notice_yesno(get_string('reportconfirm'.$type,'local'),"index.php?id={$id}&amp;d=1&amp;em={$em}&amp;confirm=1&amp;sesskey={$USER->sesskey}", $returnurl);
        }
        print_footer();
        die;
    }

    // form definition
    $mform =& new report_builder_new_form();

    // form results check
    if ($mform->is_cancelled()) {
        redirect($returnurl);
    }
    if ($fromform = $mform->get_data()) {

        if(empty($fromform->submitbutton)) {
            print_error('error:unknownbuttonclicked', 'local', $returnurl);
        }
        // create new record here
        $todb = new object();
        $todb->fullname = $fromform->fullname;
        $todb->shortname = reportbuilder::create_shortname($fromform->fullname);
        $todb->source = ($fromform->source != '0') ? $fromform->source : null;
        $todb->hidden = $fromform->hidden;
        $todb->contentmode = 0;
        $todb->accessmode = 0;
        $todb->embeddedurl = null;
        //TODO set default content and access settings here?

        begin_sql();
        if(!$newid = insert_record('report_builder',$todb)) {
            rollback_sql();
            redirect($returnurl, get_string('error:couldnotcreatenewreport','local'));
        }

        // create with default columns and filters
        $columns = reportbuilder::get_source_data('defaultcolumns',$fromform->source);
        $filters = reportbuilder::get_source_data('defaultfilters',$fromform->source);

        $so = 1;
        foreach($columns as $column) {
            $todb = new object();
            $todb->reportid = $newid;
            $todb->type = $column['type'];
            $todb->value = $column['value'];
            $todb->heading = $column['heading'];
            $todb->sortorder = $so;
            if(!insert_record('report_builder_columns', $todb)) {
                rollback_sql();
                redirect($returnurl, get_string('error:couldnotcreatenewreport','local'));
            }
            $so++;
        }

        // add filters
        $so = 1;
        foreach($filters as $filter) {
            $todb = new object();
            $todb->reportid = $newid;
            $todb->type = $filter['type'];
            $todb->value = $filter['value'];
            $todb->advanced = $filter['advanced'];
            $todb->sortorder = $so;
            if(!insert_record('report_builder_filters', $todb)) {
                rollback_sql();
                redirect($returnurl, get_string('error:couldnotcreatenewreport','local'));
            }
            $so++;
        }

        commit_sql();
        redirect($CFG->wwwroot.'/local/reportbuilder/access.php?id='.$newid);
    }

    admin_externalpage_print_header();

    print_heading(get_string('usergeneratedreports','local'));

    $tableheader = array(get_string('name','local'),
                         get_string('source','local'),
                         get_string('options','local'));

    $reports = get_records_select('report_builder','embeddedurl IS NULL','fullname');
    if($reports) {
        $data = array();
        foreach($reports as $report) {
            $row = array();
            $strsettings = get_string('settings','local');
            $strdelete = get_string('delete','local');
            $viewurl = ($report->embeddedurl === null) ? $CFG->wwwroot .
                '/local/reportbuilder/report.php?id='.$report->id :
                $report->embeddedurl;
            $settings = '<a href="'.$CFG->wwwroot.'/local/reportbuilder/settings.php?id='.$report->id.'" title="'.$strsettings.'">' .
                '<img src="'.$CFG->pixpath.'/t/edit.gif" alt="'.$strsettings.'"></a>';
            $delete = '<a href="'.$CFG->wwwroot.'/local/reportbuilder/index.php?d=1&amp;id='.$report->id.'" title="'.$strdelete.'">' .
                '<img src="'.$CFG->pixpath.'/t/delete.gif" alt="'.$strdelete.'"></a>';
            $row[] = '<a href="'.$CFG->wwwroot.'/local/reportbuilder/settings.php?id='.$report->id.'">'.$report->fullname.'</a>' .
                ' (<a href="'.$viewurl.'">'.get_string('view').'</a>)';
            $row[] = $report->source;
            $row[] = "$settings &nbsp; $delete";
            $data[] = $row;
        }

        $reportstable = new object();
        $reportstable->summary = '';
        $reportstable->head = $tableheader;
        $reportstable->data = $data;
        print_table($reportstable);
    } else {
        print get_string('noreports','local');
    }

    print '<br />';
    print_heading(get_string('embeddedreports','local'));

    $embeddedreports = get_records_select('report_builder','embeddedurl IS NOT NULL','fullname');
    if($embeddedreports) {
        $data = array();
        foreach($embeddedreports as $report) {
            $row = array();
            $strsettings = get_string('settings','local');
            $strdelete = get_string('delete','local');
            $viewurl = ($report->embeddedurl === null) ? $CFG->wwwroot .
                '/local/reportbuilder/report.php?id='.$report->id :
                $report->embeddedurl;
            $settings = '<a href="'.$CFG->wwwroot.'/local/reportbuilder/settings.php?id='.$report->id.'" title="'.$strsettings.'">' .
                '<img src="'.$CFG->pixpath.'/t/edit.gif" alt="'.$strsettings.'"></a>';
            $delete = '<a href="'.$CFG->wwwroot.'/local/reportbuilder/index.php?em=1&amp;d=1&amp;id='.$report->id.'" title="'.$strdelete.'">' .
                '<img src="'.$CFG->pixpath.'/t/delete.gif" alt="'.$strdelete.'"></a>';
            $row[] = '<a href="'.$CFG->wwwroot.'/local/reportbuilder/settings.php?id='.$report->id.'">'.$report->fullname.'</a>' .
                ' (<a href="'.$viewurl.'">'.get_string('view').'</a>)';
            $row[] = $report->source;
            $row[] = "$settings &nbsp; $delete";
            $data[] = $row;
        }
        $embeddedreportstable = new object();
        $embeddedreportstable->summary = '';
        $embeddedreportstable->head = $tableheader;
        $embeddedreportstable->data = $data;
        print_table($embeddedreportstable);
    } else {
        print get_string('noembeddedreports','local');
    }
    print '<br /><br />';
    // display mform
    $mform->display();

    admin_externalpage_print_footer();


// page specific functions

/*
 * Deletes a report and any associated data
 *
 * @param integer $id ID of the report to delete
 */
function delete_report($id) {

    if(!$id) {
        return false;
    }

    begin_sql();
    // delete the report
    if(!delete_records('report_builder','id',$id)) {
        rollback_sql();
        return false;
    }
    // delete any columns
    if(!delete_records('report_builder_columns','reportid',$id)) {
        rollback_sql();
        return false;
    }
    // delete any filters
    if(!delete_records('report_builder_filters','reportid',$id)) {
        rollback_sql();
        return false;
    }
    // delete any access settings
    if(!delete_records('report_builder_access','reportid',$id)) {
        rollback_sql();
        return false;
    }
    // delete any saved searches
    if(!delete_records('report_builder_saved','reportid',$id)) {
        rollback_sql();
        return false;
    }

    // all okay commit changes
    commit_sql();
    return true;

}

?>
