<?php
	class Index extends MY_Controller {
		function __construct() {
			parent::__construct();
			$this->load->model('User_model');
		}
		function index($param = '') {
			$data['title'] = 'Jia2 Index';
			$data['param'] = $param;
			$data['main_content'] = 'index_view';
			$this->load->view('includes/template_view', $data);
		}
		
		function login() {
			$data['title'] = '登录加加社团';
			$data['main_content'] = 'login_view';
			$this->load->view('includes/template_view', $data);
		}
		
		function do_login() {
			$result = $this->User_model->login();
			switch ($result) {
				case 1:
					static_view('用户不存在', site_url('index/login'));
					break;
				case 2:
					static_view('密码错误', site_url('index/login'));
					break;
				default:
					$session = array(
						'id' => $result['id'],
						'type' => $result['user_type']['name']
					);
					$this->session->set_userdata($session);
					redirect('index');
			}
		}
		
		function regist() {
			$data['main_content'] = 'regist_view';
			$this->load->view('includes/template_view', $data);
		}
		
		function do_regist() {
			$this->User_model->regist();
		}
		
		function logout() {
			$this->session->sess_destroy();
			redirect('index');
		}
	}