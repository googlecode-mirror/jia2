<?php
	class Index extends MY_Controller {
		function __construct() {
			parent::__construct();
		}
		function index($param = '') {
			$data['title'] = 'Jia2 Index';
			$data['param'] = $param;
			$data['main_content'] = 'index_view';
			$this->load->view('includes/template_view', $data);
		}
	}