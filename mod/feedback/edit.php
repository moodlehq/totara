<?php // $Id: edit.php,v 1.1.4.1 2008/01/15 23:53:24 agrabs Exp $
/**
* prints the form to edit the feedback items such moving, deleting and so on
*
* @version $Id: edit.php,v 1.1.4.1 2008/01/15 23:53:24 agrabs Exp $
* @author Andreas Grabs
* @license http://www.gnu.org/copyleft/gpl.html GNU Public License
* @package feedback
*/

    require_once("../../config.php");
    require_once("lib.php");
    require_once('edit_form.php');

    $id = required_param('id', PARAM_INT);

    $formdata = data_submitted('nomatch');
    $do_show = optional_param('do_show', 'edit', PARAM_ALPHA);
    $SESSION->feedback->current_tab = $do_show;
 
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

    //move up/down items
    if(isset($formdata->moveupitem) && $formdata->moveupitem > 0){
        $item = get_record('feedback_item', 'id', intval($formdata->moveupitem));
        feedback_moveup_item($item);
    }
    if(isset($formdata->movedownitem) && $formdata->movedownitem > 0){
        $item = get_record('feedback_item', 'id', intval($formdata->movedownitem));
        feedback_movedown_item($item);
    }
    
    //moving of items
    if(isset($formdata->movehere) && ($formdata->movehere > 0) && isset($SESSION->feedback->moving->movingitem)){
        $item = get_record('feedback_item', 'id', intval($SESSION->feedback->moving->movingitem));
        feedback_move_item($item, intval($formdata->movehere));
    }
    if(isset($formdata->moveitem) && $formdata->moveitem > 0){
        $item = get_record('feedback_item', 'id', intval($formdata->moveitem));
        $SESSION->feedback->moving->shouldmoving = 1;
        $SESSION->feedback->moving->movingitem = intval($formdata->moveitem);
    } else {
        unset($SESSION->feedback->moving);
    }
    
    if(isset($formdata->switchitemrequired) && $formdata->switchitemrequired > 0) {
        $item = get_record('feedback_item', 'id', $formdata->switchitemrequired);
        feedback_switch_item_required($item);
    }
    
    //the create_template-form
    $create_template_form = new feedback_edit_create_template_form();
    $create_template_form->set_feedbackdata(array('capabilities' => $capabilities));
    $create_template_form->set_form_elements();
    $create_template_form->set_data(array('id'=>$id, 'do_show'=>'templates'));
    $create_template_formdata = $create_template_form->get_data();
    if(isset($create_template_formdata->savetemplate) && $create_template_formdata->savetemplate == 1) {
        //check the capabilities to create templates
        if(!$capabilities->createprivatetemplate AND !$capabilities->createpublictemplate) {
            error('saving templates is not allowed');
        }
        if(trim($create_template_formdata->templatename) == '')
        {
            $savereturn = 'notsaved_name';
        }else {
            if($capabilities->createpublictemplate) {
                $create_template_formdata->ispublic = isset($create_template_formdata->ispublic) ? 1 : 0;
            }else {
                $create_template_formdata->ispublic = 0;
            }
            if(!feedback_save_as_template($feedback, $create_template_formdata->templatename, $create_template_formdata->ispublic))
            {
                $savereturn = 'failed';
            }else {
                $savereturn = 'saved';
            }
        }
    }

    //get the feedbackitems
    $lastposition = 0;
    $feedbackitems = get_records('feedback_item', 'feedback', $feedback->id, 'position');
    if(is_array($feedbackitems)){
        $feedbackitems = array_values($feedbackitems);
        $lastitem = $feedbackitems[count($feedbackitems)-1];
        $lastposition = $lastitem->position;
    }
    $lastposition++;
    
    
    //the add_item-form
    $add_item_form = new feedback_edit_add_question_form('edit_item.php');
    $add_item_form->set_data(array('id'=>$id, 'position'=>$lastposition));

    //the use_template-form
    $use_template_form = new feedback_edit_use_template_form('use_templ.php');
    $use_template_form->set_feedbackdata(array('course' => $course));
    $use_template_form->set_form_elements();
    $use_template_form->set_data(array('id'=>$id));

    //the create_template-form
    //$create_template_form = new feedback_edit_create_template_form('use_templ.php');

    /// Print the page header
    $navlinks = array();
    $navigation = build_navigation($navlinks, $cm);

    $strfeedbacks = get_string("modulenameplural", "feedback");
    $strfeedback  = get_string("modulename", "feedback");

    print_header($course->shortname.': '.$feedback->name, $course->fullname, $navigation,
                     '', '', true, update_module_button($cm->id, $course->id, $strfeedback), 
                     navmenu($course, $cm));

    /// print the tabs
    include('tabs.php');

    /// Print the main part of the page
    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////
	
    $savereturn=isset($savereturn)?$savereturn:'';
	  
    //print the messages
    if($savereturn == 'notsaved_name') {
        echo '<p align="center"><b><font color="red">'.get_string('name_required','feedback').'</font></b></p>';
    }

    if($savereturn == 'saved') {
        echo '<p align="center"><b><font color="green">'.get_string('template_saved','feedback').'</font></b></p>';
    }
    
    if($savereturn == 'failed') {
        echo '<p align="center"><b><font color="red">'.get_string('saving_failed','feedback').'</font></b></p>';
    }

    feedback_print_errors();
    
    ///////////////////////////////////////////////////////////////////////////
    ///print the template-section
    ///////////////////////////////////////////////////////////////////////////
    if($do_show == 'templates') {
        // print_simple_box_start("center", '80%');
        print_box_start('generalbox boxaligncenter boxwidthwide');
        $use_template_form->display();
        
        if($capabilities->createprivatetemplate OR $capabilities->createpublictemplate) {
            $create_template_form->display();
            echo '<p><a href="'.htmlspecialchars('delete_template.php?id='.$id).'">'.get_string('delete_templates', 'feedback').'</a></p>';
        }else {
            echo '&nbsp;';
        }

        if($capabilities->edititems) {
            echo '<p>
                <a href="'.htmlspecialchars('export.php?action=exportfile&id='.$id).'">'.get_string('export_questions', 'feedback').'</a>/
                <a href="'.htmlspecialchars('import.php?id='.$id).'">'.get_string('import_questions', 'feedback').'</a>
            </p>';
        }
        // print_simple_box_end();
        print_box_end();
    }
    ///////////////////////////////////////////////////////////////////////////
    ///print the Item-Edit-section
    ///////////////////////////////////////////////////////////////////////////
    if($do_show == 'edit') {
        
        $add_item_form->display();

        if(is_array($feedbackitems)){
            $itemnr = 0;
            
            $helpbutton = helpbutton('preview', get_string('preview','feedback'), 'feedback',true,false,'',true);
            
            print_heading($helpbutton . get_string('preview', 'feedback'));
            if(isset($SESSION->feedback->moving) AND $SESSION->feedback->moving->shouldmoving == 1) {
                print_heading('<a href="'.htmlspecialchars($ME.'?id='.$id).'">'.get_string('cancel_moving', 'feedback').'</a>');
            }
            // print_simple_box_start('center', '80%');
            print_box_start('generalbox boxaligncenter boxwidthwide');
            
            //check, if there exists required-elements
            $countreq = count_records('feedback_item', 'feedback', $feedback->id, 'required', 1);
            if($countreq > 0) {
                echo '<font color="red">(*)' . get_string('items_are_required', 'feedback') . '</font>';
            }
            
            echo '<table>';
            if(isset($SESSION->feedback->moving) AND $SESSION->feedback->moving->shouldmoving == 1) {
                $moveposition = 1;
                echo '<tr>'; //only shown if shouldmoving = 1
                    echo '<td>';
                        echo '<form action="'.$ME.'" method="post">';
                        echo '<input title="'.get_string('move_here','feedback').'" type="image" src="'.$CFG->pixpath .'/movehere.gif" hspace="1" height="16" width="80" border="0" />';
                        echo '<input type="hidden" name="movehere" value="'.$moveposition.'" />';
                        feedback_edit_print_default_form_values($id, $do_show);
                        echo '</form>';
                    echo '</td>';
                echo '</tr>';
            }
            //print the inserted items
            $itempos = 0;
            foreach($feedbackitems as $feedbackitem){
                $itempos++;
                if(isset($SESSION->feedback->moving) AND $SESSION->feedback->moving->movingitem == $feedbackitem->id){ //hiding the item to move
                    continue;
                }
                echo '<tr>';
                //items without value only are labels
                if($feedbackitem->hasvalue == 1) {
                    $itemnr++;
                    echo '<td valign="top">' . $itemnr . '.)&nbsp;</td>';
                } else {
                    echo '<td>&nbsp;</td>';
                }
                if($feedbackitem->typ != 'pagebreak') {
                    feedback_print_item($feedbackitem, false, false, true);
                }else {
                    echo '<td class="feedback_pagebreak"><b>'.get_string('pagebreak', 'feedback').'</b></td><td><hr width="100%" size="8px" noshade="noshade" /></td>';
                }
                echo '<td>('.get_string('position', 'feedback').':'.$itempos .')</td>';
                echo '<td>';
                if($feedbackitem->position > 1){
                    //print the button to move-up the item
                    echo '<form action="'.$ME.'" method="post">';
                    echo '<input title="'.get_string('moveup_item','feedback').'" type="image" src="'.$CFG->pixpath .'/t/up.gif" hspace="1" height="11" width="11" border="0" />';
                    echo '<input type="hidden" name="moveupitem" value="'.$feedbackitem->id.'" />';
                    feedback_edit_print_default_form_values($id, $do_show);
                    echo '</form>';
                }else{
                    echo '&nbsp;';
                }
                echo '</td>';
                echo '<td>';
                if($feedbackitem->position < $lastposition - 1){
                    //print the button to move-down the item
                    echo '<form action="'.$ME.'" method="post">';
                    echo '<input title="'.get_string('movedown_item','feedback').'" type="image" src="'.$CFG->pixpath .'/t/down.gif" hspace="1" height="11" width="11" border="0" />';
                    echo '<input type="hidden" name="movedownitem" value="'.$feedbackitem->id.'" />';
                    feedback_edit_print_default_form_values($id, $do_show);
                    echo '</form>';
                }else{
                    echo '&nbsp;';
                }
                echo '</td>';
                echo '<td>';
                    echo '<form action="'.$ME.'" method="post">';
                    echo '<input title="'.get_string('move_item','feedback').'" type="image" src="'.$CFG->pixpath .'/t/move.gif" hspace="1" height="11" width="11" border="0" />';
                    echo '<input type="hidden" name="moveitem" value="'.$feedbackitem->id.'" />';
                    feedback_edit_print_default_form_values($id, $do_show);
                    echo '</form>';
                echo '</td>';
                echo '<td>';
                //print the button to edit the item
                if($feedbackitem->typ != 'pagebreak') {
                    echo '<form action="edit_item.php" method="post">';
                    echo '<input title="'.get_string('edit_item','feedback').'" type="image" src="'.$CFG->pixpath .'/t/edit.gif" hspace="1" height="11" width="11" border="0" />';
                    echo '<input type="hidden" name="itemid" value="'.$feedbackitem->id.'" />';
                    echo '<input type="hidden" name="typ" value="'.$feedbackitem->typ.'" />';
                    feedback_edit_print_default_form_values($id, $do_show);
                    echo '</form>';
                }else {
                    echo '&nbsp;';
                }
                echo '</td>';
                echo '<td>';
                
                //print the toggle-button to switch required yes/no
                if($feedbackitem->hasvalue == 1) {
                    echo '<form action="'.$ME.'" method="post">';
                    if($feedbackitem->required == 1) {
                        echo '<input title="'.get_string('switch_item_to_not_required','feedback').'" type="image" src="pics/required.gif" hspace="1" height="11" width="11" border="0" />';
                    } else {
                        echo '<input title="'.get_string('switch_item_to_required','feedback').'" type="image" src="pics/notrequired.gif" hspace="1" height="11" width="11" border="0" />';
                    }
                    echo '<input type="hidden" name="switchitemrequired" value="'.$feedbackitem->id.'" />';
                    feedback_edit_print_default_form_values($id, $do_show);
                    echo '</form>';
                }else {
                    echo '&nbsp;';
                }
                echo '</td>';
                echo '<td>';
                //print the button to drop the item
                echo '<form action="delete_item.php" method="post">';
                echo '<input title="'.get_string('delete_item','feedback').'" type="image" src="'.$CFG->pixpath .'/t/delete.gif" hspace="1" height="11" width="11" border="0" />';
                echo '<input type="hidden" name="deleteitem" value="'.$feedbackitem->id.'" />';
                feedback_edit_print_default_form_values($id, $do_show);
                echo '</form>';
                echo '</td>';
                echo '</tr>';
                if(isset($SESSION->feedback->moving) AND $SESSION->feedback->moving->shouldmoving == 1) {
                    $moveposition++;
                    echo '<tr>'; //only shown if shouldmoving = 1
                        echo '<td>';
                            echo '<form action="'.$ME.'" method="post">';
                            echo '<input title="'.get_string('move_here','feedback').'" type="image" src="'.$CFG->pixpath .'/movehere.gif" hspace="1" height="16" width="80" border="0" />';
                            echo '<input type="hidden" name="movehere" value="'.$moveposition.'" />';
                            feedback_edit_print_default_form_values($id, $do_show);
                            echo '</form>';
                        echo '</td>';
                    echo '</tr>';
                }else {
                    echo '<tr><td>&nbsp;</td></tr>';
                }
                
            }
            echo '</table>';
            // print_simple_box_end();
            print_box_end();
        }else{
            // print_simple_box(get_string('no_items_available_yet','feedback'),"center");
            print_box(get_string('no_items_available_yet','feedback'),'generalbox boxaligncenter');
        }
    }
    /// Finish the page
    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////

    print_footer($course);

    function feedback_edit_print_default_form_values($id, $tab) {
        global $USER;
        
        echo '<input type="hidden" name="sesskey" value="' . $USER->sesskey . '" />';
        echo '<input type="hidden" name="id" value="'.$id.'" />';
        echo '<input type="hidden" name="do_show" value="'.$tab.'" />';
    }
?>
