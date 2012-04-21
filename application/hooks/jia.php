<?php
// 初始化session方法，如果当前type为空则设置为guest
	function initialize () {
		$CI =& get_instance();
		// 初始化session
		if(!$CI->session->userdata('type')) {
			$CI->session->set_userdata('type', 'guest');
		}
		// 从数据库读取并修改配置文件
		// 文章类型id
		// 消息类型id
		$post_type = $CI->db->get('post_type')->result_array();
		$notify_type = $CI->db->get('notify_type')->result_array();
		foreach ($post_type as $row) {
			$CI->config->set_item('post_type_' . $row['name'], $row['id']);
		}
		foreach ($notify_type as $row) {
			$CI->config->set_item('notify_type_' . $row['name'], $row['id']);
		}
		
		// 用cooki登录
		if($CI->session->userdata('type') == 'guest' && get_cookie('id') && get_cookie('pass') && $CI->uri->segment(2) != 'do_login') {
			$redirect = uri_string();
			$redirect = (($redirect == '') ? site_url() : $redirect);
			redirect('index/do_login/1?redirect=' . $redirect);
		}
	}
	
	function jia_redirect() {
		$CI =& get_instance();
		if($CI->input->get('redirect')) {
			redirect($CI->input->get('redirect'));
		}
	}
