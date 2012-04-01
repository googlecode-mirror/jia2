<?php
	class User extends MY_Controller {
		function __construct() {
			parent::__construct();
			$this->load->model('User_model');
		}
		
		function index($param = '') {
			$data['title'] = 'User_view';
			$data['param'] = $param;
			$data['main_content'] = 'user_view';
			$this->load->view('includes/template_view', $data);
		}
		
		function my_info() {
			$result = $this->User_model->get_info(3, array('user_type' => array('type_id', 'id')));
			echo '<pre>';
			print_r($result);
			echo '</pre>';
		}
	}