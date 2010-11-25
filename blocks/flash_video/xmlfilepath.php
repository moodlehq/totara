<?php

    require_once('../../config.php');

    $role = optional_param('role', '', PARAM_ALPHA);

    // create a SimpleXMLElement object to generate the XML
	$sxe = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8" ?><flvplayer></flvplayer>');

    switch ($role) {
    case 'admin' :
        break;
    case 'administrator' :
        break;
    case 'manager' :
        $flvfile = $CFG->wwwroot.'/blocks/flash_video/videos/manager.flv';
        $videotitle = 'Manager';
        $videodescription = 'Manager Video';
        break;
    case 'teacher' :
        break;
    case 'trainer' :
        break;
    case 'student' :
        $flvfile = $CFG->wwwroot.'/blocks/flash_video/videos/student.flv';
        $videotitle = 'Student';
        $videodescription = 'Mobility Scooter Race!!!';
        break;
    default:
        $flvfile = $CFG->wwwroot.'/blocks/flash_video/videos/scooter.flv';
        $videotitle = 'scooter';
        $videodescription = 'Mobility Scooter Race!!!';
        break;
    }

	$sxe->addChild('headerflv', $flvfile);
	$sxe->addChild('FLVTitle', $videotitle);
	$sxe->addChild('FLVDescription', $videodescription);

	header('Content-Type: text/xml');
	echo $sxe->asXML();
	exit;

?>
