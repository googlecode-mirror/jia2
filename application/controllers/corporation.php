<?php
	class Corporation extends MY_Controller {
		function add() {
			$this->_auth(array('admin'));
			echo '有权限';
		}
		
		function index() {
			
		}
	}