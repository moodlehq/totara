<?php

/**
 * A report builder source for the "user" table.
 */
class rb_source_user extends rb_base_source {

    public $base, $joinlist, $columnoptions, $filteroptions;
    public $contentoptions, $paramoptions, $defaultcolumns;
    public $defaultfilters, $requiredcolumns;
    /**
     * Whether the "staff_facetoface_sessions" report exists or not (used to determine
     * whether or not to display icons that link to it)
     * @var boolean
     */
    private $staff_f2f;

    /**
     * Constructor
     * @global object $CFG
     */
    public function __construct() {
        global $CFG;
        $this->base = $CFG->prefix . 'user';
        $this->joinlist = $this->define_joinlist();
        $this->columnoptions = $this->define_columnoptions();
        $this->filteroptions = $this->define_filteroptions();
        $this->contentoptions = $this->define_contentoptions();
        $this->paramoptions = array();
        $this->defaultcolumns = array();
        $this->defaultfilters = array();
        $this->requiredcolumns = array();
        $this->staff_f2f = get_field('report_builder', 'id', 'shortname', 'staff_facetoface_sessions');
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
                'totara_stats_comp_achieved',
                'LEFT',
                $CFG->prefix . 'block_totara_stats',
                'base.id = totara_stats_comp_achieved.userid AND totara_stats_comp_achieved.eventtype = 4',
                REPORT_BUILDER_RELATION_ONE_TO_ONE
            ),
            new rb_join(
                'totara_stats_courses_started',
                'LEFT',
                $CFG->prefix . 'block_totara_stats',
                'base.id = totara_stats_courses_started.userid AND totara_stats_courses_started.eventtype = 2',
                REPORT_BUILDER_RELATION_ONE_TO_ONE
            ),
            new rb_join(
                'totara_stats_courses_completed',
                'LEFT',
                $CFG->prefix . 'block_totara_stats',
                'base.id = totara_stats_courses_completed.userid AND totara_stats_courses_completed.eventtype = 3',
                REPORT_BUILDER_RELATION_ONE_TO_ONE
            )
        );

        $this->add_position_tables_to_joinlist($joinlist, 'base', 'id');

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
        $this->add_user_fields_to_columns($columnoptions, 'base');
        $this->add_position_fields_to_columns($columnoptions);

        // A column to display a user's profile picture
        $columnoptions[] = new rb_column_option(
                        'user',
                        'userpicture',
                        'User\'s picture',
                        'base.id',
                        array(
                            'displayfunc' => 'user_picture',
                            'noexport' => true,
                            'defaultheading' => ' ',
                            'extrafields' => array(
                                'userpic_picture' => 'base.picture',
                                'userpic_firstname' => 'base.firstname',
                                'userpic_lastname' => 'base.lastname',
                                'userpic_imagealt' => 'base.imagealt'
                            )
                        )
        );

        // A column to display the "My Learning" icons for a user
        $columnoptions[] = new rb_column_option(
                        'user',
                        'userlearningicons',
                        'User\'s My Learning Icons',
                        'base.id',
                        array(
                            'displayfunc' => 'learning_icons',
                            'noexport' => true,
                            'defaultheading' => ' '
                        )
        );

        // A column to display the number of achieved competencies for a user
        $columnoptions[] = new rb_column_option(
                        'statistics',
                        'competenciesachieved',
                        'User\'s Achieved Competency Count',
                        'totara_stats_comp_achieved.data2',
                        array(
                            'joins' => 'totara_stats_comp_achieved',
                            'grouping' => 'count',
                        )
        );

        // A column to display the number of started courses for a user
        $columnoptions[] = new rb_column_option(
                        'statistics',
                        'coursesstarted',
                        'User\'s Courses Started Count',
                        'totara_stats_courses_started.data2',
                        array(
                            'joins' => 'totara_stats_courses_started',
                            'grouping' => 'count',
                        )
        );

        // A column to display the number of completed courses for a user
        $columnoptions[] = new rb_column_option(
                        'statistics',
                        'coursescompleted',
                        'User\'s Courses Completed Count',
                        'totara_stats_courses_completed.data2',
                        array(
                            'joins' => 'totara_stats_courses_completed',
                            'grouping' => 'count',
                        )
        );

        return $columnoptions;
    }

    /**
     * Creates the array of rb_filter_option objects required for $this->filteroptions
     * @return array
     */
    private function define_filteroptions() {
        // No filter options!
        return array(
            new rb_filter_option(
                'user',
                'fullname',
                'User\'s Name',
                'text'
            )
        );
    }

    /**
     * Creates the array of rb_content_option object required for $this->contentoptions
     * @return array
     */
    private function define_contentoptions() {
        $contentoptions = array();

        // Include the rb_user_content content options for this report
        $contentoptions[] = new rb_content_option('user', 'Users', 'base.id');
        return $contentoptions;
    }

    /**
     * A rb_column_options->displayfunc helper function to display the
     * "My Learning" icons for each user row
     *
     * @global object $CFG
     * @param integer $itemid ID of the user
     * @param object $row The rest of the data for the row
     * @return string
     */
    public function rb_display_learning_icons($itemid, $row) {
        global $CFG;

        $disp = '<span style="white-space:nowrap;">';

        // Learning Records icon
        $disp = '<a href="' . $CFG->wwwroot . '/local/plan/record/courses.php?userid=' . $itemid . '"><img src="' . $CFG->pixpath . '/i/record.gif" title="' . get_string('learningrecords', 'local') . '" /></a>';

        // Face To Face Bookings icon
        if ($this->staff_f2f) {
            $disp .= '<a href="' . $CFG->wwwroot . '/my/bookings.php?id=' . $itemid . '"><img src="' . $CFG->pixpath . '/i/bookings.png" title="' . get_string('f2fbookings', 'local') . '" /></a>';
        }

        // Individual Development Plans icon
        $disp .= '<a href="' . $CFG->wwwroot . '/local/plan/index.php?userid=' . $itemid . '"><img src="' . $CFG->pixpath . '/i/plan.gif" title="' . get_string('idp', 'idp') . '" /></a>';

        $disp .= '</span>';
        return $disp;
    }


}

// end of rb_source_user class

