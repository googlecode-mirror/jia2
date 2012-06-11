<?php
	class Blog_model extends CI_Model {
		public $jiadb;
		function __construct() {
			parent::__construct();
			$this->jiadb = new Jiadb('blog');
		}
		
		function get_info($blog_id, $more = FALSE) {
			$where = array(
				'id' => $blog_id
			);
			if($more) {
				$join = array('blog_comment' => array('id' => 'blog_id'));
				$blog_result = $this->jiadb->fetchJoin($where, $join);
			} else {
				$blog_result = $this->jiadb->fetchAll($where);
			}
			if($blog_result) {
				return $blog_result[0];
			} else {
				return FALSE;
			}
		}
		
		function fetch($where = array(), $type = 'personal') {
			
		}
		
		function insert($blog) {
			if($blog && is_array($blog)) {
				$blog['type_id'] = ($blog['type'] == 'corporation' ? $this->config->item('entity_type_corporation') : $this->config->item('entity_type_personal'));
				unset($blog['type']);
				$this->db->insert('blog', $blog);
				return $this->db->insert_id();
			} else {
				return FALSE;
			}
		}
		
		function delete() {
			
		}
		
		function update() {
			
		}
	}
