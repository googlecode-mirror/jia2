<?php
	class Activity_model extends CI_Model {
		protected $jiadb;
		function __construct() {
			parent::__construct();
			$this->load->model('Post_model');
			$this->jiadb = new Jiadb('activity');
		}
		
		function get_info($id, $join = array()) {
			$this->jiadb->_table = 'activity';
			$result = $this->jiadb->fetchJoin(array('id' => $id), $join);
			if($result) {
				return $result[0];
			} else {
				return FALSE;
			}
		}
		
		//创建活动
		function insert($activity) {
			if($this->db->insert('activity', $activity)) {
				$activity_id = $this->db->insert_id();
				// 同时发一条post
				$post = array(
					'owner_id' => $activity['corporation_id'],
					'type' => 'activity',
					'content' => '发起了一个活动:' . anchor('activity/view/' . $activity_id, $activity['name']),
					'time' => time(),
				);
				$this->Post_model->insert($post);
				return $activity_id;
			} else {
				return FALSE;
			}
		}
		
		//编辑活动
		function edit() {
			
		}
		
		// 发布post
		function post() {
			
		}
	}
