<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Code for ajax user selectors.
 *
 * @package   user
 * @copyright 1999 onwards Martin Dougiamas  http://dougiamas.com
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('USER_SELECTOR_DEFAULT_ROWS', 20);

abstract class user_selector_base {
    /** @var string The control name (and id) in the HTML. */
    protected $name;
    /** @var array Extra fields to search on and return in addition to firstname and lastname. */
    protected $extrafields;
    /** @var boolean Whether the conrol should allow selection of many users, or just one. */
    protected $multiselect = true;
    /** @var int The height this control should have, in rows. */
    protected $rows = USER_SELECTOR_DEFAULT_ROWS;
    /** @var array A list of userids that should not be returned by this control. */
    protected $exclude = array();
    /** @var array|null A list of the users who are selected. */
    protected $selected = null;
    /** @var boolean When the search changes, do we keep previously selected options that do
     * not match the new search term? */
    protected $preserveselected = false;
    /** @var boolean If only one user matches the search, should we select them automatically. */
    protected $autoselectunique = false;
    /** @var boolean When searching, do we only match the starts of fields (better performance)
     * or do we match occurrences anywhere? */
    protected $searchanywhere = false;
    /** @var mixed This is used by get selected users */
    protected $validatinguserids = null;

    /**  @var boolean Used to ensure we only output the search options for one user selector on
     * each page. */
    private static $searchoptionsoutput = false;

    /** @var array JavaScript YUI3 Module definition */
    protected static $jsmodule = array(
                'name' => 'user_selector',
                'fullpath' => '/user/selector/module.js',
                'requires'  => array('node', 'event-custom', 'datasource', 'json'),
                'strings' => array(
                    array('previouslyselectedusers', 'moodle', '%%SEARCHTERM%%'),
                    array('nomatchingusers', 'moodle', '%%SEARCHTERM%%'),
                    array('none', 'moodle')
                ));


    // Public API ==============================================================

    /**
     * Constructor. Each subclass must have a constructor with this signature.
     *
     * @param string $name the control name/id for use in the HTML.
     * @param array $options other options needed to construct this selector.
     * You must be able to clone a userselector by doing new get_class($us)($us->get_name(), $us->get_options());
     */
    public function __construct($name, $options = array()) {
        global $CFG, $PAGE;

        // Initialise member variables from constructor arguments.
        $this->name = $name;
        if (isset($options['extrafields'])) {
            $this->extrafields = $options['extrafields'];
        } else if (!empty($CFG->extrauserselectorfields)) {
            $this->extrafields = explode(',', $CFG->extrauserselectorfields);
        } else {
            $this->extrafields = array();
        }
        if (isset($options['exclude']) && is_array($options['exclude'])) {
            $this->exclude = $options['exclude'];
        }
        if (isset($options['multiselect'])) {
            $this->multiselect = $options['multiselect'];
        }

        // Read the user prefs / optional_params that we use.
        $this->preserveselected = $this->initialise_option('userselector_preserveselected', $this->preserveselected);
        $this->autoselectunique = $this->initialise_option('userselector_autoselectunique', $this->autoselectunique);
        $this->searchanywhere = $this->initialise_option('userselector_searchanywhere', $this->searchanywhere);
    }

    /**
     * All to the list of user ids that this control will not select. For example,
     * on the role assign page, we do not list the users who already have the role
     * in question.
     *
     * @param array $arrayofuserids the user ids to exclude.
     */
    public function exclude($arrayofuserids) {
        $this->exclude = array_unique(array_merge($this->exclude, $arrayofuserids));
    }

    /**
     * Clear the list of excluded user ids.
     */
    public function clear_exclusions() {
        $exclude = array();
    }

    /**
     * @return array the list of user ids that this control will not select.
     */
    public function get_exclusions() {
        return clone($this->exclude);
    }

