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
				'owner_id' => $this->session->userdata('id'),
				'type' => 'personal',
				'content' => $this->input->post('content'),
				'time' => time()
			);
			$this->Post_model->insert($post);
			redirect();
		}
		
		function edit($id = 1) {
			$post = $this->db->where('id', $id)->get('posts')->result_array();
			$this->_auth(array('owner'), $post);
			echo '可以编辑';
		}
	} 