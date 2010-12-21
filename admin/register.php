<?php  // $Id$
    require_once('../config.php');
    require_once($CFG->libdir . '/adminlib.php');
    require_once('registerlib.php');
    require_login();

    require_capability('moodle/site:config', get_context_instance(CONTEXT_SYSTEM));

    if (!$site = get_site()) {
        redirect("index.php");
    }

    if (!$admin = get_admin()) {
        error("No admins");
    }

    if (!$admin->country and $CFG->country) {
        $admin->country = $CFG->country;
    }

/// Print headings
    $stradministration = get_string("administration");
    $strregistration = get_string("totararegistration", 'admin');
    $strregistrationinfo = get_string("totararegistrationinfo", 'admin');
    $navlinks = array();
    $navlinks[] = array('name' => $stradministration, 'link' => "../$CFG->admin/index.php", 'type' => 'misc');
    $navlinks[] = array('name' => $strregistration, 'link' => null, 'type' => 'misc');
    $navigation = build_navigation($navlinks);
    print_header("$site->shortname: $strregistration", $site->fullname, $navigation);

    print_heading($strregistration);

    print_simple_box($strregistrationinfo, "center", "70%");


/// Print the form
    require_once($CFG->dirroot . '/admin/register_form.php');
    $mform = new register_form();
    $staticdata = get_registration_data();
    $data = $staticdata;
    $statusmsg = '';
    if ($formdata = $mform->get_data() and confirm_sesskey()) {
        if(isset($formdata->registrationenabled) && (!isset($CFG->registrationenabled) || ($formdata->registrationenabled != $CFG->registrationenabled))) {
            if (set_config('registrationenabled',$formdata->registrationenabled)) {
                $statusmsg = get_string('changessaved');
            }
        }
    } else {
        $registrationstatus = isset($CFG->registrationenabled) ? $CFG->registrationenabled : 0;
        $data['registrationenabled'] = $registrationstatus;
    }
    $mform->set_data($data);
    if (!empty($statusmsg)) {
        print $statusmsg;
    }
    $mform->display();
    if ($CFG->registrationenabled) {
        send_registration_data($staticdata);
    }

    print_footer();

?>
