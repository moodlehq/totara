<?php

class rb_pastbookings_embedded extends rb_base_embedded {

    public $url, $source, $fullname, $filters, $columns;
    public $contentmode, $contentsettings, $embeddedparams;
    public $hidden, $accessmode, $accesssettings, $shortname;

    public function __construct($data) {
        $userid = array_key_exists('userid', $data) ? $data['userid'] : null;

        $this->url = '/my/pastbookings.php';
        $this->source = 'facetoface_sessions';
        $this->shortname = 'pastbookings';
        $this->fullname = get_string('mypastbookings', 'local');
        $this->columns = array(
            array(
                'type' => 'course',
                'value' => 'courselink',
                'heading' => 'Course Name',
            ),
            array(
                'type' => 'facetoface',
                'value' => 'name',
                'heading' => 'Session Name',
            ),
            array(
                'type' => 'date',
                'value' => 'sessiondate',
                'heading' => 'Session Date',
            ),
            array(
                'type' => 'date',
                'value' => 'timestart',
                'heading' => 'Start Time',
            ),
            array(
                'type' => 'date',
                'value' => 'timefinish',
                'heading' => 'End Time',
            ),
        );

        // only add facilitator column if role exists
        if(get_field('role','id','shortname','facilitator')) {
            $this->columns[] = array(
                'type' => 'role',
                'value' => 'facilitator',
                'heading' => 'Facilitator',
            );
        }

        // no filters
        $this->filters = array();

        // only show future bookings
        $this->contentmode = REPORT_BUILDER_CONTENT_MODE_ALL;
        $this->contentsettings = array(
            'date' => array(
                'enable' => 1,
                'when' => 'past',
            ),
        );

        // also limited to single user by embedded params
        $this->embeddedparams = array();
        if(isset($userid)) {
            $this->embeddedparams['userid'] = $userid;
        }

        parent::__construct();
    }
}
