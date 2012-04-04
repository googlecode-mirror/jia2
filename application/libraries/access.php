<?php
/**
 * 权限设置类，三种类型的权限，包括对权限的初始化等功能
 */
	class Access_factory {
		static function get_access($type) {
			switch ($type) {
				case 'post':
					return new Post_access('post_auth');
					break;
				case 'activity':
					return new Activity_access('activity_auth');
					break;
				case 'corporation':
					return new Corporation_access('corporation_auth');
					break;
				case 'comment':
					return new Comment_access('comment_auth');
					break;
			}
		} 
	}
	class Access {
		public $jiadb;
		public $table;
		public $CI;
		function __construct() {
			$this->jiadb = new Jiadb($this->table);
			$this->CI =& get_instance();
		}
		// 初始化权限
		/**
		 * @param int user_id or corporation_id
		 * @param string personal or activity
		 * @param array such as 
		 * array(
		 * 	'identity' => 'operation'
		 * ) 
		 */
		function init($id, $array) {
			foreach ($array as $identity => $auth_array) {
				$this->jiadb->_table = 'identity';
				$identiry_result = $this->jiadb->fetchAll(array('name' => $identity));
				$identiry_id = $identiry_result[0]['id'];
				foreach ($auth_array as $operation) {
					$this->jiadb->_table = 'operation';
					$operation_result = $this->jiadb->fetchAll(array('name' => $operation));
					$operation_id = $operation_result[0]['id'];
					$row = array(
						'owner_id' => $id,
						'identity_id' =>$identiry_id,
						'operation_id' => $operation_id
					);
					$this->CI->db->insert($this->table, $row);
				}
			}
		}
	}
	
	class Post_access extends Access {
		function __construct() {
			$this->table = 'post_auth';
			parent::__construct();
		}
		
		function init($user_id) {
			$inti_array = array(
				'guest' => array('view'),
				'register' => array('view'),
				'friend' => array('view'),
				'self' => array('view', 'add', 'delete')
			);
			parent::init($user_id, $inti_array);
		}
	}
	
	class Comment_access extends  Access {
		function __construct() {
			$this->table = 'comment_auth';
			parent::__construct();
		}
		
		/**
		 * @param int user_id or corporation_id
		 * @param string personal or activity
		 */
		function init($owner_id, $type) {
			$array = array(
				'guest' => array('view'),
				'register' => array('view', 'add'),
				'self' => array('view', 'add', 'delete')
			);
			if($type == 'activity') {
				$array['co_member'] = array('view', 'add');
				$array['co_admin'] = array('view', 'add', 'delete');
				$array['participant'] = array('view', 'add');
			} elseif($type == 'personal') {
				$array['friend'] = array('view', 'add');
				$array['po_master'] = array('view', 'add', 'delete');
			} else {
				return FALSE;
			}
			$this->jiadb->_table = 'post_type';
			$post_type_result = $this->jiadb->fetchAll(array('name' => $type));
			$type_id = $post_type_result[0]['id'];
			foreach ($array as $identity => $auth_array) {
				$this->jiadb->_table = 'identity';
				$identity_result = $this->jiadb->fetchAll(array('name' => $identity));
				$identity_id = $identity_result[0]['id'];
				foreach ($auth_array as $operation) {
					$this->jiadb->_table = 'operation';
					$operation_result = $this->jiadb->fetchAll(array('name' => $operation));
					$operation_id = $operation_result[0]['id'];
					$row = array(
						'owner_id' => $owner_id,
						'type_id' => $type_id,
						'identity_id' => $identity_id,
						'operation_id' => $operation_id
					);
					$this->CI->db->insert($this->table, $row);
				}
			}
		}
	}
	
	class Activity_access extends  Access {
		function __construct() {
			$this->table = 'activity_auth';
			parent::__construct();
		}
	}
	
	class Corporation_access extends Access {
		function __construct() {
			$this->table = 'corporation_auth';
			parent::__construct();
		}
	}