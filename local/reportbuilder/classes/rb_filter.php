<?php

/**
 * Class defining a report builder filter (search option)
 *
 * This class contains properties and methods needed by a filter
 * Instances of this class differ from rb_filter_option instances
 * in that they refer to an actual filter in a report instance, as
 * opposed to an available filter option.
 *
 * As well as inheriting a number of properties from the filter
 * option on which it is based, a filter defines extra information
 * about the filter such as if it should be an advanced option or not
 *
 * @copyright Totara Learning Solutions Ltd
 * @author Simon Coggins
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage reportbuilder
 */
class rb_filter {
    /**
     * Type of the {@link rb_column} that this filter should act against
     *
     * @access public
     * @var string
     */
    public $type;

    /**
     * Value of the {@link rb_column} that this filter should act against
     *
     * @access public
     * @var string
     */
    public $value;

    /**
     * Should this filter appear as a basic option (0) or advanced option (1)
     *
     * @access public
     * @var integer
     */
    public $advanced;

    /**
     * Text label to appear next to the filter
     *
     * @access public
     * @var string
     */
    public $label;

    /**
     * Name of the kind of {@link filter_type} to display
     *
     * Options include 'text', 'date', 'select', 'number', 'textarea', 'simpleselect'.
     * See {@link filter_type} child classes for a full list of options
     *
     * Each type of filter appears differently, and offers different search options.
     * Some filter types (like select) require additional parameters
     *
     * @access public
     * @var string
     */
    public $filtertype;

    /**
     * SQL snippet detailing the field to be searched by this filter
     *
     * Typically this will automatically be populated by the {@link rb_column::$field}
     * property from the column that this filter is acting on
     *
     * The required format is:
     *
     * <code>join_name.field_name</code>
     *
     * @access public
     * @var string
     */
    public $field;

    /**
     * Name of a function that will provide the options for a select pulldown
     *
     * Given a $selectfunc of 'name', a method of the source called rb_filter_name()
     * will be called and the return value used to populate the options list.
     *
     * Some common filter functions are provided by {@link rb_base_source}, and more
     * can be created by the source that needs them.
     *
     * Filters with type 'simpleselect' use {@link rb_filter::$selectchoices} instead.
     *
     * @access public
     * @var string
     */
    public $selectfunc;

    /**
     * Array of options used by simpleselect filters to populate the filter options
     *
     * Typical format would be:
     *
     * <code>
     * array(
     *     1 => get_string('yes'),
     *     0 => get_string('no'),
     * )
     * </code>
     *
     * Filters with type 'select' use {@link rb_filter::$selectfunc} instead.
     * @access public
     * @var array
     */
    public $selectchoices;

    /**
     * Options to pass to 'select' and 'simpleselect' type filters. Used in the
     * select formslib element to modify the appearance of the select menu. The
     * format is:
     *
     * <code>array('attribute' => 'value')</code>
     *
     * where attribute is an HTML attribute to add to the select tag and value
     * is the value to give it.
     *
     * One common value for $selectoptions is:
     *
     * <code>'selectoptions' => rb_filter_option::select_width_limiter(),</code>
     *
     * Which uses the {@link rb_filter_option::select_width_limiter()} method
     * to restrict the size of the pulldown without cutting it off in Internet
     * Explorer.
     *
     * @access public;
     * @var array
     */
    public $selectoptions;

    /**
     * If grouping is set to anything but 'none', a method of the source called
     * 'rb_group_name()' will be called if found, passing in the field as an
     * argument. The value returned from this method will be used instead of the
     * field in the WHERE clause, and the SQL will be executed as a GROUP BY query.
     *
     * For example, if grouping is set to 'max' on a filter with $field set to
     * 'join.col', then the method source->rb_group_max() will be called. It will
     * return 'MAX(join.col)' when passed 'join.col' as a parameter, and that
     * output will be used in place of 'join.col' in any WHERE clauses.
     *
     * Some common group functions are provided by {@link rb_base_source}, and more
     * can be created by the source that needs them.
     *
     * @access public
     * @var string
     */
    public $grouping;

    /**
     * A copy of the source object that this filter is part of. This is needed
     * to give the filter access to the rb_filter_* functions for creating the
     * select pulldown options.
     *
     * @access public
     * @var rb_base_source
     */
    public $src;

    /**
     * Generate a new filter instance
     *
     * Options provided by an associative array, e.g.:
     *
     * <code>array('selectfunc' => 'yesno')</code>
     *
     * Will provide default values for any optional parameters that aren't set
     *
     * @param string $type Type of the column to base the filter on
     * @param string $value Value of the column to base the filter on
     * @param string $advanced Should the filter be an advanced option?
     * @param string $label Text label to appear next to the filter
     * @param string $filtertype Kind of filter this is (text, select, date, etc)
     * @param string $field The field in the database to act on
     * @param array $options Associative array of optional settings for the filter
     */
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

    /**
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

    /**
     * Return true if a rb_filter is grouped, false otherwise
     *
     * @return boolean True if this filter is grouped
     */
    function is_grouped() {
        return $this->grouping != 'none';
    }

} // end of rb_filter class

