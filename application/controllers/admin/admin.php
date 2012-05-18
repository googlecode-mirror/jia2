<?php
	class Admin extends MY_Controller {
		function __construct() {
			parent::__construct();
			$this->load->model('User_model');
		}
		
		function co_request($request_id = '') {
			if(is_numeric($request_id)) {
				
			} else {
				static_view('列出所有申请创建社团请求');
			}
		}
	}
