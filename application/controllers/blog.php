<?php
	class Blog extends MY_Controller {
		function __construct() {
			parent::__construct();
		}
		
		// 默认加载当前用户blog
		function index() {
			$this->_require_login();
			
		}
		
		//发表日志
		function post() {
			$this->_require_login();
			if($this->input->post('submit')) {
				static_view('发表日志');
			} else {
				$data['main_content'] = 'blog/post_view';
				$this->load->view('includes/template_view', $data);
			}
		}
		
		//日志图片上传
		function img_up() {
			
		}
	}