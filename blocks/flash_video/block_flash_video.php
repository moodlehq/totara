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


        if ($this->instance_is_dashlet()) {
            // Insert default links, according to role
            $sql = "SELECT r.shortname
                FROM {$CFG->prefix}dashb d
                INNER JOIN {$CFG->prefix}dashb_instance di ON d.id = di.dashb_id
                INNER JOIN {$CFG->prefix}role r on d.roleid = r.id
                WHERE di.id = {$this->instance->pageid}";       // The pageid is the dashb instance id
            $role = get_field_sql($sql);

            // Create content
            $this->content = new object();

            $this->content->text = '<div class="flashvideoinner">';
            $this->content->text .= '<script src="'.$CFG->wwwroot.'/blocks/flash_video/js/swfobject.js" type="text/javascript"></script>';
            $this->content->text .= '<div id="flash_video">';
            $this->content->text .= '<a href="http://www.adobe.com/go/getflashplayer"><img alt="Get Adobe Flash player" src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" complete="true" /> </a>';
            $this->content->text .= '</div>';

            // Initialise some javascript variables which will be used by the flash menu
            $this->content->text .= '<script type="text/javascript">';
            $this->content->text .= 'var flash_video_flashfile = "'.$CFG->wwwroot.'/blocks/flash_video/player/KineoSkinnableFLVPlayer.swf";';
            $this->content->text .= 'var flash_video_flashvars = {};';
            $this->content->text .= 'flash_video_flashvars.xmlImagePath = "'.$CFG->wwwroot.'/blocks/flash_video/xmlimagepath.php";';

            $this->content->text .= 'flash_video_flashvars.xmlPath = "'.$CFG->wwwroot.'/blocks/flash_video/xmlfilepath.php?role='.$role.'";';

            $this->content->text .= 'var flash_video_params = {};';
            $this->content->text .= 'flash_video_params.wmode = "transparent";';
            $this->content->text .= 'var flash_video_attributes = {};';
            $this->content->text .= 'swfobject.embedSWF(flash_video_flashfile, "flash_video", "200", "188", "9.0.0", false, flash_video_flashvars, flash_video_params, flash_video_attributes);';
            $this->content->text .= '</script>';

            $this->content->text .= '</div>';

        } else {
            // default block
            $this->content->text = '';
        }


		$this->content->footer = '';
		return $this->content;
	}

	function instance_allow_multiple() {
		return false;
	}

	function instance_allow_config() {
		return false;
	}
	function hide_header() {
		return false;
	}

	function preferred_width() {
		return 210;
    }

    /**
    * Determines whether the block instance is a dashlet, on a dashboard page
    * @return boolean
    **/
    function instance_is_dashlet() {
        return ($this->instance->pagetype == 'totara-dashboard' && $this->instance->position == 'c');
    }
}
?>
