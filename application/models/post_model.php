<?php
	class Post_model extends CI_Model {
		public $post_type;
		protected $jiadb;
		function __construct() {
			parent::__construct();
			$this->jiadb = new Jiadb('post');
			$this->post_type['personal'] = $this->config->item('post_type_personal');
			$this->post_type['forward'] = $this->config->item('post_type_forward');
			$this->post_type['activity'] = $this->config->item('post_type_activity');
		}
		
		function get_info($post_id, $join = array()) {
			$this->jiadb->_table = 'post';
			$post = $this->jiadb->fetchJoin(array('id' => $post_id), $join);
			if($post) {
				return $post[0];
			} else {
				return FALSE;
			}
		}
		
		function insert($post = array()) {
			if($post) {
				$post['type_id'] = $this->post_type[$post['type']];
				unset($post['type']);
				if($this->db->insert('post', $post)) {
					return $this->db->insert_id();
				}
			}
			return FALSE;
		}
		
		function insert_comment($comment = array()) {
			if($comment) {
				if($this->db->insert('comment', $comment)) {
					return $this->db->insert_id();
				}
			}
			return FALSE;
		}
		
		// 获取个人信息流方法
		function post_string($user_id, $type) {
			if($type == 'corporation') {
				$following_co = $this->User_model->get_following($user_id, 'corporation');
				$join = array(
					'corporation' => array('owner_id', 'id'),
					'post_meta' => array('id', 'post_id'),
					'comment' => array('id', 'post_id', 5),
					'comment.user' => array('user_id', 'id')
				);
				$posts = $this->jiadb->fetchJoin(array('owner_id' =>$following_co, 'type_id' => $this->post_type['activity']), $join, array('time' => 'desc'), array(10,0));
			} else {
				$following_user = $this->User_model->get_following($user_id);
				$following_user[] = $user_id;
				$join = array(
					'user' => array('owner_id', 'id'),
					'comment' => array('id', 'post_id', 5),
					'comment.user' => array('user_id', 'id')
				);
				$posts = $this->jiadb->fetchJoin(array('owner_id' => $following_user, 'type_id' => $this->post_type['personal']), $join, array('time' => 'desc'), array(10, 0));
			}
			return $posts;
		}
		
		// 根据条件筛选信息
		function fetch($where = array(), $order = array('time' => 'desc'), $limit = array(20, 0)) {
			// 该方法会加入对转载文章的原文读取
			$join = array(
				'user' => array('owner_id', 'id'),
				'comment' => array('id', 'post_id', 5),
				'comment.user' => array('user_id', 'id')
			);
			$posts = $this->jiadb->fetchJoin($where, $join, $order, $limit);
			return $posts;
		}
		
		function fetch_comment($where = array(), $order = array('time' => 'desc'), $limit = array(2, 0)) {
			$this->jiadb->_table = 'comment';
			$join = array(
				'user' => array('user_id', 'id')
			);
			$comment_result = $this->jiadb->fetchJoin($where, $join, $order, $limit);
			if(count($comment_result) == 1) {
				return $comment_result[0];
			}
			return $comment_result;
		}
	}
