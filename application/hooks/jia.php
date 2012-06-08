<?php
// 初始化session方法，如果当前type为空则设置为guest
	function initialize () {
		$CI =& get_instance();
		if($CI->config->item('deploy_mode')) {
			show_error('网站正在升级，请稍后访问');
		}
		// 初始化session
		if(!$CI->session->userdata('type')) {
			$CI->session->set_userdata('type', 'guest');
		}
		// 从数据库读取并修改配置文件
		$entity_type = $CI->db->get('entity_type')->result_array();
		foreach ($entity_type as $row) {
			$CI->config->set_item('entity_type_' . $row['name'], $row['id']);
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
