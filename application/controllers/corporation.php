<?php
	class Corporation extends MY_Controller {
		function __construct() {
			parent::__construct();
		}
		function add() {
			$this->_auth(array('admin'));
			echo '有权限';
		}
		
		function index() {
			
		}
	}