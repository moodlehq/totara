<?php

if ($hassiteconfig) { // speedup for non-admins, add all caps used on this page

    $optionalsubsystems->add(new admin_setting_configcheckbox('enableoutcomes', get_string('enableoutcomes', 'grades'), get_string('enableoutcomes_help', 'grades'), 0));
    $optionalsubsystems->add(new admin_setting_configcheckbox('usecomments', get_string('enablecomments', 'admin'), get_string('configenablecomments', 'admin'), 1));

    $optionalsubsystems->add(new admin_setting_configcheckbox('usetags', get_string('usetags','admin'),get_string('configusetags', 'admin'), '1'));

    $optionalsubsystems->add(new admin_setting_configcheckbox('enablenotes', get_string('enablenotes', 'notes'), get_string('configenablenotes', 'notes'), 1));

    $optionalsubsystems->add(new admin_setting_configcheckbox('enableportfolios', get_string('enabled', 'portfolio'), get_string('enableddesc', 'portfolio'), 0));

    $optionalsubsystems->add(new admin_setting_configcheckbox('enablewebservices', get_string('enablewebservices', 'admin'), get_string('configenablewebservices', 'admin'), 0));

    $optionalsubsystems->add(new admin_setting_configcheckbox('messaging', get_string('messaging', 'admin'), get_string('configmessaging','admin'), 1));

    $optionalsubsystems->add(new admin_setting_configcheckbox('messaginghidereadnotifications', get_string('messaginghidereadnotifications', 'admin'), get_string('configmessaginghidereadnotifications','admin'), 0));

    $options = array(DAYSECS=>get_string('secondstotime86400'), WEEKSECS=>get_string('secondstotime604800'), 2620800=>get_string('nummonths', 'moodle', 1), 15724800=>get_string('nummonths', 'moodle', 6),0=>get_string('never'));
    $optionalsubsystems->add(new admin_setting_configselect('messagingdeletereadnotificationsdelay', get_string('messagingdeletereadnotificationsdelay', 'admin'), get_string('configmessagingdeletereadnotificationsdelay', 'admin'), 604800, $options));

    $optionalsubsystems->add(new admin_setting_configcheckbox('enablestats', get_string('enablestats', 'admin'), get_string('configenablestats', 'admin'), 0));

    $optionalsubsystems->add(new admin_setting_configcheckbox('enablerssfeeds', get_string('enablerssfeeds', 'admin'), get_string('configenablerssfeeds', 'admin'), 0));

    $optionalsubsystems->add(new admin_setting_bloglevel('bloglevel', get_string('bloglevel', 'admin'),
                                get_string('configbloglevel', 'admin'), 4, array(5 => get_string('worldblogs','blog'),
                                                                                 4 => get_string('siteblogs','blog'),
                                                                                 1 => get_string('personalblogs','blog'),
                                                                                 0 => get_string('disableblogs','blog'))));

    $options = array('off'=>get_string('off', 'mnet'), 'strict'=>get_string('on', 'mnet'));
    $optionalsubsystems->add(new admin_setting_configselect('mnet_dispatcher_mode', get_string('net', 'mnet'), get_string('configmnet', 'mnet'), 'off', $options));

    // Conditional activities: completion and availability
    $optionalsubsystems->add(new admin_setting_configcheckbox('enablecompletion',
        get_string('enablecompletion','completion'),
        get_string('configenablecompletion','completion'), 0));
    $optionalsubsystems->add($checkbox = new admin_setting_configcheckbox('enableavailability',
        get_string('enableavailability','condition'),
        get_string('configenableavailability','condition'), 0));
    $checkbox->set_affects_modinfo(true);

    // Course RPL
    $optionalsubsystems->add(new admin_setting_configcheckbox('enablecourserpl', get_string('enablecourserpl', 'completion'), get_string('configenablecourserpl', 'completion'), 1));

    // Module RPLs
    // Get module list
    if ($modules = $DB->get_records("modules")) {
        // Default to all
        $defaultmodules = array();

        foreach ($modules as $module) {
            $strmodulename = get_string("modulename", "$module->name");
            // Deal with modules which are lacking the language string
            if ($strmodulename == '[[modulename]]') {
                $strmodulename = $module->name;
            }
            $modulebyname[$module->id] = $strmodulename;
            $defaultmodules[] = $module->id;
        }
        asort($modulebyname, SORT_LOCALE_STRING);

        $optionalsubsystems->add(new admin_setting_configmulticheckbox(
                        'enablemodulerpl',
                        get_string('enablemodulerpl', 'completion'),
                        get_string('configenablemodulerpl', 'completion'),
                        $defaultmodules,
                        $modulebyname
        ));
    }


    $optionalsubsystems->add(new admin_setting_configcheckbox('enableplagiarism', get_string('enableplagiarism','plagiarism'), get_string('configenableplagiarism','plagiarism'), 0));
}
