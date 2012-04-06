<?php
	class User_model extends CI_Model {
		protected $jiadb;
		function __construct() {
			$this->jiadb = new Jiadb('user');
			parent::__construct();
		}
		
		function login($email, $pass) {
			$join = array(
				'user_type' => array('type_id', 'id')
			);
			$info = $this->get_info((string)$email, $join);
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
		
		function update() {
			
		}
		
		/**
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
			if(is_int($param)) {
				$reslut = $this->jiadb->fetchJoin(array('id' => $param), $join);
			} elseif(is_string($param)) {
				$reslut = $this->jiadb->fetchJoin(array('email' => $param), $join);
			}	
			return $reslut;
		}
		
		// 用户变化值获取
		function get_meta($meta_key, $user_id, $join_table = TRUE, $where = array(), $order = array(), $limit = array()) {
			$meta = array();
			$this->jiadb->_table = 'user_meta';
			$where['user_id'] = $user_id;
			$where['meta_key'] = $meta_key;
			$result = $this->jiadb->fetchAll($where, $order, $limit);
			if($result) {
				if($join_table) {
					foreach ($result as $row) {
						$this->jiadb->_table = $row['meta_table'];
						$user = $this->jiadb->fetchAll(array('id' => $row['meta_value']));
						$meta[] = $user[0];
					}
				} else {
					foreach ($result as $row) {
						$meta[] = $row['meta_value'];
					}
				}	
			}
			return $meta;
		}
		/*
		function get_friends($id) {
			$friends = array();
			$this->jiadb->_table = 'user_meta';
			$result = $this->jiadb->fetchAll(array('user_id' => $id, 'meta_key' => 'friend'));
			if($result) {
				foreach ($result as $value) {
					$friend[] = $value['meta_value'];
				}
			}
			return $friends;
		}
		
		//获取黑名单数组
		function get_blockers($with_info = FALSE, $where = array(), $order = array(), $limit = '') {
			$blockers = array();
			$this->jiadb->_table = 'user_meta';
			$result = $this->jiadb->fetchAll(array('user_id' => $id, 'meta_key' => 'blocker'));
			if($result) {
				foreach ($result as $value) {
					$blockers[] = $value['meta_value'];
				}
			}
			return $blockers;
		}
		*/
		/**
		 * @return bool
		 * @param int
		 * @param int
		 */
		function add_friend($user_id, $friend_id) {
			$insert_array = array(
				'user_id' => $user_id,
				'meta_table' => 'user',
				'meta_key' => 'friend',
				'meta_value' => $friend_id
			);
			$this->jiadb->_table = 'user_meta';
			if($this->jiadb->fetchAll($insert_array)) {
				return FALSE;
			}
			$this->db->insert('user_meta', $insert_array);
			return TRUE;
		}
		
		function add_blocker($user_id, $blocker_id) {
			// 先取消对黑名单用户的关注
			$this->db->where(array('user_id' => $user_id, 'meta_key' => 'friend', 'meta_value' => $blocker_id));
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
	}
