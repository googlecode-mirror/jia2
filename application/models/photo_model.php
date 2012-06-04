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
								return FALSE;
							}
						}
					} else {
						$config['file_name'] = $param['filename'];
						$this->upload->initialize($config);
						if($this->upload->do_upload($param['field'])) {
							$data = $this->upload->data();
							$filename = $data['file_name'];
						} else {
							return FALSE;
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
		// 上传证件照方法
		function save_request_cap($mode = 'corporation') {
			$param = array(
				'upload_path' => $this->config->item($mode . '_request'),
				'mode' => 'request',
				'filename' => $this->input->post('field') . '_'.$this->input->post('user') . '.jpg',
				'field' => $this->input->post('field')
			);
			if($this->upload($param)) {
				$this->session->set_userdata('type', 'register');
				$this->session->set_userdata('filename', $param['filename']);
				//echo $this->session->userdata('filename');
				//exit();
				// Get the image and create a thumbnail
				/*
			  $img = imagecreatefromjpeg($_FILES[$param['field']]["tmp_name"]);
			  if (!$img) {
			   echo "ERROR:could not create image handle ". $_FILES[$param['field']]["tmp_name"];
			   exit(0);
			  }
			
			  $width = imageSX($img);
			  $height = imageSY($img);
			
			  if (!$width || !$height) {
			   echo "ERROR:Invalid width or height";
			   exit(0);
			  }
			
			  // Build the thumbnail
			  $target_width = 180;
			  $target_height = 180;
			  $target_ratio = $target_width / $target_height;
			
			  $img_ratio = $width / $height;
			
			  if ($target_ratio > $img_ratio) {
			   $new_height = $target_height;
			   $new_width = $img_ratio * $target_height;
			  } else {
			   $new_height = $target_width / $img_ratio;
			   $new_width = $target_width;
			  }
			
			  if ($new_height > $target_height) {
			   $new_height = $target_height;
			  }
			  if ($new_width > $target_width) {
			   $new_height = $target_width;
			  }
				$new_img = ImageCreateTrueColor(180, 180);
				  $white=imagecolorallocate($new_img,255,255,255);
				  if (!@imagefilledrectangle($new_img, 0, 0, $target_width-1, $target_height-1,$white)) { 
				   echo "ERROR:Could not fill new image";
				   exit(0);
				  }
				  if (!@imagecopyresampled($new_img, $img, ($target_width-$new_width)/2, ($target_height-$new_height)/2, 0, 0, $new_width, $new_height, $width, $height)) {
				   echo "ERROR:Could not resize image";
				   exit(0);
				  }
				  /*
					$file_info = $this->session->userdata('file_info');
				  if ($file_info) {
				  	$file_info = array();
					  $this->session->set_userdata('file_info', $file_info);
				  }
				   * 
				   */
				
				  // Use a output buffering to load the image into a variable
				  /*
				  ob_start();
				   
				  //保存缩略图，并生成文件
				  imagejpeg($new_img,$thumb,100);
				  imagejpeg($new_img);
				  
				  $imagevariable = ob_get_contents();
				  ob_end_clean();
				*/
				  $file_id = md5($_FILES[$param['field']]["tmp_name"] + rand()*100000);
				
				  //$file_info[$file_id] = $imagevariable;
					//$this->session->set_userdata('file_info', $file_info);
				  echo "FILEID:" . $file_id; // Return the file id to the script
			}
		}
	}
