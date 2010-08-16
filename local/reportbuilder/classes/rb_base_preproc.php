<?php // $Id$

/**
 * Abstract base preprocessor class to be extended to create report builder
 * pre-processors
 *
 * Defines the properties and methods required by pre-processors and
 * implements some core methods used by all child classes
 *
 * @copyright Totara Learning Solutions Limited
 * @author Simon Coggins
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage reportbuilder
 */
abstract class rb_base_preproc {

    public $groupid;

/**
 * Class constructor
 *
 * Call from the constructor of all child classes with:
 *
 * <code>parent::__construct($groupid)</code>
 *
 * to ensure child class has implemented everything necessary to work.
 *
 */
    function __construct($groupid) {

        $this->groupid = $groupid;

        // check that child classes implement required properties
        $properties = array(
            'name',
            'prefix',
        );
        foreach($properties as $property) {
            if(!property_exists($this, $property)) {
                throw new Exception("Property '$property' must be set in class " .
                    get_class($this));
            }
        }

    }

    /*
     * All sub classes must define the following functions
     */
    abstract function run($item, $lastchecked, &$message);
    abstract function get_all_items();
    abstract function is_initialized();
    abstract function initialize_group($item=null);
    abstract function drop_group_tables();


    /**
     * Given a group ID, return an array of items in that group
     *
     * @return array Array of items (usually IDs) in that group
     */
    function get_group_items() {
        global $CFG;
        $groupid = $this->groupid;

        // group id of zero refers to all items
        // delegate getting all items to the specific pre-processor
        if($groupid == 0) {
            return $this->get_all_items();
        }

        if($items = get_records('report_builder_group_assign',
            'groupid', $groupid, 'itemid', 'itemid')) {
            return array_keys($items);
        }

        return array();
    }


    /**
     * Disable a particular item
     *
     * @param string $item Reference (usually an ID) to the item to disable
     *
     * @return boolean True if succeeds in disabling, false otherwise
     */
    function disable_item($item) {
        $groupid = $this->groupid;
        // single record assured by unique index on fields
        if($record = get_record('report_builder_preproc_track',
            'groupid', $groupid, 'itemid', $item)) {
            $todb = new object();
            $todb->id = $record->id;
            $todb->disabled = 1;
            return update_record('report_builder_preproc_track', $todb);
        } else {
            $todb = new object();
            $todb->groupid = $groupid;
            $todb->itemid = $item;
            $todb->disabled = 1;
            $todb->lastchecked = time();
            return insert_record('report_builder_preproc_track', $todb);
        }
    }


    /**
     * Return associative array of items and when they were last processed
     *
     * Used to determine if an item needs to be preprocessed again
     *
     * @return array Associative array where key is itemid and value is
     *               timestamp of last process time
     */
    function get_track_info() {
        $groupid = $this->groupid;
        // groupid/itemid fields have a unique index so every itemid
        // returned by this query will be unique
        $trackinfo = get_records('report_builder_preproc_track',
            'groupid', $groupid, 'itemid', 'itemid,lastchecked,disabled');
        return $trackinfo ? $trackinfo : array();
    }


    /**
     * Update or create tracking info for the item given
     * by setting the lastchecked to the current time.
     *
     * @param string $itemid Identifier (usually the ID) of the item to update
     *
     * @return boolean True if successful, false otherwise
     */
    function update_track_info($itemid) {
        $groupid = $this->groupid;
        if($record = get_record('report_builder_preproc_track',
            'groupid', $groupid, 'itemid', $itemid)) {
            // update existing record
            $todb = new object();
            $todb->id = $record->id;
            $todb->lastchecked = time();
            return update_record('report_builder_preproc_track', $todb);
        } else {
            // create a new record
            $todb = new object();
            $todb->groupid = $groupid;
            $todb->itemid = $itemid;
            $todb->lastchecked = time();
            $todb->disabled = 0;
            return insert_record('report_builder_preproc_track', $todb);
        }
    }

} // end of rb_base_preproc class

