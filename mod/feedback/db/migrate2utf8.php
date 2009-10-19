<?php // $Id: migrate2utf8.php,v 1.1 2007/05/22 04:53:24 moodler Exp $
function migrate2utf8_feedback_name($recordid){
    global $CFG, $globallang;

/// Some trivial checks
    if (empty($recordid)) {
        log_the_problem_somewhere();
        return false;
    }

    if (!$feedback = get_record('feedback', 'id', $recordid)) {
        log_the_problem_somewhere();
        return false;
    }

    if ($globallang) {
        $fromenc = $globallang;
    } else {
        $sitelang   = $CFG->lang;
        $courselang = get_course_lang($feedback->course);  //Non existing!
        $userlang   = get_main_teacher_lang($feedback->course); //N.E.!!

        $fromenc = get_original_encoding($sitelang, $courselang, $userlang);
    }

/// We are going to use textlib facilities
    
/// Convert the text
    if (($fromenc != 'utf-8') && ($fromenc != 'UTF-8')) {
        $result = utfconvert($feedback->name, $fromenc);

        $newfeedback = new object;
        $newfeedback->id = $recordid;
        $newfeedback->name = $result;
        migrate2utf8_update_record('feedback',$newfeedback);
    }
/// And finally, just return the converted field
    return $result;
}

function migrate2utf8_feedback_summary($recordid){
    global $CFG, $globallang;

/// Some trivial checks
    if (empty($recordid)) {
        log_the_problem_somewhere();
        return false;
    }

    if (!$feedback = get_record('feedback', 'id', $recordid)) {
        log_the_problem_somewhere();
        return false;
    }

    if ($globallang) {
        $fromenc = $globallang;
    } else {
        $sitelang   = $CFG->lang;
        $courselang = get_course_lang($feedback->course);  //Non existing!
        $userlang   = get_main_teacher_lang($feedback->course); //N.E.!!

        $fromenc = get_original_encoding($sitelang, $courselang, $userlang);
    }

/// We are going to use textlib facilities
    
/// Convert the text
    if (($fromenc != 'utf-8') && ($fromenc != 'UTF-8')) {
        $result = utfconvert($feedback->summary, $fromenc);

        $newfeedback = new object;
        $newfeedback->id = $recordid;
        $newfeedback->summary = $result;
        migrate2utf8_update_record('feedback',$newfeedback);
    }
/// And finally, just return the converted field
    return $result;
}

function migrate2utf8_feedback_page_after_submit($recordid){
    global $CFG, $globallang;

/// Some trivial checks
    if (empty($recordid)) {
        log_the_problem_somewhere();
        return false;
    }

    if (!$feedback = get_record('feedback', 'id', $recordid)) {
        log_the_problem_somewhere();
        return false;
    }

    if ($globallang) {
        $fromenc = $globallang;
    } else {
        $sitelang   = $CFG->lang;
        $courselang = get_course_lang($feedback->course);  //Non existing!
        $userlang   = get_main_teacher_lang($feedback->course); //N.E.!!

        $fromenc = get_original_encoding($sitelang, $courselang, $userlang);
    }

/// We are going to use textlib facilities
    
/// Convert the text
    if (($fromenc != 'utf-8') && ($fromenc != 'UTF-8')) {
        $result = utfconvert($feedback->page_after_submit, $fromenc);

        $newfeedback = new object;
        $newfeedback->id = $recordid;
        $newfeedback->page_after_submit = $result;
        migrate2utf8_update_record('feedback',$newfeedback);
    }
/// And finally, just return the converted field
    return $result;
}

function migrate2utf8_feedback_template_name($recordid){
    global $CFG, $globallang;

/// Some trivial checks
    if (empty($recordid)) {
        log_the_problem_somewhere();
        return false;
    }

    if (!$template = get_record('feedback_template', 'id', $recordid)) {
        log_the_problem_somewhere();
        return false;
    }

    if ($globallang) {
        $fromenc = $globallang;
    } else {
        $sitelang   = $CFG->lang;
        $courselang = get_course_lang($template->course);  //Non existing!
        $userlang   = get_main_teacher_lang($template->course); //N.E.!!

        $fromenc = get_original_encoding($sitelang, $courselang, $userlang);
    }

/// We are going to use textlib facilities
    
/// Convert the text
    if (($fromenc != 'utf-8') && ($fromenc != 'UTF-8')) {
        $result = utfconvert($template->name, $fromenc);

        $newtemplate = new object;
        $newtemplate->id = $recordid;
        $newtemplate->name = $result;
        migrate2utf8_update_record('feedback_template',$newtemplate);
    }
/// And finally, just return the converted field
    return $result;
}

