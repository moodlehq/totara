<?php //$Id$

class block_mitms_report_manager extends block_base {

    function init() {
        $this->title = get_string('title', 'block_mitms_report_manager');
        $this->version = 2010012800;
    }

    function applicable_formats() {
        return array('site' => true);
    }

    function instance_allow_multiple() {
        return false;
    }

    function specialization() {
        $this->title = get_string('displaytitle', 'block_mitms_report_manager');
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
        if(has_capability('moodle/local:viewstaffreports',$context) || has_capability('moodle/local:viewlocalreports',$context)) {
            $this->content->text = mitms_print_report_manager(true);
        } else {
            $this->content->text = '';
        }
        $this->content->footer = '';

        return $this->content;
    }

}
?>
