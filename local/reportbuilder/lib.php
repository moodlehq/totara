<?php

require_once("{$CFG->dirroot}/local/reportbuilder/filters/lib.php");
require_once($CFG->libdir.'/tablelib.php');
include_once($CFG->dirroot.'/local/reportbuilder/contentclass.php');

class reportbuilder {
    public $fullname, $shortname, $source, $hidden, $filters, $filteroptions, $columns, $contentsettings;
    public $columnoptions, $_filtering, $contentoptions, $contentmode, $embeddedurl;
    private $_id, $_defaultcolumns, $_defaultfilters, $_joinlist, $_base, $_params, $_sid;
    private $_paramoptions, $_embeddedparams, $_admin, $_adminoptions, $_fullcount, $_filteredcount;

    function reportbuilder($id=null, $shortname=null, $embed=false, $sid=null) {
	global $CFG;

	if($id != null) {
	    // look for existing report by id
	    $report = get_record('report_builder', 'id', $id);
	} else if ($shortname != null) {
	    // look for existing report by shortname
	    $report = get_record('report_builder', 'shortname', $shortname);
	} else {
	    // either id or shortname is required
            error(get_string('noshortnameorid','local'));
        }

	// handle if report not found in db
        if(!$report) {
            if($embed) {
                if(! $id = $this->create_embedded_record($shortname, $embed, $error)) {
                    error('Error creating embedded record: '.$error);
		        }
		        $report = get_record('report_builder','id', $id);
            } else {
                error("Report with ID of '$id' not found in database.");
            }
        }

        if ($report) {
            $this->_id = $report->id;
            $this->source = $report->source;
            $this->shortname = $report->shortname;
            $this->fullname = $report->fullname;
            $this->filters = $this->get_filters();
            $this->columns = $this->get_columns();
            $this->hidden = $report->hidden;
            $this->contentmode = $report->contentmode;
            $this->contentsettings = unserialize($report->contentsettings);
            $this->embeddedurl = $report->embeddedurl;
            $this->_sid = $sid;
        } else {
            error("Report with id of '$id' not found in database.");
        }

        if($embed) {
            $this->_embeddedparams = $embed->embeddedparams;
        }

        // pull in data for this report from the source
        $this->columnoptions = reportbuilder::get_source_data('columnoptions', $this->source);
        $this->contentoptions = reportbuilder::get_source_data('contentoptions', $this->source);
        $this->_defaultcolumns = reportbuilder::get_source_data('defaultcolumns', $this->source);
        $this->_defaultfilters = reportbuilder::get_source_data('defaultfilters', $this->source);
        $this->filteroptions = reportbuilder::get_source_data('filteroptions', $this->source);
        $this->_adminoptions = reportbuilder::get_source_data('adminoptions', $this->source);
        $this->_admin = $this->get_current_admin_options();
        $this->_joinlist = reportbuilder::get_source_data('joinlist', $this->source);
        $this->_base = reportbuilder::get_source_data('base', $this->source);
        $this->_paramoptions = reportbuilder::get_source_data('paramoptions', $this->source);
        $this->_params = $this->get_current_params();

        if($sid) {
            $this->restore_saved_search();
        }

        // generate a filter for this report
        $this->_filtering = new filtering($this, $this->get_current_url());

    }

    /*
     * Looks up the saved search ID specified and attempts to restore
     * the SESSION variable if access is permitted
     *
     * @return Boolean True if user can view, error otherwise
     */
    function restore_saved_search() {
        global $SESSION,$USER;
        $filtername = 'filtering_'.$this->shortname;
        if($saved = get_record('report_builder_saved','id',$this->_sid)) {
            if($saved->public != 0 || $saved->userid == $USER->id) {
                $SESSION->$filtername = unserialize($saved->search);
            } else {
                error('Saved search not found or search is not public');
                return false;
            }
        } else {
            error('Saved search not found or search is not public');
            return false;
        }
        return true;
    }

    /*
     * Gets any filters set for the current report from the database
     *
     * @returns array Array of filters for current report or empty array if none set
     */
    function get_filters() {
        $out = array();
        $id = isset($this->_id) ? $this->_id : null;
        if(empty($id)) {
            return $out;
        }
        if($filters = get_records('report_builder_filters','reportid', $id, 'sortorder')) {
            foreach ($filters as $filter) {
                $item = array(
                    'type' => $filter->type,
                    'value' => $filter->value,
                    'advanced' => $filter->advanced,
                );
                $out[$filter->id] = $item;
            }
        }
        return $out;
    }

    /*
     * Gets any columns set for the current report from the database
     *
     * @returns array Array of columns for current report or empty array if none set
     */
    function get_columns() {
        $out = array();
        $id = isset($this->_id) ? $this->_id : null;
        if(empty($id)) {
            return $out;
        }
        if($columns = get_records('report_builder_columns','reportid', $id, 'sortorder')) {
            foreach ($columns as $column) {
                $item = array(
                    'type' => $column->type,
                    'value' => $column->value,
                    'heading' => $column->heading,
                );
                $out[$column->id] = $item;
            }
        }
        return $out;
    }

