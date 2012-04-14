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
			$data['info'] = $this->User_model->get_info((int)$id);
			$data['title'] = '个人主页-' . $data['info'][0]['name'];
			$data['friends'] = $this->User_model->get_meta('friend', $id);
			$data['posts'] = $this->Post_model->fetch(array('owner_id' => $id));
			$data['css'] = array('index.css');
			$data['js'] = array('post.js', 'profile_view.js', 'tab.js');
			$data['main_content'] = 'personal/profile_view';
			$this->load->view('includes/template_view', $data);
		}
		
		function setting() {
			$this->_require_login();
			$post_auth = Auth_factory::get_auth('post', $this->session->userdata('id'));
			$comment_auth = Auth_factory::get_auth('comment', $this->session->userdata('id'));
			$identity_array = array(
				'guest', 'register', 'friend'
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
			$data['info'] = $this->User_model->get_info((int)$this->session->userdata('id'));
			$data['main_content'] = 'personal/setting_view';
			$data['css'] = array('common.css','index.css');
			$data['js'] = array('tab.js','personal/setting.js');
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
								array('identity' => 'friend', 'operation' => 'view', 'access' => 1)
							);
							break;
						case 'register':
							$post_access_array = array(
								array('identity' => 'guest', 'operation' => 'view', 'access' => 0),
								array('identity' => 'register', 'operation' => 'view', 'access' => 1),
								array('identity' => 'friend', 'operation' => 'view', 'access' => 1)
							);
							break;
						case 'friend':
							$post_access_array = array(
								array('identity' => 'guest', 'operation' => 'view', 'access' => 0),
								array('identity' => 'register', 'operation' => 'view', 'access' => 0),
								array('identity' => 'friend', 'operation' => 'view', 'access' => 1)
							);
							break;
						case 'self':
							$post_access_array = array(
								array('identity' => 'guest', 'operation' => 'view', 'access' => 0),
								array('identity' => 'register', 'operation' => 'view', 'access' => 0),
								array('identity' => 'friend', 'operation' => 'view', 'access' => 0)
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
								array('identity' => 'friend', 'operation' => 'add', 'access' => 1)
							);
							break;
						case 'friend':
							$comment_access_array = array(
								array('identity' => 'register', 'operation' => 'add', 'access' => 0),
								array('identity' => 'friend', 'operation' => 'add', 'access' => 1)
							);
							break;
						case 'self':
							$comment_access_array = array(
								array('identity' => 'register', 'operation' => 'add', 'access' => 0),
								array('identity' => 'friend', 'operation' => 'add', 'access' => 0)
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
		
		function add_friend() {
			$this->_require_login();
			$this->_require_ajax();
			$friend_id = $this->input->post('user_id');
			if($this->User_model->add_friend($this->user_id, $friend_id)) {
				echo 1;
			} else {
				echo 0;
			}
		}
		
		function add_blocker() {
			$this->_require_login();
			$this->_require_ajax();
			$blocker_id = $this->input->post('user_id');
			if($this->User_model->add_blocker($this->user_id, $blocker_id)) {
				echo 1;
			} else {
				echo 0;
			}
		}
	}
