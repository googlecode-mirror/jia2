<?php
	class Personal extends MY_Controller {
		function __construct() {
			parent::__construct();
		}
		
		function index() {
			redirect('personal/profile');
		}
		
		function profile($id = '') {
			$id = $id ? $id : $this->session->userdata('id');
			$this->_auth('view', 'post', $id);
			$this->load->view('personal/profile_view', $data);
		}
		
		function setting() {
			$data['main_content'] = 'personal/setting_view';
			$this->load->view('inlcudes/template_view', $data);
		}
		
	}
