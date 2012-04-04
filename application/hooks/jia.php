<?php
// 初始化session方法，如果当前type为空则设置为guest
	function initialize () {
		$CI =& get_instance();
		if(!$CI->session->userdata('type')) {
			$CI->session->set_userdata('type', 'guest');
		}
		$post_type = $CI->db->get('post_type')->result_array();
		foreach ($post_type as $row) {
			$CI->config->set_item('post_type_' . $row['name'], $row['id']);
		}
	}