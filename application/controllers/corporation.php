<?php
	class Corporation extends MY_Controller {
		function __construct() {
			parent::__construct();
		}
		
		function add() {
			$this->_require_login();
			$this->_auth('add', 'corporation', $this->session->userdata('id'));
			echo '有权限';
		}
		
		function index() {
			
		}
	}