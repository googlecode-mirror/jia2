<?php
	class Post extends MY_Controller {
		function __construct() {
			parent::__construct();
			$this->load->model('Post_model');
		}
		// 默认调用_view 方法
		function index($param = '') {
			$this->_view();
		}
		
		function _view() {
			echo '查看帖子';
		}
		
		function add() {
			$this->_auth('add', 'post', $this->session->userdata('id'));
			$post = array(
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
		
		function comment() {
			$this->_require_login();
			$this->_require_ajax();
			$owner_id = $this->input->post('owner_id');
			$type_id = $this->input->post('type_id');
			$type = $this->config->item('post_type_activity') == $type_id ? 'activity' : 'personal';
			$this->_auth('add', 'comment', $this->session->userdata('id'), array($type, $owner_id));
			$comment = array(
				'post_id' => $this->input->post('post_id'),
				'user_id' => $this->session->userdata('id'),
				'content' => $this->input->post('content'),
				'time' => time()
			);
			$comment_id = $this->Post_model->insert_comment($comment);
			if($comment_id) {
				$comment = $this->Post_model->fetch_comment(array('id' => $comment_id));
				echo json_encode($comment);
			} else {
				echo 0;
			}
		}
	} 