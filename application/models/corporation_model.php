<?php
	class Corporation_model extends CI_Model {
		protected $jiadb;
		function __construct() {
			parent::__construct();
			$this->jiadb = new Jiadb('Corporation');
		}
		
		function get_info($id, $join = array()) {
			$reslut = $this->jiadb->fetchJoin(array('id' => $id), $join);
			if($reslut) {
				return $reslut[0];
			} else {
				return FALSE;
			}
		}
		
		function get_meta($meta_key, $co_id, $join_table = TRUE, $where = array(), $order = array(), $limit = array()) {
			$meta = array();
			$this->jiadb->_table = 'corporation_meta';
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
		
		function insert($array) {
			if($this->db->insert('corporation', $array)) {
				$corporation_id = $this->db->insert_id();
				$corporation_access = Access_factory::get_access('corporation');
				$activity_access = Access_factory::get_access('activity');
				$comment_access = Access_factory::get_access('comment');
				$comment_access->init($corporation_id, 'activity');
				$corporation_access->init($corporation_id);
				$activity_access->init($corporation_id);
				return $corporation_id;
			} else {
				return FALSE;
			}
		}
	}
