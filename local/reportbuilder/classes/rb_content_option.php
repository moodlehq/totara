<?php

/*
 * Class defining a report builder content option
 */
class rb_content_option {
    public $classname, $title, $field, $joins;

    function __construct($classname, $title, $field, $joins=null) {

        $this->classname = $classname;
        $this->title = $title;
        $this->field = $field;
        $this->joins = $joins;

    }

} // end of rb_content_option class
