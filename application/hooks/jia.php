<?php

	function initialize () {
		$CI =& get_instance();
		if(!$CI->session->userdata('type')) {
			$CI->session->set_userdata('type', 'guester');
		}
	}