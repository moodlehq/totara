<?php  //$Id: settings.php,v 1.1.2.1 2010/03/08 21:38:52 agrabs Exp $

    $options = array(0=>get_string('no'), 1=>get_string('yes'));
    $str = get_string('configallowfullanonymous', 'feedback');
    $settings->add(new admin_setting_configselect('feedback_allowfullanonymous', get_string('allowfullanonymous', 'feedback'),
                   $str, 0, $options));

?>
