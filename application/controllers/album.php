<?php
	class Album extends MY_Controller {
		function __construct() {
			parent::__construct();
			$this->load->model('Album_model');
		}
		
		function index() {
			$data['main_content'] = 'album/index_view';
			$data['title'] = '我的相册';
			$data['css'] = array('gallery.css');
			$this->load->view('includes/template_view', $data);
		}
		
		// 列出相册的照片
		function lists() {
			$data['main_content'] = 'album/list_photo_view';
			$data['title'] = '***相册';
			$data['css'] = array('gallery.css','lightbox.css');
			$data['js'] = array('lightbox.js');
			//$data['js'] = 'lightbox.js';
			$this->load->view('includes/template_view', $data);
		}
		
		function create_album() {
			$data['main_content'] = 'album/create_view';
			$data['title'] = '创建相册';
			$data['css'] = array('gallery.css');
			$this->load->view('includes/template_view', $data);
		}
		
		function upload() {
			$this->_require_login();
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
