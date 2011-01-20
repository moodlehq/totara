<?php

class rb_plan_objectives_embedded extends rb_base_embedded {

    public $url, $source, $fullname, $filters, $columns;
    public $contentmode, $contentsettings, $embeddedparams;
    public $hidden, $accessmode, $accesssettings, $shortname;

    public function __construct($data) {
        $userid = array_key_exists('userid', $data) ? $data['userid'] : null;
        $planstatus = array_key_exists('planstatus', $data) ? $data['planstatus'] : null;

        $this->url = '/local/plan/record/objectives.php';
        $this->source = 'dp_objective';
        $this->shortname = 'plan_objectives';
        $this->fullname = get_string('recordoflearningobjectives', 'local_plan');
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
                'type' => 'objective',
                'value' => 'fullnamelink',
                'heading' => 'Objective Name',
            ),
            array(
                'type' => 'objective',
                'value' => 'description',
                'heading' => 'Objective Description',
            ),
            array(
                'type' => 'objective',
                'value' => 'priority',
                'heading' => 'Priority',
            ),
            array(
                'type' => 'objective',
                'value' => 'duedate',
                'heading' => 'Due date',
            ),
            array(
                'type' => 'objective',
                'value' => 'proficiencyandapproval',
                'heading' => 'Status'
            ),
        );

        $this->filters = array(
            array(
                'type' => 'objective',
                'value' => 'fullname',
                'advanced' => 0,
            ),
            array(
                'type' => 'objective',
                'value' => 'priority',
                'advanced' => 1,
            ),
            array(
                'type' => 'objective',
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