    /**
     * @return array of user objects. The users that were selected. This is a more sophisticated version
     * of optional_param($this->name, array(), PARAM_INTEGER) that validates the
     * returned list of ids against the rules for this user selector.
     */
    public function get_selected_users() {
        // Do a lazy load.
        if (is_null($this->selected)) {
            $this->selected = $this->load_selected_users();
        }
        return $this->selected;
    }

    /**
     * Convenience method for when multiselect is false (throws an exception if not).
     * @return object the selected user object, or null if none.
     */
    public function get_selected_user() {
        if ($this->multiselect) {
            throw new moodle_exception('cannotcallusgetselecteduser');
        }
        $users = $this->get_selected_users();
        if (count($users) == 1) {
            return reset($users);
        } else if (count($users) == 0) {
            return null;
        } else {
            throw new moodle_exception('userselectortoomany');
        }
    }

    /**
     * If you update the database in such a way that it is likely to change the
     * list of users that this component is allowed to select from, then you
     * must call this method. For example, on the role assign page, after you have
     * assigned some roles to some users, you should call this.
     */
    public function invalidate_selected_users() {
        $this->selected = null;
    }

    /**
     * Output this user_selector as HTML.
     * @param boolean $return if true, return the HTML as a string instead of outputting it.
     * @return mixed if $return is true, returns the HTML as a string, otherwise returns nothing.
     */
    public function display($return = false) {
        global $PAGE;

        // Get the list of requested users.
        $search = optional_param($this->name . '_searchtext', '', PARAM_CLEAN);
        if (optional_param($this->name . '_clearbutton', false, PARAM_BOOL)) {
            $search = '';
        }
        $groupedusers = $this->find_users($search);

        // Output the select.
        $name = $this->name;
        $multiselect = '';
        if ($this->multiselect) {
            $name .= '[]';
            $multiselect = 'multiple="multiple" ';
        }
        $output = '<div class="userselector" id="' . $this->name . '_wrapper">' . "\n" .
                '<select name="' . $name . '" id="' . $this->name . '" ' .
                $multiselect . 'size="' . $this->rows . '">' . "\n";

        // Populate the select.
        $output .= $this->output_options($groupedusers, $search);

        // Output the search controls.
        $output .= "</select>\n<div>\n";
        $output .= '<input type="text" name="' . $this->name . '_searchtext" id="' .
                $this->name . '_searchtext" size="15" value="' . s($search) . '" />';
        $output .= '<input type="submit" name="' . $this->name . '_searchbutton" id="' .
                $this->name . '_searchbutton" value="' . $this->search_button_caption() . '" />';
        $output .= '<input type="submit" name="' . $this->name . '_clearbutton" id="' .
                $this->name . '_clearbutton" value="' . get_string('clear','local_cohort') . '" />';

        // And the search options.
        $optionsoutput = false;
        $output .= "</div>\n</div>\n\n";

        // Initialise the ajax functionality.
        $output .= $this->initialise_javascript($search);

        // Return or output it.
        if ($return) {
            return $output;
        } else {
            echo $output;
        }
    }

    /**
     * The height this control will be displayed, in rows.
     *
     * @param integer $numrows the desired height.
     */
    public function set_rows($numrows) {
        $this->rows = $numrows;
    }

    /**
     * @return integer the height this control will be displayed, in rows.
     */
    public function get_rows() {
        return $this->rows;
    }

    /**
     * Whether this control will allow selection of many, or just one user.
     *
     * @param boolean $multiselect true = allow multiple selection.
     */
    public function set_multiselect($multiselect) {
        $this->multiselect = $multiselect;
    }

    /**
     * @return boolean whether this control will allow selection of more than one user.
     */
    public function is_multiselect() {
        return $this->multiselect;
    }

    /**
     * @return string the id/name that this control will have in the HTML.
     */
    public function get_name() {
        return $this->name;
    }

    /**
     * Set the user fields that are displayed in the selector in addition to the
     * user's name.
     *
     * @param array $fields a list of field names that exist in the user table.
     */
    public function set_extra_fields($fields) {
        $this->extrafields = $fields;
    }

