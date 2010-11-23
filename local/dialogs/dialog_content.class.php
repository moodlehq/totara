<?php

/**
 * Dialog content generator
 *
 * @copyright Totara Learning Solutions Limited
 * @author Aaron Barnes <aaronb@catalyst.net.nz>
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage dialogs
 */


/**
 * Class for generating markup
 *
 * @access  public
 */
class totara_dialog_content {

    /**
     * Configuration constants
     */
    const TYPE_CHOICE_SINGLE    = 1;
    const TYPE_CHOICE_MULTI     = 2;



    /**
     * Configuration parameters
     */

    /**
     * Dialog overall type
     *
     * @access  public
     * @var     class constant
     */
    public $type = self::TYPE_CHOICE_SINGLE;


    /**
     * Language file to use for messages
     *
     * @access  public
     * @var     string
     */
    public $lang_file = 'dialog';


    /**
     * PHP file to use for search tab content
     *
     * @access  public
     * @var     string
     */
    public $search_code = '';


    /**
     * Lang string to display when no items available
     *
     * @access  public
     * @var     string
     */
    public $string_nothingtodisplay = 'error:dialognotreeitems';

    /**
     * Select pane title lang string
     *
     * Set to an empty string if you do not want it to be printed
     *
     * @access  public
     * @var     string
     */
    public $select_title = '';


    /**
     * Selected pane title lang string
     *
     * Set to an empty string if you do not want it to be printed
     *
     * @access  public
     * @var     string
     */
    public $selected_title = '';


    /**
     * Selected pane html id
     *
     * @access  public
     * @var     string
     */
    public $selected_id = '';


    /**
     * Return markup for only the treeview, rather than the whole dialog
     *
     * @access  public
     * @var     boolean
     */
    public $show_treeview_only = false;


    /**
     * Items to display in the treeview
     *
     * @access  public
     * @var     array
     */
    public $items = array();


    /**
     * Array of items that are parents (e.g. have children)
     *
     * Used for rendering the treeview
     *
     * @access  public
     * @var     array
     */
    public $parent_items = array();


    /**
     * Array of items that are disabled (e.g. unselectable)
     *
     * Used for rendering the treeview
     *
     * @access  public
     * @var     array
     */
    public $disabled_items = array();


    /**
     * Array of items that are already selected (e.g. appear in the selected pane)
     *
     * If set to null, use $disabled_items instead
     *
     * Used for rendering the treeview
     *
     * @access  public
     * @var     array
     */
    public $selected_items = null;



    /**
     * Generate markup from configuration and return
     *
     * @access  public
     * @return  string  $markup Markup to print
     */
    public function generate_markup() {

        // Skip container if only displaying treeview
        if ($this->show_treeview_only) {
            return $this->generate_treeview();
        }

        $markup = '<table class="dialog-content"><tbody><tr>';

        // Open select container
        $markup .= '<td class="select">';
        $markup .= '<div class="header">';

        // Show select header
        if (!empty($this->select_title)) {
            $markup .= '<p>'.get_string($this->select_title, $this->lang_file).'</p>';
        }

        $markup .= '</div>';

        $markup .= '<div id="dialog-tabs" class="dialog-content-select">';

        $markup .= '<ul class="tabs dialog-nobind">';
        $markup .= '  <li><a href="#browse-tab">'.get_string('browse', 'dialog').'</a></li>';
        $markup .= '  <li><a href="#search-tab">'.get_string('search', 'dialog').'</a></li>';
        $markup .= '</ul>';

        // Display treeview
        $markup .= '<div id="browse-tab">';

        // Display any custom markup
        if (method_exists($this, '_prepend_markup')) {
            $markup .= $this->_prepend_markup();
        }

        $markup .= $this->generate_treeview();
        $markup .= '</div>';

        // Display searchview
        $markup .= '<div id="search-tab" class="dialog-load-within">';
        $markup .= $this->generate_search_interface();
        $markup .= '<div id="search-results"></div>';
        $markup .= '</div>';

        // Close select container
        $markup .= '</div></td>';

        // If multi-select, show selected pane
        if ($this->type === self::TYPE_CHOICE_MULTI) {

            $id = strlen($this->selected_id) ? 'id="'.$this->selected_id.'"' : '';
            $markup .= '<td class="selected" '.$id.'>';

            // Show title
            if (!empty($this->selected_title)) {
                $markup .= '<p>';
                $markup .= get_string($this->selected_title, $this->lang_file);
                $markup .= '</p>';
            }

            // Populate pane
            if ($this->selected_items === null) {
                $this->selected_items = $this->disabled_items;
            }

            $markup .= populate_selected_items_pane($this->selected_items);

            $markup .= '</td>';
        }

        // Close container for content
        $markup .= '</tr></tbody></table>';

        return $markup;
    }


