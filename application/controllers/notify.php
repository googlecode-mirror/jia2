<?php
	class Notify extends  MY_Controller {
		private $jiadb;
		function __construct() {
			parent::__construct();
			$this->load->model('Notify_model');
			$this->load->model('User_model');
			$this->jiadb = new Jiadb('notify');
		}
		
		function get_info($notify_id) {
			$notify = $this->jiadb->fetchAll(array('id' => $notify_id));
			return $notify;
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
					// ajax 请求
					if($this->_require_ajax(TRUE)) {
						$box = $this->input->post('box');
						if($box != 'in' && $box != 'out')
							static_view('你请求的数据不存在');
						$letter['info'] = $this->User_model->get_info($this->session->userdata('id'));
						$letter['letters'] = $this->_letter($box);
						$this->load->view('notify/letter_' . $box . '_view', $letter);
					} else {
						$data['title'] = '站内信';
						$data['js'] = 'personal/letter.js';
						$this->load->view('includes/template_view', $data);
					}
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
		
		function _letter($box) {
			$where = array('type' => 'letter');
			if($box == 'in') {
				$where['receiver_id']  = $this->session->userdata('id');
			} else {
				$where['user_id'] = $this->session->userdata('id');
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