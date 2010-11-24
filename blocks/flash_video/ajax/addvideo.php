<?php

	require_once('../../../config.php');
	require_once('../flash_video.class.php');
		
	$courseid = optional_param('courseid', $SITE->id, PARAM_INT);
	$videotitle = optional_param('videotitle', '', PARAM_TEXT);
	$videodescription = optional_param('videodescription', '', PARAM_TEXT);
    $videofile = optional_param('videofile', '', PARAM_FILE);
    $videoimage = optional_param('videoimage', '', PARAM_FILE);
    $videotags = optional_param('videotags', '', PARAM_TEXT);

	$json_object = array('result'=>false);

	if (! $course = get_record("course", "id", $courseid) ) {
		$json_object['error'] = "Error uploading video. Invalid course id";
		print(json_encode($json_object));
		exit;
	}

	$context = get_context_instance(CONTEXT_COURSE, $courseid);

    if(!has_capability('moodle/course:managefiles', $context)) {
		$json_object['error'] = "You do not have permission to upload videos.";
		print(json_encode($json_object));
		exit;
	}
	
	if (! $basedir = make_upload_directory($courseid)) {
		$json_object['error'] = "The site administrator needs to fix the file permissions before videos can be uploaded.";
		print(json_encode($json_object));
		exit;
	}

    if (!is_dir($basedir)) {
        $json_object['error'] = "The upload directory does not exist. Please try again.";
		print(json_encode($json_object));
		exit;
    }

    $video_data = array(
		'title' => array('value'=>$videotitle, 'formfieldname'=>'videotitle', 'description'=>'Video name', 'type'=>FLV_REQUIRED_TEXT, 'valid'=>NULL),
		'tags' => array('value'=>$videotags, 'formfieldname'=>'videotags', 'description'=>'Tags', 'type'=>FLV_TEXT, 'valid'=>NULL),
		'description' => array('value'=>$videodescription, 'formfieldname'=>'videodescription', 'description'=>'Description', 'type'=>FLV_REQUIRED_TEXT, 'valid'=>NULL),
		'videofile' => array('value'=>$videofile, 'formfieldname'=>'videofile', 'description'=>'File', 'type'=>FLV_REQUIRED_FILE, 'valid'=>NULL),
		'videoimage' => array('value'=>$videoimage, 'formfieldname'=>'videoimage', 'description'=>'Thumbnail', 'type'=>FLV_REQUIRED_IMAGE_FILE, 'valid'=>NULL)
	);

	$flash_video = new flash_video();
	$flash_video->init($video_data);
	$video_data = $flash_video->validate();
	
	if (!$flash_video->isvalid()) {
		$error_str = get_string('flashvideo_errors','block_flash_video')."\n\n";
		$error_str .= $flash_video->get_errors();
		$json_object['error'] = $error_str;
		print(json_encode($json_object));
		exit;
	} else {
		if ($flash_video->upload_files($course, $basedir)) {
			if ($flash_video->insert_record($course)) {
				$json_object['result'] = true;
				$json_object['videoid'] = $flash_video->video_id;
				$json_object['videotitle'] = $videotitle;
				print(json_encode($json_object));
				exit;
			} else {
				$json_object['error'] = get_string('flashvideo_insertfailed','block_flash_video');
				print(json_encode($json_object));
				exit;
			}
		} else {
			$json_object['error'] = get_string('flashvideo_submissionfailed','block_flash_video');
			print(json_encode($json_object));
			exit;
		}
	}

	// this should never be reached
	$json_object['error'] = 'An unknown error occurred.';
	print(json_encode($json_object));

?>