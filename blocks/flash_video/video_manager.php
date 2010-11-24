<?php 

	/**
	 * Page for configuring the video playlist for a flash video side block instance
	 */

	require_once('../../config.php');
	require_once('lib.php');

	$id = optional_param('id', 0, PARAM_INT);
	$instanceid = optional_param('instanceid', 0, PARAM_INT);
	$sesskey = optional_param('sesskey', '', PARAM_TEXT);
	$blockaction = optional_param('blockaction', 'config', PARAM_TEXT);

	if (!$course = get_record('course', 'id', $id)) {
		require_login();
	}else{
		require_login($course->id);
	}

	if (!$block_instance = get_record('block_instance', 'id', $instanceid)) { //Find configdata for my block.
		error('Incorrect block instance ID');
	}

	$flash_block = block_instance('flash_video', $block_instance);
	$flash_playlist = '';
	$flash_maxvideostodisplay = 5;

	if (isset($flash_block->config->playlist)) {
		$flash_playlist = $flash_block->config->playlist;
	}

	if (isset($flash_block->config->maxvideostodisplay)) {
		$flash_maxvideostodisplay = $flash_block->config->maxvideostodisplay;
	}

	$context = get_context_instance(CONTEXT_COURSE, $id);

    require_capability('moodle/course:managefiles', $context);

	$navlinks = array();
	$navlinks[] = array('name' => 'Flash Video',
						'link' => null,
						'type' => 'misc');
	$title = "$SITE->shortname: Flash Video";
	$fullname = $SITE->fullname;

	$CFG->stylesheets[] = $CFG->wwwroot.'/lib/yui/container/assets/skins/sam/container.css';
	$CFG->stylesheets[] = $CFG->wwwroot.'/blocks/flash_video/styles/videomanager.css';

	require_js(array(
		'yui_yahoo',
		'yui_dom',
		'yui_event',
		'yui_connection',
		'yui_element',
		'yui_button',
		'yui_container',
		$CFG->wwwroot.'/blocks/flash_video/js/videomanager.js',
		$CFG->wwwroot.'/blocks/flash_video/js/videoadder.js',
		$CFG->wwwroot.'/blocks/flash_video/js/videoeditor.js',
		$CFG->wwwroot.'/blocks/flash_video/js/playlist.js')
	);

	$navigation = build_navigation($navlinks);
	print_header($title, $fullname, $navigation);

	$course_options = get_course_options();

	echo '<table id="layout-table" cellspacing="0" class="yui-skin-sam"><tr><td id="middle-column">';

	print_heading('Flash Video block configuration');
?>
	<h3>Playlist</h3>
	<div id="playlistdisplay">Playlist will appear here shortly...</div>
	<p><a href="#" onClick="showVideoManagerDialog(); return false;">Add to playlist...</a></p>
	<form action="<?php print $CFG->wwwroot.'/course/view.php'; ?>" method="post">
		<input type="hidden" name="id" id="id" value="<?php print $id ?>" />
		<input type="hidden" name="instanceid" id="instanceid" value="<?php print $instanceid ?>" />
		<input type="hidden" name="sesskey" value="<?php print $sesskey ?>" />
		<input type="hidden" name="blockaction" value="<?php print $blockaction ?>" />
		<input type="hidden" name="playlist" id="playlist" value="<?php print $flash_playlist ?>" />
		<p><label for="maxvideostodisplay">Number of videos to display:</label>
		<input type="text" name="maxvideostodisplay" id="maxvideostodisplay" value="<?php print $flash_maxvideostodisplay ?>" /></p>
		<p><input type="submit" name="submit" value="Save" /></p>
	</form>

	<div id="videomanager" class="yui-pe-content">
		<div class="hd">
			<h2>Video Manager</h2>
		</div>
		<div class="bd">
			<div id="searchvideos">
				<h3>Search videos</h3>
				<form action="<?php print $CFG->wwwroot.'/blocks/flash_video/ajax/searchvideo.php' ?>" method="get">
					<input type="hidden" name="id" value="<?php print $id ?>" />
					<input type="hidden" name="instanceid" value="<?php print $instanceid ?>" />
					<input type="hidden" name="sesskey" value="<?php print $sesskey ?>" />
					<input type="hidden" name="blockaction" value="<?php print $blockaction ?>" />
					<label for="search_videotitle">Video name:</label>
					<input type="text" name="videotitle" id="search_videotitle" />
					<label for="search_videotag">Tagged:</label>
					<input type="text" name="videotag" id="search_videotag" />
					<label for="search_courseid">Course:</label>
					<select name="courseid" id="search_courseid">
					<?php print $course_options ?>
					</select>
					<input type="submit" name="submit" value="Search" />
				</form>
			</div>
			<p><a href="#" onClick="showAddVideoDialog(); return false;">Add new video...</a></p>
			<div id="searchresults">
				<h3>Search results</h3>
				<div id="resultstable">Results will go here</div>
			</div>
		</div>
	</div>

	<div id="videoadder" class="yui-pe-content">
		<div class="hd">
			<h2>Add New Video</h2>
		</div>
		<div class="bd">
			<form action="<?php print $CFG->wwwroot.'/blocks/flash_video/ajax/addvideo.php' ?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="sesskey" value="<?php print $sesskey ?>" />

				<p><label for="add_videotitle">Video name:</label>
				<input type="text" name="videotitle" id="add_videotitle" /></p>

				<p><label for="add_videofile">Upload video:</label>
				<input type="file" name="videofile" id="add_videofile" /></p>

				<p><label for="add_videoimage">Upload thumbnail:</label>
				<input type="file" name="videoimage" id="add_videoimage" /></p>

				<p><label for="add_videodescription">Video description:</label>
				<textarea name="videodescription" id="add_videodescription"></textarea></p>

				<p><label for="add_courseid">Course:</label>
				<select name="courseid" id="add_courseid">
				<?php print $course_options ?>
				</select></p>

				<p><label for="add_videotags">Tags (comma separated):</label>
				<textarea name="videotags" id="add_videotags"></textarea></p>

			</form>
		</div>
	</div>

	<div id="videoeditor" class="yui-pe-content">
		<div class="hd">
			<h2>Edit Video</h2>
		</div>
		<div class="bd">
			<form action="<?php print $CFG->wwwroot.'/blocks/flash_video/ajax/editvideo.php' ?>" method="post">
				<input type="hidden" name="sesskey" value="<?php print $sesskey ?>" />
				<input type="hidden" name="action" value="save" />
				<input type="hidden" name="id" id="edit_videoid" value="" />

				<p><label for="edit_videotitle">Video name:</label>
				<input type="text" name="videotitle" id="edit_videotitle" /></p>

				<p><label for="edit_videodescription">Video description:</label>
				<textarea name="videodescription" id="edit_videodescription"></textarea></p>

				<p><label for="edit_videotags">Tags (comma separated):</label>
				<textarea name="videotags" id="edit_videotags"></textarea></p>

			</form>
		</div>
	</div>

	<div id="uploadwaitmessage" style="visibility:hidden"></div>

<?php
	echo '</td></tr></table>';
	print_footer();
?>
