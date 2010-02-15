<?php

require_once("{$CFG->dirroot}/local/reportbuilder/filters/lib.php");
require_once($CFG->libdir.'/tablelib.php');

class reportbuilder {
    var $_source;
    var $_shortname;
    var $_fullname;
    var $_filters;
    var $_columns;
    var $_restriction;
    var $_id;
    var $_columnoptions;
    var $_defaultcolumns;
    var $_restrictionoptions;
    var $_defaultfilters;
    var $_joinlist;
    var $_restrictions;
    var $_base;
    var $_filtering;
    var $_params;
    var $_paramoptions;

    function reportbuilder($shortname=null, $extraparams=null) {
        global $CFG;
        if($shortname == null) {
            error(get_string('noshortname','local'));
        }

        if ($report = get_record('report_builder', 'shortname', $shortname)) {
            $this->_source = $report->source;
            $this->_shortname = $shortname;
            $this->_fullname = $report->fullname;
            $this->_filters = unserialize($report->filters);
            $this->_columns = unserialize($report->columns);
            $this->_restriction = unserialize($report->restriction);
            $this->_id = $report->id;

            // pull in data for this report
            $this->_columnoptions = $this->get_source_data('columnoptions');
            $this->_defaultcolumns = $this->get_source_data('defaultcolumns');
            $this->_defaultfilters = $this->get_source_data('defaultfilters');
            $this->_filteroptions = $this->get_source_data('filteroptions');
            $this->_joinlist = $this->get_source_data('joinlist');
            $this->_restrictionoptions = $this->get_source_data('restrictionoptions');
            $this->_base = $this->get_source_data('base');
            $this->_paramoptions = $this->get_source_data('paramoptions');
            $this->_params = $this->get_current_params();

            // generate a filter for this report
            $this->_filtering = new filtering($this, $this->get_current_url());


        } else {
            error("Report '$shortname' not found.");
        }

    }

    // get current url, minus any pagination or sort order elements
    // good for submitting forms
    function get_current_url() {
        // array of parameters to remove from query string
        $strip_params = array('spage','ssort');

        $url = new moodle_url(qualified_me());
        foreach ($url->params as $name =>$value) {
            if(in_array($name, $strip_params)) {
                $url->remove_params($name);
            }
        }
        return html_entity_decode($url->out());
    }

