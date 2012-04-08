<?php
if ( ! function_exists('static_view')) {
	function static_view($message, $url = '', $title = 'Error') {
		$CI =& get_instance();
		$data['main_content'] = 'static_view';
		$data['message'] = $message;
		$data['title'] = $title;
		$data['url'] = $url;
		$CI->load->view('includes/template_view', $data);
		exit($CI->output->get_output());
	}
}

if( ! function_exists('jump_view')) {
	function jump_view($message, $url = '', $title = 'Error') {
		$CI =& get_instance();
		$data['main_content'] = 'jump_view';
		$data['message'] = $message;
		$data['url'] = $url ? $url : site_url();
		$data['title'] = $title;
		$CI->load->view('includes/template_view', $data);
		exit($CI->output->get_output());
	}
}

if( ! function_exists('avatar_url')) {
	function avatar_url($avatar = 'default.jpg', $mode = 'tiny') {
		$CI =& get_instance();
		return site_url($CI->config->item('personal_avatar_path') . $mode . '/' . $avatar);
	}
}