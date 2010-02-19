<?php //$Id$

class block_mitms_my_current_courses extends block_base {

    function init() {
        $this->title = get_string('title', 'block_mitms_my_current_courses');
        $this->version = 2010021900;
    }

    function applicable_formats() {
        return array('site' => true);
    }

    function instance_allow_multiple() {
        return false;
    }

    function specialization() {
        $this->title = get_string('displaytitle', 'block_mitms_my_current_courses');
    }

    function get_content() {

        if ($this->content !== NULL) {
            return $this->content;
        }

        if (empty($this->instance->pinned)) {
            $context = get_context_instance(CONTEXT_BLOCK, $this->instance->id);
        } else {
            $context = get_context_instance(CONTEXT_SYSTEM); // pinned blocks do not have own context
        }

        $this->content = new stdClass;
        $this->content->text = mitms_print_my_current_courses(true);
        $this->content->footer = '';

        return $this->content;
    }

}
?>
