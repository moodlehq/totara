<?php

class reportheading {
    public $items;
    public $columnoptions;
    private $userid;

    /*
     * Create a new reportheading object
     *
     * Create the object by looking up any existing items and producing a list of
     * possible column options.
     *
     * @param integer $userid User ID of the user the report heading should be about,
     *                        or null for current user
     * @return object Report Heading object
     */
    function reportheading($userid=null) {
        global $USER;
        if ($items = get_records('report_heading_items','','','sortorder')) {
            $this->items = $items;
        } else {
            // currently no fields - add first and last name as default fields
            if($this->set_default_fields()) {
                $this->items = get_records('report_heading_items','','','sortorder');
            } else {
                error('error:couldnotcreatedefaultfields','local');
            }
        }
        $this->columnoptions = $this->get_column_options();
        $this->userid = isset($userid) ? $userid : $USER->id;
    }

    function set_default_fields() {
        $todb = new object;
        $todb->type = 'user-firstname';
        $todb->heading = 'First Name';
        $todb->defaultvalue = 'Not Found';
        $todb->sortorder = 1;
        $todb2 = new object();
        $todb2->type = 'user-lastname';
        $todb2->heading = 'Last Name';
        $todb2->defaultvalue = 'Not Found';
        $todb2->sortorder = 2;
        if(insert_record('report_heading_items', $todb) &&
           insert_record('report_heading_items', $todb2)) {
            return true;
        } else {
            return false;
        }
    }
    /*
     * Return an array of possible heading options
     *
     * Options that may change such as custom fields are calculated by
     * this function.
     *
     * Key contains a string to uniquely identify the field in question,
     * value contains a text string describing the field
     *
     * @return array Array of heading options
     */
    function get_column_options() {
        $headingoptions = array();

        // available user fields
        $userfields = array(
            'fullname',  // special option handled by get_user_field()
            'firstname','lastname','username','idnumber',
            'email','url',
            'icq','skype','yahoo','aim','msn','phone1','phone2',
            'institution','department','address','city','country',
        );

        // assign user fields
        foreach($userfields as $field) {
            $headingoptions['user-' . $field] = ucfirst($field);
        }

        // dynamically assign user profile fields
        if($customfields = get_records('user_info_field','visible', 1, 'sortorder')) {
            foreach($customfields as $customfield) {
                $headingoptions['profile-' . $customfield->shortname] = $customfield->name;
            }
        }

        // assign user's manager fields
        foreach($userfields as $field) {
            $headingoptions['manager-' . $field] = get_string('managers','local') . ucfirst($field);
        }

        // dynamically assign org and pos depths
        if($posdepths = get_records('pos_depth')) {
            foreach($posdepths as $posdepth) {
                $headingoptions['pos-' . $posdepth->shortname] = get_string('positionsarrow','local') . $posdepth->fullname;
            }
        }
        if($orgdepths = get_records('org_depth')) {
            foreach($orgdepths as $orgdepth) {
                $headingoptions['org-' . $orgdepth->shortname] = get_string('organisationsarrow','local') . $orgdepth->fullname;
            }
        }

        return $headingoptions;
    }

    /*
     * Given a column id, removes that column from the report heading table
     *
     * @param integer $cid ID of the column to be removed
     * @return boolean True on success, false otherwise
     */
    function delete_column($cid) {
        begin_sql();
        $sortorder = get_field('report_heading_items','sortorder', 'id', $cid);
        if(!$sortorder) {
            rollback_sql();
            return false;
        }
        if(!delete_records('report_heading_items','id',$cid)) {
            rollback_sql();
            return false;
        }

        if($allcolumns = get_records('report_heading_items')) {
            foreach($allcolumns as $column) {
                if($column->sortorder > $sortorder) {
                    $todb = new object();
                    $todb->id = $column->id;
                    $todb->sortorder = $column->sortorder - 1;
                    if(!update_record('report_heading_items', $todb)) {
                        rollback_sql();
                        return false;
                    }
                }
            }
        }
        commit_sql();
        $this->items = get_records('report_heading_items','','','sortorder');
        return true;

    }

