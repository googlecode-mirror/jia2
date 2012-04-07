<?php
// 初始化session方法，如果当前type为空则设置为guest
	function initialize () {
		$CI =& get_instance();
		// 初始化session
		if(!$CI->session->userdata('type')) {
			$CI->session->set_userdata('type', 'guest');
		}
		$post_type = $CI->db->get('post_type')->result_array();
		// 从数据库读取并修改配置文件
		foreach ($post_type as $row) {
			$CI->config->set_item('post_type_' . $row['name'], $row['id']);
		}
	}