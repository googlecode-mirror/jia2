<?php
require_once APPPATH . 'libraries/user.php';
require_once APPPATH . 'libraries/jiadb.php';
	class Auth_factory {
		static function get_auth($option, $type, $param) {
			switch ($type) {
				case 'post':
					return new Post_auth($option, $param);
					break;
				case 'corporation':
					return new Corporation_auth($option, $param);
					break;
				case 'activity':
					return new Activity_auth($option, $param);
			}
		}
	}

	class Auth {
		// 请求权限的用户
		public $request_user;
		// 请求的操作
		public $option;
		// 权限值
		public $access;
		public $jiadb;
		function __construct($option) {
			$this->access = 0;
			$this->request_user = $this->session->userdata('id');
			$this->option = $option;
			$this->jiadb = new Jiadb();
		}
		
		function get_access($owner_id, $identity, $table) {
			$this->jiadb->_table = 'identity';
			$result = $this->jiadb->fetchAll(array('name' => $identity));
			$identity_id = $result[0]['id'];
			$this->jiadb->_table = $table;
			$result = $this->jiadb->fetchAll(array('user_id' => $owner_id, 'identity_id' => $identity_id, 'option' => $this->option));
			$this->access = $result[0]['access'];
		}
	}
	
	class Post_auth extends Auth {
		public $post;
		public $table;
		function __construct($option, $post) {
			parent::__construct($option);
			$this->post = $post;
			$this->table = 'post_auth';
		}
		
		function get_access() {
			$owner_id = $this->post['user_id'];
			$identity = '';
			// 游客
			if($this->session->userdata('type') == 'guest') {
				$identity = 'guest';
				parent::get_access($owner_id, $identity, $this->table);
				if($this->access == 1) {
					return;
				}
			}
			$owner = new User($owner_id);
			// 黑名单
			$blockers = $owner->get_blockers();
			if(in_array($this->request_user, $friends)) {
				$identity = 'blocker';
				parent::get_access($owner_id, $identity, $this->table);
				return;
			}
			// 注册用户
			if($this->session->userdata('type') == 'register') {
				$identity = 'register';
				parent::get_access($owner_id, $identity, $this->table);
				if($this->access == 1) {
					return;
				}
			}
			// 朋友
			$friends = $owner->get_friends();
			if(in_array($this->request_user, $friends)) {
				$identity = 'friend';
				parent::get_access($owner_id, $identity, $this->table);
				if($this->access) {
					return;
				}
			}
			$user = new User($this->request_user);
			// 本人
			if($this->post['user_id'] == $this->request_user) {
				$identity = 'self';
				parent::get_access($owner_id, $identity, $this->table);
				if($this->access) {
					return;
				}
			}
			// 验证是否管理员
			if($this->session->userdata('type') == 'admin') {
				$this->access = 1;
				return;
			}
		}
	}
	
	class Corporation_auth extends Auth {
		function __construct($option, $corporation) {
			parent::__construct($option);
		}
	}
	
	class Activity_auth extends  Auth {
		function __construct($option, $activity) {
			parent::__construct($option);
		}
	}