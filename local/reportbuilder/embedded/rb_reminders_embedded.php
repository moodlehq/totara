<?php

class rb_reminders_embedded extends rb_base_embedded {

    public $url, $source, $fullname, $filters, $columns;
    public $contentmode, $contentsettings, $embeddedparams;
    public $hidden, $accessmode, $accesssettings, $shortname;

    public function __construct($data) {
        $userid = array_key_exists('userid', $data) ? $data['userid'] : null;
        $roleid = array_key_exists('roleid', $data) ? $data['roleid'] : null;

        $this->url = '/local/totara_msg/reminders.php';
        $this->source = 'totaramessages';
        $this->shortname = 'reminders';
        $this->fullname = get_string('reminders', 'local_totara_msg');
        $this->columns = array(
//        array(
//            'type' => 'message_values',
//            'value' => 'msgstatus',
//            'heading' => 'Status',
//        ),
//            array(
//                'type' => 'message_values',
//                'value' => 'urgency',
//                'heading' => 'Urgency',
//            ),
            array(
                'type' => 'message_values',
                'value' => 'msgtype',
                'heading' => 'Type',
            ),
            array(
                'type' => 'user',
                'value' => 'namelink',
                'heading' => 'Name',
            ),
            array(
                'type' => 'message_values',
                'value' => 'statement',
                'heading' => 'Details',
            ),
                array(
                'type' => 'message_values',
                'value' => 'sent',
                'heading' => 'Sent',
            ),
                array(
                'type' => 'message_values',
                'value' => 'reminder_links',
//            'heading' => 'Actions &nbsp;',
                'heading' =>
                             '<div id="totara_msg_selects" style="display: none;">'.
                             '<a href="" onclick="jqCheckAll(\'totara_messages\', \'totara_message\', 1); return false;">all</a>/'.
                             '<a href="" onclick="jqCheckAll(\'totara_messages\', \'totara_message\', 0); return false;">none</a>',
//                         '</div><noscript>Actions</noscript>',
        ),
//            array(
//            'type' => 'message_values',
//            'value' => 'checkbox',
//            'heading' => '<a href="" onclick="jqCheckAll(\'totara_messages\', \'totara_message\', 1); return false;">all</a>/'.
//                         '<a href="" onclick="jqCheckAll(\'totara_messages\', \'totara_message\', 0); return false;">none</a>',
//        ),
            array(
            'type' => 'message_values',
            'value' => 'msgid',
            'heading' => 'Id',
            'hidden' => 1,
            'noexport' => true,
            ),
        );

        $this->filters = array(
            array(
                    'type' => 'user',
                    'value' => 'fullname',
                    'advanced' => 1,
                ),
            array(
                    'type' => 'message_values',
                    'value' => 'msgtype',
                    'advanced' => 0,
                ),
    //        array(
    //                'type' => 'message_values',
    //                'value' => 'msgstatus',
    //                'advanced' => 1,
    //            ),
    //        array(
    //                'type' => 'message_values',
    //                'value' => 'urgency',
    //                'advanced' => 1,
    //            ),
            array(
                    'type' => 'message_values',
                    'value' => 'statement',
                    'advanced' => 1,
                ),
            array(
                    'type' => 'message_values',
                    'value' => 'sent',
                    'advanced' => 1,
                ),
        );

        // no restrictions
        $this->contentmode = REPORT_BUILDER_CONTENT_MODE_NONE;

        // only show reminders, not notifications
        $this->embeddedparams = array(
            'name' => '\'totara_reminder\''
        );
        // also limited to single user
        if(isset($userid)) {
            $this->embeddedparams['userid'] = $userid;
        }
        // also limited by role
        if(isset($roleid)) {
            $this->embeddedparams['roleid'] = $roleid;
        }

        parent::__construct();
    }
}
