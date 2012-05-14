<?php

// 错误提示视图方法
if ( ! function_exists('static_view')) {
	function static_view($message = '抱歉，您访问的页面不存在', $title = '404 Not Found', $url = '') {
		$CI =& get_instance();
		$data['main_content'] = 'static_view';
		$data['message'] = $message;
		$data['title'] = $title;
		$data['url'] = $url;
		$CI->load->view('includes/template_view', $data);
		exit($CI->output->get_output());
	}
}

// 自动跳转视图方法
if( ! function_exists('jump_view')) {
	function jump_view($message, $url = '', $title = 'forward') {
		$CI =& get_instance();
		$data['main_content'] = 'jump_view';
		$data['message'] = $message;
		$data['url'] = $url ? $url : site_url();
		$data['title'] = $title;
		$CI->load->view('includes/template_view', $data);
		exit($CI->output->get_output());
	}
}

// 生成头像链接方法
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

// 统计满足条件的表记录总数
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

// 将时间戳转换为中国时间方法
if(! function_exists('jdate')) {
	function jdate($time, $with_hour = TRUE) {
		if(is_numeric($time) && $with_hour)
			return date('Y年m月d日 H:i:s', $time);
		elseif(is_numeric($time) && !$with_hour)
			return date('Y年m月d日', $time);
		else
			return '获取时间失败';
	}
}
