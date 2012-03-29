<?php
require_once APPPATH . 'libraries/jiadb.php';
	class User {
		public $info;
		public $jiadb;
		public $id;
		function __construct($id) {
			$this->jiadb = new Jiadb('users');
			$this->id = $id;
		}
		
		function get_info() {
			$result = $this->jiadb->fetchAll(array('id' => $this->id));
			$this->info = $result[0];
			$this->jiadb->_table = 'user_type';
			$result = $this->jiadb->fetchAll(array('id' => $info['type_id']));
			$this->info['user_type'] = $result[0]['name'];
			return $this->info;
		}
		// 获取好友数组
		function get_friends() {
			$friends = array();
			$this->jiadb->_table = 'user_meta';
			$result = $this->jiadb->fetchAll(array('user_id' => $this->id, 'meta_key' => 'friend'));
			foreach ($result as $value) {
				$friend[] = $value['meta_value'];
			}
			return $friends;
		}
		
		function get_blockers() {
			$blockers = array();
			$this->jiadb->_table = 'user_meta';
			$result = $this->jiadb->fetchAll(array('user_id' => $this->id, 'meta_key' => 'blocker'));
			foreach ($result as $value) {
				$blockers[] = $value['meta_value'];
			}
			return $blockers;
		}
	}