    // API for sublasses =======================================================

    /**
     * Search the database for users matching the $search string, and any other
     * conditions that apply. The SQL for testing whether a user matches the
     * search string should be obtained by calling the search_sql method.
     *
     * This method is used both when getting the list of choices to display to
     * the user, and also when validating a list of users that was selected.
     *
     * When preparing a list of users to choose from ($this->is_validating()
     * return false) you should probably have an maximum number of users you will
     * return, and if more users than this match your search, you should instead
     * return a message generated by the too_many_results() method. However, you
     * should not do this when validating.
     *
     * If you are writing a new user_selector subclass, I strongly recommend you
     * look at some of the subclasses later in this file and in admin/roles/lib.php.
     * They should help you see exactly what you have to do.
     *
     * @param string $search the search string.
     * @return array An array of arrays of users. The array keys of the outer
     *      array should be the string names of optgroups. The keys of the inner
     *      arrays should be userids, and the values should be user objects
     *      containing at least the list of fields returned by the method
     *      required_fields_sql(). If a user object has a ->disabled property
     *      that is true, then that option will be displayed greyed out, and
     *      will not be returned by get_selected_users.
     */
    public abstract function find_users($search);

    /**
     *
     * Note: this function must be implemented if you use the search ajax field
     *       (e.g. set $options['file'] = '/admin/filecontainingyourclass.php';)
     * @return array the options needed to recreate this user_selector.
     */
    protected function get_options() {
        return array(
            'class' => get_class($this),
            'name' => $this->name,
            'exclude' => $this->exclude,
            'extrafields' => $this->extrafields,
            'multiselect' => $this->multiselect
        );
    }

    // Inner workings ==========================================================

    /**
     * @return boolean if true, we are validating a list of selected users,
     *      rather than preparing a list of uesrs to choose from.
     */
    protected function is_validating() {
        return !is_null($this->validatinguserids);
    }

    /**
     * Get the list of users that were selected by doing optional_param then
     * validating the result.
     *
     * @return array of user objects.
     */
    protected function load_selected_users() {
        // See if we got anything.
        $userids = optional_param($this->name, array(), PARAM_INTEGER);
        if (empty($userids)) {
            return array();
        }
        if (!$this->multiselect) {
            $userids = array($userids);
        }

        // If we did, use the find_users method to validate the ids.
        $this->validatinguserids = $userids;
        $groupedusers = $this->find_users('');
        $this->validatinguserids = null;

        // Aggregate the resulting list back into a single one.
        $users = array();
        foreach ($groupedusers as $group) {
            foreach ($group as $user) {
                if (!isset($users[$user->id]) && empty($user->disabled) && in_array($user->id, $userids)) {
                    $users[$user->id] = $user;
                }
            }
        }

        // If we are only supposed to be selecting a single user, make sure we do.
        if (!$this->multiselect && count($users) > 1) {
            $users = array_slice($users, 0, 1);
        }

        return $users;
    }

    /**
     * @param string $u the table alias for the user table in the query being
     *      built. May be ''.
     * @return string fragment of SQL to go in the select list of the query.
     */
    protected function required_fields_sql($u) {
        // Raw list of fields.
        $fields = array('id', 'firstname', 'lastname');
        $fields = array_merge($fields, $this->extrafields);

        // Prepend the table alias.
        if ($u) {
            foreach ($fields as &$field) {
                $field = $u . '.' . $field;
            }
        }
        return implode(',', $fields);
    }

