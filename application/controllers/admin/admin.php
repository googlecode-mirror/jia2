<?php
	class Admin extends MY_Controller {
		public $jiadb;
		function __construct() {
			parent::__construct();
			if($this->session->userdata('type') != 'admin') {
				static_view('抱歉，你没有该权限', '权限不足');
			}
			$this->load->model('User_model');
			$jiadb = new Jiadb();
		}
		
		function co_request($request_id = '') {
			if(is_numeric($request_id)) {
				// 处理请求
				$this->jiadb->_table = 'corporation_request';
				$join = array(
					'user' => array('user_id', 'id')
				);
				$request =  $this->jiadb->fetchJoin(array('id' => $request_id, 'status' => 0), $join);
				if($request) {
					$pass = $this->input->get('pass');
					if($pass == 'yes') {
						$this->db->where('id', $request_id);
						$this->db->update('corporation_request', array('status' => 1));
						redirect('admin/admin/co_request');
					} elseif($pass == 'no') {
						$this->db->where('id', $request_id);
						$this->db->delete('corporation_request');
						redirect('admin/admin/co_request');
					} else {
						$data['title'] = '管理请求';
						$data['requests'] = $request;
						$data['js'] = 'admin/co_request.js';
						$data['main_content'] = 'admin/co_request_view';
					}
				} else {
					static_view('申请不存在');
				}
			} else {
				
			}
		}
	}