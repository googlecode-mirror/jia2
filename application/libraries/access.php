<?php
/**
 * 权限设置类，三种类型的权限，包括对权限的初始化等功能
 */
require APPPATH . 'libraries/jiadb.php';
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
			}
		} 
	}
	class Access {
		public $jiadb;
		public $table;
		public $identity;
		function __construct() {
			$this->jiadb = new Jiadb($this->table);
		}
		
		function init() {
			
		}
	}
	
	class Post_access extends Access {
		function __construct() {
			$this->table = 'post_auth';
			parent::__construct();
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
