<?php // $Id: edit_item.php,v 1.1.4.2 2008/04/04 10:38:00 agrabs Exp $
/**
* prints the form to edit a dedicated item
*
* @version $Id: edit_item.php,v 1.1.4.2 2008/04/04 10:38:00 agrabs Exp $
* @author Andreas Grabs
* @license http://www.gnu.org/copyleft/gpl.html GNU Public License
* @package feedback
*/

    require_once("../../config.php");
    require_once("lib.php");

    $id = optional_param('id', NULL, PARAM_INT);
    $typ = optional_param('typ', false, PARAM_ALPHA);
    
    if(!$typ)redirect(htmlspecialchars('edit.php?id=' . $id));

    // set up some general variables
    $usehtmleditor = can_use_html_editor(); 

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
    
    if(!$capabilities->edititems){
        error(get_string('error'));
    }

    //if the typ is pagebreak so the item will be saved directly
    if($typ == 'pagebreak') {
        feedback_create_pagebreak($feedback->id);
        redirect(htmlspecialchars('edit.php?id='.$id));
        exit;
    }
    
    //get the existing item or create it
    $formdata->itemid = isset($formdata->itemid) ? $formdata->itemid : NULL;
    $item = false;
    if($formdata->itemid and $item = get_record('feedback_item', 'id', $formdata->itemid)){
        $typ = $item->typ;
        $position = $item->position;
    }else {
        $position = -1;
    
        if ($position == '')$position = 0;
        if(!$typ)error('missing value "typ"', htmlspecialchars('edit.php?id='.$id));
    }

    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////
    if(isset($formdata->editcancel) AND $formdata->editcancel == 1){
        redirect(htmlspecialchars('edit.php?id=' . $id));
    }
    
    if(isset($formdata->saveitem) AND $formdata->saveitem == 1){
        $newposition = $formdata->position;
        $formdata->position = $newposition + 1;

        if (!$newitemid = feedback_create_item($formdata)) {
            $SESSION->feedback->errors[] = get_string('item_creation_failed', 'feedback');
        }else {
            $newitem = get_record('feedback_item', 'id', $newitemid);
            if (!feedback_move_item($newitem, $newposition)){
                $SESSION->feedback->errors[] = get_string('item_creation_failed', 'feedback');
            }else {
                redirect(htmlspecialchars('edit.php?id='.$id));
            }            
        }
    }
    
    if(isset($formdata->updateitem) AND $formdata->updateitem == 1){
        //update the item and go back
        if (!feedback_update_item($item, $formdata)) {
            $SESSION->feedback->errors[] = get_string('item_update_failed', 'feedback');
        } else {
            if (!feedback_move_item($item, $formdata->position)){
                $SESSION->feedback->errors[] = get_string('item_update_failed', 'feedback');
            }else {
                redirect(htmlspecialchars('edit.php?id='.$id));
            } 
        }
    }
    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////

    /// Print the page header
    $navlinks = array();
    $navigation = build_navigation($navlinks, $cm);

    $strfeedbacks = get_string("modulenameplural", "feedback");
    $strfeedback  = get_string("modulename", "feedback");

    print_header($course->shortname.': '.$feedback->name, $course->fullname, $navigation,
                    "", "", true, update_module_button($cm->id, $course->id, $strfeedback), 
                    navmenu($course, $cm));

    /// Print the main part of the page
    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////
    print_heading(format_text($feedback->name));
  
          
    //print errormsg
    if(isset($error)){echo $error;}

    feedback_print_errors();
            
    // print_simple_box_start('center');
    print_box_start('generalbox boxwidthwide boxaligncenter');
    echo '<form style="display:inline;" action="'.me().'" method="post">';
    echo '<input type="hidden" name="sesskey" value="' . $USER->sesskey . '" />';
    
    //this div makes the buttons stand side by side
    echo '<div style="display:inline">';
    $itemclass = 'feedback_item_'.$typ;
    $itemobj = new $itemclass();
    $itemobj->show_edit($item, $usehtmleditor);
    echo '</div>';        
    echo '<input type="hidden" name="id" value="'.$id.'" />';
    echo '<input type="hidden" name="itemid" value="'.(isset($item->id)?$item->id:'').'" />';
    echo '<input type="hidden" name="typ" value="'.$typ.'" />';
    echo '<input type="hidden" name="feedbackid" value="'.$feedback->id.'" />';
    
    //choose the position
    $lastposition = count_records('feedback_item', 'feedback', $feedback->id);
    echo get_string('position', 'feedback').'&nbsp;';
    echo '<select name="position">';
        //Dropdown-Items for choosing the position
        if($position == -1){
            feedback_print_numeric_option_list(1, $lastposition + 1, $lastposition + 1);
        }else {
            feedback_print_numeric_option_list(1, $lastposition, $item->position);
        }
    echo '</select>&nbsp;';
    
    //////////////////////////////////////////////////////////////////////////////////////        
    //////////////////////////////////////////////////////////////////////////////////////        
    if(!empty($item->id)){
        echo '<input type="hidden" id="updateitem" name="updateitem" value="1" />';
        echo '<input type="submit" value ="'.get_string('update_item', 'feedback').'" />';
    }else{
        echo '<input type="hidden" id="saveitem" name="saveitem" value="1" />';
        echo '<input type="submit" value="'.get_string('save_item', 'feedback').'" />';
    }

    echo '</form>';
    echo '<form style="display:inline;" action="'.$ME.'" method="POST">';
    echo '<input type="hidden" name="sesskey" value="' . $USER->sesskey . '" />';
    echo '<input type="hidden" name="id" value="'.$id.'" />';
    echo '<input type="hidden" id="editcancel" name="editcancel" value="1" />';
    echo '<input type="submit" value="'.get_string('cancel').'" />';
    echo '</form>';
    echo '<div style="clear:both">&nbsp;</div>';
    //////////////////////////////////////////////////////////////////////////////////////        
    //////////////////////////////////////////////////////////////////////////////////////

    // print_simple_box_end();
    print_box_end();
  
    if ($typ!='label') {
        echo '<script language="javascript">';
        echo 'document.getElementById("itemname").focus()';
        echo '</script>';
    } 

    /// Finish the page
    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////

    print_footer($course);

?>
