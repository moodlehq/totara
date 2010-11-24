<?php

function get_course_options() {
	global $SITE;

	$options = '';
	if($courses = get_records('course', '', '', 'id ASC')) {
		foreach($courses as $course) {
			$course_name = $course->fullname;
			$course_id = $course->id;
			if($course->id == $SITE->id) {
				//$course_id = 0;
				$course_name = 'All courses';
			}
			$options .= '<option value="'.$course_id.'">'.$course_name.'</option>';
		}
	}
	return $options;
}

function used_in_playlists($videoid) {

	$courselist = array();

	// determine the id number of the flash video block type entry
	if(!$flash_video_block_id = get_field('block', 'id', 'name', 'flash_video')) {
		return false;
	}

	// retrieve all instances of flash video blocks
	if(!$flash_block_instances = get_records('block_instance', 'blockid', $flash_video_block_id)) {
		return false;
	}

	// determine if any playlists in flash video block instances contain the video id passed to this function
	foreach($flash_block_instances as $flash_block_instance) {

		// retrieve the config data for this instance
		$flash_block = block_instance('flash_video', $flash_block_instance);
		$flash_playlist = array();

		// retrieve the block instance playlist and convert it to an array
		if (isset($flash_block->config->playlist)) {
			$flash_playlist = explode(',', $flash_block->config->playlist);
		}

		// determine whether ro not the video is used in the current playlist and add it to an array if it does
		if(in_array($videoid, $flash_playlist)) {
			if(!in_array($flash_block_instance->pageid, $courselist)) {
				$courselist[] = $flash_block_instance->pageid;
			}
		}
	}

	if(empty($courselist)) {
		return false;
	} else {
		return $courselist;
	}
}


function delete_video_file($videoid) {
	if(!$video = get_record('block_flash_video', 'id', $videoid)) {
		return false;
	}

	if (! $basedir = make_upload_directory($video->course)) {
		return false;
	}

    if (!is_dir($basedir)) {
		return false;
    }

	if(!file_exists($basedir .'/'. $video->filename)) {
		return false;
	}

	if(!unlink($basedir .'/'. $video->filename)) {
		return false;
	}

	return true;
}
?>
