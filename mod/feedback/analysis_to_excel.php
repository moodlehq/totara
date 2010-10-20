<?php // $Id: analysis_to_excel.php,v 1.1.4.2 2008/01/20 11:52:47 agrabs Exp $
/**
* prints an analysed excel-spreadsheet of the feedback
*
* @version $Id: analysis_to_excel.php,v 1.1.4.2 2008/01/20 11:52:47 agrabs Exp $
* @author Andreas Grabs
* @license http://www.gnu.org/copyleft/gpl.html GNU Public License
* @package feedback
*/

    require_once("../../config.php");
    require_once("lib.php");
    require_once('easy_excel.php');
    require_once('../../user/profile/lib.php');
 
    $id = required_param('id', PARAM_INT);  //the POST dominated the GET
    
    $formdata = data_submitted('nomatch');
    
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
    
    if(!$capabilities->viewreports){
        error(get_string('error'));
    }

    //buffering any output
    //this prevents some output before the excel-header will be send
    ob_start();
    $fstring = new object();
    $fstring->bold = get_string('bold', 'feedback');
    $fstring->page = get_string('page', 'feedback');
    $fstring->of = get_string('of', 'feedback');
    $fstring->modulenameplural = get_string('modulenameplural', 'feedback');
    $fstring->questions = get_string('questions', 'feedback');
    $fstring->question = get_string('question', 'feedback');
    $fstring->responses = get_string('responses', 'feedback');
    $fstring->idnumber = get_string('idnumber');
    $fstring->username = get_string('username');
    $fstring->fullname = get_string('fullname');
    $fstring->firstname = get_string('firstname');
    $fstring->lastname = get_string('lastname');
    $fstring->courseid = get_string('courseid', 'feedback');
    $fstring->course = get_string('course');
    $fstring->anonymous_user = get_string('anonymous_user','feedback');
    $fstring->title = get_field('user_info_field', 'name', 'shortname', 'title');
    $fstring->department = get_string('department');
    $fstring->costcenter = get_field('user_info_field', 'name', 'shortname', 'costcenterid');
    $fstring->costcenterdescription = get_field('user_info_field', 'name', 'shortname', 'costcenter');
    $fstring->managerid = get_field('user_info_field', 'name', 'shortname', 'managerid');
    $fstring->managername = get_field('user_info_field', 'name', 'shortname', 'managername');
    $fstring->managersemail = get_field('user_info_field', 'name', 'shortname', 'managersemail');
    $fstring->city = get_string('city');
    $fstring->sessionvenue = get_string('sessionvenue', 'facetoface');
    $fstring->sessionstartdate = get_string('sessionstartdate', 'facetoface');
    $fstring->sessionstarttime = get_string('sessionstarttime', 'facetoface');
    ob_end_clean();

    $filename = "feedback.xls";
    
    //get the groupid for this module
    //get the groupid
    $mygroupid = $SESSION->feedback->lstgroupid;

    // Creating a workbook
    $workbook = new EasyWorkbook("-");
    $workbook->setTempDir($CFG->dataroot);
    $workbook->send($filename);
    $workbook->setVersion(8);
    // Creating the worksheets
    $sheetname = clean_param($feedback->name, PARAM_ALPHANUM);
    error_reporting(0);
    $worksheet1 =& $workbook->addWorksheet('summary');
    $worksheet1->set_workbook($workbook);
    $worksheet2 =& $workbook->addWorksheet('detailed');
    $worksheet2->set_workbook($workbook);
    error_reporting($CFG->debug);
    $worksheet1->setPortrait();
    $worksheet1->setPaper(9);
    $worksheet1->centerHorizontally();
    $worksheet1->hideGridlines();
    $worksheet1->setHeader("&\"Arial," . $fstring->bold . "\"&14".$feedback->name);
    $worksheet1->setFooter($fstring->page." &P " . $fstring->of . " &N");
    $worksheet1->setColumn(0, 0, 30);
    $worksheet1->setColumn(1, 20, 15);
    $worksheet1->setMargins_LR(0.10);

    $worksheet2->setLandscape();
    $worksheet2->setPaper(9);
    $worksheet2->centerHorizontally();

    //writing the table header
    $worksheet1->setFormat("<f>",10,false);

    ////////////////////////////////////////////////////////////////////////
    //print the analysed sheet
    ////////////////////////////////////////////////////////////////////////
    //get the completeds
    $trackfacetoface = false;
    // check if there's a facetoface activity to link reports
    if ($feedback->facetofacecmid) {
        if ($facetofacecm = get_record('course_modules', 'id', $feedback->facetofacecmid)) {
            $trackfacetoface = true;
        } else {
            error(get_string('error:facetofacelink', 'feedback'), $CFG->wwwroot.'/mod/feedback/view.php?id='.$cm->id);
        }
    }
  
    $rowOffset1 = 0;
    $worksheet1->write_string($rowOffset1, 0, get_string('coursename', 'feedback').':');
    $worksheet1->write_string($rowOffset1, 1, $course->fullname);
  
    $rowOffset1++;
    $worksheet1->write_string($rowOffset1, 0, get_string('feedbackname', 'feedback').':');
    $worksheet1->write_string($rowOffset1, 1, $feedback->name);
 
    $rowOffset1++;
    $worksheet1->write_string($rowOffset1, 0, get_string('generatedon', 'feedback').':');
    $worksheet1->write_string($rowOffset1, 1, UserDate(time()));
  
     if (!$trackfacetoface) {
         $completedscount = feedback_get_completeds_group_count($feedback, $mygroupid);
         if($completedscount > 0){
            //Anzahl der Ausgefuellten feedbacks eintragen
            $rowOffset1++;
            $worksheet1->write_string($rowOffset1, 0, $fstring->modulenameplural.': ');
            $worksheet1->write_string($rowOffset1, 1, strval($completedscount));
         }
 
         $rowOffset1 += 2;
         $worksheet1->write_string($rowOffset1, 0, $fstring->question);
         $worksheet1->write_string($rowOffset1, 1, $fstring->responses);
         $rowOffset1++ ;
 
         $items = get_records_select('feedback_item', 'feedback = '. $feedback->id . ' AND hasvalue = 1', 'position');
         if (empty($items)) {
             $items=array();
         }
         foreach($items as $item) {
             $feedback_item_class = 'feedback_item_'.$item->typ;
             $feedback_item_obj = new $feedback_item_class();
             $rowOffset1 = $feedback_item_obj->excelprint_item($worksheet1, $rowOffset1, $item, $mygroupid, '0', false);
         }
 
         //fragen holen
         $items = get_records_select('feedback_item', 'feedback = '. $feedback->id . ' AND hasvalue = 1', 'position');
         if(is_array($items)){
             $rowOffset1++;
             $worksheet1->write_string($rowOffset1, 0, $fstring->questions.': '. strval(sizeof($items)));
         }
     } else {
         if ($facetofacesessions = get_records_sql("SELECT fs.id, fs.venue, fsd.timestart, fsd.timefinish FROM {$CFG->prefix}facetoface_sessions_dates fsd, {$CFG->prefix}facetoface_sessions fs WHERE fsd.sessionid=fs.id AND fs.facetoface='$facetofacecm->id' AND datetimeknown='1'")) {
             foreach($facetofacesessions as $facetofacesession) {
                 $rowOffset1 += 2;
                 $colOffset = 0;
                 $itemColOffset = 0;
                 $worksheet1->setFormat("<f>",10,false);
                 if ($trackfacetoface) {
                     $worksheet1->write_string($rowOffset1, $colOffset++, 'Session venue');
                     $worksheet1->write_string($rowOffset1, $colOffset++, 'Session start date');
                     $worksheet1->write_string($rowOffset1, $colOffset++, 'Session start time');
                     $itemColOffset = 3;
                 }
                 $worksheet1->write_string($rowOffset1, $colOffset++, $fstring->question);
                 $worksheet1->write_string($rowOffset1, $colOffset++, $fstring->responses);
                 $rowOffset1++ ;
 
                 $worksheet1->write_string($rowOffset1, 0, $facetofacesession->venue);
                 $worksheet1->write_string($rowOffset1, 1, userdate($facetofacesession->timestart, '%d %b %Y'));
                 $worksheet1->write_string($rowOffset1, 2, userdate($facetofacesession->timefinish, '%d %b %Y'));
 
                 $items = get_records_select('feedback_item', 'feedback = '. $feedback->id . ' AND hasvalue = 1', 'position');
                 if (empty($items)) {
                      $items=array();
                 }
                 foreach($items as $item) {
                     $feedback_excelprint_item_func = 'feedback_excelprint_item_'.$item->typ;
                     $rowOffset1 = $feedback_excelprint_item_func($worksheet1, $rowOffset1, $item, $mygroupid, false, $itemColOffset, $facetofacesession->id);
                 }
             }
         }
     }


    ////////////////////////////////////////////////////////////////////////
    //print the detailed sheet
    ////////////////////////////////////////////////////////////////////////
    //get the completeds
    
    $completeds = feedback_get_completeds_group($feedback, $mygroupid);
    //important: for each completed you have to print each item, even if it is not filled out!!!
    //therefor for each completed we have to iterate over all items of the feedback
    //this is done by feedback_excelprint_detailed_items
    
    $rowOffset2 = 0;
    //first we print the table-header
    $rowOffset2 = feedback_excelprint_detailed_head($worksheet2, $items, $rowOffset2, $trackfacetoface);
    
    
    if(is_array($completeds)){
        foreach($completeds as $completed) {

            $rowOffset2 = feedback_excelprint_detailed_items(
                $worksheet2,
                $completed,
                $items,
                $rowOffset2,
                ($trackfacetoface ? $facetofacecm->id : false) // facetofacecm only exists if we are tracking face to face
            );
        }
    }
    
    
    $workbook->close();
    exit;
