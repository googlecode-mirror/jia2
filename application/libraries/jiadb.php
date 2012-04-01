<?php
	class Jiadb {
		/**
		 * @var string table's name
		 * @access pulic
		 */
		public $_table;
		/**
		 * @var object
		 * @access public
		 */
		public $CI;
		/**
		 * @param string table's name
		 */
		function __construct($_table = '') {
			$this->CI =& get_instance();
			$this->_table = $_table;
		}
		
		/**
		 * @param array index is table's field value is field's value 
		 * @param array 
		 * @param array
		 * @return array
		 */ 
		function fetchAll($where = array(), $order = array(), $limit = array()) {
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
			$result = $this->CI->db->get($this->_table)->result_array();
			$rows = count($result);
			if ($rows > 0) {
				return $result;
			} else {
				return FALSE;
			}
		}
		
		/**
		 * @param array
		 * @param array like following:
		 * $join = array(
		 * 		'joined_table1' => array('current_table_field', 'joined_table1_field'),
		 * 		'joined_table2' => array('current_table_field', 'joined_table2_field')
		 * )
		 * @param array
		 * @param array
		 */ 
		function fetchJoin($where = array(), $join = array(), $order = array(), $limit = array()) {
			$result = $this->fetchAll($where, $order, $limit);
			if($result && $join) {
				foreach ($join as $table => $field) {
					foreach ($result as $key => $row) {
						$this->_table = $table;
						$tmp = $this->fetchAll(array($field[1] => $row[$field[0]]));
						$num_rows = count($tmp);
						switch ($num_rows) {
							case 0:
								$tmp = 0;
								break;
							case 1:
								$tmp = $tmp[0];
						}
						$result[$key][$table] = $tmp;
					}
				}
			}
			return $result;
			
		}
		
		/**
		 * @param array
		 * @param array like following:
		 * $meta = array(
		 * 		'meta_key1',
		 * 		'meta_key2'
		 * )
		 * @param array
		 * @param array
		 */ 
		function fetchMeta($where = array(), $meta = array(), $order = array(), $limit = array()) {
			$reslut = array();
			$this->_table += '_meta';
			if($meta) {
				if(count($meta) > 1) {
					foreach ($meta as $key => $meta_key) {
						$meta_where = array_merge($where, array('meta_key' => $meta_key));
						$tmp = $this->fetchAll($meta_where);
						foreach($tmp as $row) {
							$reslut[$meta_key][] = $row['meta_value'];
						}
					}
				} else {
					$meta_where = array_merge($where, array('meta_key' => $meta[0]));
					$tmp = $this->fetchAll($meta_where);
					foreach ($tmp as $row) {
						$reslut[] = $row['meta_value'];
					}
				}
				
			}
		}
	}
