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
                "(SELECT userid, count(data2) ". sql_as() ." number
                    FROM {$CFG->prefix}block_totara_stats
                    WHERE eventtype = 4
                    GROUP BY userid)",
                'base.id = totara_stats_comp_achieved.userid',
                REPORT_BUILDER_RELATION_ONE_TO_ONE
            ),
            new rb_join(
                'totara_stats_courses_started',
                'LEFT',
                "(SELECT userid, count(data2) ". sql_as() ." number
                    FROM {$CFG->prefix}block_totara_stats
                    WHERE eventtype = 2
                    GROUP BY userid)",
                'base.id = totara_stats_courses_started.userid',
                REPORT_BUILDER_RELATION_ONE_TO_ONE
            ),
            new rb_join(
                'totara_stats_courses_completed',
                'LEFT',
                "(SELECT userid, count(data2) ". sql_as() ." number
                    FROM {$CFG->prefix}block_totara_stats
                    WHERE eventtype = 3
                    GROUP BY userid)",
                'base.id = totara_stats_courses_completed.userid',
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
                        get_string('userspicture', 'rb_source_user'),
                        'base.id',
                        array(
                            'displayfunc' => 'user_picture',
                            'noexport' => true,
                            'defaultheading' => get_string('picture', 'rb_source_user'),
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
                        get_string('mylearningicons', 'rb_source_user'),
                        'base.id',
                        array(
                            'displayfunc' => 'learning_icons',
                            'noexport' => true,
                            'defaultheading' => get_string('options', 'rb_source_user')
                        )
        );

        // A column to display the number of achieved competencies for a user
        $columnoptions[] = new rb_column_option(
                        'statistics',
                        'competenciesachieved',
                        get_string('usersachievedcompcount', 'rb_source_user'),
                        'totara_stats_comp_achieved.number',
                        array(
                            'displayfunc' => 'count',
                            'joins' => 'totara_stats_comp_achieved',
                        )
        );

        // A column to display the number of started courses for a user
        $columnoptions[] = new rb_column_option(
                        'statistics',
                        'coursesstarted',
                        get_string('userscoursestartedcount', 'rb_source_user'),
                        'totara_stats_courses_started.number',
                        array(
                            'displayfunc' => 'count',
                            'joins' => 'totara_stats_courses_started',
                        )
        );

        // A column to display the number of completed courses for a user
        $columnoptions[] = new rb_column_option(
                        'statistics',
                        'coursescompleted',
                        get_string('userscoursescompletedcount', 'rb_source_user'),
                        'totara_stats_courses_completed.number',
                        array(
                            'displayfunc' => 'count',
                            'joins' => 'totara_stats_courses_completed',
                        )
        );

        $columnoptions[] = new rb_column_option(
                        'user',
                        'namewithlinks',
                        'User Fullname (with links to learning components)',
                        sql_fullname("base.firstname", "base.lastname"),
                        array(
                            'displayfunc' => 'user_with_links',
                            'defaultheading' => 'User',
                            'extrafields' => array(
                                'user_id' => 'base.id',
                                'userpic_picture' => 'base.picture',
                                'userpic_firstname' => 'base.firstname',
                                'userpic_lastname' => 'base.lastname',
                                'userpic_imagealt' => 'base.imagealt'
                            ),
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
                get_string('usersname', 'rb_source_user'),
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
        $contentoptions[] = new rb_content_option(
            'user',
            get_string('users', 'rb_source_user'),
            'base.id');
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

        static $systemcontext;
        if (!isset($systemcontext)) {
            $systemcontext = get_system_context();
        }

        $disp = '<span style="white-space:nowrap;">';

        // Learning Records icon
        $disp = '<a href="' . $CFG->wwwroot . '/local/plan/record/courses.php?userid=' . $itemid . '"><img src="' . $CFG->pixpath . '/i/record.gif" title="' . get_string('learningrecords', 'local') . '" /></a>';

        // Face To Face Bookings icon
        if ($this->staff_f2f) {
            $disp .= '<a href="' . $CFG->wwwroot . '/my/bookings.php?userid=' . $itemid . '"><img src="' . $CFG->pixpath . '/i/bookings.png" title="' . get_string('f2fbookings', 'local') . '" /></a>';
        }

        // Individual Development Plans icon
        if (has_capability('local/plan:accessplan', $systemcontext)) {
            $disp .= '<a href="'.$CFG->wwwroot.'/local/plan/index.php?userid='.$itemid.'">';
            $disp .= '<img src="'.$CFG->pixpath.'/i/plan.gif" title="'.get_string('learningplans', 'local_plan').'" />';
            $disp .= '</a>';
        }

        $disp .= '</span>';
        return $disp;
    }

    function rb_display_user_with_links($user, $row) {
        global $CFG;
        $userid = $row->user_id;

        $picuser = new stdClass();
        $picuser->id = $userid;
        $picuser->picture = $row->userpic_picture;
        $picuser->imagealt = $row->userpic_imagealt;
        $picuser->firstname = $row->userpic_firstname;
        $picuser->lastname = $row->userpic_lastname;
        $user_pic = print_user_picture($picuser, 1, null, null, true);

        $rol_link = "<a href=\"{$CFG->wwwroot}/local/plan/record/courses.php?userid={$userid}\">Records</a>";
        $plan_link = "<a href=\"{$CFG->wwwroot}/local/plan/index.php?userid={$userid}\">Plans</a>";
        $profile_link = "<a href=\"{$CFG->wwwroot}/user/view.php?id={$userid}\">Profile</a>";
        $booking_link = "<a href=\"{$CFG->wwwroot}/my/bookings.php?userid={$userid}\">Bookings</a>";

        return '<div class="picture">'.$user_pic.' <span class="username">'.$user.'</span></div>'.
            '<div class="links">'.$plan_link.'&nbsp;|&nbsp;'.$profile_link.'&nbsp;|&nbsp;'.$booking_link.'&nbsp;|&nbsp;'.$rol_link.'</div>';

    }

    function rb_display_count($result) {
        return $result ? $result : 0;
    }

}

// end of rb_source_user class

