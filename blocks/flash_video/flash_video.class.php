<?php

define('FLV_REQUIRED_TEXT', 1);
define('FLV_TEXT', 2);
define('FLV_INT', 3);
define('FLV_REQUIRED_DATE', 4);
define('FLV_REQUIRED_FILE', 5);
define('FLV_REQUIRED_IMAGE_FILE', 6);

global $CFG;

require_once($CFG->dirroot.'/lib/uploadlib.php');
require_once($CFG->dirroot.'/tag/lib.php');

class flash_video {

	var $video_data = NULL;
	var $video_id = NULL;
	var $validation_errors = array();
	var $allowed_file_extensions = array('flv');
	var $allowed_image_file_extensions = array('jpg', 'gif', 'png');
	var $allowed_file_types = array('application/octet-stream', 'video/x-flv');
	var $allowed_image_file_types = array('image/jpeg', 'image/gif', 'image/png', 'image/x-png');
	var $max_file_size;
		
	function init($data){
		$this->video_data = $data;
		$this->videofilename = '';
		$this->imagefilename = '';
		$this->max_file_size = 1024 * 1024 * 4;
	}
	
	function validate(){
		
		foreach ($this->video_data as $param_name => &$param_array) {
			$paramtype = $param_array['type'];
			$paramformfieldname = $param_array['formfieldname'];
			$paramvalue = $param_array['value'];
			
			switch($paramtype) {
				case FLV_REQUIRED_TEXT:
					$param_array['valid'] = $this->validate_required_text($param_name, $paramvalue);
					break;
				case FLV_TEXT:
					$param_array['valid'] = $this->validate_text($param_name, $paramvalue);
					break;
				case FLV_INT:
					$param_array['valid'] = $this->validate_int($param_name, $paramvalue);
					break;
				case FLV_REQUIRED_DATE:
					$param_array['valid'] = $this->validate_required_date($param_name, $paramvalue);
					break;
				case FLV_REQUIRED_FILE:
					$param_array['valid'] = $this->validate_required_file($param_name, $paramformfieldname);
					break;
				case FLV_REQUIRED_IMAGE_FILE:
					$param_array['valid'] = $this->validate_required_image_file($param_name, $paramformfieldname);
					break;
			}
		}

		return $this->video_data;

	}

	function validate_required_text($param_name, $str){
		if(isset($str) && !empty($str)){
			return true;
		} else {
			return false;
		}
    }

	function validate_required_date($param_name, $str){
		if(!isset($str)){
			return false;
		}

		$date = $this->makedate($str);

		if($date===false){
			return false;
		}

		return true;
	}

	function validate_required_file($param_name, $upload_formfield_name){

		$valid = true;

		//do we have a file?
		if((empty($_FILES[$upload_formfield_name])) || ($_FILES[$upload_formfield_name]['error'] != 0)){
			$this->validation_errors[$param_name][] = get_string('filenotuploaded', 'block_flash_video');
			$valid = false;
			return $valid; // don't bother doing any more checks
		}

		$filename = strtolower(basename($_FILES[$upload_formfield_name]['name']));
		$ext = substr($filename, strrpos($filename, '.') + 1);

		if(!in_array($ext, $this->allowed_file_extensions)){
			$this->validation_errors[$param_name][] = get_string('wrongextension', 'block_flash_video');
			$valid = false;
		}

		$filetype = $_FILES[$upload_formfield_name]["type"];

		if(!in_array($filetype, $this->allowed_file_types)){
			$this->validation_errors[$param_name][] = get_string('wrongfiletype', 'block_flash_video', $filetype);
			$valid = false;
		}

		$filesize = $_FILES[$upload_formfield_name]["size"];

		if($filesize > $this->max_file_size){
			$this->validation_errors[$param_name][] = get_string('filetoobig', 'block_flash_video');
			$valid = false;
		}

		return $valid;
	}

