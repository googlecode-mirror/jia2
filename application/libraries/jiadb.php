<?php
	class Jiadb {
		public $_table;
		public $CI;
		function __construct($_table = '') {
			$this->CI =& get_instance();
			$this->_table = $_table;
		}
		
		// 返回数据库查询结果数组
		function fetchAll($where = array(), $order = array(), $limit = '') {
			if($where) {
				foreach ($where as $key => $value) {
					if(is_array($value)) {
						$this->CI->db->where_in($key, $value);
					} else {
						$this->CI->db->where($key, $value);
					}
				}
			}
			if($order) {
				foreach ($order as $key => $value) {
					$this->CI->db->order_by($key, $value);
				}
			}
			if($limit) {
				if(is_array($limit)) {
					$this->CI->db->limit($limit[0], $limit[1]);
				} else {
					$this->CI->db->limit($limit);
				}
			}
			return $this->CI->db->get($this->_table)->result_array();
		}
	}
