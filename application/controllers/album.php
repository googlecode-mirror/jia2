<?php
	class Album extends MY_Controller {
		function __construct() {
			parent::__construct();
			$this->load->model('Album_model');
		}
		
		function index($id = '', $entity_type = 'personal') {
			$owner_id = $id ? $id : $this->session->userdata('id');
			$where = array(
				'owner_id' => $owner_id,
			);
			if($entity_type == 'personal') {
				$this->load->model('User_model');
				$data['info'] = $this->User_model->get_info($owner_id);
				if(!$data['info'])
					static_view();
				$where['type_id'] = $this->config->item('entity_type_personal');
			} elseif($entity_type == 'corporation') {
				$this->load->model('Corporation_model');
				$data['info'] = $this->Corporation_model->get_info($owner_id);
				if(!$data['info'])
					static_view();
				$where['type_id'] = $this->config->item('entity_type_corporation');
			} else {
				static_view();
			}
			$data['albums'] = $this->Album_model->fetch_album($where);
			$data['main_content'] = 'album/index_view';
			$data['title'] = '我的相册';
			$data['css'] = array('gallery.css');
			$this->load->view('includes/template_view', $data);
		}
		
		// 列出相册的照片
		function lists($album_id = '') {
			if(!$album_id || !is_numeric($album_id))
				static_view();
			$data['main_content'] = 'album/list_photo_view';
			$data['info'] = $this->Album_model->get_info($album_id);
			$data['photos'] = $this->Album_model->fetch_photo($album_id);
			$data['title'] = $data['info']['name'];
			$data['js'] = array('lightbox.js');
			$data['css'] = array('gallery.css','lightbox.css');
			$this->load->view('includes/template_view', $data);
		}
		
		function create($id = '', $entity_type = 'personal') {
			$this->_require_login();
			$owner_id = $id ? $id : $this->session->userdata('id');
			$entity_type = $this->input->post('entity');
			if($entity_type == 'personal') {
				$this->load->model('User_model');
				$info = $this->User_model->get_info($owner_id);
				if($info['id'] != $this->session->userdata('id'))
					static_view('权限不足');
			}
			if($this->input->post('submit')) {
				$name = $this->input->post('name');
				$tags = $this->input->post('tags');
				//$tags_array = explode(' ', $tags);
				//$tags_array = array_filter($tags_array, function($i){if(trim($i) == '') return false; else return true;});
				//$tags = implode(' ', $tags_array);
				$type = $entity_type == 'corporation' ? 'corporation' : 'personal';
				$status = $this->input->post('status') == 'public' ? $this->config->item('status_public') : $this->config->item('status_privary');
				$album = array(
					'name' => $name,
					'owner_id' => $owner_id,
					'type' => $type,
					'status' => $status,
					'tags' => $tags
				);
				$album_id = $this->Album_model->insert($album);
				if(is_numeric($album_id)) {
					static_view('创建相册成功' . anchor('album/'.$album_id, '查看相册') . '|' .anchor('album/upload', '上传图片'), '创建相册成功');
				} else {
					static_view($album_id, '创建失败');
				}
			}
			$data['main_content'] = 'album/create_view';
			$data['title'] = '创建相册';
			$data['css'] = array('gallery.css');
			$this->load->view('includes/template_view', $data);
		}
		
		function upload() {
			$this->_require_login();
			$this->load->model('Photo_model');
			$albums = $this->Album_model->fetch_album(array('owner_id' => $this->session->userdata('id'), 'type_id' => $this->config->item('entity_type_personal')));
			if(!$albums)
				static_view('你需要先' . anchor('album/create', '创建一个相册'), '上传图片');
			
			foreach ($albums as $value) {
				$data['albums_id'][$value['id']] = $value['name'];
			}
			// 提交表单
			if($this->input->post('submit')) {
				$album_id = $this->input->post('album');
				if(!array_key_exists($album_id, $data['albums_id']))
					static_view('上传失败', '相册不存在');
				$path = $this->config->item('personal_album_path');
				$filename = $this->Photo_model->save_album_photo($path);
				if($filename) {
					$photo = array(
						'album_id' => $album_id,
						'name' => '图片'
					);
					$photo = array_merge($photo, $filename);
					$this->db->insert('photo', $photo);
					static_view('上传成功' . anchor('album', '返回相册'), '上传成功');
				} else {
					static_view('上传失败');
				}
			}
			$data['albums'] = $albums;
			$data['main_content'] = 'album/upload_view';
			$data['title'] = '上传照片';
			$data['css'] = array('gallery.css');
			$this->load->view('includes/template_view', $data);
		}
		
		function delte() {
			
		}
		
		function edit() {
			
		}
	}
