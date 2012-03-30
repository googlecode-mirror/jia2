<?php
	class Post extends MY_Controller {
		function __construct() {
			parent::__construct();
		}
		// 默认调用_view 方法
		function index($id = '') {
			$this->_view($id);
		}
		
		function _view($id) {
			echo $id;
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