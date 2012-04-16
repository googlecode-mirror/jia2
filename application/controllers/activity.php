<?php
	class Activity extends MY_Controller {
		function __construct() {
			parent::__construct();
			$this->load->model('Corporation_model');
		}
		
		function index() {
			static_view('活动集中地');
		}
		
		function add($corporation_id = '') {
			$this->_require_login();
			if($corporation_id) {
				$corporation_info = $this->Corporation_model->get_info($corporation_id);
				if($corporation_info) {
					$this->_auth('add', 'activity', $corporation_id);
					static_view('给社团创建活动页面');
				} else {
					static_view('社团不存在');
				}
			} else {
				static_view('社团不存在');
			}
		}
		
		function do_add() {
			$this->_require_login();
		}
		
		function edit() {
			$this->_require_login();
		}
		
		function do_edit() {
			$this->_require_login();
		}
		
		function delete() {
			$this->_require_login();
		}
	}
