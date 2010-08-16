<?php

/**
 * Class defining a report builder content option
 *
 * A content option contains information about how a content
 * restriction should be applied to a particular source.
 *
 * @copyright Totara Learning Solutions Limited
 * @author Simon Coggins
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage reportbuilder
 */
/*
 * Class defining a report builder content option
 */
class rb_content_option {
    /**
     * Name of the content restriction to apply against
     *
     * If 'current_org' is chosen, will try to create an instance
     * of a class called 'rb_current_org_content' which should
     * extend {@link rb_base_content}.
     *
     * @access public
     * @var string
     */
    public $classname;

    /**
     * Title for the content restriction
     *
     * Content restrictions can be applied to different fields, so
     * each source needs to provide a human readable title which
     * is used to explain which field it is being applied to.
     *
     * An example might be "The user's current position" if the
     * content restriction was restricting based on that field
     *
     * @access public
     * @var string
     */
    public $title;

    /**
     * The database field to apply the restriction against
     *
     * @access public
     * @var string
     */
    public $field;

    /**
     * The names of any {@link rb_join::$name} required to get access
     * to the {@link rb_content_option::$field}. This can be a string
     * or an array of strings if multiple joins are required.
     *
     * Their is no need to include join dependencies, these will
     * be added automatically.
     *
     * @access public
     * @var mixed
     */
    public $joins;

    /**
     * Generate a new rb_content_option instance
     *
     * @param string $classname Name of the content restriction class
     * @param string $title Human readable description of the field
     * @param string $field Database field to apply the restriction to
     * @param mixed $joins {@link rb_join::$name} required to access
     *             {@link rb_content_option::$field}
     */
    function __construct($classname, $title, $field, $joins=null) {

        $this->classname = $classname;
        $this->title = $title;
        $this->field = $field;
        $this->joins = $joins;

    }

} // end of rb_content_option class
