<?php

    require_once('../../../config.php');
    require_once($CFG->dirroot.'/lib/statslib.php');
    require_once($CFG->libdir.'/adminlib.php');
    require_once($CFG->libdir.'/tablelib.php');

    define('DEFAULT_PAGE_SIZE', 40);
    define('SHOW_ALL_PAGE_SIZE', 5000);

    $report    = optional_param('report', STATS_REPORT_ACTIVE_COURSES, PARAM_INT);
    $startdate = optional_param('time', 0, PARAM_INT);
    $enddate   = optional_param('time', 0, PARAM_INT);
    $spage     = optional_param('spage', 0, PARAM_INT);                    // which page to show
    $perpage   = optional_param('perpage', DEFAULT_PAGE_SIZE, PARAM_INT);

    admin_externalpage_setup('reportlearningrecords');
    admin_externalpage_print_header();

    $timeoptions = stats_get_time_options($now,$lastweekend,$lastmonthend,$earliestday,$earliestweek,$earliestmonth);

    if (empty($timeoptions)) {
        print_error('nostatstodisplay', "", $CFG->wwwroot.'/course/view.php?id='.$course->id);
    }

    require_once($CFG->dirroot.'/local/mitms.php');
    $organisationid = mitms_print_user_profile_field($USER->id, 'organisationid');

    require_once($CFG->dirroot.'/hierarchy/lib.php');
    $hierarchy = new hierarchy();
    $hierarchy->prefix = 'organisation';
    $organisations = $hierarchy->get_item_descendants($organisationid);
    $orgoptions = array();
    $orgseq = array();
    foreach ($organisations as $organisation) {
        $path = $string = explode('/', $organisation->path);
        $display = '';
        for ($i=1; $i < count($path)-1; $i++) {
           $display .= '&nbsp;&nbsp;&nbsp;';
        }
        $display .= $organisation->fullname;
        $orgoptions[$organisation->id] = $display;
    }
    echo $startdate.'  '.$enddate;
    echo '<form action="index.php" method="post">'."\n";
    echo '<div>';

    $tableform->width = '*';
    $tableform->align = array('left','left','left','left','left','left');
    $tableform->data[] = array(get_string('report:organisation', 'local'),choose_from_menu($orgoptions,'report',$report,'','','',true));
    $tableform->data[] = array(get_string('report:startdate', 'local'),choose_from_menu($timeoptions,'startdate',$startdate,'','','',true));
    $tableform->data[] = array(get_string('report:enddate', 'local'),choose_from_menu($timeoptions,'enddate',$enddate,'','','',true));
    $tableform->data[] = array('','<input type="submit" value="'.get_string('search').'" />');

    print_table($tableform);
    echo '</div>';
    echo '</form>';

    print_heading(get_string('report:learningrecords', 'local'));

    if (!empty($report)) {

    $select3 = "SELECT c.fullname as cfullname, ce.competencyid AS cid, ce.proficiency, ce.positionid, ce.organisationid, ce.timemodified, 
        'competency' AS type, c.idnumber as idnumber
        FROM mdl_competency_evidence ce JOIN mdl_competency c ON c.id=ce.competencyid
        UNION ALL
        SELECT c.fullname AS cfullname, cc.course AS cid, CASE WHEN cc.timecompleted IS NOT NULL THEN 3 ELSE 1 END AS proficiency,
        NULL AS positionid, NULL AS organisationid, cc.timecompleted, 'course' AS type, c.idnumber as idnumber
        FROM mdl_course_completions cc JOIN mdl_course c ON c.id=cc.course
        ORDER BY timemodified DESC<BR>";

        $table = new flexible_table('-learningrecords');

        $select = 'SELECT  u.id as uid, u.firstname, u.lastname, c.fullname AS cfullname, cc.course AS cid, cc.timecompleted';
        $from   = ' FROM mdl_course_completions cc
                    JOIN mdl_course c
                      ON c.id=cc.course
                    JOIN mdl_user u
                      ON u.id=cc.userid';
        $where  = '';
        $sort   = ' ORDER BY cc.timecompleted';
        $extrasql = '';

        $tablecolumns[] = 'learner';
        $tablecolumns[] = 'coursetitle';
        $tablecolumns[] = 'completiondate';
        
        $tableheaders[] = get_string('report:learner', 'local');
        $tableheaders[] = get_string('report:coursetitle', 'local');
        $tableheaders[] = get_string('report:completiondate','local');

        $table->define_columns($tablecolumns);
        $table->define_headers($tableheaders);

        $table->column_style('learner','width','80px');
        $table->column_style('coursetitle','width','250px');
        $table->column_style('completiondate','width','140px');

        $table->set_attribute('cellspacing', '0');
        $table->set_attribute('id', 'learningrecords');
        $table->set_attribute('class', 'logtable generalbox');

        $table->set_control_variables(array(
                    TABLE_VAR_SORT    => 'ssort',
                    TABLE_VAR_HIDE    => 'shide',
                    TABLE_VAR_SHOW    => 'sshow',
                    TABLE_VAR_IFIRST  => 'sifirst',
                    TABLE_VAR_ILAST   => 'silast',
                    TABLE_VAR_PAGE    => 'spage'
                    ));
        $table->setup();

        $table->initialbars(true);

        $matchcount = count_records_sql('SELECT COUNT (*) '.$from.$where);
        $table->pagesize($perpage, $matchcount);

        $records = get_recordset_sql($select.$from.$where.$extrasql.$sort,
            $table->get_page_start(),  $table->get_page_size());
        if ($records) {
            while ($record = rs_fetch_next_record($records)) {
                $tabledata = array();
                $tabledata[] = '<a href="'.$CFG->wwwroot.'/user/view.php?id='.$record->uid.'">'.$record->firstname.', '.$record->lastname.'</a>';
                $tabledata[] = '<a href="'.$CFG->wwwroot.'/course/view.php?id='.$record->cid.'">'.$record->cfullname.'</a>';
                $tabledata[] = userdate($record->timecompleted, '%d %b %Y');
                $table->add_data($tabledata);
            }
            rs_close($records);
        } else {
            notify(get_string('reports:nodata', 'local'));echo '</td></tr></table>';echo '<p>after notify</p>';
        }
    }
    $table->print_html();
    admin_externalpage_print_footer();

?>
