<?php // $Id: analysis_course.php,v 1.1.4.1 2008/01/15 23:53:23 agrabs Exp $
/**
* shows an analysed view of a feedback on the mainsite
*
* @version $Id: analysis_course.php,v 1.1.4.1 2008/01/15 23:53:23 agrabs Exp $
* @author Andreas Grabs
* @license http://www.gnu.org/copyleft/gpl.html GNU Public License
* @package feedback
*/

    require_once("../../config.php");
    require_once("lib.php");
    
    $SESSION->feedback->current_tab = 'analysis';
 
    $id = required_param('id', PARAM_INT);  //the POST dominated the GET
    $coursefilter = optional_param('coursefilter', '0', PARAM_INT);
    $courseitemfilter = optional_param('courseitemfilter', '0', PARAM_INT);
    $courseitemfiltertyp = optional_param('courseitemfiltertyp', '0', PARAM_ALPHANUM);
    $searchcourse = optional_param('searchcourse', '', PARAM_ALPHAEXT);
    $courseid = optional_param('courseid', false, PARAM_INT);
    
    if ($id) {
        if (! $cm = get_coursemodule_from_id('feedback', $id)) {
            error("Course Module ID was incorrect");
        }
     
        if (! $course = get_record("course", "id", $cm->course)) {
            error("Course is misconfigured");
        }
     
        if (! $feedback = get_record("feedback", "id", $cm->instance)) {
            error("Course module is incorrect");
        }
    }
    $capabilities = feedback_load_capabilities($cm->id);

    require_login($course->id);
    
    if( !( (intval($feedback->publish_stats) == 1) || $capabilities->viewreports)) {
        error(get_string('error'));
    }
    
    /// Print the page header

    $strfeedbacks = get_string("modulenameplural", "feedback");
    $strfeedback  = get_string("modulename", "feedback");
    $navigation = '';
    
    $feedbackindex = "<a href=\"index.php?id=$course->id\">$strfeedbacks</a> ->";
    if ($course->category) {
        $navigation = "<a href=\"../../course/view.php?id=$course->id\">$course->shortname</a> ->";
    }else if ($courseid > 0 AND $courseid != SITEID) {
        $usercourse = get_record('course', 'id', $courseid);
        $navigation = "<a href=\"../../course/view.php?id=$usercourse->id\">$usercourse->shortname</a> ->";
        $feedbackindex = '';
    }

    print_header("$course->shortname: $feedback->name", "$course->fullname",
                     "$navigation $feedbackindex $feedback->name", 
                     "", "", true, update_module_button($cm->id, $course->id, $strfeedback), 
                     navmenu($course, $cm));

    /// print the tabs
    include('tabs.php');

    //print the analysed items
    // print_simple_box_start("center", '80%');
    print_box_start('generalbox boxaligncenter boxwidthwide');

    if( $capabilities->viewreports ) {
        //button "export to excel"
        echo '<div align="center">';
        $export_button_link = 'analysis_to_excel.php';
        $export_button_options = array('sesskey'=>$USER->sesskey, 'id'=>$id);
        $export_button_label = get_string('export_to_excel', 'feedback');
        print_single_button($export_button_link, $export_button_options, $export_button_label, 'post');
        echo '</div>';
    }
    
    //get the groupid
    //lstgroupid is the choosen id
    $mygroupid = false;
    //get completed feedbacks
    $completedscount = feedback_get_completeds_group_count($feedback, $mygroupid, $coursefilter);
    
    //show the count
    echo '<b>'.get_string('completed_feedbacks', 'feedback').': '.$completedscount. '</b><br />';
    
    // get the items of the feedback
    $items = get_records_select('feedback_item', 'feedback = '. $feedback->id . ' AND hasvalue = 1', 'position');
    //show the count
    if(is_array($items)){
    	echo '<b>'.get_string('questions', 'feedback').': ' .sizeof($items). ' </b><hr />';
        echo '<a href="analysis_course.php?id=' . $id . '&courseid='.$courseid.'">'.get_string('show_all', 'feedback').'</a>';
    } else {
        $items=array();
    }

    echo '<form name="report" method="get">';
    echo '<div align="center"><table width="80%" cellpadding="10">';
    if ($courseitemfilter > 0) {
        $avgvalue = 'avg(value)';
        if ($CFG->dbtype == 'postgres7') {
             $avgvalue = 'avg(cast (value as integer))';
        }
        if ($courses = get_records_sql ('select fv.course_id, c.shortname, '.$avgvalue.' as avgvalue '.
                                                  'from '.$CFG->prefix.'feedback_value fv, '.$CFG->prefix.'course c, '.
                                                  $CFG->prefix.'feedback_item fi '.
                                                  'where fv.course_id = c.id '.
                                                  'and fi.id = fv.item and fi.typ = \''.$courseitemfiltertyp.'\' and fv.item = \''.
                                                  $courseitemfilter.'\' '.
                                                  'group by course_id, shortname order by avgvalue desc')) {
             $item = get_record('feedback_item', 'id', $courseitemfilter);
             echo '<tr><th colspan="2">'.$item->name.'</th></tr>';
             echo '<tr><td><table align="left">';
             echo '<tr><th>Course</th><th>Average</th></tr>';
             $sep_dec = get_string('separator_decimal', 'feedback');
             $sep_thous = get_string('separator_thousand', 'feedback');

             foreach ($courses as $c) {
                  echo '<tr><td>'.$c->shortname.'</td><td align="right">'.number_format(($c->avgvalue), 2, $sep_dec, $sep_thous).'</td></tr>';
             }
             echo '</table></td></tr>';
        } else {
             echo '<tr><td>'.get_string('noresults').'</td></tr>';
        }
    } else {

         echo get_string('search_course', 'feedback') . ': ';
         echo '<input type="text" name="searchcourse" value="'.$searchcourse.'"/> <input type="submit" value="'.get_string('search').'"/>';
         echo '<input type="hidden" name="sesskey" value="' . $USER->sesskey . '" />';
         echo '<input type="hidden" name="id" value="'.$id.'" />';
         echo '<input type="hidden" name="courseitemfilter" value="'.$courseitemfilter.'" />';
         echo '<input type="hidden" name="courseitemfiltertyp" value="'.$courseitemfiltertyp.'" />';
         echo '<input type="hidden" name="courseid" value="'.$courseid.'" />';
         echo '<script language="javascript" type="text/javascript">
                 <!--
                 function setcourseitemfilter(item, item_typ) {
                      document.report.courseitemfilter.value = item;
                      document.report.courseitemfiltertyp.value = item_typ;
                      document.report.submit();
                 }
                 -->
                 </script>';


        $sql = 'select c.id, c.shortname from '.$CFG->prefix.'course c, '.
                                              $CFG->prefix.'feedback_value fv, '.$CFG->prefix.'feedback_item fi '.
                                              'where c.id = fv.course_id and fv.item = fi.id '.
                                              'and fi.feedback = '.$feedback->id.' '.
                                              'and 
                                              (c.shortname '.sql_ilike().' \'%'.$searchcourse.'%\'
                                              OR c.fullname '.sql_ilike().' \'%'.$searchcourse.'%\')';
        
        if ($courses = get_records_sql_menu($sql)) {

             echo ' ' . get_string('filter_by_course', 'feedback') . ': ';
             choose_from_menu ($courses, 'coursefilter', $coursefilter, 'choose', 'this.form.submit()');
        }
        echo '<hr />';
        $itemnr = 0;
        //print the items in an analysed form
        echo '<tr><td>';
        foreach($items as $item) {
            if($item->hasvalue == 0) continue;
            echo '<table width="100%" class="generalbox">';	
            //get the class from item-typ
            $itemclass = 'feedback_item_'.$item->typ;
            //get the instance of the item-class
            $itemobj = new $itemclass();
            $itemnr = $itemobj->print_analysed($item, $itemnr, $mygroupid, $coursefilter);
            if (eregi('rated$', $item->typ)) {
                 echo '<tr><td colspan="2"><a href="#" onclick="setcourseitemfilter('.$item->id.',\''.$item->typ.'\'); return false;">'.
                    get_string('sort_by_course', 'feedback').'</a></td></tr>'; 
            }
            echo '</table>';
        }
        echo '</td></tr>';
    }
    echo '</table></div>';
    echo '</form>';
    print_box_end();
    
    print_footer($course);

?>
