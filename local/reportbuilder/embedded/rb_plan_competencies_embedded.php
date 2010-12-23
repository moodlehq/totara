<?php

class rb_plan_competencies_embedded extends rb_base_embedded {

    public $url, $source, $fullname, $filters, $columns;
    public $contentmode, $contentsettings, $embeddedparams;
    public $hidden, $accessmode, $accesssettings, $shortname;

    public function __construct($data) {
        $userid = array_key_exists('userid', $data) ? $data['userid'] : null;
        $planstatus = array_key_exists('planstatus', $data) ? $data['planstatus'] : null;

        $this->url = '/local/plan/record/competencies.php';
        $this->source = 'dp_competency';
        $this->shortname = 'plan_competencies';
        $this->fullname = get_string('recordoflearningcompetencies', 'local_plan');
        $this->columns = array(
            array(
                'type' => 'plan',
                'value' => 'planlink',
                'heading' => 'Plan',
            ),
            array(
                'type' => 'plan',
                'value' => 'status',
                'heading' => 'Plan status'
            ),
            array(
                'type' => 'competency',
                'value' => 'fullname',
                'heading' => 'Competency',
            ),
            array(
                'type' => 'competency',
                'value' => 'priority',
                'heading' => 'Priority',
            ),
            array(
                'type' => 'competency',
                'value' => 'duedate',
                'heading' => 'Due date',
            ),
            array(
                'type' => 'competency',
                'value' => 'proficiency',
                'heading' => 'Proficiency'
            ),
        );

        $this->filters = array(
            array(
                'type' => 'competency',
                'value' => 'fullname',
                'advanced' => 0,
            ),
            array(
                'type' => 'competency',
                'value' => 'priority',
                'advanced' => 1,
            ),
            array(
                'type' => 'competency',
                'value' => 'duedate',
                'advanced' => 1,
            ),
            array(
                'type' => 'plan',
                'value' => 'name',
                'advanced' => 1,
            ),
        );

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
