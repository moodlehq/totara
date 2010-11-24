<?php

	require_once('../../../config.php');
	require_once('../lib.php');
		
	$id = optional_param('id', 0, PARAM_INT);
	$videotitle = optional_param('videotitle', '', PARAM_TEXT);
	$videodescription = optional_param('videodescription', '', PARAM_TEXT);
    $videotags = optional_param('videotags', '', PARAM_TEXT);
    $action = optional_param('action', '', PARAM_TEXT);
	
	$json_object = array('result'=>false);

    if(!$id) {
		$json_object['error'] = "Invalid video ID";
		print(json_encode($json_object));
		exit;
	}

	$context = get_context_instance(CONTEXT_COURSE, $SITE->id);

    if(!has_capability('moodle/course:managefiles', $context)) {
		$json_object['error'] = "You do not have permission to edit videos.";
		print(json_encode($json_object));
		exit;
	}
	
	if($action=='getfields') {
		if($video = get_record('block_flash_video', 'id', $id)) {
			$json_object['result'] = true;
			$json_object['videoid'] = $video->id;
			$json_object['videotitle'] = $video->title;
			$json_object['videodescription'] = $video->description;
			$json_object['videotags'] = $video->tags;
		} else {
			$json_object['error'] = 'Invalid video ID';
		}
		print(json_encode($json_object));
		exit;
	} else if($action=='confirmdelete') {
		$json_object['result'] = true;
		$json_object['videoid'] = $id;
		if(!$courseids = used_in_playlists($id)) {
			$json_object['playlist_links_msg'] = 'This video is not currently used in any side blocks.';
		} else {
			$msg = "This video is currently used in one or more side blocks in the following courses:\n";
			foreach($courseids as $courseid) {
				if($coursedetails = get_record('course', 'id', $courseid)) {
					$msg .= "\n- ".$coursedetails->fullname;
				}
			}
			$json_object['playlist_links_msg'] = $msg;
		}
		print(json_encode($json_object));
		exit;
	} else if($action=='delete') {

		delete_video_file($id);
		
		if(delete_records('block_flash_video', 'id', $id)) {
			$json_object['result'] = true;
		} else {
			$json_object['error'] = 'Unable to delete video';
		}

		print(json_encode($json_object));
		exit;
	} else {
		$record = new object();
		$record->id = $id;
		$record->title = $videotitle;
		$record->description = $videodescription;
		$record->tags = $videotags;
		if(update_record('block_flash_video', $record)) {
			$json_object['result'] = true;
		} else {
			$json_object['error'] = 'Unable to update record';
		}
		print(json_encode($json_object));
		exit;
	}
	
	// this should never be reached
	$json_object['error'] = 'An unknown error occurred.';
	print(json_encode($json_object));

?>