    /*
     * Given a column id and a direction, moves a column up or down
     *
     * @param integer $cid ID of the column to be moved
     * @param string $updown String 'up' or 'down'
     * @return boolean True on success, false otherwise
     */
    function move_column($cid, $updown) {
        begin_sql();

        // assumes sort order is well behaved (no gaps)
        if(!$itemsort = get_field('report_heading_items', 'sortorder', 'id', $cid)) {
            rollback_sql();
            return false;
        }
        if($updown == 'up') {
            $newsort = $itemsort - 1;
        } else if ($updown == 'down') {
            $newsort = $itemsort + 1;
        } else {
            // invalid updown string
            rollback_sql();
            return false;
        }
        if($neighbour = get_record('report_heading_items', 'sortorder', $newsort)) {
            // swap sort orders
            $todb = new object();
            $todb->id = $cid;
            $todb->sortorder = $neighbour->sortorder;
            $todb2 = new object();
            $todb2->id = $neighbour->id;
            $todb2->sortorder = $itemsort;
            if(!update_record('report_heading_items', $todb) ||
               !update_record('report_heading_items', $todb2)) {
                rollback_sql();
                return false;
            }
        } else {
            // no neighbour
            rollback_sql();
            return false;
        }

        commit_sql();
        $this->items = get_records('report_heading_items','','','sortorder');
        return true;

    }

    /*
     * Print out the report heading table
     *
     * @param integer $columns Number of columns to spread the data over
     * @param boolean $timestamp If true, include a row showing when report was displayed
     * @return string The HTML to display the table
     */
    function display($columns = 1, $timestamp = true) {
        $col = 1;
        $out = '';
        $out .= '<table cellpadding="4" class="reportheading-table">';
        foreach($this->items as $item) {
            $heading = $item->heading;
            $defaultvalue = $item->defaultvalue;
            $type = $item->type;
            if($col == 1) {
                $out .= '<tr>';
            }
            $out .= '<th>'.$heading.'</th>';
            $out .= '<td>';

            // array of prefixes (defined in get_column_options()) and methods to call
            // if type starts with the prefix
            $possibletypes = array(
                'user-' => 'get_user_field',
                'profile-' => 'get_profile_field',
                'pos-' => 'get_position_depth',
                'org-' => 'get_organisation_depth',
                'manager-' => 'get_manager_field',
            );
            foreach($possibletypes as $possibletype => $func) {
                $value = '';
                if(strncmp($type, $possibletype, strlen($possibletype)) == 0) {
                    if(method_exists($this, $func)) {
                        $value = $this->$func(substr($type,strlen($possibletype)));
                    }
                    break;
                }
            }
            if($value) {
                $out .= $value;
            } else {
                $out .= $defaultvalue;
            }
            $out .= '</td>';
            if($col >= $columns) {
                $out .= '</tr>';
                $col = 0;
            }
            $col++;
        }
        // close the row if needed
        if($col != 1) {
            $out .= '</tr>';
        }
        if ($timestamp) {
            $out .= '<tr><th>' . get_string('reportedat','local') . '</th>';
            $out .= '<td colspan="' . ($columns*2 - 1) . '">' . userdate(time()) .'</td></tr>';
        }
        $out .= '</table>';
        return $out;
    }

