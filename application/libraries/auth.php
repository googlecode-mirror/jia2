<?php
require_once APPPATH . 'libraries/user.php';
require_once APPPATH . 'libraries/jiadb.php';
	class Auth_factory {
		static function get_auth($option, $type, $param = '') {
			switch ($type) {
				// 帖子操作权限
				case 'post':
					return new Post_auth($option, $param);
					break;
				// 社团操作权限
				case 'corporation':
					return new Corporation_auth($option, $param);
					break;
				// 活动操作权限	
				case 'activity':
					return new Activity_auth($option, $param);
					break;
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
		public $CI;
		function __construct($option) {
			$this->access = 0;
			$this->request_user = $this->CI->session->userdata('id');
			$this->CI =& get_instance();
			$this->jiadb = new Jiadb('options');
			// option(name) => option(id)
			$result = $this->jiadb->fetchAll(array('name' => $option));
			$this->option = $result[0]['id'];
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
		public $post;
		public $table;
		function __construct($option, $post = '') {
			parent::__construct($option);
			$this->post = $post;
			$this->table = 'post_auth';
		}
		
		function get_access() {
			$owner_id = $this->post['user_id'];
			$identity = '';
			// 游客
			if($this->CI->session->userdata('type') == 'guest') {
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
			if($this->CI->session->userdata('type') == 'register') {
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
		function __construct($option, $corporation = '') {
			parent::__construct($option);
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
		function __construct($option, $activity = '') {
			parent::__construct($option);
		}
	}