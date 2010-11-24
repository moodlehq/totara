<?php

class block_flash_video extends block_base {
	function init() {
		$this->title = get_string('blocktitle', 'block_flash_video');
		$this->version = 2009120500;
	}

	function get_content() {
		global $CFG, $COURSE;

		if($this->content !== NULL) {
			return $this->content;
		}

		if (empty($this->instance)) {
			return '';
		}

		$this->content = new object();

		$playlist = '';
		if(isset($this->config->playlist)) {
			$playlist = $this->config->playlist;
		}

		$maxvideostodisplay = 5;
		if(isset($this->config->maxvideostodisplay)) {
			$maxvideostodisplay = $this->config->maxvideostodisplay;
		}

		if(!empty($playlist)) {
			$this->content->text = '<div class="flashvideoinner">';
			$this->content->text .= '<script src="'.$CFG->wwwroot.'/blocks/flash_video/js/swfobject.js" type="text/javascript"></script>';

			$this->content->text .= '<div id="flash_video">';
			$this->content->text .= '<a href="http://www.adobe.com/go/getflashplayer"><img alt="Get Adobe Flash player" src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" complete="true" /> </a>';
			$this->content->text .= '</div>';

			$videoids = explode(',', $playlist);

			$videocount = 0;
			foreach($videoids as $videoid) {

				if($videocount >= $maxvideostodisplay) {
					break;
				}

				if($video = get_record('block_flash_video', 'id', $videoid)) {
					if($videocount == 0) {
						// Initialise some javascript variables which will be used by the flash menu
						$this->content->text .= '<script type="text/javascript">';
						$this->content->text .= 'var flash_video_flashfile = "'.$CFG->wwwroot.'/blocks/flash_video/player/KineoSkinnableFLVPlayer.swf";';
						$this->content->text .= 'var flash_video_flashvars = {};';
						$this->content->text .= 'flash_video_flashvars.xmlImagePath = "'.$CFG->wwwroot.'/blocks/flash_video/xmlimagepath.php?id='.$video->id.'";';
						$this->content->text .= 'flash_video_flashvars.xmlPath = "'.$CFG->wwwroot.'/blocks/flash_video/xmlfilepath.php?id='.$video->id.'";';
						$this->content->text .= 'var flash_video_params = {};';
						$this->content->text .= 'flash_video_params.wmode = "transparent";';
						$this->content->text .= 'var flash_video_attributes = {};';
						$this->content->text .= 'swfobject.embedSWF(flash_video_flashfile, "flash_video", "180", "168", "9.0.0", false, flash_video_flashvars, flash_video_params, flash_video_attributes);';
						$this->content->text .= '</script>';
					}

					if($maxvideostodisplay > 1) {
						if($videocount==0) {
							$this->content->text .= '<ul class="videolist">';
						}
						$this->content->text .= '<li><a href="#" onClick="flash_video.newFLV(\''.$CFG->wwwroot.'/blocks/flash_video/xmlfilepath.php?id='.$video->id.'\'); return false;">';
						$this->content->text .= '<img src="'.$CFG->wwwroot.'/file.php/'.$video->course.'/'.$video->imagefilename.'" width="55" height="40" /> ';
						$this->content->text .= $video->title.'</a></li>';
					}
					$videocount++;
				}
			}

			if($videocount>=1) {
				$this->content->text .= '</ul>';
			}

			$this->content->text .= '</div>';

		} else {
			return '';
		}

		$this->content->footer = '';
		return $this->content;
	}

	function instance_allow_multiple() {
		return true;
	}

	function hide_header() {
		return false;
	}

	function preferred_width() {
		return 210;
	}
}
?>