    /*
     * Creates a database entry for an embedded report when it is first viewed so the settings can be
     * edited
     *
     * @param string $shortname The unique name for this embedded report
     * @param object $embed An object containing the embedded reports settings
     * @param string &$error Error string to return on failure
     *
     * @return boolean ID of new database record, or false on failure
     */
    function create_embedded_record($shortname, $embed, &$error) {
        $error = null;

        // check input
        if(!isset($shortname)) {
            $error = 'Bad shortname';
            return false;
        }
        if(!isset($embed->source)) {
            $error = 'Bad source';
            return false;
        }
        if(!isset($embed->filters) || !is_array($embed->filters)) {
            $embed->filters = array();
        }
        if(!isset($embed->columns) || !is_array($embed->columns)) {
            $error = 'Bad columns';
            return false;
        }
        // hide embedded reports from report manager by default
        $embed->hidden = isset($embed->hidden) ? $embed->hidden : 1;
        $embed->accessmode = isset($embed->accessmode) ? $embed->accessmode : 0;
        $embed->contentmode = isset($embed->contentmode) ? $embed->contentmode : 0;

        $embed->accesssettings = isset($embed->accesssettings) ? $embed->accesssettings : array();
        $embed->contentsettings = isset($embed->contentsettings) ? $embed->contentsettings : array();

        $todb = new object();
        $todb->shortname = $shortname;
        $todb->fullname = $embed->fullname;
        $todb->source = $embed->source;
        $todb->hidden = 1; // hide embedded reports by default
        $todb->accessmode = $embed->accessmode;
        $todb->contentmode = $embed->contentmode;
        $todb->contentsettings = serialize($embed->contentsettings);
        $todb->accesssettings = serialize($embed->accesssettings);
        $todb->embeddedurl = qualified_me();

        begin_sql();
        if (!$newid = insert_record('report_builder', $todb)) {
            $error = 'DB insert error';
            rollback_sql();
            return false;
        }

        // add columns
        $so = 1;
        foreach($embed->columns as $column) {
            $todb = new object();
            $todb->reportid = $newid;
            $todb->type = $column['type'];
            $todb->value = $column['value'];
            $todb->heading = $column['heading'];
            $todb->sortorder = $so;
            if(!insert_record('report_builder_columns', $todb)) {
                rollback_sql();
                $error = 'Error inserting columns';
                return false;
            }
            $so++;
        }

        // add filters
        $so = 1;
        foreach($embed->filters as $filter) {
            $todb = new object();
            $todb->reportid = $newid;
            $todb->type = $filter['type'];
            $todb->value = $filter['value'];
            $todb->advanced = $filter['advanced'];
            $todb->sortorder = $so;
            if(!insert_record('report_builder_filters', $todb)) {
                rollback_sql();
                $error = 'Error inserting filters';
                return false;
            }
            $so++;
        }

        commit_sql();
        return $newid;
    }

    /*
     * Given a report fullname, try to generate a sensible shortname that will be unique
     *
     * @param string $fullname The report's full name
     * @return string A unique shortname suitable for this report
     */
    public static function create_shortname($fullname) {
        // leaves only letters and numbers
        // replaces spaces + dashes with underscores
        $validchars = strtolower(preg_replace(array('/[^a-zA-Z\d\s-_]/','/[\s-]/'), array('','_'), $fullname));
        $shortname = "report_{$validchars}";
        $try = $shortname;
        $i = 1;
        while($i<1000) {
            if(get_field('report_builder','id','shortname',$try)) {
                    // name exists, try adding a number to make unique
                $try = $shortname . $i;
            $i++;
            } else {
            // return the shortname
            return $try;
                }
        }
        // if all 1000 name tries fail, give up and use a timestamp
        return "report_".time();
    }


    /*
     * Return the URL to view the current report
     *
     * @return string URL of current report
     */
    function report_url() {
        global $CFG;
        if($this->embeddedurl === null) {
            return $CFG->wwwroot.'/local/reportbuilder/report.php?id='.$this->_id;
        } else {
            return $this->embeddedurl;
        }
    }


    /*
     * Makes sure that columns exist in columnoptions
     * if not, remove them and print a warning
     *
     * @param boolean $silent If true, removes column but doesn't raise a warning
     *                        Used by export function so file still exports
     * @return No return value, but $this->columns may be modified
     */
    function check_columns($silent=false) {
        $columns =& $this->columns;
        $columnoptions = $this->columnoptions;
        if(isset($columns) and is_array($columns)) {
            foreach($columns as $index => $column) {
                $type = $column['type'];
                $value = $column['value'];
                if(!array_key_exists($type, $columnoptions)) {
                    unset($columns[$index]); // remove column
                    if(!$silent) {
                        trigger_error("Column type '$type' not found in column options.", E_USER_WARNING);
                    }
                } else if (!array_key_exists($value, $columnoptions[$type])) {
                    unset($columns[$index]); // remove column
                    if(!$silent) {
                        trigger_error("Column value '$value' not found for type '$type' in column options.", E_USER_WARNING);
                    }
                }
            }
        }
    }


    /*
     * Get the current page url, minus any pagination or sort order elements
     * Good for submitting forms
     *
     * @return string Current URL, minus any spage and ssort parameters
     */
    function get_current_url() {
        // array of parameters to remove from query string
        $strip_params = array('spage','ssort','sid');

        $url = new moodle_url(qualified_me());
        foreach ($url->params as $name =>$value) {
            if(in_array($name, $strip_params)) {
                $url->remove_params($name);
            }
        }
        return html_entity_decode($url->out());
    }


    /*
     * Returns an array of admin options that the current user has
     * permission to view. Used to reduce the table joins to only
     * those required.
     *
     * @return array Array of arrays containing valid admin options
     */
    function get_current_admin_options() {
        $out = array();
        $context = get_context_instance(CONTEXT_SYSTEM);
        if(!isset($this->_adminoptions)) {
            return $out;
        }
        foreach ($this->_adminoptions as $adminoption) {
            // only include column if no capability set, or if it is set and user has it
            if(!isset($adminoption['capability']) || has_capability($adminoption['capability'],$context)) {
                $out[] = $adminoption;
            }
        }
        return $out;
    }


    /*
     * Returns an array of arrays containing information about any currently
     * set URL parameters. Used to determine which joins are required to
     * match against URL parameters
     *
     * @return array Array of set URL parameters and their values
     */
    function get_current_params() {
        $out = array();
        if(!isset($this->_paramoptions)) {
            return $out;
        }
        foreach ($this->_paramoptions as $name => $param) {
            $var = optional_param($name, null, PARAM_TEXT); //get as text for max flexibility

            if(isset($this->_embeddedparams[$name])) {
                // embeded params take priority over url params
                $res = array();
                $res['field'] = $param['field'];
                $res['joins'] = $param['joins'];
                $res['value'] = $this->_embeddedparams[$name];
                $out[] = $res;
            } else if(isset($var)) {
                // this url param exists, add to params to use
                $res = array();
                $res['field'] = $param['field'];
                $res['joins'] = $param['joins'];
                $res['value'] = $var; // save the value
                $out[] = $res;
            }

        }
        return $out;
    }


    /*
     * Returns the data stored a source file for use by the report
     *
     * @param string $datatype The name of the data to be obtained. Should match the filename
     *                         in the source directory
     * @param string $source The data source to obtain the data from
     * @return mixed The data is returned, usually as an array of arrays
     */
    public static function get_source_data($datatype, $source) {
        global $CFG;
        $file = "{$CFG->dirroot}/local/reportbuilder/sources/$source/$datatype.php";
        if(file_exists($file)) {
            include($file);
        }
        if(isset($$datatype)) {
            return $$datatype;
        } else {
            return null;
        }
    }

