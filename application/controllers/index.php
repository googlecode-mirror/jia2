<?php
	class Index extends MY_Controller {
		function __construct() {
			parent::__construct();
			$this->load->model('User_model');
			$this->load->model('Post_model');
		}
		
		function index() {
			if($this->session->userdata('type') == 'guest') {
				$this->_guest();
			} else {
				$data['title'] = 'Jia2 Index';
				$data['posts'] = $this->Post_model->post_string($this->session->userdata('id'));
				$data['js'] = array('tab.js', 'index_view.js', 'post.js');
				$data['main_content'] = 'index_view';
				$this->load->view('includes/template_view', $data);
			}
		}
		
		function _guest() {
			static_view('这里是游客页面');
		}
		
		function login() {
			$data['title'] = '登录加加社团';
			$data['css'] = array('login_view.css','common.css');
			$data['js'] = 'comm.js';
			$data['main_content'] = 'login_view';
			$this->load->view('includes/template_view', $data);
		}
		
		function do_login() {
			$email = $this->input->post('email');
			$pass = md5($this->input->post('pass'));
			$result = $this->User_model->login($email, $pass);
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
			$data['title'] = '注册加加';
			$data['css'] = array('login_view.css','common.css');
			$data['js'] = 'comm.js';
			$data['main_content'] = 'regist_view';
			$this->load->view('includes/template_view', $data);
		}
		
		function do_regist() {
			$email = $this->input->post('email');
			$name = $this->input->post('name');
			$pass = $this->input->post('pass');
			$result = $this->User_model->insert($email, $name, $pass);
			switch ($result) {
				case 1:
					static_view('邮箱已被注册');
					break;
				default:
					$session = array(
						'id' => $result['id'],
						'type' => $result['user_type']['name']
					);
					$this->session->set_userdata($session);
					redirect('index');
					break;
			}
		}
		
		function logout() {
			$this->session->sess_destroy();
			redirect('index/login');
		}
	}