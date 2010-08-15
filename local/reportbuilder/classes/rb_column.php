<?php

/*
 * Class defining a report builder column
 *
 * This class contains properties and methods needed by a column
 * Instances of this class differ from rb_column_option instances
 * in that they refer to an actual column in a report instance, as
 * opposed to an available column option.
 *
 * As well as inheritting a number of properties from the column
 * option on which it is based, a column defines extra information
 * about the column such as the heading the user wishes to use to
 * describe it
 *
 * @copyright Catalyst IT Limited
 * @author Simon Coggins
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage reportbuilder
 */
class rb_column {
    public $type, $value, $heading, $field, $joins;
    public $displayfunc, $extrafields, $required;
    public $capability, $noexport, $grouping, $style;
    public $hidden;

    function __construct($type, $value, $heading, $field, $options=array()) {

        // use defaults if options not set
        $defaults = array(
            'joins' => null,
            'displayfunc' => null,
            'extrafields' => null,
            'required' => false,
            'capability' => null,
            'noexport' => false,
            'grouping' => 'none',
            'style' => null,
            'hidden' => 0,
        );
        $options = array_merge($defaults, $options);

        $this->type = $type;
        $this->value = $value;
        $this->heading = $heading;
        $this->field = $field;

        // assign optional properties
        foreach($defaults as $property => $unused) {
            $this->$property = $options[$property];
        }

    }

    /*
     * Obtain an array of SQL snippets describing field information for this column
     *
     * @param object $src Source object containing grouping methods
     * @return array Array of field names with aliases used to build a query
     */
    function get_fields($src=null) {
        $field = $this->field;
        $type = $this->type;
        $value = $this->value;
        $extrafields = isset($this->extrafields) ? $this->extrafields : null;

        $fields = array();
        if($this->grouping == 'none') {
            if($field !== null) {
                $fields[] = $field . ' ' . sql_as() . " {$type}_{$value}";
            }
            if($extrafields !== null) {
                foreach($extrafields as $alias => $extrafield) {
                    $fields[] = "$extrafield " . sql_as() . " $alias";
                }
            }
        } else {
            // field is grouped
            // if grouping function doesn't exist, exit with error
            $groupfunc = 'rb_group_' . $this->grouping;
            if(!method_exists($src, $groupfunc)) {
                throw new ReportBuilderException("Grouping function '$groupfunc'" .
                   " doesn't exist in field of type '$type' and value '$value'");
            }
            // apply grouping function and ignore extrafields
            if($field !== null) {
                $fields[] = $src->$groupfunc($field)  . ' ' . sql_as() .
                    " {$type}_{$value}";
            }
        }
        return $fields;
    }

    /*
     * Examine a column to determine if it should be displayed in the current context
     *
     * @param boolean $isexport If true, data is being exported
     * @return boolean True if the column should be shown, false otherwise
     */
    function display_column($isexport=false) {
        // don't print the column if heading is blank
        if($this->heading == '') {
            return false;
        }

        // don't print the column if column has noexport set and this is an export
        if($isexport && $this->noexport) {
            return false;
        }

        // don't display column if capability is required and user doesn't have it
        $context = get_context_instance(CONTEXT_SYSTEM);
        if(isset($this->capability) && !has_capability($this->capability, $context)) {
            return false;
        }

        return true;
    }

} // end of rb_column class
