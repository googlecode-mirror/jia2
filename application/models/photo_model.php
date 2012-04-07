<?php
	class Photo_model extends CI_Model {
		function __construct() {
			parent::__construct();
			$this->load->library('image_lib');
		}
		
		function upload($mode = 'avatar') {
			$config = array(
			  		'allowed_types' => 'jpeg|jpg|png|gif',
			  		'upload_path' => $this->upload_path,
			  		'max_size' => '2048',
			  		'overwrite' => TRUE,
			  		'file_name'	=> 'avatar_id' . $user_id
			  	);
			switch ($mode) {
				case 'avatar':
					
					break;
			}
		}
		
		function avatar() {
			
		}
		
		function create_thumb() {
			
		}
	}
