<?php
	class Personal extends MY_Controller {
		public $user_id;
		function __construct() {
			parent::__construct();
			$this->load->model('User_model');
			$this->load->model('Post_model');
			$this->user_id = $this->session->userdata('id');
		}
		
		function index() {
			redirect('personal/profile');
		}
		
		function profile($id = '') {
			if($id == '') {
				$this->_require_login();
			}
			$id = $id ? $id : $this->session->userdata('id');
			$this->_auth('view', 'post', $id);
			$data['title'] = '个人主页';
			$data['info'] = $this->User_model->get_info((int)$id);
			$data['friends'] = $this->User_model->get_meta('friend', $this->user_id);
			$data['posts'] = $this->Post_model->fetch(array('owner_id' => $this->user_id));
			$data['main_content'] = 'personal/profile_view';
			$this->load->view('includes/template_view', $data);
		}
		
		function setting() {
			$this->_require_login();
			$data['main_content'] = 'personal/setting_view';
			$this->load->view('inlcudes/template_view', $data);
		}
		
		function add_friend() {
			$this->_require_login();
			$this->_require_ajax();
			$friend_id = $this->input->post('user_id');
			$user_id = $this->user_id;
			if($this->User_model->add_friend($user_id, $friend_id)) {
				echo 1;
			} else {
				echo 0;
			}
		}
		
		function add_blocker() {
			$this->_require_login();
			$this->_require_ajax();
			$blocker_id = $this->input->post('user_id');
			$user_id = $this->user_id;
			if($this->User_model->add_blocker($user_id, $blocker_id)) {
				echo 1;
			} else {
				echo 0;
			}
		}
	}
