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
				$data['f_num'] = count($following_cos);
				if($data['f_num'] > 0) {
					$data['corporations'] = $this->jiadb->fetchAll(array('id' => $following_cos));
				}
			}
			$this->load->view('includes/template_view', $data);
		}
		
		// 列出所有社团
		function list_all($id = '') {
			$this->jiadb->_table = 'corporation';
			if(!empty($id) && is_numeric($id)) {
				$corporation = $this->Corporation_model->get_info($id);
				if($corporation) {
					$data['corporations'][0] = $corporation;
				} else {
					static_view();
				}
			} elseif(empty($id)) {
				$data['corporations'] = $this->jiadb->fetchAll('', '', 20);
			} else {
				static_view();
			}
		}
		
		function profile($corporation_id = '') {
			if($corporation_id) {
				$join = array(
					'school' => array('school_id', 'id')
				);
				$corporation_info = $this->Corporation_model->get_info(array('id' => $corporation_id), $join);
				if($corporation_info) {
					$data['info'] = $corporation_info;
					$data['main_content'] = 'corporation/profile_view';
					$data['title'] = $data['info']['name'];
					$data['js'] = array('corporation/profile_view.js','corporation/jquery-1.3.2.min.js','corporation/jquery-ui-1.7.custom.min.js');
					$data['css'] = 'corporation/jquery-ui-1.7.custom.css';
					$data['followers'] = $this->Corporation_model->get_followers($corporation_id);
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
	}