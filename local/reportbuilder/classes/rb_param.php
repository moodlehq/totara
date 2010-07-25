<?php

/*
 * Class defining a report builder parameter
 */
class rb_param {
    public $name, $field, $joins, $value;

    function __construct($name, $paramoptions) {

        $this->name = $name;

        foreach($paramoptions as $paramoption) {
            if($paramoption->name == $name) {
                $this->field = $paramoption->field;
                $this->joins = $paramoption->joins;
                break;
            }
        }
    }

} // end of rb_param class