    /*
     * Returns a formatted version of a field from a user's profile
     *
     * @param string $field Name of the profile field to return
     * @param integer $userid ID of the user to return. If null return the current user's details
     * @return string A formatted HTML string of the required field or an empty string if not found
     */
    function get_user_field($field, $userid=null) {
        global $CFG;

        // check field exists in user table
        require_once($CFG->libdir.'/ddllib.php');
        $table = new XMLDBTable('user');
        $tablefield = new XMLDBField($field);
        // fullname is a special case, handled below
        if(!field_exists($table,$tablefield) && $field != 'fullname') {
            return '';
        }
        // if no user specified, defaults to current user
        if(!isset($userid)) {
            $userid = $this->userid;
        }

        // treat some fields as special
        switch($field) {
            case 'email':
                if($value = get_field('user',$field,'id',$userid)) {
                    return obfuscate_mailto($value);
                } else {
                    return '';
                }
            case 'fullname':
                $user = get_record('user', 'id', $userid);
                $fullname = fullname($user);
                return '<a href="'.$CFG->wwwroot.'/user/view.php?id='.$userid.'">'.$fullname.'</a>';
            case 'url':
                if($value = get_field('user',$field,'id',$userid)) {
                    return '<a href="'.$value.'">'.$value.'</a>';
                } else {
                    return '';
                }
            default:
                $value = get_field('user',$field,'id',$userid);
                return $value;
        }
    }

    /*
     * Returns a formatted version of the field from the user's manager's profile
     *
     * Looks up the current user's manager then uses get_user_field() to return
     * the specified information from their manager's profile
     *
     * @param string $field Name of the profile field to return
     * @return string A formatted HTML string of the required field or an empty string if not found
     */
    function get_manager_field($field) {
        global $CFG;
        // find the user's manager ID
        $ra = get_field('pos_assignment', 'reportstoid', 'userid', $this->userid);
        if(!$ra) {
            return '';
        }
        $managerid = get_field('role_assignments', 'userid', 'id', $ra);
        if(!$managerid) {
            return '';
        }
        // use get_user_field() to get manager info
        return $this->get_user_field($field, $managerid);
    }

    /*
     * Returns the value of a user's custom field setting
     *
     * @param string $field Shortname of the custom field to return the value of
     * @return string The custom field value for the current user, or an empty string
     */
    function get_profile_field($field) {
        global $CFG;
        return get_field_sql("SELECT d.data
            FROM {$CFG->prefix}user_info_data d
            JOIN {$CFG->prefix}user_info_field f ON f.id = d.fieldid
            WHERE d.userid = {$this->userid} AND f.shortname = '{$field}'");
    }

    /*
     * Returns the item at the specified depth level belonging to this user
     *
     * @param string $type The hierarchy type (position or organisation)
     * @param string $depth Shortname of the depth level required
     * @return string String containing the matching value or an empty string
     */
    function get_hierarchy_depth($type, $depth) {
        global $CFG;
        // only works for these hierarchies at the moment at does a lookup in
        // pos_assignment table
        if($type != 'position' && $type != 'organisation') {
            return '';
        }
        // get short prefix
        require_once($CFG->dirroot.'/hierarchy/lib.php');
        $shortprefix = hierarchy::get_short_prefix($type);

        $reqdepthlevel = get_field($shortprefix.'_depth', 'depthlevel', 'shortname', $depth);
        $framework = get_field($shortprefix.'_depth', 'frameworkid', 'shortname', $depth);
        $itemid = get_field('pos_assignment', $type.'id', 'userid', $this->userid, 'type', 1);
        if(empty($reqdepthlevel) || empty ($itemid)) {
            return '';
        }
        if(!$item = get_record($shortprefix, 'id', $itemid, 'frameworkid', $framework)) {
            return '';
        }
        $descendants = explode('/', $item->path);
        if(!array_key_exists($reqdepthlevel, $descendants)) {
            return '';
        }
        if($requireditem = get_record($shortprefix, 'id', $descendants[$reqdepthlevel])) {
            return $requireditem->fullname;
        } else {
            return '';
        }
    }

    /*
     * Wrapper function to return a position depth value
     *
     * See get_hierarchy_depth() for details
     */
    function get_position_depth($depth) {
        return $this->get_hierarchy_depth('position', $depth);
    }

    /*
     * Wrapper function to return an organisation depth value
     *
     * See get_hierarchy_depth() for details
     */
    function get_organisation_depth($depth) {
        return $this->get_hierarchy_depth('organisation', $depth);
    }
}

