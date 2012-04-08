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
				$data['css'] = array('common.css','index_view.css');
				$data['js'] = array('tab.js', 'index_view.js', 'post.js');
				$data['main_content'] = 'index_view';
				$this->load->view('includes/template_view', $data);
			}
		}
		
		function _guest() {
			static_view('这里是游客页面');
		}
		
		function login() {
			$this->_require_login(FALSE);
			$data['title'] = '登录加加社团';
			$data['css'] = array('comm.css','login_view.css');
			$data['js'] = array('comm.js', 'login_view.js');
			$data['main_content'] = 'login_view';
			$this->load->view('includes/template_view', $data);
		}
		
		function do_login() {
			$this->_require_ajax();
			$this->_require_login(FALSE);
			$email = $this->input->post('email');
			$pass = $this->input->post('pass');
			$remember = $this->input->post('remember');
			$result = $this->User_model->login($email, $pass);
			$json_array = array('verify' => 0, 'email' => '', 'pass' => '');
			switch ($result) {
				case 1:
					$json_array['email'] = '账户不存在';
					echo json_encode($json_array);
					break;
				case 2:
					$json_array['pass'] = '密码不正确';
					echo json_encode($json_array);
					break;
				default:
					$json_array['verify'] = 1;
					echo json_encode($json_array);
					$session = array(
						'id' => $result['id'],
						'type' => $result['user_type'][0]['name'],
						'name' => $result['name'],
						'avatar' => $result['avatar'],
					);
					$this->session->set_userdata($session);
			}
		}
		
		function regist() {
			$this->_require_login(FALSE);
			$data['title'] = '注册加加';
			$data['css'] = array('comm.css','login_view.css');
			$data['js'] = array('comm.js', 'login_view.js');
			$data['main_content'] = 'regist_view';
			$this->load->view('includes/template_view', $data);
		}
		
		function do_regist() {	
			$this->_require_login(FALSE);
			$this->_require_ajax();
			$email = $this->input->post('email');
			$name = $this->input->post('name');
			$pass = $this->input->post('pass');
			$result = $this->User_model->insert($email, $name, $pass);
			$json_array = array('verify' => 0, 'email' => '');
			switch ($result) {
				case 1:
					$json_array['email'] = '邮箱已被注册';
					echo json_encode($json_array);
				default:
					$json_array['verify'] = 1;
					echo json_encode($json_array);
					$session = array(
						'id' => $result['id'],
						'type' => $result['user_type']['name']
					);
					$this->session->set_userdata($session);
			}
		}
		
		function logout() {
			$this->session->sess_destroy();
			redirect('index/login');
		}
	}