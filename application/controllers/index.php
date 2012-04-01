<?php
	class Index extends MY_Controller {
		function __construct() {
			parent::__construct();
		}
		function index($param = '') {
			$data['title'] = 'Jia2 Index';
			$data['param'] = $param;
			$data['main_content'] = 'index_view';
			$this->load->view('includes/template_view', $data);
		}
		
		function login() {
			$data['main_content'] = 'login_view';
			$this->load->view('includes/template_view', $data);
		}
		
		function do_login() {
			$this->User_model->login();
		}
		
		function regist() {
			$data['main_content'] = 'regist_view';
			$this->load->view('includes/template_view', $data);
		}
		
		function do_regist() {
			$this->User_model->regist();
		}
		
		function logout() {
			
		}
	}