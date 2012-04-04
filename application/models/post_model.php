<?php
require_once APPPATH . 'libraries/jiadb.php';
	class Post_model extends CI_Model {
		public $post_type;
		function __construct() {
			parent::__construct();
			$this->post_type['personal'] = $this->config->item('post_type_personal');
			$this->post_type['forward'] = $this->config->item('post_type_forward');
			$this->post_type['activity'] = $this->config->item('post_type_activity');
		}
		
		function insert($post = array()) {
			if($post) {
				$post['type_id'] = $this->post_type[$post['type']];
				unset($post['type']);
				$this->db->insert('post', $post);
			}
		}
	}
