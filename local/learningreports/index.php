<?php // $Id$
    require_once('../../config.php');
    require_once($CFG->libdir.'/adminlib.php');
    require_once($CFG->dirroot.'/local/learningreports/learningreportslib.php');
    require_once('learning_reports_forms.php');

    $id = optional_param('id',null,PARAM_INT); // id for delete report
    $d = optional_param('d',false, PARAM_BOOL); // delete record?
    $confirm = optional_param('confirm', false, PARAM_BOOL); // confirm delete

    admin_externalpage_setup('learningreports');

    global $USER;

    $returnurl = $CFG->wwwroot.'/local/learningreports/index.php';

    // delete an existing report
    if($d && $confirm) {
        if(!confirm_sesskey()) {
            print_error('confirmsesskeybad','error');
        }
        if(delete_records('learning_report','id',$id)) {
            redirect($returnurl, 'Report Deleted');
        } else {
            redirect($returnurl, 'Report could not be deleted');
        }
    } else if($d) {
        admin_externalpage_print_header();
        print_heading(get_string('learningreports','local'));
        notice_yesno('Are you sure you want to delete this report?',"index.php?id={$id}&amp;d=1&amp;confirm=1&amp;sesskey={$USER->sesskey}", $returnurl);
        print_footer();
        die;
    }

    // form definition
    $mform =& new learning_reports_new_form();

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
        $todb->shortname = $fromform->shortname;
        $todb->source = ($fromform->source != '0') ? $fromform->source : null;
        // create with default columns and queries
        // TODO How to get default data for non existant report
        $todb->columns = serialize(get_source_data($fromform->source,'defaultcolumns'));
        $todb->filters = serialize(get_source_data($fromform->source,'defaultqueries'));
        $todb->restriction = serialize(get_default_restrictions($fromform->source));
        /*
        if(isset($fromform->restriction)) {
            $todb->restriction = ($fromform->restriction != '0') ? $fromform->restriction : null;
        }*/
        if(insert_record('learning_report',$todb)) {
            redirect($returnurl, get_string('newreportcreated','local'));
        } else {
            redirect($returnurl, get_string('error:couldnotcreatenewreport','local'));
        }
    }

    admin_externalpage_print_header();

    print_heading(get_string('learningreports','local'));

    $reports = get_records('learning_report');
    if($reports) {
    foreach($reports as $report) {
        $row = array();
        $settings = '<a href="'.$CFG->wwwroot.'/local/learningreports/settings.php?id='.$report->id.'">' .
            get_string('settings').'</a>';
        $delete = '<a href="'.$CFG->wwwroot.'/local/learningreports/index.php?d=1&amp;id='.$report->id.'">' .
            get_string('delete').'</a>';
        $row[] = $report->fullname;
        $row[] = $report->shortname;
        $row[] = $report->source;
        $row[] = "$settings &nbsp; $delete";
        $data[] = $row;
    }

    $tableheader = array(get_string('name','local'),
                         get_string('uniquename','local'),
                         get_string('source','local'),
                         get_string('options','local')
                     );

    $reportstable = new object();
    $reportstable->summary = '';
    $reportstable->head = $tableheader;
    $reportstable->data = $data;
    print_table($reportstable);
    } else {
        print "No reports have been created";
    }

    // display mform
    $mform->display();

    admin_externalpage_print_footer();


    function get_default_restrictions($source) {
        $options = get_source_data($source,'restrictionoptions');
        $restrictions = array();
        if(is_array($options)) {
            foreach ($options as $option) {
                if($option['default'] == '1') {
                    $restrictions[] = $option['funcname'];
                }
            }
        }
        return $restrictions;
    }
?>
