<?php //$Id$

class block_totara_report_manager extends block_base {

    function init() {
        $this->title = get_string('title', 'block_totara_report_manager');
        $this->version = 2010012800;
    }

    function applicable_formats() {
        return array('site' => true);
    }

    function instance_allow_multiple() {
        return false;
    }

    function specialization() {
        $this->title = get_string('displaytitle', 'block_totara_report_manager');
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
        $this->content->text = totara_print_report_manager(true);
        $this->content->footer = '';

        return $this->content;
    }

}
?>
