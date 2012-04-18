<?php
require_once APPPATH . 'libraries/jiadb.php';
	class Auth_factory {
		/**
		 * @param string
		 * @param string post corporation ...
		 * @param int
		 * @param array('type', 'master_id')
		 */
		static function get_auth($type, $owner_id, $post = array()) {
			switch ($type) {
				// 帖子操作权限
				case 'post':
					return new Post_auth($owner_id);
					break;
				// 社团操作权限
				case 'corporation':
					return new Corporation_auth($owner_id);
					break;
				// 活动操作权限	
				case 'activity':
					return new Activity_auth($owner_id);
					break;
				// 评论操作权限
				case 'comment':
					return new Comment_auth($owner_id, $post);
					break;
			}
		}
	}

	abstract class Auth {
		// 请求权限的用户
		public $request_user;
		// 
		public $owner_id;
		// 权限值
		public $access;
		public $identity_array;
		public $operation_array;
		public $jiadb;
		public $CI;
		public $table;
		function __construct($owner_id) {
			$this->access = 0;
			$this->CI =& get_instance();
			$this->owner_id = $owner_id;
			$this->request_user = $this->CI->session->userdata('id');
			$this->jiadb = new Jiadb();
			$identity_result = $this->CI->db->get('identity')->result_array();
			$operation_result = $this->CI->db->get('operation')->result_array();
			foreach ($identity_result as $row) {
				$this->identity_array[$row['name']] = $row['id'];
			}
			foreach ($operation_result as $row) {
				$this->operation_array[$row['name']] = $row['id'];
			}
			$this->CI->load->model('User_model');
		}
		
		function get_access($operation, $identity) {
			$operation_id = $this->operation_array[$operation];
			$identity_id = $this->identity_array[$identity];
			$this->jiadb->_table = $this->table;
			$result = $this->jiadb->fetchAll(array('owner_id' => $this->owner_id, 'identity_id' => $identity_id, 'operation_id' => $operation_id));
			$this->access = $result[0]['access'];
		}
	}
	
	// 一个用户对于一个帖子的权限，可能的身份有
	/*
	 *  guest 游客
	 *  register 注册用户
	 *  blocker 帖子主人黑名单
	 * 	follower 帖子主人粉丝
	 * 	self 帖子主人
	 * 	admin 管理员
	 */
	class Post_auth extends Auth {
		function __construct($owner_id) {
			parent::__construct($owner_id);
			$this->table = 'post_auth';
		}
		
		function get_access($operation, $identity = '') {
			if($identity) {
				parent::get_access($operation, $identity);
				return;
			}
			
			// 验证是否管理员
			if($this->CI->session->userdata('type') == 'admin') {
				$this->access = 1;
				return;
			}
			
			// 本人
			if($this->owner_id == $this->request_user) {
				$identity = 'self';
				parent::get_access($operation, $identity);
				return;
			}
			
			// 游客
			if($this->CI->session->userdata('type') == 'guest') {
				$identity = 'guest';
				parent::get_access($operation, $identity);
				return;
			}
			
			// 注册用户
			if($this->CI->session->userdata('type') == 'register') { 
				$identity = 'register';
				$blockers = (array)$this->CI->User_model->get_blockers($this->owner_id);
				if(in_array($this->request_user, $blockers)) {
					// 黑名单
					$identity = 'blocker';
					parent::get_access($operation, $identity);
					return;
				}
				parent::get_access($operation, $identity);
				if($this->access) {
					return;
				}
				// 粉丝
				$followers = $this->CI->User_model->get_followers($this->owner_id);
				if(in_array($this->request_user, $followers)) {
					$identity = 'follower';
					parent::get_access($operation, $identity);
					if($this->access) {
						return;
					}
				}
			}
		}
	}
	
	// 一个用户对于一个社团的身份可能有（主要用于对社团信息操作的权限控制）
	/*
	 *  guest 游客
	 * 	register 注册用户
	 *  blocker 黑名单
	 *  follower 粉丝
	 *  co_member 社团成员
	 *  co_admin 社团管理员
	 *  co_master 社长
	 *  admin 管理员
	 */
	class Corporation_auth extends Auth {
		function __construct($owner_id) {
			parent::__construct($owner_id);
			$this->CI->load->model('Corporation_model');
			$this->table = 'corporation_auth';
		}
		function get_access($operation, $identity = '') {
			if($identity) {
				parent::get_access($operation, $identity);
				return;
			}
			// admin
			if($this->CI->session->userdata('type') == 'admin') {
				$this->access = 1;
				return;
			}
			
			// 游客
			if($this->CI->session->userdata('type') == 'guest') {
				$identity = 'guest';
				parent::get_access($operation, $identity);
				return;
			}
			
			// 注册用户
			if($this->CI->session->userdata('type') == 'register') {
				$identity = 'register';
				$blockers = $this->CI->Corporation_model->get_blockers($this->owner_id);
				if(in_array($this->request_user, $blockers)) {
					$identity = 'blocker';
					parent::get_access($operation, $identity);
					return;
				}
				parent::get_access($operation, $identity);
				if($this->access) {
					return;
				}
				
				// 社团粉丝
				$cos = $this->CI->Corporation_model->get_followers($this->owner_id);
				if(in_array($this->owner_id, $cos)) {
					$identity = 'follower';
					parent::get_access($operation, $identity);
					if($this->access) {
						return;
					}
				}
				
				// 社团成员
				$members = $this->CI->Corporation_model->get_members($this->owner_id);
				if(in_array($this->request_user, $members)) {
					$identity = 'co_member';
					parent::get_access($operation, $identity);
					if($this->access) {
						return;
					}
				}
				
				// 社团管理员
				$administrators = $this->CI->Corporation_model->get_admin($this->owner_id);
				if(in_array($this->request_user, $administrators)) {
					$identity = 'co_admin';
					parent::get_access($operation, $identity);
					if($this->access) {
						return;
					}
				}
				// 社长
				$corporation = $this->CI->Corporation_model->get_info($this->owner_id);
				if($this->request_user == $corporation[0]['user_id']) {
					$identity = 'co_master';
					parent::get_access($operation, $identity);
					return;
				}
				
			}
		}
	}
	/*
	 *  一个用户对于一个活动的身份（主要用于对社团活动安排管理的权限控制）
	 *  guest 游客
	 *  register 注册用户
	 * 	blocker 社团黑名单
	 * 	follower 粉丝
	 *  participant 参加者
	 * 	self 活动创建者
	 * 	co_amdin 所属社团管理员
	 *  co_master 所属社团社长
	 *  admin 管理员
	 */
	class Activity_auth extends  Auth {
		function __construct($owner_id) {
			parent::__construct($owner_id);
			$this->CI->load->model('Corporation_model');
			$this->table = 'activity_auth';
		}
		
		
		function get_access($operation, $identity = '') {
			if($identity) {
				parent::get_access($operation, $identity);
				return;
			}
			// admin
			if($this->CI->session->userdata('type') == 'admin') {
				$this->access = 1;
				return;
			}
			
			// 游客
			if($this->CI->session->userdata('type') == 'guest') {
				$identity = 'guest';
				parent::get_access($operation, $identity);
				return;
			}
			
			// 注册用户
			if($this->CI->session->userdata('type') == 'register') {
				$identity = 'register';
				$blockers = $this->CI->Corporation_model->get_blockers($this->owner_id);
				if(in_array($this->request_user, $blockers)) {
					$identity = 'blocker';
					parent::get_access($operation, $identity);
					return;
				}
				parent::get_access($operation, $identity);
				if($this->access) {
					return;
				}
				
				// 社团粉丝
				$cos = $this->CI->Corporation_model->get_followers($this->owner_id);
				if(in_array($this->owner_id, $cos)) {
					$identity = 'follower';
					parent::get_access($operation, $identity);
					if($this->access) {
						return;
					}
				}
				
				// 社团成员
				$members = $this->CI->Corporation_model->get_members($this->owner_id);
				if(in_array($this->request_user, $members)) {
					$identity = 'co_member';
					parent::get_access($operation, $identity);
					if($this->access) {
						return;
					}
				}
				
				// 社团管理员
				$administrators = $this->CI->Corporation_model->get_admin($this->owner_id);
				if(in_array($this->request_user, $administrators)) {
					$identity = 'co_admin';
					parent::get_access($operation, $identity);
					if($this->access) {
						return;
					}
				}
				// 社长
				$corporation = $this->CI->Corporation_model->get_info($this->owner_id);
				if($this->request_user == $corporation[0]['user_id']) {
					$identity = 'co_master';
					parent::get_access($operation, $identity);
					return;
				}
				
			}
		}
	}
	
	/*
	 *  一个用户对于一个评论的身份（主要用于对社团活动安排管理的权限控制）
	 *  guest 游客
	 *  register 注册用户
	 * 	blocker 帖子主人黑名单
	 * 	follower 帖子主人粉丝
	 * 	self 本人
	 *  admin 管理员
	 */
	
	class Comment_auth extends Auth {
		// 帖子主人id
		public $master_id;
		public $type;
		/**
		 * @param int comment_master_id or request_user_id
		 * @param array (post_type_name, post_master_id)
		 */
		function __construct($owner_id, $post = array()) {
			$this->table = 'comment_auth';
			if($post) {
				$this->type = $post[0];
				$this->master_id = $post[1];
			}
			parent::__construct($owner_id);
		}
		
		function get_access($operation, $identity = '') {
			if($identity) {
				parent::get_access($operation, $identity);
				return;
			}
			
			if($this->CI->session->userdata('type') == 'admin') {
				$this->access = 1;
				return;
			}
			
			// 游客
			if($this->CI->session->userdata('type') == 'guest') {
				$identity = 'guest';
				parent::get_access($operation, $identity);
				return;
			}
			
			// 本人
			if($this->owner_id == $this->CI->session->userdata('id')) {
				$identity = 'self';
				parent::get_access($operation, $identity);
				return;
			}
			
			if($this->CI->session->userdata('type') == 'register') {
				$identity = 'register';
			}
			
			// 再判断对于当前po有没有权限
			if($this->type == 'personal') {
				if($this->request_user = $this->master_id) {
					$identity = 'po_master';
					parent::get_access($operation, $identity);
					return;
				}
				$blockers = $this->CI->User_model->get_blockers($this->master_id);
				if(in_array($this->request_user, $blockers)) {
					// 黑名单
					$identity = 'blocker';
					parent::get_access($operation, $identity);
					return;
				}
				// 注册用户
				parent::get_access($operation, $identity);
				if($this->access) {
					return;
				}
				// 粉丝
				$followers = $this->CI->User_model->get_followers($this->master_id);
				if(in_array($this->request_user, $followers)) {
					$identity = 'follower';
					parent::get_access($operation, $identity);
					if($this->access) {
						return;
					}
				}
			}
			
			// 
			if($this->type == 'activity') {
				$blockers = $this->CI->Corporation_model->get_blockers($this->master_id);
				if(in_array($this->request_user, $blockers)) {
					// 黑名单
					$identity = 'blocker';
					parent::get_access($operation, $identity);
					return;
				}
				// 注册用户
				parent::get_access($operation, $identity);
				if($this->access) {
					return;
				}
				// 活动参与者
				
				// 会员
				
				// 管理员
				
				// 社长
			}
		}
	}