    /**
     * Generate treeview markup
     *
     * @access  public
     * @return  string  $html Markup for treeview
     */
    public function generate_treeview() {
        global $CFG;

        // Maximum number of items to load (at any one level)
        // before giving up and suggesting search instead
        $maxitems = 100;

        $html = '';

        $html .= !$this->show_treeview_only ? '<ul class="treeview filetree picker">' : '';

        if (is_array($this->items) && !empty($this->items)) {

            $total = count($this->items);
            $count = 0;

            if ($total > $maxitems) {
                $html .= '<li class="last"><span class="empty dialog-nobind">';
                $html .= 'There are more than ' . $maxitems . ' items at this level. Try <a href="#search-tab" onclick="$(\'#dialog-tabs\').tabs(\'select\', 1);return false;">searching</a> instead.';
                $html .= '</span></li>'.PHP_EOL;
                return $html;
            }

            // Loop through elements
            foreach ($this->items as $element) {
                ++$count;

                // Initialise class vars
                $li_class = '';
                $div_class = '';
                $span_class = '';

                // If last element
                if ($count == $total) {
                    $li_class .= ' last';
                }

                // If element has children
                if (array_key_exists($element->id, $this->parent_items)) {
                    $li_class .= ' expandable';
                    $div_class .= ' hitarea expandable-hitarea';
                    $span_class .= ' folder';

                    if ($count == $total) {
                        $li_class .= ' lastExpandable';
                        $div_class .= ' lastExpandable-hitarea';
                    }
                }

                // Make disabled elements non-draggable and greyed out
#                if (array_key_exists($element->id, $this->disabled_items)){
#                    $span_class .= ' unclickable';
#                } else {
                    $span_class .= ' clickable';
#                }

                $html .= '<li class="'.trim($li_class).'" id="item_list_'.$element->id.'">';
                $html .= '<div class="'.trim($div_class).'"></div>';
                $html .= '<span id="item_'.$element->id.'" class="'.trim($span_class).'">';

                // Grab item display name
                if (isset($element->fullname)) {
                    $displayname = $element->fullname;
                } elseif (isset($element->name)) {
                    $displayname = $element->name;
                } else {
                    $displayname = '';
                }

                $html .= '<a href="#">';
                $html .= htmlentities($displayname);
                $html .= '</a>';
                $html .= '<span class="deletebutton">delete</span>';

                $html .= '</span>';

                if ($div_class !== '') {
                    $html .= '<ul style="display: none;"></ul>';
                }
                $html .= '</li>'.PHP_EOL;
            }
        }
        else {
            $html .= '<li class="last"><span class="empty">';
            $html .= get_string($this->string_nothingtodisplay, $this->lang_file);
            $html .= '</span></li>'.PHP_EOL;
        }

        $html .= !$this->show_treeview_only ? '</ul>' : '';
        return $html;
    }


    /**
     * Default search interface, simply includes a url
     *
     * @access  public
     * @return  string  Markup
     */
    public function generate_search_interface() {
        global $CFG;

        if (empty($this->search_code)) {
            return '';
        }

        ob_start();
        require_once $CFG->dirroot.$this->search_code;
        return ob_get_clean();
    }
}


/**
 * Return markup for a simple picker in a dialog
 *
 * @param   $options    array   options/values
 * @param   $selected   mixed   $options key for currently selected element
 * @param   $class      string  select element's class
 * @return  $html
 */
function display_dialog_selector($options, $selected, $class) {

    $html = '<select class="'.$class.'">';

    foreach ($options as $key => $value) {
        $html .= '<option value="'.$key.'"';

        if ($key == $selected) {
            $html .= ' selected="selected"';
        }

        $html .= '>'.htmlentities($value).'</option>';
    }

    $html .= '</select>';

    return $html;
}


/**
 * Returns markup to be used in the 'Selected Items' pane of a multi-select dialog
 *
 * @param   $elements    array elements to be created in the pane
 * @return  $html
 */
function populate_selected_items_pane($elements, $prefix='item') {

    global $CFG;

    $html = '';

    foreach ($elements as $element) {
        $html .= '<div><span id="'.$prefix.'_'.$element->id.'">';
        $html .= '<a href="#">';
        $html .= htmlentities($element->fullname);
        $html .= '</a>';
        $html .= '<span class="deletebutton">delete</span>';
        $html .= '</span></div>';
    }

    return $html;
}