    /*
     * Wrapper for displaying search form from filtering class
     *
     * @return Nothing returned but prints the search box
     */
    function display_search() {
        $this->_filtering->display_add();
    }

    /*
     * Wrapper for displaying active fileter from filtering class
     * No longer used as filtering behaviour modified to be
     * more like a search
     *
     * @return Nothing returned but prints active filters
     */
    function get_sql_filter() {
        return $this->_filtering->get_sql_filter();
    }



    /* Returns true if the current user has permission to view this report
     *
     * @param integer $id ID of the report to be viewed
     * @return boolean True if they have any of the required capabilities
     */
    public static function is_capable($id) {

        // if the 'accessmode' flag is set to 0 let anyone view it
        $accessmode = get_field('report_builder', 'accessmode', 'id', $id);
        if($accessmode == 0) {
            return true;
        }

        // get array of roles the user has
        $context = get_context_instance(CONTEXT_SYSTEM);
        $userroles = array();
        if($data = get_user_roles($context, 0, false)) {
            foreach($data as $item) {
                $userroles[$item->roleid] = 1;
            }
        }
        // see if user has any allowed roles
        if($allowedroles = get_records_select('report_builder_access', "reportid=$id AND accesstype='role'")) {
            foreach($allowedroles as $allowedrole) {
                if(array_key_exists($allowedrole->typeid, $userroles)) {
                    return true;
                }
            }
        }
        return false;
    }

    /*
     * Returns an SQL snippet that, when applied to the WHERE clause of the query,
     * reduces the results to only include those matched by any specified URL parameters
     *
     * @return string SQL snippet created from URL parameters
     */
    function get_param_restrictions() {
        $out=array();
        $params = $this->_params;
        if(is_array($params)) {
            foreach($params as $param) {
                $field = isset($param['field']) ? $param['field'] : null;
                $value = isset($param['value']) ? $param['value'] : null;
                // don't include if param not set to anything
                if(!isset($value) || $value=='') {
                    continue;
                }
                $out[] = "$field = $value";
            }
        }
        if(count($out)==0) {
            return '';
        }
        return "(" . implode(" AND ",$out) . ")";
    }


    /*
     * Returns an SQL snippet that, when applied to the WHERE clause of the query,
     * reduces the results to only include those matched by any specified content
     * restrictions
     *
     * @return string SQL snippet created from content restrictions
     */
    function get_content_restrictions() {
        global $CFG;
        // if no content restrictions enabled return a TRUE snippet
        if($this->contentmode == 0) {
            return "( TRUE )";
        } else if ($this->contentmode == 2) {
            // require all to match
            $op = ' AND ';
        } else {
            // require any to match
            $op = ' OR ';
        }

        $out = array();
        $settings = $this->contentsettings;

        // go through the content options
        if(isset($this->contentoptions) && is_array($this->contentoptions)) {
            foreach($this->contentoptions as $option) {
                $name = $option['name'];
                $field = $option['field'];
                $options = isset($settings[$name]) ? $settings[$name] : null;
                if(isset($options['enable']) && $options['enable'] == 1) {
                    // this content option is enabled
                    if(class_exists($name)) {
                        // call function to get SQL snippet
                        $klass = new $name();
                        $out[] = $klass->sql_restriction($field, $options);
                    } else {
                        error("Content class $name does not exist");
                    }
                }
            }
        }
        // show nothing if no content restrictions enabled
        if(count($out)==0) {
            return '(FALSE)';
        }
        return '('.implode($op, $out).')';
    }

    /*
     * Returns human readable descriptions of any content or
     * filter restrictions that are limiting the number of results
     * shown. Used to let the user known what a report contains
     *
     * @param string $which Which restrictions to return, defaults to all
     *                      but can be 'filter' or 'content' to just return
     *                      restrictions of that type
     * @return array An array of strings containing descriptions
     *               of any restrictions applied to this report
     */
    function get_restriction_descriptions($which='all') {
        global $CFG;
        // include content restrictions
        $content_restrictions = array();
        $settings = $this->contentsettings;
        $res = array();
        if($this->contentmode != 0) {
            foreach($this->contentoptions as $option) {
                $name = $option['name'];
                $title = $option['title'];
                $options = isset($settings[$name]) ? $settings[$name] : null;
                if(isset($options['enable']) && $options['enable'] == 1) {
                    if(class_exists($name)) {
                        $klass = new $name();
                        $res[] = $klass->human_restriction($title, $options);
                    } else {
                        error("Content class function $name does not exist");
                    }
                }
            }
            if($this->contentmode == 2) {
                // 'and' show one per line
                $content_restrictions = $res;
            } else {
                // 'or' show as a single line
                $content_restrictions[] = implode(get_string('or','local'), $res);
            }
        }

        $filter_restrictions = $this->_filtering->return_active();

        switch($which) {
        case 'content':
            $restrictions = $content_restrictions;
            break;
        case 'filter':
            $restrictions = $filter_restrictions;
            break;
        default:
            $restrictions = array_merge($content_restrictions, $filter_restrictions);
        }
        return $restrictions;
    }




    /*
     * Returns an array of fields that must form part of the SQL query
     * in order to provide the data need to display the columns required
     *
     * Each element in the array is an SQL snippet with an alias built
     * from the $type and $value of that column
     *
     * @return array Array of SQL snippets for use by SELECT query
     *
     */
    function get_column_fields() {

        $source = $this->source;
        $columns = $this->columns;
        $columnoptions = $this->columnoptions;
        $fields = array();
        foreach($columns as $column) {
            $type = isset($column['type']) ? $column['type'] : '';
            if(array_key_exists($type, $columnoptions)) {
                $value = isset($column['value']) ? $column['value'] : '';
                if(array_key_exists($value, $columnoptions[$type])) {
                    // add field to list to be selected
                    // use type_value as alias for each field
                    $fields[] = $columnoptions[$type][$value]['field']." ".sql_as()." {$type}_{$value}";
                } else {
                    trigger_error("get_column_fields(): column value '$value' not found in source '$source' for type '$type'", E_USER_WARNING);
                }
            } else {
                trigger_error("get_column_fields(): column type '$type' not found in source '$source'", E_USER_WARNING);
            }
        }
        return $fields;

    }

