<?php

	require_once('../../../config.php');
		
	$courseid = optional_param('courseid', 0, PARAM_INT);
	$videotitle = optional_param('videotitle', '', PARAM_TEXT);
    $videotag = optional_param('videotag', '', PARAM_TEXT);
    $pagenum = optional_param('pagenum', '1', PARAM_INT);

	$context = get_context_instance(CONTEXT_COURSE, $SITE->id);

	$sql = "SELECT * FROM {$CFG->prefix}block_flash_video";
	
	$where_added = false;
	
	if ($courseid && ($courseid != $SITE->id)) {
		if(!$where_added) { $sql .= " WHERE"; }
		else {$sql .= " AND"; }
		$where_added = true;
		$sql .= " course = $courseid";
	}
	
	if ($videotitle) {
		if(!$where_added) { $sql .= " WHERE"; }
		else {$sql .= " AND"; }
		$where_added = true;
		$sql .= " title LIKE '%$videotitle%'";
	}
	
	if ($videotag) {
		if(!$where_added) { $sql .= " WHERE"; }
		else {$sql .= " AND"; }
		$where_added = true;
		$sql .= " tags LIKE '%$videotag%'";
	}
	
	$flash_videos = get_records_sql($sql);
	
	if(!$flash_videos) {
		print "No videos to display.";
		exit;
	} else {
		$table = new object();
		$table->head = array('Name', 'Course', 'Tags', 'Actions');
		foreach($flash_videos as $video) {
			if($video->course == $SITE->id) {
				$course_fullname = 'Global';
			} else {
				$course_fullname = get_field('course', 'fullname', 'id', $video->course);
			}
			
			$chooselink = '<a href="#" onClick="addToPlaylist('.$video->id.', \''.$video->title.'\'); return false;">Choose</a>';
			$editlink = '<a href="#" onClick="showEditVideoDialog('.$video->id.'); return false;">Edit</a>';
			$deletelink = '<a href="#" onClick="confirmDeleteVideo('.$video->id.'); return false;">Delete</a>';
			$table->data[] = array($video->title, $course_fullname, $video->tags, $chooselink.' | '.$editlink.' | '.$deletelink);
		}
		print_table($table);
		exit;
	}

	// this should never be reached
	print('An unknown error occurred.');

?>