	function validate_required_image_file($param_name, $upload_formfield_name){

		$valid = true;

		//do we have a file?
		if((empty($_FILES[$upload_formfield_name])) || ($_FILES[$upload_formfield_name]['error'] != 0)){
			$this->validation_errors[$param_name][] = get_string('filenotuploaded', 'block_flash_video');
			$valid = false;
			return $valid; // don't bother doing any more checks
		}

		$filename = strtolower(basename($_FILES[$upload_formfield_name]['name']));
		$ext = substr($filename, strrpos($filename, '.') + 1);

		if(!in_array($ext, $this->allowed_image_file_extensions)){
			$this->validation_errors[$param_name][] = get_string('wrongextensionpic', 'block_flash_video');
			$valid = false;
		}

		$filetype = $_FILES[$upload_formfield_name]["type"];

		if(!in_array($filetype, $this->allowed_image_file_types)){
			$this->validation_errors[$param_name][] = get_string('wrongfiletypepic', 'block_flash_video', $filetype);
			$valid = false;
		}

		$filesize = $_FILES[$upload_formfield_name]["size"];

		if($filesize > $this->max_file_size){
			$this->validation_errors[$param_name][] = get_string('filetoobig', 'block_flash_video');
			$valid = false;
		}

		return $valid;
	}

	function validate_text($param_name, $str){ // Not a required field, so just assume it's valid
		return true;
	}

	function validate_int($param_name, $str){ // Not a required field, so just assume it's valid
		return true;
	}

	function isvalid(){
		foreach ($this->video_data as $param_name => $param_array){
			$paramvalid = $param_array['valid'];
			if ($paramvalid === NULL || $paramvalid === false){
				return false;
			}
		}
		return true;
	}


	function get_errors(){
		$errstr = '';
		foreach ($this->video_data as $param_name => $param_array){
			$param_description = $param_array['description'];
			$param_valid = $param_array['valid'];
			$param_type = $param_array['type'];
			if ($param_valid === NULL || $param_valid === false){
				switch($param_type){
					case FLV_REQUIRED_TEXT:
						$errstr .= "$param_description: ".get_string('requiredfield','block_flash_video')."\n";
						break;
					case FLV_REQUIRED_FILE:
					case FLV_REQUIRED_IMAGE_FILE:
						$errors = $this->validation_errors[$param_name];
						foreach($errors as $error){
							$errstr .= "$param_description: $error\n";
						}
						break;
					default:
						$errstr .= "$param_description: ".get_string('requiredfield','block_flash_video')."\n";
						break;
				}
			}
		}
		return $errstr;
	}

	function insert_record($course){
		$dataobject = new object();
		$dataobject->course = $course->id;
		$dataobject->title = $this->video_data['title']['value'];
		$dataobject->description = $this->video_data['description']['value'];
		$dataobject->filename = $this->videofilename; // should have been set when the file was uploaded
		$dataobject->imagefilename = $this->imagefilename; // should have been set when the file was uploaded
		$dataobject->tags = $this->get_tags();
		$dataobject->timeadded = time();

		if (!$dataobject->id = insert_record('block_flash_video', $dataobject)) {
			return false;
		} else {
			$this->video_id = $dataobject->id;
			//$this->set_tags($dataobject->id, $this->video_data['tags']['value']);
			return true;
		}
	}

	function upload_files($course, $dir){

		$success = false;

		if (confirm_sesskey()) {
			$um1 = new upload_manager('videofile',false,true,$course,false,0);
			if ($um1->process_file_uploads($dir)) {
				$this->videofilename = $um1->get_new_filename();
				$success = true;
			} else {
				$success = false;
			}

			if($success) {
				$um2 = new upload_manager('videoimage',false,true,$course,false,0);
				if ($um2->process_file_uploads($dir)) {
					$this->imagefilename = $um2->get_new_filename();
					$success = true;
				} else {
					$success = false;
				}
			}
		}
		return $success;
    }

	function get_tags(){
		if(isset($this->video_data['tags']['value'])){
			$tags = strip_tags($this->video_data['tags']['value']);
			$tags = split(',', $tags);
			$tags = array_unique($tags);
			array_walk($tags, 'trim');
			return join($tags, ',');
		}else{
			return '';
		}
	}

	function set_tags($id, $tags){
		if($tags){
			$newtags = strip_tags($tags);
			$tags = split(',', $newtags);
			$tags = array_unique($tags);
			array_walk($tags, 'trim');
			tag_set('podcast', $id, $tags);
		}
	}
}