    /*
     * Returns an array of fields that must form part of the SQL query
     * in order to provide the data needed to display the admin column
     *
     * @return array Array of SQL snippets for use by SELECT query
     *
     */
    function get_admin_fields() {
        $source = $this->source;
        $columns = $this->_admin;
        $fields = array();
        foreach($columns as $column) {
            if(isset($column['name'])) {
                $name = $column['name'];
            } else {
                // we need a name
                continue;
            }
            if(isset($column['fields']) && is_array($column['fields'])) {
                foreach($column['fields'] as $key => $field) {
                    $fields[] = $field.' '.sql_as()." {$name}_{$key}";
                }
            }
        }
        return $fields;
    }


    /*
     * Given an array of arrays with the 'joins' key set, returns
     * an array of SQL snippets of the actual join code
     *
     * @param array $inputs Array of arrays. The inner array should contain
     *                      a key called 'joins' which lists the names of the
     *                      required joins (names must match the keys in the
     *                      joinlist.php file)
     * @param string $type The function is called to obtain joins for various
     *                     different elements of the query. The type is displayed
     *                     in the error message to help with debugging
     * @return array An array of SQL snippets used to build the join part of the query
     */
    function get_joins($inputs, $type) {
        $source = $this->source;
        $joinlist = $this->_joinlist;
        $joins = array();
        foreach($inputs as $input) {
            $input_joins = (isset($input['joins'])) ? $input['joins'] : null;
            if($input_joins && is_array($input_joins)) {
                foreach($input_joins as $input_join) {
                    if(array_key_exists($input_join, $joinlist)) {
                        $joins[$input_join] = $joinlist[$input_join];
                    } else {
                        error("get_joins(): join for $type with name $input_join not in joinlist");
                    }
                }
            }
        }
        return $joins;
    }

    /*
     * Collects together the content restriction joins data in a format
     * suitable for get_joins()
     *
     * @return array An array of arrays containing content join information
     */
    function get_content_joins() {
        if($this->contentmode == 0) {
            // no limit on content so no joins necessary
            return array();
        }
        $settings = $this->contentsettings;
        $contentjoins = array();
        foreach($this->contentoptions as $option) {
                $optionname = $option['name'];
                if(array_key_exists($optionname, $settings)) {
                    if(array_key_exists('enable',$settings[$optionname])) {
                        if($settings[$optionname]['enable'] == 1) {
                            $contentjoins[] = $option;
                        }
                    }
                }
        }
        return $this->get_joins($contentjoins, 'content');
    }


    /*
     * Check the requested columns exist in column options, and if so
     * collect together data into a format suitable for get_joins()
     *
     * @return array An array of arrays containing column join information
     */
    function get_column_joins() {
        $source = $this->source;
        $columns = $this->columns;
        $columnoptions = $this->columnoptions;
        $coljoins = array();
        foreach($columns as $column) {
            $type = isset($column['type']) ? $column['type'] : '';

            if(array_key_exists($type, $columnoptions)) {
                $value = isset($column['value']) ? $column['value'] : '';

                if(array_key_exists($value, $columnoptions[$type])) {

                    $coljoins[] = $columnoptions[$type][$value];

                } else {
                    trigger_error("get_column_joins(): column value '$value' not found in source '$source' for type '$type'", E_USER_WARNING);
                }
            } else {
                trigger_error("get_column_joins(): column type '$type' not found in source '$source'", E_USER_WARNING);
            }
        }
        return $this->get_joins($coljoins, 'column');
    }


    /*
     * Check the current session for active filters, and if found
     * collect together join data into a format suitable for get_joins()
     *
     * @return array An array of arrays containing filter join information
     */
    function get_filter_joins() {
        $shortname = $this->shortname;
        $columnoptions = $this->columnoptions;
        global $SESSION;
        $filterjoins = array();
        // check session variable for any active filters
        // if they exist we need to make sure we have included joins for them too
        $filtername = 'filtering_'.$shortname;
        if (isset($SESSION->$filtername)) {
            foreach ($SESSION->$filtername as $filter => $unused) {
                // parse the filtername for type and value
                $parts = explode('-',$filter);
                if (count($parts) != 2) {
                    error("get_filter_joins(): filter name format incorrect. Query snippets may have included a dash character.");
                    continue;
                }
                $type = $parts[0];
                $value = $parts[1];
                $filterjoins[] = $columnoptions[$type][$value];
            }
        }
        return $this->get_joins($filterjoins, 'filter');
    }


    /*
     * Function used as callback for uksort() to sort join arrays
     * Order of sort should be the same as the order of the joinlist array
     *
     * @param mixed The first element to compare
     * @param mixed The second element to compare
     * @return integer -1, 1 or 0 depending on order of elements
     */
    function sort_join($el1, $el2) {
        $joinlist = $this->_joinlist;
        // order of this array determines order of joins
        // earlier elements joined first
        $order = array_keys($joinlist);

        $el1key = array_search($el1, $order);
        $el2key = array_search($el2, $order);

        // determine sort order
        // if key is missing, put at the end
        if($el1key !== false && $el2key === false) {
            trigger_error("Missing array key in sort_join(). Add '$el2' to order array.",E_USER_WARNING);
            return -1;
        } else if ($el2key !== false && $el1key === false) {
            trigger_error("Missing array key in sort_join(). Add '$el1' to order array.",E_USER_WARNING);
            return 1;
        } else if ($el1key === false && $el2key === false) {
            trigger_error("Missing array keys in sort_join(). Add '$el1' and '$el2' to order array.",E_USER_WARNING);
            return 0;
        } else if($el1key < $el2key) {
            return -1;
        } else if($el1key > $el2key) {
            return 1;
        } else {
            return 0;
        }
    }


