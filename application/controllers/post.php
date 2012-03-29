<?php
	class Post extends MY_Controller {
		function index() {
			
			
			$this->_auth(array('owner', 'admin'));
		}
		
		function view() {
			
		}
		
		function add() {
			$this->_auth(array('admin'));
			echo 'accessed';
		}
		
		function edit($id = 1) {
			$post = $this->db->where('id', $id)->get('posts')->result_array();
			$this->_auth(array('owner', 'admin'), $post);
			echo '可以编辑';
		}
	} 