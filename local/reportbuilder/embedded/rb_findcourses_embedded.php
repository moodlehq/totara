<?php

class rb_findcourses_embedded extends rb_base_embedded {

    public $url, $source, $fullname, $filters, $columns;
    public $contentmode, $contentsettings, $embeddedparams;
    public $hidden, $accessmode, $accesssettings, $shortname;

    public function __construct($data) {
        $this->url = '/course/find.php';
        $this->source = 'courses';
        $this->shortname = 'findcourses';
        $this->fullname = get_string('findcourses', 'local');
        $this->columns = array(
            array(
                'type' => 'course',
                'value' => 'courselinkicon',
                'heading' => 'Course Name',
            ),
            array(
                'type' => 'course_category',
                'value' => 'namelinkicon',
                'heading' => 'Category',
            ),
            array(
                'type' => 'course',
                'value' => 'startdate',
                'heading' => 'Start date',
            ),
            array(
                'type' => 'course',
                'value' => 'mods',
                'heading' => 'Content',
            ),
        );

        // no filters
        $this->filters = array(
            array(
                'type' => 'course',
                'value' => 'name_and_summary',
                'advanced' => 0,
            ),
            array(
                'type' => 'course',
                'value' => 'mods',
                'advanced' => 0,
            ),
            array(
                'type' => 'course_category',
                'value' => 'id',
                'advanced' => 1,
            ),
            array(
                'type' => 'course',
                'value' => 'startdate',
                'advanced' => 1,
            ),
        );

        // no restrictions
        $this->contentmode = REPORT_BUILDER_CONTENT_MODE_NONE;

        // don't include the front page (site-level course)
        $this->embeddedparams = array(
            'category' => '!0',
        );

        $context = get_context_instance(CONTEXT_SYSTEM);
        if(!has_capability('moodle/site:doanything', $context)) {
            // don't show hidden courses to none-admins
            $this->embeddedparams['visible'] = 1;
        }

        parent::__construct();
    }
}
