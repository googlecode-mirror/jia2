<?php
	class Corporation extends MY_Controller {
		public $jiadb;
		function __construct() {
			parent::__construct();
			$this->load->model('Corporation_model');
			$this->load->model('User_model');
			$this->jiadb = new Jiadb();
		}
		// 社团之家~？
		function index() {
			$data['title'] = '社团之家';
			$data['main_content'] = 'corporation/index_view';
			$where = array();
			$limit = '';
			$this->jiadb->_table = 'corporation';
			if($this->session->userdata('id')) {
				$following_cos = $this->User_model->get_following_co($this->session->userdata('id'));
				$join_cos = $this->User_model->get_join_co($this->session->userdata('id'));
				$data['j_num'] = count($join_cos);
				$data['f_num'] = count($following_cos);
				if($data['f_num'] > 0) {
					$data['f_corporations'] = $this->jiadb->fetchAll(array('id' => $following_cos));
				}
				if($data['j_num'] > 0) {
					$data['j_corporations'] = $this->jiadb->fetchAll(array('id' => $join_cos));
				}
			}
			$this->load->view('includes/template_view', $data);
		}
		
		// 列出所有社团
		function list_all($id = '', $page = '') {
			$this->jiadb->_table = 'corporation';
			if(!empty($id) && is_numeric($id)) {
				$corporation = $this->Corporation_model->get_info($id);
				if($corporation) {
					$data['corporations'][0] = $corporation;
				} else {
					static_view();
				}
			} elseif(empty($id)) {
				if(is_numeric($page)) {
					$limit = array($this->config->item('page_size'), $this->config->item('page_size') * ($page-1));
				} else {
					$limit = array($this->config->item('page_size'), );
				}
				$limit = array($this->config->item('page_size'), 0);
				$data['title'] = '所有社团';
				$data['corporations'] = $this->jiadb->fetchAll('', '', $limit);
				$data['main_content'] = 'corporation/list_view';
				$this->load->view('includes/template_view', $data);
			} else {
				static_view();
			}
		}
		
		function profile($corporation_id = '') {
			if($corporation_id) {
				$join = array(
					'school' => array('school_id', 'id'),
					'user' => array('user_id', 'id')
				);
				$corporation_info = $this->Corporation_model->get_info(array('id' => $corporation_id), $join);
				if($corporation_info) {
					$data['info'] = $corporation_info;
					$data['main_content'] = 'corporation/profile_view';
					$data['title'] = $data['info']['name'];
					$data['js'] = array('corporation/profile_view.js','corporation/jquery-1.3.2.min.js','corporation/jquery-ui-1.7.custom.min.js');
					$data['css'] = 'corporation/jquery-ui-1.7.custom.css';
					$data['followers'] = $this->Corporation_model->get_followers($corporation_id);
					$this->jiadb->_table = 'user';
					$data['followers_info'] = $data['followers'] ? $this->jiadb->fetchAll(array('id' => $data['followers'])) : array();
					$data['members'] = $this->Corporation_model->get_members($corporation_id);
					$data['members'][] = $data['info']['user_id'];
					$data['members_info'] = $data['members'] ? $this->jiadb->fetchAll(array('id' => $data['members'])) : array();
					$data['posts']['activity'] = $this->Corporation_model->get_trends($corporation_id);
					$data['activities'] = $this->Corporation_model->get_activities($corporation_id);
					$this->load->view('includes/template_view', $data);
				} else {
					static_view('你要查看的社团不存在');
				}
			} else {
				static_view('你要查看的社团不存在');
			}
		}
		
		function add() {
			$this->_require_login();
			$this->_auth('add', 'corporation', $this->session->userdata('id'));
			$this->jiadb->_table = 'school';
			$schools = array();
			$school_result = $this->jiadb->fetchAll();
			foreach ($school_result as $key => $row) {
				$schools[$row['id']] = $row['name'];
			}
			$data['schools'] = $schools;
			$data['title'] = '添加社团';
			$data['main_content'] = 'corporation/add_view';
			$this->load->view('includes/template_view', $data);
		}
		
		function do_add() {
			$this->_require_login();
			$this->_auth('add', 'corporation', $this->session->userdata('id'));
			$name = $this->input->post('name');
			$school_id = $this->input->post('school');
			$user_id = $this->input->post('master');
			$comment = $this->input->post('comment');
			if($name && $comment && $school_id && $user_id) {
				$corporation = array(
					'name' => $name,
					'school_id' => $school_id,
					'user_id' => $user_id,
					'comment' => $comment
				);
				if($corporation_id = $this->Corporation_model->insert($corporation)) {
					redirect('corporation/profile/' . $corporation_id);
				} else {
					static_view('貌似没有创建成功~， 要不然' . anchor('corporation/add', '再试一次？'), '创建社团失败');
				}
			} else {
				static_view('请将表单填写完整', '创建社团失败', site_url('corporation/add'));
			}
		}
		
		function setting($id = '') {
			$this->_require_login();
			if($id == '' || !is_numeric($id)) {
				static_view('抱歉，您访问的页面不存在');
			} else {
				$corporation_info = $this->Corporation_model->get_info($id);
				if($corporation_info) {
					$this->_auth('edit', 'corporation', $id);
					static_view('社团设置页面');
				} else {
					static_view('社团不存在');
				}
			}
		}
		
		function management($corporation_id) {
			$this->_require_login();
			$corporation = $this->Corporation->get_info($corporation_id);
			if($corporation) {
				$this->_auth('edit', 'corporation', $this->session->userdata('id'));
				$type = $this->input->get('type');
				switch ($type) {
					case 'member':
						static_view('成员管理');
						break;
					case 'admin':
						static_view('管理员管理');
						break;
					case 'blocker':
						static_view('黑名单管理');
						break;
					case 'follower':
						static_view('粉丝管理');
						break;
					default:
						static_view();
						break;
				}
			} else {
				static_view();
			}
		}
		
		function follow() {
			$this->_require_login();
			$this->_require_ajax();
			$corporation_id = $this->input->post('id');
			$user_id = $this->session->userdata('id');
			if($this->Corporation_model->follow($user_id, $corporation_id)) {
				echo 1;
			} else {
				echo 0;
			}
		}
		
		function unfollow() {
			$this->_require_login();
			$this->_require_ajax();
			$corporation_id = $this->input->post('id');
			$user_id = $this->session->userdata('id');
			if($this->Corporation_model->follow($user_id, $corporation_id, TRUE)) {
				echo 1;
			} else {
				echo 0;
			}
		}
		
		// 请求加入社团
		function request_join($corporation_id) {
			$this->_require_login();
			$this->_require_ajax();
			$corporation = $this->Corporation_model->get_info($corporation_id);
			$json_array = array(
				'success' => 0,
				'message' => ''
			);
			if($corporation) {
				$blockers = $this->Corporation_model->get_blockers($corporation_id);
				if($blockers && in_array($this->session->userdata('id'), $blockers)) {
					$json_array['message'] = '对不起，由于该社团的隐私设置你不能加入该社团';
				} else {
					$request = array(
						'user_id' => $this->session->userdata('id'),
						'content' => '请求加入 '. anchor('corporation/profile/' . $corporation_id, $corporation['name']) .' 社团' . '|||' . anchor('corporation/add_member/' . $corporation_id . '/' . $this->session->user_data('id')),
						'receiver_id' => $corporation['user_id'],
						'type' => 'request',
						'time' => time()
					);
					$this->Notify_model->insert($request);
					$json_array['success'] = 1;
					$json_array['message'] = '发送请求成功！';
				}
			} else {
				$json_array['message'] = '该社团不存在！';
			}
		}
		
		function add_member($corporation_id, $user_id) {
			$this->_require_login();
			$request_id = $this->input->post('request_id');
			if(empty($request_id))
				static_view('');
			if(is_numeric($corporation_id) && is_numeric($user_id)) {
				$request = $this->Notify_model->get_info($request_id);
				if($request['type_id'] != $this->config->item('notify_type_request') || $request['user_id'] != $user_id)
					static_view();
				$this->_auth('edit', 'corporation', $this->userdata('id'));
				$corporation = $this->Corporation_model->get_info($corporation_id);
				if(!$corporation)
					static_view();
				$this->_auth('edit', 'corporation', $this->session->userdata('id'));
				$code = $this->Corporation_model->join_member($corporation_id, $user_id);
				if($code == 1) {
					static_view('添加会员失败，该用户在社团黑名单内 ' . anchor('corporation/management/' . $corporation_id . '?type=blocker', '管理社团黑名单'));
				} elseif($code == 2) {
					static_view('该会员已是社团成员 ' . anchor('corporation/management/' . $corporation_id . '?type=member', '管理社团成员'));
				} elseif($code == 3) {
					$this->Notify_model->delete($request_id);
					static_view('添加会员成功！你可以' . anchor('personal/notify?type=request', '查看请求') . '或者' . anchor('corporation/management/' . $corporation_id . '?type=member', '管理社团成员'));
				}
			} else {
				static_view();
			}
				
		}
		
		function delete_member() {
			$this->_require_login();
			$this->_require_ajax();
		}
	}