    function get_current_params() {
        $out = array();
        foreach ($this->_paramoptions as $name => $param) {
            $var = optional_param($name, null, PARAM_TEXT); //get as text for max flexibility
            if(isset($var)) {
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

    // get a particular type of data from the specified source
    function get_source_data($datatype) {
        global $CFG;
        $source = $this->_source;
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

    // filtering methods passed from filtering class
    function display_add() {
        $this->_filtering->display_add();
    }

    function display_active() {
        $this->_filtering->display_active();
    }

    function get_sql_filter() {
        return $this->_filtering->get_sql_filter();
    }

    // returns array of capabilities associated with this report
    function get_capability_list() {
        $restrictions = $this->_restriction;
        $capabilities = array();
        if($restrictions && is_array($restrictions)) {
            foreach ($restrictions as $restriction) {
                $capabilities[] = $restriction['capability'];
            }
        }
        return array_unique($capabilities);
    }

    // returns true if current user has one or more or required capabilities
    function is_capable() {
        $context = get_context_instance(CONTEXT_SYSTEM);
        $capabilities = $this->get_capability_list();
        // don't allow to view if no capabilities set
        $ret = false;
        if($capabilities && is_array($capabilities)) {
            // if capabilities set, require at least one
            foreach ($capabilities as $capability) {
                if(has_capability($capability, $context)) {
                    $ret = true;
                }
            }
        }
        return $ret;

    }

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

    // parses input array into set of restrictions and returns single
    // SQL WHERE snippet
    // input argument should be like this
    // $arg = array('own', 'local', 'staff');
    // that would give access to all three groups
    function get_restrictions() {
        global $CFG;
        $context = get_context_instance(CONTEXT_SYSTEM);
        // import restriction funcs
        include_once($CFG->dirroot.'/local/reportbuilder/restrictionfuncs.php');
        $restrictions = $this->_restriction;
        $queries = array();
        // start with an empty query, so default is display no results
        $queries['default'] = array();
        // go through restrictions
        // saving groups of fields together
        if(is_array($restrictions)){
            foreach ($restrictions as $restriction) {
                $funcname = $restriction['funcname'];
                $field = $restriction['field'];
                $capability = $restriction['capability'];

                if(!isset($capability) ||
                    has_capability($capability,$context)) {
                        // short circuit and show all if 'all' is set
                        if($field=='all') {
                            return "( TRUE )";
                        }

                    $func = "reportbuilder_restriction_{$funcname}";
                    if(!function_exists($func)) {
                        error("Restriction function $func does not exist");
                    }
                    $values = $func();
                    if(!empty($values)) {
                        if(isset($queries[$field])) {
                            $queries[$field] = array_merge((array)$queries[$field], (array)$values);
                        } else {
                            $queries[$field] = $values;
                        }
                    } else {
                        // add an empty query so failed match shows
                        // no results (not all results!)
                        if(!isset($queries[$field])) {
                            $queries[$field] = array();
                        }
                    }
                } else {
                    if(!isset($queries[$field])) {
                        $queries[$field] = array();
                    }
                }

            }
        }
        // now go through each grouping, reducing to unique records
        $out = array();
        foreach ($queries as $field=>$query) {
            // build query
            if(count($query) > 0) {
            $string = $field;
            $string .= " IN (";
            $string .= implode(',',array_unique((array)$query));
            $string .= ")";
            // if no entries query is false
            } else {
                $string = "false";
            }
            $out[] = $string;
        }

        // finally build the output
        if(count($out)>0) {
            return '('.implode(' OR ',$out).')';
        } else {
            return '';
        }
    }
    // generate an sql query for this report
    // if countonly is true, just returns count of query, otherwise return
    // fields as required
    function build_query($countonly=false, $filtered=false) {
        global $CFG;
        $source = $this->_source;
        $columns = $this->_columns;
        $joinlist = $this->_joinlist;
        $base = $this->_base;

        // get the fields needed to display requested columns
        $fields = $this->get_column_fields();

        // get the joins needed to display requested columns and do filtering and restrictions
        $columnjoins = $this->get_column_joins();
        $filterjoins = $this->get_filter_joins();
        $restjoins = $this->get_restriction_joins();
        $paramjoins = $this->get_param_joins();
        $joins = array_merge($columnjoins, $filterjoins, $restjoins);

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
        $from = "FROM $base ".implode($joins,' ')." ";


        // restrictions
        $restrictions = $this->get_restrictions();
        if ($restrictions != '') {
            $where = "WHERE $restrictions";
        } else {
            $where = '';
        }

        // also apply filter to query
        if($filtered===true) {
            $extrasql = $this->get_sql_filter();
            if($extrasql!='' && $where=='') {
                $where = "WHERE $extrasql";
            } else if ($extrasql!='') {
                $where = $where." AND $extrasql";
            }
        }

        // also apply parameter restrictions
        $paramrestrictions = $this->get_param_restrictions();
        if($paramrestrictions != '' && $where=='') {
            $where = "WHERE $paramrestrictions";
        } else if ($paramrestrictions != '') {
            $where = $where . " AND $paramrestrictions";
        }

        $sql = "$select $from $where";
        return $sql;
    }


    // return the total number of records in this report
    function get_full_count() {
        $sql = $this->build_query(true);
        return count_records_sql($sql);
    }

    // return the filtered number of records in this report
    function get_filtered_count() {

        $sql = $this->build_query(true, true);
        return count_records_sql($sql);

    }

    function export_data($format) {
        $columns = $this->_columns;
        $shortname = $this->_shortname;
        $count = $this->get_filtered_count();
        $sql = $this->build_query(false, true);

        // need to create flexible table object to get sort order
        // from session var
        $table = new flexible_table($shortname);
        $sort = $table->get_sql_sort($shortname);
        $order = ($sort!='') ? "ORDER BY $sort" : '';
 
        $headings = array();
        foreach($columns as $column) {
            if(isset($column['heading']) && $column['heading'] != '') {
                $headings[] = strip_tags($column['heading']);
            }
        }
        switch($format) {
            case 'ods':
                $this->download_ods($headings, $sql.$order, $count);
            case 'xls':
                $this->download_xls($headings, $sql.$order, $count);
            case 'csv':
                $this->download_csv($headings, $sql.$order, $count);
        }
        die;
    }

    function display_table() {
        define('DEFAULT_PAGE_SIZE', 40);
        define('SHOW_ALL_PAGE_SIZE', 5000);

        $spage     = optional_param('spage', 0, PARAM_INT);                    // which page to show
        $perpage   = optional_param('perpage', DEFAULT_PAGE_SIZE, PARAM_INT);
        $ssort     = optional_param('ssort');

        $columns = $this->_columns;
        $shortname = $this->_shortname;
        $countfiltered = $this->get_filtered_count();

        $sql = $this->build_query(false, true);

        foreach($columns as $column) {
            $type = $column['type'];
            $value = $column['value'];
            // don't print the column if heading is blank
            if(isset($column['heading']) && $column['heading'] != '') {
                $tablecolumns[] = "{$type}_{$value}"; // used for sorting
                $tableheaders[] = $column['heading'];
            }
        }
        $table = new flexible_table($shortname);
        $table->define_columns($tablecolumns);
        $table->define_headers($tableheaders);
        $table->column_style('edit','width','80px');
        $table->set_attribute('cellspacing', '0');
        $table->set_attribute('id', $shortname);
        $table->set_attribute('class', 'logtable generalbox');
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

        // get the ORDER BY SQL fragment from table
        $sort = $table->get_sql_sort();
        if($sort!='') {
            $order = "ORDER BY $sort";
        } else {
           $order = '';
        }
        $data = $this->fetch_data($sql.$order, $table->get_page_start(), $table->get_page_size());
        // add data to flexible table
        foreach ($data as $row) {
            $table->add_data($row);
        }

        // display the table
        $table->print_html();

    }

    function get_column_fields() {

        $source = $this->_source;
        $columns = $this->_columns;
        $columnoptions = $this->_columnoptions;
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
                    error("get_column_fields(): column value '$value' not found in source '$source' for type '$type'");
                }
            } else {
                error("get_column_fields(): column type '$type' not found in source '$source'");
            }
        }
        return $fields;

    }

    function get_param_joins() {
        $source = $this->_source;
        $params = $this->_params;
        $joinlist = $this->_joinlist;
        $joins = array();
        foreach($params as $param) {
            $param_joins = (isset($param['joins'])) ? $param['joins'] : null;
            if($param_joins && is_array($param_joins)) {
                foreach($param_joins as $param_join) {
                    if(array_key_exists($param_join, $joinlist)) {
                        $joins[$param_join] = $joinlist[$param_join];
                    } else {
                        error("get_param_joins(): join name $param_join not in joinlist");
                    }
                }
            }
        }
        return $joins;
    }

    function get_restriction_joins() {
        $source = $this->_source;
        $restrictions = $this->_restriction;
        $joinlist = $this->_joinlist;
        $joins = array();
        foreach($restrictions as $restriction) {
            $rest_joins = (isset($restriction['joins'])) ? $restriction['joins'] : null;
            if($rest_joins && is_array($rest_joins)) {
                foreach($rest_joins as $rest_join) {
                    if(array_key_exists($rest_join, $joinlist)) {
                        $joins[$rest_join] = $joinlist[$rest_join];
                    } else {
                        error("get_restriction_joins(): join name $rest_join not in joinlist");
                    }
                }
            }
        }
        return $joins;
    }


    function get_column_joins() {
        $source = $this->_source;
        $columns = $this->_columns;
        $columnoptions = $this->_columnoptions;
        $joinlist = $this->_joinlist;
        $joins = array();
        foreach($columns as $column) {
            $type = isset($column['type']) ? $column['type'] : '';

            if(array_key_exists($type, $columnoptions)) {
                $value = isset($column['value']) ? $column['value'] : '';

                if(array_key_exists($value, $columnoptions[$type])) {

                    foreach ($columnoptions[$type][$value]['joins'] as $join) {
                        if(array_key_exists($join, $joinlist)) {
                            // add any joins that are required to an array of joins
                            // because we are storing in associative array, each join
                            // is only stored once (as required)
                            $joins[$join] = $joinlist[$join];
                        } else {
                            error("get_column_joins(): join name $join not in joinlist");
                        }
                    }
                } else {
                    error("get_column_joins(): column value '$value' not found in source '$source' for type '$type'");
                }
            } else {
                error("get_column_joins(): column type '$type' not found in source '$source'");
            }
        }
        return $joins;

    }


    function get_filter_joins() {
        $shortname = $this->_shortname;
        $columnoptions = $this->_columnoptions;
        $joinlist = $this->_joinlist;
        global $SESSION;
        $joins = array();
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
                foreach($columnoptions[$type][$value]['joins'] as $join) {
                    if(array_key_exists($join, $joinlist)) {
                        $joins[$join] = $joinlist[$join];
                    } else {
                        error("get_filter_joins(): join name $join not in joinlist");
                    }
                }
            }
        }
        return $joins;

    }


    // sort function for uksort()
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

    // get 2d array of data for a given query
    function fetch_data($sql, $start=null, $size=null, $striptags=false) {
        global $CFG;
        $columns = $this->_columns;
        $columnoptions = $this->_columnoptions;

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

    function get_filters_select() {
       $filters = $this->_filteroptions;
        $ret = array();
        foreach($filters as $type => $info) {
            foreach ($info as $value => $info2) {
                $label = $info2['label'];
                $key = "{$type}-{$value}";
                $ret[$key] = $label;
            }
        }
        return $ret;
    }

    // parses the column options data structure to return an array suitable
    // for use as a select pulldown
    function get_columns_select() {
        $columns = $this->_columnoptions;
        $ret = array();
        foreach($columns as $type => $info) {
            foreach ($info as $value => $info2) {
                $key = "{$type}-{$value}";
                $text = $info2['name'];
                $ret[$key] = $text;
            }
        }
        return $ret;
    }


    // recursive version of strip_tags
    function strip_tags_r($value) {
        return is_array($value) ? array_map(array($this,'strip_tags_r'), $value) :
            strip_tags($value);
    }


    // export functions

    function export_button() {
        global $CFG;
        $url = new moodle_url(qualified_me());
        $current_params = $url->params;
        print "<div align=\"center\">";
        print_single_button($CFG->wwwroot.'/local/reportbuilder/download.php', $current_params,
            get_string('export','local'));
        print "</div>";
    }

    function download_ods($fields, $query, $count) {
        global $CFG;
        require_once("$CFG->libdir/odslib.class.php");
        $shortname = $this->_shortname;
        $filename = clean_filename($shortname.'_report.ods');

        header("Content-Type: application/download\n");
        header("Content-Disposition: attachment; filename=$filename");
        header("Expires: 0");
        header("Cache-Control: must-revalidate,post-check=0,pre-check=0");
        header("Pragma: public");


        $workbook = new MoodleODSWorkbook('-');
        $workbook->send($filename);

        $worksheet = array();

        $worksheet[0] =& $workbook->add_worksheet('');
        $col = 0;
        foreach ($fields as $fieldname) {
            $worksheet[0]->write(0, $col, $fieldname);
            $col++;
        }

        $numfields = count($fields);

        $blocksize = 1000;
        //break the data into blocks as single array gets too big
        for($k=0;$k<=floor($count/$blocksize);$k++) {
            $start = $k*$blocksize;
            $data = $this->fetch_data($query, $start, $blocksize, true);

            $row = 0;
            foreach ($data as $datarow) {
                for($col=0; $col<$numfields;$col++) {
                    if(isset($data[$row][$col])) {
                        $worksheet[0]->write($row+1+$start, $col, htmlspecialchars_decode($data[$row][$col]));
                    }
                }
                $row++;
            }
        }


        $workbook->close();
        die;
    }

    function download_xls($fields, $query, $count) {
        global $CFG;

        require_once("$CFG->libdir/excellib.class.php");

        $shortname = $this->_shortname;
        $filename = clean_filename($shortname.'_report.xls');

        header("Content-Type: application/download\n");
        header("Content-Disposition: attachment; filename=$filename");
        header("Expires: 0");
        header("Cache-Control: must-revalidate,post-check=0,pre-check=0");
        header("Pragma: public");


        $workbook = new MoodleExcelWorkbook('-');
        $workbook->send($filename);

        $worksheet = array();

        $worksheet[0] =& $workbook->add_worksheet('');
        $col = 0;
        foreach ($fields as $fieldname) {
            $worksheet[0]->write(0, $col, $fieldname);
            $col++;
        }

        $numfields = count($fields);

        $blocksize = 1000;
        // break the data into blocks as single array gets too big
        for($k=0;$k<=floor($count/$blocksize);$k++) {
            $start = $k*$blocksize;
            $data = $this->fetch_data($query, $start, $blocksize, true);

            $row = 0;
            foreach ($data as $datarow) {
                for($col=0; $col<$numfields; $col++) {
                    if(isset($data[$row][$col])) {
                        $worksheet[0]->write($row+1+$start, $col, htmlspecialchars_decode($data[$row][$col]));
                    }
                }
                $row++;
            }
        }

        $workbook->close();
        die;
    }

    function download_csv($fields, $query, $count) {
        global $CFG;
        $shortname = $this->_shortname;
        $filename = clean_filename($shortname.'_report.csv');

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
        $blocksize = 1000;
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

    function delete_column($cid) {
        $id = $this->_id;
        // generate new version of columns, minus the one to delete
        // this will update the array indices
        $newcolumns = array();
        foreach($this->_columns as $index => $column) {
            if($index != $cid) {
                $newcolumns[] = $column;
            }
        }

        // update record in db
        $todb = new object();
        $todb->id = $id;
        $todb->columns = serialize($newcolumns);
        if(update_record('report_builder', $todb)) {
            $this->_columns = $newcolumns;
            return true;
        } else {
            return false;
        }
    }

    function delete_filter($fid) {
        $id = $this->_id;
        // generate new version of filters, minus the one to delete
        // this will update the array indices
        $newfilters = array();
        foreach($this->_filters as $index => $filter) {
            if($index != $fid) {
                $newfilters[] = $filter;
            }
        }

        // update record in db
        $todb = new object();
        $todb->id = $id;
        $todb->filters = serialize($newfilters);
        if(update_record('report_builder', $todb)) {
            $this->_filters = $newfilters;
            return true;
        } else {
            return false;
        }
    }

    function move_column($cid, $updown) {
        $id = $this->_id;

        // assumes array is well behaved (indexes 0 -> N-1)
        $first = 0;
        $last = count($this->_columns)-1;
        foreach($this->_columns as $index => $column) {
            // do a down move
            if($index == $cid && $updown == 'down' && $index != $last) {
                $temp = $column;
                $this->_columns[$index] = $this->_columns[$index+1];
                $this->_columns[$index+1] = $temp;
            }
            // do an up move
            if($index == $cid && $updown == 'up' && $index != $first) {
                $temp = $column;
                $this->_columns[$index] = $this->_columns[$index-1];
                $this->_columns[$index-1] = $temp;
            }
        }
        // save results
        $todb = new object();
        $todb->id = $id;
        $todb->columns = serialize($this->_columns);
        if(update_record('report_builder',$todb)) {
            return true;
        } else {
            return false;
        }
    }


    function move_filter($fid, $updown) {
        $id = $this->_id;

        // assumes array is well behaved (indexes 0 -> N-1)
        $first = 0;
        $last = count($this->_filters)-1;
        foreach($this->_filters as $index => $filter) {
            // do a down move
            if($index == $fid && $updown == 'down' && $index != $last) {
                $temp = $filter;
                $this->_filters[$index] = $this->_filters[$index+1];
                $this->_filters[$index+1] = $temp;
            }
            // do an up move
            if($index == $fid && $updown == 'up' && $index != $first) {
                $temp = $filter;
                $this->_filters[$index] = $this->_filters[$index-1];
                $this->_filters[$index-1] = $temp;
            }
        }
        // save results
        $todb = new object();
        $todb->id = $id;
        $todb->filters = serialize($this->_filters);
        if(update_record('report_builder',$todb)) {
            return true;
        } else {
            return false;
        }
    }



} // End of reportbuilder class

///////////////////////////////////////////////////////////////////////////////////////

// returns an associative array to be used as an options list
// of the directories within a reportbuilder subdirectory
function reportbuilder_get_options_from_dir($source) {
    global $CFG;

    $ret = array();
    $dir = "{$CFG->dirroot}/local/reportbuilder/$source/";
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if(filetype($dir.$file)!='dir' || // exclude non-directories
                    $file=='.' || $file=='..' || // exclude current and parent
                    $file=='shared') { // exclude shared as this may be used in future for shared code
                    continue;
                }
                $desc = ucwords(str_replace(array('-','_'),' ',$file));
                $ret[$file] = $desc;
            }
            closedir($dh);
        }
    }
    return $ret;
}


// get a particular type of data from the specified source
// TODO combine two versions of this function

function get_source_data($source, $datatype) {
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


