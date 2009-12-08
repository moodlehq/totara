<?php //$Id$

class block_mitms_my_learning_nav extends block_base {

    function init() {
        $this->title = get_string('title', 'block_mitms_my_learning_nav');
        $this->version = 2009120100;
    }

    function applicable_formats() {
        return array('site' => true);
    }

    function instance_allow_multiple() {
        return false;
    }

    function specialization() {
        $this->title = get_string('displaytitle', 'block_mitms_my_learning_nav');
    }

    function get_content() {
        if ($this->content !== NULL) {
            return $this->content;
        }

        $this->content = new stdClass;
        $this->content->text = mitms_print_my_learning_nav(true);
        $this->content->footer = '';

        return $this->content;
    }

}
?>
