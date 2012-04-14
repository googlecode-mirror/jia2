<?php
	class Corporation extends MY_Controller {
		public $jiadb;
		function __construct() {
			parent::__construct();
			$this->load->model('Corporation_model');
			$this->jiadb = new Jiadb();
		}
		// 社团之家~？
		function index() {
			static_view('这里将展示社团综合信息');
		}
		
		function profile($id) {
			$join = array(
				'school' => array('school_id', 'id')
			);
			$data['info'] = $this->Corporation_model->get_info(array('id' => $id), $join);
			$data['main_content'] = 'corporation/profile_view';
			$data['title'] = $data['info'][0]['name'] .  ' | 加加社团';
			$data['css'] = 'corporation/css/profile.css';
			$this->load->view('includes/template_view', $data);
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
					static_view('貌似没有创建成功~， 要不然' . anchor('corporation/add', '再试一次？'), '', '创建社团失败');
				}
			} else {
				static_view('请将表单填写完整', site_url('corporation/add'), '创建社团失败');
			}
		}
		
		function setting($id = '') {
			if($id = '' || !is_numeric($id)) {
				static_view('未定义操作', '未定义操作');
			} else {
				$this->_auth('edit', 'corporation', $owner_id);
			}
		}
	}