    /**
     * @param string $search the text to search for.
     * @param string $u the table alias for the user table in the query being
     *      built. May be ''.
     * @return array an array with two elements, a fragment of SQL to go in the
     *      where clause the query, and an array containing any required parameters.
     *      this uses ? style placeholders.
     */
    protected function search_sql($search, $u) {
        global $CFG;
        $params = array();
        $tests = array();

        if ($u) {
            $u .= '.';
        }

        // If we have a $search string, put a field LIKE '$search%' condition on each field.
        if ($search) {
            $conditions = array(
		$conditions[] = $u . 'firstname',
                $conditions[] = $u . 'lastname'
            );
            foreach ($this->extrafields as $field) {
                $conditions[] = $u . $field;
            }
            if ($this->searchanywhere) {
                $searchparam = '%' . $search . '%';
            } else {
                $searchparam = $search . '%';
            }
            $i = 0;
            foreach ($conditions as $key=>$condition) {
		$conditions[$key] = $condition . ' ' . sql_ilike() . " '$searchparam'";
                $params["con{$i}00"] = $searchparam;
                $i++;
            }
            $tests[] = '(' . implode(' OR ', $conditions) . ')';
        }

        // Add some additional sensible conditions
        $tests[] = $u . "id <> 1";
        $tests[] = $u . 'deleted = 0';
        $tests[] = $u . 'confirmed = 1';

        // If we are being asked to exclude any users, do that.
        if (!empty($this->exclude)) {
            list($usertest, $userparams) = get_in_or_equal($this->exclude, 'ex000', false);
            $tests[] = $u . 'id ' . $usertest;
            $params = array_merge($params, $userparams);
        }

        // If we are validating a set list of userids, add an id IN (...) test.
        if (!empty($this->validatinguserids)) {
            list($usertest, $userparams) = get_in_or_equal($this->validatinguserids, 'val000');
            $tests[] = $u . 'id ' . $usertest;
            $params = array_merge($params, $userparams);
        }

        if (empty($tests)) {
            $tests[] = '1 = 1';
        }

        // Combing the conditions and return.
        return array(implode(' AND ', $tests), $params);
    }

    /**
     * Used to generate a nice message when there are too many users to show.
     * The message includes the number of users that currently match, and the
     * text of the message depends on whether the search term is non-blank.
     *
     * @param string $search the search term, as passed in to the find users method.
     * @param int $count the number of users that currently match.
     * @return array in the right format to return from the find_users method.
     */
    protected function too_many_results($search, $count) {
        if ($search) {
            $a = new stdClass;
            $a->count = $count;
            $a->search = $search;
            return array(get_string('toomanyusersmatchsearch', 'local_cohort', $a) => array(),
                    get_string('pleasesearchmore', 'local_cohort') => array());
        } else {
            return array(get_string('toomanyuserstoshow', 'local_cohort', $count) => array(),
                    get_string('pleaseusesearch', 'local_cohort') => array());
        }
    }

    /**
     * Output the list of <optgroup>s and <options>s that go inside the select.
     * This method should do the same as the JavaScript method
     * user_selector.prototype.handle_response.
     *
     * @param array $groupedusers an array, as returned by find_users.
     * @return string HTML code.
     */
    protected function output_options($groupedusers, $search) {
        $output = '';

        // Ensure that the list of previously selected users is up to date.
        $this->get_selected_users();

        // If $groupedusers is empty, make a 'no matching users' group. If there is
        // only one selected user, set a flag to select them if that option is turned on.
        $select = false;
        if (empty($groupedusers)) {
            if (!empty($search)) {
                $groupedusers = array(get_string('nomatchingusers', '', $search) => array());
            } else {
                $groupedusers = array(get_string('none') => array());
            }
        } else if ($this->autoselectunique && count($groupedusers) == 1 &&
                count(reset($groupedusers)) == 1) {
            $select = true;
            if (!$this->multiselect) {
                $this->selected = array();
            }
        }

        // Output each optgroup.
        foreach ($groupedusers as $groupname => $users) {
            $output .= $this->output_optgroup($groupname, $users, $select);
        }

        // If there were previously selected users who do not match the search, show them too.
        if ($this->preserveselected && !empty($this->selected)) {
            $output .= $this->output_optgroup(get_string('previouslyselectedusers', '', $search), $this->selected, true);
        }

        // This method trashes $this->selected, so clear the cache so it is
        // rebuilt before anyone tried to use it again.
        $this->selected = null;

        return $output;
    }

