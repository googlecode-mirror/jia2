<?php
	class Corporation_model extends CI_Model {
		protected $jiadb;
		function __construct() {
			parent::__construct();
			$this->jiadb = new Jiadb('Corporation');
		}
		
		function get_info($id, $join = array()) {
			$reslut = $this->jiadb->fetchJoin(array('id' => $id), $join);
			return $reslut;
		}
		
		function get_meta($meta_key, $co_id, $join_table = TRUE, $where = array(), $order = array(), $limit = array()) {
			$meta = array();
			$this->jiadb->_table = 'user_meta';
			$where['corporation_id'] = $co_id;
			$where['meta_key'] = $meta_key;
			$result = $this->jiadb->fetchAll($where, $order, $limit);
			if($result) {
				if($join_table) {
					foreach ($result as $row) {
						$this->jiadb->_table = $row['meta_table'];
						$user = $this->jiadb->fetchAll(array('id' => $row['meta_value']));
						$meta[] = $user[0];
					}
				} else {
					foreach ($result as $row) {
						$meta[] = $row['meta_value'];
					}
				}	
			}
			return $meta;
		}
	}
