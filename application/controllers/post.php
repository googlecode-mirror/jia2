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
			$content = $this->input->post('content');
			if(trim($content)) {
				$post = array(
				'owner_id' => $this->session->userdata('id'),
				'type' => 'personal',
				'content' => trim($this->input->post('content')),
				'time' => time()
			);
				$this->Post_model->insert($post);
			}
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
			if(!$this->_auth('add', 'comment', $this->session->userdata('id'), TRUE, array($type, $owner_id))) {
				exit();
			}
			if($this->input->post('content') != '') {
				$comment = array(
					'post_id' => $this->input->post('post_id'),
					'user_id' => $this->session->userdata('id'),
					'content' => $this->input->post('content'),
					'time' => time()
				);
				$comment_id = $this->Post_model->insert_comment($comment);
				if(!($type == 'personal' && $owner_id == $this->session->userdata('id'))) {
					// 插入一条通知
					$notify = array(
						'user_id' => $this->session->userdata('id'),
						'receiver' => $owner_id,
						'content' => '评论了你的新鲜事' . anchor('personal/profile?post_id=' . $this->input->post('post_id')),
						'type' => 'message',
						'time' => time()
					);
					$this->Notify_model->insert($notify);
				}
				if($comment_id) {
					$comment = $this->Post_model->fetch_comment(array('id' => $comment_id));
					?>
					<li>
					<?=anchor('personal/profile/' . $comment['user'][0]['id'], '<img src="'. avatar_url($comment['user'][0]['avatar']) .'" >', 'class="head_pic"') ?>
					<p><?=anchor('personal/profile/' . $comment['user'][0]['id'], $comment['user'][0]['name']) ?>：<?=$comment['content']?><a href="#" class="reply"'>回复</a><br />
					<small><?=$comment['time'] ?></small></p>
					</li>
				<?
				} else {
					echo 0;
				}
			}
		}
	} 