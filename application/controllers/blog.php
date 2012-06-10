<?php
	class Blog extends MY_Controller {
		function __construct() {
			parent::__construct();
			$this->load->model('Blog_model');
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
			
			// 提交表单
			if($this->input->post('submit') || $this->input->post('draft')) {
				$title = trim($this->input->post('title'));
				if($this->input->post('draft')) {
					$draft = 1;
				} else {
					$draft = 0;
					$privacy = $this->input->post('privacy');
					$status = ($privacy == 'privary' ? $this->config->item('blog_status_privary') : $this->config->item('blog_status_public')); 
				}
				$content = $this->input->post('myContent');
				$tags = trim($this->input->post('tag'));
				if($title && $content != '') {
					if($tags) {
						$tags_array = explode(' ', $tags);
						$tags_array = array_filter($tags_array, function($i){if(trim($i) == '') return false; else return true;});
						$tags = implode(' ', $tags_array);
					}
					$time = time();
					$blog = array(
						'title' => $title,
						'content' =>$content,
						'tags' => $tags,
						'status' => $status,
						'draft' => $draft,
						'add_time' => $time,
						'update_time' => $time,
						'type' => 'personal'
					);
					$blog_id = $this->Blog_model->insert($blog);
					if($blog_id) {
						$str = '发布日志成功！ ' . anchor('blog/view/' . $blog_id, '查看');
						static_view($str, '发布成功');
					}
				} else {
					static_view('发表失败');
				}
			} else {
				// 加载编辑视图
				$data['title'] = '发布日志';
				$data['main_content'] = '/'.'blog/post_view';
				$this->load->view('includes/template_view', $data);
			}
		}
		
		// 编辑日志
		function edit() {
			$this->_require_login();
			$blog_id = $this->input->get('id');
		}
		
		// 查看单篇日志
		function view() {
			
		}
		
		// 列出某个用户或者社团的日志
		function lists($entity_type, $owner_id) {
			
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
		
		//UEditor获取视频
		function get_movie() {
			$key =htmlspecialchars($_POST["searchKey"]);
			$type = htmlspecialchars($_POST["videoType"]);
			$html = file_get_contents('http://api.tudou.com/v3/gw?method=item.search&appKey=myKey&format=json&kw='.$key.'&pageNo=1&pageSize=20&channelId='.$type.'&inDays=7&media=v&sort=s');
			echo $html;
		}
	}