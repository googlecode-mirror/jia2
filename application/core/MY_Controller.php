<?php
	class MY_Controller extends CI_Controller {
		function __construct() {
			parent::__construct();
		}
		
		function _remap($method) {
			if(method_exists($this, $method)) {
				$this->$method();
			} else {
				$this->index($method);
			}
		}
	}