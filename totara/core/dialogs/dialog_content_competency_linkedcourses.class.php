<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Alastair Munro <alastair.munro@totaralms.com>
 * @package totara
 * @subpackage dialogs
 */

/**
 * Hierarchy dialog generator
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/local/dialogs/dialog_content.class.php');
require_once($CFG->dirroot.'/hierarchy/lib.php');

/**
 * Class for generating single select hierarchy dialog markup
 *
 * @access  public
 */
class totara_dialog_content_competency_linkedcourses extends totara_dialog_content {

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
     * the internal checks by setting this to true
     *
     * @access  public
     * @var     boolean
     */
    public $skip_access_checks = false;

    /**
     * Only display competency templates, rather than items
     *
     * @access  public
     * @var     boolean
     */
    public $templates_only = false;

    /**
     * Enable search tab content
     *
     * @access  public
     * @var     bool
     */
    public $search_code = true;

    /**
     * Lang string to display when no items available
     *
     * @access  public
     * @var     string
     */
    public $string_nothingtodisplay = 'error:dialognolinkedcourseitems';

    /**
     * Show hidden frameworks
     *
     * @access public
     * @var    boolean
     */
    public $showhidden = false;


    /**
     * Load hierarchy specific information and make some
     * capability checks (which can be disabled)
     *
     * @see     totara_dialog_content_competency_linkedcourses::skip_access_checks
     *
     * @access  public
     * @param   $frameworkid    int     Framework id (optional)
     * @param   $showhidden     boolean When listing frameworks, include hidden frameworks (optional)
     */
    public function __construct($frameworkid = 0, $showhidden = false) {

        $prefix = 'competency';

        // Make some capability checks
        if (!$this->skip_access_checks) {
            require_login();
            require_capability("moodle/local:view{$prefix}", get_system_context());
        }

        // Load hierarchy instance
        $this->hierarchy = hierarchy::load_hierarchy($prefix);

        // Should the dialog display hidden frameworks?
        $this->showhidden = $showhidden;

        // Set lang file
        $this->lang_file = $prefix;

        // Load framework
        $this->set_framework($frameworkid);

        // Check if switching frameworks
        $this->switch_frameworks = optional_param('switchframework', false, PARAM_BOOL);
    }


    /**
     * Set framework hierarchy
     *
     * @access  public
     * @param   $frameworkid    int
     */
    public function set_framework($frameworkid) {
        $this->framework = $this->hierarchy->get_framework($frameworkid, $this->showhidden);
    }


    /**
     * Load competencies items to display that have linked courses
     *
     * @access  public
     * @param   $parentid   int
     */
    public function load_items($parentid) {
        global $CFG;

        $select = "SELECT
                    c.id as id,
                    c.fullname as fullname";

        $from = " FROM {$CFG->prefix}comp c";

        if ($this->showhidden) {
            $where = " WHERE c.evidencecount > 0";
        } else {
            $where = " WHERE c.evidencecount > 0 AND c.visible=1";
        }

        $order = " ORDER BY c.fullname";

        $this->items = get_records_sql($select.$from.$where.$order);
    }


    /**
     * Generate search interface for hierarchy search
     *
     * @access  public
     * @return  string
     */
    public function generate_search_interface() {
        global $CFG;

        // Setup variables for the search page
        $frameworkid = $this->framework->id;
        $select = !$this->disable_picker; # Only show select if picker isn't disabled
        $disabledlist = array_flip(array_keys($this->disabled_items)); # Return an array without values
        $templates = $this->templates_only;
        $showhidden = $this->showhidden;

        // Grab search page markup
        ob_start();
        require_once $CFG->dirroot.'/hierarchy/prefix/competency/item/search_linkedcourses.php';
        return ob_get_clean();
    }
}
