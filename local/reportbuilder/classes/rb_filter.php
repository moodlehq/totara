<?php

/*
 * Class defining a report builder filter
 */
class rb_filter {
    public $type, $value, $advanced, $label, $filtertype, $field, $joins;
    public $selectfunc, $selectchoices, $selectoptions, $grouping, $src;

    function __construct($type, $value, $advanced, $label, $filtertype, $field,
        $options=array()) {

        // use defaults if options not set
        $defaults = array(
            'joins' => null,
            'selectfunc' => null,
            'selectchoices' => array(),
            'selectoptions' => null,
            'grouping' => 'none',
            'src' => null,
        );
        $options = array_merge($defaults, $options);

        $this->type = $type;
        $this->value = $value;
        $this->advanced = $advanced;
        $this->label = $label;
        $this->filtertype = $filtertype;
        $this->field = $field;

        // assign optional properties
        foreach($defaults as $property => $unused) {
            $this->$property = $options[$property];
        }

    }

    /*
     * Return an SQL snippet describing field information for this filter
     *
     * Includes any aggregation/grouping function that the filter is using
     *
     * @return string SQL snippet to use in WHERE or HAVING clause
     */
    function get_field() {
        $src = $this->src;
        $type = $this->type;
        $value = $this->value;
        $field = $this->field;
        $grouping = $this->grouping;
        if($this->grouping == 'none') {
            return $field;
        } else {
            $groupfunc = "rb_group_$grouping";
            if(!method_exists($src, $groupfunc)) {
                throw new ReportBuilderException("Grouping function '$groupfunc'" .
                   " doesn't exist in field of type '$type' and value '$value'");
            }
            return $src->$groupfunc($field);
        }
    }

    function is_grouped() {
        return $this->grouping != 'none';
    }

} // end of rb_filter class

