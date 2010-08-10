<?php // $I$

require_once $CFG->dirroot.'/idp/lib.php';

//This file defines settingspages and externalpages under the "IDP" section
//TODO: Change capaiblities to IDP specific


if (has_capability('moodle/grade:manage', $systemcontext)){

    //General settings
    $temp = new admin_settingpage('idpsettings', get_string('generalsettings', 'idp'), 'moodle/grade:manage');
    if($ADMIN->fulltree) {

        //Start date
        $temp->add(new admin_setting_configtext('idp_start_date', get_string('setting:startdate', 'idp'), get_string('setting:configstartdate', 'idp'), date("d/m/Y", time()), PARAM_TEXT));
        $temp->add(new admin_setting_configtext('idp_end_date', get_string('setting:enddate', 'idp'), get_string('setting:configenddate', 'idp'), date("d/m/Y", time()), PARAM_TEXT));

        $temp->add(new admin_setting_configcheckbox('idp_competencyaddfrompos', get_string('setting:competencyaddfromposition', 'idp'), get_string('setting:configcompetencyaddfromposition', 'idp'), 0, PARAM_INT));

        $temp->add(new admin_setting_configselect('idp_duedates', get_string('setting:duedates', 'idp'), null, 0,
            array(IDP_NO => get_string('setting:duedateno', 'idp'),
                  IDP_OPT => get_string('setting:duedateopt', 'idp'),
                  IDP_REQ => get_string('setting:duedatereq', 'idp'))));

        $temp->add(new admin_setting_configcheckbox('idp_priorities', get_string('setting:priorities', 'idp'), null, 0, PARAM_INT));

        $temp->add(new admin_setting_configcheckbox('idp_enableeval', get_string('setting:enableeval', 'idp'), get_string('setting:configenableeval', 'idp'), 2, PARAM_INT));
        $temp->add(new admin_setting_configcheckbox('idp_showlearnrec', get_string('setting:showlearnrec', 'idp'), get_string('setting:configshowlearnrec', 'idp'), 2, PARAM_INT));

    }

    $ADMIN->add('idp', $temp);

    $ADMIN->add('idp', new admin_externalpage('idptemplate', get_string('managetemplates','idp'), $CFG->wwwroot.'/idp/settings/index.php?id=1'));

    $ADMIN->add('idp', new admin_externalpage('idppriorities', get_string('priorityscales', 'idp'), $CFG->wwwroot.'/idp/priority/index.php'));

}

?>
