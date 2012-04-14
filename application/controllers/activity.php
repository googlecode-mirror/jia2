<?php
	class Activity extends MY_Controller {
		function __construct() {
			parent::__construct();
		}
		
		function index() {
			
		}
		
		function add() {
			$this->_auth(array('co_admin', 'co_master'));
			
		}
		
		function do_add() {
			
		}
		
		function edit() {
			
		}
		
		function do_edit() {
			
		}
		
		function delete() {
			
		}
	}
