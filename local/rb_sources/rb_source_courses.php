<?php

class rb_source_courses extends rb_base_source {
    public $base, $joinlist, $columnoptions, $filteroptions;
    public $contentoptions, $paramoptions, $defaultcolumns;
    public $defaultfilters, $requiredcolumns;

    function __construct() {
        global $CFG;
        $this->base = $CFG->prefix . 'course';
        $this->joinlist = $this->define_joinlist();
        $this->columnoptions = $this->define_columnoptions();
        $this->filteroptions = $this->define_filteroptions();
        $this->contentoptions = $this->define_contentoptions();
        $this->paramoptions = $this->define_paramoptions();
        $this->defaultcolumns = $this->define_defaultcolumns();
        $this->defaultfilters = $this->define_defaultfilters();
        $this->requiredcolumns = $this->define_requiredcolumns();
        parent::__construct();
    }

    //
    //
    // Methods for defining contents of source
    //
    //

    function define_joinlist() {
        global $CFG;

        $joinlist = array(
            new rb_join(
                'mods',
                'LEFT',
                '(SELECT cm.course,' .
                sql_group_concat('CAST(m.name AS varchar)','|', true) .
                " AS list FROM {$CFG->prefix}course_modules cm LEFT JOIN {$CFG->prefix}modules m ON m.id = cm.module GROUP BY cm.course)",
                'mods.course = base.id',
                REPORT_BUILDER_RELATION_ONE_TO_ONE
            ),
        );

        // include some standard joins
        $this->add_course_custom_fields_to_joinlist($joinlist, 'base', 'id');
        $this->add_course_category_table_to_joinlist($joinlist,
            'base', 'category');
        $this->add_course_tags_tables_to_joinlist($joinlist, 'base', 'id');

        return $joinlist;
    }

    function define_columnoptions() {
        $columnoptions = array(
            new rb_column_option(
                'course',
                'mods',
                "Content",
                "mods.list",
                array('joins' => 'mods', 'displayfunc' => 'modicons')
            ),
        );

        // include some standard columns
        $this->add_course_fields_to_columns($columnoptions, 'base');
        $this->add_course_custom_fields_to_columns($columnoptions, 'base', 'id');
        $this->add_course_category_fields_to_columns($columnoptions, 'course_category', 'base');
        $this->add_course_tag_fields_to_columns($columnoptions, 'base', 'id');

        return $columnoptions;
    }

    function define_filteroptions() {
        $filteroptions = array(
            /*
            // array of rb_filter_option objects, e.g:
            new rb_filter_option(
                '',       // type
                '',       // value
                '',       // label
                '',       // filtertype
                array()   // options
            )
            */
        );

        // include some standard filters
        $this->add_course_fields_to_filters($filteroptions, 'base', 'id');
        $this->add_course_custom_fields_to_filters($filteroptions, 'base', 'id');
        $this->add_course_category_fields_to_filters($filteroptions, 'base', 'category');
        $this->add_course_tag_fields_to_filters($filteroptions, 'base', 'id');

        return $filteroptions;
    }

    function define_contentoptions() {
        $contentoptions = array(

            new rb_content_option(
                'date',
                "The completion date",
                'base.startdate'
            ),
        );
        return $contentoptions;
    }

    function define_paramoptions() {
        $paramoptions = array(
            new rb_param_option(
                'courseid',
                'base.id'
            ),
            new rb_param_option(
                'visible',
                'base.visible'
            ),
        );

        return $paramoptions;
    }

    function define_defaultcolumns() {
        $defaultcolumns = array(
            array(
                'type' => 'course',
                'value' => 'courselink',
            ),
        );
        return $defaultcolumns;
    }

    function define_defaultfilters() {
        $defaultfilters = array(
            array(
                'type' => 'course',
                'value' => 'fullname',
                'advanced' => 0,
            ),
            array(
                'type' => 'course_category',
                'value' => 'id',
                'advanced' => 0,
            ),
        );

        return $defaultfilters;
    }

    function define_requiredcolumns() {
        $requiredcolumns = array(
            /*
            // array of rb_column objects, e.g:
            new rb_column(
                '',         // type
                '',         // value
                '',         // heading
                '',         // field
                array()     // options
            )
            */
        );
        return $requiredcolumns;
    }

    //
    //
    // Source specific column display methods
    //
    //



    function rb_display_modicons($mods, $row) {
        global $CFG;
        $modules = explode('|', $mods);
        $out = '';
        foreach($modules as $module) {
            $icon = '/mod/' . $module . '/icon.gif';
            if(file_exists($CFG->dirroot . $icon)) {
                $out .= '<img src="' . $CFG->wwwroot .
                    $icon . '" alt="' . ucfirst($module) .
                    '" title="' . ucfirst($module) . '" /> ';
            }
        }
        return $out;
    }

    //
    //
    // Source specific filter display methods
    //
    //



} // end of rb_source_courses class