    /**
     * Output one particular optgroup. Used by the preceding function output_options.
     *
     * @param string $groupname the label for this optgroup.
     * @param array $users the users to put in this optgroup.
     * @param boolean $select if true, select the users in this group.
     * @return string HTML code.
     */
    protected function output_optgroup($groupname, $users, $select) {
        if (!empty($users)) {
            $output = '  <optgroup label="' . htmlspecialchars($groupname) . ' (' . count($users) . ')">' . "\n";
            foreach ($users as $user) {
                $attributes = '';
                if (!empty($user->disabled)) {
                    $attributes .= ' disabled="disabled"';
                } else if ($select || isset($this->selected[$user->id])) {
                    $attributes .= ' selected="selected"';
                }
                unset($this->selected[$user->id]);
                $output .= '    <option' . $attributes . ' value="' . $user->id . '">' .
                        $this->output_user($user) . "</option>\n";
            }
        } else {
            $output = '  <optgroup label="' . htmlspecialchars($groupname) . '">' . "\n";
            $output .= '    <option disabled="disabled">&nbsp;</option>' . "\n";
        }
        $output .= "  </optgroup>\n";
        return $output;
    }

    /**
     * Convert a user object to a string suitable for displaying as an option in the list box.
     *
     * @param object $user the user to display.
     * @return string a string representation of the user.
     */
    public function output_user($user) {
        $bits = array(
            fullname($user)
        );
        foreach ($this->extrafields as $field) {
            $bits[] = $user->$field;
        }
        return implode(', ', $bits);
    }

    /**
     * @return string the caption for the search button.
     */
    protected function search_button_caption() {
        return get_string('search');
    }

    // Initialise one of the option checkboxes, either from
    // the request, or failing that from the user_preferences table, or
    // finally from the given default.
    private function initialise_option($name, $default) {
        $param = optional_param($name, null, PARAM_BOOL);
        if (is_null($param)) {
            return get_user_preferences($name, $default);
        } else {
            set_user_preference($name, $param);
            return $param;
        }
    }

    // Output one of the options checkboxes.
    private function option_checkbox($name, $on, $label) {
        if ($on) {
            $checked = ' checked="checked"';
        } else {
            $checked = '';
        }
        $name = 'userselector_' . $name;
        $output = '<p><input type="hidden" name="' . $name . '" value="0" />' .
                // For the benefit of brain-dead IE, the id must be different from the name of the hidden form field above.
                // It seems that document.getElementById('frog') in IE will return and element with name="frog".
                '<input type="checkbox" id="' . $name . 'id" name="' . $name . '" value="1"' . $checked . ' /> ' .
                '<label for="' . $name . 'id">' . $label . "</label></p>\n";
        user_preference_allow_ajax_update($name, PARAM_BOOL);
        return $output;
    }

    /**
     * @param boolean $optiontracker if true, initialise JavaScript for updating the user prefs.
     * @return any HTML needed here.
     */
    protected function initialise_javascript($search) {
        global $USER, $PAGE, $OUTPUT;
        $output = '';

        // Put the options into the session, to allow search.php to respond to the ajax requests.
        $options = $this->get_options();
        $hash = md5(serialize($options));
        $USER->userselectors[$hash] = $options;

        // Initialise the selector.
        return $output;
    }
}

/**
 * Cohort assignment candidates
 */
class cohort_candidate_selector extends user_selector_base {
    protected $cohortid;

    public function __construct($name, $options) {
        $this->cohortid = $options['cohortid'];
        parent::__construct($name, $options);
    }

