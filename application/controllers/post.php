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
			$this->_require_ajax();
			$this->_require_login();
			$this->_auth('add', 'post', $this->session->userdata('id'));
			$content = $this->input->post('content');
			if(trim($content)) {
				$post = array(
				'owner_id' => $this->session->userdata('id'),
				'type' => 'personal',
				'content' => trim($this->input->post('content')),
				'time' => time()
			);
				$post_id = $this->Post_model->insert($post);
				if($post_id) {
					$post = $this->Post_model->get_info($post_id, array('user' => array('owner_id', 'id')));
					?>
					<li class="feed_a">
						<div class="img_block">
							<?=anchor('personal/profile/' . $post['user'][0]['id'], '<img src="'. avatar_url($post['user'][0]['avatar']) .'" >','class="head_pic"') ?>
						</div>
						<div class="feed_main">
							<div class="f_info">
								<a href="<?=site_url('personal/profile/' . $post['user'][0]['id']) ?>"><?=$post['user'][0]['name']?></a>
								<span class="f_do"><?=$post['content']?></span>
							</div>
							<div class="f_summary">
								<p class="f_pm">
									<span>22:06</span>
									<span><a>收起评论</a></span>
									<span><a>评论</a></span>
								</p>
							</div>
								<div class="feeds_comment_box">
									<ul class="comment">
									</ul>
									<div>
										<p><?=form_textarea(array('name' => 'comment_content', 'post_id'=>$post['id'], 'type' => 'personal', 'cols' => 50, 'rows' => 2)) ?></p>
										<p><?=form_button('comment', '评论') ?></p>
									</div>
								</div>
						</div>
					</li>
					<?
				} else {
					echo 0; exit;
				}
			} else {
				echo 0; exit;
			}
		}
		
		function edit($id = 1) {
			$post = $this->db->where('id', $id)->get('posts')->result_array();
			$this->_auth(array('owner'), $post);
			echo '可以编辑';
		}
		
		function comment() {
			$this->_require_login();
			$this->_require_ajax();
			//$owner_id = $this->input->post('owner_id');
			$type = $this->input->post('type');
			$post_id = $this->input->post('post_id');
			if(!$this->_auth('add', 'comment', $this->session->userdata('id'), TRUE, $post_id)) {
				echo 0;
				exit();
			}
			$post = $this->Post_model->get_info($post_id);
			$owner_id = $post['owner_id'];
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
						'content' => '评论了你的' . anchor('personal/profile?post_id=' . $this->input->post('post_id'), '新鲜事'),
						'type' => 'message',
						'time' => time()
					);
					$this->Notify_model->insert($notify);
				}
				if($comment_id) {
					$comment = $this->Post_model->fetch_comment(array('id' => $comment_id));
					?>
					<li>
						<div class="img_block"><?=anchor('personal/profile/' . $comment['user'][0]['id'], '<img src="'. avatar_url($comment['user'][0]['avatar']) .'" >','class="head_pic"') ?></div>
						<div class="comment_main">
							<div class="f_info">
							<?=anchor('personal/profile/' . $comment['user'][0]['id'], $comment['user'][0]['name']) ?>：
							<span class="f_do"><?=$comment['content']?></span>
						</div>
						<p class="f_pm">
							<span><?=$comment['time'] ?></span>
							<span><a>回复</a></span>
						</p>
						</div>
					</li>
				<?
				} else {
					echo 0;
				}
			}
		}
	} 