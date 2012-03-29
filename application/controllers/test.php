<?php
	class Test extends MY_Controller {
		function index(){
			echo $this->session->userdata('type');
		}
	}
