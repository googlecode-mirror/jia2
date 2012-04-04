<?php
	class Post_model extends CI_Model {
		public $post_type;
		public $jiadb;
		function __construct() {
			parent::__construct();
			$this->jiadb = new Jiadb('post');
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
		
		// 个人信息流方法
		function post_string($user_id) {
			$friends = $this->User_model->get_friends($user_id);
			$users = $friends;
			$users[] = $user_id;
			$posts = $this->jiadb->fetchAll(array('owner_id' => $users), array('time' => 'desc'), array(20,0));
			return $posts;
		}
		
		
		function fetch($where = '', $order = '', $limit = '' ) {
			
		}
	}
