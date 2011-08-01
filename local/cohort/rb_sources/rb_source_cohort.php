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
 * @author Simon Coggins <simonc@catalyst.net.nz>
 * @package totara
 * @subpackage reportbuilder
 */

/**
 * A report builder source for the "user" table.
 */
class rb_source_cohort extends rb_base_source {

    public $base, $joinlist, $columnoptions, $filteroptions;
    public $contentoptions, $paramoptions, $defaultcolumns;
    public $defaultfilters, $requiredcolumns, $sourcetitle;

    /**
     * Constructor
     * @global object $CFG
     */
    public function __construct() {
        global $CFG;
        $this->base = $CFG->prefix . 'cohort';
        $this->joinlist = $this->define_joinlist();
        $this->columnoptions = $this->define_columnoptions();
        $this->filteroptions = $this->define_filteroptions();
        $this->contentoptions = $this->define_contentoptions();
        $this->paramoptions = $this->define_paramoptions();
        $this->defaultcolumns = $this->define_defaultcolumns();
        $this->defaultfilters = $this->define_defaultfilters();
        $this->requiredcolumns = array();
        $this->sourcetitle = get_string('cohort', 'local_cohort');
        parent::__construct();
    }

    //
    //
    // Methods for defining contents of source
    //
    //

    /**
     * Creates the array of rb_join objects required for this->joinlist
     *
     * @global object $CFG
     * @return array
     */
    private function define_joinlist() {
        global $CFG;

        $joinlist = array(
            new rb_join(
                'members', // table alias?
                'LEFT', // type of join
                $CFG->prefix . 'cohort_members', // actual table name
                'base.id = members.cohortid', //how it is joined
                REPORT_BUILDER_RELATION_ONE_TO_MANY
            ),
        );

    $this->add_user_table_to_joinlist($joinlist, 'members', 'userid');
    $this->add_user_custom_fields_to_joinlist($joinlist, 'members', 'userid');
    $this->add_position_tables_to_joinlist($joinlist, 'members', 'userid');

        return $joinlist;
    }

    /**
     * Creates the array of rb_column_option objects required for
     * $this->columnoptions
     *
     * @return array
     */
    private function define_columnoptions() {
        $columnoptions = array();

        $columnoptions[] = new rb_column_option(
        'cohort',   // which table? Type
        'name', // alias for the field
        get_string('name', 'local_cohort'), // name for the column
        'base.name' // table alias and field name
        );

    $this->add_user_fields_to_columns($columnoptions);
    $this->add_user_custom_fields_to_columns($columnoptions);
    $this->add_position_fields_to_columns($columnoptions);

        return $columnoptions;
    }

    /**
     * Creates the array of rb_filter_option objects required for $this->filteroptions
     * @return array
     */
    private function define_filteroptions() {
        // No filter options!
        $filteroptions = array();

    $this->add_user_fields_to_filters($filteroptions);

        return $filteroptions;
    }


    function define_defaultcolumns() {
        $defaultcolumns = array(
            array(
                'type' => 'cohort',
                'value' => 'name',
            ),
        array(
                'type' => 'user',
                'value' => 'fullname',
            )
        );
        return $defaultcolumns;
    }

    function define_defaultfilters() {
        $defaultfilters = array(
        array(
                'type' => 'user',
                'value' => 'fullname',
                'advanced' => 0,
            ),
    );

        return $defaultfilters;
    }
    /**
     * Creates the array of rb_content_option object required for $this->contentoptions
     * @return array
     */
    private function define_contentoptions() {
        $contentoptions = array();

        return $contentoptions;
    }

    private function define_paramoptions() {
    $paramoptions = array(
            new rb_param_option(
                'cohortid',        // parameter name
                'base.id'  // field
            ),
    );
    return $paramoptions;
    }
}

// end of rb_source_user class