    /*
     * This function builds the main SQL query used to get the data for the page
     *
     * @param boolean $countonly If true returns SQL to count results, otherwise the
     *                           query requests the fields needed for columns too.
     * @param boolean $filtered If true, includes any active filters in the query,
     *                           otherwise returns results without filtering
     * @return string The full SQL query
     */
    function build_query($countonly=false, $filtered=false) {
        global $CFG;
        $source = $this->source;
        $columns = $this->columns;
        $joinlist = $this->_joinlist;
        $base = $this->_base;

        // get the fields needed to display requested columns
        $columnfields = $this->get_column_fields();
        $adminfields = $this->get_admin_fields();
        $fields = array_merge($columnfields, $adminfields);

        // get the joins needed to display requested columns and do filtering and restrictions
        $columnjoins = $this->get_column_joins();
        $filterjoins = ($filtered === true) ? $this->get_filter_joins() : array();
        $paramjoins = $this->get_joins($this->_params,'param');
        $adminjoins = $this->get_joins($this->_admin,'admin');
        $contentjoins = $this->get_content_joins();
        $joins = array_merge($columnjoins, $filterjoins, $paramjoins, $adminjoins, $contentjoins);

        // now build the query from the snippets

        // need a unique field for get_records() so include id as first column
        if($countonly) {
            $select = "SELECT COUNT(*) ";
        } else {
            $select = "SELECT base.id,".implode($fields,',')." ";
        }

        // sort joins in order determined by sort_join function
        // this ensures joins are processed in the correct order
        // sort_join callback is method within this class
        uksort($joins, array($this,'sort_join'));

        // build query starting from base table then adding required joins
        $from = "FROM $base ".implode(' ', $joins)." ";


        // restrictions
        $whereclauses = array();
        $restrictions = $this->get_content_restrictions();
        if($restrictions != '') {
            $whereclauses[] = $restrictions;
        }
        $extrasql = ($filtered===true) ? $this->get_sql_filter() : '';
        if($extrasql != '') {
            $whereclauses[] = $extrasql;
        }
        $paramrestrictions = $this->get_param_restrictions();
        if($paramrestrictions != '') {
            $whereclauses[] = $paramrestrictions;
        }
        $where = (count($whereclauses) > 0) ? "WHERE ".implode(' AND ',$whereclauses) : '';

        $sql = "$select $from $where";
        return $sql;
    }

    /*
     * Return the total number of records in this report (after any
     * restrictions have been applied but before any filters)
     *
     * @return integer Record count
     */
    function get_full_count() {
        // use cached value if present
        if(empty($this->_fullcount)) {
            $sql = $this->build_query(true);
            $this->_fullcount = count_records_sql($sql);
        }
        return $this->_fullcount;
    }

    /*
     * Return the number of filtered records in this report
     *
     * @return integer Filtered record count
     */
    function get_filtered_count() {
        // use cached value if present
        if(empty($this->_filteredcount)) {
            $sql = $this->build_query(true, true);
            $this->_filteredcount = count_records_sql($sql);
        }
        return $this->_filteredcount;
    }

    /*
     * Exports the data from the current results, maintaining
     * sort order and active filters but removing pagination
     *
     * @param string $format Format for the export ods/csv/xls
     * @return No return but initiates save dialog
     */
    function export_data($format) {
        $this->check_columns(true);
        $columns = $this->columns;
        $shortname = $this->shortname;
        $count = $this->get_filtered_count();
        $sql = $this->build_query(false, true);

        // need to create flexible table object to get sort order
        // from session var
        $table = new flexible_table($shortname);
        $sort = $table->get_sql_sort($shortname);
        $order = ($sort!='') ? " ORDER BY $sort" : '';

        // array of filters that have been applied
        // for including in report where possible
        $restrictions = $this->get_restriction_descriptions();

        $headings = array();
        foreach($columns as $column) {
            if(isset($column['heading']) && $column['heading'] != '') {
                $headings[] = strip_tags($column['heading']);
            }
        }
        switch($format) {
            case 'ods':
                $this->download_ods($headings, $sql.$order, $count, $restrictions);
            case 'xls':
                $this->download_xls($headings, $sql.$order, $count, $restrictions);
            case 'csv':
                $this->download_csv($headings, $sql.$order, $count);
        }
        die;
    }

    /*
     * Display the results table
     *
     * @return No return value but prints the current data table
     */
    function display_table() {
        global $CFG;
        define('DEFAULT_PAGE_SIZE', 40);
        define('SHOW_ALL_PAGE_SIZE', 5000);

        $spage     = optional_param('spage', 0, PARAM_INT);                    // which page to show
        $perpage   = optional_param('perpage', DEFAULT_PAGE_SIZE, PARAM_INT);
        $ssort     = optional_param('ssort');

        $this->check_columns();
        $columns = $this->columns;
        $shortname = $this->shortname;
        $countfiltered = $this->get_filtered_count();

        if(count($columns) == 0) {
            print '<p>' . get_string('error:nocolumnsdefined','local') . '</p>';
            return false;
        }

        $sql = $this->build_query(false, true);

        $tablecolumns = array();
        $tableheaders = array();
        foreach($columns as $column) {
            $type = $column['type'];
            $value = $column['value'];
            // don't print the column if heading is blank
            if(isset($column['heading']) && $column['heading'] != '') {
                $tablecolumns[] = "{$type}_{$value}"; // used for sorting
                $tableheaders[] = $column['heading'];
            }
        }
        // also add any admin columns
        if(isset($this->_admin) && is_array($this->_admin) && count($this->_admin)>0) {
            foreach($this->_admin as $admincol) {
                $tablecolumns[] = $admincol['name'];
                $tableheaders[] = $admincol['heading'];
            }
        }

        $table = new flexible_table($shortname);
        $table->define_columns($tablecolumns);
        $table->define_headers($tableheaders);
        $table->set_attribute('cellspacing', '0');
        $table->set_attribute('id', $shortname);
        $table->set_attribute('class', 'logtable generalbox reportbuilder-table');
        $table->set_control_variables(array(
            TABLE_VAR_SORT    => 'ssort',
            TABLE_VAR_HIDE    => 'shide',
            TABLE_VAR_SHOW    => 'sshow',
            TABLE_VAR_IFIRST  => 'sifirst',
            TABLE_VAR_ILAST   => 'silast',
            TABLE_VAR_PAGE    => 'spage'
        ));
        $table->sortable(true,'user_fullname'); // sort by name by default
        $table->setup();
        $table->initialbars(true);
        $table->pagesize($perpage, $countfiltered);

        // center the contents of all the admin columns
        if(isset($this->_admin) && is_array($this->_admin) && count($this->_admin)>0) {
            foreach($this->_admin as $admincol) {
                $table->column_style($admincol['name'],'text-align','center');
            }
        }

        // check the sort session var doesn't contain old columns that no
        // longer exist
        $this->check_sort_keys();
        // get the ORDER BY SQL fragment from table
        $sort = $table->get_sql_sort();
        if($sort!='') {
            $order = " ORDER BY $sort";
        } else {
           $order = '';
        }
        $data = $this->fetch_data($sql.$order, $table->get_page_start(), $table->get_page_size(), false, true);
        // add data to flexible table
        foreach ($data as $row) {
            $table->add_data($row);
        }

        // display the table
        $table->print_html();

    }

