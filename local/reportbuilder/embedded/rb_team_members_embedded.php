<?php

class rb_team_members_embedded extends rb_base_embedded {

    public $url, $source, $fullname, $filters, $columns;
    public $contentmode, $contentsettings, $embeddedparams;
    public $hidden, $accessmode, $accesssettings, $shortname;

    public function __construct($data) {
        $this->url = '/my/teammembers.php';
        $this->source = 'user';
        $this->shortname = 'team_members';
        $this->fullname = get_string('teammembers', 'local');
        $this->columns = array(
            array(
                'type' => 'user',
                'value' => 'namelinkicon',
                'heading' => 'Name'
            ),
            array(
                'type' => 'user',
                'value' => 'lastlogin',
                'heading' => 'Last Login'
            ),
            array(
                'type' => 'statistics',
                'value' => 'coursesstarted',
                'heading' => 'Courses Started'
            ),
            array(
                'type' => 'statistics',
                'value' => 'coursescompleted',
                'heading' => 'Courses Completed'
            ),
            array(
                'type' => 'statistics',
                'value' => 'competenciesachieved',
                'heading' => 'Competencies Achieved'
            ),
            array(
                'type' => 'user',
                'value' => 'userlearningicons',
                'heading' => 'Links',
            ),
        );

        // no filters
        $this->filters = array();

        // only show future bookings
        $this->contentmode = REPORT_BUILDER_CONTENT_MODE_ALL;
        $this->contentsettings = array(
            'user' => array(
                'enable' => 1,
                'who' => 'reports'
            )
        );

        parent::__construct();
    }
}
