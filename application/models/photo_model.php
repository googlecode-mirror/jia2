<?php
	class Photo_model extends CI_Model {
		function __construct() {
			parent::__construct();
			$this->load->library('upload');
			$this->load->library('image_lib');
		}
		
		function upload($param = array()) {
			$config = array(
			  		'allowed_types' => 'jpeg|jpg|png|gif',
			  		'upload_path' => $param['upload_path'],
			  		'max_size' => '2048',
			  		'overwrite' => TRUE,
			  		'file_name'	=> $param['filename']
			 );
			switch ($param['mode']) {
				case 'avatar':
					$this->upload->initialize($config);
					if($this->upload->do_upload()) {
						$image_data = $this->upload->data();
						$thumb_tiny = array(
							'source_image' => $image_data['full_path'],
							'create_thumb' => TRUE,
							'maintain_ratio' => TRUE,
							'thumb_marker' => '',
							'new_image' => $param['upload_path'] . 'tiny/',
							'width' => 50,
							'height' => 50
						);
						$thumb_big = array(
							'source_image' => $image_data['full_path'],
							'create_thumb' => TRUE,
							'maintain_ratio' => TRUE,
							'thumb_marker' => '',
							'new_image' => $param['upload_path'] . 'big/',
							'width' => 180,
							'height' => 180
						);
						$this->image_lib->initialize($thumb_tiny); 
						$this->image_lib->resize();
						$this->image_lib->initialize($thumb_big);
						$this->image_lib->resize();
						// 删除原始图像
						if(file_exists($image_data['full_path']))
							unlink($image_data['full_path']);
						return TRUE;
						} else {
							//错误提示
							// echo $this->upload->display_errors('<p>', '</p>');
							return FALSE;
						}
					break;
				case 'request':
					if(is_array($param['field'])) {
						$filename = array();
						foreach ($param['field'] as $field) {
							$config['file_name'] = $field . '_' . $this->session->userdata('id');
							$this->upload->initialize($config);
							if($this->upload->do_upload($field)) {
								$data = $this->upload->data();
								$filename[$field] = $data['file_name'];
							} else {
								static_view('上传失败！', '上传失败');
							}
						}
					} else {
						$config['file_name'] = $param['filed'] . '_' . $this->session->userdata('id');
						$this->upload->initialize($config);
						if($this->upload->do_upload($param['filed'])) {
							$data = $this->upload->data();
							$filename = $data['file_name'];
						} else {
							static_view('上传失败！', '上传失败');
						}
					}
					return $filename;
					break;
			}
		}
		
		function set_avatar($mode = 'personal', $filename) {
			$param = array(
				'upload_path' => $this->config->item($mode . '_avatar_path'),
				'mode' => 'avatar',
				'filename' => $filename . '.jpg',
			);
			if($this->upload($param)) {
				return $param['filename'];
			} else {
				return FALSE;
			}
		}
		
		function save_request_cap($mode = 'corporation') {
			$param = array(
				'upload_path' => $this->config->item($mode . '_request'),
				'mode' => 'request',
				'filename' => 'tmp',
				'field' => array('id_card_cap', 'st_card_cap')
			);
			return $this->upload($param);
		}
	}
