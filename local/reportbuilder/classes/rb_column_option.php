<?php

/*
 * Class defining a report builder column option
 */
class rb_column_option {
    public $type, $value, $name, $field, $joins;
    public $displayfunc, $defaultheading;
    public $extrafields, $capability, $noexport;
    public $grouping, $style, $hidden;

    function __construct($type, $value, $name, $field, $options=array()) {

        // use defaults if options not set
        $defaults = array(
            'joins' => null,
            'displayfunc' => null,
            'defaultheading' => null,
            'extrafields' => null,
            'capability' => null,
            'noexport' => false,
            'grouping' => 'none',
            'style' => null,
            'hidden' => 0,
        );
        $options = array_merge($defaults, $options);

        $this->type = $type;
        $this->value = $value;
        $this->name = $name;
        $this->field = $field;

        // assign optional properties
        foreach($defaults as $property => $unused) {
            $this->$property = $options[$property];
        }

    }

} // end of rb_column_options class


