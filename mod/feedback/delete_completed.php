<?php // $Id: delete_completed.php,v 1.1.4.2 2008/04/04 10:38:00 agrabs Exp $
/**
* prints the form to confirm the deleting of a completed
*
* @version $Id: delete_completed.php,v 1.1.4.2 2008/04/04 10:38:00 agrabs Exp $
* @author Andreas Grabs
* @license http://www.gnu.org/copyleft/gpl.html GNU Public License
* @package feedback
*/

    require_once("../../config.php");
    require_once("lib.php");

    $id = required_param('id', PARAM_INT);
    $completedid = optional_param('completedid', 0, PARAM_INT);

    $formdata = data_submitted('nomatch');
    
    if(isset($formdata->canceldelete)){
        redirect('show_entries.php?id='.$id.'&do_show=showentries');
    }
    
    if($completedid == 0){
        error(get_string('no_complete_to_delete', 'feedback'), 'show_entries.php?id='.$id.'&do_show=showentries');
    }

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
    
    if(!$capabilities->deletecompleteds){
        error(get_string('error'));
    }
    
    //delete item
    if(isset($formdata->confirmdelete) && $formdata->confirmdelete == 1){
        if($completed = get_record('feedback_completed', 'id', $completedid)) {
            feedback_delete_completed($completedid);
            add_to_log($course->id, "feedback", "delete", "view.php?id=$cm->id", "$feedback->name",$cm->id);
            redirect('show_entries.php?id='.$id.'&do_show=showentries');
        }
    }

     $strfeedbacks = get_string("modulenameplural", "feedback");
     $strfeedback  = get_string("modulename", "feedback");

	$navigation=isset($navigation)?$navigation:'';
     print_header("$course->shortname: $feedback->name", "$course->fullname",
                      "$navigation <a href=\"index.php?id=$course->id\">$strfeedbacks</a> -> $feedback->name", 
                        "", "", true, update_module_button($cm->id, $course->id, $strfeedback), 
                        navmenu($course, $cm));

    /// Print the main part of the page
    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////
    print_heading(format_text($feedback->name));
    // print_simple_box_start("center", "60%", "#FFAAAA", 20, "noticebox");
    print_box_start('generalbox errorboxcontent boxaligncenter boxwidthnormal');
    print_heading(get_string('are_you_sure_to_delete_this_entry', 'feedback'));
?>
    <p>&nbsp;</p>
    <div>
        <form style="display:inline;" name="frm" action="<?php echo me();?>" method="post">
            <input type="hidden" name="sesskey" value="<?php echo $USER->sesskey; ?>" />
            <input type="hidden" name="id" value="<?php echo $id;?>" />
            <input type="hidden" name="completedid" value="<?php echo $completedid;?>" />
            <input type="hidden" name="confirmdelete" value="1" />
            <button type="submit"><?php print_string('delete');?></button>
        </form>
        <form style="display:inline;" name="frm" action="<?php echo me();?>" method="post">
            <input type="hidden" name="sesskey" value="<?php echo $USER->sesskey; ?>" />
            <input type="hidden" name="id" value="<?php echo $id;?>" />
            <input type="hidden" name="completedid" value="<?php echo $completedid;?>" />
            <input type="hidden" name="canceldelete" value="1" />
            <button type="submit"><?php print_string('cancel');?></button>
        </form>
    </div>
    <div style="clear:both">&nbsp;</div>
<?php        
    // print_simple_box_end();
    print_box_end();
        

    print_footer($course);

?>
