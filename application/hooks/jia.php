<?php
// 初始化session方法，如果当前type为空则设置为guest
	function initialize () {
		$CI =& get_instance();
		if(!$CI->session->userdata('type')) {
			$CI->session->set_userdata('type', 'guest');
		}
	}