<?php
	class Search extends MY_Controller {
		function __construct() {
			parent::__construct();
		}
		
		function index() {
			static_view('这里是搜索界面');
		}
		
		function do_search() {
			$this->_require_ajax();
			$object = $this->input->post('object');
			$keywords = $this->input->post('keywords');
			switch ($object) {
				case 'user':
					// 搜索用户
					
					break;
				case 'corporation':
					// 搜索社团
					break;
				case 'activity':
					// 搜索社团
					break;
				default:
					// 三个都搜索
					break;
			}
		}
		
		function _user($keyword) {
			
		}
		
		function _corporation() {
			
		}
		
		function _activity() {
			
		}
	}