    /**
     * Candidate users
     * @param <type> $search
     * @return array
     */
    public function find_users($search) {
        global $CFG;
        //by default wherecondition retrieves all users except the deleted, not confirmed and guest
        list($wherecondition, $params) = $this->search_sql($search, 'u');
        $params['cohortid'] = $this->cohortid;

        $fields      = 'SELECT ' . $this->required_fields_sql('u');
        $countfields = 'SELECT COUNT(1)';

        $sql = " FROM {$CFG->prefix}user u
            LEFT JOIN {$CFG->prefix}cohort_members cm ON (cm.userid = u.id AND cm.cohortid = $this->cohortid)
                WHERE cm.id IS NULL AND $wherecondition";

        $order = ' ORDER BY u.lastname ASC, u.firstname ASC';

        if (!$this->is_validating()) {
            $potentialmemberscount = count_records_sql($countfields . $sql);
            if ($potentialmemberscount > 100) {
                return $this->too_many_results($search, $potentialmemberscount);
            }
        }

        $availableusers = get_records_sql($fields . $sql . $order);

        if (empty($availableusers)) {
            return array();
        }


        if ($search) {
            $groupname = get_string('potusersmatching', 'local_cohort', $search);
        } else {
            $groupname = get_string('potusers', 'local_cohort');
        }

        return array($groupname => $availableusers);
    }

    protected function get_options() {
        $options = parent::get_options();
        $options['cohortid'] = $this->cohortid;
        $options['file'] = 'cohort/lib.php';
        return $options;
    }
}

/**
 * Cohort assignment candidates
 */
class cohort_existing_selector extends user_selector_base {
    protected $cohortid;

    public function __construct($name, $options) {
        $this->cohortid = $options['cohortid'];
        parent::__construct($name, $options);
    }

    /**
     * Candidate users
     * @param <type> $search
     * @return array
     */
    public function find_users($search) {
        global $CFG;
        //by default wherecondition retrieves all users except the deleted, not confirmed and guest
        list($wherecondition, $params) = $this->search_sql($search, 'u');
        $params['cohortid'] = $this->cohortid;

        $fields      = 'SELECT ' . $this->required_fields_sql('u');
        $countfields = 'SELECT COUNT(1)';

        $sql = " FROM {$CFG->prefix}user u
                 JOIN {$CFG->prefix}cohort_members cm ON (cm.userid = u.id AND cm.cohortid = {$this->cohortid})
                WHERE $wherecondition";

        $order = ' ORDER BY u.lastname ASC, u.firstname ASC';

        if (!$this->is_validating()) {
            $potentialmemberscount = count_records_sql($countfields . $sql);
            if ($potentialmemberscount > 100) {
                return $this->too_many_results($search, $potentialmemberscount);
            }
        }

        $availableusers = get_records_sql($fields . $sql . $order);

        if (empty($availableusers)) {
            return array();
        }


        if ($search) {
            $groupname = get_string('currentusersmatching', 'local_cohort', $search);
        } else {
            $groupname = get_string('currentusers', 'local_cohort');
        }

        return array($groupname => $availableusers);
    }

    protected function get_options() {
        $options = parent::get_options();
        $options['cohortid'] = $this->cohortid;
        $options['file'] = 'cohort/lib.php';
        return $options;
    }
}

/**
 * Constructs IN() or = sql fragment
 * @param mixed $items single or array of values
 * @param int $type bound param type SQL_PARAMS_QM or SQL_PARAMS_NAMED
 * @param string named param placeholder start
 * @param bool true means equal, false not equal
 * @return array - $sql and $params
 */
function get_in_or_equal($items, $start='param0000', $equal=true) {
    if (is_array($items) and empty($items)) {
        error('Items was an array and empty');
    }

    if (!is_array($items)){
        $sql = $equal ? "= $items" : "<> $items";
        $params = array($start=>$items);
    } else if (count($items) == 1) {
        $sql = $equal ? "= $items[0]" : "<> $items[0]";
        $item = reset($items);
        $params = array($start=>$item);
    } else {
        $params = array();
        $sql = array();
        foreach ($items as $item) {
            $params[$start] = $item;
            $sql[] = ''.$item++;
        }
        if ($equal) {
            $sql = 'IN ('.implode(',', $sql).')';
        } else {
            $sql = 'NOT IN ('.implode(',', $sql).')';
        }
    }

    return array($sql, $params);
}
