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
	/**
	 * @param string from db
	 * @param string ting or big
	 */
	function avatar_url($avatar = 'default.jpg', $obj = 'personal', $mode = 'tiny') {
		$CI =& get_instance();
		return site_url($CI->config->item($obj . '_avatar_path') . $mode . '/' . $avatar);
	}
}

if(! function_exists('count_rows')) {
	function count_rows($table, $where = array()) {
		$CI = &get_instance();
		if ($where) {
			foreach ($where as $key => $value) {
				if (is_array($value)) {
					$CI->db->where_in($key, $value);
				} else {
					$CI->db->where($key, $value);
				}
			}
			return $CI->db->get($table)->num_rows;
		} else {
			//若无限制条件则返回表的总行数
			return $CI->db->count_all($table);
		}
	}
}
