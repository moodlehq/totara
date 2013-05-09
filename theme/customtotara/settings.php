<?php

/**
 * Settings for the customtotara theme
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {

// Logo file setting
$name = 'theme_customtotara/logo';
$title = new lang_string('logo','theme_customtotara');
$description = new lang_string('logodesc', 'theme_customtotara');
$default = "";
$setting = new admin_setting_configfilepicker($name, $title, $description, $default, array('web_image'));
$settings->add($setting);

// favicon file setting
$name = 'theme_customtotara/favicon';
$title = new lang_string('favicon','theme_customtotara');
$description = new lang_string('favicondesc', 'theme_customtotara');
$default = "";
$setting = new admin_setting_configfilepicker($name, $title, $description, $default, array('*.ico'));
$settings->add($setting);

//Link colour setting
$name = 'theme_customtotara/linkcolor';
$title = new lang_string('linkcolor','theme_customtotara');
$description = new lang_string('linkcolordesc', 'theme_customtotara');
$default = '#087BB1';
$previewconfig = array('selector'=>'a', 'style'=>'color');
$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
$settings->add($setting);

//Link visited colour setting
$name = 'theme_customtotara/linkvisitedcolor';
$title = new lang_string('linkvisitedcolor','theme_customtotara');
$description = new lang_string('linkvisitedcolordesc', 'theme_customtotara');
$default = '#087BB1';
$previewconfig = array('selector'=>'a:visited', 'style'=>'color');
$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
$settings->add($setting);

// page header background colour setting
$name = 'theme_customtotara/headerbgc';
$title = new lang_string('headerbgc','theme_customtotara');
$description = new lang_string('headerbgcdesc', 'theme_customtotara');
$default = '#F5F5F5';
$previewconfig = array('selector'=>'#page-header', 'style'=>'backgroundColor');
$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
$settings->add($setting);

// button colour setting
$name = 'theme_customtotara/buttoncolor';
$title = new lang_string('buttoncolor','theme_customtotara');
$description = new lang_string('buttoncolordesc', 'theme_customtotara');
$default = '#E6E6E6';
$previewconfig = array('selector'=>'input[\'type=submit\']]', 'style'=>'background-color');
$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
$settings->add($setting);

// Custom CSS file
$name = 'theme_customtotara/customcss';
$title = new lang_string('customcss','theme_customtotara');
$description = new lang_string('customcssdesc', 'theme_customtotara');
$setting = new admin_setting_configtextarea($name, $title, $description, '');
$settings->add($setting);
}