    /*
     * Look up the sort keys and make sure they still exist in table
     * (could have been deleted in report builder)
     *
     * @return true May unset flexible table sort keys if they are not
     *              found in the column list
     */
    function check_sort_keys() {
        global $SESSION;
        $shortname = $this->shortname;
        $sortarray = isset($SESSION->flextable[$shortname]->sortby) ? $SESSION->flextable[$shortname]->sortby : null;
        if(is_array($sortarray)) {
            foreach($sortarray as $sortelement => $unused) {
                // see if sort element is in columns array
                $set = false;
                foreach($this->columns as $col) {
                    if($col['type'].'_'.$col['value'] == $sortelement) {
                        $set = true;
                    }
                }
                // if it's not remove it from sort SESSION var
                if($set === false) {
                    unset($SESSION->flextable[$shortname]->sortby[$sortelement]);
                }
            }
        }
        return true;
    }


    /*
     * Given an SQL query and some addition parameters, returns a 2d array of the data
     * obtained by running the query. If display functions exist for any columns the
     * data is passed to the display function and the result included instead.
     *
     * @param string $sql The SQL query, excluding offset/limit
     * @param integer $start The first row to extract
     * @param integer $size The total number of rows to extract
     * @param boolean $striptags If true, returns the data with any html tags removed
     * @param boolean $incadmin If true, add any admin columns defined by adminoptions.php
     * @return array Outer array are table rows, inner array are columns
     */
    function fetch_data($sql, $start=null, $size=null, $striptags=false, $incadmin=false) {
        global $CFG;
        $columns = $this->columns;
        $columnoptions = $this->columnoptions;

        // include display functions
        $displayfuncfile = "{$CFG->dirroot}/local/reportbuilder/displayfuncs.php";
        if(file_exists($displayfuncfile)) {
            include_once($displayfuncfile);
        }
        $records = get_recordset_sql($sql, $start, $size);
        $ret = array();
        if ($records) {
            while ($record = rs_fetch_next_record($records)) {
                $tabledata = array();
                foreach ($columns as $column) {
                    // don't print a column if heading is blank
                    if(isset($column['heading']) && $column['heading'] != '') {
                        $type = $column['type'];
                        $value = $column['value'];
                        $field = "{$type}_{$value}";
                        // treat fields different if display function exists
                        if (isset($columnoptions[$type][$value]['displayfunc']) &&
                            function_exists($columnoptions[$type][$value]['displayfunc'])) {
                            $func = $columnoptions[$type][$value]['displayfunc'];
                            $tabledata[] = $func($record->$field, $record);
                        } else {
                            $tabledata[] = $record->$field;
                        }
                    }
                }
                if($incadmin) {
                    $this->add_admin_columns($tabledata, $record);
                }
                $ret[] = $tabledata;
            }
            rs_close($records);
        }
        if($striptags === true) {
            return $this->strip_tags_r($ret);
        } else {
            return $ret;
        }
    }

    /*
     * Appends any admin columns to the fetch_data result row
     *
     * @param array &$row The current row that would be returned if no admin options set
     *                    Passed by reference.
     * @param array $record The db record for the current row, which includes the admin
     *                      fields required to build the admin column
     * @param No return value but may modify &$row
     */
    function add_admin_columns(&$row, $record) {
        global $CFG;
        if(isset($this->_admin) && is_array($this->_admin) && count($this->_admin)>0) {
            require_once($CFG->dirroot.'/local/reportbuilder/displayfuncs.php');
            foreach($this->_admin as $admincol) {
                $name = $admincol['name'];
                $displayfunc = $admincol['displayfunc'];
                if(function_exists($displayfunc)) {
                    $row[] = $displayfunc($record);
                }
            }
        }
    }


    /*
     * Recursive version of strip_tags
     *
     * @param array $value A nested array of strings
     * @return array The same array with HTML stripped from all strings
     */
    function strip_tags_r($value) {
        return is_array($value) ? array_map(array($this,'strip_tags_r'), $value) :
            strip_tags($value);
    }


    /* Prints select box and submit button to export current report
     * for this to work page must contain:
     * if($format!=''){$report->export_data($format);die;}
     * before header printed
     *
     * @return No return value but prints export select form
     */
    function export_select() {
        global $CFG;
        require_once($CFG->dirroot.'/local/reportbuilder/export_form.php');
        $export = new report_builder_export_form(qualified_me());
        $export->display();

    }

    /* Prints three buttons to export current report
     * for this to work page must contain:
     * if($format!=''){$report->export_data($format);die;}
     * before header printed
     *
     * @return string Returns the code for the export buttons
     */
    function export_buttons() {
        $out = "<center><table><tr><td>";
        $out .= print_single_button(qualified_me(),array('format'=>'xls'),get_string('exportxls','local'),'post','_self', true);
        $out .= "</td><td>";
        $out .= print_single_button(qualified_me(),array('format'=>'csv'),get_string('exportcsv','local'),'post','_self', true);
        $out .= "</td><td>";
        $out .= print_single_button(qualified_me(),array('format'=>'ods'),get_string('exportods','local'),'post','_self', true);
	$out .= "</td><tr></table></center>";
	return $out;
    }

    /*
     * Returns a button that when clicked, takes the user to a page which displays
     * the report
     *
     * @return string HTML to display the button
     */
    function view_button() {
        global $CFG;
        $viewurl = $this->report_url();
        $url = new moodle_url($this->report_url());
        return print_single_button($url->out(true), $url->params, get_string('viewreport','local'), 'get', '_self', true);
    }

    /*
     * Returns a button that when clicked, takes the user to a page where they can
     * save the results of a search for the current report
     *
     * @return string HTML to display the button
     */
    function save_button() {
        global $CFG;
        $search = optional_param('addfilter', null, PARAM_TEXT);
        if($search) {
            $params = array('id' => $this->_id);
            return print_single_button($CFG->wwwroot.'/local/reportbuilder/save.php', $params, get_string('savesearch','local'), 'get', '_self', true);
        } else {
            return '';
        }
    }

