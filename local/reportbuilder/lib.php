<?php

/**
 * Main Class definition and library functions for report builder
 *
 * @copyright Catalyst IT Limited
 * @author Simon Coggins
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage reportbuilder
 */

require_once("{$CFG->dirroot}/local/reportbuilder/filters/lib.php");
require_once($CFG->libdir.'/tablelib.php');
require_once($CFG->dirroot.'/local/reportbuilder/classes/rb_base_source.php');
require_once($CFG->dirroot.'/local/reportbuilder/classes/rb_base_content.php');
require_once($CFG->dirroot.'/local/reportbuilder/classes/rb_base_access.php');
require_once($CFG->dirroot.'/local/reportbuilder/classes/rb_base_preproc.php');
require_once($CFG->dirroot.'/local/reportbuilder/classes/rb_join.php');
require_once($CFG->dirroot.'/local/reportbuilder/classes/rb_column.php');
require_once($CFG->dirroot.'/local/reportbuilder/classes/rb_column_option.php');
require_once($CFG->dirroot.'/local/reportbuilder/classes/rb_filter.php');
require_once($CFG->dirroot.'/local/reportbuilder/classes/rb_filter_option.php');
require_once($CFG->dirroot.'/local/reportbuilder/classes/rb_param.php');
require_once($CFG->dirroot.'/local/reportbuilder/classes/rb_param_option.php');
require_once($CFG->dirroot.'/local/reportbuilder/classes/rb_content_option.php');

/**
 * Name of directories containing report builder source files
 */
define('SOURCE_DIR_NAME', 'rb_sources');

/**
 * Confirmation codes for displaying notices after specific page actions
 */
define('REPORT_BUILDER_UNKNOWN_BUTTON_CLICKED', 1);
define('REPORT_BUILDER_FAILED_DELETE_SESSKEY', 2);

define('REPORT_BUILDER_REPORT_CONFIRM_DELETE', 3);
define('REPORT_BUILDER_REPORT_FAILED_DELETE', 4);

define('REPORT_BUILDER_GENERAL_CONFIRM_UPDATE', 5);
define('REPORT_BUILDER_GENERAL_FAILED_UPDATE', 6);

define('REPORT_BUILDER_COLUMNS_CONFIRM_SHOWHIDE', 7);
define('REPORT_BUILDER_COLUMNS_FAILED_SHOWHIDE', 8);
define('REPORT_BUILDER_COLUMNS_CONFIRM_DELETE', 9);
define('REPORT_BUILDER_COLUMNS_FAILED_DELETE', 10);
define('REPORT_BUILDER_COLUMNS_CONFIRM_MOVE', 11);
define('REPORT_BUILDER_COLUMNS_FAILED_MOVE', 12);
define('REPORT_BUILDER_COLUMNS_CONFIRM_UPDATE', 13);
define('REPORT_BUILDER_COLUMNS_FAILED_UPDATE', 14);

define('REPORT_BUILDER_FILTERS_CONFIRM_DELETE', 15);
define('REPORT_BUILDER_FILTERS_FAILED_DELETE', 16);
define('REPORT_BUILDER_FILTERS_CONFIRM_MOVE', 17);
define('REPORT_BUILDER_FILTERS_FAILED_MOVE', 18);
define('REPORT_BUILDER_FILTERS_CONFIRM_UPDATE', 19);
define('REPORT_BUILDER_FILTERS_FAILED_UPDATE', 20);

define('REPORT_BUILDER_CONTENT_CONFIRM_UPDATE', 21);
define('REPORT_BUILDER_CONTENT_FAILED_UPDATE', 22);

define('REPORT_BUILDER_ACCESS_CONFIRM_UPDATE', 23);
define('REPORT_BUILDER_ACCESS_FAILED_UPDATE', 24);

define('REPORT_BUILDER_GLOBAL_CONFIRM_UPDATE', 25);
define('REPORT_BUILDER_GLOBAL_FAILED_UPDATE', 26);

/**
 * Export option codes
 *
 * Bitwise flags, so new ones should be double highest value
 */
define('REPORT_BUILDER_EXPORT_EXCEL', 1);
define('REPORT_BUILDER_EXPORT_CSV', 2);
define('REPORT_BUILDER_EXPORT_ODS', 4);
define('REPORT_BUILDER_EXPORT_FUSION', 8);

global $REPORT_BUILDER_EXPORT_OPTIONS;
$REPORT_BUILDER_EXPORT_OPTIONS = array(
    'xls' => REPORT_BUILDER_EXPORT_EXCEL,
    'csv' => REPORT_BUILDER_EXPORT_CSV,
    'ods' => REPORT_BUILDER_EXPORT_ODS,
    'fusion' => REPORT_BUILDER_EXPORT_FUSION,
);

/**
 * Main report builder object class definition
 */
class reportbuilder {
    public $fullname, $shortname, $source, $hidden, $filters, $filteroptions, $columns, $requiredcolumns;
    public $columnoptions, $_filtering, $contentoptions, $contentmode, $embeddedurl, $description;
    public $_id, $recordsperpage, $defaultsortcolumn, $defaultsortorder;
    private $_joinlist, $_base, $_params, $_sid;
    private $_paramoptions, $_embeddedparams, $_fullcount, $_filteredcount;
    public $src, $grouped;

    /**
     * Constructor for reportbuilder object
     *
     * Generates a new reportbuilder report instance.
     *
     * Requires either a valid ID or shortname as parameters.
     *
     * @param integer $id ID of the report to generate
     * @param string $shortname Shortname of the report to generate
     * @param object $embed Object containing settings for an embedded report
     * @param integer $sid Saved search ID if displaying a saved search
     *
     */
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
            error(get_string('noshortnameorid','local_reportbuilder'));
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
            $this->src = self::get_source_object($this->source);
            $this->shortname = stripslashes($report->shortname);
            $this->fullname = stripslashes($report->fullname);
            $this->hidden = $report->hidden;
            $this->description = stripslashes($report->description);
            $this->contentmode = $report->contentmode;
            $this->embeddedurl = $report->embeddedurl;
            $this->recordsperpage = $report->recordsperpage;
            $this->defaultsortcolumn = $report->defaultsortcolumn;
            $this->defaultsortorder = $report->defaultsortorder;
            $this->_sid = $sid;
            // assume no grouping initially
            $this->grouped = false;

