<?php  //$Id$

    require_once($CFG->dirroot.'/mod/facetoface/lib.php');

      $settings->add(new admin_setting_configtext('facetoface_fromaddress', get_string('setting:fromaddress_caption', 'facetoface'),get_string('setting:fromaddress', 'facetoface'), get_string('setting:fromaddressdefault', 'facetoface'), "/^((?:[\w\.\-])+\@(?:(?:[a-zA-Z\d\-])+\.)+(?:[a-zA-Z\d]{2,4}))$/",30));
      

      $settings->add(new admin_setting_configtext('facetoface_manageraddressformat', get_string('setting:manageraddressformat_caption', 'facetoface'),get_string('setting:manageraddressformat', 'facetoface'), get_string('setting:manageraddressformatdefault', 'facetoface'), PARAM_TEXT));
      

      $settings->add(new admin_setting_configtext('facetoface_manageraddressformatreadable', get_string('setting:manageraddressformatreadable_caption', 'facetoface'),get_string('setting:manageraddressformatreadable', 'facetoface'), get_string('setting:manageraddressformatreadabledefault', 'facetoface'), PARAM_NOTAGS));
      

      $settings->add(new admin_setting_configcheckbox('facetoface_addchangemanageremail', get_string('setting:addchangemanageremail_caption', 'facetoface'),get_string('setting:addchangemanageremail', 'facetoface'), get_string('setting:addchangemanageremaildefault', 'facetoface'), PARAM_BOOL));
      

      $settings->add(new admin_setting_configcheckbox('facetoface_hidecost', get_string('setting:hidecost_caption', 'facetoface'),get_string('setting:hidecost', 'facetoface'), get_string('setting:hidecostdefault', 'facetoface'), PARAM_BOOL));
      

      $settings->add(new admin_setting_configcheckbox('facetoface_hidediscount', get_string('setting:hidediscount_caption', 'facetoface'),get_string('setting:hidediscount', 'facetoface'), get_string('setting:hidediscountdefault', 'facetoface'), PARAM_BOOL));
      

      $settings->add(new admin_setting_configcheckbox('facetoface_oneemailperday', get_string('setting:oneemailperday_caption', 'facetoface'),get_string('setting:oneemailperday', 'facetoface'), get_string('setting:oneemailperdaydefault', 'facetoface'), PARAM_BOOL));
      

      $settings->add(new admin_setting_configcheckbox('facetoface_disableicalcancel', get_string('setting:disableicalcancel_caption', 'facetoface'),get_string('setting:disableicalcancel', 'facetoface'), get_string('setting:disableicalcanceldefault', 'facetoface'), PARAM_BOOL));
      

?>


