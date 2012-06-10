<?php
	class Blog_model extends CI_Model {
		function __construct() {
			parent::__construct();
		}
		
		function fetch() {
			
		}
		
		function insert($blog) {
			if($blog && is_array($blog)) {
				$blog['type_id'] = ($blog['type'] == 'corporation' ? $this->config->item('entity_type_corporation') : $this->config->item('entity_type_personal'));
				unset($blog['type']);
				$this->db->insert('blog', $blog);
				return $this->db->insert_id();
			}
		}
		
		function delete() {
			
		}
		
		function update() {
			
		}
		
		function fetch() {
			
		}
	}
