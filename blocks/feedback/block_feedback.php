<?php
require_once($CFG->dirroot.'/mod/feedback/lib.php');
class block_feedback extends block_base {

    function init() {
        $this->title = get_string('feedback', 'block_feedback');
        $this->version = 2007072500;
    }

    function get_content() {
        global $CFG;
        $courseid = intval($this->instance->pageid);
        if($courseid <= 0) $courseid = SITEID;
        if($this->content !== NULL) {
            return $this->content;
        }

        if (empty($this->instance->pageid)) {
            $this->instance->pageid = SITEID;
        }

        $this->content = New stdClass;
        $this->content->text = '';

        // the sql below is translated as
        // get the feedback instances on the course site
        // show only feedback does have an existing mapping at feedback_sitecourse_map on the current course
        // or feedback that does not have an explicit mapping on feedback_sitecourse_map
        
        // does not work with mysql
        // $sql = "select cm.id, f.name from
                // {$CFG->prefix}feedback f, {$CFG->prefix}course_modules cm,
                // {$CFG->prefix}modules m
                // where f.id = cm.instance and f.course = '1'
                // and m.id = cm.module and m.name = 'feedback'
                // and (exists (select 1 from {$CFG->prefix}feedback_sitecourse_map sm where sm.courseid = $courseid)
                // or not exists (select 1 from {$CFG->prefix}feedback_sitecourse_map sm where sm.feedbackid = f.id))";
        // $sql = "SELECT cm.id, f.name
                  // FROM {$CFG->prefix}feedback f, {$CFG->prefix}course_modules cm, {$CFG->prefix}feedback_sitecourse_map sm, {$CFG->prefix}modules m
                  // WHERE f.id = cm.instance
                    // AND f.course = '".SITEID."'
                    // AND m.id = cm.module 
                    // AND m.name = 'feedback'
                    // AND sm.courseid = $courseid 
                    // AND sm.feedbackid = f.id";
        
        // if ($feedbacks = get_records_sql($sql)) {
            
        if ( $feedbacks = feedback_get_feedbacks_from_sitecourse_map($courseid)) { //arb
        
            foreach ($feedbacks as $feedback) { //arb
                $this->content->text .= '<a href="'.$CFG->wwwroot.'/mod/feedback/view.php?id='. //arb
                $feedback->cmid.'&courseid='.$courseid.'">'.$feedback->name . '</a><br/>'; //arb
            }
    
        }

        $this->content->footer = '';

        return $this->content;

    }

}

?>
