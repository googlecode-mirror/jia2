<?php
require_once APPPATH . 'libraries/jiadb.php';
	class Post_model extends CI_Model {
		function __construct() {
			parent::__construct();
		}
		
		function insert($post = array()) {
			if($post) {
				$this->db->insert('post', $post);
			}
		}
	}
