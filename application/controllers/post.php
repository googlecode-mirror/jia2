<?php
	class Post extends MY_Controller {
		function __construct() {
			parent::__construct();
			$this->load->model('Post_model');
		}
		// 默认调用_view 方法
		function index() {
			$this->_view();
		}
		
		function _view() {
			
		}
		
		function add() {
			$this->_auth('add', 'post', $this->session->userdata('id'));
			$post = array(
				'id' => $this->session->userdata('id'),
				'type_id' => 1,
				'content' => $this->input->post('content'),
				'time' => time()
			);
			//$this->Post_model->insert($post);
		}
		
		function edit($id = 1) {
			$post = $this->db->where('id', $id)->get('posts')->result_array();
			$this->_auth(array('owner'), $post);
			echo '可以编辑';
		}
	} 