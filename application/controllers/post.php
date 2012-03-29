<?php
	class Post extends MY_Controller {
		function __construct() {
			parent::__construct();
		}
		function index() {
			
			
			$this->_auth(array('owner'));
		}
		
		function view() {
			
		}
		
		function add() {
			$this->_auth();
			echo 'accessed';
		}
		
		function edit($id = 1) {
			$post = $this->db->where('id', $id)->get('posts')->result_array();
			$this->_auth(array('owner'), $post);
			echo '可以编辑';
		}
	} 