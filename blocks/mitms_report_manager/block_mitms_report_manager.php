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

        $this->content = new stdClass;
        $this->content->text = mitms_print_report_manager(true);
        $this->content->footer = '';

        return $this->content;
    }

}
?>
