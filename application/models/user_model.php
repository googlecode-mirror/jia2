<?php
	class User_model extends CI_Model {
		public $jiadb;
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
		
		// 获取变化的数据
		function get_meta($id, $mety_key = array()) {
			$result = $this->jiadb->fetchMeta(array('id' => $id), $mety_key);
			return $result;
		}
		
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
		function get_blockers() {
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
		
	}
