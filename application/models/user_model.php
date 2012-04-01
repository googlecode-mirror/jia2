<?php
require_once APPPATH . 'libraries/jiadb.php';
	class User_model extends CI_Model {
		public $jiadb;
		function __construct() {
			$this->jiadb = new Jiadb('user');
			parent::__construct();
		}
		
		function login() {
			$email = $this->input->post('email');
			$pass = $this->input->post('pass');
			$info = $this->jiadb->fetchAll(array('email' => $email));
		}
		
		function insert() {
			
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
		function get_info($id, $join = array()) {
			$reslut = $this->jiadb->fetchJoin(array('id' => $id), $join);
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
			foreach ($result as $value) {
				$friend[] = $value['meta_value'];
			}
			return $friends;
		}
		
		//获取黑名单数组
		function get_blockers() {
			$blockers = array();
			$this->jiadb->_table = 'user_meta';
			$result = $this->jiadb->fetchAll(array('user_id' => $id, 'meta_key' => 'blocker'));
			foreach ($result as $value) {
				$blockers[] = $value['meta_value'];
			}
			return $blockers;
		}
		
	}
