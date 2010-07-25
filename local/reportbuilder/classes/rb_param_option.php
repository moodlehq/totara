<?php

/*
 * Class defining a report builder parameter option
 */
class rb_param_option {
    public $name, $field, $joins;

    function __construct($name, $field, $joins=null) {

        $this->name = $name;
        $this->field = $field;
        $this->joins = $joins;
    }

} // end of rb_param_options class


