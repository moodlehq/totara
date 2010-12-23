<?php

class rb_plan_courses_embedded extends rb_base_embedded {

    public $url, $source, $fullname, $filters, $columns;
    public $contentmode, $contentsettings, $embeddedparams;
    public $hidden, $accessmode, $accesssettings, $shortname;

    public function __construct($data) {
        $userid = array_key_exists('userid', $data) ? $data['userid'] : null;
        $planstatus = array_key_exists('planstatus', $data) ? $data['planstatus'] : null;

        $this->url = '/local/plan/record/courses.php';
        $this->source = 'dp_course';
        $this->shortname = 'plan_courses';
        $this->fullname = get_string('recordoflearningcourses', 'local_plan');
        $this->columns = array(
            array(
                'type' => 'course',
                'value' => 'courselink',
                'heading' => 'Course Title',
            ),
            array(
                'type' => 'plan',
                'value' => 'planlink',
                'heading' => 'Plan',
            ),
            array(
                'type' => 'plan',
                'value' => 'status',
                'heading' => 'Plan status',
            ),
            array(
                'type' => 'plan',
                'value' => 'courseduedate',
                'heading' => 'Course due date',
            ),
            array(
                'type' => 'plan',
                'value' => 'coursepriority',
                'heading' => 'Course priority',
            ),
            array(
                'type' => 'course_completion',
                'value' => 'status',
                'heading' => 'Status',
            ),
        );

        // no filters
        $this->filters = array();

        // no restrictions
        $this->contentmode = REPORT_BUILDER_CONTENT_MODE_NONE;

        $this->embeddedparams = array();
        if(isset($userid)) {
            $this->embeddedparams['userid'] = $userid;
        }
        if(isset($planstatus)) {
            $this->embeddedparams['planstatus'] = $planstatus;
        }

        parent::__construct();
    }
}
