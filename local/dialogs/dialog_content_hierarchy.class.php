<?php

/**
 * Hierarchy dialog generator
 *
 * @copyright Totara Learning Solutions Limited
 * @author Aaron Barnes <aaronb@catalyst.net.nz>
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage dialogs
 */
require_once($CFG->dirroot.'/local/dialogs/dialog_content.class.php');
require_once($CFG->dirroot.'/hierarchy/lib.php');


/**
 * Class for generating single select hierarchy dialog markup
 *
 * @access  public
 */
class totara_dialog_content_hierarchy extends totara_dialog_content {

    /**
     * Hierarchy object instance
     *
     * @access  public
     * @var     object
     */
    public $hierarchy;


    /**
     * Flag to disable framework picker
     *
     * @access  public
     * @var     boolean
     */
    public $disable_picker = false;


    /**
     * If you are making access checks seperately, you can disable
     * the internal checks by setting this to false
     *
     * @access  public
     * @var     boolean
     */
    public $skip_access_checks = false;


    /**
     * Only display hierarchy templates, rather than items
     *
     * @access  public
     * @var     boolean
     */
    public $templates_only = false;


    /**
     * Load hierarchy specific information and make some
     * capability checks (which can be disabled)
     *
     * @see     totara_dialog_hierarchy::skip_access_checks
     *
     * @access  public
     * @param   $type           string  Hierarchy type
     * @param   $frameworkid    int     Framework id (optional)
     */
    public function __construct($type, $frameworkid = 0) {

        // Make some capability checks
        if (!$this->skip_access_checks) {
            require_login();
            require_capability("moodle/local:view{$type}", get_system_context());
        }

        // Load hierarchy instance
        $this->hierarchy = hierarchy::load_hierarchy($type);

        // Set lang file
        $this->lang_file = $type;

        // Load framework
        $this->set_framework($frameworkid);
    }


    /**
     * Set framework hierarchy
     *
     * @access  public
     * @param   $frameworkid    int
     */
    public function set_framework($frameworkid) {

        if (!$framework = $this->hierarchy->get_framework($frameworkid)) {
            error('frameworkdoesntexist', 'hierarchy', $frameworkid);
        }

        $this->framework = $framework;
    }


    /**
     * Load hierarchy items to display
     *
     * @access  public
     * @param   $parentid   int
     */
    public function load_items($parentid) {
        $this->items = $this->hierarchy->get_items_by_parent($parentid);

        // If we are loading non-root nodes, tell the dialog_content class not to
        // return markup for the whole dialog
        if ($parentid > 0) {
            $this->show_treeview_only = true;
        }

        // Also fill parents array
        $this->parent_items = $this->hierarchy->get_all_parents();
    }


    /**
     * Prepend custom markup before treeview
     *
     * @access  protected
     * @return  string
     */
    protected function _prepend_markup() {
        if ($this->disable_picker) {
            return '';
        }

        return $this->hierarchy->display_framework_selector('', true, true);
    }


    public function generate_search_interface() {
        global $CFG;

        // Setup variables for the search page
        $type = $this->hierarchy->prefix;
        $frameworkid = $this->framework->id;
        $select = !$this->disable_picker; # Only show select if picker isn't disabled
        $disabledlist = array();
        $templates = $this->templates_only;


        ob_start();
        require_once $CFG->dirroot.'/hierarchy/item/search.php';
        return ob_get_clean();
    }
}


/**
 * Class for generating multi select hierarchy dialog markup
 *
 * @access  public
 */
class totara_dialog_content_hierarchy_multi extends totara_dialog_content_hierarchy {

    /**
     * Load hierarchy specific information and make some
     * capability checks (which can be disabled)
     *
     * @see     totara_dialog_hierarchy::skip_access_checks
     *
     * @access  public
     * @param   $type           string  Hierarchy type
     * @param   $frameworkid    int     Framework id (optional)
     */
    public function __construct($type, $frameworkid = 0) {

        // Run parent constructor
        parent::__construct($type, $frameworkid);

        // Set to type multi
        $this->type = self::TYPE_CHOICE_MULTI;

        // Set titles
        $this->select_title = 'locate'.$type;
    }
}