////////////////////////////////////////////////////////////////////////////////    
////////////////////////////////////////////////////////////////////////////////    
//functions
////////////////////////////////////////////////////////////////////////////////    

    
    function feedback_excelprint_detailed_head(&$worksheet, $items, $rowOffset, $trackfacetoface) {
        global $fstring, $feedback;
        
        if(!$items) return;
        $colOffset = 0;
        
        $worksheet->setFormat('<l><f><ru2>');
    
        if ($feedback->anonymous == FEEDBACK_ANONYMOUS_NO)
        {
            $worksheet->write_string($rowOffset, $colOffset++, $fstring->idnumber);
            $worksheet->write_string($rowOffset, $colOffset++, $fstring->username);
            $worksheet->write_string($rowOffset, $colOffset++, $fstring->firstname);
            $worksheet->write_string($rowOffset, $colOffset++, $fstring->lastname);
            $worksheet->write_string($rowOffset, $colOffset++, $fstring->title);
            $worksheet->write_string($rowOffset, $colOffset++, $fstring->department);
            $worksheet->write_string($rowOffset, $colOffset++, $fstring->costcenter);
            $worksheet->write_string($rowOffset, $colOffset++, $fstring->costcenterdescription);
            $worksheet->write_string($rowOffset, $colOffset++, $fstring->managerid);
            $worksheet->write_string($rowOffset, $colOffset++, $fstring->managername);
            $worksheet->write_string($rowOffset, $colOffset++, $fstring->managersemail);
            $worksheet->write_string($rowOffset, $colOffset++, $fstring->city);

            if ($trackfacetoface)
            {
                $worksheet->write_string($rowOffset, $colOffset++, $fstring->sessionvenue);
                $worksheet->write_string($rowOffset, $colOffset++, $fstring->sessionstartdate);
                $worksheet->write_string($rowOffset, $colOffset++, $fstring->sessionstarttime);
            }
        }
        else
        {
            $worksheet->write_string($rowOffset, $colOffset++, $fstring->fullname);
        }

        foreach($items as $item) {
            $worksheet->write_string($rowOffset, $colOffset, stripslashes_safe($item->name));
            $colOffset++;
        }

        $worksheet->write_string($rowOffset, $colOffset, $fstring->courseid);
        $colOffset++;

        $worksheet->write_string($rowOffset, $colOffset, $fstring->course);
        $colOffset++;

        return $rowOffset + 1;
    }
    
    function feedback_excelprint_detailed_items(&$worksheet, $completed, $items, $rowOffset, $facetofacecmid=false) {
        global $fstring, $feedback, $CFG;
        
        if(!$items) return;
        $colOffset = 0;
        $courseid = 0;

        $worksheet->setFormat('<l>');
//        $worksheet->setFormat('<l><f><ru2>');

        $feedback = get_record('feedback', 'id', $completed->feedback);

        $user = get_record('user', 'id', $completed->userid);
        $user_custom = profile_user_record($user->id);

        $anon = $completed->anonymous_response == FEEDBACK_ANONYMOUS_YES;

        if ($feedback->anonymous == FEEDBACK_ANONYMOUS_NO)
        {
            $worksheet->write_string($rowOffset, $colOffset++, $anon ? $fstring->anonymous_user : $user->idnumber);
            $worksheet->write_string($rowOffset, $colOffset++, $anon ? '-' : $user->username);
            $worksheet->write_string($rowOffset, $colOffset++, $anon ? '-' : $user->firstname);
            $worksheet->write_string($rowOffset, $colOffset++, $anon ? '-' : $user->lastname);
            $worksheet->write_string($rowOffset, $colOffset++, $anon ? '-' : $user_custom->title);
            $worksheet->write_string($rowOffset, $colOffset++, $anon ? '-' : $user->department);
            $worksheet->write_string($rowOffset, $colOffset++, $anon ? '-' : $user_custom->costcenterid);
            $worksheet->write_string($rowOffset, $colOffset++, $anon ? '-' : $user_custom->costcenter);
            $worksheet->write_string($rowOffset, $colOffset++, $anon ? '-' : $user_custom->managerid);
            $worksheet->write_string($rowOffset, $colOffset++, $anon ? '-' : $user_custom->managername);
            $worksheet->write_string($rowOffset, $colOffset++, $anon ? '-' : $user_custom->managersemail);
            $worksheet->write_string($rowOffset, $colOffset++, $anon ? '-' : $user->city);
            
            if($facetofacecmid)
            {
                if ($facetofacesessions = get_records_sql("SELECT fse.venue, fsd.timestart, fsd.timefinish FROM {$CFG->prefix}facetoface_sessions_dates fsd, {$CFG->prefix}facetoface_sessions fse, {$CFG->prefix}facetoface_submissions fsu WHERE fsd.sessionid=fse.id AND fse.facetoface='$facetofacecmid' AND fse.datetimeknown='0' AND fsu.sessionid=fse.id AND fsu.userid = '$completed->userid' AND fsu.timecancelled = 0"))
                {
                    foreach($facetofacesessions as $facetofacesession)
                    {
                        $worksheet->write_string($rowOffset, $colOffset++, $facetofacesession->venue);
                        $worksheet->write_string($rowOffset, $colOffset++, userdate($facetofacesession->timestart, '%d %b %Y'));
                        $worksheet->write_string($rowOffset, $colOffset++, userdate($facetofacesession->timefinish, '%d %b %Y'));
                    }
                }
            }
        }
        else
        {
            $worksheet->write_string($rowOffset, $colOffset++, $fstring->anonymous_user);
        }
        
        foreach($items as $item) {
            $value = get_record('feedback_value', 'item', $item->id, 'completed', $completed->id);
            $itemclass = 'feedback_item_'.$item->typ;
            $itemobj = new $itemclass();
            $printval = $itemobj->get_printval($item, $value);

            $worksheet->setFormat('<l><vo>');
            if(is_numeric($printval)) {
                $worksheet->write_number($rowOffset, $colOffset, trim($printval));
            } else {
                $worksheet->write_string($rowOffset, $colOffset, trim($printval));
            }
            $printval = '';
            $colOffset++;
            $courseid = isset($value->course_id) ? $value->course_id : 0;
            if($courseid == 0) $courseid = $feedback->course;
        }

        $worksheet->write_number($rowOffset, $colOffset++, $courseid);
        $course = get_record('course', 'id', $courseid);
        if ($course)
        {
            $worksheet->write_string($rowOffset, $colOffset++, $course->shortname);
        }
        return ++$rowOffset;
    }
?>
