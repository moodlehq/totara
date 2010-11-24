<?php

	require_once('../../../config.php');
		
	$courseid = optional_param('id', $SITE->id, PARAM_INT);
	$instanceid = optional_param('instanceid', 0, PARAM_INT);
	$playlist = optional_param('playlist', '', PARAM_TEXT);
	$action = optional_param('action', '', PARAM_TEXT);

	$json_object = array('result'=>false);

	if (! $course = get_record("course", "id", $courseid) ) {
		$json_object['error'] = "Invalid course id";
		print(json_encode($json_object));
		exit;
	}

	$context = get_context_instance(CONTEXT_COURSE, $courseid);

    if(!has_capability('moodle/course:managefiles', $context)) {
		$json_object['error'] = "You do not have permission to manage playlists.";
		print(json_encode($json_object));
		exit;
	}
	
	if (!$block_instance = get_record('block_instance', 'id', $instanceid)) { //Find configdata for my block.
		$json_object['error'] = "Incorrect block instance ID.";
		print(json_encode($json_object));
		exit;
	}
	
	$flash_block = block_instance('flash_video', $block_instance);
	$flash_playlist = '';
	
	if (isset($playlist) && !empty($playlist)) {
		$flash_playlist = $playlist;
	} else if (isset($flash_block->config->playlist)) {
		$flash_playlist = $flash_block->config->playlist;
	}
	
	if($action == 'showplaylist') {
		if(empty($flash_playlist)) {
			$json_object = array('result'=>true);
			$json_object['html'] = "No playlist to display.";
			print(json_encode($json_object));
			exit;
		} else {
			$videoids = explode(',', $flash_playlist);
			$html = '<ul>';
			$videocount = 0;
			foreach($videoids as $videoid) {
				if($video = get_record('block_flash_video', 'id', $videoid)) {
					$html .= '<li>'.$video->title.' | <a href="#" onClick="removeFromPlaylist('.$videocount.')">Remove</a></li>';
				}
				$videocount++;
			}
			$html .= '</ul>';
			$json_object = array('result'=>true);
			$json_object['html'] = $html;
			print(json_encode($json_object));
			exit;
		}		
	}
	
	// this should never be reached
	$json_object['error'] = 'An unknown error occurred.';
	print(json_encode($json_object));

?>