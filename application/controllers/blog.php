<?php
	class Blog extends MY_Controller {
		function __construct() {
			parent::__construct();
		}
		
		// 默认加载当前用户blog
		function index() {
			$this->_require_login();
			$data['title'] = '发表日志';
			$data['main_content'] = 'blog/index_view';
			$this->load->view('includes/template_view', $data);
		}
		
		//发表日志
		function post() {
			$this->_require_login();
			$data['img_manager'] = site_url('blog/img_manager');
			$data['img_up'] = site_url('blog/img_up');
			if($this->input->get('entity') == 'corporation') {
				$id = $this->input->get('id');
				$this->load->model('Corporation_model');
				$corporation_info = $Corporation_model->get_info($id);
				// 默认只有社长能发布社团日志，后期加入日志权限
				if($corporation_info && $corporation_info['user_id'] == $this->session->userdata('id')) {
					$data['img_up'] .= '?entity=corporation' . '&id=' . $id;
					$data['img_manager'] .= '?entity=corporation' . '&id=' . $id;
					$data['img_path'] = '/' . $this->config->item('corporation_blog_path') . $id;
				} else {
					static_view('你没有改权限', '权限不足');
				}
			} else {
				$data['img_up'] .= '?id=' . $this->session->userdata('id');
				$data['img_manager'] .= '?id=' . $this->session->userdata('id');
				$data['img_path'] = $this->config->item('personal_blog_path') . $this->session->userdata('id');
			}
			if($this->input->post('submit')) {
				static_view('执行插入数据库');
			} else {
				$data['main_content'] = '/'.'blog/post_view';
				$this->load->view('includes/template_view', $data);
			}
		}
		
		//日志图片上传
		function img_up() {
			$state = "上传失败";
			$this->load->model('Photo_model');
			//原始文件名，表单名固定，不可配置
		    $oriName = htmlspecialchars($_POST['fileName'], ENT_QUOTES);
		    //上传图片框中的描述表单名称，
		    $title = htmlspecialchars($_POST['pictitle'], ENT_QUOTES);
			$id = $this->input->get('id');
			$entity = $this->input->get('entity');
			if($entity == 'corporation') {
				$path = $this->config->item('corporation_blog_path') . $id .'/';
			} else {
				$path = $this->config->item('personal_blog_path') . $id . '/'; 
			}
			if(!file_exists($path)) {
				mkdir($path);
			}
			$fileName = $this->Photo_model->save_blog_img($path);
			if($fileName) {
				$fileName = $path . $fileName;
				$state = 'SUCCESS';
			}
			echo "{'url':'".$fileName."','title':'".$title."','original':'".$oriName."','state':'".$state."'}";
		}
		
		function img_manager() {
			$id = $this->input->get('id');
			$entity = $this->input->get('entity');
			if($entity == 'corporation') {
				$path = $this->config->item('corporation_blog_path') . $id;
			} else {
				$path = $this->config->item('personal_blog_path') . $id; 
			}
			$action = htmlspecialchars($_POST["action"]);
			if($action=="get"){
				$this->load->model('Photo_model');
			    $files = $this->Photo_model->getfiles($path);
			    if(!$files)return;
			    $str = "";
			    foreach ($files as $file) {
			    	$str .= $file."ue_separate_ue";
			    }
			    echo $str;
			}
		}
		
		//获取视频
		function get_movie() {
			$key =htmlspecialchars($_POST["searchKey"]);
			$type = htmlspecialchars($_POST["videoType"]);
			$html = file_get_contents('http://api.tudou.com/v3/gw?method=item.search&appKey=myKey&format=json&kw='.$key.'&pageNo=1&pageSize=20&channelId='.$type.'&inDays=7&media=v&sort=s');
			echo $html;
		}
		
		function edit() {
			$this->_require_login();
			$blog_id = $this->input->get('id');
		}
	}