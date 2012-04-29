<?php
	class Notify_model extends CI_Model {
		public $jiadb;
		private $notify_type;
		function __construct() {
			parent::__Construct();
			$this->jiadb = new Jiadb('notify');
			$this->notify_type = array(
				'message' => $this->config->item('notify_type_message'),
				'letter' => $this->config->item('notify_type_letter'),
				'request' => $this->config->item('notify_type_request')
			);
		}
		
		function fetch(array $where, array $limit = array(10, 0)) {
			$where['type_id'] = $this->notify_type[$where['type']];
			unset($where['type']);
			return $this->jiadb->fetchJoin($where, array('user' => array('user_id', 'id')), array('time' => 'DESC'), $limit);
		}
		
		function insert(array $notify) {
			$notify['type_id'] = $this->notify_type[$notify['type']];
			unset($notify['type']);
			$this->db->insert('notify', $notify);
		}
		
		// 将消息标记已读
		function mark_as_read($notify_id) {
			if(is_array($notify_id)) {
				$this->db->where_in('id', $notify_id);
				$this->db->update('notify', array('status' => 0));
			} else {
				$this->db->where('id', $notify_id);
				$this->db->update('notify', array('status' => 0));
			}
		}
		
		function delete() {
			// do nothing here
		}
	}