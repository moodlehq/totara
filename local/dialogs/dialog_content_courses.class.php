<?php

/**
 * Course/category dialog generator
 *
 * @copyright Totara Learning Solutions Limited
 * @author Aaron Barnes <aaronb@catalyst.net.nz>
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage dialogs
 */
require_once($CFG->dirroot.'/local/dialogs/dialog_content.class.php');
require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->libdir.'/datalib.php');


/**
 * Class for generating single select course dialog markup
 *
 * @access  public
 */
class totara_dialog_content_courses extends totara_dialog_content {

    /**
     * Current category (e.g., show children of this category)
     *
     * @access  public
     * @var     integer
     */
    public $categoryid;


    /**
     * Categories at this level (indexed by category ID)
     *
     * @access  public
     * @var     array
     */
    public $categories = array();


    /**
     * Courses at this level
     *
     * @access  public
     * @var     array
     */
    public $courses = array();



    /**
     * Set current category
     *
     * @see     totara_dialog_hierarchy::categoryid
     *
     * @access  public
     * @param   $categoryid     int     Category id
     */
    public function __construct($categoryid) {

        $this->categoryid = $categoryid;

        // If category ID doesn't equal 0, must be only loading the tree
        if ($this->categoryid > 0) {
            $this->show_treeview_only = true;
        }

        // Load child categories
        $this->load_categories();

        // Load child courses
        $this->load_courses();
    }


    /**
     * Load categories to display
     *
     * @access  public
     */
    public function load_categories() {

        // If category 0, make fake object
        if (!$this->categoryid) {
            $parent = new object();
            $parent->id = 0;
        }
        else {
            // Load category
            if (!$parent = get_record('course_categories', 'id', $this->categoryid)) {
                error('Category ID was incorrect');
            }
        }

        // Load child categories
        $categories = get_child_categories($parent->id);

        // Fix array to be indexed by prefixed id's (so it doesn't conflict with course id's)
        foreach ($categories as $category) {
            $c = new object();
            $c->id = 'cat'.$category->id;
            $c->fullname = $category->name;

            $this->categories[$c->id] = $c;
        }

        // Also fill parents array
        $this->parent_items = $this->categories;
    }


    /**
     * Load courses to display
     *
     * @access  public
     */
    public function load_courses() {
        if ($this->categoryid) {
            $this->courses = get_courses($this->categoryid, "fullname ASC", 'c.id,c.fullname,c.sortorder');
        }
    }


    /**
     * Generate markup, but first merge categories and courses together
     *
     * @access  public
     * @return  string
     */
    public function generate_markup() {

        // Merge categories and courses (courses to follow categories)
        $this->items = array_merge($this->categories, $this->courses);

        return parent::generate_markup();
    }
}
