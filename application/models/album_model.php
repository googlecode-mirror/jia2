<?php
	class Album_model extends CI_Model {
		function __construct() {
			parent::__construct();
		}
		
		function get_info() {
			
		}
		
		function insert($album) {
			if($album && is_array($album)) {
				$album['type_id'] = ($album['type'] == 'corporation' ? $this->config->item('entity_corporation') : $this->config->item('entity_personal'));
				unset($album['type']);
				$result = $this->db->get_where('album', $album);
				if($result->num_rows > 0) {
					return '相册名已存在';
				} else {
					$this->db->insert('album', $album);
					return $this->db->insert_id();
				}
			} else {
				return '创建相册失败';
			}
		}
		
		function update() {
			
		}
		
		function fetch_album() {
			
		}
		
		function fetch_photo($album_id) {
			
		}
		
		function delete_album() {
			
		}
		
		function delete_photo() {
			
		}
	}
