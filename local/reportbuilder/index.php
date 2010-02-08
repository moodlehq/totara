<?php // $Id$
    require_once('../../config.php');
    require_once($CFG->libdir.'/adminlib.php');
    require_once($CFG->dirroot.'/local/reportbuilder/lib.php');
    require_once('report_forms.php');

    $id = optional_param('id',null,PARAM_INT); // id for delete report
    $d = optional_param('d',false, PARAM_BOOL); // delete record?
    $confirm = optional_param('confirm', false, PARAM_BOOL); // confirm delete

    admin_externalpage_setup('reportbuilder');

    global $USER;

    $returnurl = $CFG->wwwroot.'/local/reportbuilder/index.php';

    // delete an existing report
    if($d && $confirm) {
        if(!confirm_sesskey()) {
            print_error('confirmsesskeybad','error');
        }
        if(delete_records('report_builder','id',$id)) {
            redirect($returnurl, get_string('reportdeleted', 'local'));
        } else {
            redirect($returnurl, get_string('reportnotdeleted', 'local'));
        }
    } else if($d) {
        admin_externalpage_print_header();
        print_heading(get_string('reportbuilder','local'));
        notice_yesno(get_string('reportconfirmdelete','local'),"index.php?id={$id}&amp;d=1&amp;confirm=1&amp;sesskey={$USER->sesskey}", $returnurl);
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
        $todb->shortname = $fromform->shortname;
        $todb->source = ($fromform->source != '0') ? $fromform->source : null;
        // create with default columns, restrictions and queries
        $todb->columns = serialize(get_source_data($fromform->source,'defaultcolumns'));
        $todb->filters = serialize(get_source_data($fromform->source,'defaultqueries'));
        $todb->restriction = serialize(get_default_restrictions($fromform->source));
        if($newid = insert_record('report_builder',$todb)) {
            redirect($CFG->wwwroot.'/local/reportbuilder/settings.php?id='.$newid);
        } else {
            redirect($returnurl, get_string('error:couldnotcreatenewreport','local'));
        }
    }

    admin_externalpage_print_header();

    print_heading(get_string('reportbuilder','local'));

    $reports = get_records('report_builder');
    if($reports) {
    foreach($reports as $report) {
        $row = array();
        $strsettings = get_string('settings','local');
        $strdelete = get_string('delete','local');
        $settings = '<a href="'.$CFG->wwwroot.'/local/reportbuilder/settings.php?id='.$report->id.'" title="'.$strsettings.'">' .
            '<img src="'.$CFG->pixpath.'/t/edit.gif" alt="'.$strsettings.'"></a>';
        $delete = '<a href="'.$CFG->wwwroot.'/local/reportbuilder/index.php?d=1&amp;id='.$report->id.'" title="'.$strdelete.'">' .
            '<img src="'.$CFG->pixpath.'/t/delete.gif" alt="'.$strdelete.'"></a>';
        $row[] = '<a href="'.$CFG->wwwroot.'/local/reportbuilder/report.php?id='.$report->id.'">'.$report->fullname.'</a>';
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
        print get_string('noreports','local');
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
                    $row = array();
                    $row['funcname'] = (isset($option['funcname'])) ? $option['funcname'] : null;
                    $row['title'] = (isset($option['title'])) ? $option['title'] : null;
                    $row['field'] = (isset($option['field'])) ? $option['field'] : null;
                    $row['joins'] = (isset($option['joins'])) ? $option['joins'] : null;
                    $row['capability'] = (isset($option['capability'])) ? $option['capability'] : null;
                    $restrictions[] = $row;
                }
            }
        }
        return $restrictions;
    }
?>
