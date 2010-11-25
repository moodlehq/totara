<?php

	require_once('../../config.php');

	//$id = optional_param('id', 0, PARAM_INT);
	
	// create a SimpleXMLElement object to generate the XML
	$sxe = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8" ?><flvplayer></flvplayer>');

	/*if(!$id) {
		header('Content-Type: text/xml'); 
		echo $sxe->asXML();
		exit;
	}
	
	if(!$video = get_record('block_flash_video', 'id', $id)) {
		header('Content-Type: text/xml'); 
		echo $sxe->asXML();
		exit;
    }*/
		
	$buttons = $sxe->addChild('buttonImages');

	$buttons->addChild('playNormal', $CFG->wwwroot.'/blocks/flash_video/player/images/playButtonNormal.png');
	$buttons->addChild('playOver', $CFG->wwwroot.'/blocks/flash_video/player/images/playButtonOver.png');
	$buttons->addChild('playDown', $CFG->wwwroot.'/blocks/flash_video/player/images/playButtonDown.png');
	$buttons->addChild('playDisabled', $CFG->wwwroot.'/blocks/flash_video/player/images/playButtonDisabled.png');

	$buttons->addChild('stopNormal', $CFG->wwwroot.'/blocks/flash_video/player/images/stopButtonNormal.png');
	$buttons->addChild('stopOver', $CFG->wwwroot.'/blocks/flash_video/player/images/stopButtonOver.png');
	$buttons->addChild('stopDown', $CFG->wwwroot.'/blocks/flash_video/player/images/stopButtonDown.png');
	$buttons->addChild('stopDisabled', $CFG->wwwroot.'/blocks/flash_video/player/images/stopButtonDisabled.png');

	$sxe->addChild('seekHex', '0xFF0000');
			
	header('Content-Type: text/xml'); 
	echo $sxe->asXML();
	exit;
		
?>
