<?php

class rb_course_completions_embedded extends rb_base_embedded {

    public $url, $source, $fullname, $filters, $columns;
    public $contentmode, $contentsettings, $embeddedparams;
    public $hidden, $accessmode, $accesssettings, $shortname;

    public function __construct($data) {
        $userid = array_key_exists('userid', $data) ? $data['userid'] : null;

        $this->url = '/my/coursecompletions.php';
        $this->source = 'course_completion';
        $this->shortname = 'course_completions';
        $this->fullname = get_string('mycoursecompletions', 'local');
        $this->columns = array(
            array(
                'type' => 'course',
                'value' => 'courselink',
                'heading' => 'Course',
            ),
            array(
                'type' => 'course_completion',
                'value' => 'status',
                'heading' => 'Status',
            ),
            array(
                'type' => 'course_completion',
                'value' => 'completeddate',
                'heading' => 'Date Completed',
            ),
            array(
                'type' => 'course_completion',
                'value' => 'organisation',
                'heading' => 'Completed At',
            ),
            array(
                'type' => 'course_completion',
                'value' => 'position',
                'heading' => 'Completed As',
            ),
        );

        // no filters
        $this->filters = array();

        // no restrictions
        $this->contentmode = REPORT_BUILDER_CONTENT_MODE_NONE;

        // also limited to single user by embedded params
        $this->embeddedparams = array();
        if(isset($userid)) {
            $this->embeddedparams['userid'] = $userid;
        }

        parent::__construct();
    }
}