    /*
     * Returns a menu that when selected, takes the user to the specified saved search
     *
     * @return string HTML to display a pulldown menu with saved search options
     */
    function view_saved_menu() {
        global $CFG,$USER;
        $id = $this->_id;
        $sid = $this->_sid;
        // only show if there are saved searches for this report and user
        if($saved = get_records_select('report_builder_saved', 'reportid='.$id.' AND userid='.$USER->id)) {
            $common = $CFG->wwwroot.'/local/reportbuilder/report.php?id='.$id.'&amp;sid=';
            $options = array();
            foreach($saved as $item) {
                $options[$item->id] = $item->name;
            }
            return popup_form($common, $options, 'viewsavedsearch', $sid, get_string('viewsavedsearch','local'),'','',true);
        } else {
            return '';
        }
    }


    /*
     * Returns HTML for a button that when clicked, takes the user to a page which
     * allows them to edit this report
     *
     * @return string HTML to display the button
     */
    function edit_button() {
        global $CFG;
        $context = get_context_instance(CONTEXT_SYSTEM);
        // TODO what capability should be required here?
        if(has_capability('moodle/local:admin',$context)) {
            return print_single_button($CFG->wwwroot.'/local/reportbuilder/settings.php', array('id'=>$this->_id), get_string('editthisreport','local'), 'get', '_self', true);
        } else {
            return '';
        }
    }

    /* Download current table in ODS format
     * @param array $fields Array of column headings
     * @param string $query SQL query to run to get results
     * @param integer $count Number of filtered records in query
     * @param array $restrictions Array of strings containing info
     *                            about the content of the report
     * @return Returns the ODS file
     */
    function download_ods($fields, $query, $count, $restrictions=array()) {
        global $CFG;
        require_once("$CFG->libdir/odslib.class.php");
        $shortname = $this->shortname;
        $filename = clean_filename($shortname.'_report.ods');
        $blocksize = 1000;

        header("Content-Type: application/download\n");
        header("Content-Disposition: attachment; filename=$filename");
        header("Expires: 0");
        header("Cache-Control: must-revalidate,post-check=0,pre-check=0");
        header("Pragma: public");


        $workbook = new MoodleODSWorkbook('-');
        $workbook->send($filename);

        $worksheet = array();

        $worksheet[0] =& $workbook->add_worksheet('');
        $row = 0;
        $col = 0;

        if(is_array($restrictions) && count($restrictions)>0) {
            $worksheet[0]->write($row, 0, get_string('reportcontents','local'));
            $row++;
            foreach($restrictions as $restriction) {
                $worksheet[0]->write($row, 0, $restriction);
                $row++;
            }
            $row++;
        }

        foreach ($fields as $fieldname) {
            $worksheet[0]->write($row, $col, $fieldname);
            $col++;
        }
        $row++;

        $numfields = count($fields);

        //break the data into blocks as single array gets too big
        for($k=0;$k<=floor($count/$blocksize);$k++) {
            $start = $k*$blocksize;
            $data = $this->fetch_data($query, $start, $blocksize, true);

            $filerow = 0;
            foreach ($data as $datarow) {
                for($col=0; $col<$numfields;$col++) {
                    if(isset($data[$filerow][$col])) {
                        $worksheet[0]->write($row+$start, $col, htmlspecialchars_decode($data[$filerow][$col]));
                    }
                }
                $filerow++;
                $row++;
            }
        }

        $workbook->close();
        die;
    }

    /* Download current table in XLS format
     * @param array $fields Array of column headings
     * @param string $query SQL query to run to get results
     * @param integer $count Number of filtered records in query
     * @param array $restrictions Array of strings containing info
     *                            about the content of the report
     * @return Returns the Excel file
     */
    function download_xls($fields, $query, $count, $restrictions=array()) {
        global $CFG;

        require_once("$CFG->libdir/excellib.class.php");

        $shortname = $this->shortname;
        $filename = clean_filename($shortname.'_report.xls');
        $blocksize = 1000;

        header("Content-Type: application/download\n");
        header("Content-Disposition: attachment; filename=$filename");
        header("Expires: 0");
        header("Cache-Control: must-revalidate,post-check=0,pre-check=0");
        header("Pragma: public");


        $workbook = new MoodleExcelWorkbook('-');
        $workbook->send($filename);

        $worksheet = array();

        $worksheet[0] =& $workbook->add_worksheet('');
        $row = 0;
        $col = 0;

        if(is_array($restrictions) && count($restrictions)>0) {
            $worksheet[0]->write($row, 0, get_string('reportcontents','local'));
            $row++;
            foreach($restrictions as $restriction) {
                $worksheet[0]->write($row, 0, $restriction);
                $row++;
            }
            $row++;
        }

        foreach ($fields as $fieldname) {
            $worksheet[0]->write($row, $col, $fieldname);
            $col++;
        }
        $row++;

        $numfields = count($fields);

        // break the data into blocks as single array gets too big
        for($k=0;$k<=floor($count/$blocksize);$k++) {
            $start = $k*$blocksize;
            $data = $this->fetch_data($query, $start, $blocksize, true);

            $filerow = 0;
            foreach ($data as $datarow) {
                for($col=0; $col<$numfields; $col++) {
                    if(isset($data[$filerow][$col])) {
                        $worksheet[0]->write($row+$start, $col, htmlspecialchars_decode($data[$filerow][$col]));
                    }
                }
                $row++;
                $filerow++;
            }
        }

        $workbook->close();
        die;
    }

     /* Download current table in CSV format
     * @param array $fields Array of column headings
     * @param string $query SQL query to run to get results
     * @param integer $count Number of filtered records in query
     * @return Returns the CSV file
     */
    function download_csv($fields, $query, $count) {
        global $CFG;
        $shortname = $this->shortname;
        $filename = clean_filename($shortname.'_report.csv');
        $blocksize = 1000;

        header("Content-Type: application/download\n");
        header("Content-Disposition: attachment; filename=$filename");
        header("Expires: 0");
        header("Cache-Control: must-revalidate,post-check=0,pre-check=0");
        header("Pragma: public");

        $delimiter = get_string('listsep');
        $encdelim  = '&#'.ord($delimiter).';';
        $row = array();
        foreach ($fields as $fieldname) {
            $row[] = str_replace($delimiter, $encdelim, $fieldname);
        }

        echo implode($delimiter, $row)."\n";

        $numfields = count($fields);
        // break the data into blocks as single array gets too big
        for($k=0;$k<=floor($count/$blocksize);$k++) {
            $start = $k*$blocksize;
            $data = $this->fetch_data($query, $start, $blocksize, true);
            $i = 0;
            foreach ($data AS $row) {
                $row = array();
                for($j=0; $j<$numfields; $j++) {
                    if(isset($data[$i][$j])) {
                        $row[] = htmlspecialchars_decode(str_replace($delimiter, $encdelim, $data[$i][$j]));
                    } else {
                        $row[] = '';
                    }
                }
                echo implode($delimiter, $row)."\n";
                $i++;
            }

        }
        die;

    }

