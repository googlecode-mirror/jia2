<?php
	class Notify extends  MY_Controller {
		
		function __construct() {
			parent::__construct();
			$this->load->model('Notify_model');
		}
		
		function index() {
			$this->_require_login();
			$type = $this->input->get('type');
			switch($type) {
				case 'letter':
					$data['letter'] = $this->_letter();
					break;
				case 'message':
					$data['message'] = $this->_message();
					$data['main_content'] = 'notify_view';
					$this->load->view('includes/template_view', $data);
					break;
				case 'request':
					$this->_request();
					break;
				default:
					static_view('抱歉，你访问的页面不存在');
			}
		}
		
		function _message() {
			$where = array(
				'user_id' => $this->session->userdata('id'),
				'type' => 'message'
			);
			return $this->Notify_model->fetch($where);
		}
		
		function _letter() {
			
		}
		
		function _request() {
			
		}
		
		function check() {
			$this->_require_login();
			$this->_require_ajax();
		}
	}