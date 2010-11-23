<?php

/**
 * Class defining a report builder filter option (search option)
 *
 * A filter option is an object that defines a possible filter
 * within a source. When an administrator includes this filter
 * option in a report, they provide some additional information
 * (such as if it is an advanced option), and a {@link rb_filter}
 * object is created based on the filter option's properties.
 *
 * @copyright Totara Learning Solutions Ltd
 * @author Simon Coggins
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage reportbuilder
 */
class rb_filter_option {
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
     * When default filters are included, this parameter determines if they
     * start with their advanced status set to basic (0) or advanced (1)
     *
     * @access public
     * @var integer
     */
    public $defaultadvanced;


    /**
     * Generate a new filter option instance
     *
     * Options provided by an associative array, e.g.:
     *
     * <code>array('selectfunc' => 'yesno')</code>
     *
     * Will provide default values for any optional parameters that aren't set
     *
     * @param string $type Type of the column to base the filter on
     * @param string $value Value of the column to base the filter on
     * @param string $label Text label to appear next to the filter
     * @param string $filtertype Kind of filter this is (text, select, date, etc)
     * @param array $options Associative array of optional settings for the filter
     */
    function __construct($type, $value, $label, $filtertype,
        $options=array()) {

        // use defaults if options not set
        $defaults = array(
            'selectfunc' => null,
            'selectchoices' => array(),
            'selectoptions' => null,
            'defaultadvanced' => 0,
        );
        $options = array_merge($defaults, $options);

        $this->type = $type;
        $this->value = $value;
        $this->label = $label;
        $this->filtertype = $filtertype;

        // assign optional properties
        foreach($defaults as $property => $unused) {
            $this->$property = $options[$property];
        }

    }

    /**
     * Returns an attribute variable used to limit the width of a pulldown
     *
     * This code is required to fix limited width pulldowns in IE. The
     * if(document.all) condition limits the javascript to only affect IE.
     *
     * @return array Array of the correct format to be used by a 'select'
     *               form element
     */
    static function select_width_limiter() {
        return array(
            'class' => 'totara-limited-width-150',
            'onMouseDown'=>"if(document.all) this.className='totara-expanded-width-150';",
            'onBlur'=>"if(document.all) this.className='totara-limited-width-150';",
            'onChange'=>"if(document.all) this.className='totara-limited-width-150';"
        );
    }

} // end of rb_filter class

