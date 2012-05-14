<?php
	class Personal extends MY_Controller {
		public $user_id;
		function __construct() {
			parent::__construct();
			$this->load->model('User_model');
			$this->load->model('Post_model');
			$this->load->model('Photo_model');
			$this->user_id = $this->session->userdata('id');
		}
		
		function index() {
			redirect('personal/profile');
		}
		
		function profile($id = '') {
			if($id == '') {
				$this->_require_login();
			}
			$id = $id ? $id : $this->session->userdata('id');
			$this->_auth('view', 'post', $id);
			$join = array(
				'school' => array('school_id', 'id'),
				'province' => array('province_id', 'id')
			);
			$data['info'] = $this->User_model->get_info((int)$id, $join);
			$data['followers'] = $this->User_model->get_followers($id);
			$data['title'] = '个人主页-' . $data['info']['name'];
			$data['followers'] = $this->User_model->get_followers($id);
			$post_id = $this->input->get('post_id');
			if(!empty($post_id)) {
				$post = array('personal' => $this->Post_model->fetch(array('owner_id' => $id, 'id' => $post_id)));
				if($post['personal']) {
					$data['posts'] = $post;
				} else {
					static_view('抱歉该页面不存在');
				}
			} else {
				$data['posts'] = array('personal' => $this->Post_model->fetch(array('owner_id' => $id)));
			}
			$data['js'] = array('post.js', 'personal/profile_view.js', 'tab.js');
			$data['main_content'] = 'personal/profile_view';
			$data['slider_bar_view'] = 'includes/slider_bar_view';
			$this->load->view('includes/template_view', $data);
		}
		
		function setting() {
			$this->_require_login();
			$post_auth = Auth_factory::get_auth('post', $this->session->userdata('id'));
			$comment_auth = Auth_factory::get_auth('comment', $this->session->userdata('id'));
			$identity_array = array(
				'guest', 'register', 'follower'
			);
			$privacy = array(
				'post' => '',
				'comment' => ''
			);
			for($i=0; $i<3; $i++) {
				$post_auth->get_access('view', $identity_array[$i]);
				if ($post_auth->access == 1) {
					$privacy['post'] = $identity_array[$i];
					break;
				}
			}
			for ($i=0; $i<3; $i++) {
				$comment_auth->get_access('add', $identity_array[$i]);
				if ($comment_auth->access == 1) {
					$privacy['comment'] = $identity_array[$i];
					break;
				}
			}
			$privacy['post'] = $privacy['post'] ? $privacy['post'] : 'self';
			$privacy['comment'] = $privacy['comment'] ? $privacy['comment'] : 'self';
			$data['info'] = $this->User_model->get_info((int)$this->session->userdata('id'));
			$data['title'] = '账户设置';
			$data['privacy'] = $privacy;
			$join = array(
				'school' => array('school_id', 'id'),
				'province' => array('province_id', 'id')
			);
			$data['info'] = $this->User_model->get_info((int)$this->session->userdata('id'), $join);
			$data['main_content'] = 'personal/setting_view';
			$data['slider_bar_view'] = 'includes/slider_bar_view';
			$data['js'] = array('personal/setting.js','tab.js');
			$this->load->view('includes/template_view', $data);
		}
		
		function do_setting() {
			$this->_require_login();
			$setting = $this->input->post('setting');
			switch ($setting) {
				
				case 'avatar':
					// 头像设置
					$result = $this->Photo_model->set_avatar('personal', $this->user_id);
					if($result) {
						$this->User_model->update(array('id' => $this->user_id), array('avatar' => $result));
						redirect('personal/setting');
					} else {
						static_view('不好意思亲~ 上传失败了, 要不然' . anchor('personal/setting', '再试一次?'));
					}
					break;
					
				case 'info':
				// 资料设置
					$name = $this->input->post('name');
					$gender = $this->input->post('gender');
					
				case 'privacy':
					// 隐私设置
					$post = $this->input->post('post');
					$comment = $this->input->post('comment');
					$post_access = Access_factory::get_access('post');
					$comment_access = Access_factory::get_access('comment');
					// post 权限设置
					$post_access_array = array();
					$comment_access_array = array();
					switch ($post) {
						case 'guest':
							$post_access_array = array(
								array('identity' => 'guest', 'operation' => 'view', 'access' => 1),
								array('identity' => 'register', 'operation' => 'view', 'access' => 1),
								array('identity' => 'follower', 'operation' => 'view', 'access' => 1)
							);
							break;
						case 'register':
							$post_access_array = array(
								array('identity' => 'guest', 'operation' => 'view', 'access' => 0),
								array('identity' => 'register', 'operation' => 'view', 'access' => 1),
								array('identity' => 'follower', 'operation' => 'view', 'access' => 1)
							);
							break;
						case 'follower':
							$post_access_array = array(
								array('identity' => 'guest', 'operation' => 'view', 'access' => 0),
								array('identity' => 'register', 'operation' => 'view', 'access' => 0),
								array('identity' => 'follower', 'operation' => 'view', 'access' => 1)
							);
							break;
						case 'self':
							$post_access_array = array(
								array('identity' => 'guest', 'operation' => 'view', 'access' => 0),
								array('identity' => 'register', 'operation' => 'view', 'access' => 0),
								array('identity' => 'follower', 'operation' => 'view', 'access' => 0)
							);
							break;
						default:
							static_view('亲, 请不要恶意篡改表单好嘛~, 给你个机会, ' . anchor('personal/setting#privacy', '重新设置'));
					}
					// 评论权限设置
					switch ($comment) {
						case 'register':
							$comment_access_array = array(
								array('identity' => 'register', 'operation' => 'add', 'access' => 1),
								array('identity' => 'follower', 'operation' => 'add', 'access' => 1)
							);
							break;
						case 'follower':
							$comment_access_array = array(
								array('identity' => 'register', 'operation' => 'add', 'access' => 0),
								array('identity' => 'follower', 'operation' => 'add', 'access' => 1)
							);
							break;
						case 'self':
							$comment_access_array = array(
								array('identity' => 'register', 'operation' => 'add', 'access' => 0),
								array('identity' => 'follower', 'operation' => 'add', 'access' => 0)
							);
							break;
						default:
							static_view('亲, 请不要恶意篡改表单好嘛~, 给你个机会, ' . anchor('personal/setting#privacy', '重新设置'));
					}
					$post_access->set_access($this->user_id, $post_access_array);
					$comment_access->set_access($this->user_id, $comment_access_array, 'personal');
					break;
					
				case 'pass':
					// 密码设置
					$this->_require_ajax();
					$old_pass = $this->input->post('old_pass');
					$pass = $this->input->post('pass');
					$pass_check = $this->input->post('pass_check');
					$json_array = array(
						'verify' => 0,
						'old_pass' => '',
						'pass' => '',
						'pass_check' => ''
					);
					if(!$old_pass) {
						$json_array['old_pass'] = '请输入原密码';
						echo json_encode($json_array);
						return;
					}
					if(!$pass) {
						$json_array['pass'] = '请输入新密码';
						echo json_encode($json_array);
						return;
					}
					if($pass != $pass_check) {
						$json_array['pass_check'] = '密码不一致';
						echo json_encode($json_array);
						return;
					}
					$info = $this->User_model->get_info((int)$this->user_id);
					$info = $info[0];
					if($info['pass'] != md5($old_pass)) {
						$json_array['old_pass'] = '原密码不正确';
						echo json_encode($json_array);
						return;
					}
					$this->db->where('id', $this->user_id);
					$this->db->update('user', array('pass' => md5($pass)));
					$json_array['verify'] = 1;
					echo json_encode($json_array);
				break;
			}
			redirect('personal/setting');
		}
		
		// 关注某人
		function follow() {
			$this->_require_login();
			$this->_require_ajax();
			$following_id = $this->input->post('user_id');
			if($this->User_model->follow($this->user_id, $following_id)) {
				// 发条通知
				$notify = array(
					'user_id' => $this->user_id,
					'receiver_id' => $following_id,
					'content' => '关注了你',
					'time' => time(),
					'type' => 'message'
				);
				$this->Notify_model->insert($notify);
				echo 1;
			} else {
				echo 0;
			}
		}
		
		function unfollow() {
			$this->_require_login();
			$this->_require_ajax();
			$following_id = $this->input->post('user_id');
			if($this->User_model->follow($this->user_id, $following_id, TRUE)) {
				echo 1;
			} else {
				echo 0;
			}
		}
		
		// 屏蔽某人
		function block() {
			$this->_require_login();
			$this->_require_ajax();
			$blocker_id = $this->input->post('user_id');
			if($this->User_model->add_blocker($this->user_id, $blocker_id)) {
				echo 1;
			} else {
				echo 0;
			}
		}
		
		// 驳回请求
		function reject_request() {
			$this->_require_login();
			$this->_require_ajax();
			$request_id = $this->input->post('request_id');
			$request = $this->Notify_model->get_info($request_id);
			$json_array = array(
				'success' => 0,
				'message' => ''
			);
			// 判断数据是否存在，是否是请求，接受者是否为当前用户
			if($request && $request['type_id'] == $this->config->item('notify_type_request') && $request['receiver_id'] == $this->session->userdata('id')) {
				$this->db->where('id', $request['id']);
				$this->db->delete('notify');
				$json_array['success'] = 1;
				$json_array['message'] = '成功';
			} else {
				$json_array['message'] = '失败';
			}
			echo json_encode($json_array);
		}
	}
