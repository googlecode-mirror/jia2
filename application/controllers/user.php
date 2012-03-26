<?php
	class User extends MY_Controller {
		function __construct() {
			parent::__construct();
		}
		
		function index($param = '') {
			$data['title'] = 'User_view';
			$data['param'] = $param;
			$data['main_content'] = 'user_view';
			$this->load->view('includes/template_view', $data);
		}
	}