    /*
     * Returns array of content options allowed for this report's source
     *
     * @return array An array of content option names
     */
    function get_content_options() {

        $contentoptions = array();
        if(isset($this->contentoptions) && is_array($this->contentoptions)) {
            foreach($this->contentoptions as $option) {
                $contentoptions[] = $option['name'];
            }
        }
        return $contentoptions;
    }


    ///
    /// Functions for Editing Reports
    ///


    /*
     * Parses the filter options data for this source into a data structure
     * suitable for an HTML select pulldown.
     *
     * @return array An Array with $type-$value as key and $label as value
     */
    function get_filters_select() {
        $filters = $this->filteroptions;
        $ret = array();
        if(!isset($this->filteroptions)) {
            return $ret;
        }
        foreach($filters as $type => $info) {
            foreach ($info as $value => $info2) {
                $label = $info2['label'];
                $key = "{$type}-{$value}";
                $ret[$key] = $label;
            }
        }
        return $ret;
    }

    /*
     * Parses the column options data for this source into a data structure
     * suitable for an HTML select pulldown
     *
     * @return array An array with $type-$value as key and $name as value
     */
    function get_columns_select() {
        $columns = $this->columnoptions;
        $ret = array();
        if(!isset($this->columnoptions)) {
            return $ret;
        }
        foreach($columns as $type => $info) {
            foreach ($info as $value => $info2) {
                $key = "{$type}-{$value}";
                $text = $info2['name'];
                $ret[$key] = $text;
            }
        }
        return $ret;
    }

    /*
     * Given a column id, removes that column from the current report
     *
     * @param integer $cid ID of the column to be removed
     * @return boolean True on success, false otherwise
     */
    function delete_column($cid) {
        $id = $this->_id;
        begin_sql();
        $sortorder = get_field('report_builder_columns','sortorder', 'id', $cid);
        if(!$sortorder) {
            rollback_sql();
            return false;
        }
        if(!delete_records('report_builder_columns','id',$cid)) {
            rollback_sql();
            return false;
        }
        if($allcolumns = get_records('report_builder_columns', 'reportid', $id)) {
            foreach($allcolumns as $column) {
                if($column->sortorder > $sortorder) {
                    $todb = new object();
                    $todb->id = $column->id;
                    $todb->sortorder = $column->sortorder - 1;
                    if(!update_record('report_builder_columns', $todb)) {
                        rollback_sql();
                        return false;
                    }
                }
            }
        }
        commit_sql();
        $this->columns = $this->get_columns();
        return true;

    }

    /*
     * Given a filter id, removes that filter from the current report and
     * updates the sortorder for other filters
     *
     * @param integer $fid ID of the filter to be removed
     * @return boolean True on success, false otherwise
     */
    function delete_filter($fid) {
        $id = $this->_id;
        begin_sql();
        $sortorder = get_field('report_builder_filters','sortorder', 'id', $fid);
        if(!$sortorder) {
            rollback_sql();
            return false;
        }
        if(!delete_records('report_builder_filters','id',$fid)) {
            rollback_sql();
            return false;
        }
        if($allfilters = get_records('report_builder_filters', 'reportid', $id)) {
            foreach($allfilters as $filter) {
                if($filter->sortorder > $sortorder) {
                    $todb = new object();
                    $todb->id = $filter->id;
                    $todb->sortorder = $filter->sortorder - 1;
                    if(!update_record('report_builder_filters', $todb)) {
                        rollback_sql();
                        return false;
                    }
                }
            }
        }
        commit_sql();
        $this->filters = $this->get_filters();
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
        $id = $this->_id;
        begin_sql();

        // assumes sort order is well behaved (no gaps)
        if(!$itemsort = get_field('report_builder_columns', 'sortorder', 'id', $cid)) {
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
        if($neighbour = get_record('report_builder_columns', 'reportid', $id, 'sortorder', $newsort)) {
            // swap sort orders
            $todb = new object();
            $todb->id = $cid;
            $todb->sortorder = $neighbour->sortorder;
            $todb2 = new object();
            $todb2->id = $neighbour->id;
            $todb2->sortorder = $itemsort;
            if(!update_record('report_builder_columns', $todb) ||
               !update_record('report_builder_columns', $todb2)) {
                rollback_sql();
                return false;
            }
        } else {
            // no neighbour
            rollback_sql();
            return false;
        }

        commit_sql();
        $this->columns = $this->get_columns();
        return true;

    }


    /*
     * Given a filter id and a direction, moves a filter up or down
     *
     * @param integer $fid ID of the filter to be moved
     * @param string $updown String 'up' or 'down'
     * @return boolean True on success, false otherwise
     */
    function move_filter($fid, $updown) {
        $id = $this->_id;

        begin_sql();

        // assumes sort order is well behaved (no gaps)
        if(!$itemsort = get_field('report_builder_filters', 'sortorder', 'id', $fid)) {
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

        if($neighbour = get_record('report_builder_filters', 'reportid', $id, 'sortorder', $newsort)) {
            // swap sort orders
            $todb = new object();
            $todb->id = $fid;
            $todb->sortorder = $neighbour->sortorder;
            $todb2 = new object();
            $todb2->id = $neighbour->id;
            $todb2->sortorder = $itemsort;
            if(!update_record('report_builder_filters', $todb) ||
               !update_record('report_builder_filters', $todb2)) {
                rollback_sql();
                return false;
            }
        } else {
            // no neighbour
            rollback_sql();
            return false;
        }

        commit_sql();
        $this->filters = $this->get_filters();
        return true;

    }



} // End of reportbuilder class