            // pull in data for this report from the source
            $this->_base = $this->src->base . ' base';
            $this->_joinlist = $this->src->joinlist;
            $this->columnoptions = $this->src->columnoptions;
            $this->filteroptions = $this->src->filteroptions;
            $this->_paramoptions = $this->src->paramoptions;
            $this->contentoptions = $this->src->contentoptions;
            $this->requiredcolumns = $this->src->requiredcolumns;
            $this->columns = $this->get_columns();
            $this->filters = $this->get_filters();

        } else {
            error("Report with id of '$id' not found in database.");
        }

        if($embed) {
            $this->_embeddedparams = $embed->embeddedparams;
        }
        $this->_params = $this->get_current_params();

        if($sid) {
            $this->restore_saved_search();
        }


    }


    /**
     * Include javascript code needed by report builder
     */
    function include_js() {
        global $CFG;
        require_once($CFG->dirroot.'/local/js/lib/setup.php');

        $this->get_filtering();

        $dialog = false;
        $treeview = false;

        // only include show/hide code for tabular reports
        $js = array();
        $graph = (substr($this->source, 0,
            strlen('graphical_feedback_questions')) ==
            'graphical_feedback_questions');
        if(!$graph) {
            $js['showhide'] = $CFG->wwwroot.'/local/reportbuilder/showhide.js.php';
            $dialog = true;
        }

        // include JS for dialogs if required for filters
        $orgtrees = array();
        $postrees = array();
        $comptrees = array();
        foreach($this->filters as $filter) {
            switch($filter->filtertype) {
            case 'org':
                $orgtrees[] = "'{$filter->type}-{$filter->value}'";
                $js['dialog'] = $CFG->wwwroot . '/local/reportbuilder/tree_dialogs.js.php';
                $dialog = $treeview = true;
                break;
            case 'pos':
                $postrees[] = "'{$filter->type}-{$filter->value}'";
                $js['dialog'] = $CFG->wwwroot . '/local/reportbuilder/tree_dialogs.js.php';
                $dialog = $treeview = true;
                break;
            case 'comp':
                $comptrees[] = "'{$filter->type}-{$filter->value}'";
                $js['dialog'] = $CFG->wwwroot . '/local/reportbuilder/tree_dialogs.js.php';
                $dialog = $treeview = true;
                break;
            default:
            }
        }


        $code = array();
        if($dialog) {
            $code[] = TOTARA_JS_DIALOG;
        }
        if($treeview) {
            $code[] = TOTARA_JS_TREEVIEW;
        }


        local_js($code);
        if(count($js)) {
            require_js(array_values($js));
        }

        if($dialog) {
            print '
<script type="text/javascript">
var orgtree = [' . implode(', ', $orgtrees) . '];
var postree = [' . implode(', ', $postrees) . '];
var comptree = [' . implode(', ', $comptrees) . '];
</script>';
        }
    }

    /**
     * Generate a filtering object for this report
     *
     * This does quite a few small SQL queries so load it lazily only when required.
     *
     * @return boolean True if set, false if has been set previously
     */
    function get_filtering() {
        if($this->_filtering === null) {
            $this->_filtering = new filtering($this, $this->get_current_url());
            return true;
        }
        return false;
    }


    /**
     * Method for debugging SQL statement generated by report builder
     */
    function debug($level=1) {
        $context = get_context_instance(CONTEXT_SYSTEM);
        if(!has_capability('moodle/site:doanything', $context)) {
            return false;
        }
        print '<div style="border: 1px solid black; background-color: #ffc; padding: 10px;">';
        print '<h3>Query:</h3>';
        print '<pre>';
        print_r($this->build_query(false, true));
        print '</pre>';
        if($level>1) {
            print '<h3>Reportbuilder Object</h3>';
            var_dump($this);
        }
        print '</div>';
    }

    /**
     * Searches for and returns an instance of the specified preprocessor class
     * for a particular activity group
     *
     * @param string $preproc The name of the preproc class to return
     *                       (excluding the rb_preproc prefix)
     * @param integer $groupid The group id to create the preprocessor for
     * @return object An instance of the preproc. Returns false if
     *                the preproc can't be found
     */
    static function get_preproc_object($preproc, $groupid) {
        $sourcepaths = self::find_source_dirs();
        foreach($sourcepaths as $sourcepath) {
            $classfile = $sourcepath . 'rb_preproc_' . $preproc . '.php';
            if(is_readable($classfile)) {
                include_once($classfile);
                $classname = 'rb_preproc_'.$preproc;
                if(class_exists($classname)) {
                    return new $classname($groupid);
                }
            }
        }
        return false;
    }

    /**
     * Searches for and returns an instance of the specified source class
     *
     * @param string $source The name of the source class to return
     *                       (excluding the rb_source prefix)
     * @return object An instance of the source. Returns false if
     *                the source can't be found
     */
    static function get_source_object($source) {
        $sourcepaths = self::find_source_dirs();
        foreach($sourcepaths as $sourcepath) {
            $classfile = $sourcepath . 'rb_source_' . $source . '.php';
            if(is_readable($classfile)) {
                include_once($classfile);
                $classname = 'rb_source_'.$source;
                if(class_exists($classname)) {
                    return new $classname();
                }
            }
        }

        // if exact match not found, look for match with group suffix
        // of the form: [sourcename]_grp_[grp_id]
        // if found, call the base source passing the groupid as an argument
        if(preg_match('/^(.+)_grp_([0-9]+)$/', $source, $matches)) {
            $basesource = $matches[1];
            $groupid = $matches[2];
            foreach($sourcepaths as $sourcepath) {
                $classfile = $sourcepath . 'rb_source_' . $basesource . '.php';
                if(is_readable($classfile)) {
                    include_once($classfile);
                    $classname = 'rb_source_' . $basesource;
                    if(class_exists($classname)) {
                        return new $classname($groupid);
                    }
                }
            }
        }

        // if still not found, look for match with group suffix
        // of the form: [sourcename]_grp_all
        // if found, call the base source passing a groupid of 0 as an argument
        if(preg_match('/^(.+)_grp_all$/', $source, $matches)) {
            $basesource = $matches[1];
            foreach($sourcepaths as $sourcepath) {
                $classfile = $sourcepath . 'rb_source_' . $basesource . '.php';
                if(is_readable($classfile)) {
                    include_once($classfile);
                    $classname = 'rb_source_' . $basesource;
                    if(class_exists($classname)) {
                        return new $classname(0);
                    }
                }
            }
        }


        // bad source
        throw new ReportBuilderException("Source '$source' not found");
    }

    /**
     * Searches codebase for report builder source files and returns a list
     *
     * @return array Associative array of all available sources, formatted
     *               to be used in a select element.
     */
    static function get_source_list() {
        $output = array();

        foreach(self::find_source_dirs() as $dir) {
            if(is_dir($dir) && $dh = opendir($dir)) {
                while(($file = readdir($dh)) !== false) {
                    if(is_dir($file) ||
                    !preg_match('|^rb_source_(.*)\.php$|', $file, $matches)) {
                        continue;
                    }
                    $source = $matches[1];
                    $sourcename = ucwords(str_replace(array('-','_'), ' ', $source));
                    $src = reportbuilder::get_source_object($source);
                    $preproc = $src->preproc;

                    if($src->grouptype == 'all') {
                        $sourcestr = $source . '_grp_all';
                        $output[$sourcestr] = $sourcename;
                    } else if($src->grouptype != 'none') {
                        // create a source for every group that's based on
                        // this source's preprocessor
                        if($groups = get_records('report_builder_group',
                            'preproc', $preproc)) {
                            foreach($groups as $group) {
                                $sourcestr = $source . '_grp_' . $group->id;
                                $output[$sourcestr] = $sourcename . ': ' . $group->name;
                            }
                        }
                    } else {
                        // otherwise, just create a single source
                        $output[$source] = $sourcename;
                    }
                }
                closedir($dh);
            }
        }

        return $output;
    }

    /**
     * Recursively locates source directories with in the current source search paths
     *
     * Uses $SOURCE_SEARCH_PATH and SOURCE_DIR_NAME to choose where to look
     * and what to match against.
     *
     * @return array An array of paths to source directories
     */
    static function find_source_dirs() {
        global $CFG;
        // list of directories to look in for source classes
        // from dirroot, include leading slash
        $SOURCE_SEARCH_PATH = array('/local','/mod');
        $sourcepaths = array();
        foreach($SOURCE_SEARCH_PATH as $path) {
            $sourcepaths = array_merge($sourcepaths,
                self::glob_r(SOURCE_DIR_NAME, GLOB_ONLYDIR|GLOB_MARK, $CFG->dirroot.$path));
        }

        return $sourcepaths;
    }

    /**
     * Recursive version of the glob() function
     *
     * Finds files or directories the match a pattern by recursively searching the
     * specified path
     *
     * @param string $pattern Pattern to match against
     * @param integer $flags Flags to pass to glob function
     * @param string $path Path to start search from
     * @returns array An array of matching paths
     */
    static function glob_r($pattern='*', $flags = 0, $path='') {
        $paths = glob($path.'*', GLOB_MARK|GLOB_ONLYDIR|GLOB_NOSORT);
        $files = glob($path.$pattern, $flags);
        foreach ($paths as $path) {
            $files = array_merge($files, self::glob_r($pattern, $flags, $path));
        }
        return $files;
    }

    /**
     * Reduces an array of objects to those that match all specified conditions
     *
     * @param array $items An array of objects to reduce
     * @param array $conditions An associative array of conditions.
     *                          key is the object's property, value is the value
     *                          to match against
     * @param boolean $multiple If true, returns all matches, as an array,
     *                          otherwise returns first match as an object
     *
     * @return mixed An array of objects or a single object that match all
     *               the conditions
     */
    function reduce_items($items, $conditions, $multiple=true) {
        if(!is_array($items)) {
            throw new ReportBuilderException('Input not an array');
        }
        if(!is_array($conditions)) {
            throw new ReportBuilderException('Conditions not an array');
        }
        $output = array();
        foreach($items as $item) {
            $status = true;
            foreach($conditions as $name => $value) {
                // condition fails if property missing
                if (!property_exists($item, $name)) {
                    $status = false;
                    break;
                }
                if ($item->$name != $value) {
                    $status = false;
                    break;
                }
            }
            if($status && $multiple) {
                $output[] = $item;
            } else if ($status) {
                return $item;
            }
        }
        return $output;
    }

    static function get_single_item($items, $type, $value) {
        $cond = array('type' => $type, 'value' => $value);
        return self::reduce_items($items, $cond, false);
    }


    /**
     * Check the joins provided are in the joinlist
     *
     * @param array $joinlist Join list to check for joins
     * @param mixed $joins Single, or array of joins to check
     * @returns boolean True if all specified joins are in the list
     *
     */
    static function check_joins($joinlist, $joins) {
        // nothing to check
        if($joins === null) {
            return true;
        }

        // get array of available names from join list provided
        $joinnames = array('base');
        foreach($joinlist as $item) {
            $joinnames[] = $item->name;
        }

        // return false if any listed joins don't exist
        if(is_array($joins)) {
            foreach($joins as $join) {
                if(!in_array($join, $joinnames)) {
                    return false;
                }
            }
        } else {
            if(!in_array($joins, $joinnames)) {
                return false;
            }
        }
        return true;
    }


    /**
     * Looks up the saved search ID specified and attempts to restore
     * the SESSION variable if access is permitted
     *
     * @return Boolean True if user can view, error otherwise
     */
    function restore_saved_search() {
        global $SESSION,$USER;
        $this->get_filtering();
        $filtername = 'filtering_'.$this->shortname;
        if($saved = get_record('report_builder_saved','id',$this->_sid)) {
            if($saved->ispublic != 0 || $saved->userid == $USER->id) {
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

    /**
     * Gets any filters set for the current report from the database
     *
     * @return array Array of filters for current report or empty array if none set
     */
    function get_filters() {
        $out = array();
        $id = isset($this->_id) ? $this->_id : null;
        if(empty($id)) {
            return $out;
        }
        if($filters = get_records('report_builder_filters','reportid', $id, 'sortorder')) {
            foreach ($filters as $filter) {
                try {
                    $out[$filter->id] = $this->src->new_filter_from_option(
                        $filter->type,
                        $filter->value,
                        $filter->advanced
                    );
                    // enabled report grouping if any filters are grouped
                    if($out[$filter->id]->grouping != 'none') {
                        $this->grouped = true;
                    }
                } catch (ReportBuilderException $e) {
                    trigger_error($e->getMessage(), E_USER_WARNING);
                }
            }
        }
        return $out;
    }

    /**
     * Gets any columns set for the current report from the database
     *
     * @return array Array of columns for current report or empty array if none set
     */
    function get_columns() {
        $out = array();
        $id = isset($this->_id) ? $this->_id : null;
        if(empty($id)) {
            return $out;
        }
        if($columns = get_records('report_builder_columns',
            'reportid', $id, 'sortorder')) {
            foreach ($columns as $column) {
                try {
                    $out[$column->id] = $this->src->new_column_from_option(
                        $column->type,
                        $column->value,
                        $column->heading,
                        $column->hidden
                    );
                    // enabled report grouping if any columns are grouped
                    if($out[$column->id]->grouping != 'none') {
                        $this->grouped = true;
                    }
                }
                catch (ReportBuilderException $e) {
                    trigger_error($e->getMessage(), E_USER_WARNING);
                }
            }
        }

        // now append any required columns
        if(is_array($this->requiredcolumns)) {
            foreach($this->requiredcolumns as $column) {
                $column->required = true;
                $out[] = $column;
                // enabled report grouping if any columns are grouped
                if($column->grouping != 'none') {
                    $this->grouped = true;
                }
            }
        }

        return $out;
    }

    /**
     * Creates a database entry for an embedded report when it is first viewed
     * so the settings can be edited
     *
     * @param string $shortname The unique name for this embedded report
     * @param object $embed An object containing the embedded reports settings
     * @param string &$error Error string to return on failure
     *
     * @return boolean ID of new database record, or false on failure
     */
    function create_embedded_record($shortname, $embed, &$error) {
        global $CFG;
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
        // store URL after wwwroot
        $todb->embeddedurl = substr(qualified_me(), strlen($CFG->wwwroot));

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

        // add content restrictions
        foreach($embed->contentsettings as $option => $settings) {
            $classname = 'rb_' . $option . '_content';
            if(class_exists($classname)) {
                foreach($settings as $name => $value) {
                    if(!reportbuilder::update_setting($newid, $classname, $name,
                        $value)) {
                        rollback_sql();
                        $error = 'Error inserting content restrictions';
                        return false;
                    }
                }
            }
        }

        // add access restrictions
        foreach($embed->accesssettings as $option => $settings) {
            $classname = $option . '_access';
            if(class_exists($classname)) {
                foreach($settings as $name => $value) {
                    if(!reportbuilder::update_setting($newid, $classname, $name,
                        $value)) {
                        rollback_sql();
                        $error = 'Error inserting access restrictions';
                        return false;
                    }
                }
            }
        }

        commit_sql();
        return $newid;
    }

    /**
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


    /**
     * Return the URL to view the current report
     *
     * @return string URL of current report
     */
    function report_url() {
        global $CFG;
        if($this->embeddedurl === null) {
            return $CFG->wwwroot.'/local/reportbuilder/report.php?id='.$this->_id;
        } else {
            return $CFG->wwwroot . $this->embeddedurl;
        }
    }


    /**
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


    /**
     * Returns an array of arrays containing information about any currently
     * set URL parameters. Used to determine which joins are required to
     * match against URL parameters
     *
     * @return array Array of set URL parameters and their values
     */
    function get_current_params() {
        $out = array();
        if(empty($this->_paramoptions)) {
            return $out;
        }
        foreach ($this->_paramoptions as $param) {
            $name = $param->name;
            $var = optional_param($name, null, PARAM_TEXT);

            if(isset($this->_embeddedparams[$name])) {
                // embedded params take priority over url params
                $res = new rb_param($name, $this->_paramoptions);
                $res->value = $this->_embeddedparams[$name];
                $out[] = $res;
            } else if(isset($var)) {
                // this url param exists, add to params to use
                $res = new rb_param($name, $this->_paramoptions);
                $res->value = $var; // save the value
                $out[] = $res;
            }

        }
        return $out;
    }


    /**
     * Wrapper for displaying search form from filtering class
     *
     * @return Nothing returned but prints the search box
     */
    function display_search() {
        $this->get_filtering();
        $this->_filtering->display_add();
    }

    /**
     * Wrapper for displaying active filter from filtering class
     * No longer used as filtering behaviour modified to be
     * more like a search
     *
     * @return Nothing returned but prints active filters
     */
    function get_sql_filter() {
        $this->get_filtering();
        return $this->_filtering->get_sql_filter();
    }



    /** Returns true if the current user has permission to view this report
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

        $any = false;
        $all = true;
        // loop round classes, only considering classes that extend rb_base_access
        foreach(get_declared_classes() as $class) {
            if(is_subclass_of($class, 'rb_base_access')) {
                // remove rb_ prefix
                $settingname = substr($class, 3);
                $obj = new $class();
                // is this option enabled?
                if(reportbuilder::get_setting($id, $settingname, 'enable')) {
                    // does user have permission for this access option?
                    $allowed = $obj->access_restriction($id);
                    $any = $any || $allowed;
                    $all = $all && $allowed;
                }
            }
        }

        if($accessmode == 1) {
            // any enabled options can be true
            return $any;
        } else {
            // all enabled options must be true
            return $all;
        }

    }

    /**
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
                $field = $param->field;
                $value = $param->value;
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


    /**
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

        $reportid = $this->_id;
        $out = array();

        // go through the content options
        if(isset($this->contentoptions) && is_array($this->contentoptions)) {
            foreach($this->contentoptions as $option) {
                $name = $option->classname;
                $classname = 'rb_' . $name . '_content';
                $settingname = $name . '_content';
                $field = $option->field;
                if(class_exists($classname)) {
                    $class = new $classname();
                    if(reportbuilder::get_setting($reportid, $settingname,
                        'enable')) {
                        // this content option is enabled
                        // call function to get SQL snippet
                        $out[] = $class->sql_restriction($field, $reportid);
                    }
                } else {
                    error("Content class $classname does not exist");
                }
            }
        }
        // show nothing if no content restrictions enabled
        if(count($out)==0) {
            return '(FALSE)';
        }
        return '('.implode($op, $out).')';
    }

    /**
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
        $reportid = $this->_id;
        $res = array();
        if($this->contentmode != 0) {
            foreach($this->contentoptions as $option) {
                $name = $option->classname;
                $classname = 'rb_' . $name . '_content';
                $settingname = $name . '_content';
                $title = $option->title;
                if(class_exists($classname)) {
                    $class = new $classname();
                    if(reportbuilder::get_setting($reportid, $settingname,
                        'enable')) {
                        // this content option is enabled
                        // call function to get text string
                        $res[] = $class->text_restriction($title, $reportid);
                    }
                } else {
                    error("Content class function $classname does not exist");
                }
            }
            if($this->contentmode == 2) {
                // 'and' show one per line
                $content_restrictions = $res;
            } else {
                // 'or' show as a single line
                $content_restrictions[] = implode(get_string('or','local_reportbuilder'), $res);
            }
        }

        $this->get_filtering();
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




    /**
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
        $fields = array();
        $src = $this->src;
        foreach($this->columns as $column) {
            $fields = array_merge($fields, $column->get_fields($src));
        }
        return $fields;
    }


    /**
     * Returns the names of all the joins in the joinlist
     *
     * @return array Array of join names from the joinlist
     */
    function get_joinlist_names() {
        $joinlist = $this->_joinlist;
        $joinnames = array();
        foreach($joinlist as $item) {
            $joinnames[] = $item->name;
        }
        return $joinnames;
    }


    /**
     * Return a join from the joinlist by name
     *
     * @param string $name Join name to get from the join list
     *
     * @return object {@link rb_join} object for the matching join, or false
     */
    function get_joinlist_item($name) {
        $joinlist = $this->_joinlist;
        foreach($joinlist as $item) {
            if($item->name == $name) {
                return $item;
            }
        }
        return false;
    }


    /**
     * Given an item, returns an array of {@link rb_join} objects needed by this item
     *
     * @param object $item An object containing a 'joins' property
     * @param string $usage The function is called to obtain joins for various
     *                     different elements of the query. The usage is displayed
     *                     in the error message to help with debugging
     * @return array An array of {@link rb_join} objects used to build the join part of the query
     */
    function get_joins($item, $usage) {
        $output = array();

        // extract the list of joins into an array format
        if(isset($item->joins) && is_array($item->joins)) {
            $joins = $item->joins;
        } else if (isset($item->joins)) {
            $joins = array($item->joins);
        } else {
            $joins = array();
        }

        foreach($joins as $join) {
            if($join == 'base') {
                continue;
            }
            $joinobj = $this->get_single_join($join, $usage);
            $output[] = $joinobj;

            $this->get_dependency_joins($output, $joinobj);

        }

        return $output;
    }

    /**
     * Given a join name, look for it in the joinlist and return the join object
     *
     * @param string $join A single join name (should match joinlist item name)
     * @param string $usage The function is called to obtain joins for various
     *                      different elements of the query. The usage is
     *                      displayed in the error message to help with debugging
     * @return string An rb_join object for the specified join, or error
     */
    function get_single_join($join, $usage) {

        if($match = $this->get_joinlist_item($join)) {
            // return the join object for the item
            return $match;
        } else {
            error("'{$join}' not in join list for {$usage}");
            return false;
        }
    }

    /**
     * Recursively build an array of {@link rb_join} objects that includes all
     * dependencies
     */
    function get_dependency_joins(&$joins, $joinobj) {

        // get array of dependencies, excluding references to the
        // base table
        if(isset($joinobj->dependencies)
            && is_array($joinobj->dependencies)) {

            $dependencies = array();
            foreach($joinobj->dependencies as $item) {
                // ignore references to base as a dependency
                if($item == 'base') {
                    continue;
                }
                $dependencies[] = $item;
            }
        } else if (isset($joinobj->dependencies)
                && $joinobj->dependencies != 'base') {

            $dependencies = array($joinobj->dependencies);
        } else {
            $dependencies = array();
        }

        // loop through dependencies, adding any that aren't already
        // included
        foreach($dependencies as $dependency) {
            $joinobj = $this->get_single_join($dependency, 'dependencies');
            if(in_array($joinobj, $joins)) {
                // prevents infinite loop if dependencies include
                // circular references
                continue;
            }
            // add to list of current joins
            $joins[] = $joinobj;

            // recursively get dependencies of this dependency
            $this->get_dependency_joins($joins, $joinobj);
        }

    }


    /**
     * Return an array of {@link rb_join} objects containing the joins required by
     * the current enabled content restrictions
     *
     * @return array An array of {@link rb_join} objects containing join information
     */
    function get_content_joins() {
        $reportid = $this->_id;

        if($this->contentmode == 0) {
            // no limit on content so no joins necessary
            return array();
        }
        $contentjoins = array();
        foreach($this->contentoptions as $option) {
            $name = $option->classname;
            $classname = 'rb_' . $name . '_content';
            if(class_exists($classname)) {
                if(reportbuilder::get_setting($reportid, $name . '_content', 'enable')) {
                    // this content option is enabled
                    // get required joins
                    $contentjoins = array_merge($contentjoins,
                        $this->get_joins($option, 'content'));
                }
            }
        }
        return $contentjoins;
    }


    /**
     * Return an array of {@link rb_join} objects containing the joins required by
     * the current column list
     *
     * @return array An array of {@link rb_join} objects containing join information
     */
    function get_column_joins() {
        $coljoins = array();
        foreach($this->columns as $column) {
            $coljoins = array_merge($coljoins,
                $this->get_joins($column, 'column'));
        }
        return $coljoins;
    }

    /**
     * Return an array of {@link rb_join} objects containing the joins required by
     * the current param list
     *
     * @return array An array of {@link rb_join} objects containing join information
     */
    function get_param_joins() {
        $paramjoins = array();
        foreach($this->_params as $param) {
            $value = $param->value;
            // don't include joins if param not set
            if(!isset($value) || $value=='') {
                continue;
            }
            $paramjoins = array_merge($paramjoins,
                $this->get_joins($param, 'param'));
        }
        return $paramjoins;
    }

    /**
     * Check the current session for active filters, and if found
     * collect together join data into a format suitable for {@link get_joins()}
     *
     * @return array An array of arrays containing filter join information
     */
    function get_filter_joins() {
        $shortname = $this->shortname;
        $columnoptions = $this->columnoptions;
        global $SESSION;
        $this->get_filtering();
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
                $item = $this->get_single_item($columnoptions, $type, $value);
                $filterjoins = array_merge($filterjoins,
                    $this->get_joins($item, 'filter'));
            }
        }
        return $filterjoins;
    }


    /**
     * Given an array of {@link rb_join} objects, convert them into an SQL snippet
     *
     * @param array $joins Array of {@link rb_join} objects
     *
     * @return string SQL snippet that includes all the joins in the order provided
     */
    function get_join_sql($joins) {
        $out = array();

        foreach($joins as $join) {
            $name = $join->name;
            $type = $join->type;
            $table = $join->table;
            $conditions = $join->conditions;

            if(array_key_exists($name, $out)) {
                // we've already added this join
                continue;
            }
            // store in associative array so we can tell which
            // joins we've already added
            $out[$name] = "$type JOIN $table $name\n        ON $conditions";
        }
        return implode("\n    ", $out) . " \n";
    }


    /**
     * Sort an array of {@link rb_join} objects
     *
     * Given an array of {@link rb_join} objects, sorts them such that:
     * - any duplicate joins are removed
     * - any joins with dependencies appear after those dependencies
     *
     * This is achieved by repeatedly looping through the list of
     * joins, moving joins to the sorted list only when all their
     * dependencies are already in the sorted list.
     *
     * On the first pass any joins that have no dependencies are
     * saved to the sorted list and removed from the current list.
     *
     * References to the moved items are then removed from the
     * dependencies lists of all the remaining items and the loop
     * is repeated.
     *
     * The loop continues until there is an iteration where no
     * more items are removed. At this point either:
     * - The current list is empty
     * - There are references to joins that don't exist
     * - There are circular references
     *
     * In the later two cases we throw an error, otherwise return
     * the sorted list.
     *
     * @param array Array of {@link rb_join} objects to be sorted
     *
     * @return array Sorted array of {@link rb_join} objects
     */
    function sort_joins($unsortedjoins) {

        // get structured list of dependencies for each join
        $items = $this->get_dependencies_array($unsortedjoins);

        // make an index of the join objects with name as key
        $joinsbyname = array();
        foreach($unsortedjoins as $join) {
            $joinsbyname[$join->name] = $join;
        }

        // loop through items, storing any that don't have
        // dependencies in the output list

        // safety net to avoid infinite loop if something
        // unexpected happens
        $maxdepth = 50;
        $i = 0;
        $output = array();
        while($i < $maxdepth) {

            // items with empty dependencies array
            $nodeps = $this->get_independent_items($items);

            foreach($nodeps as $nodep) {
                $output[] = $joinsbyname[$nodep];
                unset($items[$nodep]);
                // remove references to this item from all
                // the other dependency lists
                $this->remove_from_dep_list($items, $nodep);
            }

            // stop when no more items can be removed
            // if all goes well, this will be after all items
            // have been removed
            if(count($nodeps) == 0) {
                break;
            }

            $i++;
        }

        // we shouldn't have any items left once we've left the loop
        if(count($items) != 0) {
            error('Could not sort join list. Source either contains ' .
                'circular dependencies or references a none-existent join');
        }

        return $output;
    }


    /**
     * Remove joins that have no impact on the results count
     *
     * Given an array of {@link rb_join} objects we want to return a similar list,
     * but with any joins that have no effect on the count removed. This is
     * done for performance reasons when calculating the count.
     *
     * The only joins that can be safely removed match the following criteria:
     * 1- Only LEFT joins are safe to remove
     * 2- Even LEFT joins are unsafe, unless the relationship is either
     *   One-to-one or many-to-one
     * 3- The join can't have any dependencies that don't also match the
     *   criteria above: e.g.:
     *
     *   base LEFT JOIN table_a JOIN table_b
     *
     *   Table_b can't be removed because it fails criteria 1. Table_a
     *   can't be removed, even though it passes criteria 1 and 2, because
     *   table_b is dependent on it.
     *
     * To achieve this result, we use a similar strategy to sort_joins().
     * As a side effect, duplicate joins are removed but note that this
     * method doesn't change the sort order of the joins provided.
     *
     * @param array $unprunedjoins Array of rb_join objects to be pruned
     *
     * @return array Array of {@link rb_join} objects, minus any joins
     *               that don't affect the total record count
     */
    function prune_joins($unprunedjoins) {
        // get structured list of dependencies for each join
        $items = $this->get_dependencies_array($unprunedjoins);

        // make an index of the join objects with name as key
        $joinsbyname = array();
        foreach($unprunedjoins as $join) {
            $joinsbyname[$join->name] = $join;
        }

        // safety net to avoid infinite loop if something
        // unexpected happens
        $maxdepth = 100;
        $i = 0;
        $output = array();
        while($i < $maxdepth) {
            $prunecount = 0;
            // items with empty dependencies array
            $nodeps = $this->get_independent_items($items);
            foreach($nodeps as $nodep) {
                if($joinsbyname[$nodep]->pruneable()) {
                    unset($items[$nodep]);
                    $this->remove_from_dep_list($items, $nodep);
                    unset($joinsbyname[$nodep]);
                    $prunecount++;
                }
            }

            // stop when no more items can be removed
            if($prunecount == 0) {
                break;
            }

            $i++;
        }

        return array_values($joinsbyname);
    }


    /**
     * Reformats an array of {@link rb_join} objects to a structure helpful for managing dependencies
     *
     * Saves the dependency info in the following format:
     *
     * array(
     *    'name1' => array('dep1', 'dep2'),
     *    'name2' => array('dep3'),
     *    'name3' => array(),
     *    'name4' => array(),
     * );
     *
     * This has the effect of:
     * - Removing any duplicate joins (joins with the same name)
     * - Removing any references to 'base' in the dependencies list
     * - Converting null dependencies to array()
     * - Converting string dependencies to array('string')
     *
     * @param array $joins Array of {@link rb_join} objects
     *
     * @return array Array of join dependencies
     */
    private function get_dependencies_array($joins){
        $items = array();
        foreach($joins as $join) {

            // group joins in a more consistent way and remove all
            // references to 'base'
            if(is_array($join->dependencies)) {
                $deps = array();
                foreach($join->dependencies as $dep) {
                    if($dep == 'base') {
                        continue;
                    }
                    $deps[] = $dep;
                }
                $items[$join->name] = $deps;
            } else if (isset($join->dependencies)
                && $join->dependencies != 'base') {
                $items[$join->name] = array($join->dependencies);
            } else {
                $items[$join->name] = array();
            }
        }
        return $items;
    }


    /**
     * Remove references to a particular join from the
     * join dependencies list
     *
     * Given a list of join dependencies (as generated by
     * get_dependencies_array() ) remove all references to
     * the join named $joinname
     *
     * @param array &$items Array of dependencies. Passed by ref
     * @param string $joinname Name of join to remove from list
     *
     * @return true;
     */
    private function remove_from_dep_list(&$items, $joinname) {
        foreach($items as $join => $deps) {
            foreach($deps as $key => $dep) {
                if($dep == $joinname) {
                    unset($items[$join][$key]);
                }
            }
        }
        return true;
    }


    /**
     * Return a list of items with no dependencies
     *
     * Given a list of join dependencies (as generated by
     * get_dependencies_array() ) return the names (keys)
     * of elements with no dependencies.
     *
     * @param array $items Array of dependencies
     *
     * @return array Array of names of independent items
     */
    private function get_independent_items($items) {
        $nodeps = array();
        foreach($items as $join => $deps) {
            if(count($deps) == 0) {
                $nodeps[] = $join;
            }
        }
        return $nodeps;
    }


    /**
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

        $this->get_filtering();
        // get the fields needed to display requested columns
        $fields = $this->get_column_fields();

        // get the joins needed to display requested columns and do filtering and restrictions
        $columnjoins = $this->get_column_joins();

        // if we are only counting, don't need all the column joins. Remove
        // any that don't affect the count
        if($countonly && !$this->grouped) {
            $columnjoins = $this->prune_joins($columnjoins);
        }

        $filterjoins = ($filtered === true) ? $this->get_filter_joins() : array();
        $paramjoins = $this->get_param_joins();
        $contentjoins = $this->get_content_joins();
        $joins = array_merge($columnjoins, $filterjoins, $paramjoins, $contentjoins);

        // sort the joins to remove duplicates and resolve any dependencies
        $joins = $this->sort_joins($joins);

        $joins_sql = $this->get_join_sql($joins);

        // now build the query from the snippets

        // need a unique field for get_records() so include id as first column
        if($countonly && !$this->grouped) {
            $select = "SELECT COUNT(*) ";
        } else {
            $baseid = ($this->grouped) ? "min(base.id),\n    " : "base.id,\n    ";
            $select = "SELECT $baseid ".implode($fields,",\n     ")." \n";
        }

        // build query starting from base table then adding required joins
        $from = "FROM $base\n    " . $joins_sql;


        // restrictions
        $whereclauses = array();
        $havingclauses = array();

        $restrictions = $this->get_content_restrictions();
        if($restrictions != '') {
            $whereclauses[] = $restrictions;
        }

        if($filtered===true) {
            $sqls = $this->get_sql_filter();
            if(isset($sqls['where']) && $sqls['where'] != '') {
                $whereclauses[] = $sqls['where'];
            }
            if(isset($sqls['having']) && $sqls['having'] != '') {
                $havingclauses[] = $sqls['having'];
            }
        }

        $paramrestrictions = $this->get_param_restrictions();
        if($paramrestrictions != '') {
            $whereclauses[] = $paramrestrictions;
        }
        $where = (count($whereclauses) > 0) ? "WHERE ".implode(' AND ',$whereclauses)."\n" : '';

        $groupby = '';
        if($this->grouped) {
            $groups_array = array();
            $allgrouped = true;
            foreach($this->columns as $column) {
                if($column->grouping == 'none') {
                    $allgrouped = false;
                    $groups_array[] = $column->field;
                    if($column->extrafields !== null) {
                        foreach($column->extrafields as $field) {
                            $groups_array[] = $field;
                        }
                    }
                }
            }
            if(count($groups_array) > 0 && !$allgrouped) {
                $groupby .= ' GROUP BY ' . implode(', ', $groups_array) . ' ';
            }

            if(count($havingclauses) > 0) {
                $groupby .= ' HAVING ' . implode(' AND ', $havingclauses) . "\n";
            }
        }

        if($countonly && $this->grouped) {
            $sql = "SELECT COUNT(*) FROM ($select $from $where $groupby) AS query";
        } else {
            $sql = "$select $from $where $groupby";
        }
        return $sql;
    }

    /**
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

    /**
     * Return the number of filtered records in this report
     *
     * @return integer Filtered record count
     */
    function get_filtered_count() {
        $this->get_filtering();
        // use cached value if present
        if(empty($this->_filteredcount)) {
            $sql = $this->build_query(true, true);
            $this->_filteredcount = count_records_sql($sql);
        }
        return $this->_filteredcount;
    }

    /**
     * Exports the data from the current results, maintaining
     * sort order and active filters but removing pagination
     *
     * @param string $format Format for the export ods/csv/xls
     * @return No return but initiates save dialog
     */
    function export_data($format) {
        $columns = $this->columns;
        $shortname = $this->shortname;
        $this->get_filtering();
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
            // check that column should be included
            if($column->display_column(true)) {
                $headings[] = strip_tags($column->heading);
            }
        }
        switch($format) {
            case 'ods':
                $this->download_ods($headings, $sql.$order, $count, $restrictions);
            case 'xls':
                $this->download_xls($headings, $sql.$order, $count, $restrictions);
            case 'csv':
                $this->download_csv($headings, $sql.$order, $count);
            case 'fusion':
                $this->download_fusion($headings, $sql.$order, $count, $restrictions);
        }
        die;
    }

    /**
     * Display the results table
     *
     * @return No return value but prints the current data table
     */
    function display_table() {
        global $CFG, $SESSION;
        define('DEFAULT_PAGE_SIZE', $this->recordsperpage);
        define('SHOW_ALL_PAGE_SIZE', 5000);
        $spage     = optional_param('spage', 0, PARAM_INT);                    // which page to show
        $perpage   = optional_param('perpage', DEFAULT_PAGE_SIZE, PARAM_INT);
        $ssort     = optional_param('ssort');

        $columns = $this->columns;
        $shortname = $this->shortname;
        $countfiltered = $this->get_filtered_count();

        if(count($columns) == 0) {
            print '<p>' . get_string('error:nocolumnsdefined','local_reportbuilder') . '</p>';
            return false;
        }

        $sql = $this->build_query(false, true);

        $tablecolumns = array();
        $tableheaders = array();
        foreach($columns as $column) {
            $type = $column->type;
            $value = $column->value;
            if($column->display_column()) {
                $tablecolumns[] = "{$type}_{$value}"; // used for sorting
                $tableheaders[] = $column->heading;
            }
        }

        $table = new flexible_table($shortname);
        $table->define_columns($tablecolumns);
        $table->define_headers($tableheaders);
        foreach($columns as $column) {
            if($column->display_column()) {
                $ident = "{$column->type}_{$column->value}";
                // assign $type_$value class to each column
                $table->column_class($ident, ' '.$ident);
                // apply any column-specific styling
                if(is_array($column->style)) {
                    foreach($column->style as $property => $value) {
                        $table->column_style($ident, $property, $value);
                    }
                }
                // hide any columns where hidden flag is set
                if($column->hidden != 0) {
                    $table->column_style($ident, 'display', 'none');
                }
            }
        }
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
        $table->sortable(true, $this->defaultsortcolumn, $this->defaultsortorder); // sort by name by default
        $table->setup();
        $table->initialbars(true);
        $table->pagesize($perpage, $countfiltered);

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
        $data = $this->fetch_data($sql.$order, $table->get_page_start(), $table->get_page_size());
        // add data to flexible table
        foreach ($data as $row) {
            $table->add_data($row);
        }

        // display the table
        $table->print_html();

        print $this->hide_columns();
    }


    /**
     * Produce javascript to hide any columns as indicated by the session
     *
     * @return string HTML to display javascript to hide required columns
     */
    function hide_columns() {
        global $SESSION;
        $out = '';
        $shortname = $this->shortname;
        // javascript to hide columns based on session variable
        if(isset($SESSION->rb_showhide_columns[$shortname])) {
            $out .= '<script type="text/javascript">';
            $out .= "$(document).ready(function(){";
            foreach($this->columns as $column) {
                $ident = "{$column->type}_{$column->value}";
                if(isset($SESSION->rb_showhide_columns[$shortname][$ident])) {
                    if($SESSION->rb_showhide_columns[$shortname][$ident] == 0) {
                        $out .= "$('#$shortname .$ident').hide();";
                    }
                }
            }
            $out .= '});';
            $out .= '</script>';
        }
        return $out;
    }

    /**
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
                    if($col->type.'_'.$col->value == $sortelement) {
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


    /**
     * Given an SQL query and some addition parameters, returns a 2d array of the data
     * obtained by running the query. If display functions exist for any columns the
     * data is passed to the display function and the result included instead.
     *
     * @param string $sql The SQL query, excluding offset/limit
     * @param integer $start The first row to extract
     * @param integer $size The total number of rows to extract
     * @param boolean $striptags If true, returns the data with any html tags removed
     * @param boolean $isexport If true, data is being exported
     * @return array Outer array are table rows, inner array are columns
     */
    function fetch_data($sql, $start=null, $size=null, $striptags=false, $isexport=false) {
        global $CFG;
        $columns = $this->columns;
        $columnoptions = $this->columnoptions;

        $records = get_recordset_sql($sql, $start, $size);
        $ret = array();
        if ($records) {
            while ($record = rs_fetch_next_record($records)) {
                $tabledata = array();
                foreach ($columns as $column) {
                    // check column should be shown
                    if($column->display_column($isexport)) {
                        $type = $column->type;
                        $value = $column->value;
                        $field = "{$type}_{$value}";
                        // treat fields different if display function exists
                        if (isset($column->displayfunc)) {
                            $func = 'rb_display_'.$column->displayfunc;
                            if(method_exists($this->src, $func)) {
                                $tabledata[] = $this->src->$func($record->$field, $record);
                            } else {
                                $tabledata[] = $record->$field;
                            }
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


    /**
     * Recursive version of strip_tags
     *
     * @param array $value A nested array of strings
     * @return array The same array with HTML stripped from all strings
     */
    function strip_tags_r($value) {
        return is_array($value) ? array_map(array($this,'strip_tags_r'), $value) :
            strip_tags($value);
    }


    /** Prints select box and Export button to export current report.
     *
     * A select is shown if the global settings allow exporting in
     * multiple formats. If only one format specified, prints a button.
     * If no formats are set in global settings, no export options are shown
     *
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

    /** Prints separate buttons to export current report in the allowed
     * formats
     * for this to work page must contain:
     * if($format!=''){$report->export_data($format);die;}
     * before header printed
     *
     * @return string Returns the code for the export buttons
     */
    function export_buttons() {
        global $REPORT_BUILDER_EXPORT_OPTIONS;
        $exportoptions = get_config('reportbuilder', 'exportoptions');

        $out = "<center><table><tr>";
        foreach($REPORT_BUILDER_EXPORT_OPTIONS as $option => $code) {
            // bitwise operator to see if option bit is set
            if(($exportoptions & $code) == $code) {
                $out .= '<td>';
                $out .= print_single_button(qualified_me(),array('format'=>$option),get_string('export'.$option,'local_reportbuilder'),'post','_self', true);
                $out .= '</td>';
            }
        }
	    $out .= "<tr></table></center>";
	    return $out;
    }

    /**
     * Returns a button that when clicked, takes the user to a page which displays
     * the report
     *
     * @return string HTML to display the button
     */
    function view_button() {
        global $CFG;
        $viewurl = $this->report_url();
        $url = new moodle_url($this->report_url());
        return print_single_button($url->out(true), $url->params, get_string('viewreport','local_reportbuilder'), 'get', '_self', true);
    }

    /**
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
            return print_single_button($CFG->wwwroot.'/local/reportbuilder/save.php', $params, get_string('savesearch','local_reportbuilder'), 'get', '_self', true);
        } else {
            return '';
        }
    }

    /**
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
            return popup_form($common, $options, 'viewsavedsearch', $sid, get_string('viewsavedsearch','local_reportbuilder'),'','',true);
        } else {
            return '';
        }
    }


    /**
     * Returns HTML for a button that when clicked, takes the user to a page which
     * allows them to edit this report
     *
     * @return string HTML to display the button
     */
    function edit_button() {
        global $CFG;
        $context = get_context_instance(CONTEXT_SYSTEM);
        // TODO what capability should be required here?
        if(has_capability('local/reportbuilder:managereports',$context)) {
            return print_single_button($CFG->wwwroot.'/local/reportbuilder/general.php', array('id'=>$this->_id), get_string('editthisreport','local_reportbuilder'), 'get', '_self', true);
        } else {
            return '';
        }
    }

    /**
     * Returns HTML for a button that lets users show and hide report columns
     * interactively within the report
     *
     * JQuery, dialog code and showhide.js.php should be included in page
     * when this is used (see code in report.php)
     *
     * @return string HTML to display the button
     */
    function showhide_button() {
        // hide if javascript disabled
        return '<script type="text/javascript">
            var id = ' . $this->_id . ';' .
            "var shortname = '{$this->shortname}';" .
            '</script><form><input type="button" name="rb_showhide_columns" ' .
            'id="show-showhide-dialog" value="' .
            get_string('showhidecolumns', 'local_reportbuilder') .
            '" style="display:none; float: right;"></form>';

    }


    function print_description() {
        $out = '';
        if(isset($this->description) &&
            trim(strip_tags($this->description)) != '') {
            $out .= print_box_start('generalbox', '', true);
            $out .= $this->description;
            $out .= print_box_end(true);
        }
        return $out;
    }

    /** Download current table in ODS format
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
            $worksheet[0]->write($row, 0, get_string('reportcontents','local_reportbuilder'));
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
            $data = $this->fetch_data($query, $start, $blocksize, true, true);

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

    /** Download current table in XLS format
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
            $worksheet[0]->write($row, 0, get_string('reportcontents','local_reportbuilder'));
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
            $data = $this->fetch_data($query, $start, $blocksize, true, true);

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

     /** Download current table in CSV format
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
            $data = $this->fetch_data($query, $start, $blocksize, true, true);
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

    /* Download current table to Google Fusion
     * @param array $fields Array of column headings
     * @param string $query SQL query to run to get results
     * @param integer $count Number of filtered records in query
     * @param array $restrictions Array of strings containing info
     *                            about the content of the report
     * @return Returns never
     */
    function download_fusion($fields, $query, $count, $restriction) {
        global $CFG;
        /*
        global $SESSION;
        if (!isset($SESSION->reportbuilder_report)) {
            $SESSION->reportbuilder_report = array();
        }
        $SESSION->reportbuilder_report[$this->shortname] = array(
                                                            'shortname' => serialize($this->shortname),
                                                            'fields' => serialize($fields),
                                                            'query' => serialize($query),
                                                            'count' => serialize($count),
                                                            'restrictions' => serialize($restrictions),
                                                            );
        var_dump($fields);
        var_dump($query);
        var_dump($count);
        var_dump($SESSION->reportbuilder_report);
        */

        $jump = new moodle_url($CFG->wwwroot."/local/reportbuilder/fusionexporter.php", array('id' => $this->_id, 'sid' => $this->_sid));
        redirect($jump->out());
        die;
    }

    /**
     * Returns array of content options allowed for this report's source
     *
     * @return array An array of content option names
     */
    function get_content_options() {

        $contentoptions = array();
        if(isset($this->contentoptions) && is_array($this->contentoptions)) {
            foreach($this->contentoptions as $option) {
                $contentoptions[] = $option->classname;
            }
        }
        return $contentoptions;
    }


    ///
    /// Functions for Editing Reports
    ///


    /**
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
        foreach($filters as $filter) {
            $section = ucwords(str_replace(array('_','-'),array(' ',' '), $filter->type));
            $key = $filter->type . '-' . $filter->value;
            $ret[$section][$key] = $filter->label;
        }
        return $ret;
    }

    /**
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
        foreach($columns as $column) {
            $section = ucwords(str_replace(array('_','-'),array(' ',' '), $column->type));
            $key = $column->type . '-' . $column->value;
            $ret[$section][$key] = $column->name;
        }
        return $ret;
    }

    /**
     * Given a column id, sets the default visibility to show or hide
     * for that column on current report
     *
     * @param integer $cid ID of the column to be changed
     * @param integer $hide 0 to show column, 1 to hide it
     * @return boolean True on success, false otherwise
     */
    function showhide_column($cid, $hide) {
        $col = get_record('report_builder_columns', 'id', $cid);
        if(!$col) {
            return false;
        }

        $todb = new object();
        $todb->id = $cid;
        $todb->hidden = $hide;
        return update_record('report_builder_columns', $todb);

    }

    /**
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

    /**
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

    /**
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


    /**
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

    /**
     * Method for obtaining a report builder setting
     *
     * @param integer $reportid ID for the report to obtain a setting for
     * @param string $type Identifies the class using the setting
     * @param string $name Identifies the particular setting
     * @return mixed The value of the setting $name or null if it doesn't exist
     */
    static function get_setting($reportid, $type, $name) {
        return get_field('report_builder_settings', 'value', 'reportid',
            $reportid, 'type', $type, 'name', $name);
    }

    /**
     * Return an associative array of all settings of a particular type
     *
     * @param integer $reportid ID of the report to get settings for
     * @param string $type Identifies the class to get settings from
     * @return array Associative array of name|value settings
     */
    static function get_all_settings($reportid, $type) {
        $settings = array();
        if($records = get_records_select('report_builder_settings',
            "reportid = $reportid AND type = '$type'")) {
            foreach($records as $record) {
                $settings[$record->name] = $record->value;
            }
        }
        return $settings;
    }

    /**
     * Method for updating a setting for a particular report
     *
     * Will create a DB record if no setting is found
     *
     * @param integer $reportid ID of the report to update the settings of
     * @param string $type Identifies the class to be updated
     * @param string $name Identifies the particular setting to update
     * @param string $value The new value of the setting
     * @return boolean True if the setting could be updated or created
     */
    static function update_setting($reportid, $type, $name, $value) {
        if($record = get_record('report_builder_settings', 'reportid',
            $reportid, 'type', $type, 'name', $name)) {
            // update record
            $todb = new object();
            $todb->id = $record->id;
            $todb->value = addslashes($value);
            if(!update_record('report_builder_settings', $todb)) {
                return false;
            }
        } else {
            // insert record
            $todb = new object();
            $todb->reportid = $reportid;
            $todb->type = $type;
            $todb->name = $name;
            $todb->value = $value;
            if(!insert_record('report_builder_settings', $todb)) {
                return false;
            }
        }
        return true;
    }


    /**
     * Return HTML to display the results of a feedback activity
     */
    function print_feedback_results() {
        global $CFG;
        // get paging parameters
        define('DEFAULT_PAGE_SIZE', $this->recordsperpage);
        define('SHOW_ALL_PAGE_SIZE', 5000);
        $spage     = optional_param('spage', 0, PARAM_INT);                    // which page to show
        $perpage   = optional_param('perpage', DEFAULT_PAGE_SIZE, PARAM_INT);
        $countfiltered = $this->get_filtered_count();

        $out = '';
        $groupid = $this->src->groupid;
        $out .= print_box_start('generalbox', '', true);

        if(!$groupid) {
            $out .= 'The activity group could not be found';
        }
        $questionstable = "report_builder_fbq_{$groupid}_q";
        $optionstable = "report_builder_fbq_{$groupid}_opt";
        $answerstable = "report_builder_fbq_{$groupid}_a";

        $questions = get_records($questionstable, '', '', 'sortorder');
        $options = get_records($optionstable, '', '', 'qid,sortorder');
        $grouped_options = array();
        foreach($options as $option) {
            $grouped_options[$option->qid][] = $option;
        }

        // get first column and use as heading
        $columns = $this->columns;
        if(count($columns) > 0) {
            $primary_field = current($columns);
            if($primary_field->required == true) {
                $primary_field = null;
            }

            // get any extra (none required) columns
            $additional_fields = array();
            while($col = next($columns)) {
                if($col->required == false) {
                    $additional_fields[] = $col;
                }
            }
        }

        // get data
        $sql = $this->build_query(false, true);

        // use default sort data if set
        if(isset($this->defaultsortcolumn)) {
            if(isset($this->defaultsortorder) &&
                $this->defaultsortorder == SORT_DESC) {
                $order = 'DESC';
            } else {
                $order = 'ASC';
            }

            // see if sort element is in columns array
            $set = false;
            foreach($this->columns as $col) {
                if($col->type.'_'.$col->value == $this->defaultsortcolumn) {
                    $set = true;
                }
            }
            if($set) {
                $sort = " ORDER BY {$this->defaultsortcolumn} {$order}";
            } else {
                $sort = '';
            }
        } else {
            $sort = '';
        }
        $data = get_records_sql($sql . $sort, $spage * $perpage, $perpage);
        $first = true;
        if($data) {

            foreach($data as $item) {
                // dividers between feedback results
                if($first) {
                    $out .= print_paging_bar($countfiltered, $spage, $perpage,
                        $this->report_url(). '&amp;', 'spage', false, true);
                    $first = false;
                } else {
                    $out .= '<hr class="feedback-separator"/>';
                }

                if(isset($primary_field)) {
                    // print primary heading
                    $primaryname = $primary_field->type . '_' . $primary_field->value;
                    $primaryheading = $primary_field->heading;

                    // treat fields different if display function exists
                    if (isset($primary_field->displayfunc)) {
                        $func = 'rb_display_'.$primary_field->displayfunc;
                        if(method_exists($this->src, $func)) {
                            $primaryvalue = $this->src->$func($item->$primaryname, $item);
                        } else {
                            $primaryvalue = (isset($item->$primaryname)) ? $item->$primaryname : 'Unknown';
                        }
                    } else {
                        $primaryvalue = (isset($item->$primaryname)) ? $item->$primaryname : 'Unknown';
                    }

                    $out .= '<h2>' . $primaryheading . ': '.$primaryvalue . '</h2>';
                }

                if(isset($additional_fields)) {
                    // print secondary details
                    foreach($additional_fields as $additional_field) {
                        $addname = $additional_field->type . '_' . $additional_field->value;
                        $addheading = $additional_field->heading;
                        $addvalue = (isset($item->$addname)) ? $item->$addname : 'Unknown';
                        // treat fields different if display function exists
                        if (isset($additional_field->displayfunc)) {
                            $func = 'rb_display_'.$additional_field->displayfunc;
                            if(method_exists($this->src, $func)) {
                                $addvalue = $this->src->$func($item->$addname, $item);
                            } else {
                                $addvalue = (isset($item->$addname)) ? $item->$addname : 'Unknown';
                            }
                        } else {
                            $addvalue = (isset($item->$addname)) ? $item->$addname : 'Unknown';
                        }

                        $out .= '<strong>' . $addheading . ': '. $addvalue . '</strong><br />';
                    }
                }

                // print count of number of results
                $out .= '<p>Results from <strong>' . $item->responses_number . '</strong> completed feedback(s).</p>';

                // display answers
                foreach($questions as $question) {
                    $qnum = $question->sortorder;;
                    $qname = stripslashes($question->name);
                    $qid = $question->id;
                    $out .= '<h3>Q' . $qnum . ': ' . $qname . '</h3>';

                    switch($question->typ) {
                    case 'dropdown':
                    case 'dropdownrated':
                    case 'check':
                    case 'radio':
                    case 'radiorated':
                        // if it's an option based question, display bar chart if there are options
                        if(!array_key_exists($qid, $grouped_options)) {
                            continue;
                        }
                        $out .= $this->get_feedback_option_answer($qid, $grouped_options[$qid], $item);
                        break;
                    case 'textarea':
                    case 'textfield':
                        // if it's a text based question, print all answers in a text field
                        $out .= $this->get_feedback_standard_answer($qid, $item);
                        break;
                    case 'numeric':
                    default:
                    }

                }
            }
        }

        $out .= print_paging_bar($countfiltered, $spage, $perpage,
            $this->report_url(). '&amp;', 'spage', false, true);

        $out .= print_box_end(true);

        return $out;
    }

    function get_feedback_standard_answer($qid, $item) {
        $out = '';
        $count = 'q' . $qid . '_count';
        $answer = 'q' . $qid . '_list';
        if(isset($item->$count)) {
            $out .= '<p>' . $item->$count . ' response(s).</p>';
        }
        if(isset($item->$answer) && $item->$answer != '') {
            $responses = str_replace(array('<br />'),array("\n"), stripslashes($item->$answer));
            $out .= '<textarea rows="6" cols="100">' . $responses . '</textarea>';
        }
        return $out;
    }

    function get_feedback_option_answer($qid, $options, $item) {
        $out = '';
        $count = array();
        $perc = array();
        // group answer counts and percentages
        foreach($options as $option) {
            $oid = $option->sortorder;
            $countname = 'q' . $qid . '_' . $oid . '_sum';
            $percname = 'q' . $qid . '_' . $oid . '_perc';
            if(isset($item->$countname)) {
                $count[$oid] = $item->$countname;
            } else {
                $count[$oid] = null;
            }
            if(isset($item->$percname)) {
                $perc[$oid] = $item->$percname;
            } else {
                $perc[$oid] = null;
            }
        }
        $maxcount = max($count);
        $maxbarwidth = 100; // percent

        $numresp = 'q' . $qid . '_total';
        if(isset($item->$numresp)) {
            $out .= '<p>' . $item->$numresp . ' response(s).</p>';
        }

        $out .= '<table class="feedback-table">';
        foreach($options as $option) {
            $oid = $option->sortorder;
            $out .= '<tr>';
            $out .= '<th class="feedback-option-number">' . $oid . '</th>';
            $out .= '<td class="feedback-option-name">' . stripslashes($option->name) . "</td>\n";
            $barwidth = $perc[$oid];
            $spacewidth = 100 - $barwidth;
            $out .= '<td class="feedback-option-chart"><table class="feedback-bar-chart"><tr>';
            $out .= '<td class="feedback-bar-color" width="'.$barwidth.'%"></td>' . "\n";
            $out .= '<td class="feedback-bar-blank" width="'.$spacewidth.'%"></td>'. "\n";
            $out .= '</tr></table>';
            $out .= '<td class="feedback-option-count"> ' . $count[$oid];
            if(isset($perc[$oid])) {
                $out .= ' (' . $perc[$oid] . '%)';
            }
            $out .= ' </td>' . "\n";
            $out .= '</tr>';
        }
        $out .= '</table>';
        return $out;
    }
} // End of reportbuilder class

class ReportBuilderException extends Exception { }

/**
 * Returns the proper SQL to aggregate a field by joining with a specified delimiter
 *
 *
 */
function sql_group_concat($field, $delimiter=', ', $unique=false) {
    global $CFG;

    // if not supported, just return single value - use min()
    $sql = " MIN($field) ";

    switch ($CFG->dbfamily) {
        case 'mysql':
            // use native function
            $distinct = $unique ? 'DISTINCT' : '';
            $sql = " GROUP_CONCAT($distinct $field SEPARATOR $delimiter) ";
            break;
        case 'postgres':
            // use custom aggregate function - must have been defined
            // in local/db/upgrade.php
            $distinct = $unique ? 'TRUE' : 'FALSE';
            $sql = " GROUP_CONCAT($field, '$delimiter', $distinct) ";
            break;
    }

    return $sql;
}

