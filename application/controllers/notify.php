<?php
	class Notify extends  MY_Controller {
		
		function __construct() {
			parent::__construct();
			$this->load->model('Notify_model');
		}
		
		function index() {
			$this->_require_login();
			$type = $this->input->get('type');
			$data['notify'] = $type;
			$data['css'] = array('home.css','guest.css');
			$data['js'] = array('tab.js');
			$data['main_content'] = 'notify_view';
			switch($type) {
				case 'letter':
					$data['title'] = '站内信';
					$data['letters'] = $this->_letter();
					$this->load->view('includes/template_view', $data);
					break;
				case 'message':
					$data['title'] = '消息';
					$data['messages'] = $this->_message();
					$this->load->view('includes/template_view', $data);
					break;
				case 'request':
					$data['title'] = '请求';
					$this->_request();
					$data['requests'] = $this->_request();
					$this->load->view('includes/template_view', $data);
					break;
				default:
					static_view('抱歉，你访问的页面不存在');
			}
		}
		
		function _message() {
			$where = array(
				'receiver' => $this->session->userdata('id'),
				'type' => 'message'
			);
			return $this->Notify_model->fetch($where);
		}
		
		function _letter() {
			$where = array(
				'receiver' => $this->session->userdata('id'),
				'type' => 'letter'
			);
			return $this->Notify_model->fetch($where);
		}
		
		function _request() {
			$where = array(
				'receiver' => $this->session->userdata('id'),
				'type' => 'request'
			);
			return $this->Notify_model->fetch($where);
		}
		
		function check() {
			$this->_require_login();
			$this->_require_ajax();
			$user_id = $this->session->userdata('id');
			$where = array(
				'status' => 1,
				'receiver' => $user_id
			);
			$where['type_id'] = $this->config->item('notify_type_letter');
			$result['letter'] = count_rows('notify', $where);
			$where['type_id'] = $this->config->item('notify_type_message');
			$result['message'] = count_rows('notify', $where);
			$where['type_id'] = $this->config->item('notify_type_request');
			$result['request'] = count_rows('notify', $where);
			echo json_encode($result);
		}
	}