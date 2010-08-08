<?php

/*
 * Class defining a report builder join
 */

define('REPORT_BUILDER_RELATION_ONE_TO_ONE', 1);
define('REPORT_BUILDER_RELATION_ONE_TO_MANY', 2);
define('REPORT_BUILDER_RELATION_MANY_TO_ONE', 3);
define('REPORT_BUILDER_RELATION_MANY_TO_MANY', 4);

class rb_join {
    public $name, $type, $table, $conditions;
    public $relation, $dependencies;

    function __construct($name, $type, $table, $conditions,
        $relation=null, $dependencies='base') {

        $this->name = $name;
        $this->type = $type;
        $this->table = $table;
        $this->conditions = $conditions;
        $this->relation = $relation;
        $this->dependencies = $dependencies;

    }

    /*
     * Returns true if performing this join won't change the number of records
     *
     * Used by prune_joins() to avoid making unnecessary joins when counting
     * records
     */
    public function pruneable() {

        // only left joins can be guaranteed not to change the number
        // of records
        if(!preg_match('/^\s*left(\s+outer)?\s*/i', $this->type)) {
            return false;
        }

        // even left joins can result in more records, unless the table
        // being joined has the a *-to-one relationship
        switch($this->relation) {
        case REPORT_BUILDER_RELATION_ONE_TO_ONE:
        case REPORT_BUILDER_RELATION_MANY_TO_ONE:
            return true;
        default:
            return false;
        }

    }

} // end of rb_join class
