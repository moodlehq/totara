<?php

require_once($CFG->dirroot.'/lib/formslib.php'     );
require_once(dirname(__FILE__).'/cron_procfile.php');

class cronsettings_form extends moodleform {

    /**
     * (non-PHPdoc)
     * @see moodleform::definition()
     */
    public function definition() {
        global $CFG;

        $mform =& $this->_form;

        $mform->addElement('header', 'settingsheader', '&nbsp;');

        $data = array();
        for($pos=0; $pos < 73 ;$pos++) {
            $val = (string)$pos;
            $data[$val] = $val;
        }
        $mform->addElement('select',
                           'cron_max_time',
                           get_string('cron_max_time','admin'),
                           $data);
        $mform->setType('cron_max_time', PARAM_INT);
        $mform->setDefault('cron_max_time', 0);

        $mform->addElement('static',
                           'cron_max_time_info',
                           '&nbsp;',
                           get_string('cron_max_time_info','admin'));

        $cwatcher = "<h3 id=\"cron_watcher_info\" class=\"main\">".
                    get_string('cron_watcher_info','admin').
                    "</h3>";
        $mform->addElement('static',
                           'cron_watcher_info',
                           '&nbsp;',
                           $cwatcher);
        $mform->setHelpButton('cron_watcher_info',
                              array('cron_watcher_info',
                                    get_string('cron_watcher_info','admin'), 'moodle'));

        $mform->addElement('checkbox',
                           'cron_max_time_mail_notify',
                            get_string('cron_max_time_mail_notify','admin'),
                            get_string('cron_max_time_mail_notify_info','admin'));
        $mform->setType('cron_max_time_mail_notify', PARAM_BOOL);
        $mform->setDefault('cron_max_time_mail_notify', 0);

        $mform->addElement('checkbox',
                           'cron_max_time_kill',
                            get_string('cron_max_time_kill','admin'),
                            get_string('cron_max_time_kill_info','admin'));
        $mform->setType('cron_max_time_kill', PARAM_BOOL);
        $mform->setDefault('cron_max_time_kill', 0);


        $cstatus = "<h3 id=\"cron_status_info\" class=\"main\">".
                    get_string('cron_status_info','admin').
                    "</h3>";
        $mform->addElement('static',
                           'cron_status_info',
                           '&nbsp;',
                           $cstatus);
        $elements = array();
        $stvalue = '<span id="cron_execution_status">'.cron_status().'</span>';
        $elements[] = $mform->createElement('static',
                                            'cron_execution_status',
                                            get_string('cron_execution_status','admin'),
                                            $stvalue);

        $curl = "{$CFG->wwwroot}/{$CFG->admin}/cron.php";
        $elements[] = $mform->createElement('button',
                                            'cron_execute',
                                            get_string('cron_execute','admin'),
                                            array('onclick' => "cron_redirect_url('{$curl}')"));

        $elements[] = $mform->createElement('button',
                                            'cron_refresh',
                                            get_string('cron_refresh','admin'),
                                            array('onclick' => "cron_refresh()"));

        $mform->addGroup($elements,
                         'cron_execution_watch',
                         get_string('cron_execution_watch','admin'),
                         '<span>&nbsp;&nbsp;</span>');

        $this->add_action_buttons(false);
    }

}

