<?php
	class Notify extends  MY_Controller {
		
		function __construct() {
			parent::__construct();
			$this->load->model('Notify_model');
			$this->load->model('User_model');
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
					$data['js'] = 'personal/letter.js';
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
				'receiver_id' => $this->session->userdata('id'),
				'type' => 'message'
			);
			return $this->Notify_model->fetch($where);
		}
		
		function _letter() {
			$letter_type = $this->input->get('letter');
			$where = array('type' => 'letter');
			if($letter_type == 'in' || TRUE) {
				$where['receiver_id']  = $this->session->userdata('id');
			} elseif($letter_type == 'out') {
				$where['user_id'] = $this->session->userdata('id');
			} else {
				static_view('抱歉，你访问的页面不存在');
			}
			return $this->Notify_model->fetch($where);
		}
		
		function _request() {
			$where = array(
				'receiver_id' => $this->session->userdata('id'),
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
				'receiver_id' => $user_id
			);
			$where['type_id'] = $this->config->item('notify_type_letter');
			$result['letter'] = count_rows('notify', $where);
			$where['type_id'] = $this->config->item('notify_type_message');
			$result['message'] = count_rows('notify', $where);
			$where['type_id'] = $this->config->item('notify_type_request');
			$result['request'] = count_rows('notify', $where);
			echo json_encode($result);
		}
		
		// 发送站内信
		function letter() {
			$this->_require_login();
			$this->_require_ajax();
			$user_id = $this->session->userdata('id');
			$content = trim($this->input->post('content'));
			$receiver = $this->input->post('receiver');
			$json_array = array(
				'success' => 0,
				'message' => ''
			);
			if(!is_numeric($receiver) || !$content) {
				$json_array['message'] = '你提交的数据格式不正确';
			} else {
				if(!$this->User_model->get_info($receiver)) {
					$json_array['message'] = '收件人不存在';
				} else {
					$letter = array(
						'user_id' => $user_id,
						'receiver_id' => $receiver,
						'content' => $content,
						'time' => time(),
						'type' => 'letter'
					);
					$this->Notify_model->insert($letter);
					$json_array['success'] = 1;
					$json_array['message'] = '发送成功';
				}
			}
			echo json_encode($json_array);
		}
	}