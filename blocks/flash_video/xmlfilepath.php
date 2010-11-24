<?php

	require_once('../../config.php');

	$id = optional_param('id', 0, PARAM_INT);
	
	// create a SimpleXMLElement object to generate the XML
	$sxe = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8" ?><flvplayer></flvplayer>');

	if(!$id) {
		header('Content-Type: text/xml'); 
		echo $sxe->asXML();
		exit;
	}
	
	if(!$video = get_record('block_flash_video', 'id', $id)) {
		header('Content-Type: text/xml'); 
		echo $sxe->asXML();
		exit;
	}
		
	$flvfile = $CFG->wwwroot.'/file.php/'.$video->course.'/'.$video->filename;
	$videotitle = $video->title;
	$videodescription = $video->description;
	
	$sxe->addChild('headerflv', $flvfile);
	$sxe->addChild('FLVTitle', $videotitle);
	$sxe->addChild('FLVDescription', $videodescription);

	header('Content-Type: text/xml'); 
	echo $sxe->asXML();
	exit;
		
?>