<?php // $Id$

/**
 * Page containing list of available reports and new report form
 *
 * @copyright Catalyst IT Limited
 * @author Simon Coggins
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage reportbuilder
 */

    require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
    require_once($CFG->libdir.'/adminlib.php');
    require_once($CFG->dirroot.'/local/reportbuilder/lib.php');
    require_once('report_forms.php');

    $id = optional_param('id',null,PARAM_INT); // id for delete report
    $d = optional_param('d',false, PARAM_BOOL); // delete record?
    $em = optional_param('em', false, PARAM_BOOL); // embedded report?
    $confirm = optional_param('confirm', false, PARAM_BOOL); // confirm delete
    $notice = optional_param('notice', 0, PARAM_INT); // notice flag

    admin_externalpage_setup('managereports');

    global $USER;

    $returnurl = $CFG->wwwroot.'/local/reportbuilder/index.php';
    $type = $em ? 'reload' : 'delete';

    // delete an existing report
    if($d && $confirm) {
        if(!confirm_sesskey()) {
            redirect($returnurl . '?notice=' .
                REPORT_BUILDER_FAILED_DELETE_SESSKEY);
        }
        if(delete_report($id)) {
            redirect($returnurl . '?notice=' .
                REPORT_BUILDER_REPORT_CONFIRM_DELETE);
        } else {
            redirect($returnurl . '?notice=' .
                REPORT_BUILDER_REPORT_FAILED_DELETE);
        }
    } else if($d) {
        admin_externalpage_print_header();
        print_heading(get_string('reportbuilder','local_reportbuilder'));
        if($em) {
            notice_yesno(get_string('reportconfirm'.$type,'local_reportbuilder'),"index.php?id={$id}&amp;d=1&amp;em={$em}&amp;confirm=1&amp;sesskey={$USER->sesskey}", $returnurl);
        } else {
            notice_yesno(get_string('reportconfirm'.$type,'local_reportbuilder'),"index.php?id={$id}&amp;d=1&amp;em={$em}&amp;confirm=1&amp;sesskey={$USER->sesskey}", $returnurl);
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
            redirect($returnurl . '?notice=' .
                REPORT_BUILDER_UNKNOWN_BUTTON_CLICKED);
        }
        // create new record here
        $todb = new object();
        $todb->fullname = $fromform->fullname;
        $todb->shortname = reportbuilder::create_shortname($fromform->fullname);
        $todb->source = ($fromform->source != '0') ? $fromform->source : null;
        $todb->hidden = $fromform->hidden;
        $todb->contentmode = 0;
        $todb->accessmode = 1; // default to limited access
        $todb->embeddedurl = null;
        //TODO set default content and access settings here?

        begin_sql();
        if(!$newid = insert_record('report_builder',$todb)) {
            rollback_sql();
            redirect($returnurl, get_string('error:couldnotcreatenewreport','local_reportbuilder'));
        }

        // if administrator or admin role exists, restrict access to new report to administrators only
        // (if role doesn't exist report will not be visible to anyone)
        if($adminroleid = get_field('role', 'id', 'shortname', 'administrator') ||
           $adminroleid = get_field('role', 'id', 'shortname', 'admin')) {
            $todb = new object();
            $todb->reportid = $newid;
            $todb->type = 'role_access';
            $todb->name = 'enable';
            $todb->value = 1;

            $todb2 = new object();
            $todb2->reportid = $newid;
            $todb2->type = 'role_access';
            $todb2->name = 'activeroles';
            $todb2->value = '1';

            if(!insert_record('report_builder_settings', $todb) ||
                !insert_record('report_builder_settings', $todb2)) {
                rollback_sql();
                redirect($returnurl, get_string('error:couldnotcreatenewreport','local_reportbuilder'));
            }
        }

        // create columns for new report based on default columns
        $src = reportbuilder::get_source_object($fromform->source);
        if(isset($src->defaultcolumns) && is_array($src->defaultcolumns)) {
            $defaultcolumns = $src->defaultcolumns;
            $so = 1;
            foreach($defaultcolumns as $option) {
                try {
                    $heading = isset($option['heading']) ? $option['heading'] :
                        null;
                    $column = $src->new_column_from_option($option['type'],
                        $option['value'], $heading);

                    $todb = new object();
                    $todb->reportid = $newid;
                    $todb->type = addslashes($column->type);
                    $todb->value = addslashes($column->value);
                    $todb->heading = addslashes($column->heading);
                    $todb->hidden = addslashes($column->hidden);
                    $todb->sortorder = $so;
                    if(!insert_record('report_builder_columns', $todb)) {
                        rollback_sql();
                        redirect($returnurl, get_string('error:couldnotcreatenewreport','local_reportbuilder'));
                    }
                    $so++;
                }
                catch (ReportBuilderException $e) {
                    trigger_error($e->getMessage(), E_USER_WARNING);
                }
            }
        }

        // create filters for new report based on default filters
        $src = reportbuilder::get_source_object($fromform->source);
        if(isset($src->defaultfilters) && is_array($src->defaultfilters)) {
            $defaultfilters = $src->defaultfilters;
            $so = 1;
            foreach($defaultfilters as $option) {
                try {
                    $advanced = isset($option['advanced']) ? $option['advanced'] :
                        null;
                    $filter = $src->new_filter_from_option($option['type'],
                        $option['value'], $advanced);

                    $todb = new object();
                    $todb->reportid = $newid;
                    $todb->type = addslashes($filter->type);
                    $todb->value = addslashes($filter->value);
                    $todb->advanced = addslashes($filter->advanced);
                    $todb->sortorder = $so;
                    if(!insert_record('report_builder_filters', $todb)) {
                        rollback_sql();
                        redirect($returnurl, get_string('error:couldnotcreatenewreport','local_reportbuilder'));
                    }
                    $so++;
                }
                catch (ReportBuilderException $e) {
                    trigger_error($e->getMessage(), E_USER_WARNING);
                }
            }
        }

        commit_sql();
        redirect($CFG->wwwroot.'/local/reportbuilder/general.php?id='.$newid);
    }

    admin_externalpage_print_header();

    if($notice) {
        switch($notice) {
        case REPORT_BUILDER_FAILED_DELETE_SESSKEY:
            notify(get_string('error:bad_sesskey','local_reportbuilder'));
            break;
        case REPORT_BUILDER_REPORT_FAILED_DELETE:
            notify(get_string('no' . $type . 'report','local_reportbuilder'));
            break;
        case REPORT_BUILDER_REPORT_CONFIRM_DELETE:
            notify(get_string($type . 'report','local_reportbuilder'), 'notifysuccess');
            break;
        }
    }

    print_heading(get_string('usergeneratedreports','local_reportbuilder'));

    $tableheader = array(get_string('name','local_reportbuilder'),
                         get_string('source','local_reportbuilder'),
                         get_string('options','local_reportbuilder'));

    $reports = get_records_select('report_builder','embeddedurl IS NULL','fullname');
    if($reports) {
        $data = array();
        foreach($reports as $report) {
            $row = array();
            $strsettings = get_string('settings','local_reportbuilder');
            $strdelete = get_string('delete','local_reportbuilder');
            $viewurl = ($report->embeddedurl === null) ? $CFG->wwwroot .
                '/local/reportbuilder/report.php?id='.$report->id :
                $report->embeddedurl;
            $settings = '<a href="'.$CFG->wwwroot.'/local/reportbuilder/general.php?id='.$report->id.'" title="'.$strsettings.'">' .
                '<img src="'.$CFG->pixpath.'/t/edit.gif" alt="'.$strsettings.'"></a>';
            $delete = '<a href="'.$CFG->wwwroot.'/local/reportbuilder/index.php?d=1&amp;id='.$report->id.'" title="'.$strdelete.'">' .
                '<img src="'.$CFG->pixpath.'/t/delete.gif" alt="'.$strdelete.'"></a>';
            $row[] = '<a href="'.$CFG->wwwroot.'/local/reportbuilder/general.php?id='.$report->id.'">'.$report->fullname.'</a>' .
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
        print get_string('noreports','local_reportbuilder');
    }

    print '<br />';
    print_heading(get_string('embeddedreports','local_reportbuilder'));

    $embeddedreports = get_records_select('report_builder','embeddedurl IS NOT NULL','fullname');
    if($embeddedreports) {
        $data = array();
        foreach($embeddedreports as $report) {
            $row = array();
            $strsettings = get_string('settings','local_reportbuilder');
            $strdelete = get_string('delete','local_reportbuilder');
            $viewurl = ($report->embeddedurl === null) ? $CFG->wwwroot .
                '/local/reportbuilder/report.php?id='.$report->id :
                $report->embeddedurl;
            $settings = '<a href="'.$CFG->wwwroot.'/local/reportbuilder/general.php?id='.$report->id.'" title="'.$strsettings.'">' .
                '<img src="'.$CFG->pixpath.'/t/edit.gif" alt="'.$strsettings.'"></a>';
            $delete = '<a href="'.$CFG->wwwroot.'/local/reportbuilder/index.php?em=1&amp;d=1&amp;id='.$report->id.'" title="'.$strdelete.'">' .
                '<img src="'.$CFG->pixpath.'/t/delete.gif" alt="'.$strdelete.'"></a>';
            $row[] = '<a href="'.$CFG->wwwroot.'/local/reportbuilder/general.php?id='.$report->id.'">'.$report->fullname.'</a>' .
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
        print get_string('noembeddedreports','local_reportbuilder');
    }
    print '<br /><br />';
    // display mform
    $mform->display();

    admin_externalpage_print_footer();


// page specific functions

/**
 * Deletes a report and any associated data
 *
 * @param integer $id ID of the report to delete
 *
 * @return boolean True if report was successfully deleted
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
    // delete any content and access settings
    if(!delete_records('report_builder_settings','reportid',$id)) {
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

