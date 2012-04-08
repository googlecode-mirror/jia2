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
		public $identity_array;
		public $operation_array;
		function __construct() {
			$this->jiadb = new Jiadb($this->table);
			$this->CI =& get_instance();
			$identity_result = $this->CI->db->get('identity')->result_array();
			$operation_result = $this->CI->db->get('operation')->result_array();
			foreach ($identity_result as $row) {
				$this->identity_array[$row['name']] = $row['id'];
			}
			foreach ($operation_result as $row) {
				$this->operation_array[$row['name']] = $row['id'];
			}
		}
		// 初始化权限
		/**
		 * @param int user_id or corporation_id
		 * @param string personal or activity
		 * @param array such as 
		 * array(
		 * 	'identity' => 'operation'
		 * ) 
		 * @param array such as
		 * array(
		 * 'type_id' => 'value'
		 * )
		 */
		function init($id, $array, $extend = array()) {
			foreach ($array as $identity => $auth_array) {
				$identity_id = $this->identity_array[$identity];
				foreach ($auth_array as $operation) {
					$operation_id = $this->operation_array[$operation];
					$row = array(
						'owner_id' => $id,
						'identity_id' =>$identity_id,
						'operation_id' => $operation_id
					);
					if($extend) {
						foreach ($extend as $field => $value) {
							$row[$field] = $value;
						}
					}
					$this->CI->db->insert($this->table, $row);
				}
			}
		}
		/**
		 * 
		 * @param int user_id or corporation_id
		 * @param array like
		 * array(
		 *   array('identity' => 'register', 'opetarion' => 'add', 'access' => 0),
			 array('identity' => 'friend', 'opetarion' => 'add', 'access' => 1)
		 * )
		 */
		function set_access($id, array $access, $extend = array()) {
			foreach ($access as $row) {
				$this->CI->db->where('owner_id', $id);
				$this->db->where('identity_id', $this->identity_array[$row['iedntity']]);
				$this->db->where('operation_id', $this->operation_array[$row['operation']]);
				if($extend) {
					$this->CI->db->where($extend);
				}
				$this->CI->db->update($this->table, array('access' => $row['access']));
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
			$extend = array('type_id' => $type_id);
			parent::init($owner_id, $array, $extend);
			
		}
		
		function set_access($id, $access = array(), $post_type) {
			$this->jiadb->_table = 'post_type';
			$result = $this->jiadb->fetchAll(array('name' => $post_type));
			$extend = array(
				'type_id' => $result[0]['id']
			);
			parent::set_access($id, $access, $result);
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