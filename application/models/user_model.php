<?php
	class User_model extends CI_Model {
		protected $jiadb;
		function __construct() {
			$this->jiadb = new Jiadb('user');
			parent::__construct();
		}
		
		function login($param, $pass) {
			$join = array(
				'user_type' => array('type_id', 'id')
			);
			$info = $this->get_info($param, $join);
			if(!$info) {
				return 1;
			}
			if($info[0]['pass'] != $pass) {
				return 2;
			}
			return $info[0];
		}
		
		function insert($email, $name, $pass) {
			$info = $this->get_info((string)$email);
			if($info) {
				return 1;
			}
			$user = array(
				'email' => $email,
				'name' => $name,
				'pass' => md5($pass)
			);
			$this->db->insert('user', $user);
			$user_id = $this->db->insert_id();
			$post_access = Access_factory::get_access('post');
			$post_access->init($user_id);
			$comment_auth = Access_factory::get_access('comment');
			$comment_auth->init($user_id, 'personal');
			$join = array(
				'user_type' => array('type_id', 'id')
			);
			$info = $this->get_info((int)$user_id, $join);
			return $info[0];
		}
		
		function update($where = array(), $row = array()) {
			$this->db->where($where);
			$this->db->update('user', $row);
		}
		
		/**
		 * @param string or int(email address or user_id)
		 * @param array like following:
		 * $join = array(
		 * 		'joined_table1' => array('current_table_field', 'joined_table1_field'),
		 * 		'joined_table2' => array('current_table_field', 'joined_table2_field')
		 * )
		 * 
		 * such as $join = array(
		 * 		'user_type' => array('type_id', 'id')
		 * )
		 */ 
		function get_info($param, $join = array()) {
			$result = '';
			$this->jiadb->_table = 'user';
			$field = 'id';
			if(is_array($param)) {
				if(is_int($param[0])) {
					$field = 'id';
				} elseif(is_string($param[0])) {
					$field = 'email';
				}
			} else {
				if(is_int($param)) {
					$field = 'id';
				} elseif(is_string($param)) {
					$field = 'email';
				}
			}
			return $this->jiadb->fetchJoin(array($field => $param), $join);
		}
		
		/*
		// 获取用户变化值 
		function get_meta($meta_key, $meta_table = '') {
			$this->jiadb->_table = 'user';
			$return = 'user_id';
			$where = array(
				'meta_key' => 'follower',
				'meta_value' => $user_id
			);
			if($meta_table) {
				$where['meta_table'] = $meta_table;
			}
			return $this->jiadb->fetchMeta($return, $where);
		}
		 */
		
		// 获取粉丝
		function get_followers($user_id) {
			$this->jiadb->_table = 'user';
			$return = 'user_id';
			$where = array(
				'meta_key' => 'follower',
				'meta_table' => 'user',
				'meta_value' => $user_id
			);
			return $this->jiadb->fetchMeta($return, $where);
		}
		
		// 获取关注
		/**
		 * @param int 
		 * @param string user or corporation or activity
		 */
		function get_following($user_id, $meta_table = 'user') {
			$this->jiadb->_table = 'user';
			$return = 'meta_value';
			$where = array(
				'meta_key' => 'follower',
				'meta_table' => $meta_table,
				'user_id' => $user_id
			);
			return $this->jiadb->fetchMeta($return, $where);
		}
		
		function get_blockers($user_id) {
			$this->jiadb->_table = 'user';
			$reutrn = 'meta_value';
			$where = array(
				'meta_key' => 'blocker',
				'meta_table' => 'user',
				'user_id' => $user_id
			);
		}
		
		/**
		 * @return bool
		 * @param int
		 * @param int
		 *
		function add_follower($user_id, $follower_id) {
			$insert_array = array(
				'user_id' => $user_id,
				'meta_table' => 'user',
				'meta_key' => 'follower',
				'meta_value' => $follower_id
			);
			$this->jiadb->_table = 'user_meta';
			if($this->jiadb->fetchAll($insert_array)) {
				return FALSE;
			}
			$this->db->insert('user_meta', $insert_array);
			return TRUE;
		}
		 */
		
		/**
		 * @param int follower_id
		 * @param int following_id
		 */
		function follow($user_id, $following_id) {
			// 被关注者的黑名单
			$following_blockers = $this->get_blockers($following_id);
			// 关注者的黑名单
			$follower_blockers = $this->get_blockers($user_id);
			// 需要满足 关注者不在被关注者的黑名单内同时 被关注者也不在关注者的黑名单内
			if(in_array($user_id, $following_blockers) || in_array($following_id, $follower_blockers)) {
				return FALSE;
			} else {
				$meta_array = array(
					'user_id' => $user_id,
					'meta_table' => 'user',
					'meta_key' => 'follower',
					'meta_value' => $following_id
				);
				$this->insert_meta($meta_array);
				return TRUE;
			}
		}
		
		/**
		 * @param int master_id
		 * @param int blocker_id
		 */
		function block($user_id, $blocker_id) {
			// 移除关注
			$delete_following = array(
				'user_id' => $user_id,
				'meta_key' => 'follower',
				'meta_table' => 'user',
				'meta_value' => $blocker_id
			);
			
			// 移除粉丝
			$delete_follower = array(
				'user_id' => $blocker_id,
				'meta_key' => 'follower',
				'meta_table' => 'user',
				'meta_value' => $user_id
			);
			$this->delete_meta($delete_follower);
			$this->delete_meta($delete_following);
			$meta_array = array(
				'user_id' => $user_id,
				'meta_key' => 'blocker',
				'meta_table' => 'user',
				'meta_value' => $blocker_id
			);
			$this->insert_meta($meta_array);
		}
		
		function insert_meta(array $meta_array) {
			$this->jiadb->_table = 'user_meta';
			if($this->jiadb->fetchAll($meta_array)) {
				return;
			} else {
				$this->db->insert('user_meta', $meta_array);
				return;
			}
		}
		
		function delete_meta(array $meta_array) {
			$this->db->where($meta_array);
			$this->db->delete('user_meta');
		}
		
		/*
		function add_blocker($user_id, $blocker_id) {
			// 先取消对黑名单用户的关注
			$this->db->where(array('user_id' => $user_id, 'meta_key' => 'follower', 'meta_value' => $blocker_id));
			$this->db->delete('user_meta');
			$insert_array = array(
				'user_id' => $user_id,
				'meta_table' => 'user',
				'meta_key' => 'blocker',
				'meta_value' => $blocker_id
			);
			$this->jiadb->_table = 'user_meta';
			if($this->jiadb->fetchAll($insert_array)) {
				return FALSE;
			}
			$this->db->insert('user_meta', $insert_array);
			return TRUE;
		}
		 * 
		 */
	}
