<?php
require_once APPPATH . 'libraries/jiadb.php';
	class Auth_factory {
		/**
		 * @param string
		 * @param string post corporation ...
		 * @param int
		 * @param array('type', 'master_id')
		 */
		static function get_auth($operation, $type, $owner_id, $master = '') {
			switch ($type) {
				// 帖子操作权限
				case 'post':
					return new Post_auth($operation, $owner_id);
					break;
				// 社团操作权限
				case 'corporation':
					return new Corporation_auth($operation, $owner_id);
					break;
				// 活动操作权限	
				case 'activity':
					return new Activity_auth($operation, $owner_id);
					break;
				// 评论操作权限
				case 'comment':
					return new Comment_auth($operation, $owner_id, $master);
					break;
			}
		}
	}

	class Auth {
		// 请求权限的用户
		public $request_user;
		public $owner_id;
		// 请求的操作
		public $operation;
		// 权限值
		public $access;
		public $jiadb;
		public $CI;
		public $table;
		function __construct($operation, $owner_id) {
			$this->access = 0;
			$this->CI =& get_instance();
			$this->owner_id = $owner_id;
			$this->request_user = $this->CI->session->userdata('id');
			$this->jiadb = new Jiadb('operation');
			$this->CI->load->model('User_model');
			// operation(name) => operation(id)
			$result = $this->jiadb->fetchAll(array('name' => $operation));
			$this->operation = $result[0]['id'];
		}
		
		function get_access($identity) {
			$this->jiadb->_table = 'identity';
			// identity(name) => identity(id)
			$result = $this->jiadb->fetchAll(array('name' => $identity));
			$identity_id = $result[0]['id'];
			$this->jiadb->_table = $this->table;
			$result = $this->jiadb->fetchAll(array('owner_id' => $this->owner_id, 'identity_id' => $identity_id, 'operation_id' => $this->operation));
			$this->access = $result[0]['access'];
		}
	}
	
	// 一个用户对于一个帖子的权限，可能的身份有
	/*
	 *  guest 游客
	 *  register 注册用户
	 *  blocker 帖子主人黑名单
	 * 	friend 帖子主人朋友
	 * 	self 帖子主人
	 * 	admin 管理员
	 */
	class Post_auth extends Auth {
		function __construct($operation, $owner_id) {
			parent::__construct($operation, $owner_id);
			$this->table = 'post_auth';
		}
		
		function get_access() {
			$identity = '';
			// 本人
			if($this->owner_id == $this->CI->session->userdata('id')) {
				$identity = 'self';
				parent::get_access($identity);
				return;
			}
			
			// 游客
			if($this->CI->session->userdata('type') == 'guest') {
				$identity = 'guest';
				parent::get_access($identity);
				return;
			}
			
			// 注册用户
			if($this->CI->session->userdata('type') == 'register') { 
				$identity = 'register';
				$blockers = $this->CI->User_model->get_meta('blocker', $this->owner_id, FALSE);
				if(in_array($this->request_user, $blockers)) {
					// 黑名单
					$identity = 'blocker';
					parent::get_access($identity);
					return;
				}
				parent::get_access($identity);
				if($this->access) {
					return;
				}
				// 朋友
				$friends = $this->CI->User_model->get_meta('friend', $this->owner_id, FALSE);
				if(in_array($this->request_user, $friends)) {
					$identity = 'friend';
					parent::get_access($identity);
					if($this->access) {
						return;
					}
				}
			}

			// 验证是否管理员
			if($this->CI->session->userdata('type') == 'admin') {
				$this->access = 1;
				return;
			}
		}
	}
	
	// 一个用户对于一个社团的身份可能有（主要用于对社团信息操作的权限控制）
	/*
	 *  guest 游客
	 * 	register 注册用户
	 *  blocker 黑名单
	 *  friend 朋友（关注）
	 *  co_member 社团成员
	 *  co_admin 社团管理员
	 *  co_master 社长
	 *  admin 管理员
	 */
	class Corporation_auth extends Auth {
		function __construct($operation, $owner_id) {
			parent::__construct($operation, $owner_id);
			$this->CI->load->model('Corporation_model');
			$this->table = 'corporation_auth';
		}
		
		function get_access() {
			$identity = '';
			
			// 游客
			if($this->CI->userdata('type') == 'guest') {
				$identity = 'guest';
				parent::get_access($identity);
				return;
			}
			
			// 注册用户
			if($this->CI->session->userdata('type') == 'register') {
				$identity = 'register';
				$blockers = $this->CI->Corporation_model->get_meta('blocker', $this->owner_id, FALSE);
				if(in_array($this->request_user, $blockers)) {
					$identity = 'blocker';
					parent::get_access($identity);
					return;
				}
				parent::get_access($identity);
				if($this->access) {
					return;
				}
				
				// 社团粉丝
				$cos = $this->CI->User_model->get_meta('corporation', $this->request_user, FALSE);
				if(in_array($this->owner_id, $cos)) {
					$identity = 'friend';
					parent::get_access($identity);
					if($this->access) {
						return;
					}
				}
				
				// 社团成员
				$members = $this->CI->Corporation_model->get_meta('member', $this->owner_id, FALSE);
				if(in_array($this->request_user, $members)) {
					$identity = 'co_member';
					parent::get_access($identity);
					if($this->access) {
						return;
					}
				}
				
				// 社团管理员
				$administrators = $this->CI->Corporation_model->get_meta('admin', $this->owner_id, FALSE);
				if(in_array($this->request_user, $administrators)) {
					$identity = 'co_admin';
					parent::get_access($identity);
					if($this->access) {
						return;
					}
				}
				// 社长
				$corporation = $this->CI->Corporation_model->get_info($this->owner_id);
				if($this->request_user == $corporation[0]['user_id']) {
					$identity = 'co_master';
					parent::get_access($identity);
					return;
				}
				
			}
			
			
			// admin
			if($this->CI->session->userdata('type') == 'admin') {
				$this->access = 1;
				return;
			}
		}
	}
	/*
	 *  一个用户对于一个活动的身份（主要用于对社团活动安排管理的权限控制）
	 *  guest 游客
	 *  register 注册用户
	 * 	blocker 社团黑名单
	 * 	friend 关注者
	 *  participant 参加者
	 * 	self 活动创建者
	 * 	co_amdin 所属社团管理员
	 *  co_master 所属社团社长
	 *  admin 管理员
	 */
	class Activity_auth extends  Auth {
		function __construct($operation, $owner_id) {
			parent::__construct($operation, $owner_id);
			$this->CI->load->model('Corporation_model');
		}
	}
	
	/*
	 *  一个用户对于一个评论的身份（主要用于对社团活动安排管理的权限控制）
	 *  guest 游客
	 *  register 注册用户
	 * 	blocker 帖子主人黑名单
	 * 	friend 帖子主人朋友
	 * 	self 本人
	 *  admin 管理员
	 */
	
	class Comment_auth extends Auth {
		public $master_id;
		public $type;
		/**
		 * @param string view edit delete add
		 * @param int comment_master_id or request_user_id
		 * @param int post_master_id
		 */
		function __construct($operation, $owner_id, $master) {
			$this->table = 'comment_auth';
			$this->master_id = $master[0];
			$this->table = $master[1];
			parent::__construct($operation);
		}
		
		function get_access() {
			$identity = '';
			
			// 游客
			if($this->CI->session->userdata('type') == 'guest') {
				$identity = 'guest';
				parent::get_access($identity);
				return;
			}
			
			// 本人
			if($this->owner_id == $this->CI->session->userdara('id')) {
				$identity = 'self';
				parent::get_access($identity);
				return;
			}
			
			if($this->CI->session->userdata('type') == 'register') {
				$identity = 'register';
			}
			
			// 再判断对于当前po有没有权限
			if($this->type == 'personal') {
				$blockers = $this->CI->User_model->get_blockers($this->owner_id);
				if(in_array($this->request_user, $friends)) {
					// 黑名单
					$identity = 'blocker';
					parent::get_access($identity);
					return;
				}
				// 注册用户
				parent::get_access($identity);
				if($this->access) {
					return;
				}
				// 朋友
				$friends = $this->CI->User_model->get_friends($this->owner_id);
				if(in_array($this->request_user, $friends)) {
					$identity = 'friend';
					parent::get_access($identity);
					if($this->access) {
						return;
					}
				}
			}
			
			if($this->type == 'activity') {
				$blockers = $this->CI->User_model->get_blockers($this->owner_id);
				if(in_array($this->request_user, $friends)) {
					// 黑名单
					$identity = 'blocker';
					parent::get_access($identity);
					return;
				}
				// 注册用户
				parent::get_access($identity);
				if($this->access) {
					return;
				}
				// 活动参与者
				
				// 会员
				
				// 管理员
				
				// 社长
			}
			
			if($this->CI->session->userdata('type') == 'admin') {
				$this->access = 1;
				return;
			}
			// 
		}
	}
