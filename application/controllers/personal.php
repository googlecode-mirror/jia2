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
			$data['js'] = array('post.js', 'profile_view.js');
			$data['main_content'] = 'personal/profile_view';
			$this->load->view('includes/template_view', $data);
		}
		
		function setting() {
			$this->_require_login();
			$data['title'] = '账户设置';
			$data['main_content'] = 'personal/setting_view';
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
					$post = $this->input->post('post');
					$comment = $this->input->post('comment');
					$post_access = Access_factory::get_access('post');
					$comment_access = Access_factory::get_access('comment');
					switch ($post) {
						case 'guest':
							$post_access_array = array(
								'view' => 'guest',
								'view' => ''
							);
							break;
						case 'register':
							
							break;
						case 'friend':
							
							break;
					}
					break;
				case 'privacy':
				// 隐私设置
					break;
			}
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