function migrate2utf8_feedback_item_name($recordid){
    global $CFG, $globallang;

/// Some trivial checks
    if (empty($recordid)) {
        log_the_problem_somewhere();
        return false;
    }

    if (!$item = get_record('feedback_item', 'id', $recordid)) {
        log_the_problem_somewhere();
        return false;
    }

    if (!$feedback = get_record('feedback', 'id', $item->feedback)) {
        log_the_problem_somewhere();
        return false;
    }

    if ($globallang) {
        $fromenc = $globallang;
    } else {
        $sitelang   = $CFG->lang;
        $courselang = get_course_lang($feedback->course);  //Non existing!
        $userlang   = get_main_teacher_lang($feedback->course); //N.E.!!

        $fromenc = get_original_encoding($sitelang, $courselang, $userlang);
    }

/// We are going to use textlib facilities
    
/// Convert the text
    if (($fromenc != 'utf-8') && ($fromenc != 'UTF-8')) {
        $result = utfconvert($item->name, $fromenc);

        $newitem = new object;
        $newitem->id = $recordid;
        $newitem->name = $result;
        migrate2utf8_update_record('feedback_item',$newitem);
    }
/// And finally, just return the converted field
    return $result;
}

function migrate2utf8_feedback_item_presentation($recordid){
    global $CFG, $globallang;

/// Some trivial checks
    if (empty($recordid)) {
        log_the_problem_somewhere();
        return false;
    }

    if (!$item = get_record('feedback_item', 'id', $recordid)) {
        log_the_problem_somewhere();
        return false;
    }

    if (!$feedback = get_record('feedback', 'id', $item->feedback)) {
        log_the_problem_somewhere();
        return false;
    }

    if ($globallang) {
        $fromenc = $globallang;
    } else {
        $sitelang   = $CFG->lang;
        $courselang = get_course_lang($feedback->course);  //Non existing!
        $userlang   = get_main_teacher_lang($feedback->course); //N.E.!!

        $fromenc = get_original_encoding($sitelang, $courselang, $userlang);
    }

/// We are going to use textlib facilities
    
/// Convert the text
    if (($fromenc != 'utf-8') && ($fromenc != 'UTF-8')) {
        $result = utfconvert($item->presentation, $fromenc);

        $newitem = new object;
        $newitem->id = $recordid;
        $newitem->presentation = $result;
        migrate2utf8_update_record('feedback_item',$newitem);
    }
/// And finally, just return the converted field
    return $result;
}

function migrate2utf8_feedback_value_value($recordid){
    global $CFG, $globallang;

/// Some trivial checks
    if (empty($recordid)) {
        log_the_problem_somewhere();
        return false;
    }

    if (!$value = get_record('feedback_value', 'id', $recordid)) {
        log_the_problem_somewhere();
        return false;
    }
    
    //get the feedback
    $sql = "SELECT f.* FROM
               ".$CFG->prefix."feedback as f, ".$CFG->prefix."feedback_completed as fc
            WHERE fc.id = ".$value->completed."
               AND fc.feedback = f.id";
    
    if (!$feedback = get_record_sql($sql)) {
        log_the_problem_somewhere();
        return false;
    }

    if ($globallang) {
        $fromenc = $globallang;
    } else {
        $sitelang   = $CFG->lang;
        $courselang = get_course_lang($feedback->course);  //Non existing!
        $userlang   = get_main_teacher_lang($feedback->course); //N.E.!!

        $fromenc = get_original_encoding($sitelang, $courselang, $userlang);
    }

/// We are going to use textlib facilities
    
/// Convert the text
    if (($fromenc != 'utf-8') && ($fromenc != 'UTF-8')) {
        $result = utfconvert($value->value, $fromenc);

        $newvalue = new object;
        $newvalue->id = $recordid;
        $newvalue->value = $result;
        migrate2utf8_update_record('feedback_value',$newvalue);
    }
/// And finally, just return the converted field
    return $result;
}
?>
